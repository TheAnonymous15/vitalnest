<?php

namespace IdentityService\Services;

use IdentityService\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private string $jwtSecret;
    private int $jwtExpiry = 3600; // 1 hour

    public function __construct()
    {
        $this->jwtSecret = getenv('JWT_SECRET') ?: 'vitalnest-secret-key-change-in-production';
    }

    public function register(array $data): array
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
        $user->setRole($data['role'] ?? 'client');
        $user->setStatus('active');

        if (!$user->save()) {
            throw new \Exception('Failed to create user');
        }

        return [
            'user' => $user->toArray(),
            'token' => $this->generateToken($user),
            'expires_in' => $this->jwtExpiry
        ];
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

        if ($user->getStatus() !== 'active') {
            throw new \Exception('Account is not active');
        }

        return [
            'user' => $user->toArray(),
            'token' => $this->generateToken($user),
            'expires_in' => $this->jwtExpiry
        ];
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
