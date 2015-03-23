-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 21 Mars 2015 à 11:41
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
-- Structure de la table `factures`
--

CREATE TABLE IF NOT EXISTS `factures` (
  `num_facture` int(11) NOT NULL AUTO_INCREMENT,
  `num_bl` int(11),
  `date` date NOT NULL,
  `date_echeance` date NOT NULL,
  `ref_client` varchar(100) NOT NULL,
  `ref_fournisseur` varchar(100) NOT NULL,
  `code_client` varchar(20) NOT NULL,
  `nom_commercial` varchar(50) NOT NULL,
  `mode_reglement` varchar(30) NOT NULL,
  `info_comp` varchar(200) NOT NULL,
  `type_expedition` varchar(100) NOT NULL,
  `nbre_colis` int(11) NOT NULL,
  `acompte` float NOT NULL,
  `poids_total` float NOT NULL,
  `volume_total` float NOT NULL,
  `adr1_L` varchar(50) NOT NULL,
  `adr2_L` varchar(50) NOT NULL,
  `adr3_L` varchar(50) NOT NULL,
  `cp_L` int(6) NOT NULL,
  `ville_L` varchar(50) NOT NULL,
  `pays_L` varchar(50) NOT NULL,
  `tel_bureau_L` varchar(20) NOT NULL,
  `email_L` varchar(100) NOT NULL,
  `site_web_L` varchar(100) NOT NULL,
  `adr1_F` varchar(50) NOT NULL,
  `adr2_F` varchar(50) NOT NULL,
  `adr3_F` varchar(50) NOT NULL,
  `cp_F` int(6) NOT NULL,
  `ville_F` varchar(50) NOT NULL,
  `pays_F` varchar(50) NOT NULL,
  `tel_bureau_F` varchar(20) NOT NULL,
  `email_F` varchar(100) NOT NULL,
  `site_web_F` varchar(100) NOT NULL,
  `liste_articles` varchar(500) NOT NULL,
  `prix_ttc` float NOT NULL,
  `prix_ht` float NOT NULL,
  `raison_sociale` varchar(100) NOT NULL,
  PRIMARY KEY (`num_facture`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150001 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
