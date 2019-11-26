<?php

require_once('models/model.php');
require_once('views/view.php');

function CtlAceuilForum(){
	header("location: mini_chat/minichat.php");
}


function CtlLonginPassword($login,$password) {
	if (!empty($login) AND !empty($password) ) {
		$isPasswordCorrect=checkUser($login,$password);
		if ($isPasswordCorrect) {
			CtlAceuilForum();
		}
		else {
			throw new Exception("Login ou mdp non valide");
		}
	}
	else {
		throw new Exception("Login ou mdp vide");
	}
}