<?php

/*#############################*/
/*                             */
/*                             */
/*     CREE/MODIF LOGIN/MDP    */ // thomas
/*                             */
/*                             */
/*#############################*/

function displayConnexionDirecteur(){
	$contents=displayManagementLoginPass();
	$contents.=displayManagementEmploy();
	$contents.=displayCreateReason();
	$contentsError='';
    require_once('gabarit_directeur.php');
}

function displayErrorDirecteur($error){
	$contents=displayManagementLoginPass();
	$contents.=displayManagementEmploy();
	$contentsError=displayErrorD($error);
	require_once('gabarit_directeur.php');
}

// affiche form pr erreur
function displayErrorD($error){
	$contentsError='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p><strong>'. $error. '</strong></p>
	  </fieldset>  
	</form>';
	return $contentsError;
}

function displayManagementLoginPass(){
	$contents='<form method="post" action="index.php" name="managementLoginPass" id="managementLoginPass" onSubmit="return checkForm(this)"> 
			    <fieldset>
			        <legend>Gestion login & mdp</legend>
			        <p>
			            <input type="submit" name="creatLogPass" id="creatLogPass" value="Cree login/mdp" />
			        </p> 
			        <p>
			            <input type="submit" name="updatetLogPass" id="updateLogPass" value="Modifier login/mdp" />
			        </p> 
			    </fieldset>
			</form>';
	return $contents;
}

// retourn affichage de la liste deroulante
function displayAllEmployeWithoutLogin($listingAllEmployeWithoutLogin){
  $contents='<label for="allEmployeWithoutLogin">Employe :</label>
               <select name="allEmployeWithoutLogin" required >
               <option value="" selected >--choix emplye nom--</option>';
  foreach ($listingAllEmployeWithoutLogin as $line ) {
    // cree var NOM prenom 
    $emplo='<strong>'.strtoupper($line->nom_employe).' </strong>'.$line->prenom_employe;
    $sentence='<option value="'.$line->id_employe.'" >'.$emplo.'</option>';
    $contents.=$sentence;
  }
  $contents.='</select>';
  return $contents;
}

function displayCreatLoginPassword($listingAllEmployeWithoutLogin){
	$contents='<form method="post" action="index.php" name="CreatLoginPassword" id="CreatLoginPassword" onSubmit="return checkForm(this)"> 
			    <fieldset>
			        <legend>Cree login & mdp</legend>
			        <p>';
// afficher liste deroulante			        
	$contents.=displayAllEmployeWithoutLogin($listingAllEmployeWithoutLogin);
	$contents.='</p>
			        <p>
			            <label for="creatLogin">Login : </label>
			            <input type="text" name="creatLogin" id="creatLogin" onBlur="checkNotEmpty(this)" />
			        </p>
			        <p>
			            <label for="creatPassword">Password : </label>
			            <input type="text" name="creatPassword" id="creatPassword" onBlur="checkNotEmpty(this)" />
			        </p>
			        <p>
			            <label for="confirmPassword">Confirme password : </label>
			            <input type="text" name="confirmPassword" id="confirmPassword" onBlur="checkNotEmpty(this)" />
			        </p>   
			        <p>
			            <input type="submit" name="CreatLoginPassword" id="CreatLoginPassword" value="Cree" />
			        </p> 
			    </fieldset>
			</form>';
	$contentsError='';
    require_once('gabarit_directeur.php');
}

// ------> function display pas fini <-------
// function displayAddLoginPassword(){
// 	$contents='<form method="post" action="index.php" name="AddLoginPassword" id="v" > 
//       <fieldset>
//           <legend>Corfimation  </legend> 
//             <p>
//               Mme/M <strong>'.$customerName.'</strong> poscede sur son compte : '.$balance.' €
//             </p>
//         <p>
//                 <input type="submit" name="balance" value="OK c est note !" />
//             </p>
//         </fieldset>
//     </form>';
//     $contentsError='';
//   require_once('gabarit_agent.php');
// }

function displayAllEmploye($listingAllEmploye){
  $contents='<label for="allEmploye">Employe :</label>
               <select name="allEmploye" required >
               <option value="" selected >--choix emplye nom--</option>';
  foreach ($listingAllEmploye as $line ) {
    // cree var NOM prenom 
    $emplo='<strong>'.strtoupper($line->nom_employe).' </strong>'.$line->prenom_employe;
    $sentence='<option value="'.$line->id_employe.'" >'.$emplo.'</option>';
    $contents.=$sentence;
  }
  $contents.='</select>';
  return $contents;
}

function displayUpdateLoginPassword($listingAllEmploye){
	$contents='<form method="post" action="index.php" name="updateLoginPassword" id="updateLoginPassword" onSubmit="return checkForm(this)"> 
			    <fieldset>
			        <legend>Cree login & mdp</legend>
			        <p>';
// afficher liste deroulante			        
	$contents.=displayAllEmploye($listingAllEmploye);
	$contents.='</p>  
			        <p>
			            <input type="submit" name="updateLoginPassword" id="updateLoginPassword" value="Modifier" />
			        </p> 
			    </fieldset>
			</form>';
	$contentsError='';
    require_once('gabarit_directeur.php');
}

