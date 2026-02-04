-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2015 at 12:53 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbfna`
--
CREATE DATABASE IF NOT EXISTS `dbfna` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbfna`;

-- --------------------------------------------------------

--
-- Table structure for table `feed_finishedstock`
--

CREATE TABLE IF NOT EXISTS `feed_finishedstock` (
  `FINISHEDSTOCKID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PRODUCTIONID` int(11) NOT NULL,
  `FOODID` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `FOODTOTQNTY` double NOT NULL,
  `AMOUNT` double NOT NULL,
  `TOTAMOUNT` double NOT NULL,
  `AVGPRICE` double NOT NULL,
  `FOODFLAG` int(11) NOT NULL,
  `WORKFLAG` varchar(20) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`FINISHEDSTOCKID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `feed_finishedstock`
--

INSERT INTO `feed_finishedstock` (`FINISHEDSTOCKID`, `PROJECTID`, `SUBPROJECTID`, `PRODUCTIONID`, `FOODID`, `QUANTITY`, `FOODTOTQNTY`, `AMOUNT`, `TOTAMOUNT`, `AVGPRICE`, `FOODFLAG`, `WORKFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(31, 2, 6, 39, 3, 1800, 1800, 113130, 113130, 62.85, 1, 'In', 20, 'Active', 0, '2015-01-02', '16:35:22 PM'),
(32, 2, 6, 43, 3, 500, 2300, 31425, 144555, 62.85, 2, 'In', 20, 'Active', 0, '2015-01-03', '17:00:10 PM'),
(33, 2, 6, 44, 3, 1800, 4100, 123264, 267819, 65.321707317073, 3, 'In', 20, 'Active', 0, '2015-01-02', '17:07:03 PM'),
(34, 2, 6, 45, 3, 1800, 5900, 123264, 391083, 66.285254237288, 4, 'In', 20, 'Active', 0, '2015-01-01', '17:17:36 PM'),
(35, 3, 8, 0, 3, 117.5, 5782.5, 8611.0174, 382471.9826, 66.285254237288, 5, 'Out', 20, 'Active', 0, '2015-01-05', '17:47:09 PM'),
(36, 3, 8, 0, 3, 94, 5688.5, 6888.8139, 375583.1687, 66.285254237288, 6, 'Out', 20, 'Active', 0, '2015-01-07', '17:55:53 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_fooditem`
--

CREATE TABLE IF NOT EXISTS `feed_fooditem` (
  `FOODID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `FOODNAME` varchar(100) NOT NULL,
  `DETAILS` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`FOODID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `feed_fooditem`
--

INSERT INTO `feed_fooditem` (`FOODID`, `PROJECTID`, `SUBPROJECTID`, `FOODNAME`, `DETAILS`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 2, 6, 'Layer (60-70) Weeks', 'Layer', 20, 'Active', 0, '2014-12-14', '19:15:33 PM'),
(2, 2, 6, 'Layer (35-60) Weeks', 'Layer', 20, 'Active', 0, '2014-12-14', '19:16:40 PM'),
(3, 2, 6, 'Grower (18-24) Weeks', 'Grower', 20, 'Active', 0, '2014-12-15', '18:51:20 PM'),
(4, 2, 6, 'Grower (31-60) Day', 'Grower', 20, 'Active', 0, '2014-12-15', '18:51:51 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_production`
--

CREATE TABLE IF NOT EXISTS `feed_production` (
  `PRODUCTIONID` int(11) NOT NULL AUTO_INCREMENT,
  `FOODID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` varchar(20) NOT NULL,
  `VOUCHERNO` varchar(20) NOT NULL,
  `PRODUCTIONQNTY` double NOT NULL,
  `PRODUCTIONDATE` date NOT NULL,
  `PRODUCTIONCOST` double NOT NULL,
  `AVGPRICE` double NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`PRODUCTIONID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `feed_production`
--

INSERT INTO `feed_production` (`PRODUCTIONID`, `FOODID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `VOUCHERNO`, `PRODUCTIONQNTY`, `PRODUCTIONDATE`, `PRODUCTIONCOST`, `AVGPRICE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(45, 3, 2, 6, '', '', 1800, '2015-01-01', 123264, 68.48, 20, 'Active', 0, '2015-01-10', '17:17:36 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_production_bkdn`
--

CREATE TABLE IF NOT EXISTS `feed_production_bkdn` (
  `PRODUCTIONBKDNID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTIONID` int(11) NOT NULL,
  `RECIPIID` int(11) NOT NULL,
  `RECIPIBKDNID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `WTID` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`PRODUCTIONBKDNID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `feed_production_bkdn`
--

INSERT INTO `feed_production_bkdn` (`PRODUCTIONBKDNID`, `PRODUCTIONID`, `RECIPIID`, `RECIPIBKDNID`, `PROJECTID`, `SUBPROJECTID`, `PRODUCTID`, `QUANTITY`, `WTID`, `PRICE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(103, 45, 9, 35, 2, 6, 76, 360, 1, 36000, 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(104, 45, 9, 36, 2, 6, 79, 270, 1, 21600, 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(105, 45, 9, 37, 2, 6, 78, 360, 1, 17280, 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(106, 45, 9, 38, 2, 6, 81, 360, 1, 16200, 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(107, 45, 9, 39, 2, 6, 77, 360, 1, 28080, 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(108, 45, 9, 40, 2, 6, 80, 90, 1, 4104, 20, 'Active', 0, '2015-01-10', '17:17:36 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_profitamount`
--

CREATE TABLE IF NOT EXISTS `feed_profitamount` (
  `PAID` int(11) NOT NULL AUTO_INCREMENT,
  `RATE` double NOT NULL,
  `PROFITFLAG` int(11) NOT NULL,
  `OPENING_PADATE` date NOT NULL,
  `CLOSING_PADATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`PAID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `feed_profitamount`
--

INSERT INTO `feed_profitamount` (`PAID`, `RATE`, `PROFITFLAG`, `OPENING_PADATE`, `CLOSING_PADATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(9, 6, 1, '2014-12-26', '2014-12-27', 20, 'Active', 1, '2014-12-26', '10:11:06 AM'),
(10, 7, 2, '2014-12-27', '2014-12-25', 20, 'Active', 2, '2014-12-26', '10:11:19 AM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_purchaserawmat`
--

CREATE TABLE IF NOT EXISTS `feed_purchaserawmat` (
  `PRMID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODCATTYPEID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `INVOICENO` varchar(20) NOT NULL,
  `UNITPRICE` double NOT NULL,
  `QUANTITY` double NOT NULL,
  `WTID` int(11) NOT NULL,
  `AMOUNT` double NOT NULL,
  `PURCHASEDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`PRMID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `feed_purchaserawmat`
--

INSERT INTO `feed_purchaserawmat` (`PRMID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `PRODCATTYPEID`, `PRODUCTID`, `INVOICENO`, `UNITPRICE`, `QUANTITY`, `WTID`, `AMOUNT`, `PURCHASEDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(76, 2, 6, 20, 10, 76, '1', 100, 1000, 1, 100000, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(77, 2, 6, 20, 10, 79, '1', 80, 1000, 1, 80000, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(78, 2, 6, 20, 10, 78, '1', 48, 1000, 1, 48000, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(79, 2, 6, 20, 10, 81, '1', 45, 1000, 1, 45000, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(80, 2, 6, 20, 10, 77, '1', 78, 1000, 1, 78000, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(81, 2, 6, 20, 10, 80, '1', 45.6, 1000, 1, 45600, '2015-01-01', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(82, 5, 7, 21, 11, 82, '2', 3, 100, 3, 300, '2015-01-05', 20, 'Active', 0, '2015-01-10', '18:01:54 PM'),
(83, 2, 6, 19, 10, 80, '3', 100, 120, 2, 12000, '2015-01-08', 20, 'Active', 0, '2015-01-18', '19:29:45 PM'),
(84, 2, 6, 19, 10, 76, '4', 100, 123, 1, 12300, '2015-01-05', 20, 'Active', 0, '2015-01-18', '19:32:27 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_rawmatstock`
--

CREATE TABLE IF NOT EXISTS `feed_rawmatstock` (
  `RMSID` int(11) NOT NULL AUTO_INCREMENT,
  `PRMID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODCATTYPEID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `TOTQNTY` double NOT NULL,
  `AMOUNT` double NOT NULL,
  `TOTAMOUNT` double NOT NULL,
  `UNITPRICE` double NOT NULL,
  `AVGPRICE` double NOT NULL,
  `PARTYTOTQNTY` double NOT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `PRODFLAG` int(11) NOT NULL,
  `WORKFLAG` varchar(20) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(20) NOT NULL,
  PRIMARY KEY (`RMSID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `feed_rawmatstock`
--

INSERT INTO `feed_rawmatstock` (`RMSID`, `PRMID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `PRODCATTYPEID`, `PRODUCTID`, `QUANTITY`, `TOTQNTY`, `AMOUNT`, `TOTAMOUNT`, `UNITPRICE`, `AVGPRICE`, `PARTYTOTQNTY`, `PARTYFLAG`, `PRODFLAG`, `WORKFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(172, 76, 2, 6, 20, 10, 76, 1000, 1000, 100000, 100000, 100, 100, 1000, 1, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(173, 77, 2, 6, 20, 10, 79, 1000, 1000, 80000, 80000, 80, 80, 1000, 2, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(174, 78, 2, 6, 20, 10, 78, 1000, 1000, 48000, 48000, 48, 48, 1000, 3, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(175, 79, 2, 6, 20, 10, 81, 1000, 1000, 45000, 45000, 45, 45, 1000, 4, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(176, 80, 2, 6, 20, 10, 77, 1000, 1000, 78000, 78000, 78, 78, 1000, 5, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(177, 81, 2, 6, 20, 10, 80, 1000, 1000, 45600, 45600, 45.6, 45.6, 1000, 6, 1, 'In', 20, 'Active', 0, '2015-01-10', '17:06:22 PM'),
(184, 76, 2, 6, 20, 10, 76, 360, 640, 36000, 64000, 100, 100, 1000, 2, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(185, 77, 2, 6, 20, 10, 79, 270, 730, 21600, 58400, 80, 80, 1000, 3, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(186, 78, 2, 6, 20, 10, 78, 360, 640, 17280, 30720, 48, 48, 1000, 4, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(187, 79, 2, 6, 20, 10, 81, 360, 640, 16200, 28800, 45, 45, 1000, 5, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(188, 80, 2, 6, 20, 10, 77, 360, 640, 28080, 49920, 78, 78, 1000, 6, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(189, 81, 2, 6, 20, 10, 80, 90, 910, 4104, 41496, 45.6, 45.6, 1000, 7, 2, 'Out', 20, 'Active', 0, '2015-01-10', '17:17:36 PM'),
(190, 82, 5, 7, 21, 11, 82, 100, 100, 300, 300, 3, 3, 100, 1, 1, 'In', 20, 'Active', 0, '2015-01-10', '18:01:54 PM'),
(191, 82, 5, 7, 21, 11, 82, 10, 90, 30, 270, 3, 3, 100, 2, 2, 'Out', 20, 'Active', 0, '2015-01-10', '18:02:15 PM'),
(192, 83, 2, 6, 19, 10, 80, 120, 1030, 12000, 53496, 100, 51.93786407767, 120, 1, 3, 'In', 20, 'Active', 0, '2015-01-18', '19:29:45 PM'),
(193, 84, 2, 6, 19, 10, 76, 123, 763, 12300, 76300, 100, 100, 123, 2, 3, 'In', 20, 'Active', 0, '2015-01-18', '19:32:27 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_recipi`
--

CREATE TABLE IF NOT EXISTS `feed_recipi` (
  `RECIPIID` int(11) NOT NULL AUTO_INCREMENT,
  `FOODID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `RECIPIDATE` date NOT NULL,
  `FOODQNTY` double NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`RECIPIID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `feed_recipi`
--

INSERT INTO `feed_recipi` (`RECIPIID`, `FOODID`, `PROJECTID`, `SUBPROJECTID`, `RECIPIDATE`, `FOODQNTY`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(9, 3, 2, 6, '2015-01-01', 100, 20, 'Active', 0, '2015-01-10', '16:32:18 PM');

-- --------------------------------------------------------

--
-- Table structure for table `feed_recipi_bkdn`
--

CREATE TABLE IF NOT EXISTS `feed_recipi_bkdn` (
  `RECIPIBKDNID` int(11) NOT NULL AUTO_INCREMENT,
  `RECIPIID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `WTID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`RECIPIBKDNID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `feed_recipi_bkdn`
--

INSERT INTO `feed_recipi_bkdn` (`RECIPIBKDNID`, `RECIPIID`, `PROJECTID`, `SUBPROJECTID`, `PRODUCTID`, `QUANTITY`, `WTID`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(35, 9, 2, 6, 76, 20, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM'),
(36, 9, 2, 6, 79, 15, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM'),
(37, 9, 2, 6, 78, 20, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM'),
(38, 9, 2, 6, 81, 20, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM'),
(39, 9, 2, 6, 77, 20, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM'),
(40, 9, 2, 6, 80, 5, 1, 20, 'Active', 0, '2015-01-10', '16:32:18 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_alustock`
--

CREATE TABLE IF NOT EXISTS `fna_alustock` (
  `ALUSID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTLOADUNLOADBKDNID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODCATTYPEID` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `LOTNO` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `LOTTOTQNTY` double NOT NULL,
  `PARTYTOTQNTY` double NOT NULL,
  `LOTFLAG` int(11) NOT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `WORKTYPEFLAG` varchar(100) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`ALUSID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `fna_alustock`
--

INSERT INTO `fna_alustock` (`ALUSID`, `PRODUCTLOADUNLOADBKDNID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `PRODCATTYPEID`, `PRODUCTID`, `LOTNO`, `QUANTITY`, `LOTTOTQNTY`, `PARTYTOTQNTY`, `LOTFLAG`, `PARTYFLAG`, `WORKTYPEFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(25, 85, 1, 1, 18, 5, 71, 19, 14, 14, 414, 1, 4, 'Load', 20, 'Active', 0, '2014-12-07', '13:14:46 PM'),
(26, 86, 1, 1, 18, 5, 71, 38, 12, 12, 426, 1, 5, 'Load', 20, 'Active', 0, '2014-12-07', '13:16:00 PM'),
(29, 89, 1, 1, 18, 5, 71, 19, 5, 9, 111, 2, 8, 'Unload', 20, 'Active', 0, '2014-12-10', '04:32:38 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_balance`
--

CREATE TABLE IF NOT EXISTS `fna_balance` (
  `BALANCEID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `INCOME` double NOT NULL,
  `EXPANSE` double NOT NULL,
  `BALANCE` double NOT NULL,
  `FLAG` int(11) NOT NULL,
  `BALDATE` date NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `USERID` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BALANCEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `fna_balance`
--

INSERT INTO `fna_balance` (`BALANCEID`, `PROJECTID`, `SUBPROJECTID`, `INCOME`, `EXPANSE`, `BALANCE`, `FLAG`, `BALDATE`, `STATUS`, `USERID`, `ENTDATE`, `ENTTIME`) VALUES
(3, 2, 6, 12000, 0, 12000, 1, '2015-01-08', 'Active', 20, '2015-01-07', '19:38:53 PM'),
(7, 2, 6, 0, 12300, -300, 2, '2015-01-09', 'Active', 20, '2015-01-07', '20:00:30 PM'),
(8, 6, 10, 20000000, 0, 19999700, 3, '2015-01-08', 'Active', 20, '2015-01-07', '20:04:01 PM'),
(9, 1, 1, 0, 12300, 19987400, 4, '2015-01-08', 'Active', 20, '2015-01-08', '15:38:29 PM'),
(10, 4, 9, 0, 200000, 19787400, 5, '2015-01-08', 'Active', 20, '2015-01-08', '15:49:11 PM'),
(12, 6, 10, 0, 20000, 19767400, 6, '2015-01-09', 'Active', 20, '2015-01-08', '20:30:33 PM'),
(13, 6, 10, 0, 5000, 19762400, 7, '2015-01-10', 'Active', 20, '2015-01-08', '20:31:06 PM'),
(14, 6, 10, 0, 15000, 19747400, 8, '2015-01-07', 'Active', 20, '2015-01-08', '20:31:57 PM'),
(15, 6, 10, 0, 15700, 19731700, 9, '2015-01-08', 'Active', 20, '2015-01-11', '18:49:49 PM'),
(16, 6, 10, 22000, 0, 19753700, 10, '2015-01-11', 'Active', 20, '2015-01-11', '18:50:51 PM'),
(17, 6, 10, 0, 34000, 19719700, 11, '2015-01-15', 'Active', 20, '2015-01-15', '11:58:25 AM'),
(18, 4, 9, 22000, 0, 19741700, 12, '2015-01-15', 'Active', 20, '2015-01-16', '19:14:15 PM'),
(19, 2, 6, 50000, 0, 19791700, 13, '2015-01-06', 'Active', 20, '2015-01-18', '19:23:19 PM'),
(20, 3, 8, 55000, 0, 19846700, 14, '2015-01-21', 'Active', 20, '2015-01-22', '16:45:18 PM'),
(21, 3, 8, 20000, 0, 19866700, 15, '2015-01-22', 'Active', 20, '2015-01-22', '19:08:12 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_bank`
--

CREATE TABLE IF NOT EXISTS `fna_bank` (
  `BANKID` int(11) NOT NULL AUTO_INCREMENT,
  `BANKNAME` varchar(100) NOT NULL,
  `ADDRESS` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BANKID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fna_bank`
--

INSERT INTO `fna_bank` (`BANKID`, `BANKNAME`, `ADDRESS`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(2, 'South East Bank', 'Mirpur', 20, 'Active', 0, '2015-01-08', '18:04:00 PM'),
(3, 'Eastern Bank Limited', 'Motijhil', 20, 'Active', 0, '2015-01-08', '19:10:42 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_bankaccount`
--

CREATE TABLE IF NOT EXISTS `fna_bankaccount` (
  `BANKACCOUNTID` int(11) NOT NULL AUTO_INCREMENT,
  `BANKID` int(11) NOT NULL,
  `BRANCHID` int(11) NOT NULL,
  `ACCOUNTNO` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BANKACCOUNTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fna_bankaccount`
--

INSERT INTO `fna_bankaccount` (`BANKACCOUNTID`, `BANKID`, `BRANCHID`, `ACCOUNTNO`, `DESCRIPTION`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 2, 1, '1234567890', 'komol', 20, 'Active', 0, '2015-01-08', '18:57:39 PM'),
(2, 2, 2, '0987654321', 'Sarker', 20, 'Active', 0, '2015-01-08', '19:09:10 PM'),
(3, 3, 3, '234123', 'asdfadas', 20, 'Active', 0, '2015-01-08', '19:11:36 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_banktransaction`
--

CREATE TABLE IF NOT EXISTS `fna_banktransaction` (
  `BTID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BANKID` int(11) NOT NULL,
  `BRANCHID` int(11) NOT NULL,
  `BANKACCOUNTID` int(11) NOT NULL,
  `ACCOUNTNO` varchar(100) NOT NULL,
  `DEPOSIT` double NOT NULL,
  `WITHDRAW` double NOT NULL,
  `BALANCE` double NOT NULL,
  `ACCOUNTBALANCE` double NOT NULL,
  `BTDATE` date NOT NULL,
  `ACCFLAG` int(11) NOT NULL,
  `BANKFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fna_banktransaction`
--

INSERT INTO `fna_banktransaction` (`BTID`, `PROJECTID`, `SUBPROJECTID`, `BANKID`, `BRANCHID`, `BANKACCOUNTID`, `ACCOUNTNO`, `DEPOSIT`, `WITHDRAW`, `BALANCE`, `ACCOUNTBALANCE`, `BTDATE`, `ACCFLAG`, `BANKFLAG`, `USERID`, `STATUS`, `ENTDATE`, `ENTTIME`) VALUES
(2, 6, 10, 3, 3, 0, '234123', 20000, 0, 20000, 20000, '2015-01-07', 1, 1, 20, 'Active', '2015-01-08', '20:30:33 PM'),
(3, 6, 10, 3, 3, 0, '234123', 5000, 0, 25000, 25000, '2015-01-08', 2, 2, 20, 'Active', '2015-01-08', '20:31:06 PM'),
(4, 6, 10, 2, 2, 0, '0987654321', 15000, 0, 40000, 15000, '2015-01-09', 1, 3, 20, 'Active', '2015-01-08', '20:31:57 PM'),
(5, 6, 10, 3, 3, 0, '234123', 15700, 0, 55700, 40700, '2015-01-10', 3, 4, 20, 'Active', '2015-01-11', '18:49:49 PM'),
(6, 6, 10, 3, 3, 0, '234123', 0, 22000, 33700, 18700, '2015-01-11', 4, 5, 20, 'Active', '2015-01-11', '18:50:51 PM'),
(7, 6, 10, 3, 3, 0, '234123', 34000, 0, 67700, 52700, '2015-01-15', 5, 6, 20, 'Active', '2015-01-15', '11:58:25 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_basta`
--

CREATE TABLE IF NOT EXISTS `fna_basta` (
  `BASTAID` int(11) NOT NULL AUTO_INCREMENT,
  `PARTYID` int(11) NOT NULL,
  `BUYQNTY` double NOT NULL,
  `TOTBUYQNTY` double NOT NULL,
  `SELLQNTY` double NOT NULL,
  `TOTSELLQNTY` double NOT NULL,
  `BALANCEQNTY` double NOT NULL,
  `BUYPRICE` double NOT NULL,
  `UNITPRICE` double NOT NULL,
  `TOTBUYPRICE` double NOT NULL,
  `SELLPRICE` double NOT NULL,
  `TOTSELLPRICE` double NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`BASTAID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fna_basta`
--

INSERT INTO `fna_basta` (`BASTAID`, `PARTYID`, `BUYQNTY`, `TOTBUYQNTY`, `SELLQNTY`, `TOTSELLQNTY`, `BALANCEQNTY`, `BUYPRICE`, `UNITPRICE`, `TOTBUYPRICE`, `SELLPRICE`, `TOTSELLPRICE`, `ENTRYDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 18, 0, 0, 100, 100, -100, 0, 170, 0, 17000, 17000, '0000-00-00', 20, 'Active', 1, '2014-12-08', '10:00:06 AM'),
(2, 0, 100, 100, 0, 0, 0, 1000, 10, 1000, 0, 0, '0000-00-00', 20, 'Active', 2, '2014-12-08', '10:04:13 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_bill`
--

CREATE TABLE IF NOT EXISTS `fna_bill` (
  `BID` int(11) NOT NULL AUTO_INCREMENT,
  `SESSIONID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(10) DEFAULT NULL,
  `RECEIVENUMBER` int(10) DEFAULT NULL,
  `PRODCATTYPEID` int(10) DEFAULT NULL,
  `PRODUCTID` int(10) DEFAULT NULL,
  `PACKINGUNITID` int(10) DEFAULT NULL,
  `QUANTITY` double DEFAULT NULL,
  `WTQNTY` double NOT NULL,
  `TOTQUANTITY` double DEFAULT NULL,
  `BILLAMOUNT` double DEFAULT NULL,
  `TOTBILLAMOUNT` double DEFAULT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`BID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `fna_bill`
--

INSERT INTO `fna_bill` (`BID`, `SESSIONID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `RECEIVENUMBER`, `PRODCATTYPEID`, `PRODUCTID`, `PACKINGUNITID`, `QUANTITY`, `WTQNTY`, `TOTQUANTITY`, `BILLAMOUNT`, `TOTBILLAMOUNT`, `PARTYFLAG`, `ENTRYDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(68, 0, 1, 2, 14, 1, 6, 32, 18, 1824, 419520, 419520, 1195631.95999, 1195631.95999, 1, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(69, 0, 1, 2, 14, 1, 6, 33, 19, 18331, 183310, 183310, 1008205, 2203836.95999, 2, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(70, 0, 1, 2, 14, 1, 6, 44, 15, 19060, 2382500, 2382500, 6790124.77279, 8993961.73278, 3, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(71, 0, 1, 2, 14, 1, 7, 63, 15, 156, 19500, 19500, 55574.9981403, 9049536.73092, 4, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(72, 0, 1, 2, 14, 1, 7, 64, 11, 42709, 1242400, 1242400, 10560400, 19609936.7309, 5, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(73, 0, 1, 2, 14, 1, 7, 65, 11, 3018, 88930, 88930, 755905, 20365841.7309, 6, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(74, 0, 1, 1, 18, 2, 5, 71, 23, 180, 0, 180, 64800, 64800, 1, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:07:27 PM'),
(75, 0, 1, 1, 18, 3, 5, 71, 23, 210, 0, 210, 75600, 140400, 2, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:09:51 PM'),
(76, 0, 1, 1, 18, 4, 5, 71, 23, 10, 0, 10, 3600, 144000, 3, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:11:03 PM'),
(77, 0, 1, 1, 18, 5, 5, 71, 23, 14, 0, 14, 5040, 149040, 4, '2014-12-01', 20, 'Active', NULL, '2014-12-07', '13:14:46 PM'),
(78, 0, 1, 1, 18, 6, 5, 71, 23, 12, 0, 12, 4320, 153360, 5, '2014-12-03', 20, 'Active', NULL, '2014-12-07', '13:16:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_branch`
--

CREATE TABLE IF NOT EXISTS `fna_branch` (
  `BRANCHID` int(11) NOT NULL AUTO_INCREMENT,
  `BANKID` int(11) NOT NULL,
  `BRANCHNAME` varchar(100) NOT NULL,
  `ADDRESS` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BRANCHID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fna_branch`
--

INSERT INTO `fna_branch` (`BRANCHID`, `BANKID`, `BRANCHNAME`, `ADDRESS`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 2, 'Mirpur Branch', 'Mirpur', 20, 'Active', 0, '2015-01-08', '18:35:42 PM'),
(2, 2, 'Dhanmondi nBranch', 'Dhanmondi', 20, 'Active', 0, '2015-01-08', '18:36:45 PM'),
(3, 3, 'Original Mirpur', 'mirpur', 20, 'Active', 0, '2015-01-08', '19:11:15 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_chamber`
--

CREATE TABLE IF NOT EXISTS `fna_chamber` (
  `CHID` int(11) NOT NULL AUTO_INCREMENT,
  `CHNAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CHID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fna_chamber`
--

INSERT INTO `fna_chamber` (`CHID`, `CHNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 'Chamber-1', 20, 'Active', NULL, '2014-09-21', '18:05:39 PM'),
(2, 'Chamber-2', 20, 'Active', NULL, '2014-09-25', '16:19:41 PM'),
(3, 'Chamber-3', 20, 'Active', NULL, '2014-09-25', '16:19:57 PM'),
(4, 'Chamber-4', 20, 'Active', NULL, '2014-09-25', '16:20:07 PM'),
(5, 'Chamber-5', 20, 'Active', NULL, '2014-09-25', '16:20:18 PM'),
(6, 'Chamber-6', 20, 'Active', NULL, '2014-09-25', '16:20:32 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_expanse`
--

CREATE TABLE IF NOT EXISTS `fna_expanse` (
  `EXPID` int(11) NOT NULL AUTO_INCREMENT,
  `EXPHID` int(11) NOT NULL,
  `EXPSUBHID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `AMOUNT` double NOT NULL,
  `EXPDATE` date NOT NULL,
  `VOUCHERNO` varchar(50) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`EXPID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fna_expanse`
--

INSERT INTO `fna_expanse` (`EXPID`, `EXPHID`, `EXPSUBHID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `AMOUNT`, `EXPDATE`, `VOUCHERNO`, `DESCRIPTION`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 6, 13, 1, 1, 13, 1000, '2014-12-08', '1', '', 20, 'Active', 0, '2014-12-08', '10:05:50 AM'),
(2, 2, 6, 2, 6, 20, 200, '2015-01-05', '101', 'sdfsf', 20, 'Active', 0, '2015-01-05', '19:38:08 PM'),
(3, 2, 5, 3, 8, 0, 500, '2015-01-05', '15', '', 20, 'Active', 0, '2015-01-06', '20:03:07 PM'),
(4, 2, 5, 4, 9, 23, 550, '2015-01-08', '123', 'sgdffds', 20, 'Active', 0, '2015-01-11', '16:03:08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_expense_head`
--

CREATE TABLE IF NOT EXISTS `fna_expense_head` (
  `EXPHID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `EXPHEADNAME` varchar(200) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(200) NOT NULL,
  PRIMARY KEY (`EXPHID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `fna_expense_head`
--

INSERT INTO `fna_expense_head` (`EXPHID`, `PROJECTID`, `SUBPROJECTID`, `EXPHEADNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 0, 0, 'Salary', 20, 'Active', 0, '2014-10-27', '16:22:50 PM'),
(2, 0, 0, 'Convayence', 20, 'Active', 0, '2014-10-27', '16:29:18 PM'),
(3, 0, 0, 'Entertainment', 20, 'Active', 0, '2014-10-27', '16:35:38 PM'),
(4, 0, 0, 'Electricity', 20, 'Active', 0, '2014-11-21', '09:51:04 AM'),
(5, 0, 0, 'Others Expanse', 20, 'Active', 0, '2014-11-21', '11:14:59 AM'),
(6, 0, 0, 'Daily Labour', 20, 'Active', 0, '2014-11-21', '11:16:03 AM'),
(7, 0, 0, 'Kat Mistry', 20, 'Active', 0, '2014-11-21', '11:17:07 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_expsubhead`
--

CREATE TABLE IF NOT EXISTS `fna_expsubhead` (
  `EXPSUBHID` int(11) NOT NULL AUTO_INCREMENT,
  `EXPHID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `SUBHEADNAME` varchar(200) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(200) NOT NULL,
  PRIMARY KEY (`EXPSUBHID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fna_expsubhead`
--

INSERT INTO `fna_expsubhead` (`EXPSUBHID`, `EXPHID`, `PROJECTID`, `SUBPROJECTID`, `SUBHEADNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(5, 2, 0, 0, 'CNG', 20, 'Active', 0, '2014-11-12', '16:07:41 PM'),
(6, 2, 0, 0, 'Bus', 20, 'Active', 0, '2014-11-12', '16:07:54 PM'),
(7, 3, 0, 0, 'Party Expanse', 20, 'Active', 0, '2014-11-12', '16:08:31 PM'),
(8, 3, 0, 0, 'Staff Expanse', 20, 'Active', 0, '2014-11-12', '16:08:49 PM'),
(9, 1, 0, 0, 'Basic Salary', 20, 'Active', 0, '2014-11-12', '16:09:00 PM'),
(10, 4, 0, 0, 'Electricity Bill', 20, 'Active', 0, '2014-11-21', '09:51:32 AM'),
(11, 2, 0, 0, 'Van Vara', 20, 'Active', 0, '2014-11-21', '11:14:32 AM'),
(12, 5, 0, 0, 'Others Expanse', 20, 'Active', 0, '2014-11-21', '11:15:28 AM'),
(13, 6, 0, 0, 'Cleaning', 20, 'Active', 0, '2014-11-21', '11:16:54 AM'),
(14, 7, 0, 0, 'Mistry', 20, 'Active', 0, '2014-11-21', '11:17:30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_labour`
--

CREATE TABLE IF NOT EXISTS `fna_labour` (
  `LABOURID` int(10) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `LABOURNAME` varchar(100) DEFAULT NULL,
  `FATHERNAME` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `MOBILE` int(11) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LABOURID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `fna_labour`
--

INSERT INTO `fna_labour` (`LABOURID`, `PROJECTID`, `SUBPROJECTID`, `LABOURNAME`, `FATHERNAME`, `ADDRESS`, `MOBILE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(6, 1, 1, 'Alamgir  Hossain', 'Ali akbar Hossain', ' Mirpur', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:45:25 PM'),
(7, 1, 2, 'Pran Gopal Datta', 'Pran Kumar', 'Mirpur ', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:45:59 PM'),
(8, 1, 3, 'Fahim Hasan', 'Fazlu Hasan', ' Shamoly', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:46:32 PM'),
(9, 1, 1, 'Amzad Hossain', 'Afzalur', ' sgsgsdgsd', 2147483647, 20, 'Active', NULL, '2014-11-21', '06:07:10 AM'),
(10, 1, 5, 'Nazim Uddin', 'Nazmul', 'jshbajsh ', 2147483647, 20, 'Active', NULL, '2014-11-21', '09:54:05 AM'),
(11, 1, 1, 'Abul', 'kflrfrjf', ' Khajurtala', 0, 20, 'Active', NULL, '2014-12-07', '12:36:03 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_labourbill`
--

CREATE TABLE IF NOT EXISTS `fna_labourbill` (
  `LABOURBILLID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `LABOURID` int(10) DEFAULT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODUCTLOADUNLOADID` int(10) DEFAULT NULL,
  `BILLAMOUNT` double DEFAULT NULL,
  `PAYMENTAMOUNT` double DEFAULT NULL,
  `BALANCEAMOUNT` double DEFAULT NULL,
  `LABOURFLAG` int(11) NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LABOURBILLID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `fna_labourbill`
--

INSERT INTO `fna_labourbill` (`LABOURBILLID`, `PROJECTID`, `SUBPROJECTID`, `LABOURID`, `PARTYID`, `PRODUCTLOADUNLOADID`, `BILLAMOUNT`, `PAYMENTAMOUNT`, `BALANCEAMOUNT`, `LABOURFLAG`, `ENTRYDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(11, 1, 2, 7, 14, 12, 422270, 0, 422270, 1, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(12, 1, 2, 7, 14, 13, 162034.5, 0, 584304.5, 2, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(13, 1, 2, 7, 14, 14, 6, 0, 584027, 3, '2014-11-30', 20, 'Active', NULL, '2014-12-02', '11:28:52 AM'),
(14, 1, 1, 11, 18, 15, 1620, 0, 1620, 1, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:07:27 PM'),
(15, 1, 1, 11, 18, 16, 1890, 0, 3510, 2, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:09:51 PM'),
(16, 1, 1, 11, 18, 17, 90, 0, 3600, 3, '2014-12-02', 20, 'Active', NULL, '2014-12-07', '13:11:03 PM'),
(17, 1, 1, 11, 18, 18, 126, 0, 3726, 4, '2014-12-01', 20, 'Active', NULL, '2014-12-07', '13:14:46 PM'),
(18, 1, 1, 11, 18, 19, 108, 0, 3834, 5, '2014-12-03', 20, 'Active', NULL, '2014-12-07', '13:16:00 PM'),
(19, 1, 1, 11, 18, 20, 850, 0, 4684, 6, '2014-12-05', 20, 'Active', NULL, '2014-12-10', '04:23:24 AM'),
(20, 1, 1, 11, 18, 21, 1785, 0, 6469, 7, '2014-12-05', 20, 'Active', NULL, '2014-12-10', '04:25:28 AM'),
(21, 1, 1, 11, 18, 22, 42.5, 0, 6511.5, 8, '2014-12-08', 20, 'Active', NULL, '2014-12-10', '04:32:38 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_labourcontact`
--

CREATE TABLE IF NOT EXISTS `fna_labourcontact` (
  `LABCONTACTID` int(11) NOT NULL AUTO_INCREMENT,
  `LABOURID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `STARTDATE` date DEFAULT NULL,
  `ENDDATE` date DEFAULT NULL,
  `DESCRIPTION` text,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LABCONTACTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fna_labourcontact`
--

INSERT INTO `fna_labourcontact` (`LABCONTACTID`, `LABOURID`, `PROJECTID`, `SUBPROJECTID`, `STARTDATE`, `ENDDATE`, `DESCRIPTION`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 7, 1, 2, '2014-06-01', '2015-05-31', 'Pran', 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(2, 6, 1, 1, '2014-06-01', '2015-05-31', 'asdfsd', 20, 'Active', NULL, '2014-11-29', '17:19:10 PM'),
(3, 11, 1, 1, '2013-12-01', '2015-12-31', '', 20, 'Active', NULL, '2014-12-07', '12:51:54 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_labourcontact_bkdn`
--

CREATE TABLE IF NOT EXISTS `fna_labourcontact_bkdn` (
  `LABCONTACTBKDNID` int(11) NOT NULL AUTO_INCREMENT,
  `LABCONTACTID` int(11) DEFAULT NULL,
  `WORKTYPE` varchar(50) NOT NULL,
  `CHAMBERIDFROM` int(10) DEFAULT NULL,
  `CHAMBERIDTO` int(10) DEFAULT NULL,
  `PACKINGUNITID` int(10) DEFAULT NULL,
  `LOADPRICE` double DEFAULT NULL,
  `UNLOADPRICE` double DEFAULT NULL,
  `TRANSFERPRICE` double DEFAULT NULL,
  `SHADEPRICE` double DEFAULT NULL,
  `PALOTPRICE` double NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LABCONTACTBKDNID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `fna_labourcontact_bkdn`
--

INSERT INTO `fna_labourcontact_bkdn` (`LABCONTACTBKDNID`, `LABCONTACTID`, `WORKTYPE`, `CHAMBERIDFROM`, `CHAMBERIDTO`, `PACKINGUNITID`, `LOADPRICE`, `UNLOADPRICE`, `TRANSFERPRICE`, `SHADEPRICE`, `PALOTPRICE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 1, '', 0, 1, 15, 6, 6, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(2, 1, '', 0, 1, 16, 6, 6, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(3, 1, '', 0, 3, 15, 6, 6, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(4, 1, '', 0, 3, 16, 6, 6, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(5, 1, '', 0, 4, 11, 8.5, 8, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(6, 1, '', 0, 4, 15, 8, 8, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(7, 1, '', 0, 4, 16, 8, 8, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(8, 1, '', 0, 5, 14, 4.5, 4.5, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(9, 1, '', 0, 5, 18, 12, 12, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(10, 1, '', 0, 5, 11, 5, 5, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(11, 1, '', 0, 6, 18, 12, 12, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(12, 1, '', 0, 5, 12, 4.5, 4.5, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(13, 1, '', 0, 5, 13, 4.5, 4.5, 0, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(14, 1, '', 1, 1, 15, 0, 0, 3, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(15, 1, '', 1, 1, 16, 0, 0, 3, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(16, 1, '', 1, 3, 15, 0, 0, 7, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(17, 1, '', 1, 3, 16, 0, 0, 7, 0, 0, 20, 'Active', NULL, '2014-11-26', '13:06:16 PM'),
(18, 1, '', 1, 1, 11, 0, 0, 2, 0, 0, 20, 'Active', NULL, '2014-11-27', '18:21:33 PM'),
(19, 1, '', 1, 1, 12, 0, 0, 2, 0, 0, 20, 'Active', NULL, '2014-11-27', '18:21:33 PM'),
(20, 1, '', 1, 1, 14, 0, 0, 3, 0, 0, 20, 'Active', NULL, '2014-11-27', '18:21:33 PM'),
(21, 1, '', 0, 3, 19, 1, 1, 0, 0, 0, 20, 'Active', NULL, '2014-11-28', '06:09:12 AM'),
(22, 1, '', 0, 1, 19, 1, 1, 0, 0, 0, 20, 'Active', NULL, '2014-11-28', '06:09:12 AM'),
(23, 1, '', 0, 1, 20, 2.5, 2.5, 0, 0, 0, 20, 'Active', NULL, '2014-11-28', '06:09:12 AM'),
(24, 1, '', 0, 3, 20, 2.5, 2.5, 0, 0, 0, 20, 'Active', NULL, '2014-11-28', '06:09:12 AM'),
(25, 2, '', 0, 2, 14, 6, 5, 0, 0, 0, 20, 'Active', NULL, '2014-11-29', '17:19:10 PM'),
(26, 3, '', 2, 2, 23, 9, 8.5, 12, 2.2, 0, 20, 'Active', NULL, '2014-12-07', '12:51:54 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_labourworkhistory`
--

CREATE TABLE IF NOT EXISTS `fna_labourworkhistory` (
  `LABWORKHISTID` int(11) NOT NULL AUTO_INCREMENT,
  `LABOURID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODUCTLOADUNLOADBKDNID` int(10) DEFAULT NULL,
  `PRODCATTYPEID` int(10) DEFAULT NULL,
  `PRODUCTID` int(10) DEFAULT NULL,
  `PACKINGUNITID` int(10) DEFAULT NULL,
  `QUANTITY` double DEFAULT NULL,
  `CHID` int(10) DEFAULT NULL,
  `POCKET` int(10) DEFAULT NULL,
  `BILLAMOUNT` double DEFAULT NULL,
  `TOTBILLAMOUNT` double DEFAULT NULL,
  `RECEIVENUMBER` int(10) DEFAULT NULL,
  `DELIVERYCHALLANNUMBER` int(10) DEFAULT NULL,
  `WORKTYPEFLAG` varchar(20) NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LABWORKHISTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `fna_labourworkhistory`
--

INSERT INTO `fna_labourworkhistory` (`LABWORKHISTID`, `LABOURID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `PRODUCTLOADUNLOADBKDNID`, `PRODCATTYPEID`, `PRODUCTID`, `PACKINGUNITID`, `QUANTITY`, `CHID`, `POCKET`, `BILLAMOUNT`, `TOTBILLAMOUNT`, `RECEIVENUMBER`, `DELIVERYCHALLANNUMBER`, `WORKTYPEFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(69, 7, 1, 2, 14, 69, 6, 32, 18, 1824, 6, 1, 12, 21888, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(70, 7, 1, 2, 14, 70, 6, 33, 19, 18331, 3, 6, 1, 18331, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(71, 7, 1, 2, 14, 71, 6, 44, 15, 19060, 4, 5, 8, 152480, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(72, 7, 1, 2, 14, 72, 7, 63, 15, 156, 3, 1, 6, 936, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(73, 7, 1, 2, 14, 73, 7, 64, 11, 42709, 5, 3, 5, 213545, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(74, 7, 1, 2, 14, 74, 7, 65, 11, 3018, 5, 3, 5, 15090, 1, NULL, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(75, 7, 1, 2, 14, 75, 6, 32, 18, 1085, 6, 1, 12, 13020, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(76, 7, 1, 2, 14, 76, 6, 33, 19, 11871, 3, 2, 1, 11871, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(77, 7, 1, 2, 14, 77, 6, 44, 15, 2094, 3, 2, 6, 12564, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(78, 7, 1, 2, 14, 78, 7, 63, 15, 41, 1, 2, 6, 246, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(79, 7, 1, 2, 14, 79, 7, 64, 11, 24810, 5, 1, 5, 124050, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(80, 7, 1, 2, 14, 80, 7, 65, 12, 63, 1, 6, 4.5, 283.5, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(81, 7, 1, 2, 14, 81, 7, 63, 15, 1, 3, 1, 6, 6, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:28:52 AM'),
(82, 11, 1, 1, 18, 82, 5, 71, 23, 180, 2, 2, 9, 1620, 2, NULL, 'Load', 20, 'Active', NULL, '2014-12-07', '13:07:27 PM'),
(83, 11, 1, 1, 18, 83, 5, 71, 23, 210, 2, 6, 9, 1890, 3, NULL, 'Load', 20, 'Active', NULL, '2014-12-07', '13:09:51 PM'),
(84, 11, 1, 1, 18, 84, 5, 71, 23, 10, 2, 1, 9, 90, 4, NULL, 'Load', 20, 'Active', NULL, '2014-12-07', '13:11:03 PM'),
(85, 11, 1, 1, 18, 85, 5, 71, 23, 14, 2, 3, 9, 126, 5, NULL, 'Load', 20, 'Active', NULL, '2014-12-07', '13:14:46 PM'),
(86, 11, 1, 1, 18, 86, 5, 71, 23, 12, 2, 2, 9, 108, 6, NULL, 'Load', 20, 'Active', NULL, '2014-12-07', '13:16:00 PM'),
(87, 11, 1, 1, 18, 87, 5, 71, 23, 100, 2, 1, 8.5, 850, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-10', '04:23:24 AM'),
(88, 11, 1, 1, 18, 88, 5, 71, 23, 210, 2, 6, 8.5, 1785, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-10', '04:25:28 AM'),
(89, 11, 1, 1, 18, 89, 5, 71, 23, 5, 2, 3, 8.5, 42.5, NULL, 1, 'Unload', 20, 'Active', NULL, '2014-12-10', '04:32:38 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_loan`
--

CREATE TABLE IF NOT EXISTS `fna_loan` (
  `LOANID` int(11) NOT NULL AUTO_INCREMENT,
  `LOANTYPEID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `LOANAMOUNT` double NOT NULL,
  `INTERESTRATE` double NOT NULL,
  `INTERESTAMOUNT` double NOT NULL,
  `TOTLOANAMOUNT` double NOT NULL,
  `LOANPAYMENT` double NOT NULL,
  `TOTLOANPAYMENT` double NOT NULL,
  `BALANCE` double NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `LOANPURPOSE` varchar(100) NOT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `LOANFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(40) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(100) NOT NULL,
  PRIMARY KEY (`LOANID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fna_loan`
--

INSERT INTO `fna_loan` (`LOANID`, `LOANTYPEID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `LOANAMOUNT`, `INTERESTRATE`, `INTERESTAMOUNT`, `TOTLOANAMOUNT`, `LOANPAYMENT`, `TOTLOANPAYMENT`, `BALANCE`, `ENTRYDATE`, `LOANPURPOSE`, `PARTYFLAG`, `LOANFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 2, 1, 1, 18, 17000, 25, 0, 17000, 0, 0, 17000, '2014-12-01', 'fsdsddff ', 1, 1, 20, 'Active', 0, '2014-12-08', '10:00:06 AM'),
(2, 1, 1, 1, 13, 5000, 25, 0, 5000, 0, 0, 5000, '2014-11-01', 'fsdfffd fdfg ', 1, 2, 20, 'Active', 0, '2014-12-08', '10:01:17 AM'),
(3, 3, 1, 1, 17, 200000, 25, 0, 200000, 0, 0, 200000, '2014-12-01', 'dccvc', 1, 3, 20, 'Active', 0, '2014-12-08', '10:02:05 AM'),
(4, 3, 1, 1, 18, 3200000, 25, 65753.4246575, 3217000, 32000, 32000, 3233753.42466, '2014-11-01', '', 2, 4, 20, 'Inactive', 0, '2014-12-08', '10:03:17 AM'),
(5, 3, 1, 1, 18, 3233753.42466, 25, 17719.1968475, 6450753.42466, 5000, 5000, 3246472.62151, '2014-12-01', '', 3, 5, 20, 'Inactive', 0, '2014-12-08', '10:10:01 AM'),
(6, 3, 1, 1, 18, 3246472.62151, 25, 0, 9697226.04617, 0, 0, 6492945.24302, '2014-12-09', '', 4, 6, 20, 'Active', 0, '2014-12-08', '10:11:04 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_loantype`
--

CREATE TABLE IF NOT EXISTS `fna_loantype` (
  `LOANTYPEID` int(11) NOT NULL AUTO_INCREMENT,
  `LOANTYPENAME` varchar(100) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(120) NOT NULL,
  PRIMARY KEY (`LOANTYPEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fna_loantype`
--

INSERT INTO `fna_loantype` (`LOANTYPEID`, `LOANTYPENAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 'Car Loan', 20, 'Active', 0, '2014-11-05', '18:18:09 PM'),
(2, 'Basta Loan', 20, 'Active', 0, '2014-11-05', '18:18:26 PM'),
(3, 'Normal Loan', 20, 'Active', 0, '2014-11-05', '18:18:37 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_packingname`
--

CREATE TABLE IF NOT EXISTS `fna_packingname` (
  `PACKINGNAMEID` int(11) NOT NULL AUTO_INCREMENT,
  `PACKINGNAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PACKINGNAMEID`),
  UNIQUE KEY `PACKINGNAMEID` (`PACKINGNAMEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fna_packingname`
--

INSERT INTO `fna_packingname` (`PACKINGNAMEID`, `PACKINGNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 'Basta', 20, 'Active', NULL, '2014-09-20', '17:10:22 PM'),
(3, 'Drum', 20, 'Active', NULL, '2014-09-25', '15:17:20 PM'),
(4, 'Cartoon', 20, 'Active', NULL, '2014-10-24', '10:29:02 AM'),
(5, 'Jhuri', 20, 'Active', NULL, '2014-11-21', '06:23:44 AM'),
(6, 'Cartun', 20, 'Active', NULL, '2014-11-28', '06:00:47 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_packingunit`
--

CREATE TABLE IF NOT EXISTS `fna_packingunit` (
  `PACKINGUNITID` int(11) NOT NULL AUTO_INCREMENT,
  `PACKINGNAMEID` int(11) NOT NULL,
  `QID` int(11) NOT NULL,
  `WTID` int(11) NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PACKINGUNITID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `fna_packingunit`
--

INSERT INTO `fna_packingunit` (`PACKINGUNITID`, `PACKINGNAMEID`, `QID`, `WTID`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(11, 1, 10, 1, 20, 'Active', NULL, '2014-11-26', '12:56:05 PM'),
(12, 1, 12, 1, 20, 'Active', NULL, '2014-11-26', '12:56:15 PM'),
(13, 1, 11, 1, 20, 'Active', NULL, '2014-11-26', '12:56:26 PM'),
(14, 1, 4, 1, 20, 'Active', NULL, '2014-11-26', '12:56:39 PM'),
(15, 3, 13, 1, 20, 'Active', NULL, '2014-11-26', '12:56:51 PM'),
(16, 3, 6, 1, 20, 'Active', NULL, '2014-11-26', '12:57:02 PM'),
(17, 3, 14, 1, 20, 'Active', NULL, '2014-11-26', '12:57:20 PM'),
(18, 3, 15, 1, 20, 'Active', NULL, '2014-11-26', '12:57:34 PM'),
(19, 4, 16, 1, 20, 'Active', NULL, '2014-11-28', '06:06:15 AM'),
(20, 4, 17, 1, 20, 'Active', NULL, '2014-11-28', '06:06:25 AM'),
(21, 1, 18, 1, 20, 'Active', NULL, '2014-11-29', '17:16:27 PM'),
(22, 1, 0, 0, 20, 'Active', NULL, '2014-12-05', '16:33:52 PM'),
(23, 1, 19, 1, 20, 'Active', NULL, '2014-12-07', '12:42:14 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_party`
--

CREATE TABLE IF NOT EXISTS `fna_party` (
  `PARTYID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYNAME` varchar(100) DEFAULT NULL,
  `FATHERNAME` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `MOBILE` int(11) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PARTYID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `fna_party`
--

INSERT INTO `fna_party` (`PARTYID`, `PROJECTID`, `SUBPROJECTID`, `PARTYNAME`, `FATHERNAME`, `ADDRESS`, `MOBILE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(13, 1, 1, 'Aluddin Sarker', 'Akbar sarker', 'Sirajgonj ', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:47:07 PM'),
(14, 1, 2, 'Payel Hasan', 'Pavel', 'aksdkjah ', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:47:44 PM'),
(15, 1, 3, 'Fazlur Rahman', 'Bazlur Rahman', ' swaefdwaedw', 1971696274, 20, 'Active', NULL, '2014-11-12', '15:48:12 PM'),
(16, 1, 5, 'Nantoo', 'sdcsdjkhg', 'sjdhcsjdh ', 2342423, 20, 'Active', NULL, '2014-11-21', '10:05:34 AM'),
(17, 1, 1, 'Ali Baba', 'Khaja Baba', ' Kazjshba', 2147483647, 20, 'Active', NULL, '2014-12-05', '11:33:17 AM'),
(18, 1, 1, 'Md. Shahidul Islam', 'lkfjlf;a jlfjla', 'Bro bari natore ', 0, 20, 'Active', NULL, '2014-12-07', '12:38:10 PM'),
(19, 2, 6, 'Farid Hasan', 'Faysal kabir', ' sfsdds', 12314124, 20, 'Active', NULL, '2014-12-13', '18:28:30 PM'),
(20, 2, 6, 'Fahim Hasan', 'Abu Bakar', 'aksdjhakj ', 12323, 20, 'Active', NULL, '2014-12-14', '18:31:09 PM'),
(21, 5, 7, 'Mehedi Hasan', 'sefsf', ' sdzfsfs', 2412412, 20, 'Active', NULL, '2014-12-22', '15:13:16 PM'),
(22, 4, 9, 'FNA Hachery', 'Hachery', ' ', 0, 20, 'Active', NULL, '2014-12-29', '15:42:02 PM'),
(23, 4, 9, 'Komol', 'Quddus', ' Sirajgionj', 21312312, 20, 'Active', NULL, '2014-12-30', '17:20:43 PM'),
(24, 6, 10, 'Opening Balance', 'FNA', ' FNA', 123445, 20, 'Active', NULL, '2015-01-07', '20:03:33 PM'),
(25, 3, 8, 'Komol Hasan', 'quddus sarker', ' swfsdfs', 23423, 20, 'Active', NULL, '2015-01-10', '18:10:55 PM'),
(26, 3, 8, 'Masud', 'Mamun', ' sefs', 2147483647, 20, 'Active', NULL, '2015-01-22', '19:06:04 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_partybill`
--

CREATE TABLE IF NOT EXISTS `fna_partybill` (
  `PARTYBILLID` int(11) NOT NULL AUTO_INCREMENT,
  `PARTYID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PRODCATTYPEID` int(11) NOT NULL,
  `RECEIVENUMBER` int(10) DEFAULT NULL,
  `BILLAMOUNT` double DEFAULT NULL,
  `RECEIVEAMOUNT` double DEFAULT NULL,
  `BALANCEAMOUNT` double DEFAULT NULL,
  `ENTRYDATE` date NOT NULL,
  `BANKNAME` varchar(100) DEFAULT NULL,
  `CHEQUENUMBER` double DEFAULT NULL,
  `CHEQUEDATE` date DEFAULT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PARTYBILLID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `fna_partybill`
--

INSERT INTO `fna_partybill` (`PARTYBILLID`, `PARTYID`, `PROJECTID`, `SUBPROJECTID`, `PRODCATTYPEID`, `RECEIVENUMBER`, `BILLAMOUNT`, `RECEIVEAMOUNT`, `BALANCEAMOUNT`, `ENTRYDATE`, `BANKNAME`, `CHEQUENUMBER`, `CHEQUEDATE`, `PARTYFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(42, 23, 4, 9, 0, NULL, 120, NULL, 120, '2015-01-06', NULL, NULL, NULL, 1, 20, 'Sell', NULL, '2015-01-05', '18:38:10 PM'),
(43, 23, 4, 9, 0, NULL, 120, NULL, 240, '2015-01-06', NULL, NULL, NULL, 2, 20, 'Sell', NULL, '2015-01-05', '18:40:19 PM'),
(44, 20, 2, 6, 10, 0, 0, 5000, 5000, '2015-01-07', '', 0, '0000-00-00', 1, 20, 'Active', NULL, '2015-01-05', '19:18:03 PM'),
(45, 20, 2, 6, 10, 0, 0, 10000, 15000, '2015-01-02', '', 0, '0000-00-00', 2, 20, 'Active', NULL, '2015-01-06', '16:04:47 PM'),
(46, 20, 2, 6, 0, NULL, 10000, NULL, 10240, '2015-01-03', NULL, NULL, NULL, 3, 20, 'Active', NULL, '2015-01-06', '16:33:41 PM'),
(49, 19, 2, 6, 10, 0, 0, 12000, 12000, '2015-01-08', '', 0, '0000-00-00', 1, 20, 'Active', NULL, '2015-01-07', '19:38:53 PM'),
(53, 20, 2, 6, 0, 0, 12300, 0, -2060, '2015-01-09', NULL, NULL, NULL, 4, 20, 'Active', NULL, '2015-01-07', '20:00:30 PM'),
(54, 24, 6, 10, 0, 0, 0, 20000000, 20000000, '2015-01-08', '', 0, '0000-00-00', 1, 20, 'Active', NULL, '2015-01-07', '20:04:01 PM'),
(55, 18, 1, 1, 0, 0, 12300, 0, 12300, '2015-01-08', NULL, NULL, NULL, 1, 20, 'Active', NULL, '2015-01-08', '15:38:29 PM'),
(56, 23, 4, 9, 0, 0, 200000, 0, -199760, '2015-01-08', NULL, NULL, NULL, 3, 20, 'Active', NULL, '2015-01-08', '15:49:11 PM'),
(57, 20, 2, 6, 0, NULL, 100000, NULL, 97940, '2015-01-01', NULL, NULL, NULL, 5, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(58, 20, 2, 6, 0, NULL, 50000, NULL, 147940, '2015-01-01', NULL, NULL, NULL, 6, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(59, 20, 2, 6, 0, NULL, 60000, NULL, 207940, '2015-01-01', NULL, NULL, NULL, 7, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(60, 20, 2, 6, 0, NULL, 45000, NULL, 252940, '2015-01-01', NULL, NULL, NULL, 8, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(61, 20, 2, 6, 0, NULL, 55000, NULL, 307940, '2015-01-01', NULL, NULL, NULL, 9, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(62, 20, 2, 6, 0, NULL, 67000, NULL, 374940, '2015-01-01', NULL, NULL, NULL, 10, 20, 'Active', NULL, '2015-01-10', '16:27:31 PM'),
(63, 20, 2, 6, 0, NULL, 100000, NULL, 474940, '2015-01-01', NULL, NULL, NULL, 11, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(64, 20, 2, 6, 0, NULL, 80000, NULL, 554940, '2015-01-01', NULL, NULL, NULL, 12, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(65, 20, 2, 6, 0, NULL, 48000, NULL, 602940, '2015-01-01', NULL, NULL, NULL, 13, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(66, 20, 2, 6, 0, NULL, 45000, NULL, 647940, '2015-01-01', NULL, NULL, NULL, 14, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(67, 20, 2, 6, 0, NULL, 78000, NULL, 725940, '2015-01-01', NULL, NULL, NULL, 15, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(68, 20, 2, 6, 0, NULL, 45600, NULL, 771540, '2015-01-01', NULL, NULL, NULL, 16, 20, 'Active', NULL, '2015-01-10', '17:06:22 PM'),
(69, 21, 5, 7, 0, NULL, 300, NULL, 300, '2015-01-05', NULL, NULL, NULL, 1, 20, 'Active', NULL, '2015-01-10', '18:01:54 PM'),
(70, 25, 3, 8, 0, NULL, 1200, NULL, 1200, '2015-01-09', NULL, NULL, NULL, 1, 20, 'Sell', NULL, '2015-01-10', '18:11:32 PM'),
(71, 25, 3, 8, 0, NULL, 20000, NULL, 21200, '2015-01-10', NULL, NULL, NULL, 2, 20, 'Sell', NULL, '2015-01-10', '18:24:20 PM'),
(72, 25, 3, 8, 0, NULL, 60000, NULL, 81200, '2015-01-11', NULL, NULL, NULL, 3, 20, 'Sell', NULL, '2015-01-11', '15:11:05 PM'),
(73, 23, 4, 9, 0, NULL, 21000, NULL, -178760, '2015-01-17', NULL, NULL, NULL, 4, 20, 'Sell', NULL, '2015-01-11', '15:17:20 PM'),
(74, 23, 4, 9, 0, 0, 0, 22000, -24060, '2015-01-15', '', 0, '0000-00-00', 5, 20, 'Active', NULL, '2015-01-16', '19:14:15 PM'),
(75, 20, 2, 6, 10, 0, 0, 50000, 721540, '2015-01-06', '', 0, '0000-00-00', 17, 20, 'Active', NULL, '2015-01-18', '19:23:19 PM'),
(76, 19, 2, 6, 0, NULL, 12000, NULL, 12120, '2015-01-08', NULL, NULL, NULL, 2, 20, 'Active', NULL, '2015-01-18', '19:29:45 PM'),
(77, 19, 2, 6, 0, NULL, 12300, NULL, 12540, '2015-01-05', NULL, NULL, NULL, 3, 20, 'Active', NULL, '2015-01-18', '19:32:27 PM'),
(78, 25, 3, 8, 0, NULL, 1800, NULL, 83000, '2015-01-19', NULL, NULL, NULL, 4, 20, 'Sell', NULL, '2015-01-19', '16:29:44 PM'),
(79, 25, 3, 8, 0, NULL, 25200, NULL, 108200, '2015-01-21', NULL, NULL, NULL, 5, 20, 'Sell', NULL, '2015-01-19', '16:48:06 PM'),
(80, 25, 3, 8, 0, NULL, 30100, NULL, 138300, '2015-01-21', NULL, NULL, NULL, 6, 20, 'Sell', NULL, '2015-01-19', '16:49:42 PM'),
(81, 25, 3, 8, 0, NULL, 20000, NULL, 158300, '2015-01-21', NULL, NULL, NULL, 7, 20, 'Sell', NULL, '2015-01-21', '16:47:22 PM'),
(82, 25, 3, 8, 0, NULL, 12600, NULL, 170900, '2015-01-21', NULL, NULL, NULL, 8, 20, 'Sell', NULL, '2015-01-21', '16:48:50 PM'),
(83, 25, 3, 8, 0, 0, 0, 55000, 197940, '2015-01-21', '', 0, '0000-00-00', 9, 20, 'Active', NULL, '2015-01-22', '16:45:18 PM'),
(84, 26, 3, 8, 0, NULL, 21200, NULL, 21200, '2015-01-09', NULL, NULL, NULL, 1, 20, 'Sell', NULL, '2015-01-22', '19:06:47 PM'),
(85, 26, 3, 8, 0, 0, 0, 20000, 1200, '2015-01-22', '', 0, '0000-00-00', 2, 20, 'Active', NULL, '2015-01-22', '19:08:12 PM'),
(90, 26, 3, 8, 0, NULL, 25680, NULL, 26880, '2015-01-21', NULL, NULL, NULL, 3, 20, 'Sell', NULL, '2015-01-22', '19:36:45 PM'),
(91, 26, 3, 8, 0, NULL, 49203, NULL, 76083, '2015-01-21', NULL, NULL, NULL, 4, 20, 'Sell', NULL, '2015-01-22', '19:36:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_product`
--

CREATE TABLE IF NOT EXISTS `fna_product` (
  `PRODUCTID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODCATTYPEID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PRODUCTNAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `fna_product`
--

INSERT INTO `fna_product` (`PRODUCTID`, `PRODCATTYPEID`, `PROJECTID`, `SUBPROJECTID`, `PRODUCTNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(28, 6, 1, 2, 'Greem Mango -12', 20, 'Active', NULL, '2014-11-26', '05:42:36 AM'),
(29, 6, 1, 2, 'Pineapple Crass-12', 20, 'Active', NULL, '2014-11-26', '05:44:03 AM'),
(30, 6, 1, 2, 'Mango Pulp Gutti-13', 20, 'Active', NULL, '2014-11-26', '05:46:00 AM'),
(31, 6, 1, 2, 'Green Mango Assina-13', 20, 'Active', NULL, '2014-11-26', '05:47:16 AM'),
(32, 6, 1, 2, 'Chaina', 20, 'Active', NULL, '2014-11-26', '05:47:58 AM'),
(33, 6, 1, 2, 'Nata de co co', 20, 'Active', NULL, '2014-11-26', '05:48:37 AM'),
(34, 6, 1, 2, 'Fat', 20, 'Active', NULL, '2014-11-26', '05:49:24 AM'),
(35, 6, 1, 2, 'Orange Contant', 20, 'Active', NULL, '2014-11-26', '05:50:32 AM'),
(36, 6, 1, 2, 'Pineapple -13', 20, 'Active', NULL, '2014-11-26', '05:51:23 AM'),
(37, 6, 1, 2, 'Guava-13', 20, 'Active', NULL, '2014-11-26', '05:52:10 AM'),
(38, 6, 1, 2, 'Banana -13', 20, 'Active', NULL, '2014-11-26', '05:52:41 AM'),
(39, 6, 1, 2, 'Tamato -13', 20, 'Active', NULL, '2014-11-26', '05:53:31 AM'),
(40, 6, 1, 2, 'Tamarind', 20, 'Active', NULL, '2014-11-26', '05:54:00 AM'),
(41, 6, 1, 2, 'Carrot-14', 20, 'Active', NULL, '2014-11-26', '05:56:30 AM'),
(42, 6, 1, 2, 'Plums(Boroi)-14', 20, 'Active', NULL, '2014-11-26', '05:57:36 AM'),
(43, 6, 1, 2, 'Green Mango -14', 20, 'Active', NULL, '2014-11-26', '05:58:50 AM'),
(44, 6, 1, 2, 'Mango Pulp Gutti-14', 20, 'Active', NULL, '2014-11-26', '06:00:17 AM'),
(45, 6, 1, 2, 'Naga Chilli/14-15', 20, 'Active', NULL, '2014-11-26', '06:02:47 AM'),
(46, 6, 1, 2, 'Assina-14 (125kg)', 20, 'Active', NULL, '2014-11-26', '06:03:39 AM'),
(47, 6, 1, 2, 'Assina Bar (150kg)', 20, 'Active', NULL, '2014-11-26', '06:05:16 AM'),
(48, 6, 1, 2, 'Assina Bar (125kg)', 20, 'Active', NULL, '2014-11-26', '06:05:48 AM'),
(49, 6, 1, 2, 'Guava-14', 20, 'Active', NULL, '2014-11-26', '06:06:23 AM'),
(50, 6, 1, 2, 'Assina Pulp (150kg)-14', 20, 'Active', NULL, '2014-11-26', '06:07:25 AM'),
(51, 6, 1, 2, 'Pineapple Pulp-14', 20, 'Active', NULL, '2014-11-26', '06:08:26 AM'),
(52, 6, 1, 2, 'Assina -14 (con)', 20, 'Active', NULL, '2014-11-26', '06:09:26 AM'),
(53, 6, 1, 2, 'Pineapple Crash-14', 20, 'Active', NULL, '2014-11-26', '06:10:55 AM'),
(54, 6, 1, 2, 'Asseptic', 20, 'Active', NULL, '2014-11-26', '06:12:03 AM'),
(55, 6, 1, 2, 'Banana Pulp 14', 20, 'Active', NULL, '2014-11-26', '06:12:37 AM'),
(56, 7, 1, 2, 'Chilli Bogura L.C', 20, 'Active', NULL, '2014-11-26', '06:15:38 AM'),
(57, 7, 1, 2, 'Cassia Leaf', 20, 'Active', NULL, '2014-11-26', '06:19:04 AM'),
(58, 7, 1, 2, 'Cassia leaf (exp)', 20, 'Active', NULL, '2014-11-26', '06:20:55 AM'),
(59, 7, 1, 2, 'Mango Powder', 20, 'Active', NULL, '2014-11-26', '06:21:43 AM'),
(60, 7, 1, 2, 'Ginger Powder', 20, 'Active', NULL, '2014-11-26', '06:24:24 AM'),
(61, 7, 1, 2, 'Nat Mag Powder', 20, 'Active', NULL, '2014-11-26', '06:24:56 AM'),
(62, 7, 1, 2, 'Gur Liquti', 20, 'Active', NULL, '2014-11-26', '06:28:17 AM'),
(63, 7, 1, 2, 'Gur Patali', 20, 'Active', NULL, '2014-11-26', '06:28:49 AM'),
(64, 7, 1, 2, 'Chilli Bundu', 20, 'Active', NULL, '2014-11-26', '06:29:34 AM'),
(65, 7, 1, 2, 'Chilli Bindu Local (exp)', 20, 'Active', NULL, '2014-11-26', '06:31:54 AM'),
(66, 7, 1, 2, 'Chilli Bogura (exp)', 20, 'Active', NULL, '2014-11-26', '06:33:33 AM'),
(67, 7, 1, 2, 'Chilli L.C (jeli)', 20, 'Active', NULL, '2014-11-26', '06:34:54 AM'),
(68, 6, 1, 2, 'Assina Pulp 150kg', 20, 'Active', NULL, '2014-11-28', '05:48:24 AM'),
(69, 6, 1, 2, 'Assina 2014 (con)', 20, 'Active', NULL, '2014-11-28', '05:49:18 AM'),
(70, 7, 1, 2, 'Cassia leaf Powder', 20, 'Active', NULL, '2014-11-28', '06:51:20 AM'),
(71, 5, 1, 1, 'Alu', 20, 'Active', NULL, '2014-11-29', '16:44:45 PM'),
(72, 8, 1, 3, 'Khejur', 20, 'Active', NULL, '2014-12-05', '13:11:04 PM'),
(76, 10, 2, 6, 'D.C.P', 20, 'Active', NULL, '2014-12-15', '18:47:37 PM'),
(77, 10, 2, 6, 'Mithionin', 20, 'Active', NULL, '2014-12-15', '18:48:03 PM'),
(78, 10, 2, 6, 'Lycin', 20, 'Active', NULL, '2014-12-15', '18:48:21 PM'),
(79, 10, 2, 6, 'Kolin', 20, 'Active', NULL, '2014-12-15', '18:48:37 PM'),
(80, 10, 2, 6, 'Tokcin Binder', 20, 'Active', NULL, '2014-12-15', '18:49:04 PM'),
(81, 10, 2, 6, 'M.C.P', 20, 'Active', NULL, '2014-12-15', '18:49:25 PM'),
(82, 11, 5, 7, 'Napa', 20, 'Active', NULL, '2014-12-22', '15:12:24 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_productcattype`
--

CREATE TABLE IF NOT EXISTS `fna_productcattype` (
  `PRODCATTYPEID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `CATEGORYTYPENAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODCATTYPEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `fna_productcattype`
--

INSERT INTO `fna_productcattype` (`PRODCATTYPEID`, `PROJECTID`, `SUBPROJECTID`, `CATEGORYTYPENAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(5, 1, 1, 'Alu', 20, 'Active', NULL, '2014-11-12', '15:50:36 PM'),
(6, 1, 2, 'Pulp', 20, 'Active', NULL, '2014-11-12', '15:50:48 PM'),
(7, 1, 2, 'Spicy', 20, 'Active', NULL, '2014-11-12', '15:51:01 PM'),
(8, 1, 3, 'Fruits', 20, 'Active', NULL, '2014-11-12', '15:51:16 PM'),
(9, 1, 5, 'Nantoo', 20, 'Active', NULL, '2014-11-21', '09:55:02 AM'),
(10, 2, 6, 'Feed', 20, 'Active', NULL, '2014-12-10', '18:49:18 PM'),
(11, 5, 7, 'Medicine', 20, 'Active', NULL, '2014-12-22', '15:12:08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_productfare`
--

CREATE TABLE IF NOT EXISTS `fna_productfare` (
  `PRODUCTFAREID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODCATTYPEID` int(11) NOT NULL,
  `PRODUCTID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PACKINGUNITID` int(11) NOT NULL,
  `UNITFARE` double DEFAULT NULL,
  `STARTDATE` date DEFAULT NULL,
  `ENDDATE` date DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCTFAREID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `fna_productfare`
--

INSERT INTO `fna_productfare` (`PRODUCTFAREID`, `PRODCATTYPEID`, `PRODUCTID`, `PROJECTID`, `SUBPROJECTID`, `PACKINGUNITID`, `UNITFARE`, `STARTDATE`, `ENDDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 6, 18, 1, 2, 0, 2.5, '2014-06-01', '2015-05-31', 20, 'Active', NULL, '2014-11-25', '17:47:55 PM'),
(2, 6, 54, 1, 2, 0, 5, '2014-04-01', '2015-03-31', 20, 'Active', NULL, '2014-11-26', '06:41:34 AM'),
(3, 6, 39, 1, 2, 0, 2.8499999046325684, '2014-04-01', '2014-05-31', 20, 'Active', NULL, '2014-11-26', '06:46:19 AM'),
(4, 6, 32, 1, 2, 0, 2.8499999046325684, '2014-06-01', '2014-05-31', 20, 'Active', NULL, '2014-11-26', '06:47:45 AM'),
(5, 6, 48, 1, 2, 0, 2.8499999046325684, '2014-06-01', '2014-05-31', 20, 'Active', NULL, '2014-11-26', '06:55:03 AM'),
(6, 6, 47, 1, 2, 0, 2.8499999046325684, '2013-10-01', '2015-11-20', 20, 'Active', NULL, '2014-11-26', '09:44:03 AM'),
(7, 6, 50, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-28', 20, 'Active', NULL, '2014-11-26', '09:45:03 AM'),
(8, 6, 46, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-01', 20, 'Active', NULL, '2014-11-26', '09:46:00 AM'),
(9, 6, 38, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-27', 20, 'Active', NULL, '2014-11-26', '09:46:55 AM'),
(10, 6, 55, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-28', 20, 'Active', NULL, '2014-11-26', '09:47:43 AM'),
(11, 6, 41, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-29', 20, 'Active', NULL, '2014-11-26', '09:48:26 AM'),
(12, 6, 34, 1, 2, 0, 5.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:50:23 AM'),
(13, 6, 28, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:52:09 AM'),
(14, 6, 43, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:53:07 AM'),
(15, 6, 31, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:53:46 AM'),
(16, 6, 37, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:54:50 AM'),
(17, 6, 49, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:55:56 AM'),
(18, 6, 30, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:56:35 AM'),
(19, 6, 44, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:57:23 AM'),
(20, 6, 45, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '09:58:38 AM'),
(21, 6, 33, 1, 2, 0, 5.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:37:54 AM'),
(22, 6, 42, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:39:32 AM'),
(23, 7, 57, 1, 2, 0, 2.8499999046325684, '2013-11-02', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:40:25 AM'),
(24, 6, 40, 1, 2, 0, 4.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:42:23 AM'),
(25, 6, 51, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:43:11 AM'),
(26, 6, 29, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:43:55 AM'),
(27, 6, 53, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:45:20 AM'),
(28, 6, 36, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:45:59 AM'),
(29, 6, 35, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:46:39 AM'),
(30, 7, 58, 1, 2, 0, 6.5, '2013-11-01', '2015-11-29', 20, 'Active', NULL, '2014-11-26', '10:49:39 AM'),
(31, 7, 65, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:51:02 AM'),
(32, 7, 66, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:52:08 AM'),
(33, 7, 56, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:52:49 AM'),
(34, 7, 64, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:53:26 AM'),
(35, 7, 67, 1, 2, 0, 8.5, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:54:46 AM'),
(36, 7, 60, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:55:36 AM'),
(37, 7, 62, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:56:40 AM'),
(38, 7, 63, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:57:25 AM'),
(39, 7, 59, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '10:58:21 AM'),
(40, 7, 61, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-26', '11:00:38 AM'),
(41, 6, 68, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-28', '05:53:53 AM'),
(42, 6, 52, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-28', '06:49:42 AM'),
(43, 6, 69, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-28', '06:52:40 AM'),
(44, 7, 70, 1, 2, 0, 2.8499999046325684, '2013-11-01', '2015-11-30', 20, 'Active', NULL, '2014-11-28', '06:53:35 AM'),
(45, 5, 71, 1, 1, 14, 360, '2014-06-01', '2015-05-31', 20, 'Active', NULL, '2014-11-29', '17:15:22 PM'),
(46, 5, 71, 1, 1, 21, 400, '2014-06-01', '2015-05-31', 20, 'Active', NULL, '2014-11-29', '17:16:57 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_productloadunload`
--

CREATE TABLE IF NOT EXISTS `fna_productloadunload` (
  `PRODUCTLOADUNLOADID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(10) DEFAULT NULL,
  `LABOURID` int(10) DEFAULT NULL,
  `ENTRYDATE` date DEFAULT NULL,
  `RECEIVENUMBER` int(10) DEFAULT NULL,
  `DELIVERYCHALLANNUMBER` int(10) DEFAULT NULL,
  `LOTNO` varchar(100) NOT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCTLOADUNLOADID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `fna_productloadunload`
--

INSERT INTO `fna_productloadunload` (`PRODUCTLOADUNLOADID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `LABOURID`, `ENTRYDATE`, `RECEIVENUMBER`, `DELIVERYCHALLANNUMBER`, `LOTNO`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(12, 1, 2, 14, 7, '2014-11-30', 1, NULL, '', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(13, 1, 2, 14, 7, '2014-11-30', NULL, 1, '', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(14, 1, 2, 14, 7, '2014-11-30', NULL, 1, '', 20, 'Active', NULL, '2014-12-02', '11:28:52 AM'),
(15, 1, 1, 18, 11, '2014-12-02', 2, NULL, '2', 20, 'Active', NULL, '2014-12-07', '13:07:27 PM'),
(16, 1, 1, 18, 11, '2014-12-02', 3, NULL, '3', 20, 'Active', NULL, '2014-12-07', '13:09:51 PM'),
(17, 1, 1, 18, 11, '2014-12-02', 4, NULL, '4', 20, 'Active', NULL, '2014-12-07', '13:11:03 PM'),
(18, 1, 1, 18, 11, '2014-12-01', 5, NULL, '19', 20, 'Active', NULL, '2014-12-07', '13:14:46 PM'),
(19, 1, 1, 18, 11, '2014-12-03', 6, NULL, '38', 20, 'Active', NULL, '2014-12-07', '13:16:00 PM'),
(20, 1, 1, 18, 11, '2014-12-05', NULL, 1, '4', 20, 'Active', NULL, '2014-12-10', '04:23:24 AM'),
(21, 1, 1, 18, 11, '2014-12-05', NULL, 1, '3', 20, 'Active', NULL, '2014-12-10', '04:25:28 AM'),
(22, 1, 1, 18, 11, '2014-12-08', NULL, 1, '19', 20, 'Active', NULL, '2014-12-10', '04:32:38 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_productloadunloadbkdn`
--

CREATE TABLE IF NOT EXISTS `fna_productloadunloadbkdn` (
  `PRODUCTLOADUNLOADBKDNID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTLOADUNLOADID` int(11) NOT NULL,
  `PRODCATTYPEID` int(10) DEFAULT NULL,
  `PRODUCTID` int(10) DEFAULT NULL,
  `PACKINGUNITID` int(10) DEFAULT NULL,
  `CHALLANNO` int(11) NOT NULL,
  `QUANTITY` double DEFAULT NULL,
  `WTQNTY` double NOT NULL,
  `CHID` int(10) DEFAULT NULL,
  `POCKET` int(10) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCTLOADUNLOADBKDNID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `fna_productloadunloadbkdn`
--

INSERT INTO `fna_productloadunloadbkdn` (`PRODUCTLOADUNLOADBKDNID`, `PRODUCTLOADUNLOADID`, `PRODCATTYPEID`, `PRODUCTID`, `PACKINGUNITID`, `CHALLANNO`, `QUANTITY`, `WTQNTY`, `CHID`, `POCKET`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(69, 12, 6, 32, 18, 0, 1824, 419520, 6, 1, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(70, 12, 6, 33, 19, 0, 18331, 183310, 3, 6, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(71, 12, 6, 44, 15, 0, 19060, 2382500, 4, 5, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(72, 12, 7, 63, 15, 0, 156, 19500, 3, 1, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(73, 12, 7, 64, 11, 0, 42709, 1242400, 5, 3, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(74, 12, 7, 65, 11, 0, 3018, 88930, 5, 3, 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(75, 13, 6, 32, 18, 0, 1085, 0, 6, 1, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(76, 13, 6, 33, 19, 0, 11871, 0, 3, 2, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(77, 13, 6, 44, 15, 0, 2094, 0, 3, 2, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(78, 13, 7, 63, 15, 0, 41, 0, 1, 2, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(79, 13, 7, 64, 11, 0, 24810, 0, 5, 1, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(80, 13, 7, 65, 12, 0, 63, 0, 1, 6, 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(81, 14, 7, 63, 15, 0, 1, 0, 3, 1, 20, 'Active', NULL, '2014-12-02', '11:28:52 AM'),
(82, 15, 5, 71, 23, 0, 180, 0, 2, 2, 20, 'Active', NULL, '2014-12-07', '13:07:27 PM'),
(83, 16, 5, 71, 23, 0, 210, 0, 2, 6, 20, 'Active', NULL, '2014-12-07', '13:09:51 PM'),
(84, 17, 5, 71, 23, 0, 10, 0, 2, 1, 20, 'Active', NULL, '2014-12-07', '13:11:03 PM'),
(85, 18, 5, 71, 23, 0, 14, 0, 2, 3, 20, 'Active', NULL, '2014-12-07', '13:14:46 PM'),
(86, 19, 5, 71, 23, 0, 12, 0, 2, 2, 20, 'Active', NULL, '2014-12-07', '13:16:00 PM'),
(87, 20, 5, 71, 23, 0, 100, 0, NULL, NULL, 20, 'Active', NULL, '2014-12-10', '04:23:24 AM'),
(88, 21, 5, 71, 23, 0, 210, 0, NULL, NULL, 20, 'Active', NULL, '2014-12-10', '04:25:28 AM'),
(89, 22, 5, 71, 23, 0, 5, 0, NULL, NULL, 20, 'Active', NULL, '2014-12-10', '04:32:38 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_productstock`
--

CREATE TABLE IF NOT EXISTS `fna_productstock` (
  `PRODUCTSTOCKID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTLOADUNLOADBKDNID` int(10) DEFAULT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `PRODCATTYPEID` int(10) DEFAULT NULL,
  `LOTNO` int(100) DEFAULT NULL,
  `PRODUCTID` int(10) DEFAULT NULL,
  `QUANTITY` double DEFAULT NULL,
  `WTQNTY` double NOT NULL,
  `TOTQUANTITY` double DEFAULT NULL,
  `PARTYFLAG` int(11) NOT NULL,
  `PRODCATTYPEFLAG` int(10) DEFAULT NULL,
  `PRODTYPEFLAG` int(10) DEFAULT NULL,
  `WORKTYPEFLAG` varchar(10) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCTSTOCKID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `fna_productstock`
--

INSERT INTO `fna_productstock` (`PRODUCTSTOCKID`, `PRODUCTLOADUNLOADBKDNID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `PRODCATTYPEID`, `LOTNO`, `PRODUCTID`, `QUANTITY`, `WTQNTY`, `TOTQUANTITY`, `PARTYFLAG`, `PRODCATTYPEFLAG`, `PRODTYPEFLAG`, `WORKTYPEFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(69, 69, 1, 2, 14, 6, NULL, 32, 1824, 419520, 1824, 1, 1, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(70, 70, 1, 2, 14, 6, NULL, 33, 18331, 183310, 18331, 2, 2, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(71, 71, 1, 2, 14, 6, NULL, 44, 19060, 2382500, 19060, 3, 3, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(72, 72, 1, 2, 14, 7, NULL, 63, 156, 19500, 156, 4, 1, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(73, 73, 1, 2, 14, 7, NULL, 64, 42709, 1242400, 42709, 5, 2, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(74, 74, 1, 2, 14, 7, NULL, 65, 3018, 88930, 3018, 6, 3, 1, 'Load', 20, 'Active', NULL, '2014-12-02', '11:19:42 AM'),
(75, 75, 1, 2, 14, 6, NULL, 32, 1085, 0, 739, 7, 4, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(76, 76, 1, 2, 14, 6, NULL, 33, 11871, 0, 6460, 8, 5, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(77, 77, 1, 2, 14, 6, NULL, 44, 2094, 0, 16966, 9, 6, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(78, 78, 1, 2, 14, 7, NULL, 63, 41, 0, 115, 10, 4, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(79, 79, 1, 2, 14, 7, NULL, 64, 24810, 0, 17899, 11, 5, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(80, 80, 1, 2, 14, 7, NULL, 65, 63, 0, 2955, 12, 6, 2, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:27:49 AM'),
(81, 81, 1, 2, 14, 7, NULL, 63, 1, 0, 114, 13, 7, 3, 'Unload', 20, 'Active', NULL, '2014-12-02', '11:28:52 AM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_project`
--

CREATE TABLE IF NOT EXISTS `fna_project` (
  `PROJECTID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTNAME` varchar(200) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`PROJECTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fna_project`
--

INSERT INTO `fna_project` (`PROJECTID`, `PROJECTNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 'Cold Storage', 20, 'Active', 0, '2014-11-04', '17:52:07 PM'),
(2, 'Feed Mills', 20, 'Active', 0, '2014-11-04', '17:57:50 PM'),
(3, 'Paultry Firms', 20, 'Active', 0, '2014-11-04', '17:58:11 PM'),
(4, 'Hacheries', 20, 'Active', 0, '2014-11-04', '17:58:32 PM'),
(5, 'Medicine', 20, 'Active', 0, '2014-11-04', '17:58:51 PM'),
(6, 'FNA Group', 20, 'Active', 0, '2015-01-07', '20:02:11 PM'),
(7, 'Loan', 20, 'Active', 0, '2015-01-11', '16:27:11 PM'),
(8, 'Bank', 20, 'Active', 0, '2015-01-11', '16:27:22 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_quantity`
--

CREATE TABLE IF NOT EXISTS `fna_quantity` (
  `QID` int(11) NOT NULL AUTO_INCREMENT,
  `QVALUE` int(10) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`QID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `fna_quantity`
--

INSERT INTO `fna_quantity` (`QID`, `QVALUE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(4, 80, 20, 'Active', NULL, '2014-10-17', '17:43:24 PM'),
(6, 150, 20, 'Active', NULL, '2014-10-17', '17:43:46 PM'),
(10, 30, 20, 'Active', NULL, '2014-11-26', '12:42:53 PM'),
(11, 60, 20, 'Active', NULL, '2014-11-26', '12:54:39 PM'),
(12, 50, 20, 'Active', NULL, '2014-11-26', '12:55:01 PM'),
(13, 125, 20, 'Active', NULL, '2014-11-26', '12:55:19 PM'),
(14, 200, 20, 'Active', NULL, '2014-11-26', '12:55:28 PM'),
(15, 230, 20, 'Active', NULL, '2014-11-26', '12:55:36 PM'),
(16, 10, 20, 'Active', NULL, '2014-11-28', '06:05:00 AM'),
(17, 20, 20, 'Active', NULL, '2014-11-28', '06:05:08 AM'),
(18, 100, 20, 'Active', NULL, '2014-11-29', '17:16:11 PM'),
(19, 85, 20, 'Active', NULL, '2014-12-07', '12:41:19 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_session`
--

CREATE TABLE IF NOT EXISTS `fna_session` (
  `SESSIONID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODCATTYPEID` int(11) NOT NULL,
  `STARTDATE` date DEFAULT NULL,
  `ENDDATE` date DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SESSIONID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fna_subproject`
--

CREATE TABLE IF NOT EXISTS `fna_subproject` (
  `SUBPROJECTID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTNAME` varchar(200) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`SUBPROJECTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `fna_subproject`
--

INSERT INTO `fna_subproject` (`SUBPROJECTID`, `PROJECTID`, `SUBPROJECTNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 1, 'Alu', 20, 'Active', 0, '2014-11-04', '18:24:10 PM'),
(2, 1, 'PRAN', 20, 'Active', 0, '2014-11-04', '18:24:24 PM'),
(3, 1, 'Fruits', 20, 'Active', 0, '2014-11-04', '18:24:45 PM'),
(4, 1, 'Kisuan', 20, 'Active', 0, '2014-11-12', '16:01:58 PM'),
(5, 1, 'Nantoo Traders', 20, 'Active', 0, '2014-11-21', '09:50:18 AM'),
(6, 2, 'Feed Mill', 20, 'Active', 0, '2014-12-10', '18:49:01 PM'),
(7, 5, 'Medicine', 20, 'Active', 0, '2014-12-22', '15:11:44 PM'),
(8, 3, 'Poultry', 20, 'Active', 0, '2014-12-29', '15:41:21 PM'),
(9, 4, 'Hatchery', 20, 'Active', 0, '2015-01-03', '18:23:54 PM'),
(10, 6, 'FNA', 20, 'Active', 0, '2015-01-07', '20:02:26 PM'),
(11, 8, 'Bank', 20, 'Active', 0, '2015-01-11', '16:27:36 PM'),
(12, 7, 'Loan', 20, 'Active', 0, '2015-01-11', '16:27:49 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_weight`
--

CREATE TABLE IF NOT EXISTS `fna_weight` (
  `WTID` int(11) NOT NULL AUTO_INCREMENT,
  `WNAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`WTID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fna_weight`
--

INSERT INTO `fna_weight` (`WTID`, `WNAME`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 'KG', 20, 'Active', NULL, '2014-09-20', '17:49:55 PM'),
(2, 'Ltr', 20, 'Active', NULL, '2014-09-20', '17:50:15 PM'),
(3, 'pcs', 20, 'Active', NULL, '2014-12-26', '18:38:35 PM'),
(4, 'gram', 20, 'Active', NULL, '2014-12-26', '18:38:51 PM'),
(5, 'ml', 20, 'Active', NULL, '2014-12-26', '18:39:01 PM');

-- --------------------------------------------------------

--
-- Table structure for table `fna_worktype`
--

CREATE TABLE IF NOT EXISTS `fna_worktype` (
  `WORKTYPEID` int(10) NOT NULL,
  `WORKTYPENAME` varchar(100) DEFAULT NULL,
  `USERID` int(11) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL,
  `ENTDATE` date DEFAULT NULL,
  `ENTTIME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hatch_chicken_production`
--

CREATE TABLE IF NOT EXISTS `hatch_chicken_production` (
  `CPID` int(11) NOT NULL AUTO_INCREMENT,
  `ESIMID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `HATCHNO` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `TOTQUANTITY` int(11) NOT NULL,
  `CHICKPRICEPERPCS` double NOT NULL,
  `RATE` double NOT NULL,
  `PRICE` double NOT NULL,
  `TOTPRICE` double NOT NULL,
  `PERCENTAGE` double NOT NULL,
  `CPDATE` date NOT NULL,
  `HATCHFLAG` int(11) NOT NULL,
  `WORKSFLAG` varchar(50) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`CPID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `hatch_chicken_production`
--

INSERT INTO `hatch_chicken_production` (`CPID`, `ESIMID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `HATCHNO`, `QUANTITY`, `TOTQUANTITY`, `CHICKPRICEPERPCS`, `RATE`, `PRICE`, `TOTPRICE`, `PERCENTAGE`, `CPDATE`, `HATCHFLAG`, `WORKSFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(18, 13, 4, 9, 0, 1, 1200, 1200, 14.166666666667, 0, 0, 0, 80, '2015-01-03', 1, 'In', 20, 'Active', 0, '2015-01-03', '17:11:23 PM'),
(19, 13, 4, 9, 23, 1, 500, 700, 14.166666666667, 20, 10000, 10000, 80, '2015-01-04', 2, 'Out', 20, 'Active', 0, '2015-01-03', '18:22:01 PM'),
(20, 13, 4, 9, 23, 1, 200, 500, 14.166666666667, 21, 4200, 5800, 80, '2015-01-05', 3, 'Out', 20, 'Active', 0, '2015-01-04', '16:28:23 PM'),
(21, 17, 4, 9, 0, 17, 2600, 2600, 16.985028394425, 0, 0, 0, 92.85714285714286, '2015-01-07', 1, 'In', 20, 'Active', 0, '2015-01-04', '16:30:57 PM'),
(22, 17, 4, 9, 23, 17, 1000, 1600, 16.985028394425, 21, 21000, 21000, 92.85714285714286, '2015-01-08', 2, 'Out', 20, 'Active', 0, '2015-01-04', '16:31:18 PM'),
(23, 17, 4, 9, 23, 17, 250, 1350, 16.985028394425, 19, 4750, 16250, 92.85714285714286, '2015-01-11', 3, 'Out', 20, 'Active', 0, '2015-01-04', '17:06:25 PM'),
(24, 17, 4, 9, 22, 17, 220, 1130, 16.985028394425, 20, 4400, 11850, 92.85714285714286, '2015-01-12', 4, 'Out', 20, 'Active', 0, '2015-01-04', '19:01:14 PM'),
(25, 19, 4, 9, 0, 19, 1200, 1200, 15.765765765767, 0, 0, 0, 85.71428571428571, '2015-01-15', 1, 'In', 20, 'Active', 0, '2015-01-11', '15:15:03 PM'),
(26, 19, 4, 9, 23, 19, 1000, 200, 15.765765765767, 21, 21000, 21000, 85.71428571428571, '2015-01-17', 2, 'Out', 20, 'Active', 0, '2015-01-11', '15:17:20 PM');

-- --------------------------------------------------------

--
-- Table structure for table `hatch_egg_settings_machine`
--

CREATE TABLE IF NOT EXISTS `hatch_egg_settings_machine` (
  `ESIMID` int(11) NOT NULL AUTO_INCREMENT,
  `OHEID` int(11) NOT NULL,
  `HATCHNO` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `EGGQNTY` int(11) NOT NULL,
  `TOTALEGGQNTY` int(11) NOT NULL,
  `EGGPRICE` double NOT NULL,
  `EGGTOTPRICE` double NOT NULL,
  `HATCHFLAG` int(11) NOT NULL,
  `ESIMDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`ESIMID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hatch_egg_settings_machine`
--

INSERT INTO `hatch_egg_settings_machine` (`ESIMID`, `OHEID`, `HATCHNO`, `PROJECTID`, `SUBPROJECTID`, `EGGQNTY`, `TOTALEGGQNTY`, `EGGPRICE`, `EGGTOTPRICE`, `HATCHFLAG`, `ESIMDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(13, 29, 1, 4, 9, 1500, 1500, 17000, 17000, 1, '2015-01-05', 20, 'In', 1, '2015-01-03', '17:00:55 PM'),
(16, 29, 1, 4, 9, 1500, 0, 17000, 0, 2, '2015-01-03', 20, 'Out', 2, '2015-01-03', '17:11:23 PM'),
(17, 32, 17, 4, 9, 2800, 2800, 44161.073825504, 44161.073825504, 1, '2015-01-05', 20, 'In', 3, '2015-01-04', '16:30:39 PM'),
(18, 32, 17, 4, 9, 2800, 0, 44161.073825504, 0, 2, '2015-01-07', 20, 'Out', 4, '2015-01-04', '16:30:57 PM'),
(19, 41, 19, 4, 9, 1400, 1400, 18918.91891892, 18918.91891892, 1, '2015-01-11', 20, 'In', 5, '2015-01-11', '15:13:33 PM'),
(20, 41, 19, 4, 9, 1400, 0, 18918.91891892, 0, 2, '2015-01-15', 20, 'Out', 6, '2015-01-11', '15:15:03 PM');

-- --------------------------------------------------------

--
-- Table structure for table `hatch_opening_hatching_egg`
--

CREATE TABLE IF NOT EXISTS `hatch_opening_hatching_egg` (
  `OHEID` int(11) NOT NULL AUTO_INCREMENT,
  `ESID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `OPENDATE` date NOT NULL,
  `EGGQUANTITY` int(11) NOT NULL,
  `VANGAEGGQNTY` int(11) NOT NULL,
  `TOTVANGAEGGQNTY` int(11) NOT NULL,
  `TOTEGGQNTY` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `TOTPRICE` double NOT NULL,
  `RATE` double NOT NULL,
  `AVGRATEPEREGG` double NOT NULL,
  `OHEFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`OHEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `hatch_opening_hatching_egg`
--

INSERT INTO `hatch_opening_hatching_egg` (`OHEID`, `ESID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `OPENDATE`, `EGGQUANTITY`, `VANGAEGGQNTY`, `TOTVANGAEGGQNTY`, `TOTEGGQNTY`, `PRICE`, `TOTPRICE`, `RATE`, `AVGRATEPEREGG`, `OHEFLAG`, `USERID`, `STATUS`, `ENTDATE`, `ENTTIME`) VALUES
(35, 36, 4, 9, 8, '2015-01-12', 2000, 0, 0, 2000, 20000, 20000, 10, 10, 1, 20, 'In', '2015-01-05', '16:18:11 PM'),
(36, 36, 4, 9, 8, '2015-01-13', 100, 20, 20, 1880, 20000, 20000, 10, 10.63829787234, 2, 20, 'Cancel', '2015-01-05', '16:18:29 PM'),
(37, 36, 4, 9, 8, '2015-01-14', 120, 30, 50, 1730, 20000, 20000, 10, 11.560693641618, 3, 20, 'Cancel', '2015-01-05', '16:18:57 PM'),
(38, 36, 4, 9, 8, '2015-01-15', 50, 0, 50, 1680, 20000, 20000, 10, 11.904761904762, 4, 20, 'Cancel', '2015-01-05', '16:36:11 PM'),
(40, 36, 4, 9, 8, '2015-01-06', 50, 40, 10, 1680, 120, 20000, 10, 11.904761904762, 5, 20, 'VangaSell', '2015-01-05', '18:40:19 PM'),
(41, 36, 4, 9, 8, '2015-01-11', 100, 100, 110, 1480, 120, 20000, 10, 13.513513513514, 6, 20, 'Cancel', '2015-01-11', '15:13:00 PM'),
(42, 36, 4, 9, 8, '2015-01-11', 1400, 0, 0, 80, 120, 20000, 10, 13.513513513514, 7, 20, 'Out', '2015-01-11', '15:13:33 PM');

-- --------------------------------------------------------

--
-- Table structure for table `hatch_vangaeggsell`
--

CREATE TABLE IF NOT EXISTS `hatch_vangaeggsell` (
  `VESID` int(11) NOT NULL AUTO_INCREMENT,
  `OHEID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `TOTQUANTITY` int(11) NOT NULL,
  `RATE` double NOT NULL,
  `PRICE` double NOT NULL,
  `TOTALPRICE` double NOT NULL,
  `VESDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`VESID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hatch_vangaeggsell`
--

INSERT INTO `hatch_vangaeggsell` (`VESID`, `OHEID`, `PARTYID`, `QUANTITY`, `TOTQUANTITY`, `RATE`, `PRICE`, `TOTALPRICE`, `VESDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(4, 0, 23, 40, 40, 3, 120, 120, '2015-01-06', 20, 'VangaSell', 1, '2015-01-05', '18:40:19 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_batchopen`
--

CREATE TABLE IF NOT EXISTS `pal_batchopen` (
  `BOID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `BWISELIVESTOCK` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `BDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`BOID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pal_batchopen`
--

INSERT INTO `pal_batchopen` (`BOID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `BWISELIVESTOCK`, `PRICE`, `BDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(12, 3, 8, 1, 5000, 100000, '2015-01-03', 20, 'Inactive', 0, '2015-01-10', '17:29:19 PM'),
(13, 0, 0, 2, 3800, 38000, '2015-01-19', 20, 'Inactive', 0, '2015-01-19', '16:29:10 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_dailyoperation`
--

CREATE TABLE IF NOT EXISTS `pal_dailyoperation` (
  `DOID` int(11) NOT NULL AUTO_INCREMENT,
  `BOID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `DODATE` date NOT NULL,
  `STOCKINHAND` int(11) NOT NULL,
  `DEADSTOCK` int(11) NOT NULL,
  `CANCELSTOCK` int(11) NOT NULL,
  `SELLSTOCK` int(11) NOT NULL,
  `SELLPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`DOID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pal_dailyoperation`
--

INSERT INTO `pal_dailyoperation` (`DOID`, `BOID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `BATCHNO`, `DODATE`, `STOCKINHAND`, `DEADSTOCK`, `CANCELSTOCK`, `SELLSTOCK`, `SELLPRICE`, `BATCHFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(19, 12, 3, 8, 25, 1, '2015-01-04', 4700, 100, 100, 100, 2200, 1, 20, 'Inactive', 0, '2015-01-10', '17:36:59 PM'),
(20, 13, 3, 8, 25, 2, '2015-01-19', 3660, 10, 10, 120, 1800, 1, 20, 'Inactive', 0, '2015-01-19', '16:29:44 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_egg_production`
--

CREATE TABLE IF NOT EXISTS `pal_egg_production` (
  `EPID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `MURGIQNTY` int(11) NOT NULL,
  `EGGQNTY` int(11) NOT NULL,
  `EGGTOTQNTY` int(11) NOT NULL,
  `EGGPERCENTAGE` double NOT NULL,
  `EPDATE` date NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`EPID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `pal_egg_production`
--

INSERT INTO `pal_egg_production` (`EPID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `MURGIQNTY`, `EGGQNTY`, `EGGTOTQNTY`, `EGGPERCENTAGE`, `EPDATE`, `BATCHFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(35, 3, 8, 1, 3000, 2700, 2700, 90, '2015-01-09', 1, 20, 'Active', 0, '2015-01-10', '18:03:33 PM'),
(36, 3, 8, 1, 3000, 200, 2500, 90, '2015-01-09', 2, 20, 'Out', 0, '2015-01-10', '18:11:32 PM'),
(37, 3, 8, 1, 3000, 100, 2400, 90, '2015-01-09', 3, 20, 'Out', 0, '2015-01-22', '19:06:47 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_egg_sell`
--

CREATE TABLE IF NOT EXISTS `pal_egg_sell` (
  `ESID` int(11) NOT NULL AUTO_INCREMENT,
  `SCID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `RATE` double NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `TOTQUANTITY` int(11) NOT NULL,
  `TOTPRICE` double NOT NULL,
  `GRANDTOTALPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `ESDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`ESID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `pal_egg_sell`
--

INSERT INTO `pal_egg_sell` (`ESID`, `SCID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `PARTYID`, `RATE`, `QUANTITY`, `TOTQUANTITY`, `TOTPRICE`, `GRANDTOTALPRICE`, `BATCHFLAG`, `ESDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(37, 2, 3, 8, 1, 25, 6, 200, 200, 1200, 1200, 1, '2015-01-09', 20, 'Active', 0, '2015-01-10', '18:11:32 PM'),
(38, 2, 3, 8, 1, 26, 212, 100, 300, 21200, 22400, 2, '2015-01-22', 20, 'Active', 0, '2015-01-22', '19:06:47 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_fooddistribute`
--

CREATE TABLE IF NOT EXISTS `pal_fooddistribute` (
  `FDID` int(11) NOT NULL AUTO_INCREMENT,
  `FOODID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `DOID` int(11) NOT NULL,
  `MURID` int(11) NOT NULL,
  `MORID` int(11) NOT NULL,
  `MUR_MOR_QNTY` int(11) NOT NULL,
  `FOOD_NEED_MUR_MOR` double NOT NULL,
  `FOODWEIGHT` double NOT NULL,
  `TOTFOODWEIGHT` double NOT NULL,
  `PRICE` double NOT NULL,
  `TOTALPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `FDDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`FDID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pal_fooddistribute`
--

INSERT INTO `pal_fooddistribute` (`FDID`, `FOODID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `DOID`, `MURID`, `MORID`, `MUR_MOR_QNTY`, `FOOD_NEED_MUR_MOR`, `FOODWEIGHT`, `TOTFOODWEIGHT`, `PRICE`, `TOTALPRICE`, `BATCHFLAG`, `FDDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(12, 3, 3, 8, 1, 0, 24, 27, 4700, 25, 117.5, 117.5, 73.285254237288, 8611.0174, 1, '2015-01-05', 20, 'Active', 0, '2015-01-10', '17:47:09 PM'),
(13, 3, 3, 8, 1, 0, 24, 27, 4700, 20, 94, 211.5, 73.285254237288, 6888.8139, 2, '2015-01-07', 20, 'Active', 0, '2015-01-10', '17:55:53 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_medicine`
--

CREATE TABLE IF NOT EXISTS `pal_medicine` (
  `MID` int(11) NOT NULL AUTO_INCREMENT,
  `PARTYID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `PRODUCTID` int(11) NOT NULL,
  `QUANTITY` double NOT NULL,
  `WTID` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `TOTALPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `MDDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pal_medicine`
--

INSERT INTO `pal_medicine` (`MID`, `PARTYID`, `PROJECTID`, `SUBPROJECTID`, `BATCHNO`, `PRODUCTID`, `QUANTITY`, `WTID`, `PRICE`, `TOTALPRICE`, `BATCHFLAG`, `MDDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(7, 0, 3, 8, 1, 82, 10, 3, 3, 30, 1, '2015-01-09', 20, 'Active', 0, '2015-01-10', '18:02:15 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_morog`
--

CREATE TABLE IF NOT EXISTS `pal_morog` (
  `MORID` int(11) NOT NULL AUTO_INCREMENT,
  `DOID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `STOCKINHAND` int(11) NOT NULL,
  `DEADSTOCK` int(11) NOT NULL,
  `CANCELSTOCK` int(11) NOT NULL,
  `SELLSTOCK` int(11) NOT NULL,
  `SELLPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`MORID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `pal_morog`
--

INSERT INTO `pal_morog` (`MORID`, `DOID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `BATCHNO`, `ENTRYDATE`, `STOCKINHAND`, `DEADSTOCK`, `CANCELSTOCK`, `SELLSTOCK`, `SELLPRICE`, `BATCHFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(24, 19, 0, 0, 25, 1, '2015-01-04', 1700, 0, 0, 0, 0, 1, 20, 'Active', 0, '2015-01-10', '17:40:44 PM'),
(25, 19, 3, 8, 25, 1, '2015-01-05', 1480, 10, 10, 200, 40000, 2, 20, 'Active', 0, '2015-01-10', '17:41:20 PM'),
(26, 19, 3, 8, 25, 1, '2015-01-10', 1380, 10, 10, 200, 40000, 3, 20, 'Out', 0, '2015-01-10', '18:24:20 PM'),
(27, 20, 0, 0, 25, 2, '2015-01-20', 1000, 0, 0, 0, 0, 1, 20, 'Active', 0, '2015-01-19', '16:47:32 PM'),
(28, 20, 3, 8, 25, 2, '2015-01-21', 860, 10, 10, 120, 25200, 2, 20, 'Active', 0, '2015-01-19', '16:48:06 PM'),
(29, 20, 3, 8, 25, 2, '2015-01-21', 800, 0, 0, 60, 12600, 3, 20, 'Active', 0, '2015-01-21', '16:48:50 PM'),
(32, 19, 3, 8, 26, 1, '2015-01-21', 1260, 10, 10, 200, 25680, 4, 20, 'Out', 0, '2015-01-22', '19:36:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_morog_murgi_sell`
--

CREATE TABLE IF NOT EXISTS `pal_morog_murgi_sell` (
  `MMSID` int(11) NOT NULL AUTO_INCREMENT,
  `BATCHNO` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `MURGIQNTY` int(11) NOT NULL,
  `MOROGQNTY` int(11) NOT NULL,
  `TOTQUANTITY` int(11) NOT NULL,
  `RATE` double NOT NULL,
  `TOTPRICE` double NOT NULL,
  `GRANDTOTPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `MMSELLDATE` date NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`MMSID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `pal_morog_murgi_sell`
--

INSERT INTO `pal_morog_murgi_sell` (`MMSID`, `BATCHNO`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `MURGIQNTY`, `MOROGQNTY`, `TOTQUANTITY`, `RATE`, `TOTPRICE`, `GRANDTOTPRICE`, `BATCHFLAG`, `MMSELLDATE`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(19, 1, 3, 8, 25, 0, 100, 100, 200, 20000, 20000, 1, '2015-01-10', 20, 'Active', 0, '2015-01-10', '18:24:20 PM'),
(20, 1, 3, 8, 25, 300, 0, 400, 200, 60000, 80000, 2, '2015-01-11', 20, 'Active', 0, '2015-01-11', '15:11:05 PM'),
(25, 1, 3, 8, 26, 0, 120, 520, 214, 25680, 105680, 3, '2015-01-21', 20, 'Active', 0, '2015-01-22', '19:36:45 PM'),
(26, 1, 3, 8, 26, 213, 0, 733, 231, 49203, 154883, 4, '2015-01-21', 20, 'Active', 0, '2015-01-22', '19:36:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_murgi`
--

CREATE TABLE IF NOT EXISTS `pal_murgi` (
  `MURID` int(11) NOT NULL AUTO_INCREMENT,
  `DOID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `PARTYID` int(11) NOT NULL,
  `BATCHNO` int(11) NOT NULL,
  `ENTRYDATE` date NOT NULL,
  `STOCKINHAND` int(11) NOT NULL,
  `DEADSTOCK` int(11) NOT NULL,
  `CANCELSTOCK` int(11) NOT NULL,
  `SELLSTOCK` int(11) NOT NULL,
  `SELLPRICE` double NOT NULL,
  `BATCHFLAG` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`MURID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `pal_murgi`
--

INSERT INTO `pal_murgi` (`MURID`, `DOID`, `PROJECTID`, `SUBPROJECTID`, `PARTYID`, `BATCHNO`, `ENTRYDATE`, `STOCKINHAND`, `DEADSTOCK`, `CANCELSTOCK`, `SELLSTOCK`, `SELLPRICE`, `BATCHFLAG`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(27, 19, 0, 0, 25, 1, '2015-01-04', 3000, 0, 0, 0, 0, 1, 20, 'Active', 0, '2015-01-10', '17:40:44 PM'),
(28, 19, 3, 8, 25, 1, '2015-01-11', 2700, 0, 0, 0, 0, 2, 20, 'Out', 0, '2015-01-11', '15:11:05 PM'),
(29, 20, 0, 0, 25, 2, '2015-01-20', 2660, 0, 0, 0, 0, 1, 20, 'Active', 0, '2015-01-19', '16:47:32 PM'),
(30, 20, 3, 8, 25, 2, '2015-01-21', 2500, 10, 10, 140, 30100, 2, 20, 'Active', 0, '2015-01-19', '16:49:42 PM'),
(31, 20, 3, 8, 25, 2, '2015-01-21', 2400, 0, 0, 100, 20000, 3, 20, 'Active', 0, '2015-01-21', '16:47:22 PM'),
(34, 19, 3, 8, 26, 1, '2015-01-21', 2487, 0, 0, 213, 45369, 3, 20, 'Out', 0, '2015-01-22', '19:36:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pal_sellcategory`
--

CREATE TABLE IF NOT EXISTS `pal_sellcategory` (
  `SCID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECTID` int(11) NOT NULL,
  `SUBPROJECTID` int(11) NOT NULL,
  `SCNAME` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `FLAG` int(11) NOT NULL,
  `ENTDATE` date NOT NULL,
  `ENTTIME` varchar(50) NOT NULL,
  PRIMARY KEY (`SCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pal_sellcategory`
--

INSERT INTO `pal_sellcategory` (`SCID`, `PROJECTID`, `SUBPROJECTID`, `SCNAME`, `DESCRIPTION`, `USERID`, `STATUS`, `FLAG`, `ENTDATE`, `ENTTIME`) VALUES
(1, 0, 0, 'Haching', 'Haching', 20, 'Active', 0, '2014-12-27', '12:24:47 PM'),
(2, 0, 0, 'Commercial', 'Commercial', 20, 'Active', 0, '2014-12-27', '12:25:55 PM'),
(3, 0, 0, 'Vanga', 'Vanga', 20, 'Active', 0, '2014-12-27', '12:26:13 PM'),
(4, 0, 0, 'Cancel', 'Cancel', 20, 'Active', 0, '2014-12-27', '12:26:23 PM');

-- --------------------------------------------------------

--
-- Table structure for table `s_category`
--

CREATE TABLE IF NOT EXISTS `s_category` (
  `CATEGORY_ID` int(20) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(250) NOT NULL,
  PRIMARY KEY (`CATEGORY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `s_category`
--

INSERT INTO `s_category` (`CATEGORY_ID`, `CATEGORY`) VALUES
(1, 'Banking & Financial Industry'),
(2, 'Career Development'),
(3, 'Web Application'),
(4, 'Finance & Accounting'),
(5, 'HR & Administration'),
(6, 'Information Technology'),
(7, 'Leadership & Change Management'),
(8, 'NGO & Development Sectors'),
(9, 'Quality & Productivity'),
(10, 'Ready Made Garments'),
(11, 'Sales & Marketing'),
(12, 'Environmental Science');

-- --------------------------------------------------------

--
-- Table structure for table `s_default_role_privileage`
--

CREATE TABLE IF NOT EXISTS `s_default_role_privileage` (
  `DRP_ID` int(20) NOT NULL AUTO_INCREMENT,
  `ROLE_ID` int(20) NOT NULL,
  `SUB_MODULE_ID` int(20) NOT NULL,
  PRIMARY KEY (`DRP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `s_default_role_privileage`
--

INSERT INTO `s_default_role_privileage` (`DRP_ID`, `ROLE_ID`, `SUB_MODULE_ID`) VALUES
(1, 17, 2),
(2, 17, 1),
(3, 18, 5),
(4, 18, 6),
(5, 19, 7),
(6, 20, 11),
(7, 20, 8),
(8, 20, 10),
(9, 20, 15),
(10, 20, 14),
(11, 20, 13),
(12, 20, 12),
(13, 20, 16),
(14, 20, 6),
(15, 20, 7),
(16, 21, 11),
(17, 21, 8),
(18, 21, 10),
(19, 21, 15),
(20, 21, 14),
(21, 21, 13),
(22, 21, 12),
(23, 21, 16),
(24, 21, 6),
(25, 21, 7),
(26, 22, 5),
(27, 22, 9),
(28, 22, 3),
(29, 22, 2),
(30, 22, 1),
(31, 22, 19),
(32, 22, 18),
(33, 22, 9),
(34, 23, 21),
(35, 23, 20),
(36, 23, 9),
(37, 24, 19),
(38, 24, 21),
(39, 24, 18),
(40, 24, 20),
(41, 24, 9);

-- --------------------------------------------------------

--
-- Table structure for table `s_module`
--

CREATE TABLE IF NOT EXISTS `s_module` (
  `MODULE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SERVICE_ID` int(20) NOT NULL,
  `MODULE_NAME` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(10) NOT NULL,
  PRIMARY KEY (`MODULE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `s_module`
--

INSERT INTO `s_module` (`MODULE_ID`, `SERVICE_ID`, `MODULE_NAME`, `DESCRIPTION`, `ORDER_NO`) VALUES
(1, 1, 'User Registration', 'User Registration', 1),
(2, 1, 'Privilege Control', 'Privilege Control', 3),
(3, 1, 'File Management', 'File Management', 2),
(5, 3, 'Project File Management', 'Project File Management', 1),
(6, 4, 'Package', 'Package', 1),
(7, 5, 'Reports', 'Reports', 1),
(8, 6, 'Project', 'Project', 1),
(9, 7, 'Objective/Purpose of This Tool', ' ', 1),
(10, 8, 'Contact Information', ' ', 1),
(11, 9, 'Home', ' ', 1),
(12, 10, 'FNA Operation', ' ', 1),
(14, 11, 'Load Entry', ' ', 1),
(15, 11, 'Unload Entry Form', ' Unload Entry Form', 2),
(16, 5, 'Received Number', ' ', 2),
(17, 11, 'Transfer', ' Transfer', 3),
(18, 11, 'Palot Entry', ' Palot Entry', 4),
(19, 5, 'Gate Pass', ' Gate Pass', 3),
(20, 12, 'Labour Bill Payment', ' Labour Bill', 1),
(21, 12, 'Party Payment Receive', ' Payment receive', 2),
(22, 5, 'Pran Product Receive', ' Receive Product', 5),
(23, 5, 'Pran Product Delivery', ' Product Delivery', 4),
(24, 5, 'FNA Bill', ' FNA Bill', 6),
(25, 5, 'Labour Bill', ' Labour Bill', 7),
(26, 5, 'Party Wise Stock', ' Party Stock', 8),
(27, 11, 'Expanse Entry Form', ' Expanse Entry ', 5),
(28, 5, 'Expanse Individual', 'Expanse Head Wise ', 9),
(29, 11, 'Loan Entry Form', ' Loan Entry Form', 6),
(30, 11, 'Basta Entry Form', ' Basta', 7),
(31, 12, 'Loan Payment Entry', ' Loan Payment', 3),
(32, 5, 'FNA Bill Sub Project', ' FNA Bill Sub Project Wise', 10),
(33, 5, 'Profit and Loss Report', ' Profit or loss', 11),
(34, 5, 'Expanse Head Wise Project', ' Project ', 12),
(35, 5, 'Project Wise Profit & Loss', ' Project Wise Profit & Loss', 13),
(36, 5, 'FNA Payment Receive', ' Payment Receive', 14),
(37, 11, 'Alu Load Entry', ' Alu Load', 8),
(38, 11, 'Alu Unload Entry', ' Alu Unload', 9),
(39, 5, 'Party Wise Alu Stock', ' Alu Stock', 15),
(40, 5, 'Alu Stock Report', ' Alu Stock ', 16),
(41, 13, 'Purchase Raw Materials', ' Raw Mat Purchase', 1),
(42, 13, 'Food Item Entry', ' Food', 2),
(43, 13, 'Recipe Entry Form', ' Recipe', 3),
(44, 13, 'Production Entry', ' Production', 4),
(45, 14, 'Purchase Raw Materials', ' Raw Materials Purchase', 1),
(46, 14, 'Raw Materials Stock', ' Stock', 2),
(47, 14, 'Feed Production', ' Production', 3),
(48, 14, 'Raw Materials Use', ' Raw Use', 4),
(49, 14, 'Feed Mill Finished Goods Stock', ' Finished Goods', 5),
(50, 14, 'Recipe Report', ' Recipe', 6),
(51, 15, 'Poultry Entry Setup', ' Poultry', 1),
(52, 13, 'Profit Amount', ' Profit', 5),
(53, 15, 'Egg Sell Entry ', ' Egg Sell', 2),
(54, 15, 'Murgi Morog sell Entry', ' Murgi/Morog', 3),
(55, 16, 'Opening Batch', ' Opening Batch', 1),
(56, 16, 'Batch Wise Food distribution', ' ', 2),
(57, 16, 'Medicine Distribution', ' ', 3),
(58, 16, 'Egg Production', ' ', 4),
(59, 16, 'Egg Sell', ' ', 5),
(60, 16, 'Murgi Morog Sell', ' ', 6),
(61, 17, 'Hatchery Entry Form', ' ', 1),
(62, 18, 'Hatchery Opening Egg', ' ', 1),
(63, 18, 'Cancel Egg', ' ', 2),
(64, 18, 'Egg Settings in Machine', ' ', 3),
(65, 18, 'Chicken Production', ' ', 4),
(66, 18, 'Chicken Stock', ' ', 5),
(67, 18, 'Chicken Sales Statement', ' ', 6),
(68, 18, 'Party Bill', ' ', 7),
(69, 14, 'Profit or Loss Report', ' ', 7),
(70, 16, 'Profit or Loss Report', ' ', 7),
(71, 12, 'Payment Entry Form', ' ', 4),
(72, 12, 'Bank Transaction', ' ', 5),
(73, 18, 'Hatchery Profit or Loss', ' ', 8),
(74, 19, 'Bank Transaction', ' ', 1),
(75, 19, 'Balance Sheet', ' ', 2),
(76, 14, 'Balance Sheet', ' ', 8),
(77, 14, 'Party Bill', ' ', 8),
(78, 16, 'Party Bill', ' ', 8);

-- --------------------------------------------------------

--
-- Table structure for table `s_module_main`
--

CREATE TABLE IF NOT EXISTS `s_module_main` (
  `MODULE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SERVICE_ID` int(20) NOT NULL,
  `MODULE_NAME` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(10) NOT NULL,
  PRIMARY KEY (`MODULE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_operator`
--

CREATE TABLE IF NOT EXISTS `s_operator` (
  `OPERATOR_ID` int(20) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(20) NOT NULL,
  `OPNAME` varchar(100) NOT NULL,
  `OPPASS` varchar(100) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  PRIMARY KEY (`OPERATOR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `s_operator`
--

INSERT INTO `s_operator` (`OPERATOR_ID`, `USER_ID`, `OPNAME`, `OPPASS`, `START_DATE`, `END_DATE`) VALUES
(1, 1, 'admin', 'admin', '2013-03-09', '0000-00-00'),
(19, 18, 'PEDPIII_user1', '123456', '0000-00-00', '0000-00-00'),
(20, 19, 'adb_user', '123456', '0000-00-00', '0000-00-00'),
(21, 20, 'fna', '123456', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `s_position`
--

CREATE TABLE IF NOT EXISTS `s_position` (
  `POSITION_ID` int(20) NOT NULL AUTO_INCREMENT,
  `POSITION` varchar(100) NOT NULL,
  PRIMARY KEY (`POSITION_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `s_position`
--

INSERT INTO `s_position` (`POSITION_ID`, `POSITION`) VALUES
(1, 'Managing Director'),
(3, 'Chairman'),
(4, 'Officer'),
(5, 'Jr Officer'),
(6, 'Senior Officer'),
(7, 'Chairman Senior');

-- --------------------------------------------------------

--
-- Table structure for table `s_privilege_control`
--

CREATE TABLE IF NOT EXISTS `s_privilege_control` (
  `PRIVILEGE_CONTROL_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SUB_MODULE_ID` int(20) NOT NULL,
  `USER_ID` int(20) NOT NULL,
  `RECORD_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRIVILEGE_CONTROL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2877 ;

--
-- Dumping data for table `s_privilege_control`
--

INSERT INTO `s_privilege_control` (`PRIVILEGE_CONTROL_ID`, `SUB_MODULE_ID`, `USER_ID`, `RECORD_DATE`) VALUES
(443, 19, 18, '2014-09-02 07:40:51'),
(444, 21, 18, '2014-09-02 07:40:51'),
(445, 18, 18, '2014-09-02 07:40:51'),
(446, 5, 18, '2014-09-02 07:40:51'),
(447, 17, 18, '2014-09-02 07:40:51'),
(448, 20, 18, '2014-09-02 07:40:51'),
(449, 9, 18, '2014-09-02 07:40:51'),
(450, 3, 18, '2014-09-02 07:40:51'),
(451, 2, 18, '2014-09-02 07:40:51'),
(452, 1, 18, '2014-09-02 07:40:51'),
(454, 19, 19, '2014-09-05 00:24:27'),
(455, 21, 19, '2014-09-05 00:24:27'),
(456, 18, 19, '2014-09-05 00:24:27'),
(457, 5, 19, '2014-09-05 00:24:27'),
(458, 17, 19, '2014-09-05 00:24:27'),
(459, 20, 19, '2014-09-05 00:24:27'),
(460, 9, 19, '2014-09-05 00:24:27'),
(461, 3, 19, '2014-09-05 00:24:27'),
(462, 2, 19, '2014-09-05 00:24:27'),
(463, 1, 19, '2014-09-05 00:24:27'),
(2548, 9, 1, '2015-01-11 14:37:31'),
(2549, 3, 1, '2015-01-11 14:37:31'),
(2550, 2, 1, '2015-01-11 14:37:31'),
(2551, 1, 1, '2015-01-11 14:37:31'),
(2810, 52, 20, '2015-01-19 15:56:56'),
(2811, 54, 20, '2015-01-19 15:56:56'),
(2812, 62, 20, '2015-01-19 15:56:56'),
(2813, 51, 20, '2015-01-19 15:56:56'),
(2814, 53, 20, '2015-01-19 15:56:56'),
(2815, 86, 20, '2015-01-19 15:56:56'),
(2816, 59, 20, '2015-01-19 15:56:57'),
(2817, 57, 20, '2015-01-19 15:56:57'),
(2818, 87, 20, '2015-01-19 15:56:57'),
(2819, 79, 20, '2015-01-19 15:56:57'),
(2820, 55, 20, '2015-01-19 15:56:57'),
(2821, 56, 20, '2015-01-19 15:56:57'),
(2822, 58, 20, '2015-01-19 15:56:57'),
(2823, 60, 20, '2015-01-19 15:56:57'),
(2824, 47, 20, '2015-01-19 15:56:57'),
(2825, 48, 20, '2015-01-19 15:56:57'),
(2826, 40, 20, '2015-01-19 15:56:57'),
(2827, 37, 20, '2015-01-19 15:56:57'),
(2828, 23, 20, '2015-01-19 15:56:57'),
(2829, 39, 20, '2015-01-19 15:56:57'),
(2830, 27, 20, '2015-01-19 15:56:57'),
(2831, 26, 20, '2015-01-19 15:56:57'),
(2832, 24, 20, '2015-01-19 15:56:57'),
(2833, 5, 20, '2015-01-19 15:56:57'),
(2834, 82, 20, '2015-01-19 15:56:57'),
(2835, 29, 20, '2015-01-19 15:56:57'),
(2836, 41, 20, '2015-01-19 15:56:57'),
(2837, 30, 20, '2015-01-19 15:56:57'),
(2838, 81, 20, '2015-01-19 15:56:57'),
(2839, 85, 20, '2015-01-19 15:56:57'),
(2840, 84, 20, '2015-01-19 15:56:57'),
(2841, 71, 20, '2015-01-19 15:56:57'),
(2842, 73, 20, '2015-01-19 15:56:57'),
(2843, 75, 20, '2015-01-19 15:56:57'),
(2844, 77, 20, '2015-01-19 15:56:57'),
(2845, 76, 20, '2015-01-19 15:56:57'),
(2846, 74, 20, '2015-01-19 15:56:57'),
(2847, 72, 20, '2015-01-19 15:56:57'),
(2848, 83, 20, '2015-01-19 15:56:57'),
(2849, 78, 20, '2015-01-19 15:56:58'),
(2850, 21, 20, '2015-01-19 15:56:58'),
(2851, 63, 20, '2015-01-19 15:56:58'),
(2852, 64, 20, '2015-01-19 15:56:58'),
(2853, 61, 20, '2015-01-19 15:56:58'),
(2854, 66, 20, '2015-01-19 15:56:58'),
(2855, 68, 20, '2015-01-19 15:56:58'),
(2856, 69, 20, '2015-01-19 15:56:58'),
(2857, 67, 20, '2015-01-19 15:56:58'),
(2858, 70, 20, '2015-01-19 15:56:58'),
(2859, 65, 20, '2015-01-19 15:56:58'),
(2860, 88, 20, '2015-01-19 15:56:58'),
(2861, 80, 20, '2015-01-19 15:56:58'),
(2862, 50, 20, '2015-01-19 15:56:58'),
(2863, 44, 20, '2015-01-19 15:56:58'),
(2864, 38, 20, '2015-01-19 15:56:58'),
(2865, 34, 20, '2015-01-19 15:56:58'),
(2866, 42, 20, '2015-01-19 15:56:58'),
(2867, 46, 20, '2015-01-19 15:56:58'),
(2868, 28, 20, '2015-01-19 15:56:58'),
(2869, 35, 20, '2015-01-19 15:56:58'),
(2870, 49, 20, '2015-01-19 15:56:58'),
(2871, 36, 20, '2015-01-19 15:56:58'),
(2872, 32, 20, '2015-01-19 15:56:58'),
(2873, 33, 20, '2015-01-19 15:56:58'),
(2874, 43, 20, '2015-01-19 15:56:58'),
(2875, 45, 20, '2015-01-19 15:56:58'),
(2876, 25, 20, '2015-01-19 15:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `s_privilege_control_main`
--

CREATE TABLE IF NOT EXISTS `s_privilege_control_main` (
  `PRIVILEGE_CONTROL_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SUB_MODULE_ID` int(20) NOT NULL,
  `RECORD_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PRIVILEGE_CONTROL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `s_privilege_control_main`
--

INSERT INTO `s_privilege_control_main` (`PRIVILEGE_CONTROL_ID`, `SUB_MODULE_ID`, `RECORD_DATE`) VALUES
(31, 1, '2013-05-18 21:14:38'),
(32, 6, '2013-05-18 21:14:38'),
(33, 5, '2013-05-18 21:14:38'),
(34, 4, '2013-05-18 21:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `s_role`
--

CREATE TABLE IF NOT EXISTS `s_role` (
  `ROLE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `ROLE_NAME` varchar(100) NOT NULL,
  `FORWARD_TO` int(20) NOT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `s_role`
--

INSERT INTO `s_role` (`ROLE_ID`, `ROLE_NAME`, `FORWARD_TO`) VALUES
(1, 'Officer', 0),
(17, 'Sr. Executive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `s_service`
--

CREATE TABLE IF NOT EXISTS `s_service` (
  `SERVICE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SERVICE_NAME` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(20) NOT NULL,
  PRIMARY KEY (`SERVICE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `s_service`
--

INSERT INTO `s_service` (`SERVICE_ID`, `SERVICE_NAME`, `DESCRIPTION`, `ORDER_NO`) VALUES
(1, 'Setup', 'System Initialization', 8),
(3, 'FNA Setup', 'FNA Setup', 2),
(5, 'Reports', 'Reports', 44),
(6, 'Project', '', 33),
(7, 'Objective/Purpose of This Tool', ' ', 2),
(8, 'Contact Information', ' ', 3),
(9, 'Home', ' ', 1),
(11, 'FNA Operations', ' FNA Operations', 4),
(12, 'FNA Transaction', ' Bill payment', 3),
(13, 'Feed Entry', ' Feed Entry', 5),
(14, 'Feed Report', ' Feed Mill Report', 45),
(15, 'Poultry Entry', ' Poultry Entry ', 6),
(16, 'Poultry Report', ' Poultry Report', 46),
(17, 'Hatchery Entry', ' Hatchery Entry', 7),
(18, 'Hatchery Report', ' ', 47),
(19, 'Group Report', ' ', 48);

-- --------------------------------------------------------

--
-- Table structure for table `s_service_main`
--

CREATE TABLE IF NOT EXISTS `s_service_main` (
  `SERVICE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `SERVICE_NAME` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(20) NOT NULL,
  PRIMARY KEY (`SERVICE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_sub_module`
--

CREATE TABLE IF NOT EXISTS `s_sub_module` (
  `SUB_MODULE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `MODULE_ID` int(20) NOT NULL,
  `SUB_MODULE_NAME` varchar(1000) NOT NULL,
  `DEFAULT_FILE` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(10) NOT NULL,
  PRIMARY KEY (`SUB_MODULE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `s_sub_module`
--

INSERT INTO `s_sub_module` (`SUB_MODULE_ID`, `MODULE_ID`, `SUB_MODULE_NAME`, `DEFAULT_FILE`, `DESCRIPTION`, `ORDER_NO`) VALUES
(1, 1, 'User Registration', 'UserRegistration.php', 'User Registration', 1),
(2, 2, 'Privilege Control', 'PrivilegeControl.php', 'Privilege Control', 3),
(3, 3, 'File Management', 'FileManagement.php', 'File Management', 2),
(5, 5, 'FNA File Management', 'ProjectFileManagement.php', 'FNA File Management', 1),
(6, 6, 'Package Information', 'packageInformation.php', 'Package', 1),
(7, 6, 'PQ Stage', 'pqStage.php', 'PQ Stage', 2),
(8, 6, 'Bidding Document Preparation Stage', 'biddingDPStage.php', 'Bidding Document Preparation Stage', 3),
(9, 7, 'APP Sample', 'appSimple.php', '', 1),
(10, 6, 'Bidding/Proposal Stage', 'biddingProposalStage.php', '', 4),
(11, 6, 'Bid/ Proposal Evaluation Stage', 'bidProposalEvaluationStage.php', '', 5),
(12, 6, 'Evaluation Report Approval Stage', 'evaluationReportApprovalStage.php', '', 6),
(13, 6, 'Contracting Stage', 'contractingStage.php', '', 7),
(14, 6, 'Contract Management Stage', 'contractManagementStage.php', '', 8),
(15, 6, 'Contract Concluding Stage ', 'contractConcludingStage.php', '', 9),
(16, 6, 'Others Information ', 'othersInformation.php', '', 10),
(17, 8, 'Third Primary Education Development Program PEDP, III', 'project.php', '', 1),
(18, 9, 'Objective/Purpose of This Tool', 'objective_purpose.php', ' ', 1),
(19, 10, 'Contact Information', 'contactInformation.php', ' ', 1),
(20, 7, 'Advance Search', 'Advancesearch.php', ' ', 2),
(21, 11, 'Home', 'index.php', ' ', 1),
(22, 12, 'FNA Entry Form', 'fnaEntryForm.php', ' ', 1),
(23, 14, 'Load Entry', 'fnaLoad.php', ' ', 1),
(24, 15, 'Unload Entry Form', 'fnaunLoad.php', ' Unload Entry Form', 2),
(25, 16, 'Received Number', 'reptReceiveNumber.php', ' ', 1),
(26, 17, 'Transfer Entry', 'fnaTransfer.php', ' Transfer', 3),
(27, 18, 'Palot Entry', 'fnaPalot.php', ' Palot Entry Form', 4),
(28, 19, 'Gate Pass', 'reptGatepass.php', ' Gate Pass', 3),
(29, 20, 'Labour Bill Payment', 'fnaLabourBillPayment.php', ' Labour Bill Payment', 1),
(30, 21, 'Receive Entry Form', 'fnaPartyPaymentReceive.php', ' Payment Receive', 2),
(31, 7, 'Pran Product Receive', 'reptFnaPranReceive.php', ' Product Receive', 5),
(32, 23, 'Pran Product delivery', 'reptFnaPranDelivery.php', ' Product delivery', 4),
(33, 22, 'Pran Product Receive', 'reptFnaPranReceive.php', ' Product Receieve', 5),
(34, 24, 'FNA Bill', 'reptFnaBill.php', ' FNA Bill', 2),
(35, 25, 'Labour Bill', 'reptLabourBill.php', ' Labour Bill', 6),
(36, 26, 'Party Wise Stock', 'reptFnaPartyStock.php', ' Party Stock', 7),
(37, 27, 'Expanse Entry Form', 'fnaExpanse.php', ' Expanse Entry Form', 5),
(38, 28, 'Expanse Individual', 'reptFnaExpanseIndividual.php', ' Expanse Head Wise', 8),
(39, 29, 'Loan Entry Form', 'fnaLoan.php', ' Loan Entry Form', 6),
(40, 30, 'Basta Entry Form', 'fnaBasta.php', ' Basta', 7),
(41, 31, 'Loan Payment Entry', 'fnaLoanPayment.php', ' Loan Payment', 3),
(42, 32, 'FNA Bill Sub Project Wise', 'reptFnaBillSubProj.php', ' FNA Bill Sub Prolect', 10),
(43, 33, 'Profit and Loss Report', 'ReptProfitLoss.php', ' Profit or loss', 11),
(44, 34, 'Expanse Head Wise Project', 'reptFnaExpansesSubProj.php', ' Project wise', 12),
(45, 35, 'Project Wise Profit & Loss', 'ReptProjectWiseProfitLoss.php', ' Project Wise profit & Loss', 13),
(46, 36, 'FNA Payment Receive', 'reptFnaPaymentRec.php', ' Payment Receive', 14),
(47, 37, 'Alu Load Entry', 'fnaLoadAlu.php', ' Alu Load', 8),
(48, 38, 'Alu Unload Entry', 'fnaAluUnload.php', ' Alu Unload', 9),
(49, 39, 'Party Wise Alu Stock', 'reptFnaAluPartyStock.php', ' Alu Stock', 15),
(50, 40, 'Alu Stock Report', 'ReptAluStock.php', ' Alu Stock', 16),
(51, 41, 'Purchase Raw Materials', 'feedPurchaseRawMat.php', ' ', 1),
(52, 42, 'Food Item Entry', 'feedFoodItem.php', ' Food', 2),
(53, 43, 'Recipe Entry', 'feedRecipi.php', ' Recipe', 3),
(54, 44, 'Production Entry', 'feedProduction.php', ' Production', 4),
(55, 45, 'Purchase Raw Materials', 'ReptFeedRawMatPurchase.php', ' Raw Materials Purchase', 1),
(56, 46, 'Raw Materials Stock', 'ReptFeedRawMatStock.php', ' Stock', 2),
(57, 47, 'Feed Production', 'ReptFeedProduction.php', ' Production', 3),
(58, 48, 'Raw Materials Use', 'ReptFeedRawMatUse.php', ' Raw Use', 4),
(59, 49, 'Feed Mill Finished Goods Stock', 'ReptFeedMillFinishStock.php', ' Finished goods', 5),
(60, 50, 'Recipe Report', 'ReptFeedRecipe.php', ' Recipe', 6),
(61, 51, 'Poultry Entry', 'PaultryEntry.php', ' Poultry', 1),
(62, 52, 'Profit Amount', 'feedProfitAmount.php', ' Profit', 5),
(63, 53, 'Egg Sell Entry', 'PalEggSell.php', ' Egg Sell', 2),
(64, 54, 'Murgi/Morog Sell Entry', 'PalMorogMurgiSell.php', ' Murgi/Morog Sell', 3),
(65, 55, 'Opening Batch', 'ReptPalOpenBatch.php', ' Opening Batch', 1),
(66, 56, 'Batch Wise Food distribution', 'ReptPalFoodDist.php', ' ', 2),
(67, 57, 'Medicine Distribution', 'ReptPalMedicineDist.php', ' ', 3),
(68, 58, 'Egg Production', 'ReptPalEggProd.php', ' ', 4),
(69, 59, 'Egg Sell', 'ReptPalEggSell.php', ' ', 5),
(70, 60, 'Murgi Morog sell', 'ReptPalMurMorSell.php', ' ', 6),
(71, 61, 'Hatchery Entry Form', 'HatcheryEntry.php', ' ', 1),
(72, 62, 'Hatchery Opening Egg', 'ReptHatchOpeningEgg.php', ' ', 1),
(73, 63, 'Cancel Egg', 'ReptHatchCancelEgg.php', ' ', 2),
(74, 64, 'Egg settings in Machine', 'ReptHatchEggSettings.php', ' ', 3),
(75, 65, 'Chicken Production', 'ReptHatchChickenProd.php', ' ', 4),
(76, 66, 'Chicken Stock Report', 'ReptHatchChickenStock.php', ' ', 5),
(77, 67, 'Chicken Sales Statement', 'ReptHatchChickenSalesState.php', ' ', 6),
(78, 68, 'Party Bill', 'reptHatchPartyBillRec.php', ' ', 7),
(79, 69, 'Profit or Loss Report', 'ReptFeedProfitLoss.php', ' ', 7),
(80, 70, 'Profit or Loss Report', 'ReptPoultryProfitLoss.php', ' ', 7),
(81, 71, 'Payment Entry form', 'fnaPartyPayment.php', ' ', 4),
(82, 72, 'Bank Transaction', 'fnaBankTransaction.php', ' ', 5),
(83, 73, 'Hatchery Profit or Loss', 'ReptHatcheryProfitLoss.php', ' ', 8),
(84, 74, 'Bank Transaction', 'ReptBankTransaction.php', ' ', 1),
(85, 75, 'Balance Sheet', 'ReptGroupBalanceSheet.php', ' ', 2),
(86, 76, 'Balance Sheet', 'ReptFeedBalanceSheet.php', ' ', 8),
(87, 77, 'Party Bill', 'reptFeedPartyBillRec.php', ' ', 9),
(88, 78, 'Party Bill', 'reptPoultryPartyBillRec.php', ' ', 8);

-- --------------------------------------------------------

--
-- Table structure for table `s_sub_module_main`
--

CREATE TABLE IF NOT EXISTS `s_sub_module_main` (
  `SUB_MODULE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `MODULE_ID` int(20) NOT NULL,
  `SUB_MODULE_NAME` varchar(1000) NOT NULL,
  `DEFAULT_FILE` varchar(1000) NOT NULL,
  `DESCRIPTION` varchar(2400) NOT NULL,
  `ORDER_NO` int(10) NOT NULL,
  PRIMARY KEY (`SUB_MODULE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `s_user`
--

CREATE TABLE IF NOT EXISTS `s_user` (
  `USER_ID` int(20) NOT NULL AUTO_INCREMENT,
  `POSITION_ID` int(20) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `psId` int(11) NOT NULL,
  `USER_STATUS` varchar(100) NOT NULL,
  `aId` int(11) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `s_user`
--

INSERT INTO `s_user` (`USER_ID`, `POSITION_ID`, `USER_NAME`, `EMAIL`, `psId`, `USER_STATUS`, `aId`) VALUES
(1, 1, 'admin', 'euitsols.suprt@gmail.com', 1, 'active', 2),
(18, 4, 'PEDPIII_user1', 'PEDPIII_user1@gmail.com', 2, 'active', 2),
(19, 7, 'ADB_user', 'test@gmail.com', 3, 'active', 4),
(20, 4, 'FNA', 'fna@gmail.com', 0, 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `s_user_role`
--

CREATE TABLE IF NOT EXISTS `s_user_role` (
  `USER_ROLE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `ROLE_ID` int(20) NOT NULL,
  `USER_ID` int(20) NOT NULL,
  PRIMARY KEY (`USER_ROLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `s_user_role`
--

INSERT INTO `s_user_role` (`USER_ROLE_ID`, `ROLE_ID`, `USER_ID`) VALUES
(1, 1, 1),
(27, 20, 18),
(28, 19, 19),
(29, 1, 20);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
