<?php

use ReportingService\Controllers\ReportController;

return [
    'GET /reports' => [ReportController::class, 'index', 'auth:admin'],
    'GET /reports/templates' => [ReportController::class, 'templates', 'auth'],
    'GET /reports/{id}' => [ReportController::class, 'show', 'auth'],
    'POST /reports' => [ReportController::class, 'generate', 'auth'],
    'GET /reports/{id}/download' => [ReportController::class, 'download', 'auth'],
    'POST /reports/schedule' => [ReportController::class, 'schedule', 'auth:admin'],
    'GET /reports/patient/{id}' => [ReportController::class, 'patientReport', 'auth'],
    'GET /reports/clinician/{id}' => [ReportController::class, 'clinicianReport', 'auth:admin,clinician'],
    'GET /reports/lab' => [ReportController::class, 'labReport', 'auth:admin,lab_tech'],
    'GET /reports/financial' => [ReportController::class, 'financialReport', 'auth:admin'],
];

