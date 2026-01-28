<?php
}
    }
        return ['success' => true, 'data' => ['count' => $count]];
        $count = $this->notificationService->getUnreadCount($userId);
        $userId = $_GET['user_id'] ?? null;
    {
    public function unreadCount(): array

    }
        return ['success' => true, 'data' => $templates];
        $templates = $this->notificationService->getTemplates();
    {
    public function templates(): array

    }
        return ['success' => true, 'message' => 'Preferences updated', 'data' => $preferences];
        $preferences = $this->notificationService->updatePreferences($userId, $data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function updatePreferences(int $userId): array

    }
        return ['success' => true, 'data' => $preferences];
        $preferences = $this->notificationService->getPreferences($userId);
    {
    public function preferences(int $userId): array

    }
        return ['success' => true, 'message' => "{$count} notifications sent"];
        $count = $this->notificationService->sendBulk($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function sendBulk(): array

    }
        return ['success' => true, 'message' => 'Notification deleted'];
        $this->notificationService->delete($id);
    {
    public function delete(int $id): array

    }
        return ['success' => true, 'message' => "{$count} notifications marked as read"];
        $count = $this->notificationService->markAllAsRead($data['user_id']);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function markAllAsRead(): array

    }
        return ['success' => true, 'message' => 'Marked as read', 'data' => $notification];
        $notification = $this->notificationService->markAsRead($id);
    {
    public function markAsRead(int $id): array

    }
        return ['success' => true, 'message' => 'Notification sent', 'data' => $notification];
        http_response_code(201);
        $notification = $this->notificationService->send($data);
        $data = json_decode(file_get_contents('php://input'), true);
    {
    public function send(): array

    }
        return ['success' => true, 'data' => $notification];
        }
            return ['success' => false, 'message' => 'Notification not found'];
            http_response_code(404);
        if (!$notification) {
        $notification = $this->notificationService->findById($id);
    {
    public function show(int $id): array

    }
        return ['success' => true, 'data' => $notifications];
        $notifications = $this->notificationService->getAll($userId, $unreadOnly);
        $unreadOnly = isset($_GET['unread']);
        $userId = $_GET['user_id'] ?? null;
    {
    public function index(): array

    }
        $this->notificationService = new NotificationService();
    {
    public function __construct()

    private NotificationService $notificationService;
{
class NotificationController

use NotificationService\Services\NotificationService;

namespace NotificationService\Controllers;

 */
 * Notification Service - Notification Controller
/**

