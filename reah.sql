-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 11, 2021 at 03:42 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reah`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_content` text NOT NULL,
  `comment_video_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_report_id` varchar(500) NOT NULL DEFAULT 'id : '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_date`, `comment_content`, `comment_video_id`, `comment_user_id`, `comment_report_id`) VALUES
(1, '2021-03-11 22:00:00', 'je suis la', 1, 1, 'id : '),
(2, '2021-03-11 22:00:00', 'oui', 1, 1, 'id : '),
(3, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(4, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(5, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(6, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(7, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(8, '2020-02-19 22:00:00', 'oui', 1, 1, 'id : '),
(9, '2021-03-14 22:00:00', 'oui', 1, 1, 'id : '),
(10, '2021-03-16 11:09:57', 'saluuuuuuuuut\r\n', 1, 11, 'id : ,1,1,1,1,1,1'),
(12, '2021-03-28 10:45:34', '', 1, 1, 'id : '),
(13, '2021-03-28 10:45:51', 'ok\r\n', 1, 1, 'id : '),
(14, '2021-03-28 10:46:26', 'ok', 1, 1, 'id : '),
(15, '2021-03-28 10:46:31', 'ok', 1, 1, 'id : '),
(16, '2021-03-28 10:46:32', '', 1, 1, 'id : '),
(17, '2021-03-28 10:47:15', 'dsddd', 1, 1, 'id : '),
(18, '2021-03-28 10:47:29', 'tgl', 1, 1, 'id : '),
(19, '2021-03-28 10:48:10', 'okokokok', 1, 1, 'id : '),
(20, '2021-03-28 10:49:15', 'jnlj,l', 1, 1, 'id : '),
(21, '2021-03-28 10:49:31', 'ok ok ', 1, 1, 'id : '),
(22, '2021-03-28 10:50:47', 'ok ok ', 1, 1, 'id : '),
(23, '2021-03-28 10:51:37', 'dddd', 9, 1, 'id : '),
(24, '2021-03-28 10:52:26', 'dddd', 9, 1, 'id : '),
(25, '2021-03-28 10:52:34', 'dddd', 9, 1, 'id : '),
(26, '2021-03-28 10:52:47', 'ta mere', 9, 1, 'id : ,14'),
(27, '2021-03-28 10:53:40', 't moche', 8, 1, 'id : '),
(28, '2021-03-28 10:54:08', 't qui', 7, 1, 'id : '),
(30, '2021-03-28 10:59:42', 'dqzd', 9, 1, 'id : '),
(31, '2021-03-28 11:00:21', 'dqzd', 9, 1, 'id : '),
(32, '2021-03-28 11:00:22', 'dqzd', 9, 1, 'id : '),
(47, '2021-03-28 12:36:02', 'ww', 8, 1, 'id : '),
(48, '2021-03-28 12:40:34', 'dzq', 7, 1, 'id : '),
(49, '2021-03-28 12:41:37', 'dzqdd', 7, 1, 'id : '),
(50, '2021-03-28 12:41:52', 'ddddddddddd', 8, 1, 'id : '),
(52, '2021-03-28 12:44:38', 'dqzddd', 1, 1, 'id : '),
(53, '2021-03-28 12:44:38', 'dqzddd', 1, 1, 'id : '),
(58, '2021-03-28 12:45:45', 'tg', 7, 1, 'id : '),
(60, '2021-03-28 12:46:19', 'd', 1, 1, 'id : '),
(61, '2021-03-28 12:47:30', 'd', 8, 1, 'id : '),
(62, '2021-03-28 12:49:19', 'dd', 8, 1, 'id : '),
(66, '2021-03-28 13:14:08', 'ok', 1, 1, 'id : '),
(67, '2021-03-28 13:47:45', 't mocje', 1, 1, 'id : '),
(70, '2021-03-28 14:58:55', 'ok', 9, 11, 'id : ');

-- --------------------------------------------------------

--
-- Table structure for table `defis`
--

CREATE TABLE `defis` (
  `defi_id` int(11) NOT NULL,
  `defi_name` varchar(30) NOT NULL,
  `defi_description` text NOT NULL,
  `defi_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `defi_image` varchar(250) DEFAULT NULL,
  `defi_user_id` int(11) NOT NULL,
  `defi_verified` tinyint(1) DEFAULT '0',
  `defi_current` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `defis`
