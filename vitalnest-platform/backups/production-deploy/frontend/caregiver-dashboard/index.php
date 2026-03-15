<?php
session_start();

// Check if user is authenticated with caregiver-specific token
$token = $_COOKIE['caregiver_token'] ?? '';
$hasAuthToken = !empty($token);

// Load the appropriate component
if (!$hasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}

