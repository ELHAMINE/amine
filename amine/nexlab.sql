-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 09:56 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `montant_total` int(11) NOT NULL,
  `mantant_paye` int(11) NOT NULL,
  `date_de_payement` datetime NOT NULL,
  `montant_restant` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `liverable`
--

CREATE TABLE `liverable` (
  `id_liverable` int(11) NOT NULL,
  `numero_liverable` varchar(45) NOT NULL,
  `id_projet` varchar(45) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `montant` float NOT NULL DEFAULT '0',
  `paye` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liverable`
--

INSERT INTO `liverable` (`id_liverable`, `numero_liverable`, `id_projet`, `date_debut`, `date_fin`, `montant`, `paye`) VALUES
(1, '123', '2', '2018-06-01', '2018-06-30', 0, 0),
(2, '12', '1', '2018-06-06', '2018-06-28', 100000, 1),
(3, '1', '10', '2010-05-05', '2015-05-05', 10000, 0),
(4, '2', '52', '2018-06-19', '2018-09-21', 200000, 0),
(5, '4', '546', '2018-06-21', '2018-06-21', 625, 0),
(6, '5', '1', '2018-06-21', '2018-06-21', 245, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `id_utilisateur`, `sujet`, `text`, `date`) VALUES
(2, 5, 'reclamation', '', '2018-06-21 12:45:15'),
(3, 5, 'reclamation', 'kafksdhkhdvkSBHl', '2018-06-21 12:45:27'),
(4, 10, 'reclamation', 'salut je veut savoire si vous pouver me creer un compte', '2018-06-21 13:32:56'),
(5, 11, 'yassine', 'hkvhalsvhalbhlasdvbldnbljafs\r\n', '2018-06-21 13:37:50'),
(6, 5, 'jhjb', 'kjbkbkjbk', '2018-06-21 18:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id_projet`, `id_utilisateur`, `date_debut`, `date_fin`, `nom`, `description`) VALUES
(1, 4, '2018-06-01', '2018-06-30', 'Asssurance', 'ce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\nce ci est un projets de test pour une description long......\r\n\r\n\r\n\r\n\r\n'),
(2, 5, '2018-06-01', '2018-06-30', 'Ecole', 'ce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......\r\nce ci est un projets de test pour une description long......'),
(3, NULL, '2018-06-08', '2018-06-01', 'amine', 'bmnb,jbj,'),
(4, 8, '2018-06-21', '2018-06-21', 'jhvjh', 'gjhvlgluhgliuhglkhu'),
(5, 10, '2018-06-21', '2018-06-21', 'assurace axa', '');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `cin` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `datenaiss` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`, `is_active`) VALUES
(2, 'Q1234', 'Bahlaoui', 'Youssef', '1995-02-20', 'usef@email.me', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(6, 'Q7181', 'El-hosi', 'Amine', '1997-05-05', 'amine@elhosi.me', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(4, 'Q123409', 'fridi', 'yassine', '1996-10-20', 'yasin@mail.me', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0),
(5, 'Q312919', 'Farzouz', 'Abderrzak', '2000-01-01', 'abdo@email.me', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL),
(8, 'Q0192', 'El-Hosi', 'Hamza', '2000-02-20', 'hamza@email.me', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1),
(10, 'q6655', 'coco', 'kik', '2015-02-14', 'kik@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1),
(11, 'v354', 'yassine', 'ahmed', '2000-12-05', 'yass@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1),
(12, 'hv', 'hghmb', 'jvjhv', '2021-09-25', '123@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1),
(13, 'V54545', 'val', 'ersfg', '2015-09-24', '1234@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`),
  ADD KEY `FK_id_projet` (`id_projet`);

--
-- Indexes for table `liverable`
--
ALTER TABLE `liverable`
  ADD PRIMARY KEY (`id_liverable`),
  ADD UNIQUE KEY `numero_livrable` (`numero_liverable`),
  ADD KEY `FK_id_projet` (`id_projet`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `FK_id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liverable`
--
ALTER TABLE `liverable`
  MODIFY `id_liverable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
