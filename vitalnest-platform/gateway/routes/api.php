<?php
/**
 * Vitalnest Platform - API Gateway Router
 */

class Router
{
    private array $routes = [];
    private array $serviceMap = [
        'auth' => 'identity-service',
        'users' => 'identity-service',
        'patients' => 'patient-service',
        'clinicians' => 'clinician-service',
        'appointments' => 'scheduling-service',
        'lab-orders' => 'lab-service',
        'records' => 'medical-records-service',
        'analytics' => 'analytics-service',
        'reports' => 'reporting-service',
        'notifications' => 'notification-service',
    ];

    private array $serviceUrls = [
        'identity-service' => 'http://localhost:8001',
        'patient-service' => 'http://localhost:8002',
        'lab-service' => 'http://localhost:8003',
        'clinician-service' => 'http://localhost:8004',
        'scheduling-service' => 'http://localhost:8005',
        'medical-records-service' => 'http://localhost:8006',
        'analytics-service' => 'http://localhost:8007',
        'reporting-service' => 'http://localhost:8008',
        'notification-service' => 'http://localhost:8009',
    ];

    /**
     * Dispatch request to appropriate service
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');

        // Remove /api prefix if present
        if (strpos($uri, '/api') === 0) {
            $uri = substr($uri, 4);
        }

        // Get first path segment to determine service
        $segments = explode('/', trim($uri, '/'));
        $resource = $segments[0] ?? '';

        // Health check endpoint
        if ($uri === '/health' || $uri === '') {
            $this->healthCheck();
            return;
        }

        // Find service
        $serviceName = $this->serviceMap[$resource] ?? null;

        if (!$serviceName) {
            $this->notFound();
            return;
        }

        // Proxy to service
        $this->proxyRequest($serviceName, $uri, $method);
    }

    /**
     * Proxy request to microservice
     */
    private function proxyRequest(string $serviceName, string $uri, string $method): void
    {
        $serviceUrl = $this->serviceUrls[$serviceName] ?? null;

        if (!$serviceUrl) {
            $this->serviceUnavailable($serviceName);
            return;
        }

        $url = $serviceUrl . $uri;

        // Add query string
        if (!empty($_SERVER['QUERY_STRING'])) {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }

        // Get request body
        $body = file_get_contents('php://input');

        // Get headers to forward
        $headers = $this->getForwardHeaders();

        // Make request
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 5,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            $this->serviceUnavailable($serviceName, $error);
            return;
        }

        // Forward response
        http_response_code($httpCode);

        // Add gateway headers
        header('X-Gateway: vitalnest');
        header('X-Service: ' . $serviceName);

        echo $response;
    }

    /**
     * Get headers to forward to service
     */
    private function getForwardHeaders(): array
    {
        $headers = [];
        $forwardHeaders = ['Content-Type', 'Authorization', 'Accept', 'X-Request-ID'];

        foreach ($forwardHeaders as $name) {
            $serverKey = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
            if (isset($_SERVER[$serverKey])) {
                $headers[] = "$name: " . $_SERVER[$serverKey];
            }
        }

        // Add gateway identifier
        $headers[] = 'X-Forwarded-By: vitalnest-gateway';
        $headers[] = 'X-Forwarded-For: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown');

        return $headers;
    }

    /**
     * Health check endpoint
     */
    private function healthCheck(): void
    {
        $services = [];

        foreach ($this->serviceUrls as $name => $url) {
            $ch = curl_init($url . '/health');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 2,
                CURLOPT_CONNECTTIMEOUT => 1,
            ]);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $services[$name] = [
                'status' => $httpCode === 200 ? 'healthy' : 'unhealthy',
                'url' => $url
            ];
        }

        echo json_encode([
            'success' => true,
            'gateway' => 'vitalnest-api-gateway',
            'version' => '1.0.0',
            'timestamp' => date('Y-m-d H:i:s'),
            'services' => $services
        ], JSON_PRETTY_PRINT);
    }

    /**
     * 404 response
     */
    private function notFound(): void
    {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Resource not found'
        ]);
    }

    /**
     * Service unavailable response
     */
    private function serviceUnavailable(string $serviceName, string $error = ''): void
    {
        http_response_code(503);
        echo json_encode([
            'success' => false,
            'message' => 'Service temporarily unavailable',
            'service' => $serviceName,
            'error' => $error ?: 'Could not connect to service'
        ]);
    }
}

