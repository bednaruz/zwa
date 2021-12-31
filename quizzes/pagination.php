<?php
    //-----------------------------pagination---------------------------------------
    $quizz = $_SESSION['quizz'];
    $query = "SELECT *FROM $quizz";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {  
        $page = 1;
    }
    if (isset($_POST['submit_answer'])) { //increment number of page, switch to next page, safe the answer to database
        $page++;
        if ($page > $number_of_result) {
            unset($_SESSION['quizz']);
            unset($_GET['page']);
            $conn->close();
            header("location: ../index.php");
        } else {
            header("location: $quizz" . ".php?page=" . $page);
        }
    }
    $query = "SELECT *FROM $quizz WHERE id = $page";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    //-------------------------------end of pagination--------------------------------
?>