// ne devrai pas aficher l id employer
function displayEmploye($employe){
  $id=$employe['id_employe'];
  $nom=$employe['nom_employe'];
  $prenom=$employe['prenom_employe'];
  $login=$employe['login'];
  //$mdp=$employe['mdp'];
  $contents='<form method="post" action="index.php" name="UpdateLoginPassword" id="UpdateLoginPassword" onSubmit="return checkFormUpdate(this)"> 
          <fieldset>
              <legend>Info employe</legend>
              <p>
                  <label for="id_employe">Id employe : </label>
                  <input type="text" name="id_employe" id="id_employe" onBlur="checkNotEmpty(this)" value="'.$id.'" readonly="readonly" />
              </p>
              <p>
                  <label for="nom_employe">Nom : </label>
                  <input type="text" name="nom_employe" id="nom_employe" onBlur="checkNotEmpty(this)" value="'.$nom.'"/>
              </p>
              <p>
                  <label for="prenom_employe">Prenom : </label>
                  <input type="text" name="prenom_employe" id="prenom_employe" onBlur="checkNotEmpty(this)" value="'.$prenom.'"/>
              </p>
              <p>
                  <label for="login">Login : </label>
                  <input type="text" name="login" id="login" onBlur="checkNotEmpty(this)" value="'.$login.'"/>
              </p>
              <p>
                  <label for="mdp">Mot de pass : </label>
                  <input type="text" name="mdp" id="mdp" onBlur="checkNotEmpty(this)" value=""/>
              </p>  
              <p>
                  <input type="submit" name="UpdateLoginPassword" id="UpdateLoginPassword" value="Valider modification" />
              </p> 
          </fieldset>
      </form>';
  $contentsError='';
    require_once('views/gabarit_directeur.php');
}


/*#############################*/
/*                             */
/*                             */
/*       CREE/SUP EMPLOYE      */ // thomas
/*                             */
/*                             */
/*#############################*/

function displayManagementEmploy(){
	$contents='<form method="post" action="index.php" name="managementEmploy" id="managementEmploy" onSubmit="return checkForm(this)"> 
			    <fieldset>
			        <legend>Gestion employe</legend>
			        <p>
			            <input type="submit" name="creatEmploy" id="creatEmploy" value="Cree employer" />
			        </p> 
			        <p>
			            <input type="submit" name="deleteEmploy" id="deleteEmploy" value="Supprimer employer" />
			        </p> 
			    </fieldset>
			</form>';
	return $contents;
}

/*#############################*/
/*                             */
/*                             */
/*       CREE/SUP EMPLOYE      */ // clemence
/*                             */
/*                             */
/*#############################*/

function displayCreateEmploy(){
	$contents='<form method="post" action="index.php" name="monForm1" onSubmit="return verif(this)">
	<fieldset>
	<legend> Gestion du personnel </legend>
	<p>
		Création d\'un employé :
	</p>
	<p>
	<label for="nom"> Nom : </label>
	<input type="text" name="nom" id="nom"/>
	</p>
	<p>
	<label for="prenom"> Prénom : </label>
	<input type="text" name="prenom" id="prenom"/>
	</p>
	<p>
		<label name="categoryEmploye" id="categoryEmploye">
		<select name="categoryEmploye">
			<option value="" selected>--Choix de la catégorie--</option>
			<option value="categoryAgent">Agent</option>
			<option value="categoryMedecin" name="categoryMedecin">Medecin</option>
		</select>
		</label>
	</p>
	<p>
	<label for="spe"> Specialite : </label>
	<input type="text" name="spe" id="spe"/>
	</p>
	<p>
	<p>
		<input type="submit" value="Creer" name="creer"/>
	</p>
	</form>';
	$contentsError='';
    require_once('views/gabarit_directeur.php');
}

function displayDeleteEmploy(){
	$contents='<form method="post" action="index.php" name="monForm1" onSubmit="return verif(this)">
	<fieldset>
		<legend>Supprission d\'un employé :</legend>
	<p>
	<label for="nom"> Nom : </label>
	<input type="text" name="nom" id="nom"/>
	</p>
	<p>
	<label for="prenom"> Prénom : </label>
	<input type="text" name="prenom" id="prenom"/>
	</p>
	<p>
		<input type="submit" value="Supprimer" name="supprimer"/>
	</p>
	</fieldset>
	</form>';
	$contentsError='';
    require_once('views/gabarit_directeur.php');
}

// ---> pas vraiment cree ; fonctionelle UNIQUEMENT pour le senario	<---
function displayCreateReason(){
	$contents='<form action="index.php" method="POST" name="formCreerMotif" id="formCreerMotif">
            <fieldset>
               <legend>Créer un motif</legend>
               <p><label>Libellé du motif : </label>
                  <input type="text" name="libelle_motif" id="libelle_motif" /></p>
               <p><label>Prix du motif : </label>
                  <input type="number" name="prix_motif" id="prix_motif" /></p>
               <p><label>Libellé de la pièce : </label>
                  <input type="text" name="piece_motif" id="piece_motif" /></p>
               <p><input type="submit" name="creer_motif" value="Créer un motif">
                <input type="reset" value="Effacer"></p>
            </fieldset>
        </form>';
    return $contents;
}


        