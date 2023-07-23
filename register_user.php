<?php 
require_once "./connection.php";
global $conn;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($password !== $password2) {
        echo "<script>alert('Password didn't match');</script>";
    } else {
        
        $sql = "INSERT INTO usercrediential (username, password) VALUES (?, ?)";

       
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "User created successfully!";
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
