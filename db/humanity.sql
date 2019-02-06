-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 06, 2019 at 10:30 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `humanity`
--

-- --------------------------------------------------------

--
-- Table structure for table `breaks`
--

DROP TABLE IF EXISTS `breaks`;
CREATE TABLE IF NOT EXISTS `breaks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `break_in` datetime NOT NULL,
  `break_out` datetime DEFAULT NULL,
  `time_clock` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time_clock` (`time_clock`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clock_day_counter`
--

DROP TABLE IF EXISTS `clock_day_counter`;
CREATE TABLE IF NOT EXISTS `clock_day_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clock_index` int(11) NOT NULL,
  `clock_time` datetime DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clock_index` (`clock_index`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email_addr` varchar(200) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `emp_image` text NOT NULL,
  `role` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  `payroll_card` int(11) DEFAULT NULL,
  `total_pay` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_addr` (`email_addr`),
  KEY `payroll_card` (`payroll_card`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email_addr`, `phone_no`, `password`, `emp_image`, `role`, `position`, `payroll_card`, `total_pay`) VALUES
(68, 'umar', 'farooq', 'umarbwn@gmail.com', '03037645434', 'cXc0aGRkcWNyZw==', 'download.jpg', 'superadmin', 0, NULL, 0),
(73, 'rashid', 'raza', 'rashid@gmail.com', '03037645432', 'cXc0aGRkcWNyZw==', 'employee73.jpg', '', 7, 21, 0),
(74, 'ali', 'raza', 'aliraza@gmail.com', '03035787036', 'cXc0aGRkcWNyZw==', 'employee74.jpg', '', 7, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paid_leaves` int(2) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_condition` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `paid_leaves`, `emp_id`, `leave_condition`) VALUES
(10, 0, 68, 0),
(15, 0, 73, 0),
(16, 0, 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_cards`
--

DROP TABLE IF EXISTS `payroll_cards`;
CREATE TABLE IF NOT EXISTS `payroll_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_title` varchar(200) NOT NULL,
  `pay_rate` int(3) NOT NULL,
  `daily_hours` int(2) NOT NULL,
  `hrly_rate_chart` text NOT NULL,
  `arrivel_time` time NOT NULL,
  `fine_time` time NOT NULL,
  `deduct_hours` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_cards`
--

INSERT INTO `payroll_cards` (`id`, `card_title`, `pay_rate`, `daily_hours`, `hrly_rate_chart`, `arrivel_time`, `fine_time`, `deduct_hours`) VALUES
(21, '8 Hours card', 100, 8, '{\"sun0\":\"100%\",\"mon0\":\"100%\",\"tue0\":\"100%\",\"wed0\":\"100%\",\"thu0\":\"100%\",\"fri0\":\"100%\",\"sat0\":\"100%\",\"sun0pm\":\"100%\",\"mon0pm\":\"100%\",\"tue0pm\":\"100%\",\"wed0pm\":\"100%\",\"thu0pm\":\"100%\",\"fri0pm\":\"100%\",\"sat0pm\":\"100%\",\"special_hours\":[]}', '11:00:00', '11:15:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `monthly_salary` double NOT NULL,
  `calculated_salary` double NOT NULL,
  `salary_type` varchar(20) NOT NULL,
  `per_hour_amount` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`id`, `emp_id`, `monthly_salary`, `calculated_salary`, `salary_type`, `per_hour_amount`) VALUES
(10, 68, 0, 0, '', 0),
(15, 73, 30000, 0, 'monthly', 0),
(16, 74, 0, 0, 'wages', 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `location`) VALUES
(7, 'Web Developers', 10);

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

DROP TABLE IF EXISTS `terminals`;
CREATE TABLE IF NOT EXISTS `terminals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `location`, `name`) VALUES
(10, 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 'Showroom');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_links`
--

DROP TABLE IF EXISTS `terminal_links`;
CREATE TABLE IF NOT EXISTS `terminal_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `positions` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `link_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_links`
--

INSERT INTO `terminal_links` (`id`, `positions`, `location_id`, `link_type`) VALUES
(70, '[\"{\\\"position\\\":{\\\"id\\\":\\\"7\\\",\\\"name\\\":\\\"Web Developers\\\"}}\"]', 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `time_clock`
--

DROP TABLE IF EXISTS `time_clock`;
CREATE TABLE IF NOT EXISTS `time_clock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_clock_in` datetime NOT NULL,
  `emp_clock_out` datetime NOT NULL,
  `emp_loc` text NOT NULL,
  `emp_id` int(11) NOT NULL,
  `clock_in_img` text NOT NULL,
  `clock_out_img` text NOT NULL,
  `emp_clock_out_loc` text NOT NULL,
  `clock_pay` double NOT NULL,
  `status` int(11) NOT NULL,
  `special_overtime` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_clock`
--

INSERT INTO `time_clock` (`id`, `emp_clock_in`, `emp_clock_out`, `emp_loc`, `emp_id`, `clock_in_img`, `clock_out_img`, `emp_clock_out_loc`, `clock_pay`, `status`, `special_overtime`) VALUES
(399, '2019-02-05 09:35:39', '2019-02-05 09:35:46', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 73, 'clock_in399.jpeg', 'clock_out399.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.24305555555556, 1, 0),
(400, '2019-02-05 09:38:12', '2019-02-05 09:38:22', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 73, 'clock_in400.jpeg', 'clock_out400.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.34722222222222, 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breaks`
--
ALTER TABLE `breaks`
  ADD CONSTRAINT `breaks_ibfk_1` FOREIGN KEY (`time_clock`) REFERENCES `time_clock` (`id`);

--
-- Constraints for table `clock_day_counter`
--
ALTER TABLE `clock_day_counter`
  ADD CONSTRAINT `clock_day_counter_ibfk_1` FOREIGN KEY (`clock_index`) REFERENCES `time_clock` (`id`),
  ADD CONSTRAINT `clock_day_counter_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `breaks` (`emp_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`payroll_card`) REFERENCES `payroll_cards` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`location`) REFERENCES `terminals` (`id`);

--
-- Constraints for table `terminal_links`
--
ALTER TABLE `terminal_links`
  ADD CONSTRAINT `terminal_links_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `terminals` (`id`);

--
-- Constraints for table `time_clock`
--
ALTER TABLE `time_clock`
  ADD CONSTRAINT `time_clock_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
