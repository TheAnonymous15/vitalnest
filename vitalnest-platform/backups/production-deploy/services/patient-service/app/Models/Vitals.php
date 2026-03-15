<?php
/**
 * Patient Service - Vitals Model
 */

namespace PatientService\Models;

class Vitals
{
    protected string $table = 'patient_vitals';

    protected array $fillable = [
        'patient_id',
        'recorded_by',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'heart_rate',
        'temperature',
        'respiratory_rate',
        'oxygen_saturation',
        'weight',
        'height',
        'bmi',
        'blood_glucose',
        'notes',
        'recorded_at'
    ];

    public int $id;
    public int $patient_id;
    public int $recorded_by;
    public ?int $blood_pressure_systolic;
    public ?int $blood_pressure_diastolic;
    public ?int $heart_rate;
    public ?float $temperature;
    public ?int $respiratory_rate;
    public ?int $oxygen_saturation;
    public ?float $weight;
    public ?float $height;
    public ?float $bmi;
    public ?float $blood_glucose;
    public ?string $notes;
    public string $recorded_at;
    public string $created_at;

    /**
     * Get blood pressure as string
     */
    public function getBloodPressure(): string
    {
        if ($this->blood_pressure_systolic && $this->blood_pressure_diastolic) {
            return "{$this->blood_pressure_systolic}/{$this->blood_pressure_diastolic}";
        }
        return 'N/A';
    }

    /**
     * Calculate BMI if weight and height provided
     */
    public function calculateBmi(): ?float
    {
        if ($this->weight && $this->height) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 2);
        }
        return null;
    }

    /**
     * Check if vitals are in normal range
     */
    public function getAbnormalVitals(): array
    {
        $abnormal = [];

        if ($this->blood_pressure_systolic && ($this->blood_pressure_systolic > 140 || $this->blood_pressure_systolic < 90)) {
            $abnormal[] = 'blood_pressure_systolic';
        }
        if ($this->blood_pressure_diastolic && ($this->blood_pressure_diastolic > 90 || $this->blood_pressure_diastolic < 60)) {
            $abnormal[] = 'blood_pressure_diastolic';
        }
        if ($this->heart_rate && ($this->heart_rate > 100 || $this->heart_rate < 60)) {
            $abnormal[] = 'heart_rate';
        }
        if ($this->temperature && ($this->temperature > 37.5 || $this->temperature < 36.0)) {
            $abnormal[] = 'temperature';
        }
        if ($this->oxygen_saturation && $this->oxygen_saturation < 95) {
            $abnormal[] = 'oxygen_saturation';
        }

        return $abnormal;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'recorded_by' => $this->recorded_by,
            'blood_pressure' => $this->getBloodPressure(),
            'blood_pressure_systolic' => $this->blood_pressure_systolic,
            'blood_pressure_diastolic' => $this->blood_pressure_diastolic,
            'heart_rate' => $this->heart_rate,
            'temperature' => $this->temperature,
            'respiratory_rate' => $this->respiratory_rate,
            'oxygen_saturation' => $this->oxygen_saturation,
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi ?? $this->calculateBmi(),
            'blood_glucose' => $this->blood_glucose,
            'notes' => $this->notes,
            'abnormal_vitals' => $this->getAbnormalVitals(),
            'recorded_at' => $this->recorded_at
        ];
    }
}

