<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylesMenu.css">
    <title>Menu</title>
</head>
<body>
<div class="background-container">
    <img src="../images/23.png" alt="Background Image">
    <div class="button-container">
        <a href="levelMenu.php"><img src="../images/button1.png" alt="Play" class="small-img" id="button1"></a>
        <a href="bananaGame.php"><img src="../images/button2.png" alt="Challenge" class="small-img" id="button2"></a>
        <a href="exit.php"><img src="../images/button3.png" alt="Exit" class="small-img" id="button3"></a>
    </div>
    <div class="icons">
        <a href="page1.html"><img src="../images/settings.png" alt="Settings" class="small-img" id="button4"></a>
        <a href="page1.html"><img src="../images/info.png" alt="Info" class="small-img" id="button5"></a>
        <a href="leaderboard.php"><img src="../images/leaderB.png" alt="Leaderboard" class="small-img" id="button6"></a>
    </div>
</div>
</body>
</html>
