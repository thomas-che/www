<?php

require_once('connect.php');

function getConnect(){
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query("SET NAMES UTF8");
    return $connexion;
}

function getDiscussion(){
	$connexion=getConnect();
	$requete="SELECT * FROM forum ORDER BY id DESC LIMIT 10";
    $resultat=$connexion->query($requete) ;
    $resultat-> setFetchMode(PDO::FETCH_OBJ);
// pour avoir un tableau d objet
    $discussion=$resultat->fetchall();
    $resultat->closeCursor();
    return $discussion;
}

function ajouterMessage($nom,$msg){
	$connexion=getConnect();
    $requete="INSERT INTO forum VALUES ( 0 , '$nom' , '$msg' ) ";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();	
}

function sipprimerMessage($id){
	$connexion=getConnect();
	$requete="DELETE FROM forum WHERE id='$id' ";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}