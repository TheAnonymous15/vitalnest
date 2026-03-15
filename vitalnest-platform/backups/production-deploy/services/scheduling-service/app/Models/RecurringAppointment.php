<?php
/**
 * Scheduling Service - Recurring Appointment Model
 */

namespace SchedulingService\Models;

class RecurringAppointment
{
    protected string $table = 'recurring_appointments';

    public int $id;
    public int $patient_id;
    public int $clinician_id;
    public string $type;
    public string $recurrence_pattern; // daily, weekly, biweekly, monthly
    public int $day_of_week; // for weekly
    public ?int $day_of_month; // for monthly
    public string $start_time;
    public int $duration;
    public ?string $location;
    public string $start_date;
    public ?string $end_date;
    public bool $is_active;
    public string $created_at;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'clinician_id' => $this->clinician_id,
            'type' => $this->type,
            'recurrence_pattern' => $this->recurrence_pattern,
            'day_of_week' => $this->day_of_week,
            'day_of_month' => $this->day_of_month,
            'start_time' => $this->start_time,
            'duration' => $this->duration,
            'location' => $this->location,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active
        ];
    }
}

