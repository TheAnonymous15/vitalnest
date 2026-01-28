<?php
/**
 * Identity Service - Create Roles Table Migration
 */

return new class {
    /**
     * Run the migration
     */
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS roles (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                slug VARCHAR(50) NOT NULL UNIQUE,
                description TEXT NULL,
                permissions JSON NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_slug (slug)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        // Execute migration
        // $pdo->exec($sql);

        // Seed default roles
        $this->seedRoles();
    }

    /**
     * Seed default roles
     */
    private function seedRoles(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access',
                'permissions' => json_encode(['*'])
            ],
            [
                'name' => 'Clinician',
                'slug' => 'clinician',
                'description' => 'Medical professional with patient access',
                'permissions' => json_encode([
                    'patients.view', 'patients.create', 'patients.update',
                    'appointments.view', 'appointments.create', 'appointments.update',
                    'medical_records.view', 'medical_records.create',
                    'lab_orders.view', 'lab_orders.create'
                ])
            ],
            [
                'name' => 'Lab Technician',
                'slug' => 'lab_tech',
                'description' => 'Laboratory staff',
                'permissions' => json_encode([
                    'lab_orders.view', 'lab_orders.update',
                    'lab_results.view', 'lab_results.create', 'lab_results.update'
                ])
            ],
            [
                'name' => 'Caregiver',
                'slug' => 'caregiver',
                'description' => 'Patient caregiver with limited access',
                'permissions' => json_encode([
                    'patients.view',
                    'appointments.view',
                    'medical_records.view'
                ])
            ],
            [
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Patient/Client',
                'permissions' => json_encode([
                    'profile.view', 'profile.update',
                    'appointments.view', 'appointments.create',
                    'medical_records.view'
                ])
            ]
        ];

        // Insert roles
        // foreach ($roles as $role) {
        //     $pdo->prepare("INSERT INTO roles ...)->execute($role);
        // }
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS roles;";
        // Execute migration
        // $pdo->exec($sql);
    }
};

