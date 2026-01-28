<?php
/**
 * Identity Service - Role Model
 */

namespace IdentityService\Models;

class Role
{
    protected string $table = 'roles';

    protected array $fillable = [
        'name',
        'slug',
        'description',
        'permissions'
    ];

    public int $id;
    public string $name;
    public string $slug;
    public ?string $description;
    public array $permissions;
    public string $created_at;
    public string $updated_at;

    /**
     * Available roles
     */
    public const ADMIN = 'admin';
    public const CLINICIAN = 'clinician';
    public const LAB_TECH = 'lab_tech';
    public const CAREGIVER = 'caregiver';
    public const CLIENT = 'client';

    /**
     * Check if role has permission
     */
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions);
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'permissions' => $this->permissions,
            'created_at' => $this->created_at
        ];
    }
}

