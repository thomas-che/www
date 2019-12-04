<?php 

require_once('modele/modele.php') ;
require_once('vue/vue.php');

function ctlAcceuil(){
	afficherAcceuil();
}


function ctlAfficherClient(){
	$client=chercherTousLesClients();
	afficherClient($client);
}


function ctlAjouterClient($nom,$prenom,$date,$tel){
    if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($tel) ) { 
	   ajouterClient($nom,$prenom,$date,$tel);
	   afficheracceuil();
	}
	else  {throw new Exception("Un des champs est invalide"); }   
}

function ctlChercherClient($nom){
    if (!empty($nom)) { 
	   $client=chercherNomClient($nom);
	   afficherClient($client);
	}
	else  {throw new Exception("Le champ nom est vide"); }   
}


function ctlSupprimerClient(){
	
	 foreach($_POST as $key => $val){
		    if ($key!='boutonSupprimer') { // car même le bouton est posté 
			supprimerClient($key);
			
			}	
	}   
	   
	afficherAcceuil();	
}  

function CtlErreur($erreur){
	afficherErreur($erreur);
}


