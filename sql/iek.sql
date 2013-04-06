-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2013 at 12:10 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iekadd`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_sessions`
--

CREATE TABLE IF NOT EXISTS `active_sessions` (
  `user_id` varchar(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_sessions`
--

INSERT INTO `active_sessions` (`user_id`, `login_time`, `user_type`) VALUES
('qa', '2013-03-11 11:41:52', 'C'),
('x', '2013-03-11 11:48:48', 'C'),
('x', '2013-03-11 11:50:48', 'C'),
('shaji', '2013-03-26 20:14:20', 'C'),
('shaji', '2013-03-26 20:25:14', 'C'),
('shaji', '2013-03-26 20:26:04', 'C'),
('biju', '2013-03-26 20:58:14', 'C'),
('biju', '2013-03-26 20:59:03', 'C'),
('abcd', '2013-03-30 06:33:18', 'C'),
('biju', '2013-03-31 17:49:27', 'C'),
('biju', '2013-03-31 17:51:32', 'C'),
('biju', '2013-03-31 17:57:18', 'C'),
('bill', '2013-03-31 18:03:15', 'C'),
('biju', '2013-03-31 18:26:01', 'C'),
('biju', '2013-03-31 18:26:51', 'C'),
('bill', '2013-03-31 18:50:52', 'C'),
('bill', '2013-03-31 18:54:06', ''),
('bill', '2013-03-31 18:55:18', ''),
('bill', '2013-03-31 18:58:32', 'sel'),
('bill', '2013-03-31 18:59:45', 'seller');

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
  `config_id` int(10) NOT NULL,
  `config` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_category`
--

INSERT INTO `config_category` (`config_id`, `config`, `category`, `unit`) VALUES
(1, 'RAM', 'Laptop', 'GB'),
(2, 'BRAND', 'Laptop', ''),
(3, 'HDD', 'Laptop', 'GB'),
(4, 'WARRANTY', 'Laptop', 'year'),
(5, 'WARRANTY', 'Mobile', 'year'),
(6, 'PROCESSOR', 'Laptop', '');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

CREATE TABLE IF NOT EXISTS `consumer` (
  `username` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`username`, `name`, `email`, `mobile`) VALUES
('abcd', 'sdasd', 'dasd', '12312'),
('aji', 'aji b', 'aji@gmail.com', '9877777766'),
('biju', 'biju ramesh', 'bbb', '1234567890'),
('binu', 'binu d', 'binu@gmail.com', '9877777766'),
('jmj', 'ljj b', 'jj@gmail.com', '9877777766'),
('lijin', 'lijin b', 'ljn@gmail.com', '9877777766'),
('lijo', 'lijo p', 'ju@gmail.com', '9877777766'),
('liju', 'liju p', 'lju@gmail.com', '9877777766'),
('lj', 'lj b', 'lj@gmail.com', '9877777766'),
('ljmj', 'ljmj b', 'lmjj@gmail.com', '9877777766'),
('mahi', 'mahindra', 'mahi@gmail.com', '1111111111'),
('manu', 'manu b', 'manu@gmail.com', '9877777766'),
('qa', 'qa unittest', 'qa@mail.com', '123456789'),
('sanjay', 'sanju ram', 'sanjay@gmail.com', '3632'),
('shaji', 'shaji nadeshan', 'shaji@gmail.com', '1234567890'),
('shiju', 'shiju p p', 'shiju@gmail.com', '9877777766'),
('testuser', 'tester', 'test@gmail.com', '123456'),
('x', 'x', 'x', 'xx');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `emailbox`
--

INSERT INTO `emailbox` (`id`, `title`, `description`, `mail_from`, `mail_to`) VALUES
(1, 'hnmnb', 'gjhj', 'notset', 'notset'),
(2, 'sddsd', 'erwtst', 'notset', 'notset');

-- --------------------------------------------------------

--
-- Table structure for table `keyword_searchengine`
--

CREATE TABLE IF NOT EXISTS `keyword_searchengine` (
  `key_id` int(30) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prefer` int(10) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `keyword_searchengine`
--

INSERT INTO `keyword_searchengine` (`key_id`, `keyword`, `product_id`, `prefer`) VALUES
(11, 'testuser', 10, 0),
(12, 'dell 1525 inspiron', 10, 0),
(13, 'multimedia entry lev', 10, 0),
(14, 'Laptop ', 10, 0),
(15, '10', 10, 0),
(16, '5', 10, 0),
(17, 'Dell', 10, 0),
(18, '500', 10, 0),
(19, '2', 10, 0),
(20, 'intel core i5', 10, 0),
(21, 'testuser', 11, 0),
(22, 'sony vaio', 11, 0),
(23, 'multiedia laptop wit', 11, 0),
(24, 'Laptop ', 11, 0),
(25, '5', 11, 0),
(26, '4', 11, 0),
(27, 'sony', 11, 0),
(28, '500', 11, 0),
(29, '2', 11, 0),
(30, 'i5', 11, 0),
(31, 'testuser', 12, 0),
(32, 'micromax a100', 12, 0),
(33, 'smartphone with andr', 12, 0),
(34, 'Mobile ', 12, 0),
(35, '5', 12, 0),
(36, '1', 12, 0),
(37, 'testuser', 13, 0),
(38, 'dasdh', 13, 0),
(39, 'jdh', 13, 0),
(40, 'Laptop ', 13, 0),
(41, '3', 13, 0),
(42, '2', 13, 0),
(43, 'ddffw', 13, 0),
(44, '500', 13, 0),
(45, '2', 13, 0),
(46, 'ut', 13, 0);

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
('abcd', '123', 'consumer'),
('aji', '123', 'consumer'),
('biju', '123', 'consumer'),
('bill', '123', 'seller'),
('binu', '123', 'consumer'),
('bir', '123', 'seller'),
('jmj', '123', 'consumer'),
('lijin', '123', 'consumer'),
('lijo', '123', 'consumer'),
('liju', '123', 'consumer'),
('lj', '123', 'consumer'),
('ljmj', '123', 'consumer'),
('ma', '123', 'seller'),
('mahi', '123', 'consumer'),
('manu', '123', 'consumer'),
('qa', 'qa', 'consumer'),
('sanjay', '123', 'consumer'),
('shaji', '123', 'consumer'),
('tata', '123', 'seller'),
('tatabir', '123', 'seller'),
('tatabirla', '123', 'seller'),
('test', '123', 'seller'),
('testuser', '123', 'consumer'),
('x', 'x', 'consumer');

-- --------------------------------------------------------

--
-- Table structure for table `product_configuration`
--

CREATE TABLE IF NOT EXISTS `product_configuration` (
  `config_id` int(20) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(30) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `string_value` varchar(20) NOT NULL,
  `int_value` int(20) NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `product_configuration`
--

INSERT INTO `product_configuration` (`config_id`, `config_name`, `prod_id`, `string_value`, `int_value`) VALUES
(41, 'RAM', 10, '', 5),
(42, 'BRAND', 10, 'Dell', 0),
(43, 'HDD', 10, '', 500),
(44, 'WARRANTY', 10, '', 2),
(45, 'PROCESSOR', 10, 'intel core i5', 0),
(46, 'RAM', 11, '', 4),
(47, 'BRAND', 11, 'sony', 0),
(48, 'HDD', 11, '', 500),
(49, 'WARRANTY', 11, '', 2),
(50, 'PROCESSOR', 11, 'i5', 0),
(51, 'WARRANTY', 12, '', 1),
(52, 'RAM', 13, '', 2),
(53, 'BRAND', 13, 'ddffw', 0),
(54, 'HDD', 13, '', 500),
(55, 'WARRANTY', 13, '', 2),
(56, 'PROCESSOR', 13, 'ut', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_seller`
--

CREATE TABLE IF NOT EXISTS `product_seller` (
  `prod_id` int(20) NOT NULL AUTO_INCREMENT,
  `sellerid` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `count` varchar(10) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product_seller`
--

INSERT INTO `product_seller` (`prod_id`, `sellerid`, `name`, `description`, `category`, `count`) VALUES
(10, 'testuser', 'dell 1525 inspiron', 'multimedia entry level laptop', 'Laptop ', '10'),
(11, 'testuser', 'sony vaio', 'multiedia laptop with touch enabled lcd screen', 'Laptop ', '5'),
(12, 'testuser', 'micromax a100', 'smartphone with android 4.0(ics) os', 'Mobile ', '5'),
(13, 'testuser', 'dasdh', 'jdh', 'Laptop ', '3');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `username` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`username`, `name`, `email`, `mobile`) VALUES
('bill', 'bill gates', 'bill@gmail.com', '7777777777'),
('bir', 'birla', 'bir@gmail.com', '9877777766'),
('ma', 'mahi', 'ma@gmail.com', '1111111111'),
('tata', 'tata r', 'tata@gmail.com', '9877777766'),
('tatabir', 'tata bir', 'tatabir@gmail.com', '9877777766'),
('tatabirla', 'tata birla', 'tatabirla@gmail.com', '9877777766'),
('test', 'tester', 'test@gmail.com', '123456'),
('testuser', 'tester', 'test@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `sellerprofile`
--

CREATE TABLE IF NOT EXISTS `sellerprofile` (
  `display_name` varchar(25) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
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
('dispname1', 'opname1', 'email1', 'address1', 'zip1', 'ctct1', 'landmark1', 'nr.city1', 'lat1', 'long1'),
('fgh', 'rtrt', 'sda', 'ww', 'd', 'ww', 'ff', 'sts', 'we', 'k.j'),
('mahindra', 'ma', 'ma@gmail.com', 'mahi,mumbai', '747463', '222222222', 'taj', 'pune', '74', '54'),
('hsj', 'testuser', 'test@gmail.com', 'test,tester', '13556', '1232134', 'skd', 'ukke', '54', '73');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
