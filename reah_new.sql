-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 23 fév. 2021 à 16:41
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reah_new`
--

-- --------------------------------------------------------

--
-- Structure de la table `demo_videos`
--

CREATE TABLE `demo_videos` (
  `demo_video_id` int(11) NOT NULL,
  `demo_video_url` text NOT NULL,
  `demo_video_title` text NOT NULL,
  `demo_video_author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demo_videos`
--

INSERT INTO `demo_videos` (`demo_video_id`, `demo_video_url`, `demo_video_title`, `demo_video_author`) VALUES
(1, '51831727', 'Trouble', 'Marina Ek'),
(2, '318786091', 'DUT MMI Champs-sur-Marne', 'Guillaume Mollet'),
(3, '171563897', 'DUT MMI Présentation', 'Paul Kaelblen'),
(4, '199637397', '(S)WITCH', 'Félix Darraud'),
(5, '209098036', 'Curriculum Vitae - motion design', 'Alice Boyard');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `sessions_userid` int(11) NOT NULL,
  `sessions_token` text NOT NULL,
  `sessions_serial` text NOT NULL,
  `sessions_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`sessions_userid`, `sessions_token`, `sessions_serial`, `sessions_date`) VALUES
(2, 'hd64bde7v4hhdnaefsve6ne6j13r43b7', 'ea4vv763b7ew3rb3eqe26nBh8hx6y4bj', '03/01/2021'),
(7, '4731ye4vB23f7bj7eewe3jsef784dhbq', 'r3qb337eb7d47fvBenr81eycn676e3xb', '03/01/2021'),
(1, '86jf43jd7bdce36dwvs37rxqbee6hBna', 'abr86e7sxh477qbjd323cdB6h6n4y3ee', '03/01/2021');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_lastname` text NOT NULL,
  `user_firstname` text NOT NULL,
  `user_username` text NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_profile_picture` text NOT NULL,
  `user_profile_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_lastname`, `user_firstname`, `user_username`, `user_email`, `user_password`, `user_status`, `user_profile_picture`, `user_profile_description`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.net', '$2y$10$uMoHx7RRqFiw7C0dox7F8O3fzjDYL6ovpJUoFdhAlIMufppDRBTM2', 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(2, '', '', 'loic', 'loic@etienne.tf', '$2y$10$La9Dt.7gO.R2qhwuTGadTelNnJMDjdbIe9tODlHO2TvakgacNHEuC', 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(5, '', '', 'Mewshinyex', 'mewshinyex@vivaldi.net', '$2y$10$lVT8r57OWI4Btxf4AxXvHu5u3x/8RPj5LkjZFT8YcRVKrO1MPp2UK', 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(6, 'Lolo', 'Lolo', 'loloo', 'lolo@moi.fr', '$2y$10$L5jmC.7HuRUe45QPHb1x4OyFinkj17cW.PXJUXUT911E9Y/RAWahS', 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demo_videos`
--
ALTER TABLE `demo_videos`
  ADD PRIMARY KEY (`demo_video_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demo_videos`
--
ALTER TABLE `demo_videos`
  MODIFY `demo_video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
