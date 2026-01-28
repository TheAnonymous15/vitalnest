<?php

return [
    'name' => 'lab-service',
    'version' => '1.0.0',
    'description' => 'Laboratory orders and results management service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: 3306,
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_lab',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'charset' => 'utf8mb4',
    ],

    'test_types' => [
        'blood_panel' => 'Complete Blood Count (CBC)',
        'metabolic_panel' => 'Comprehensive Metabolic Panel',
        'lipid_panel' => 'Lipid Panel',
        'thyroid_panel' => 'Thyroid Panel',
        'urinalysis' => 'Urinalysis',
        'hba1c' => 'Hemoglobin A1C',
        'vitamin_d' => 'Vitamin D Level',
        'iron_panel' => 'Iron Studies',
    ]
];

