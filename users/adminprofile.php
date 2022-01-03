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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["search_form"]) && !empty($_POST["search"])) {
                    $name = $_POST["search"];
                    $sql = "SELECT * FROM users WHERE username='$name'";
                    if ($result = $conn->query($sql)) {
                        echo "Query sent successfuly";
                        if ($overall = $result->fetch_row()) {
                            $sql = "SELECT * FROM results WHERE id=$overall[0]";
                            if ($result = $conn->query($sql)) {
                                echo "Quizz results retrieved successfully";
                                $results = $result->fetch_row();
                                $_SESSION["overall"] = $overall;
                                $_SESSION["score_results"] = [$results[1],$results[3],$results[5],$results[7],$results[9]];
                                $_SESSION["time_results"] = [$results[2],$results[4],$results[6],$results[8],$results[10]];
                                
                                header("location: show.php");
                            } else {
                                echo "Error: " . $sql . " : " . $conn->error;
                            }
                        } else {
                            echo "No such user";
                        }
                    } else {
                        echo "Error: " . $sql . " : " . $conn->error;
                    }
                } elseif (isset($_POST["delete_form"]) && !empty($_POST["delete"] && $_POST["delete"] != "admin")) {
                    $name = $_POST["delete"];
                    $sql = "SELECT * FROM users WHERE username='$name'";
                    if ($result = $conn->query($sql)) {
                        echo "Query sent successfuly";
                        if ($overall = $result->fetch_row()) {
                            $id = $overall[0];
                            $sql = "DELETE FROM users WHERE username='$name'";
                            if ($result = $conn->query($sql)) {
                                echo "User deleted from users successfuly";
                                $sql = "DELETE FROM results WHERE id=$id";
                                if ($result = $conn->query($sql)) {
                                    echo "User quizz results deleted successfuly";
                                } else {
                                    echo "Could not delete user results";
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
                    Admin<br>
                    <form method="POST">
                        <label for="search">Vyhledat uživatele: </label>
                        <input type="text" name="search">
                        <input type="submit" name="search_form"><br>
                    </form>
                    <form method="POST">
                        <label for="delete">Vymazat účet uživatele: </label>
                        <input type="text" name="delete">
                        <input type="submit" name="delete_form"><br>
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