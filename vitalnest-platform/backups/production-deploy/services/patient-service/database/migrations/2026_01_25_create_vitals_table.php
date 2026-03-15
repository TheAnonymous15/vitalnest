<?php
/**
 * Patient Service - Create Vitals Table Migration
 */

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS patient_vitals (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                recorded_by BIGINT UNSIGNED NOT NULL,
                blood_pressure_systolic INT NULL,
                blood_pressure_diastolic INT NULL,
                heart_rate INT NULL,
                temperature DECIMAL(4,1) NULL,
                respiratory_rate INT NULL,
                oxygen_saturation INT NULL,
                weight DECIMAL(5,2) NULL,
                height DECIMAL(5,2) NULL,
                bmi DECIMAL(4,1) NULL,
                blood_glucose DECIMAL(5,1) NULL,
                notes TEXT NULL,
                recorded_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_recorded_at (recorded_at),
                FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS patient_vitals;";
    }
};

