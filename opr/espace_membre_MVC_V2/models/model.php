<?php

require_once('connect.php');
require_once('connect_MC.php');

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



/*#############################*/
/*                             */
/*                             */
/*         MINI CHAT           */
/*                             */
/*                             */
/*#############################*/



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