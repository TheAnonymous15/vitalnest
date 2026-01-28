<?php
/**
 * Patient Service - API Routes
 */

use PatientService\Controllers\PatientController;

return [
    'GET /patients' => [PatientController::class, 'index', 'auth'],
    'GET /patients/{id}' => [PatientController::class, 'show', 'auth'],
    'POST /patients' => [PatientController::class, 'store', 'auth:clinician,admin'],
    'PUT /patients/{id}' => [PatientController::class, 'update', 'auth:clinician,admin'],
    'DELETE /patients/{id}' => [PatientController::class, 'destroy', 'auth:admin'],

    // Vitals routes
    'GET /patients/{id}/vitals' => [PatientController::class, 'vitals', 'auth'],
    'POST /patients/{id}/vitals' => [PatientController::class, 'recordVitals', 'auth:clinician,caregiver'],
];

