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
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "../help/buttons.php";
            require_once "../help/resultstable.php";
            require_once "../help/connect.php";
        ?>
        <header>
            <div class="menu-container">
                <button class="button menu-button" onclick="location.href = '../index.php';">Domů</button>
                <button class="button menu-button" onclick="location.href = '../scoreboard.php';">Žebříček hráčů</button>
                <button class="button menu-button" onclick="location.href = '../whatnext.php';">Co dál?</button>
            </div>
            <div class="sign-container">
                <button class="button menu-button" onclick="location.href = '../<?php echo $_SESSION['sign_location']?>';"><?php echo $_SESSION['sign_button']?></button>
                <button class="button register-button" onclick="location.href = '../<?php echo $_SESSION['register_location']?>';"><?php echo $_SESSION['register_button']?></button>
            </div>
        </header>
        <main>
            <div class="user-info">
                <div class="user-avatar">
                    <div><img src="../img/avatars/admin.png"></div>
                </div>
                <div class="user-greeting">
                    Admin<br>
                    <form method="POST">
                      <label for>Vyhledat hráče:</label>
                      Odstranit hráče:
                    </form>
                    Statistiky:
                </div>
                <div class="user-score">
                    <div>
                        <img src="">
                        Skóre: <?php echo $_SESSION["score1"];?>
                        Čas: <?php echo $_SESSION["time1"]?>
                    </div>
                    <div>
                        <img src="">
                        Skóre: <?php echo $_SESSION["score2"]?>
                        Čas: <?php echo $_SESSION["time2"]?>
                    </div>
                    <div>
                        <img src="">
                        Skóre: <?php echo $_SESSION["score3"]?>
                        Čas: <?php echo $_SESSION["time3"]?>
                    </div>
                    <div>
                        <img src="">
                        Skóre: <?php echo $_SESSION["score4"]?>
                        Čas: <?php echo $_SESSION["time4"]?>
                    </div>
                    <div>
                        <img src="">
                        Skóre: <?php echo $_SESSION["score5"]?>
                        Čas: <?php echo $_SESSION["time5"]?>
                    </div>
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