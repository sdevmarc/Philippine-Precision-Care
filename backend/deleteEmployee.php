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

$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../frontend/pages/ManageEmployees.php");
    exit(); 
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
