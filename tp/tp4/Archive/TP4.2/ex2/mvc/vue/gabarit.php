<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />
	  
    </head>
    
	<body>	
	    <form id="addCustomer" action="site.php" method="post">
   			<fieldset>
   				<legend>Ajouter client</legend>
				<p><label> Nom : </label><input type="text" name="lastName" /></p>
				<p><label> Prenom : </label><input type="text" name="name" /></p>
				<p><label> Date naissance : </label><input type="date" name="birthDate" /></p>
				<p><label> Tel : </label><input type="text" name="phoneNumber" /></p>
				<p> <input type="submit" value="Ajouter client" name="addCustomer" /> </p>
				<p> <input type="reset" value="Tout effacer" name="clear" /> </p>
			</fieldset>
		</form>

		<form id="displayCustomer" action="site.php" method="post">
   			<fieldset>
   				<legend>Afficher client</legend>
				<p> <input type="submit" value="Afficher client" name="displayCustomer" /> </p>
			</fieldset>
		</form>

		<?php echo $displayContents ; ?>

		<form id="getCustomer" action="site.php" method="post">
   			<fieldset>
   				<legend>Rechercher client</legend>
				<p><label> Nom client : </label><input type="text" name="getCustomerName" /></p>
				<p> <input type="submit" value="Rechercher client" name="getCustomer" /> </p>
				<p> <input type="reset" value="Tout effacer" name="clear" /> </p>
			</fieldset>
		</form>

  	</body>

 </html>
 