-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2019 at 04:33 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `normalized_data`
--

CREATE TABLE `normalized_data` (
  `id` int(11) NOT NULL,
  `ticketID` int(20) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `mobileNo` varchar(50) NOT NULL,
  `contactType` varchar(20) NOT NULL,
  `callType` varchar(20) NOT NULL,
  `sourceName` varchar(50) NOT NULL,
  `storeID` int(10) NOT NULL,
  `questionTypeID` int(10) NOT NULL,
  `questionSubTypeID` int(10) NOT NULL,
  `dispositionName` varchar(50) NOT NULL,
  `DateCreated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question_sub_types`
--

CREATE TABLE `question_sub_types` (
  `id` int(11) NOT NULL,
  `questionSubType` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` int(11) NOT NULL,
  `questionType` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `raw_data`
--

CREATE TABLE `raw_data` (
  `id` int(11) NOT NULL,
  `ticketID` int(50) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `mobileNo` varchar(100) NOT NULL,
  `contactType` varchar(50) NOT NULL,
  `callType` varchar(50) NOT NULL,
  `sourceName` varchar(50) NOT NULL,
  `storeName` varchar(100) NOT NULL,
  `questionType` varchar(50) NOT NULL,
  `questionSubType` varchar(100) NOT NULL,
  `dispositionName` varchar(100) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `storeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `normalized_data`
--
ALTER TABLE `normalized_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticketID` (`ticketID`),
  ADD KEY `storeID` (`storeID`),
  ADD KEY `questionTypeID` (`questionTypeID`),
  ADD KEY `questionSubTypeID` (`questionSubTypeID`);

--
-- Indexes for table `question_sub_types`
--
ALTER TABLE `question_sub_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `questionSubType` (`questionSubType`) USING BTREE;

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `questionType` (`questionType`) USING BTREE;

--
-- Indexes for table `raw_data`
--
ALTER TABLE `raw_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `storeName` (`storeName`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `normalized_data`
--
ALTER TABLE `normalized_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `question_sub_types`
--
ALTER TABLE `question_sub_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `raw_data`
--
ALTER TABLE `raw_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1036;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `normalized_data`
--
ALTER TABLE `normalized_data`
  ADD CONSTRAINT `normalized_data_ibfk_1` FOREIGN KEY (`storeID`) REFERENCES `stores` (`id`),
  ADD CONSTRAINT `normalized_data_ibfk_2` FOREIGN KEY (`questionTypeID`) REFERENCES `question_types` (`id`),
  ADD CONSTRAINT `normalized_data_ibfk_3` FOREIGN KEY (`questionSubTypeID`) REFERENCES `question_sub_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
