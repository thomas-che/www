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
          <legend> Poster un message </legend>
   	  	 <p><label>  Message  : </label><input type="text" name="msg" /> </p>
	     <p> <input type="submit" value="Envoyer votre message" name="envoyer"  /> </p>

	   
   </fieldset>  
   </form>


   <?php echo $contenu; ?>

   <form id="monForm" action="forum.php" method="post">
   <fieldset>
          <legend> Effacer un message </legend>
   	 
	
	 <p><label>  Id du message  : </label><input type="text" name="idmsg" /></p>
	 <p> <input type="submit" value="Supprimer le msg" name="supprimer"  /> </p>

	   
   </fieldset>  
   </form>

   <form id="monForm" action="forum.php" method="post">
   <fieldset>
          <legend> Se déconnecter </legend>
   	 
	
	 <p> <input type="submit" value="Quitter le forum" name="deconnect"  /> </p>

	   
   </fieldset>  
   </form>
</body>
</html>