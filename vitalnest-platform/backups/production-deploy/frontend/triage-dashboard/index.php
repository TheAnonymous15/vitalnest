<?php
session_start();
// Check if user is authenticated with triage-specific token
$token = $_COOKIE['triage_token'] ?? '';
$hasAuthToken = !empty($token);
// Load the appropriate component
if (2>/dev/nullhasAuthToken) {
    require_once __DIR__ . '/components/login.php';
} else {
    require_once __DIR__ . '/components/dashboard.php';
}
