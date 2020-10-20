-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 oct. 2020 à 10:55
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exercice_film`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Documentaire'),
(2, 'Science-fiction'),
(3, 'Drame'),
(6, 'Documentaire'),
(7, 'Amour');

-- --------------------------------------------------------

--
-- Structure de la table `lending`
--

CREATE TABLE `lending` (
  `lending_id` int(11) NOT NULL,
  `lending_person` varchar(50) NOT NULL,
  `lending_date` date NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lending`
--

INSERT INTO `lending` (`lending_id`, `lending_person`, `lending_date`, `id_movie`) VALUES
(1, 'Sikora Delfine', '2020-09-21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `movie_year` char(4) DEFAULT NULL,
  `movie_comment` varchar(1000) DEFAULT NULL,
  `movie_duration` varchar(20) DEFAULT NULL,
  `movie_mark` tinyint(4) DEFAULT NULL,
  `movie_is_filing` tinyint(1) NOT NULL DEFAULT 0,
  `id_category` int(11) DEFAULT NULL,
  `movie_is_seeing` tinyint(1) NOT NULL DEFAULT 0,
  `movie_img` varchar(250) DEFAULT NULL,
  `movie_tmdb_id` varchar(250) DEFAULT NULL,
  `movie_wish` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`movie_id`, `movie_name`, `movie_year`, `movie_comment`, `movie_duration`, `movie_mark`, `movie_is_filing`, `id_category`, `movie_is_seeing`, `movie_img`, `movie_tmdb_id`, `movie_wish`) VALUES
(1, 'Harry Potter à l\'école des sorciers', '2001', 'Mon film préféré dans mon enfance !', '2h32', 5, 0, 2, 1, 'https://pausegeek.fr/img/news/2016/09/Harry-Potter-1.jpg', NULL, 0),
(2, 'A Potter à l\'école des sorciers', '2014', 'Mon film préféré dans mon enfance !', '2h32', 5, 0, 2, 1, 'https://pausegeek.fr/img/news/2016/09/Harry-Potter-1.jpg', NULL, 0),
(4, 'Titanic', NULL, NULL, NULL, NULL, 0, NULL, 0, '/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg', '597', 0),
(5, 'Titanic', NULL, NULL, NULL, NULL, 0, NULL, 0, '/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg', '597', 0),
(6, 'Back to the Future', NULL, NULL, NULL, NULL, 0, NULL, 0, '/7lyBcpYB0Qt8gYhXYaEZUNlNQAv.jpg', '105', 1),
(7, 'Princess Mononoke', NULL, NULL, NULL, NULL, 0, NULL, 0, '/pdtzEreKvKAlqa2YEBaGwiA45V8.jpg', '128', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `lending`
--
ALTER TABLE `lending`
  ADD PRIMARY KEY (`lending_id`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `lending`
--
ALTER TABLE `lending`
  MODIFY `lending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lending`
--
ALTER TABLE `lending`
  ADD CONSTRAINT `lending_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`movie_id`);

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
