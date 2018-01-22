-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2017 at 09:31 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mpvawards`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `aname` varchar(16) NOT NULL,
  `apass` varchar(16) NOT NULL,
  `astatus` int(11) NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `aid` (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apass`, `astatus`) VALUES
(1, 'admin', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `binnacle`
--

CREATE TABLE IF NOT EXISTS `binnacle` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `buser` int(11) NOT NULL,
  `bcategory` int(11) NOT NULL,
  `bvote` int(11) NOT NULL,
  `bdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `clabel` varchar(255) NOT NULL,
  `cdesc` text NOT NULL,
  `corder` int(11) NOT NULL,
  `csex` int(11) NOT NULL DEFAULT '3',
  `cdepartment` int(11) NOT NULL DEFAULT '0',
  `cstatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `clabel`, `cdesc`, `corder`, `csex`, `cdepartment`, `cstatus`) VALUES
(1, 'El más responsable', '', 1, 0, 0, 1),
(2, 'El más servicial', '', 2, 0, 0, 1),
(3, 'El más pellizquito', '', 3, 0, 0, 1),
(4, 'El más fashionista', '', 4, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `dlabel` varchar(32) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`did`, `dlabel`) VALUES
(1, 'LaTres'),
(2, 'Copernico');

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE IF NOT EXISTS `metas` (
  `mid` int(11) NOT NULL,
  `mlabel` varchar(16) NOT NULL,
  `mvalue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE IF NOT EXISTS `sex` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `slabel` varchar(50) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`sid`, `slabel`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `upass` varchar(50) NOT NULL,
  `ufb` varchar(100) DEFAULT NULL,
  `usex` int(11) NOT NULL,
  `udepartment` int(11) NOT NULL DEFAULT '1',
  `ustatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`, `ufb`, `usex`, `udepartment`, `ustatus`) VALUES
(1, 'Harold Soto', '109970929', '728916083', 1, 1, 1),
(2, 'Brenda Vargas', '000', '100000209958172', 2, 1, 1),
(3, 'Mauricio Segura', '000', '1070360747', 1, 1, 1),
(4, 'Stephanie Altamirano', '000', '100001084872118', 2, 1, 1),
(5, 'Jennifer Barrientos', '000', '740184222', 2, 1, 1),
(6, 'Viktor Infante', '000', '100000635867826', 1, 1, 1),
(7, 'Irene Guzmán', '000', '1271643595', 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
