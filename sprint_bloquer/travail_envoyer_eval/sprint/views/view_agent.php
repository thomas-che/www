<?php

// MODIF PR NEW PATIENT

function displayFormChoiseAgent(){
	$contents='<form method="post" action="index.php" name="formChoiseAgent" id="formChoiseAgent" > 
			    <fieldset>
			        <legend>Choix action</legend>

			        	<input type="submit" name="newPatient" id="newPatient" value="Nouveau patient" />

			            <input type="submit" name="FormSynthese" id="FormSynthese" value="Synthese patient & modif info" />
			            <input type="submit" name="displayFormNssPatient" id="displayFormNssPatient" value="Recherche nss patient" />
			            <input type="submit" name="displayTakeAppointment" id="displayTakeAppointment" value="Prendre un rdv" />
			            <input type="submit" name="displayPayementDepot" id="displayPayementDepot" value="Payer & depot" /> 
			    </fieldset>
			</form>';
	return $contents;
}




/*#############################*/
/*                             */
/*                             */
/*            RDV              */ // thomas
/*                             */
/*                             */
/*#############################*/

function displayConnexionAgent(){
	$contentsError='';
	$contents=displayFormChoiseAgent();
	require_once('gabarit_agent.php');
	// $contents=displayFormSynthese();
	// $contents.=displayFormNssPatient();
	// $contents.=displayTakeAppointment();
	// $contents.=displayPayement();
	// $contents.=displayDepot();
	// $contentsError='';
	// require_once('gabarit_agent.php');
}

function displayErrorAgent($error){
	// $contents=displayFormSynthese();
	// $contents.=displayFormNssPatient();
	// $contents.=displayTakeAppointment();
	// $contents.=displayPayement();
	// $contents.=displayDepot();
	$contents=displayFormChoiseAgent();
	$contentsError=displayErrorA($error);
	require_once('gabarit_agent.php');
}

function displayErrorA($error){
	$contentsError='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p><strong>'. $error. '</strong></p>
	  </fieldset>  
	</form>';
	return $contentsError;
}

function displayPayementDepot(){
	$contents=displayPayement();
	$contents.=displayDepot();
	$contentsError='';
	require_once('gabarit_agent.php');
}

function displayTakeAppointment(){ 
    $contents='
    <form method="post" action="index.php" name="futurAppointment" id="futurAppointmentAppointment" onSubmit="return checkForm(this)"> 
	    <fieldset>
	        <legend>Prendre RDV</legend>
	        <p>
			    <label for="nss">NSS :</label>
			    <input type="text" name="nss" id="nss" onBlur="checkNss(this)" />
			</p> 
	        <p>
	            <label for="doctorName">Nom medecin :</label>
	            <input type="text" name="doctorName" id="doctorName" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="specialize">Specialite :</label>
	            <input type="text" name="specialize" id="specialize" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="dateFuturAppointment">Date :</label>
	            <input type="date" name="dateFuturAppointment" id="dateFuturAppointment" min="'.date('Y-m-d').'" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="hoursFuturAppointment">Heure :</label>
	            <input type="time" name="hoursFuturAppointment" id="hoursFuturAppointment" min="08:00" max="20:00" step="3600" onBlur="checkNotEmpty(this);checkHour(this)" />
	        </p>
	        <p>
	            <input type="submit" name="checkAppointment" value="Verifier disponibilite" />
	        </p>
	    </fieldset>
	</form>';
	$contentsError='';
	require_once('gabarit_agent.php');
}

// retourn affichage de la liste deroulante
function displayAllReason($listingAllReason){
	$contents='<label for="allReason">Motif :</label>
               <select name="allReason" required >
               <option value="" selected >--choix motif--</option>';
	foreach ($listingAllReason as $line ) {
		$sentence='<option value="'.$line->libelle_motif.'" >'.$line->libelle_motif.'</option>';
		$contents.=$sentence;
	}
	$contents.='</select>';
	return $contents;
}

