<?php
/**
 * Patient Service - Patient Management Service
 */

namespace PatientService\Services;

use PatientService\Models\Patient;
use PatientService\Models\Vitals;
use PatientService\Events\PatientCreated;
use PatientService\Events\VitalsRecorded;

class PatientManagementService
{
    /**
     * Get all patients with pagination
     */
    public function getAll(int $page = 1, int $perPage = 15, ?string $search = null): array
    {
        $offset = ($page - 1) * $perPage;

        // DB query would go here

        return [
            'data' => [],
            'meta' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => 0
            ]
        ];
    }

    /**
     * Find patient by ID
     */
    public function findById(int $id): ?Patient
    {
        // DB query would go here
        return null;
    }

    /**
     * Create new patient
     */
    public function create(array $data): Patient
    {
        // Generate medical record number
        $data['medical_record_number'] = $this->generateMRN();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        // Create patient (DB implementation would go here)
        $patient = new Patient();
        $patient->id = rand(1000, 9999);
        $patient->medical_record_number = $data['medical_record_number'];

        // Dispatch event
        $event = new PatientCreated($patient);
        $event->dispatch();

        return $patient;
    }

    /**
     * Update patient
     */
    public function update(int $id, array $data): Patient
    {
        $patient = $this->findById($id);

        if (!$patient) {
            throw new \Exception('Patient not found');
        }

        // Update fields
        $patient->updated_at = date('Y-m-d H:i:s');

        // Save to DB

        return $patient;
    }

    /**
     * Delete patient
     */
    public function delete(int $id): bool
    {
        $patient = $this->findById($id);

        if (!$patient) {
            throw new \Exception('Patient not found');
        }

        // Soft delete or archive

        return true;
    }

    /**
     * Get vitals history for patient
     */
    public function getVitalsHistory(int $patientId, int $limit = 50): array
    {
        // DB query would go here
        // SELECT * FROM patient_vitals WHERE patient_id = ? ORDER BY recorded_at DESC LIMIT ?

        return [];
    }

    /**
     * Record new vitals
     */
    public function recordVitals(int $patientId, array $data): Vitals
    {
        $patient = $this->findById($patientId);

        if (!$patient) {
            throw new \Exception('Patient not found');
        }

        $vitals = new Vitals();
        $vitals->patient_id = $patientId;
        $vitals->recorded_at = date('Y-m-d H:i:s');

        // Calculate BMI if weight and height provided
        if (isset($data['weight']) && isset($data['height'])) {
            $heightInMeters = $data['height'] / 100;
            $vitals->bmi = round($data['weight'] / ($heightInMeters * $heightInMeters), 2);
        }

        // Dispatch event
        $event = new VitalsRecorded($vitals);
        $event->dispatch();

        return $vitals;
    }

    /**
     * Generate unique Medical Record Number
     */
    private function generateMRN(): string
    {
        $prefix = 'VN';
        $year = date('Y');
        $random = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        return "{$prefix}{$year}{$random}";
    }
}

