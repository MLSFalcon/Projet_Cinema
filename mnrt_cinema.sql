-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 10 jan. 2025 à 09:48
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mnrt_cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(50) COLLATE latin1_bin NOT NULL,
  `explication` varchar(50) COLLATE latin1_bin NOT NULL,
  `ref_user` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `FK_contact_user` (`ref_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE latin1_bin NOT NULL,
  `resume` varchar(50) COLLATE latin1_bin NOT NULL,
  `genre` varchar(50) COLLATE latin1_bin NOT NULL,
  `duree` time NOT NULL,
  `image` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `nb_place` int(11) DEFAULT NULL,
  `ref_user` int(11) NOT NULL,
  `ref_seance` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `FK_reservation_utilisateur` (`ref_user`),
  KEY `FK_reservation_seance` (`ref_seance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(11) NOT NULL,
  `nb_place` int(11) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id_seance` int(11) NOT NULL AUTO_INCREMENT,
  `date_seance` date NOT NULL,
  `heure` time NOT NULL,
  `ref_salle` int(11) NOT NULL,
  `ref_film` int(11) NOT NULL,
  `nb_place_dispo` int(11) NOT NULL,
  PRIMARY KEY (`id_seance`),
  KEY `FK_seance_salle` (`ref_salle`),
  KEY `FK_seance_film` (`ref_film`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE latin1_bin NOT NULL,
  `prenom` varchar(50) COLLATE latin1_bin NOT NULL,
  `email` varchar(50) COLLATE latin1_bin NOT NULL,
  `mdp` varchar(50) COLLATE latin1_bin NOT NULL,
  `role` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_contact_user` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_reservation_seance` FOREIGN KEY (`ref_seance`) REFERENCES `seance` (`id_seance`),
  ADD CONSTRAINT `FK_reservation_utilisateur` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `FK_seance_film` FOREIGN KEY (`ref_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `FK_seance_salle` FOREIGN KEY (`ref_salle`) REFERENCES `salle` (`id_salle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
