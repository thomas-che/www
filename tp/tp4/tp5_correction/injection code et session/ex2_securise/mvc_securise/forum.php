<?php
session_start();
require_once('controleur/controleur.php');
try {
 if (isset($_SESSION['nom'])){
	     if (isset($_POST['envoyer'])){
			       $nom=$_SESSION['nom'];
		           $msg=$_POST['msg'];
				   CtlAjouterMessage($nom,$msg);
				    CtlAcceuil(); 
		    }
		 elseif (isset($_POST['supprimer'])){ 
	     	       $id=$_POST['idmsg'];
				   CtlSupprimerMessage($id);
		     } 
		 elseif (isset($_POST['deconnect'])){
			 CtlDeconnect();
		 	}
	   	else CtlAcceuil(); 	 
	}	
    
 else{
	if (isset($_POST['connect'])){
		         $user=$_POST['user'];
                 $mdp=$_POST['mdp'];
                 CtlConnect($user,$mdp);	
	}	
	else{
		ctlAcceuilConnect();
		
	}
	
 }
}
catch(Exception $e) {
            $msg = $e->getMessage() ;
		    CtlErreur($msg);
}	