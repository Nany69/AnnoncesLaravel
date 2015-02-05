-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 19 Septembre 2014 à 15:49
-- Version du serveur: 5.5.38-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `freeads`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `prix` int(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `description`, `photo1`, `photo2`, `photo3`, `prix`, `created_at`, `updated_at`, `user_id`) VALUES
(14, '14', '14', 'menu.png', 'moi1.jpg', NULL, 14, '2014-09-17 11:14:43', '2014-09-17 11:14:43', 0),
(15, 'Iphone 5 S NEUF 32go', 'À vendre iPhone 5s NEUF, encore sous garantie .<br>\r\nAvec câble, chargeur, écouteurs .... <br>\r\nPayement via PayPal uniquement\r\n', '24k-gold-iphone-5s-640x414.jpg', 'iphone1.jpg', 'iphone2__5_.jpg', 350, '2014-09-18 07:01:06', '2014-09-18 07:01:06', 1),
(17, '250 KTM  a bibi', 'du culLorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.', 'iphone1.jpg', '13_KTM_250_SO_1.jpg', NULL, 2000, '2014-09-19 09:40:05', '2014-09-19 07:40:05', 1),
(27, 'Deuxieme annonce du cul', 'du culLorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nam exercitationem aspernatur distinctio totam fugiat illo necessitatibus, provident eius adipisci consequatur mollitia. Magni quisquam, maxime odit esse, modi at voluptates.', 'accueil.png', 'Capture du 2014-05-13 18:53:22.png', 'Capture du 2014-06-20 09:45:16.png', 55, '2014-09-18 18:19:33', '2014-09-18 16:19:33', 37),
(28, 'Jonas a bikrave', 'Jonas pas chere trkl', 'menu.png', NULL, NULL, 250, '2014-09-19 11:39:26', '2014-09-19 11:39:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'utilisateur'),
(2, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `remember_token` int(11) NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `role_id`, `remember_token`, `confirmation_code`, `confirmed`) VALUES
(1, 'root', '$2y$10$/r/4DIZVun9p7uCFuwE.c..jP2dODB9bWjUqCXv2h5iHJlYO1svrK', 'root@rout.fr', '2014-09-17 05:31:38', '2014-09-18 17:11:08', 1, 0, '', 1),
(3, 'Martin', '$2y$10$nuHFPvXUWGU5rjM1ZoFwD.4SnwTGbXYtKiX3jq/KzXIRcRxj1y/S2', 'martin_AT_exemple.fr', '2014-09-08 20:39:32', '2014-09-16 15:00:32', 1, 0, '', 1),
(4, 'Lefevre', '$2y$10$t0/N9S3q58d5S766GMGoDuY25k8yh.SsamadyLd9elJaTjb/VODiW', 'lefevre_AT_exemple.fr', '2014-09-08 20:39:32', '2014-09-16 15:00:32', 1, 0, '', 1),
(5, 'Dupond', '$2y$10$zEz5zk0Z38nenwPCHKydouiaEeWIlZU07FJqVD3YtBPa59wLWOILy', 'dupond_AT_exemple.fr', '2014-09-08 20:39:32', '2014-09-16 15:00:32', 1, 0, '', 1),
(6, 'user1', 'user1', 'user1@user.fr', '2014-09-03 22:00:00', '2014-09-16 15:00:32', 1, 0, '', 1),
(7, 'adminnn', '$2y$10$Vq.U46fvbY8DA9jvxsvgpeRxQSOKxJUVsz0GBbPy/UUufowOCN2oq', 'adminnn_AT_exemple.fr', '2014-09-10 09:45:06', '2014-09-16 15:00:32', 1, 0, '', 1),
(8, 'roubz', '$2y$10$UhlnNmh/ZZ/SDyLlcTzxSu0axCiEjj5nU8SE7Bx6l.gHMZSPC5KW6', 'robin.chalas@ducul.eu', '2014-09-11 20:13:54', '2014-09-16 15:00:32', 0, 0, '', 1),
(9, 'pelo', '$2y$10$2SQB7y.otGV7C0a5rvPCTuQyFGOesazlhHR/jcBjROj7s1nPQk6ru', 'pelo@pelo.fr', '2014-09-15 15:50:26', '2014-09-16 15:00:32', 1, 0, '', 1),
(10, 'robinchal', '$2y$10$mlJhj62Cbkq9As6oJvDv1eB3epLKYQJfH/vjkmbjRgZeAWCAGho8C', 'robin@chal.fr', '2014-09-15 17:50:17', '2014-09-16 15:00:32', 1, 0, '', 1),
(11, 'lolol', '$2y$10$/XggFdnbwGu1rACk/i5QS.9.cPKG9zqmYXU.WDKHu09Ppze.eprTS', 'lol@lol.fr', '2014-09-15 17:57:34', '2014-09-16 15:00:32', 1, 0, '', 1),
(21, 'connard', '$2y$10$c/fGlIiEAl.dOkEyppV55OvIKdWPlyGIc0TdujzCUoMgm9BxtI3DC', 'connard@ducul.fr', '2014-09-16 08:34:21', '2014-09-16 15:00:32', 1, 0, NULL, 1),
(28, 'ggg', '$2y$10$2s3blHje5ZaaJ.9E/gnVqO/EcCEYouUQhnpIHMeGHFM3dLAtdQnm.', 'root@root.fr', '2014-09-16 10:25:39', '2014-09-16 15:00:32', 1, 0, 'zz5itTN7K69hs22o9YhEICbpWfxffC', 0),
(35, 'robert', '$2y$10$vypudrmKCQv631Lt8ZwdOee5I8OuLikMzeh9V3ceU4/OdsrUgWJGu', 'robert@robert.fr', '2014-09-17 06:20:18', '2014-09-17 06:20:18', 1, 0, 'rC9fXOYpIUuuLdj2uuR1HMlkQ3ulxs', 0),
(37, 'monfol', '$2y$10$V8fDO/AE6RmADI28uKKWH.QqRE4YV713mB9sh8cPE64zoMzlPJ2gO', 'robin.chalas@epitech.eu', '2014-09-18 08:09:32', '2014-09-18 16:26:30', 1, 0, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
