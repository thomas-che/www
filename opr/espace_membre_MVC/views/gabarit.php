<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>Connexion</title>
    </head>

    <body>

    	<form method="post" action="index.php"> 
	        <fieldset>
	            <legend>Connexion</legend> 
	            <p>
	                <label for="pseudo">Pseudo :</label>
	                <input type="text" name="pseudo" id="pseudo" required />
	            </p>
	            <p>
	                <label for="mdp">Mot de pass :</label>
	                <input type="password" name="mdp" id="mdp" required />
	            </p>
	            <p>
	                <label for="co_auto">Connexion automatique </label>
	                <input type="checkbox" name="co_auto" id="co_auto" />
	            </p>
	            <p>
	            	<input type="submit" name="connction" value="se conncter" />
	            </p>
	        </fieldset>
    	</form>

    	<form method="post" action="index.php"> 
	        <fieldset>
	            <legend>Inscription</legend> 
	            <p>
	                <label for="pseudo">Pseudo :</label>
	                <input type="text" name="pseudo" id="pseudo" required />
	            </p>
	            <p>
	                <label for="mdp">Mot de pass :</label>
	                <input type="password" name="mdp" id="mdp" required />
	            </p>
	            <p>
	                <label for="mdp_confirmation">Confirmation mot de pass :</label>
	                <input type="password" name="mdp_confirmation" id="mdp_confirmation" required />
	            </p>
	            <p>
	                <label for="mail">Mail :</label>
	                <input type="text" name="mail" id="mail" required />
	            </p>
	            <p>
	            	<input type="submit" name="inscription" value="envoyer" />
	            </p>
	        </fieldset>
    	</form>
	</body>
</html>