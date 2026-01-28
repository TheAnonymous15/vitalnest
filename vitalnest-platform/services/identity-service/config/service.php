<?php
/**
 * Identity Service - Configuration
 */

return [
    'name' => 'identity-service',
    'version' => '1.0.0',
    'description' => 'Authentication and user management service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: 3306,
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_identity',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ],

    'jwt' => [
        'secret' => getenv('JWT_SECRET') ?: 'your-secret-key',
        'algorithm' => 'HS256',
        'expiry' => 3600, // 1 hour
        'refresh_expiry' => 86400 * 7, // 7 days
    ],

    'password' => [
        'min_length' => 8,
        'require_uppercase' => true,
        'require_lowercase' => true,
        'require_number' => true,
        'require_special' => false,
    ],

    'rate_limiting' => [
        'login_attempts' => 5,
        'lockout_duration' => 900, // 15 minutes
    ],

    'events' => [
        'user.registered' => [
            'queue' => 'identity-events',
            'handlers' => [
                'SendWelcomeEmail',
                'CreateAuditLog',
            ]
        ],
        'user.logged_in' => [
            'queue' => 'identity-events',
            'handlers' => [
                'UpdateLoginStats',
                'CheckSuspiciousActivity',
            ]
        ]
    ]
];

