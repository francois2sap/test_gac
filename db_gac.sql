-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 27 jan. 2019 à 19:14
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_gac`
--

-- --------------------------------------------------------

--
-- Structure de la table `appels`
--

DROP TABLE IF EXISTS `appels`;
CREATE TABLE IF NOT EXISTS `appels` (
  `num_compte` varchar(10) NOT NULL COMMENT 'Compte facture',
  `num_fac` varchar(10) NOT NULL COMMENT 'Numero de facture',
  `num_abo` varchar(10) NOT NULL COMMENT 'Numero abonne',
  `date` date NOT NULL COMMENT 'date',
  `heure` time NOT NULL COMMENT 'heure',
  `temps_appel` float NOT NULL COMMENT 'duree/volume reel',
  `temps_facture` float NOT NULL COMMENT 'duree/volume facture',
  `type` text NOT NULL COMMENT 'type'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Details des appels';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
