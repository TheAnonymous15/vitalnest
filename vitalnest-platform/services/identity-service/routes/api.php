<?php
/**
 * Identity Service - API Routes
 */

use IdentityService\Controllers\AuthController;
use IdentityService\Controllers\UserController;

return [
    // Authentication routes
    'POST /auth/register' => [AuthController::class, 'register'],
    'POST /auth/login' => [AuthController::class, 'login'],
    'POST /auth/logout' => [AuthController::class, 'logout', 'auth'],
    'POST /auth/refresh' => [AuthController::class, 'refreshToken', 'auth'],
    'GET /auth/profile' => [AuthController::class, 'profile', 'auth'],

    // User management routes (admin only)
    'GET /users' => [UserController::class, 'index', 'auth:admin'],
    'GET /users/{id}' => [UserController::class, 'show', 'auth:admin'],
    'PUT /users/{id}' => [UserController::class, 'update', 'auth:admin'],
    'DELETE /users/{id}' => [UserController::class, 'destroy', 'auth:admin'],
    'PUT /users/{id}/role' => [UserController::class, 'updateRole', 'auth:admin'],
    'PUT /users/{id}/status' => [UserController::class, 'toggleStatus', 'auth:admin'],
];

