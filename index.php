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
        <link rel="stylesheet" href="css/style_dark.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION["loggedin"])){
            echo $_SESSION["loggedin"];
        } else {
            echo "Session isnt set";
        }
        require_once "help/buttons.php";
        ?>
        <header>
            <div class="menu-container">
                <button class="button menu-button" onclick="location.href = 'index.php';">Domů</button>
                <button class="button menu-button" onclick="location.href = 'scoreboard.php';">Žebříček hráčů</button>
                <button class="button menu-button" onclick="location.href = 'whatnext.php';">Co dál?</button>
            </div>
            <div class="sign-container">
                <button class="button menu-button" onclick="location.href = '<?php echo $_SESSION['sign_location']?>';"><?php echo $_SESSION['sign_button']?></button>
                <button class="button register-button" onclick="location.href = '<?php echo $_SESSION['register_location']?>';"><?php echo $_SESSION['register_button']?></button>
            </div>
        </header>
        <main>
            <div class="circle">
                <div id="theme1"><a href="quizzes/quizz.php" name="?quizz=1" class="theme"><img class="theme-image" src="img/picir.gif" alt="pi"></a></div>
                <div id="theme24">
                    <a href="quizzes/quizz.php" name="?quizz=4"><img class="theme-image" src="img/picir.gif" alt="pi"></a>
                    <a href="quizzes/quizz.php" name="?quizz=2"><img class="theme-image" src="img/picir.gif" alt="pi"></a> 
                </div>
                <div id="theme35">
                    <a href="quizzes/quizz.php" name="?quizz=5"><img class="theme-image" src="img/picir.gif" alt="pi"></a>
                    <a href="quizzes/quizz.php" name="?quizz=3"><img class="theme-image" src="img/picir.gif" alt="pi"></a>
                </div>
            </div>
        </main>
        <footer>
            <address class="address-style">
                Email: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>