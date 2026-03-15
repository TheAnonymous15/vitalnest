<?php
}
    }
        ];
            'data' => $vitals
            'message' => 'Vitals recorded successfully',
            'success' => true,
        return [

        $vitals = $this->patientService->recordVitals($id, $data);

        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function recordVitals(int $id): array
     */
     * Record new vitals
    /**

    }
        ];
            'data' => $vitals
            'success' => true,
        return [

        $vitals = $this->patientService->getVitalsHistory($id);
    {
    public function vitals(int $id): array
     */
     * Get patient vitals history
    /**

    }
        ];
            'message' => 'Patient deleted successfully'
            'success' => true,
        return [

        $this->patientService->delete($id);
    {
    public function destroy(int $id): array
     */
     * Delete patient
    /**

    }
        ];
            'data' => $patient
            'message' => 'Patient updated successfully',
            'success' => true,
        return [

        $patient = $this->patientService->update($id, $data);

        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function update(int $id): array
     */
     * Update patient
    /**

    }
        ];
            'data' => $patient
            'message' => 'Patient created successfully',
            'success' => true,
        return [
        http_response_code(201);

        $patient = $this->patientService->create($data);

        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function store(): array
     */
     * Create new patient
    /**

    }
        ];
            'data' => $patient
            'success' => true,
        return [

        }
            ];
                'message' => 'Patient not found'
                'success' => false,
            return [
            http_response_code(404);
        if (!$patient) {

        $patient = $this->patientService->findById($id);
    {
    public function show(int $id): array
     */
     * Get single patient
    /**

    }
        ];
            'data' => $patients
            'success' => true,
        return [

        $patients = $this->patientService->getAll($page, $perPage, $search);

        $search = $_GET['search'] ?? null;
        $perPage = $_GET['per_page'] ?? 15;
        $page = $_GET['page'] ?? 1;
    {
    public function index(): array
     */
     * List all patients with pagination
    /**

    }
        $this->patientService = new PatientManagementService();
    {
    public function __construct()

    private PatientManagementService $patientService;
{
class PatientController

use PatientService\Models\Patient;
use PatientService\Services\PatientManagementService;

namespace PatientService\Controllers;

 */
 * Patient Service - Patient Controller
/**

