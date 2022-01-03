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
        <script src="js/pwd_strength_bar.js"></script>
        <script src="js/validate_rform.js"></script>
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "help/connect.php";
            require_once "help/resultstable.php";
            //require_once "tempdrop.php";
            //echo "Table dropped";

            $img = "green";

            $sql = "CREATE TABLE users(
            id INT(255) AUTO_INCREMENT,
            Unique(id),
            username VARCHAR(30) NOT NULL,
            mail VARCHAR(50) NOT NULL,
            birthyear SMALLINT(8) DEFAULT NULL,
            programmed TINYINT(1) DEFAULT NULL,
            pwd VARCHAR(255) NOT NULL,
            score INT(255) DEFAULT 0,
            avatar VARCHAR(20) DEFAULT '$img'
            )";
                
            if ($conn->query($sql)) {
                echo "Table users created successfully";
            } else {
                echo "Error creating table: " . $conn->error;
            }

            $username = $mail = $birthyear = $fpwd = $spwd = "";
            $programmed = 0;
            $usernameErr = $mailErr = $pwdErr = "";

            function Test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["username"])) {
                    $usernameErr = "Uživatelské jméno je povinné";
                } else {
                    $username = Test_input($_POST["username"]);
                }
                if (empty($_POST["mail"])) {
                    $mailErr = "E-mail je povinný";
                } else {
                    $mail = Test_input($_POST["mail"]);
                }
                $birthyear = Test_input($_POST["birthyear"]);
                if (Test_input($_POST["programmed"]) == "yes") {
                    $programmed = 1;
                } else {
                    $programmed = 0;
                }
                if (empty($_POST["fpwd"]) or empty($_POST["spwd"])) {
                    $pwdErr = "Heslo je povinné";
                } else {
                    $fpwd = Test_input($_POST["fpwd"]);
                    $spwd = Test_input($_POST["spwd"]);
                    if ($_POST["fpwd"]!= $_POST["spwd"]) {
                        $pwdErr = "Hesla se neshodují";
                    } else {
                        $pwd = password_hash($fpwd, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users(username, mail, birthyear, programmed, pwd) VALUES ('$username', '$mail', $birthyear, $programmed, '$pwd')";
                        if ($conn->query($sql)) {
                            $sql = "SELECT id FROM users WHERE username='$username'";
                            if($result = $conn->query($sql)) {
                                $_SESSION["id"] = $result->fetch_row()[0];
                                $id = $_SESSION["id"];
                                echo "Found the id of user";

                                require_once "help/resultstable.php";
                                $sql = "INSERT INTO results(id) VALUES ($id)";
                                if ($conn->query($sql)) {
                                    echo "<br>New record in results created succesfully<br>";
                                } else {
                                    echo "Error: " . $sql . " : " . $conn->error;
                                }

                                header("location: signin.php");
                            } else {
                                echo "Error: " . $sql . " : " . $conn->error;
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }      
            }

            $conn->close();

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
            <div class="center-inline-flex">
                <div class="main-container register-container">
                    <form id="register" class="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="username">Uživatelské jméno: *</label><br>
                        <input type="text" name="username" pattern="^([a-zA-Z0-9_-]){1,30}$" required><br>
                        <span id="username_error"><?php echo $usernameErr;?></span><br>

                        <label for="mail">E-mail: *</label><br>
                        <input type="email" name="mail" pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})" required><br>
                        <span id="mail_error"><?php echo $mailErr;?></span><br>

                        <label for="birthyear">Rok narození:</label><br>
                        <input type="number" name="birthyear" value="2008" pattern="[1910-2017]{4}"><br>
                        <span id="birthyear_error"></span><br>

                        Už jsi v něčem programoval/a?<br>
                        <input type="radio" name="programmed" value="yes">
                        <label for="programmed">Ano</label><br>
                        <input type="radio" name="programmed" value="no" checked="checked">
                        <label for="programmed">Ne</label><br>
                        <span id="programmed_error"></span><br>

                        <label for="fpwd">Heslo: *</label><br>
                        <input type="password" name="fpwd" id="fpwd" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}" required><br>
                        <meter id="pwd_meter" low="33" high="66" max="100" optimum="70" value="0"></meter><br>
                        <span id="pwd_error"><?php echo $pwdErr;?></span><br>

                        <label for="spwd">Heslo znovu: *</label><br>
                        <input type="password" name="spwd" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,100}" required><br>
                        <span id="match_error"><?php echo $pwdErr;?></span><br>

                        <input type="submit" class="submit" name="register_submit" value="Potvrdit"><br>
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