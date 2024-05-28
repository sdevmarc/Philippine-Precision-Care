<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../backend/database.php';

$username = 'testuser';
$password = password_hash('password123', PASSWORD_DEFAULT);
$user_role = 'admin';
$is_active = true;
$first_name = 'Test';
$middle_name = 'User';
$last_name = 'Example';
$email = 'testuser@example.com';
$phone_number = '1234567890';
$address = '123 Test Street, Test City, Test Country';

$sql = "INSERT INTO users (username, password, user_role, is_active, first_name, middle_name, last_name, email, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
if($stmt = mysqli_prepare(getDbConnection(), $sql)){
    mysqli_stmt_bind_param($stmt, "sssissssss", $username, $password, $user_role, $is_active, $first_name, $middle_name, $last_name, $email, $phone_number, $address);

    if(mysqli_stmt_execute($stmt)){
        echo "User created successfully.";
    } else {
        echo "Error: Could not execute the query. " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: Could not prepare the query. " . mysqli_error(getDbConnection());
}

mysqli_close(getDbConnection());
?>
