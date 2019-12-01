<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />
	  
    </head>
  <body>
 	
 	<!--  DIAPO PROF -->
 	<!-- <form id="monForm1" action="forum.php" method="post">
		<p><label> Nom : </label><input type="text" name="user" /></p>
		<p><label> Message : </label><input type="text" name="msg" /> </p>
		<p> <input type="submit" value="Envoyer votre msg" name="envoyer" /> </p>
	</form> -->

	<form id="monForm1" action="forum.php" method="post">
		<p><label> login : </label><input type="text" name="login" /></p>
		<p><label> mdp : </label><input type="text" name="mdp" /> </p>
		<p><label> Message : </label><input type="text" name="msg" /> </p>
		<p> <input type="submit" value="Envoyer votre msg" name="envoyer" /> </p>
	</form>

	<?php echo "{gabarie}" . $contenu ; ?>

	<form id="monForm2" action="forum.php" method="post">
		<p><label> Id du message : </label><input type="text" name="idmsg" /></p>
		<p> <input type="submit" value="Supprimer le msg" name="supprimer" /> </p>
	</form>
  


	</body>
</html>