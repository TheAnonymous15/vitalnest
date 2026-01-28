<?php
}
    }
        return ['success' => true, 'data' => $diagnoses];
        $diagnoses = $this->recordsService->getDiagnoses($patientId);
    {
    public function diagnoses(int $patientId): array

    }
        return ['success' => true, 'message' => 'Medication added', 'data' => $medication];
        $medication = $this->recordsService->addMedication($patientId, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function addMedication(int $patientId): array

    }
        return ['success' => true, 'data' => $medications];
        $medications = $this->recordsService->getMedications($patientId);
    {
    public function medications(int $patientId): array

    }
        return ['success' => true, 'message' => 'Note added', 'data' => $note];
        $note = $this->recordsService->addClinicalNote($patientId, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function addClinicalNote(int $patientId): array

    }
        return ['success' => true, 'data' => $notes];
        $notes = $this->recordsService->getClinicalNotes($patientId);
    {
    public function clinicalNotes(int $patientId): array

    }
        return ['success' => true, 'data' => $history];
        $history = $this->recordsService->getPatientHistory($patientId);
    {
    public function patientHistory(int $patientId): array

    }
        return ['success' => true, 'message' => 'Record created', 'data' => $record];
        http_response_code(201);
        $record = $this->recordsService->create($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function store(): array

    }
        return ['success' => true, 'data' => $record];
        }
            return ['success' => false, 'message' => 'Record not found'];
            http_response_code(404);
        if (!$record) {
        $record = $this->recordsService->findById($id);
    {
    public function show(int $id): array

    }
        return ['success' => true, 'data' => $records];
        $records = $this->recordsService->getAll($patientId, $type);
        $type = $_GET['type'] ?? null;
        $patientId = $_GET['patient_id'] ?? null;
    {
    public function index(): array

    }
        $this->recordsService = new MedicalRecordsService();
    {
    public function __construct()

    private MedicalRecordsService $recordsService;
{
class RecordsController

use MedicalRecordsService\Services\MedicalRecordsService;

namespace MedicalRecordsService\Controllers;

 */
 * Medical Records Service - Records Controller
/**

