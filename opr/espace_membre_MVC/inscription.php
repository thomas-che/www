<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>Inscription</title>
    </head>

    <body>

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
	            	<input type="submit" name="submit" value="envoyer" />
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


		if (isset($_POST) and !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp_confirmation']) AND !empty($_POST['mail']) ) {

			$pseudo_libre=true;
			$requete=$connexion->prepare("SELECT pseudo FROM membres ");
			$requete->execute(array());
			$pseudo= htmlspecialchars($_POST['pseudo']);
			while ($ligne=$requete->fetch()) {
				if ($ligne['pseudo']==$pseudo) {
					echo '<p> Votre pseudo est deja utiliser !</p>';
					$pseudo_libre=false;
					break;
				}
			}
			$requete->closeCursor();

			$mdp_identique=true;
			$mdp= htmlspecialchars($_POST['mdp']);
			$mdp_confirmation= htmlspecialchars($_POST['mdp_confirmation']);
			if ($mdp!=$mdp_confirmation ) {
				echo '<p> Vos mot de passe sont differents !</p>';
				$mdp_identique=false;
			}
			else {
				$mdp_hache= password_hash($mdp,PASSWORD_DEFAULT);
			}

			$mail_correct=true;
			$mail= htmlspecialchars($_POST['mail']);
			if ( preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", "$mail") ) {
				$mail_libre=true;
				$requete=$connexion->prepare("SELECT email FROM membres ");
				$requete->execute(array());
				while ($ligne=$requete->fetch()) {
					if ($ligne['email']==$mail) {
						echo '<p> Adresse mail deja utiliser !</p>';
						$mail_libre=false;
						break;
					}
				}
				$requete->closeCursor();
			}
			else {
				echo '<p> Votre adresse mail est incorect !</p>';
				$mail_correct=false;
				$mail_libre=false;
			}

			if ( $pseudo_libre and $mdp_identique and $mail_correct and $mail_libre ) {

// ne fonctione pas avec des requette preparer
// $requete=$connexion->prepare("INSERT INTO membres VALUES (0,pseudo=:pseudo,mdp=:mdp,mail=:mail, NOW() )");
// $requete->execute(array('pseudo'=>$pseudo,'mdp'=>$mdp_hache,'mail'=>$mail));

// CORRECTION insertion avec requette preparer
// $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
// $req->execute(array(
//     'pseudo' => $pseudo,
//     'pass' => $pass_hache,
//     'email' => $email));

				$date=date('Y-m-d');
				$requete=$connexion->exec("INSERT INTO membres VALUES ( 0,'$pseudo','$mdp_hache','$mail', '$date' )");
				echo '<p> Inscription reussit !</p>';
			}
			else{
				echo '<p> Echec inscription ...</p>';
			}
		}

        ?> 
        <!-- <p>
        	Pour aller à la page de conncxion <a href="connexion.php">connexion.php</a>
    	</p> -->
    </body>
</html>
