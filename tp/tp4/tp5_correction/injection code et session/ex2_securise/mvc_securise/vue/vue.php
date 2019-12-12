<?php
  function afficherDiscussion($discussion){
		  
	  $contenu='  <form id="monForm"  action="" method="post">
	  <fieldset>
	  <legend> Les messages déjà postés </legend>';
      
	  foreach ($discussion as $ligne){
		 
       $contenu=$contenu . '<p><label>'. htmlentities($ligne->nom, ENT_QUOTES,"UTF-8") .' : </label> <input type="texte" value="'. 
			    htmlentities($ligne->msg, ENT_QUOTES,"UTF-8").'
		  		['. $ligne->id.'] "/> </p>';
      }
	  
	  $contenu.='</fieldset>  </form>';
	  
	  
      require_once('gabarit.php'); 
  }
  
  
  function afficherErreur($erreur,$gabarit,$retour){
  	
	  $contenu=' <form id="monForm"  action="" method="post">
	  <fieldset>
	  <legend> Erreurs détectées </legend>
	   <p>'. $erreur. '</p>';
	   
	   if ($retour){
	   	 $contenu.='<p><a href="forum.php"/> Revenir au forum </a></p>';
       }
	   $contenu.='</fieldset>  </form>';
      require_once($gabarit); 
		
	
  }

  function afficherConnect(){
	  $contenu='';
	  require_once('gabaritConnect.php');
  }