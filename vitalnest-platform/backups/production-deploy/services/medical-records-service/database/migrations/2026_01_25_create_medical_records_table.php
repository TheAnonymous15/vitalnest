<?php

return new class {
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS medical_records (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                patient_id BIGINT UNSIGNED NOT NULL,
                clinician_id BIGINT UNSIGNED NOT NULL,
                appointment_id BIGINT UNSIGNED NULL,
                record_type ENUM('clinical_note', 'diagnosis', 'procedure', 'prescription', 'lab_result', 'imaging', 'referral', 'assessment') NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                data JSON NULL,
                icd_code VARCHAR(20) NULL,
                is_confidential BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                INDEX idx_patient (patient_id),
                INDEX idx_clinician (clinician_id),
                INDEX idx_type (record_type),
                INDEX idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS medical_records;";
    }
};

