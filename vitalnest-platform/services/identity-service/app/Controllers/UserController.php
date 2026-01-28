<?php
/**
 * Identity Service - User Controller
 * Handles user management operations
 */

namespace IdentityService\Controllers;

use IdentityService\Services\UserService;
use IdentityService\Models\User;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * List all users with pagination
     */
    public function index(): array
    {
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['per_page'] ?? 15;
        $role = $_GET['role'] ?? null;

        $users = $this->userService->getAll($page, $perPage, $role);

        return [
            'success' => true,
            'data' => $users
        ];
    }

    /**
     * Get single user
     */
    public function show(int $id): array
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            http_response_code(404);
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        return [
            'success' => true,
            'data' => $user
        ];
    }

    /**
     * Update user
     */
    public function update(int $id): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $user = $this->userService->update($id, $data);

        return [
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ];
    }

    /**
     * Delete user
     */
    public function destroy(int $id): array
    {
        $this->userService->delete($id);

        return [
            'success' => true,
            'message' => 'User deleted successfully'
        ];
    }

    /**
     * Update user role
     */
    public function updateRole(int $id): array
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $user = $this->userService->updateRole($id, $data['role']);

        return [
            'success' => true,
            'message' => 'User role updated successfully',
            'data' => $user
        ];
    }

    /**
     * Activate/Deactivate user
     */
    public function toggleStatus(int $id): array
    {
        $user = $this->userService->toggleStatus($id);

        return [
            'success' => true,
            'message' => 'User status updated successfully',
            'data' => $user
        ];
    }
}

