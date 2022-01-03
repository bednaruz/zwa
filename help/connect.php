<?php
    $servername = "localhost";
    $user = "bednaruz";
    $pass = "webove aplikace";
    $dbname = "bednaruz";

    $conn = mysqli_connect($servername, $user, $pass, $dbname);

    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>
