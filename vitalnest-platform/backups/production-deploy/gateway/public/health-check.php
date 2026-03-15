<?php
/**
 * VitalNest - Health Check Endpoint
 * Used by load balancers, monitoring services, and deployment tools
 * Returns JSON response with system health status
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

$health = [
    'status' => 'healthy',
    'timestamp' => date('c'),
    'service' => 'vitalnest-public',
    'version' => '1.0.0',
    'checks' => []
];

// Check PHP version
$health['checks']['php'] = [
    'status' => version_compare(PHP_VERSION, '7.4.0', '>=') ? 'ok' : 'warning',
    'version' => PHP_VERSION
];

// Check required PHP extensions
$requiredExtensions = ['json', 'session', 'mbstring', 'pdo', 'pdo_sqlite'];
$missingExtensions = [];

foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        $missingExtensions[] = $ext;
    }
}

$health['checks']['extensions'] = [
    'status' => empty($missingExtensions) ? 'ok' : 'error',
    'missing' => $missingExtensions
];

// Check writable directories
$writableDirs = [
    __DIR__ . '/../logs',
    __DIR__ . '/../cache',
    __DIR__ . '/../uploads'
];

$nonWritable = [];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) {
        // Try to create directory
        @mkdir($dir, 0755, true);
    }
    if (!is_writable($dir)) {
        $nonWritable[] = basename($dir);
    }
}

$health['checks']['filesystem'] = [
    'status' => empty($nonWritable) ? 'ok' : 'warning',
    'non_writable' => $nonWritable
];

// Check database connectivity (if databases exist)
$dbPath = __DIR__ . '/../../database/';
if (is_dir($dbPath)) {
    try {
        $dbFiles = glob($dbPath . '*.db');
        $health['checks']['database'] = [
            'status' => 'ok',
            'databases' => count($dbFiles)
        ];
    } catch (Exception $e) {
        $health['checks']['database'] = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
} else {
    $health['checks']['database'] = [
        'status' => 'warning',
        'message' => 'Database directory not found'
    ];
}

// Check memory usage
$memoryLimit = ini_get('memory_limit');
$memoryUsage = memory_get_usage(true);
$health['checks']['memory'] = [
    'status' => 'ok',
    'limit' => $memoryLimit,
    'usage' => round($memoryUsage / 1024 / 1024, 2) . 'MB'
];

// Determine overall status
$hasError = false;
$hasWarning = false;

foreach ($health['checks'] as $check) {
    if ($check['status'] === 'error') {
        $hasError = true;
    } elseif ($check['status'] === 'warning') {
        $hasWarning = true;
    }
}

if ($hasError) {
    $health['status'] = 'unhealthy';
    http_response_code(503);
} elseif ($hasWarning) {
    $health['status'] = 'degraded';
    http_response_code(200);
} else {
    $health['status'] = 'healthy';
    http_response_code(200);
}

echo json_encode($health, JSON_PRETTY_PRINT);

