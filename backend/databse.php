<?php
require_once 'config.php';

function getDbConnection() {
    global $link;
    return $link;
}
?>
