<?php
$dbPath = __DIR__ . '/vitalnest_subscriptions.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create packages table
    $db->exec("
        CREATE TABLE IF NOT EXISTS packages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            price DECIMAL(10,2) NOT NULL,
            billing_cycle VARCHAR(20) NOT NULL DEFAULT 'monthly',
            features TEXT,
            max_appointments INTEGER DEFAULT 0,
            max_family_members INTEGER DEFAULT 0,
            telemedicine_enabled INTEGER DEFAULT 0,
            priority_support INTEGER DEFAULT 0,
            lab_discount DECIMAL(5,2) DEFAULT 0,
            pharmacy_discount DECIMAL(5,2) DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            sort_order INTEGER DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Create subscriptions table
    $db->exec("
        CREATE TABLE IF NOT EXISTS subscriptions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            package_id INTEGER NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'active',
            start_date DATETIME NOT NULL,
            end_date DATETIME,
            next_billing_date DATETIME,
            auto_renew INTEGER DEFAULT 1,
            cancellation_date DATETIME,
            cancellation_reason TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (package_id) REFERENCES packages(id)
        )
    ");

    // Create billing_history table
    $db->exec("
        CREATE TABLE IF NOT EXISTS billing_history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            subscription_id INTEGER NOT NULL,
            user_id INTEGER NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'pending',
            payment_method VARCHAR(50),
            transaction_id VARCHAR(100),
            description TEXT,
            invoice_number VARCHAR(50),
            billing_date DATETIME NOT NULL,
            payment_date DATETIME,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (subscription_id) REFERENCES subscriptions(id)
        )
    ");

    // Create payment_methods table
    $db->exec("
        CREATE TABLE IF NOT EXISTS payment_methods (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            type VARCHAR(20) NOT NULL,
            card_last_four VARCHAR(4),
            card_brand VARCHAR(20),
            card_exp_month VARCHAR(2),
            card_exp_year VARCHAR(4),
            mobile_money_provider VARCHAR(50),
            mobile_money_number VARCHAR(20),
            is_default INTEGER DEFAULT 0,
            is_active INTEGER DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Create subscription_changes table (for tracking upgrades/downgrades)
    $db->exec("
        CREATE TABLE IF NOT EXISTS subscription_changes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            subscription_id INTEGER NOT NULL,
            user_id INTEGER NOT NULL,
            from_package_id INTEGER,
            to_package_id INTEGER NOT NULL,
            change_type VARCHAR(20) NOT NULL,
            effective_date DATETIME NOT NULL,
            prorated_amount DECIMAL(10,2),
            notes TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (subscription_id) REFERENCES subscriptions(id),
            FOREIGN KEY (from_package_id) REFERENCES packages(id),
            FOREIGN KEY (to_package_id) REFERENCES packages(id)
        )
    ");

    // Insert default packages
    $packages = [
        [
            'name' => 'Basic Care',
            'description' => 'Essential healthcare coverage for individuals',
            'price' => 29.99,
            'billing_cycle' => 'monthly',
            'features' => json_encode([
                'Up to 3 appointments per month',
                'Basic health screening',
                'Email support',
                'Access to medical records',
                'Prescription management'
            ]),
            'max_appointments' => 3,
            'max_family_members' => 0,
            'telemedicine_enabled' => 0,
            'priority_support' => 0,
            'lab_discount' => 0,
            'pharmacy_discount' => 5,
            'sort_order' => 1
        ],
        [
            'name' => 'Family Plus',
            'description' => 'Comprehensive care for the whole family',
            'price' => 79.99,
            'billing_cycle' => 'monthly',
            'features' => json_encode([
                'Up to 10 appointments per month',
                'Cover up to 5 family members',
                'Telemedicine consultations',
                'Comprehensive health screening',
                'Priority email & phone support',
                '10% pharmacy discount',
                'Access to wellness programs'
            ]),
            'max_appointments' => 10,
            'max_family_members' => 5,
            'telemedicine_enabled' => 1,
            'priority_support' => 1,
            'lab_discount' => 5,
            'pharmacy_discount' => 10,
            'sort_order' => 2
        ],
        [
            'name' => 'Premium Care',
            'description' => 'Premium healthcare with unlimited benefits',
            'price' => 149.99,
            'billing_cycle' => 'monthly',
            'features' => json_encode([
                'Unlimited appointments',
                'Cover up to 8 family members',
                'Unlimited telemedicine',
                'Annual comprehensive health screening',
                'Priority 24/7 support',
                '20% lab test discount',
                '15% pharmacy discount',
                'Home visit services',
                'Dedicated care coordinator',
                'Access to specialist network'
            ]),
            'max_appointments' => -1,
            'max_family_members' => 8,
            'telemedicine_enabled' => 1,
            'priority_support' => 1,
            'lab_discount' => 20,
            'pharmacy_discount' => 15,
            'sort_order' => 3
        ],
        [
            'name' => 'Enterprise',
            'description' => 'Custom solutions for organizations',
            'price' => 499.99,
            'billing_cycle' => 'monthly',
            'features' => json_encode([
                'Unlimited everything',
                'Custom family member limit',
                'Dedicated account manager',
                'On-site health screening',
                'Custom reporting',
                '25% lab discount',
                '20% pharmacy discount',
                'Wellness programs',
                'Mental health support',
                'Preventive care programs'
            ]),
            'max_appointments' => -1,
            'max_family_members' => -1,
            'telemedicine_enabled' => 1,
            'priority_support' => 1,
            'lab_discount' => 25,
            'pharmacy_discount' => 20,
            'sort_order' => 4
        ]
    ];

    $stmt = $db->prepare("
        INSERT INTO packages (name, description, price, billing_cycle, features, max_appointments,
                            max_family_members, telemedicine_enabled, priority_support,
                            lab_discount, pharmacy_discount, sort_order)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    foreach ($packages as $package) {
        $stmt->execute([
            $package['name'],
            $package['description'],
            $package['price'],
            $package['billing_cycle'],
            $package['features'],
            $package['max_appointments'],
            $package['max_family_members'],
            $package['telemedicine_enabled'],
            $package['priority_support'],
            $package['lab_discount'],
            $package['pharmacy_discount'],
            $package['sort_order']
        ]);
    }

    echo "✅ Subscription database initialized successfully!\n";
    echo "📦 Created 4 default packages\n";
    echo "💾 Database: vitalnest_subscriptions.db\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

