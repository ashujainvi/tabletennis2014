-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2013 at 10:18 PM
-- Server version: 5.5.27
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tt`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `Eid` int(2) NOT NULL AUTO_INCREMENT,
  `Ename` varchar(50) NOT NULL,
  `Agelimit` int(2) NOT NULL,
  `Birthdate` date NOT NULL,
  `Gender` int(1) NOT NULL,
  PRIMARY KEY (`Eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Eid`, `Ename`, `Agelimit`, `Birthdate`, `Gender`) VALUES
(1, 'Men', 100, '1913-01-01', 1),
(2, 'Women', 100, '1913-01-01', 0),
(3, 'Youth_boys', 21, '1993-01-01', 1),
(4, 'YouthGirls', 21, '1993-01-01', 0),
(5, 'Boys', 18, '1996-01-01', 1),
(6, 'Girls', 18, '1996-01-01', 0),
(7, 'MatersMen', 40, '1973-01-01', 1),
(8, 'MatersWomen', 40, '1973-01-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `Pid` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` int(1) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Institution` varchar(100) NOT NULL,
  `ContactNo` varchar(10) NOT NULL,
  `EmailId` varchar(50) NOT NULL,
  `Member` int(1) NOT NULL,
  `Accomodation` int(1) NOT NULL,
  PRIMARY KEY (`Pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`Pid`, `Name`, `DOB`, `Gender`, `Address`, `Institution`, `ContactNo`, `EmailId`, `Member`, `Accomodation`) VALUES
(1000, 'yanay', '1993-10-10', 1, 'KAG', 'KGB', '9971528807', 'tanay1400089@gmail.com', 1, 1),
(1001, 'tanay', '2013-10-21', 1, 'Kahn', 'AKGEC', '9873456876', 'tanay1400089@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `single`
--

CREATE TABLE IF NOT EXISTS `single` (
  `Pid` int(5) NOT NULL,
  `Eid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `single`
--

INSERT INTO `single` (`Pid`, `Eid`) VALUES
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `Tid` int(5) NOT NULL AUTO_INCREMENT,
  `LeaderId` int(5) NOT NULL,
  `Member1` int(5) NOT NULL,
  `Member2` int(5) NOT NULL,
  PRIMARY KEY (`Tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
