<?php

session_start();

require_once('controllers/controller.php');
try {   
	if (isset($_POST['connction'])) {
		$pseudo= htmlspecialchars($_POST['pseudo']);
		$mdp=htmlspecialchars($_POST['mdp']);
		CtlLonginPassword($pseudo,$mdp);
	}
	elseif (isset($_POST['inscription'])){ 
// a completer !!		
     	$id=$_POST['idmsg'];
		CtlSupprimerMessage($id);
	} 
   	else CtlAcceuil(); 	 
}
	
catch(Exception $e) {
    $msg = $e->getMessage() ;
	CtlErreur($msg);
  }

