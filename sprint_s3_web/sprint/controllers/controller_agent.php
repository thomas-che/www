<?php

require_once('models/model_agent.php');
require_once('views/view_agent.php');

/////////////////////////////////
//                             //
//        AFFICHAGE            // // thomas
//                             //
/////////////////////////////////

function ctlDisplayNewPatient(){
	displayNewPatient();
}

function ctlDisplayFormSynthese(){
	displayFormSynthese();
}
function ctlDisplayFormNssPatient(){
	displayFormNssPatient();
}
function ctlTakeAppointment(){
	displayTakeAppointment();
}
function ctlDisplayPayementDepot(){
	displayPayementDepot();
}

function ctlDisplayFormChoiseAgent(){
	displayFormChoiseAgent();
}


/*#############################*/
/*                             */
/*                             */
/*            RDV              */ // thomas
/*                             */
/*                             */
/*#############################*/

function ctlConnexionAgent(){
	displayConnexionAgent();
}


function ctlErrorAgent($error){
	displayErrorAgent($error);
}


/* non utiliser 
function ctlDisplayAllReason(){
	$listingAllReason=getAllReason();
	if (!empty($listingAllReason[0])){
		displayAllReason($listingAllReason);
	}
	else{
		throw new Exception("Aucun motif dans la bdd");
	}
}*/

function ctlAppointment($nss,$doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment){
	if (preg_match("#^[0-9]{15}$#", $nss)){
		$idDoctor=getIdDoctor($doctorName);
	  	if (!empty($idDoctor)){
		    $specializeDoctor=getSepcializeDoctor($idDoctor);
		    if ($specializeDoctor==$specialize){
				$slot=getSlot($dateFuturAppointment,$hoursFuturAppointment);
				if (empty($slot)){
					$listingAllReason=getAllReason();
					if (!empty($listingAllReason[0])){
						displayAppointmentReason($nss,$doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment,$listingAllReason);
					}
					else{
						throw new Exception("Aucun motif dans la bdd");
					}
				}
				else{
					throw new Exception("Creneau deja reserver");
				}
		    }
		    else{
		    	throw new Exception("Specialiter n est pas celle du medecin entrer");
		    }
	  	}
		else{
		    throw new Exception("Nom du medecin inconu");
		}
	}
	else{
		throw new Exception("Nss faux");	
	}
}

function ctlDisplayListingDocumentsBring($reason){
	$idReason=getIdReason($reason);
	$listingDocumentsBring=getDocumentsBring($idReason);
	$priceReason=getPriceReason($idReason);
	displayListingDocumentsBring($listingDocumentsBring,$priceReason);
}

function ctlAddAppointment($nss,$doctorName,$dateFuturAppointment,$hoursFuturAppointment,$reason){
	addSlot($dateFuturAppointment,$hoursFuturAppointment);
	$idDoctor=getIdDoctor($doctorName);
	$idReason=getIdReason($reason);
	addAppointment($nss,$idReason,$idDoctor,$dateFuturAppointment,$hoursFuturAppointment);
}

/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // thomas
/*                             */
/*                             */
/*#############################*/


function cltDisplayBalances($nss){
  $answer=getBalances($nss);
  $customerName=strtoupper($answer['nom_patient']);
  $balances=$answer['solde_patient'];
  displayBalances($customerName,$balances);
}


/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // clemence
/*                             */
/*                             */
/*#############################*/

/* thomas modif
	- sup : ctlPageCompte() & ctlPagePayement()

*/

function ctlDisplayAccount($nss){
	$patient=searchPatient($nss);
	$sold=giveSold($nss);
	displayAccount($patient,$sold);
}

// -----> pr inscription <------
// function ctlMakeVirement($montant,$nss){
// 	$patient=searchPatient($nss);
// 	foreach($patient as $ligne){
// 		editAccount($montant,$nss);
// 	}
// 	// displayPageCompte();
// 	ctlConnexionAgent();
// }

/* thomas ajout ctl:
	- regex nss
	- si patient inconu {ne fonctine pas avant d aficher payement success}
	- fomat montant incorect
 */
function ctlMakePayement($montant,$nss){
	if (preg_match("#^[0-9]{15}$#", $nss)){
		$patient=searchPatient($nss);
	// ne fonctione pas avant alert js 
		if (!empty($patient[0])){
			if (is_numeric($montant) && 0<$montant){
				foreach($patient as $ligne){
					if($montant<$ligne->solde_patient){
						editAccount( ( ($ligne->solde_patient)-$montant ),$nss );
						//ctlConnexionAgent();
						cltDisplayBalances($nss);
					}
					else{
						throw new Exception('Solde inferieur au montant');
					}
				}
			}
			else{
				throw new Exception('Format du montant incorect');	
			}
		}
		else{
			throw new Exception("Patient inconu a ce nss");
		}
	}
	else{
		throw new Exception("Nss faux");
	}
}

/* thomas ajout ctl:
	- regex nss
	- si patient inconu {ne fonctine pas avant d aficher payement success}
	- format depot correct
 */
