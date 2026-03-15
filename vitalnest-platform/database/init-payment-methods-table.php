<?php
$dbPath = __DIR__ . '/vitalnest_subscriptions.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Creating payment_methods table...\n";

    $db->exec("
        CREATE TABLE IF NOT EXISTS payment_methods (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            type TEXT NOT NULL,
            is_default INTEGER DEFAULT 0,
            card_brand TEXT,
            card_last_four TEXT,
            card_exp_month TEXT,
            card_exp_year TEXT,
            mobile_money_provider TEXT,
            mobile_money_number TEXT,
            status TEXT DEFAULT 'active',
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            updated_at TEXT DEFAULT CURRENT_TIMESTAMP
        );
    ");

    echo "✅ payment_methods table created successfully!\n\n";

    // Create indexes
    $db->exec("CREATE INDEX IF NOT EXISTS idx_payment_user_id ON payment_methods(user_id);");
    $db->exec("CREATE INDEX IF NOT EXISTS idx_payment_is_default ON payment_methods(is_default);");

    echo "✅ Indexes created successfully!\n\n";

    echo "📊 Table Schema:\n";
    echo "================\n";
    echo "✓ id - Primary key\n";
    echo "✓ user_id - User identifier\n";
    echo "✓ type - 'card' or 'mobile_money'\n";
    echo "✓ is_default - 1 for default, 0 otherwise\n";
    echo "✓ card_brand - Visa, Mastercard, Amex, etc.\n";
    echo "✓ card_last_four - Last 4 digits\n";
    echo "✓ card_exp_month - MM\n";
    echo "✓ card_exp_year - YYYY\n";
    echo "✓ mobile_money_provider - M-Pesa, Airtel, etc.\n";
    echo "✓ mobile_money_number - Phone number\n";
    echo "✓ status - active/inactive\n";
    echo "✓ created_at - Timestamp\n";
    echo "✓ updated_at - Timestamp\n\n";

    echo "🎉 Payment methods table setup complete!\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

