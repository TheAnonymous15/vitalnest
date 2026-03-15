<?php

namespace ClinicianService\Events;

use ClinicianService\Models\Clinician;

class ClinicianRegistered
{
    public Clinician $clinician;
    public string $occurredAt;

    public function __construct(Clinician $clinician)
    {
        $this->clinician = $clinician;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'clinician.registered';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'clinician_id' => $this->clinician->id,
            'specialty' => $this->clinician->specialty,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // Trigger license verification workflow
        // Notify admin for approval
        error_log(json_encode($this->getPayload()));
    }
}

