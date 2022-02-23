-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 fév. 2022 à 16:33
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) DEFAULT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(3) NOT NULL,
  `id_commande` int(3) DEFAULT NULL,
  `id_produit` int(3) DEFAULT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `ville` varchar(20) NOT NULL,
  `code_postal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
(13, 'Admin', '$2y$10$OwQ7qgU.u2LCbgJ6hfhQHe8eBrSJpZV/fRcLFh2aqZKzhnRaNLHP2', 'Lebron', 'Julien', 'admin@gmail.com', 'm', 'Jettes', 01090, '30 Avenue Broustin', 1),
(14, 'Adrianouche', '$2y$10$GyOoqR2j1L6rB6UTIciN1eEMYdJUudqR964/3kD9p0irfK1vo/ZR6', 'Gonzalez', 'Adriana', 'A.gonzalez@gmail.com', 'f', 'Jettes', 01090, '30 Avenue Broustin', 0),
(15, 'Coco77', '$2y$10$rRD/lWS1V0xUlTyNhwcyweMbLa0YSv0UtP9JEVnDn.Yi4Vgr5.tp2', 'Garcia', 'Corentin', 'coco77@gmail.com', 'm', 'Meaux', 77100, '90 Avenue du G&eacute;n&eacute;ral Leclerc', 0),
(16, 'GegeLapince', '$2y$10$tLKvGQRKD68CpDr6Lu4uAubdGZE0f6n.45OuWvZV.1jdS/oVfAGpK', 'Lorain', 'G&eacute;rome', 'lapince@gmail.com', 'm', 'Paris', 75012, '60 rue de l\'ancienne &eacute;glise', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `taille` varchar(5) NOT NULL,
  `public` enum('m','f','mixte') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `prix` int(3) NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
(1, 'dd-001', 'Basket', 'Adidas Model 1', 'Magnifique Basket Adidas Model 1', 'Blanc', 'M', 'mixte', '/site/photo/dd-001_adidas_model_1.jpg', 49, 10),
(3, 'dd-002', 'Basket', 'Adidas Model 2', 'Magnifique paire de basket Adidas Model 2', 'Gris', 'S', 'f', '/site/photo/dd-002_adida_model_2_.jpg', 39, 10),
(4, 'dd-003', 'Basket', 'Adidad Model 3', 'Magnifique paire de basket Adidas Model 3', 'Orange', 'L', 'mixte', '/site/photo/dd-003_adidad_model_3.jpg', 59, 10),
(5, 'dd-004', 'Veste', 'Veste Model 1', 'Magnifique Veste Model 1', 'Blanc', 'M', 'm', '/site/photo/dd-004_veste_model_1.jpg', 119, 10),
(6, 'dd-005', 'Veste', 'Veste Model 2', 'Magnifique Veste Model 2', 'Noir', 'L', 'm', '/site/photo/dd-005_veste_model_2.jpg', 99, 10),
(7, 'dd-006', 'Veste', 'Veste Model 3', 'Magnifique Veste Model 3', 'Orange', 'M', 'm', '/site/photo/dd-006_veste_model_3.jpg', 129, 5),
(8, 'dd-007', 'Basket', 'Nike Model 1', 'Magnifique paire de basket Nike Model 1', 'Noir', 'S', 'mixte', '/site/photo/dd-007_nike_model_1.jpg', 69, 10),
(9, 'dd-008', 'Basket', 'Nike Model 2', 'Magnifique Paire de basket Nike Model 2', 'Orange', 'M', 'f', '/site/photo/dd-008_nike_model_2.jpg', 129, 10),
(10, 'dd-009', 'Basket', 'Nike Model 3', 'Magnifique Paire de Basket Nike Model 3 Blanc', 'Blanc', 'XL', 'mixte', '/site/photo/dd-009_nike_model_3.jpg', 139, 10),
(11, 'dd-010', 'Tshirt', 'Tshirt Model 1', 'Magnifique Tshirt Model 1', 'Noir', 'S', 'm', '/site/photo/dd-010_t_shirt_model_1.jpg', 29, 10),
(12, 'dd-011', 'Tshirt', 'Tshirt Model 2', 'Magnifique Tshirt Model 2', 'Noir', 'M', 'm', '/site/photo/dd-011_t_shirt_model_2.jpg', 49, 10),
(13, 'dd-012', 'Tshirt', 'Tshirt Model 3', 'Magnifique Tshirt Model 3', 'Blanc', 'L', 'mixte', '/site/photo/dd-012_t_shirt_model_3.jpg', 39, 10),
(15, 'dd-013', 'Tshirt', 'Tshirt Model 4', 'Magnifique Tshirt Model 4', 'Bleu', 'M', 'm', '/site/photo/dd-013_t_shirt_model_4.jpg', 19, 5),
(16, 'dd-014', 'Pull', 'Pull Model 1', 'Magnifique Pull Model 1', 'Gris', 'XL', 'm', '/site/photo/dd-014_pull_model_1jpg.jpg', 159, 2),
(17, 'dd-015', 'Bonnet', 'Bonnet Model 1', 'Magnifique bonnet model 1 qui tiens bien chaud !', 'Beige', 'M', 'f', '/site/photo/dd-015_bonnet_model_1.jpg', 29, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
