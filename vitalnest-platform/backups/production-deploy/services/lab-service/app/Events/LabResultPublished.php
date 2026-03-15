<?php
/**
 * Lab Service - Lab Result Published Event
 */

namespace LabService\Events;

use LabService\Models\LabResult;

class LabResultPublished
{
    public LabResult $result;
    public string $occurredAt;

    public function __construct(LabResult $result)
    {
        $this->result = $result;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'lab.result_published';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'lab_order_id' => $this->result->lab_order_id,
            'result_id' => $this->result->id,
            'test_name' => $this->result->test_name,
            'is_abnormal' => $this->result->is_abnormal,
            'status' => $this->result->status,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        // Notify ordering clinician
        // Update medical records
        // Alert if abnormal
        if ($this->result->is_abnormal) {
            // Trigger urgent notification
        }
        error_log(json_encode($this->getPayload()));
    }
}

