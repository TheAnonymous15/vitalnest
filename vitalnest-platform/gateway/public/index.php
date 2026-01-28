<?php
/**
 * Vitalnest Platform - Main Router
 * Gateway Public Portal - Index File
 * Acts as the main entry point and routes requests
 */

// Start session
session_start();

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base paths
define('BASE_PATH', __DIR__);
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('COMPONENTS_PATH', INCLUDES_PATH . '/components');
define('SECTIONS_PATH', INCLUDES_PATH . '/sections');

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $_SESSION['user_role'] ?? 'guest';
$userName = $_SESSION['user_name'] ?? '';

// Set page metadata
$pageTitle = 'Vitalnest - Professional Home Healthcare Services';
$pageDescription = 'Book professional home healthcare services. Licensed nurses, clinicians, and lab services at your doorstep. Quality care delivered to your home.';

// Include header component
require_once COMPONENTS_PATH . '/header.php';

// Include navigation component
require_once COMPONENTS_PATH . '/navbar.php';

// Include main content sections in order
require_once SECTIONS_PATH . '/hero.php';
require_once SECTIONS_PATH . '/vision-mission.php';
//require_once SECTIONS_PATH . '/how-it-works.php';
require_once SECTIONS_PATH . '/services.php'; // Now includes "Why Choose Us" section
//require_once SECTIONS_PATH . '/why-choose-us.php'; // Now integrated into services.php
require_once SECTIONS_PATH . '/packages.php';
//require_once SECTIONS_PATH . '/testimonials.php';
require_once SECTIONS_PATH . '/faq.php';
//require_once SECTIONS_PATH . '/security-compliance.php';
//require_once SECTIONS_PATH . '/final-cta.php'; // Now integrated into services.php

// Include footer component
require_once COMPONENTS_PATH . '/footer.php';
?>

