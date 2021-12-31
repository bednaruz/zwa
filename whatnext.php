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
        <title>Let's learn 💻</title>
    </head>
    <body>
        <?php require_once "help/buttons.php";?>
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
            <div class="hobby">
                <div class="hobby_title">3D tisk</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://www.prusa3d.com/cs/" target="_BLANK"><img src=img/prusa.jpg alt="tiskárna Průša"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.thingiverse.com/" target="_BLANK"><img src=img/3dmodel.png alt="3D model"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://www.autodesk.com/products/fusion-360/free-trial" target="_BLANK"><img src=img/fusion.png alt="program Fusion360"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Stavebnice</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://store.makeblock.com/products/diy-coding-robot-kits-mbot" target="_BLANK"><img src=img/mBot.jpg alt="mBot"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.lego.com/cs-cz/themes/mindstorms/about" target="_BLANK"><img src=img/legomindstorms.png alt="robot lego mindstorms"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://microbit.org/" target="_BLANK"><img src=img/microbit.jpg alt="micro:bit"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://boffin.cz/" target="_BLANK"><img src=img/boffin.jpg alt="stavebnice boffin"></a></div>
                </div>

                <div class="hobby_title">DIY</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.laskakit.cz/" target="_BLANK"><img src=img/laskaarduino.png alt="laskarduino"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://dratek.cz/" target="_BLANK"><img src=img/dratek.png alt="drátek"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.gme.cz/" target="_BLANK"><img src=img/gm.jpg alt="GM electronics"></a></div>
                </div>
                
                <div class="hobby_title">CTF</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://picoctf.org/index#picogym" target="_BLANK"><img src=img/picoCTF.png alt="pico capture the flag"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Programování</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" ref="https://scratch.mit.edu/" target="_BLANK"><img src=img/scratch.png alt="scratch"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://ide.mblock.cc/" target="_BLANK"><img src=img/mbotcode.jpg alt="mBlock code editor"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://bootcamp.berkeley.edu/blog/most-in-demand-programming-languages/" target="_BLANK"><img src=img/code.jpg alt="kód"></a></div>
                </div>
                
                <div class="hobby_title">wITches</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://witches.fel.cvut.cz/" target="_blank"><img class="hobby_img" src="img/logo.png" alt="logo"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Soutěže</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.ibobr.cz/" target="_BLANK"><img src=img/bobrik.png alt="Bobřík informatiky"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://robosoutez.fel.cvut.cz/" target="_BLANK"><img src=img/robosoutez.jpg alt="robosoutěž"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Kutilové</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.instructables.com/" target="_BLANK"><img src=img/instructables.png alt="instuctables"></a></div>
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
