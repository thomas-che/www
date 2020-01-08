DROP TABLE matiere;
DROP TABLE note;
DROP TABLE etudiant;


CREATE TABLE etudiant (  
	idEtudiant 	int(7) 		NOT NULL 	AUTO_INCREMENT
	, nom 		varchar(64) 	NOT NULL
	, prenom	varchar(64) 	NOT NULL
	, email		varchar(255) 	NOT NULL
	, td		varchar(1) 	NOT NULL
	, tp		varchar(1) 	NOT NULL
	, CONSTRAINT PK_etudiant PRIMARY KEY (idEtudiant)
	);

CREATE TABLE matiere (
	nomMatiere 	varchar(64) 	NOT NULL
  	, coef 		int(1) 		NOT NULL
	, CONSTRAINT PK_matiere PRIMARY KEY (nomMatiere)
	);

CREATE TABLE note (
  	idNote 		int(11) 	NOT NULL
	, idEtudiant	int(7) 		NOT NULL
	, nomMatiere	varchar(64) 	NOT NULL	
  	, resultat	int(2) 		NOT NULL
  	, descritif 	varchar(255) 	NOT NULL
	, CONSTRAINT PK_note PRIMARY KEY (idNote)
	, CONSTRAINT FK_note_etudiant_idEtudiant FOREIGN KEY (idEtudiant) REFERENCES etudiant (idEtudiant) ON DELETE CASCADE
	, CONSTRAINT FK_note_matiere_nomMatiere FOREIGN KEY (nomMatiere) REFERENCES matiere (nomMatiere) ON DELETE CASCADE
	);


