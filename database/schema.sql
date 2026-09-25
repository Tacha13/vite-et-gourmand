USE vite_et_gourmand;

CREATE TABLE IF NOT EXISTS comptes 
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
email VARCHAR (250) UNIQUE NOT NULL,
mot_de_passe_hash VARCHAR (250) NOT NULL,
nom VARCHAR (250) NOT NULL,
prenom VARCHAR (250) NOT NULL,
telephone VARCHAR (20),
adresse VARCHAR (250),
complement_adresse VARCHAR(250),
code_postal VARCHAR (20),
commune VARCHAR(250),
role VARCHAR (50) DEFAULT 'utilisateur',
actif BOOLEAN DEFAULT 1,
date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS menus 
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nomMenu VARCHAR (250) NOT NULL,
description VARCHAR (250) NOT NULL,
theme VARCHAR (250) NOT NULL,
nbPersonneMin INTEGER NOT NULL,
prix FLOAT NOT NULL,
conditions VARCHAR (250) NOT NULL,
regime VARCHAR (250) NOT NULL,
allergenes VARCHAR (250) NOT NULL,
stock INTEGER NOT NULL,
image VARCHAR (250) NOT NULL
);

CREATE TABLE IF NOT EXISTS plats 
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nomPlat VARCHAR (250) NOT NULL,
typePlat VARCHAR (250) NOT NULL
);

CREATE TABLE IF NOT EXISTS allergenes 
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
nomAllergene VARCHAR (250) NOT NULL
);

CREATE TABLE IF NOT EXISTS menu_plat
(
menu_id INTEGER NOT NULL,
plat_id INTEGER NOT NULL,
PRIMARY KEY (menu_id, plat_id),
Foreign Key (menu_id) REFERENCES menus(id),
Foreign Key (plat_id) REFERENCES plats(id)
);

CREATE TABLE IF NOT EXISTS plat_allergene
(
plat_id INTEGER NOT NULL,
allergene_id INTEGER NOT NULL,
PRIMARY KEY (plat_id, allergene_id),
Foreign Key (plat_id) REFERENCES plats(id),
Foreign Key (allergene_id) REFERENCES allergenes(id)
);


CREATE TABLE IF NOT EXISTS commandes
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
numero VARCHAR (20) UNIQUE NOT NULL,
statut VARCHAR (50) NOT NULL DEFAULT 'en attente de validation',
adresseLivraison VARCHAR (250) NOT NULL,
datePrestation DATE NOT NULL,
heurePrestation TIME NOT NULL,
nbPersonneCommande INTEGER NOT NULL,
prixTotal DECIMAL (10, 2) NOT NULL,
fraisLivraison DECIMAL (10, 2) NOT NULL,
montantRemise DECIMAL (10, 2) NOT NULL DEFAULT 0.00,
motifAnnulation VARCHAR (250),
dateCreation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
menu_id INTEGER NOT NULL,
compte_id INTEGER NOT NULL,
Foreign Key (compte_id) REFERENCES comptes(id),
Foreign Key (menu_id) REFERENCES menus(id)
);

CREATE TABLE IF NOT EXISTS histostatut
(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
statut VARCHAR (50) NOT NULL,
dateChangement DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
commande_id INTEGER NOT NULL,
Foreign Key (commande_id) REFERENCES commandes(id)

);