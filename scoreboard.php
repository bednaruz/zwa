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
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/site.webmanifest">
        <script src="js/prevent_resubmit.js"></script>
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "help/connect.php";
            require_once "help/buttons.php";

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["desc"])) {
                    $_SESSION["ordered"] = "DESC";
                } else if (isset($_POST["asc"])) {
                    $_SESSION["ordered"] = "ASC";
                } else if (isset($_POST["prog"])) {
                    $_SESSION["prog"] = " WHERE programmed=1 ";
                } else if (isset($_POST["noprog"])) {
                    $_SESSION["prog"] = " WHERE programmed=0 ";
                } else if (isset($_POST["all"])) {
                    $_SESSION["prog"] = "";
                }
                unset($_POST);
                header("location: scoreboard.php?page=1");
            } elseif (!isset($_SESSION["prog"])) {
                $_SESSION["ordered"] = "DESC";
                $_SESSION["prog"] = "";
            }

            if (isset($_GET["page"])) {    
                $page = $_GET["page"];
            } else {    
                $page = 1;    
            }

            $ordered = $_SESSION["ordered"];
            $programmed = $_SESSION["prog"];
            $rowsPerPage = 5;

            $sql = "SELECT
                        avatar, id, username, score
                    FROM
                        users
                    $programmed
                    ORDER BY
                        users.score $ordered";

            if (!($result = $conn->query($sql))) {
                $conn->close();
                header("location: img/marvin.png");
                die();
            }

            $total = $result->num_rows;
            $totalPages = ceil($total/$rowsPerPage);
            $startFrom = ($page-1) * $rowsPerPage;

            $sql = "SELECT
                        avatar, id, username, score
                    FROM
                        users
                    $programmed
                    ORDER BY
                        users.score $ordered,
                        users.id ASC
                    LIMIT
                        $startFrom, $rowsPerPage";

            if (!($result = $conn->query($sql))) {
                $conn->close();
                header("location: img/marvin.png");
                die();
            }
        ?>
        <header>
            <div class="sign-container">
                <a href="<?php echo htmlspecialchars($_SESSION['sign_location'])?>" class="button menu-button"><?php echo htmlspecialchars($_SESSION["sign_button"])?></a>
                <a href="<?php echo htmlspecialchars($_SESSION['register_location'])?>" class="button register-button"><?php echo htmlspecialchars($_SESSION["register_button"])?></a>
            </div>
            <div class="menu-container">
                <a href="index.php" class="button menu-button">Domů</a>
                <a href="scoreboard.php" class="button menu-button">Žebříček hráčů</a>
                <a href="whatnext.php" class="button menu-button">Co dál?</a>
            </div>   
        </header>
        <main>
            <div class="filter">
                <div class="order-buttons">
                    <form method="post">
                        <label for="desc"></label>
                        <input type="submit" id="desc" name="desc" class="filter-button" value="Od nejvyššího skóre">
                        <label for="asc"></label>
                        <input type="submit" id="asc" name="asc" class="filter-button" value="Od nejnižšího skóre">
                    </form>
                </div>
                <div class="prog-buttons">
                    <form method="post">
                        <label for="prog"></label>
                        <input type="submit" id="prog" name="prog" class="filter-button" value="Programovali">
                        <label for="noprog"></label>
                        <input type="submit" id="noprog" name="noprog" class="filter-button" value="Neprogramovali">
                        <label for="all"></label>
                        <input type="submit" id="all" name="all" class="filter-button" value="Všichni">
                    </form>
                </div>
            </div>
            <div class="score-table">
                <div class="score-header">
                    <div class="header-id">ID</div>
                    <div class="header-username">Uživatelské jméno</div>
                    <div class="header-score">Skóre</div>
                </div>
                <div class="score-content">
                    <?php
                        while($row = $result->fetch_array()) {
                            echo '<img class="content-avatar" src="img/avatars/'.htmlspecialchars($row[0]).'.png" alt="user avatar">';
                            echo '<div class="content-id">'.htmlspecialchars($row[1]).'</div>';
                            echo '<div class="content-username">'.htmlspecialchars($row[2]).'</div>';
                            echo '<div class="content-score">'.htmlspecialchars($row[3]).'</div>';
                        }
                    ?>
                </div>
                <?php
                    echo '<div class="pagination">';
                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        } else {
                            $page = 1;
                        }
                        $prevLink = '<a class="pagination-button" href="scoreboard.php?page='. htmlspecialchars((($page == 1) ? 1 : --$page)). '">'.'Zpět'.'</a>';
                        echo $prevLink;

                        for ($i = 1; $i <= $totalPages; $i++) {   
                            if ($i == $page) {   
                                $pagLink = '<a class="active pagination-button" href="scoreboard.php?page='.$i.'">'.$i.'</a>';   
                            } else {   
                                $pagLink = '<a class="pagination-button" href="scoreboard.php?page='.$i.'">'.$i.'</a>';    
                            }
                            echo $pagLink;
                        };

                        $nextLink = '<a class="pagination-button" href="scoreboard.php?page='. htmlspecialchars(($page == $totalPages) ? $page : ++$page). '">'.'Další'.'</a>';
                        echo $nextLink;
                    echo '</div>';

                    $conn->close();
                ?>
            </div>
        </main>
        <footer>
            <address class="address-style">
                Email: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>