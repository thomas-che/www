<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>forum</title>
    </head>

    <body>

        <?php 
        if (! ($_POST['code']=='code') ){
            echo "code faux";
            exit();
        }
        else {
            echo 'bon code';
        }

        ?>

    </body>
</html>