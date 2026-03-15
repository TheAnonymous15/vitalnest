<?php
session_start();
// Check if user is authenticated with nurse-specific token
$token = $_COOKIE['nurse_token'] ?? '';
$hasAuthToken = !empty($token);
// Load the appropriate component
if (2>/dev/nullhasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}
