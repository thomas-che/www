<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="style.css" />
	  
    </head>
    
	<body>	
   		<form id="ajouterclient" action="site.php" method="post">
   			<fieldset>
   				<legend>Ajouter client</legend>
				<p><label> Nom : </label><input type="text" name="nom" /></p>
				<p> <input type="submit" value="Ajouter client" name="ajouter" /> </p>
				<p> <input type="reset" value="Tout effacer" name="effacer" /> </p>
			</fieldset>
		</form>

		<form id="afficherclient" action="site.php" method="post">
   			<fieldset>
   				<legend>Afficher client</legend>
				<p> <input type="submit" value="Afficher client" name="afficherclient" /> </p>
			</fieldset>
		</form>

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

        if (isset($_POST) && !empty($_POST['nom']) ){
        	$nom=htmlspecialchars($_POST['nom']);
        	$requete="INSERT INTO clientsimple VALUES (0,'$nom')";
        	$resultat=$connexion->query($requete);
        	$resultat->closeCursor();


        }
// afficher les noms
        elseif (isset($_POST['afficherclient'])) {

        	$requete="SELECT nom,id FROM clientsimple";
        	$resultat=$connexion->query($requete);
        	$resultat-> setFetchMode(PDO::FETCH_OBJ);
        	$lesnom=$resultat->fetchall();
		    $resultat->closeCursor();

		    if ( !empty($lesnom[0]) ) { 
		    	?>
		    	<form id="listeclient" action="site.php" method="post">
   					<fieldset>
   						<legend>Lieste des clients</legend>
   						

		    	<?php 
		    	foreach ($lesnom as $ligne ) {
        			echo '<p><input type="checkbox" name="'.$ligne->id.'">Client n° '.$ligne->id.' : '.'<input type="text" name="nomClient" readonly="readonly" value="'.htmlspecialchars($ligne->nom).'"/></p>';
        		}
        		?>
        				
        				<p> <input type="submit" value="Suprimer client" name="supprimerclient" /> </p>
					</fieldset>
				</form>
        		<?php

    // suprimer client
			    if (isset($_POST['supprimerclient'])) {
					foreach ($_POST as $key => $value ) {
						if ($value='on') {
							$id=(int)$key;
							$requete="DELETE FROM clientsimple WHERE id=$id";
							$resultat=$connexion->query($requete);
							$resultat->closeCursor();
						}
					}
			    }
		    }
		    else {
		    	echo '<p>aucune ligne ne répond à votre requête</p>';
		    }
        }
        ?>
        <form id="rechercheClient" action="site.php" method="post">
   			<fieldset>
   				<legend>Rechercher client</legend>
				<p><label> Nom client : </label><input type="text" name="nomCleintRecherche" /></p>
				<p> <input type="submit" value="Rechercher client" name="rechercherClient" /> </p>
				<p> <input type="reset" value="Tout effacer" name="effacer" /> </p>
			</fieldset>
		</form>
		<?php
		if (isset($_POST['rechercherClient']) && !empty($_POST['nomCleintRecherche'])) {
			$nom=htmlspecialchars($_POST['nomCleintRecherche']);
			$requete="SELECT nom,id FROM clientsimple WHERE nom='$nom'";
			$resultat=$connexion->query($requete);
			$resultat->setFetchMode(PDO::FETCH_OBJ);
			$resultatRecherche=$resultat->fetchall();
			$resultat->closeCursor();
			?>

			<form id="resultatRecherche" action="site.php" method="post">
   					<fieldset>
   						<legend>Resultat de la recherche</legend>
   			<?php
			if (!empty($resultatRecherche[0])) {
				$resultatRechercheContennu='';
				foreach ($resultatRecherche as $ligne) {
					$resultatRechercheContennu.='<p><input type="checkbox" name="'.$ligne->id.'">Client n° '.$ligne->id.' : '.'<input type="text" name="nomClient" readonly="readonly" value="'.$nom.'"/></p>';
				}
				$resultatRechercheContennu.='<p> <input type="submit" value="Suprimer client" name="supprimerclient" /> </p>';
			}
			else {
				$resultatRechercheContennu='Aucun client au nom de <strong>'.$nom.'</strong> sur le site';
			}
			echo $resultatRechercheContennu;
			?>
				</fieldset>
			</form>
			<?php
		    			
		}


    // suprimer client
	    if (isset($_POST['supprimerclient'])) {
			foreach ($_POST as $key => $value ) {
				if ($value='on') {
					$id=(int)$key;
					$requete="DELETE FROM clientsimple WHERE id=$id";
					$resultat=$connexion->query($requete);
					$resultat->closeCursor();
				}
			}
	    }


        echo var_dump($_POST);
        foreach ($_POST as $key => $value ) {
        	echo '</br>===>'.$key.' = '.$value;
			if (is_numeric($key)) {
				echo ' --test--> = nb!!! '.$key;
			}
		}

        ?>
  	</body>

 </html>