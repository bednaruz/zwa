<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "connect.php";

$_SESSION["quizz"] = "quizz1";

$sql = "CREATE TABLE quizz1(
id INT(255) AUTO_INCREMENT,
Unique(id),
question VARCHAR(50) NOT NULL,
answer VARCHAR(50) DEFAULT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table quizz1 created successfully";
    $sql = "INSERT INTO
                quizz1(question, answer)
            VALUES 
                ('Kolik je 1+1?', 2),
                ('A co 12*25?', 300),
                ('Jaké číslo se používá pro error Not found', 404),
                ('aSDGASDGASDF', 23546)";
    if (mysqli_query($conn, $sql)) {
        echo "Questions inserted correctly";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }        
} else {
    echo "Error creating table: " . $conn->error;
}
?>