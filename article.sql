-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 29 Décembre 2014 à 21:32
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(30) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `famille` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prix_ht` float NOT NULL,
  `tva` float NOT NULL,
  `prix_achat` float NOT NULL,
  `nbre_stock` int(11) NOT NULL,
  `volume` float NOT NULL,
  `poids` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `ref`, `libelle`, `famille`, `prix_ht`, `tva`, `prix_achat`, `nbre_stock`, `volume`, `poids`) VALUES
(10, 'IKC-IPIR20/13', 'Cam&eacute;ra IP CMOS 1000 TVL', 'Cam&eacute;ra IP', 55, 20, 30, 41, 1, 1),
(11, 'IKD-C30', 'Speed Dome affichage LCD', 'Speed Dome', 51, 20, 116, 61, 1, 2),
(12, 'IKD-C30FFF', 'fsdfsdfi', 'Cam&eacute;ra analogique', 12, 24, 12, 6, 12, 12),
(13, 'IKE-04N41P', 'NVR Linux D&eacute;tection de mouvement, manuel, alarme, plage horaire', 'NVR', 125, 20, 80, 10, 1, 1),
(14, 'IKE-64N6E', 'NVR Linux, i3 / i5 CPU, 4GO RAM', 'NVR', 469, 20, 380, 30, 1, 35),
(15, 'IKE-64N78', 'NVR H.264 Triple Flux (Enregistrement, Lan/Internet, Mobile)', 'NVR', 419, 20, 350, 48, 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
