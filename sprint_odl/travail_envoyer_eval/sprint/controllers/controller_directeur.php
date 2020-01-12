<?php

require_once('models/model_directeur.php');
require_once('views/view_directeur.php');

/*#############################*/
/*                             */
/*                             */
/*     CREE/MODIF LOGIN/MDP    */ // thomas
/*                             */
/*                             */
/*#############################*/

function ctlConnexionDirecteur(){
	displayConnexionDirecteur();
}

function ctlErrorDirecteur($error){
	displayErrorDirecteur($error);
}

function cltDisplayCreatLoginPassword(){
	$listingAllEmployeWithoutLogin=getAllEmployeWithoutLogin();
	displayCreatLoginPassword($listingAllEmployeWithoutLogin);
}

// ------> non utiliser <------
// function ctlDisplayEmployeById($id_employe){
// 	$answer=getEmployeById($id_employe);
// 	$customerFirstName=strtoupper($answer['nom_patient']);
// 	$customerName=$answer['prenom_patient'];
// 	// ---> function display pas fini <---
// 	displayAddLoginPassword($customerFirstName,$customerName);
// }

function ctlCreatLoginPassword($id_employe,$creatLogin,$creatPassword,$confirmPassword){
	$answerLogin=loginAvailable($creatLogin);
	if (empty($answerLogin)){
		if($creatPassword==$confirmPassword){
			$passwordHash= password_hash($creatPassword,PASSWORD_DEFAULT);
			addLoginPassword($id_employe,$creatLogin,$passwordHash);
			ctlConnexionDirecteur();	 	
		}
		else{
			throw new Exception("mot de pass non identique");
		}
	}
	else{
		throw new Exception("login deja utiliser");
	}
}


function cltDisplayUpdateLoginPassword(){
	$listingAllEmploye=getAllEmploye();
	displayUpdateLoginPassword($listingAllEmploye);
}

function ctlDisplayEmploye($id_employe){
	$employe=getEmployeById($id_employe);
	displayEmploye($employe);
}

// pas de test si login deja pris => car deja pris par lui, mais doit faire d autre test par raport a son id_employe
function ctlUpdateEmployeNoPass($id_employe,$nom_employe,$prenom_employe,$login){
	updateEmployeNoPass($id_employe,$nom_employe,$prenom_employe,$login);
	ctlConnexionDirecteur();
// controle	JS + alert confimation	 	
}

// pas double demande mdp
function ctlUpdateEmployePass($id_employe,$nom_employe,$prenom_employe,$login,$mdp){
	$passwordHash= password_hash($mdp,PASSWORD_DEFAULT);
	updateEmployePass($id_employe,$nom_employe,$prenom_employe,$login,$passwordHash);
	ctlConnexionDirecteur();
// controle	JS + alert confimation	 
}


/*#############################*/
/*                             */
/*                             */
/*       CREE/SUP EMPLOYE      */ // clemence
/*                             */
/*                             */
/*#############################*/

function ctlAddEmploye($nom_employe,$prenom_employe){ //controle l'ajout de l'employé
	if(!empty($nom_employe) && !empty($prenom_employe)){
		addEmploye($nom_employe,$prenom_employe);
	}else{
		throw new Exception('Une des informations est incorrecte ou vide');
	}
}
function ctlSearchIDEmploye($nom_employe,$prenom_employe){ //controle la recherche de l'employé
	if(!empty($nom_employe)&&!empty($prenom_employe)){
		$id=searchIDEmploye($nom_employe,$prenom_employe);
		if($id==null){
			throw new PDOException("Cet employé n'existe pas");
		}else{
			return $id;
		}
	}
}
function ctlSearchIDMedecin($id_e){
	if(!empty($id_e)){
		$id=searchIDMedecin($id_e[0]->id_employe);
		if($id==null){
			return $id;
		}
	}else{
		throw new PDOException("L'id n'existe pas");
	}
}
function ctlAddAgent($nom_employe,$prenom_employe){
	if(!empty($nom_employe)&&!empty($prenom_employe)){
		$id_e=ctlSearchIDEmploye($nom_employe,$prenom_employe);
		addAgent($id_e[0]->id_employe);
	}else{
		throw new PDOException("Le nom ou le prenom est incorrect");
	}
}
function ctlAddMedecin($nom_employe,$prenom_employe,$specialite){ //controle l'ajout du medecin
	if(!empty($specialite)&&!empty($nom_employe)&&!empty($prenom_employe)){
		$id_e=ctlSearchIDEmploye($nom_employe,$prenom_employe);
		$spe=giveSpecialite($specialite);
		if($spe==null){ //Si l'id de la specialite n'existe pas on cree une specialite pour ajouter le medecin
			addSpecialite($specialite);
			$spe=giveSpecialite($specialite);
			addMedecin($id_e[0]->id_employe,$spe[0]->id_specialite);
		}else{
			addMedecin($id_e[0]->id_employe,$spe[0]->id_specialite);
		}
	}else{
		throw new Exception("L'un des champs est incorrect ou vide");
	}
}


function ctlDeleteEmploye($nom_employe,$prenom_employe){
	if(!empty($nom_employe)&&!empty($prenom_employe)){
		$id_e=searchIDEmploye($nom_employe,$prenom_employe);
		if($id_e==null){
			throw new Exception("L'employé n'existe pas");
		}else{
			$id_s=ctlSearchIDMedecin($id_e);
			if($id_e==$id_s){

				//thomas modif
				deletSoltEmploye($id_e[0]->id_employe);
				deletRdvEmploye($id_e[0]->id_employe);
				deleteMedecin($id_e[0]->id_employe);
				deleteEmploye($id_e[0]->id_employe);
				
			}else{

				deleteAgent($id_e[0]->id_employe);
				deleteEmploye($id_e[0]->id_employe);
			}
			//ctlPageDirecteur();
			ctlConnexionDirecteur();
		}
	}else{
		throw new Exception("Le nom ou le prenom est invalide");
	}
}

function ctlDisplayCreateEmploy(){
	displayCreateEmploy();
}

function ctlDisplayDeleteEmploy(){
	displayDeleteEmploy();
}

/*#############################*/
/*                             */
/*                             */
/*   Créer Motif               */ // tom
/*                             */
/*                             */
/*#############################*/
// ---> pas vraiment cree ; fonctionelle UNIQUEMENT pour le senario	<---

function ctlDisplayCreateReason(){
	displayCreateReason();
}

function ctlCreateReason($libelleReason,$prixReason,$libellePiece){
   if(empty($libelleReason)||empty($prixReason)||empty($libellePiece)) throw new Exception ('Un des champs est vide');
   createPiece($libellePiece);
   $idPiece=getIdPieceFromLibelle($libellePiece);
   createReason($libelleReason,$prixReason,$idPiece);
   $idReason=getIdReasonFromLibelle($libelleReason);
   createApporter($idPiece,$idReason);

   ctlConnexionDirecteur();
} 