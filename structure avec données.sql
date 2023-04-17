-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 17 avr. 2023 à 16:00
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mission_secrete`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id_admin` char(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `mail` varchar(254) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateCreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id_admin`, `name`, `firstname`, `mail`, `password`, `dateCreation`) VALUES
('126b13bf-d23e-11ed-b1ac-00155d7820ba', 'Doe', 'John', 'johndoe@gmail.com', '$2y$10$G581njHH3dLqeFoU6lqSFu2bVXayoLNU4kWZX9tgYxZvr6F.Nba2S', '2023-04-03 18:39:15');

-- --------------------------------------------------------

--
-- Structure de la table `agents`
--

CREATE TABLE `agents` (
  `code_agent` int(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `specialities` set('Infiltration','Reconnaissance','Assassinat','Combat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agents`
--

INSERT INTO `agents` (`code_agent`, `name`, `firstname`, `dateBirth`, `nationality`, `specialities`) VALUES
(107, 'Aznavour', 'Charles', '1966-07-08', 'Francais', 'Infiltration,Assassinat'),
(114, 'Blunt', 'Anthony', '1995-11-18', 'Americain', 'Infiltration,Reconnaissance'),
(247, 'Philby', 'Kim', '1988-06-25', 'Britannique', 'Assassinat'),
(333, 'Iglesias', 'Julio', '1975-08-13', 'Espagnol', 'Combat'),
(641, 'Einstein', 'Albert', '1960-01-27', 'Allemand', 'Reconnaissance');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `codeName` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`codeName`, `name`, `firstname`, `dateBirth`, `nationality`) VALUES
('Baskerville', 'Holmes', 'Sherlock', '1960-05-22', 'Britannique'),
('Chauve-souris', 'Wayne', 'Bruce', '1976-03-04', 'Americain'),
('Eveque', 'Camillo', 'Don', '1967-05-11', 'Espagnol'),
('Pelican', 'Guetta', 'David', '1989-06-07', 'Francais'),
('Winden', 'Kahnwald', 'Jonas', '2000-09-21', 'Allemand');

-- --------------------------------------------------------

--
-- Structure de la table `hideouts`
--

