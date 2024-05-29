<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ppc_portal');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM appointments";
$result = mysqli_query($link, $sql);

// Check if there are any appointments
if(mysqli_num_rows($result) > 0) {
    $appointments = array();
    // Fetch each row of data
    while($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
}


mysqli_close($link);

// Return the appointments data as JSON
echo json_encode($appointments);
?>
