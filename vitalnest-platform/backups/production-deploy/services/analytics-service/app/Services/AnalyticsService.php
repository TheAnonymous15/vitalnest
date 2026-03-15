<?php
/**
 * Analytics Service - Analytics Service
 */

namespace AnalyticsService\Services;

class AnalyticsService
{
    public function getDashboardMetrics(string $period): array
    {
        return [
            'total_patients' => $this->randomMetric(500, 1000),
            'active_patients' => $this->randomMetric(300, 600),
            'appointments_today' => $this->randomMetric(20, 50),
            'appointments_this_week' => $this->randomMetric(100, 200),
            'pending_lab_orders' => $this->randomMetric(10, 30),
            'clinicians_online' => $this->randomMetric(5, 15),
            'period' => $period,
            'generated_at' => date('Y-m-d H:i:s')
        ];
    }

    public function getPatientAnalytics(string $period): array
    {
        return [
            'total' => $this->randomMetric(500, 1000),
            'new_this_period' => $this->randomMetric(20, 50),
            'by_gender' => [
                'male' => $this->randomMetric(200, 400),
                'female' => $this->randomMetric(200, 400),
                'other' => $this->randomMetric(10, 30)
            ],
            'by_age_group' => [
                '0-18' => $this->randomMetric(50, 100),
                '19-35' => $this->randomMetric(100, 200),
                '36-55' => $this->randomMetric(150, 250),
                '56-70' => $this->randomMetric(100, 200),
                '70+' => $this->randomMetric(100, 150)
            ],
            'retention_rate' => round(rand(70, 95) + rand(0, 99) / 100, 2),
            'average_visits_per_patient' => round(rand(2, 5) + rand(0, 99) / 100, 2)
        ];
    }

    public function getAppointmentAnalytics(string $period, ?int $clinicianId): array
    {
        return [
            'total' => $this->randomMetric(500, 1000),
            'completed' => $this->randomMetric(400, 800),
            'cancelled' => $this->randomMetric(20, 50),
            'no_show' => $this->randomMetric(10, 30),
            'by_type' => [
                'home_visit' => $this->randomMetric(200, 400),
                'video_call' => $this->randomMetric(150, 300),
                'phone_call' => $this->randomMetric(50, 100),
                'in_clinic' => $this->randomMetric(100, 200)
            ],
            'average_duration' => rand(25, 45),
            'busiest_day' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'][rand(0, 4)],
            'busiest_hour' => rand(9, 16) . ':00'
        ];
    }

    public function getClinicianAnalytics(string $period): array
    {
        return [
            'total_clinicians' => $this->randomMetric(20, 50),
            'active_clinicians' => $this->randomMetric(15, 40),
            'by_specialty' => [
                'general_practice' => $this->randomMetric(5, 15),
                'internal_medicine' => $this->randomMetric(3, 10),
                'geriatrics' => $this->randomMetric(2, 8),
                'home_health' => $this->randomMetric(5, 12)
            ],
            'average_patients_per_clinician' => rand(20, 40),
            'average_appointments_per_day' => round(rand(5, 10) + rand(0, 99) / 100, 2)
        ];
    }

    public function getLabAnalytics(string $period): array
    {
        return [
            'total_orders' => $this->randomMetric(200, 500),
            'completed' => $this->randomMetric(150, 400),
            'pending' => $this->randomMetric(30, 80),
            'average_turnaround_hours' => rand(12, 48),
            'by_test_type' => [
                'blood_panel' => $this->randomMetric(50, 150),
                'metabolic_panel' => $this->randomMetric(40, 100),
                'lipid_panel' => $this->randomMetric(30, 80),
                'urinalysis' => $this->randomMetric(20, 60)
            ],
            'abnormal_results_rate' => round(rand(5, 20) + rand(0, 99) / 100, 2)
        ];
    }

    public function getVitalsAnalytics(?int $patientId, string $period): array
    {
        return [
            'records_count' => $this->randomMetric(50, 200),
            'averages' => [
                'blood_pressure_systolic' => rand(110, 130),
                'blood_pressure_diastolic' => rand(70, 85),
                'heart_rate' => rand(65, 85),
                'temperature' => round(36.5 + rand(0, 10) / 10, 1),
                'oxygen_saturation' => rand(95, 99)
            ],
            'trends' => [
                'blood_pressure' => ['stable', 'improving', 'declining'][rand(0, 2)],
                'heart_rate' => ['stable', 'improving', 'declining'][rand(0, 2)]
            ],
            'alerts_count' => $this->randomMetric(0, 10)
        ];
    }

    public function getTrends(string $metric, string $period): array
    {
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($months as $month) {
            $data[] = [
                'period' => $month,
                'value' => $this->randomMetric(100, 500)
            ];
        }

        return [
            'metric' => $metric,
            'period' => $period,
            'data' => $data
        ];
    }

    public function getRealtimeMetrics(): array
    {
        return [
            'active_users' => $this->randomMetric(10, 50),
            'active_appointments' => $this->randomMetric(5, 20),
            'pending_notifications' => $this->randomMetric(0, 10),
            'system_health' => 'healthy',
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }

    private function randomMetric(int $min, int $max): int
    {
        return rand($min, $max);
    }
}

