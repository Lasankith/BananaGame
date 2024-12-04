<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "bananadb");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the username and score from the POST request
$userName = mysqli_real_escape_string($con, $_POST['userName']);
$score = (int)$_POST['score'];

// Insert the score into the leaderboard table
$query = "INSERT INTO leaderboard (userName, score) VALUES ('$userName', $score)";
if (mysqli_query($con, $query)) {
    echo "Score saved successfully!";
} else {
    echo "Error saving score: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
