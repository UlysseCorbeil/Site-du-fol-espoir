-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 09 oct. 2018 à 21:47
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_fol_espoir`
--
CREATE DATABASE IF NOT EXISTS `bd_fol_espoir` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_fol_espoir`;

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE `administrateurs` (
  `idAdmin` int(10) UNSIGNED NOT NULL,
  `sLoginAdmin` varchar(255) NOT NULL,
  `sPwdAdmin` varchar(255) NOT NULL,
  `sCourrielAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`idAdmin`, `sLoginAdmin`, `sPwdAdmin`, `sCourrielAdmin`) VALUES
(1, 'cmartin', 'cmartin', 'cm@cm.qc.ca');

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE `auteurs` (
  `idAuteur` int(10) UNSIGNED NOT NULL,
  `sNomAuteur` varchar(255) NOT NULL,
  `sPrenomAuteur` varchar(255) NOT NULL,
  `sCourrielAuteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`idAuteur`, `sNomAuteur`, `sPrenomAuteur`, `sCourrielAuteur`) VALUES
(1, 'Zola', 'Émile', 'ezola@cm.qc.ca'),
(2, 'Hugo', 'Victor', 'hv@cm.qc.ca');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `idMedia` int(10) UNSIGNED NOT NULL,
  `sTitreMedia` varchar(255) NOT NULL DEFAULT 'sans titre',
  `sUrlMedia` varchar(255) NOT NULL,
  `enumTypeMedia` enum('image/gif','image/jpeg','image/png','audio/x-wav','audio/mpeg3','audio/x-mpeg-3', 'audio/ogg') NOT NULL,
  `sMotsClefs` varchar(255) NOT NULL,
  `bAccepte` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `dateMedia` date NOT NULL,
  `iNoAuteur` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`idMedia`, `sTitreMedia`, `sUrlMedia`, `enumTypeMedia`, `sMotsClefs`, `bAccepte`, `dateMedia`, `iNoAuteur`) VALUES
(1, 'sans titre', 'url.jpg', 'image/jpeg', '#amitie', 0, '2018-10-01', 2);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `idPage` int(10) UNSIGNED NOT NULL,
  `sTitrePage` varchar(255) NOT NULL,
  `sTextePage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`idPage`, `sTitrePage`, `sTextePage`) VALUES
(1, 'À propos', 'Le texte de À propos');

-- --------------------------------------------------------

--
-- Structure de la table `textes`
--

DROP TABLE IF EXISTS `textes`;
CREATE TABLE `textes` (
  `idTexte` int(10) UNSIGNED NOT NULL,
  `sTitreTexte` varchar(255) NOT NULL DEFAULT 'sans titre',
  `sTexte` longtext NOT NULL,
  `sNomCategorie` enum('essai','poésie','récit','théâtre','inclassable') NOT NULL DEFAULT 'inclassable',
  `sMotsClefs` varchar(255) NOT NULL,
  `bAccepte` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `dateTexte` date NOT NULL,
  `iNoAuteur` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `textes`
--

INSERT INTO `textes` (`idTexte`, `sTitreTexte`, `sTexte`, `sNomCategorie`, `sMotsClefs`, `bAccepte`, `dateTexte`, `iNoAuteur`) VALUES
(1, 'sans titre', 'qqqq', 'inclassable', '#amour', 0, '2018-10-09', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`idAuteur`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `iNoAuteur` (`iNoAuteur`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`idPage`),
  ADD UNIQUE KEY `sTitrePage` (`sTitrePage`);

--
-- Index pour la table `textes`
--
ALTER TABLE `textes`
  ADD PRIMARY KEY (`idTexte`),
  ADD KEY `iNoAuteur` (`iNoAuteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `idAdmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `idAuteur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `idMedia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `idPage` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `textes`
--
ALTER TABLE `textes`
  MODIFY `idTexte` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`iNoAuteur`) REFERENCES `auteurs` (`idAuteur`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `textes`
--
ALTER TABLE `textes`
  ADD CONSTRAINT `textes_ibfk_1` FOREIGN KEY (`iNoAuteur`) REFERENCES `auteurs` (`idAuteur`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
