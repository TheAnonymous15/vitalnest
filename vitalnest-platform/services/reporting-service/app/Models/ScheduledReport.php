<?php
/**
 * Reporting Service - Scheduled Report Model
 */

namespace ReportingService\Models;

class ScheduledReport
{
    protected string $table = 'scheduled_reports';

    public int $id;
    public string $name;
    public string $report_type;
    public array $parameters;
    public string $schedule; // cron expression
    public ?array $recipients;
    public string $format;
    public bool $is_active;
    public ?string $last_run_at;
    public ?string $next_run_at;
    public int $created_by;
    public string $created_at;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'report_type' => $this->report_type,
            'parameters' => $this->parameters,
            'schedule' => $this->schedule,
            'recipients' => $this->recipients,
            'format' => $this->format,
            'is_active' => $this->is_active,
            'last_run_at' => $this->last_run_at,
            'next_run_at' => $this->next_run_at,
            'created_at' => $this->created_at
        ];
    }
}

