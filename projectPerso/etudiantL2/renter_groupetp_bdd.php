<?php

// UPDATE `minichat` SET `message` = 'nonnnnnn' WHERE `minichat`.`id` = 43 


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
while ( ($data = fgetcsv($handle,1000,':','"') ) !== FALSE ) {
	
	$idEtudiant=$data[0];

	$tp='D';

	$resultat=$connexion->query(" UPDATE etudiant SET tp= '$tp' WHERE idEtudiant= '$idEtudiant' ");
	$resultat->closeCursor();

}	
fclose($handle);

echo 'fini';