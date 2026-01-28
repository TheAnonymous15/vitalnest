<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS lab_orders (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                ordered_by BIGINT UNSIGNED NOT NULL,
                assigned_to BIGINT UNSIGNED NULL,
                order_number VARCHAR(20) NOT NULL UNIQUE,
                test_type VARCHAR(100) NOT NULL,
                priority ENUM('routine', 'urgent', 'stat') NOT NULL DEFAULT 'routine',
                status ENUM('pending', 'specimen_collected', 'in_progress', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
                clinical_notes TEXT NULL,
                specimen_type VARCHAR(50) NULL,
                specimen_collected_at TIMESTAMP NULL,
                scheduled_at TIMESTAMP NULL,
                completed_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_status (status),
                INDEX idx_priority (priority),
                INDEX idx_order_number (order_number)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS lab_orders;";
    }
};

