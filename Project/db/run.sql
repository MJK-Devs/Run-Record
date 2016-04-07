-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2013 at 03:45 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

USE knovak18;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Database: `run`
--

-- --------------------------------------------------------

--
-- Table structure for table `rruser`
--
DROP TABLE IF EXISTS `rruser`;
CREATE TABLE IF NOT EXISTS `rruser` (
    `UserID` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
    `Username` varchar(50) NOT NULL UNIQUE,
    `Password` varchar(50) NOT NULL,
    `Email` varchar(50) NOT NULL UNIQUE,
    `FirstName` varchar(50) NOT NULL,
    `LastName` varchar(50) NOT NULL,
    `DOB` date DEFAULT NULL,
    `Gender` char DEFAULT NULL,
    `Weight` int(11) DEFAULT '0',
    `JoinDate` timestamp DEFAULT current_timestamp,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rruser`
--

INSERT INTO `rruser` (`UserID`, `Username`, `Password`, `Email`, `FirstName`, `LastName`, `DOB`, `Gender`, `Weight`) VALUES
    (1, "knovak18", "web2", "knovak18@kent.edu", "Kevin", "Novak", "1993-11-28", "M", 140),
    (2, "knovak19", "web3", "knovak19@kent.edu", "Kevin", "Novak", "1993-11-29", "M", 141);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `rrruns`
--
DROP TABLE IF EXISTS `rrruns`;
CREATE TABLE IF NOT EXISTS `rrruns` (
    `RunID` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
    `Date` date NOT NULL,
    `Distance` int(11) DEFAULT '0',
    `Time` int(11) DEFAULT '0',
    `AddDate` timestamp DEFAULT current_timestamp,
    PRIMARY KEY (`RunID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rrruns`
--

INSERT INTO `rrruns` (`RunID`, `Date`, `Distance`, `Time`) VALUES
    (1, "2016-04-03", 2, 720),
    (2, "2016-03-28", 3, 923),
    (3, "2016-03-23", 3, 937),
    (4, "2016-03-22", 3, 933);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `rruserruns`
--
DROP TABLE IF EXISTS `rruserruns`;
CREATE TABLE IF NOT EXISTS `rruserruns` (
    `UserID` int(11) NOT NULL,
    `RunID` int(11) NOT NULL,
    PRIMARY KEY (`UserID`, `RunID`),
    KEY `UserID` (`UserID`),
    KEY `RunID` (`RunID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rrruns`
--

INSERT INTO `rruserruns` (`UserID`, `RunID`) VALUES
    (1, 1),
    (1, 3),
    (1, 4),
    (2, 2);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
