<?php


/*####################*/
/*                    */
/*       TO DO        */
/*                    */
/*####################*/

// 1} verif si dans le catch on a le droit de faire un if
// 2} verif si dans le try on peut lever une exception      ==> NON 
// 3} gere le displayErrorMail aurement :
// 		- triche avec un echo   ==> OK
// 		=> je veux continuer a saisir sans aller a la page connexion  ==> pense avec popup js
// 4} gerer les cookie




require_once('models/model.php');
require_once('views/view.php');

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
			//session_start();
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
	// header("location: mini_chat/minichat.php");
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

// triche un peux je pense
function ctlDeconnexion(){
	$_SESSION = array();
	session_destroy();
	ctlConnexion();
}



/*#############################*/
/*                             */
/*                             */
/*         MINI CHAT           */
/*                             */
/*                             */
/*#############################*/

function ctlHome(){
	$discussion=getDiscussion();
	if (!empty($discussion)){
		displayDiscusion($discussion);
	}
	else{
		throw new Exception("pas de msg dans la bd");
	}
}


function ctlAddMessage($pseudo,$message){
	if (!empty($pseudo) && !empty($message)){
		addMessage($pseudo,$message);
		ctlHome();
	}
	else {
		throw new Exception("pseudo ou message vide");
	}
}

function ctlError_MC($error){
	displayError($error);
}

