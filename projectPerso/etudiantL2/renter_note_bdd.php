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


$handle = fopen('tpA_note_clean.csv','r');
while ( ($data = fgetcsv($handle,1000,';','"') ) !== FALSE ) {
	
	echo var_dump($data);

	$idEtudiant=$data[0];
	$res=$data[1];
	$nomMatiere='poo';
	$descriptif='cc1';

	$resultat=$connexion->query("INSERT INTO note VALUES ( 0 ,'$idEtudiant','$nomMatiere','$res','$descriptif' ) ");
	$resultat->closeCursor();

}	
fclose($handle);