--

INSERT INTO `defis` (`defi_id`, `defi_name`, `defi_description`, `defi_timestamp`, `defi_image`, `defi_user_id`, `defi_verified`, `defi_current`) VALUES
(1, 'Saint-Valentin', 'Pour ce défi de la Saint-valentin, nous vous proposons de réaliser un court-métrage d\'une durée comprise entre 1 min 05s et 4 min. Vous êtes complètement libres. Laissez-vous emporter par les sentiments que vous inspire la saint-valentin.\r\n\r\nPour ce défi, vous devrez inclure les éléments suivants :\r\n- La date \"14 janvier\" doit apparaître à l\'écran\r\n- Un travelling \r\n- Gros plan\r\n- Plan en plongé\r\n- Une transition créative', '2021-04-10 14:41:04', 'saint-valentin.jpg', 11, 1, 1),
(2, 'Harry Potter', 'Pour ce défi Harry Potter, vous devrez à partir des deux films \"Harry Potter and the Deathly Hallows\" partie 1 et 2, réaliser un teaser sur un personnage ou une thématique de votre choix. Donc laissez Harry tranquille !\r\n\r\nContraintes : \r\n\r\n- Raconter une histoire à partir de rushs déjà existants.\r\n- S\'incruster dans le trailer grâce à un fond vert\r\n', '2021-04-10 14:41:04', 'teaser-harrypotter.jpg', 11, 1, 1),
(3, 'coucou toi', 'coucou\r\n', '2021-04-10 14:41:04', 'saint-valentin.jpg', 11, 0, 0),
(4, 'ok', 'ok', '2021-04-10 14:41:04', NULL, 11, 0, 0),
(7, 'dzqd', 'ddd', NULL, NULL, 11, 0, 0),
(8, 'dqzddddd', 'ddddddddddddddddd', NULL, NULL, 11, 0, 0),
(9, 'ze', 'ez', '2021-04-10 16:46:32', NULL, 11, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `distribution_id` int(11) NOT NULL,
  `distribution_user_id` int(11) NOT NULL,
  `distribution_video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`distribution_id`, `distribution_user_id`, `distribution_video_id`) VALUES
(1, 16, 1),
(2, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_title`) VALUES
(1, 'Drame'),
(2, 'Thriller'),
(3, 'Action'),
(4, 'Policier'),
(5, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `liked_id` int(11) NOT NULL,
  `liked_user_id` int(11) NOT NULL,
  `liked_video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`liked_id`, `liked_user_id`, `liked_video_id`) VALUES
(14, 11, 8),
(18, 11, 16),
(19, 11, 11),
(20, 11, 13),
(25, 11, 19),
(30, 11, 15),
(31, 11, 17),
(32, 1, 19),
(34, 1, 18),
(36, 1, 17),
(37, 1, 1),
(38, 1, 8),
(45, 11, 14),
(53, 11, 12),
(56, 11, 18),
(62, 11, 1),
(66, 11, 1),
(76, 11, 7);

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `saved_id` int(11) NOT NULL,
  `saved_user_id` int(11) NOT NULL,
  `saved_video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`saved_id`, `saved_user_id`, `saved_video_id`) VALUES
