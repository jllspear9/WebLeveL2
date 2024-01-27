-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 22 déc. 2023 à 14:06
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `navette`
--
CREATE DATABASE IF NOT EXISTS `navette` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `navette`;

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`date`) VALUES
('2023-12-05'),
('2023-12-07'),
('2023-12-12'),
('2023-12-14'),
('2023-12-19'),
('2023-12-21');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `horaireDep` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`horaireDep`) VALUES
('8h00'),
('9h30-10h'),
('17h00'),
('19h-19h30');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `numLieu` bigint(20) NOT NULL,
  `nomLieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`numLieu`, `nomLieu`) VALUES
(1, 'Pau – parking Cap Sud'),
(2, 'Aire de covoiturage de Lescar (Emmaüs)'),
(3, 'Entrée/sortie d’autoroute d’Orthez'),
(4, 'Aire de covoiture d’IKEA – Bayonne Nord'),
(5, 'Bayonne – campus de la Nive'),
(6, 'Anglet Montaury');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `numUtil` bigint(20) NOT NULL,
  `numTrajet` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `numTrajet` bigint(20) NOT NULL,
  `dateTrajet` date NOT NULL,
  `lieuDepart` varchar(50) NOT NULL,
  `lieuArrivee` varchar(50) NOT NULL,
  `horaireDepart` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `numUtil` bigint(20) NOT NULL,
  `loginUtil` varchar(50) NOT NULL,
  `mdpUtil` varchar(50) NOT NULL,
  `nomUtil` varchar(50) NOT NULL,
  `prenomUtil` varchar(50) NOT NULL,
  `telPortable` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `typeUtil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`numUtil`,`numTrajet`),
  ADD KEY `numTrajet` (`numTrajet`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`numTrajet`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`numUtil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `numTrajet` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `numUtil` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`numUtil`) REFERENCES `UTILISATEUR` (`numUtil`),
  ADD CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`numTrajet`) REFERENCES `TRAJET` (`numTrajet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
