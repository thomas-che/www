<?php

function displayConnexion(){
	$contents='
	<form method="post" action="index.php"> 
        <fieldset>
            <legend>Connexion</legend> 
            <p>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" />
            </p>
            <p>
                <label for="co_auto">Connexion automatique </label>
                <input type="checkbox" name="co_auto" id="co_auto" />
            </p>
            <p>
            	<input type="submit" name="connexion" value="se conncter" />
            </p>
            <p>
            	<input type="submit" name="goRegistration" value="Shaitez-vous vous inscrire ?" />
            </p>
        </fieldset>
	</form>';
    require_once('gabarit.php');
}

function displayRegistration(){
	$contents='
	<form method="post" action="index.php"> 
        <fieldset>
            <legend>Inscription</legend> 
            <p>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" required />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" required />
            </p>
            <p>
                <label for="mdp_confirmation">Confirmation mot de pass :</label>
                <input type="password" name="mdp_confirmation" id="mdp_confirmation" required />
            </p>
            <p>
                <label for="mail">Mail :</label>
                <input type="text" name="mail" id="mail" required />
            </p>
            <p>
            	<input type="submit" name="Registration" value="envoyer" />
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
	  		<p><a href="index.php"/> Revenir sur la page de connection </a></p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}

// tricher avec le echo
function displayErrorMail($error){
	$contents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p>Recommencer ou <a href="index.php"/> revenir sur la page de connection </a></p>
	  </fieldset>  
	</form>';
	echo $contents;
}


/*#############################*/
/*                             */
/*                             */
/*         MINI CHAT           */
/*                             */
/*                             */
/*#############################*/

function displayDiscusion($discussion){
    $contenu='<form class="discussion">
                <fieldset>
                    <legend>Discussion</legend>';
    foreach ($discussion as $ligne){
        $contenu.='<p><strong>'.$ligne->pseudo.'</strong> : '.$ligne->message.' </p>';
    }
    $contenu.='     </fieldset>
                </form>';
    require_once('gabarit_MC.php');
}

function displayError_MC($error){
    $contenu='<form class="error">
                <fieldset>
                    <legend>/!\ MSG ERROR /!\</legend>';
    $contenu.='<p><strong>'.$error.'</strong></p>';
    $contenu.=' </fieldset>
               </form>';
    require_once('gabarit_MC.php');
}




