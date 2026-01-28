<?php

define('SERVICE_START', microtime(true));

require_once __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/service.php';
$routes = require __DIR__ . '/../routes/api.php';

header('Content-Type: application/json');
header('X-Service: ' . $config['name']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

$response = null;

foreach ($routes as $route => $handler) {
    [$routeMethod, $routePath] = explode(' ', $route, 2);

    if ($method !== $routeMethod) continue;

    $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
    $pattern = '#^' . $pattern . '$#';

    if (preg_match($pattern, $uri, $matches)) {
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

        $controllerClass = $handler[0];
        $method = $handler[1];

        $controller = new $controllerClass();
        $response = !empty($params) ? $controller->$method(...array_values($params)) : $controller->$method();
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

