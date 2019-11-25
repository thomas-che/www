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

    /*
   	// 35 c est le nb de ligne
    for($i=0; $i<=35; $i++){

    	$requete="SELECT num1,num2,num3 FROM tirage WHERE id=$i ";
		$resultat=$connexion->query($requete) ;
		$donnees = $resultat->fetch();
		$resultat->closeCursor();
		echo '<p>' . $donnees['num1'] . ' ' . $donnees['num2'] . ' ' . $donnees['num3'] . '</p>' ;
		

    }*/


	echo '<br/><br/>';
	echo 'fin';

// correction prof  ; on lit ligne par ligne
	$requete="SELECT * FROM tirage ";
	$resultat=$connexion->query($requete) ;
	$resultat-> setFetchMode(PDO::FETCH_OBJ);
	while ($ligne=$resultat->fetch()) {
		echo '<p>' . $ligne->num1 . ' ' . $ligne->num2 . ' ' . $ligne->num3 . '</p>' ;
		
	}
	$resultat->closeCursor();