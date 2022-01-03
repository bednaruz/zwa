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
            
            $_SESSION["quizz"] = "2";
            
            $sql = "CREATE TABLE quizz2(
            id INT(255) AUTO_INCREMENT,
            Unique(id),
            question VARCHAR(255) NOT NULL,
            answer VARCHAR(50) DEFAULT NULL
            )";
            
            if (mysqli_query($conn, $sql)) {
                echo "Table quizz2 created successfully";
                $code = 'while(True):print("Hello world")';
                $sql = "INSERT INTO
                            quizz2(question, answer)
                        VALUES 
                            ('Co je dvojice slov reprezentující podmínku v programování (první slovo-druhé slovo)?', 'if-else'),
                            ('Napište program, který bude v pythonu donekonečna vypisovat Hello world (program napište bez mezer a enterů).', '$code'),
                            ('a = 1, b = a, a = 2. Jakou číselnou hodnotu má b?', 1),
                            ('Jakou dvojici klíčových slov můžete použít, když chcete vyzkoušet část kódu, ale zároveň nechcete, aby program v případě neúspěšnosti skočil chybou? (první slovo-druhé slovo)', 'try-except')";
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