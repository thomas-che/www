<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
  <title>Ex4</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="text/javascript" src="test.js" ></script>
  </head>
  <body>
	<form method="post" action="index.php" onSubmit="return verifForm(this)"> 
        <fieldset>
            <legend>Inscription</legend> 
            <p>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo"  onBlur="verifNonVide(this)" />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp"  onBlur="verifNonVide(this)" />
            </p>
            <p>
                <label for="mdp_confirmation">Confirmation mot de pass :</label>
                <input type="password" name="mdp_confirmation" id="mdp_confirmation"  onBlur="verifNonVide(this)" />
            </p>
            <p>
                <label for="mail">Mail :</label>
                <input type="text" name="mail" id="mail" onBlur="verifNonVide(this)"/>
            </p>
            <p>
            	<input type="submit" name="Registration" value="envoyer" />
            </p>
        </fieldset>
	</form>
  </body>
</html>