(1, 11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sessions_userid` int(11) NOT NULL,
  `sessions_token` text NOT NULL,
  `sessions_serial` text NOT NULL,
  `sessions_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sessions_userid`, `sessions_token`, `sessions_serial`, `sessions_date`) VALUES
(2, 'hd64bde7v4hhdnaefsve6ne6j13r43b7', 'ea4vv763b7ew3rb3eqe26nBh8hx6y4bj', '03/01/2021'),
(7, 'rr4bed4awneyf77vchev3qbe673d346b', 'qf1ey63ech4364vedr73rw7e64h7vbnd', '03/01/2021'),
(13, 'hab3rvw2nfb7e71fcdeerxy38djshb64', '7d6B44jeh83sqxny7eb13ahfv3hecne4', '03/01/2021'),
(14, 'b3e1s4hb34nynxBqfh6863ajehnjbw77', 'we7nc3s4dvahqdr74yhhd2n766n7x6br', '03/01/2021'),
(15, '3anj7jqe3nerx4ev7h8c4yw7132s6er7', '44xq43fse716eh6bvbBj7anvdd3neh7c', '03/01/2021'),
(16, 'b74jB76dr4fvee8n332ebdj1xre346a3', 'b68437enddf34eqxah1w6sBe3f4h6yjh', '03/01/2021'),
(1, 'x7ac7debnr66j3h6d7qrd34v2Bs3venb', 'f3darhhwvrhxjc4bjdne2be63v4bB6f6', '03/01/2021'),
(22, '4evbef813d6db3xw3qearn4y2hd7hnn3', 'v3nah7edxrdfb638eebc23hqjydfe1Bb', '03/01/2021'),
(23, 'hwcrd4b2h63eje38ve7xbbvjB6hy34sf', 'dr26b3byf4jdevfe43n7aev3ejhhsxBw', '03/01/2021'),
(24, '78hfe73qxree4j4scd6wvefdrhanby7b', 'bBvxeh47rjefw6e3v4hnyfd7cr14qhde', '03/01/2021'),
(25, '3v7fberabdeh8e1ny6q3Bhb4v6346n7d', 'jeycfe277a6qd3n81bB4rjnhsdv774f3', '03/01/2021'),
(26, 'r3j7xe3dB7bhn4hyjb3d3h276cfqvs4e', '3djq6srj3e3nvy67nb67b812B4bvfdhf', '03/01/2021'),
(27, 'r386hbn1xne4djvd4hc4svhBf3jw7e6b', 'vbnrbxn6137edj6f3qehryh3caBdvb76', '03/01/2021'),
(28, 'be6hdb38f3364x2d7vre671hsBdnra77', 'b1ncdyfe33Bedeh3nnr3d66r27exaq74', '03/01/2021'),
(29, 'faneh2sbe434eqnBw187e3dn3hfydjb6', '8ebnwvhr7en421be67axvsbjnd3yhB47', '03/01/2021'),
(30, 'wdesnqhd37fd48rcrb61fjabh3e7hb4v', 'cfxej7n3r1q24dfwenhneyd63eh4re7a', '03/01/2021'),
(11, '4wnh7x6eby6dbh7sbefnen2r4f3v8eah', 'nf7er26jeeede74Bav68n7hscdd3j4q1', '03/01/2021');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `subscription_subscriber_id` int(11) NOT NULL,
  `subscription_subscriber_name` varchar(50) DEFAULT NULL,
  `subscription_artist_id` int(11) NOT NULL,
  `subscription_artist_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `subscription_subscriber_id`, `subscription_subscriber_name`, `subscription_artist_id`, `subscription_artist_name`) VALUES
