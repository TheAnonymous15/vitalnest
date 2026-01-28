<?php
/**
 * Vitalnest Platform - API Gateway
 * Entry point for all API requests
 */

require_once __DIR__ . '/../../shared/auth/jwt.php';
require_once __DIR__ . '/middleware/auth.php';
require_once __DIR__ . '/routes/api.php';

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Route the request
$router = new Router();
$router->dispatch();

