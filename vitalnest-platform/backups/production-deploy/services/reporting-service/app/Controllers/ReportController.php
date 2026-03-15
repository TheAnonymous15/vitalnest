<?php
}
    }
        return ['success' => true, 'data' => $templates];
        $templates = $this->reportService->getTemplates();
    {
    public function templates(): array

    }
        return ['success' => true, 'message' => 'Report scheduled', 'data' => $schedule];
        $schedule = $this->reportService->scheduleReport($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function schedule(): array

    }
        return ['success' => true, 'data' => ['download_url' => $url]];
        $url = $this->reportService->getDownloadUrl($id, $format);
        $format = $_GET['format'] ?? 'pdf';
    {
    public function download(int $id): array

    }
        return ['success' => true, 'data' => $report];
        $report = $this->reportService->generateFinancialReport($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function financialReport(): array

    }
        return ['success' => true, 'data' => $report];
        $report = $this->reportService->generateLabReport($period);
        $period = $_GET['period'] ?? '30d';
    {
    public function labReport(): array

    }
        return ['success' => true, 'data' => $report];
        $report = $this->reportService->generateClinicianReport($clinicianId, $period);
        $period = $_GET['period'] ?? '30d';
    {
    public function clinicianReport(int $clinicianId): array

    }
        return ['success' => true, 'data' => $report];
        $report = $this->reportService->generatePatientReport($patientId, $type);
        $type = $_GET['type'] ?? 'summary';
    {
    public function patientReport(int $patientId): array

    }
        return ['success' => true, 'message' => 'Report generated', 'data' => $report];
        http_response_code(201);
        $report = $this->reportService->generate($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function generate(): array

    }
        return ['success' => true, 'data' => $report];
        }
            return ['success' => false, 'message' => 'Report not found'];
            http_response_code(404);
        if (!$report) {
        $report = $this->reportService->findById($id);
    {
    public function show(int $id): array

    }
        return ['success' => true, 'data' => $reports];
        $reports = $this->reportService->getAll($page, $type);
        $type = $_GET['type'] ?? null;
        $page = $_GET['page'] ?? 1;
    {
    public function index(): array

    }
        $this->reportService = new ReportGeneratorService();
    {
    public function __construct()

    private ReportGeneratorService $reportService;
{
class ReportController

use ReportingService\Services\ReportGeneratorService;

namespace ReportingService\Controllers;

 */
 * Reporting Service - Report Controller
/**

