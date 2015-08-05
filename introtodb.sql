-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2014 at 05:43 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `introtodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankdetail`
--

CREATE TABLE IF NOT EXISTS `bankdetail` (
  `bankdetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL COMMENT 'Foreign Key from customer',
  `account_type` varchar(50) NOT NULL,
  `account_no` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  PRIMARY KEY (`bankdetail_id`),
  KEY `bankdetail_id` (`bankdetail_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL COMMENT 'Foreign Key from feedback',
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`complaint_id`),
  UNIQUE KEY `feedback_id_2` (`feedback_id`),
  KEY `feedback_id` (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `feedback_id`, `text`) VALUES
(1, 2, 'Worst support'),
(3, 3, 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `points` int(11) NOT NULL DEFAULT '0',
  `purchase_id` int(11) DEFAULT NULL COMMENT 'Current ongoing purchase of user',
  `person_id` int(11) NOT NULL COMMENT 'From person',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `person_id_2` (`person_id`),
  KEY `person_id` (`person_id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `points`, `purchase_id`, `person_id`) VALUES
(3, 506, 20, 12),
(7, 0, 23, 17),
(10, 0, NULL, 19);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(20) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Health'),
(2, 'Yo'),
(3, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Related to person table',
  `work_hours` int(11) NOT NULL DEFAULT '0',
  `salary` int(11) NOT NULL DEFAULT '0' COMMENT 'Per month',
  `joining_date` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL COMMENT 'Related to department',
  `person_id` int(11) NOT NULL COMMENT 'Foreign Key from person',
  `education` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `person_id_2` (`person_id`),
  KEY `person_id` (`person_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `work_hours`, `salary`, `joining_date`, `department_id`, `person_id`, `education`) VALUES
(1, 5, 500, '2014-11-03', 2, 17, 'Btech\r\n'),
(2, 65060, 20520, '0000-00-00', 1, 12, 'Btech'),
(3, 0, 0, NULL, NULL, 18, '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL COMMENT 'Foreign Key from customer',
  `time` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `customer_id`, `time`, `date`) VALUES
(1, 3, '05:08:56', '2014-11-04'),
(2, 10, '05:07:00', '2014-11-02'),
(3, 3, '08:06:00', '2014-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `max_qty` int(11) NOT NULL DEFAULT '0',
  `min_qty` int(11) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Foreign key for product',
  PRIMARY KEY (`offer_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offer_id`, `max_qty`, `min_qty`, `discount`, `start_date`, `end_date`, `product_id`) VALUES
(1, 5, 1, 22, '2014-11-11', '2014-11-19', 2),
(5, 10, 1, 2, '2014-11-04', '2014-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `street_address` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `whoisit` varchar(20) NOT NULL DEFAULT 'customer' COMMENT '("customer", "employee", "admin")',
  `password` varchar(50) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`name`, `email`, `phoneNo`, `state`, `country`, `city`, `street_address`, `dob`, `person_id`, `whoisit`, `password`) VALUES
('Raj', 'raj454raj@gmail.com', '9985900308', 'Gujarat', 'India', 'Gandhinagar', 'adsasd', '2014-11-11', 12, 'admin', 'admin'),
('Hitesh Sharma', 'hitesh96db@gmail.com', '5259629526', 'sdfsd', 'ksdffsd', 'sfd', 'fsdfsd', '2014-11-04', 17, 'customer', 'default'),
('Sourav', 'sourav@gmail.com', 'kjn', 'kjn', 'kjnkjn', 'kjnkjn', 'kjn', '2014-11-03', 18, 'manager', 'default'),
('Jalu', 'jal@gmail.com', '9595969569', 'sadkml', 'dsklfm', 'sjkfd', 'elkdfsm', '2014-08-05', 19, 'customer', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL COMMENT 'Name of the Product',
  `type` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `type`, `company`, `price`, `stock`) VALUES
(1, 'Raja', 'food', 'Raja Bakery', 12, 29),
(2, 'Zolo', 'mobile', 'ZOLO electronics', 2222, 26),
(3, 'NasKme', 'mobile', 'HTC', 222231, 46),
(4, 'Raj', 'Food', 'No company', 50, 88),
(5, 'Health', 'Cosmetic', 'no', 80, 26525);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL COMMENT 'Foreign key from employee',
  `counter_no` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `net_total` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `employee_id` (`employee_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `employee_id`, `counter_no`, `date`, `time`, `net_total`, `customer_id`) VALUES
(20, NULL, NULL, '2006-11-14', '07:34:28', 30, 1),
(21, NULL, NULL, '2006-11-14', '07:51:00', 8920, 1),
(23, NULL, NULL, '2009-11-14', '06:33:25', 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE IF NOT EXISTS `purchase_product` (
  `purchase_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`purchase_product_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`purchase_product_id`, `purchase_id`, `product_id`, `qty`) VALUES
(32, 21, 1, 10),
(33, 21, 2, 4),
(36, 23, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL COMMENT 'Foreign Key from purchase',
  `product_id` int(11) NOT NULL COMMENT 'Foreign Key from product',
  `refund` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `purchase_id` (`purchase_id`,`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`return_id`, `purchase_id`, `product_id`, `refund`, `date`) VALUES
(1, 20, 1, 80, '2014-10-15'),
(2, 21, 4, 80, '2014-10-15'),
(3, 20, 1, 36, '2014-11-07'),
(4, 20, 1, 36, '2014-11-07'),
(5, 20, 1, 36, '2014-11-07'),
(6, 20, 1, 36, '2014-11-07'),
(7, 20, 1, 36, '2014-11-07'),
(8, 20, 1, 36, '2014-11-07'),
(9, 20, 1, 36, '2014-11-07'),
(10, 20, 1, 36, '2014-11-07'),
(11, 20, 1, 36, '2014-11-07'),
(12, 20, 1, 36, '2014-11-07'),
(13, 20, 1, 36, '2014-11-07'),
(14, 20, 1, 36, '2014-11-07'),
(15, 20, 1, 36, '2014-11-07'),
(16, 20, 1, 0, '2014-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE IF NOT EXISTS `suggestion` (
  `suggestion_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL COMMENT 'Foreign Key from feedback',
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`suggestion_id`),
  UNIQUE KEY `feedback_id_2` (`feedback_id`),
  KEY `feedback_id` (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`suggestion_id`, `feedback_id`, `text`) VALUES
(1, 2, 'Good people'),
(2, 1, 'Hello\r\n'),
(3, 3, 'Yo');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `type`, `city`, `state`, `country`, `street_address`) VALUES
(1, 'Health', 'Gandhinagar', 'Gujarat', 'India', 'sjdn'),
(2, 'Food', 'Hyderabad', 'Telangana', 'India', '');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product`
--

CREATE TABLE IF NOT EXISTS `warehouse_product` (
  `warehouse_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_arrival` date NOT NULL,
  `date_to_move` date NOT NULL,
  `stock` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Foreign Key from product',
  `warehouse_id` int(11) NOT NULL,
  PRIMARY KEY (`warehouse_product_id`),
  KEY `product_id` (`product_id`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `warehouse_product`
--

INSERT INTO `warehouse_product` (`warehouse_product_id`, `date_of_arrival`, `date_to_move`, `stock`, `product_id`, `warehouse_id`) VALUES
(1, '2014-11-03', '2014-11-11', 20, 3, 1),
(2, '2014-11-03', '2014-11-12', -1, 2, 2),
(3, '2014-11-10', '2014-11-19', 30, 3, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bankdetail`
--
ALTER TABLE `bankdetail`
  ADD CONSTRAINT `bankdetail_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD CONSTRAINT `suggestion_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`);

--
-- Constraints for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD CONSTRAINT `warehouse_product_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`warehouse_id`),
  ADD CONSTRAINT `warehouse_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
