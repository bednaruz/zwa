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
        <script src="js/validate_sform.js"></script>
        <script src="js/prevent_resubmit.js"></script>
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("location: index.php");
                exit;
            }
    
            require_once "help/connect.php";
            require_once "help/resultstable.php";
            require_once "help/buttons.php";
            require_once "help/testinput.php";
    
            $username = $pwd = $mail = $birthyear = $programmed = $hashedPassword = "";
            $usernameErr = $pwdErr = $loginErr = "";
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                if (empty($_POST["username"])) {
                    $usernameErr = "Vyplňte uživatelské jméno, prosím";
                    echo $usernameErr;
                } else {
                    $username = testInput($_POST["username"]);
                }
        
                if (empty($_POST["pwd"])) {
                    $pwdErr = "Vyplňte heslo, prosím";
                } else {
                    $pwd = testInput($_POST["pwd"]);
                }
        
                if (empty($usernameErr) && empty($pwdErr)) {

                    $sql = "SELECT
                                id, username, pwd, score, avatar
                            FROM
                                users
                            WHERE
                                username='$username'";
                    
                    if(!($result = $conn->query($sql))) {
                        $conn->close();
                        header("location: img/marvin.png");
                        die();
                    }
                    if ($result->num_rows) {
                        $row = $result->fetch_array();
                        $hashedPassword = $row[2];
                        if (password_verify($pwd, $hashedPassword)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $row[0];
                            $_SESSION["username"] = $row[1];
                            $_SESSION["score"] = $row[3];
                            $_SESSION["avatar"] = $row[4];
                            
                            $sql = "SELECT
                                        *
                                    FROM
                                        results
                                    WHERE
                                        id=$row[0]";

                            if ($result = $conn->query($sql)) {
                                if ($row = $result->fetch_row()) {
                                    $_SESSION["score_results"] = [$results[1], $results[3], $results[5], $results[7], $results[9]];
                                    $_SESSION["time_results"] = [$results[2], $results[4], $results[6], $results[8], $results[10]];
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
                            
                            $conn->close();
                            header("location: index.php");
                            exit;
                        } else {
                            $loginErr = "Nesprávné uživatelské jméno nebo heslo";
                        }
                    } else {
                        $conn->close();
                        header("location: img/marvin.png");
                        die();
                    }
                }
            }
            
            $conn->close();
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
            <div class="center-inline-flex">
                <div class="main-container signin-container">
                    <form id="signin" class="register-form" method="post" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <span><?php echo htmlspecialchars($loginErr);?></span><br>
                        <label for="username">Uživatelské jméno:<span><?php echo htmlspecialchars($usernameErr);?></span></label><br>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars(isset($_POST["username"]) ? $_POST["username"] : ''); ?>" pattern="^([a-zA-Z0-9_-]){1,30}$" required><br>
                        <span id="username_error"></span><br>

                        <label for="pwd">Heslo:<span><?php echo htmlspecialchars($pwdErr);?></span></label><br>
                        <input type="password" id="pwd" name="pwd" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}" required><br>
                        <span id="pwd_error"></span><br>
                        
                        <input type="submit" class="submit" id="signin_submit" name="signin_submit" value="Potvrdit"><br>
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
