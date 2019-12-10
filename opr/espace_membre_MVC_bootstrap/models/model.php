<?php

require_once('connect.php');

function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function checkUser($pseudo,$password) {
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT pass FROM membres WHERE pseudo=:pseudo");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

// return le pseudo si il est deja pris
function pseudoAvailable($pseudoTest){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT pseudo FROM membres WHERE pseudo IN ( :pseudoTest ) ");
	$prepare->bindValue(':pseudoTest',$pseudoTest,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

function mailAvailable($mailTest){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT email FROM membres WHERE email IN ( :mailTest ) ");
	$prepare->bindValue(':mailTest',$mailTest,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

function addUser($pseudo,$passwordHash,$mail,$date){
	$connexion=getConnect();
	$prepare=$connexion->prepare("INSERT INTO membres VALUES ( 0 , :pseudo , :passwordHash , :mail , :datee ) ");
	$prepare->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
	$prepare->bindValue(':passwordHash',$passwordHash,PDO::PARAM_STR);
	$prepare->bindValue(':mail',$mail,PDO::PARAM_STR);
	$prepare->bindValue(':datee',$date,PDO::PARAM_STR);
	$prepare->execute();
	$prepare->closeCursor();
}