<?php

namespace ReportingService\Events;

use ReportingService\Models\Report;

class ReportGenerated
{
    public Report $report;
    public string $occurredAt;

    public function __construct(Report $report)
    {
        $this->report = $report;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'report.generated';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'report_id' => $this->report->id,
            'report_number' => $this->report->report_number,
            'type' => $this->report->type,
            'status' => $this->report->status,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        error_log(json_encode($this->getPayload()));
    }
}