function displayAppointmentReason($nss,$doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment,$listingAllReason){
    $contents='
    <form method="post" action="index.php" name="futurAppointment" id="futurAppointmentAppointment" onSubmit="return addAppointmentSuccess(this)"> 
	    <fieldset>
	        <legend>Prendre RDV</legend> 
	        <p>
			    <label for="nss">NSS :</label>
			    <input type="text" name="nss" id="nss" value="'.$nss.'" readonly="readonly" onBlur="checkNss(this)" />
			</p> 
	        <p>
	            <label for="doctorName">Nom medecin :</label>
	            <input type="text" name="doctorName" id="doctorName" value="'.$doctorName.'" readonly="readonly" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="specialize">Specialite :</label>
	            <input type="text" name="specialize" id="specialize" value="'.$specialize.'" readonly="readonly" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="dateFuturAppointment">Date :</label>
	            <input type="date" name="dateFuturAppointment" id="dateFuturAppointment" value="'.$dateFuturAppointment.'" readonly="readonly" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>
	            <label for="hoursFuturAppointment">Heure :</label>
	            <input type="time" name="hoursFuturAppointment" id="hoursFuturAppointment" value="'.$hoursFuturAppointment.'" readonly="readonly" onBlur="checkNotEmpty(this)" />
	        </p>
	        <p>';

	$contents.=displayAllReason($listingAllReason);

	$contents.='
			</p>        
	        <p>
	            <input type="submit" name="addAppointment" value="Valider RDV" />
	        </p>
	    </fieldset>
	</form>';
	$contentsError='';
    require_once('gabarit_agent.php');
}

function displayListingDocumentsBring($listingDocumentsBring,$priceReason){
	$contents='<form method="post" action="index.php" name="DocumentsBring" id="DocumentsBring" > 
	    <fieldset>
	        <legend>Finalisation</legend>
	        	<h5>Liste des pieces a apporter</h5> 
	        	<ul>';
	foreach($listingDocumentsBring as $line){
    	$contents.='<li>'.$line->libelle_piece.'</li>';
	}
	$contents.='</ul>
				<p> le prix de l operation est de '.$priceReason.' € </p>';
	$contents.='<p>
	            	<input type="submit" name="DocumentsBring" value="OK c est note !" />
		        </p>
		    </fieldset>
		</form>';
	$contentsError='';
	require_once('gabarit_agent.php');
}

/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // thomas
/*                             */
/*                             */
/*#############################*/

function displayBalances($customerName,$balance){
  $contents='<form method="post" action="index.php" name="balance" id="balance" > 
      <fieldset>
          <legend>Votre solde </legend> 
            <p>
              Mme/M <strong>'.$customerName.'</strong> poscede sur son compte : '.$balance.' €
            </p>
        <p>
                <input type="submit" name="balance" value="OK c est note !" />
            </p>
        </fieldset>
    </form>';
    $contentsError='';
  require_once('gabarit_agent.php');
}


/*#############################*/
/*                             */
/*                             */
/*           PAYER             */ // clemence
/*                             */
/*                             */
/*#############################*/

/* thomas modif
 	- dans des fonctions
 	- nomer les form + action="index.php"
 	- ns => nss
 	- js: dans les imput + si bien valider
*/

function displayPayement(){ 
    $contents='<form method="post" action="index.php" name="payement" id="payement" onSubmit="return addPayementSuccess(this)" >
					<fieldset>
						<legend>Payement du rendez-vous </legend>
					<p>
						<label for="nss"> Indiquer le NSS : </label>
						<input type="text" name="nss" id="nss" onBlur="checkNss(this)" />
					</p>
					<p>
						<label for="prix">Prix du rendez-vous : </label>
						<input type="text" name="prix" id="prix" onBlur="checkPrix(this)" />
					</p>
					<p>
						<input type="submit" value="Payer" name="payer"/>
					</p>
					</fieldset>
				</form>';
	return $contents;
}

// -----> pr inscription <------
// function displayVirement(){
// 	$contents='<form method="post" action="clinique.php">
// 				<fieldset>
// 				 <legend>Virement</legend>
// 				 <p>
// 				   <label for="NSS"> Indiquer le NSS : </label>
// 				   <input type="text" name="NSS" id="NSS"/>
// 				 </p>
// 				 <p>
// 				  <label for="vir">Virement sur le solde : </label>
// 				  <input type="text" name="vir" id="vir"/>
// 				 </p>
// 				 <p>
// 				  <input type="submit" value="Virement" name="virement"/>
// 				 </p>
// 				</fieldset>
// 			   </form>';
// 	return $contents;
// }

function displayDepot(){
	$contents='<form method="post" action="index.php" name="formDepot" id="formDepot" onSubmit="return addDepotSuccess(this)" >
				<fieldset>
				 <legend>Dépôt</legend>
				 <p>
					<label for="nss"> Indiquer le NSS : </label>
					<input type="text" name="nss" id="nss" onBlur="checkNss(this)" />
				 </p>
				 <p>
					<label for="depot">Argent à déposer : </label>
					<input type="text" name="depot" id="depot" onBlur="checkPrix(this)" />
				 </p>
				 <p>
					<input type="submit" value="Deposer" name="deposer"/>
				 </p>
				</fieldset>
			   </form>';
	return $contents;
}

/*#############################*/
/*                             */
/*                             */
/*      Afficher synthese      */ // tom
/*                             */
/*                             */
/*#############################*/

