<?php

require_once('controleur/controleur.php');

try{
    if (isset($_POST['displayCustomer'])) {
		CtldisplayAllCustomer();
    }
    elseif (isset($_POST['addCustomer'])) {
    	$lastName=htmlspecialchars($_POST['lastName']);
    	$name=htmlspecialchars($_POST['name']);
    	$birthDate=$_POST['birthDate'];
    	$phoneNumber=htmlspecialchars($_POST['phoneNumber']);
    	CtlAddCustomer($lastName,$name,$birthDate,$phoneNumber);
    }
    elseif (isset($_POST['getCustomer'])) {
    	$lastName=htmlspecialchars($_POST['getCustomerName']);
    	CtldisplayCustomer($lastName);
    }
    elseif (isset($_POST['deleteCustomer'])) {
    	CtldeleteCustomer();
    }
    else{
        CtlHome();
    }
}
catch(Exception $e) {
    $msg=$e->getMessage(); // recupere le msg de l Exception
    CtlError($msg);  // le msg sera afficher
}


