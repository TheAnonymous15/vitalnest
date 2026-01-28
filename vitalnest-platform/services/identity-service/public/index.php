<?php
/**
 * Identity Service - Entry Point
 */

define('SERVICE_START', microtime(true));

// Autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load configuration
$config = require __DIR__ . '/../config/service.php';

// Load routes
$routes = require __DIR__ . '/../routes/api.php';

// Set headers
header('Content-Type: application/json');
header('X-Service: ' . $config['name']);
header('X-Service-Version: ' . $config['version']);

// Get request info
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Simple router
$response = null;

foreach ($routes as $route => $handler) {
    [$routeMethod, $routePath] = explode(' ', $route, 2);

    if ($method !== $routeMethod) {
        continue;
    }

    // Convert route parameters to regex
    $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
    $pattern = '#^' . $pattern . '$#';

    if (preg_match($pattern, $uri, $matches)) {
        // Extract route parameters
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

        // Check middleware
        if (isset($handler[2])) {
            $middleware = $handler[2];
            // Auth middleware check would go here
        }

        // Instantiate controller and call method
        $controllerClass = $handler[0];
        $method = $handler[1];

        $controller = new $controllerClass();

        if (!empty($params)) {
            $response = $controller->$method(...array_values($params));
        } else {
            $response = $controller->$method();
        }

        break;
    }
}

if ($response === null) {
    http_response_code(404);
    $response = [
        'success' => false,
        'message' => 'Route not found'
    ];
}

// Add execution time
$response['_meta'] = [
    'service' => $config['name'],
    'execution_time' => round((microtime(true) - SERVICE_START) * 1000, 2) . 'ms'
];

echo json_encode($response, JSON_PRETTY_PRINT);

