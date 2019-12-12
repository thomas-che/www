<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />
	  
    </head>
  <body>
 
   <form id="monForm" action="forum.php" method="post">
   <fieldset>
          <legend> Se connecter </legend>
   	 
	
	 <p><label>  Login  : </label><input type="text" name="user" /></p>
	 <p><label>  Mot de passe  : </label><input type="text" name="mdp" /></p>
	 <p> <input type="submit" value="OK" name="connect"  /> </p>

	   
   </fieldset>  
   </form>


   <?php echo $contenu; ?>

  


</body>
</html>