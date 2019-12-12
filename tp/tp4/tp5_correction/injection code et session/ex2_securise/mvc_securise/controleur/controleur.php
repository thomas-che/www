<?php 

require_once('modele/modele.php') ;
require_once('vue/vue.php');

function CtlAcceuilConnect(){
	afficherConnect();
}

function CtlDeconnect(){
	// destruction de la session 
	 $_SESSION = array();
     if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"],$params["secure"], $params["httponly"]);
	 }
	 session_destroy();
	 afficherConnect();
 }


function CtlAcceuil(){
	$discussion=getDiscussion();
	afficherDiscussion($discussion);
}


function CtlConnect($login,$mdp){
    if (!empty($login) && !empty($mdp)) { 
		$pseudo=checkUser($login,$mdp);
		if ($pseudo!=null){	
		  $_SESSION['nom']=$pseudo[0]->nom;	
		  CtlAcceuil();
	     }
		 else{
		  throw new Exception("Login ou mdp non valide"); 
	    }   	     
	}
	else  {throw new Exception("Login ou mdp vide"); }   
}


function CtlAjouterMessage($nom,$message){
    if (!empty($nom) && !empty($message)) { 
	      ajouterMessage($nom,$message);
	     }
		 else{
		  throw new Exception("Message vide"); 
	    }   	 
	    
	}
	


function CtlSupprimerMessage($id){
	 if  (ctype_digit($id)){
	supprimerMessage($id);
	CtlAcceuil();	
     }
	 else {throw new Exception("Id message non valide");} 
}  

function CtlErreur($erreur){
	if (isset($_SESSION['nom'])) {
		afficherErreur($erreur,'gabarit.php',true);
	}
	else{
		afficherErreur($erreur,'gabaritConnect.php',false);
	}
			
}