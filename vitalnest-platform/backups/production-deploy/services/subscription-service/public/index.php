<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$startTime = microtime(true);
$dbPath = __DIR__ . '/../../../database/vitalnest_subscriptions.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    respondWithError('Database connection failed', 500);
}

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$pathParts = array_filter(explode('/', $requestUri));
$pathParts = array_values($pathParts);

// Helper functions
function respondWithError($message, $code = 400) {
    global $startTime;
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'message' => $message,
        '_meta' => [
            'service' => 'subscription-service',
            'execution_time' => number_format((microtime(true) - $startTime) * 1000, 1) . 'ms'
        ]
    ]);
    exit;
}

function respondWithSuccess($data, $message = '') {
    global $startTime;
    echo json_encode([
        'success' => true,
        'message' => $message,
        'data' => $data,
        '_meta' => [
            'service' => 'subscription-service',
            'execution_time' => number_format((microtime(true) - $startTime) * 1000, 1) . 'ms'
        ]
    ]);
    exit;
}

function getJsonInput() {
    $input = file_get_contents('php://input');
    return json_decode($input, true) ?: [];
}

// Routes
if ($requestMethod === 'GET' && isset($pathParts[0]) && $pathParts[0] === 'packages') {
    // GET /packages - Get all available packages
    $activeOnly = $_GET['active_only'] ?? '1';

    $sql = "SELECT * FROM packages";
    if ($activeOnly === '1') {
        $sql .= " WHERE is_active = 1";
    }
    $sql .= " ORDER BY sort_order ASC, price ASC";

    $stmt = $db->query($sql);
    $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($packages as &$package) {
        $package['features'] = json_decode($package['features'], true);
    }

    respondWithSuccess($packages);
}

