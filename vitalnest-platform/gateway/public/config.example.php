<?php
/**
 * VitalNest Platform Configuration
 * Environment-specific settings for deployment
 *
 * IMPORTANT: Copy this file to config.php and update values for your environment
 * Never commit config.php to version control
 */

// Environment: 'development', 'staging', 'production'
define('ENVIRONMENT', 'production');

// Debug mode (set to false in production)
define('DEBUG_MODE', false);

// Error reporting
if (ENVIRONMENT === 'production') {
    error_reporting(0);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', __DIR__ . '/../logs/php_errors.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

// Site Configuration
define('SITE_NAME', 'VitalNest');
define('SITE_TAGLINE', 'Professional Home Healthcare');
define('SITE_URL', 'https://vitalnest.co.ke'); // Update with your domain
define('SITE_EMAIL', 'Vitalnesthomecare25@gmail.com');
define('SITE_PHONE', '+254746511327');

// Database Configuration
define('DB_PATH', __DIR__ . '/../database/');

// Session Configuration
define('SESSION_NAME', 'vitalnest_session');
define('SESSION_LIFETIME', 3600); // 1 hour
define('SESSION_SECURE', true); // Set to true when using HTTPS
define('SESSION_HTTPONLY', true);

// Security Configuration
define('CSRF_TOKEN_NAME', 'vitalnest_csrf');
define('PASSWORD_HASH_COST', 12);

// API Configuration (for future use)
define('API_VERSION', 'v1');
define('API_RATE_LIMIT', 100); // requests per minute

// File Upload Configuration
define('UPLOAD_MAX_SIZE', 10 * 1024 * 1024); // 10MB
define('UPLOAD_ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'application/pdf']);
define('UPLOAD_PATH', __DIR__ . '/../uploads/');

// Email Configuration (SMTP)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', ''); // Your email
define('SMTP_PASSWORD', ''); // Your app password
define('SMTP_FROM_NAME', 'VitalNest Healthcare');
define('SMTP_FROM_EMAIL', 'Vitalnesthomecare25@gmail.com');

// M-Pesa Configuration (Safaricom Daraja API)
define('MPESA_ENVIRONMENT', 'production'); // 'sandbox' or 'production'
define('MPESA_CONSUMER_KEY', ''); // Get from Safaricom Developer Portal
define('MPESA_CONSUMER_SECRET', '');
define('MPESA_SHORTCODE', ''); // Your Paybill/Till number
define('MPESA_PASSKEY', '');
define('MPESA_CALLBACK_URL', SITE_URL . '/api/payments/mpesa/callback');

// Analytics (optional)
define('GOOGLE_ANALYTICS_ID', ''); // e.g., 'G-XXXXXXXXXX'

// Social Media Links
define('SOCIAL_WHATSAPP', 'https://wa.me/254746511327');
define('SOCIAL_FACEBOOK', '');
define('SOCIAL_TWITTER', '');
define('SOCIAL_INSTAGRAM', '');

// Cache Configuration
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 3600); // 1 hour
define('CACHE_PATH', __DIR__ . '/../cache/');

// Timezone
date_default_timezone_set('Africa/Nairobi');

// Application Paths
define('BASE_PATH', __DIR__);
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('COMPONENTS_PATH', INCLUDES_PATH . '/components');
define('SECTIONS_PATH', INCLUDES_PATH . '/sections');

/**
 * Initialize secure session
 */
function initSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', SESSION_HTTPONLY ? '1' : '0');
        ini_set('session.cookie_secure', SESSION_SECURE ? '1' : '0');
        ini_set('session.use_strict_mode', '1');
        ini_set('session.cookie_samesite', 'Strict');
        session_name(SESSION_NAME);
        session_start();

        // Regenerate session ID periodically
        if (!isset($_SESSION['created'])) {
            $_SESSION['created'] = time();
        } elseif (time() - $_SESSION['created'] > 1800) {
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        }
    }
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Sanitize input
 */
function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Log application events
 */
function logEvent($message, $level = 'INFO') {
    $logFile = __DIR__ . '/../logs/app_' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] [$level] $message" . PHP_EOL;

    if (!is_dir(dirname($logFile))) {
        mkdir(dirname($logFile), 0755, true);
    }

    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

