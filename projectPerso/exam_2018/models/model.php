<?php

require_once('connect.php');

function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function getArticle(){
    $connexion=getConnect();
    $resultat=$connexion->query("SELECT id,titre,prix,stock FROM article");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $listArticle=$resultat->fetchall();
    $resultat->closeCursor();
    return $listArticle;
}

function getPriceById($id){
    $connexion=getConnect();
    $prepare=$connexion->prepare("SELECT prix FROM article WHERE id=:id");
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    $prepare->execute();
    $answer=$prepare->fetch();
    $prepare->closeCursor();
    return $answer[0];
}

function updateStock($id){
    $connexion=getConnect();
    $prepare=$connexion->prepare("UPDATE article SET stock=stock-1 WHERE id=:id ");
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    $prepare->execute();
    $prepare->closeCursor();
}