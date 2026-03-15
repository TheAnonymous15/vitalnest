<?php
/**
 * OTP Service Endpoint
 * Uses external OTP service from SynaVue Technologies
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// External OTP Service URLs
define('OTP_SEND_URL', 'https://synavuetechnologies.com/send_otp/');
define('OTP_VERIFY_URL', 'https://synavuetechnologies.com/verify_otp/');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

// Get action from query string or request body
$action = $_GET['action'] ?? $input['action'] ?? '';

/**
 * Send OTP to email
 */
function sendOtp(string $email): array {
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
        return ['success' => false, 'message' => 'Failed to send OTP. Please try again.'];
    }

    $result = json_decode($response, true);

    if ($result && isset($result['success']) && $result['success']) {
        return [
            'success' => true,
            'message' => 'OTP sent successfully to your email',
            'code' => $result['code'] ?? '00'
        ];
    }

    // If response is empty but HTTP was successful, assume OTP was sent
    if ($httpCode >= 200 && $httpCode < 300) {
        return [
            'success' => true,
            'message' => 'OTP sent successfully to your email'
        ];
    }

    return [
        'success' => false,
        'message' => $result['message'] ?? 'Failed to send OTP. Please try again.'
    ];
}

/**
 * Verify OTP
 */
function verifyOtp(string $email, string $otp): array {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => OTP_VERIFY_URL,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(['email' => $email, 'otp' => $otp]),
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
        error_log("OTP Verify Error: " . $error);
        return ['success' => false, 'message' => 'Verification failed. Please try again.'];
    }

    $result = json_decode($response, true);

    if ($result && isset($result['success']) && $result['success']) {
        return [
            'success' => true,
            'message' => 'OTP verified successfully',
            'code' => $result['code'] ?? '00'
        ];
    }

    return [
        'success' => false,
        'message' => $result['message'] ?? 'Invalid OTP. Please try again.'
    ];
}

// Handle POST requests
if ($method === 'POST') {
    switch ($action) {
        case 'send':
            $email = $input['email'] ?? '';

            if (empty($email)) {
                echo json_encode(['success' => false, 'message' => 'Email is required']);
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid email format']);
                exit;
            }

            $result = sendOtp($email);
            echo json_encode($result);
            exit;

        case 'verify':
            $email = $input['email'] ?? '';
            $otp = $input['otp'] ?? '';

            if (empty($email) || empty($otp)) {
                echo json_encode(['success' => false, 'message' => 'Email and OTP are required']);
                exit;
            }

            $result = verifyOtp($email, $otp);

            // If verification successful, update user status in database
            if ($result['success']) {
                try {
                    $dbPath = __DIR__ . '/../../../database/vitalnest_identity.db';
                    $db = new PDO('sqlite:' . $dbPath);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Update user as verified
                    $stmt = $db->prepare("UPDATE users SET email_verified = 1, email_verified_at = datetime('now'), status = 'active' WHERE email = ?");
                    $stmt->execute([$email]);

                    $result['user_verified'] = true;
                } catch (PDOException $e) {
                    error_log("Database Error: " . $e->getMessage());
                    // Don't fail the response, OTP was still verified
                }
            }

            echo json_encode($result);
            exit;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action. Use "send" or "verify"']);
            exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid request method. Use POST.']);

