<?php
session_start(); // Start the session

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ppc_portal');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Prepare and bind the data
    $first_name = mysqli_real_escape_string($link, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($link, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($link, $_POST['last_name']);
    $contact_number = mysqli_real_escape_string($link, $_POST['contact_number']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

    // Attempt to insert the data into the database
    $sql = "INSERT INTO appointments (first_name, middle_name, last_name, contact_number, email) VALUES ('$first_name', '$middle_name', '$last_name', '$contact_number', '$email')";

    if(mysqli_query($link, $sql)){
        // Set session variable for success
        $_SESSION['success_message'] = "Appointment submitted successfully.";
        // Redirect back to the frontend page
        header("Location: ../frontend/pages/Appointment.php");
        exit();
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

// Close connection
mysqli_close($link);
?>
