<?php 
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Růžena Bednářová">
        <link rel="stylesheet" href="style_dark.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <title>Webovka</title>
    </head>
    <body>
        <?php
        require_once "connect.php";

        if (isset($_GET['quizz'])){
            $link = $_GET['quizz'];
            if ($link == '1'){
                $quizz = "quizz1";
                require_once "quizz1.php";
            }
            if ($link == '2'){
                $quizz = "quizz2";
                require_once "quizz2.php";
            }
            if ($link == '3'){
                $quizz = "quizz3";
                require_once "quizz3.php";
            }
            if ($link == '4'){
                $quizz = "quizz4";
                require_once "quizz4.php";
            }
            if ($link == '5'){
                $quizz = "quizz5";
                require_once "quizz5.php";
            }
        } else {
            $_GET['quizz'] = '1';
            $quizz = "quizz1";
            require_once "quizz1.php";
        }
        
        //-----------------------------pagination---------------------------------------
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
                unset($_GET['quizz']);
                unset($_GET['page']);
                $conn->close();
                header("location: index.php");
            } else {
                header("location: quizz.php?page=" . $page);
            }
        }

        $query = "SELECT *FROM $quizz WHERE id = $page";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        //-------------------------------end of pagination--------------------------------
        
        require_once "buttons.php";
        ?>
        <header>
            <div class="menu-container">
                <button class="button menu-button" onclick="location.href = 'index.php';">Domů</button>
                <button class="button menu-button" onclick="location.href = 'scoreboard.php';">Žebříček hráčů</button>
                <button class="button menu-button" onclick="location.href = 'aboutus.php';">Kdo jsme?</button>
            </div>
            <div class="sign-container">
                <button class="button menu-button" onclick="location.href = '<?php echo $_SESSION['sign_location']?>';"><?php echo $_SESSION['sign_button']?></button>
                <button class="button register-button" onclick="location.href = '<?php echo $_SESSION['register_location']?>';"><?php echo $_SESSION['register_button']?></button>
            </div>
        </header>
        <main>
        <div class='center-inline-flex'>
            <div class='main-container'>
                <form id="quizz" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <?php echo $row['id'] . ' ' . $row['question'] . '</br>';?>
                    <input type="text" id="answer" name="answer"><br>
                    <input type="submit" id="submit_answer" name="submit_answer" value="Další"><br>
                </form>
            </div>
        </div>
        </main>
        <footer>
            <address class="address-style">
                Napište mi: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>