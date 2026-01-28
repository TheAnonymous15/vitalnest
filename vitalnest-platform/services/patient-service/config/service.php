<?php

return [
    'name' => 'patient-service',
    'version' => '1.0.0',
    'description' => 'Patient management and vitals tracking service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: 3306,
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_patients',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ],

    'vitals' => [
        'alert_thresholds' => [
            'blood_pressure_systolic' => ['min' => 90, 'max' => 140],
            'blood_pressure_diastolic' => ['min' => 60, 'max' => 90],
            'heart_rate' => ['min' => 60, 'max' => 100],
            'temperature' => ['min' => 36.0, 'max' => 37.5],
            'oxygen_saturation' => ['min' => 95, 'max' => 100],
        ]
    ]
];

