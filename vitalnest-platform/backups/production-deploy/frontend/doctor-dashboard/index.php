<?php
session_start();
// Check if user is authenticated with doctor-specific token
$token = $_COOKIE['doctor_token'] ?? '';
$hasAuthToken = !empty($token);
// Load the appropriate component
if (!$hasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}
