<?php
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
            
            $_SESSION["quizz"] = "quizz1";
            
            $sql = "CREATE TABLE quizz1(
            id INT(255) AUTO_INCREMENT,
            Unique(id),
            question VARCHAR(50) NOT NULL,
            answer VARCHAR(50) DEFAULT NULL
            )";
            
            if (mysqli_query($conn, $sql)) {
                echo "Table quizz1 created successfully";
                $sql = "INSERT INTO
                            quizz1(question, answer)
                        VALUES 
                            ('Kolik je 1+1?', 2),
                            ('A co 12*25?', 300),
                            ('Jaké číslo se používá pro error Not found', 404),
                            ('aSDGASDGASDF', 23546)";
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
            <div class='center-inline-flex'>
                <div class='main-container'>
                    <form id="quizz" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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