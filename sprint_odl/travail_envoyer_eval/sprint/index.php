<?php

session_start();

require_once('controllers/controller.php');

try {

/////////////////////////////////
//                             //
//        CONNEXION            // // thomas
//                             //
/////////////////////////////////
	if (isset($_POST['connexion']) && !empty($_POST['login']) && !empty($_POST['mdp']) ) {
		$login= htmlspecialchars($_POST['login']);
		$password=htmlspecialchars($_POST['mdp']);
		ctlAccess($login,$password);
	}

/*#############################*/
/*                             */
/*                             */
/*            AGENT            */ 
/*                             */
/*                             */
/*#############################*/

/////////////////////////////////
//                             //
//        AFFICHAGE            // // thomas
//                             //
/////////////////////////////////
	elseif (isset($_POST['newPatient'])) {
		ctlDisplayNewPatient();
	}
	elseif (isset($_POST['FormSynthese'])) {
		ctlDisplayFormSynthese();
	}
	elseif (isset($_POST['displayFormNssPatient'])) {
		ctlDisplayFormNssPatient();
	}
	elseif (isset($_POST['displayTakeAppointment'])) {
		ctlTakeAppointment();
	}
	elseif (isset($_POST['displayPayementDepot'])) {
		ctlDisplayPayementDepot();
	}


/////////////////////////////////
//                             //
//            RDV              // // thomas
//                             //
/////////////////////////////////
// controle que doc+spe sont compatible puis ctl date/heure disponible
	elseif (isset($_POST['checkAppointment']) && !empty($_POST['nss']) && !empty($_POST['doctorName']) && !empty($_POST['specialize']) && !empty($_POST['dateFuturAppointment']) && !empty($_POST['hoursFuturAppointment']) ) {

		$nss=htmlspecialchars($_POST['nss']);
		$doctorName= htmlspecialchars($_POST['doctorName']);
		$specialize=htmlspecialchars($_POST['specialize']);
		$dateFuturAppointment=htmlspecialchars($_POST['dateFuturAppointment']);
		$hoursFuturAppointment=htmlspecialchars($_POST['hoursFuturAppointment']);

		//ph renvoie avec type time 07:00 ; phpMyAdmin: 07:00:00 ; ne garde que les heures
		$hoursFuturAppointment=substr($hoursFuturAppointment, 0, 2);
		$hoursFuturAppointment.=':00:00';
		ctlAppointment($nss,$doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment);
	}

/////////////////////////////////
//                             //
//         RDV AJOUT           // // thomas
//                             //
/////////////////////////////////
	elseif (isset($_POST['addAppointment']) && !empty($_POST['nss']) && !empty($_POST['doctorName']) && !empty($_POST['specialize']) && !empty($_POST['dateFuturAppointment']) && !empty($_POST['hoursFuturAppointment']) && !empty($_POST['allReason'])) {

		$nss=htmlspecialchars($_POST['nss']);
		$doctorName= htmlspecialchars($_POST['doctorName']);
		$dateFuturAppointment=htmlspecialchars($_POST['dateFuturAppointment']);
		$hoursFuturAppointment=htmlspecialchars($_POST['hoursFuturAppointment']);
		$reason=htmlspecialchars($_POST['allReason']);

		ctlAddAppointment($nss,$doctorName,$dateFuturAppointment,$hoursFuturAppointment,$reason);
		ctlDisplayListingDocumentsBring($reason);

	}
	elseif ( isset($_POST['payer']) && !empty($_POST['nss']) && !empty($_POST['prix'])) {
		$nss=htmlspecialchars($_POST['nss']);
		$new_montant=htmlspecialchars($_POST['prix']);
		ctlMakePayement($new_montant,$nss);
		cltDisplayBalances($nss);
	}
	elseif (isset($_POST['deposer']) && !empty($_POST['nss']) && !empty($_POST['depot'])) {
		$nss=htmlspecialchars($_POST['nss']);
		$depot=htmlspecialchars($_POST['depot']);
		ctlMakeDepot($depot,$nss);
		cltDisplayBalances($nss);
	}

//////////////////////////////////////
//                                  //
// SYNTHESE=Informations +Liste RDV // // tom
//                                  //
//////////////////////////////////////
	elseif (isset($_POST['synthese']) && !empty($_POST['nss_synthese'])) {
		$nss=htmlspecialchars($_POST['nss_synthese']);
		ctlSynthese($nss);
	}

/////////////////////////////////
//                             //
//   Recherche NSS Patient     // // tom
//                             //
/////////////////////////////////
	// recherche nss avec nom et date patient
	elseif (isset($_POST['rechercher']) && !empty($_POST['nom_patient']) && !empty($_POST['date_patient']) ) {
		$customerName=htmlspecialchars($_POST['nom_patient']);
	    $customerBirthday=htmlspecialchars($_POST['date_patient']);
	    ctlSearchNssPatient($customerName,$customerBirthday);
	}
/////////////////////////////////
//                             //
//   Ajouter/Modifier Patient  // // tom
//                             //
/////////////////////////////////
	elseif(isset($_POST['ajouter_patient']) || isset($_POST['modifier'])){
      $nss=$_POST['nss'];
      $nom=$_POST['nom_patient'];
      $prenom=$_POST['prenom_patient'];
      $adresse=$_POST['adresse_patient'];
      $numTel=$_POST['num_tel_patient'];
      $date=$_POST['date_patient'];
      $dep=$_POST['departement_patient'];
      $solde=$_POST['solde'];
      if ($dep=='99') $pays=$_POST['pays_patient'];
      else $pays='';
      $solde=0;

      ctlAddOrUpdatePatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde);
   }





