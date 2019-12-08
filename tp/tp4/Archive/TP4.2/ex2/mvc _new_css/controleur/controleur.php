<?php

require_once('modele/modele.php');
require_once('vue/vue.php');


function CtlHome(){
	displayHome();
}

function CtldisplayAllCustomer(){
	$listingCustomer=getAllCustomer();
	if (!empty($listingCustomer[0])) {
		displayCustomer($listingCustomer);
		CtlHome();
	}
	else {
		throw new Exception("aucun client dans la base");
	}
}

function CtldisplayCustomer($lastName){
	$listingCustomer=getCustomer($lastName);
	if (!empty($listingCustomer[0])) {
		displayCustomer($listingCustomer);
		CtlHome();
	}
	else {
		throw new Exception("aucun client avec ce nom dans la base");
	}
}

function CtlAddCustomer($lastName,$name,$birthDate,$phoneNumber) {
	if( !empty($lastName) && !empty($name) && !empty($birthDate) && !empty($phoneNumber) ){

		if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", "$phoneNumber")){
			$phoneNumber=intval($phoneNumber);
			addCustomer($lastName,$name,$birthDate,$phoneNumber);	
		}
		else {
			throw new Exception("tel incorect");
		}
		CtlHome();
	}
	else {
		throw new Exception("un des champs est invalide");
	}
}

function CtldeleteCustomer(){
// suivi les info du pdf
	foreach ($_POST as $key => $value) {
		if ($value='on') {
			$key=intval($key);
			deleteCustomer($key);
		}
	}
	CtlHome();
}

function CtlError($error){
	displayError($error);
}