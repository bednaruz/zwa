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
        
        $query = "SELECT id, question, answer FROM $quizz";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "Quizz content succesfully obtained " . $quizz;
        } else {
            echo "Failed to obtain " . $quizz . " content";
        }
        while ($row = mysqli_fetch_array($result)){
            $ids[] = $row[0];
            $questions[] = $row[1];
            $answers[] = $row[2];
        }
        echo "Id of quizz is " . $_SESSION['index'];
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
            <div class="center-inline-flex">
                <div class="main-container quizz-container">
                    <?php
                    //echo $questions[$_SESSION['index']];
                    ?>
                    <input type="submit" id="quizz_next" name="quizz_next" value="Další"><br>
                </div>
            </div>
            <?php $conn->close();?>
        </main>
        <footer>
            <address class="address-style">
                Autorka webu: <a class="address-style" rel="author" href="https://www.linkedin.com/in/r%C5%AF%C5%BEena-bedn%C3%A1%C5%99ov%C3%A1-b601a1b6">Růžena Bednářová</a><br>
                Napište mi: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>