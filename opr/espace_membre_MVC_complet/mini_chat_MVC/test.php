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

$d=getDiscussion();

function displayDiscusion($discussion){
	$contenu='<form class="discussion">
    			<fieldset>
    				<legend>Discussion</legend>';
	foreach ($discussion as $ligne){
		$contenu.='<p><strong>'.$ligne->pseudo.'</strong> : '.$ligne->message.' </p>';
	}
	$contenu.='    	</fieldset>
    			</form>';




	require_once('view/gabarit.php');
}

function displayError($error){
	$contenu='<form class="error">
    			<fieldset>
    				<legend>/!\ MSG ERROR /!\</legend>';
	$contenu.='<p><strong>'.$error.'</strong></p>';
	$contenu.=' </fieldset>
    		   </form>';
	require_once('view/gabarit.php');;
}
$e='pas de msg dans la bd';

displayError($e);