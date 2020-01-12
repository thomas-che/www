<?php

require_once('connect.php');


/*#############################*/
/*                             */
/*                             */
/*            RDV              */ // thomas
/*                             */
/*                             */
/*#############################*/

// return la liste des motifs dipo
function getAllReason() {
	$connexion=getConnect();
  	$answer=$connexion->query("SELECT libelle_motif FROM motif ");
  	$answer->setFetchMode(PDO::FETCH_OBJ);
	$listingAllReason=$answer->fetchall();
	$answer->closeCursor();
   	return $listingAllReason;
}

function getIdDoctor($doctorName){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT id_employe FROM employe WHERE nom_employe=:nom_employe");
	$prepare->bindValue(':nom_employe', $doctorName, PDO::PARAM_STR);
	$prepare->execute();
	$idDoctor=$prepare->fetch();
	$prepare->closeCursor();
	return $idDoctor['id_employe'];
}

// rt la spe de l id du doc
function getSepcializeDoctor($idDoctor){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT libelle_specialite FROM specialite NATURAL JOIN (SELECT id_specialite FROM medecin WHERE id_employe=:id_employe)T");
	$prepare->bindValue(':id_employe', $idDoctor, PDO::PARAM_INT);
	$prepare->execute();
	$sepcialize=$prepare->fetch();
	$prepare->closeCursor();
	return $sepcialize[0];
}

function getSlot($dateFuturAppointment,$hoursFuturAppointment){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT date_creneau,heure_creneau FROM creneau WHERE date_creneau=:date_creneau AND heure_creneau=:heure_creneau");
	$prepare->bindValue(':date_creneau', $dateFuturAppointment, PDO::PARAM_STR);
	$prepare->bindValue(':heure_creneau', $hoursFuturAppointment, PDO::PARAM_STR);
	$prepare->execute();
	$slot=$prepare->fetch();
	$prepare->closeCursor();
	return $slot;
}


// -----> fontione pas avec requette preparer <------
// function addSlot($dateFuturAppointment,$hoursFuturAppointment){
// 	$connexion=getConnect();
// 	$prepare=$connexion->prepare("INSERT INTO creneau VALUES ( date_creneau=:dateFuturAppointment, heure_creneau=:hoursFuturAppointment ) ");
// 	$prepare->bindValue(':dateFuturAppointment',$dateFuturAppointment,PDO::PARAM_STR);
// 	$prepare->bindValue(':hoursFuturAppointment',$hoursFuturAppointment,PDO::PARAM_STR);
// 	$prepare->execute();
// 	$prepare->closeCursor();
// }
function addSlot($dateFuturAppointment,$hoursFuturAppointment){
	$connexion=getConnect();
	$answer=$connexion->query("INSERT INTO creneau VALUES ('$dateFuturAppointment','$hoursFuturAppointment') ");
	$answer->closeCursor();
}


function getIdReason($reasonWording){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT id_motif FROM motif WHERE libelle_motif=:libelle_motif");
	$prepare->bindValue(':libelle_motif', $reasonWording, PDO::PARAM_STR);
	$prepare->execute();
	$idReason=$prepare->fetch();
	$prepare->closeCursor();
	return $idReason['id_motif'];
}

// -----> fontione pas avec requette preparer <------
// function addAppointment($nss,$idReason,$idDoctor,$dateFuturAppointment,$hoursFuturAppointment){
// 	$connexion=getConnect();
// 	$prepare=$connexion->prepare("INSERT INTO rdv VALUES ( nss=:nss, id_motif=:id_motif, id_employe=:id_employe, '$dateFuturAppointment', '$hoursFuturAppointment', statut_paiement=:statut_paiement) " );
// 	$prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
// 	$prepare->bindValue(':id_motif', $idReason, PDO::PARAM_INT);
// 	$prepare->bindValue(':id_employe', $idDoctor, PDO::PARAM_INT);
// 	$prepare->bindValue(':statut_paiement', 'en attente de payement', PDO::PARAM_STR);
// 	$prepare->execute();
// 	$prepare->closeCursor();
// }
// ---> peux le faire plus rapidement avec jointure <---
function addAppointment($nss,$idReason,$idDoctor,$dateFuturAppointment,$hoursFuturAppointment){
	$connexion=getConnect();
	$answer=$connexion->query("INSERT INTO rdv VALUES ( '$nss', '$idReason', '$idDoctor', '$dateFuturAppointment', '$hoursFuturAppointment', 'en attente de payement' ) ");
	$answer->closeCursor();
}

function getDocumentsBring($idReason){
	$connexion=getConnect();
  	$prepare=$connexion->prepare("SELECT libelle_piece FROM piece NATURAL JOIN	(SELECT id_piece FROM apporter WHERE id_motif=:id_motif )T ");
  	$prepare->bindValue(':id_motif', $idReason, PDO::PARAM_INT);
	$prepare->execute();
  	$prepare->setFetchMode(PDO::FETCH_OBJ);
	$listingDocumentsBring=$prepare->fetchall();
 	$prepare->closeCursor();
   	return $listingDocumentsBring;
}

