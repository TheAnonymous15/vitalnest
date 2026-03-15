<?php

use AnalyticsService\Controllers\AnalyticsController;

return [
    'GET /analytics/dashboard' => [AnalyticsController::class, 'dashboard', 'auth:admin'],
    'GET /analytics/patients' => [AnalyticsController::class, 'patients', 'auth:admin'],
    'GET /analytics/appointments' => [AnalyticsController::class, 'appointments', 'auth:admin,clinician'],
    'GET /analytics/clinicians' => [AnalyticsController::class, 'clinicians', 'auth:admin'],
    'GET /analytics/lab' => [AnalyticsController::class, 'lab', 'auth:admin,lab_tech'],
    'GET /analytics/vitals' => [AnalyticsController::class, 'vitals', 'auth'],
    'GET /analytics/trends' => [AnalyticsController::class, 'trends', 'auth:admin'],
    'GET /analytics/realtime' => [AnalyticsController::class, 'realtime', 'auth:admin'],
];

