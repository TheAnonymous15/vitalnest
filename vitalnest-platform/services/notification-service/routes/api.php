<?php

use NotificationService\Controllers\NotificationController;

return [
    'GET /notifications' => [NotificationController::class, 'index', 'auth'],
    'GET /notifications/unread-count' => [NotificationController::class, 'unreadCount', 'auth'],
    'GET /notifications/templates' => [NotificationController::class, 'templates', 'auth:admin'],
    'GET /notifications/{id}' => [NotificationController::class, 'show', 'auth'],
    'POST /notifications' => [NotificationController::class, 'send', 'auth'],
    'POST /notifications/bulk' => [NotificationController::class, 'sendBulk', 'auth:admin'],
    'PUT /notifications/{id}/read' => [NotificationController::class, 'markAsRead', 'auth'],
    'POST /notifications/mark-all-read' => [NotificationController::class, 'markAllAsRead', 'auth'],
    'DELETE /notifications/{id}' => [NotificationController::class, 'delete', 'auth'],
    'GET /users/{id}/preferences' => [NotificationController::class, 'preferences', 'auth'],
    'PUT /users/{id}/preferences' => [NotificationController::class, 'updatePreferences', 'auth'],
];

