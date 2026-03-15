<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS notifications (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                type VARCHAR(50) NOT NULL,
                channel ENUM('email', 'sms', 'push', 'in_app') NOT NULL DEFAULT 'in_app',
                title VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                data JSON NULL,
                action_url VARCHAR(255) NULL,
                status ENUM('pending', 'sent', 'delivered', 'failed') DEFAULT 'pending',
                read_at TIMESTAMP NULL,
                sent_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                INDEX idx_user (user_id),
                INDEX idx_type (type),
                INDEX idx_status (status),
                INDEX idx_read (read_at),
                INDEX idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS notifications;";
    }
};

