<?php
/**
 * Packages Service - Entry Point
 */

define('SERVICE_START', microtime(true));

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'PackagesService\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Load configuration
$config = require __DIR__ . '/../config/service.php';

// Load routes
$routes = require __DIR__ . '/../routes/api.php';

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Max-Age: 86400');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');
header('X-Service: ' . $config['name']);
header('X-Service-Version: ' . $config['version']);

// Get request info
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Router
$response = null;

foreach ($routes as $route => $handler) {
    [$routeMethod, $routePath] = explode(' ', $route, 2);

    if ($method !== $routeMethod) continue;

    // Convert route parameters to regex
    $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
    $pattern = '#^' . $pattern . '$#';

    if (preg_match($pattern, $uri, $matches)) {
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

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
    $response = ['success' => false, 'message' => 'Route not found'];
}

$response['_meta'] = [
    'service' => $config['name'],
    'execution_time' => round((microtime(true) - SERVICE_START) * 1000, 2) . 'ms'
];

echo json_encode($response, JSON_PRETTY_PRINT);

