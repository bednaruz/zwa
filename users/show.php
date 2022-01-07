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
            require_once "../help/connect.php";
            require_once "../help/resultstable.php";
            require_once "../help/buttons.php";

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
                    <div><img src="../img/avatars/admin.png" alt="admin avatar"></div>
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
                <div class="user-main">
                    ID: <?php echo htmlspecialchars($_SESSION["overall"][0])?><br>
                    Uživatelské jméno: <?php echo htmlspecialchars($_SESSION["overall"][1])?><br>
                    Email: <?php echo htmlspecialchars($_SESSION["overall"][2])?><br>
                    Rok narození: <?php echo htmlspecialchars($_SESSION["overall"][3])?><br>
                    Už někdy programoval/a:
                    <?php 
                        if ($_SESSION["overall"][4]) {
                            echo "Ne";
                        } else {
                            echo "Ano";
                        }
                    ?><br>
                    Celkové skóre: <?php echo htmlspecialchars($_SESSION["overall"][6])?><br>
                </div>
                <div class="user-score">
                    <div class="quizz">
                        <img class="quizz-img" src="../img/themes/pi.png" alt="pi"><br>
                        Skóre: <?php echo htmlspecialchars($_SESSION["score_results"][0])?><br>
                        Čas: <?php echo htmlspecialchars($_SESSION["time_results"][0])?>
                    </div>
                    <div class="quizz">
                        <img class="quizz-img" src="../img/themes/code.png" alt="code parentheses"><br>
                        Skóre: <?php echo htmlspecialchars($_SESSION["score_results"][1])?><br>
                        Čas: <?php echo htmlspecialchars($_SESSION["time_results"][1])?>
                    </div>
                    <div class="quizz">
                        <img class="quizz-img" src="../img/themes/internet.png" alt="internet"><br>
                        Skóre: <?php echo htmlspecialchars($_SESSION["score_results"][2])?><br>
                        Čas: <?php echo htmlspecialchars($_SESSION["time_results"][2])?>
                    </div>
                    <div class="quizz">
                        <img class="quizz-img" src="../img/themes/transistor.png" alt="transistor"><br>
                        Skóre: <?php echo htmlspecialchars($_SESSION["score_results"][3])?><br>
                        Čas: <?php echo htmlspecialchars($_SESSION["time_results"][3])?>
                    </div>
                    <div class="quizz">
                        <img class="quizz-img" src="../img/themes/chemistry.png" alt="chemistry"><br>
                        Skóre: <?php echo htmlspecialchars($_SESSION["score_results"][4])?><br>
                        Čas: <?php echo htmlspecialchars($_SESSION["time_results"][4])?>
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