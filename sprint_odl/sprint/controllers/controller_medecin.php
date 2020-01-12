<?php

require_once('models/model_medecin.php');
require_once('views/view_medecin.php');

function ctlConnexionMedecin(){
	displayConnexionMedecin();
}

require_once('models/model.php');
require_once('models/model_agent.php');

/*#############################*/
/*                             */
/*                             */
/*   Bloquer Creneau Medecin   */ // tom
/*                             */
/*                             */
/*#############################*/

function ctlBlockSlots($login,$nb,$dates,$hours){
   if (empty($dates) || empty($hours)||empty($login)||empty($nb)) throw new Exception ('Les dates ou les heures sont vides');
   if ($nb<=0) throw new Exception ('Vous ne pouvez pas bloquer moins de 1 créneau');
   if (count($dates)<>count($hours)) throw new Exception ('Il n\'y a pas le même nombre de dates et d\'heures');
   $id=ctlGetIdEmploye($login);
   for($i=0;$i<$nb;$i++){
      $d=$dates[$i];
      $h=$hours[$i];
      if (empty($d)||empty($h)) throw new Exception ('Une des dates ou des heures est vide');
      
      $slot=getSlot($d,$h);
      if ($slot==null){
         addSlot($d,$h);
      }
      $appointmentList=getAppointmentListFromDate($id,$d,$h);
      $blockList=getAppointmentBlockList($id,$d,$h);
      if ($appointmentList==null && $blockList==null){
         addBlockSlots($id,$d,$h);
      }
      else {
         throw new Exception ('Ce créneau n\'est pas disponible');
      }
      //rajouter test format ?
      //rajouter test validité dates et heures ?
   }
   displayConnexionMedecin();
}
   
function ctlGetIdEmploye($login){
   $id=getIdEmploye($login);
   if ($id==null) throw new Exception ('Le login ne correspond pas à un employé');
   return $id;
}