function displayAppointmentList($list){
   if ($list==null){
      $contents='<p>Aucun rendez-vous n\'a été programmé</p>';
   }
   else {
      $contents='<p>Liste des rendez-vous :</p>
                <form id="resultat_rdv" name="resultat_rdv">';
      $i=1;
      foreach($list as $line){
         $contents.='<fieldset>
                     <legend>Rendez-vous '.$i.'</legend>
                     <p><label>Nom du médecin: </label>
                     <input type="text" value="'.$line->nom_employe.'" disabled /></p>
                     <p><label>Date : </label>
                     <input type="text" value="'.$line->date_creneau.'" disabled /></p>
                     <p><label>Heure : </label>
                     <input type="text" value="'.$line->heure_creneau.'" disabled /></p>
                     <p><label>Prix : </label>
                     <input type="text" value="'.$line->prix_motif.'" disabled /></p>
                     <p><label>Statut : </label>
                     <input type="text" value="'.$line->statut_paiement.'" disabled /></p>
                  </fieldset>';
         $i++;
      }
      $contents.='</form>';
   }
   // $contentsError='';
   // require_once('gabarit_agent.php');
   return $contents;
}

function displayFormSynthese(){
	$contents='<form id="synthese" name="synthese" method="post" action="index.php" onSubmit="return checkFormSynthese(this);">
		         <fieldset name="synthese_fds">
		            <legend>Synthèse d\'un patient</legend>
		            <p name="pnss"><label>Numéro de sécurité sociale : </label>
		            <input type="text" maxlength="15" id="nss_synthese" name="nss_synthese" onBlur="checkNssSynthese(this)"/></p>
		            <p><input type="submit" id="synthese" name="synthese" value="Synthèse patient"/>
		            <input type="reset" value="Effacer"/></p>
		         </fieldset>
		      </form>';
	$contentsError='';
	require_once('gabarit_agent.php');
}

function displaySynthese($displayPatient,$displayList){
   $contents=$displayPatient.$displayList;
   $contentsError='';
   require_once('gabarit_agent.php');
}

// function displayInformations($patients){
//    $contents='<form id="resultat_synthese" name="resultat_synthese">';
//    foreach($patients as $line){
//       $contents.='<fieldset>
//                      <legend>Synthèse du patient</legend>
//                      <p><label>NSS : </label>
//                         <input type="text" value="'.$line->nss.'" disabled id="nss"/></p>
//                      <p><label>Nom : </label>
//                         <input type="text" value="'.$line->nom_patient.'" disabled id="nom"/></p>
//                      <p><label>Prénom : </label>
//                         <input type="text" value="'.$line->prenom_patient.'" disabled id="prenom"/></p>
//                      <p><label>Adresse : </label>
//                         <input type="text" value="'.$line->adresse_patient.'" disabled id="adresse"/></p>
//                      <p><label>Numéro de téléphone : </label>
//                         <input type="text" value="'.$line->num_tel_patient.'" disabled id="numTel"/></p>
//                      <p><label>Date de naissance : </label>
//                         <input type="text" value="'.$line->date_naissance_patient.'" disabled id="date"/></p>
//                      <p><label>Département de naissance : </label>
//                         <input type="text" value="'.$line->departement_naissance_patient.'" disabled id="dep"/></p>
//                      <p><label>Pays de naissance : </label>
//                         <input type="text" value="'.$line->pays_naissance_patient.'" disabled id="pays"/></p>
// 					 <p><label>Solde : </label>
//                         <input type="text" value="'.$line->solde_patient.'" disabled id="solde"/></p>
                     
//                      <p id="buttons"><input type="button" value="Mettre les informations à jour" onclick="activModif()"/></p>
//                   </fieldset>';
//    }
//    $contents.='</form>';
//    return $contents;
// }
//<p id="buttons"><input type="button" name="modifier" id="modifier" value="Mettre les informations à jour" onclick="activModif()"/></p>

