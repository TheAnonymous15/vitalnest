<?php

namespace AnalyticsService\Events;

class MetricRecorded
{
    public string $metricName;
    public float $value;
    public array $dimensions;
    public string $occurredAt;

    public function __construct(string $metricName, float $value, array $dimensions = [])
    {
        $this->metricName = $metricName;
        $this->value = $value;
        $this->dimensions = $dimensions;
        $this->occurredAt = date('Y-m-d H:i:s');
    }

    public function getName(): string
    {
        return 'metric.recorded';
    }

    public function getPayload(): array
    {
        return [
            'event' => $this->getName(),
            'metric_name' => $this->metricName,
            'value' => $this->value,
            'dimensions' => $this->dimensions,
            'occurred_at' => $this->occurredAt
        ];
    }

    public function dispatch(): void
    {
        error_log(json_encode($this->getPayload()));
    }
}

