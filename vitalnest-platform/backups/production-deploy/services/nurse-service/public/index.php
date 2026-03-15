<?php
/**
 * Nurse Service API - Vitals Collection & Patient Preparation
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
$dbPath = __DIR__ . '/../../../database/vitalnest_nurse.db';
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

// Helper function to calculate BMI
function calculateBMI($weight_kg, $height_m) {
    if ($height_m > 0) {
        return round($weight_kg / ($height_m * $height_m), 2);
    }
    return null;
}

// Helper function to check if vitals are abnormal
function checkAbnormalVitals($vitals, $db) {
    $abnormal = [];

    $ranges = $db->query("SELECT * FROM vitals_reference_ranges WHERE age_group = 'adult'");
    $referenceRanges = [];
    while ($row = $ranges->fetchArray(SQLITE3_ASSOC)) {
        $referenceRanges[$row['vital_type']] = $row;
    }

    foreach ($vitals as $key => $value) {
        if ($value !== null && isset($referenceRanges[$key])) {
            $range = $referenceRanges[$key];
            if ($value < $range['min_warning'] || $value > $range['max_warning']) {
                $abnormal[] = $key;
            }
        }
    }

    return count($abnormal) > 0;
}

// Routes
switch ($method) {
    case 'GET':
        // GET /vitals - List all vitals records
        if (strpos($path, 'vitals') !== false && !is_numeric(end($pathParts))) {
            $patient_id = $_GET['patient_id'] ?? null;
            $nurse_id = $_GET['nurse_id'] ?? null;
            $date = $_GET['date'] ?? null;

            $sql = "SELECT * FROM vitals_records WHERE 1=1";

            if ($patient_id) {
                $sql .= " AND patient_id = " . (int)$patient_id;
            }
            if ($nurse_id) {
                $sql .= " AND nurse_id = " . (int)$nurse_id;
            }
            if ($date) {
                $sql .= " AND DATE(vitals_taken_at) = '" . $db->escapeString($date) . "'";
            }

            $sql .= " ORDER BY vitals_taken_at DESC";

            $result = $db->query($sql);
            $vitals = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $vitals[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $vitals,
                'count' => count($vitals)
            ]);
        }

        // GET /vitals/:id - Get specific vitals record
        if (strpos($path, 'vitals') !== false && is_numeric(end($pathParts))) {
            $vitalsId = (int)end($pathParts);

            $stmt = $db->prepare('SELECT * FROM vitals_records WHERE id = ?');
            $stmt->bindValue(1, $vitalsId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $vitals = $result->fetchArray(SQLITE3_ASSOC);

            if (!$vitals) {
                sendResponse(['success' => false, 'message' => 'Vitals record not found'], 404);
            }

            // Get nursing notes
            $stmt = $db->prepare('SELECT * FROM nursing_notes WHERE vitals_record_id = ? ORDER BY created_at DESC');
            $stmt->bindValue(1, $vitalsId, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $notes = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $notes[] = $row;
            }

            $vitals['nursing_notes'] = $notes;

            sendResponse([
                'success' => true,
                'data' => $vitals
            ]);
        }

        // GET /visits - Get patient visits
        if (strpos($path, 'visits') !== false) {
            $status = $_GET['status'] ?? null;
            $today = $_GET['today'] ?? false;

            $sql = "SELECT * FROM patient_visits WHERE 1=1";

            if ($status) {
                $sql .= " AND visit_status = '" . $db->escapeString($status) . "'";
            }
            if ($today) {
                $sql .= " AND DATE(check_in_time) = DATE('now')";
            }

            $sql .= " ORDER BY check_in_time DESC";

            $result = $db->query($sql);
            $visits = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $visits[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $visits,
                'count' => count($visits)
            ]);
        }

        // GET /reference-ranges - Get vital signs reference ranges
        if (strpos($path, 'reference-ranges') !== false) {
            $result = $db->query("SELECT * FROM vitals_reference_ranges");
            $ranges = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $ranges[] = $row;
            }

            sendResponse([
                'success' => true,
                'data' => $ranges
            ]);
        }
        break;

    case 'POST':
        // POST /vitals - Create new vitals record
        if (strpos($path, 'vitals') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);

            if (!$input) {
                sendResponse(['success' => false, 'message' => 'Invalid JSON'], 400);
            }

            // Validation
            $required = ['nurse_id', 'patient_id'];
            foreach ($required as $field) {
                if (!isset($input[$field])) {
                    sendResponse(['success' => false, 'message' => "Field '$field' is required"], 400);
                }
            }

            // Calculate BMI if height and weight provided
            $bmi = null;
            if (isset($input['height']) && isset($input['weight'])) {
                $bmi = calculateBMI($input['weight'], $input['height']);
            }

            // Check if vitals are abnormal
            $vitalsData = [
                'systolic_bp' => $input['systolic_bp'] ?? null,
                'diastolic_bp' => $input['diastolic_bp'] ?? null,
                'heart_rate' => $input['heart_rate'] ?? null,
                'respiratory_rate' => $input['respiratory_rate'] ?? null,
                'temperature' => $input['temperature'] ?? null,
                'oxygen_saturation' => $input['oxygen_saturation'] ?? null
            ];

            $abnormalVitals = checkAbnormalVitals($vitalsData, $db);

            // Insert vitals record
            $stmt = $db->prepare('
                INSERT INTO vitals_records (
                    nurse_id, patient_id, appointment_id,
                    systolic_bp, diastolic_bp, heart_rate, respiratory_rate, 
                    temperature, oxygen_saturation, blood_glucose,
                    height, weight, bmi, waist_circumference,
                    pain_level, pain_location, pain_description,
                    general_appearance, mental_status, skin_condition, mobility,
                    chief_complaint, current_medications, allergies, 
                    medical_history, surgical_history, family_history, social_history,
                    nurse_notes, patient_concerns,
                    abnormal_vitals, requires_immediate_attention,
                    status, vitals_taken_at, created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ');

            $now = date('Y-m-d H:i:s');
            $stmt->bindValue(1, $input['nurse_id'], SQLITE3_INTEGER);
            $stmt->bindValue(2, $input['patient_id'], SQLITE3_INTEGER);
            $stmt->bindValue(3, $input['appointment_id'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(4, $input['systolic_bp'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(5, $input['diastolic_bp'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(6, $input['heart_rate'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(7, $input['respiratory_rate'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(8, $input['temperature'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(9, $input['oxygen_saturation'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(10, $input['blood_glucose'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(11, $input['height'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(12, $input['weight'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(13, $bmi, SQLITE3_FLOAT);
            $stmt->bindValue(14, $input['waist_circumference'] ?? null, SQLITE3_FLOAT);
            $stmt->bindValue(15, $input['pain_level'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(16, $input['pain_location'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(17, $input['pain_description'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(18, $input['general_appearance'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(19, $input['mental_status'] ?? 'alert', SQLITE3_TEXT);
            $stmt->bindValue(20, $input['skin_condition'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(21, $input['mobility'] ?? 'independent', SQLITE3_TEXT);
            $stmt->bindValue(22, $input['chief_complaint'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(23, $input['current_medications'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(24, $input['allergies'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(25, $input['medical_history'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(26, $input['surgical_history'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(27, $input['family_history'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(28, $input['social_history'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(29, $input['nurse_notes'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(30, $input['patient_concerns'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(31, $abnormalVitals ? 1 : 0, SQLITE3_INTEGER);
            $stmt->bindValue(32, $input['requires_immediate_attention'] ?? 0, SQLITE3_INTEGER);
            $stmt->bindValue(33, 'completed', SQLITE3_TEXT);
            $stmt->bindValue(34, $now, SQLITE3_TEXT);
            $stmt->bindValue(35, $now, SQLITE3_TEXT);
            $stmt->bindValue(36, $now, SQLITE3_TEXT);

            if ($stmt->execute()) {
                $vitalsId = $db->lastInsertRowID();

                // Update visit status if appointment_id provided
                if (isset($input['appointment_id'])) {
                    $updateVisit = $db->prepare('UPDATE patient_visits SET visit_status = ?, vitals_completed_time = ? WHERE appointment_id = ?');
                    $updateVisit->bindValue(1, 'vitals_taken', SQLITE3_TEXT);
                    $updateVisit->bindValue(2, $now, SQLITE3_TEXT);
                    $updateVisit->bindValue(3, $input['appointment_id'], SQLITE3_INTEGER);
                    $updateVisit->execute();
                }

                // Get created vitals
                $stmt = $db->prepare('SELECT * FROM vitals_records WHERE id = ?');
                $stmt->bindValue(1, $vitalsId, SQLITE3_INTEGER);
                $result = $stmt->execute();
                $vitals = $result->fetchArray(SQLITE3_ASSOC);

                sendResponse([
                    'success' => true,
                    'message' => 'Vitals recorded successfully',
                    'data' => $vitals,
                    'abnormal_vitals' => $abnormalVitals
                ], 201);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to record vitals'], 500);
            }
        }

        // POST /visits - Create patient visit
        if (strpos($path, 'visits') !== false) {
            $input = json_decode(file_get_contents('php://input'), true);

            $stmt = $db->prepare('
                INSERT INTO patient_visits (
                    patient_id, nurse_id, appointment_id, 
                    check_in_time, visit_status, waiting_room, notes, created_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ');

            $now = date('Y-m-d H:i:s');
            $stmt->bindValue(1, $input['patient_id'], SQLITE3_INTEGER);
            $stmt->bindValue(2, $input['nurse_id'], SQLITE3_INTEGER);
            $stmt->bindValue(3, $input['appointment_id'] ?? null, SQLITE3_INTEGER);
            $stmt->bindValue(4, $now, SQLITE3_TEXT);
            $stmt->bindValue(5, 'checked_in', SQLITE3_TEXT);
            $stmt->bindValue(6, $input['waiting_room'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(7, $input['notes'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(8, $now, SQLITE3_TEXT);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Patient checked in successfully'], 201);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to check in patient'], 500);
            }
        }
        break;

    case 'PUT':
        // PUT /vitals/:id - Update vitals record
        if (strpos($path, 'vitals') !== false && is_numeric(end($pathParts))) {
            $vitalsId = (int)end($pathParts);
            $input = json_decode(file_get_contents('php://input'), true);

            $updates = [];
            $params = [];

            $allowedFields = ['status', 'reviewed_by', 'nurse_notes', 'requires_immediate_attention'];
            foreach ($allowedFields as $field) {
                if (isset($input[$field])) {
                    $updates[] = "$field = ?";
                    $params[] = $input[$field];
                }
            }

            if (count($updates) > 0) {
                $updates[] = 'updated_at = ?';
                $params[] = date('Y-m-d H:i:s');
                $params[] = $vitalsId;

                $sql = 'UPDATE vitals_records SET ' . implode(', ', $updates) . ' WHERE id = ?';
                $stmt = $db->prepare($sql);

                foreach ($params as $i => $value) {
                    $stmt->bindValue($i + 1, $value);
                }

                if ($stmt->execute()) {
                    sendResponse(['success' => true, 'message' => 'Vitals updated successfully']);
                } else {
                    sendResponse(['success' => false, 'message' => 'Failed to update vitals'], 500);
                }
            } else {
                sendResponse(['success' => false, 'message' => 'No fields to update'], 400);
            }
        }

        // PUT /visits/:id - Update visit status
        if (strpos($path, 'visits') !== false && is_numeric(end($pathParts))) {
            $visitId = (int)end($pathParts);
            $input = json_decode(file_get_contents('php://input'), true);

            $stmt = $db->prepare('UPDATE patient_visits SET visit_status = ?, exam_room = ? WHERE id = ?');
            $stmt->bindValue(1, $input['visit_status'], SQLITE3_TEXT);
            $stmt->bindValue(2, $input['exam_room'] ?? null, SQLITE3_TEXT);
            $stmt->bindValue(3, $visitId, SQLITE3_INTEGER);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Visit updated successfully']);
            } else {
                sendResponse(['success' => false, 'message' => 'Failed to update visit'], 500);
            }
        }
        break;

    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
