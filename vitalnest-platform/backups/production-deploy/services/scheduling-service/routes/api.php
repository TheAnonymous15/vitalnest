<?php

use SchedulingService\Controllers\AppointmentController;

return [
    'GET /appointments' => [AppointmentController::class, 'index', 'auth'],
    'GET /appointments/upcoming' => [AppointmentController::class, 'upcoming', 'auth'],
    'GET /appointments/today' => [AppointmentController::class, 'today', 'auth'],
    'GET /appointments/{id}' => [AppointmentController::class, 'show', 'auth'],
    'POST /appointments' => [AppointmentController::class, 'store', 'auth'],
    'PUT /appointments/{id}' => [AppointmentController::class, 'update', 'auth'],
    'POST /appointments/{id}/cancel' => [AppointmentController::class, 'cancel', 'auth'],
    'POST /appointments/{id}/reschedule' => [AppointmentController::class, 'reschedule', 'auth'],
    'POST /appointments/{id}/confirm' => [AppointmentController::class, 'confirm', 'auth'],
    'POST /appointments/{id}/complete' => [AppointmentController::class, 'complete', 'auth:clinician'],
];