CREATE TABLE `hideouts` (
  `code_hideout` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hideouts`
--

INSERT INTO `hideouts` (`code_hideout`, `address`, `country`, `type`) VALUES
('Blitz', 'Leipziger Straße 56,Wulften', 'Allemagne', 'Abri anti-nucléaire'),
('Bunker', '6 rue Saussier-Leroy, Paris', 'France', 'Abri souterrain'),
('Nest', '828 Cherry St.Deland, FL 32720', 'Amerique', 'Maison en pleine montagne'),
('Tomato', 'Ctra. de Siles 54,Folgoso Do Courel', 'Espagne', 'Appartement en ville'),
('Wellington', '42 Eastbourne Rd,Collier Street', 'Angleterre', 'Maison isolée en forêt');

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `code_mission` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `agents` int(3) NOT NULL,
  `contacts` varchar(15) NOT NULL,
  `targets` varchar(7) NOT NULL,
  `missionType` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `hideouts` varchar(15) DEFAULT NULL,
  `specialityRequired` enum('Infiltration','Reconnaissance','Assassinat','Combat') NOT NULL,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`code_mission`, `title`, `description`, `country`, `agents`, `contacts`, `targets`, `missionType`, `status`, `hideouts`, `specialityRequired`, `dateStart`, `dateEnd`) VALUES
('23056SNO', 'Infiltration', 'Infiltration d\' un gang à la réputation violente', 'Amerique', 333, 'Chauve-souris', 'AJAX', 'Infiltration à haut risque', 'Terminée', NULL, 'Combat', '2015-06-25', '2016-01-17'),
('478VFXJ7774PM', 'Reconnaissance territoire ennemi', 'Mission d\'infiltration et d\'espionnage', 'Allemagne', 114, 'Winden', 'SIGMA', 'Surveillance', 'En cours', NULL, 'Reconnaissance', '2022-06-19', '2022-07-02'),
('7854MGRDCS7', 'Assassinat important', 'Elimination d\' une cible de haute importance', 'France', 247, 'Pelican', 'FELIX', 'Assassinat', 'Terminée', 'Bunker', 'Assassinat', '2004-02-17', '2004-05-22'),
('7854XUNYD', 'Surveilance', 'Surveillance des deplacements d\' une cible prioritaire', 'Angleterre', 641, 'Baskerville', 'FELIX', 'Surveillance et filature', 'Echec', 'Wellington', 'Reconnaissance', '2020-11-25', '2022-01-11'),
('QCHWF258', 'Assassinat', 'Assassinat d\' une cible et son entourage', 'Allemagne', 107, 'Winden', 'BIGBEN', 'Meurtre', 'Terminée', 'Blitz', 'Assassinat', '2007-01-21', '2007-02-14'),
('QCWPO734', 'Elimination', 'Elimination d\' un groupe armé', 'Espagne', 333, 'Eveque', 'FELIX', 'Mission à haut risque', 'En cours', 'Tomato', 'Combat', '2022-08-05', '2022-07-02'),
('SRFD785', 'Infiltration à haut risque', 'Mission d\' infiltration périlleuse et technique', 'Espagne', 107, 'Eveque', 'DJANGO', 'Discrétion et furtivité', 'Echec', 'Tomato', 'Infiltration', '2017-05-06', '2017-05-07'),
('WFRTG214', 'Observation', 'Observation tactique d\' une base ennemie hostile et élimination si possible de son directeur', 'Angleterre', 641, 'Baskerville', 'BIGBEN', 'Observation et possible assassinat', 'Echec', 'Wellington', 'Reconnaissance', '2018-12-20', '2019-01-20'),
('XDJOR3971', 'Assassinat', 'Assassinat d\' une cible sous haute surveillance', 'Amerique', 247, 'Chauve-souris', 'DJANGO', 'Meurtre', 'Terminée', 'Nest', 'Assassinat', '2009-04-21', '2009-05-19'),
('ZARTKN29', 'Infiltration', 'Infiltration d\' une soirée mondaine pour récolter les informations de l\' hôte', 'Allemagne', 107, 'Winden', 'SIGMA', 'Infiltration et recolte d\' informations', 'Terminée', NULL, 'Infiltration', '2013-03-17', '2013-03-18');

-- --------------------------------------------------------

--
-- Structure de la table `targets`
--

CREATE TABLE `targets` (
  `code_target` varchar(7) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `targets`
--

INSERT INTO `targets` (`code_target`, `name`, `firstname`, `dateBirth`, `nationality`) VALUES
('AJAX', 'Eastwood', 'Clint', '1975-04-05', 'Americain'),
('BIGBEN', 'Johnson', 'James', '1994-05-22', 'Britannique'),
('DJANGO', 'Smith', 'John', '1995-02-21', 'Allemand'),
('FELIX', 'Dupond', 'Jacques', '1956-08-17', 'Francais'),
('SIGMA', 'de la Vega', 'Don Diego', '1987-12-07', 'Espagnol');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`code_agent`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`codeName`);

--
-- Index pour la table `hideouts`
--
ALTER TABLE `hideouts`
  ADD PRIMARY KEY (`code_hideout`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`code_mission`),
  ADD KEY `agents` (`agents`),
  ADD KEY `contacts` (`contacts`),
  ADD KEY `targets` (`targets`),
  ADD KEY `hideouts` (`hideouts`);

--
-- Index pour la table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`code_target`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_ibfk_1` FOREIGN KEY (`agents`) REFERENCES `agents` (`code_agent`),
  ADD CONSTRAINT `missions_ibfk_2` FOREIGN KEY (`contacts`) REFERENCES `contacts` (`codeName`),
  ADD CONSTRAINT `missions_ibfk_3` FOREIGN KEY (`targets`) REFERENCES `targets` (`code_target`),
  ADD CONSTRAINT `missions_ibfk_4` FOREIGN KEY (`hideouts`) REFERENCES `hideouts` (`code_hideout`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
