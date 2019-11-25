<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>OPR php</title>
    </head>

    <body>

		<?php

		$id_billet=$_GET['billets'];

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

		echo '<p><a href="index.php">revenir a la liste des billets</a></p>';

		$requete=$connexion->prepare("SELECT * FROM billets WHERE id=$id_billet");
		$requete->execute(array());
		while ($ligne=$requete->fetch()) {
			echo '<div class="news"><h3>' . $ligne['titre'] . $ligne['date_creation'] . '</h3><p>' . $ligne['contenu'] . '</p></div>';
		}


		// requete preparer avec marqueur nominatif :nom
		// titre,date_creation,contenu,id
		$requete=$connexion->prepare("SELECT * FROM commentaires WHERE id_billet=? ");
		$requete->execute(array($_GET['billets']));
		while ($ligne=$requete->fetch()) {
			echo '<p><strong>' . $ligne['auteur'] . '</strong> ' . $ligne['date_commentaire'] . '</p>';
			echo '<p>' . $ligne['commentaire'] . '</p>';
		}

		?>
	</body>
</html>


<!-- ==================> CORRECTION <=================================================================-->


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
 
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

// Récupération du billet
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();
?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>
</body>
</html>