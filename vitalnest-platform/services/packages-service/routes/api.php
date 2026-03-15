<?php
/**
 * Packages Service - API Routes
 */

use PackagesService\Controllers\PackageController;

return [
    // Public routes
    'GET /packages' => [PackageController::class, 'index'],
    'GET /packages/{id}' => [PackageController::class, 'show'],
    'GET /packages/slug/{slug}' => [PackageController::class, 'showBySlug'],

    // Admin routes
    'GET /admin/packages' => [PackageController::class, 'adminIndex'],
    'POST /admin/packages' => [PackageController::class, 'store'],
    'PUT /admin/packages/{id}' => [PackageController::class, 'update'],
    'DELETE /admin/packages/{id}' => [PackageController::class, 'destroy'],
    'PATCH /admin/packages/{id}/toggle' => [PackageController::class, 'toggleStatus'],
    'POST /admin/packages/reorder' => [PackageController::class, 'reorder'],

    // Feature management
    'POST /admin/packages/{id}/features' => [PackageController::class, 'addFeature'],
    'PUT /admin/features/{id}' => [PackageController::class, 'updateFeature'],
    'DELETE /admin/features/{id}' => [PackageController::class, 'deleteFeature'],
];

