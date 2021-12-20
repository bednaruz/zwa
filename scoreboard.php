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

        if (isset($_GET["page"])) {    
            $page = $_GET["page"];    
        } else {    
            $page = 1;    
        }

        $rows_per_page = 10;
        $query = "SELECT id, username, score FROM users ORDER BY users.score DESC";
        $result = mysqli_query($conn, $query);
        $total = mysqli_num_rows($result);  //total number of rows in scoreboard
        $total_pages = ceil($total/$rows_per_page); //how many pages will i need

        $start_from = ($page-1) * $rows_per_page;
        $query = "SELECT id, username, score FROM users ORDER BY users.score DESC, users.id ASC LIMIT $start_from, $rows_per_page";
        $result = mysqli_query($conn, $query);  //only selected number of rows

        require_once "buttons.php";
        ?>
        <header>
            <div class="menu-container">
                <button class="button menu-button" onclick="location.href = 'index.php';">Domů</button>
                <button class="button menu-button" onclick="location.href = 'scoreboard.php';">Žebříček hráčů</button>
                <button class="button menu-button" onclick="location.href = 'whatnext.php';">Co dál?</button>
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

                        for ($i = 1; $i <= $total_pages; $i++) {   
                            if ($i == $page) {   
                                $pagLink = '<a class="active" href="scoreboard.php?page='.$i.'">'.$i.'</a>';   
                            } else {   
                                $pagLink = '<a href="scoreboard.php?page='.$i.'">'.$i.'</a>';    
                            }
                            echo $pagLink;
                        };

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