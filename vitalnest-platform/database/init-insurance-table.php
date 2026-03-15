g<?php
$dbPath = __DIR__ . '/vitalnest_patients.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Creating insurance_covers table...\n";

    $db->exec("
        CREATE TABLE IF NOT EXISTS insurance_covers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            provider_name TEXT NOT NULL,
            policy_number TEXT NOT NULL,
            policy_type TEXT NOT NULL,
            coverage_amount REAL DEFAULT 0,
            start_date TEXT NOT NULL,
            end_date TEXT NOT NULL,
            status TEXT DEFAULT 'active',
            primary_holder_name TEXT NOT NULL,
            primary_holder_relationship TEXT DEFAULT 'self',
            contact_phone TEXT,
            contact_email TEXT,
            coverage_details TEXT,
            exclusions TEXT,
            claim_procedure TEXT,
            emergency_contact TEXT,
            group_number TEXT,
            network_type TEXT,
            copay_amount REAL DEFAULT 0,
            deductible_amount REAL DEFAULT 0,
            out_of_pocket_max REAL DEFAULT 0,
            prescription_coverage INTEGER DEFAULT 1,
            dental_coverage INTEGER DEFAULT 0,
            vision_coverage INTEGER DEFAULT 0,
            mental_health_coverage INTEGER DEFAULT 1,
            maternity_coverage INTEGER DEFAULT 0,
            documents_path TEXT,
            notes TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        );
    ");

    echo "✅ insurance_covers table created successfully!\n\n";

    // Create indexes for better query performance
    $db->exec("CREATE INDEX IF NOT EXISTS idx_insurance_user_id ON insurance_covers(user_id);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_insurance_status ON insurance_covers(status);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_insurance_policy_number ON insurance_covers(policy_number);");

    echo "✅ Indexes created successfully!\n\n";

    // Create claims table for tracking insurance claims
    echo "Creating insurance_claims table...\n";

    $db->exec("
        CREATE TABLE IF NOT EXISTS insurance_claims (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            insurance_id INTEGER NOT NULL,
            user_id INTEGER NOT NULL,
            claim_number TEXT NOT NULL,
            claim_date TEXT NOT NULL,
            service_date TEXT NOT NULL,
            claim_type TEXT NOT NULL,
            provider_name TEXT NOT NULL,
            diagnosis_code TEXT,
            procedure_code TEXT,
            billed_amount REAL NOT NULL,
            approved_amount REAL DEFAULT 0,
            paid_amount REAL DEFAULT 0,
            patient_responsibility REAL DEFAULT 0,
            claim_status TEXT DEFAULT 'pending',
            submission_date TEXT,
            processing_date TEXT,
            payment_date TEXT,
            denial_reason TEXT,
            appeal_status TEXT,
            documents_path TEXT,
            notes TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (insurance_id) REFERENCES insurance_covers(id) ON DELETE CASCADE
        );
    ");

    echo "✅ insurance_claims table created successfully!\n\n";

    // Create indexes for claims
    $db->exec("CREATE INDEX IF NOT EXISTS idx_claims_insurance_id ON insurance_claims(insurance_id);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_claims_user_id ON insurance_claims(user_id);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_claims_status ON insurance_claims(claim_status);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_claims_number ON insurance_claims(claim_number);");

    echo "✅ Claims indexes created successfully!\n\n";

    echo "📊 Database Schema:\n";
    echo "==================\n";
    echo "✓ insurance_covers - Main insurance policy information\n";
    echo "✓ insurance_claims - Claims tracking and management\n";
    echo "\n";

    echo "🎉 Insurance management system database setup complete!\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

