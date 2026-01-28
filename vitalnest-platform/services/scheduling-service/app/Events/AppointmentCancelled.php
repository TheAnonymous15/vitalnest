<?php

namespace SchedulingService\Events;

use SchedulingService\Models\Appointment;

class AppointmentCancelled
{
    public Appointment $appointment;
    public string $occurredAt;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'appointment.cancelled';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'appointment_id' => $this->appointment->id,
            'patient_id' => $this->appointment->patient_id,
            'clinician_id' => $this->appointment->clinician_id,
            'reason' => $this->appointment->cancellation_reason,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // Notify patient and clinician
        // Free up time slot
        error_log(json_encode($this->getPayload()));
    }
}

