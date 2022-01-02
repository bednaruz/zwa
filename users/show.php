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

            if (!isset($_SESSION["overall"])) {
              header("location: ../index.php");
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["search_form"]) && !empty($_POST["search"])) {
                    $name = $_POST["search"];
                    $sql = "SELECT * FROM users WHERE username='$name'";
                    if ($result = $conn->query($sql)) {
                        echo "Query sent successfuly";
                        if ($overall = $result->fetch_row()) {
                            $sql = "SELECT * FROM results WHERE userid='$overall[0]'";
                            if ($result = $conn->query($sql)) {
                                echo "Quizz results retrieved successfully";
                                $quizz_results = $result->fetch_row();
                            } else {
                                echo "Second sql failed<br>";
                                echo "Error: " . $sql . " : " . $conn->error;
                            }
                        } else {
                            echo "No such user";
                        }
                    } else {
                        echo "First sql failed<br>";
                        echo "Error: " . $sql . " : " . $conn->error;
                    }
                } elseif (isset($_POST["delete_form"]) && !empty($_POST["delete"])) {
                    $name = $_POST["delete"];
                    $sql = "SELECT * FROM users WHERE username='$name'";
                    if ($result = $conn->query($sql)) {
                        echo "Query sent successfuly";
                        if ($overall = $result->fetch_row()) {
                            $id = $overall[0];
                            $sql = "DELETE FROM users WHERE username='$name'";
                            if ($result = $conn->query($sql)) {
                                echo "User deleted from users successfuly";
                                $sql = "DELETE FROM results WHERE userid='$id'";
                                if ($result = $conn->query($sql)) {
                                    echo "User quizz results deleted successfuly";
                                    if(isset($_SESSION["overall"])) {
                                      unset($_SESSION["overall"]);
                                      unset($_SESSION["quizz_results"]);
                                    }
                                    header("location: adminprofile.php");
                                } else {
                                    echo "Could not delete user quizz results";
                                }
                            } else {
                                echo "Could not delete user from users";
                            }
                        } else {
                            echo "No such user";
                        }
                    }
                }
            }
        ?>
        <header>
            <div class="menu-container">
                <a href="../index.php" class="button menu-button">Domů</a>
                <a href="../scoreboard.php" class="button menu-button">Žebříček hráčů</a>
                <a href="../whatnext.php" class="button menu-button">Co dál?</a>
            </div>
            <div class="sign-container">
                <a href="../<?php echo $_SESSION['sign_location']?>" class="button menu-button"><?php echo $_SESSION['sign_button']?></a>
                <a href="../<?php echo $_SESSION['register_location']?>" class="button register-button"><?php echo $_SESSION['register_button']?></a>
            </div>
        </header>
        <main>
            <div class="user-info">
                <div class="user-avatar">
                    <div><img src="../img/avatars/admin.png"></div>
                </div>
                <div class="user-greeting">
                    Admin show<br>
                    <form method="POST">
                        <label for="search">Vyhledat uživatele: </label>
                        <input type="text" name="search">
                        <input type="submit" name="search_form" value="Potvrdit"><br>
                    </form>
                    <form method="POST">
                        <label for="delete">Vymazat účet uživatele: </label>
                        <input type="text" name="delete">
                        <input type="submit" name="delete_form" value="Potvrdit"><br>
                    </form>
                </div>
                <div class="user-main">
                  ID: <?php echo $_SESSION["overall"][0]?><br>
                  Uživatelské jméno: <?php echo $_SESSION["overall"][1]?><br>
                  Email: <?php echo $_SESSION["overall"][2]?><br>
                  Rok narození: <?php echo $_SESSION["overall"][3]?><br>
                  Už někdy programoval/a:
                  <?php 
                    if ($_SESSION["overall"][4]) {
                      echo "Ne";
                    } else {
                      echo "Ano";
                    }
                  ?><br>
                  Celkové skóre: <?php echo $_SESSION["overall"][6]?><br>
                </div>
                <div class="user-score">
                    <div>
                        <img src="../img/themes/pi.png" alt="pi">
                        Skóre: <?php echo $_SESSION["quizz_results"][1]?><br>
                        Čas: <?php echo $_SESSION["quizz_results"][2]?>
                    </div>
                    <div>
                        <img src="../img/themes/code.png" alt="code parentheses">
                        Skóre: <?php echo $_SESSION["quizz_results"][3]?><br>
                        Čas: <?php echo $_SESSION["quizz_results"][4]?>
                    </div>
                    <div>
                        <img src="../img/themes/internet.png" alt="internet">
                        Skóre: <?php echo $_SESSION["quizz_results"][5]?><br>
                        Čas: <?php echo $_SESSION["quizz_results"][6]?>
                    </div>
                    <div>
                        <img src="../img/themes/transistor.png" alt="transistor">
                        Skóre: <?php echo $_SESSION["quizz_results"][7]?><br>
                        Čas: <?php echo $_SESSION["quizz_results"][8]?>
                    </div>
                    <div>
                        <img src="../img/themes/chemistry.png" alt="chemistry">
                        Skóre: <?php echo $_SESSION["quizz_results"][9]?><br>
                        Čas: <?php echo $_SESSION["quizz_results"][10]?>
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