<?php
/**
 * Scheduling Service - Appointment Service
 */

namespace SchedulingService\Services;

use SchedulingService\Models\Appointment;
use SchedulingService\Events\AppointmentScheduled;
use SchedulingService\Events\AppointmentCancelled;

class AppointmentService
{
    public function getAll(int $page, ?int $patientId, ?int $clinicianId, ?string $status, ?string $date): array
    {
        return ['data' => [], 'meta' => ['current_page' => $page, 'total' => 0]];
    }

    public function findById(int $id): ?Appointment
    {
        return null;
    }

    public function create(array $data): Appointment
    {
        // Check for conflicts
        if ($this->hasConflict($data['clinician_id'], $data['scheduled_at'], $data['duration'] ?? 30)) {
            throw new \Exception('Time slot is not available');
        }

        $appointment = new Appointment();
        $appointment->id = rand(1000, 9999);
        $appointment->appointment_number = $this->generateAppointmentNumber();
        $appointment->patient_id = $data['patient_id'];
        $appointment->clinician_id = $data['clinician_id'];
        $appointment->caregiver_id = $data['caregiver_id'] ?? null;
        $appointment->type = $data['type'] ?? Appointment::TYPE_HOME_VISIT;
        $appointment->scheduled_at = $data['scheduled_at'];
        $appointment->duration = $data['duration'] ?? 30;
        $appointment->location = $data['location'] ?? null;
        $appointment->reason = $data['reason'] ?? null;
        $appointment->notes = $data['notes'] ?? null;
        $appointment->status = Appointment::STATUS_SCHEDULED;
        $appointment->created_at = date('Y-m-d H:i:s');

        $event = new AppointmentScheduled($appointment);
        $event->dispatch();

        return $appointment;
    }

    public function update(int $id, array $data): Appointment
    {
        $appointment = $this->findById($id);
        if (!$appointment) throw new \Exception('Appointment not found');
        return $appointment;
    }

    public function cancel(int $id, ?string $reason): Appointment
    {
        $appointment = $this->findById($id);
        if (!$appointment) throw new \Exception('Appointment not found');
        if (!$appointment->canCancel()) throw new \Exception('Cannot cancel this appointment');

        $appointment->status = Appointment::STATUS_CANCELLED;
        $appointment->cancellation_reason = $reason;

        $event = new AppointmentCancelled($appointment);
        $event->dispatch();

        return $appointment;
    }

    public function reschedule(int $id, string $newDateTime): Appointment
    {
        $appointment = $this->findById($id);
        if (!$appointment) throw new \Exception('Appointment not found');

        if ($this->hasConflict($appointment->clinician_id, $newDateTime, $appointment->duration)) {
            throw new \Exception('New time slot is not available');
        }

        $appointment->scheduled_at = $newDateTime;
        return $appointment;
    }

    public function confirm(int $id): Appointment
    {
        $appointment = $this->findById($id);
        if (!$appointment) throw new \Exception('Appointment not found');

        $appointment->status = Appointment::STATUS_CONFIRMED;
        $appointment->confirmed_at = date('Y-m-d H:i:s');
        return $appointment;
    }

    public function complete(int $id, ?string $notes): Appointment
    {
        $appointment = $this->findById($id);
        if (!$appointment) throw new \Exception('Appointment not found');

        $appointment->status = Appointment::STATUS_COMPLETED;
        $appointment->completed_at = date('Y-m-d H:i:s');
        if ($notes) $appointment->notes = $notes;
        return $appointment;
    }

    public function getUpcoming(): array
    {
        return [];
    }

    public function getToday(?int $clinicianId): array
    {
        return [];
    }

    private function hasConflict(int $clinicianId, string $dateTime, int $duration): bool
    {
        // Check for scheduling conflicts
        return false;
    }

    private function generateAppointmentNumber(): string
    {
        return 'APT' . date('Ymd') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}