/*#############################*/
/*                             */
/*                             */
/*   Ajouter/Modifier Patient  */ // tom
/*                             */
/*                             */
/*#############################*/
/*
elseif(isset($_POST['ajouter_patient']) || isset($_POST['modifier'])){
      $nss=$_POST['nss'];
      $nom=$_POST['nom_patient'];
      $prenom=$_POST['prenom_patient'];
      $adresse=$_POST['adresse_patient'];
      $numTel=$_POST['num_tel_patient'];
      $date=$_POST['date_patient'];
      $dep=$_POST['departement_patient'];
      if ($dep=='99') $pays=$_POST['pays_patient'];
      else $pays='';
      $solde=0;

      ctlAddOrUpdatePatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde);
   }
*/






/*#############################*/
/*                             */
/*                             */
/*          MEDECIN            */ 
/*                             */
/*                             */
/*#############################*/

/////////////////////////////////
//                             //
//   Bloquer Creneau Medecin   // // tom
//                             //
/////////////////////////////////
	elseif ( isset($_POST['bloquer']) && !empty($_POST['login']) && !empty($_POST['nbCreneaux']) ) {
		
		$login=htmlspecialchars($_POST['login']);
    	$nb=htmlspecialchars($_POST['nbCreneaux']);
		$dates=Array();
		$hours=Array();
		for($i=1;$i<$nb+1;$i++){
			array_push($dates,$_POST['d'.$i]);
			array_push($hours,$_POST['h'.$i]);
		}
		ctlBlockSlots($login,$nb,$dates,$hours);
	}


/*#############################*/
/*                             */
/*                             */
/*         DIRECTEUR           */ 
/*                             */
/*                             */
/*#############################*/

/////////////////////////////////
//                             //
//     CREE/MODIF LOGIN/MDP    // // thomas
//                             //
/////////////////////////////////
	elseif (isset($_POST['creatLogPass'])) {
		cltDisplayCreatLoginPassword();
	}

/////////////////////////////////
//                             //
//        CREE LOGIN/MDP       // // thomas
//                             //
/////////////////////////////////
// ajout du login et mdp au emplyoe
	elseif (isset($_POST['CreatLoginPassword']) && !empty($_POST['creatLogin']) && !empty($_POST['creatPassword']) && !empty($_POST['confirmPassword']) && !empty($_POST['allEmployeWithoutLogin']) ) {

		$id_employe=$_POST['allEmployeWithoutLogin'];
		$creatLogin=htmlspecialchars($_POST['creatLogin']);
		$creatPassword=htmlspecialchars($_POST['creatPassword']);
		$confirmPassword=htmlspecialchars($_POST['confirmPassword']);
		ctlCreatLoginPassword($id_employe,$creatLogin,$creatPassword,$confirmPassword);

// todo: affiche page cofimation
	}

/////////////////////////////////
//                             //
//    SELECT EMPLOYE A MODIF   // // thomas
//                             //
/////////////////////////////////
// selectioner puis modifier info d un employe
	elseif (isset($_POST['updatetLogPass'])) {
		cltDisplayUpdateLoginPassword();
	}

