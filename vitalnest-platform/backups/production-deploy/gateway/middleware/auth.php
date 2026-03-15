<?php
/**
 * Vitalnest Platform - API Gateway Auth Middleware
 */

require_once __DIR__ . '/../../shared/auth/jwt.php';

class AuthMiddleware
{
    /**
     * Authenticate request
     */
    public static function handle(?string $requiredRole = null): ?array
    {
        $token = self::getTokenFromHeader();

        if (!$token) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Authentication required'
            ]);
            exit;
        }

        $payload = jwt_decode($token);

        if (!$payload) {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid or expired token'
            ]);
            exit;
        }

        // Check role if required
        if ($requiredRole) {
            $roles = explode(',', $requiredRole);
            if (!in_array($payload['role'] ?? '', $roles)) {
                http_response_code(403);
                echo json_encode([
                    'success' => false,
                    'message' => 'Insufficient permissions'
                ]);
                exit;
            }
        }

        return $payload;
    }

    /**
     * Check if user is authenticated (optional auth)
     */
    public static function check(): ?array
    {
        $token = self::getTokenFromHeader();

        if (!$token) {
            return null;
        }

        return jwt_decode($token);
    }

    /**
     * Get token from Authorization header
     */
    private static function getTokenFromHeader(): ?string
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';

        if (preg_match('/Bearer\s+(.+)$/i', $authHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

/**
 * Rate Limiting Middleware
 */
class RateLimitMiddleware
{
    private static array $requests = [];

    public static function handle(int $maxRequests = 100, int $windowSeconds = 60): void
    {
        $clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = md5($clientIp);
        $now = time();

        // Clean old entries
        self::$requests = array_filter(self::$requests, fn($time) => $time > $now - $windowSeconds);

        // Count requests
        $requestCount = count(array_filter(self::$requests, fn($k) => strpos($k, $key) === 0, ARRAY_FILTER_USE_KEY));

        if ($requestCount >= $maxRequests) {
            http_response_code(429);
            header('Retry-After: ' . $windowSeconds);
            echo json_encode([
                'success' => false,
                'message' => 'Too many requests. Please try again later.'
            ]);
            exit;
        }

        self::$requests[$key . '_' . $now] = $now;
    }
}

/**
 * CORS Middleware
 */
class CorsMiddleware
{
    public static function handle(array $allowedOrigins = ['*']): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';

        if (in_array('*', $allowedOrigins) || in_array($origin, $allowedOrigins)) {
            header('Access-Control-Allow-Origin: ' . $origin);
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Max-Age: 86400');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
}

