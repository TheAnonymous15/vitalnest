<?php
/**
 * VitalNest Platform - MAIN ENTRY POINT
 * =====================================
 * Single entry point for cPanel/Shared Hosting
 * All requests route through this file
 *
 * Features:
 * - Single Page Application (SPA) style navigation
 * - URL remains unchanged during internal navigation
 * - Full routing for dashboards, API, and static pages
 */

// ============================================
// INITIALIZATION
// ============================================

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define paths
define('ROOT_PATH', __DIR__);
define('FRONTEND_PATH', ROOT_PATH . '/frontend');
define('SERVICES_PATH', ROOT_PATH . '/services');
define('GATEWAY_PATH', ROOT_PATH . '/gateway/public');
define('DATABASE_PATH', ROOT_PATH . '/database');
define('SHARED_PATH', ROOT_PATH . '/shared');

// Load gateway config if exists
if (file_exists(GATEWAY_PATH . '/config.php')) {
    require_once GATEWAY_PATH . '/config.php';
}

// ============================================
// REQUEST PARSING
// ============================================

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = '/' . trim($requestUri, '/');
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Check if this is an AJAX/fetch request for content loading
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                 strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
$isContentRequest = isset($_GET['_content']) || $isAjaxRequest;

// ============================================
// DASHBOARD ROUTES
// ============================================

$dashboards = [
    '/admin'        => 'admin-dashboard',
    '/doctor'       => 'doctor-dashboard',
    '/clinician'    => 'clinician-dashboard',
    '/nurse'        => 'nurse-dashboard',
    '/lab'          => 'lab-dashboard',
    '/pharmacy'     => 'pharmacy-dashboard',
    '/client'       => 'client-dashboard',
    '/patient'      => 'client-dashboard',
    '/caregiver'    => 'caregiver-dashboard',
    '/hr'           => 'hr-dashboard',
    '/receptionist' => 'receptionist-dashboard',
    '/triage'       => 'triage-dashboard',
];

// Check dashboard routes
foreach ($dashboards as $route => $dashboard) {
    if ($requestUri === $route || strpos($requestUri, $route . '/') === 0) {
        $dashboardPath = FRONTEND_PATH . '/' . $dashboard . '/index.php';
        if (file_exists($dashboardPath)) {
            define('CURRENT_DASHBOARD', $dashboard);
            define('DASHBOARD_PATH', FRONTEND_PATH . '/' . $dashboard);

            // If AJAX request, just return the content
            if ($isContentRequest) {
                require_once $dashboardPath;
                exit;
            }

            // Otherwise wrap in SPA shell
            renderSPAShell($dashboardPath, $dashboard);
            exit;
        } else {
            http_response_code(404);
            echo "Dashboard not found: $dashboard";
            exit;
        }
    }
}

// ============================================
// API ROUTES
// ============================================

if (strpos($requestUri, '/api/') === 0) {
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept');
    header('Access-Control-Max-Age: 86400');

    if ($requestMethod === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    $parts = explode('/', trim($requestUri, '/'));
    array_shift($parts);
    $serviceKey = $parts[0] ?? '';

    $serviceMap = [
        'auth'          => 'identity-service',
        'identity'      => 'identity-service',
        'users'         => 'identity-service',
        'patients'      => 'patient-service',
        'scheduling'    => 'scheduling-service',
        'appointments'  => 'scheduling-service',
        'lab'           => 'lab-service',
        'clinicians'    => 'clinician-service',
        'nurse'         => 'nurse-service',
        'triage'        => 'triage-service',
        'records'       => 'medical-records-service',
        'subscriptions' => 'subscription-service',
        'insurance'     => 'insurance-service',
        'tickets'       => 'tickets-service',
        'notifications' => 'notification-service',
        'analytics'     => 'analytics-service',
        'reports'       => 'reporting-service',
        'packages'      => 'packages-service',
    ];

    if (isset($serviceMap[$serviceKey])) {
        $serviceName = $serviceMap[$serviceKey];
        $servicePath = SERVICES_PATH . '/' . $serviceName . '/public/index.php';

        // Keep the full path including service key (e.g., /auth/login)
        $serviceUri = '/' . implode('/', $parts);
        $_SERVER['ORIGINAL_REQUEST_URI'] = $_SERVER['REQUEST_URI'];
        $_SERVER['REQUEST_URI'] = $serviceUri ?: '/';

        $autoloader = SERVICES_PATH . '/' . $serviceName . '/vendor/autoload.php';
        if (file_exists($autoloader)) {
            require_once $autoloader;
        }

        if (file_exists($servicePath)) {
            require_once $servicePath;
            exit;
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Service unavailable: ' . $serviceName]);
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'API endpoint not found: ' . $requestUri]);
    exit;
}

// ============================================
// STATIC PAGES
// ============================================

$staticPages = [
    '/privacy-policy'    => GATEWAY_PATH . '/privacy-policy.php',
    '/terms-of-service'  => GATEWAY_PATH . '/terms-of-service.php',
    '/cookie-policy'     => GATEWAY_PATH . '/cookie-policy.php',
    '/sitemap'           => GATEWAY_PATH . '/sitemap.php',
    '/sitemap.xml'       => GATEWAY_PATH . '/sitemap.php',
    '/robots.txt'        => GATEWAY_PATH . '/robots.php',
    '/health-check'      => GATEWAY_PATH . '/health-check.php',
    '/404'               => GATEWAY_PATH . '/404.php',
    '/500'               => GATEWAY_PATH . '/500.php',
];

if (isset($staticPages[$requestUri])) {
    $pagePath = $staticPages[$requestUri];
    if (file_exists($pagePath)) {
        if ($isContentRequest) {
            require_once $pagePath;
            exit;
        }
        renderSPAShell($pagePath, basename($requestUri));
        exit;
    }
}

// ============================================
// STATIC ASSETS
// ============================================

$extension = strtolower(pathinfo($requestUri, PATHINFO_EXTENSION));
$assetExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'webp'];

