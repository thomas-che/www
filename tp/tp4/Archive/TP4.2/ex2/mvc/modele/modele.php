<?php

require_once('connect.php');

function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query("SET NAMES UTF8");
    return $connexion;
}   

function getAllCustomer(){
	$connexion=getConnect();
	$answer=$connexion->query("SELECT * FROM clientsimple");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$listingAllCustomer=$answer->fetchall();
	$answer->closeCursor();
	return $listingAllCustomer;
}

function getCustomer($lastName) {
	$connexion=getConnect();
	$answer=$connexion->query("SELECT * FROM clientsimple WHERE nom='$lastName' ");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$listingCustomerName=$answer->fetchall();
	$answer->closeCursor();
	return $listingCustomerName;
}

function addCustomer($lastName,$name,$birthDate,$phoneNumber){
	$connexion=getConnect();
	$answer=$connexion->query("INSERT INTO clientsimple VALUES (0,'$lastName','$name','$birthDate',$phoneNumber) ");
	$answer->closeCursor();
}

function deleteCustomer($id){
	$connexion=getConnect();
	$answer=$connexion->query("DELETE FROM clientsimple WHERE id=$id");
	$answer->closeCursor();
}