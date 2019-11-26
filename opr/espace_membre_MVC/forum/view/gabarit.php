<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>FORUM_MVC</title>

    <body>

        <form action="forum.php" method="POST">
            <fieldset>
                <legend>Formulaire</legend>
                <p><label>Nom : <input type="text" name="nom" /></label></p>
                <p><label>Message : <input type="text" name="msg" /></label></p>

                <p><input type="submit" value="Envoyer msg" name="envoyer" /></p>
            </fieldset>
        </form>

        <?php  echo $contenu ; ?>

        <form action="forum.php" method="POST">
            <fieldset>
                <legend>Supprimer msg</legend>
                <p><label>Id msg : <input type="text" name="idmsg" /></label></p>

                <p><input type="submit" value="Supprimer" name="supprimer" /></p>
            </fieldset>
        </form>
    </body>
</html>