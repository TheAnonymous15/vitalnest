<?php
/**
 * Identity Service - User Service
 * Business logic for user management
 */

namespace IdentityService\Services;

use IdentityService\Models\User;

class UserService
{
    /**
     * Get all users with pagination
     */
    public function getAll(int $page = 1, int $perPage = 15, ?string $role = null): array
    {
        $offset = ($page - 1) * $perPage;

        // DB query would go here
        // SELECT * FROM users WHERE role = ? LIMIT ? OFFSET ?

        return [
            'data' => [],
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => 0
            ]
        ];
    }

    /**
     * Find user by ID
     */
    public function findById(int $id): ?User
    {
        // DB query would go here
        return null;
    }

    /**
     * Update user
     */
    public function update(int $id, array $data): User
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new \Exception('User not found');
        }

        // Update fields
        $allowedFields = ['first_name', 'last_name', 'phone'];
        foreach ($allowedFields as $field) {
            if (isset($data[$field])) {
                $user->$field = $data[$field];
            }
        }

        $user->updated_at = date('Y-m-d H:i:s');

        // Save to DB

        return $user;
    }

    /**
     * Delete user
     */
    public function delete(int $id): bool
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new \Exception('User not found');
        }

        // Soft delete - set status to deleted
        $user->status = 'deleted';
        $user->updated_at = date('Y-m-d H:i:s');

        // Save to DB

        return true;
    }

    /**
     * Update user role
     */
    public function updateRole(int $id, string $role): User
    {
        $validRoles = ['admin', 'clinician', 'lab_tech', 'caregiver', 'client'];

        if (!in_array($role, $validRoles)) {
            throw new \InvalidArgumentException('Invalid role');
        }

        $user = $this->findById($id);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $user->role = $role;
        $user->updated_at = date('Y-m-d H:i:s');

        // Save to DB

        return $user;
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(int $id): User
    {
        $user = $this->findById($id);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->updated_at = date('Y-m-d H:i:s');

        // Save to DB

        return $user;
    }
}

