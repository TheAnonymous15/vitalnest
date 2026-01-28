<?php
}
    }
        return $validated;
        }
            $validated[$field] = $data[$field] ?? null;
            }
                throw new \InvalidArgumentException("Field {$field} is required");
            if (strpos($rule, 'required') !== false && empty($data[$field])) {
        foreach ($rules as $field => $rule) {
        $validated = [];
        // Basic validation implementation
    {
    private function validate(array $data, array $rules): array
     */
     * Validate request data
    /**

    }
        ];
            'data' => $user
            'success' => true,
        return [

        $user = $this->authService->getCurrentUser();
    {
    public function profile(): array
     */
     * Get current user profile
    /**

    }
        ];
            'data' => ['token' => $token]
            'success' => true,
        return [

        $token = $this->authService->refreshToken();
    {
    public function refreshToken(): array
     */
     * Refresh token
    /**

    }
        ];
            'message' => 'Logged out successfully'
            'success' => true,
        return [

        $this->authService->logout();
    {
    public function logout(): array
     */
     * Logout user
    /**

    }
        ];
            'data' => $result
            'success' => true,
        return [

        }
            ];
                'message' => 'Invalid credentials'
                'success' => false,
            return [
            http_response_code(401);
        if (!$result) {

        $result = $this->authService->login($validated['email'], $validated['password']);

        ]);
            'password' => 'required'
            'email' => 'required|email',
        $validated = $this->validate($data, [

        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function login(): array
     */
     * Login user
    /**

    }
        ];
            'data' => $user
            'message' => 'User registered successfully',
            'success' => true,
        return [

        $user = $this->authService->register($validated);

        ]);
            'role' => 'required|in:admin,clinician,lab_tech,caregiver,client'
            'last_name' => 'required',
            'first_name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email',
        $validated = $this->validate($data, [

        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function register(): array
     */
     * Register a new user
    /**

    }
        $this->authService = new AuthService();
    {
    public function __construct()

    private AuthService $authService;
{
class AuthController

use IdentityService\Models\User;
use IdentityService\Services\AuthService;

namespace IdentityService\Controllers;

 */
 * Handles authentication and authorization
 * Identity Service - Auth Controller
/**

