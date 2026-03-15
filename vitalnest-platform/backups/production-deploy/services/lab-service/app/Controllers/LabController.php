<?php
}
    }
        return ['success' => true, 'data' => $orders];

        $orders = $this->labService->getPendingOrders();
    {
    public function pending(): array
     */
     * Get pending orders for lab
    /**

    }
        return ['success' => true, 'data' => $results];

        $results = $this->labService->getResultsByOrder($orderId);
    {
    public function getResults(int $orderId): array
     */
     * Get results for an order
    /**

    }
        return ['success' => true, 'message' => 'Results submitted', 'data' => $result];

        $result = $this->labService->submitResults($orderId, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function submitResults(int $orderId): array
     */
     * Submit lab results
    /**

    }
        return ['success' => true, 'message' => 'Status updated', 'data' => $order];

        $order = $this->labService->updateOrderStatus($id, $data['status']);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function updateStatus(int $id): array
     */
     * Update lab order status
    /**

    }
        return ['success' => true, 'message' => 'Lab order created', 'data' => $order];
        http_response_code(201);

        $order = $this->labService->createOrder($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function store(): array
     */
     * Create new lab order
    /**

    }
        return ['success' => true, 'data' => $order];

        }
            return ['success' => false, 'message' => 'Lab order not found'];
            http_response_code(404);
        if (!$order) {

        $order = $this->labService->getOrderById($id);
    {
    public function show(int $id): array
     */
     * Get single lab order
    /**

    }
        return ['success' => true, 'data' => $orders];

        $orders = $this->labService->getOrders($page, $status, $patientId);

        $patientId = $_GET['patient_id'] ?? null;
        $status = $_GET['status'] ?? null;
        $page = $_GET['page'] ?? 1;
    {
    public function index(): array
     */
     * List all lab orders
    /**

    }
        $this->labService = new LabWorkflowService();
    {
    public function __construct()

    private LabWorkflowService $labService;
{
class LabController

use LabService\Models\LabResult;
use LabService\Models\LabOrder;
use LabService\Services\LabWorkflowService;

namespace LabService\Controllers;

 */
 * Lab Service - Lab Controller
/**

