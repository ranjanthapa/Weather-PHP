<?php
function authenticate() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user_data = fopen("userlog.txt", "r");
        $login_successful = false;

        while (!feof($user_data)) {
            $line = fgets($user_data);
            $user_info = explode(",", trim($line));

            if ($user_info[0] === $username && $user_info[1] === $password) {
                $login_successful = true;
                header("Location:home.php");
                fclose($user_data);
                exit();
            }
        }

        fclose($user_data);

        if (!$login_successful) {
          echo "<script>alert('Invalid username or password');</script>";
        }
    }
}
authenticate();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Form</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
          <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  authenticate();
                }
            ?>
            <div class="form-group">
                <a href="register.php" class="register-link">New User? Register here</a>
            </div>
        </form>
    </div>
</body>
</html>
