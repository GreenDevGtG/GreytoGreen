-- INSERT

INSERT INTO `lieu` (
id,
Nom,
Adresse,
Telephone,
Site_web,
Email
)
VALUES (
?,
Nouveau_nom,
Nouvelle_adresse,
Nouveau_telephone,
Nouveau_site_web,
Nouvel_email
);

-- READ 

SELECT * FROM `lieu`;

-- UPDATE

UPDATE `lieu`
SET 
Nom = Update_nom,
Adresse = Update_adresse,
Telephone = Update_telephone,
Site_web = Update_site_web,
Email = Update_email
WHERE id = "choix id";

-- DELETE

DELETE FROM `lieu`
WHERE id = "choix id";