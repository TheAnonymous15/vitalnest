<?php
/**
 * Lab Service - Lab Workflow Service
 */

namespace LabService\Services;

use LabService\Models\LabOrder;
use LabService\Models\LabResult;
use LabService\Events\LabResultPublished;

class LabWorkflowService
{
    public function getOrders(int $page = 1, ?string $status = null, ?int $patientId = null): array
    {
        return ['data' => [], 'meta' => ['current_page' => $page, 'total' => 0]];
    }

    public function getOrderById(int $id): ?LabOrder
    {
        return null;
    }

    public function createOrder(array $data): LabOrder
    {
        $order = new LabOrder();
        $order->id = rand(1000, 9999);
        $order->order_number = $this->generateOrderNumber();
        $order->patient_id = $data['patient_id'];
        $order->ordered_by = $data['ordered_by'];
        $order->test_type = $data['test_type'];
        $order->priority = $data['priority'] ?? LabOrder::PRIORITY_ROUTINE;
        $order->status = LabOrder::STATUS_PENDING;
        $order->clinical_notes = $data['clinical_notes'] ?? null;
        $order->created_at = date('Y-m-d H:i:s');

        return $order;
    }

    public function updateOrderStatus(int $id, string $status): LabOrder
    {
        $order = $this->getOrderById($id);
        if (!$order) throw new \Exception('Lab order not found');

        $validStatuses = [
            LabOrder::STATUS_PENDING,
            LabOrder::STATUS_SPECIMEN_COLLECTED,
            LabOrder::STATUS_IN_PROGRESS,
            LabOrder::STATUS_COMPLETED,
            LabOrder::STATUS_CANCELLED
        ];

        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        $order->status = $status;
        if ($status === LabOrder::STATUS_COMPLETED) {
            $order->completed_at = date('Y-m-d H:i:s');
        }

        return $order;
    }

    public function submitResults(int $orderId, array $data): LabResult
    {
        $order = $this->getOrderById($orderId);
        if (!$order) throw new \Exception('Lab order not found');

        $result = new LabResult();
        $result->id = rand(1000, 9999);
        $result->lab_order_id = $orderId;
        $result->test_name = $data['test_name'];
        $result->result_value = $data['result_value'];
        $result->unit = $data['unit'] ?? null;
        $result->reference_range = $data['reference_range'] ?? null;
        $result->is_abnormal = $data['is_abnormal'] ?? false;
        $result->interpretation = $data['interpretation'] ?? null;
        $result->performed_by = $data['performed_by'];
        $result->status = LabResult::STATUS_PRELIMINARY;
        $result->performed_at = date('Y-m-d H:i:s');
        $result->created_at = date('Y-m-d H:i:s');

        // Dispatch event
        $event = new LabResultPublished($result);
        $event->dispatch();

        return $result;
    }

    public function getResultsByOrder(int $orderId): array
    {
        return [];
    }

    public function getPendingOrders(): array
    {
        return [];
    }

    private function generateOrderNumber(): string
    {
        return 'LAB' . date('Ymd') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}

