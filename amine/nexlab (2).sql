-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 02 juil. 2018 à 01:48
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nexlab`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `text`) VALUES
(1, 'amine', 'amine@elhosi.me', 'this is test message !'),
(2, 'azerty123', 'elhossi8amine@gmail.com', '12345667899'),
(3, 'azerty123', 'elhossi8amine@gmail.com', '12345667899'),
(4, 'azerty123', 'elhossi8amine@gmail.com', '12345667899');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
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
-- Structure de la table `liverable`
--

CREATE TABLE `liverable` (
  `id_liverable` int(11) NOT NULL,
  `numero_liverable` int(11) NOT NULL,
  `id_projet` varchar(45) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `montant` float NOT NULL DEFAULT '0',
  `paye` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liverable`
--

INSERT INTO `liverable` (`id_liverable`, `numero_liverable`, `id_projet`, `date_debut`, `date_fin`, `montant`, `paye`) VALUES
(1, 1, '2', '2018-05-05', '2019-03-02', 500000, 1),
(2, 1, '2', '0000-00-00', '0000-00-00', 0, 1),
(3, 2, '2', '2013-02-05', '2015-02-02', 0, 1),
(4, 2, '1', '2018-05-05', '2019-05-05', 500000, 0),
(5, 1, '1', '1998-05-05', '2018-05-05', 50000, 0),
(6, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(7, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(8, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(9, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(10, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(11, 1, '3', '2020-05-05', '2030-01-01', 50000, 0),
(12, 101, '3', '2018-05-05', '2019-04-04', 500000, 0),
(13, 301, '3', '2018-05-05', '2019-05-05', 0, 1),
(14, 301, '3', '2018-05-05', '2019-05-05', 0, 0),
(15, 202, '3', '2000-05-05', '2019-12-20', 50000, 0),
(16, 5, '4', '2018-05-05', '2020-01-01', 1000, 1),
(17, 1, '3', '1997-05-05', '2018-05-05', 5000, 0),
(18, 1, '2', '2015-12-30', '2018-06-01', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_utilisateur`, `sujet`, `text`, `date`) VALUES
(1, 2, 'DFBKDK', 'SNJBKDJBNJKDNBJSDNB.SNC SOBNLDN NJN\r\n', '2018-06-29 03:07:31'),
(2, 3, 'PROJETC 2 ', 'CECI EST UNE DESCRIPTION DU PROJECT 2', '2018-06-29 03:27:46');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
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
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `id_utilisateur`, `date_debut`, `date_fin`, `nom`, `description`) VALUES
(1, 2, '2018-01-01', '2019-01-01', 'PROJET1', 'CECI EST LA DESCRIPTION DU PROJET1'),
(2, 3, '2018-01-01', '2020-02-02', 'PROJET2', 'CECI EST LA DESCRIPTION DU PROJET'),
(3, 4, '0020-01-01', '2030-01-01', 'PROJET3', 'CECI EST DU TEXT POUR LA DESCRIPTION DU PROJET'),
(4, 5, '2018-10-05', '2020-02-04', 'PROJET4', 'CECI EST UNE DESCIPTION DU PROJET');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
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
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `cin`, `nom`, `prenom`, `datenaiss`, `email`, `pass`, `is_admin`, `is_active`) VALUES
(1, 'Q326154', 'EL HOSSI', 'AMINE', '1997-05-05', 'elhossi8amine@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(2, 'q123456', 'nclient1', 'pclient1', '1996-06-29', 'client1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1),
(3, 'q22222', 'nclient2', 'pclient2', '2014-06-29', 'client2@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1),
(4, 'q2586', 'nclient3', 'pclient3', '2014-06-29', 'client3@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1),
(5, 'hv2558', 'nclient4', 'pclient4', '2018-06-29', 'client4@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 1),
(6, 'Q3261542', 'client1', 'client1', '1997-05-05', 'eclient1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`),
  ADD KEY `FK_id_projet` (`id_projet`);

--
-- Index pour la table `liverable`
--
ALTER TABLE `liverable`
  ADD PRIMARY KEY (`id_liverable`),
  ADD KEY `FK_id_projet` (`id_projet`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `FK_id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liverable`
--
ALTER TABLE `liverable`
  MODIFY `id_liverable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
