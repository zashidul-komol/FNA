-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2014 at 10:44 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adbdb`
--
CREATE DATABASE IF NOT EXISTS `adbdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `adbdb`;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_agency`
--

CREATE TABLE IF NOT EXISTS `adbs_agency` (
  `aId` int(11) NOT NULL AUTO_INCREMENT,
  `aFName` varchar(200) NOT NULL,
  `aSName` varchar(200) NOT NULL,
  `aPhone` varchar(50) NOT NULL,
  `aEmail` varchar(200) NOT NULL,
  `aAddress` varchar(200) NOT NULL,
  `aDescription` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`aId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adbs_agency`
--

INSERT INTO `adbs_agency` (`aId`, `aFName`, `aSName`, `aPhone`, `aEmail`, `aAddress`, `aDescription`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(2, 'National Curriculum and Textbook Board', 'NCTB', '123457657', 'nctb@gmail.com', ' Dhaka', 'National Curriculum and Textbook Board', 'Active', '2014-07-20', '19:11:58 PM', 3),
(3, 'Third Primary Education Development Program PEDP , III', 'PEDP', '01737880714', 'faizulrng@gmail.com', ' Dhaka, Bangladesh', 'faizulrng@gmail.com', 'Active', '2014-07-20', '19:22:16 PM', 3),
(4, 'Water Development Board', 'WDB', '87895667', 'fdfg@jk.vgh', ' kjlki', ' Water Development Board', 'Active', '2014-07-21', '18:47:47 PM', 1),
(5, 'Local Government Division ', 'LGD', '02-9776543', 'lgd@molgrd.gov.bd', ' Secretariat Building', ' Local Government Division (LGD)', 'Active', '2014-08-15', '06:30:21 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_agency_project_mapping`
--

