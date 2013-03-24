-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2013 at 02:14 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iek`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_sessions`
--

CREATE TABLE IF NOT EXISTS `active_sessions` (
  `user_id` varchar(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_sessions`
--

INSERT INTO `active_sessions` (`user_id`, `login_time`, `user_type`) VALUES
('qa', '2013-03-11 11:41:52', 'C'),
('x', '2013-03-11 11:48:48', 'C'),
('x', '2013-03-11 11:50:48', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE IF NOT EXISTS `chatbox` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(100) DEFAULT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `message` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readflag` varchar(2) NOT NULL,
  PRIMARY KEY (`slno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`slno`, `sender`, `recipient`, `message`, `time`, `readflag`) VALUES
(40, 'consumer', 'seller', 'hai', '2013-03-03 21:41:04', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `config_category`
--

CREATE TABLE IF NOT EXISTS `config_category` (
  `config` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_category`
--

INSERT INTO `config_category` (`config`, `category`, `unit`) VALUES
('RAM', 'Laptop', 'GB'),
('BRAND', 'Laptop', ''),
('HDD', 'Laptop', 'GB'),
('WARRANTY', 'Laptop', 'year'),
('WARRANTY', 'Mobile', 'year'),
('PROCESSOR', 'Laptop', '');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

CREATE TABLE IF NOT EXISTS `consumer` (
  `username` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `address` text,
  `dob` varchar(15) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`username`, `name`, `email`, `mobile`, `address`, `dob`) VALUES
('qa', 'qa unittest', 'qa@mail.com', '123456789', '0', '0'),
('x', 'x', 'x', 'xx', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `emailbox`
--

CREATE TABLE IF NOT EXISTS `emailbox` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `mail_from` varchar(20) NOT NULL,
  `mail_to` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keyword_searchengine`
--

CREATE TABLE IF NOT EXISTS `keyword_searchengine` (
  `keyword` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prefer` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` char(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `type`) VALUES
('qa', 'qa', 'consumer'),
('x', 'x', 'consumer');

-- --------------------------------------------------------

--
-- Table structure for table `product_configuration`
--

CREATE TABLE IF NOT EXISTS `product_configuration` (
  `config_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `string_value` varchar(20) NOT NULL,
  `int_value` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_seller`
--

CREATE TABLE IF NOT EXISTS `product_seller` (
  `prod_no` int(11) NOT NULL,
  `sellerid` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `count` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `username` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text,
  `dob` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sellerprofile`
--

CREATE TABLE IF NOT EXISTS `sellerprofile` (
  `display_name` varchar(25) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `ph_no` varchar(15) NOT NULL,
  `landmark` varchar(30) NOT NULL,
  `near_city` varchar(20) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerprofile`
--

INSERT INTO `sellerprofile` (`display_name`, `seller_id`, `email`, `address`, `zipcode`, `ph_no`, `landmark`, `near_city`, `latitude`, `longitude`) VALUES
('1', '2', '3', '5', '6', '4', '7', '8', '9', '10'),
('dispname', 'oprname', 'email', 'address', 'zip', 'ctctno', 'landmark', 'nr.city', 'lat', 'lonng'),
('dispname1', 'opname1', 'email1', 'address1', 'zip1', 'ctct1', 'landmark1', 'nr.city1', 'lat1', 'long1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;