<?php

return [
    'name' => 'clinician-service',
    'version' => '1.0.0',
    'description' => 'Clinician management and scheduling service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_clinicians',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'scheduling' => [
        'default_slot_duration' => 30,
        'buffer_between_appointments' => 5,
        'max_daily_appointments' => 20
    ]
];

