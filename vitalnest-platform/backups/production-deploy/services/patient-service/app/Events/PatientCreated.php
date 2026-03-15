<?php
/**
 * Patient Service - Patient Created Event
 */

namespace PatientService\Events;

use PatientService\Models\Patient;

class PatientCreated
{
    public Patient $patient;
    public string $occurredAt;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'patient.created';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'patient_id' => $this->patient->id,
            'medical_record_number' => $this->patient->medical_record_number,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        error_log(json_encode($this->getPayload()));
    }
}

