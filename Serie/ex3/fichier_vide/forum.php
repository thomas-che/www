<!DOCTYPE html> 
    <head>
        <meta charset="utf-8" />
        <title>OPR php</title>
    </head>

    <body>

        <form id="ajouterclient" action="forum.php" method="post">
            <fieldset>
                <legend>Ajouter client</legend>
                <p><label for="boite"> Nom 1 : </label>
                    <p>nom 1<input type="checkbox" name="box" /></p>
                    <p>nom 2<input type="checkbox" name="box" /></p>
                    <p>nom 3<input type="checkbox" name="box" /></p>
                </p>
                <p> <input type="submit" value="Ajouter client" name="ajouter" /> </p>
            </fieldset>
        </form>


        <?php 

        echo var_dump($_POST);
        echo '</br> boite'.var_dump($_POST['boite']);
        echo '</br> box'.var_dump($_POST['box']);


        ?>

    </body>
</html>