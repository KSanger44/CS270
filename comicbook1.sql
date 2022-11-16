-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2021 at 04:06 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ComicBook1`
--
CREATE DATABASE IF NOT EXISTS `ComicBook1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ComicBook1`;

-- --------------------------------------------------------

--
-- Table structure for table `COLLECTIONS`
--

CREATE TABLE `COLLECTIONS` (
  `CollectionID` int(11) NOT NULL,
  `Owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `COLLECTIONS`
--

INSERT INTO `COLLECTIONS` (`CollectionID`, `Owner`) VALUES
(1, 'KSanger'),
(2, 'PKuhn'),
(3, 'PKuhn');

-- --------------------------------------------------------

--
-- Table structure for table `COLLECTIONS_ITEMS`
--

CREATE TABLE `COLLECTIONS_ITEMS` (
  `ItemID` int(11) NOT NULL,
  `CollectionID` int(11) NOT NULL,
  `IssueID` int(11) NOT NULL,
  `NumberOFCopies` int(11) DEFAULT NULL,
  `Condition` float DEFAULT NULL,
  `EstPrice` float DEFAULT NULL,
  `ContainerID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `COLLECTIONS_ITEMS`
--

INSERT INTO `COLLECTIONS_ITEMS` (`ItemID`, `CollectionID`, `IssueID`, `NumberOFCopies`, `Condition`, `EstPrice`, `ContainerID`) VALUES
(1, 1, 1, 2, 9.2, 1100000, 'Crate 1'),
(2, 2, 3, 1, 9.8, 2500, 'Box 3'),
(3, 3, 1, 1, 8.5, 49000, 'Box 4');

-- --------------------------------------------------------

--
-- Table structure for table `ISSUES`
--

CREATE TABLE `ISSUES` (
  `IssueID` int(11) NOT NULL,
  `SeriesID` int(11) NOT NULL,
  `IssueNum` int(11) NOT NULL,
  `AlternativeIssueData` varchar(100) DEFAULT NULL,
  `GuestCharacter` varchar(100) DEFAULT NULL,
  `Notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ISSUES`
--

INSERT INTO `ISSUES` (`IssueID`, `SeriesID`, `IssueNum`, `AlternativeIssueData`, `GuestCharacter`, `Notes`) VALUES
(1, 1, 1, '', '', 'First Appearance of Jonah Jameson'),
(2, 1, 14, '', 'Green Goblin', 'First Battle with the Green Goblin'),
(3, 2, 100, '', 'Hercules', 'Return of Swordsman');

-- --------------------------------------------------------

--
-- Table structure for table `SERIES`
--

CREATE TABLE `SERIES` (
  `SeriesID` int(11) NOT NULL,
  `SeriesName` varchar(100) NOT NULL,
  `Volume` int(11) DEFAULT NULL,
  `PrimaryCharacter` varchar(100) DEFAULT NULL,
  `PrimaryWriter` varchar(100) DEFAULT NULL,
  `FirstPubDate` date DEFAULT NULL,
  `LastPubDate` date DEFAULT NULL,
  `Notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SERIES`
--

INSERT INTO `SERIES` (`SeriesID`, `SeriesName`, `Volume`, `PrimaryCharacter`, `PrimaryWriter`, `FirstPubDate`, `LastPubDate`, `Notes`) VALUES
(1, 'The Amazing Spiderman', 1, 'Spiderman', 'Stan Lee', '1963-03-01', '1995-10-01', ''),
(2, 'The Avengers', 1, 'Avengers', 'Stan Lee', '1963-09-01', '1996-09-01', ''),
(3, 'The Amazing Spiderman', 2, 'Spiderman', 'Howard Mackie', '1999-01-01', '2003-10-01', 'issue numbering uses both a new system and continues vol 1 numbering');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `EmailAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='To track each user.';

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`UserName`, `Password`, `EmailAddress`) VALUES
('KSanger', 'test2', 'ksanger@edgewood.edu'),
('PKuhn', 'test1', 'pkuhn@edgewood.edu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `COLLECTIONS`
--
ALTER TABLE `COLLECTIONS`
  ADD PRIMARY KEY (`CollectionID`),
  ADD KEY `COLLECTIONS_FK` (`Owner`);

--
-- Indexes for table `COLLECTIONS_ITEMS`
--
ALTER TABLE `COLLECTIONS_ITEMS`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `COLLECTIONS_ITEMS_FK` (`CollectionID`),
  ADD KEY `COLLECTIONS_ITEMS_FK_1` (`IssueID`);

--
-- Indexes for table `ISSUES`
--
ALTER TABLE `ISSUES`
  ADD PRIMARY KEY (`IssueID`),
  ADD KEY `ISSUES_FK` (`SeriesID`);

--
-- Indexes for table `SERIES`
--
ALTER TABLE `SERIES`
  ADD PRIMARY KEY (`SeriesID`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `COLLECTIONS`
--
ALTER TABLE `COLLECTIONS`
  MODIFY `CollectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `COLLECTIONS_ITEMS`
--
ALTER TABLE `COLLECTIONS_ITEMS`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `ISSUES`
--
ALTER TABLE `ISSUES`
  MODIFY `IssueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `SERIES`
--
ALTER TABLE `SERIES`
  MODIFY `SeriesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `COLLECTIONS`
--
ALTER TABLE `COLLECTIONS`
  ADD CONSTRAINT `COLLECTIONS_FK` FOREIGN KEY (`Owner`) REFERENCES `USERS` (`UserName`);

--
-- Constraints for table `COLLECTIONS_ITEMS`
--
ALTER TABLE `COLLECTIONS_ITEMS`
  ADD CONSTRAINT `COLLECTIONS_ITEMS_FK` FOREIGN KEY (`CollectionID`) REFERENCES `COLLECTIONS` (`CollectionID`),
  ADD CONSTRAINT `COLLECTIONS_ITEMS_FK_1` FOREIGN KEY (`IssueID`) REFERENCES `ISSUES` (`IssueID`);

--
-- Constraints for table `ISSUES`
--
ALTER TABLE `ISSUES`
  ADD CONSTRAINT `ISSUES_FK` FOREIGN KEY (`SeriesID`) REFERENCES `SERIES` (`SeriesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
