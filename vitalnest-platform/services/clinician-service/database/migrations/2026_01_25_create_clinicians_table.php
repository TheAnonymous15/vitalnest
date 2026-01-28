<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS clinicians (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL UNIQUE,
                license_number VARCHAR(50) NOT NULL UNIQUE,
                specialty VARCHAR(50) NOT NULL,
                sub_specialty VARCHAR(50) NULL,
                title VARCHAR(20) DEFAULT 'Dr.',
                bio TEXT NULL,
                years_experience INT UNSIGNED NULL,
                certifications JSON NULL,
                languages JSON NULL,
                accepting_patients BOOLEAN DEFAULT TRUE,
                consultation_fee DECIMAL(10,2) NULL,
                status ENUM('pending_verification', 'active', 'inactive', 'suspended') DEFAULT 'pending_verification',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_specialty (specialty),
                INDEX idx_status (status),
                INDEX idx_accepting (accepting_patients)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS clinicians;";
    }
};

