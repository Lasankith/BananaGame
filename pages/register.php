<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password === $confirmPassword) {
        $checkQuery = "SELECT * FROM usertb WHERE userName='$username'";
        $result = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($result) == 0) {
            $insertQuery = "INSERT INTO usertb (userName, password) VALUES ('$username', '$password')";
            if (mysqli_query($con, $insertQuery)) {
                header("Location: login.php?msg=registered");
                exit;
            } else {
                $error = "Error inserting user: " . mysqli_error($con);
            }
        } else {
            $error = "Username already exists. Please choose another.";
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register Form</title>
</head>
<body>
<div class="background-container">
    <img src="../images/login.png" alt="Background Image">
    <div class="login-container">
        <h2 style="padding-top: 105px;">REGISTER</h2><br>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="image" src="../images/button1.png" alt="Login Button">
        </form>
        <p class="register-link-container">
            Already have an account? <a href="login.php" class="register-link">Login</a>
        </p>
    </div>
</div>
</body>
</html>


