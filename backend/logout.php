<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../frontend/pages/login.php");
    exit;
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page after logout
header("Location: ../frontend/pages/login.php");
exit;
?>
