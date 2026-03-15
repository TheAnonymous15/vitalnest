<?php
}
    }
        return ['success' => true, 'data' => $appointments];
        $appointments = $this->appointmentService->getToday($clinicianId);
        $clinicianId = $_GET['clinician_id'] ?? null;
    {
    public function today(): array

    }
        return ['success' => true, 'data' => $appointments];
        $appointments = $this->appointmentService->getUpcoming();
    {
    public function upcoming(): array

    }
        return ['success' => true, 'message' => 'Appointment completed', 'data' => $appointment];
        $appointment = $this->appointmentService->complete($id, $data['notes'] ?? null);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function complete(int $id): array

    }
        return ['success' => true, 'message' => 'Appointment confirmed', 'data' => $appointment];
        $appointment = $this->appointmentService->confirm($id);
    {
    public function confirm(int $id): array

    }
        return ['success' => true, 'message' => 'Appointment rescheduled', 'data' => $appointment];
        $appointment = $this->appointmentService->reschedule($id, $data['scheduled_at']);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function reschedule(int $id): array

    }
        return ['success' => true, 'message' => 'Appointment cancelled', 'data' => $appointment];
        $appointment = $this->appointmentService->cancel($id, $data['reason'] ?? null);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function cancel(int $id): array

    }
        return ['success' => true, 'message' => 'Appointment updated', 'data' => $appointment];
        $appointment = $this->appointmentService->update($id, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function update(int $id): array

    }
        return ['success' => true, 'message' => 'Appointment scheduled', 'data' => $appointment];
        http_response_code(201);
        $appointment = $this->appointmentService->create($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function store(): array

    }
        return ['success' => true, 'data' => $appointment];
        }
            return ['success' => false, 'message' => 'Appointment not found'];
            http_response_code(404);
        if (!$appointment) {
        $appointment = $this->appointmentService->findById($id);
    {
    public function show(int $id): array

    }
        return ['success' => true, 'data' => $appointments];
        $appointments = $this->appointmentService->getAll($page, $patientId, $clinicianId, $status, $date);

        $date = $_GET['date'] ?? null;
        $status = $_GET['status'] ?? null;
        $clinicianId = $_GET['clinician_id'] ?? null;
        $patientId = $_GET['patient_id'] ?? null;
        $page = $_GET['page'] ?? 1;
    {
    public function index(): array

    }
        $this->appointmentService = new AppointmentService();
    {
    public function __construct()

    private AppointmentService $appointmentService;
{
class AppointmentController

use SchedulingService\Services\AppointmentService;

namespace SchedulingService\Controllers;

 */
 * Scheduling Service - Appointment Controller
/**

