<?php
$host = "localhost"; 
$db_user = "root"; 
$db_password = ""; 
$db_name = "weatherdb";

$conn = new mysqli($host, $db_user, $db_password, $db_name);
if ($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);
}

?>