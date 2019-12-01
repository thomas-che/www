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
	//5=7-2 => 7 tirage avec 3 num et jamais 1,1,1
	for($n1=1; $n1<=5; $n1++) {

		
		for($n2=$n1+1; $n2<7; $n2++) {

			for($n3=$n2+1; $n3<=7; $n3++){

				$requete="INSERT INTO tirage VALUES( $n1 , $n2 , $n3 )";
				$resultat=$connexion->query($requete) ;
				$resultat->closeCursor();

			}
			
		}

	}

	echo 'table tirage rempli avec 3 colonnes partant de 1 a 7';
	*/


	//5=7-2 => 7 tirage avec 3 num et jamais 1,1,1 ; 5=7-2boules
	//plus besoin du $j qui corespond a l id ; faire une fonction pour demander le nb de num
	$j=1;
	for($n1=1; $n1<=5; $n1++) {

		
		for($n2=$n1+1; $n2<7; $n2++) {

			for($n3=$n2+1; $n3<=7; $n3++){

				$requete="INSERT INTO tirage VALUES( $n1 , $n2 , $n3 , $j)";
				$resultat=$connexion->query($requete) ;
				$resultat->closeCursor();
				$j++;

			}
			
		}

	}

	echo 'table tirage rempli avec 3 colonnes partant de 1 a 7';
	echo '<br/><br/>';






	//aficher la table
	/*echo '<br/><br/>';
	$requete="SELECT num1,num2,num3 FROM tirage ";
	$resultat=$connexion->query($requete) ;
	$tab= $resultat->fetchAll(PDO::FETCH_ASSOC);
	echo print_r($tab,true);
	$resultat->closeCursor();
	echo '<br/><br/>';
	*/

	