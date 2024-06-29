-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 29 juin 2022 à 20:24
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tabiblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `auteurs` text NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `type_doc` text NOT NULL,
  `ecole` text NOT NULL,
  `tels` text NOT NULL,
  `fichier_doc` text NOT NULL,
  `apercu_doc` text NOT NULL,
  `m_memoire` text NOT NULL,
  `m_stage` text NOT NULL,
  `mention` text NOT NULL,
  `theme` text NOT NULL,
  `filiere` text NOT NULL,
  `annee` text NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `validated_at` datetime DEFAULT NULL,
  `validated_by` text DEFAULT NULL,
  `info_sup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`info_sup`)),
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  PRIMARY KEY (`id_document`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_document`, `auteurs`, `auteur_id`, `type_doc`, `ecole`, `tels`, `fichier_doc`, `apercu_doc`, `m_memoire`, `m_stage`, `mention`, `theme`, `filiere`, `annee`, `description`, `created_at`, `validated_at`, `validated_by`, `info_sup`, `metadata`) VALUES
(4, 'Ham & Bor', 10, 'Mémoire', 'Olofofo', '2456321568', '/uploads/documents/62bc4af774c1b-Menu-Jus-Dim.pdf', '/uploads/apercus/62bc4af774ff9-Herbecine.jpg', 'Boris', 'Hamid', 'Honnorable', 'Memoire En Ligne', 'Agronomie', '2022', 'Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. Lorem ipsum dolar si ummer amet. ', '2022-06-29 16:21:00', NULL, 'Olofofo', NULL, NULL),
(5, 'Ham & Bor sss', 10, 'Mémoire', 'Olofofo', '5896532478', '/uploads/documents/62bc997e37e35-DOCOUN-Accord-de-Confidentialite-de-non-divulgation.docx', '/uploads/apercus/62bc997e3869c-avatar (2).png', 'Bor', 'Ahy', 'Honnorable', 'Agroo', 'Agroeconomie', '2022', 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum ', '2022-06-29 00:00:00', '2022-06-29 19:55:24', 'Olofofo', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

DROP TABLE IF EXISTS `ecole`;
CREATE TABLE IF NOT EXISTS `ecole` (
  `id_ecole` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `libelle` text NOT NULL,
  `mdp` text NOT NULL,
  `email` text NOT NULL,
  `logo` text NOT NULL,
  `token` text DEFAULT NULL,
  `info_sup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_ecole`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id_ecole`, `nom`, `libelle`, `mdp`, `email`, `logo`, `token`, `info_sup`, `metadata`) VALUES
(9, 'Olofofo', 'Info', 's', 'ham@gmail.com', '../uploads/ecole/62bc89097c3f9-leaves.png', 'c1ebe933584d6df801ed1ffc13c705242e8409f94ced842c7a0de16756d8c707', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `internaute`
--

DROP TABLE IF EXISTS `internaute`;
CREATE TABLE IF NOT EXISTS `internaute` (
  `id_internaute` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mdp` text NOT NULL,
  `tel` text NOT NULL,
  `email` text NOT NULL,
  `photo` text NOT NULL,
  `token` text DEFAULT NULL,
  `info_sup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_internaute`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `internaute`
--

INSERT INTO `internaute` (`id_internaute`, `nom`, `prenom`, `mdp`, `tel`, `email`, `photo`, `token`, `info_sup`, `metadata`) VALUES
(10, 'Kpetre', 'Hamid', 's', '5', 'kpetreh@gmail.com', '/uploads/internaute/62bc12f14ac94-WhatsApp Image 2022-06-18 at 17.06.10.jpeg', '8471568856a42f2eaa6686c39c00e1f173013a74ada81552bc9bac993e1e9034', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
