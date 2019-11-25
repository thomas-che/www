<?php
setcookie('pseudo', 'M@teo21', time() + 60, null, null, false, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre de ma page</title>
    </head>
    <body>
    <p>
        <?php echo $_COOKIE['pseudo'] ; ?>
    </p>
    <p>
        <a href="test.php">Lien vers mapage.php</a><br />
        <a href="miniChat.php">Lien vers monscript.php</a><br />
        <a href="informations.php">Lien vers informations.php</a>
    </p>
    </body>
</html>