-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2023 at 01:37 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `missions_secretes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` char(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `mail` varchar(254) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateCreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `code_agent` int(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `specialities` set('Infiltration','Reconnaissance','Assassinat','Combat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `codeName` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hideouts`
--

CREATE TABLE `hideouts` (
  `code_hideout` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `missions`
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

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `code_target` varchar(7) NOT NULL,
  `name` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `dateBirth` date NOT NULL,
  `nationality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`code_agent`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`codeName`);

--
-- Indexes for table `hideouts`
--
ALTER TABLE `hideouts`
  ADD PRIMARY KEY (`code_hideout`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`code_mission`),
  ADD KEY `agents` (`agents`),
  ADD KEY `contacts` (`contacts`),
  ADD KEY `targets` (`targets`),
  ADD KEY `hideouts` (`hideouts`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`code_target`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `missions`
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
