<?php

namespace SchedulingService\Events;

use SchedulingService\Models\Appointment;

class AppointmentScheduled
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
        return 'appointment.scheduled';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'appointment_id' => $this->appointment->id,
            'appointment_number' => $this->appointment->appointment_number,
            'patient_id' => $this->appointment->patient_id,
            'clinician_id' => $this->appointment->clinician_id,
            'scheduled_at' => $this->appointment->scheduled_at,
            'type' => $this->appointment->type,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // Send confirmation email/SMS to patient
        // Notify clinician
        // Add to calendar
        error_log(json_encode($this->getPayload()));
    }
}

