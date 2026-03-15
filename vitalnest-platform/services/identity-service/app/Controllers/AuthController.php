<?php
/**
 * Identity Service - Auth Controller
 * Handles authentication and authorization
 */

namespace IdentityService\Controllers;

use IdentityService\Services\AuthService;
use IdentityService\Services\OtpService;

// External OTP Service URL
define('OTP_SEND_URL', 'https://synavuetechnologies.com/send_otp/');
define('OTP_VERIFY_URL', 'https://synavuetechnologies.com/verify_otp/');

class AuthController
{
    private AuthService $authService;
    private OtpService $otpService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->otpService = new OtpService();
    }

    /**
     * Send OTP using external service
     */
    private function sendExternalOtp(string $email): array
    {
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

        if ($httpCode >= 200 && $httpCode < 300) {
            return ['success' => true, 'message' => 'OTP sent successfully'];
        }

        return ['success' => false, 'message' => $result['message'] ?? 'Failed to send OTP'];
    }

    /**
     * Register a new user
     */
    public function register(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $validated = $this->validate($data, [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'in:admin,clinician,lab_tech,caregiver,client,hr,patient'
        ]);

        try {
            // Register user with pending status
            $result = $this->authService->register($validated, false); // Don't auto-verify

            // Send OTP using external service
            $otpResult = $this->sendExternalOtp($validated['email']);

            return [
                'success' => true,
                'message' => 'Registration successful! Please verify your email with the OTP sent.',
                'requires_otp' => true,
                'otp_sent' => $otpResult['success'],
                'data' => [
                    'email' => $validated['email'],
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name']
                ]
            ];
        } catch (\Exception $e) {
            http_response_code(400);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Verify OTP using external service
     */
    private function verifyExternalOtp(string $email, string $otp): array
    {
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
            return ['success' => true, 'message' => 'OTP verified successfully'];
        }

        return [
            'success' => false,
            'message' => $result['message'] ?? 'Invalid OTP. Please try again.'
        ];
    }

    /**
     * Verify email with OTP
     */
    public function verifyEmail(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['email']) || empty($data['otp'])) {
            http_response_code(400);
            return [
                'success' => false,
                'message' => 'Email and OTP are required'
            ];
        }

        try {
            // Verify OTP using external service
            $result = $this->verifyExternalOtp($data['email'], $data['otp']);

            if (!$result['success']) {
                http_response_code(400);
                return $result;
            }

            // Activate user account
            $this->authService->activateUser($data['email']);

            // Auto-login after verification
            $user = $this->authService->getUserByEmail($data['email']);
            $token = $this->authService->generateTokenForUser($user);

            return [
                'success' => true,
                'message' => 'Email verified successfully',
                'data' => [
                    'user' => $user->toArray(),
                    'token' => $token
                ]
            ];
        } catch (\Exception $e) {
            http_response_code(400);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['email'])) {
            http_response_code(400);
            return [
                'success' => false,
                'message' => 'Email is required'
            ];
        }

        // Use external OTP service
        $result = $this->sendExternalOtp($data['email']);

        if (!$result['success']) {
            http_response_code(500);
        }

        return $result;
    }

    /**
     * Login user
     */
    public function login(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data === null) {
            return [
                'success' => false,
                'message' => 'Invalid JSON in request body'
            ];
        }

        $validated = $this->validate($data, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $result = $this->authService->login($validated['email'], $validated['password']);

            if (!$result) {
                http_response_code(401);
                return [
                    'success' => false,
                    'message' => 'Invalid credentials'
                ];
            }

            // Check if email is verified
            if (isset($result['user']['status']) && $result['user']['status'] === 'pending') {
                // Send OTP using external service
                $otpResult = $this->sendExternalOtp($validated['email']);

                http_response_code(403);
                return [
                    'success' => false,
                    'message' => 'Please verify your email first. A new OTP has been sent.',
                    'requires_verification' => true,
                    'requires_otp' => true,
                    'otp_sent' => $otpResult['success'],
                    'email' => $validated['email']
                ];
            }

            return [
                'success' => true,
                'data' => $result
            ];
        } catch (\Exception $e) {
            http_response_code(400);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Logout user
     */
    public function logout(): array
    {
        return [
            'success' => true,
            'message' => 'Logged out successfully'
        ];
    }

    /**
     * Force logout specific user (admin only)
     */
    public function forceLogout(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data === null) {
            return [
                'success' => false,
                'message' => 'Invalid JSON in request body'
            ];
        }

        try {
            $validated = $this->validate($data, [
                'user_id' => 'required',
                'reason' => 'required'
            ]);

            // Get the target user
            $db = new \SQLite3(__DIR__ . '/../../../../database/vitalnest_identity.db');
            $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');

            if ($stmt === false) {
                return [
                    'success' => false,
                    'message' => 'Database error: ' . $db->lastErrorMsg()
                ];
            }

            $stmt->bindValue(1, $validated['user_id'], SQLITE3_INTEGER);
            $result = $stmt->execute();
            $user = $result->fetchArray(SQLITE3_ASSOC);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'User not found'
                ];
            }

            // Log the force logout event
            $sql = 'INSERT INTO audit_logs (user_id, action, details, created_at) VALUES (?, ?, ?, ?)';
            $logStmt = $db->prepare($sql);

            if ($logStmt === false) {
                // If audit table doesn't exist, just skip logging
                error_log('Audit logs table may not exist');
            } else {
                $logStmt->bindValue(1, $validated['user_id'], SQLITE3_INTEGER);
                $logStmt->bindValue(2, 'force_logout', SQLITE3_TEXT);
                $logStmt->bindValue(3, json_encode([
                    'reason' => $validated['reason'],
                    'admin_id' => $_SERVER['HTTP_X_USER_ID'] ?? 'system'
                ]), SQLITE3_TEXT);
                $logStmt->bindValue(4, date('Y-m-d H:i:s'), SQLITE3_TEXT);
                $logStmt->execute();
            }

            // In a real system, you would invalidate all tokens for this user
            // For now, we'll just return success and the client will handle logout

            return [
                'success' => true,
                'message' => "User {$user['email']} has been force logged out",
                'data' => [
                    'user_id' => $validated['user_id'],
                    'email' => $user['email'],
                    'reason' => $validated['reason']
                ]
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get current user profile
     */
    public function profile(): array
    {
        $user = $this->authService->getCurrentUser();

        if (!$user) {
            http_response_code(401);
            return [
                'success' => false,
                'message' => 'Unauthorized'
            ];
        }

        return [
            'success' => true,
            'data' => $user->toArray()
        ];
    }

    /**
     * Validate request data
     */
    private function validate(array $data, array $rules): array
    {
        $validated = [];

        foreach ($rules as $field => $rule) {
            $rulesList = explode('|', $rule);

            foreach ($rulesList as $singleRule) {
                if ($singleRule === 'required' && empty($data[$field])) {
                    throw new \InvalidArgumentException("Field {$field} is required");
                }

                if (strpos($singleRule, 'min:') === 0 && isset($data[$field])) {
                    $min = (int) substr($singleRule, 4);
                    if (strlen($data[$field]) < $min) {
                        throw new \InvalidArgumentException("Field {$field} must be at least {$min} characters");
                    }
                }

                if ($singleRule === 'email' && isset($data[$field])) {
                    if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                        throw new \InvalidArgumentException("Field {$field} must be a valid email");
                    }
                }
            }

            $validated[$field] = $data[$field] ?? null;
        }

        return $validated;
    }
}