CREATE TABLE IF NOT EXISTS `adbs_agency_project_mapping` (
  `apmId` int(11) NOT NULL AUTO_INCREMENT,
  `psId` int(11) NOT NULL,
  `aId` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`apmId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adbs_agency_project_mapping`
--

INSERT INTO `adbs_agency_project_mapping` (`apmId`, `psId`, `aId`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 2, 4, 'Active', '2014-09-01', '19:05:50 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_biddingdocumentpreparationstage`
--

CREATE TABLE IF NOT EXISTS `adbs_biddingdocumentpreparationstage` (
  `bdpsId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `bdps_29` date NOT NULL,
  `bdps_30` date NOT NULL,
  `bdps_31` date NOT NULL,
  `bdps_32` date NOT NULL,
  `bdps_33` date NOT NULL,
  `bdps_34` date NOT NULL,
  `bdps_35` date NOT NULL,
  `bdps_36` date NOT NULL,
  `bdps_37` date NOT NULL,
  `bdps_89` int(11) NOT NULL,
  `bdps_90` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bdpsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `adbs_biddingdocumentpreparationstage`
--

INSERT INTO `adbs_biddingdocumentpreparationstage` (`bdpsId`, `pId`, `bdps_29`, `bdps_30`, `bdps_31`, `bdps_32`, `bdps_33`, `bdps_34`, `bdps_35`, `bdps_36`, `bdps_37`, `bdps_89`, `bdps_90`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(12, 225, '2014-02-03', '2014-02-06', '2014-02-10', '2014-02-13', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 'Active', '2014-08-17', '08:28:50 AM', 3),
(13, 220, '2014-08-05', '2014-08-13', '2014-08-13', '2014-08-13', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 'Active', '2014-08-18', '11:15:07 AM', 3),
(14, 219, '2014-08-05', '2014-08-05', '2014-08-13', '2014-08-13', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 45, 54, 'active', '2014-09-11', '16:13:46 PM', 18),
(15, 221, '2014-08-05', '2014-08-13', '2014-08-06', '2014-08-21', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 5662, 7772, 'active', '2014-08-18', '12:29:38 PM', 3),
(16, 218, '2014-09-04', '2014-09-10', '2014-11-12', '2014-10-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 3, 4, 'active', '2014-09-11', '16:14:01 PM', 18),
(17, 226, '2014-08-23', '2014-08-24', '2014-08-25', '2014-08-26', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 43, 4343, 'active', '2014-08-18', '17:13:42 PM', 8),
(18, 222, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 'Active', '2014-09-02', '18:55:22 PM', 18),
(19, 224, '2014-09-23', '2014-09-30', '2014-09-16', '2014-09-23', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 115, 116, 'active', '2014-09-03', '13:44:40 PM', 18),
(20, 233, '2014-09-04', '2014-09-05', '2014-09-06', '2014-09-07', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 432, 4324, 'Active', '2014-09-03', '17:24:23 PM', 18),
(21, 238, '2014-09-01', '2014-09-01', '2014-09-22', '2014-09-23', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 34, 43, 'Active', '2014-09-06', '12:19:37 PM', 18),
(22, 239, '2014-09-10', '2014-09-16', '2014-09-17', '2014-09-16', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 435, 435, 'Active', '2014-09-11', '16:19:16 PM', 18),
(23, 240, '0000-00-00', '0000-00-00', '2014-09-04', '2014-09-09', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 'Active', '2014-09-11', '16:23:58 PM', 18),
(24, 242, '2014-09-04', '2014-09-02', '2014-09-03', '2014-09-04', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 'Active', '2014-09-13', '12:33:14 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_biddingdps_bkdn_note`
--

CREATE TABLE IF NOT EXISTS `adbs_biddingdps_bkdn_note` (
  `bdpsbntId` int(11) NOT NULL AUTO_INCREMENT,
  `bdpsId` int(11) NOT NULL,
  `clarificationDateByADB` date NOT NULL,
  `responseDateByADB` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bdpsbntId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_biddingprocedure`
--

CREATE TABLE IF NOT EXISTS `adbs_biddingprocedure` (
  `bpId` int(11) NOT NULL AUTO_INCREMENT,
  `bpName` varchar(250) NOT NULL,
  `bpDescription` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bpId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `adbs_biddingprocedure`
--

INSERT INTO `adbs_biddingprocedure` (`bpId`, `bpName`, `bpDescription`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, '1S1E', 'Single Stage One Envelope', 'Active', '2014-07-08', '13:57:02 PM', 1),
(2, '1S2E', 'Single Stage Two Envelope ', 'Active', '2014-07-08', '13:58:31 PM', 1),
(3, '2S', 'Two Stage ', 'Active', '2014-07-08', '16:06:10 PM', 1),
(4, '2S2E', 'Two Stage Two Envelope  ', 'Active', '2014-07-08', '16:06:25 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_biddingproposalstage`
--

CREATE TABLE IF NOT EXISTS `adbs_biddingproposalstage` (
  `bpsId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `bps_38` date NOT NULL,
  `bps_38a` date NOT NULL,
  `bps_39` date NOT NULL,
  `bps_40` date NOT NULL,
  `bps_41` date NOT NULL,
  `bps_42` date NOT NULL,
  `bps_43` date NOT NULL,
  `bps_44` date NOT NULL,
  `bps_45` date NOT NULL,
  `bps_46` date NOT NULL,
  `bps_47` date NOT NULL,
  `bps_48` date NOT NULL,
  `bps_49` date NOT NULL,
  `bps_84` int(11) NOT NULL,
  `bps_90` int(11) NOT NULL,
  `bps_91` int(11) NOT NULL,
  `bps_92` varchar(11) NOT NULL,
  `bps_102` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bpsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=351 ;

--
-- Dumping data for table `adbs_biddingproposalstage`
--

INSERT INTO `adbs_biddingproposalstage` (`bpsId`, `pId`, `bps_38`, `bps_38a`, `bps_39`, `bps_40`, `bps_41`, `bps_42`, `bps_43`, `bps_44`, `bps_45`, `bps_46`, `bps_47`, `bps_48`, `bps_49`, `bps_84`, `bps_90`, `bps_91`, `bps_92`, `bps_102`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(214, 218, '2014-05-15', '2014-08-06', '2014-08-13', '2014-08-21', '2014-08-07', '0000-00-00', '2014-08-14', '0000-00-00', '0000-00-00', '2014-08-21', '0000-00-00', '2014-08-28', '2014-09-12', 324, 443, 0, '', 0, 'active', '2014-09-12', '18:27:05 PM', 18),
(215, 219, '2014-07-15', '2014-09-30', '2014-09-16', '2014-09-15', '2014-09-30', '2014-09-15', '2014-09-23', '2014-09-09', '2014-09-16', '0000-00-00', '0000-00-00', '2014-09-30', '2014-09-17', 34453, 34, 0, '', 0, 'active', '2014-09-11', '16:36:37 PM', 18),
(216, 220, '2014-05-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'active', '2014-09-02', '18:55:53 PM', 18),
(217, 221, '2014-07-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'Active', '2014-08-15', '11:02:20 AM', 3),
(218, 222, '2015-07-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'Active', '2014-08-15', '11:02:20 AM', 3),
(219, 223, '2014-07-15', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'Active', '2014-08-15', '11:02:20 AM', 3),
(220, 224, '2014-09-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 6546, 0, 546, '334', 43443, 'active', '2014-09-03', '13:46:34 PM', 18),
(344, 225, '0000-00-00', '2014-02-20', '2014-02-23', '2014-02-24', '2014-02-25', '2014-02-26', '2014-02-27', '2014-03-03', '2014-03-06', '2014-03-10', '0000-00-00', '2014-03-13', '2014-03-17', 10, 2, 1, '120', 0, 'Active', '2014-08-17', '08:37:12 AM', 3),
(345, 233, '2014-09-12', '2014-09-13', '2014-09-14', '2014-09-15', '2014-09-16', '2014-09-17', '2014-09-18', '2014-09-19', '2014-09-20', '2014-09-21', '0000-00-00', '2014-09-22', '2014-09-23', 354, 543, 543, '43', 34, 'Active', '2014-09-03', '17:25:05 PM', 18),
(346, 238, '0000-00-00', '2014-09-01', '0000-00-00', '0000-00-00', '2014-09-22', '0000-00-00', '2014-09-16', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-03', '2014-09-02', 435, 435, 435, '43', 5345, 'Active', '2014-09-06', '12:22:31 PM', 18),
(347, 239, '2014-09-01', '2014-09-02', '2014-09-03', '2014-09-04', '2014-09-05', '2014-09-06', '2014-09-07', '2014-09-08', '2014-09-09', '2014-09-10', '0000-00-00', '2014-09-11', '2014-09-12', 5345, 5434, 0, '', 0, 'active', '2014-09-08', '11:21:20 AM', 18),
(348, 245, '0000-00-00', '2014-09-17', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'active', '2014-09-16', '13:55:26 PM', 18),
(349, 246, '0000-00-00', '2014-09-25', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'Active', '2014-09-15', '16:51:39 PM', 18),
(350, 247, '0000-00-00', '2014-09-24', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, '', 0, 'Active', '2014-09-16', '10:59:05 AM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_biddingproposalstage_bkdn`
--

CREATE TABLE IF NOT EXISTS `adbs_biddingproposalstage_bkdn` (
  `bpsbId` int(11) NOT NULL AUTO_INCREMENT,
  `bpsId` int(11) NOT NULL,
  `newsPaperName` varchar(250) NOT NULL,
  `publishDate` date NOT NULL,
  `newsPaperLanguage` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bpsbId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_bidproposalevaluationstage`
--

CREATE TABLE IF NOT EXISTS `adbs_bidproposalevaluationstage` (
  `bpesId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `bpes_50` date NOT NULL,
  `bpes_51` date NOT NULL,
  `bpes_52` date NOT NULL,
  `bpes_53` date NOT NULL,
  `bpes_54` date NOT NULL,
  `bpes_54a` date NOT NULL,
  `bpes_55` date NOT NULL,
  `bpes_56` date NOT NULL,
  `bpes_85` int(11) NOT NULL,
  `bpes_86` int(11) NOT NULL,
  `bpes_87` varchar(50) NOT NULL,
  `bpes_93` varchar(11) NOT NULL,
  `bpes_94` int(11) NOT NULL,
  `bpes_97` double NOT NULL,
  `bpes_98` double NOT NULL,
  `bpes_100` varchar(50) NOT NULL,
  `bpes_101` int(11) NOT NULL,
  `bpes_102` varchar(50) NOT NULL,
  `bpes_103` text NOT NULL,
  `bpes_112` varchar(50) NOT NULL,
  `bpes_50a` date NOT NULL,
  `bpes_51a` date NOT NULL,
  `bpes_56a` int(11) NOT NULL,
  `bpes_95a` double NOT NULL,
  `bpes_104` varchar(500) NOT NULL,
  `bpes_113` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`bpesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `adbs_bidproposalevaluationstage`
--

INSERT INTO `adbs_bidproposalevaluationstage` (`bpesId`, `pId`, `bpes_50`, `bpes_51`, `bpes_52`, `bpes_53`, `bpes_54`, `bpes_54a`, `bpes_55`, `bpes_56`, `bpes_85`, `bpes_86`, `bpes_87`, `bpes_93`, `bpes_94`, `bpes_97`, `bpes_98`, `bpes_100`, `bpes_101`, `bpes_102`, `bpes_103`, `bpes_112`, `bpes_50a`, `bpes_51a`, `bpes_56a`, `bpes_95a`, `bpes_104`, `bpes_113`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(22, 225, '2014-03-20', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-03-19', '0000-00-00', '2014-04-10', 8, 5, 'Yes', '140', 1, 3456900, 45678900, 'Yes', 0, 'null', '', 'No', '0000-00-00', '0000-00-00', 0, 0, '', '', 'Active', '2014-08-17', '08:47:33 AM', 3),
(23, 218, '2014-09-10', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-08-20', '0000-00-00', '2014-08-28', 443, 4343, 'No', '344322', 434311, 543543, 543543, '', 0, '3434', 'No', '', '2014-09-03', '2014-09-04', 45345, 534534, 'test', 'Yes', 'active', '2014-09-12', '15:10:50 PM', 18),
(24, 219, '2014-09-17', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-24', '0000-00-00', '2014-09-30', 45, 43534, 'Yes', '5345', 5435, 45345, 435, '', 0, '543', 'No', '', '2014-09-11', '2014-09-18', 345, 53, '534', 'No', 'active', '2014-09-08', '13:42:59 PM', 18),
(25, 221, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', 353, 4534534, 5345, '', 0, 'null', ' ', '', '0000-00-00', '0000-00-00', 0, 0, '', '', 'active', '2014-09-03', '18:56:29 PM', 18),
(26, 220, '2014-09-03', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-11', '0000-00-00', '2014-09-18', 0, 0, 'No', '', 0, 0, 0, '', 0, 'null', '', '', '0000-00-00', '0000-00-00', 543, 0, '', '', 'active', '2014-09-10', '19:17:30 PM', 18),
(27, 233, '2014-09-25', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-26', '0000-00-00', '2014-09-27', 34, 43, 'No', '43', 43, 434, 5646, 'No', 0, 'null', ' test', 'Yes', '0000-00-00', '0000-00-00', 0, 0, '', '', 'Active', '2014-09-03', '17:26:00 PM', 18),
(28, 238, '2014-09-03', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-03', '0000-00-00', '2014-09-03', 0, 0, 'Yes', '534', 5345, 0, 0, '', 0, 'null', ' ', '', '0000-00-00', '0000-00-00', 0, 0, '', '', 'Active', '2014-09-06', '12:25:27 PM', 18),
(32, 241, '2014-09-09', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-12', '0000-00-00', '2014-09-13', 15, 16, 'Yes', '17', 18, 20, 21, 'No', 0, '22', 'Yes', '', '2014-09-10', '2014-09-11', 14, 19, ' 23', 'Yes', 'Active', '2014-09-08', '13:04:51 PM', 18),
(33, 239, '2014-09-02', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-05', '0000-00-00', '2014-09-06', 8, 9, 'Yes', '10', 11, 13, 14, '', 0, '15', 'Yes', '', '2014-09-03', '2014-09-04', 7, 12, '16', 'Yes', 'Active', '2014-09-08', '15:54:28 PM', 18),
(34, 245, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-18', '0000-00-00', '2014-09-10', 0, 0, '', '', 0, 0, 0, '', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0, '', '', 'active', '2014-09-16', '14:05:29 PM', 18),
(38, 247, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-27', '0000-00-00', '0000-00-00', 0, 0, '', '', 0, 0, 0, '', 0, '', '', '', '0000-00-00', '0000-00-00', 0, 0, '', '', 'Active', '2014-09-16', '10:59:05 AM', 18),
(39, 240, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', 0, 0, 0, '', 0, '', '', '', '0000-00-00', '2014-09-25', 0, 0, ' ', '', 'Active', '2014-09-16', '16:18:38 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_contractconcludingstage`
--

CREATE TABLE IF NOT EXISTS `adbs_contractconcludingstage` (
  `ccsId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `ccs_76` date NOT NULL,
  `ccs_77` date NOT NULL,
  `ccs_78` double NOT NULL,
  `ccs_79` double NOT NULL,
  `ccs_80` double NOT NULL,
  `ccs_110` int(11) NOT NULL,
  `ccs_111` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`ccsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `adbs_contractconcludingstage`
--

INSERT INTO `adbs_contractconcludingstage` (`ccsId`, `pId`, `ccs_76`, `ccs_77`, `ccs_78`, `ccs_79`, `ccs_80`, `ccs_110`, `ccs_111`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 218, '2014-08-07', '2014-08-08', 3434, 4343, 4334, 4343, 54, 'active', '2014-09-03', '19:25:21 PM', 18),
(2, 221, '0000-00-00', '0000-00-00', 546, 646, 66, 45, 54, 'Active', '2014-09-03', '16:43:40 PM', 18),
(3, 219, '2014-09-15', '2014-09-23', 345345, 345345, 34534, 5345345, 5345345, 'active', '2014-09-03', '19:26:12 PM', 18),
(4, 238, '2014-09-02', '2014-09-02', 0, 0, 0, 43, 4343, 'Active', '2014-09-06', '12:38:42 PM', 18),
(5, 239, '2014-09-02', '2014-09-17', 45, 435, 345, 543, 543, 'Active', '2014-09-06', '12:53:48 PM', 18),
(6, 241, '0000-00-00', '0000-00-00', 0, 4534, 543534, 0, 0, 'active', '2014-09-08', '19:10:49 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_contractconcludingstage_bkdn`
--

CREATE TABLE IF NOT EXISTS `adbs_contractconcludingstage_bkdn` (
  `ccsbId` int(11) NOT NULL AUTO_INCREMENT,
  `ccsId` int(11) NOT NULL,
  `billPayDate` date NOT NULL,
  `chequeDate` date NOT NULL,
  `billAmount` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`ccsbId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_contractingstage`
--

CREATE TABLE IF NOT EXISTS `adbs_contractingstage` (
  `csId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `cs_63a` date NOT NULL,
  `cs_64` date NOT NULL,
  `cs_65` date NOT NULL,
  `cs_66` date NOT NULL,
  `cs_67` date NOT NULL,
  `cs_67a` date NOT NULL,
  `cs_68` date NOT NULL,
  `cs_69` date NOT NULL,
  `cs_70` date NOT NULL,
  `cs_9` varchar(200) NOT NULL,
  `cs_11` double NOT NULL,
  `cs_72` date NOT NULL,
  `cs_104` varchar(50) NOT NULL,
  `cs_105` varchar(50) NOT NULL,
  `cs_106` varchar(50) NOT NULL,
  `cs_113` varchar(250) NOT NULL,
  `cs_114a` varchar(200) NOT NULL,
  `cs_72a` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`csId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=358 ;

--
-- Dumping data for table `adbs_contractingstage`
--

INSERT INTO `adbs_contractingstage` (`csId`, `pId`, `cs_63a`, `cs_64`, `cs_65`, `cs_66`, `cs_67`, `cs_67a`, `cs_68`, `cs_69`, `cs_70`, `cs_9`, `cs_11`, `cs_72`, `cs_104`, `cs_105`, `cs_106`, `cs_113`, `cs_114a`, `cs_72a`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(207, 218, '0000-00-00', '2014-09-25', '2014-09-30', '2014-09-23', '2014-10-21', '2014-09-23', '2014-09-24', '2014-09-24', '2014-08-09', '100000.00 BDT', 250000, '2014-10-28', 'Yes', 'No', 'No', 'Test', '435', '35', 'active', '2014-09-13', '13:51:06 PM', 18),
(208, 219, '0000-00-00', '2014-09-08', '2014-09-08', '2014-09-08', '2014-09-23', '2014-09-02', '2014-09-02', '2014-09-08', '2014-09-02', '0', 4343, '2014-09-17', 'No', 'No', 'No', 'test', '34534', '15', 'active', '2014-09-14', '15:52:35 PM', 18),
(209, 220, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-07-15', '0000-00-00', '0000-00-00', '0', 345, '1970-01-01', '', 'Yes', 'Yes', 'testwer', '', '', 'active', '2014-09-15', '19:01:33 PM', 18),
(210, 221, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 63242, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(211, 222, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2015-09-15', '0000-00-00', '0000-00-00', '0', 432, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(212, 223, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 4324, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(213, 224, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 4324, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(337, 225, '2014-05-26', '2014-05-21', '0000-00-00', '2014-05-22', '0000-00-00', '2014-05-26', '2014-05-28', '2014-05-27', '2014-05-29', '0', 8543200, '2014-12-30', 'No', 'yes', 'no', 'Ms shuibd computers', '', '', 'Active', '2014-08-17', '09:05:04 AM', 3),
(338, 226, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-07-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(339, 227, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(340, 228, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-07-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(341, 229, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(342, 230, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2015-09-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(343, 231, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(344, 232, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '0000-00-00', '0000-00-00', '0', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(345, 233, '2014-09-15', '2014-09-16', '2014-09-17', '2014-09-18', '2014-09-19', '2014-09-20', '2014-09-22', '2014-09-21', '2014-09-23', '3434', 4343, '2014-09-24', 'No', 'No', 'Yes', '3434', '', '', 'Active', '2014-09-03', '17:27:26 PM', 18),
(346, 236, '2014-09-10', '2014-09-16', '2014-09-09', '2014-09-17', '2014-09-23', '2014-09-25', '2014-09-28', '2014-09-26', '2014-09-29', '100000', 250000, '2014-09-30', 'Yes', 'No', 'No', 'test', '', '', 'Active', '2014-09-04', '17:05:17 PM', 18),
(347, 238, '2014-09-01', '2014-09-09', '2014-09-17', '2014-09-10', '2014-09-30', '2014-09-29', '2014-09-15', '2014-09-01', '2014-09-15', '0', 0, '2014-09-09', 'No', 'Yes', 'Yes', '', '', '', 'Active', '2014-09-06', '12:31:16 PM', 18),
(348, 239, '0000-00-00', '2014-09-04', '2014-09-05', '2014-09-06', '2014-09-17', '2014-09-24', '2014-09-10', '2014-09-09', '2014-09-11', '1', 2423423, '2014-10-07', 'Yes', 'Yes', 'Yes', '13', '14', '13', 'active', '2014-09-16', '13:13:14 PM', 18),
(349, 242, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-07-15', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, '0000-00-00', '', '', '', '', '', '', 'Active', '2014-09-10', '16:52:29 PM', 18),
(350, 240, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-09', '2014-09-08', '2014-09-09', '0000-00-00', '', 0, '2014-09-21', '', '', '', '', '', '12', 'active', '2014-09-14', '15:53:28 PM', 18),
(351, 241, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 4324324324, '1970-01-01', '', '', '', '', '', '', 'Active', '2014-09-15', '14:30:19 PM', 18),
(352, 245, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-17', '2014-09-10', '0000-00-00', '0000-00-00', '', 4324234234, '2014-10-21', '', 'No', 'No', '', '', '34', 'active', '2014-09-16', '15:29:22 PM', 18),
(356, 246, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 54353453, '1970-01-01', '', 'Yes', 'Yes', '', '', '', 'Active', '2014-09-15', '17:51:51 PM', 18),
(357, 247, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-30', '0000-00-00', '0000-00-00', '0000-00-00', '', 0, '2014-09-29', '', '', '', '', '', '', 'Active', '2014-09-16', '10:59:05 AM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_contractmanagementstage`
--

CREATE TABLE IF NOT EXISTS `adbs_contractmanagementstage` (
  `cmsId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `cms_71` date NOT NULL,
  `cms_72a` date NOT NULL,
  `cms_73` date NOT NULL,
  `cms_74` date NOT NULL,
  `cms_75` date NOT NULL,
  `cms_107` int(11) NOT NULL,
  `cms_108` int(11) NOT NULL,
  `cms_109` double NOT NULL,
  `cms_10` varchar(200) NOT NULL,
  `cms_12` double NOT NULL,
  `cms_75a` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`cmsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=224 ;

--
-- Dumping data for table `adbs_contractmanagementstage`
--

INSERT INTO `adbs_contractmanagementstage` (`cmsId`, `pId`, `cms_71`, `cms_72a`, `cms_73`, `cms_74`, `cms_75`, `cms_107`, `cms_108`, `cms_109`, `cms_10`, `cms_12`, `cms_75a`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(205, 218, '2014-08-27', '0000-00-00', '2014-08-31', '2014-10-18', '2014-08-03', 3242, 0, 0, '4343.00 BDT', 434343, '2014-08-21', 'active', '2014-09-12', '16:25:22 PM', 18),
(206, 219, '2014-09-02', '0000-00-00', '2014-09-18', '2014-09-09', '2014-09-15', 34534, 0, 0, '5435', 5345, '2014-09-23', 'active', '2014-09-15', '14:05:17 PM', 18),
(207, 220, '0000-00-00', '0000-00-00', '0000-00-00', '2014-10-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-15', '11:02:20 AM', 3),
(208, 221, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-15', '11:02:20 AM', 3),
(209, 222, '0000-00-00', '0000-00-00', '0000-00-00', '2014-12-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-15', '11:02:20 AM', 3),
(210, 223, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-15', '11:02:20 AM', 3),
(211, 224, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-15', '11:02:20 AM', 3),
(212, 226, '0000-00-00', '0000-00-00', '0000-00-00', '2014-10-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(213, 227, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(214, 228, '0000-00-00', '0000-00-00', '0000-00-00', '2014-10-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(215, 229, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(216, 230, '0000-00-00', '0000-00-00', '0000-00-00', '2014-12-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(217, 231, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(218, 232, '0000-00-00', '0000-00-00', '0000-00-00', '2014-11-15', '0000-00-00', 0, 0, 0, '0', 0, '0000-00-00', 'Active', '2014-08-18', '16:44:19 PM', 8),
(219, 233, '2014-09-25', '0000-00-00', '2014-09-26', '2014-09-27', '2014-09-28', 34534, 534, 345345, '4556', 4564, '0000-00-00', 'Active', '2014-09-03', '17:28:02 PM', 18),
(220, 238, '2014-09-24', '0000-00-00', '2014-09-09', '2014-09-09', '2014-09-02', 45, 45, 543, '453', 543543, '0000-00-00', 'Active', '2014-09-06', '12:33:16 PM', 18),
(221, 241, '2014-09-03', '0000-00-00', '2014-09-04', '2014-09-05', '2014-09-06', 8, 0, 0, '1', 2, '2014-09-07', 'active', '2014-09-08', '18:29:03 PM', 18),
(222, 240, '2014-09-03', '0000-00-00', '2014-09-04', '2014-09-05', '2014-09-06', 8, 0, 0, '1', 2, '2014-09-07', 'Active', '2014-09-08', '18:29:30 PM', 18),
(223, 242, '0000-00-00', '0000-00-00', '0000-00-00', '2014-10-15', '0000-00-00', 0, 0, 0, '', 0, '0000-00-00', 'Active', '2014-09-10', '16:52:29 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_contractmanagementstage_bkdn`
--

CREATE TABLE IF NOT EXISTS `adbs_contractmanagementstage_bkdn` (
  `cmsbId` int(11) NOT NULL AUTO_INCREMENT,
  `cmsId` int(11) NOT NULL,
  `numberOfVO` int(11) NOT NULL,
  `voAmount` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`cmsbId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_disbursementproject_child`
--

CREATE TABLE IF NOT EXISTS `adbs_disbursementproject_child` (
  `dpcId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `bpc_79h` varchar(100) NOT NULL,
  `bpc_79i` varchar(100) NOT NULL,
  `bpc_79j` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`dpcId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `adbs_disbursementproject_child`
--

INSERT INTO `adbs_disbursementproject_child` (`dpcId`, `pId`, `bpc_79h`, `bpc_79i`, `bpc_79j`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(37, 218, 'Q1', '2014', 8000, 'active', '2014-09-09', '16:30:08 PM', 18),
(38, 218, 'Q1', '2016', 4353, 'Active', '2014-09-03', '19:21:19 PM', 18),
(39, 219, 'Q2', '2014', 43534, 'Active', '2014-09-03', '19:21:37 PM', 18),
(40, 219, 'Q2', '2015', 43543, 'Active', '2014-09-03', '19:21:58 PM', 18),
(41, 236, 'Q1', '2014', 87, 'Active', '2014-09-04', '14:44:25 PM', 19),
(42, 236, 'Q2', '2015', 45345, 'Active', '2014-09-04', '16:50:35 PM', 19),
(43, 236, 'Q4', '2015', 4554, 'Active', '2014-09-04', '16:56:23 PM', 19),
(44, 220, 'Q1', '2014', 4000, 'Active', '2014-09-05', '19:14:18 PM', 18),
(45, 218, 'Q1', '2015', 5000, 'Active', '2014-09-06', '11:55:08 AM', 18),
(46, 238, 'Q1', '2014', 435435, 'Active', '2014-09-06', '12:37:08 PM', 18),
(47, 239, 'Q2', '2011', 30000, 'Active', '2014-09-07', '13:33:15 PM', 18),
(48, 240, 'Q1', '2011', 40000, 'Active', '2014-09-08', '18:30:59 PM', 18),
(49, 218, 'Q1', '2025', 4353, 'Active', '2014-09-09', '16:30:34 PM', 18),
(50, 218, 'Q1', '2012', 37690, 'active', '2014-09-11', '12:03:04 PM', 18),
(51, 218, 'Q2', '2012', 3254, 'Active', '2014-09-11', '12:03:35 PM', 18),
(52, 218, 'Q3', '2012', 5435, 'Active', '2014-09-11', '12:07:59 PM', 18),
(53, 218, 'Q4', '2012', 5435, 'Active', '2014-09-11', '12:08:25 PM', 18),
(54, 218, 'Q1', '2018', 435, 'Active', '2014-09-11', '12:08:40 PM', 18),
(55, 218, 'Q2', '2017', 3443, 'Active', '2014-09-11', '12:09:02 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_evaluationras_bkdn_note`
--

CREATE TABLE IF NOT EXISTS `adbs_evaluationras_bkdn_note` (
  `erasbntId` int(11) NOT NULL AUTO_INCREMENT,
  `erasId` int(11) NOT NULL,
  `clarificationDateByADB` date NOT NULL,
  `responseDateByADB` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`erasbntId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_evaluationreportapprovalstage`
--

CREATE TABLE IF NOT EXISTS `adbs_evaluationreportapprovalstage` (
  `erasId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `eras_57` date NOT NULL,
  `eras_58` date NOT NULL,
  `eras_59` date NOT NULL,
  `eras_60` date NOT NULL,
  `eras_60a` date NOT NULL,
  `eras_61` date NOT NULL,
  `eras_62` date NOT NULL,
  `eras_62a` date NOT NULL,
  `eras_63` date NOT NULL,
  `eras_95` varchar(50) NOT NULL,
  `eras_96` int(11) NOT NULL,
  `eras_99` varchar(50) NOT NULL,
  `eras_101` int(11) NOT NULL,
  `eras_62b` date NOT NULL,
  `eras_104` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`erasId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `adbs_evaluationreportapprovalstage`
--

INSERT INTO `adbs_evaluationreportapprovalstage` (`erasId`, `pId`, `eras_57`, `eras_58`, `eras_59`, `eras_60`, `eras_60a`, `eras_61`, `eras_62`, `eras_62a`, `eras_63`, `eras_95`, `eras_96`, `eras_99`, `eras_101`, `eras_62b`, `eras_104`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(23, 225, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-04-15', '2014-04-16', '2014-04-17', '2014-04-22', '0000-00-00', '2', 2, 'No', 0, '0000-00-00', '', 'Active', '2014-08-17', '08:56:21 AM', 3),
(24, 218, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-08-14', '2014-08-15', '2014-08-16', '2014-08-17', '2014-08-18', '43433', 343444, '', 3434534, '2014-09-05', '', 'active', '2014-09-13', '11:04:43 AM', 18),
(25, 233, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-15', '2014-09-17', '2014-09-09', '2014-09-09', '2014-09-02', '4354', 3434, 'No', 3434, '0000-00-00', '', 'active', '2014-09-03', '17:26:32 PM', 18),
(30, 239, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-02', '2014-09-03', '2014-09-04', '2014-09-05', '2014-09-07', '8', 9, '', 10, '2014-09-06', '11', 'active', '2014-09-08', '16:00:01 PM', 18),
(31, 220, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-09', '0000-00-00', '0000-00-00', '2014-09-10', '2014-09-12', '13', 14, '', 15, '2014-09-11', '16', 'Active', '2014-09-13', '11:05:26 AM', 18),
(32, 219, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-02', '2014-09-03', '2014-09-04', '2014-09-05', '2014-09-07', '8', 9, '', 10, '2014-09-06', '11', 'Active', '2014-09-14', '17:00:05 PM', 18),
(34, 245, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-19', '0000-00-00', '0000-00-00', '2014-09-20', '0000-00-00', '', 0, '', 0, '0000-00-00', '', 'Active', '2014-09-15', '16:32:54 PM', 18),
(36, 246, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-27', '0000-00-00', '0000-00-00', '2014-09-28', '0000-00-00', '', 0, '', 0, '0000-00-00', '', 'Active', '2014-09-15', '16:51:39 PM', 18),
(37, 247, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '2014-09-22', '0000-00-00', '0000-00-00', '2014-09-30', '0000-00-00', '', 0, '', 0, '0000-00-00', '', 'Active', '2014-09-16', '10:59:05 AM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_inputtabfields`
--

CREATE TABLE IF NOT EXISTS `adbs_inputtabfields` (
  `itfId` int(11) NOT NULL AUTO_INCREMENT,
  `itfhId` int(11) NOT NULL,
  `itfName` varchar(250) NOT NULL,
  `itfNature` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`itfId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adbs_inputtabfields`
--

INSERT INTO `adbs_inputtabfields` (`itfId`, `itfhId`, `itfName`, `itfNature`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 1, 'Loan/Grant No', 'text', 'Active', '2014-07-09', '10:37:24 AM', 1),
(2, 3, 'Date of DBD sent to ADB (1S1E,1S2E,1S of 2S & 2S2E))', 'text', 'Active', '2014-07-09', '16:47:44 PM', 1),
(3, 1, 'EA Name', 'text', 'Active', '2014-07-11', '15:49:51 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_inputtabhead`
--

CREATE TABLE IF NOT EXISTS `adbs_inputtabhead` (
  `ithId` int(11) NOT NULL AUTO_INCREMENT,
  `ithName` varchar(250) NOT NULL,
  `ithDescription` text NOT NULL,
  `prefix` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`ithId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `adbs_inputtabhead`
--

INSERT INTO `adbs_inputtabhead` (`ithId`, `ithName`, `ithDescription`, `prefix`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 'Package Information', ' This is a tab head name', 'pi', 'Active', '2014-07-08', '16:30:18 PM', 1),
(2, 'PQ Stage', 'This is a tab head name', 'pqs', 'Active', '2014-07-08', '19:37:02 PM', 1),
(3, 'Bidding Document Preparation Stage', ' This is tab head name', 'bdps', 'Active', '2014-07-09', '16:46:08 PM', 1),
(4, 'Bidding/Propasal Stage', ' test', 'bps', 'Active', '2014-07-09', '16:57:28 PM', 1),
(5, 'Bid/ Proposal Evaluation Stage', 'This is a tab head name', 'bpes', 'Active', '2014-07-10', '16:08:18 PM', 1),
(6, 'Evaluation Report Approval Stage', 'This is a tab head name', 'eras', 'Active', '2014-07-10', '16:08:56 PM', 1),
(7, 'Contracting Stage', 'This is a tab head name ', 'cs', 'Active', '2014-07-10', '16:09:29 PM', 1),
(8, 'Contract Management Stage', 'This is a tab head name ', 'cms', 'Active', '2014-07-10', '16:09:57 PM', 1),
(9, 'Contract Concluding Stage ', 'This is a tab head name', 'ccs', 'Active', '2014-07-10', '16:10:19 PM', 1),
(10, 'Others Information ', 'This is a tab head name', 'oi', 'Active', '2014-07-10', '16:10:39 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_othersinformation`
--

CREATE TABLE IF NOT EXISTS `adbs_othersinformation` (
  `oiId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `oi_114` text NOT NULL,
  `oi_120` double NOT NULL,
  `oi_121` text NOT NULL,
  `oi_111` int(11) NOT NULL,
  `oi_112` int(11) NOT NULL,
  `oi_118` varchar(300) NOT NULL,
  `oi_119` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`oiId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `adbs_othersinformation`
--

INSERT INTO `adbs_othersinformation` (`oiId`, `pId`, `oi_114`, `oi_120`, `oi_121`, `oi_111`, `oi_112`, `oi_118`, `oi_119`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 218, '34534', 0, 'null', 5435, 345345, '', '', 'active', '2014-09-13', '17:03:43 PM', 18),
(2, 219, 'No remarks', 0, 'null', 0, 0, 'No', 'Yes', 'active', '2014-09-16', '17:26:39 PM', 18),
(3, 224, 'test', 0, 'Nulll', 0, 0, '', '', 'Active', '2014-09-02', '18:42:26 PM', 18),
(4, 233, 'test', 0, 'Nulll', 0, 0, '', '', 'Active', '2014-09-03', '17:38:15 PM', 18),
(5, 220, 'test3', 0, 'null', 0, 0, '', '', 'active', '2014-09-03', '17:59:44 PM', 18),
(6, 238, 'test', 0, 'Nulll', 0, 0, '', '', 'Active', '2014-09-06', '12:40:13 PM', 18),
(7, 240, '44', 0, 'null', 22, 33, '', '', 'active', '2014-09-08', '18:07:34 PM', 18),
(8, 247, '3', 0, 'Nulll', 1, 2, 'No', 'Yes', 'Active', '2014-09-16', '17:16:21 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_package`
--

CREATE TABLE IF NOT EXISTS `adbs_package` (
  `pId` int(11) NOT NULL AUTO_INCREMENT,
  `ptId` int(11) NOT NULL,
  `pmId` int(11) NOT NULL,
  `bpId` int(11) NOT NULL,
  `pName` varchar(200) NOT NULL,
  `agency` int(11) NOT NULL,
  `agencyName` varchar(200) NOT NULL,
  `psId` int(11) NOT NULL,
  `adbPackageName` varchar(200) NOT NULL,
  `pi_4` varchar(250) NOT NULL,
  `pi_5` varchar(250) NOT NULL,
  `pi_6` varchar(250) NOT NULL,
  `pi_7` varchar(250) NOT NULL,
  `pi_7a` varchar(250) NOT NULL,
  `pi_7b` varchar(250) NOT NULL,
  `pi_7c` varchar(250) NOT NULL,
  `pi_7d` double NOT NULL,
  `pi_8` double NOT NULL,
  `pi_13` varchar(200) NOT NULL,
  `pi_14` varchar(200) NOT NULL,
  `pi_15` varchar(200) NOT NULL,
  `pi_16` varchar(20) NOT NULL,
  `pi_17` varchar(20) NOT NULL,
  `pi_18` varchar(20) NOT NULL,
  `pi_19` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;

--
-- Dumping data for table `adbs_package`
--

INSERT INTO `adbs_package` (`pId`, `ptId`, `pmId`, `bpId`, `pName`, `agency`, `agencyName`, `psId`, `adbPackageName`, `pi_4`, `pi_5`, `pi_6`, `pi_7`, `pi_7a`, `pi_7b`, `pi_7c`, `pi_7d`, `pi_8`, `pi_13`, `pi_14`, `pi_15`, `pi_16`, `pi_17`, `pi_18`, `pi_19`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(218, 1, 1, 1, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-01', '55456135435', 'CTIIP/G-01: Procurement of furniture, air-coolers etc. for project offices (PMU, PIUs).', 'Test123', 'sets', '171', 'ADB & GOB', 3443, 434343, 'Goods ', 'ICB', '1S1E', 'ADB', 'PD, CTIIP', 'No', 'No', 'active', '2014-09-11', '14:22:08 PM', 18),
(219, 1, 2, 1, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-02', '65465', 'CTIIP/G-02: Procurement of office equipment; such as: Laptops, Desktop Computers with Printers, Scanners, UPS & other accessories, Multimedia Projectors, Photocopier Machines, Fax Machines etc. for PMU & PIUs ', 'tdfsdfasdfs', 'sets', '34', '-do-', 0, 0, 'Goods ', 'LCB', '1S1E', 'ADB', 'PD, CTIIP', 'Yes', 'Yes', 'active', '2014-09-03', '18:12:21 PM', 18),
(220, 1, 0, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-03', '2972', 'CTIIP/G-03: Procurement of cross country vehicles - twin cabin pick-ups for field inspection (2500+/- c.c., dual AC, all auto etc.)', 'test4', 'Nos.', '14', '-do-', 35345, 4353453, 'Goods ', '', '', '', 'PD, CTIIP', 'No', 'Yes', 'active', '2014-09-13', '11:04:09 AM', 18),
(221, 1, 3, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-04', '', 'CTIIP/G-04: Procurement of four stroke motor cycles for field officials (100+/- c.c.).', '', 'Nos.', '17', '-do-', 0, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(222, 1, 0, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-05', '', 'CTIIP/G-05: Procurement of (a) truck mounted desludging equipment, (b) drainage maintenance equipment, (c) Push cart / hand trolley, rickshaw van for SWM etc. for batch-1 target towns.', '', 'sets', '6', '-do-', 0, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(223, 2, 0, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-06', '', 'CTIIP/G-06: Procurement of (a) equipment, spare parts & chemicals for four costal zonal laboratories of DPHE (Khulna, Barisal, Noakhali & Gopalgonj) - 4 sets; and\n(b) water quality testing kits including setting up of field laboratories in batch-1 po', '', 'sets', '4', '-do-', 0, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(224, 3, 0, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-07', '', 'CTIIP/G-07: Procurement of Tools & equipment for supervision / monitoring / quality control - 6 sets', '', 'sets', '6', '-do-', 0, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-15', '11:02:20 AM', 3),
(225, 1, 1, 1, 'Goods  with PR, ICB, 1S1E, without PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'PEDPIII/DPE/G050', '01', 'Procurement of Computers and Accessories', 'Procurement of Computers, Laptops, Printers, Scanners, Photocopiers and others ', 'No ', '100', 'ADB and GOB', 80000000, 1000000, 'Goods ', 'ICB', '1S1E', 'ADB', 'HOPE', 'Yes', 'No', 'Active', '2014-08-16', '16:19:04 PM', 3),
(226, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-01', '', 'CTIIP/G-01: Procurement of furniture, air-coolers etc. for project offices (PMU, PIUs).', '', 'sets', '17', 'ADB & GOB', 4300000, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(227, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-02', '', 'CTIIP/G-02: Procurement of office equipment; such as: Laptops, Desktop Computers with Printers, Scanners, UPS & other accessories, Multimedia Projectors, Photocopier Machines, Fax Machines etc. for PMU & PIUs ', '', 'sets', '34', '-do-', 5400000, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(228, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-03', '', 'CTIIP/G-03: Procurement of cross country vehicles - twin cabin pick-ups for field inspection (2500+/- c.c., dual AC, all auto etc.)', '', 'Nos.', '14', '-do-', 63400000, 0, 'NCB', '', '', '', 'CE, LGED', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(229, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-04', '', 'CTIIP/G-04: Procurement of four stroke motor cycles for field officials (100+/- c.c.).', '', 'Nos.', '17', '-do-', 63400000, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(230, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-05', '', 'CTIIP/G-05: Procurement of (a) truck mounted desludging equipment, (b) drainage maintenance equipment, (c) Push cart / hand trolley, rickshaw van for SWM etc. for batch-1 target towns.', '', 'sets', '6', '-do-', 64300000, 0, 'NCB', '', '', '', 'CE, LGED', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(231, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-06', '', 'CTIIP/G-06: Procurement of (a) equipment, spare parts & chemicals for four costal zonal laboratories of DPHE (Khulna, Barisal, Noakhali & Gopalgonj) - 4 sets; and\n(b) water quality testing kits including setting up of field laboratories in batch-1 po', '', 'sets', '4', '-do-', 64300000, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(232, 1, 0, 0, '', 0, '', 5, 'City Region Development Project (CRDP)', 'G-07', '', 'CTIIP/G-07: Procurement of Tools & equipment for supervision / monitoring / quality control - 6 sets', '', 'sets', '6', '-do-', 400000, 0, 'NCB', '', '', '', 'PD, CTIIP', '', '', 'Active', '2014-08-18', '16:44:19 PM', 8),
(233, 1, 2, 1, 'Goods  with PR, LCB, 1S1E, PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '', '', '', ' ', '', '', '', 0, 0, 'Goods ', 'LCB', '1S1E', 'ADB', 'PD', 'Yes', 'Yes', 'Active', '2014-08-23', '09:09:22 AM', 3),
(234, 1, 2, 2, 'Goods  with PR, LCB, 1S2E, PQ, environment effectiveness project', 0, '', 3, 'environment effectiveness project', 'G-004', '5345', 'Test', ' Test', '24', '432', 'Test', 432423, 432432, 'Goods ', 'LCB', '1S2E', 'ADB', 'HOPE', 'Yes', 'Yes', 'Active', '2014-09-01', '12:19:02 PM', 17),
(235, 1, 2, 2, 'Goods  with PR, LCB, 1S2E, without PQ, environment effectiveness project', 0, '', 3, 'environment effectiveness project', 'G-005', '434', 'Test', ' Test', '3443', '4343', 'Test', 3443, 43443, 'Goods ', 'LCB', '1S2E', 'ADB', 'MI', 'Yes', 'No', 'Active', '2014-09-01', '12:21:32 PM', 17),
(236, 1, 2, 2, 'Goods  without PR, LCB, 1S2E, without PQ, environment effectiveness project', 0, '', 3, 'environment effectiveness project', '345', '435', 'test', 'test', '435', '35', '4543', 4535, 3453443, 'Goods ', 'LCB', '1S2E', 'ADB', 'PD', 'No', 'No', 'Active', '2014-09-04', '11:30:47 AM', 19),
(237, 1, 1, 2, 'Goods  with PR, ICB, 1S2E, PQ, environment effectiveness project', 0, '', 3, 'environment effectiveness project', '', '', '', ' ', '', '', '', 0, 0, 'Goods ', 'ICB', '1S2E', '', '', 'Yes', 'Yes', 'Active', '2014-09-04', '14:25:06 PM', 19),
(238, 1, 2, 1, 'Goods  without PR, LCB, 1S1E, PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '400', '400', 'test', ' test', '453', '433', '6345', 345345, 45345, 'Goods ', 'LCB', '1S1E', 'GOB', 'HOPE', 'No', 'Yes', 'Active', '2014-09-06', '10:38:53 AM', 18),
(239, 1, 1, 1, 'Goods  with PR, ICB, 1S1E, PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '4543', '5435', 'test', ' ', '', '', '', 0, 0, 'Goods ', 'ICB', '1S1E', '', '', 'Yes', 'Yes', 'Active', '2014-09-06', '12:40:59 PM', 18),
(240, 1, 3, 3, 'Goods  with PR, NCB, 2S, PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '11', '22', '33', ' 44', '', '', '', 0, 0, 'Goods ', 'NCB', '2S', '', '', 'No', 'Yes', 'active', '2014-09-11', '16:23:35 PM', 18),
(241, 1, 5, 4, 'Goods  with PR, DC, 2S2E, PQ, Third Primary Education Development Program PEDP, III', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '1', '2', '3', ' 4', '5', '6', '7', 8, 9, 'Goods ', 'DC', '2S2E', 'ADB', 'PD', 'Yes', 'Yes', 'Active', '2014-09-08', '07:39:32 AM', 18),
(242, 1, 0, 0, '', 0, '', 2, 'Third Primary Education Development Program PEDP, III', 'G-01', '234', 'CTIIP/G-01: Procurement of furniture, air-coolers etc. for project offices (PMU, PIUs).', '', 'sets', '17', 'ADB & GOB', 0, 0, 'Goods ', '', '', '', 'PD, CTIIP', 'No', 'No', 'active', '2014-09-16', '16:58:58 PM', 18),
(243, 1, 1, 1, 'Goods  with PR, ICB, 1S1E, PQ, ,  435', 0, '', 0, '', '435', '', '', ' ', '', '', '', 0, 0, 'Goods ', 'ICB', '1S1E', '', '', 'Yes', 'Yes', 'Active', '2014-09-14', '15:59:08 PM', 18),
(244, 1, 1, 1, 'Goods  with PR, ICB, 1S1E, without PQ, ,  3423', 0, '', 0, '', '3423', '4324', '234', ' 234234', '423', '4234', '4234', 234234, 23432, 'Goods ', 'ICB', '1S1E', 'ADB', 'PD', 'Yes', 'No', 'Active', '2014-09-15', '15:07:10 PM', 18),
(245, 1, 1, 1, 'Goods  with PR, ICB, 1S1E, PQ, Third Primary Education Development Program PEDP, III,  1', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '1', '2', '3', ' 4', '5', '6', '9', 7, 8, 'Goods ', 'ICB', '1S1E', 'ADB', 'PD', 'Yes', 'Yes', 'Active', '2014-09-15', '16:19:45 PM', 18),
(246, 1, 1, 2, 'Goods  without PR, ICB, 1S2E, PQ, Third Primary Education Development Program PEDP, III,  11', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '11', '22', '33', ' 4', '5', '6', '9', 7, 8, 'Goods ', 'ICB', '1S2E', 'GOB', 'MINS', 'No', 'Yes', 'Active', '2014-09-15', '16:51:19 PM', 18),
(247, 1, 2, 2, 'Goods  with PR, LCB, 1S2E, PQ, Third Primary Education Development Program PEDP, III,  543', 0, '', 2, 'Third Primary Education Development Program PEDP, III', '543', '5345', '34', ' ', '', '', '', 0, 0, 'Goods ', 'LCB', '1S2E', '', '', 'Yes', 'Yes', 'Active', '2014-09-16', '10:58:50 AM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_packagefields`
--

CREATE TABLE IF NOT EXISTS `adbs_packagefields` (
  `pfId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `ithId` int(11) NOT NULL,
  `itfId` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_package_lot`
--

CREATE TABLE IF NOT EXISTS `adbs_package_lot` (
  `plId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `pi_8` double NOT NULL,
  `cs_96` double NOT NULL,
  `cms_110` double NOT NULL,
  `cs_97` double NOT NULL,
  `cms_111` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`plId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_paymentstage`
--

CREATE TABLE IF NOT EXISTS `adbs_paymentstage` (
  `psId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `ps_76` double NOT NULL,
  `ps_76Taka` double NOT NULL,
  `ps_77` int(11) NOT NULL,
  `ps_78` double NOT NULL,
  `ps_78a` varchar(200) NOT NULL,
  `ps_79` double NOT NULL,
  `ps_TotalLatePayment` double NOT NULL,
  `ps_TotalDamgePayment` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(100) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`psId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `adbs_paymentstage`
--

INSERT INTO `adbs_paymentstage` (`psId`, `pId`, `ps_76`, `ps_76Taka`, `ps_77`, `ps_78`, `ps_78a`, `ps_79`, `ps_TotalLatePayment`, `ps_TotalDamgePayment`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(22, 218, 451949, 39771512, 4, -447606, '', 0, 935, 845, 'active', '2014-09-03', '19:16:34 PM', 18),
(23, 224, 435435, 38318280, 1, -431111, '', 0, 4343, 4343, 'Active', '2014-09-03', '16:55:24 PM', 18),
(24, 233, 5745, 505560, 1, -1402, '', 0, 600, 200, 'Active', '2014-09-03', '17:28:44 PM', 18),
(25, 219, 474158, 41725904, 2, -469815, '', 0, 435780, 690, 'active', '2014-09-03', '19:17:22 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_paymentstage_bkdn`
--

CREATE TABLE IF NOT EXISTS `adbs_paymentstage_bkdn` (
  `psbkdnId` int(11) NOT NULL AUTO_INCREMENT,
  `psId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `psbkdn_1` date NOT NULL,
  `psbkdn_2` double NOT NULL,
  `psbkdn_2a` varchar(200) NOT NULL,
  `psbkdn_2b` double NOT NULL,
  `psbkdn_78b` varchar(200) NOT NULL,
  `psbkdn_3` int(11) NOT NULL,
  `psbkdn_4` date NOT NULL,
  `psbkdn_5` date NOT NULL,
  `psbkdn_6` date NOT NULL,
  `psbkdn_7` varchar(100) NOT NULL,
  `psbkdn_8` double NOT NULL,
  `psbkdn_9` double NOT NULL,
  `psbkdn_10` double NOT NULL,
  `psbkdn_12` double NOT NULL,
  `net_payment` double NOT NULL,
  `a_p_Adjustment` double NOT NULL,
  `psbkdn_QuaterNo` varchar(50) NOT NULL,
  `psbkdn_Year` varchar(50) NOT NULL,
  `psbkdn_Actual` double NOT NULL,
  `psbkdn_flag` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(100) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`psbkdnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `adbs_paymentstage_bkdn`
--

INSERT INTO `adbs_paymentstage_bkdn` (`psbkdnId`, `psId`, `pId`, `psbkdn_1`, `psbkdn_2`, `psbkdn_2a`, `psbkdn_2b`, `psbkdn_78b`, `psbkdn_3`, `psbkdn_4`, `psbkdn_5`, `psbkdn_6`, `psbkdn_7`, `psbkdn_8`, `psbkdn_9`, `psbkdn_10`, `psbkdn_12`, `net_payment`, `a_p_Adjustment`, `psbkdn_QuaterNo`, `psbkdn_Year`, `psbkdn_Actual`, `psbkdn_flag`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(100, 0, 218, '2014-09-09', 50000, '', 0, '', 1, '2014-09-02', '2014-09-04', '0000-00-00', '5435.00', 0, 34234, 42342, 47000, 38892, 3000, 'Q1', '2014', 88892, 1, 'Active', '2014-09-09', '14:33:35 PM', 18),
(101, 0, 218, '0000-00-00', 0, '', 0, '', 2, '2014-09-03', '2014-09-10', '2014-05-14', '35', 71000, 2000, 1000, 45000, 20000, 2000, 'Q2', '2014', 22000, 2, 'Active', '2014-09-08', '08:52:32 AM', 18),
(102, 0, 218, '0000-00-00', 0, '', 0, '', 3, '2014-09-17', '2014-09-25', '2014-09-24', '435', 130000, 0, 0, 40000, 53000, 5000, 'Q3', '2014', 58000, 3, 'Active', '2014-09-08', '08:53:18 AM', 18),
(103, 0, 218, '0000-00-00', 0, '', 0, '', 4, '2014-09-09', '2014-09-10', '2015-01-22', '4534', 198000, 2000, 4000, 37000, 63000, 3000, 'Q1', '2015', 66000, 4, 'Active', '2014-09-08', '08:54:15 AM', 18),
(104, 0, 238, '2014-09-09', 34443, '', 0, '', 1, '2014-09-10', '2014-09-03', '2014-09-10', '34', 4343, 4336536, 5645, 6456, 4307247, 27987, 'Q3', '2014', 4341690, 1, 'Active', '2014-09-08', '09:01:09 AM', 18),
(105, 0, 240, '2014-09-02', 50000, '', 0, '', 1, '2014-09-10', '2014-09-10', '2014-02-20', '4534', 50000, 0, 0, 47000, 47000, 3000, 'Q1', '2014', 97000, 1, 'Active', '2014-09-08', '18:30:34 PM', 18),
(106, 0, 240, '0000-00-00', 0, '', 0, '', 2, '2014-09-09', '2014-09-11', '2014-05-21', '34534', 71000, 2000, 1000, 45000, 20000, 2000, 'Q2', '2014', 22000, 2, 'Active', '2014-09-08', '18:31:31 PM', 18),
(107, 0, 240, '0000-00-00', 0, '', 0, '', 3, '2014-09-10', '2014-09-03', '2014-05-07', '34543', 43, 435, 345, 45, -116822, 44955, 'Q2', '2014', -71867, 3, 'Active', '2014-09-08', '18:31:54 PM', 18),
(108, 0, 218, '0000-00-00', 0, '', 0, '', 5, '2014-09-17', '2014-09-16', '0000-00-00', '45', 34, 345, 34534, 534, -266621, 36466, 'Q1', '1970', -230155, 5, 'Active', '2014-09-10', '19:32:11 PM', 18),
(109, 0, 220, '2014-09-25', 435, '', 0, '', 1, '2014-09-10', '2014-09-03', '0000-00-00', '5435', 534, 543, 453, 543, 732, -108, 'Q1', '1970', 1167, 1, 'Active', '2014-09-11', '16:56:33 PM', 18),
(110, 0, 220, '0000-00-00', 0, '', 0, '', 2, '2014-09-10', '2014-09-10', '2014-09-16', '43', 43, 43, 43, 43, -1081, 500, 'Q3', '2014', -581, 2, 'Active', '2014-09-11', '17:04:35 PM', 18),
(111, 0, 220, '0000-00-00', 0, '', 0, '', 3, '2014-09-09', '2014-09-16', '2014-09-17', '534', 543, 435, 345, 435, 982, -392, 'Q3', '2014', 590, 3, 'Active', '2014-09-11', '17:09:51 PM', 18),
(112, 0, 218, '0000-00-00', 0, '', 0, '', 6, '0000-00-00', '0000-00-00', '0000-00-00', '', 4434343, 0, 0, 0, 4467964, 534, 'Q1', '1970', 4468498, 6, 'Active', '2014-09-12', '12:17:05 PM', 18),
(113, 0, 242, '2014-09-13', 6456456, '', 0, '', 1, '0000-00-00', '0000-00-00', '2014-09-24', '', 6456, 0, 65, 6, -6450059, 6456450, 'Q3', '2014', 6397, 1, 'Active', '2014-09-12', '12:36:15 PM', 18),
(114, 0, 218, '0000-00-00', 0, '', 0, '', 7, '0000-00-00', '0000-00-00', '2014-09-19', '435', 534, 345, 0, 0, -4433464, 0, 'Q3', '2014', -4433464, 7, 'Active', '2014-09-13', '15:52:35 PM', 18),
(115, 0, 241, '2014-09-18', 4324, '', 0, '', 1, '2014-09-10', '2014-09-12', '2014-09-18', '4324', 34324, 432, 432, 4324, 34324, 0, 'Q3', '2014', 38648, 1, 'Active', '2014-09-15', '14:30:52 PM', 18),
(116, 0, 245, '0000-00-00', 0, '', 0, '', 1, '0000-00-00', '0000-00-00', '0000-00-00', '', 6456, 0, 0, 0, 6456, 0, 'Q1', '1970', 6456, 1, 'Active', '2014-09-15', '18:30:29 PM', 18),
(117, 0, 246, '2014-09-03', 534, '5345.00', 0, '5,435.00', 1, '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 0, 0, 0, -534, 534, 'Q1', '1970', 0, 1, 'Active', '2014-09-15', '18:35:56 PM', 18),
(118, 0, 246, '2014-09-03', 534, '5345.00', 0, '5,435.00', 2, '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 0, 0, 0, -534, 534, 'Q1', '1970', 0, 2, 'Active', '2014-09-15', '18:36:31 PM', 18),
(119, 0, 246, '0000-00-00', 0, '', 0, '', 3, '2014-09-09', '2014-09-02', '2014-09-24', '423', 423, 432, 4, 234, 1085, -234, 'Q3', '2014', 851, 3, 'Active', '2014-09-15', '18:38:51 PM', 18),
(120, 0, 239, '2014-09-17', 45345, '534.00', 0, '354.00', 1, '0000-00-00', '0000-00-00', '0000-00-00', '', 0, 0, 0, 0, -45345, 45345, 'Q1', '1970', 0, 1, 'Active', '2014-09-16', '13:12:30 PM', 18),
(121, 0, 218, '0000-00-00', 0, '', 0, '', 8, '2014-09-03', '2014-09-04', '2014-09-05', '66666', 250000, 888888888, 999999999, 101010, -110760980, -101010, 'Q3', '2014', -110861990, 8, 'Active', '2014-09-16', '18:13:50 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_paymentstage_quarter_bkdn`
--

CREATE TABLE IF NOT EXISTS `adbs_paymentstage_quarter_bkdn` (
  `qnbkdnId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `qnbkdn_QuaterNo` varchar(50) NOT NULL,
  `qnbkdn_Year` varchar(50) NOT NULL,
  `amountPaid` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`qnbkdnId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `adbs_paymentstage_quarter_bkdn`
--

INSERT INTO `adbs_paymentstage_quarter_bkdn` (`qnbkdnId`, `pId`, `qnbkdn_QuaterNo`, `qnbkdn_Year`, `amountPaid`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(6, 218, 'Q3', '2014', 444859, 'active', '2014-09-03', '19:16:34 PM', 18),
(7, 218, 'Q4', '2014', 7000, 'Active', '2014-09-02', '18:31:57 PM', 18),
(8, 224, 'Q3', '2014', 435435, 'Active', '2014-09-03', '16:55:24 PM', 18),
(9, 233, 'Q3', '2014', 5345, 'Active', '2014-09-03', '17:28:44 PM', 18),
(10, 219, 'Q3', '2014', 39068, 'active', '2014-09-03', '19:17:22 PM', 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_pqstage`
--

CREATE TABLE IF NOT EXISTS `adbs_pqstage` (
  `pqsId` int(11) NOT NULL AUTO_INCREMENT,
  `pId` int(11) NOT NULL,
  `pqs_20` date NOT NULL,
  `pqs_21` date NOT NULL,
  `pqs_22` date NOT NULL,
  `pqs_22a` date NOT NULL,
  `pqs_23` date NOT NULL,
  `pqs_24` date NOT NULL,
  `pqs_25` date NOT NULL,
  `pqs_26` date NOT NULL,
  `pqs_27` date NOT NULL,
  `pqs_27a` date NOT NULL,
  `pqs_28` date NOT NULL,
  `pqs_81` int(11) NOT NULL,
  `pqs_82` int(11) NOT NULL,
  `pqs_83` int(11) NOT NULL,
  `pqs_101` int(11) NOT NULL,
  `pqs_102` varchar(50) NOT NULL,
  `pqs_103` text NOT NULL,
  `pqs_104` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL,
  `entDate` int(11) NOT NULL,
  `entTime` int(11) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pqsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `adbs_pqstage`
--

INSERT INTO `adbs_pqstage` (`pqsId`, `pId`, `pqs_20`, `pqs_21`, `pqs_22`, `pqs_22a`, `pqs_23`, `pqs_24`, `pqs_25`, `pqs_26`, `pqs_27`, `pqs_27a`, `pqs_28`, `pqs_81`, `pqs_82`, `pqs_83`, `pqs_101`, `pqs_102`, `pqs_103`, `pqs_104`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(14, 219, '2014-09-02', '2014-09-03', '2014-09-04', '2014-09-03', '2014-09-30', '2014-09-03', '2014-09-07', '2014-09-08', '2014-09-09', '2014-09-10', '2014-09-11', 432, 4324, 4324, 0, '234', 'No', 'Test', 0, 2014, 17, 18),
(15, 220, '2014-08-05', '2014-08-05', '2014-08-06', '0000-00-00', '2014-08-13', '2014-08-20', '2014-08-21', '2014-08-13', '2014-08-13', '2014-09-02', '2014-08-14', 4334, 4334, 3434, 0, '434222', 'Yes', 'Test', 0, 2014, 17, 18),
(16, 226, '2014-08-20', '2014-08-20', '2014-08-27', '0000-00-00', '2014-08-12', '2014-08-21', '2014-08-13', '2014-08-05', '2014-08-13', '0000-00-00', '2014-08-13', 43, 43, 43, 0, '43', 'No', '', 0, 2014, 17, 8),
(17, 222, '2014-08-12', '2014-08-12', '2014-08-05', '0000-00-00', '2014-08-13', '2014-08-07', '2014-08-22', '2014-08-22', '2014-08-29', '0000-00-00', '2014-08-13', 53345, 5435, 345, 0, '5543', 'Yes', 'Test2', 0, 2014, 18, 18),
(18, 221, '2014-08-05', '2014-08-13', '2014-08-12', '0000-00-00', '2014-08-20', '2014-08-20', '2014-08-05', '2014-08-13', '2014-08-14', '0000-00-00', '2014-08-13', 0, 0, 0, 0, '', 'No', ' Test', 0, 2014, 15, 3),
(19, 224, '2014-09-01', '2014-09-02', '2014-09-03', '0000-00-00', '2014-09-04', '2014-09-05', '2014-09-06', '2014-09-07', '2014-09-08', '2014-09-09', '2014-09-10', 111, 112, 113, 0, '114', 'No', 'Test', 0, 2014, 13, 18),
(20, 233, '2014-09-04', '2014-09-05', '2014-09-06', '0000-00-00', '2014-09-07', '2014-09-08', '2014-09-09', '2014-09-10', '2014-09-11', '2014-09-12', '2014-09-13', 4334, 43, 43, 0, '43', 'Yes', ' Test', 0, 2014, 16, 18),
(23, 238, '2014-09-01', '2014-09-03', '2014-09-04', '0000-00-00', '2014-09-05', '2014-09-06', '2014-09-07', '2014-09-08', '2014-09-09', '2014-09-10', '2014-09-11', 35, 435, 543, 0, '543', 'Yes', 'test', 0, 2014, 16, 18),
(24, 239, '2014-09-02', '2014-09-25', '2014-09-18', '0000-00-00', '2014-09-10', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, '', '', ' ', 0, 2014, 10, 18),
(25, 240, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 45, 435, 345, 0, '345345', 'Yes', 'Test', 0, 2014, 18, 18);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_pqstage_bkdn_newspaper`
--

CREATE TABLE IF NOT EXISTS `adbs_pqstage_bkdn_newspaper` (
  `pqsbnId` int(11) NOT NULL AUTO_INCREMENT,
  `pqsId` int(11) NOT NULL,
  `newsPaperName` varchar(250) NOT NULL,
  `publishDate` date NOT NULL,
  `newsPaperLanguage` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pqsbnId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_pqstage_bkdn_note`
--

CREATE TABLE IF NOT EXISTS `adbs_pqstage_bkdn_note` (
  `pqsbntId` int(11) NOT NULL AUTO_INCREMENT,
  `pqsId` int(11) NOT NULL,
  `clarificationDateByADB` date NOT NULL,
  `responseDateByADB` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pqsbntId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adbs_procurementmethod`
--

CREATE TABLE IF NOT EXISTS `adbs_procurementmethod` (
  `pmId` int(11) NOT NULL AUTO_INCREMENT,
  `pmName` varchar(250) NOT NULL,
  `pmDescription` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`pmId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adbs_procurementmethod`
--

INSERT INTO `adbs_procurementmethod` (`pmId`, `pmName`, `pmDescription`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 'ICB', 'International Competitive Bidding', 'Active', '2014-07-08', '13:33:21 PM', 1),
(2, 'LCB', 'Limited Competitive Bidding', 'Active', '2014-07-08', '15:58:31 PM', 1),
(3, 'NCB', 'National Competitive Bidding', 'Active', '2014-07-08', '15:58:48 PM', 1),
(4, 'Shoping', 'This is materials type project.', 'Active', '2014-07-08', '15:59:13 PM', 1),
(5, 'DC', 'Direct Contracting', 'Active', '2014-07-08', '15:59:29 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_procurementtype`
--

CREATE TABLE IF NOT EXISTS `adbs_procurementtype` (
  `ptId` int(11) NOT NULL AUTO_INCREMENT,
  `ptName` varchar(250) NOT NULL,
  `ptDescription` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(50) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`ptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adbs_procurementtype`
--

INSERT INTO `adbs_procurementtype` (`ptId`, `ptName`, `ptDescription`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(1, 'Goods ', 'Goods Procurement', 'Active', '2014-07-08', '10:42:25 AM', 1),
(2, 'Works', 'Works Procurement', 'Active', '2014-07-08', '15:57:28 PM', 1),
(3, 'Trunkey', 'Trunkey', 'Active', '2014-07-08', '15:57:50 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adbs_projectsetup`
--

CREATE TABLE IF NOT EXISTS `adbs_projectsetup` (
  `psId` int(11) NOT NULL AUTO_INCREMENT,
  `aId` int(11) NOT NULL,
  `loanGrandNo` varchar(250) NOT NULL,
  `loanAmount` double NOT NULL,
  `allocationToEaAmouont` double NOT NULL,
  `projectEffectedDate` date NOT NULL,
  `projectclosingDate` date NOT NULL,
  `revisedProjectClosingDate` date NOT NULL,
  `adbProjectName` varchar(250) NOT NULL,
  `adbShortProjectName` varchar(200) NOT NULL,
  `adbSector` varchar(250) NOT NULL,
  `ministryDivision` varchar(250) NOT NULL,
  `eaName` varchar(200) NOT NULL,
  `easProjectName` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `entDate` date NOT NULL,
  `entTime` varchar(100) NOT NULL,
  `entUser` int(11) NOT NULL,
  PRIMARY KEY (`psId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adbs_projectsetup`
--

INSERT INTO `adbs_projectsetup` (`psId`, `aId`, `loanGrandNo`, `loanAmount`, `allocationToEaAmouont`, `projectEffectedDate`, `projectclosingDate`, `revisedProjectClosingDate`, `adbProjectName`, `adbShortProjectName`, `adbSector`, `ministryDivision`, `eaName`, `easProjectName`, `status`, `entDate`, `entTime`, `entUser`) VALUES
(2, 2, '5000-34C', 34034070, 33035080, '2014-07-23', '2016-08-25', '2014-07-23', 'Third Primary Education Development Program PEDP, III', 'PEDP', 'Education', 'Education', 'National Curriculum and Textbook Board', 'National Curriculum and Textbook Board', 'Active', '2014-07-20', '19:13:53 PM', 3),
(3, 4, '3455-23D', 23400000, 456000, '2014-07-08', '2014-07-13', '2014-07-21', 'environment effectiveness project', 'PEEF', 'development', 'Local Govt department', 'Water Development Board', 'Local Environment effectiveness project', 'Active', '2014-07-22', '19:00:54 PM', 1),
(4, 0, '3200-5d', 2345678111, 2000000, '2014-07-01', '2015-07-31', '2015-08-31', 'water emabnkment development project', 'WEDP', 'revenue', 'water resource ministry', '', 'reinforcement in river ruling project', 'Active', '2014-07-27', '15:17:57 PM', 1),
(5, 0, '4532-3D', 8886543, 3400000, '2013-08-01', '2015-09-30', '2016-08-31', 'City Region Development Project (CRDP)', 'CRDP', 'Development', 'Ministry of Local Government, Rural Development and Co-operatives (LGRD&C)', '', 'City Region Development Project (CRDP)', 'Active', '2014-08-15', '06:28:18 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `CONTACT_ID` int(20) NOT NULL AUTO_INCREMENT,
  `CONTACT_NAME` varchar(500) NOT NULL,
  `CONTACT_EMAIL` varchar(100) NOT NULL,
  `CONTACT_SUBJECT` varchar(500) NOT NULL,
  `CONTACT_MESSAGE` varchar(2400) NOT NULL,
  `CONTACT_DATE` varchar(25) NOT NULL,
  PRIMARY KEY (`CONTACT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`CONTACT_ID`, `CONTACT_NAME`, `CONTACT_EMAIL`, `CONTACT_SUBJECT`, `CONTACT_MESSAGE`, `CONTACT_DATE`) VALUES
(1, 'Md Abdul Karim Akhand', 'sumon.orz@gmail.com', 'Test Subject', 'Hi! This is Sumon from chandpur........', ' 18-05-2013'),
(6, 'Tasneam Jahan Maryam', 'tasneamjahan@gmail.com', 'This is test message', 'Hi! This is Tasneam Jahan Maryam.....', '18-05-2013'),
(9, 'Taslima Akhter', 'taslima@gmail.com', 'Test Subject', 'Hi! This is Taslima Akhter', '18-05-2013'),
(10, 'mehedi', 'mehed@test.com', 'just for test', 'hello this is a vua site..........', '19-05-2013'),
(11, 'Monira', 'monira@gmail.com', 'Test Message', 'Hi! This is Test Message................................', '31-05-2013');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
(11, 9, 'Home', ' ', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `s_operator`
--

INSERT INTO `s_operator` (`OPERATOR_ID`, `USER_ID`, `OPNAME`, `OPPASS`, `START_DATE`, `END_DATE`) VALUES
(1, 1, 'admin', '!Adb2014', '2013-03-09', '0000-00-00'),
(19, 18, 'PEDPIII_user1', '123456', '0000-00-00', '0000-00-00'),
(20, 19, 'adb_user', '123456', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `s_position`
--

CREATE TABLE IF NOT EXISTS `s_position` (
  `POSITION_ID` int(20) NOT NULL AUTO_INCREMENT,
  `POSITION` varchar(100) NOT NULL,
  PRIMARY KEY (`POSITION_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `s_position`
--

INSERT INTO `s_position` (`POSITION_ID`, `POSITION`) VALUES
(1, 'Managing Director'),
(3, 'Chairman'),
(4, 'Officer'),
(5, 'Jr Officer'),
(6, 'Senior Officer'),
(7, 'Chairman Senior'),
(8, 'test3');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=464 ;

--
-- Dumping data for table `s_privilege_control`
--

INSERT INTO `s_privilege_control` (`PRIVILEGE_CONTROL_ID`, `SUB_MODULE_ID`, `USER_ID`, `RECORD_DATE`) VALUES
(272, 5, 1, '2014-07-20 17:39:41'),
(273, 17, 1, '2014-07-20 17:39:42'),
(274, 9, 1, '2014-07-20 17:39:42'),
(275, 3, 1, '2014-07-20 17:39:42'),
(276, 2, 1, '2014-07-20 17:39:42'),
(277, 1, 1, '2014-07-20 17:39:42'),
(443, 19, 18, '2014-09-01 16:40:51'),
(444, 21, 18, '2014-09-01 16:40:51'),
(445, 18, 18, '2014-09-01 16:40:51'),
(446, 5, 18, '2014-09-01 16:40:51'),
(447, 17, 18, '2014-09-01 16:40:51'),
(448, 20, 18, '2014-09-01 16:40:51'),
(449, 9, 18, '2014-09-01 16:40:51'),
(450, 3, 18, '2014-09-01 16:40:51'),
(451, 2, 18, '2014-09-01 16:40:51'),
(452, 1, 18, '2014-09-01 16:40:51'),
(454, 19, 19, '2014-09-04 09:24:27'),
(455, 21, 19, '2014-09-04 09:24:27'),
(456, 18, 19, '2014-09-04 09:24:27'),
(457, 5, 19, '2014-09-04 09:24:27'),
(458, 17, 19, '2014-09-04 09:24:27'),
(459, 20, 19, '2014-09-04 09:24:27'),
(460, 9, 19, '2014-09-04 09:24:27'),
(461, 3, 19, '2014-09-04 09:24:27'),
(462, 2, 19, '2014-09-04 09:24:27'),
(463, 1, 19, '2014-09-04 09:24:27');

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
(31, 1, '2013-05-18 06:14:38'),
(32, 6, '2013-05-18 06:14:38'),
(33, 5, '2013-05-18 06:14:38'),
(34, 4, '2013-05-18 06:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `s_role`
--

CREATE TABLE IF NOT EXISTS `s_role` (
  `ROLE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `ROLE_NAME` varchar(100) NOT NULL,
  `FORWARD_TO` int(20) NOT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `s_role`
--

INSERT INTO `s_role` (`ROLE_ID`, `ROLE_NAME`, `FORWARD_TO`) VALUES
(1, 'PD', 0),
(17, 'HOPE', 1),
(19, 'BOD', 17),
(20, 'PE member', 17),
(21, 'EC member', 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `s_service`
--

INSERT INTO `s_service` (`SERVICE_ID`, `SERVICE_NAME`, `DESCRIPTION`, `ORDER_NO`) VALUES
(1, 'Setup', 'System Initialization', 8),
(3, 'Procurement Plan Setup', 'Procurement Plan Setup', 22),
(5, 'Reports', 'Reports', 44),
(6, 'Project', '', 33),
(7, 'Objective/Purpose of This Tool', ' ', 2),
(8, 'Contact Information', ' ', 3),
(9, 'Home', ' ', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `s_sub_module`
--

INSERT INTO `s_sub_module` (`SUB_MODULE_ID`, `MODULE_ID`, `SUB_MODULE_NAME`, `DEFAULT_FILE`, `DESCRIPTION`, `ORDER_NO`) VALUES
(1, 1, 'User Registration', 'UserRegistration.php', 'User Registration', 1),
(2, 2, 'Privilege Control', 'PrivilegeControl.php', 'Privilege Control', 3),
(3, 3, 'File Management', 'FileManagement.php', 'File Management', 2),
(5, 5, 'Procurement Plan File Management', 'ProjectFileManagement.php', 'Procurement Plan File Management', 1),
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
(21, 11, 'Home', 'index.php', ' ', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `s_user`
--

INSERT INTO `s_user` (`USER_ID`, `POSITION_ID`, `USER_NAME`, `EMAIL`, `psId`, `USER_STATUS`, `aId`) VALUES
(1, 1, 'EUITSols', 'euitsols.suprt@gmail.com', 1, 'active', 2),
(18, 4, 'PEDPIII_user1', 'PEDPIII_user1@gmail.com', 2, 'active', 2),
(19, 7, 'ADB_user', 'test@gmail.com', 3, 'active', 4);

-- --------------------------------------------------------

--
-- Table structure for table `s_user_role`
--

CREATE TABLE IF NOT EXISTS `s_user_role` (
  `USER_ROLE_ID` int(20) NOT NULL AUTO_INCREMENT,
  `ROLE_ID` int(20) NOT NULL,
  `USER_ID` int(20) NOT NULL,
  PRIMARY KEY (`USER_ROLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `s_user_role`
--

INSERT INTO `s_user_role` (`USER_ROLE_ID`, `ROLE_ID`, `USER_ID`) VALUES
(1, 1, 1),
(27, 20, 18),
(28, 19, 19);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
