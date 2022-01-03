<?php
    ob_start();
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
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/site.webmanifest">
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
                <a href="index.php" class="button menu-button">Domů</a>
                <a href="scoreboard.php" class="button menu-button">Žebříček hráčů</a>
                <a href="whatnext.php" class="button menu-button">Co dál?</a>
            </div>
            <div class="sign-container">
                <a href="<?php echo $_SESSION['sign_location']?>" class="button menu-button"><?php echo $_SESSION['sign_button']?></a>
                <a href="<?php echo $_SESSION['register_location']?>" class="button register-button"><?php echo $_SESSION['register_button']?></a>
            </div>
        </header>
        <main>
            <div class="circle">
                <div id="theme1"><a href="quizzes/quizz1.php" id="quizz1" class="theme" action=""><img class="theme-image" src="img/themes/pi.png" alt="pi"></a></div>
                <div id="theme24">
                    <a href="quizzes/quizz4.php" id="quizz4"><img class="theme-image" src="img/themes/transistor.png" alt="transistor"></a>
                    <a href="quizzes/quizz2.php" id="quizz2"><img class="theme-image" src="img/themes/code.png" alt="code parenthesis"></a> 
                </div>
                <div id="theme35">
                    <a href="quizzes/quizz5.php" id="quizz5"><img class="theme-image" src="img/themes/chemistry.png" alt="chemistry"></a>
                    <a href="quizzes/quizz3.php" id="quizz3"><img class="theme-image" src="img/themes/internet.png" alt="internet"></a>
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