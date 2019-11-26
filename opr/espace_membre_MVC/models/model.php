<?php

require_once('connect.php');

function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function checkUser($login,$password) {
	$requete=$connexion->prepare("SELECT pass FROM membres WHERE pseudo=?");
	$requete->execute(array($pseudo));
	$ligne=$requete->fetch();
	$mdp_hache=$ligne['pass'];
	$isPasswordCorrect= password_verify($mdp, $mdp_hache );
	return $isPasswordCorrect;
}