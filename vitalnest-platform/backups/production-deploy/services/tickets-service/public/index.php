<?php
/**
 * Tickets API - Create and manage support tickets
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Database connection
$dbPath = __DIR__ . '/../../../database/vitalnest_tickets.db';
$db = new SQLite3($dbPath);

// Get request method and path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', trim($path, '/'));

// Helper function to send JSON response
function sendResponse($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
    exit;
}

// Helper function to generate ticket number
function generateTicketNumber($db) {
    $year = date('Y');
    $result = $db->query("SELECT COUNT(*) as count FROM tickets WHERE strftime('%Y', created_at) = '$year'");
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $count = ($row['count'] ?? 0) + 1;
    return sprintf('TKT-%s-%03d', $year, $count);
}

// Routes
switch ($method) {
    case 'GET':
        // GET /tickets - List all tickets or user's tickets
        if (end($pathParts) === 'tickets') {
            $userId = $_GET['user_id'] ?? null;
            $status = $_GET['status'] ?? null;
            $category = $_GET['category'] ?? null;

            $sql = "SELECT 
                        t.*,
                        COUNT(DISTINCT tc.id) as comment_count
                    FROM tickets t
                    LEFT JOIN ticket_comments tc ON tc.ticket_id = t.id
                    WHERE 1=1";

            if ($userId) {
                $sql .= " AND t.user_id = " . (int)$userId;
            }
            if ($status) {
                $sql .= " AND t.status = '" . $db->escapeString($status) . "'";
            }
            if ($category) {
                $sql .= " AND t.category = '" . $db->escapeString($category) . "'";
            }

            $sql .= " GROUP BY t.id ORDER BY t.created_at DESC";

            $result = $db->query($sql);
            $tickets = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $tickets[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $tickets,
                'count' => count($tickets)
            ]);
        }

        // GET /tickets/:id - Get specific ticket
        if (isset($pathParts[count($pathParts) - 1]) && is_numeric($pathParts[count($pathParts) - 1])) {
            $ticketId = (int)$pathParts[count($pathParts) - 1];

            // Get ticket
            $stmt = $db->prepare('SELECT * FROM tickets WHERE id = ?');
            $stmt->bindValue(1, $ticketId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $ticket = $result->fetchArray(SQLITE3_ASSOC);

            if (!$ticket) {
                sendResponse(['success' => false, 'message' => 'Ticket not found'], 404);
            }

            // Get comments
            $stmt = $db->prepare('SELECT * FROM ticket_comments WHERE ticket_id = ? ORDER BY created_at ASC');
            $stmt->bindValue(1, $ticketId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $comments = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $comments[] = $row;
            }

            $ticket['comments'] = $comments;

            sendResponse([
                'success' => true,
                'data' => $ticket
            ]);
        }
        break;

    case 'POST':
        // POST /tickets - Create new ticket
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            sendResponse(['success' => false, 'message' => 'Invalid JSON'], 400);
        }

        // Validation
        $required = ['user_id', 'category', 'priority', 'subject', 'description'];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                sendResponse(['success' => false, 'message' => "Field '$field' is required"], 400);
            }
        }

        // Validate description length
        if (strlen($input['description']) < 20) {
            sendResponse(['success' => false, 'message' => 'Description must be at least 20 characters'], 400);
        }

        // Generate ticket number
        $ticketNumber = generateTicketNumber($db);

        // Determine department based on category
        $department = $input['department'] ?? 'general';
        if ($input['category'] === 'appointment') $department = 'reception';
        if ($input['category'] === 'medical') $department = 'medical';
        if ($input['category'] === 'billing') $department = 'billing';
        if ($input['category'] === 'technical') $department = 'it';
        if ($input['category'] === 'prescription') $department = 'pharmacy';
        if ($input['category'] === 'lab_results') $department = 'lab';

        // Insert ticket
        $stmt = $db->prepare('
            INSERT INTO tickets (
                ticket_number, user_id, category, priority, status, 
                subject, description, department, source, created_at, updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $now = date('Y-m-d H:i:s');
        $stmt->bindValue(1, $ticketNumber, SQLITE3_TEXT);
        $stmt->bindValue(2, $input['user_id'], SQLITE3_INTEGER);
        $stmt->bindValue(3, $input['category'], SQLITE3_TEXT);
        $stmt->bindValue(4, $input['priority'], SQLITE3_TEXT);
        $stmt->bindValue(5, 'open', SQLITE3_TEXT);
        $stmt->bindValue(6, $input['subject'], SQLITE3_TEXT);
        $stmt->bindValue(7, $input['description'], SQLITE3_TEXT);
        $stmt->bindValue(8, $department, SQLITE3_TEXT);
        $stmt->bindValue(9, $input['source'] ?? 'web', SQLITE3_TEXT);
        $stmt->bindValue(10, $now, SQLITE3_TEXT);
        $stmt->bindValue(11, $now, SQLITE3_TEXT);

        if ($stmt->execute()) {
            $ticketId = $db->lastInsertRowID();

            // Create notification for staff
            $notifStmt = $db->prepare('
                INSERT INTO ticket_notifications (
                    ticket_id, user_id, notification_type, title, message, created_at
                ) VALUES (?, ?, ?, ?, ?, ?)
            ');

            $notifStmt->bindValue(1, $ticketId, SQLITE3_INTEGER);
            $notifStmt->bindValue(2, 1, SQLITE3_INTEGER); // Admin user
            $notifStmt->bindValue(3, 'created', SQLITE3_TEXT);
            $notifStmt->bindValue(4, 'New Support Ticket', SQLITE3_TEXT);
            $notifStmt->bindValue(5, "New {$input['category']} ticket: {$input['subject']}", SQLITE3_TEXT);
            $notifStmt->bindValue(6, $now, SQLITE3_TEXT);
            $notifStmt->execute();

            // Get created ticket
            $stmt = $db->prepare('SELECT * FROM tickets WHERE id = ?');
            $stmt->bindValue(1, $ticketId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $ticket = $result->fetchArray(SQLITE3_ASSOC);

            sendResponse([
                'success' => true,
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } else {
            sendResponse(['success' => false, 'message' => 'Failed to create ticket'], 500);
        }
        break;

    case 'PUT':
        // PUT /tickets/:id - Update ticket
        $ticketId = (int)$pathParts[count($pathParts) - 1];
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            sendResponse(['success' => false, 'message' => 'Invalid JSON'], 400);
        }

        // Build update query
        $updates = [];
        $params = [];

        if (isset($input['status'])) {
            $updates[] = 'status = ?';
            $params[] = $input['status'];
        }
        if (isset($input['priority'])) {
            $updates[] = 'priority = ?';
            $params[] = $input['priority'];
        }
        if (isset($input['assigned_to'])) {
            $updates[] = 'assigned_to = ?';
            $params[] = $input['assigned_to'];
        }

        $updates[] = 'updated_at = ?';
        $params[] = date('Y-m-d H:i:s');

        $params[] = $ticketId;

        $sql = 'UPDATE tickets SET ' . implode(', ', $updates) . ' WHERE id = ?';
        $stmt = $db->prepare($sql);

        foreach ($params as $i => $value) {
            $stmt->bindValue($i + 1, $value);
        }

        if ($stmt->execute()) {
            sendResponse(['success' => true, 'message' => 'Ticket updated successfully']);
        } else {
            sendResponse(['success' => false, 'message' => 'Failed to update ticket'], 500);
        }
        break;

    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
