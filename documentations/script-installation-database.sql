-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Octobre 2014 à 17:32
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `agoraexmachina`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sizeW` varchar(50) NOT NULL,
  `sizeH` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `delegations`
--

CREATE TABLE IF NOT EXISTS `delegations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users1` int(11) DEFAULT NULL,
  `users2` int(11) DEFAULT NULL,
  `categories` int(11) DEFAULT NULL,
  `instances` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Structure de la table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instances` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `creationdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `forumsanswers`
--

CREATE TABLE IF NOT EXISTS `forumsanswers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forums` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `users` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  `descr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Structure de la table `instances`
--

CREATE TABLE IF NOT EXISTS `instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `users` int(11) DEFAULT NULL,
  `categories` int(11) NOT NULL,
  `whoCanSeeTheInstance` varchar(255) NOT NULL,
  `whoCanVote` varchar(255) NOT NULL,
  `whoCanWriteVote` varchar(255) NOT NULL,
  `typeOfDelegation` varchar(255) NOT NULL,
  `quorumRequired` varchar(255) NOT NULL,
  `voteAccountingMethod` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `instancesusers`
--

CREATE TABLE IF NOT EXISTS `instancesusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whoCanSeeTheInstance` tinyint(1) NOT NULL,
  `whoCanVote` tinyint(1) NOT NULL,
  `whoCanWriteVote` tinyint(1) NOT NULL,
  `instances` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `creationDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instances` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Structure de la table `votesusers`
--

CREATE TABLE IF NOT EXISTS `votesusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votes` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `values` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
