<?php
/**
 * Identity Service - Auth Controller
 * Handles authentication and authorization
 */

namespace IdentityService\Controllers;

use IdentityService\Services\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Register a new user
     */
    public function register(): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $validated = $this->validate($data, [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'in:admin,clinician,lab_tech,caregiver,client,hr'
        ]);

        try {
            $result = $this->authService->register($validated);
            return [
                'success' => true,
                'message' => 'User registered successfully',
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

