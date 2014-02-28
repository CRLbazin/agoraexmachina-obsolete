-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Ven 28 Février 2014 à 16:12
-- Version du serveur: 5.6.11-log
-- Version de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `aem`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Politique'),
(2, 'Technique'),
(3, 'Fanny');

-- --------------------------------------------------------

--
-- Structure de la table `instances`
--

CREATE TABLE IF NOT EXISTS `instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `users` int(11) NOT NULL,
  `categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `instances`
--

INSERT INTO `instances` (`id`, `name`, `descr`, `image`, `deadline`, `users`, `categories`) VALUES
(24, 'validation des projets', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lacus pulvinar, aliquam arcu sed, semper lorem. Pellentesque sit amet dignissim urna. Donec a libero eget velit porttitor feugiat. Aliquam varius nibh sit amet condimentum viverra. Pellentesque turpis purus, lacinia et egestas nec, vestibulum id nulla. Sed consequat ultricies mi, non vehicula nulla. Aenean eu orci sit amet erat posuere sagittis a sed arcu. Curabitur quam nisl, sagittis ut velit vitae, pharetra lobortis dolor. Quisque porttitor interdum molestie. Duis at malesuada orci.</p>\r\n<p>&nbsp;</p>\r\n<p>Etiam consectetur, purus id vehicula luctus, dolor felis eleifend turpis, ut fermentum dui dolor eget nisl. Pellentesque vitae arcu quis arcu congue vulputate. Sed eros nibh, sagittis at fermentum a, sagittis sit amet neque. In tortor nisl, gravida a libero tristique, pharetra convallis nulla. Quisque faucibus velit mi, tincidunt pulvinar lacus bibendum vitae. Nam in tortor nec sapien rhoncus volutpat. Donec eu lacus mollis arcu facilisis dictum. Duis et cursus neque. Vestibulum arcu odio, posuere quis ullamcorper ut, rutrum at dui. Pellentesque condimentum aliquet erat, eget bibendum augue iaculis eget. Vivamus tempus libero a lorem molestie mollis. Quisque quis quam vitae enim sodales pulvinar. Aenean id cursus nisi. Vivamus elementum porttitor aliquam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed ante eros, imperdiet a tortor ac, auctor ultrices orci. Aenean facilisis mattis neque, quis pellentesque magna hendrerit non. Sed rutrum dui et pretium sodales. Aliquam tempus elit eget purus condimentum, malesuada auctor metus sollicitudin. Etiam lacus ligula, tincidunt vitae augue vulputate, congue porttitor mi. Donec fringilla molestie neque, et sagittis risus ullamcorper ac. Maecenas pharetra dolor at dui pulvinar, non tincidunt nibh rhoncus. Cras turpis ligula, condimentum id varius vel, dictum sit amet nulla.</p>\r\n<p>&nbsp;</p>\r\n<p>Quisque tincidunt lacus purus, a dignissim massa blandit eget. Duis in viverra dui, at consequat elit. Nullam aliquet quam semper rutrum mattis. Maecenas at neque ipsum. Vivamus egestas justo libero, nec pharetra justo mollis vel. Phasellus in arcu gravida, dictum erat at, pharetra urna. Duis pretium varius condimentum. Phasellus pulvinar diam eu libero vestibulum ullamcorper. Fusce a elit libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce feugiat iaculis odio, eu ullamcorper diam fermentum sed. Maecenas dictum aliquam imperdiet.</p>\r\n<p>&nbsp;</p>\r\n<p>Nullam auctor massa mi, non dapibus justo malesuada nec. Ut at eros sed eros vehicula porta eu eget risus. Nunc eu volutpat lorem. Pellentesque faucibus, magna et iaculis scelerisque, orci felis tristique tortor, eget placerat lorem urna quis mi. In hac habitasse platea dictumst. Etiam risus augue, lacinia ut turpis et, accumsan iaculis enim. Phasellus vel eros porta, sodales nibh egestas, accumsan metus. Mauris ut nisi erat. Duis lectus elit, pretium at augue quis, porta ornare lacus. Aliquam sodales quis lectus vitae cursus. Mauris interdum tellus at enim malesuada lacinia. Curabitur id viverra orci. Aliquam sagittis, ipsum et lobortis varius, nisl elit vulputate sapien, a viverra quam velit non odio. Duis viverra, mauris in bibendum egestas, leo massa vehicula orci, et commodo sem mauris quis ipsum.</p>', '951AA545.jpg', '30/01/2014', 17, 1);

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
  `creationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `active`, `level`, `creationDate`) VALUES
(17, 'admin', '6-Asmodai', 'admin@admin.net', 1, 8, '10/01/2014'),
(19, 'bazin', '6-Asmodai', 'crlbazin@gmail.com', 1, 1, '13/01/2014');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `instances`, `users`, `name`, `descr`) VALUES
(25, 24, 17, 'aze', 'une instance de test pour valider le bon fonctionnement du systÃ¨me');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
