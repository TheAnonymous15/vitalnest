<?php

define('SERVICE_START', microtime(true));
require_once __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/service.php';
$routes = require __DIR__ . '/../routes/api.php';

header('Content-Type: application/json');
header('X-Service: ' . $config['name']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$response = null;
foreach ($routes as $route => $handler) {
    [$routeMethod, $routePath] = explode(' ', $route, 2);
    if ($method !== $routeMethod) continue;

    $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath) . '$#';
    if (preg_match($pattern, $uri, $matches)) {
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        $controller = new $handler[0]();
        $response = !empty($params) ? $controller->{$handler[1]}(...array_values($params)) : $controller->{$handler[1]}();
        break;
    }
}

if ($response === null) {
    http_response_code(404);
    $response = ['success' => false, 'message' => 'Route not found'];
}

$response['_meta'] = ['service' => $config['name'], 'execution_time' => round((microtime(true) - SERVICE_START) * 1000, 2) . 'ms'];
echo json_encode($response, JSON_PRETTY_PRINT);

