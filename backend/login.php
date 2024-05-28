<?php
session_start();
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if(empty($username) || empty($password)) {
        header("Location: ../frontend/pages/login.php?error=emptyfields");
        exit();
    }

    $sql = "SELECT id, username, password, first_name, last_name, user_role, is_active FROM users WHERE username = ?";
    if($stmt = mysqli_prepare(getDbConnection(), $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $first_name, $last_name, $user_role, $is_active);
                if(mysqli_stmt_fetch($stmt)){
                    if($is_active) {
                        if(password_verify($password, $hashed_password)){
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["first_name"] = $first_name;
                            $_SESSION["last_name"] = $last_name;
                            $_SESSION["user_role"] = $user_role;

                            header("Location: ../frontend/pages/Dashboard.php");
                        } else{
                            header("Location: ../frontend/pages/login.php?error=invalidpassword");
                        }
                    } else {
                        header("Location: ../frontend/pages/login.php?error=inactiveuser");
                    }
                }
            } else{
                header("Location: ../frontend/pages/login.php?error=nouser");
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close(getDbConnection());
?>