function getPriceReason($idReason){
	$connexion=getConnect();
  	$prepare=$connexion->prepare("SELECT prix_motif FROM motif WHERE id_motif=:id_motif ");
  	$prepare->bindValue(':id_motif', $idReason, PDO::PARAM_INT);
	$prepare->execute();
	$priceReason=$prepare->fetch();
 	$prepare->closeCursor();
   	return $priceReason['prix_motif'];
}

/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // thomas
/*                             */
/*                             */
/*#############################*/

function getBalances($nss){
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT nom_patient,solde_patient FROM patient WHERE nss=:nss");
	$prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
	$prepare->execute();
	$answer=$prepare->fetch();
	$prepare->closeCursor();
	return $answer;
}


/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // clemence
/*                             */
/*                             */
/*#############################*/

function editAccount($new_montant,$nss){
	$connexion=getConnect();
// use prepare
	$montant=strval($new_montant);
	$NSS=intval($nss);
	$requete="UPDATE patient SET solde_patient='$montant' WHERE nss='$NSS'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function giveSold($nss){
// use prepare
	$connexion=getConnect();
	$requete="SELECT solde_patient FROM patient WHERE nss='$nss'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$sold=$resultat->fetchall();
	$resultat->closeCursor();
	return $sold;
}
function searchPatient($nss){
// use prepare
	$connexion=getConnect();
	$requete="SELECT * FROM patient WHERE nss='$nss'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$patient=$resultat->fetchall();
	$resultat->closeCursor();
	return $patient;
}

/*#############################*/
/*                             */
/*                             */
/*       Afficher RDV          */ // tom
/*                             */
/*                             */
/*#############################*/

function getAppointmentList($nss){
   $connexion=getConnect();
   $requete="SELECT nom_employe,date_creneau,heure_creneau,prix_motif,statut_paiement FROM
               (SELECT * FROM rdv WHERE nss=:nss) rdv
               NATURAL JOIN motif
               NATURAL JOIN employe";
   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
   $prepare->execute();
   $prepare->setFetchMode(PDO::FETCH_OBJ);
   $list=$prepare->fetchall();
   $prepare->closeCursor();
   return $list;
}


/*#############################*/
/*                             */
/*                             */
/*    Recherche NSS Patient    */ // tom
/*                             */
/*                             */
/*#############################*/

function getPatients($nom,$date) {
   $connexion=getConnect();
   $requete="SELECT *
               FROM patient
               WHERE nom_patient=:nom
               AND date_naissance_patient=:date";
   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':nom', $nom, PDO::PARAM_STR);
   $prepare->bindValue(':date', $date, PDO::PARAM_STR);
   $prepare->execute();
   $prepare->setFetchMode(PDO::FETCH_OBJ);
   $listPatients=$prepare->fetchall();
   $prepare->closeCursor();
   return $listPatients;
}


/*#############################*/
/*                             */
/*                             */
/*      Ajouter ou modifier    */ // tom
/*          Patient            */
/*                             */
/*#############################*/

function addPatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde){
   $connexion=getConnect();
   $requete="INSERT INTO patient
            VALUES (:nss,:nom,:prenom,:adresse,:numTel,:date,:dep,:pays,:solde)";

   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
   $prepare->bindValue(':nom', $nom, PDO::PARAM_STR);
   $prepare->bindValue(':prenom', $prenom, PDO::PARAM_STR);
   $prepare->bindValue(':adresse', $adresse, PDO::PARAM_STR);
   $prepare->bindValue(':numTel', $numTel, PDO::PARAM_STR);
   $prepare->bindValue(':date', $date, PDO::PARAM_STR);
   $prepare->bindValue(':dep', $dep, PDO::PARAM_STR);
   $prepare->bindValue(':pays', $pays, PDO::PARAM_STR);
   $prepare->bindValue(':solde', $solde, PDO::PARAM_INT);
   $prepare->execute();
   $prepare->closeCursor();
}

function updatePatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde){
   $connexion=getConnect();
   $requete="UPDATE `patient` 
            SET `nss` = :nss, 
            `nom_patient` = :nom, 
            `prenom_patient` = :prenom, 
            `adresse_patient` = :adresse, 
            `num_tel_patient` = :numTel, 
            `date_naissance_patient` = :date, 
            `departement_naissance_patient` = :dep, 
            `pays_naissance_patient` = :pays, 
            `solde_patient` = :solde 
            WHERE `patient`.`nss` = :nss ";

   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
   $prepare->bindValue(':nom', $nom, PDO::PARAM_STR);
   $prepare->bindValue(':prenom', $prenom, PDO::PARAM_STR);
   $prepare->bindValue(':adresse', $adresse, PDO::PARAM_STR);
   $prepare->bindValue(':numTel', $numTel, PDO::PARAM_STR);
   $prepare->bindValue(':date', $date, PDO::PARAM_STR);
   $prepare->bindValue(':dep', $dep, PDO::PARAM_STR);
   $prepare->bindValue(':pays', $pays, PDO::PARAM_STR);
   $prepare->bindValue(':solde', $solde, PDO::PARAM_INT);
   $prepare->execute();
   $prepare->closeCursor();
}

