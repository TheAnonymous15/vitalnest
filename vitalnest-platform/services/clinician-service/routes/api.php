<?php

use ClinicianService\Controllers\ClinicianController;

return [
    'GET /clinicians' => [ClinicianController::class, 'index', 'auth'],
    'GET /clinicians/{id}' => [ClinicianController::class, 'show', 'auth'],
    'POST /clinicians' => [ClinicianController::class, 'store', 'auth:admin'],
    'PUT /clinicians/{id}' => [ClinicianController::class, 'update', 'auth:admin,clinician'],
    'GET /clinicians/{id}/schedule' => [ClinicianController::class, 'schedule', 'auth'],
    'GET /clinicians/{id}/patients' => [ClinicianController::class, 'patients', 'auth:clinician'],
    'GET /clinicians/{id}/availability' => [ClinicianController::class, 'availability', 'auth'],
];

