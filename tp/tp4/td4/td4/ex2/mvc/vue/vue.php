<?php
   function afficherClient($client){
	  $contenuAffichage='  <form id="monForm"  action="" method="post">
	  <fieldset>
	  <legend> Les clients de la base </legend>';
      if ($client==null) {
		  $contenuAffichage.='Aucune ligne ne répond à votre requête'; 
	  }	  
	  else{
	   foreach ($client as $ligne){
		 
	  	$id = $ligne->id;
	  	$nom= $ligne->nom;
	  	$prenom= $ligne->prenom;
	  	$date= $ligne->daten;
	  	$tel= $ligne->tel;

	  	// on ajoute un zone check dont le champ name=ID de l'élément a supprimer
	  	$check='  <INPUT type="checkbox" name="'.$id.'" />';
	  	$contenuAffichage.='<p><label>'.$check. ' Num CL '. $id.' : </label>  <input type="text" value="'.$nom.' '. $prenom. ' ne le '. $date. ' joignable sur le  '. $tel .'"/> </p>' ;
		// ATTENTION on ne met pas de name dans les zone de saisie pour plus tard dans le script de suppression ne pas avoir 
		//ces name dans le tableau $_POST 	
	  	}
	  	// on ajoute un bouton de soumission pour envoyer les données  a supprimer
	  	$contenuAffichage.=  '<p> <label class="pas_de_style"> &nbsp; </label>  <INPUT type="submit" value="Supprimer client" name="boutonSupprimer" /></p> </fieldset>  </form>';
 
	  } 
      require_once('gabarit.php'); 
     
   }

   function afficherAcceuil(){
	   $contenuAffichage='';
	    require_once('gabarit.php'); 
	}	
	
	
  function afficherErreur($erreur){
        $contenuAffichage=' <form id="monForm"  action="" method="post">
        <fieldset>
        <legend> Erreurs détectées </legend>
        <p>'. $erreur. '</p>
        <p><a href="site.php"/> Cliquez ici pour revenir au menu principal';
        $contenuAffichage.='</fieldset>  </form>';
   	    require_once('vue/gabarit.php'); 
	}
	
	