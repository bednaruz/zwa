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
        <script src="validate_sform.js"></script>
        <title>Webovka</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            header("location: index.php");
            exit;
        }
 
        require_once "connect.php";
 
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
                $query = "SELECT id, username, pwd, score FROM users WHERE username='$username'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result)) {
                    $row = mysqli_fetch_array($result);
                    $hashed_password = $row[2];
                    if (password_verify($pwd, $hashed_password)) {
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row[0];
                        $_SESSION["username"] = $username;
                        $_SESSION["score"] = $row[3];
                        header("location: index.php");
                    } else {
                        $loginErr = "Nesprávné uživatelské jméno nebo heslo";
                    }
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();

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
                        
                        <input type="submit" id="signin_submit" name="signin_submit" value="Potvrdit"><br>
                    </form>
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
