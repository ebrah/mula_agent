-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2019 at 07:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mula_agent`
--

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `agentcode` int(30) NOT NULL,
  `startimes` int(30) NOT NULL,
  `azamtv` int(10) DEFAULT NULL,
  `dstv` int(10) DEFAULT NULL,
  `halotel` int(10) DEFAULT NULL,
  `ttcl` int(10) DEFAULT NULL,
  `total_commission` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `date`, `agentcode`, `startimes`, `azamtv`, `dstv`, `halotel`, `ttcl`, `total_commission`) VALUES
(1, '2019-02-25', 100, 3, 2, 1, 2, 1, 100),
(2, '2019-02-27', 100, 3, 12, 33, 32, 23, 52400);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `startimes` float NOT NULL,
  `azamtv` float NOT NULL,
  `dstv` float NOT NULL,
  `halotel` float NOT NULL,
  `ttcl` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `startimes`, `azamtv`, `dstv`, `halotel`, `ttcl`) VALUES
(1, 1000, 1000, 300, 500, 500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `agent` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `code` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `agent`, `active`, `code`) VALUES
(22, 'adamson@gmail.com', '$2y$10$4gE28a.BCFtSTHa1tvbn6OeM3ksPGUBunGQkX5GL8H2jEL2TAJHEy', 0, 1, NULL),
(23, 'jame@gmail.com', '$2y$10$IVnwg3WqClDJ/TVRqy285ut334lgZyupAWWIFx6O/ZA/1CagOc4dG', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekly`
--

CREATE TABLE `weekly` (
  `id` int(10) NOT NULL,
  `start_week_date` date NOT NULL,
  `end_week_date` date NOT NULL,
  `agentcode` int(30) NOT NULL,
  `weekly_commission` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `weekly`
--

INSERT INTO `weekly` (`id`, `start_week_date`, `end_week_date`, `agentcode`, `weekly_commission`) VALUES
(0, '2019-02-25', '2019-03-03', 100, 52500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`agentcode`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `weekly`
--
ALTER TABLE `weekly`
  ADD KEY `agentcode` (`agentcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `weekly`
--
ALTER TABLE `weekly`
  ADD CONSTRAINT `weekly_ibfk_1` FOREIGN KEY (`agentcode`) REFERENCES `commission` (`agentcode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
