<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "connect.php";

$_SESSION["quizz"] = "quizz2";

$sql = "CREATE TABLE quizz2(
id INT(255) AUTO_INCREMENT,
Unique(id),
question VARCHAR(50) NOT NULL,
answer VARCHAR(50) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table quizz2 created successfully";
    $sql = "INSERT INTO
                quizz2(question, answer)
            VALUES 
                ('Jak se máš?', 'dobře'),
                ('Jaká je odpověď na otázku života, vewsmíru a vůbec?', 42),
                ('Jaká je pravá barva vesmíru?','béžová')";
    if (mysqli_query($conn, $sql)) {
        echo "Questions inserted correctly";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }        
} else {
    echo "Error creating table: " . $conn->error;
}



?>