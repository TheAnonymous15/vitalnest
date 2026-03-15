<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS lab_results (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                lab_order_id BIGINT UNSIGNED NOT NULL,
                performed_by BIGINT UNSIGNED NOT NULL,
                verified_by BIGINT UNSIGNED NULL,
                test_name VARCHAR(100) NOT NULL,
                result_value VARCHAR(255) NOT NULL,
                unit VARCHAR(50) NULL,
                reference_range VARCHAR(100) NULL,
                status ENUM('preliminary', 'final', 'corrected') NOT NULL DEFAULT 'preliminary',
                is_abnormal BOOLEAN DEFAULT FALSE,
                interpretation TEXT NULL,
                notes TEXT NULL,
                verified_at TIMESTAMP NULL,
                performed_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_order (lab_order_id),
                INDEX idx_status (status),
                INDEX idx_abnormal (is_abnormal),
                FOREIGN KEY (lab_order_id) REFERENCES lab_orders(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS lab_results;";
    }
};

