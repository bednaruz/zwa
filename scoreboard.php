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
        <link rel="stylesheet" href="style_dark.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <title>Webovka</title>
    </head>
    <body>
        <?php
        require_once "connect.php";

        $query = "SELECT id, username, score FROM users ORDER by users.score DESC";
        $result = mysqli_query($conn, $query);

        require_once "buttons.php";
        ?>
        <header>
            <div class="menu-container">
                <button class="button menu-button" onclick="location.href = 'index.php';">Domů</button>
                <button class="button menu-button" onclick="location.href = 'scoreboard.php';">Žebříček hráčů</button>
                <button class="button menu-button" onclick="location.href = 'aboutus.php';">Kdo jsme?</button>
            </div>
            <div class="sign-container">
                <button class="button menu-button" onclick="location.href = '<?php echo $_SESSION['sign_location']?>';"><?php echo $_SESSION['sign_button']?></button>
                <button class="button register-button" onclick="location.href = '<?php echo $_SESSION['register_location']?>';"><?php echo $_SESSION['register_button']?></button>
            </div>
        </header>
        <main>
            <div class="score-table">
                <div class="score-header">
                    <div class="score-rank">Pořadí</div>
                    <div class="score-username">Uživatelské jméno</div>
                    <div class="score-score">Skóre</div>
                </div>
                <div class="score-content">
                    <?php
                        while($row = mysqli_fetch_array($result)) {
                            echo '<div class="score-row">';
                                echo '<div class="score-rank">'.$row[0].'</div>';
                                echo '<div class="score-username">'.$row[1].'</div>';
                                echo '<div class="score-score">'.$row[2].'</div>';
                            echo '</div>';
                        }
                        $conn->close();
                    ?>
                </div>
            </div>
        </main>
        <footer>
            <address class="address-style">
                Autorka webu: <a class="address-style" rel="author" href="https://www.linkedin.com/in/r%C5%AF%C5%BEena-bedn%C3%A1%C5%99ov%C3%A1-b601a1b6">Růžena Bednářová</a><br>
                Napište mi: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>