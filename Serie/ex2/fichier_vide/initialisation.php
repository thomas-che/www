<?php 
    try {
    require_once('connect.php') ;
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
    $msg = 'ERREUR dans ' . $e->getFile() . ' Ligne : ' . $e->getLine() . ' : ' . $e->getMessage() ;
    exit($msg);
    }
    $connexion->query("SET NAMES UTF8") ; 

	/*$requete="SELECT num1,num2,num3 FROM tirage WHERE 1 ";
	$resultat=$connexion->query($requete) ;
	$donnees = $resultat->fetch();
	$resultat->closeCursor();

	echo $donnees['num1'] . $donnees['num2'] . $donnees['num3'];

	echo '<br/><br/>';

	$requete="SELECT num1,num2,num3 FROM tirage ";
	$resultat=$connexion->query($requete) ;
	$tab= $resultat->fetchAll(PDO::FETCH_ASSOC);
	echo print_r($tab,true);

	echo '<br/><br/>';
	*/

	// effacer les donner ; TRUNCATE tirage
	$requete=" TRUNCATE tirage ";
	$resultat=$connexion->query($requete) ;
	echo 'table tirage vidé';
	echo '<br/><br/>';

//corect prof 
	/*
	$requete=" DELETE FROM tirage ";
	$resultat=$connexion->query($requete) ;
	*/