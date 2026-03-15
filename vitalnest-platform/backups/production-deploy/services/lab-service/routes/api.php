<?php

use LabService\Controllers\LabController;

return [
    'GET /lab-orders' => [LabController::class, 'index', 'auth'],
    'GET /lab-orders/pending' => [LabController::class, 'pending', 'auth:lab_tech'],
    'GET /lab-orders/{id}' => [LabController::class, 'show', 'auth'],
    'POST /lab-orders' => [LabController::class, 'store', 'auth:clinician'],
    'PUT /lab-orders/{id}/status' => [LabController::class, 'updateStatus', 'auth:lab_tech'],
    'POST /lab-orders/{id}/results' => [LabController::class, 'submitResults', 'auth:lab_tech'],
    'GET /lab-orders/{id}/results' => [LabController::class, 'getResults', 'auth'],
];

