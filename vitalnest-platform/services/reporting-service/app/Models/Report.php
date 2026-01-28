<?php
/**
 * Reporting Service - Report Model
 */

namespace ReportingService\Models;

class Report
{
    protected string $table = 'reports';

    public int $id;
    public string $report_number;
    public string $title;
    public string $type;
    public ?string $description;
    public array $parameters;
    public ?array $data;
    public string $status;
    public ?string $file_path;
    public ?string $file_format;
    public int $generated_by;
    public ?string $generated_at;
    public string $created_at;

    public const TYPE_PATIENT_SUMMARY = 'patient_summary';
    public const TYPE_CLINICIAN_PERFORMANCE = 'clinician_performance';
    public const TYPE_LAB_SUMMARY = 'lab_summary';
    public const TYPE_FINANCIAL = 'financial';
    public const TYPE_OPERATIONAL = 'operational';
    public const TYPE_COMPLIANCE = 'compliance';
    public const TYPE_CUSTOM = 'custom';

    public const STATUS_PENDING = 'pending';
    public const STATUS_GENERATING = 'generating';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'report_number' => $this->report_number,
            'title' => $this->title,
            'type' => $this->type,
            'description' => $this->description,
            'parameters' => $this->parameters,
            'status' => $this->status,
            'file_path' => $this->file_path,
            'file_format' => $this->file_format,
            'generated_by' => $this->generated_by,
            'generated_at' => $this->generated_at,
            'created_at' => $this->created_at
        ];
    }
}

