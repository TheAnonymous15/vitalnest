<?php
/**
 * Patient Service - Patient Model
 */

namespace PatientService\Models;

class Patient
{
    protected string $table = 'patients';

    protected array $fillable = [
        'user_id',
        'medical_record_number',
        'date_of_birth',
        'gender',
        'blood_type',
        'allergies',
        'emergency_contact_name',
        'emergency_contact_phone',
        'insurance_provider',
        'insurance_policy_number',
        'primary_physician_id',
        'address',
        'city',
        'state',
        'zip_code',
        'notes'
    ];

    public int $id;
    public int $user_id;
    public string $medical_record_number;
    public string $date_of_birth;
    public string $gender;
    public ?string $blood_type;
    public ?array $allergies;
    public ?string $emergency_contact_name;
    public ?string $emergency_contact_phone;
    public ?string $insurance_provider;
    public ?string $insurance_policy_number;
    public ?int $primary_physician_id;
    public ?string $address;
    public ?string $city;
    public ?string $state;
    public ?string $zip_code;
    public ?string $notes;
    public string $created_at;
    public string $updated_at;

    /**
     * Calculate age
     */
    public function getAge(): int
    {
        $dob = new \DateTime($this->date_of_birth);
        $now = new \DateTime();
        return $now->diff($dob)->y;
    }

    /**
     * Check if patient has allergies
     */
    public function hasAllergies(): bool
    {
        return !empty($this->allergies);
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'medical_record_number' => $this->medical_record_number,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->getAge(),
            'gender' => $this->gender,
            'blood_type' => $this->blood_type,
            'allergies' => $this->allergies,
            'emergency_contact' => [
                'name' => $this->emergency_contact_name,
                'phone' => $this->emergency_contact_phone
            ],
            'insurance' => [
                'provider' => $this->insurance_provider,
                'policy_number' => $this->insurance_policy_number
            ],
            'address' => [
                'street' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code
            ],
            'primary_physician_id' => $this->primary_physician_id,
            'notes' => $this->notes,
            'created_at' => $this->created_at
        ];
    }
}

