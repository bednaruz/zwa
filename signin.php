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
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <script src="js/validate_sform.js"></script>
        <title>Webovka</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: index.php");
            exit;
        }
 
        require_once "help/connect.php";
        require_once "help/resultstable.php";
 
        $username = $pwd = $mail = $birthyear = $programmed = $hashed_password = "";
        $usernameErr = $pwdErr = $loginErr = "";

        function Test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
            if (empty($_POST["username"])) {
                $usernameErr = "Vyplňte uživatelské jméno, prosím";
            } else {
                $username = Test_input($_POST["username"]);
            }
    
            if (empty($_POST["pwd"])) {
                $pwdErr = "Vyplňte heslo, prosím";
            } else {
                $pwd = Test_input($_POST["pwd"]);
            }
    
            if (empty($usernameErr) and empty($pwdErr)) {
                $query = "SELECT id, username, pwd, score, avatar FROM users WHERE username='$username'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result)) {
                    $row = mysqli_fetch_array($result);
                    $hashed_password = $row[2];
                    if (password_verify($pwd, $hashed_password)) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $username;
                        $_SESSION["score"] = $row[3];
                        $_SESSION["avatar"] = $row[4];
                    
                        $sql = "SELECT * FROM results WHERE userid=$row[0]";
                        $result = $conn->query($sql);
                        if ($result) {
                            $row = $result->fetch_row();
                            $_SESSION["id"] = $row[0];
                            $_SESSION["score1"] = $row[1];
                            $_SESSION["time1"] = $row[2];
                            $_SESSION["score2"] = $row[3];
                            $_SESSION["time2"] = $row[4];
                            $_SESSION["score3"] = $row[5];
                            $_SESSION["time3"] = $row[6];
                            $_SESSION["score4"] = $row[7];
                            $_SESSION["time4"] = $row[8];
                            $_SESSION["score5"] = $row[9];
                            $_SESSION["time5"] = $row[10];
                            header("location: index.php");
                        }
                    } else {
                        $loginErr = "Nesprávné uživatelské jméno nebo heslo";
                    }
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();

        require_once "help/buttons.php";
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
            <div class="center-inline-flex">
                <div class="main-container signin-container">
                    <form id="signin" class="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <span><?php echo $loginErr;?></span><br>
                        <label for="username">Uživatelské jméno:<span><?php echo $usernameErr;?></span></label><br>
                        <input type="text" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" pattern="^([a-zA-Z0-9_-]){1,30}$" required><br>
                        <span id="username_error"></span><br>

                        <label for="pwd">Heslo:<span><?php echo $pwdErr;?></span></label><br>
                        <input type="password" name="pwd" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}" required><br>
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
