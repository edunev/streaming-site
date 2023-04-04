-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2021 at 07:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e21bdfilms`
--
CREATE DATABASE IF NOT EXISTS `e21bdfilms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e21bdfilms`;

-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE `connexion` (
  `courriel` varchar(50) NOT NULL,
  `type` varchar(1) NOT NULL,
  `statut` varchar(1) NOT NULL,
  `mot_passe` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`courriel`, `type`, `statut`, `mot_passe`) VALUES
('admin@domain.com', 'A', 'A', 'Canada01-'),
('davidbfortin@teleworm.ca', 'M', 'A', 'Canada01-'),
('joyceceagle@teleworm.us', 'M', 'A', 'Canada01-'),
('karen@jourrapide.com', 'M', 'A', 'Canada01-'),
('rivera@friendlock.ca', 'M', 'I', 'Canada01-'),
('tim@dayrep.com', 'M', 'A', 'Canada01-');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE `films` (
  `id_film` int(5) NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `titre` varchar(300) DEFAULT NULL,
  `realisateur` varchar(50) DEFAULT NULL,
  `duree` int(4) DEFAULT NULL,
  `langue` varchar(30) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `lien` varchar(1000) DEFAULT NULL,
  `pochette` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id_film`, `categorie`, `titre`, `realisateur`, `duree`, `langue`, `date`, `lien`, `pochette`) VALUES
(44, 'suspense', 'Evil Dead', 'Sam Raimi', 80, 'anglais', '1983-05-26', 'https://youtu.be/dtsK7skqk9U', '59f24d8599da83958492b3f0a2a608713084b748.jpg'),
(45, 'drame', 'The Human Centipede', 'Tom Six', 92, 'anglais', '2010-05-07', 'https://youtu.be/glfBurdSUS8', '8bd13410f474ffdbb6c63ac364d759df43bee3e5.jpg'),
(46, 'suspense', 'Jeu d enfant', 'Tom Holland', 77, 'francais', '1988-11-08', 'https://youtu.be/0isP0xK6t7Y', '985784cf459c05319ee0343244a07bac4988fc12.jpg'),
(47, 'drame', 'Simetierre', 'Stephen King', 107, 'francais', '1989-04-21', 'https://youtu.be/VDBDd_BL-Sc', '511b7ed7dc9af9c632b951892bdd1b0b1ea6d647.jpg'),
(48, 'comedie', 'Skins', 'Eduardo Casanova', 91, 'espagnol', '2017-10-03', 'https://youtu.be/3xzPE6J2hIU', '5ac291514ccabd0d0696dc944e8e0efc1bd0c5bc.jpg'),
(49, 'action', 'Saw', 'James Wan', 104, 'anglais', '2004-10-29', 'https://youtu.be/S-1QgOMQ-ls', 'avatar.jpg'),
(50, 'comedie', 'F.B.I.', 'Keenen Ivory Wayans', 109, 'francais', '2004-06-26', 'https://youtu.be/3dJWyYwqN-U', '77f2bf5bcf79902c1f706034909d96ca41724a42.jpg'),
(51, 'action', 'Mortal Kombat', 'Greg Russo', 110, 'francais', '2021-04-23', 'https://youtu.be/B_SeNjJ5qyk', '83a3d26ac866fc92b2ce82317273886ca5314548.jpg'),
(52, 'action', 'Froid Mortel', 'Lluis Quilez', 106, 'francais', '2021-01-29', 'https://youtu.be/gRcesjLkdN0', '975134be4fe001e05ffbdf6834deddd30958027e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location_payment`
--

DROP TABLE IF EXISTS `location_payment`;
CREATE TABLE `location_payment` (
  `id_transaction` int(5) NOT NULL,
  `id_film` int(10) DEFAULT NULL,
  `nom_film` varchar(200) NOT NULL DEFAULT 'cette ligne est un reg. de payment',
  `courriel` varchar(30) DEFAULT NULL,
  `date_location` timestamp NOT NULL DEFAULT current_timestamp(),
  `prix` double DEFAULT NULL,
  `payment` double DEFAULT NULL,
  `date_payment` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_payment`
--

INSERT INTO `location_payment` (`id_transaction`, `id_film`, `nom_film`, `courriel`, `date_location`, `prix`, `payment`, `date_payment`) VALUES
(46, 52, 'Froid Mortel', 'admin@domain.com', '0000-00-00 00:00:00', 4.99, NULL, NULL),
(47, 48, 'Skins', 'admin@domain.com', '0000-00-00 00:00:00', 4.99, NULL, NULL),
(48, 44, 'Evil Dead', 'admin@domain.com', '0000-00-00 00:00:00', 2.99, NULL, NULL),
(49, NULL, 'cette ligne est un reg. de payment', 'admin@domain.com', '0000-00-00 00:00:00', NULL, 16.21, '2021-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE `membres` (
  `courriel` varchar(50) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `genre` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`courriel`, `prenom`, `nom`, `genre`, `date_naissance`) VALUES
('admin@domain.com', 'Compte', 'Admin', 'homme', '1980-01-04'),
('davidbfortin@teleworm.ca', 'David', 'B. Fortin', 'homme', '1966-04-19'),
('joyceceagle@teleworm.us', 'Joyce', 'C. Eagle', 'femme', '1998-02-21'),
('karen@jourrapide.com', 'Karen', 'True', 'femme', '1987-02-15'),
('rivera@friendlock.ca', 'Vincent', 'Rivera', 'homme', '1937-06-27'),
('tim@dayrep.com', 'Tim', 'Jackson', 'homme', '1970-11-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`courriel`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `location_payment`
--
ALTER TABLE `location_payment`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_filme` (`id_film`),
  ADD KEY `courriel` (`courriel`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`courriel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `location_payment`
--
ALTER TABLE `location_payment`
  MODIFY `id_transaction` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_ibfk_1` FOREIGN KEY (`courriel`) REFERENCES `membres` (`courriel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
