-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 10, 2021 at 09:18 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `reah_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidates_defi_id` int(11) NOT NULL,
  `candidates_user_id` int(11) NOT NULL,
  `candidates_defi_name` varchar(30) NOT NULL,
  `candidates_user_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_content` text NOT NULL,
  `comment_video_id` int(11) NOT NULL,
  `comments_user_id` int(11) NOT NULL,
  `comments_user_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `defis`
--

CREATE TABLE `defis` (
  `defi_id` int(11) NOT NULL,
  `defi_name` varchar(30) NOT NULL,
  `defi_description` text NOT NULL,
  `defi_timestamp` bigint(50) DEFAULT NULL,
  `defi_image` longblob,
  `defi_user_id` int(11) NOT NULL,
  `defi_verified` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `defis`
--

INSERT INTO `defis` (`defi_id`, `defi_name`, `defi_description`, `defi_timestamp`, `defi_image`, `defi_user_id`, `defi_verified`) VALUES
(1, 'Saint-Valentin', 'dzq', NULL, NULL, 0, 1),
(2, 'dz', 'dd', NULL, NULL, 0, 1),
(3, 'dzq', 'ddd', NULL, NULL, 0, 0),
(4, 'dzq', 'dz', NULL, NULL, 0, 0),
(8, 'dzq', 'dzq', NULL, NULL, 0, 0),
(10, 'dz', 'dqz', NULL, NULL, 0, 0),
(12, 'dzq', 'dzq', NULL, NULL, 0, 0),
(13, 'd', 'd', NULL, NULL, 0, 0),
(14, 'd', 'ddd', NULL, NULL, 0, NULL),
(15, 'qz', 'z', NULL, NULL, 0, NULL),
(16, 'dd', 'd', NULL, NULL, 0, 0),
(17, 'dd', 'd', NULL, NULL, 1, 0),
(18, 'dd', 'dd', NULL, NULL, 1, 0),
(19, 'qqq', 'q', NULL, NULL, 1, 0),
(20, 'd', 'd', NULL, NULL, 1, 0),
(21, 'oui', 'ui', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, '4731ye4vB23f7bj7eewe3jsef784dhbq', 'r3qb337eb7d47fvBenr81eycn676e3xb', '03/01/2021'),
(1, 'd3f3hqwav1yx2bdbd6Beerce6n87srv3', 'x3hbj7b2n33ce3ded774n76yewfevds4', '03/01/2021');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `subscription_subscriber_id` int(11) NOT NULL,
  `subscription_subscriber_name` varchar(50) NOT NULL,
  `subscription_artist_id` int(11) NOT NULL,
  `subscription_artist_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `user_status` int(11) NOT NULL,
  `user_CGU` tinyint(1) NOT NULL,
  `user_profile_picture` text NOT NULL,
  `user_profile_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_lastname`, `user_firstname`, `user_username`, `user_email`, `user_password`, `user_status`, `user_CGU`, `user_profile_picture`, `user_profile_description`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.net', '$2y$10$uMoHx7RRqFiw7C0dox7F8O3fzjDYL6ovpJUoFdhAlIMufppDRBTM2', 0, 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(2, '', '', 'loic', 'loic@etienne.tf', '$2y$10$La9Dt.7gO.R2qhwuTGadTelNnJMDjdbIe9tODlHO2TvakgacNHEuC', 0, 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(5, '', '', 'Mewshinyex', 'mewshinyex@vivaldi.net', '$2y$10$lVT8r57OWI4Btxf4AxXvHu5u3x/8RPj5LkjZFT8YcRVKrO1MPp2UK', 0, 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee'),
(6, 'Lolo', 'Lolo', 'loloo', 'lolo@moi.fr', '$2y$10$L5jmC.7HuRUe45QPHb1x4OyFinkj17cW.PXJUXUT911E9Y/RAWahS', 0, 0, 'profile_pictures/default.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse exercitationem laudantium nihil voluptas itaque odit cumque nesciunt numquam, sunt d   olor, voluptatem recusandae assumenda rerum facereeee');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_vimeo_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `video_title` text NOT NULL,
  `video_user_id` int(11) NOT NULL,
  `video_username` varchar(30) NOT NULL,
  `video_name` varchar(50) NOT NULL,
  `video_synopsis` text NOT NULL,
  `video_poster` longblob NOT NULL,
  `video_genre` text NOT NULL,
  `video_defi_id` int(11) NOT NULL,
  `video_duration` time NOT NULL,
  `video_date` date DEFAULT NULL,
  `video_distribution` varchar(255) NOT NULL,
  `video_like_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_vimeo_id`, `video_url`, `video_title`, `video_user_id`, `video_username`, `video_name`, `video_synopsis`, `video_poster`, `video_genre`, `video_defi_id`, `video_duration`, `video_date`, `video_distribution`, `video_like_number`) VALUES
(1, 0, '51831727', 'Trouble', 0, '', '', '', '', '', 1, '00:00:00', NULL, '', 67),
(2, 0, '318786091', 'DUT MMI Champs-sur-Marne', 0, '', '', '', '', '', 1, '00:00:00', NULL, '', 177),
(3, 0, '171563897', 'DUT MMI Présentation', 0, '', '', '', '', '', 2, '00:00:00', NULL, '', 3),
(4, 0, '199637397', '(S)WITCH', 0, '', '', '', '', '', 3, '00:00:00', NULL, '', 23),
(5, 0, '209098036', 'Curriculum Vitae - motion design', 0, '', '', '', '', '', 2, '00:00:00', NULL, '', 76);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidates_defi_id`);

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
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

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
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidates_defi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defis`
--
ALTER TABLE `defis`
  MODIFY `defi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