if ($requestMethod === 'GET' && isset($pathParts[0]) && $pathParts[0] === 'subscription') {
    // GET /subscription?user_id=X - Get user's current subscription
    $userId = $_GET['user_id'] ?? null;

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $stmt = $db->prepare("
        SELECT s.*, p.name as package_name, p.description as package_description,
               p.price, p.billing_cycle, p.features, p.max_appointments,
               p.max_family_members, p.telemedicine_enabled, p.priority_support,
               p.lab_discount, p.pharmacy_discount
        FROM subscriptions s
        JOIN packages p ON s.package_id = p.id
        WHERE s.user_id = ? AND s.status = 'active'
        ORDER BY s.created_at DESC
        LIMIT 1
    ");

    $stmt->execute([$userId]);
    $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($subscription) {
        $subscription['features'] = json_decode($subscription['features'], true);

        // Get usage stats
        $subscription['usage'] = [
            'appointments_used' => 0, // TODO: Query from scheduling service
            'appointments_limit' => $subscription['max_appointments']
        ];
    }

    respondWithSuccess($subscription);
}

if ($requestMethod === 'POST' && isset($pathParts[0]) && $pathParts[0] === 'subscribe') {
    // POST /subscribe - Create new subscription
    $data = getJsonInput();
    $userId = $data['user_id'] ?? null;
    $packageId = $data['package_id'] ?? null;

    if (!$userId || !$packageId) {
        respondWithError('User ID and Package ID are required');
    }

    // Check if package exists
    $stmt = $db->prepare("SELECT * FROM packages WHERE id = ? AND is_active = 1");
    $stmt->execute([$packageId]);
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$package) {
        respondWithError('Invalid package');
    }

    // Check for existing active subscription
    $stmt = $db->prepare("SELECT * FROM subscriptions WHERE user_id = ? AND status = 'active'");
    $stmt->execute([$userId]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        respondWithError('User already has an active subscription. Please upgrade/downgrade instead.');
    }

    $db->beginTransaction();

    try {
        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s', strtotime('+1 month'));
        $nextBillingDate = $endDate;

        $stmt = $db->prepare("
            INSERT INTO subscriptions (user_id, package_id, status, start_date, end_date, next_billing_date)
            VALUES (?, ?, 'active', ?, ?, ?)
        ");
        $stmt->execute([$userId, $packageId, $startDate, $endDate, $nextBillingDate]);
        $subscriptionId = $db->lastInsertId();

        // Create initial billing record
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad($subscriptionId, 6, '0', STR_PAD_LEFT);
        $stmt = $db->prepare("
            INSERT INTO billing_history (subscription_id, user_id, amount, status, description, invoice_number, billing_date)
            VALUES (?, ?, ?, 'paid', ?, ?, ?)
        ");
        $stmt->execute([
            $subscriptionId,
            $userId,
            $package['price'],
            'Initial subscription to ' . $package['name'],
            $invoiceNumber,
            $startDate
        ]);

        $db->commit();

        respondWithSuccess([
            'subscription_id' => $subscriptionId,
            'package_name' => $package['name'],
            'amount' => $package['price'],
            'invoice_number' => $invoiceNumber
        ], 'Subscription created successfully');

    } catch (Exception $e) {
        $db->rollBack();
        respondWithError('Failed to create subscription: ' . $e->getMessage(), 500);
    }
}

if ($requestMethod === 'POST' && isset($pathParts[0]) && $pathParts[0] === 'change-plan') {
    // POST /change-plan - Upgrade or downgrade subscription
    $data = getJsonInput();
    $userId = $data['user_id'] ?? null;
    $newPackageId = $data['new_package_id'] ?? null;

    if (!$userId || !$newPackageId) {
        respondWithError('User ID and new package ID are required');
    }

    // Get current subscription
    $stmt = $db->prepare("SELECT * FROM subscriptions WHERE user_id = ? AND status = 'active'");
    $stmt->execute([$userId]);
    $currentSub = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$currentSub) {
        respondWithError('No active subscription found');
    }

    // Get new package
    $stmt = $db->prepare("SELECT * FROM packages WHERE id = ? AND is_active = 1");
    $stmt->execute([$newPackageId]);
    $newPackage = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$newPackage) {
        respondWithError('Invalid new package');
    }

    // Get current package
    $stmt = $db->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->execute([$currentSub['package_id']]);
    $currentPackage = $stmt->fetch(PDO::FETCH_ASSOC);

    $db->beginTransaction();

    try {
        $changeType = $newPackage['price'] > $currentPackage['price'] ? 'upgrade' : 'downgrade';
        $effectiveDate = date('Y-m-d H:i:s');

        // Update subscription
        $stmt = $db->prepare("UPDATE subscriptions SET package_id = ?, updated_at = ? WHERE id = ?");
        $stmt->execute([$newPackageId, $effectiveDate, $currentSub['id']]);

        // Log the change
        $stmt = $db->prepare("
            INSERT INTO subscription_changes (subscription_id, user_id, from_package_id, to_package_id,
                                              change_type, effective_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $currentSub['id'],
            $userId,
            $currentSub['package_id'],
            $newPackageId,
            $changeType,
            $effectiveDate
        ]);

        $db->commit();

        respondWithSuccess([
            'change_type' => $changeType,
            'from_package' => $currentPackage['name'],
            'to_package' => $newPackage['name'],
            'new_price' => $newPackage['price']
        ], ucfirst($changeType) . ' successful');

    } catch (Exception $e) {
        $db->rollBack();
        respondWithError('Failed to change plan: ' . $e->getMessage(), 500);
    }
}

if ($requestMethod === 'POST' && isset($pathParts[0]) && $pathParts[0] === 'cancel') {
    // POST /cancel - Cancel subscription
    $data = getJsonInput();
    $userId = $data['user_id'] ?? null;
    $reason = $data['reason'] ?? '';

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $stmt = $db->prepare("SELECT * FROM subscriptions WHERE user_id = ? AND status = 'active'");
    $stmt->execute([$userId]);
    $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$subscription) {
        respondWithError('No active subscription found');
    }

    $db->beginTransaction();

    try {
        $cancellationDate = date('Y-m-d H:i:s');

        $stmt = $db->prepare("
            UPDATE subscriptions
            SET status = 'cancelled',
                auto_renew = 0,
                cancellation_date = ?,
                cancellation_reason = ?,
                updated_at = ?
            WHERE id = ?
        ");
        $stmt->execute([$cancellationDate, $reason, $cancellationDate, $subscription['id']]);

        $db->commit();

        respondWithSuccess([
            'subscription_id' => $subscription['id'],
            'cancelled_at' => $cancellationDate
        ], 'Subscription cancelled successfully');

    } catch (Exception $e) {
        $db->rollBack();
        respondWithError('Failed to cancel subscription: ' . $e->getMessage(), 500);
    }
}