function ctlMakeDepot($depot,$nss){
	if (preg_match("#^[0-9]{15}$#", $nss)){
		$patient=searchPatient($nss);
	// ne fonctione pas avant alert js 
		if (!empty($patient[0])){
			if (is_numeric($depot) && 0<$depot){
				foreach($patient as $ligne){
					editAccount( ( $depot+($ligne->solde_patient) ),$nss );
					//ctlConnexionAgent();
					cltDisplayBalances($nss);
				}
			}
			else{
				throw new Exception('Format du depot incorect');
			}
		}
		else{
			throw new Exception("Patient inconu a ce nss");
		}
	}
	else{
		throw new Exception("Nss faux");
	}
}


/*#############################*/
/*                             */
/*       SYNTHESE=             */
/*       Informations          */// tom
/*       +Liste RDV            */
/*                             */
/*#############################*/

function ctlSynthese($nss){
   //test sur nss et si le patient existe dans ctlAppointmentList
   $displayList=ctlAppointmentList($nss);
   $patient=searchPatient($nss);
   $displayPatient=displayInformations($patient);
   displaySynthese($displayPatient,$displayList);
}
function ctlAppointmentList($nss){
   //test du nss
   if (empty($nss)){
      throw new Exception ("Le nss est vide");
   }
   //test si que des chiffres
   if (!preg_match("#^[0-9]{15}$#", $nss)){
      throw new Exception ("Nss invalide");
   }
   $patient=searchPatient($nss);
   if($patient==null){
      throw new Exception ("Le nss ne correspond pas à un patient");
   }
   $list=getAppointmentList($nss);
   return displayAppointmentList($list);
}


/*#############################*/
/*                             */
/*                             */
/*    Recherche NSS Patient    */ // tom
/*                             */
/*                             */
/*#############################*/

function ctlSearchNssPatient($nom,$date){
   
   if(empty($nom)) throw new Exception ("Le champ du nom est vide");
   if(empty($date)) throw new Exception ("Le champ de la date de naissance est vide");
   $listPatients=getPatients($nom,$date);
   if ($listPatients==null) throw new Exception ("Il n'existe pas de nss correspondant à ce nom et cette date");
   $displayListPatients=displayInformations($listPatients);
   displayNssPatient($displayListPatients);
}


/*#############################*/
/*                             */
/*                             */
/*      Ajouter ou modifier    */ // tom
/*          Patient            */
/*                             */
/*#############################*/

function ctlAddOrUpdatePatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde) {
   if($pays=='') $pays='France';
   $t=Array($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde);
   $i=0;
   foreach($t as $var){
      if($i==8 && $solde==0) continue;
      if (empty($var))throw new Exception ('Un des champs est vide'.$var);
   $i++;
   }
   if(!preg_match("#^[0-9]{15}$#", $nss))throw new Exception ('Nss invalide');
   if(!preg_match("#^0[0-9]{9}$#", $numTel))throw new Exception ('NumTel invalide');
   
   //test date
   if(!preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $date))throw new Exception ('Format date invalide');
   $year=intval(substr($date,0,4));
   $mouth=intval(substr($date,6,2));
   $day=intval(substr($date,9,2));
// pb format date quand thomas execute, date => 2015-6-1
   //if(!checkdate($mouth,$day,$year))throw new Exception ('Date invalide');
   
   $patient=searchPatient($nss);
   if($patient==null){
      addPatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde);
   }
   else {
      updatePatient($nss,$nom,$prenom,$adresse,$numTel,$date,$dep,$pays,$solde);
   }
   displayConnexionAgent();
}




/////////////////////////////////
//                             //
//         payer               // // clemence
//                             //
/////////////////////////////////
function ctlSearchRDV($nss){
	$rdv=searchRDV($nss);
	return $rdv;
}
function ctlSearchPatient($nss){
	if(!empty($nss)){
		$patient=searchPatient($nss);
		return $patient;
	}else{
		throw new Exception("Le NSS n'est pas valide");
	}
	
}
function ctlDisplayPaiement($nss){
	$rdv=ctlSearchRDV($nss);
	$var=displayListAttente($rdv);
	display1($var);
}

function ctlMakePaiement($nss,$prix,$num){ //controle le paiement
	if(!empty($nss)&&!empty($prix)&&!empty($num)){
		$patient=searchPatient($nss);
		foreach($patient as $ligne){
			if($prix<0){
				throw new Exception('Attention Le prix est négatif');
			}
			if($ligne->solde_patient<$prix){
				throw new Exception('Le solde est inferieur au paiement');
			}else{
				editAccount((($ligne->solde_patient)-$prix),$nss);
			}
		}
	}else{
		throw new Exception("Le NSS est incorrect");
	}
	$rdv=ctlSearchRDV($nss);
	$rdv=$rdv[$num-1];
	ChangeStatut($rdv->nss,$rdv->id_motif,$rdv->id_employe,$rdv->date_creneau,$rdv->heure_creneau);
	ctlPageCompte();
}