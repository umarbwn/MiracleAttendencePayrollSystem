-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2019 at 03:22 PM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clock_day_counter`
--

INSERT INTO `clock_day_counter` (`id`, `clock_index`, `clock_time`, `emp_id`) VALUES
(11, 325, NULL, 63);

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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email_addr`, `phone_no`, `password`, `emp_image`, `role`, `position`, `payroll_card`, `total_pay`) VALUES
(45, 'test', 'admin', 'admin@gmail.com', '03035787036', 'd2VsY29tZQ==', '48381465_355644638322851_7153055705484754944_n.jpg', 'superadmin', 0, NULL, 0),
(63, 'Ali', 'Raza', 'aliraza@gmail.com', '03035787036', 'cXc0aGRkcWNyZw==', 'employee63.jpg', '', 1, 15, 0),
(64, 'umar', 'farooq', 'umarfarooq@gmail.com', '03035787036', 'cXc0aGRkcWNyZw==', 'employee64.jpg', '', 3, 15, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `paid_leaves`, `emp_id`, `leave_condition`) VALUES
(5, 0, 63, 0),
(6, 0, 64, 0);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_cards`
--

INSERT INTO `payroll_cards` (`id`, `card_title`, `pay_rate`, `daily_hours`, `hrly_rate_chart`) VALUES
(15, '8 Hours card', 100, 8, '{\"sun0\":\"100%\",\"mon0\":\"127%\",\"tue0\":\"100%\",\"wed0\":\"100%\",\"thu0\":\"127%\",\"fri0\":\"127%\",\"sat0\":\"100%\",\"sun0pm\":\"100%\",\"mon0pm\":\"100%\",\"tue0pm\":\"100%\",\"wed0pm\":\"100%\",\"thu0pm\":\"100%\",\"fri0pm\":\"100%\",\"sat0pm\":\"100%\",\"special_hours\":{\"_am_ip_mon0\":\"127%\",\"_am_ip_thu0\":\"127%\",\"_am_ip_fri0\":\"127%\",\"_am_ip_mon1\":\"127%\",\"_am_ip_thu1\":\"127%\",\"_am_ip_fri1\":\"127%\",\"_am_ip_mon2\":\"127%\",\"_am_ip_thu2\":\"127%\",\"_am_ip_fri2\":\"127%\",\"_am_ip_mon3\":\"127%\",\"_am_ip_thu3\":\"127%\",\"_am_ip_fri3\":\"127%\",\"_am_ip_mon4\":\"127%\",\"_am_ip_thu4\":\"127%\",\"_am_ip_fri4\":\"127%\",\"_am_ip_mon5\":\"127%\",\"_am_ip_thu5\":\"127%\",\"_am_ip_fri5\":\"127%\",\"_am_ip_mon6\":\"127%\",\"_am_ip_thu6\":\"127%\",\"_am_ip_fri6\":\"127%\",\"_am_ip_mon7\":\"127%\",\"_am_ip_thu7\":\"127%\",\"_am_ip_fri7\":\"127%\",\"_am_ip_mon8\":\"127%\",\"_am_ip_thu8\":\"127%\",\"_am_ip_fri8\":\"127%\",\"_am_ip_mon9\":\"127%\",\"_am_ip_thu9\":\"127%\",\"_am_ip_fri9\":\"127%\",\"_am_ip_mon10\":\"127%\",\"_am_ip_thu10\":\"127%\",\"_am_ip_fri10\":\"127%\",\"_am_ip_mon11\":\"127%\",\"_am_ip_thu11\":\"127%\",\"_am_ip_fri11\":\"127%\"}}');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`id`, `emp_id`, `monthly_salary`, `calculated_salary`, `salary_type`, `per_hour_amount`) VALUES
(5, 63, 30000, 0, 'monthly', 0),
(6, 64, 30000, 0, 'monthly', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `location`) VALUES
(1, 'web developer', 4),
(2, 'Car painter', 4),
(3, 'Hostel web developers', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `location`, `name`) VALUES
(4, 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 'Showroom1'),
(5, 'Street No.1, G. E. C. H. S Phase 3 Muhammadpura, Lahore, Punjab 54600, Pakistan', 'Continental hostel');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_links`
--

DROP TABLE IF EXISTS `terminal_links`;
CREATE TABLE IF NOT EXISTS `terminal_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_links`
--

INSERT INTO `terminal_links` (`id`, `position_id`) VALUES
(2, 1),
(3, 1),
(4, 3);

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
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_clock`
--

INSERT INTO `time_clock` (`id`, `emp_clock_in`, `emp_clock_out`, `emp_loc`, `emp_id`, `clock_in_img`, `clock_out_img`, `emp_clock_out_loc`, `clock_pay`, `status`) VALUES
(325, '2019-01-21 10:10:06', '2019-01-21 20:11:46', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 63, 'clock_in325.jpeg', 'clock_out325.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 1320.9722222222, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clock_day_counter`
--
ALTER TABLE `clock_day_counter`
  ADD CONSTRAINT `clock_day_counter_ibfk_1` FOREIGN KEY (`clock_index`) REFERENCES `time_clock` (`id`),
  ADD CONSTRAINT `clock_day_counter_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`);

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
  ADD CONSTRAINT `terminal_links_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Constraints for table `time_clock`
--
ALTER TABLE `time_clock`
  ADD CONSTRAINT `time_clock_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
