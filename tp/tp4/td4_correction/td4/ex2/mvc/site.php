<?php

require_once('controleur/controleur.php');
try {   if (isset($_POST['boutonAjouter'])){
                  $nom=$_POST['n'];
                  $prenom=$_POST['p'];
                  $date=$_POST['d'];
                  $tel=$_POST['t'];
		          ctlAjouterClient($nom,$prenom,$date,$tel);
		    }
		 elseif (isset($_POST['boutonRechercher'])){ 
	     	       $nom=$_POST['nomCl'];
				   ctlChercherClient($nom);
		     }
			 
		elseif (isset($_POST['boutonSupprimer'])){ 
		     	    ctlSupprimerClient();
			     }	  
		elseif (isset($_POST['boutonAfficher'])){ 
		 		   	ctlAfficherClient();
		 			     }	  
	   	
		else ctlAcceuil(); 	 
	}
	
catch(Exception $e) {
                $msg = $e->getMessage() ;
			    ctlErreur($msg);
  }



