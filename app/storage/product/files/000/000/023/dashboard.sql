-- --------------------------------------------------------
-- Host:                         216.14.113.50
-- Server version:               5.1.72-cll - MySQL Community Server (GPLv2)
-- Server OS:                    unknown-linux-gnu
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table springra_dbuser.2co_fraud_status_logs
CREATE TABLE IF NOT EXISTS `2co_fraud_status_logs` (
  `2co_order_number` varchar(35) NOT NULL DEFAULT '',
  `email` text,
  `2co_fraud_status` enum('Unverified','Pass','Fail') DEFAULT 'Unverified',
  `data` text,
  `creation_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`2co_order_number`),
  KEY `idx_email` (`email`(200))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table springra_dbuser.2co_fraud_status_logs: 30,237 rows
/*!40000 ALTER TABLE `2co_fraud_status_logs` DISABLE KEYS */;
