-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 02 Octobre 2016 à 12:32
-- Version du serveur: 5.5.52-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `timhub`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbillet`
--

CREATE TABLE IF NOT EXISTS `tbillet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `auteur` text NOT NULL,
  `contenu` text NOT NULL,
  `allocineId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `tbillet`
--

INSERT INTO `tbillet` (`id`, `titre`, `auteur`, `contenu`, `allocineId`) VALUES
(2, 'Arnaques, Crimes & Botanique', 'auteur', 'contenu', 19298),
(3, 'The Wolf of Wall Street', 'auteur', 'contenu', 127524),
(4, 'Django Unchained', 'auteur', 'contenu', 190918),
(5, 'Pulp Fiction', 'auteur', 'contenu', 10126),
(6, 'Le Parrain', 'auteur', 'contenu', 1628),
(7, 'Snatch', 'auteur', 'contenu', 26251),
(8, 'Billet 7', 'auteur', 'contenu', 31057),
(9, 'Billet 8', 'auteur', 'contenu', 58525),
(10, 'Billet 9', 'auteur', 'contenu', 70544),
(11, 'Billet 10', 'auteur', 'contenu', 619),
(12, 'Billet 11', 'auteur', 'contenu', 18598),
(13, 'Billet 12', 'auteur', 'contenu', 106082),
(14, 'Billet 13', 'auteur', 'contenu', 29785),
(15, 'Billet 14', 'auteur', 'contenu', 176961),
(16, 'Billet 15', 'tim', 'olala le contenu', 16463);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` varchar(75) NOT NULL,
  `password` text NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_visit` timestamp NULL DEFAULT NULL,
  `avatar` text,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `nom`, `prenom`, `mail`, `password`, `date_inscription`, `last_visit`, `avatar`, `admin`) VALUES
(1, 'tim', 'Chapelle', 'Timothee', 'tim@tchapelle.be', '63a9f0ea7bb98050796b649e85481845', '2016-09-15 12:02:34', '2016-10-01 18:54:02', 'default_module.jpg', 1),
(2, 'timo', 'Chapelle', 'Timothee', 'tim@tchapelle.be', 'f7403c8161d3901030bbf678452a3eeb', '2016-09-15 12:18:06', NULL, NULL, 0),
(3, 'timi', 'Timo', 'Chapelle', 'horace22@gmail.com', '2367a880cbbf1ff448cd6da3b0e38f56', '2016-09-15 15:17:41', NULL, 'default_space.jpg', 0),
(5, 'orom', 'orom', 'baba', 'baba@orom.com', 'fc96d31d5d014553dcc7b33b8ebce65a', '2016-09-17 17:28:16', NULL, '220x220-jpg.jpg', 0),
(6, 'root', 'root', 'root', 'root@root.root', '63a9f0ea7bb98050796b649e85481845', '2016-09-19 09:52:21', '2016-09-30 08:08:32', 'default_module.jpg', 1),
(11, 'TIMOS', 'TIMOS', 'TIMOS', 'TIMOS@TIMOS.TM', '0ac31d9505f2785a559918263d4ba0ce', '2016-09-19 14:13:19', NULL, 'Gantry-fond.png', 0),
(12, 'ZORRO', 'ZORRO', 'ZORRO', 'ZO@ZO.ZO', 'b7888ee1d8b078fa000b09c818478126', '2016-09-19 14:16:43', NULL, 'default_user.jpg', 0),
(13, 'toto', 'toto', 'toto', 'toto@toto.to', 'f71dbe52628a3f83a77ab494817525c6', '2016-09-19 14:30:03', NULL, 'default_space.jpg', 0),
(14, 'abcdef', 'def', 'abcde', 'abc@def.com', 'e80b5017098950fc58aad83c8c14978e', '2016-09-25 21:54:26', NULL, 'logoln.png', 0),
(15, 'cinephil', 'phil', 'cine', 'cine@phil.ph', '2b272af73cb46fa32f05e4c9fc103160', '2016-09-26 13:08:26', NULL, 'default_user.jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
