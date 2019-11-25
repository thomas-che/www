<?php session_start() ?>

<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="tp_web.css"/>
        <title>OPR php</title>
    </head>

    <body>
        <?php 

        echo date('Y-m-d');

        $mdp='abcd';
        $mdp_hache= password_hash($mdp,PASSWORD_DEFAULT);

        echo $mdp_hache;


        /*
        $connexion=new PDO('mysql:host=localhost;dbname=bd_opr','thomas','Thomas91');
        $resultat=$connexion->query('SELECT LENGTH(nom) AS nom_maj, possesseur, console, prix FROM jeux_video');
        while ($donnees = $resultat->fetch()){
            echo '<p>'. $donnees['nom_maj'] . ' -- ' . $donnees['possesseur'] . ' -- ' . $donnees['console'] . ' -- ' . $donnees['prix'] . '</p>' ;
        }
        $resultat->closeCursor();
        $connexion=new PDO('mysql:host=localhost;dbname=bd_opr','thomas','Thomas91');
        $resultat=$connexion->query('SELECT AVG(prix) AS moy FROM jeux_video');
        $donnees = $resultat->fetch();
        echo '<p>la moyenne des prix est :' . $donnees['moy'] . '€ </p>';
        */


        /*echo 'debut<br/><br/>';

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
        $requete="SELECT nom FROM ex1 WHERE test=2" ;
        $resultat=$connexion->query($requete) ;

        //pour afficher le resutat sur la page !!
        $donnees = $resultat->fetch();
        echo 'resutat de la requet = ' . $donnees['nom'];

        echo '<br/><br/>fin';
        */
        echo '<br/><br/>';

        

        ?>

        <?php 
        



        ?>
    
        


    </body>
</html>