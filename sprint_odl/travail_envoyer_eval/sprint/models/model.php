<?php

require_once('connect.php');

// require_once('models/model_agent.php');
// require_once('models/model_directeur.php');
// require_once('models/model_medecin.php');

/*#############################*/
/*                             */
/*                             */
/*         CONNEXION           */ // thomas
/*                             */
/*                             */
/*#############################*/

function checkUser($login) {
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT mdp FROM employe WHERE login=:login");
	$prepare->bindValue(':login',$login,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

function getIdEmploye($login) {
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT id_employe FROM employe WHERE login=:login");
	$prepare->bindValue(':login', $login, PDO::PARAM_STR);
	$prepare->execute();
	$idEmploye=$prepare->fetch();
	$prepare->closeCursor();
	return $idEmploye['id_employe'];
}

// ne fonctionne pas avec comme agr le nom de la table
function getCategoryAgent($idEmploye) {
	$connexion=getConnect();
  	$prepare=$connexion->prepare("SELECT id_employe FROM agent WHERE id_employe=:idEmploye");
  	$prepare->bindValue(':idEmploye', $idEmploye, PDO::PARAM_INT);
   	$prepare->execute();
   	$answer=$prepare->fetch();
   	$prepare->closeCursor();
   	return $answer;
}
function getCategoryDirecteur($idEmploye) {
	$connexion=getConnect();
  	$prepare=$connexion->prepare("SELECT id_employe FROM directeur WHERE id_employe=:idEmploye");
  	$prepare->bindValue(':idEmploye', $idEmploye, PDO::PARAM_INT);
   	$prepare->execute();
   	$answer=$prepare->fetch();
   	$prepare->closeCursor();
   	return $answer;
}
