<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$dbPath = __DIR__ . '/../../../database/vitalnest_identity.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$path = $_SERVER['REQUEST_URI'];

// POST /request-reset - Request password reset
if ($method === 'POST' && strpos($path, 'request-reset') !== false) {
    $email = $input['email'] ?? '';
    $phone = $input['phone'] ?? '';

    // Must provide either email or phone
    if (!$email && !$phone) {
        echo json_encode(['success' => false, 'message' => 'Email or phone number is required']);
        exit;
    }

    // Validate email if provided
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Valid email is required']);
        exit;
    }

    // Check if user exists by email or phone
    if ($email) {
        $stmt = $db->prepare("SELECT id, first_name, email FROM users WHERE email = ? AND role = 'client'");
        $stmt->execute([$email]);
    } else {
        $stmt = $db->prepare("SELECT id, first_name, email FROM users WHERE phone = ? AND role = 'client'");
        $stmt->execute([$phone]);
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Don't reveal if email/phone exists or not for security
        echo json_encode([
            'success' => true,
            'message' => 'If your account is registered, you will receive reset instructions.'
        ]);
        exit;
    }

    // Generate reset token
    $token = bin2hex(random_bytes(32));
    $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Invalidate old tokens for this email
    $db->prepare("UPDATE password_resets SET used = 1 WHERE email = ? AND used = 0")->execute([$user['email']]);

    // Insert new token (always use email from user record)
    $stmt = $db->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$user['email'], $token, $expiresAt]);

    // In a real app, send email/SMS here
    // For now, return token (in production, this would be sent via email/SMS)

    echo json_encode([
        'success' => true,
        'message' => 'Password reset instructions sent',
        'dev_token' => $token // Remove in production
    ]);
    exit;
}


// POST /reset-password - Reset password with token
if ($method === 'POST' && strpos($path, 'reset-password') !== false) {
    $token = $input['token'] ?? '';
    $newPassword = $input['new_password'] ?? '';

    if (!$token || !$newPassword) {
        echo json_encode(['success' => false, 'message' => 'Token and new password are required']);
        exit;
    }

    if (strlen($newPassword) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        exit;
    }

    // Verify token
    $stmt = $db->prepare("
        SELECT email FROM password_resets
        WHERE token = ? AND used = 0 AND datetime(expires_at) > datetime('now')
    ");
    $stmt->execute([$token]);
    $reset = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reset) {
        echo json_encode(['success' => false, 'message' => 'Invalid or expired reset token']);
        exit;
    }

    // Update password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $stmt = $db->prepare("UPDATE users SET password = ?, updated_at = datetime('now') WHERE email = ?");
    $stmt->execute([$hashedPassword, $reset['email']]);

    // Mark token as used
    $db->prepare("UPDATE password_resets SET used = 1 WHERE token = ?")->execute([$token]);

    echo json_encode([
        'success' => true,
        'message' => 'Password reset successful! You can now login with your new password.'
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);

