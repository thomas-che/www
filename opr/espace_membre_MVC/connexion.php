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
	            	<input type="submit" name="submit" value="se conncter" />
	            </p>
	        </fieldset>
    	</form>

    	<?php

		try { 
		    require_once('connect.php'); 
		    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
		    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		}
		catch(PDOException $e) { 
		    $msg = 'ERREUR dans ' . $e->getFile() . ' Ligne : ' . $e->getLine() . ' : ' . $e->getMessage();
		    exit($msg); 
		}
		$connexion->query("SET NAMES UTF8"); 

// ne fonctione pas avec cookie
		// echo var_dump($_COOKIE);
		if (isset($_COOKIE['pseudo']) and isset($_COOKIE['mdp_hache'])) {
			$pseudo= $_COOKIE['pseudo'];
			$mdp_hache= $_COOKIE['mdp_hache'];

			$requete=$connexion->prepare("SELECT pass FROM membres WHERE pseudo=?");
			$requete->execute(array($pseudo));
			$ligne=$requete->fetch();
			$mdp_hache_bd=$ligne['pass'];
			//$isPasswordCorrect= password_verify($mdp, $mdp_hache_bd );
			if ($mdp_hache==$mdp_hache_bd) {
				header("location: mini_chat/minichat.php");
			}
		}


		if (!empty($_POST['pseudo']) AND !empty($_POST['mdp']) ) {
			$pseudo= htmlspecialchars($_POST['pseudo']);
			$mdp=htmlspecialchars($_POST['mdp']);

			$requete=$connexion->prepare("SELECT pass FROM membres WHERE pseudo=?");
			$requete->execute(array($pseudo));
			$ligne=$requete->fetch();
			$mdp_hache=$ligne['pass'];
			$isPasswordCorrect= password_verify($mdp, $mdp_hache );

			if (!$ligne) {
				echo '<p> Mauvais pseudo et/ou mdp </p>';
			}
			else {
				if ($isPasswordCorrect) {
					session_start();
					$_SESSION['pseudo']=$pseudo;
					echo '<p>Vous etes connecter</p>';
					if(isset($_POST['co_auto'])) {
	// comprend pas comment fonctionne le cookie
						setcookie('pseudo', '$pseudo', time() + 3600, null, null, false, true);
						setcookie('mdp_hache', '$mdp_hache', time() + 3600, null, null, false, true);
					}
					// test redirection
					header("location: mini_chat/minichat.php");
				}
				else{
					echo '<p> Mauvais pseudo et/ou mdp </p>';
				}
			}


		}



    	?>
    </body>
</html>