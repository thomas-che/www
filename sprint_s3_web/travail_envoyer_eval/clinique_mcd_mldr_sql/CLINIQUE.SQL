-- -----------------------------------------------------------------------------
--             Génération d'une base de données pour
--                      Oracle Version 10g
--                        (14/12/2019 0:06:39)
-- -----------------------------------------------------------------------------
--      Nom de la base : clinique
--      Projet : Espace de travail
--      Auteur : Tom Petragallo
--      Date de dernière modification : 14/12/2019 0:05:54
-- -----------------------------------------------------------------------------

DROP TABLE Directeur CASCADE CONSTRAINTS;

DROP TABLE Medecin CASCADE CONSTRAINTS;

DROP TABLE Piece CASCADE CONSTRAINTS;

DROP TABLE Motif CASCADE CONSTRAINTS;

DROP TABLE Patient CASCADE CONSTRAINTS;

DROP TABLE Creneau CASCADE CONSTRAINTS;

DROP TABLE Specialite CASCADE CONSTRAINTS;

DROP TABLE Agent CASCADE CONSTRAINTS;

DROP TABLE Employe CASCADE CONSTRAINTS;

DROP TABLE Bloquer CASCADE CONSTRAINTS;

DROP TABLE RDV CASCADE CONSTRAINTS;

DROP TABLE Apporter CASCADE CONSTRAINTS;

-- -----------------------------------------------------------------------------
--       CREATION DE LA BASE 
-- -----------------------------------------------------------------------------

CREATE DATABASE clinique;

-- -----------------------------------------------------------------------------
--       TABLE : Directeur
-- -----------------------------------------------------------------------------

