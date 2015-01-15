
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 14 Janvier 2015 à 20:00
-- Version du serveur: 5.1.61
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `u157965635_ikc`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`u157965635_root`@`localhost` PROCEDURE `SP_RAISE_ERROR`(IN P_ERROR VARCHAR(256))
BEGIN
    DECLARE V_ERROR VARCHAR(300);
    SET V_ERROR := CONCAT('[ERROR: ', P_ERROR, ']');
    INSERT INTO `TBL_DUMMY` VALUES (V_ERROR);
END$$

DELIMITER ;

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
  `tel_bur` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `site_web` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL,
  `index` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index`),
  KEY `index` (`index`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`code_client`, `adr1`, `adr2`, `adr3`, `cp`, `ville`, `pays`, `tel_bur`, `email`, `site_web`, `type`, `index`) VALUES
('9C0001', '10 rue Raspail', '', '', 75007, 'Paris', 'France', '01 69 20 22 22 ', 'info@carrefour.fr', '', 'L', 81),
('9C0002', '5 rue de ze', 'ze', 'ze', 75001, 'Paris', 'ze', '0145124578', 'ze', 'ze', 'F', 54),
('9c0001', '5 rue de Nantes', '', '', 75001, 'Paris', 'France', '01 45 68 88 99', 'test@cora.fr', 'cora.fr', 'L', 42),
('9C0001', '1/3', 'Avenue du Général Sarrail', '', 75016, 'Paris', 'Paris', '01 69 20 22 22 ', 'paris_auteuil@carrefour.fr', 'https://paris-auteuil.magasins.carrefour.fr/', 'F', 3),
('9C0002', 'SH 944', '85', 'rue du port', 92728, 'Nanterre', 'France', '0145124578', 'cardif@bnp.fr', 'http://www.cardif.fr/', 'L', 4),
('9C0002', '18', 'rue du commerce', '', 75015, 'Paris', 'France', '', 'cardif@bnp.fr', 'http://www.cardif.fr/', 'F', 6),
('9M0001', '12', 'Avenue des pommiers', '', 92145, 'Clamart', 'France', '0145781245', 'malik@zouhiri.fr', 'zouhiri.fr', 'F', 12),
('9M0001', '125', 'Avenue du Général Sarrail', '', 92145, 'Clamart', 'France', '0145781245', 'malik@zouhiri.fr', 'zouhiri.fr', 'L', 11),
('9s0001', '5 rue de Nantes', '', '', 35000, 'Rennes', 'France', '02 99 48 57 88', 'econtact@space.fr', '', 'L', 46),
('9S0002', 'xxxxx', '', '', 91120, 'Palaiseau', 'France', '01 44 55 66 78', 'contact@securitesys.fr', '', 'L', 82),
('9s0001', '5 bd. Paris', '', '', 75016, 'Paris', 'france', '02 99 48 57 88', 'compta@space.fr', '', 'F', 47);

--
-- Déclencheurs `adresse`
--
DROP TRIGGER IF EXISTS `max_adresse`;
DELIMITER //
CREATE TRIGGER `max_adresse` BEFORE INSERT ON `adresse`
 FOR EACH ROW BEGIN
    Declare n integer;
    Declare i integer;
    SELECT COUNT( * ) into n FROM adresse WHERE code_client = NEW.code_client AND type = 'L';
    SELECT COUNT( * ) into i FROM adresse WHERE code_client = NEW.code_client AND type = 'F';    
    IF n >= 20 THEN           
	CALL SP_RAISE_ERROR ('Un client ne peut avoir plus de 20 adresses de livraisons.');
    END IF;    
    IF i >= 5 THEN           
	CALL SP_RAISE_ERROR ('Un client ne peut avoir plus de 5 adresses de facturations');
    END IF;    
END
//
DELIMITER ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `ref`, `libelle`, `famille`, `prix_ht`, `tva`, `prix_achat`, `nbre_stock`, `volume`, `poids`) VALUES
(10, 'IKC-IPIR20/13', 'Caméra IP CMOS 1000 TVL', 'Caméra IP', 55, 20, 30, 40, 1, 1),
(11, 'IKD-C30', 'Speed Dome affichage LCD', 'Speed Dome', 51, 20, 116, 61, 1, 2),
(34, 'IKC-TEST-STOCK', 'test stock', 'Caméra analogique', 40, 20, 5, 215, 5, 5),
(13, 'IKE-04N41P', 'NVR Linux Detection de mouvement, manuel, alarme, plage horaire', 'NVR', 150, 20, 80, 25, 1, 1),
(14, 'IKE-64N6E', 'NVR Linux, i3 / i5 CPU, 4GO RAM', 'NVR', 469, 20, 380, 35, 1, 35),
(15, 'IKE-64N78', 'NVR H.264 Triple Flux (Enregistrement, Lan/Internet, Mobile)', 'NVR', 419, 20, 350, 48, 1, 6),
(21, 'IKC-BNC75/M', 'Fiche BNC male', 'Accessoire', 0.5, 20, 0.4, 12, 0.5, 0.5),
(36, 'IKA-04HA', 'DVR 4 voies, H.264, analogique', 'DVR', 120, 20, 0, 150, 0, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`code`, `forme_juridique`, `raison_sociale`, `nom_commercial`, `mode_reglement`, `echeance`, `fdm`, `jour`, `remise`, `info_comp`) VALUES
('9C0001', 'S.A', 'Carrefour', 'WANG', 'Virement', 20, 0, 0, 15, 'credit de 5000€, le 26/12/14'),
('9C0002', 'Collectivité', 'Cardif', 'RAMONI', 'Carte Bancaire', 30, 0, 1, 0, ''),
('9M0001', 'S.A', 'Micromania', 'COUDRAY', 'Carte Bancaire', 20, 1, 10, 15, 'Cherche souvent a avoir des prix plus bas.'),
('9J5648', 'S.A', 'Samsung', 'AZZA', 'Carte bancaire', 0, 0, 0, 0, ''),
('9s0001', 'S.A', 'SPACE', 'david', 'Carte Bancaire', 0, 0, 1, 0, ''),
('9C0005', 'S.A', 'CORA', 'Paul', 'Virement', 30, 0, 1, 0, ''),
('9N2811', 'Collectivité', 'Collectivité des entreprises', 'JOHN', 'Carte bancaire', 0, 0, 0, 0, ''),
('9S0002', 'S.AR.L', 'Securite Systeme', 'ANNE SOPHIE', 'Carte bancaire', 0, 0, 0, 0, 'franco port');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `code` varchar(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `civilite` varchar(10) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `tel_bur` varchar(20) NOT NULL,
  `tel_mob` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code_client` varchar(6) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`code`, `nom`, `civilite`, `fonction`, `tel_bur`, `tel_mob`, `fax`, `email`, `code_client`) VALUES
