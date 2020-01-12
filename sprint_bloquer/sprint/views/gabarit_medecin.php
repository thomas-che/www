<!DOCTYPE html> 
<html lang="fr" xml:lang="fr"  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/style.css"/>
        <script type="text/javascript" src="static/js/medecin.js" ></script>
        <title>Medecin</title>
    </head>

    <body>
        <form action="index.php" method="POST" name="formGabaritAgent" id="formGabaritAgent">
            <p> <strong>Binvenue medecin</strong> 
                <input type="submit" name="homeAgent" value="Revenir page aceuil medecin">
                <input type="submit" name="deconnexion" value="Deconnexion">
            </p>
        </form>
        <form id="taches" name="taches" method="post"  onSubmit="return checkForm(this);">
            <fieldset id="monFds">
            <legend>Bloquer un créneau</legend>
            <p><label>Login :</label>
               <input type="text" id="login" name="login" onBlur="checkLogin(this)"/></p>   
                <p><label>Nombre de créneau à bloquer :</label>
               <input type="number" min="0" id="nbCreneaux" name="nbCreneaux" onBlur="afficher_nb_creneaux();checkNbCreneaux(this)"/></p>
                <p id="derP"><input type="submit" id="bloquer" name="bloquer" value="Bloquer"/>
               <input type="reset" value="Effacer"/></p>
            </fieldset>
        </form>
        <?php echo $contentsError; ?>
    	<?php echo $contents; ?>
	</body>
</html>
