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
            require_once "../help/buttons.php";

            if (!isset($_SESSION["time"]) || !isset($_SESSION["answered"])) {
                $conn->close();
                header("location: ../index.php");
                exit;
            }

            $quizz = "quizz" . $_SESSION["quizz"];

            $sql = "SELECT
                        *
                    FROM
                        $quizz";
            
            if (!$result = $conn->query($sql)) {
                $conn->close();
                header("location: ../img/marvin.png");
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
            <div class="results">Tvoje výsledky<br></div>
            <div class="results-detail">
                <?php
                    $score = 0;
                    $time = $_SESSION["time"];
                    for($i = 0; $i < 4; $i++){
                        $row = $result->fetch_row();
                        echo htmlspecialchars("Otázka: " . $row[1]) . "<br>";
                        echo '<div class="results-answered">';
                            if ($_SESSION["answered"][$i] == 0) {
                                echo "NEZODPOVĚZENA";
                            } elseif ($_SESSION["answered"][$i] == 1){
                                echo "SPRÁVNĚ";
                                $score++;
                            } else {
                                echo "ŠPATNĚ";
                            }
                            echo "<br><br>";
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="results-points">
                Body: <?php echo htmlspecialchars($score) ?><br>
                Čas: <?php
                        echo htmlspecialchars($time);
                        $conn->close();
                        unset($_SESSION["time"]);
                        unset($_SESSION["answered"]);
                    ?>
                <br><br>
            </div>
        </main>
        <footer>
            <address class="address-style">
                Email: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>