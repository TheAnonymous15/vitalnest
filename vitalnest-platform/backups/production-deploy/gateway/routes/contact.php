<?php
/**
 * Contact Form API Endpoint
 * Handles direct messages from the public contact form
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Validate required fields
    $required = ['name', 'email', 'subject', 'message'];
    $missing = [];

    foreach ($required as $field) {
        if (empty($input[$field])) {
            $missing[] = $field;
        }
    }

    if (!empty($missing)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields: ' . implode(', ', $missing)
        ]);
        exit;
    }

    // Validate email format
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address'
        ]);
        exit;
    }

    // Sanitize inputs
    $name = htmlspecialchars(trim($input['name']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL);
    $phone = isset($input['phone']) ? htmlspecialchars(trim($input['phone']), ENT_QUOTES, 'UTF-8') : null;
    $subject = htmlspecialchars(trim($input['subject']), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($input['message']), ENT_QUOTES, 'UTF-8');

    // Determine priority based on subject
    $priority = 'normal';
    if (stripos($subject, 'emergency') !== false || stripos($subject, 'urgent') !== false) {
        $priority = 'high';
    } elseif (stripos($subject, 'booking') !== false) {
        $priority = 'medium';
    }

    // Connect to notifications database
    $dbPath = __DIR__ . '/../../database/vitalnest_notifications.db';

    if (!file_exists($dbPath)) {
        throw new Exception('Database not found');
    }

    $db = new SQLite3($dbPath);
    $db->busyTimeout(5000);

    // Prepare statement
    $stmt = $db->prepare('
        INSERT INTO messages (
            sender_name,
            sender_email,
            sender_phone,
            subject,
            message,
            priority,
            status,
            created_at
        ) VALUES (
            :name,
            :email,
            :phone,
            :subject,
            :message,
            :priority,
            "unread",
            datetime("now")
        )
    ');

    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':subject', $subject, SQLITE3_TEXT);
    $stmt->bindValue(':message', $message, SQLITE3_TEXT);
    $stmt->bindValue(':priority', $priority, SQLITE3_TEXT);

    $result = $stmt->execute();

    if (!$result) {
        throw new Exception('Failed to save message');
    }

    $messageId = $db->lastInsertRowID();

    $db->close();

    // Success response
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Your message has been sent successfully! We\'ll get back to you soon.',
        'data' => [
            'message_id' => $messageId,
            'priority' => $priority
        ]
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while sending your message. Please try again.',
        'error' => $e->getMessage()
    ]);
}

