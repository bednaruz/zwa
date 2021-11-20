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
        <link rel="stylesheet" href="style_cyberpunk.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <title>Webovka</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION["loggedin"])){
            echo $_SESSION["loggedin"];
        } else {
            echo "Session isnt set";
        }
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
            <div class="circle">
                <a href="quizz1.php" name="?quizz=1" class="theme-image"><img src="images/pi_cir.gif" alt="pi"></a>
                <a href="quizz2.php" name="?quizz=2" class="theme-image"><img src="images/pi_cir.gif" alt="pi"></a>
                <a href="quizz3.php" name="?quizz=3" class="theme-image"><img src="images/pi_cir.gif" alt="pi"></a>
                <a href="quizz4.php" name="?quizz=4" class="theme-image"><img src="images/pi_cir.gif" alt="pi"></a>
                <a href="quizz5.php" name="?quizz=5" class="theme-image"><img src="images/pi_cir.gif" alt="pi"></a>
            </div>
        </main>
        <footer>
            <address class="address-style">
                Autorka webu: <a class="address-style" rel="author" href="https://www.linkedin.com/in/r%C5%AF%C5%BEena-bedn%C3%A1%C5%99ov%C3%A1-b601a1b6">Růžena Bednářová</a><br>
                Napište mi: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>