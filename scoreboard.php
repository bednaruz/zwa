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
        <link rel="stylesheet" href="css/style_dark.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/site.webmanifest">
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
        require_once "help/connect.php";

        if (isset($_GET["page"])) {    
            $page = $_GET["page"];    
        } else {    
            $page = 1;    
        }

        $rows_per_page = 10;
        $query = "SELECT avatar, id, username, score FROM users ORDER BY users.score DESC";
        $result = mysqli_query($conn, $query);
        $total = mysqli_num_rows($result);  //total number of rows in scoreboard
        $total_pages = ceil($total/$rows_per_page); //how many pages will i need

        $start_from = ($page-1) * $rows_per_page;
        $query = "SELECT avatar, id, username, score FROM users ORDER BY users.score DESC, users.id ASC LIMIT $start_from, $rows_per_page";
        $result = mysqli_query($conn, $query);  //only selected number of rows

        require_once "help/buttons.php";
        ?>
        <header>
            <div class="menu-container">
                <a href="index.php" class="button menu-button">Domů</a>
                <a href="scoreboard.php" class="button menu-button">Žebříček hráčů</a>
                <a href="whatnext.php" class="button menu-button">Co dál?</a>
            </div>
            <div class="sign-container">
                <a href="<?php echo $_SESSION['sign_location']?>" class="button menu-button"><?php echo $_SESSION['sign_button']?></a>
                <a href="<?php echo $_SESSION['register_location']?>" class="button register-button"><?php echo $_SESSION['register_button']?></a>
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
                                echo '<div class="score-avatar"><img src="img/avatars/'.$row[0].'.png"></div>';
                                echo '<div class="score-rank">'.$row[1].'</div>';
                                echo '<div class="score-username">'.$row[2].'</div>';
                                echo '<div class="score-score">'.$row[3].'</div>';
                            echo '</div>';
                        }

                        $prevLink = '<a href="scoreboard.php?page='. (($page == 1) ? 1 : --$page). '">'.'Prev'.'</a>';
                        echo $prevLink;
                        for ($i = 1; $i <= $total_pages; $i++) {   
                            if ($i == $page) {   
                                $pagLink = '<a class="active" href="scoreboard.php?page='.$i.'">'.$i.'</a>';   
                            } else {   
                                $pagLink = '<a href="scoreboard.php?page='.$i.'">'.$i.'</a>';    
                            }
                            echo $pagLink;
                        };
                        $nextLink = '<a href="scoreboard.php?page='. (($page == $total_pages) ? $page : ++$page). '">'.'Next'.'</a>';
                        echo $nextLink;

                        $conn->close();
                    ?>
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