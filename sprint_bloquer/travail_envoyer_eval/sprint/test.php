<?php

// page de test si les fonctions fonctionnent correctement


define("SERVEUR", "localhost");
define("USER", "tp"); // le nom de lutilisateur de la bd
define("PASSWORD", "tp"); // le mdp sur phpmyadmin
define("BDD", "clinique"); // nom de la bd


function getConnect() {
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}
?>

<!-- afficher les erreur -->
<?php

function displayError($error){
  $contents='<form id="displayError"  action="" method="post">
    <fieldset>
      <legend> Erreurs détectées </legend>
        <p>'. $error. '</p>
        <p><a href="index.php"/> Revenir sur la page de connection </a></p>
    </fieldset>  
  </form>';
  require_once('views/gabarit.php');
}
function ctlError($error){
  displayError($error);
}
?>

<!-- choix de la page apres la connexion -->
<?php
function getIdEmploye($login) {
	$connexion=getConnect();
	$prepare=$connexion->prepare("SELECT id_employe FROM employe WHERE login=:login");
	$prepare->bindValue(':login', $login, PDO::PARAM_STR);
	$prepare->execute();
	$idEmploye=$prepare->fetch();
	return $idEmploye['id_employe'];
}

$log='A11';
$res=getIdEmploye($log);

//echo $res;

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
// $directeur=getCategoryDirecteur($idEmploye,'directeur');
// $idEmploye=intval($res);
// $agent=getCategoryAgent($idEmploye,'agent');

// if (empty($directeur) && empty($agent)){
//    echo 'Medecin';
// }
// else if (empty($directeur)){
//    echo 'agent';
// }
// else {
//    echo 'directeur';
// }
?>

<!-- script js pr les forms -->
<script type="text/javascript">
  function highlights(path,error){
    if(error){
        path.style.backgroundColor = "" ;
        return true ;
    }else{
        path.style.backgroundColor = "#fba" ;
        return false;
    }
  }
  function checkNotEmpty(path){
      if(path.value.length > 0){
           return highlights(path,true);
      }else{
          return highlights(path,false);
      }
  }
  function checkForm(form){
      if(checkNotEmpty(form.login)&&checkNotEmpty(form.mdp)){
          return true ;
      }else{
          alert('Toutes les conditions ne sont pas remplies');
          return false ;
      }
  }
</script>


<!-- les motifs -->
<?php
function getAllReason() {
  $connexion=getConnect();
    $answer=$connexion->query("SELECT libelle_motif FROM motif ");
    $answer->setFetchMode(PDO::FETCH_OBJ);
  $listingAllReason=$answer->fetchall();
  $answer->closeCursor();
    return $listingAllReason;
}
function displayAllReason($listingAllReason){
  $contents='<label for="allReason">Motif :</label>
               <select name="allReason">';
  foreach ($listingAllReason as $line ) {
    $sentence='<option value="'.$line->libelle_motif.'" >'.$line->libelle_motif.'</option>';
    $contents.=$sentence;
  }
  $contents.='</select>';
  require_once('views/gabarit_agent.php');

}
function ctlDisplayAllReason(){
  $listingAllReason=getAllReason();
  if (!empty($listingAllReason[0])){
    displayAllReason($listingAllReason);
  }
  else{
    throw new Exception("Aucun motif dans la bdd");
  }
}

try{
  //ctlDisplayAllReason();
}
catch(Exception $e) {
    $msg=$e->getMessage(); // recupere le msg de l Exception
    CtlError($msg);  // le msg sera afficher
}
?>

<!-- test doctor bonne spe -->
<?php

function getIdDoctor($doctorName){
  $connexion=getConnect();
  $prepare=$connexion->prepare("SELECT id_employe FROM employe WHERE nom_employe=:nom_employe");
  $prepare->bindValue(':nom_employe', $doctorName, PDO::PARAM_STR);
  $prepare->execute();
  $idDoctor=$prepare->fetch();
  $prepare->closeCursor();
  return $idDoctor['id_employe'];
}
// $dn='M11';
// $idD=getIdDoctor($dn);
// echo '<p>id doc : >>'.$idD.'<< </p>';

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

// $s=getSepcializeDoctor($idD);
// echo '<p>spe : >>'.$s.'<<</p>';

// function ctlDoctorSpecialize($doctorName,$specialize){
//   $idDoctor=getIdDoctor($doctorName);
//   if (!empty($idDoctor)){
//     $specializeDoctor=getSepcializeDoctor($idDoctor);
//     if ($specializeDoctor==$specialize){
//       echo '<p>bonne spe</p>';
//     }
//     else{
//       throw new Exception("Specialiter n est pas celle du medecin entrer");
//     }
//   }
//   else{
//     throw new Exception("Nom du medecin inconu");
    
//   }
// }

// $sp='radiologue';
// ctlDoctorSpecialize($dn,$sp);

?>

<!-- test creneau libre -->
<?php

