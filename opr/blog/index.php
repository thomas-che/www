<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>OPR php</title>
    </head>

    <body>

    	<h1>Mon super blog !</h1>

		<?php

		try { // on essay de ce connecter
		    require_once('connect.php'); // appelle le fichier connect.php
		    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); // cree la connection en remplacant les variables
		    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // initialise les future msg d erreur
		}
		catch(PDOException $e) { // on capture l erreur et on l afiche
		    $msg = 'ERREUR dans ' . $e->getFile() . ' Ligne : ' . $e->getLine() . ' : ' . $e->getMessage();
		    exit($msg); 
		}
		$connexion->query("SET NAMES UTF8"); // initialise l encodage



		// requete preparer avec marqueur nominatif :nom
		// titre,date_creation,contenu,id
		$requete=$connexion->prepare("SELECT *,DATE_FORMAT(date_creation, 'le %d/%m/%Y a %Hh%imin%ss') AS date_retour FROM billets LIMIT 5");
		$requete->execute(array());
		while ($ligne=$requete->fetch()) {
			echo '<div class="news"><h3>' . $ligne['titre'] . $ligne['date_retour'] . '</h3><p>' . $ligne['contenu'] . '</br><a href="commentaire.php?billets=' . $ligne['id'] . '">Commentaire</a></p></div>';
		}

		?>


	</body>
</html>


<!-- ==================> CORRECTION <=================================================================-->

<!-- a faire la prochaine fois: -->
<?php 
echo htmlspecialchars($donnees['titre']);  // eviter faille xss
echo nl2br(htmlspecialchars($donnees['contenu'])); // convertir les retour ligne en br
$req->closeCursor(); // pas oblier de liberer le curseur
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p>Derniers billets du blog :</p>
 
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch())
{
?>
<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    <br />
    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
</body>
</html>