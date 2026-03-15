<?php
/**
 * VitalNest Gateway - Landing Page
 * This file renders the public landing page
 *
 * Note: Main routing is handled by /index.php (root)
 * This file is called when user visits the home page
 */

// Load configuration if not already loaded
if (!defined('BASE_PATH')) {
    if (file_exists(__DIR__ . '/config.php')) {
        require_once __DIR__ . '/config.php';
        if (function_exists('initSecureSession') && session_status() === PHP_SESSION_NONE) {
            initSecureSession();
        }
    } else {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        define('BASE_PATH', __DIR__);
        define('INCLUDES_PATH', BASE_PATH . '/includes');
        define('COMPONENTS_PATH', INCLUDES_PATH . '/components');
        define('SECTIONS_PATH', INCLUDES_PATH . '/sections');
    }
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? 'guest';
$userName = $_SESSION['user_name'] ?? '';

// Set page metadata
$pageTitle = 'VitalNest - Professional Home Healthcare Services';
$pageDescription = 'Book professional home healthcare services. Licensed nurses, clinicians, and lab services at your doorstep. Quality care delivered to your home.';

// Include landing page components
require_once COMPONENTS_PATH . '/header.php';
require_once COMPONENTS_PATH . '/navbar.php';
require_once SECTIONS_PATH . '/hero.php';
require_once SECTIONS_PATH . '/vision-mission.php';
require_once SECTIONS_PATH . '/services.php';
require_once SECTIONS_PATH . '/packages-dynamic.php';
require_once SECTIONS_PATH . '/faq.php';
require_once COMPONENTS_PATH . '/footer.php';

