<?php

// page de test si les fonctions fonctionnent correctement

define("SERVEUR", "localhost");
define("USER", "tp"); // le nom de lutilisateur de la bd
define("PASSWORD", "tp"); // le mdp sur phpmyadmin
define("BDD", "bd_article"); // nom de la bd



function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function getArticle(){
    $connexion=getConnect();
    $resultat=$connexion->query("SELECT titre,prix,stock FROM article");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $listArticle=$resultat->fetchall();
    $resultat->closeCursor();
    return $listArticle;
}

function displayArticle($listAllArticle){
	$contents='<table>
				<tr><th>Titre</th><th>Prix</th><th>Stock</th><th>validation</th></tr>';
	foreach ($listAllArticle as $line){
		$contents.='<tr><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td><input type="checkbox" ></td></tr>';
	}
    $contents.='</table>
            <input type="submit" name="valider" value="valider la comande" ';
    echo $contents;
} 


$l=getArticle();
displayArticle($l);


function getPriceById($id){
    $connexion=getConnect();
    $prepare=$connexion->prepare("SELECT prix FROM article WHERE id=:id");
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    $prepare->execute();
    $answer=$prepare->fetch();
    $prepare->closeCursor();
    return $answer[0];
}

$p=getPriceById(7);
echo '>>'.$p.'<<';

?>
<style>
table,tr,td,th { 
    empty-cells:hide ; 
    border: 1px solid black; 
    border-collapse:separate;
}

.zeroStock{
    color: red;
}
</style>
<tr class="zeroStock" ><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td> </td></tr>