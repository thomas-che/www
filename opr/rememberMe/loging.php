<?php

session_start();

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


if (isset($_POST['submit']) && !empty($_POST['pseudo']) && !empty($_POST['password']) ){
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$password=htmlspecialchars($_POST['password']);


	$prepare=$connexion->prepare("SELECT pass FROM membres WHERE pseudo= :pseudo ");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();


// avec ctlAccess
	$mdp_hache=$answer['pass'];
	$isPasswordCorrect= password_verify($password, $mdp_hache );
	if ($isPasswordCorrect==1){
		//code yt
		if (!empty($_POST['remember-me']) ){
			setcookie('pseudo',$pseudo,time()+60*2);
			setcookie('password',$password,time()+60*2);
		}
		// detruie le cookie
		else{
			if (isset($_COOKIE['pseudo'])){
				setcookie('pseudo','',time()-10);
			}
			if (isset($_COOKIE['password'])){
				setcookie('password','',time()-10);
			}
		}
		header('location:connercter.php');
	}
	else {
		$message='pseudo ou mdp non valide';
	}




	// if ($answer){
	// 	if (!empty($_POST['remember-me']) ){
	// 		setcookie('pseudo',$pseudo,time()+60*2);
	// 		setcookie('password',$password,time()+60*2);
	// 	}
	// 	// detruie le cookie
	// 	else{
	// 		if (isset($_COOKIE['pseudo'])){
	// 			setcookie('pseudo','',time()-10);
	// 		}
	// 		if (isset($_COOKIE['password'])){
	// 			setcookie('password','',time()-10);
	// 		}
	// 	}
	// 	header('location:connercter.php');
	// }
	// else{
	// 	$message='invalid login';
	// }
}



?>

<!DOCTYPE html> 
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>Remember Me</title>
    </head>

    <body>
    	<form method="post" action="loging.php"> 
	        <fieldset>
	            <legend>Connexion</legend> 
	            <p>
	            	<?php
	            		if (isset($message)){echo $message;}
	            	?>
	            </p>
	            <p>
	                <label for="pseudo">Pseudo :</label>
	                <input type="text" name="pseudo" id="pseudo" required value="<?php if(isset($_COOKIE['pseudo']) ){echo $_COOKIE['pseudo'];} ?>" />
	            </p>
	            <p>
	                <label for="mdp">Mot de pass :</label>
	                <input type="password" name="password" id="password" required value="<?php if(isset($_COOKIE['password']) ){echo $_COOKIE['password'];} ?>" />
	            </p>
	            <p>
	            	<input type="checkbox" name="remember-me" id="remember-me" <?php if(isset($_COOKIE['pseudo']) ){ ?> checked <?php } ?> />
	                <label for="remember-me">Connexion automatique </label>
	            </p>
	            <p>
	            	<input type="submit" name="submit" value="Se conncter" />
	            </p>
	        </fieldset>
    	</form>
	</body>
</html>




