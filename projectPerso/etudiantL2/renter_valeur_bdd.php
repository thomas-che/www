<?php

//fclose($listeEtu);

// idEtudiant nom prenom email td

try { 
    require_once('connect.php'); 
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query("SET NAMES UTF8");
}
catch(PDOException $e) { 
    $msg = 'ERREUR dans ' . $e->getFile() . ' Ligne : ' . $e->getLine() . ' : ' . $e->getMessage();
    exit($msg); 
}


$handle = fopen('listeEtudiantL2.csv','r');
while ( ($data = fgetcsv($handle,1000,',','"') ) !== FALSE ) {
	$idEtudiant=$data[0];
	$nom=$data[1];
	$prenom=$data[2];
	$email=$data[3];
	$td=$data[4];
	$tp='X';

	$resultat=$connexion->query("INSERT INTO etudiant VALUES ('$idEtudiant','$nom','$prenom','$email','$td','$tp' ) ");
	$resultat->closeCursor();

}	
fclose($handle);

