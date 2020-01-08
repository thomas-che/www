<?php



function displayError($error){
	$contents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p><a href="javascript:history.back()">Revenir a la page precedente</a></p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}
