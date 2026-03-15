<?php

namespace NotificationService\Controllers;

class MessageController
{
    private $db;

    public function __construct()
    {
        // Set timezone to East Africa Time (EAT - UTC+3)
        date_default_timezone_set('Africa/Nairobi');

        // Use absolute path to the database
        $dbPath = realpath(__DIR__ . '/../../../../database/vitalnest_notifications.db');

        if (!$dbPath || !file_exists($dbPath)) {
            throw new \Exception('Database file not found at expected location');
        }

        $this->db = new \SQLite3($dbPath);
        $this->db->busyTimeout(5000);
    }

    /**
     * Receive and save contact message
     */
    public function receive(): array
    {
        try {
            $input = json_decode(file_get_contents('php://input'), true);

            // Validate required fields
            $required = ['name', 'email', 'message'];
            $missing = [];

            foreach ($required as $field) {
                if (empty($input[$field])) {
                    $missing[] = $field;
                }
            }

            if (!empty($missing)) {
                http_response_code(400);
                return [
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missing)
                ];
            }

            // Validate email format
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                return [
                    'success' => false,
                    'message' => 'Invalid email address'
                ];
            }

            // Sanitize inputs
            $name = htmlspecialchars(trim($input['name']), ENT_QUOTES, 'UTF-8');
            $email = filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL);
            $phone = isset($input['phone']) ? htmlspecialchars(trim($input['phone']), ENT_QUOTES, 'UTF-8') : null;
            $subject = isset($input['subject']) ? htmlspecialchars(trim($input['subject']), ENT_QUOTES, 'UTF-8') : 'General Inquiry';
            $message = htmlspecialchars(trim($input['message']), ENT_QUOTES, 'UTF-8');

            // Get priority from user input or determine from content
            if (isset($input['priority']) && in_array($input['priority'], ['normal', 'medium', 'high'])) {
                // Use user-selected priority
                $priority = $input['priority'];
            } else {
                // Fallback: determine priority based on subject and message content
                $priority = 'normal';
                $combinedText = strtolower($subject . ' ' . $message);

                if (stripos($combinedText, 'emergency') !== false || stripos($combinedText, 'urgent') !== false) {
                    $priority = 'high';
                } elseif (stripos($combinedText, 'booking') !== false || stripos($combinedText, 'appointment') !== false) {
                    $priority = 'medium';
                }
            }

            // Insert into messages table
            $stmt = $this->db->prepare('
                INSERT INTO messages (
                    sender_name,
                    sender_email,
                    sender_phone,
                    subject,
                    message,
                    priority,
                    status,
                    created_at
                ) VALUES (
                    :name,
                    :email,
                    :phone,
                    :subject,
                    :message,
                    :priority,
                    "unread",
                    datetime("now", "+3 hours")
                )
            ');

            $stmt->bindValue(':name', $name, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
            $stmt->bindValue(':subject', $subject, SQLITE3_TEXT);
            $stmt->bindValue(':message', $message, SQLITE3_TEXT);
            $stmt->bindValue(':priority', $priority, SQLITE3_TEXT);

            $result = $stmt->execute();

            if (!$result) {
                throw new \Exception('Failed to save message to database');
            }

            $messageId = $this->db->lastInsertRowID();

            // Success response
            http_response_code(201);
            return [
                'success' => true,
                'message' => 'Thank you for contacting us! Your message has been received and our team will respond within 24 hours.',
                'data' => [
                    'message_id' => $messageId,
                    'priority' => $priority,
                    'sender_name' => $name,
                    'sender_email' => $email,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ];

        } catch (\Exception $e) {
            http_response_code(500);
            return [
                'success' => false,
                'message' => 'Failed to save message. Please try again.',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get all messages (for admin)
     */
    public function index(): array
    {
        try {
            $status = $_GET['status'] ?? null;
            $limit = $_GET['limit'] ?? 50;
            $offset = $_GET['offset'] ?? 0;

            $query = 'SELECT * FROM messages';
            $conditions = [];

            if ($status) {
                $conditions[] = "status = '" . $this->db->escapeString($status) . "'";
            }

            if (!empty($conditions)) {
                $query .= ' WHERE ' . implode(' AND ', $conditions);
            }

            $query .= ' ORDER BY created_at DESC LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;

            $result = $this->db->query($query);
            $messages = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $messages[] = $row;
            }

            return [
                'success' => true,
                'data' => $messages,
                'count' => count($messages)
            ];

        } catch (\Exception $e) {
            http_response_code(500);
            return [
                'success' => false,
                'message' => 'Failed to retrieve messages',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Handle custom plan requests
     */
    public function customPlan(): array
    {
        try {
            $input = json_decode(file_get_contents('php://input'), true);

            // Validate required fields
            $required = ['sender_name', 'sender_phone', 'message'];
            $missing = [];

            foreach ($required as $field) {
                if (empty($input[$field])) {
                    $missing[] = $field;
                }
            }

            if (!empty($missing)) {
                http_response_code(400);
                return [
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missing)
                ];
            }

            // Validate email if provided
            if (!empty($input['sender_email']) && !filter_var($input['sender_email'], FILTER_VALIDATE_EMAIL)) {
                http_response_code(400);
                return [
                    'success' => false,
                    'message' => 'Invalid email address'
                ];
            }

            // Sanitize inputs
            $name = htmlspecialchars(trim($input['sender_name']), ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars(trim($input['sender_phone']), ENT_QUOTES, 'UTF-8');
            $email = !empty($input['sender_email']) ? filter_var(trim($input['sender_email']), FILTER_SANITIZE_EMAIL) : null;
            $message = htmlspecialchars(trim($input['message']), ENT_QUOTES, 'UTF-8');

            // Insert into custom_plans table
            $stmt = $this->db->prepare('
                INSERT INTO custom_plans (
                    sender_name,
                    sender_phone,
                    sender_email,
                    message,
                    priority,
                    status,
                    created_at
                ) VALUES (
                    :name,
                    :phone,
                    :email,
                    :message,
                    "normal",
                    "pending",
                    datetime("now", "+3 hours")
                )
            ');

            $stmt->bindValue(':name', $name, SQLITE3_TEXT);
            $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':message', $message, SQLITE3_TEXT);

            $result = $stmt->execute();

            if (!$result) {
                throw new \Exception('Failed to save custom plan request');
            }

            $requestId = $this->db->lastInsertRowID();

            // Success response
            http_response_code(201);
            return [
                'success' => true,
                'message' => 'Your custom plan request has been received! Our team will contact you within 24 hours.',
                'data' => [
                    'request_id' => $requestId,
                    'sender_name' => $name,
                    'sender_phone' => $phone,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ];

        } catch (\Exception $e) {
            http_response_code(500);
            return [
                'success' => false,
                'message' => 'Failed to submit custom plan request. Please try again.',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get all custom plan requests
     */
    public function getCustomPlans(): array
    {
        try {
            $status = $_GET['status'] ?? null;
            $limit = $_GET['limit'] ?? 50;
            $offset = $_GET['offset'] ?? 0;

            $query = 'SELECT * FROM custom_plans';
            $conditions = [];

            if ($status) {
                $conditions[] = "status = '" . $this->db->escapeString($status) . "'";
            }

            if (!empty($conditions)) {
                $query .= ' WHERE ' . implode(' AND ', $conditions);
            }

            $query .= ' ORDER BY created_at DESC LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;

            $result = $this->db->query($query);
            $customPlans = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $customPlans[] = $row;
            }

            return [
                'success' => true,
                'data' => $customPlans,
                'count' => count($customPlans)
            ];

        } catch (\Exception $e) {
            http_response_code(500);
            return [
                'success' => false,
                'message' => 'Failed to retrieve custom plan requests',
                'error' => $e->getMessage()
            ];
        }
    }

    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}

