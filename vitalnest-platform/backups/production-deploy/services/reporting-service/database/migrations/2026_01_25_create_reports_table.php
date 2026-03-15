<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS reports (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                report_number VARCHAR(20) NOT NULL UNIQUE,
                title VARCHAR(255) NOT NULL,
                type VARCHAR(50) NOT NULL,
                description TEXT NULL,
                parameters JSON NOT NULL,
                data JSON NULL,
                status ENUM('pending', 'generating', 'completed', 'failed') DEFAULT 'pending',
                file_path VARCHAR(255) NULL,
                file_format VARCHAR(10) NULL,
                generated_by BIGINT UNSIGNED NOT NULL,
                generated_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_type (type),
                INDEX idx_status (status),
                INDEX idx_generated_by (generated_by)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS reports;";
    }
};

