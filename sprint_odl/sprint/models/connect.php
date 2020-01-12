<?php

define("SERVEUR", "localhost");
define("USER", "tp"); // le nom de lutilisateur de la bd
define("PASSWORD", "tp"); // le mdp sur phpmyadmin
define("BDD", "clinique"); // nom de la bd


function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}
