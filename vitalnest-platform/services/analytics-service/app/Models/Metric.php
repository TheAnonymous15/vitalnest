<?php
/**
 * Analytics Service - Metric Model
 */

namespace AnalyticsService\Models;

class Metric
{
    protected string $table = 'metrics';

    public int $id;
    public string $name;
    public string $type;
    public float $value;
    public ?array $dimensions;
    public string $period;
    public string $recorded_at;

    public const TYPE_COUNTER = 'counter';
    public const TYPE_GAUGE = 'gauge';
    public const TYPE_HISTOGRAM = 'histogram';

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'dimensions' => $this->dimensions,
            'period' => $this->period,
            'recorded_at' => $this->recorded_at
        ];
    }
}

