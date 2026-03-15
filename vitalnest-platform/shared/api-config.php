<?php
/**
 * VitalNest - API Configuration Helper
 * Include this file in dashboards to get the correct API base URL
 */

// Determine the API base URL based on environment
function getApiBaseUrl() {
    // Check if we're in production (running via the unified router)
    if (defined('SITE_URL')) {
        return SITE_URL . '/api';
    }

    // Auto-detect base URL
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Check if we're running through the unified gateway
    $scriptPath = dirname($_SERVER['SCRIPT_NAME']);

    // If script is in gateway/public, we use /api
    if (strpos($scriptPath, 'gateway/public') !== false || $scriptPath === '/' || $scriptPath === '') {
        return $protocol . '://' . $host . '/api';
    }

    // If we're in a dashboard, calculate path to gateway
    // From /frontend/admin-dashboard/ we need to go to /gateway/public/api
    if (strpos($_SERVER['REQUEST_URI'], '/dashboard/') !== false) {
        return $protocol . '://' . $host . '/api';
    }

    // Fallback for development - use relative paths
    return '/api';
}

// Get dashboard base URL
function getDashboardBaseUrl($dashboard = null) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    if ($dashboard) {
        return $protocol . '://' . $host . '/dashboard/' . $dashboard;
    }

    return $protocol . '://' . $host . '/dashboard';
}

// Get site base URL
function getSiteBaseUrl() {
    if (defined('SITE_URL')) {
        return SITE_URL;
    }

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    return $protocol . '://' . $host;
}

// Output JavaScript configuration for frontend
function outputApiConfig() {
    $apiBase = getApiBaseUrl();
    $siteBase = getSiteBaseUrl();
    ?>
    <script>
        // VitalNest API Configuration
        const VITALNEST_CONFIG = {
            API_BASE_URL: '<?php echo $apiBase; ?>',
            SITE_BASE_URL: '<?php echo $siteBase; ?>',
            DASHBOARD_BASE_URL: '<?php echo getDashboardBaseUrl(); ?>',

            // Helper methods
            api: function(endpoint) {
                return this.API_BASE_URL + '/' + endpoint.replace(/^\//, '');
            },

            dashboard: function(role) {
                return this.DASHBOARD_BASE_URL + '/' + role;
            }
        };

        // Legacy compatibility
        const API_BASE_URL = VITALNEST_CONFIG.API_BASE_URL;
    </script>
    <?php
}

