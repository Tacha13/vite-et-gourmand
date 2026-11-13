-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 13 nov. 2026 à 20:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
-- Déchargement des données de la table `allergenes`
--

INSERT INTO `allergenes` (`id`, `nomAllergene`) VALUES
(2, 'Fruits à coques'),
(3, 'Crustacés'),
(5, 'Lait'),
(6, 'Céréales contenant du gluten'),
(7, 'Mollusques'),
(8, 'Arachides'),
(10, 'Moutarde'),
(11, 'Graines de sésame'),
(12, 'Œuf'),
(13, 'Poisson');

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `avis`, `note`, `statutAvis`, `commande_id`) VALUES
(1, 'Menu complet, délicieux', 5, 'Validé', 1),
(2, 'Equipe professionnelle, repas savoureux. Au-delà de nos espérance.', 5, 'Validé', 22),
(3, 'Moment convivial sublimé par le menu. Merci à vous', 4, 'Refusé', 11),
(4, 'Repas délicieux et plein de saveurs.', 5, 'En attente de validation', 13),
(5, 'Une vraie belle découverte ! Le menu commandé était non seulement exquis et frais, mais en plus très facile à organiser grâce aux instructions claires laissées sur chaque contenant. Nos invités se sont régalés de l\'entrée au dessert.', 5, 'Validé', 3),
(6, 'Prestation parfaite pour notre dîner d\'anniversaire ! Le repas était savoureux, les saveurs bien équilibrées et la présentation très soignée. L&#039;écoute, la gentillesse et la ponctualité ont été très appréciées par tous nos convives. Une expé', 5, 'En attente de validation', 4),
(7, ' On ressent tout le savoir-faire et l’amour des bons produits marins dans ce menu. Les saveurs et les textures sont au rendez-vous, avec des spécialités locales préparées avec justesse. Le rapport qualité-prix est au top et l\'équipe est très accueill', 5, 'En attente de validation', 24);

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `numero`, `statut`, `adresseLivraison`, `complementLivraison`, `codePostalLivraison`, `communeLivraison`, `datePrestation`, `heurePrestation`, `nbPersonneCommande`, `prixTotal`, `fraisLivraison`, `montantRemise`, `motifAnnulation`, `modeContact`, `dateCreation`, `menu_id`, `compte_id`) VALUES
(1, 'CMD-2026-9714', 'Terminée', 'Rue de la liberté', '20 bis', '33810', 'AMBES', '2026-10-08', '18:30:00', 10, 430.90, 10.90, 0.00, NULL, NULL, '2026-10-05 15:40:04', 4, 9),
(3, 'CMD-2026-4788', 'Terminée', 'Impasse du terroir', NULL, '33810', 'AMBES', '2026-10-11', '20:00:00', 20, 1000.90, 10.90, 110.00, NULL, NULL, '2026-10-05 16:02:28', 5, 9),
(4, 'CMD-2026-6114', 'Terminée', 'Impasse du terroir', NULL, '33810', 'AMBES', '2026-10-11', '20:00:00', 20, 1000.90, 10.90, 110.00, NULL, NULL, '2026-10-05 16:11:26', 5, 9),
(10, 'CMD-2026-9081', 'Annulée', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, 'test d\'annulation', 'Appel', '2026-10-07 11:15:32', 3, 9),
(11, 'CMD-2026-1044', 'Terminée', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, NULL, '2026-10-07 11:16:49', 3, 9),
(12, 'CMD-2026-6279', 'Terminée', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, NULL, '2026-10-07 11:17:32', 3, 9),
(13, 'CMD-2026-3908', 'Terminée', 'Rue de la liberté', NULL, '33000', 'Bordeaux', '2026-10-14', '20:30:00', 6, 210.00, 0.00, 0.00, NULL, NULL, '2026-10-07 11:20:10', 3, 9),
(14, 'CMD-2026-7463', 'Acceptée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:06:49', 3, 9),
(15, 'CMD-2026-3142', 'En attente de validation', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:21:56', 3, 9),
(16, 'CMD-2026-4810', 'Terminée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:24:27', 3, 9),
(17, 'CMD-2026-6590', 'Terminée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:27:00', 3, 9),
(18, 'CMD-2026-4701', 'Terminée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:27:28', 3, 9),
(19, 'CMD-2026-5922', 'Terminée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:28:14', 3, 9),
(20, 'CMD-2026-4171', 'Terminée', 'Rue de la liberté', '30 ter', '33810', 'AMBES', '2026-10-15', '20:30:00', 7, 255.90, 10.90, 0.00, NULL, NULL, '2026-10-08 09:29:00', 3, 9),
(21, 'CMD-2026-5896', 'Terminée', 'Boulevard de la Poste', '42', '33000', 'Bordeaux', '2026-10-27', '10:00:00', 9, 378.00, 0.00, 0.00, NULL, NULL, '2026-10-08 10:24:46', 4, 13),
(22, 'CMD-2026-22', 'Terminée', 'Chemin de la plage', NULL, '33000', 'Bordeaux', '2026-10-24', '20:30:00', 4, 226.00, 0.00, 0.00, NULL, NULL, '2026-10-12 14:54:54', 9, 14),
(23, 'CMD-2026-23', 'Terminée', 'Chemin de la plage', '2 Bis', '33000', 'Bordeaux', '2026-10-28', '20:00:00', 10, 508.50, 0.00, 56.50, NULL, NULL, '2026-10-12 17:31:15', 9, 19),
(24, 'CMD-2026-24', 'Terminée', '23 Lotissement la Savana', NULL, '33000', 'Bordeaux', '2026-10-22', '20:00:00', 6, 339.00, 0.00, 0.00, NULL, NULL, '2026-10-15 19:05:09', 9, 14),
(25, 'CMD-2026-25', 'En attente de validation', '2 Rue Lgafe', NULL, '33000', 'Bordeaux', '2026-10-21', '19:00:00', 4, 226.00, 0.00, 0.00, NULL, NULL, '2026-10-16 11:21:07', 9, 23),
(26, 'CMD-2026-26', 'En attente de validation', '5 Rue de la frite', NULL, '33810', 'AMBES', '2026-11-18', '20:30:00', 12, 670.90, 10.90, 0.00, NULL, NULL, '2026-11-05 17:56:20', 5, 9),
(27, 'CMD-2026-27', 'En attente de validation', 'Rue Paradis', NULL, '33530', 'BASSENS', '2026-11-18', '20:30:00', 10, 360.90, 10.90, 0.00, NULL, NULL, '2026-11-07 14:56:18', 4, 14),
(28, 'CMD-2026-28', 'En attente de validation', 'Rue de l\'église', '42', '33530', 'BASSENS', '2026-12-05', '19:30:00', 4, 162.90, 10.90, 0.00, NULL, NULL, '2026-11-07 15:15:44', 11, 14);

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `email`, `mot_de_passe_hash`, `nom`, `prenom`, `telephone`, `adresse`, `complement_adresse`, `code_postal`, `commune`, `role`, `actif`, `date_creation`) VALUES
(9, 'mprune@mail.fr', '$2y$10$z4zpd8zvcVBO4P71VKAX2uYy7U2TjGC5YXEA2gJ7UbjUgaCCFsnTC', 'Prune', 'Marie', '06.02.03.04.05', '2 rue de la liberté', 'lot 2', '13400', 'Aubagne', 'utilisateur', 1, '2026-09-11 10:23:49'),
(13, 'martinp@mail.fr', '$2y$10$B5UCMICJGeOjt4j4r.QiYeM7SI4fXuDG1TUnA47XZaCx9L9HLnw2W', 'Martin', 'Paul', '0606060606', 'Lotissement la vallée', '', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-08 10:23:49'),
(14, 'cduss@mail.fr', '$2y$10$Gr.hrztye7AxIRmW8oqlx.EaF2/kbfDVLXLY61NQO6MJC2vJ6FxpK', 'Duss', 'Claude', '0606060606', 'Chemin de la plage', '', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-09 15:56:44'),
(15, 'winchl@mail.fr', '$2y$10$dLX4Cz9Jcdp9It3UuQm0u.Svnz0tEkC3coRIGUdDV3uWJnMo6Ayn.', 'Winch', 'Largo', '06.02.03.04.05', '5 Rue de la Poste', 'ter', '33000', 'Bordeaux', 'employe', 0, '2026-10-09 16:01:59'),
(17, 'emodel@mail.fr', '$2y$10$jlL4aOhDNL3L1IwPy9r0V.xGL6CLmgDK7m9Fw/Ym79vlBCp.CBP..', 'Modele', 'Employe', '06.02.03.04.05', 'Rue du Poulet', '25', '33200', 'Caudéran', 'employe', 1, '2026-10-12 09:05:52'),
(18, 'superm@mail.fr', '$2y$10$Icnwm.RaVVdfiMG5kruUxeKzIgVla737xXOf5e4/Wzw8Q2LPylLy2', 'Super', 'Man', '0606060606', 'Route des vignes', '', '33100', 'La Bastide', 'utilisateur', 1, '2026-10-12 15:20:14'),
(19, 'ironm@mail.fr', '$2y$10$jlyTkXQiorSUtaRqKqvGMu0PXGEvScLj9/r1RQm95ZkZC/Wd97CfO', 'Iron', 'Man', '06.01.02.03.04', 'Chemin de la plage', '2 bis', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-12 15:36:15'),
(21, 'gourmandjo@mail.fr', '$2y$10$1cG9DcCbJUVC5HmucbqVYuYah.gpI/5K72SOKXmHSrNcEa9V6E.32', 'Gourmand', 'José', '06.01.02.03.04', 'Rue Latour', '', '33000', 'Bordeaux', 'admin', 1, '2026-10-13 12:05:26'),
(22, 'gourmand.f@mail.fr', '$2y$10$Ny5KJlBEIiR.Ru5NFDbcDujoJMBU4W/3/iBo99ZaYnOZa3f01DorS', 'Gourmand', 'Fleur', '07.07.08.09.04', 'Avenue de Tivoli', '16', '33110', 'Le Bouscat', 'employe', 1, '2026-10-13 12:09:05'),
(23, 'pignonf@mail.fr', '$2y$10$KvOc6QaMMtKKUgvRq.j7T.BstKLh4Po3fL7w1u37rDh.5wdzEY/pK', 'Pignon', 'François', '06.58.46.51.32', '6 Rue Lagafe', '', '33000', 'Bordeaux', 'utilisateur', 1, '2026-10-16 11:19:37'),
(24, 'dartagnanc@mail.fr', '$2y$10$KZkR/guOxxaZFyIiJvQo8.JFRPyAjAj6vJwgbvVjQRQDeziCyUJdu', 'D\'ARTAGNAN', 'Charles', '06.15.16.1718', 'Avenue Tivoli', '23', '33110', 'LE BOUSCAT', 'utilisateur', 1, '2026-11-07 15:24:25');

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
(17, 'En attente de validation', '2026-10-12 17:31:15', 23),
(18, 'En attente de validation', '2026-10-15 19:05:09', 24),
(19, 'En attente de validation', '2026-10-16 11:21:07', 25),
(20, 'Acceptée', '2026-10-20 10:56:23', 4),
(21, 'Annulée', '2026-10-20 14:16:38', 10),
(22, 'En préparation', '2026-10-20 14:56:19', 11),
(23, 'Terminée', '2026-10-31 14:21:05', 4),
(24, 'Terminée', '2026-10-31 14:28:15', 13),
(25, 'Terminée', '2026-10-31 14:32:06', 11),
(26, 'Terminée', '2026-10-31 16:40:33', 22),
(27, 'Terminée', '2026-10-31 16:40:47', 22),
(28, 'Terminée', '2026-10-31 16:40:58', 21),
(29, 'Terminée', '2026-10-31 16:41:07', 23),
(30, 'En attente de validation', '2026-11-05 17:56:20', 26),
(31, 'En attente de validation', '2026-11-07 14:56:18', 27),
(32, 'En attente de validation', '2026-11-07 15:15:44', 28),
(33, 'Terminée', '2026-11-07 15:29:02', 24),
(34, 'Terminée', '2026-11-07 15:30:29', 24),
(35, 'Terminée', '2026-11-07 16:18:38', 12),
(36, 'Terminée', '2026-11-07 16:31:43', 16),
(37, 'Terminée', '2026-11-07 16:33:12', 17),
(38, 'Terminée', '2026-11-07 16:34:26', 18),
(39, 'Acceptée', '2026-11-12 14:42:31', 14),
(40, 'Terminée', '2026-11-13 11:16:06', 19),
(41, 'Terminée', '2026-11-13 11:19:23', 20);

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id`, `jour`, `heureDebut`, `heureFin`, `ouvert`) VALUES
(1, 'Lundi', '09:00:00', '19:00:00', 1),
(2, 'Mardi', '09:00:00', '19:00:00', 1),
(3, 'Mercredi', '09:00:00', '19:00:00', 1),
(4, 'Jeudi', '09:00:00', '19:00:00', 1),
(5, 'Vendredi', '09:00:00', '19:00:00', 1),
(6, 'Samedi', '09:00:00', '13:00:00', 1),
(7, 'Dimanche', NULL, NULL, 0);

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `nomMenu`, `description`, `theme`, `nbPersonneMin`, `prix`, `conditions`, `regime`, `allergenes`, `stock`, `image`) VALUES
(3, 'Menu Saveurs de saison', 'Une cuisine raffinée aux saveurs de saison, élaborée à partir de produits frais et soigneusement sélectionnés.', 'Evénement', 6, 35, 'Conditions : Ce menu doit être commandé minimum 5 jours avant la prestation.', 'Classique', 'gluten, fruits à coque, produits laitiers.', 10, 'plat viande saveurs des saisons.jpg'),
(4, 'Menu Evasion Gourmande', 'Une sélection généreuse et savoureuse, idéale pour partager un moment convivial en famille ou entre amis.', 'Pâques', 8, 35, 'Conditions : Commander 1 semaine à l\'avance. Produits frais.', 'Classique', '', 8, 'Plat poisson menu evasion gourmande.jpg'),
(5, 'Menu Prestige', 'Une expérience gastronomique élégante, composée de produits d’exception et de créations raffinées.', 'Noël', 10, 55, 'Conditions : Commander 1 semaine à l\'avance. ', 'Classique', '', 0, 'Plat viand champêtre.jpg'),
(9, 'Menu Délices de la Mer', 'Une sélection raffinée de produits de la mer, sublimés par des accompagnements frais et savoureux. Un menu élégant et gourmand, idéal pour partager un moment convivial autour des saveurs marines.', 'Evénement', 4, 56.5, 'Conditions : Commander minimum 14 jours avant. Selon arrivage.', 'Classique', '', 4, 'Menu délices de la mer.jpg'),
(10, 'Menu Escale méditerranéenne', 'Laissez-vous séduire par les saveurs ensoleillées de la Méditerranée. Des légumes généreux, des herbes parfumées et des associations gourmandes composent ce menu végétal, idéal pour un moment convivial et plein de fraîcheur.', 'Classique', 6, 42, 'Conditions : Menus entièrement vegan : sans viande, poisson, œufs, produits laitiers, miel ni gélatine animale.', 'Vegan', '', 12, 'Menu Vegan.jpg'),
(11, 'Menu Jardin gourmand', 'Une cuisine végétarienne raffinée qui associe la douceur des légumes de saison à des saveurs généreuses et gourmandes. Des produits frais, des textures délicates et des associations savoureuses composent ce menu convivial et plein de finesse.', 'Classique', 4, 38, 'Conditions : Commande minimum 5 jours avant la prestation.', 'Végétarien', '', 6, 'Menu Jardin gourmand.jpg');

--
-- Déchargement des données de la table `menu_plat`
--

INSERT INTO `menu_plat` (`menu_id`, `plat_id`) VALUES
(3, 3),
(3, 4),
(3, 6),
(3, 7),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(9, 32),
(9, 33),
(9, 34),
(9, 35),
(9, 36),
(9, 37),
(9, 38),
(9, 39),
(9, 40),
(10, 41),
(10, 42),
(10, 43),
(10, 44),
(10, 45),
(10, 46),
(10, 47),
(10, 48),
(10, 49),
(11, 50),
(11, 51),
(11, 52),
(11, 53),
(11, 54),
(11, 55),
(11, 56),
(11, 57),
(11, 58);

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `nomPlat`, `typePlat`, `description`) VALUES
(3, 'L\'Éclat des saisons', 'Entrée', 'Salade de chèvre chaud, noix et légumes croquants.'),
(4, 'Gourmandise des saisons', 'Plat principal', 'Filet de volaille rôti, légumes de saison et jus aux herbes.'),
(6, 'Velouté du jardin', 'Entrée', 'Velouté de légumes de saison, crème légère et herbes fraîches.'),
(7, 'Feuilleté gourmand', 'Entrée', 'Feuilleté aux champignons et fondue de poireaux.'),
(9, 'Suprême de volaille', 'Plat principal', 'Suprême de poulet, pommes grenailles et sauce forestière.'),
(10, 'Pavé de veau', 'Plat principal', 'Pavé de veau, purée maison et légumes glacés.'),
(11, 'Douceur du verger', 'Dessert', 'Tarte fine aux pommes et caramel.'),
(12, 'Délice fruité', 'Dessert', 'Panna cotta à la vanille et coulis de fruits rouges.'),
(13, 'Moelleux gourmand', 'Dessert', 'Moelleux au chocolat et crème anglaise.'),
(14, 'Jardin printanier', 'Entrée', 'Asperges vertes, œuf mollet et vinaigrette citronnée.'),
(15, 'Œuf gourmand', 'Entrée', 'Œuf mimosa revisité, jeunes pousses et copeaux de parmesan.'),
(16, 'Croustillant de saison', 'Entrée', 'Feuilleté aux légumes printaniers et fromage frais.'),
(17, 'Agneau de Pâques', 'Plat principal', 'Souris d\'agneau confite, pommes grenailles et légumes printaniers.'),
(18, 'Volaille printanière', 'Plat principal', 'Suprême de volaille, risotto aux asperges et sauce crémeuse.'),
(19, 'Filet de veau', 'Plat principal', 'Filet de veau rôti, purée de carottes et jus réduit.'),
(20, 'Nid de Pâques', 'Dessert', 'Mousse au chocolat, croustillant praliné et petits œufs chocolatés.'),
(21, 'Fraîcheur printanière', 'Dessert', 'Entremets aux fruits rouges et biscuit léger.'),
(22, 'Douceur chocolatée', 'Dessert', 'Fondant au chocolat, cœur caramel et glace vanille.'),
(23, 'Éclat festif', 'Entrée', 'Foie gras mi-cuit, chutney de figues et pain brioché.'),
(24, 'Délice des sous-bois', 'Entrée', 'Ravioles aux champignons, crème légère et éclats de noisettes.'),
(25, 'Élégance marine', 'Entrée', 'Noix de Saint-Jacques poêlées, fondue de poireaux et beurre citronné.'),
(26, 'Signature Prestige', 'Plat principal', 'Filet de bœuf, sauce aux morilles et gratin dauphinois.'),
(27, 'Volaille festive', 'Plat principal', 'Suprême de volaille farci aux champignons, légumes glacés.'),
(28, 'Magret raffiné', 'Plat principal', 'Magret de canard, sauce aux fruits rouges et purée de patate douce.'),
(29, 'Bûche enchantée', 'Dessert', 'Bûche chocolat et praliné.'),
(30, 'Perle de Noël', 'Dessert', 'Entremets vanille, insert poire et croustillant spéculoos.'),
(31, 'Délice exotique', 'Dessert', 'Dôme mangue-passion et biscuit coco.'),
(32, 'Fraîcheur océane', 'Entrée', 'Tartare de saumon, avocat et citron vert.'),
(33, 'Perle marine', 'Entrée', 'Noix de Saint-Jacques poêlées, crème de petits pois.'),
(34, 'Délice iodé', 'Entrée', 'Crevettes marinées, mangue fraîche et salade croquante.'),
(35, 'Escale marine', 'Plat principal', 'Filet de cabillaud, légumes fondants et sauce citronnée.'),
(36, 'Saveur des océans', 'Plat principal', 'Pavé de saumon rôti, risotto crémeux et sauce à l\'aneth.'),
(37, 'Trésor de la mer', 'Plat principal', 'Gambas poêlées, riz parfumé et sauce coco-citronnelle.'),
(38, 'Nuage citronné', 'Dessert', 'Tartelette au citron meringuée.'),
(39, 'Douceur exotique', 'Dessert', 'Mousse coco, cœur mangue-passion.'),
(40, 'Chocolat marin', 'Dessert', 'Moelleux au chocolat et coulis de fruits rouges.'),
(41, 'Soleil de Provence', 'Entrée', 'Tartare de tomates, concombre, olives et basilic.'),
(42, 'Croustillant du Sud', 'Entrée', 'Feuilleté aux légumes du soleil et crème végétale aux herbes.'),
(43, 'Douceur méditerranéenne', 'Entrée', 'Houmous maison, légumes croquants et pain pita vegan.'),
(44, 'Escale du soleil', 'Plat principal', 'Aubergine farcie aux légumes, lentilles et herbes fraîches.'),
(45, 'Risotto provençal', 'Plat principal', 'Risotto aux tomates confites, courgettes et basilic.'),
(46, 'Voyage végétal', 'Plat principal', 'Tajine de légumes, pois chiches et semoule aux épices douces.'),
(47, 'Délice des agrumes', 'Dessert', 'Tartelette citron-amande à la crème végétale.'),
(48, 'Douceur coco', 'Dessert', 'Panna cotta au lait de coco et coulis de mangue.'),
(49, 'Gourmandise chocolatée', 'Dessert', 'Fondant au chocolat noir et crème végétale à la vanille.'),
(50, 'Douceur du terroir', 'Entrée', 'Tarte fine au chèvre frais, tomates confites et basilic.'),
(51, 'Fraîcheur printanière', 'Entrée', 'Salade de jeunes pousses, poire, noix et bleu.'),
(52, 'Velours forestier', 'Entrée', 'Velouté de champignons et copeaux de parmesan.'),
(53, 'Harmonie végétale', 'Plat principal', 'Risotto crémeux aux champignons, parmesan et noisettes.'),
(54, 'Délice du potager', 'Plat principal', 'Ravioles ricotta-épinards, crème légère aux herbes.'),
(55, 'Soleil gourmand', 'Plat principal', 'Lasagnes aux légumes grillés, mozzarella et basilic.'),
(56, 'Nuage gourmand', 'Dessert', 'Mousse au chocolat noir et fruits rouges.'),
(57, 'Douceur vanillée', 'Dessert', 'Crème brûlée à la vanille.'),
(58, 'Tendre gourmandise', 'Dessert', 'Tiramisu traditionnel au café et cacao.');

--
-- Déchargement des données de la table `plat_allergene`
--

INSERT INTO `plat_allergene` (`plat_id`, `allergene_id`) VALUES
(3, 2),
(3, 5),
(3, 10),
(4, 11),
(6, 5),
(7, 6),
(9, 5),
(10, 5),
(11, 5),
(11, 6),
(12, 5),
(13, 5),
(13, 12),
(14, 12),
(15, 5),
(15, 12),
(16, 5),
(16, 6),
(18, 5),
(20, 2),
(20, 5),
(20, 12),
(21, 5),
(21, 6),
(21, 12),
(22, 5),
(22, 6),
(22, 12),
(23, 5),
(23, 6),
(23, 12),
(24, 2),
(24, 5),
(24, 6),
(25, 5),
(25, 7),
(26, 5),
(29, 2),
(29, 5),
(29, 6),
(29, 12);

--
-- Déchargement des données de la table `token_mdp`
--

INSERT INTO `token_mdp` (`id`, `token`, `date_creation`, `date_expiration`, `compte_id`) VALUES
(9, 'd7281ce8f55c35eb0dd39e8002c0c3ea3f77400e01a7ddd632142e35f53adf1f', '2026-11-13 14:12:18', '2026-11-13 15:12:18', 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
