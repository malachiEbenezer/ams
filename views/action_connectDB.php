<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "ams";

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    header('Database connection failed.');
    exit;
}else{
    //echo'DATABASE CONNECTED!';
    //header('DATABASE CONNECTED!');
    exit;
}

?>