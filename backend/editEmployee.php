<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppc_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$position = $_POST['position'];

$sql = "UPDATE employees SET first_name='$firstName', last_name='$lastName', email='$email', position='$position' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  // Redirect back to ManageEmployees page
  header("Location: ../frontend/pages/ManageEmployees.php");
  exit(); // Make sure no other output is sent
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
