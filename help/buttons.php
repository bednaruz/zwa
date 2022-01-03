<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION["loggedin"]) and $_SESSION["loggedin"]){
        $_SESSION["sign_button"] = "Odhlásit se";
        $_SESSION["register_button"] = "Můj účet";
        $_SESSION["sign_location"] = 'signout.php';
        if($_SESSION["username"] == "admin") {
            $_SESSION["register_location"] = 'users/adminprofile.php';
        } else {
            $_SESSION["register_location"] = 'users/userprofile.php';
        }
    } else {
        $_SESSION["sign_button"] = "Přihlásit se";
        $_SESSION["register_button"] = "Registrovat se";
        $_SESSION["sign_location"] = 'signin.php';
        $_SESSION["register_location"] = 'register.php';
    }
?>