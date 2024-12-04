<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM usertb WHERE userName='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: menu.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Form</title>
</head>
<body>
<div class="background-container">
    <img src="../images/login.png" alt="Background Image">
    <div class="login-container">
        <h2 style="padding-top: 120px;">LOGIN</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-button">
                <img src="../images/button1.png" alt="Login Button">
            </button>
        </form>
        <p class="register-link-container">
            If you don't have an account? <a href="register.php" class="register-link">Register here</a>
        </p>
    </div>
</div>
</body>
</html>

