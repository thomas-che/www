<?php

require_once('models/model_MC.php');
require_once('views/view_MC.php');


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

function ctlError_MC($error){
	displayError($error);
}

