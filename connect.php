<?php
$servername = "localhost";
$user = "root";
$pass = "nevermind93";
$dbname = "zwa";

$conn = mysqli_connect($servername, $user, $pass, $dbname);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
