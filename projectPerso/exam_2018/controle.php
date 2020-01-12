<?php
/*#############################*/
/*                             */
/*         CONTROLLER          */
/*                             */
/*#############################*/

require_once('models/model.php');
require_once('views/view.php');

function ctlDisplayArticle(){
	$listeArticle=getArticle();
	displayArticle($listeArticle);
}

function ctlValidator(){
	$isCheckboxNotEmpty=false;
	$sum=0;
	foreach ($_POST as $key => $value){
		if ($value =='on'){
			$isCheckboxNotEmpty=true;
			
			$prix=getPriceById($key);
			$sum=$sum+$prix;
			updateStock($key);
		}
	}
	if ($isCheckboxNotEmpty){
		throw new Exception('tt ='.$sum.'€');
	}
	else{
		throw new Exception('pas d article choisie');
	}
}

function ctlError($error){
	displayError($error);
}


/*#############################*/
/*                             */
/*            MODEL            */
/*                             */
/*#############################*/

define("SERVEUR", "localhost");
define("USER", "tp"); // le nom de lutilisateur de la bd
define("PASSWORD", "tp"); // le mdp sur phpmyadmin
define("BDD", "bd_article"); // nom de la bd

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


/*#############################*/
/*                             */
/*           VIEW              */
/*                             */
/*#############################*/

function displayArticle($listAllArticle){
	$contents='<form action="index.php" method="POST" ><table>
				<tr><th>Titre</th><th>Prix</th><th>Stock</th><th>validation</th></tr>';
	foreach ($listAllArticle as $line){
		if (0<$line->stock){
			$contents.='<tr><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td><input type="checkbox" name="'.$line->id.'" ></td></tr>';
		}
		else{
			$contents.='<tr class="zeroStock" ><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td> </td></tr>';
		}
		
	}
	$contents.='</table>
	<input type="submit" name="valider" value="valider la comande" ></form>';
	require_once('gabarit.php');
}

function displayError($error){
	$contents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p>cliquer <a href="index.php">ici</a> pr revenir aceuil</p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}

/*#############################*/
/*                             */
/*          GABARIT            */
/*                             */
/*#############################*/ 
?>
<!DOCTYPE html> 
<html lang="fr" xml:lang="fr"  xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="views/style/style.css"/>
        <script type="text/javascript" src="static/js/acceuil.js" ></script>
        <title>Article</title>
    </head>

    <body>
    	<?php echo $contents; ?>

	</body>
</html>

<?php
/*#############################*/
/*                             */
/*            INDEX            */
/*                             */
/*#############################*/

require_once('controllers/controller.php');

try {
	if (isset($_POST['valider'])){
		ctlValidator();
	}
	else {
		ctlDisplayArticle();
	}
}	
catch (Exception $e) {
	$errorMessage = $e->getMessage();
	ctlError($errorMessage);
}