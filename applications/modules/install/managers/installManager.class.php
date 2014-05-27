<?php
	
/**
* file for the install manager
* @author cyril bazin 
* @package cu.install
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\install\managers;

/**
* install manager
*/
class installManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'install' ;
	}
	
	/**
	 * delete
	 * execute a query "delete" with a filter on id
	 * @param int id of the row to deleted
	 */
	public function addDb()
	{
		$this->db->exec("
-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 13 Mai 2014 à 19:08
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `aem`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Politiques');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `forums`
--

INSERT INTO `forums` (`id`, `instances`, `users`, `title`, `creationdate`) VALUES
(20, 49, 17, 'QSD', '0000-00-00'),
(19, 49, 17, 'aze', '0000-00-00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `forumsanswers`
--

INSERT INTO `forumsanswers` (`id`, `forums`, `title`, `users`, `creationdate`, `descr`) VALUES
(46, 20, 'QSD', 17, '0000-00-00 00:00:00', ' QSD'),
(45, 19, '222', 17, '0000-00-00 00:00:00', ' 222'),
(44, 19, '111', 17, '0000-00-00 00:00:00', ' 111'),
(43, 19, 'zer', 17, '0000-00-00 00:00:00', 'ZER'),
(41, 19, 'aze', 17, '0000-00-00 00:00:00', ' qsd'),
(48, 19, '444', 17, '0000-00-00 00:00:00', ' 444'),
(49, 20, '555', 17, '0000-00-00 00:00:00', ' 555');

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
  `users` int(11) DEFAULT NULL,
  `categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `instances`
--

INSERT INTO `instances` (`id`, `name`, `descr`, `image`, `deadline`, `users`, `categories`) VALUES
(49, 'Instance de discussion numÃ©ro UNE', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in enim non mi tincidunt tincidunt at ac ante. Morbi accumsan, arcu eu pharetra lobortis, velit lorem tempus justo, vel pellentesque augue ante a nunc. Nulla sagittis lorem vitae urna euismod pulvinar. Suspendisse egestas id dui nec adipiscing. Curabitur eu lobortis mauris. Ut mattis bibendum quam, quis laoreet augue porttitor nec. Donec quis dictum sem. Proin dictum non est a cursus. Ut et purus ut augue volutpat auctor ut ac ante. Nam posuere neque ac risus posuere condimentum. Pellentesque adipiscing varius tellus a iaculis. Vivamus condimentum odio sit amet magna fermentum, vitae egestas mauris adipiscing.</p>\r\n<p>&nbsp;</p>\r\n<p>Fusce volutpat accumsan sagittis. Maecenas ac massa eget mi cursus egestas a sed mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent molestie a magna sodales aliquet. Aenean accumsan feugiat ipsum eget lobortis. Quisque eu ipsum in erat adipiscing sagittis eu id dolor. Etiam pulvinar lacus et velit suscipit pellentesque. Ut ac suscipit mi, at cursus dui. Quisque adipiscing ullamcorper tincidunt. Mauris sit amet quam sapien. Sed vestibulum pretium volutpat. Nullam accumsan lectus eu lectus lobortis, vel consequat odio auctor. Ut eleifend rutrum tellus, sit amet vestibulum elit aliquam sit amet. Proin scelerisque augue et nulla scelerisque facilisis. Vestibulum ultricies arcu sed risus lacinia suscipit.</p>\r\n<p>&nbsp;</p>\r\n<p>Phasellus lacinia vehicula dictum. Aenean eu lectus et purus vestibulum imperdiet. Mauris porttitor elit at varius scelerisque. Nam eu odio tristique, fringilla eros at, ultricies enim. Proin vel ultricies felis. Aenean magna lectus, faucibus sit amet tempus non, bibendum non arcu. Aenean euismod augue et magna interdum, id ultricies massa consectetur. Phasellus adipiscing tellus quis orci condimentum, interdum viverra velit tempus. Donec pretium, nulla eu euismod auctor, turpis dolor adipiscing dui, non porttitor nisl sapien eu orci. Nam quis egestas ligula, quis iaculis magna.</p>\r\n<p>&nbsp;</p>\r\n<p>Aliquam imperdiet commodo sapien, vitae scelerisque turpis elementum et. Duis malesuada, mauris at viverra lobortis, enim justo vehicula sem, at lobortis erat lorem sed odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla non rutrum tellus. Etiam eget pharetra dolor. Sed euismod ante non purus sagittis pellentesque. Fusce sit amet dignissim nulla. Mauris id est velit. Quisque eu lorem eu diam interdum condimentum. Cras sit amet dolor tincidunt, facilisis urna et, tincidunt augue.</p>', 'logoInstance.jpg', '21/05/2014', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `active`, `level`, `creationDate`) VALUES
(17, 'admin', '6-Asmodai', 'admin@admin.net', 1, 7, '10/01/2014');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `instances`, `users`, `name`, `descr`) VALUES
(28, 49, 17, 'Vote numÃ©ro UN', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu tortor interdum, faucibus justo a, laoreet nulla. Maecenas tempus congue eros varius dapibus. Aliquam sollicitudin ante erat, ut pellentesque dolor auctor sed. Curabitur eu gravida augue, a sollicitudin mauris. Vestibulum sit amet sapien ut mauris cursus scelerisque. Vivamus at vulputate orci. Duis iaculis molestie eleifend. Quisque eu lorem commodo leo vehicula aliquet a non erat. Sed eleifend nisi a quam posuere, id tempor lectus dapibus. Sed dolor quam, hendrerit in lacinia eu, blandit non dui.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed mi mauris, commodo vitae velit sed, gravida feugiat leo. Donec eu dolor vel nibh interdum vulputate. Cras at porta odio, aliquet interdum tellus. Nunc tortor risus, fringilla non erat non, lacinia malesuada urna. Donec a venenatis nunc. Cras consequat arcu in velit pellentesque rhoncus tristique vel nibh.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu tortor interdum, faucibus justo a, laoreet nulla. Maecenas tempus congue eros varius dapibus. Aliquam sollicitudin ante erat, ut pellentesque dolor auctor sed. Curabitur eu gravida augue, a sollicitudin mauris. Vestibulum sit amet sapien ut mauris cursus scelerisque. Vivamus at vulputate orci. Duis iaculis molestie eleifend. Quisque eu lorem commodo leo vehicula aliquet a non erat. Sed eleifend nisi a quam posuere, id tempor lectus dapibus. Sed dolor quam, hendrerit in lacinia eu, blandit non dui. Sed mi mauris, commodo vitae velit sed, gravida feugiat leo. Donec eu dolor vel nibh interdum vulputate. Cras at porta odio, aliquet interdum tellus. Nunc tortor risus, fringilla non erat non, lacinia malesuada urna. Donec a venenatis nunc. Cras consequat arcu in velit pellentesque rhoncus tristique vel nibh.</p>');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `votesusers`
--

INSERT INTO `votesusers` (`id`, `votes`, `users`, `values`) VALUES
(1, 28, 17, -1),
(2, 28, 19, -1),
(3, 28, 18, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
				
				
		");
		
		
		
			
	}
	
	
}

?>