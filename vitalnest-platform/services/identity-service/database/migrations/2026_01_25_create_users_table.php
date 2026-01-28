<?php
/**
 * Identity Service - Create Users Table Migration
 */

return new class {
    /**
     * Run the migration
     */
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NULL,
                role ENUM('admin', 'clinician', 'lab_tech', 'caregiver', 'client') NOT NULL DEFAULT 'client',
                status ENUM('pending', 'active', 'inactive', 'suspended', 'deleted') NOT NULL DEFAULT 'pending',
                email_verified_at TIMESTAMP NULL,
                last_login_at TIMESTAMP NULL,
                remember_token VARCHAR(100) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_email (email),
                INDEX idx_role (role),
                INDEX idx_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        // Execute migration
        // $pdo->exec($sql);
    }

    /**
     * Reverse the migration
     */
    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS users;";
        // Execute migration
        // $pdo->exec($sql);
    }
};

