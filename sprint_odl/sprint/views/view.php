<?php

// require_once('views/view_agent.php');
// require_once('views/view_directeur.php');
// require_once('views/view_medecin.php');

/*#############################*/
/*                             */
/*                             */
/*         CONNEXION           */ // thomas
/*                             */
/*                             */
/*#############################*/

function displayConnexion(){
    $contents='
    <form method="post" action="index.php" onSubmit="return checkForm(this)"> 
        <fieldset>
            <legend>Connexion</legend> 
            <p>
                <label for="login">Login :</label>
                <input type="text" name="login" id="login" onBlur="checkNotEmpty(this)" />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" onBlur="checkNotEmpty(this)" />
            </p>
            <p>
                <input type="submit" name="connexion" value="se conncter" />
            </p>
        </fieldset>
    </form>';
    require_once('gabarit.php');
}

function displayError($error){
	$contents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p><a href="javascript:history.back()">Revenir a la page precedente</a></p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}