CREATE TABLE Directeur
   (
    id_employe INT(4)  NOT NULL
,   CONSTRAINT PK_Directeur PRIMARY KEY (id_employe)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Medecin
-- -----------------------------------------------------------------------------

CREATE TABLE Medecin
   (
    id_employe INT(4)  NOT NULL,
    id_specialite INT(4)  NOT NULL
,   CONSTRAINT PK_Medecin PRIMARY KEY (id_employe)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Piece
-- -----------------------------------------------------------------------------

CREATE TABLE Piece
   (
    id_piece INT(4)  NOT NULL,
    libelle_piece VARCHAR2(64)  NULL
,   CONSTRAINT PK_Piece PRIMARY KEY (id_piece)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Motif
-- -----------------------------------------------------------------------------

CREATE TABLE Motif
   (
    id_motif INT(4)  NOT NULL,
    libelle_motif VARCHAR2(64)  NULL,
    prix_motif INT(6)  NULL,
    consignes VARCHAR2(256)  NULL
,   CONSTRAINT PK_Motif PRIMARY KEY (id_motif)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Patient
-- -----------------------------------------------------------------------------

CREATE TABLE Patient
   (
    nss VARCHAR2(15)  NOT NULL,
    nom_patient VARCHAR2(32)  NULL,
    prenom_patient VARCHAR2(32)  NULL,
    num_tel_patient VARCHAR2(10)  NULL,
    date_naissance_patient DATE  NULL,
    departement_naissance_patient VARCHAR2(3)  NULL,
    pays_naissance_patient VARCHAR2(32)  NULL,
    solde_patient INT(6)  NULL
,   CONSTRAINT PK_Patient PRIMARY KEY (nss)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Creneau
-- -----------------------------------------------------------------------------

CREATE TABLE Creneau
   (
    date_creneau DATE  NOT NULL,
    heure_creneau DATE  NOT NULL
,   CONSTRAINT PK_Creneau PRIMARY KEY (date_creneau, heure_creneau)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Specialite
-- -----------------------------------------------------------------------------

CREATE TABLE Specialite
   (
    id_specialite INT(4)  NOT NULL,
    libelle_specialite VARCHAR2(64)  NULL
,   CONSTRAINT PK_Specialite PRIMARY KEY (id_specialite)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Agent
-- -----------------------------------------------------------------------------

CREATE TABLE Agent
   (
    id_employe INT(4)  NOT NULL
,   CONSTRAINT PK_Agent PRIMARY KEY (id_employe)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Employe
-- -----------------------------------------------------------------------------

CREATE TABLE Employe
   (
    id_employe INT(4)  NOT NULL,
    login VARCHAR2(32)  NULL,
    mdp VARCHAR2(32)  NULL,
    nom_employe VARCHAR2(32)  NULL,
    prenom_employe VARCHAR2(32)  NULL
,   CONSTRAINT PK_Employe PRIMARY KEY (id_employe)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Bloquer
-- -----------------------------------------------------------------------------

CREATE TABLE Bloquer
   (
    date_creneau DATE  NOT NULL,
    heure_creneau DATE  NOT NULL,
    id_employe INT(4)  NOT NULL
,   CONSTRAINT PK_Bloquer PRIMARY KEY (date_creneau, heure_creneau, id_employe)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : RDV
-- -----------------------------------------------------------------------------

CREATE TABLE RDV
   (
    nss VARCHAR2(15)  NOT NULL,
    id_motif INT(4)  NOT NULL,
    id_employe INT(4)  NOT NULL,
    date_creneau DATE  NOT NULL,
    heure_creneau DATE  NOT NULL,
    statut_paiement VARCHAR2(32)  NULL
,   CONSTRAINT PK_RDV PRIMARY KEY (nss, id_motif, id_employe, date_creneau, heure_creneau)  
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : Apporter
-- -----------------------------------------------------------------------------

CREATE TABLE Apporter
   (
    id_motif INT(4)  NOT NULL,
    id_piece INT(4)  NOT NULL
,   CONSTRAINT PK_Apporter PRIMARY KEY (id_motif, id_piece)  
   ) ;

-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE Directeur ADD (
     CONSTRAINT FK_Directeur_Employe
          FOREIGN KEY (id_employe)
               REFERENCES Employe (id_employe))   ;

ALTER TABLE Medecin ADD (
     CONSTRAINT FK_Medecin_Specialite
          FOREIGN KEY (id_specialite)
               REFERENCES Specialite (id_specialite))   ;

ALTER TABLE Medecin ADD (
     CONSTRAINT FK_Medecin_Employe
          FOREIGN KEY (id_employe)
               REFERENCES Employe (id_employe))   ;

ALTER TABLE Agent ADD (
     CONSTRAINT FK_Agent_Employe
          FOREIGN KEY (id_employe)
               REFERENCES Employe (id_employe))   ;

ALTER TABLE Bloquer ADD (
     CONSTRAINT FK_Bloquer_Creneau
          FOREIGN KEY (date_creneau, heure_creneau)
               REFERENCES Creneau (date_creneau, heure_creneau))   ;

ALTER TABLE Bloquer ADD (
     CONSTRAINT FK_Bloquer_Medecin
          FOREIGN KEY (id_employe)
               REFERENCES Medecin (id_employe))   ;

ALTER TABLE RDV ADD (
     CONSTRAINT FK_RDV_Patient
          FOREIGN KEY (nss)
               REFERENCES Patient (nss))   ;

ALTER TABLE RDV ADD (
     CONSTRAINT FK_RDV_Motif
          FOREIGN KEY (id_motif)
               REFERENCES Motif (id_motif))   ;

ALTER TABLE RDV ADD (
     CONSTRAINT FK_RDV_Medecin
          FOREIGN KEY (id_employe)
               REFERENCES Medecin (id_employe))   ;

ALTER TABLE RDV ADD (
     CONSTRAINT FK_RDV_Creneau
          FOREIGN KEY (date_creneau, heure_creneau)
               REFERENCES Creneau (date_creneau, heure_creneau))   ;

ALTER TABLE Apporter ADD (
     CONSTRAINT FK_Apporter_Motif
          FOREIGN KEY (id_motif)
               REFERENCES Motif (id_motif))   ;

ALTER TABLE Apporter ADD (
     CONSTRAINT FK_Apporter_Piece
          FOREIGN KEY (id_piece)
               REFERENCES Piece (id_piece))   ;


-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------