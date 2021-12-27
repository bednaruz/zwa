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
                    <div class="hobby_column1"><a class="hobby_img" href="https://www.prusa3d.com/cs/" target="_BLANK"><img src=images/prusa.jpg alt="tiskárna Průša"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.thingiverse.com/" target="_BLANK"><img src=images/3dmodel.png alt="3D model"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://www.autodesk.com/products/fusion-360/free-trial" target="_BLANK"><img src=images/fusion.png alt="program Fusion360"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Stavebnice</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://store.makeblock.com/products/diy-coding-robot-kits-mbot" target="_BLANK"><img src=images/mBot.jpg alt="mBot"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.lego.com/cs-cz/themes/mindstorms/about" target="_BLANK"><img src=images/legomindstorms.png alt="robot lego mindstorms"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://microbit.org/" target="_BLANK"><img src=images/microbit.jpg alt="micro:bit"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://boffin.cz/" target="_BLANK"><img src=images/boffin.jpg alt="stavebnice boffin"></a></div>
                </div>

                <div class="hobby_title">DIY</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.laskakit.cz/" target="_BLANK"><img src=images/laskaarduino.png alt="laskarduino"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://dratek.cz/" target="_BLANK"><img src=images/dratek.png alt="drátek"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.gme.cz/" target="_BLANK"><img src=images/gm.jpg alt="GM electronics"></a></div>
                </div>
                
                <div class="hobby_title">CTF</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://picoctf.org/index#picogym" target="_BLANK"><img src=images/picoCTF.png alt="pico capture the flag"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Programování</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" ref="https://scratch.mit.edu/" target="_BLANK"><img src=images/scratch.png alt="scratch"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://ide.mblock.cc/" target="_BLANK"><img src=images/mbotcode.png alt="mBlock code editor"></a></div>
                    <div class="hobby_column2"></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://bootcamp.berkeley.edu/blog/most-in-demand-programming-languages/" target="_BLANK"><img src=images/code.jpg alt="kód"></a></div>
                </div>
                
                <div class="hobby_title">wITches</div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://witches.fel.cvut.cz/" target="_blank"><img class="hobby_img" src="images/logo.png" alt="logo"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Soutěže</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.ibobr.cz/" target="_BLANK"><img src=images/bobrik.png alt="Bobřík informatiky"></a></div>
                </div>
                <div class="hobby_row">
                    <div class="hobby_column1"><a class="hobby_img" href="https://robosoutez.fel.cvut.cz/" target="_BLANK"><img src=images/robosoutez.jpg alt="robosoutěž"></a></div>
                    <div class="hobby_column2"></div>
                </div>

                <div class="hobby_title">Kutilové</div>
                <div class="hobby_row">
                    <div class="hobby_column1"></div>
                    <div class="hobby_column2"><a class="hobby_img" href="https://www.instructables.com/" target="_BLANK"><img src=images/instructables.png alt="instuctables"></a></div>
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
