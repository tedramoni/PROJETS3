-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 22 Novembre 2014 à 19:19
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `code_client` varchar(15) NOT NULL,
  `adr1` varchar(50) NOT NULL,
  `adr2` varchar(50) NOT NULL,
  `adr3` varchar(50) NOT NULL,
  `cp` int(6) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `tel_bur` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `site_web` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL,
  UNIQUE KEY `code_client` (`code_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `code` varchar(15) NOT NULL,
  `forme_juridique` varchar(50) NOT NULL,
  `raison_sociale` varchar(100) NOT NULL,
  `nom_commercial` varchar(100) NOT NULL,
  `mode_reglement` varchar(50) NOT NULL,
  `echeance` int(11) NOT NULL,
  `fdm` tinyint(1) NOT NULL,
  `jour` int(1) NOT NULL,
  `remise` int(11) NOT NULL,
  `info_comp` varchar(500) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `code` varchar(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `civilite` varchar(10) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `tel_bur` int(20) NOT NULL,
  `tel_mob` int(20) NOT NULL,
  `fax` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code_client` varchar(15) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `code_client` (`code_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livre_or`
--

CREATE TABLE IF NOT EXISTS `livre_or` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(400) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_TIMESTAMP,
  `pseudo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Contenu de la table `livre_or`
--

INSERT INTO `livre_or` (`id`, `titre`, `texte`, `date`, `pseudo`) VALUES
(76, 'Salut', 'Hey, wassup?  :wink:', '2014-11-22 16:45:41', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `password`, `email`) VALUES
(1, 'root', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'root@ikonic.com');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `contrainte_existance` FOREIGN KEY (`code_client`) REFERENCES `client` (`code`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contrainte_contact` FOREIGN KEY (`code_client`) REFERENCES `client` (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
