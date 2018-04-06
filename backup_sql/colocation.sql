-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 03:51 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `colocation`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce_logement`
--

CREATE TABLE IF NOT EXISTS `annonce_logement` (
  `num_annonce_logement` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `adresse` text NOT NULL,
  `prix` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `debut_disponibilite` date NOT NULL,
  `fin_disponibilite` date NOT NULL,
  `nb_personne` int(11) NOT NULL,
  `num_personne_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_annonce_logement`),
  KEY `num_personne_ID` (`num_personne_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `annonce_logement`
--

INSERT INTO `annonce_logement` (`num_annonce_logement`, `titre`, `description`, `adresse`, `prix`, `surface`, `debut_disponibilite`, `fin_disponibilite`, `nb_personne`, `num_personne_ID`) VALUES
(10, 'Appartement 4 pièces vue mer', 'Bonjour,\r\n\r\nJe met à disposition un appartement vue mer, qui peut accueillir 3 étudiants dans 3 chambre dédiés.\r\nLe prix indiqué est pour chaque étudiant.', 'Jacque Lieutot Chemin des coussinet 06600 ANTIBES', 500, 120, '2018-02-08', '2019-07-20', 3, 2),
(11, 'Maison 6 chambres', 'Bonjour,\r\n\r\nNous mettons à disposition une maison de 350m² avec piscine, pouvant accueil 6 étudiants. \r\nChaque demande sera étudié minutieusement.\r\nPrix: 800€ par étudiants', '856 chemin des dinosaures 06100 NICE', 800, 350, '2017-11-10', '2020-07-18', 6, 2),
(12, 'Appartement 3 pièces 60m² avec terrasse', 'Bonjour,\r\n\r\nNous vous proposons un appartement, d''une superficie de 60m² proche situé en plein centre ville.\r\nContactez nous pour plus d''information.', '985 chemin des figues', 400, 60, '2018-04-01', '2019-06-30', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `num_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `mdp` text NOT NULL,
  PRIMARY KEY (`num_personne`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`num_personne`, `nom`, `prenom`, `email`, `mdp`) VALUES
(2, 'ATTAL', 'Michaela', 'michaelattal06fr@gmail.com', '$2y$13$82FEmzj72RT81TvPagarbe5AGzGHZ.ph9hTp/opmMKQLurasHCPfC'),
(3, 'Pelestor', 'Valentin', 'infectedgame69@gmail.com', '$2y$13$JgFFLBpSTcFAphWtIScU4.H8c80dpTbd8JM..Z.xeaWOGiEHawmmW');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonce_logement`
--
ALTER TABLE `annonce_logement`
  ADD CONSTRAINT `annonce_logement_ibfk_1` FOREIGN KEY (`num_personne_ID`) REFERENCES `personne` (`num_personne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
