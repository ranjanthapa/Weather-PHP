<?php
function registerUser() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        if ($password == $password2 && !empty($username)) {
            $user_credential_data = fopen("userlog.txt", "a");
            $data = $username . "," . $password . "\n";
            fwrite($user_credential_data, $data);
            fclose($user_credential_data);
            header("Location: index.php");
            exit();
        }
    }
}
registerUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register New User</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password2">Confirm Password:</label>
                <input type="password" id="password" name="password2" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register" action=>
            </div>
          
            <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                  registerUser();
                }
            ?>
                  
            <div class="form-group">
                <a href="index.php" class="login-link">Back to Login</a>
            </div>
        </form>
    </div>
</body>
</html>
