<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS recurring_appointments (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                clinician_id BIGINT UNSIGNED NOT NULL,
                type ENUM('home_visit', 'video_call', 'phone_call', 'in_clinic') NOT NULL,
                recurrence_pattern ENUM('daily', 'weekly', 'biweekly', 'monthly') NOT NULL,
                day_of_week TINYINT NULL,
                day_of_month TINYINT NULL,
                start_time TIME NOT NULL,
                duration INT DEFAULT 30,
                location VARCHAR(255) NULL,
                start_date DATE NOT NULL,
                end_date DATE NULL,
                is_active BOOLEAN DEFAULT TRUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_clinician (clinician_id),
                INDEX idx_active (is_active)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS recurring_appointments;";
    }
};

