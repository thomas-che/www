<!DOCTYPE html> <html lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Mini Chat</title> 
    </head>

    <body>

        <form action="minichat.php" method="POST">
            <fieldset>
                <legend>Formulaire</legend>
                <p><label>Pseudo : <input type="text" name="pseudo" /></label></p>
                <p><label>Message : <input type="text" name="message" /></label></p>

                <p><input type="submit" /></p>
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
            
            //print_r($_POST);

            if ( isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['message']) ) {
                $pseudo=htmlspecialchars ($_POST['pseudo']);
                $message=htmlspecialchars ($_POST['message']);
                $requete="INSERT INTO minichat VALUES ( 0 , '$pseudo' , '$message' ) ";
                $resultat=$connexion->exec($requete);
        // pour vider le tab $_POST
                //unset($_POST);  
            }
            
            else {
                echo '<p>le champ pseudo ou message est vide</p>';
            }

            unset($_POST);
        ?>

        <?php
            // afficher la discussion
            $requete="SELECT * FROM minichat ORDER BY id DESC";
            $resultat=$connexion->query($requete) ;
            $resultat-> setFetchMode(PDO::FETCH_OBJ);
            $i=0;
            while ($ligne=$resultat->fetch()) {
                if ($i<10) {
                    echo '<p>' . $ligne->pseudo . ' : ' . $ligne->message . '</p>' ;
                }
                $i++;
            }
            $resultat->closeCursor();
        ?>


    </body>
</html>