<?php

namespace IdentityService\Services;

use IdentityService\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private string $jwtSecret;
    private int $jwtExpiry = 28800; // 8 hours

    public function __construct()
    {
        $this->jwtSecret = getenv('JWT_SECRET') ?: 'vitalnest-secret-key-change-in-production';
    }

    public function register(array $data, bool $autoVerify = false): array
    {
        // Check if user exists
        if (User::findByEmail($data['email'])) {
            throw new \Exception('Email already registered');
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setPhone($data['phone'] ?? null);
        $user->setRole($data['role'] ?? 'patient');
        $user->setStatus($autoVerify ? 'active' : 'pending'); // Set to pending for OTP verification

        if (!$user->save()) {
            throw new \Exception('Failed to create user');
        }

        $result = [
            'user' => $user->toArray(),
            'expires_in' => $this->jwtExpiry
        ];

        // Only generate token if auto-verified
        if ($autoVerify) {
            $result['token'] = $this->generateToken($user);
        }

        return $result;
    }

    public function login(string $email, string $password): ?array
    {
        $user = User::findByEmail($email);

        if ($user === null) {
            return null;
        }

        if (!$user->verifyPassword($password)) {
            return null;
        }

        // Return user info even if pending (to show verification screen)
        return [
            'user' => $user->toArray(),
            'token' => $user->getStatus() === 'active' ? $this->generateToken($user) : null,
            'expires_in' => $this->jwtExpiry
        ];
    }

    /**
     * Activate user after email verification
     */
    public function activateUser(string $email): bool
    {
        $user = User::findByEmail($email);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $user->setStatus('active');
        $user->setEmailVerifiedAt(date('Y-m-d H:i:s'));

        return $user->save();
    }

    /**
     * Get user by email
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::findByEmail($email);
    }

    /**
     * Generate token for a user
     */
    public function generateTokenForUser(User $user): string
    {
        return $this->generateToken($user);
    }

    public function generateToken(User $user): string
    {
        $payload = [
            'iss'   => 'vitalnest-identity-service',
            'sub'   => $user->getId(),
            'email' => $user->getEmail(),
            'role'  => $user->getRole(),
            'iat'   => time(),
            'exp'   => time() + $this->jwtExpiry
        ];

        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }

    public function validateToken(string $token): ?array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getCurrentUser(): ?User
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? null;

        if ($authHeader === null) {
            return null;
        }

        // Remove "Bearer " prefix
        $token = str_replace('Bearer ', '', $authHeader);

        $payload = $this->validateToken($token);

        if ($payload === null || !isset($payload['sub'])) {
            return null;
        }

        return User::find($payload['sub']);
    }
}
