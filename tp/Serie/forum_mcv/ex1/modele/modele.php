<?php

require_once('connect.php');

// DIAPO PROF
function getConnect()
{
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query("SET NAMES UTF8");
    echo "{model} var_dump de co" . var_dump($connexion);
    return $connexion;
}

// DIAPO PROF
function getDiscussion(){
	$connexion=getConnect();
	$requete="SELECT * FROM forum Limit 10" ;
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$discussion=$resultat->fetchall();
	// $discussion est donc un tableau d'objet où chaque case est un objet contenant une ligne
	//entière du résultat de la requête
	$resultat->closeCursor();
	return $discussion;
}

// DIAPO PROF
function ajouterMessage($nom,$message){
	$connexion=getConnect(); // création d'une connexion PDO
	$requete="INSERT INTO forum VALUES (0, '$nom', '$message')" ;
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

// DIAPO PROF
function supprimerMessage($id){
	$connexion=getConnect(); // création d'une connexion PDO
	$requete="DELETE FROM forum WHERE id=$id" ;
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

// prof tp info
function checkUsser($id,$mdp){
	// doit renvoier un tab d objet soit le nom soit null
	$connexion=getConnect(); 
	// pdf tp : select nom from user where id='$id' and mdp='$mdp'
	$requete="SELECT nom FROM usser WHERE id='$id' AND mdp='$mdp' " ;
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$nom=$resultat->fetchall();
	$resultat->closeCursor();
	echo "{model}le nom est: " . $nom[0] ;
	echo "{model}var dump =" . var_dump($nom);
	echo "{model}le print r =" . print_r($nom);
	return $nom;
}