// -----> tom modif info patient <---
/* thomas : modif readonly => disabled  ;  readonly="readonly"*/
function displayInformations($patients){
   $contents='<form id="resultat_synthese" name="resultat_synthese" method="post" action="index.php" onSubmit="return checkFormModifier(this);">';
   foreach($patients as $line){
      $contents.='<fieldset>
                     <legend>Synthèse du patient</legend>
                     <p><label>NSS : </label>
                        <input type="text" value="'.$line->nss.'" disabled id="nss" name="nss"/></p>
                     <p><label>Nom : </label>
                        <input type="text" value="'.$line->nom_patient.'" disabled id="nom" name="nom_patient" onBlur="checkTextAjouter(this)"/></p>
                     <p><label>Prénom : </label>
                        <input type="text" value="'.$line->prenom_patient.'" disabled id="prenom" name="prenom_patient" onBlur="checkTextAjouter(this)"/></p>
                     <p><label>Adresse : </label>
                        <input type="text" value="'.$line->adresse_patient.'" disabled id="adresse" name="adresse_patient" onBlur="checkTextAjouter(this)"/></p>
                     <p><label>Numéro de téléphone : </label>
                        <input type="text" value="'.$line->num_tel_patient.'" disabled id="numTel" name="num_tel_patient" onBlur="checkNumTelAjouter(this)"/></p>
                     <p><label>Date de naissance : </label>
                        <input type="text" value="'.$line->date_naissance_patient.'" disabled id="date" name="date_patient" onBlur="checkDateAjouter(this)"/></p>
                     <p><label>Département de naissance : </label>
                        <input type="text" value="'.$line->departement_naissance_patient.'" readonly id="dep" name="departement_patient" onBlur="checkDepartementAjouter(this)"/></p>
                     <p><label>Pays de naissance : </label>
                        <input type="text" value="'.$line->pays_naissance_patient.'" disabled id="pays" name="pays_patient" onBlur="checkTextAjouter(this)"/></p>
                     <p><label>Solde : </label>
                        <input type="text" value="'.$line->solde_patient.'" disabled id="solde"/></p>
                     <p id="buttons"><input type="button" value="Mettre les informations à jour" onclick="activModif()"/></p>
                  </fieldset>';
   }
   $contents.='</form>';
   return $contents;
}



/*#############################*/
/*                             */
/*                             */
/*    Recherche NSS Patient    */ // tom
/*                             */
/*                             */
/*#############################*/

function displayFormNssPatient(){
	$contents='<form id="rechercher" name="rechercher" method="post" action="index.php" onSubmit="return checkFormRechercher(this);">
		         <fieldset name="rechercher_fds">
		            <legend>Rechercher un patient</legend>
		            <p><label>Nom : </label>
		               <input type="text" id="nom_patient" name="nom_patient" onBlur="checkNomRechercher(this)"/></p>
		            <p><label>Date de naissance : </label>
		               <input type="date" id="date_patient" name="date_patient" onBlur="checkDateRechercher(this)"/></p>
		            <p><input type="submit" id="rechercher" name="rechercher" value="Rechercher patient"/>
		               <input type="reset" value="Effacer"/></p>
		         </fieldset>
		      </form>';
	$contentsError='';
	require_once('gabarit_agent.php');
}

function displayNssPatient($displayListPatients){
   $contents='<p>Patients correspondants :</p>'.$displayListPatients;
   $contentsError='';
   require_once('gabarit_agent.php');
}


/*#############################*/
/*                             */
/*                             */
/*      NOUVEAU PATIENT        */ // tom
/*                             */
/*                             */
/*#############################*/

// nouveau patient
function displayNewPatient(){
	$contents=' <form id="ajouter_patient" name="ajouter_patient" method="post" action="index.php" onSubmit="return checkFormAjouter(this);" />
      <fieldset id="fds_ajouter">
         <legend>Ajouter un patient</legend>
         <p><label>NSS : </label>
            <input type="text" maxlength="15" id="nss" name="nss" onBlur="checkNssSynthese(this)"/></p>
         <p><label>Nom : </label>
            <input type="text" id="nom_patient" name="nom_patient" onBlur="checkTextAjouter(this)"/></p>
         <p><label>Prénom : </label>
            <input type="text" id="prenom_patient" name="prenom_patient" onBlur="checkTextAjouter(this)"/></p>
         <p><label>Adresse : </label>
            <input type="text" id="adresse_patient" name="adresse_patient" onBlur="checkTextAjouter(this)"/></p>
         <p><label>Numéro Tel : </label>
            <input type="text" maxlength="10" id="num_tel_patient" name="num_tel_patient" onBlur="checkNumTelAjouter(this)"/></p>
         <p><label>Date de naissance : </label>
            <input type="date" id="date_patient" name="date_patient" onBlur="checkDateAjouter(this)"/></p>
         <p><label>Département de naissance : </label>
            <input type="text" id="departement_patient" name="departement_patient" onBlur="ajouterPays();checkDepartementAjouter(this);"/></p>
         <p id="derP_ajouter">
         <p><label>Solde : </label>
            <input type="text" name="solde" id="solde"/>
         </p>
         <input type="submit" id="ajouter_patient" name="ajouter_patient" value="Ajouter patient"/>
            <input type="reset" value="Effacer"/></p>
      </fieldset>
   </form>';
	$contentsError='';
	require_once('gabarit_agent.php');
}


