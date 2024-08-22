-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 12:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidsweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `gurdian` varchar(50) NOT NULL,
  `gemail` varchar(100) NOT NULL,
  `child` varchar(50) NOT NULL,
  `chage` int(4) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `regDate`, `gurdian`, `gemail`, `child`, `chage`, `message`) VALUES
(1, '2024-06-03 03:27:41', 'Niall Horan', 'https://www.instagram.com/niallhoran/?hl=en', 'Theo Greg', 12, ' July 16, 2013 '),
(2, '2024-06-03 03:27:58', 'Us', 'https://www.netflix.com/ca/title/70271599', '1D', 2013, 'Award-winning documentarian Morgan Spurlock turns his camera on boy band phenomenon One Direction in this combination concert film and backstage pass.'),
(11, '2024-06-18 18:38:20', 'Louis Tomlinson', 'https://www.instagram.com/louist91/', 'Freddie ', 8, ' January 21, 2016 '),
(13, '2024-06-18 23:10:55', 'Liam Payne', 'https://www.instagram.com/liampayne/', 'Bear', 7, ' March 22, 2017 '),
(14, '2024-06-18 23:12:34', 'Zayn Malik', 'https://www.instagram.com/zayn/', 'Khai ', 4, ' September 19, 2020 '),
(16, '2024-06-18 23:47:26', 'MMA', 'https://www.famousbirthdays.com/people/taylor-payne.html', 'bd to know!', 9999, 'yeeeeet');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `capacity` int(4) NOT NULL,
  `begAge` int(2) NOT NULL,
  `endAge` int(2) NOT NULL,
  `begTime` time NOT NULL,
  `endTime` time NOT NULL,
  `pub` tinyint(1) NOT NULL,
  `image` varchar(150) NOT NULL,
  `idtea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `regDate`, `name`, `price`, `capacity`, `begAge`, `endAge`, `begTime`, `endTime`, `pub`, `image`, `idtea`) VALUES
(1, '2024-06-15 17:47:51', 'Back-end language', 2400, 8, 8, 15, '17:30:00', '22:30:00', 1, 'backend.jpg', 0),
(2, '2024-06-15 17:47:51', 'Calculus', 1999, 19, 7, 13, '15:33:33', '03:03:03', 1, 'trig.png', 2),
(4, '2024-06-15 17:47:51', 'Chemistry', 2300, 33, 3, 6, '17:51:15', '19:15:51', 1, 'chem.png', 1),
(5, '2024-06-15 17:47:51', 'Guess who\'s back?..', 999.999, 9999, 9, 99, '00:01:39', '01:39:00', 1, 'x.gif', 6),
(6, '2024-06-15 17:50:05', 'law school', 1800.56, 48, 5, 10, '18:00:00', '18:30:00', 1, 'law-school.png', 4),
(7, '2024-06-15 17:50:05', 'pharmacy', 1363.9, 26, 4, 8, '08:00:00', '10:30:00', 1, 'pharm.jpg', 1),
(8, '2024-06-15 17:50:05', 'Sculpting', 1589.79, 14, 2, 12, '23:00:00', '03:20:00', 1, 'sculp.jpg', 4),
(9, '2024-06-16 18:44:01', 'Martial Arts', 5555.5, 15, 5, 15, '05:00:00', '17:00:00', 1, 'eddb76653559f162c5fd9f427271171d.jpeg', 3),
(14, '2024-06-19 23:06:54', 'o.0', 0, 0, 0, 0, '00:00:00', '00:00:00', 0, '77890a4ad47c0aff70d4502eb9512864.jpeg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `regDate`, `name`, `email`, `subject`, `message`) VALUES
(1, '2024-06-03 03:27:41', 'maysaa', 'jijij.hjkh@jkj', 'الدومين لا يعمل', 'test5'),
(2, '2024-06-03 03:27:58', 'Us', 'jijij@jkj', 'f', 'ff'),
(11, '2024-06-18 18:38:20', 'Rue', 'rowanmahrous01@gmail.com', 'yesssir', 'yo'),
(13, '2024-06-18 23:10:55', 'Rue', 'saar@', 'Rue', 'yeeet'),
(14, '2024-06-18 23:12:34', 'g', 'g@g', 'g', 'ggg'),
(16, '2024-06-18 23:47:26', 'joe', 'j@e', '¡Yo!', 'yeeeeet'),
(17, '2024-06-19 00:42:01', 'o.0', 'o@0', 'o-0', 'o_0');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `idtea` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(100) NOT NULL,
  `Jobtitle` varchar(300) NOT NULL,
  `image` varchar(150) NOT NULL,
  `pub` tinytext NOT NULL COMMENT '0 blocked; 1 active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`idtea`, `regDate`, `fullname`, `Jobtitle`, `image`, `pub`) VALUES
(0, '2024-06-15 16:39:06', 'Mr.x', 'x', 'efa42cb0b5c7e3f9041d14584eecb84f.png', '1'),
(1, '2024-06-15 16:30:09', 'Walter White Hartwell', 'American chemist, school teacher, and major narcotics distributor from Albuquerque, New Mexico, whose drug empire became the largest meth operation in U.S. history.', 'walt.jpg', '1'),
(2, '2024-06-15 16:32:51', ' Gustavo Fring	', 'Chilean-American restaurant entrepreneur and major narcotics distributor who primarily worked in Albuquerque, New Mexico. Originally collaborating with the Mexican drug cartel to distribute cartel cocaine.', 'gus.jpg', '1'),
(3, '2024-06-15 16:35:02', 'Michael Ehrmantraut', 'American career criminal, Marine Corps veteran, and former Philadelphia police officer. Calm and calculating, Mike later became a private investigator, hitman, assassin, and violent fixer for drug traffickers.', 'mike.jpg', '1'),
(4, '2024-06-15 16:38:39', 'James Morgan', 'American criminal defense lawyer, scam artist, and convicted criminal who is serving an 86-year sentence at ADX Montrose. Originally from Cicero, Illinois during his career as a scam artist.', 'McGill.jpg', '1'),
(6, '2024-06-16 13:08:08', 'Slim Shady', '..back again', 'scarytea.jpg', '1'),
(7, '2024-06-17 12:53:55', 'tea', 'tea', '61d62346c749757983ee7657631015ff.jpeg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(50) NOT NULL,
  `Jobtitle` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `pub` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `regDate`, `fullname`, `Jobtitle`, `comment`, `image`, `pub`) VALUES
(1, '2024-05-28 15:35:51', 'Rowan Mahrous', 'TourGuide', 'It\'s giving the edu n entertainment experience', '-QR.png', 1),
(2, '2024-05-28 15:38:35', 'Emily O\'Malley', 'A professional cook', 'It is all \'bout greenish-gingerish mix 💚🤍🧡', '-Emm.jpg', 1),
(3, '2024-05-28 15:38:35', 'Maximillion Pegasus	\n', 'Yu-Gi-oh player', 'German nurseries all the way', 'ugo.jpg', 1),
(4, '2024-05-28 18:16:06', 'Merida Do-Gooder', 'Survival heroo', '\"Ack! Lang may yer lum reek, and may a moose ne\'er leave your girnel with a tear drop in his eye! Haste Ye Back, Me Lassie!\"\n', '0f5152ae8ee6b548b83eb24f5b7f0080.jpeg', 1),
(7, '2024-05-29 01:11:39', 'yma', 'WHO', 'Ayyyo!', 'fd682868a40719548668e7d8c8df2263.jpeg', 0),
(12, '2024-06-16 12:34:27', 'o.0', 'o-0', 'o_0', '7aaed9e90f6b13a057c4694cfd49e09a.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  `phone` char(20) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '0 blocked; 1 active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regDate`, `fullname`, `username`, `email`, `pwd`, `phone`, `active`) VALUES
(1, '2024-05-17 18:15:52', 'Conan O\'Brayn', 'conan', 'Conan@brayn.com', '$2y$10$Sh89liP.IK6rVLYL44fUbeJ42rDLz7RgOjfkbBNi0KIgCGxJcYcLa', '1', 1),
(3, '2024-05-19 15:18:07', 'supyo', 'supyo', 'yo@oy.com', '$2y$10$qvWRwUlGYQz2xC0JTe4vr.sH6DOtQO.3.xMiSPqd.kdESbT9iqOGm', '+000', 0),
(6, '2024-05-19 16:23:31', 'Ro', 'Rue', 'Ro@6', '$2y$10$63iG6uYWKasbl7YqZ9eVVebnmMw2vd9zoCVdwDH1EBfl5Z/W0F1A.', '666', 1),
(8, '2024-06-14 20:09:50', 'Rowan Mustafa ', 'Regina1D', '1D@yahoo.com', '$2y$10$WUH7VsxkjzhbYptGi5d0RuO8tWo9FGUpt18lhNRDnt2UuD8q07YS6', '+200000000000', 1),
(13, '2024-06-14 20:56:52', 'Emerald isle☘️', '🇮🇪', 'irish@ginger', '$2y$10$LnHOaJV9YiHAHJ5wM81IHeEqjAC0YCYKg6eOCxzR2Yhed4zZTH.6y', '+353', 1),
(15, '2024-06-17 12:57:46', 'KKK', 'kkk', 'kkk@666', '$2y$10$XrFxKL8840Vde/ejD02vfuNpQMRNJeYpn3lUs3TFH34FWYHqNQyMO', '666', 1),
(16, '2024-06-16 12:58:44', 'x', 'x', 'x@x', '$2y$10$e0rylAus.gvyql4Jx0skB.EJKHeoIj7n9kWK.hGBdtxqhDxapZBFm', '000+', 0),
(17, '2024-06-17 12:07:08', '0o0', '0', '0@0', '$2y$10$6DwSiSLRW0zUAGm5FyAouu9V7VgoB58qpIQQVjD3EyFJnRrV5SNXi', '0+0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gemail` (`gemail`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtea` (`idtea`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`idtea`),
  ADD KEY `fullname;` (`fullname`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`fullname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1821;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`idtea`) REFERENCES `teachers` (`idtea`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
