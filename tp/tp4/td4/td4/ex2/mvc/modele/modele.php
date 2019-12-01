
<?php

require_once('connect.php');

function getConnect(){
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function chercherTousLesClients(){
	$connexion=getConnect();
	$requete="select * from client"  ; 
	$resultat=$connexion->query($requete); 
	$resultat->setFetchMode(PDO::FETCH_OBJ);
    $client=$resultat->fetchall(); // chargement du rés dans un tab
    $resultat->closeCursor();
	return $client;
}	



function chercherNomClient($nom){
	$connexion=getConnect();
	$requete="select * from client where nom='$nom' "  ; 
	$resultat=$connexion->query($requete); 
	$resultat->setFetchMode(PDO::FETCH_OBJ);
    $client=$resultat->fetchall(); // chargement du rés dans un tab
    $resultat->closeCursor();
	return $client;
}	



function ajouterClient($nom,$prenom,$date,$tel){
	$connexion=getConnect();
    $requete="INSERT INTO client VALUES('', '$nom', '$prenom','$date','$tel')" ;
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}
		
function supprimerClient($id){
	$connexion=getConnect();
    $requete="delete from client where id=$id" ;
    $resultat=$connexion->query($requete);  
    $resultat->closeCursor();
}		
		
		
	