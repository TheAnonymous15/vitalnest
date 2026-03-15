<?php
session_start();

// Check if user is authenticated with lab-specific token
$token = $_COOKIE['lab_token'] ?? '';
$hasAuthToken = !empty($token);

// Load the appropriate component
if (!$hasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}

