-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Mai 2020 à 10:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pistache_menagere`
--

-- --------------------------------------------------------

--
-- Structure de la table `distribution`
--

CREATE TABLE IF NOT EXISTS `distribution` (
  `task_id` int(11) NOT NULL,
  `user_login` varchar(40) NOT NULL,
  `home` varchar(30) NOT NULL,
  PRIMARY KEY (`task_id`,`user_login`),
  KEY `fk2_distribution` (`user_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Structure de la table `distribution_home`
--

CREATE TABLE IF NOT EXISTS `distribution_home` (
  `home` varchar(30) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `ban` tinyint(1) DEFAULT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`home`,`user_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `home`
--

CREATE TABLE IF NOT EXISTS `home` (
  `home` varchar(30) NOT NULL,
  `admin` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `reset_points` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`home`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `home`
--



--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `type` char(40) NOT NULL,
  `jour` date NOT NULL,
  `heure` time NOT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `home` varchar(30) NOT NULL,
  `points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;



--
-- Structure de la table `task_sort`
--

CREATE TABLE IF NOT EXISTS `task_sort` (
  `user_login` varchar(30) NOT NULL,
  `my_missions` int(11) DEFAULT '0',
  `today` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `home` varchar(30) NOT NULL,
  PRIMARY KEY (`user_login`,`home`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(40) CHARACTER SET latin1 NOT NULL,
  `point` int(11) DEFAULT '0',
  `password` varchar(70) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
