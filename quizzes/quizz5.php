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
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../img/favicon/site.webmanifest">
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "../help/connect.php";
            
            $_SESSION["quizz"] = "5";
            
            $sql = "CREATE TABLE quizz5(
            id INT(255) AUTO_INCREMENT,
            Unique(id),
            question VARCHAR(255) NOT NULL,
            answer VARCHAR(50) DEFAULT NULL
            )";
            
            if (mysqli_query($conn, $sql)) {
                echo "Table quizz5 created successfully";
                $sql = "INSERT INTO
                            quizz5(question, answer)
                        VALUES 
                            ('Jaká je chemická zkratka pro kyselinu, která je nebezpečná tím, že na sebe velmi rychle navazuje vápník a v malém množství ji můžeme najít i v Coca-Cole?', 'H3PO4'),
                            ('Jaká je chemická zkratka pro nebezpečný plyn, který se místo kyslíku naváže na hemoglobin a vzniká špatným spalováním např. v karmě?', 'CO'),
                            ('Co je lehčí a bude se tak držet více při zemi? Molekula kyslíku (O2) nebo oxid uhličitý (CO2)?', 'O2'),
                            ('Jak se jmenuje nejznámější chemický indikátor růžové barvy? (malými písmeny)', 'fenolftalein')";
                if (mysqli_query($conn, $sql)) {
                    echo "Questions inserted correctly";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }        
            } else {
                echo "Error creating table: " . $conn->error;
            }
            
            require_once "pagination.php";
            require_once "../help/buttons.php";
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
            <div class='center-inline-flex'>
                <div class='main-container'>
                    <form id="quizz" method="post">
                        <?php echo $row['id'] . ' ' . $row['question'] . '</br>';?>
                        <input type="text" id="answer" name="answer"><br>
                        <input type="submit" id="submit_answer" name="submit_answer" value="Další"><br>
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