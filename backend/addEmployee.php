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

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$position = $_POST['position'];

$sql = "INSERT INTO employees (first_name, last_name, email, position) VALUES ('$firstName', '$lastName', '$email', '$position')";

if ($conn->query($sql) === TRUE) {
  // Redirect back to ManageEmployees page
  header("Location: ../frontend/pages/ManageEmployees.php");
  exit(); 
} else {
//   echo "Error: " . $sql . "<br>" . $conn->error;

  header("Location: ../frontend/pages/ManageEmployees.php");

}

$conn->close();
?>
