<?php
    //-----------------------------pagination---------------------------------------
    $quizz = "quizz" . $_SESSION["quizz"];

    $numberOfQuestions = 4;

    if (isset($_GET["page"])) {
        if (!isset($_SESSION["answered"])) {
            $conn->close();
            header("location: $quizz" . ".php");
            exit;
        }

        if ($_GET["page"] > $numberOfQuestions) {
            $page = $numberOfQuestions;
        } else {
            $page = $_GET["page"];
        }
    } else {
        $page = 1;
        $_SESSION["answered"] = [0,0,0,0];  //0-not answered, 1-correct, 2-wrong
        $_SESSION["time"] = microtime(true);
    }

    if ($_SESSION["answered"][$page-1]) {
        $conn->close();
        header("location: $quizz" . ".php?page=" . ++$page);
        exit;
    }

    if (isset($_POST["submit_answer"])) {

        $sql = "SELECT
                    answer
                FROM
                    $quizz
                WHERE
                    id=$page";

        if (!($result = $conn->query($sql))) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }
        if (!($row = $result->fetch_row())) {
            $conn->close();
            header("location: ../img/marvin.png");
            die();
        }
        
        if (isset($_POST["answer"]) && !empty($_POST["answer"])) {
            if ($row[0] == $_POST["answer"]) {
                $_SESSION["answered"][$page-1] = 1;
            } else {
                $_SESSION["answered"][$page-1] = 2;
            }
        }

        $page++;
        unset($_POST["submit_answer"]);

        if ($page > $numberOfQuestions) {
            $time = date("H:i:s", microtime(true) - $_SESSION["time"]);
            $_SESSION["time"] = $time;
            if (isset($_SESSION["id"])) {
                $timeword = "time" . $_SESSION["quizz"];
                $scoreword = "score" . $_SESSION["quizz"];
                $id = $_SESSION["id"];
                $score = 0;
                for($i = 0; $i < $numberOfQuestions; $i++){
                    if($_SESSION["answered"][$i] == 1){
                        $score++;
                    }
                }

                $sql = "UPDATE
                            results
                        SET
                            $scoreword=$score, $timeword='$time'
                        WHERE
                            id=$id";

                if (!$conn->query($sql)) {
                    $conn->close();
                    header("location: ../img/marvin.png");
                    die();
                }

                $sql = "SELECT
                            score1, score2, score3, score4
                        FROM
                            results
                        WHERE
                            id=$id";
                
                if (!($result = $conn->query($sql))) {
                    $conn->close();
                    header("location: ../img/marvin.png");
                    die();
                }

                if (!($row = $result->fetch_row())) {
                    $conn->close();
                    header("location: ../img/marvin.png");
                    die();
                }

                $score = 0;
                for($i = 0; $i < $numberOfQuestions; $i++){
                    $score = $score + $row[$i];
                }

                $sql = "UPDATE
                            users
                        SET
                            score=$score
                        WHERE
                            id=$id";

                if (!$conn->query($sql)) {
                    $conn->close();
                    header("location: ../img/marvin.png");
                    die();
                }
            }
            unset($_GET["page"]);

            $conn->close();
            header("location: quizzresult.php");
            exit;
        } else {
            $conn->close();
            header("location: $quizz" . ".php?page=" . $page);
            exit;
        }
    }

    $sql = "SELECT
                *
            FROM
                $quizz
            WHERE
                id=$page";
    
    if (!($result = $conn->query($sql))) {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }
    if (!($row = $result->fetch_row())) {
        $conn->close();
        header("location: ../img/marvin.png");
        die();
    }
    //-------------------------------end of pagination--------------------------------
?>