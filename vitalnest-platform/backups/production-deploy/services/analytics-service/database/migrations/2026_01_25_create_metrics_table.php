<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS metrics (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                type ENUM('counter', 'gauge', 'histogram') NOT NULL,
                value DECIMAL(15,4) NOT NULL,
                dimensions JSON NULL,
                period VARCHAR(20) NOT NULL,
                recorded_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_name (name),
                INDEX idx_period (period),
                INDEX idx_recorded (recorded_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS metrics;";
    }
};

