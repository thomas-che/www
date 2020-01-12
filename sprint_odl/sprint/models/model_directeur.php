<?php

require_once('connect.php');

/*#############################*/
/*                             */
/*                             */
/*     CREE/MODIF LOGIN/MDP    */ // thomas
/*                             */
/*                             */
/*#############################*/


// return le login si il est deja pris
function loginAvailable($loginTest){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT login FROM employe WHERE login IN ( :loginTest ) ");
	$prepare->bindValue(':loginTest',$loginTest,PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}

function getAllEmployeWithoutLogin() {
	$connexion=getConnect();
	$answer=$connexion->query("SELECT id_employe,nom_employe,prenom_employe FROM employe WHERE login IS NULL and mdp IS NULL;");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$listingAllEmployeWithoutLogin=$answer->fetchall();
	$answer->closeCursor();
	return $listingAllEmployeWithoutLogin;
}

function addLoginPassword($id_employe,$creatLogin,$passwordHash){
	$connexion=getConnect();
	$prepare=$connexion->prepare("UPDATE employe SET login=:login ,mdp=:mdp WHERE id_employe=:id_employe");
	$prepare->bindValue(':login',$creatLogin,PDO::PARAM_STR);
	$prepare->bindValue(':mdp',$passwordHash,PDO::PARAM_STR);
	$prepare->bindValue(':id_employe',$id_employe,PDO::PARAM_INT);
	$prepare->execute();
	$prepare->closeCursor();
}

function getAllEmploye() {
	$connexion=getConnect();
	$answer=$connexion->query("SELECT id_employe,nom_employe,prenom_employe,login,mdp FROM employe");
	$answer->setFetchMode(PDO::FETCH_OBJ);
	$listingAllEmploye=$answer->fetchall();
	$answer->closeCursor();
	return $listingAllEmploye;
}

function getEmployeById($id_employe) {
   $connexion=getConnect();
   $prepare=$connexion->prepare("SELECT id_employe,nom_employe,prenom_employe,login,mdp FROM employe WHERE id_employe=:id_employe");
   $prepare->bindValue(':id_employe', $id_employe, PDO::PARAM_INT);
   $prepare->execute();
   $EmployeById=$prepare->fetch();
   $prepare->closeCursor();
   return $EmployeById;
}

function updateEmployeNoPass($id_employe,$nom_employe,$prenom_employe,$login){
	$connexion=getConnect();
	$prepare=$connexion->prepare("UPDATE employe SET nom_employe=:nom_employe, prenom_employe=:prenom_employe, login=:login WHERE id_employe=:id_employe");
	$prepare->bindValue(':nom_employe',$nom_employe,PDO::PARAM_STR);
	$prepare->bindValue(':prenom_employe',$prenom_employe,PDO::PARAM_STR);
	$prepare->bindValue(':login',$login,PDO::PARAM_STR);
	$prepare->bindValue(':id_employe',$id_employe,PDO::PARAM_INT);
	$prepare->execute();
	$prepare->closeCursor();
}

function updateEmployePass($id_employe,$nom_employe,$prenom_employe,$login,$mdp){
	$connexion=getConnect();
	$prepare=$connexion->prepare("UPDATE employe SET nom_employe=:nom_employe, prenom_employe=:prenom_employe, login=:login, mdp=:mdp WHERE id_employe=:id_employe");
	$prepare->bindValue(':nom_employe',$nom_employe,PDO::PARAM_STR);
	$prepare->bindValue(':prenom_employe',$prenom_employe,PDO::PARAM_STR);
	$prepare->bindValue(':login',$login,PDO::PARAM_STR);
	$prepare->bindValue(':mdp',$mdp,PDO::PARAM_STR);
	$prepare->bindValue(':id_employe',$id_employe,PDO::PARAM_INT);
	$prepare->execute();
	$prepare->closeCursor();
}

/*#############################*/
/*                             */
/*                             */
/*       CREE/SUP EMPLOYE      */ // clemence
/*                             */
/*                             */
/*#############################*/

function addEmploye($nom_employe,$prenom_employe){ //ajout employé
	$connexion=getConnect();
	$requete="INSERT INTO employe VALUES(0,null,null,:nom_employe,:prenom_employe)";
	$resultat=$connexion->prepare($requete);
	$resultat->bindValue(':nom_employe',$nom_employe,PDO::PARAM_STR);
	$resultat->bindValue(':prenom_employe',$prenom_employe,PDO::PARAM_STR);
	$resultat->execute();
	$resultat->closeCursor();
}
function searchIDEmploye($nom_employe,$prenom_employe){ //chercher id_employe
	$connexion=getConnect();
	$requete="SELECT id_employe FROM employe WHERE nom_employe='$nom_employe' AND prenom_employe='$prenom_employe'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$employe=$resultat->fetchall();
	$resultat->closeCursor();
	return $employe;
}
function searchIDMedecin($id_e){ //cherche l'id du medecin
	$connexion=getConnect();
	$requete="SELECT id_employe FROM medecin WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$id=$resultat->fetchall();
	$resultat->closeCursor();
	return $id;
}
function addAgent($id_e){ //ajout Agent
	$connexion=getConnect();
	$requete="INSERT INTO agent VALUES('$id_e')";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function addMedecin($id_e,$id_s){ //ajout d'un medecin
	$connexion=getConnect();
	$requete="INSERT INTO medecin VALUES('$id_e','$id_s')";
	$resultat=$connexion->prepare($requete);
	$resultat->bindValue(':id_employe',$id_e,PDO::PARAM_STR);
	$resultat->bindValue(':id_specialite',$id_s,PDO::PARAM_STR);
	$resultat->execute();
	$resultat->closeCursor();
}
function giveSpecialite($specialite){ //donne l'id de la spécialité
	$connexion=getConnect();
	$requete="SELECT id_specialite FROM specialite WHERE libelle_specialite='$specialite'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$spe=$resultat->fetchall();
	$resultat->closeCursor();
	return $spe;
}
function addSpecialite($specialite){ //ajout specialité
	$connexion=getConnect();
	$requete="INSERT INTO specialite VALUES(0,:libelle_specialite)";
	$resultat=$connexion->prepare($requete);
	$resultat->bindValue(':libelle_specialite',$specialite,PDO::PARAM_STR);
	$resultat->execute();
}

// thomas ajout
function deletSoltEmploye($id_e){
	$connexion=getConnect();
	$requete="DELETE FROM bloquer WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
// thomas ajout
function deletRdvEmploye($id_e){
	$connexion=getConnect();
	$requete="DELETE FROM rdv WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function deleteEmploye($id_e){ //supprime employé
	$connexion=getConnect();
	$requete="DELETE FROM employe WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function deleteAgent($id_e){ //supprime agent
	$connexion=getConnect();
	$requete="DELETE FROM agent WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function deleteMedecin($id_e){ //supprime medecin
	$connexion=getConnect();
	$requete="DELETE FROM medecin WHERE id_employe='$id_e'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}


/*#############################*/
/*                             */
/*                             */
/*   Créer Motif               */ // tom
/*                             */
/*                             */
/*#############################*/
// ---> pas vraiment cree ; fonctionelle UNIQUEMENT pour le senario	<---

function createPiece($libellePiece) {
   $connexion=getConnect();
   $requete="INSERT INTO piece VALUES (0,'$libellePiece')";
   $connexion->query($requete);
}

function createReason($libelleReason,$prixReason) {
   $connexion=getConnect();
   $requete="INSERT INTO motif VALUES (0,'$libelleReason','$prixReason','')";
   $connexion->query($requete);
}

function createApporter($idPiece,$idReason){
   $connexion=getConnect();
   $requete="INSERT INTO apporter VALUES ('$idReason','$idPiece')";
   $connexion->query($requete);
}

function getIdPieceFromLibelle($libellePiece){
   $connexion=getConnect();
   $requete="SELECT id_piece FROM piece WHERE libelle_piece='$libellePiece'";
   $res=$connexion->query($requete);
   $res->setFetchMode(PDO::FETCH_OBJ);
   $id=$res->fetchall();
   return $id[0]->id_piece;
}

function getIdReasonFromLibelle($libelleReason){
   $connexion=getConnect();
   $requete="SELECT id_motif FROM motif WHERE libelle_motif='$libelleReason'";
   $res=$connexion->query($requete);
   $res->setFetchMode(PDO::FETCH_OBJ);
   $id=$res->fetchall();
   return $id[0]->id_motif;
}






