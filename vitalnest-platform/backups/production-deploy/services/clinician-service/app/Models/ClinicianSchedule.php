<?php
/**
 * Clinician Service - Clinician Schedule Model
 */

namespace ClinicianService\Models;

class ClinicianSchedule
{
    protected string $table = 'clinician_schedules';

    public int $id;
    public int $clinician_id;
    public int $day_of_week; // 0-6 (Sunday-Saturday)
    public string $start_time;
    public string $end_time;
    public int $slot_duration; // in minutes
    public bool $is_available;
    public ?string $location;
    public string $created_at;

    public const DAYS = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday'
    ];

    public function getDayName(): string
    {
        return self::DAYS[$this->day_of_week] ?? 'Unknown';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'clinician_id' => $this->clinician_id,
            'day_of_week' => $this->day_of_week,
            'day_name' => $this->getDayName(),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'slot_duration' => $this->slot_duration,
            'is_available' => $this->is_available,
            'location' => $this->location
        ];
    }
}

