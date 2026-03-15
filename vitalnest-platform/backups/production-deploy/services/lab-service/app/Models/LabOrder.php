<?php
/**
 * Lab Service - Lab Order Model
 */

namespace LabService\Models;

class LabOrder
{
    protected string $table = 'lab_orders';

    public int $id;
    public int $patient_id;
    public int $ordered_by;
    public ?int $assigned_to;
    public string $order_number;
    public string $test_type;
    public string $priority;
    public string $status;
    public ?string $clinical_notes;
    public ?string $specimen_type;
    public ?string $specimen_collected_at;
    public ?string $scheduled_at;
    public ?string $completed_at;
    public string $created_at;
    public string $updated_at;

    public const STATUS_PENDING = 'pending';
    public const STATUS_SPECIMEN_COLLECTED = 'specimen_collected';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public const PRIORITY_ROUTINE = 'routine';
    public const PRIORITY_URGENT = 'urgent';
    public const PRIORITY_STAT = 'stat';

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isUrgent(): bool
    {
        return in_array($this->priority, [self::PRIORITY_URGENT, self::PRIORITY_STAT]);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'patient_id' => $this->patient_id,
            'ordered_by' => $this->ordered_by,
            'assigned_to' => $this->assigned_to,
            'test_type' => $this->test_type,
            'priority' => $this->priority,
            'status' => $this->status,
            'clinical_notes' => $this->clinical_notes,
            'specimen_type' => $this->specimen_type,
            'specimen_collected_at' => $this->specimen_collected_at,
            'scheduled_at' => $this->scheduled_at,
            'completed_at' => $this->completed_at,
            'is_urgent' => $this->isUrgent(),
            'created_at' => $this->created_at
        ];
    }
}

