<?php
/**
 * Clinician Service - Clinician Model
 */

namespace ClinicianService\Models;

class Clinician
{
    protected string $table = 'clinicians';

    public int $id;
    public int $user_id;
    public string $license_number;
    public string $specialty;
    public ?string $sub_specialty;
    public string $title;
    public ?string $bio;
    public ?int $years_experience;
    public ?array $certifications;
    public ?array $languages;
    public bool $accepting_patients;
    public ?string $consultation_fee;
    public string $status;
    public string $created_at;
    public string $updated_at;

    public const SPECIALTIES = [
        'general_practice' => 'General Practice',
        'internal_medicine' => 'Internal Medicine',
        'pediatrics' => 'Pediatrics',
        'cardiology' => 'Cardiology',
        'dermatology' => 'Dermatology',
        'neurology' => 'Neurology',
        'psychiatry' => 'Psychiatry',
        'orthopedics' => 'Orthopedics',
        'geriatrics' => 'Geriatrics',
        'home_health' => 'Home Health',
    ];

    public function isAcceptingPatients(): bool
    {
        return $this->accepting_patients && $this->status === 'active';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'license_number' => $this->license_number,
            'specialty' => $this->specialty,
            'specialty_name' => self::SPECIALTIES[$this->specialty] ?? $this->specialty,
            'sub_specialty' => $this->sub_specialty,
            'title' => $this->title,
            'bio' => $this->bio,
            'years_experience' => $this->years_experience,
            'certifications' => $this->certifications,
            'languages' => $this->languages,
            'accepting_patients' => $this->accepting_patients,
            'consultation_fee' => $this->consultation_fee,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}

