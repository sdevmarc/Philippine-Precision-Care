<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ppc_portal');

// Create connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    echo json_encode(['success' => false, 'message' => 'Could not connect to database.']);
    exit;
}

// Get the input data
$input = json_decode(file_get_contents('php://input'), true);
$appointment_id = $input['id'] ?? null;

if (!$appointment_id) {
    echo json_encode(['success' => false, 'message' => 'No appointment ID provided.']);
    exit;
}

// Retrieve the appointment data
$sql = "SELECT * FROM appointments WHERE id = ?";
$stmt = $link->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
    exit;
}

$stmt->bind_param('i', $appointment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();

    // Insert the appointment data into finance_approved_appointments (without appointment_time)
    $insert_sql = "INSERT INTO finance_approved_appointments (id, first_name, middle_name, last_name, contact_number, email, appointment_date, billing) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $link->prepare($insert_sql);

    if ($insert_stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare insert statement.']);
        exit;
    }

    $insert_stmt->bind_param(
        'isssssss',
        $appointment['id'],
        $appointment['first_name'],
        $appointment['middle_name'],
        $appointment['last_name'],
        $appointment['contact_number'],
        $appointment['email'],
        $appointment['appointment_date'],
        $appointment['billing']
    );

    if ($insert_stmt->execute()) {
        // Delete the appointment from the appointments table
        $delete_sql = "DELETE FROM appointments WHERE id = ?";
        $delete_stmt = $link->prepare($delete_sql);

        if ($delete_stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare delete statement.']);
            exit;
        }

        $delete_stmt->bind_param('i', $appointment_id);
        $delete_stmt->execute();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert appointment into finance_approved_appointments.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Appointment not found.']);
}

// Close the connection
mysqli_close($link);
?>
