<?php
/**
 * Clinician Service - Clinician Management Service
 */

namespace ClinicianService\Services;

use ClinicianService\Models\Clinician;
use ClinicianService\Events\ClinicianRegistered;

class ClinicianManagementService
{
    public function getAll(int $page = 1, ?string $specialty = null, ?bool $available = null): array
    {
        return ['data' => [], 'meta' => ['current_page' => $page, 'total' => 0]];
    }

    public function findById(int $id): ?Clinician
    {
        return null;
    }

    public function create(array $data): Clinician
    {
        $clinician = new Clinician();
        $clinician->id = rand(1000, 9999);
        $clinician->user_id = $data['user_id'];
        $clinician->license_number = $data['license_number'];
        $clinician->specialty = $data['specialty'];
        $clinician->title = $data['title'] ?? 'Dr.';
        $clinician->accepting_patients = true;
        $clinician->status = 'pending_verification';
        $clinician->created_at = date('Y-m-d H:i:s');

        $event = new ClinicianRegistered($clinician);
        $event->dispatch();

        return $clinician;
    }

    public function update(int $id, array $data): Clinician
    {
        $clinician = $this->findById($id);
        if (!$clinician) throw new \Exception('Clinician not found');
        return $clinician;
    }

    public function getSchedule(int $clinicianId): array
    {
        return [];
    }

    public function getPatients(int $clinicianId): array
    {
        return [];
    }

    public function getAvailability(int $clinicianId, string $date): array
    {
        // Generate available time slots for the given date
        $slots = [];
        $startHour = 9;
        $endHour = 17;

        for ($hour = $startHour; $hour < $endHour; $hour++) {
            $slots[] = [
                'time' => sprintf('%02d:00', $hour),
                'available' => rand(0, 1) === 1
            ];
            $slots[] = [
                'time' => sprintf('%02d:30', $hour),
                'available' => rand(0, 1) === 1
            ];
        }

        return $slots;
    }
}

