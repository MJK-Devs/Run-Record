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

--
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
    `JoinDate` date DEFAULT NULL,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `rr-user`
--

INSERT INTO `rruser` (`UserID`, `Username`, `Password`, `Email`, `FirstName`, `LastName`, `DOB`, `Gender`, `Weight`, `JoinDate`) VALUES
    (1, "knovak18", "web2", "knovak18@kent.edu", "Kevin", "Novak", "1993-11-28", "M", 140, "2016-03-16");

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
