<?php

require_once('connect_MC.php');

function getConnect_MC(){
    $connexion=new PDO('mysql:host='.SERVEUR_MC.';dbname='.BDD_MC,USER_MC,PASSWORD_MC) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query("SET NAMES UTF8");
    return $connexion;
} 

function addMessage($pseudo,$message){
	$connexion=getConnect_MC();
	$prepare=$connexion->prepare("INSERT INTO minichat VALUES ( 0 , :pseudo , :message ) ");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->bindValue(':message',$message,PDO::PARAM_STR);
	$prepare->execute();
	$prepare->closeCursor();
}

function getDiscussion(){
	$connexion=getConnect_MC();
	$answer=$connexion->query("SELECT pseudo,message FROM minichat ORDER BY id DESC LIMIT 10");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$discussion=$answer->fetchall();
	$answer->closeCursor();
	return $discussion;
}