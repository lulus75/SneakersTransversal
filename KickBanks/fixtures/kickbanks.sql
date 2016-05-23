-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 22 Mai 2016 à 23:19
-- Version du serveur: 5.5.49-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `kickbanks`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_article` datetime NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_url1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_url2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_url3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` datetime NOT NULL,
  `bid_price` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=193 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `id_user`, `id_article`, `description`, `date_article`, `nickname`, `price`, `marque`, `article_url1`, `article_url2`, `article_url3`, `end_time`, `bid_price`, `winner_id`, `etat`, `couleur`, `title`) VALUES
(188, 6, 6, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui ', '2016-05-22 23:07:41', 'jean02', 140, 'airforce', 'assets/uploads/sneakers6.jpg', 'assets/uploads/sneakers5.jpg', 'assets/uploads/sneakers1.jpg', '2016-05-23 23:07:41', 60, NULL, 'neuf', 'blanc marron noir', 'Adidas vlneo'),
(189, 6, 6, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui ', '2016-05-22 23:08:26', 'jean02', 90, 'adidas', 'assets/uploads/téléchargement (2).jpg', 'assets/uploads/sneakers1.jpg', 'assets/uploads/sneakers2.jpg', '2016-05-23 23:08:26', 40, NULL, 'Commeneuf', 'blanc jaune bleu', 'Adidas superstar'),
(190, 7, 7, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui ', '2016-05-22 23:09:39', 'jacque', 230, 'nike', 'assets/uploads/sneakers6.jpg', 'assets/uploads/sneakers1.jpg', 'assets/uploads/sneakers3.jpg', '2016-05-26 23:09:39', 120, NULL, 'neuf', 'blanc rouge', 'Nike AirMax'),
(191, 7, 7, 'Asics classique', '2016-05-22 23:10:24', 'jacque', 205, 'asics', 'assets/uploads/sneakers5.jpg', 'assets/uploads/téléchargement (2).jpg', 'assets/uploads/sneakers1.jpg', '2016-05-28 23:10:24', 130, NULL, 'neuf', 'jaune orange', 'asics classique'),
(192, 7, 7, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui ', '2016-05-22 23:11:35', 'jacque', 109, 'puma', 'assets/uploads/sneakers6.jpg', 'assets/uploads/sneakers5.jpg', 'assets/uploads/sneakers1.jpg', '2016-05-25 23:11:35', 78, NULL, 'neuf', 'blanc noir', 'puma fast cat');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_commentaire` date NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE IF NOT EXISTS `enchere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE IF NOT EXISTS `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Contenu de la table `marque`
--

INSERT INTO `marque` (`id`, `marque`, `logo_url`) VALUES
(1, 'airforce', 'airForce.png'),
(2, 'adidas', 'adidas.png'),
(3, 'asics', 'asics.png'),
(4, 'converse', 'converse.png'),
(5, 'diadora', 'diadora.png'),
(6, 'jordan', 'jordan.png'),
(7, 'karhu', 'karhu.png'),
(8, 'lacoste', 'lacoste.png'),
(9, 'lecoqsportif', 'lecoqsportif.png'),
(10, 'newbalance', 'newbalance.png'),
(11, 'nike', 'nike.png'),
(12, 'nikesb', 'nikesb.png'),
(13, 'puma', 'puma.png'),
(14, 'reebook', 'reebook.png'),
(15, 'vans', 'vans.png'),
(16, 'veja', 'veja.png'),
(17, 'yeezy', 'yeezy.png'),
(18, 'air force', 'airForce.png'),
(19, 'adidas', 'adidas.png'),
(20, 'asics', 'asics.png'),
(21, 'converse', 'converse.png'),
(22, 'diadora', 'diadora.png'),
(23, 'jordan', 'jordan.png'),
(24, 'karhu', 'karhu.png'),
(25, 'lacoste', 'lacoste.png'),
(26, 'lecoqsportif', 'lecoqsportif.png'),
(27, 'newbalance', 'newbalance.png'),
(28, 'nike', 'nike.png'),
(29, 'nikesb', 'nikesb.png'),
(30, 'puma', 'puma.png'),
(31, 'reebook', 'reebook.png'),
(32, 'vans', 'vans.png'),
(33, 'veja', 'veja.png'),
(34, 'yeezy', 'yeezy.png');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_recepteur` int(11) NOT NULL,
  `content_message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_message` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `tchat`
--

CREATE TABLE IF NOT EXISTS `tchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_msg` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nickname`, `email`, `password`, `password2`, `firstname`, `lastname`) VALUES
(6, 'jean02', 'jean-pierre@hotmail.fr', '5854087f936d028e8336babb355df0ee2a3405f5', '5854087f936d028e8336babb355df0ee2a3405f5', 'Jean', 'Pierre'),
(7, 'jacque', 'pierrep@hotmail.fr', '5854087f936d028e8336babb355df0ee2a3405f5', '5854087f936d028e8336babb355df0ee2a3405f5', 'pierre', 'paul');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
