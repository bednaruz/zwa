<?php
    $servername = "localhost";
    $user = "bednaruz";
    $pass = "webove aplikace";
    $dbname = "bednaruz";

    $conn = mysqli_connect($servername, $user, $pass, $dbname);
    if (!$conn) {
        header("location: ../img/marvin.png");
        die();
    }
    if ($conn->connect_error) {
        header("location: ../img/marvin.png");
        die();
    }
?>
