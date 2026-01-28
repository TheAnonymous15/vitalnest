<?php

error_reporting(E_ALL);
ini_set('display_errors', getenv('APP_DEBUG') ?: '0');
date_default_timezone_set('UTC');

set_exception_handler(function (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => getenv('APP_DEBUG') ? $e->getMessage() : 'Internal server error']);
    exit;
});

