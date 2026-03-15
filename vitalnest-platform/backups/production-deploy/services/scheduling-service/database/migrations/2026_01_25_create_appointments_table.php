<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS appointments (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                clinician_id BIGINT UNSIGNED NOT NULL,
                caregiver_id BIGINT UNSIGNED NULL,
                appointment_number VARCHAR(20) NOT NULL UNIQUE,
                type ENUM('home_visit', 'video_call', 'phone_call', 'in_clinic') NOT NULL,
                status ENUM('scheduled', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show') DEFAULT 'scheduled',
                scheduled_at DATETIME NOT NULL,
                duration INT DEFAULT 30,
                location VARCHAR(255) NULL,
                notes TEXT NULL,
                reason TEXT NULL,
                cancellation_reason TEXT NULL,
                confirmed_at TIMESTAMP NULL,
                started_at TIMESTAMP NULL,
                completed_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_clinician (clinician_id),
                INDEX idx_scheduled (scheduled_at),
                INDEX idx_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS appointments;";
    }
};

