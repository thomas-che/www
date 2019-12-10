<?php


require_once('models/connect.php');

function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function checkUser($pseudo,$password) {
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT pass FROM membres WHERE pseudo=:pseudo");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->execute();
	$ligne=$prepare->fetch();
	$mdp_hache=$ligne['pass'];
	$isPasswordCorrect= password_verify($password, $mdp_hache );
	return $isPasswordCorrect;
}

function displayConnexion(){
	$contents='
	<form method="post" action="index.php"> 
        <fieldset>
            <legend>Connexion</legend> 
            <p>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" />
            </p>
            <p>
                <label for="co_auto">Connexion automatique </label>
                <input type="checkbox" name="co_auto" id="co_auto" />
            </p>
            <p>
            	<input type="submit" name="connction" value="se conncter" />
            </p>
            <p>
            	<input type="submit" name="goInscription" value="Shaitez-vous vous inscrire ?" />
            </p>
        </fieldset>
	</form>';
// devrait il y avoir un pb avec le name de bouton : name="connction"
    require_once('views/gabarit.php');
}

function displayRegistration(){
	$contents.='
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
	</form>';
	require_once('views/gabarit.php');
}


function ctlConnexion(){
	displayConnexion();
}

function ctlRegistration(){
	displayRegistration();
}

$p='tata';
$mdp='mdpe';

function ctlAccess($pseudo,$password){
	if (!empty($pseudo) && !empty($password)) {
		$isPasswordCorrect=checkUser($pseudo,$password);
		if ($isPasswordCorrect==1){
			ctlGoMiniChat();
		}
		else {
			throw new Exception("pseudo ou mdp non valide");
			
		}
	}
	else {
		throw new Exception("pseudo et/ou mdp vide");
	}
}

function ctlGoMiniChat(){
	header("location: mini_chat/minichat.php");
}

//ctlAccess($p,$mdp);


function pseudoAvailable($pseudoTest){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT pseudo FROM membres WHERE pseudo IN ( :pseudoTest ) ");
	$prepare->bindValue(':pseudoTest',$pseudoTest,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

$p='tata';
$res=pseudoAvailable($p);
// echo 'res ='.$res.'</br>';

function mailAvailable($mailTest){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT email FROM membres WHERE email IN ( :mailTest ) ");
	$prepare->bindValue(':mailTest',$mailTest,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

$p='tatsssa@gmail.com';
$res=mailAvailable($p);
//echo 'res ='.$res.'</br>';

function addUser($pseudo,$passwordHash,$mail,$date){
	$connexion=getConnect();
	$prepare=$connexion->prepare("INSERT INTO membres VALUES ( 0 , :pseudo , :passwordHash , :mail , :datee ) ");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->bindValue(':passwordHash',$passwordHash,PDO::PARAM_STR);
	$prepare->bindValue(':mail',$mail,PDO::PARAM_STR);
	$prepare->bindValue(':datee',$date,PDO::PARAM_STR);
	$prepare->execute();
	$prepare->closeCursor();
}


function ctlRegistrationLogin($pseudo,$password,$passwordConfirmation,$mail){
	if (!empty($pseudo) && !empty($password) && !empty($passwordConfirmation) && !empty($mail)) {
		$answerPseudo=pseudoAvailable($pseudo);
		if (empty($answerPseudo)){
			if ($password == $passwordConfirmation){
				$passwordHash= password_hash($password,PASSWORD_DEFAULT);
				$answerMail=mailAvailable($mail);
				if (empty($answerMail)){

					echo '<p>ANAVNT Inscription</p>';

					$date=date('Y-m-d');
					addUser($pseudo,$passwordHash,$mail,$date);

					echo '<p> Inscription reussit !</p>';
					
				}
				else {
					throw new Exception("adresse mail deja utiliser");
				}
			}
			else{
				throw new Exception("mot de pass non identique");
			}
		}
		else {
			throw new Exception("pseudo deja utiliser");
		}
	}
	else {
		throw new Exception("un ou plusieur champ vide");
	}
}


$pseudo='tETe';
$password='mdp';
$passwordConfirmation='mdp';
$mail='tete@gmail.com';

//ctlRegistrationLogin($pseudo,$password,$passwordConfirmation,$mail);
