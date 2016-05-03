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
    `Height` int(11) DEFAULT '0',
    `Weight` int(11) DEFAULT '0',
    `State` varchar(20),
    `City` varchar(30),
    `ZipCode` int(11) DEFAULT '0',
    `AboutMe` varchar(300),
    `JoinDate` timestamp DEFAULT current_timestamp,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rruser`
--

INSERT INTO `rruser` (`UserID`, `Username`, `Password`, `Email`, `FirstName`, `LastName`, `DOB`, `Gender`, `Height`, `Weight`, `State`, `City`, `ZipCode`, `AboutMe`) VALUES
    (1, "knovak18", "web2", "knovak18@kent.edu", "Kevin", "Novak", "1993-11-28", "m", 66, 140, "Ohio", "Kent", 44243, "This is me."),
    (2, "mboehlke", "pass1234", "mboehlke@kent.edu", "Matt", "Boehlke", "1995-05-06", "m", 69, 165, "Ohio", "Kent", 44243, "I wanted to write something about me!"),
    (3, "jason", "password", "jryan@kent.edu", "Jason", "Ryan", "1995-01-02", "m", 74, 175, "Ohio", "Madison", 44057, "This is me.");
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `rrruns`
--
DROP TABLE IF EXISTS `rrruns`;
CREATE TABLE IF NOT EXISTS `rrruns` (
    `RunID` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
    `Date` date NOT NULL,
    `Distance` DECIMAL(6,2) DEFAULT '0',
    `Time` int(11) DEFAULT '0',
    `TimeOfDay` text,
    `Difficulty` text,
    `Terrain` text,
    `Conditions` text,
    `Temperature` text,
    `Comments` text,
    `AddDate` timestamp DEFAULT current_timestamp,
    PRIMARY KEY (`RunID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rrruns`
--

INSERT INTO `rrruns` (`RunID`, `Date`, `Distance`, `Time`, `TimeOfDay`, `Difficulty`, `Terrain`, `Conditions`, `Temperature`, `Comments`) VALUES
    (1, "2016-04-29", 2.00, 948, "Morning", "Difficult", "Road", "Sunny", "Warm", "Very tiring."),
    (2, "2016-04-30", 3.00, 1240, "Afternoon", "Somewhat difficult", "Road", "Normal", "Pleasant", "A good run."),
    (3, "2016-05-01", 3.25, 1663, "Morning", "Somewhat difficult", "Road", "Sunny", "Pleasant", "Stopped a little early."),
    (4, "2016-05-03", 2.25, 921, "Evening", "Normal", "Sidewalk", "Normal", "Chilly", "Should have worn more layers."),
    (5, "2016-04-28", 4.00, 2135, "Night", "Normal", "Grass", "Sunny", "Warm", "Personal best."),
    (6, "2016-04-30", 5.00, 2314, "Night", "Somewhat difficult", "Grass", "Sunny", "Warm", "Good run."),
    (7, "2016-05-02", 6.15, 2414, "Night", "Hard", "Treadmill", "Sunny", "Warm", "Very tiring."),
    (8, "2016-05-03", 1.00, 358, "Evening", "Normal", "Track (outdoor)", "Normal", "Pleasant", "Fanatasic run."),
    (9, "2016-04-28", 3.50, 1470, "Morning", "Normal", "Track (outdoor)", "Normal", "Pleasant", "Remember to bring more water."),
    (10, "2016-04-30", 2.50, 1304, "Afternoon", "Somewhat difficult", "Track (indoor)", "Windy", "Pleasant", "Too windy today."),
    (11, "2016-05-01", 3.75, 1932, "Afternoon", "Difficult", "Treadmill", "Normal", "Chilly", "Half hour cooldown."),
    (12, "2016-05-03", 4.00, 2013, "Morning", "Hard", "Track (outdoor)", "Windy", "Chilly", "Very tiring.");

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
    (1, 2),
    (1, 3),
    (1, 4),
    (2, 5),
    (2, 6),
    (2, 7),
    (2, 8),
    (3, 9),
    (3, 10),
    (3, 11),
    (3, 12);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
