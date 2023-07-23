<?php
require 'connection.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM usercrediential WHERE username='$username' AND password='$password'";
    $response = mysqli_query($conn, $sql);
    print_r($response);
    if ($response && mysqli_num_rows($response) == 1){
        header("Location:index.php");
        exit();
    }else{
        echo "Invalid username or password.";
    }    
}
