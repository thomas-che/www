DROP DATABASE IF EXISTS clinique ;

CREATE DATABASE IF NOT EXISTS clinique 
-- thomas ajout de set encodage
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE clinique ;

-- thomas nom tab en minuscule
# -----------------------------------------------------------------------------
#       TABLE : directeur
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS directeur
 (
   id_employe INT(4) NOT NULL   
   , PRIMARY KEY (id_employe) 
 );

# -----------------------------------------------------------------------------
#       TABLE : medecin
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS medecin
 (
   id_employe INT(4) NOT NULL  ,
   id_specialite INT(4) NOT NULL  
   , PRIMARY KEY (id_employe) 
 );

# -----------------------------------------------------------------------------
#       TABLE : piece
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS piece
 (
   id_piece INT(4) NOT NULL AUTO_INCREMENT ,
   libelle_piece VARCHAR(64) NOT NULL  
   , PRIMARY KEY (id_piece) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : motif
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS motif
 (
   id_motif INT(4) NOT NULL AUTO_INCREMENT ,
   libelle_motif VARCHAR(64) NOT NULL  ,
   prix_motif INT(6) NOT NULL  ,
   consignes VARCHAR(256) NOT NULL  
   , PRIMARY KEY (id_motif) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : patient
# -----------------------------------------------------------------------------

-- thomas pay naissance peut etre nul
-- thomas add adresse_patient 

CREATE TABLE IF NOT EXISTS patient
 (
   nss VARCHAR(15) NOT NULL  ,
   nom_patient VARCHAR(32) NOT NULL  ,
   prenom_patient VARCHAR(32) NOT NULL  ,
   num_tel_patient VARCHAR(10) NOT NULL  ,
   date_naissance_patient DATE NOT NULL  ,
   departement_naissance_patient VARCHAR(3) NOT NULL  ,
   adresse_patient VARCHAR(64) NOT NULL  ,
   pays_naissance_patient VARCHAR(32)  ,
   solde_patient INT(6) NOT NULL  
   , PRIMARY KEY (nss) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : creneau
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS creneau
 (
   date_creneau DATE NOT NULL  ,
   heure_creneau TIME NOT NULL  
   , PRIMARY KEY (date_creneau,heure_creneau) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : specialite
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS specialite
 (
   id_specialite INT(4) NOT NULL AUTO_INCREMENT ,
   libelle_specialite VARCHAR(64) NOT NULL  
   , PRIMARY KEY (id_specialite) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : agent
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS agent
 (
   id_employe INT(4) NOT NULL  
   , PRIMARY KEY (id_employe) 
 );
 

# -----------------------------------------------------------------------------
#       TABLE : employe
# -----------------------------------------------------------------------------

--thomas modif logueur mdp (32->256) pr mdp hash 
--thomas +login unique

CREATE TABLE IF NOT EXISTS employe
 (
   id_employe INT(4) NOT NULL AUTO_INCREMENT ,
   login VARCHAR(32) NULL UNIQUE ,
   mdp VARCHAR(256) NULL  ,
   nom_employe VARCHAR(32) NOT NULL  ,
   prenom_employe VARCHAR(32) NOT NULL  
   , PRIMARY KEY (id_employe)
 ) ;
 

# -----------------------------------------------------------------------------
#       TABLE : bloquer
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS bloquer
 (
   date_creneau DATE NOT NULL  ,
   heure_creneau TIME NOT NULL  ,
   id_employe INT(4) NOT NULL  
   , PRIMARY KEY (date_creneau,heure_creneau,id_employe) 
 ) ;
 

# -----------------------------------------------------------------------------
#       TABLE : rdv
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS rdv
 (
   nss VARCHAR(15) NOT NULL  ,
   id_motif INT(4) NOT NULL  ,
   id_employe INT(4) NOT NULL  ,
   date_creneau DATE NOT NULL  ,
   heure_creneau TIME NOT NULL  ,
   statut_paiement VARCHAR(32) NOT NULL  
   , PRIMARY KEY (nss,id_motif,id_employe,date_creneau,heure_creneau) 
 ) ;
 

# -----------------------------------------------------------------------------
#       TABLE : apporter
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS apporter
 (
   id_motif INT(4) NOT NULL  ,
   id_piece INT(4) NOT NULL  
   , PRIMARY KEY (id_motif,id_piece) 
 ) ;
 


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE directeur 
  ADD FOREIGN KEY FK_Directeur_Employe (id_employe)
      REFERENCES employe (id_employe) ;


ALTER TABLE medecin 
  ADD FOREIGN KEY FK_Medecin_Specialite (id_specialite)
      REFERENCES epecialite (id_specialite) ;


ALTER TABLE medecin 
  ADD FOREIGN KEY FK_Medecin_Employe (id_employe)
      REFERENCES employe (id_employe) ;


ALTER TABLE agent 
  ADD FOREIGN KEY FK_Agent_Employe (id_employe)
      REFERENCES employe (id_employe) ;


ALTER TABLE bloquer 
  ADD FOREIGN KEY FK_Bloquer_Creneau (date_creneau,heure_creneau)
      REFERENCES creneau (date_creneau,heure_creneau) ;


ALTER TABLE bloquer 
  ADD FOREIGN KEY FK_Bloquer_Medecin (id_employe)
      REFERENCES medecin (id_employe) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY FK_RDV_Patient (nss)
      REFERENCES patient (nss) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY FK_RDV_Motif (id_motif)
      REFERENCES motif (id_motif) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY FK_RDV_Medecin (id_employe)
      REFERENCES medecin (id_employe) ;


ALTER TABLE rdv 
  ADD FOREIGN KEY FK_RDV_Creneau (date_creneau,heure_creneau)
      REFERENCES creneau (date_creneau,heure_creneau) ;


ALTER TABLE apporter 
  ADD FOREIGN KEY FK_Apporter_Motif (id_motif)
      REFERENCES motif (id_motif) ;


ALTER TABLE apporter 
  ADD FOREIGN KEY FK_Apporter_Piece (id_piece)
      REFERENCES piece (id_piece) ;

