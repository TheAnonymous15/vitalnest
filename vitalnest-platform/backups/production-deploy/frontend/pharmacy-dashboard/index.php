<?php
session_start();
// Check if user is authenticated with pharmacy-specific token
$token = $_COOKIE['pharmacy_token'] ?? '';
$hasAuthToken = !empty($token);
// Load the appropriate component
if (!$hasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}
