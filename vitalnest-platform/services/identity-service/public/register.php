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

// OTP Service URL
define('OTP_SEND_URL', 'https://synavuetechnologies.com/send_otp/');

/**
 * Send OTP to email using external service
 */
function sendOtpToEmail(string $email): array {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => OTP_SEND_URL,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(['email' => $email]),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        error_log("OTP Send Error: " . $error);
        return ['success' => false, 'message' => 'Failed to send OTP'];
    }

    $result = json_decode($response, true);

    if ($result && isset($result['success']) && $result['success']) {
        return ['success' => true, 'message' => 'OTP sent successfully'];
    }

    // If HTTP was successful, assume OTP was sent
    if ($httpCode >= 200 && $httpCode < 300) {
        return ['success' => true, 'message' => 'OTP sent successfully'];
    }

    return ['success' => false, 'message' => $result['message'] ?? 'Failed to send OTP'];
}

// POST /register - Client registration
if ($method === 'POST') {
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';
    $firstName = $input['first_name'] ?? '';
    $lastName = $input['last_name'] ?? '';
    $phone = $input['phone'] ?? '';

    // Validation
    if (!$email || !$password || !$firstName || !$lastName) {
        echo json_encode([
            'success' => false,
            'message' => 'Email, password, first name, and last name are required'
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        exit;
    }

    // Check if email already exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user with pending status (will be activated after OTP verification)
    try {
        $stmt = $db->prepare("
            INSERT INTO users (email, password, first_name, last_name, phone, role, status, email_verified, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, 'client', 'pending', 0, datetime('now'), datetime('now'))
        ");

        $stmt->execute([$email, $hashedPassword, $firstName, $lastName, $phone]);

        $userId = $db->lastInsertId();

        // Send OTP to the registered email using external service
        $otpResult = sendOtpToEmail($email);

        echo json_encode([
            'success' => true,
            'message' => 'Registration successful! Please verify your email with the OTP sent.',
            'requires_otp' => true,
            'otp_sent' => $otpResult['success'],
            'data' => [
                'user_id' => $userId,
                'email' => $email,
                'first_name' => $firstName,
                'last_name' => $lastName
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request method']);

