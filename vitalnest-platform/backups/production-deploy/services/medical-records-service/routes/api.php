<?php

use MedicalRecordsService\Controllers\RecordsController;

return [
    'GET /records' => [RecordsController::class, 'index', 'auth'],
    'GET /records/{id}' => [RecordsController::class, 'show', 'auth'],
    'POST /records' => [RecordsController::class, 'store', 'auth:clinician'],
    'GET /patients/{id}/history' => [RecordsController::class, 'patientHistory', 'auth'],
    'GET /patients/{id}/notes' => [RecordsController::class, 'clinicalNotes', 'auth'],
    'POST /patients/{id}/notes' => [RecordsController::class, 'addClinicalNote', 'auth:clinician'],
    'GET /patients/{id}/medications' => [RecordsController::class, 'medications', 'auth'],
    'POST /patients/{id}/medications' => [RecordsController::class, 'addMedication', 'auth:clinician'],
    'GET /patients/{id}/diagnoses' => [RecordsController::class, 'diagnoses', 'auth'],
];

