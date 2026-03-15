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
        'user_id',
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
    public ?string $user_id;
    public ?string $email_verified_at;
    public ?string $last_login_at;
    public string $created_at;
    public string $updated_at;

    /**
     * Get database connection
     */
    private static function getDb(): \PDO
    {
        $config = require __DIR__ . '/../../config/service.php';
        $dbPath = $config['database']['path'];
        $pdo = new \PDO("sqlite:{$dbPath}");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * Find user by ID
     */
    public static function find(int $id): ?self
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return self::hydrate($data);
    }

    /**
     * Find user by email
     */
    public static function findByEmail(string $email): ?self
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return self::hydrate($data);
    }

    /**
     * Hydrate model from array
     */
    private static function hydrate(array $data): self
    {
        $user = new self();
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone = $data['phone'];
        $user->role = $data['role'];
        $user->status = $data['status'];
        $user->user_id = $data['user_id'] ?? null;
        $user->email_verified_at = $data['email_verified_at'];
        $user->last_login_at = $data['last_login_at'];
        $user->created_at = $data['created_at'];
        $user->updated_at = $data['updated_at'];
        return $user;
    }

    /**
     * Save user to database
     */
    public function save(): bool
    {
        $db = self::getDb();

        if (isset($this->id)) {
            // Update existing user
            $stmt = $db->prepare("
                UPDATE users SET 
                    email = ?, first_name = ?, last_name = ?, phone = ?, 
                    role = ?, status = ?, email_verified_at = ?, updated_at = datetime('now')
                WHERE id = ?
            ");
            return $stmt->execute([
                $this->email, $this->first_name, $this->last_name,
                $this->phone, $this->role, $this->status, $this->email_verified_at, $this->id
            ]);
        } else {
            // Generate UUID4 for new user if not set
            if (!isset($this->user_id)) {
                $this->user_id = $this->generateUUID4();
            }

            // Insert new user (email_verified_at is NULL for new users)
            $stmt = $db->prepare("
                INSERT INTO users (email, password, first_name, last_name, phone, role, status, user_id, email_verified_at, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL, datetime('now'), datetime('now'))
            ");
            $result = $stmt->execute([
                $this->email, $this->password, $this->first_name,
                $this->last_name, $this->phone, $this->role, $this->status, $this->user_id
            ]);

            if ($result) {
                $this->id = (int)$db->lastInsertId();
            }

            return $result;
        }
    }

    /**
     * Generate UUID v4
     */
    private function generateUUID4(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function getRole(): string { return $this->role; }
    public function getStatus(): string { return $this->status; }

    // Setters
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    public function setFirstName(string $firstName): void { $this->first_name = $firstName; }
    public function setLastName(string $lastName): void { $this->last_name = $lastName; }
    public function setPhone(?string $phone): void { $this->phone = $phone; }
    public function setRole(string $role): void { $this->role = $role; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function setEmailVerifiedAt(?string $datetime): void { $this->email_verified_at = $datetime; }

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
        return isset($this->email_verified_at) && $this->email_verified_at !== null;
    }

    /**
     * Convert to array (hiding sensitive data)
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'user_id' => $this->user_id ?? null,
            'email' => $this->email ?? null,
            'first_name' => $this->first_name ?? null,
            'last_name' => $this->last_name ?? null,
            'full_name' => $this->getFullName(),
            'phone' => $this->phone ?? null,
            'role' => $this->role ?? null,
            'status' => $this->status ?? null,
            'email_verified' => $this->hasVerifiedEmail(),
            'last_login_at' => $this->last_login_at ?? null,
            'created_at' => $this->created_at ?? null
        ];
    }
}

