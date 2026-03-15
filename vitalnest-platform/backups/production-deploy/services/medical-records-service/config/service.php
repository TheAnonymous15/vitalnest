<?php

return [
    'name' => 'medical-records-service',
    'version' => '1.0.0',
    'description' => 'Medical records and clinical documentation service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_records',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'record_types' => [
        'clinical_note', 'diagnosis', 'procedure', 'prescription',
        'lab_result', 'imaging', 'referral', 'assessment'
    ]
];

