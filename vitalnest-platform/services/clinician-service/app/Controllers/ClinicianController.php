<?php
}
    }
        return ['success' => true, 'data' => $slots];
        $slots = $this->clinicianService->getAvailability($id, $date);
        $date = $_GET['date'] ?? date('Y-m-d');
    {
    public function availability(int $id): array

    }
        return ['success' => true, 'data' => $patients];
        $patients = $this->clinicianService->getPatients($id);
    {
    public function patients(int $id): array

    }
        return ['success' => true, 'data' => $schedule];
        $schedule = $this->clinicianService->getSchedule($id);
    {
    public function schedule(int $id): array

    }
        return ['success' => true, 'message' => 'Clinician updated', 'data' => $clinician];
        $clinician = $this->clinicianService->update($id, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function update(int $id): array

    }
        return ['success' => true, 'message' => 'Clinician created', 'data' => $clinician];
        http_response_code(201);
        $clinician = $this->clinicianService->create($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function store(): array

    }
        return ['success' => true, 'data' => $clinician];
        }
            return ['success' => false, 'message' => 'Clinician not found'];
            http_response_code(404);
        if (!$clinician) {
        $clinician = $this->clinicianService->findById($id);
    {
    public function show(int $id): array

    }
        return ['success' => true, 'data' => $clinicians];
        $clinicians = $this->clinicianService->getAll($page, $specialty, $available);

        $available = $_GET['available'] ?? null;
        $specialty = $_GET['specialty'] ?? null;
        $page = $_GET['page'] ?? 1;
    {
    public function index(): array

    }
        $this->clinicianService = new ClinicianManagementService();
    {
    public function __construct()

    private ClinicianManagementService $clinicianService;
{
class ClinicianController

use ClinicianService\Services\ClinicianManagementService;

namespace ClinicianService\Controllers;

 */
 * Clinician Service - Clinician Controller
/**

