<?php


/*####################*/
/*                    */
/*       TO DO        */
/*                    */
/*####################*/

// 1} password cookie pas cripter
// 2} gere le displayErrorMail aurement :
// 		- triche avec un echo   ==> OK
// 		=> je veux continuer a saisir sans aller a la page connexion  ==> pense avec popup js OU cookie




require_once('models/model.php');
require_once('views/view.php');

require_once('controller_MC.php');

function ctlConnexion(){
	displayConnexion();
}

function ctlRegistration(){
	displayRegistration();
}

function ctlAccess($pseudo,$password){
	if (!empty($pseudo) && !empty($password)) {
		$answer=checkUser($pseudo,$password);
		$mdp_hache=$answer['pass'];
		$isPasswordCorrect= password_verify($password, $mdp_hache );
		if ($isPasswordCorrect==1){

			if (!empty($_POST['remember-me']) ){
				setcookie('pseudo',$pseudo,time()+60*2);
// password cookie pas cripter
				setcookie('password',$password,time()+60*2);
			}
			// detruie le cookie
			else{
				ctlDestroyedCookie();
			}
			$_SESSION['pseudo']=$pseudo;
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
	ctlHome();
}

function ctlError($error){
	displayError($error);
}

function ctlErrorMail($error){
	ctlRegistration();
	displayErrorMail($error);
}

function ctlRegistrationLogin($pseudo,$password,$passwordConfirmation,$mail){
	if (!empty($pseudo) && !empty($password) && !empty($passwordConfirmation) && !empty($mail)) {
		$answerPseudo=pseudoAvailable($pseudo);
		if (empty($answerPseudo)){
			if ($password == $passwordConfirmation){
				$passwordHash= password_hash($password,PASSWORD_DEFAULT);
				// test si email est correctement ecrit
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", "$mail")){
					$answerMail=mailAvailable($mail);
					if (empty($answerMail)){
						$date=date('Y-m-d');
						addUser($pseudo,$passwordHash,$mail,$date);
						ctlConnexion();
						echo '<p>Inscription reusit, connectez vous</p>';
					}
					else {
						throw new Exception("adresse mail deja utiliser");
					}
				}
				else {
					throw new Exception("email incorect");
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

// fin de la session
function ctlDeconnexion(){
	$_SESSION = array();
	session_destroy();
	ctlConnexion();
}

function ctlDestroyedCookie(){
	if (isset($_COOKIE['pseudo'])){
		setcookie('pseudo','',time()-10);
	}
	if (isset($_COOKIE['password'])){
		setcookie('password','',time()-10);
	}
}