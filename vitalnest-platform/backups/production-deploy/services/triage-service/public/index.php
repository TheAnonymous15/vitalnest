<?php
/**
 * Triage API - Emergency patient assessment and prioritization
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
$dbPath = __DIR__ . '/../../../database/vitalnest_triage.db';
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

// Helper function to determine priority color
function getPriorityColor($level) {
    switch ($level) {
        case 1: return 'red';
        case 2: return 'orange';
        case 3: return 'yellow';
        case 4: return 'green';
        case 5: return 'blue';
        default: return 'yellow';
    }
}

// Routes
switch ($method) {
    case 'GET':
        // GET /assessments - List all triage assessments
        if (strpos($path, 'assessments') !== false) {
            $status = $_GET['status'] ?? null;
            $priority = $_GET['priority'] ?? null;

            $sql = "SELECT * FROM triage_assessments WHERE 1=1";

            if ($status) {
                $sql .= " AND status = '" . $db->escapeString($status) . "'";
            }
            if ($priority) {
                $sql .= " AND priority_level = " . (int)$priority;
            }

            $sql .= " ORDER BY priority_level ASC, arrival_time ASC";

            $result = $db->query($sql);
            $assessments = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $assessments[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $assessments,
                'count' => count($assessments)
            ]);
        }

        // GET /queue - Get current triage queue
        if (strpos($path, 'queue') !== false) {
            $sql = "SELECT 
                        q.*,
                        a.chief_complaint,
                        a.priority_color,
                        a.arrival_time
                    FROM triage_queue q
                    LEFT JOIN triage_assessments a ON q.assessment_id = a.id
                    WHERE q.status IN ('waiting', 'called')
                    ORDER BY q.priority_level ASC, q.created_at ASC";

            $result = $db->query($sql);
            $queue = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $queue[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $queue,
                'count' => count($queue)
            ]);
        }

        // GET /beds - Get bed availability
        if (strpos($path, 'beds') !== false) {
            $status = $_GET['status'] ?? null;
            $type = $_GET['type'] ?? null;

            $sql = "SELECT * FROM triage_beds WHERE 1=1";

            if ($status) {
                $sql .= " AND status = '" . $db->escapeString($status) . "'";
            }
            if ($type) {
                $sql .= " AND bed_type = '" . $db->escapeString($type) . "'";
            }

            $sql .= " ORDER BY bed_number ASC";

            $result = $db->query($sql);
            $beds = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $beds[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $beds,
                'count' => count($beds)
            ]);
        }

        // GET /alerts - Get active emergency alerts
        if (strpos($path, 'alerts') !== false) {
            $sql = "SELECT * FROM emergency_alerts WHERE resolved = 0 ORDER BY created_at DESC";

            $result = $db->query($sql);
            $alerts = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $alerts[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $alerts,
                'count' => count($alerts)
            ]);
        }

        // GET /ambulances - Get incoming ambulances
        if (strpos($path, 'ambulances') !== false) {
            $sql = "SELECT * FROM ambulance_arrivals WHERE status IN ('en_route', 'arrived') ORDER BY eta ASC";

            $result = $db->query($sql);
            $ambulances = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $ambulances[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $ambulances,
                'count' => count($ambulances)
            ]);
        }

        // GET /protocols - Get triage protocols
        if (strpos($path, 'protocols') !== false) {
            $sql = "SELECT * FROM triage_protocols WHERE is_active = 1 ORDER BY priority_level ASC";

            $result = $db->query($sql);
            $protocols = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $protocols[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $protocols,
                'count' => count($protocols)
            ]);
        }
        break;

    case 'POST':
        // POST /assessments - Create new triage assessment
        if (strpos($path, 'assessments') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);

            if (!$input) {
                sendResponse(['success' => false, 'message' => 'Invalid JSON'], 400);
            }

            // Validation
            $required = ['triage_staff_id', 'patient_id', 'chief_complaint', 'priority_level'];
            foreach ($required as $field) {
                if (!isset($input[$field])) {
                    sendResponse(['success' => false, 'message' => "Field '$field' is required"], 400);
                }
            }

            // Determine priority color
            $priorityColor = getPriorityColor($input['priority_level']);

            // Insert assessment
            $stmt = $db->prepare('
                INSERT INTO triage_assessments (
                    triage_staff_id, patient_id, arrival_mode, chief_complaint, pain_level,
                    systolic_bp, diastolic_bp, heart_rate, respiratory_rate, temperature, 
                    oxygen_saturation, weight, priority_level, priority_color,
                    allergies, current_medications, medical_history,
                    presenting_symptoms, trauma_mechanism, onset_time, duration,
                    status, triage_completed_at, created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ');

            $now = date('Y-m-d H:i:s');
            $stmt->bindValue(1, $input['triage_staff_id'], SQLITE3_INTEGER);
            $stmt->bindValue(2, $input['patient_id'], SQLITE3_INTEGER);
            $stmt->bindValue(3, $input['arrival_mode'] ?? 'walk_in', SQLITE3_TEXT);
            $stmt->bindValue(4, $input['chief_complaint'], SQLITE3_TEXT);
            $stmt->bindValue(5, $input['pain_level'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(6, $input['systolic_bp'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(7, $input['diastolic_bp'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(8, $input['heart_rate'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(9, $input['respiratory_rate'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(10, $input['temperature'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(11, $input['oxygen_saturation'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(12, $input['weight'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(13, $input['priority_level'], SQLITE3_INTEGER);
            $stmt->bindValue(14, $priorityColor, SQLITE3_TEXT);
            $stmt->bindValue(15, $input['allergies'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(16, $input['current_medications'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(17, $input['medical_history'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(18, $input['presenting_symptoms'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(19, $input['trauma_mechanism'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(20, $input['onset_time'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(21, $input['duration'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(22, 'waiting', SQLITE3_TEXT);
            $stmt->bindValue(23, $now, SQLITE3_TEXT);
            $stmt->bindValue(24, $now, SQLITE3_TEXT);
            $stmt->bindValue(25, $now, SQLITE3_TEXT);

            if ($stmt->execute()) {
                $assessmentId = $db->lastInsertRowID();

                // Add to queue
                $queueNum = $db->querySingle("SELECT COALESCE(MAX(queue_number), 0) + 1 FROM triage_queue WHERE DATE(created_at) = DATE('now')");

                $queueStmt = $db->prepare('
                    INSERT INTO triage_queue (assessment_id, patient_id, queue_number, priority_level, status, created_at)
                    VALUES (?, ?, ?, ?, ?, ?)
                ');
                $queueStmt->bindValue(1, $assessmentId, SQLITE3_INTEGER);
                $queueStmt->bindValue(2, $input['patient_id'], SQLITE3_INTEGER);
                $queueStmt->bindValue(3, $queueNum, SQLITE3_INTEGER);
                $queueStmt->bindValue(4, $input['priority_level'], SQLITE3_INTEGER);
                $queueStmt->bindValue(5, 'waiting', SQLITE3_TEXT);
                $queueStmt->bindValue(6, $now, SQLITE3_TEXT);
                $queueStmt->execute();

                // Get created assessment
                $stmt = $db->prepare('SELECT * FROM triage_assessments WHERE id = ?');
                $stmt->bindValue(1, $assessmentId, SQLITE3_INTEGER);
                $result = $stmt->execute();
                $assessment = $result->fetchArray(SQLITE3_ASSOC);

                sendResponse([
                    'success' => true,
                    'message' => 'Triage assessment created successfully',
                    'data' => $assessment
                ], 201);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to create assessment'], 500);
            }
        }

        // POST /alerts - Create emergency alert
        if (strpos($path, 'alerts') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);

            $stmt = $db->prepare('
                INSERT INTO emergency_alerts (assessment_id, alert_type, severity, title, message, triggered_by, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ');

            $now = date('Y-m-d H:i:s');
            $stmt->bindValue(1, $input['assessment_id'], SQLITE3_INTEGER);
            $stmt->bindValue(2, $input['alert_type'], SQLITE3_TEXT);
            $stmt->bindValue(3, $input['severity'], SQLITE3_TEXT);
            $stmt->bindValue(4, $input['title'], SQLITE3_TEXT);
            $stmt->bindValue(5, $input['message'], SQLITE3_TEXT);
            $stmt->bindValue(6, $input['triggered_by'], SQLITE3_INTEGER);
            $stmt->bindValue(7, $now, SQLITE3_TEXT);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Alert created successfully'], 201);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to create alert'], 500);
            }
        }

        // POST /ambulances - Register incoming ambulance
        if (strpos($path, 'ambulances') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);

            $stmt = $db->prepare('
                INSERT INTO ambulance_arrivals (
                    ambulance_number, eta, priority_level, patient_condition, 
                    chief_complaint, vital_signs, special_requirements, 
                    contact_person, contact_phone, notified_at, created_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ');

            $now = date('Y-m-d H:i:s');
            $stmt->bindValue(1, $input['ambulance_number'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(2, $input['eta'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(3, $input['priority_level'] ?? 3, SQLITE3_INTEGER);
            $stmt->bindValue(4, $input['patient_condition'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(5, $input['chief_complaint'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(6, $input['vital_signs'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(7, $input['special_requirements'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(8, $input['contact_person'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(9, $input['contact_phone'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(10, $now, SQLITE3_TEXT);
            $stmt->bindValue(11, $now, SQLITE3_TEXT);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Ambulance registered successfully'], 201);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to register ambulance'], 500);
            }
        }
        break;

    case 'PUT':
        // PUT /assessments/:id - Update assessment
        if (strpos($path, 'assessments') !== false && is_numeric(end($pathParts))) {
            $assessmentId = (int)end($pathParts);
            $input = json_decode(file_get_contents('php://input'), true);

            $updates = [];
            $params = [];

            if (isset($input['status'])) {
                $updates[] = 'status = ?';
                $params[] = $input['status'];
            }
            if (isset($input['assigned_to'])) {
                $updates[] = 'assigned_to = ?';
                $params[] = $input['assigned_to'];
            }
            if (isset($input['bed_room_number'])) {
                $updates[] = 'bed_room_number = ?';
                $params[] = $input['bed_room_number'];
            }

            $updates[] = 'updated_at = ?';
            $params[] = date('Y-m-d H:i:s');
            $params[] = $assessmentId;

            $sql = 'UPDATE triage_assessments SET ' . implode(', ', $updates) . ' WHERE id = ?';
            $stmt = $db->prepare($sql);

            foreach ($params as $i => $value) {
                $stmt->bindValue($i + 1, $value);
            }

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Assessment updated successfully']);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to update assessment'], 500);
            }
        }

        // PUT /beds/:id - Update bed status
        if (strpos($path, 'beds') !== false && is_numeric(end($pathParts))) {
            $bedId = (int)end($pathParts);
            $input = json_decode(file_get_contents('php://input'), true);

            $stmt = $db->prepare('UPDATE triage_beds SET status = ?, current_patient_id = ?, updated_at = ? WHERE id = ?');
            $stmt->bindValue(1, $input['status'], SQLITE3_TEXT);
            $stmt->bindValue(2, $input['current_patient_id'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(3, date('Y-m-d H:i:s'), SQLITE3_TEXT);
            $stmt->bindValue(4, $bedId, SQLITE3_INTEGER);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Bed updated successfully']);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to update bed'], 500);
            }
        }
        break;

    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
