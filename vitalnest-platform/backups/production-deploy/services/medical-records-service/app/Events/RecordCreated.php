<?php

namespace MedicalRecordsService\Events;

use MedicalRecordsService\Models\MedicalRecord;

class RecordCreated
{
    public MedicalRecord $record;
    public string $occurredAt;

    public function __construct(MedicalRecord $record)
    {
        $this->record = $record;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'medical_record.created';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'record_id' => $this->record->id,
            'patient_id' => $this->record->patient_id,
            'record_type' => $this->record->record_type,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // Update patient timeline
        // Notify relevant parties if needed
        error_log(json_encode($this->getPayload()));
    }
}

