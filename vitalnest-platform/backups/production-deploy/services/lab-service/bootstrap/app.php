<?php

error_reporting(E_ALL);
ini_set('display_errors', getenv('APP_DEBUG') ?: '0');
date_default_timezone_set('UTC');

if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) putenv(trim($line));
    }
}

set_exception_handler(function (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => getenv('APP_DEBUG') ? $e->getMessage() : 'Internal server error']);
    exit;
});

