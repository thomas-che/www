<!DOCTYPE html> 
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />  
        <link rel="stylesheet" href="cours.css" />
        <title>Mini chat MVC</title>  
    </head>

    <body>
    	<form class="newMessage" action="site.php" method="post">
    		<fieldset>
    			<legend>Ecrir un message</legend>
    			<p><label>Pseudo : <input type="text" name="pseudo" required></label></p>
    			<p><label>Message : <input type="text" name="message" required></label></p>
    			<p><input type="submit" name="send" value="Envoyer"></p>
    		</fieldset>
    	</form>

    	<?php echo $contenu; ?>

    </body>
</html>