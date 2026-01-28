<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS dashboard_snapshots (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                snapshot_type VARCHAR(50) NOT NULL,
                data JSON NOT NULL,
                period VARCHAR(20) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_type (snapshot_type),
                INDEX idx_period (period)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS dashboard_snapshots;";
    }
};

