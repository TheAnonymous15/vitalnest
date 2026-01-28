<?php
/**
 * Medical Records Service - Medical Record Model
 */

namespace MedicalRecordsService\Models;

class MedicalRecord
{
    protected string $table = 'medical_records';

    public int $id;
    public int $patient_id;
    public int $clinician_id;
    public ?int $appointment_id;
    public string $record_type;
    public string $title;
    public ?string $description;
    public ?array $data;
    public ?string $icd_code;
    public bool $is_confidential;
    public string $created_at;
    public string $updated_at;

    public const TYPE_CLINICAL_NOTE = 'clinical_note';
    public const TYPE_DIAGNOSIS = 'diagnosis';
    public const TYPE_PROCEDURE = 'procedure';
    public const TYPE_PRESCRIPTION = 'prescription';
    public const TYPE_LAB_RESULT = 'lab_result';
    public const TYPE_IMAGING = 'imaging';
    public const TYPE_REFERRAL = 'referral';
    public const TYPE_ASSESSMENT = 'assessment';

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'clinician_id' => $this->clinician_id,
            'appointment_id' => $this->appointment_id,
            'record_type' => $this->record_type,
            'title' => $this->title,
            'description' => $this->description,
            'data' => $this->data,
            'icd_code' => $this->icd_code,
            'is_confidential' => $this->is_confidential,
            'created_at' => $this->created_at
        ];
    }
}

