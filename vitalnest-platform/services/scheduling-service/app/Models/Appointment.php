<?php
/**
 * Scheduling Service - Appointment Model
 */

namespace SchedulingService\Models;

class Appointment
{
    protected string $table = 'appointments';

    public int $id;
    public int $patient_id;
    public int $clinician_id;
    public ?int $caregiver_id;
    public string $appointment_number;
    public string $type;
    public string $status;
    public string $scheduled_at;
    public int $duration; // minutes
    public ?string $location;
    public ?string $notes;
    public ?string $reason;
    public ?string $cancellation_reason;
    public ?string $confirmed_at;
    public ?string $started_at;
    public ?string $completed_at;
    public string $created_at;
    public string $updated_at;

    public const TYPE_HOME_VISIT = 'home_visit';
    public const TYPE_VIDEO_CALL = 'video_call';
    public const TYPE_PHONE_CALL = 'phone_call';
    public const TYPE_IN_CLINIC = 'in_clinic';

    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_NO_SHOW = 'no_show';

    public function isUpcoming(): bool
    {
        return strtotime($this->scheduled_at) > time() &&
               in_array($this->status, [self::STATUS_SCHEDULED, self::STATUS_CONFIRMED]);
    }

    public function canCancel(): bool
    {
        return in_array($this->status, [self::STATUS_SCHEDULED, self::STATUS_CONFIRMED]);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'appointment_number' => $this->appointment_number,
            'patient_id' => $this->patient_id,
            'clinician_id' => $this->clinician_id,
            'caregiver_id' => $this->caregiver_id,
            'type' => $this->type,
            'status' => $this->status,
            'scheduled_at' => $this->scheduled_at,
            'duration' => $this->duration,
            'location' => $this->location,
            'notes' => $this->notes,
            'reason' => $this->reason,
            'is_upcoming' => $this->isUpcoming(),
            'can_cancel' => $this->canCancel(),
            'confirmed_at' => $this->confirmed_at,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at
        ];
    }
}