('DUP', 'Dupond Sophie', 'MMe', 'gerante', '', '06 66 77 88 99', '', 'sd@carrefour.fr', '9C0001'),
('F01', 'Lombardi', 'M', 'Aviateur', '0612457964', '0145127845', '0978451245', 'falco@lombardi.fr', '9C0002'),
('Z01', 'Zouhiri', 'M', 'Chercheur', '92145', 'Clamart', 'France', 'malik@zouhiri.fr', '9M0001'),
('BGA', 'GATE', 'M', 'CEO', '999478658', '999564235', '4568531', 'bgates@outlook.fr', '9J5648');

--
-- Déclencheurs `contact`
--
DROP TRIGGER IF EXISTS `max_contact`;
DELIMITER //
CREATE TRIGGER `max_contact` BEFORE INSERT ON `contact`
 FOR EACH ROW BEGIN
   Declare n integer;
   SELECT COUNT( * ) into n FROM contact WHERE code_client = NEW.code_client;
   IF n >= 3 THEN           
   CALL SP_RAISE_ERROR ('Un client ne peut avoir plus de 3 contacts.');
   END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `livre_or`
--

CREATE TABLE IF NOT EXISTS `livre_or` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(400) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Contenu de la table `livre_or`
--

INSERT INTO `livre_or` (`id`, `titre`, `texte`, `date`, `pseudo`) VALUES
(113, 'test', ' test msg  :smile:', '2014-11-23 14:39:28', 'root'),
(76, 'Salut', 'Hey, wassup?  :wink:', '2014-11-22 16:45:41', 'root'),
(131, 'QuestionnaireMystique', ' http://www35.zippyshare.com/v/39693972/file.html', '2015-01-05 10:49:51', 'root'),
(133, 'Tp9Se', ' http://www52.zippyshare.com/v/97687105/file.html', '2015-01-07 11:49:46', 'root');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `password`, `email`) VALUES
(1, 'root', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'root@ikonic.com');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `nbre_entree` int(11) NOT NULL,
  `nbre_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`id`, `ref`, `date`, `nbre_entree`, `nbre_stock`) VALUES
(3, 'IKC-GFKDEP', '2015-01-16', 24, 24),
(5, 'IKC-IPIR20/13', '2014-12-04', 10, 40),
(7, 'IKC-IPIR20/13', '2014-10-25', 20, 40),
(8, 'IKC-ZAKIEDSR', '2015-01-08', 50, 50),
(9, 'IKC-ZAKIEDSR', '2015-01-08', 50, 50),
(10, 'IKC-TEST', '2015-01-12', 10, 10),
(11, 'IKC-TEST', '2015-01-01', 200, 200),
(12, 'IKC-ZAKIE58', '2015-01-13', 1500, 1500),
(13, 'IKC-ZAKIE', '2015-01-13', 24, 24),
(14, 'IKC-TESTT', '2015-01-14', 23, 23),
(15, 'IKC-TEST', '2015-01-12', 25, 25),
(16, 'IKC-TEST', '2015-01-14', 24, 24),
(17, 'IKC-TEST', '2015-01-22', 25, 25),
(18, 'IKC-TEST', '2015-01-22', 25, 25),
(19, 'IKC-TEST', '2015-01-22', 25, 25),
(20, 'IKC-ZAKIE', '2015-01-13', 21, 21),
(21, 'IKC-ZAKIE', '2015-01-31', 500, 500),
(22, 'IKC-ZAKIE', '2015-01-31', 500, 500),
(23, 'IKC-ZAKIE', '2015-01-31', 500, 500),
(24, 'IKC-TEST23', '2015-01-14', 35, 35),
(25, 'IKC-TEST-STOCK', '2015-01-01', 50, 215),
(26, 'IKC-TEST-STOCK', '2015-01-02', 20, 215),
(27, 'IKC-TESTMODIF', '2015-01-10', 150, 151),
(28, 'IKC-TEST-STOCK', '2015-01-03', 10, 215),
(29, 'IKC-TESTMODIF', '2015-01-13', 1, 151),
(30, 'IKE-64N6E', '2015-01-13', 5, 35),
(31, 'IKC-TEST-STOCK', '2015-01-14', 100, 215),
(32, 'IKC-TEST-STOCK', '2015-01-16', 35, 215),
(33, 'IKE-04N41P', '2015-01-13', -5, 25),
(34, 'IKC-IPIR20/13', '2015-01-13', -1, 40),
(35, 'IKE-04N41P', '2015-01-14', 20, 25),
(36, 'IKA-04HA', '2015-01-14', 100, 150),
(37, 'IKA-04HA', '2015-01-15', 50, 150),
(38, 'IKC-TEST6', '2015-01-14', 25, 30),
(39, 'IKC-TEST6', '2015-01-15', 5, 30);

-- --------------------------------------------------------

--
-- Structure de la table `TBL_DUMMY`
--

CREATE TABLE IF NOT EXISTS `TBL_DUMMY` (
  `error` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déclencheurs `TBL_DUMMY`
--
DROP TRIGGER IF EXISTS `TRIG_BI_DUMMY`;
DELIMITER //
CREATE TRIGGER `TRIG_BI_DUMMY` BEFORE INSERT ON `TBL_DUMMY`
 FOR EACH ROW BEGIN
    SET NEW = NEW.`error`;
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
