<?php

require_once('model/model.php');
require_once('view/view.php');


function CtlAcceuil() {
	$discussion=getDiscussion();
	afficherDiscussion($discussion);
}

function CtlAjouterMessage($nom,$msg){
	if (!empty($nom) && !empty($msg)){
		ajouterMessage($nom,$msg);
	}
	else {
		throw new Exception("pseudo et/ou message est vide");
	}
	CtlAcceuil();
}

function CtlSupprimerMessage($id){
	if (ctype_digit($id)) {
		sipprimerMessage($id);
	}
	else {
		throw new Exception("id non valide");
	}
	CtlAcceuil();
}

function CtlErreur($erreur){
	afficherErreur($erreur);
}