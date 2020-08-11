-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 25 Janvier 2020 à 17:47
-- Version du serveur :  8.0.18-0ubuntu0.19.10.1
-- Version de PHP :  7.3.11-0ubuntu0.19.10.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `MORVAN`
--

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mdp` char(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `cp` varchar(25) DEFAULT NULL,
  `rue` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contenu de la table `Clients`
--

INSERT INTO `Clients` (`id`, `pseudo`, `mdp`, `email`, `ville`, `cp`, `rue`) VALUES
(1, 'test2', 'ad0234829205b9033196ba818f7a872b', 'test2@test.com', 'Laval', '53000', 'ESIEA');

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `ID_Commande` int(11) NOT NULL,
  `ID_Client` int(20) DEFAULT NULL,
  `ID_Facture` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Details_Commandes`
--

CREATE TABLE `Details_Commandes` (
  `ID_Details_Commande` int(3) NOT NULL,
  `ID_Commande` int(3) DEFAULT NULL,
  `ID_Produit` int(3) DEFAULT NULL,
  `Quantite_Produit` int(3) NOT NULL,
  `Prix_Produit` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Produits`
--

CREATE TABLE `Produits` (
  `ID_Produit` int(11) NOT NULL,
  `Nom_Produit` varchar(100) NOT NULL,
  `ID_Categorie` int(50) NOT NULL,
  `Image_Produit` varchar(45) NOT NULL,
  `Description_Produit` text NOT NULL,
  `Prix_Produit` int(10) NOT NULL,
  `Quantite_Produit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contenu de la table `Produits`
--

INSERT INTO `Produits` (`ID_Produit`, `Nom_Produit`, `ID_Categorie`, `Image_Produit`, `Description_Produit`, `Prix_Produit`, `Quantite_Produit`) VALUES
(1, 'Antipuces pour chats', 1, 'antipuces.jpeg', 'Cet antipuce est au top de nos produits actuellement. Vous ne pouvez pas trouvez mieux ailleurs', 20, 30),
(2, 'Arbre à Chat', 1, 'arbre-a-chat.jpg', 'Cet arbre à chat unique va permettre à votre petit animal de ne plus abimer vos fauteuils et de ne plus vous embêter avec des pelotes qui trainent partout.', 300, 12),
(3, 'Bambou', 2, 'bambou.jpg', 'Ces petits morceaux de bambou vont permettre à vos animaux exotiques de pouvoir se nourrir pleinement lors de tous les moments de la journée. Notre bambou vient tout droit d\'Amérique Latine cultivés par nos précieux partenaires.', 50, 100),
(4, 'Cacahuètes', 2, 'cacahuetes.png', 'Nos cacahuètes viennent tout droit de milieux tropicales près du Mexique. Elles sont excellentes et très appréciées de nos petits rongeurs.', 30, 50),
(5, 'Cage pour hamster', 1, 'cage-hamster.jpg', 'Cette cage pour hamster comprend de nombreux gadgets et accessoires que votre petit rongeur pourrait raffoler. Cette cage est très grande et peut permettre au petit animal d\'y fonder sa famille sans aucun soucis d\'espace.', 150, 10),
(6, 'Croquettes pour chien', 2, 'croquettes-chien.jpg', 'Il s\'agit de croquettes pour tout chiens. Poids : 10Kg.', 40, 20),
(7, 'Gamelle pour Chat', 1, 'gamelle-chat.jpeg', 'Cette gamelle pour chat est en acier inoxydable et possède un anti-dérapant. Cet anti-dérapant protège également des planchers de bois franc.', 15, 30),
(8, 'Gamelle pour Chien', 1, 'gamelle-chien.jpeg', 'Cette gamelle pour chien a été conçu en acier inoxydable et possède un anti-dérapant.', 15, 30),
(9, 'Graines pour oiseaux', 2, 'graines.jpeg', 'Comprend des boulettes de suif (insectes, pommes, arachides et baies), des vers de farine géants, de l’avoine nue et des flocons d’avoine nue, des raisins secs, des cœurs de tournesol, du millet, du maïs concassé, des noix hachées, de l’huile de soja et du blé. Sac de 5Kg.', 25, 30),
(10, 'Herbe à chat', 2, 'herbe-a-chat.jpg', 'Ces paquets de graines d\'herbe à chat favorisent la digestion de l\'animal et augmentent la fibre végétale. Les chats domestiques au ventre sensible sont favorisés car cela previent la formation de boules de poils dans l\'estomac du chat. Sac de 20Kg.', 15, 30),
(11, 'Poisson', 2, 'poisson.jpg', 'Notre poisson frais nous provient tout droit de nos partenaires. Poids : 3Kg', 15, 30),
(12, 'Shampoing pour chat', 1, 'shampoing.jpeg', 'Contient 250mL. Ce shampoing permet la brillance du poil de votre chat et empêche les démangeaisons.', 15, 40),
(13, 'Shampoing pour chien', 1, 'shampoing-chien.jpeg', 'Contient 250mL. Ce shampoing permet la brillance du pelage de votr chien. A été conçu pour tous pelages, il s\'agit également d\'un démêlant.', 20, 50),
(14, 'Souris en plastique', 1, 'souris-plastique.jpg', 'Cette souris en peluche apportera beaucoup de plaisir et d\'énergie à vos animaux de compagnie ce qui leur permettra d\'être plus argiles.', 10, 30),
(15, 'Vermifuge pour vos animaux', 1, 'vermifuge.jpg', 'Ce vermifuge anti-parasitaire est 100% naturel pour tous vos animaux domestiques. Elimine les vers, ascaris, ankylostome, trichocéphale et ténia.', 21, 30),
(16, 'Viande pour chien', 2, 'viande.jpeg', 'Cette viande pour chien adulte permet une bonne digestion et favorise une peau et un pelage sains. Pas de conservateur ajouté. Poids : 2Kg', 20, 50);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`ID_Commande`);

--
-- Index pour la table `Details_Commandes`
--
ALTER TABLE `Details_Commandes`
  ADD PRIMARY KEY (`ID_Details_Commande`);

--
-- Index pour la table `Produits`
--
ALTER TABLE `Produits`
  ADD PRIMARY KEY (`ID_Produit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `ID_Commande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Details_Commandes`
--
ALTER TABLE `Details_Commandes`
  MODIFY `ID_Details_Commande` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Produits`
--
ALTER TABLE `Produits`
  MODIFY `ID_Produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
