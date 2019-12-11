<?php

require_once('model/connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query("SET NAMES UTF8");
    return $connexion;
} 

function addMessage($pseudo,$message){
	$connexion=getConnect();
	$prepare=$connexion->prepare("INSERT INTO minichat VALUES ( 0 , :pseudo , :message ) ");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->bindValue(':message',$message,PDO::PARAM_STR);
	$prepare->execute();
	$prepare->closeCursor();
}

function getDiscussion(){
	$connexion=getConnect();
	$answer=$connexion->query("SELECT pseudo,message FROM minichat ORDER BY id DESC LIMIT 10");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$discussion=$answer->fetchall();
	$answer->closeCursor();
	return $discussion;
}