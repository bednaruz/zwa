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
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php
            require_once "help/buttons.php";
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
            <div class="hobby">
                <div class="hobby-title">3D tisk</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://www.prusa3d.com/cs/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/prusa.jpg alt="tiskárna Průša">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://www.thingiverse.com/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/3dmodel.png alt="3D model">
                        </a>
                    </div>
                </div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://www.autodesk.com/products/fusion-360/free-trial" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/fusion.png alt="program Fusion360">
                        </a>
                    </div>
                </div>
        
                <div class="hobby-title">Stavebnice</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://store.makeblock.com/products/diy-coding-robot-kits-mbot" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/mBot.jpg alt="mBot">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://www.lego.com/cs-cz/themes/mindstorms/about" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/legomindstorms.png alt="robot lego mindstorms">
                        </a>
                    </div>
                </div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://microbit.org/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/microbit.jpg alt="micro:bit">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://boffin.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/boffin.jpg alt="stavebnice boffin">
                        </a>
                    </div>
                </div>
                
                <div class="hobby-title">DIY</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://dratek.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/dratek.png alt="drátek">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://www.laskakit.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/laskaarduino.png alt="laskarduino">
                        </a>
                    </div>
                </div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://www.gme.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/gm.jpg alt="GM electronics">
                        </a>
                    </div>
                </div>

                <div class="hobby-title">CTF</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://picoctf.org/index#picogym" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/picoCTF.png alt="pico capture the flag">
                        </a>
                    </div>
                </div>

                <div class="hobby-title">Programování</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://scratch.mit.edu/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/scratch.png alt="scratch">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://ide.mblock.cc/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/mbotcode.jpg alt="mBlock code editor">
                        </a>
                    </div>
                </div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://bootcamp.berkeley.edu/blog/most-in-demand-programming-languages/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/code.jpg alt="kód">
                        </a>
                    </div>
                </div>

                <div class="hobby-title">wITches</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://witches.fel.cvut.cz/" target="_blank">
                            <img class="hobby-img" src="img/whatnext/logo.png" alt="logo">
                        </a>
                    </div>
                </div>

                <div class="hobby-title">Soutěže</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://www.ibobr.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/bobrik.png alt="Bobřík informatiky">
                        </a>
                    </div>
                    <div class="hobby-column2">
                        <a class="hobby-img" href="https://robosoutez.fel.cvut.cz/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/robosoutez.jpg alt="robosoutěž">
                        </a>
                    </div>
                </div>
                
                <div class="hobby-title">Kutilové</div>
                <div class="hobby-row">
                    <div class="hobby-column1">
                        <a class="hobby-img" href="https://www.instructables.com/" target="_BLANK">
                            <img class="hobby-img" src=img/whatnext/instructables.png alt="instuctables">
                        </a>
                    </div>
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
