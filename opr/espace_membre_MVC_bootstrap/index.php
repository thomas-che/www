<?php

session_start();

require_once('controllers/controller.php');

try {   
	if (isset($_POST['connexion']) && !empty($_POST['pseudo']) && !empty($_POST['mdp']) ) {
		$pseudo= htmlspecialchars($_POST['pseudo']);
		$password=htmlspecialchars($_POST['mdp']);
		ctlAccess($pseudo,$password);
	}
	elseif (isset($_POST['goRegistration']) ) {
	 	ctlRegistration();
	}
	elseif ( isset($_POST['Registration']) && !empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['mdp_confirmation']) && !empty($_POST['mail']) ) {
		$pseudo= strtolower(htmlspecialchars($_POST['pseudo']));
		$mail=htmlspecialchars($_POST['mail']);
	 	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", "$mail")){
	 		$password=htmlspecialchars($_POST['mdp']);
	 		$passwordConfirmation=htmlspecialchars($_POST['mdp_confirmation']);
	 		ctlRegistrationLogin($pseudo,$password,$passwordConfirmation,$mail);
	 	}

// pas sure que on fasse ca ici
	 	else{
	 		throw new Exception("email incorect");
	 	}
	}
	elseif (isset($_POST['deconnexion']) ) {
	 	ctlDeconnexion();
	} 
   	else ctlConnexion(); 	 
}
	
catch (Exception $e) {
    $errorMessage = $e->getMessage();
    if ($errorMessage=='email incorect' || $errorMessage=='pseudo deja utiliser' || $errorMessage=='mot de pass non identique' || $errorMessage=='adresse mail deja utiliser'){
    	ctlErrorMail($errorMessage);
    }
    else {
    	ctlError($errorMessage);
    }
}


