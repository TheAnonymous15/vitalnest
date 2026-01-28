<?php
/**
 * Identity Service - User Model
 */

namespace IdentityService\Models;

class User
{
    protected string $table = 'users';

    protected array $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'role',
        'status',
        'email_verified_at',
        'last_login_at'
    ];

    protected array $hidden = [
        'password',
        'remember_token'
    ];

    public int $id;
    public string $email;
    public string $password;
    public string $first_name;
    public string $last_name;
    public ?string $phone;
    public string $role;
    public string $status;
    public ?string $email_verified_at;
    public ?string $last_login_at;
    public string $created_at;
    public string $updated_at;

    /**
     * Get full name
     */
    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if email is verified
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Convert to array (hiding sensitive data)
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->getFullName(),
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'email_verified' => $this->hasVerifiedEmail(),
            'last_login_at' => $this->last_login_at,
            'created_at' => $this->created_at
        ];
    }
}