(94, 7, NULL, 1, NULL),
(171, 1, NULL, 7, NULL),
(177, 1, NULL, 11, NULL),
(184, 14, NULL, 11, NULL),
(190, 16, NULL, 14, NULL),
(191, 16, NULL, 15, NULL),
(205, 11, NULL, 16, NULL),
(206, 11, NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_lastname` text NOT NULL,
  `user_firstname` text NOT NULL,
  `user_username` text NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_birthday` varchar(11) DEFAULT NULL,
  `user_status` int(11) NOT NULL,
  `user_CGU` tinyint(1) NOT NULL,
  `user_profile_picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `user_banner` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `user_name` varchar(50) DEFAULT NULL,
  `user_website` varchar(50) DEFAULT NULL,
  `user_bio` text,
  `user_report_id` varchar(500) NOT NULL DEFAULT 'id :',
  `user_suspended` tinyint(1) NOT NULL DEFAULT '0',
  `user_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_lastname`, `user_firstname`, `user_username`, `user_email`, `user_password`, `user_birthday`, `user_status`, `user_CGU`, `user_profile_picture`, `user_banner`, `user_name`, `user_website`, `user_bio`, `user_report_id`, `user_suspended`, `user_admin`) VALUES
(5, '', '', 'Mewshinyex', 'mewshinyex@vivaldi.net', '$2y$10$lVT8r57OWI4Btxf4AxXvHu5u3x/8RPj5LkjZFT8YcRVKrO1MPp2UK', NULL, 0, 0, 'default.jpg', 'default.jpg', '', '', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee', 'id :', 0, 0),
(11, 'Saint Martin', 'Julie', 'Jstm', 'jstmartin17@gmail.com', '$2y$10$g7Hb45u6xrduDCZug12kS.CY2C8GYjKDgaxhZI2TuxKFwdO..6uwK', '17/03/01', 0, 1, 'jstm.jpg', 'default.jpg', 'Julie Saint Martin', 'www.juliestm.web-edu.fr', 'Salut c\'est moi ! \r\nAllez voir mon portfolio \r\nvvvvv\r\n\r\n\r\n', 'id :', 0, 1),
(12, 'Gambette', 'Philippe', 'PhilippeG', 'philippe.gambette@u-pem.fr', '$2y$10$kdNFj6H6mAruLp7ADMlJq.g6mDVYj8N5KMDWxp3f6sUPOKWWlkj0a', '1/6/1984', 0, 1, 'default.jpg', 'default.jpg', NULL, NULL, NULL, 'id :', 0, 0),
(13, 'Asma', 'Ilès', 'Ilès.raw', 'iles.a@icloud.com', '$2y$10$Swp3L6Xx4yL/tZZmRiQhweGnaXWOBDzI9eDeZf4TAPTnyzjsdeNfC', '7/8/2001', 0, 1, 'default.jpg', 'default.jpg', '', '', '', 'id :', 0, 0),
(14, 'Lad', 'Minal', 'laD.Minal', 'minal.lad95350@gmail.com', '$2y$10$glAE5FOLnvF6viABC4SZ8e2zGsl1yKQH9/hi8Qftfyl3tY7j0qqk6', '9/6/2000', 0, 1, 'minmin.jpg', 'minmin.jpg', '', 'www.minal-lad.com', 'Salut : )', 'id :', 0, 0),
(15, 'Baillon', 'Edouard', 'fyedd', 'eddu1412@gmail.com', '$2y$10$2wzkYI25935iaEWr6dkKSexQYHAZliHPDOb7Ul3dEcJguMcWCDzsS', '14/12/2000', 0, 1, 'ed.jpg', 'default.jpg', '', '', '', 'id :', 0, 0),
(16, 'Bassi', 'Manar', 'manar21', 'manar.bassimane@gmail.com', '$2y$10$0/l2I6n3tz7ZY4LdGGxL0OFVnWp/IjzHG4WXttk3GPctXs/sNVwVu', '21/2/2000', 0, 1, 'default.jpg', 'default.jpg', '', '', 'Hola amigos', 'id :', 0, 0),
(22, 'admin', 'admin', 'admin', 'admin@admin', '$2y$10$84BxOa0lzFj2lnSH2znn6.1/vq308gE3UFeFfbkP.NYsj0Srjr/O6', '3/4/2004', 0, 1, 'default.jpg', 'default.jpg', '', '', '', 'id :', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_vimeo_id` int(11) NOT NULL DEFAULT '0',
  `video_url` text NOT NULL,
  `video_title` text NOT NULL,
  `video_user_id` int(11) DEFAULT NULL,
  `video_username` varchar(30) DEFAULT NULL,
  `video_name` varchar(50) DEFAULT NULL,
  `video_synopsis` text NOT NULL,
  `video_poster` longblob,
  `video_genre` text NOT NULL,
  `video_defi_id` int(11) NOT NULL,
  `video_duration` time DEFAULT NULL,
  `video_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `video_distribution` varchar(255) DEFAULT NULL,
  `video_like_number` int(11) DEFAULT '0',
  `video_report_id` varchar(500) NOT NULL DEFAULT 'id :'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_vimeo_id`, `video_url`, `video_title`, `video_user_id`, `video_username`, `video_name`, `video_synopsis`, `video_poster`, `video_genre`, `video_defi_id`, `video_duration`, `video_date`, `video_distribution`, `video_like_number`, `video_report_id`) VALUES
