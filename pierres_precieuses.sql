-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 25 Octobre 2018 à 17:01
-- Version du serveur :  5.7.23-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pierres_precieuses`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `continent` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `agent`
--

INSERT INTO `agent` (`id`, `fullname`, `continent`, `email`, `password`) VALUES
(1, 'mounach', 'europe', 'mounach@gmail.com', '$2y$10$SpVvRnk8BVeCxrJi7HFvQe4nAL4PblyeP1B6iGrqoF5NMLpBb1twC'),
(2, 'mouad', 'europe', 'mouad@gmail.com', '$2y$10$XWzDgfIVTaolCOCB/oUWiOFFURRBdPjq.KbTyLS1/WAZaVyCi6GCy'),
(3, 'dounia', 'afrique', 'dounia@gmail.com', '$2y$10$hJ67VMed7HBtnhCKyH1s0uFHB3CCJD5axw1tZQgt0Wi6vhgiyhYI6');

-- --------------------------------------------------------

--
-- Structure de la table `carriere`
--

CREATE TABLE `carriere` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `continent` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `carriere`
--

INSERT INTO `carriere` (`id`, `name`, `continent`, `owner`, `status`) VALUES
(1, 'carriere de Ayoub', 'afrique', 'ayoub', 'ouvert'),
(2, 'carriere de Mostafa', 'afrique', 'mostafa', 'ferme'),
(3, 'carriere de souhaila', 'europe', 'souhaila', 'ouvert'),
(4, 'carriere de dounia', 'afrique', 'dounia', 'ouvert');

-- --------------------------------------------------------

--
-- Structure de la table `pierre`
--

CREATE TABLE `pierre` (
  `id` int(11) NOT NULL,
  `denomination` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `size` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pierre`
--

INSERT INTO `pierre` (`id`, `denomination`, `color`, `weight`, `size`, `quality`, `id_type`) VALUES
(1, 'diamant', 'white', '20', 'small', 'EX', 1),
(2, 'rubis', 'red', '10', 'small', 'EX', 1),
(3, 'citrine', 'yellow', '15', 'medium', 'VG', 2),
(4, 'peridot', 'green', '10', 'small', 'F', 3),
(16, 'emraude', 'grey', '30', 'big', 'EX', 1),
(17, 'cornaline', 'grey', '30', 'big', 'EX', 2),
(18, 'perle', 'grey', '30', 'big', 'EX', 3),
(19, 'saphir', 'grey', '30', 'big', 'EX', 1),
(20, 'grenat', 'grey', '30', 'big', 'EX', 2),
(21, 'opale', 'grey', '30', 'big', 'EX', 2),
(22, 'spinelle', 'noir', '10', 'small', 'G', 3),
(23, 'rubis', 'grey', '30', 'big', 'EX', 2);

-- --------------------------------------------------------

--
-- Structure de la table `recueil`
--

CREATE TABLE `recueil` (
  `id_agent` int(11) NOT NULL,
  `id_pierre` int(11) NOT NULL,
  `id_carriere` int(11) NOT NULL,
  `date_recueil` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `recueil`
--

INSERT INTO `recueil` (`id_agent`, `id_pierre`, `id_carriere`, `date_recueil`) VALUES
(1, 1, 1, '2017-12-18 13:17:17'),
(1, 2, 1, '2017-12-24 09:09:09'),
(1, 4, 2, '2018-10-24 00:12:49'),
(1, 22, 2, '2018-10-24 01:49:22'),
(2, 3, 2, '2018-05-08 15:15:15'),
(2, 17, 4, '2018-10-24 00:50:27'),
(2, 18, 4, '2018-10-24 00:53:14'),
(2, 19, 4, '2018-10-24 00:54:56'),
(2, 20, 4, '2018-10-24 00:57:27'),
(2, 21, 4, '2018-10-24 00:58:31'),
(2, 23, 2, '2018-10-25 00:43:34'),
(3, 16, 3, '2018-10-24 00:44:31');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
(1, 'precieuses'),
(2, 'fines'),
(3, 'organiques');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carriere`
--
ALTER TABLE `carriere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pierre`
--
ALTER TABLE `pierre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `recueil`
--
ALTER TABLE `recueil`
  ADD PRIMARY KEY (`id_agent`,`id_pierre`,`id_carriere`),
  ADD KEY `id_pierre` (`id_pierre`),
  ADD KEY `id_carriere` (`id_carriere`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `carriere`
--
ALTER TABLE `carriere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `pierre`
--
ALTER TABLE `pierre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pierre`
--
ALTER TABLE `pierre`
  ADD CONSTRAINT `pierre_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Contraintes pour la table `recueil`
--
ALTER TABLE `recueil`
  ADD CONSTRAINT `recueil_ibfk_1` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `recueil_ibfk_2` FOREIGN KEY (`id_pierre`) REFERENCES `pierre` (`id`),
  ADD CONSTRAINT `recueil_ibfk_3` FOREIGN KEY (`id_carriere`) REFERENCES `carriere` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
