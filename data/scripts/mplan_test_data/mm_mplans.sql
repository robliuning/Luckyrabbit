-- phpMyAdmin SQL Dump
-- version 3.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2011 at 09:16 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `luckyrabbit_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `mm_mplans`
--

CREATE TABLE IF NOT EXISTS `mm_mplans` (
  `planId` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `projectId` int(6) unsigned zerofill NOT NULL,
  `yearNum` int(4) NOT NULL,
  `monNum` int(4) NOT NULL,
  `pDate` date NOT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `contactId` int(6) unsigned zerofill NOT NULL,
  `approvcId` int(6) unsigned zerofill DEFAULT NULL,
  `approvcDate` date DEFAULT NULL,
  `approvcRemark` text,
  `approvfId` int(6) unsigned zerofill DEFAULT NULL,
  `approvfDate` date DEFAULT NULL,
  `approvfRemark` text,
  `status` tinyint(2) NOT NULL,
  `remark` text,
  `cTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`planId`),
  KEY `projectId` (`projectId`),
  KEY `contactId` (`contactId`),
  KEY `approvcId` (`approvcId`),
  KEY `approvfId` (`approvfId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `mm_mplans`
--

INSERT INTO `mm_mplans` (`planId`, `projectId`, `yearNum`, `monNum`, `pDate`, `total`, `contactId`, `approvcId`, `approvcDate`, `approvcRemark`, `approvfId`, `approvfDate`, `approvfRemark`, `status`, `remark`, `cTime`) VALUES
(000014, 000003, 2011, 1, '2011-01-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 1, '材料月计划测试一', '2011-08-25 13:12:50'),
(000015, 000003, 2011, 2, '2011-02-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 1, '材料月计划测试二', '2011-08-25 13:13:13'),
(000016, 000003, 2011, 3, '2011-03-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 1, '材料月计划测试三', '2011-08-25 13:13:19'),
(000017, 000003, 2011, 4, '2011-04-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 1, '材料月计划测试四', '2011-08-25 13:13:29'),
(000018, 000003, 2011, 5, '2011-05-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试五', '2011-08-25 11:23:37'),
(000019, 000003, 2011, 6, '2011-06-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试六', '2011-08-25 11:23:46'),
(000020, 000003, 2011, 7, '2011-07-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试七', '2011-08-25 11:25:51'),
(000021, 000003, 2011, 8, '2011-08-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试八', '2011-08-25 11:25:51'),
(000022, 000003, 2011, 9, '2011-09-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试九', '2011-08-25 11:26:41'),
(000023, 000003, 2011, 10, '2011-10-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试十', '2011-08-25 11:27:25'),
(000024, 000003, 2011, 11, '2011-11-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试十一', '2011-08-25 11:27:36'),
(000025, 000003, 2011, 12, '2011-12-01', NULL, 000019, NULL, NULL, NULL, NULL, NULL, NULL, 0, '材料月计划测试十二', '2011-08-25 11:29:02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mm_mplans`
--
ALTER TABLE `mm_mplans`
  ADD CONSTRAINT `mm_mplans_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `pm_projects` (`projectId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_mplans_ibfk_2` FOREIGN KEY (`contactId`) REFERENCES `em_contacts` (`contactId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_mplans_ibfk_3` FOREIGN KEY (`approvcId`) REFERENCES `em_contacts` (`contactId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mm_mplans_ibfk_4` FOREIGN KEY (`approvfId`) REFERENCES `em_contacts` (`contactId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
