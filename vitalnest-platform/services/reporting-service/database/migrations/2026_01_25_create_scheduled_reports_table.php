<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS scheduled_reports (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                report_type VARCHAR(50) NOT NULL,
                parameters JSON NOT NULL,
                schedule VARCHAR(50) NOT NULL,
                recipients JSON NULL,
                format VARCHAR(10) DEFAULT 'pdf',
                is_active BOOLEAN DEFAULT TRUE,
                last_run_at TIMESTAMP NULL,
                next_run_at TIMESTAMP NULL,
                created_by BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_active (is_active),
                INDEX idx_next_run (next_run_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS scheduled_reports;";
    }
};