/////////////////////////////////
//                             //
//      MODIF INFO EMPLOYE     // // thomas
//                             //
/////////////////////////////////
// affiche le form pr modif les infos de l employe
	elseif (isset($_POST['updateLoginPassword']) && !empty($_POST['allEmploye']) ) {
		$id_employe=$_POST['allEmploye'];
		ctlDisplayEmploye($id_employe);
	}

/////////////////////////////////
//                             //
//      UPDATE INFO EMPLOYE    // // thomas
//                             //
/////////////////////////////////
// update les info de l employer
	elseif (isset($_POST['UpdateLoginPassword']) && !empty($_POST['nom_employe']) && !empty($_POST['prenom_employe']) && !empty($_POST['login']) ) {
		
		$id_employe=$_POST['id_employe'];
		$nom_employe=htmlspecialchars($_POST['nom_employe']);
		$prenom_employe=htmlspecialchars($_POST['prenom_employe']);
		$login=htmlspecialchars($_POST['login']);

		// update juste le nom prenom et log d un employe si mdp est vide
		if (empty($_POST['mdp'])) {
			ctlUpdateEmployeNoPass($id_employe,$nom_employe,$prenom_employe,$login);
		}
		else {
			$mdp=htmlspecialchars($_POST['mdp']);
			ctlUpdateEmployePass($id_employe,$nom_employe,$prenom_employe,$login,$mdp);
		}
// todo: affiche page cofimation
	}

/////////////////////////////////
//                             //
//       Créer Motif           // // tom
//                             //
/////////////////////////////////
// ---> pas vraiment cree ; fonctionelle UNIQUEMENT pour le senario	<---
	elseif ( isset($_POST['creer_motif']) && !empty($_POST['libelle_motif']) && !empty($_POST['prix_motif']) && !empty($_POST['piece_motif']) ) {
		$libelleReason=htmlspecialchars($_POST['libelle_motif']);
		$prixReason=htmlspecialchars($_POST['prix_motif']);
		$libellePiece=htmlspecialchars($_POST['piece_motif']);

		ctlCreateReason($libelleReason,$prixReason,$libellePiece);
	}


/////////////////////////////////
//                             //
//       CREE EMPLOYE          // // clemence
//                             //
/////////////////////////////////
	elseif (isset($_POST['creatEmploy'])) {
		ctlDisplayCreateEmploy();
	}
	elseif (isset($_POST['creer']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
		
		$nom=htmlspecialchars($_POST['nom']);
    	$prenom=htmlspecialchars($_POST['prenom']);
		$specialite=htmlspecialchars($_POST['spe']);
	    
	    if($_POST['spe']==null){
	      ctlAddEmploye($nom,$prenom);
	      ctlAddAgent($nom,$prenom);
	      ctlConnexionDirecteur();
	    }
	    else{
	      ctlAddEmploye($nom,$prenom);
	      ctlAddMedecin($nom,$prenom,$specialite);
	      ctlConnexionDirecteur();
	    }
	}

/////////////////////////////////
//                             //
//       SUPPRIME EMPLOYE      // // clemence
//                             //
/////////////////////////////////
	elseif (isset($_POST['deleteEmploy'])) {
		ctlDisplayDeleteEmploy();
	}
	elseif (isset($_POST['supprimer']) && !empty($_POST['nom']) ) {
		$nom=htmlspecialchars($_POST['nom']);
    	$prenom=htmlspecialchars($_POST['prenom']);
    	ctlDeleteEmploye($nom,$prenom);
	}


/////////////////////////////////
//                             //
//       GESTION SESSION       // // thomas
//                             //
/////////////////////////////////
	elseif (isset($_POST['deconnexion']) ) {
	 	ctlDeconnexion();
	}
	elseif (isset($_SESSION['categorie'])) {

		if ($_SESSION['categorie']=='agent') {
			ctlConnexionAgent();
		}
		elseif ($_SESSION['categorie']=='medecin') {
			ctlConnexionMedecin();
		}
		else{
			ctlConnexionDirecteur();
		}
	}
// retour connexion
	else{
		ctlConnexion();
	}
		 
}





	
catch (Exception $e) {

	if (isset($_SESSION['categorie'])) {
		if ($_SESSION['categorie']=='agent') {
			$errorMessage = $e->getMessage();
			ctlErrorAgent($errorMessage);
		}
		elseif ($_SESSION['categorie']=='medecin') {
			ctlConnexionMedecin();
		}
		else{
			$errorMessage = $e->getMessage();
			ctlErrorDirecteur($errorMessage);
		}
	}
	else {
		$errorMessage = $e->getMessage();
		ctlError($errorMessage);
	}
}
