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
        <?php require_once "buttons.php";?>
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
            <img src="images/witches.png" alt="čarodějky" class="witches-photo">
            <img src="images/logo.png" alt="logo" class="logo"><br>
            Jsme studentky Fakulty elektrotechnické Českého vysokého učení technického v Praze a říkáme si wITches.
            Pořádáme akce zdarma pro děti od 5. - 9. třídy, zábavně a bez nároku na odměnu.
            Naším cílem je zvýšit zájem dětí o elektrotechniku a informatiku.
            Rozvíjíme spolupráci kluků a holek zábavnou formou.
            Kromě toho vytváříme dívčí komunitu na fakultě, která svojí dobrovolnickou aktivitou přispívá k rozvoji společnosti.
            Při naší činnosti ve wITches si všechno děláme samy, učíme se nové věci, získáváme nové zkušenosti, podporujeme se a učíme se od sebe navzájem.
            Pro zachování týmového ducha, který je nezbytný pro fungování skupiny, se setkáváme na pravidelném teambuildingu, kde hrajeme bowling, skáčeme na trampolínách nebo si uděláme piknik.
            Více se o nás a našich workshopech můžete dozvědět <a href="https://witches.fel.cvut.cz/">zde</a>.
        </main>
        <footer>
            <address class="address-style">
                Autorka webu: <a class="address-style" rel="author" href="https://www.linkedin.com/in/r%C5%AF%C5%BEena-bedn%C3%A1%C5%99ov%C3%A1-b601a1b6">Růžena Bednářová</a><br>
                Napište mi: <a class="address-style" href="mailto:ruzenabed@gmail.com">ruzenabed@gmail.com</a>
            </address>
        </footer>
    </body>
</html>
