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
				<p><label> Prenom : </label><input type="text" name="prenom" /></p>
				<p><label> Date naissance : </label><input type="date" name="datenaissance" /></p>
				<p><label> Tel : </label><input type="tel" name="tel" /></p>
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

        if (isset($_POST) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['datenaissance']) && !empty($_POST['tel']) ){
        	$nom=htmlspecialchars($_POST['nom']);
        	$prenom=htmlspecialchars($_POST['prenom']);
        	$datenaissance=htmlspecialchars($_POST['datenaissance']);
        	$tel=htmlspecialchars($_POST['tel']);

        	if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", "$tel")) {
        		$requete="INSERT INTO clientsimple VALUES (0,'$nom','$prenom','$datenaissance','$tel')";
        		$resultat=$connexion->query($requete);
        		$resultat->closeCursor();
        	}
        	else {
        		echo '<p> /!\ tel incorect /!\ </p>';
        	}



        }
// afficher les noms
        elseif (isset($_POST['afficherclient'])) {

        	$requete="SELECT id,nom,prenom,datenaissance,tel FROM clientsimple";
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
		    		$phrase=strtoupper(htmlspecialchars($ligne->nom)).' '.htmlspecialchars($ligne->prenom).' né le '.$ligne->datenaissance.' joingnable sur le 0'.$ligne->tel;
        			echo '<p><input type="checkbox" name="'.$ligne->id.'">Client n° '.$ligne->id.' : '.'<input type="text" name="nomClient" readonly="readonly" value="'.$phrase.'"/></p>';
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