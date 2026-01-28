<?php
/**
 * Patient Service - Create Patients Table Migration
 */

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS patients (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                medical_record_number VARCHAR(20) NOT NULL UNIQUE,
                date_of_birth DATE NOT NULL,
                gender ENUM('male', 'female', 'other') NOT NULL,
                blood_type ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NULL,
                allergies JSON NULL,
                emergency_contact_name VARCHAR(100) NULL,
                emergency_contact_phone VARCHAR(20) NULL,
                insurance_provider VARCHAR(100) NULL,
                insurance_policy_number VARCHAR(50) NULL,
                primary_physician_id BIGINT UNSIGNED NULL,
                address VARCHAR(255) NULL,
                city VARCHAR(100) NULL,
                state VARCHAR(50) NULL,
                zip_code VARCHAR(20) NULL,
                notes TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_user_id (user_id),
                INDEX idx_mrn (medical_record_number),
                INDEX idx_physician (primary_physician_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS patients;";
    }
};

