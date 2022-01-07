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
        <link rel="stylesheet" href="../css/style_dark.css">
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../img/favicon/site.webmanifest">
        <script src="js/prevent_resubmit.js"></script>
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "../help/connect.php";
            require_once "../help/buttons.php";

            if (!isset($_SESSION["tables"])) {
                $conn->close();
                header("location: ../index.php");
                exit;
            }
            
            $_SESSION["quizz"] = "1";
            
            require_once "pagination.php";
        ?>
        <header>
            <div class="sign-container">
                <a href="../<?php echo htmlspecialchars($_SESSION['sign_location'])?>" class="button menu-button"><?php echo htmlspecialchars($_SESSION["sign_button"])?></a>
                <a href="../<?php echo htmlspecialchars($_SESSION['register_location'])?>" class="button register-button"><?php echo htmlspecialchars($_SESSION["register_button"])?></a>
            </div>
            <div class="menu-container">
                <a href="../index.php" class="button menu-button">Domů</a>
                <a href="../scoreboard.php" class="button menu-button">Žebříček hráčů</a>
                <a href="../whatnext.php" class="button menu-button">Co dál?</a>
            </div>
        </header>
        <main>
            <div class="center-inline-flex">
                <div class="main-container">
                    <form method="post" action="<?php echo htmlspecialchars("")?>">
                        <label for="answer" class="question"><?php echo htmlspecialchars($row[0] . ")  " . $row[1]) . "</br>";?></label>
                        <input type="text" name="answer"><br>
                        <input type="submit" name="submit_answer" class="button register-button" value="Další"><br>
                    </form>
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