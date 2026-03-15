<?php
session_start();

// Check if user is authenticated
$token = $_COOKIE['token'] ?? '';
$hasAuthToken = !empty($token);

// Load the appropriate component without redirecting (keeps URL clean)
if (!$hasAuthToken) {
    // Not logged in - load login page
    require_once __DIR__ . '/components/login.php';
} else {
    // Logged in - load dashboard page
    require_once __DIR__ . '/components/dashboard.php';
}
