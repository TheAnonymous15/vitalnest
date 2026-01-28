<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS clinician_schedules (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                clinician_id BIGINT UNSIGNED NOT NULL,
                day_of_week TINYINT NOT NULL,
                start_time TIME NOT NULL,
                end_time TIME NOT NULL,
                slot_duration INT DEFAULT 30,
                is_available BOOLEAN DEFAULT TRUE,
                location VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_clinician (clinician_id),
                INDEX idx_day (day_of_week),
                FOREIGN KEY (clinician_id) REFERENCES clinicians(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS clinician_schedules;";
    }
};

