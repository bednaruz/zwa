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

            if (!isset($_SESSION["id"])) {
                $conn->close();
                header("location: ../index.php");
                exit;
            }

            $id = $_SESSION["id"];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST["green"])) {
                    $img = "green";
                } elseif (!empty($_POST["red"])) {
                    $img = "red";
                } elseif (!empty($_POST["blue"])) {
                    $img = "blue";
                } elseif (!empty($_POST["purple"])) {
                    $img = "purple";
                } elseif (!empty($_POST["white"])) {
                    $img = "white";
                }

                $sql = "UPDATE
                            users
                        SET
                            avatar='$img'
                        WHERE
                            id=$id";

                if ($conn->query($sql)) {
                    $_SESSION["avatar"] = $img;
                } else {
                    $conn->close();
                    header("location: img/marvin.png");
                    die();
                }
            }

            $sql = "SELECT
                        *
                    FROM
                        results
                    WHERE
                        id=$id";

            if ($result = $conn->query($sql)) {
                if ($results = $result->fetch_row()) {
                    $_SESSION["score_results"] = [$results[1],$results[3],$results[5],$results[7],$results[9]];
                    $_SESSION["time_results"] = [$results[2],$results[4],$results[6],$results[8],$results[10]];
                } else {
                    $conn->close();
                    header("location: img/marvin.png");
                    die();
                }
            } else {
                $conn->close();
                header("location: img/marvin.png");
                die();
            }
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
                    <div><img src="../img/avatars/<?php echo htmlspecialchars($_SESSION['avatar']);?>.png"></div>
                    <div class="avatar">
                        <button>Změnit avatar</button>
                        <form method="post" class="avatar-content">
                            <input type="submit" class="av-green avatar-option" name="green" value="green">
                            <input type="submit" class="av-red avatar-option" name="red" value="red">
                            <input type="submit" class="av-blue avatar-option" name="blue" value="blue">
                            <input type="submit" class="av-purple avatar-option" name="purple" value="purple">
                            <input type="submit" class="av-white avatar-option" name="white" value="white">
                        </form>
                    </div>
                </div>
                <div class="user-greeting">
                    Ahoj <?php echo htmlspecialchars($_SESSION["username"])?>!<br>
                    Tvoje celkové skóre: <?php echo htmlspecialchars($_SESSION["score"])?>
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