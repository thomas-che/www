<?php 

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

//$resultat=$connexion->query("SELECT * FROM etudiant NATURAL JOIN (SELECT idEtudiant,resultat FROM note WHERE nomMatiere='poo')T1  ORDER BY resultat DESC");
$resultat=$connexion->query("SELECT * FROM etudiant WHERE tp='A' ");


$resultat-> setFetchMode(PDO::FETCH_OBJ);
$i=0;
while ($ligne=$resultat->fetch()) {
    //echo '<p><strong>'.$i++.'</strong>  '.$ligne->idEtudiant.' : '.$ligne->prenom.' '.$ligne->nom.' a eu au cc1 de poo '.$ligne->resultat.'</p>' ;
    echo '<p><strong>'.$ligne->idEtudiant.'</strong> : '.$ligne->prenom.' '.$ligne->nom.' ; tp='.$ligne->tp.' td='.$ligne->td.'</p>' ;
    
}
echo 'rien';
$resultat->closeCursor();