<?php

return [
    'name' => 'scheduling-service',
    'version' => '1.0.0',
    'description' => 'Appointment scheduling and calendar management service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_scheduling',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'appointments' => [
        'default_duration' => 30,
        'min_duration' => 15,
        'max_duration' => 120,
        'cancellation_window' => 24, // hours before appointment
        'reminder_times' => [24, 2], // hours before appointment
    ]
];

