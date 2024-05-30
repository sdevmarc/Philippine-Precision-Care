<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "ppc_portal";

    // Create connection
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
?>

