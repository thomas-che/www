<?php

require_once('model/model.php');
require_once('view/view.php');

function ctlHome(){
	$discussion=getDiscussion();
	if (!empty($discussion)){
		displayDiscusion($discussion);
	}
	else{
		throw new Exception("pas de msg dans la bd");
	}
}


function ctlAddMessage($pseudo,$message){
	if (!empty($pseudo) && !empty($message)){
		addMessage($pseudo,$message);
		ctlHome();
	}
	else {
		throw new Exception("pseudo ou message vide");
	}
}

function ctlError($error){
	displayError($error);
}