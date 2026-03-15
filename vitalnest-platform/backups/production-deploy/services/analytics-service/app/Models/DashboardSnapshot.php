<?php
/**
 * Analytics Service - Dashboard Snapshot Model
 */

namespace AnalyticsService\Models;

class DashboardSnapshot
{
    protected string $table = 'dashboard_snapshots';

    public int $id;
    public string $snapshot_type;
    public array $data;
    public string $period;
    public string $created_at;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'snapshot_type' => $this->snapshot_type,
            'data' => $this->data,
            'period' => $this->period,
            'created_at' => $this->created_at
        ];
    }
}

