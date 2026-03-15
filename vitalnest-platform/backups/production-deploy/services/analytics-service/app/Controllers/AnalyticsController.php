<?php
}
    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getRealtimeMetrics();
    {
    public function realtime(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getTrends($metric, $period);
        $period = $_GET['period'] ?? '12m';
        $metric = $_GET['metric'] ?? 'patients';
    {
    public function trends(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getVitalsAnalytics($patientId, $period);
        $period = $_GET['period'] ?? '90d';
        $patientId = $_GET['patient_id'] ?? null;
    {
    public function vitals(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getLabAnalytics($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function lab(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getClinicianAnalytics($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function clinicians(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getAppointmentAnalytics($period, $clinicianId);
        $clinicianId = $_GET['clinician_id'] ?? null;
        $period = $_GET['period'] ?? '30d';
    {
    public function appointments(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getPatientAnalytics($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function patients(): array

    }
        return ['success' => true, 'data' => $data];
        $data = $this->analyticsService->getDashboardMetrics($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function dashboard(): array

    }
        $this->analyticsService = new AnalyticsService();
    {
    public function __construct()

    private AnalyticsService $analyticsService;
{
class AnalyticsController

use AnalyticsService\Services\AnalyticsService;

namespace AnalyticsService\Controllers;

 */
 * Analytics Service - Analytics Controller
/**

