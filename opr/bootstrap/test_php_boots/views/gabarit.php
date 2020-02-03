<!DOCTYPE html> 
<html lang="fr" xml:lang="fr"  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
        <link rel="stylesheet" href="views/style/style.css"/>
        <script type="text/javascript" src="static/js/acceuil.js" ></script>
        <title>Acceuil</title>
    </head>

    <body>

        <?php 
        require_once('include/navbar.php');
        ?>
        <?php
        echo $contents; 
        ?>

	</body>
</html>
