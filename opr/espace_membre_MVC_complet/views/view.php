<?php

function displayConnexion(){
	$contents='
	<form method="post" action="index.php"> 
        <fieldset>
            <legend>Connexion</legend> 
            <p>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" value="';
    if (isset($_COOKIE['pseudo']) ) {
        $pseudo=htmlspecialchars($_COOKIE['pseudo']);
        $contents.=$pseudo;
    }
    $contents.='" />
            </p>
            <p>
                <label for="mdp">Mot de pass :</label>
                <input type="password" name="mdp" id="mdp" value="';
    if (isset($_COOKIE['password']) ) {
        $contents.=$_COOKIE['password'];
    }
    $contents.='" />
            </p>
            <p>
                <input type="checkbox" name="remember-me" id="remember-me" ';
    if (isset($_COOKIE['pseudo']) ) {
        $contents.='checked';
    }
    $contents.=' />
                <label for="remember-me">Connexion automatique </label>
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

