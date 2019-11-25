<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('pseudo', '');
setcookie('mdp_hache', '');

// redirection pae de connection
header("location: /opr/espace_membre/index.php");