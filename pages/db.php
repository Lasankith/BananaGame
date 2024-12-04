<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "bananadb");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