(1, 0, '527945068', 'Je t\'haine', 11, NULL, NULL, 'Une jeune femme est retrouvée morte à son domicile. Différents indices sèment le doute sur le tueur. L\'inspectrice Bennet arrivera-t-elle à trouver le criminel ?', NULL, 'Thriller, Policier', 1, '00:03:51', '2021-03-31 06:14:11', '13', 21, 'id :'),
(7, 0, '528002519', 'À nous !', 14, NULL, NULL, 'En ce soir de Saint-Valentin, George et Morgane se préparent à se retrouver pour un dîner aux chandelles comme tous les amoureux en ce jour dédié à l\'amour. George, fou amoureux de Morgane, prépare sa maison pour accueillir sa dulcinée, qui se met sur son 31 pour cette soirée spéciale. Pourtant, les choses ne se passent pas comme on pourrait le croire...', NULL, 'Romance, Drame', 1, '00:03:41', '2021-03-31 06:14:11', '', 8, 'id :'),
(8, 0, '528255015', 'Dernière rencontre', 15, NULL, NULL, 'Un homme se fait poursuivre dans les rues de Paris, il essaye d\'échapper à ses démons bien motivés à ne pas le lâcher...', NULL, 'Drame, Romance', 1, '00:05:20', '2021-03-31 06:14:11', NULL, 13, 'id :,1,1,1'),
(9, 0, '528255338', 'Nuage', 11, NULL, NULL, 'Stéphanie, jeune femme célibataire très complexée par l’amour et les garçons. Elle a reçu deux propositions, une de son ex et de ses amis pour sortir le jour de la Saint Valentin. Seulement elle a envie de voir personne et décide de rester seule chez elle persuadée de passer une meilleure soirée …', NULL, 'Horreur', 1, '00:03:37', '2021-03-31 06:14:11', '', 34, 'id : '),
(10, 0, '531153404', 'Harry Potter', 11, NULL, NULL, 'Découvrez un teaser unique centré sur le personnage principal Harry Potter.\r\nDe Chloé et Cindy.', NULL, 'Action, Drame, Fantastique', 2, '00:02:02', '2021-03-31 06:14:11', NULL, 1, 'id :'),
(12, 0, '531153344', 'Grandeur et décadence', 11, NULL, NULL, 'Découvrez un teaser unique centré sur le personnage Lord Voldemort.\r\nDe Tanguy Adisson.', NULL, 'Action, Drame, Fantastique', 2, '00:03:30', '2021-03-31 06:14:11', NULL, 2, 'id :'),
(13, 0, '531441958', 'Hermione&Ron', 11, NULL, NULL, 'Découvrez un teaser unique sur les personnages Hermione et Ron.\r\nDe Célian Chevereau et Victoria Arrii.', NULL, 'Action, Drame, Fantastique', 2, '00:02:42', '2021-03-31 17:51:03', NULL, 1, 'id :'),
(14, 0, '531442018', 'Horcruxes', 11, NULL, NULL, 'Découvrez un teaser unique sur le personnage principal Harry Potter.\r\nD\'Aurélien, Céline et Julianne.', NULL, 'Action, Drame, Fantastique', 2, '00:02:38', '2021-03-31 17:51:03', NULL, 1, 'id :'),
(17, 0, '531472832', 'L\'omniprésence de Voldemort dans l\'esprit d\'Harry', 11, NULL, NULL, 'Découvrez un teaser unique sur les personnages Harry Potter et Voldemort.\r\nDe Amélie Rubiales et Clémentine Gilama.', NULL, 'Action, Drame, Fantastique', 2, '00:02:13', '2021-03-31 19:15:03', NULL, 6, 'id :');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `defis`
--
ALTER TABLE `defis`
  ADD PRIMARY KEY (`defi_id`);

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`distribution_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`liked_id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`saved_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `defis`
--
ALTER TABLE `defis`
  MODIFY `defi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `distribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `liked_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `saved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
