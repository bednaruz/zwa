<?php
    $time = "00:00:00";

    $sql = "CREATE TABLE IF NOT EXISTS results(
        id INT(255), Unique(id),
        score1 INT(255) DEFAULT 0,
        time1 VARCHAR(255) DEFAULT '$time',
        score2 INT(255) DEFAULT 0,
        time2 VARCHAR(255) DEFAULT '$time',
        score3 INT(255) DEFAULT 0,
        time3 VARCHAR(255) DEFAULT '$time',
        score4 INT(255) DEFAULT 0,
        time4 VARCHAR(255) DEFAULT '$time',
        score5 INT(255) DEFAULT 0,
        time5 VARCHAR(255) DEFAULT '$time'
    )";

    if (!$conn->query($sql)) {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }
?>