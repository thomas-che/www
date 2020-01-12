<!DOCTYPE html> 
<html lang="fr" xml:lang="fr"  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style.css"/>
        <script type="text/javascript" src="static/js/agent.js" ></script>
        <title>Agent</title>
    </head>

    <body>
        <form action="index.php" method="POST" name="formGabaritAgent" id="formGabaritAgent">
            <p> <strong>Binvenue agent</strong> 
                <input type="submit" name="homeAgent" value="Revenir page aceuil agent">
                <input type="submit" name="deconnexion" value="Deconnexion">
            </p>
        </form>
        <?php echo $contentsError; ?>
    	<?php echo $contents; ?>
        <form id="formAccesPaye" method="POST" action="index.php" >
      <fieldset>
         <p><label>NSS :</label><input type="text" id="nss" name="nss"/></p>
         <p><input type="submit" id="accesPaye" name="accesPaye" value="Accéder aux paiements"/></p>
      </fieldset>
   </form>
	</body>
</html>
