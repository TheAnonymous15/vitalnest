<?php
/**
 * Lab Service - Lab Result Model
 */

namespace LabService\Models;

class LabResult
{
    protected string $table = 'lab_results';

    public int $id;
    public int $lab_order_id;
    public int $performed_by;
    public ?int $verified_by;
    public string $test_name;
    public string $result_value;
    public ?string $unit;
    public ?string $reference_range;
    public string $status;
    public bool $is_abnormal;
    public ?string $interpretation;
    public ?string $notes;
    public ?string $verified_at;
    public string $performed_at;
    public string $created_at;

    public const STATUS_PRELIMINARY = 'preliminary';
    public const STATUS_FINAL = 'final';
    public const STATUS_CORRECTED = 'corrected';

    public function isPreliminary(): bool
    {
        return $this->status === self::STATUS_PRELIMINARY;
    }

    public function isFinal(): bool
    {
        return $this->status === self::STATUS_FINAL;
    }

    public function isVerified(): bool
    {
        return $this->verified_by !== null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'lab_order_id' => $this->lab_order_id,
            'test_name' => $this->test_name,
            'result_value' => $this->result_value,
            'unit' => $this->unit,
            'reference_range' => $this->reference_range,
            'status' => $this->status,
            'is_abnormal' => $this->is_abnormal,
            'interpretation' => $this->interpretation,
            'notes' => $this->notes,
            'performed_by' => $this->performed_by,
            'verified_by' => $this->verified_by,
            'verified_at' => $this->verified_at,
            'performed_at' => $this->performed_at
        ];
    }
}

