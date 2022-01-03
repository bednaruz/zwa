<?php
    require_once "../help/resultstable.php";
    //-----------------------------pagination---------------------------------------
    $quizz = "quizz".$_SESSION['quizz'];
    $query = "SELECT * FROM $quizz";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);
    if (isset($_GET["page"])) {
        if (!isset($_SESSION["answered"])) {
            header("location: $quizz" . ".php");
        }
        if ($_GET["page"] > $number_of_result) {
            $page = $number_of_result;
        } else {
            $page = $_GET["page"];
        }
    } else {  
        $page = 1;
        $_SESSION["answered"] = [0,0,0,0];
        $_SESSION["quizz_score"] = 0;
        $_SESSION["time"] = microtime(true);
    }
    if ($_SESSION["answered"][$page-1]) {
        header("location: $quizz" . ".php?page=" . $page++);
    }
    if (isset($_POST["submit_answer"])) { //increment number of page, switch to next page, safe the answer to database
        $_SESSION["answered"][$page-1] = 1;
        $query = "SELECT answer FROM $quizz WHERE id=$page";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        if (isset($_POST["answer"]) && !empty($_POST["answer"]) && $row[0] == $_POST["answer"]) {
            $_SESSION["quizz_score"]++;
        }
        $page++;
        unset($_POST["submit_answer"]);
        if ($page > $number_of_result) {
            $_SESSION["time"] = microtime(true) - $_SESSION["time"];
            $time = date("H:i:s", $_SESSION["time"]);
            if (isset($_SESSION["id"])) {
                $timeword = "time" . $_SESSION["quizz"];
                $scoreword = "score" . $_SESSION["quizz"];
                $id = $_SESSION["id"];
                $score = $_SESSION["quizz_score"];
                $sql = "UPDATE results SET $timeword='$time', $scoreword='$score' WHERE id=$id";
                if ($conn->query($sql)) {
                    echo "Time spent on quizz updated succesfully";
                    echo "<br>Time is: " . $time . ", score is: " . $score . "<br>";
                }
            }
            unset($_SESSION["quizz"]);
            unset($_GET["page"]);
            $conn->close();
            header("location: ../index.php");
        } else {
            header("location: $quizz" . ".php?page=" . $page);
        }
    }
    $query = "SELECT * FROM $quizz WHERE id=$page";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    //-------------------------------end of pagination--------------------------------
?>