if ($requestMethod === 'GET' && isset($pathParts[0]) && $pathParts[0] === 'billing-history') {
    // GET /billing-history?user_id=X - Get billing history
    $userId = $_GET['user_id'] ?? null;
    $limit = $_GET['limit'] ?? 50;

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $stmt = $db->prepare("
        SELECT bh.*, s.package_id, p.name as package_name
        FROM billing_history bh
        LEFT JOIN subscriptions s ON bh.subscription_id = s.id
        LEFT JOIN packages p ON s.package_id = p.id
        WHERE bh.user_id = ?
        ORDER BY bh.created_at DESC
        LIMIT ?
    ");

    $stmt->execute([$userId, (int)$limit]);
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

    respondWithSuccess($history);
}

if ($requestMethod === 'GET' && isset($pathParts[0]) && $pathParts[0] === 'payment-methods') {
    // GET /payment-methods?user_id=X - Get payment methods
    $userId = $_GET['user_id'] ?? null;

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $stmt = $db->prepare("
        SELECT * FROM payment_methods
        WHERE user_id = ? AND status = 'active'
        ORDER BY is_default DESC, created_at DESC
    ");

    $stmt->execute([$userId]);
    $methods = $stmt->fetchAll(PDO::FETCH_ASSOC);

    respondWithSuccess($methods);
}

if ($requestMethod === 'POST' && isset($pathParts[0]) && $pathParts[0] === 'payment-methods') {
    // POST /payment-methods - Add new payment method
    $data = getJsonInput();
    $userId = $data['user_id'] ?? null;
    $type = $data['type'] ?? null; // card, mobile_money

    if (!$userId || !$type) {
        respondWithError('User ID and payment type are required');
    }

    $db->beginTransaction();

    try {
        $isDefault = $data['is_default'] ?? 0;

        // If this is set as default, unset other defaults
        if ($isDefault) {
            $stmt = $db->prepare("UPDATE payment_methods SET is_default = 0 WHERE user_id = ?");
            $stmt->execute([$userId]);
        }

        $stmt = $db->prepare("
            INSERT INTO payment_methods (user_id, type, card_last_four, card_brand, card_exp_month,
                                        card_exp_year, mobile_money_provider, mobile_money_number, is_default)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $userId,
            $type,
            $data['card_last_four'] ?? null,
            $data['card_brand'] ?? null,
            $data['card_exp_month'] ?? null,
            $data['card_exp_year'] ?? null,
            $data['mobile_money_provider'] ?? null,
            $data['mobile_money_number'] ?? null,
            $isDefault
        ]);

        $methodId = $db->lastInsertId();
        $db->commit();

        respondWithSuccess(['payment_method_id' => $methodId], 'Payment method added successfully');

    } catch (Exception $e) {
        $db->rollBack();
        respondWithError('Failed to add payment method: ' . $e->getMessage(), 500);
    }
}

if ($requestMethod === 'DELETE' && isset($pathParts[0]) && $pathParts[0] === 'payment-methods' && isset($pathParts[1])) {
    // DELETE /payment-methods/{id} - Remove payment method
    $methodId = $pathParts[1];
    $userId = $_GET['user_id'] ?? null;

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $stmt = $db->prepare("UPDATE payment_methods SET status = 'inactive' WHERE id = ? AND user_id = ?");
    $stmt->execute([$methodId, $userId]);

    if ($stmt->rowCount() > 0) {
        respondWithSuccess([], 'Payment method removed successfully');
    } else {
        respondWithError('Payment method not found');
    }
}

// PUT /payment-methods/{id}/set-default - Set default payment method
if ($requestMethod === 'PUT' && isset($pathParts[0]) && $pathParts[0] === 'payment-methods' && isset($pathParts[1]) && isset($pathParts[2]) && $pathParts[2] === 'set-default') {
    $methodId = $pathParts[1];
    $data = getJsonInput();
    $userId = $data['user_id'] ?? null;

    if (!$userId) {
        respondWithError('User ID is required');
    }

    $db->beginTransaction();

    try {
        // Unset all defaults for this user
        $stmt = $db->prepare("UPDATE payment_methods SET is_default = 0 WHERE user_id = ?");
        $stmt->execute([$userId]);

        // Set this one as default
        $stmt = $db->prepare("UPDATE payment_methods SET is_default = 1 WHERE id = ? AND user_id = ?");
        $stmt->execute([$methodId, $userId]);

        if ($stmt->rowCount() > 0) {
            $db->commit();
            respondWithSuccess([], 'Default payment method updated');
        } else {
            $db->rollBack();
            respondWithError('Payment method not found');
        }
    } catch (Exception $e) {
        $db->rollBack();
        respondWithError('Failed to update default payment method: ' . $e->getMessage(), 500);
    }
}

// Default response
respondWithError('Route not found', 404);

