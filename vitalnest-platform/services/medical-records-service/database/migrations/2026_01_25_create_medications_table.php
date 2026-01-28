<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS medications (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                prescribed_by BIGINT UNSIGNED NOT NULL,
                name VARCHAR(255) NOT NULL,
                dosage VARCHAR(100) NOT NULL,
                frequency VARCHAR(100) NOT NULL,
                route VARCHAR(50) NULL,
                instructions TEXT NULL,
                start_date DATE NOT NULL,
                end_date DATE NULL,
                status ENUM('active', 'completed', 'discontinued', 'on_hold') DEFAULT 'active',
                reason TEXT NULL,
                pharmacy VARCHAR(255) NULL,
                refills_remaining INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_status (status),
                INDEX idx_name (name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS medications;";
    }
};

