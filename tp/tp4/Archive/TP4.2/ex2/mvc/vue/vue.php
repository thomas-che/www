<?php

function displayCustomer($listingCustomer) {
	$displayContents='<form id="displayCustomer" action="site.php" method="post">
	<fieldset>
		<legend>Liste des clients</legend>';
	foreach ($listingCustomer as $line ) {
		$sentence=strtoupper($line->nom).' '.$line->prenom.' né le '.$line->datenaissance.' joingnable sur le 0'.$line->tel;

		$displayContents.='<p><input type="checkbox" name="'.$line->id.'">Client n° '.$line->id.' : '.'<input type="text" name="nameCustomer" readonly="readonly" value="'.$sentence.'"/></p>';
	}
	$displayContents.='<p> <input type="submit" value="Suprimer client" name="deleteCustomer" /> </p>
		</fieldset>
	</form>';
	require_once('gabarit.php');
}

function displayError($error){
	$displayContents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p><a href="site.php"/> Revenir sur le site </a></p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}

function displayHome(){
	$displayContents='';
	require_once('gabarit.php');
}
