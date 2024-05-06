DROP TABLE IF EXISTS `equipements`;

CREATE TABLE `equipements` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nom` VARCHAR(100),
  `description` TEXT,
  `aperçu` TEXT,
  `spécifications` TEXT,
  `caractéristiques` TEXT,
  `utilisation` TEXT,
  `téléchargements` TEXT,
  `type` VARCHAR(50), -- par exemple: 'Drone', 'Véhicule Terrestre', 'Capteur', etc.
  `status` VARCHAR(10) CHECK (status IN ('disponible', 'en_maintenance', 'reserve')),
  `image` VARCHAR(255), -- Colonne ajoutée pour stocker le chemin de l'image
  'created_at' DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ajouté
  'updated_at' DATETIME DEFAULT CURRENT_TIMESTAMP -- Ajouté
, "projet_id" integer);


DROP TABLE IF EXISTS `plateformes`;

CREATE TABLE `plateformes` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nom` VARCHAR(100),
  `type` VARCHAR(50) NOT NULL CHECK (type IN ('Terrestre', 'Drone')),
  `description` TEXT,
  `capacite` VARCHAR(100) 
);


DROP TABLE IF EXISTS `equipements_plateformes`;

CREATE TABLE `equipements_plateformes` (
  `equipement_id` INTEGER NOT NULL,
  `plateforme_id` INTEGER NOT NULL,
  FOREIGN KEY(`equipement_id`) REFERENCES `equipements`(`id`),
  FOREIGN KEY(`plateforme_id`) REFERENCES `plateformes`(`id`),
  PRIMARY KEY (`equipement_id`, `plateforme_id`)
);


DROP TABLE IF EXISTS `projets`;

CREATE TABLE `projets` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nom` VARCHAR(100),
  `introduction` TEXT,
  `description` TEXT,
  `image` VARCHAR(255),
  `plateforme_id` INTEGER,
  'created_at' DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ajouté
  'updated_at' DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ajouté
  FOREIGN KEY(`plateforme_id`) REFERENCES `plateformes`(`id`)
);


DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `projet_id` INTEGER,  -- Ajoutez cette ligne
  `equipement_id` INTEGER,
  `path` VARCHAR(255) NOT NULL,
  'created_at' DATETIME DEFAULT CURRENT_TIMESTAMP,
  'updated_at' DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`projet_id`) REFERENCES `projets`(`id`) ON DELETE CASCADE,  -- Mettez à jour cette ligne
  FOREIGN KEY (`equipement_id`) REFERENCES `equipements`(`id`) ON DELETE CASCADE
);


DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nom` VARCHAR(100),
  `prenom` VARCHAR(100),
  `email` VARCHAR(100),
  `identifiant` VARCHAR(100),
  `date_debut` DATE,
  `date_fin` DATE,
  `equipement_id` INTEGER NOT NULL,
  `user_id` INTEGER,  -- Ajout de la colonne user_id
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP, 
  "statut" varchar not null default 'pending', 
  "commentaire" text,
  FOREIGN KEY (`equipement_id`) REFERENCES `equipements`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `utilisateurs`(`id`) ON DELETE SET NULL -- Assurez-vous que la table utilisateurs est correctement définie
);


DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  `nom` VARCHAR(40),
  `prenom` VARCHAR(40),
  `email` VARCHAR(255) NOT NULL UNIQUE,  -- Champ pour l'email avec validation d'unicité
  `mdp` VARCHAR(60) NOT NULL,            -- MDP est souvent stocké sous forme de hash
  `role` VARCHAR(10) NOT NULL DEFAULT 'chercheur', `profile_image` VARCHAR(255) NULL,
  CHECK (role IN ('chercheur', 'enseignant', 'etudiant', 'admin'))
);


DROP TABLE IF EXISTS `equipements_projets`;

CREATE TABLE `equipements_projets` (
  `equipement_id` INTEGER NOT NULL,
  `projet_id` INTEGER NOT NULL,
  FOREIGN KEY(`equipement_id`) REFERENCES `equipements`(`id`),
  FOREIGN KEY(`projet_id`) REFERENCES `projets`(`id`),
  PRIMARY KEY (`equipement_id`, `projet_id`)
);
