<?php
/**
 * Patient Service - Vitals Recorded Event
 */

namespace PatientService\Events;

use PatientService\Models\Vitals;

class VitalsRecorded
{
    public Vitals $vitals;
    public string $occurredAt;

    public function __construct(Vitals $vitals)
    {
        $this->vitals = $vitals;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'patient.vitals_recorded';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'patient_id' => $this->vitals->patient_id,
            'vitals_id' => $this->vitals->id ?? null,
            'abnormal_vitals' => $this->vitals->getAbnormalVitals(),
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // If abnormal vitals, trigger alert
        if (!empty($this->vitals->getAbnormalVitals())) {
            // Notify clinician
        }
        error_log(json_encode($this->getPayload()));
    }
}

