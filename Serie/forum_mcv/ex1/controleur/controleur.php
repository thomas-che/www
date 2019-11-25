<?php

// DIAPO PROF
require_once('modele/modele.php') ;
require_once('vue/vue.php') ;

// DIAPO PROF
function CtlAcceuil(){
	$discussion=getDiscussion(); // appel du modèle qui va mettre dans la variable
// $discussion un tableau de toutes les discussions de la BDD
	afficherDiscussion($discussion); // appel de la vue qui va exploiter $discussion et afficher
// son contenu
}

// DIAPO PROF
// function CtlAjouterMessage($nom,$message){
// 	if (!empty($nom) && !empty($message)) {
// 		ajouterMessage($nom,$message); // appel du modèle pour insertion
// 		CtlAcceuil(); // appelle de la fonction précédente du contrôleur
// 	}
// 	else {
// 		throw new Exception("nom ou message invalide"); 
// 	}
// }

// prof tp info
function CtlAjouterMessage($login,$message,$mdp){
	if (!empty($login) && !empty($message) && !empty($mdp)) {
		$pseudo=checkUsser($login,$mdp);
		echo "{controleur}pseudo =" . $pseudo[0]->nom;
		echo "{controleur} le print r du ctl=" . print_r($pseudo);
		echo "{controleur}var dumps=" . var_dump($pseudo);
		if ( $pseudo != null ) {
			ajouterMessage($pseudo[0]->nom,$message); // appel du modèle pour insertion
		}
		else {
			throw new Exception("login/mdp invalide"); 
		}
		CtlAcceuil(); // appelle de la fonction précédente du contrôleur
	}
	else {
		throw new Exception("login/mdp/msg invalide"); 
	}
}


// DIAPO PROF
function CtlSupprimerMessage($id){
	if (ctype_digit($id)){
		supprimerMessage($id); // appel du modèle pour suppression
		CtlAcceuil(); // appelle de la fonction du contrôleur qui affiche les discussion
	}
	else {
		throw new Exception("id message invalide");
	}
}

// DIAPO PROF
function CtlErreur($erreur){
	afficherErreur($erreur) ;
}