function getSlot($dateFuturAppointment,$hoursFuturAppointment){
  $connexion=getConnect();
  $prepare=$connexion->prepare("SELECT date_creneau,heure_creneau FROM creneau WHERE date_creneau=:date_creneau AND heure_creneau=:heure_creneau");
  $prepare->bindValue(':date_creneau', $dateFuturAppointment, PDO::PARAM_STR);
  $prepare->bindValue(':heure_creneau', $hoursFuturAppointment, PDO::PARAM_STR);
  $prepare->execute();
  $creneau=$prepare->fetch();
  $prepare->closeCursor();
  return $creneau;
}

function ctlAppointment($doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment){
  $idDoctor=getIdDoctor($doctorName);
  if (!empty($idDoctor)){
    $specializeDoctor=getSepcializeDoctor($idDoctor);
    if ($specializeDoctor==$specialize){
    echo '<p>bonne spe</p>';
    $slot=getSlot($dateFuturAppointment,$hoursFuturAppointment);
    
    echo var_dump($slot);

    if (empty($slot)){
      echo '<p>creneau libre</p>';
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

$dn='M11';
$sp='radiologue';
$dRdv='2019-12-21';
$hRdv='08:00:00'; // 7h pris

//ctlAppointment($dn,$sp,$dRdv,$hRdv);

?>

<?php
function displayAppointmentReason($doctorName,$specialize,$dateFuturAppointment,$hoursFuturAppointment){
    $contents='
    <form method="post" action="index.php" name="futurAppointment" id="futurAppointmentAppointment" onSubmit="return checkForm(this)"> 
      <fieldset>
          <legend>Prendre RDV</legend> 
          <p>
              <label for="doctorName">Nom medecin :</label>
              <input type="text" name="doctorName" id="doctorName" value="'.$doctorName.'" onBlur="checkNotEmpty(this)" />
          </p>
          <p>
              <label for="specialize">Specialite :</label>
              <input type="text" name="specialize" id="specialize" value="'.$specialize.'" onBlur="checkNotEmpty(this)" />
          </p>
          <p>
              <label for="dateFuturAppointment">Date :</label>
              <input type="date" name="dateFuturAppointment" id="dateFuturAppointment" value="'.$dateFuturAppointment.'" onBlur="checkNotEmpty(this)" />
          </p>
          <p>
              <label for="hoursFuturAppointment">Heure :</label>
              <input type="time" name="hoursFuturAppointment" id="hoursFuturAppointment" value="'.$hoursFuturAppointment.'" onBlur="checkNotEmpty(this)" />
          </p>
          <p>
              <input type="submit" name="checkAppointment" value="Verifier disponibilite" />
          </p>
      </fieldset>
  </form>';
    require_once('views/gabarit_agent.php');
}

// displayAppointmentReason($dn,$sp,$dRdv,$hRdv);
?>

<script type="text/javascript">
  function checkNss(path){
    if(14<path.value.length &&  path.value.length<16){
         return highlights(path,true);
    }else{
        return highlights(path,false);
    }
}
</script>

<!-- <p>
    <label for="nss">NSS :</label>
    <input type="text" name="nss" id="nss" onBlur="checkNss(this)" />
</p> -->

<!-- ajout rdv -->
<?php
function addSlot($dateFuturAppointment,$hoursFuturAppointment){
  $connexion=getConnect();
  $answer=$connexion->query("INSERT INTO creneau VALUES ($dateFuturAppointment,$hoursFuturAppointment) ");
  $answer->closeCursor();
}
// $d='';
// $h='';
// addSlot($d,$h);
// echo '<p>fini</p>';

function addAppointment($nss,$idReason,$idDoctor,$dateFuturAppointment,$hoursFuturAppointment){
  $connexion=getConnect();
  $prepare=$connexion->prepare("INSERT INTO rdv VALUES (nss=:nss, id_motif=:id_motif, id_employe=:id_employe, '$dateFuturAppointment', '$hoursFuturAppointment', statut_paiement=:statut_paiement) " );
  $prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
  $prepare->bindValue(':id_motif', $idReason, PDO::PARAM_INT);
  $prepare->bindValue(':id_employe', $idDoctor, PDO::PARAM_INT);
  $prepare->bindValue(':statut_paiement', 'en attente de payement', PDO::PARAM_STR);
  $prepare->execute();
  $prepare->closeCursor();
}

//'269054958815780', '1', '3', '2019-12-10', '08:00:00', 'en attente de payement'

$n='269054958815780';
$idR='1';
$idD='3';
$d='2019-12-10';
$h='08:00:00';

//addAppointment($n,$idR,$idD,$d,$h);

?>

<!-- afficher liste doc a apporter -->
<?php
function getDocumentsBring($idReason){
  $connexion=getConnect();
    $prepare=$connexion->prepare("SELECT libelle_piece FROM piece NATURAL JOIN  (SELECT id_piece FROM apporter WHERE id_motif=:id_motif )T ");
    $prepare->bindValue(':id_motif', $idReason, PDO::PARAM_INT);
  $prepare->execute();
    $prepare->setFetchMode(PDO::FETCH_OBJ);
  $listingAllDocumentsBring=$prepare->fetchall();
  $prepare->closeCursor();
    return $listingAllDocumentsBring;
}

$idR=1;
$resss=getDocumentsBring($idR);
// echo var_dump($res);

foreach($resss as $line){
   // echo '<p> '.$line->libelle_piece.'</p>';
}
?>

<!-- afficher solde client -->
<?php
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
  require_once('views/gabarit_agent.php');
}

function getBalances($nss){
  $connexion=getConnect();
  $prepare=$connexion->prepare("SELECT nom_patient,solde_patient FROM patient WHERE nss=:nss");
  $prepare->bindValue(':nss', $nss, PDO::PARAM_STR);
  $prepare->execute();
  $answer=$prepare->fetch();
  $prepare->closeCursor();
  return $answer;
}

function cltDisplayBalances($nss){
  $answer=getBalances($nss);

  echo var_dump($answer);

  $customerName=strtoupper($answer['nom_patient']);
  $balances=$answer['solde_patient'];
  displayBalances($customerName,$balances);
}

$n=269054958815780;
//cltDisplayBalances($n);

?>
<!-- 
<label name="categoryEmplye" id="categoryEmplye">
<select name="categoryEmplye">
    <option value="" selected >--choix Categorie employe--</option>
    <option value="categoryEmployeAgent" >agent</option>
    <option value="categoryEmployeMedecin" >medecin</option>
</select>
</label>


          <p>
              <label for="doctorName">Nom medecin :</label>
              <input type="text" name="doctorName" id="doctorName" value="'.$doctorName.'" onBlur="checkNotEmpty(this)" />
          </p>



<form method="post" action="index.php" name="CreatLoginPassword" id="CreatLoginPassword" onSubmit="return checkForm(this)"> 
    <fieldset>
        <legend>Cree login & mdp</legend>
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
</form> -->


<?php

function getAllEmployeWithoutLogin() {
  $connexion=getConnect();
    $answer=$connexion->query("SELECT id_employe,nom_employe,prenom_employe FROM employe WHERE login IS NULL and mdp IS NULL;");
    $answer->setFetchMode(PDO::FETCH_OBJ);
  $listingAllEmployeWithoutLogin=$answer->fetchall();
  $answer->closeCursor();
    return $listingAllEmployeWithoutLogin;
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

$em=getAllEmployeWithoutLogin();
$affichage_liste_deroulate=displayAllEmployeWithoutLogin($em);

echo $affichage_liste_deroulate;

?>


<?php

function getEmployeById($id_employe) {
   $connexion=getConnect();
   $prepare=$connexion->prepare("SELECT id_employe,nom_employe,prenom_employe,login,mdp FROM employe WHERE id_employe=:id_employe");
   $prepare->bindValue(':id_employe', $id_employe, PDO::PARAM_INT);
   $prepare->execute();
   $EmployeById=$prepare->fetch();
   $prepare->closeCursor();
   return $EmployeById;
}

function displayEmploye($employe){
  $nom=$employe['nom_employe'];
  $prenom=$employe['prenom_employe'];
  $login=$employe['login'];
  //$mdp=$employe['mdp'];
  $contents='<form method="post" action="index.php" name="UpdateLoginPassword" id="UpdateLoginPassword" onSubmit="return checkForm(this)"> 
          <fieldset>
              <legend>Info employe</legend>
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

$ide=3;
$e=getEmployeById($ide);
echo var_dump($e);
displayEmploye($e);

?>



<!-- clemence clinique.php -->
<?php
require_once('C:/wamp1/www/projet/controleur/controleur.php');

try {
   // ctlPageCompte();
   // ctlPaiement();
  ctlPageDirecteur();
  if(isset($_POST['creer'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $specialite=$_POST['spe'];
    if($_POST['spe']==null){
      ctlAddEmploye($nom,$prenom);
      ctlAddAgent($nom,$prenom);
    }else{
      ctlAddEmploye($nom,$prenom);
      ctlAddMedecin($nom,$prenom,$specialite);
    }
  }
  if(isset($_POST['supprimer'])){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    ctlDeleteEmploye($nom,$prenom);
  }

  if(isset($_POST['virement'])){
    $nss=$_POST['NSS'];
    $new_montant=$_POST['vir'];
    ctlMakeVirement($new_montant,$nss);
  }
  if(isset($_POST['deposer'])){
    $patient=$_POST['nss'];
    $depot=$_POST['dep'];
    ctlMakeDepot($depot,$patient);
  }
  if(isset($_POST['payer'])){
    $nss=$_POST['ns'];
    $new_montant=$_POST['prix'];
    ctlMakePaiement($new_montant,$nss);
  }
  
}catch(PDOException $e){
    $msg = $e->getMessage();
    ctlErreur($msg);
}
?>