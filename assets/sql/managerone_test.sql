-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 26 juin 2021 à 16:56
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `managerone_test`
--

-- --------------------------------------------------------
drop database if exists managerone_test;
create database managerone_test;
use managerone_test;
--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `IdT` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('Tache realiser','Tache en cours','Tache non commencer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdT`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`IdT`, `User_id`, `Title`, `Description`, `Date`, `Status`) VALUES
(1, 4, 'YassineE', 'Ajout edit', '2021-07-24 23:40:43', 'Tache realiser'),
(2, 3, 'Test', 'Edit unitaire', '2021-07-24 23:40:43', 'Tache en cours'),
(3, 2, 'Test', 'Suppression', '2021-07-24 23:40:43', 'Tache realiser'),
(4, 1, 'Ajout verif', 'Non', '2021-07-24 23:40:43', 'Tache non commencer'),
(5, 5, 'Test', 'Test', '2021-07-24 23:40:43', 'Tache en cours'),
(8, 3, 'Test', 'Test', '2021-06-26 03:20:15', 'Tache non commencer'),
(9, 1, 'Test', 'Non', '2021-06-26 03:20:26', 'Tache non commencer'),
(13, 3, 'Hmmm', 'Non', '2021-06-26 03:44:29', 'Tache non commencer'),
(14, 2, 'But', 'eff', '2021-06-26 18:54:11', 'Tache non commencer');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`) VALUES
(1, 'Yassine', 'enissay999@gmail.com'),
(2, 'bloq', 'enisasay999@gmail.com'),
(3, '  edit', 'enisszay999@gmail.com'),
(4, ' verif', 'eniessay999@gmail.com'),
(5, 'Test', 'Test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
