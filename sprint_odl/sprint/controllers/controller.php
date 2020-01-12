<?php

require_once('models/model.php');
require_once('views/view.php');

require_once('controller_agent.php');
require_once('controller_directeur.php');
require_once('controller_medecin.php');

/*#############################*/
/*                             */
/*                             */
/*            RDV              */ // thomas
/*                             */
/*                             */
/*#############################*/

// mdp pr bdd 
// $2y$10$C2tBdS46ALk3YCoARrIuSunIANd5J0NDhYMG7L0lWsPQKM7CJ8qo2

function ctlConnexion(){
	displayConnexion();
}
function ctlDeconnexion(){
	$_SESSION = array();
	session_destroy();
	ctlConnexion();
}

function ctlAccess($login,$password){
	if (!empty($login) && !empty($password)) {
		$answer=checkUser($login);
		$mdp_hache=$answer['mdp'];
		$isPasswordCorrect= password_verify($password, $mdp_hache );
		if ($isPasswordCorrect==1){

			$idEmploye=getIdEmploye($login);
			$directeur=getCategoryDirecteur($idEmploye);
			$agent=getCategoryAgent($idEmploye);

			if (empty($directeur) && empty($agent)){

				$_SESSION['categorie']='medecin';
			   //ctlConnexionMedecin();

			}
			else if (empty($directeur)){
				$_SESSION['categorie']='agent';
			   //ctlConnexionAgent();

			}
			else {
				$_SESSION['categorie']='directeur';
			   //ctlConnexionDirecteur();

			}
			ctlGo();
		}
		else {
			throw new Exception("login ou mdp non valide");
		}
	}
	else {
		throw new Exception("login et/ou mdp vide");
	}
}

function ctlGo(){
	if ($_SESSION['categorie']=='agent') {
		ctlConnexionAgent();
	}
	elseif ($_SESSION['categorie']=='medecin') {
		ctlConnexionMedecin();
	}
	else{
		ctlConnexionDirecteur();
	}
}

function ctlError($error){
	displayError($error);
}
