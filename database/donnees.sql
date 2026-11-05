-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 13 oct. 2026 à 19:15
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

-- Ordre des tables : parents avant enfants (clés étrangères)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vite_et_gourmand`
--

--

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `email`, `mot_de_passe_hash`, `nom`, `prenom`, `telephone`, `adresse`, `complement_adresse`, `code_postal`, `commune`, `role`, `actif`, `date_creation`) VALUES
(9, 'mprune@mail.fr', '$2y$10$DeijyTY5XsT0PgurkHEPX.VpXAjY9tJqnZ8v/cFA5vFmS.kA.3wZS', 'Prune', 'Marie', '06.02.03.04.05', '2 rue de la liberté', 'lot 2', '13400', 'Aubagne', 'utilisateur', 1, '2026-09-11 10:23:49'),
(13, 'martinp@mail.fr', '$2y$10$B5UCMICJGeOjt4j4r.QiYeM7SI4fXuDG1TUnA47XZaCx9L9HLnw2W', 'Martin', 'Paul', '0606060606', 'Lotissement la vallée', '', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-08 10:23:49'),
(14, 'cduss@mail.fr', '$2y$10$Gr.hrztye7AxIRmW8oqlx.EaF2/kbfDVLXLY61NQO6MJC2vJ6FxpK', 'Duss', 'Claude', '0606060606', 'Chemin de la plage', '', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-09 15:56:44'),
(15, 'winchl@mail.fr', '$2y$10$dLX4Cz9Jcdp9It3UuQm0u.Svnz0tEkC3coRIGUdDV3uWJnMo6Ayn.', 'Winch', 'Largo', '06.02.03.04.05', '5 Rue de la Poste', 'ter', '33000', 'Bordeaux', 'employe', 1, '2026-10-09 16:01:59'),
(17, 'emodel@mail.fr', '$2y$10$jlL4aOhDNL3L1IwPy9r0V.xGL6CLmgDK7m9Fw/Ym79vlBCp.CBP..', 'Modele', 'Employe', '06.02.03.04.05', 'Rue du Poulet', '25', '33200', 'Caudéran', 'employe', 1, '2026-10-12 09:05:52'),
(18, 'superm@mail.fr', '$2y$10$Icnwm.RaVVdfiMG5kruUxeKzIgVla737xXOf5e4/Wzw8Q2LPylLy2', 'Super', 'Man', '0606060606', 'Route des vignes', '', '33100', 'La Bastide', 'utilisateur', 1, '2026-10-12 15:20:14'),
(19, 'ironm@mail.fr', '$2y$10$jlyTkXQiorSUtaRqKqvGMu0PXGEvScLj9/r1RQm95ZkZC/Wd97CfO', 'Iron', 'Man', '06.01.02.03.04', 'Chemin de la plage', '2 bis', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-12 15:36:15'),
(21, 'gourmandjo@mail.fr', '$2y$10$1cG9DcCbJUVC5HmucbqVYuYah.gpI/5K72SOKXmHSrNcEa9V6E.32', 'Gourmand', 'José', '06.01.02.03.04', 'Rue Latour', '', '33000', 'Bordeaux', 'admin', 1, '2026-10-13 12:05:26'),
(22, 'gourmand.f@mail.fr', '$2y$10$Ny5KJlBEIiR.Ru5NFDbcDujoJMBU4W/3/iBo99ZaYnOZa3f01DorS', 'Gourmand', 'Fleur', '07.07.08.09.04', 'Avenue de Tivoli', '16', '33110', 'Le Bouscat', 'employe', 1, '2026-10-13 12:09:05');



--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `nomMenu`, `description`, `theme`, `nbPersonneMin`, `prix`, `conditions`, `regime`, `allergenes`, `stock`, `image`) VALUES
(3, 'Menu Saveurs de saison', 'Une cuisine raffinée aux saveurs de saison, élaborée à partir de produits frais et soigneusement sélectionnés.', ' Noël - Pâques - Classique - Evénement', 6, 35, 'Conditions : Ce menu doit être commandé minimum 5 jours avant la prestation.', 'Classique', 'gluten, fruits à coque, produits laitiers.', 0, 'plat viande.jpg'),
(4, 'Menu Evasion Gourmande', 'Une sélection généreuse et savoureuse, idéale pour partager un moment convivial en famille ou entre amis.', 'Evénement', 8, 42, '', '', '', 0, 'Plat poisson.jpg'),
(5, 'Menu Prestige', 'Une expérience gastronomique élégante, composée de produits d’exception et de créations raffinées.', 'Noël - Pâques', 10, 55, '', '', '', 0, 'Plat viand champêtre.jpg'),
(9, 'Menu Délices de la Mer', 'Une sélection raffinée de produits de la mer, sublimés par des accompagnements frais et savoureux. Un menu élégant et gourmand, idéal pour partager un moment convivial autour des saveurs marines.', 'Evènement', 4, 56.5, 'Commande minimum 7 jours avant', 'classique', '', 4, 'Menu délices de la mer.jpg');


--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `nomPlat`, `typePlat`) VALUES
(3, 'L\'Éclat des saisons', 'Entrée'),
(4, 'Gourmandise des saisons', 'Filet de volaille rôti, légumes de saison et jus aux herbes');

-- Mise à jour table plats avec ajout colonne description et données (fichier excel MAJ BDD)
ALTER TABLE plats ADD description VARCHAR(250) AFTER typePlat;

--Mise à jour des descriptions dans plats
insert into plats (id, nomPlat, typePlat,description) values (5,'Fraîcheur du potager','Entrée','Salade de chèvre chaud, noix et légumes croquants.');
insert into plats (id, nomPlat, typePlat,description) values (6,'Velouté du jardin','Entrée','Velouté de légumes de saison, crème légère et herbes fraîches.');
insert into plats (id, nomPlat, typePlat,description) values (7,'Feuilleté gourmand','Entrée','Feuilleté aux champignons et fondue de poireaux.');
insert into plats (id, nomPlat, typePlat,description) values (4,'Gourmandise des saisons','Plat principal','Filet de volaille rôti, légumes de saison et jus aux herbes.');
insert into plats (id, nomPlat, typePlat,description) values (9,'Suprême de volaille','Plat principal','Suprême de poulet, pommes grenailles et sauce forestière.');
insert into plats (id, nomPlat, typePlat,description) values (10,'Pavé de veau','Plat principal','Pavé de veau, purée maison et légumes glacés.');
insert into plats (id, nomPlat, typePlat,description) values (11,'Douceur du verger','Dessert','Tarte fine aux pommes et caramel.');
insert into plats (id, nomPlat, typePlat,description) values (12,'Délice fruité','Dessert','Panna cotta à la vanille et coulis de fruits rouges.');
insert into plats (id, nomPlat, typePlat,description) values (13,'Moelleux gourmand','Dessert','Moelleux au chocolat et crème anglaise.');

insert into plats (id, nomPlat, typePlat,description) values (14,'Jardin printanier','Entrée','Asperges vertes, œuf mollet et vinaigrette citronnée.');
insert into plats (id, nomPlat, typePlat,description) values (15,'Œuf gourmand','Entrée','Œuf mimosa revisité, jeunes pousses et copeaux de parmesan.');
insert into plats (id, nomPlat, typePlat,description) values (16,'Croustillant de saison','Entrée','Feuilleté aux légumes printaniers et fromage frais.');
insert into plats (id, nomPlat, typePlat,description) values (17,'Agneau de Pâques','Plat principal','Souris d\'agneau confite, pommes grenailles et légumes printaniers.');
insert into plats (id, nomPlat, typePlat,description) values (18,'Volaille printanière','Plat principal','Suprême de volaille, risotto aux asperges et sauce crémeuse.');
insert into plats (id, nomPlat, typePlat,description) values (19,'Filet de veau','Plat principal','Filet de veau rôti, purée de carottes et jus réduit.');
insert into plats (id, nomPlat, typePlat,description) values (20,'Nid de Pâques','Dessert','Mousse au chocolat, croustillant praliné et petits œufs chocolatés.');
insert into plats (id, nomPlat, typePlat,description) values (21,'Fraîcheur printanière','Dessert','Entremets aux fruits rouges et biscuit léger.');
insert into plats (id, nomPlat, typePlat,description) values (22,'Douceur chocolatée','Dessert','Fondant au chocolat, cœur caramel et glace vanille.');

insert into plats (id, nomPlat, typePlat,description) values (23,'Éclat festif','Entrée','Foie gras mi-cuit, chutney de figues et pain brioché.');
insert into plats (id, nomPlat, typePlat,description) values (24,'Délice des sous-bois','Entrée','Ravioles aux champignons, crème légère et éclats de noisettes.');
insert into plats (id, nomPlat, typePlat,description) values (25,'Élégance marine','Entrée','Noix de Saint-Jacques poêlées, fondue de poireaux et beurre citronné.');
insert into plats (id, nomPlat, typePlat,description) values (26,'Signature Prestige','Plat principal','Filet de bœuf, sauce aux morilles et gratin dauphinois.');
insert into plats (id, nomPlat, typePlat,description) values (27,'Volaille festive','Plat principal','Suprême de volaille farci aux champignons, légumes glacés.');
insert into plats (id, nomPlat, typePlat,description) values (28,'Magret raffiné','Plat principal','Magret de canard, sauce aux fruits rouges et purée de patate douce.');
insert into plats (id, nomPlat, typePlat,description) values (29,'Bûche enchantée','Dessert','Bûche chocolat et praliné.');
insert into plats (id, nomPlat, typePlat,description) values (30,'Perle de Noël','Dessert','Entremets vanille, insert poire et croustillant spéculoos.');
insert into plats (id, nomPlat, typePlat,description) values (31,'Délice exotique','Dessert','Dôme mangue-passion et biscuit coco.');

insert into plats (id, nomPlat, typePlat,description) values (32,'Fraîcheur océane','Entrée','Tartare de saumon, avocat et citron vert.');
insert into plats (id, nomPlat, typePlat,description) values (33,'Perle marine','Entrée','Noix de Saint-Jacques poêlées, crème de petits pois.');
insert into plats (id, nomPlat, typePlat,description) values (34,'Délice iodé','Entrée','Crevettes marinées, mangue fraîche et salade croquante.');
insert into plats (id, nomPlat, typePlat,description) values (35,'Escale marine','Plat principal','Filet de cabillaud, légumes fondants et sauce citronnée.');
insert into plats (id, nomPlat, typePlat,description) values (36,'Saveur des océans','Plat principal','Pavé de saumon rôti, risotto crémeux et sauce à l\'aneth.');
insert into plats (id, nomPlat, typePlat,description) values (37,'Trésor de la mer','Plat principal','Gambas poêlées, riz parfumé et sauce coco-citronnelle.');
insert into plats (id, nomPlat, typePlat,description) values (38,'Nuage citronné','Dessert','Tartelette au citron meringuée.');
insert into plats (id, nomPlat, typePlat,description) values (39,'Douceur exotique','Dessert','Mousse coco, cœur mangue-passion.');
insert into plats (id, nomPlat, typePlat,description) values (40,'Chocolat marin','Dessert','Moelleux au chocolat et coulis de fruits rouges.');

insert into plats (id, nomPlat, typePlat,description) values (41,'Soleil de Provence','Entrée','Tartare de tomates, concombre, olives et basilic.');
insert into plats (id, nomPlat, typePlat,description) values (42,'Croustillant du Sud','Entrée','Feuilleté aux légumes du soleil et crème végétale aux herbes.');
insert into plats (id, nomPlat, typePlat,description) values (43,'Douceur méditerranéenne','Entrée','Houmous maison, légumes croquants et pain pita vegan.');
insert into plats (id, nomPlat, typePlat,description) values (44,'Escale du soleil','Plat principal','Aubergine farcie aux légumes, lentilles et herbes fraîches.');
insert into plats (id, nomPlat, typePlat,description) values (45,'Risotto provençal','Plat principal','Risotto aux tomates confites, courgettes et basilic.');
insert into plats (id, nomPlat, typePlat,description) values (46,'Voyage végétal','Plat principal','Tajine de légumes, pois chiches et semoule aux épices douces.');
insert into plats (id, nomPlat, typePlat,description) values (47,'Délice des agrumes','Dessert','Tartelette citron-amande à la crème végétale.');
insert into plats (id, nomPlat, typePlat,description) values (48,'Douceur coco','Dessert','Panna cotta au lait de coco et coulis de mangue.');
insert into plats (id, nomPlat, typePlat,description) values (49,'Gourmandise chocolatée','Dessert','Fondant au chocolat noir et crème végétale à la vanille.');

insert into plats (id, nomPlat, typePlat,description) values (50,'Douceur du terroir','Entrée','Tarte fine au chèvre frais, tomates confites et basilic.');
insert into plats (id, nomPlat, typePlat,description) values (51,'Fraîcheur printanière','Entrée','Salade de jeunes pousses, poire, noix et bleu.');
insert into plats (id, nomPlat, typePlat,description) values (52,'Velours forestier','Entrée','Velouté de champignons et copeaux de parmesan.');
insert into plats (id, nomPlat, typePlat,description) values (53,'Harmonie végétale','Plat principal','Risotto crémeux aux champignons, parmesan et noisettes.');
insert into plats (id, nomPlat, typePlat,description) values (54,'Délice du potager','Plat principal','Ravioles ricotta-épinards, crème légère aux herbes.');
insert into plats (id, nomPlat, typePlat,description) values (55,'Soleil gourmand','Plat principal','Lasagnes aux légumes grillés, mozzarella et basilic.');
insert into plats (id, nomPlat, typePlat,description) values (56,'Nuage gourmand','Dessert','Mousse au chocolat noir et fruits rouges.');
insert into plats (id, nomPlat, typePlat,description) values (57,'Douceur vanillée','Dessert','Crème brûlée à la vanille.');
insert into plats (id, nomPlat, typePlat,description) values (58,'Tendre gourmandise','Dessert','Tiramisu traditionnel au café et cacao.');


--Mise à jour du lien plats menu_plat (fichier excel MAJ BDD)
insert into menu_plat (menu_id, plat_id) values (3,3);
insert into menu_plat (menu_id, plat_id) values (3,4);
insert into menu_plat (menu_id, plat_id) values (3,5);
insert into menu_plat (menu_id, plat_id) values (3,7);
insert into menu_plat (menu_id, plat_id) values (3,9);
insert into menu_plat (menu_id, plat_id) values (3,10);
insert into menu_plat (menu_id, plat_id) values (3,11);
insert into menu_plat (menu_id, plat_id) values (3,12);
insert into menu_plat (menu_id, plat_id) values (3,13);

insert into menu_plat (menu_id, plat_id) values (4,14);
insert into menu_plat (menu_id, plat_id) values (4,15);
insert into menu_plat (menu_id, plat_id) values (4,16);
insert into menu_plat (menu_id, plat_id) values (4,17);
insert into menu_plat (menu_id, plat_id) values (4,18);
insert into menu_plat (menu_id, plat_id) values (4,19);
insert into menu_plat (menu_id, plat_id) values (4,20);
insert into menu_plat (menu_id, plat_id) values (4,21);
insert into menu_plat (menu_id, plat_id) values (4,22);

insert into menu_plat (menu_id, plat_id) values (5,23);
insert into menu_plat (menu_id, plat_id) values (5,24);
insert into menu_plat (menu_id, plat_id) values (5,25);
insert into menu_plat (menu_id, plat_id) values (5,26);
insert into menu_plat (menu_id, plat_id) values (5,27);
insert into menu_plat (menu_id, plat_id) values (5,28);
insert into menu_plat (menu_id, plat_id) values (5,29);
insert into menu_plat (menu_id, plat_id) values (5,30);
insert into menu_plat (menu_id, plat_id) values (5,31);

insert into menu_plat (menu_id, plat_id) values (9,32);
insert into menu_plat (menu_id, plat_id) values (9,33);
insert into menu_plat (menu_id, plat_id) values (9,34);
insert into menu_plat (menu_id, plat_id) values (9,35);
insert into menu_plat (menu_id, plat_id) values (9,36);
insert into menu_plat (menu_id, plat_id) values (9,37);
insert into menu_plat (menu_id, plat_id) values (9,38);
insert into menu_plat (menu_id, plat_id) values (9,39);
insert into menu_plat (menu_id, plat_id) values (9,40);

insert into menu_plat (menu_id, plat_id) values (10,41);
insert into menu_plat (menu_id, plat_id) values (10,42);
insert into menu_plat (menu_id, plat_id) values (10,43);
insert into menu_plat (menu_id, plat_id) values (10,44);
insert into menu_plat (menu_id, plat_id) values (10,45);
insert into menu_plat (menu_id, plat_id) values (10,46);
insert into menu_plat (menu_id, plat_id) values (10,47);
insert into menu_plat (menu_id, plat_id) values (10,48);
insert into menu_plat (menu_id, plat_id) values (10,49);

insert into menu_plat (menu_id, plat_id) values (11,50);
insert into menu_plat (menu_id, plat_id) values (11,51);
insert into menu_plat (menu_id, plat_id) values (11,52);
insert into menu_plat (menu_id, plat_id) values (11,53);
insert into menu_plat (menu_id, plat_id) values (11,54);
insert into menu_plat (menu_id, plat_id) values (11,55);
insert into menu_plat (menu_id, plat_id) values (11,56);
insert into menu_plat (menu_id, plat_id) values (11,57);
insert into menu_plat (menu_id, plat_id) values (11,58);


--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `numero`, `statut`, `adresseLivraison`, `complementLivraison`, `codePostalLivraison`, `communeLivraison`, `datePrestation`, `heurePrestation`, `nbPersonneCommande`, `prixTotal`, `fraisLivraison`, `montantRemise`, `motifAnnulation`, `dateCreation`, `menu_id`, `compte_id`) VALUES
(1, 'CMD-2026-9714', 'En attente de validation', 'Rue de la liberté', '20 bis', '33810', 'AMBES', '2026-10-08', '18:30:00', 10, 430.90, 10.90, 0.00, NULL, '2026-10-05 15:40:04', 4, 9),
(3, 'CMD-2026-4788', 'En attente de validation', 'Impasse du terroir', NULL, '33810', 'AMBES', '2026-10-11', '20:00:00', 20, 1000.90, 10.90, 110.00, NULL, '2026-10-05 16:02:28', 5, 9),
(4, 'CMD-2026-6114', 'En attente de validation', 'Impasse du terroir', NULL, '33810', 'AMBES', '2026-10-11', '20:00:00', 20, 1000.90, 10.90, 110.00, NULL, '2026-10-05 16:11:26', 5, 9),
(10, 'CMD-2026-9081', 'En attente de validation', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, '2026-10-07 11:15:32', 3, 9),
(11, 'CMD-2026-1044', 'En attente de validation', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, '2026-10-07 11:16:49', 3, 9),
(12, 'CMD-2026-6279', 'En attente de validation', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, '2026-10-07 11:17:32', 3, 9),
(13, 'CMD-2026-3908', 'En attente de validation', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, '2026-10-07 11:20:10', 3, 9),
(14, 'CMD-2026-7463', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:06:49', 3, 9),
(15, 'CMD-2026-3142', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:21:56', 3, 9),
(16, 'CMD-2026-4810', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:24:27', 3, 9),
(17, 'CMD-2026-6590', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:27:00', 3, 9),
(18, 'CMD-2026-4701', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:27:28', 3, 9),
(19, 'CMD-2026-5922', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:28:14', 3, 9),
(20, 'CMD-2026-4171', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, '2026-10-08 09:29:00', 3, 9),
(21, 'CMD-2026-5896', 'En attente de validation', 'Boulevard de la Poste', '42', '33000', 'Bordeaux', '2026-10-27', '10:00:00', 9, 378.00, 0.00, 0.00, NULL, '2026-10-08 10:24:46', 4, 13),
(22, 'CMD-2026-22', 'En attente de validation', 'Chemin de la plage', NULL, '33000', 'Bordeaux', '2026-10-24', '20:30:00', 4, 226.00, 0.00, 0.00, NULL, '2026-10-12 14:54:54', 9, 14),
(23, 'CMD-2026-23', 'En attente de validation', 'Chemin de la plage', '2 Bis', '33000', 'Bordeaux', '2026-10-28', '20:00:00', 10, 508.50, 0.00, 56.50, NULL, '2026-10-12 17:31:15', 9, 19);

--
-- Déchargement des données de la table `histostatut`
--

INSERT INTO `histostatut` (`id`, `statut`, `dateChangement`, `commande_id`) VALUES
(1, 'En attente de validation', '2026-10-05 15:40:04', 1),
(2, 'En attente de validation', '2026-10-05 16:02:28', 3),
(3, 'En attente de validation', '2026-10-05 16:11:26', 4),
(4, 'En attente de validation', '2026-10-07 11:15:32', 10),
(5, 'En attente de validation', '2026-10-07 11:16:49', 11),
(6, 'En attente de validation', '2026-10-07 11:17:32', 12),
(7, 'En attente de validation', '2026-10-07 11:20:10', 13),
(8, 'En attente de validation', '2026-10-08 09:06:49', 14),
(9, 'En attente de validation', '2026-10-08 09:21:56', 15),
(10, 'En attente de validation', '2026-10-08 09:24:27', 16),
(11, 'En attente de validation', '2026-10-08 09:27:00', 17),
(12, 'En attente de validation', '2026-10-08 09:27:28', 18),
(13, 'En attente de validation', '2026-10-08 09:28:14', 19),
(14, 'En attente de validation', '2026-10-08 09:29:00', 20),
(15, 'En attente de validation', '2026-10-08 10:24:46', 21),
(16, 'En attente de validation', '2026-10-12 14:54:54', 22),
(17, 'En attente de validation', '2026-10-12 17:31:15', 23);

--
-- Déchargement des données de la table `menu_plat`
--

INSERT INTO `menu_plat` (`menu_id`, `plat_id`) VALUES
(3, 3),
(3, 4);


-- Déchargement des données de la table `allergenes`
--

INSERT INTO `allergenes` (`id`, `nomAllergene`) VALUES
(2, 'Fruits à coque'),
(3, 'Crustacés'),
(5, 'Lait'),
(6, 'Céréales contenant du gluten'),
(7, 'Mollusques'),
(8, 'Arachides'),
(10, 'Moutarde'),
(11, 'Graines de sésame');
(12, 'Œuf');
(13, 'Poisson');


--
-- Déchargement des données de la table `plat_allergene`
--

INSERT INTO `plat_allergene` (`plat_id`, `allergene_id`) VALUES (3, 10),
INSERT INTO `plat_allergene` (`plat_id`, `allergene_id`) VALUES (4, 11);
insert into plat_allergene (plat_id, allergene_id) values (3,2);
insert into plat_allergene (plat_id, allergene_id) values (3,5);
insert into plat_allergene (plat_id, allergene_id) values (6,5);
insert into plat_allergene (plat_id, allergene_id) values (7,6);
insert into plat_allergene (plat_id, allergene_id) values (9,5);
insert into plat_allergene (plat_id, allergene_id) values (10,5);
insert into plat_allergene (plat_id, allergene_id) values (11,5);
insert into plat_allergene (plat_id, allergene_id) values (11,6);
insert into plat_allergene (plat_id, allergene_id) values (12,5);
insert into plat_allergene (plat_id, allergene_id) values (13,5);
insert into plat_allergene (plat_id, allergene_id) values (13,12);
insert into plat_allergene (plat_id, allergene_id) values (14,12);
insert into plat_allergene (plat_id, allergene_id) values (15,5);
insert into plat_allergene (plat_id, allergene_id) values (15,12);
insert into plat_allergene (plat_id, allergene_id) values (16,5);
insert into plat_allergene (plat_id, allergene_id) values (16,6);
insert into plat_allergene (plat_id, allergene_id) values (18,5);
insert into plat_allergene (plat_id, allergene_id) values (20,2);
insert into plat_allergene (plat_id, allergene_id) values (20,5);
insert into plat_allergene (plat_id, allergene_id) values (20,12);
insert into plat_allergene (plat_id, allergene_id) values (21,5);
insert into plat_allergene (plat_id, allergene_id) values (21,6);
insert into plat_allergene (plat_id, allergene_id) values (21,12);
insert into plat_allergene (plat_id, allergene_id) values (22,5);
insert into plat_allergene (plat_id, allergene_id) values (22,6);
insert into plat_allergene (plat_id, allergene_id) values (22,12);
insert into plat_allergene (plat_id, allergene_id) values (23,5);
insert into plat_allergene (plat_id, allergene_id) values (23,6);
insert into plat_allergene (plat_id, allergene_id) values (23,12);
insert into plat_allergene (plat_id, allergene_id) values (24,2);
insert into plat_allergene (plat_id, allergene_id) values (24,5);
insert into plat_allergene (plat_id, allergene_id) values (24,6);
insert into plat_allergene (plat_id, allergene_id) values (25,5);
insert into plat_allergene (plat_id, allergene_id) values (25,7);
insert into plat_allergene (plat_id, allergene_id) values (26,5);
insert into plat_allergene (plat_id, allergene_id) values (29,2);
insert into plat_allergene (plat_id, allergene_id) values (29,5);
insert into plat_allergene (plat_id, allergene_id) values (29,6);
insert into plat_allergene (plat_id, allergene_id) values (29,12);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Mise à jour de la table horaires

INSERT INTO horaires (jour, heureDebut, heureFin, ouvert) 
VALUES ('Lundi','09:00:00', '18:00:00',1), ('Mardi','09:00:00', '18:00:00',1),('Mercredi','09:00:00', '18:00:00',1),('Jeudi','09:00:00', '18:00:00',1),('Vendredi','09:00:00', '18:00:00',1),('Samedi','09:00:00', '13:00:00',1),('Dimanche',null,null,0);



