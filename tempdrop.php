<?php
  $sql = "DROP IF EXISTS TABLE users";
  $conn->query($sql);
  $sql = "DROP IF EXISTS TABLE results";
  $conn->query($sql);
?>