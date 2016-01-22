-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 22 Janvier 2016 à 21:47
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `iut_projet_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realisateur` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `prix_location` float NOT NULL,
  `acteur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id`, `realisateur`, `title`, `categorie`, `prix_location`, `acteur`) VALUES
(17, 'Chris Columbus', 'Harry Potter à l''école des sorciers', 'Fantastique', 5, 'Daniel Radcliffe, Emma Watson, Rupert Grint'),
(20, 'James Van', 'Fast and Furious 7', 'Action', 7, 'Vin Diesel');

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

CREATE TABLE IF NOT EXISTS `louer` (
  `id_film` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_location` date NOT NULL,
  `duree` date NOT NULL,
  KEY `fk_film_id_film` (`id_film`),
  KEY `fk_users_id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `user_firstname` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `pass_word`, `user_firstname`, `mail`, `isAdmin`) VALUES
(1, 'admin', 'bdbd6db1d8cc09a957e86180fda9442a', 'admin', 'admin@film.location.fr', 1),
(2, 'phan', '172522ec1028ab781d9dfd17eaca4427', 'david', 'david_phan@hotmail.fr', 0),
(3, 'lahmourate', 'c36d6e43044252ab121a52138e5aacb0', 'achraf', '', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `louer`
--
ALTER TABLE `louer`
  ADD CONSTRAINT `fk_users_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_film_id_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