if (in_array($extension, $assetExtensions)) {
    // Try multiple locations for assets
    $possiblePaths = [
        GATEWAY_PATH . $requestUri,                    // /resources/logo.jpeg
        GATEWAY_PATH . '/resources' . $requestUri,     // /logo.jpeg -> /resources/logo.jpeg
    ];

    // If path starts with /resources/, also try without prefix
    if (strpos($requestUri, '/resources/') === 0) {
        $possiblePaths[] = GATEWAY_PATH . $requestUri;
    }

    foreach ($possiblePaths as $assetPath) {
        if (file_exists($assetPath)) {
            $mimeTypes = [
                'css' => 'text/css', 'js' => 'application/javascript',
                'png' => 'image/png', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
                'gif' => 'image/gif', 'svg' => 'image/svg+xml', 'ico' => 'image/x-icon',
                'woff' => 'font/woff', 'woff2' => 'font/woff2', 'ttf' => 'font/ttf', 'webp' => 'image/webp',
            ];
            header('Content-Type: ' . ($mimeTypes[$extension] ?? 'application/octet-stream'));
            header('Cache-Control: public, max-age=86400'); // Cache for 1 day
            readfile($assetPath);
            exit;
        }
    }

    http_response_code(404);
    exit;
}

// ============================================
// DEFAULT: LANDING PAGE
// ============================================

if ($requestUri === '/' || $requestUri === '') {
    require_once GATEWAY_PATH . '/index.php';
    exit;
}

// ============================================
// 404 - PAGE NOT FOUND
// ============================================

http_response_code(404);
if (file_exists(GATEWAY_PATH . '/404.php')) {
    require_once GATEWAY_PATH . '/404.php';
} else {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | VitalNest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-teal-500">404</h1>
        <p class="text-xl mt-4 text-gray-400">Page not found</p>
        <a href="/" class="mt-6 inline-block px-6 py-3 bg-teal-600 hover:bg-teal-700 rounded-lg transition">
            Return Home
        </a>
    </div>
</body>
</html>';
}
exit;

// ============================================
// SPA SHELL RENDERER
// ============================================

/**
 * Renders the SPA shell with iframe for seamless navigation
 * URL stays as / while content changes
 */
function renderSPAShell($contentPath, $pageName = '') {
    $pageTitle = 'VitalNest' . ($pageName ? ' - ' . ucfirst(str_replace('-', ' ', $pageName)) : '');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body { margin: 0; padding: 0; height: 100%; overflow: hidden; }
        #app-frame { width: 100%; height: 100%; border: none; }
        .loading-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(13, 13, 13, 0.95);
            display: flex; align-items: center; justify-content: center;
            z-index: 9999; transition: opacity 0.3s;
        }
        .loading-overlay.hidden { opacity: 0; pointer-events: none; }
        .spinner {
            width: 50px; height: 50px;
            border: 3px solid rgba(15, 118, 110, 0.3);
            border-top-color: #0F766E;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-vital-dark">
    <div id="loading" class="loading-overlay">
        <div class="spinner"></div>
    </div>
    <iframe id="app-frame" src="<?php echo $_SERVER['REQUEST_URI']; ?>?_content=1"></iframe>
    <script>
        const frame = document.getElementById('app-frame');
        const loading = document.getElementById('loading');

        frame.onload = function() {
            loading.classList.add('hidden');
            // Update title from iframe
            try {
                const iframeTitle = frame.contentDocument?.title;
                if (iframeTitle) document.title = iframeTitle;
            } catch(e) {}
        };

        // Intercept navigation within iframe
        frame.addEventListener('load', function() {
            try {
                const links = frame.contentDocument.querySelectorAll('a[href^="/"]');
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');
                        if (href && href.startsWith('/') && !href.startsWith('//')) {
                            e.preventDefault();
                            loading.classList.remove('hidden');
                            frame.src = href + '?_content=1';
                        }
                    });
                });
            } catch(e) {}
        });
    </script>
</body>
</html>
    <?php
}
