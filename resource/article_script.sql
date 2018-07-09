-- INSERT

INSERT INTO `article` (
id,
Nom,
Contenu,
URL_image,
URL_source
)
VALUES (
?,
Nouveau_nom,
Nouvelle_contenu,
Nouveau_URL_image,
Nouveau_URL_source
);

-- READ 

SELECT * FROM `article`;

-- UPDATE

UPDATE `article`
SET 
Nom = Update_nom,
Contenu = Update_contenu,
URL_image = Update_URL_image,
URL_source = Update_URL_source
WHERE id = "choix id";

-- DELETE

DELETE FROM `article`
WHERE id = "choix id";