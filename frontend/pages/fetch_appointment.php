<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connection.php';
$conn = OpenCon();

// Get the appointment ID from the query string
$appointment_id = $_GET['id'] ?? null;

if (!$appointment_id) {
    echo json_encode(['success' => false, 'message' => 'No appointment ID provided.']);
    exit;
}

// Retrieve the appointment data
$sql = "SELECT id, first_name, middle_name, last_name, contact_number, email, appointment_date FROM appointments WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
    exit;
}

$stmt->bind_param('i', $appointment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $appointment]);
} else {
    echo json_encode(['success' => false, 'message' => 'Appointment not found.']);
}

// Close the connection
CloseCon($conn);
?>
