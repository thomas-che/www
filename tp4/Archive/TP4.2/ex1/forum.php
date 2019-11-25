<?php

echo "avant le requiee";

require_once('controleur/controleur.php');
// charge les méthodes du contrôleur

echo " apres le requiee";

try {
	if (isset($_POST['envoyer'])){ // si on a cliqué sur Envoyer
		echo "{furum} dans le if";
		$login=$_POST['login'];
		$mdp=$_POST['mdp'];
		$msg=$_POST['msg'];
		echo "{forum}afficher de $ post=" . print_r($_POST);
		CtlAjouterMessage($login,$mdp,$msg); // appel du contrôleur qui gère le cas postage d'un msg
	}
	elseif (isset($_POST['supprimer'])){ // si on a cliqué sur Supprimer
		$id=$_POST['idmsg'];
		CtlSupprimerMessage($id); // appel du contrôleur qui gère le cas suppression d'un msg
	}
	else CtlAcceuil(); // on vient d'arriver sur la page et on appelle le contrôleur qui gère
}
// l'affichage des discussions
catch(Exception $e) {
	// une erreur est survenu dans le bloc try
	$msg = $e->getMessage() ; // on récupère son code
	CtlErreur($msg);
}