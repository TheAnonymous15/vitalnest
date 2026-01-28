<?php

return [
    'name' => 'analytics-service',
    'version' => '1.0.0',
    'description' => 'Analytics and metrics service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_analytics',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'cache' => [
        'dashboard_ttl' => 300, // 5 minutes
        'metrics_ttl' => 60
    ],

    'periods' => ['24h', '7d', '30d', '90d', '12m']
];

