<?php

require_once('connect.php');

/*#############################*/
/*                             */
/*                             */
/*   Bloquer Creneau Medecin   */ // tom
/*                             */
/*                             */
/*#############################*/

function addBlockSlots($id,$d,$h){
   $connexion=getConnect();
   $requete="INSERT INTO bloquer
            VALUES (:d,:h,:id)";
   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':h', $h, PDO::PARAM_STR);
   $prepare->bindValue(':d', $d, PDO::PARAM_STR);
   $prepare->bindValue(':id', $id, PDO::PARAM_INT);
   $prepare->execute();
   $prepare->closeCursor();
}

function getAppointmentListFromDate($id,$d,$h){
   $connexion=getConnect();
   $requete="SELECT * FROM rdv
            WHERE id_employe=:id
            AND date_creneau=:d
            AND heure_creneau=:h";
   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':h', $h, PDO::PARAM_STR);
   $prepare->bindValue(':d', $d, PDO::PARAM_STR);
   $prepare->bindValue(':id', $id, PDO::PARAM_INT);
   $prepare->execute();
   $list=$prepare->fetchall();
   $prepare->closeCursor();
   return $list;
}

function getAppointmentBlockList($id,$d,$h){
   $connexion=getConnect();
   $requete="SELECT * FROM bloquer
            WHERE id_employe=:id
            AND date_creneau=:d
            AND heure_creneau=:h";
   $prepare=$connexion->prepare($requete);
   $prepare->bindValue(':h', $h, PDO::PARAM_STR);
   $prepare->bindValue(':d', $d, PDO::PARAM_STR);
   $prepare->bindValue(':id', $id, PDO::PARAM_INT);
   $prepare->execute();
   $list=$prepare->fetchall();
   $prepare->closeCursor();
   return $list;
}