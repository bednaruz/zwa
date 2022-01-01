<?php
  require_once "help/connect.php";

  $time = "0h 0min 0s";

  $sql = "CREATE TABLE results(
  userid INT(255), Unique(userid),
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

  if ($conn->query($sql)) {
      echo "Table results created succesfully";
  } else {
      echo "Error: " . $sql . " : " . $conn->error;
  }
?>