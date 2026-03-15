<?php
session_start();

// Check if user is authenticated with client-specific token
$token = $_COOKIE['client_token'] ?? '';
$hasAuthToken = !empty($token);

// Load the appropriate component
if (!$hasAuthToken) {
    require_once __DIR__ . '/components/login-new.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}

