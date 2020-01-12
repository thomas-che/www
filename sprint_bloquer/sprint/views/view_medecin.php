<?php


function displayConnexionMedecin(){
	$contents='';
	$contentsError='';
    require_once('gabarit_medecin.php');
}

function displayErrorMedecin($error){
	$contents='';
	$contentsError=displayErrorM($error);
	require_once('gabarit_directeur.php');
}

// affiche form pr erreur
function displayErrorM($error){
	$contentsError='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p><strong>'. $error. '</strong></p>
	  </fieldset>  
	</form>';
	return $contentsError;
}

