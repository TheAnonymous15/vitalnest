<?php
/**
 * Medical Records Service - Medication Model
 */

namespace MedicalRecordsService\Models;

class Medication
{
    protected string $table = 'medications';

    public int $id;
    public int $patient_id;
    public int $prescribed_by;
    public string $name;
    public string $dosage;
    public string $frequency;
    public ?string $route;
    public ?string $instructions;
    public string $start_date;
    public ?string $end_date;
    public string $status;
    public ?string $reason;
    public ?string $pharmacy;
    public int $refills_remaining;
    public string $created_at;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_DISCONTINUED = 'discontinued';
    public const STATUS_ON_HOLD = 'on_hold';

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'prescribed_by' => $this->prescribed_by,
            'name' => $this->name,
            'dosage' => $this->dosage,
            'frequency' => $this->frequency,
            'route' => $this->route,
            'instructions' => $this->instructions,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'reason' => $this->reason,
            'pharmacy' => $this->pharmacy,
            'refills_remaining' => $this->refills_remaining,
            'is_active' => $this->isActive(),
            'created_at' => $this->created_at
        ];
    }
}

