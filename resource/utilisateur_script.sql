-- INSERT

INSERT INTO `utilisateur` (
id,
Pseudonyme,
Email,
Mot_de_passe,
Adresse,
Prenom,
Nom,
Ville,
Date_de_naissance,
Pays
)
VALUES (
?,
Nouveau_pseudonyme,
Nouvel_email,
Nouveau_mot_de_passe,
Nouvelle_adresse,
Nouveau_nom,
Nouveau_prenom,
Nouvelle_ville,
Nouvelle_date_de_naissance,
Nouveau_pays
);

-- READ 

SELECT * FROM `utilisateur`;

-- UPDATE

UPDATE `utilisateur`
SET 
Pseudonyme = Update_pseudo,
Email = Update_email,
Mot_de_passe = Update_mot_de_passe,
Adresse = Update_adresse,
Prenom = Update_prenom,
Nom = Update_nom,
Ville = Update_ville,
Date_de_naissance = Update_date_de_naissance,
Pays = Update_pays
WHERE id = "choix id";

-- DELETE

DELETE FROM `utilisateur`
WHERE id = "choix id";