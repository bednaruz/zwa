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
            require_once "../help/connect.php";

            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                $conn->close();
                header("location: ../index.php");
                exit;
            }
            
            require_once "userinfo.php";
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
            <div class="user-info">
                <div class="user-avatar">
                    <div><img src="../img/avatars/admin.png"></div>
                </div>
                <div class="user-greeting">
                    Admin<br><br>
                    <form method="post" action="<?php htmlspecialchars("")?>">
                        <label for="search">Vyhledat uživatele: </label>
                        <input type="text" name="search">
                        <input type="submit" class="button register-button" name="search_form" value="Vyhledat"><br>
                    </form>
                    <form method="post" action="<?php htmlspecialchars("")?>">
                        <label for="delete">Vymazat účet uživatele: </label>
                        <input type="text" name="delete">
                        <input type="submit" class="button register-button" name="delete_form" value="Vymazat"><br>
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