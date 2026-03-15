<?php

return [
    'name' => 'notification-service',
    'version' => '1.0.0',
    'description' => 'Multi-channel notification service',

    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'database' => getenv('DB_DATABASE') ?: 'vitalnest_notifications',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],

    'channels' => [
        'email' => [
            'driver' => 'smtp',
            'host' => getenv('MAIL_HOST') ?: 'smtp.mailtrap.io',
            'port' => getenv('MAIL_PORT') ?: 587,
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD'),
            'from_address' => getenv('MAIL_FROM_ADDRESS') ?: 'noreply@vitalnest.com',
            'from_name' => getenv('MAIL_FROM_NAME') ?: 'Vitalnest'
        ],
        'sms' => [
            'driver' => 'twilio',
            'sid' => getenv('TWILIO_SID'),
            'token' => getenv('TWILIO_TOKEN'),
            'from' => getenv('TWILIO_FROM')
        ],
        'push' => [
            'driver' => 'firebase',
            'credentials' => getenv('FIREBASE_CREDENTIALS')
        ]
    ],

    'queue' => [
        'driver' => 'redis',
        'connection' => 'default'
    ]
];

