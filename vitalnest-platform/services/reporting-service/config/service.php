<?php

return [
    'name' => 'reporting-service',
    'version' => '1.0.0',
    'description' => 'Report generation and scheduling service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_reports',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'storage' => [
        'driver' => 'local',
        'path' => __DIR__ . '/../storage/reports'
    ],

    'formats' => ['pdf', 'csv', 'xlsx', 'html']
];

