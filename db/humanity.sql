-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2019 at 10:34 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email_addr`, `phone_no`, `password`, `emp_image`, `role`, `position`, `payroll_card`, `total_pay`) VALUES
(45, 'test', 'admin', 'admin@gmail.com', '03035787036', 'd2VsY29tZQ==', '48381465_355644638322851_7153055705484754944_n.jpg', 'superadmin', 0, NULL, 0),
(66, 'Ali', 'Raza', 'aliraza@gmail.com', '03037645434', 'cXc0aGRkcWNyZw==', 'employee66.jpg', '', 4, 15, 0),
(67, 'Abdul', 'Rehman', 'abdulrehman@gmail.com', '03037645433', 'cXc0aGRkcWNyZw==', 'employee67.jpg', '', 5, 15, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `paid_leaves`, `emp_id`, `leave_condition`) VALUES
(8, 0, 66, 0),
(9, 0, 67, 0);

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

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `name`, `description`) VALUES
(1, 'sdfsdf', 'sample details'),
(2, 'sdfsdf', 'sample details'),
(5, 'This is sample name', 'This is sample description '),
(6, 'This is sample name', 'This is sample description '),
(7, 'This is sample name', 'This is sample description ');

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
(15, '8 Hours card', 100, 8, '{\"sun0\":\"127%\",\"mon0\":\"127%\",\"tue0\":\"127%\",\"wed0\":\"127%\",\"thu0\":\"127%\",\"fri0\":\"127%\",\"sat0\":\"127%\",\"sun0pm\":\"127%\",\"mon0pm\":\"127%\",\"tue0pm\":\"127%\",\"wed0pm\":\"127%\",\"thu0pm\":\"127%\",\"fri0pm\":\"127%\",\"sat0pm\":\"127%\",\"special_hours\":{\"_am_ip_sun0\":\"127%\",\"_am_ip_mon0\":\"127%\",\"_am_ip_tue0\":\"127%\",\"_am_ip_wed0\":\"127%\",\"_am_ip_thu0\":\"127%\",\"_am_ip_fri0\":\"127%\",\"_am_ip_sat0\":\"127%\",\"_am_ip_sun1\":\"127%\",\"_am_ip_mon1\":\"127%\",\"_am_ip_tue1\":\"127%\",\"_am_ip_wed1\":\"127%\",\"_am_ip_thu1\":\"127%\",\"_am_ip_fri1\":\"127%\",\"_am_ip_sat1\":\"127%\",\"_am_ip_sun2\":\"127%\",\"_am_ip_mon2\":\"127%\",\"_am_ip_tue2\":\"127%\",\"_am_ip_wed2\":\"127%\",\"_am_ip_thu2\":\"127%\",\"_am_ip_fri2\":\"127%\",\"_am_ip_sat2\":\"127%\",\"_am_ip_sun3\":\"127%\",\"_am_ip_mon3\":\"127%\",\"_am_ip_tue3\":\"127%\",\"_am_ip_wed3\":\"127%\",\"_am_ip_thu3\":\"127%\",\"_am_ip_fri3\":\"127%\",\"_am_ip_sat3\":\"127%\",\"_am_ip_sun4\":\"127%\",\"_am_ip_mon4\":\"127%\",\"_am_ip_tue4\":\"127%\",\"_am_ip_wed4\":\"127%\",\"_am_ip_thu4\":\"127%\",\"_am_ip_fri4\":\"127%\",\"_am_ip_sat4\":\"127%\",\"_am_ip_sun5\":\"127%\",\"_am_ip_mon5\":\"127%\",\"_am_ip_tue5\":\"127%\",\"_am_ip_wed5\":\"127%\",\"_am_ip_thu5\":\"127%\",\"_am_ip_fri5\":\"127%\",\"_am_ip_sat5\":\"127%\",\"_am_ip_sun6\":\"127%\",\"_am_ip_mon6\":\"127%\",\"_am_ip_tue6\":\"127%\",\"_am_ip_wed6\":\"127%\",\"_am_ip_thu6\":\"127%\",\"_am_ip_fri6\":\"127%\",\"_am_ip_sat6\":\"127%\",\"_am_ip_sun7\":\"127%\",\"_am_ip_mon7\":\"127%\",\"_am_ip_tue7\":\"127%\",\"_am_ip_wed7\":\"127%\",\"_am_ip_thu7\":\"127%\",\"_am_ip_fri7\":\"127%\",\"_am_ip_sat7\":\"127%\",\"_am_ip_sun8\":\"127%\",\"_am_ip_mon8\":\"127%\",\"_am_ip_tue8\":\"127%\",\"_am_ip_wed8\":\"127%\",\"_am_ip_thu8\":\"127%\",\"_am_ip_fri8\":\"127%\",\"_am_ip_sat8\":\"127%\",\"_am_ip_sun9\":\"127%\",\"_am_ip_mon9\":\"127%\",\"_am_ip_tue9\":\"127%\",\"_am_ip_wed9\":\"127%\",\"_am_ip_thu9\":\"127%\",\"_am_ip_fri9\":\"127%\",\"_am_ip_sat9\":\"127%\",\"_am_ip_sun10\":\"127%\",\"_am_ip_mon10\":\"127%\",\"_am_ip_tue10\":\"127%\",\"_am_ip_wed10\":\"127%\",\"_am_ip_thu10\":\"127%\",\"_am_ip_fri10\":\"127%\",\"_am_ip_sat10\":\"127%\",\"_am_ip_sun11\":\"127%\",\"_am_ip_mon11\":\"127%\",\"_am_ip_tue11\":\"127%\",\"_am_ip_wed11\":\"127%\",\"_am_ip_thu11\":\"127%\",\"_am_ip_fri11\":\"127%\",\"_am_ip_sat11\":\"127%\",\"_pm_ip_sun12\":\"127%\",\"_pm_ip_mon12\":\"127%\",\"_pm_ip_tue12\":\"127%\",\"_pm_ip_wed12\":\"127%\",\"_pm_ip_thu12\":\"127%\",\"_pm_ip_fri12\":\"127%\",\"_pm_ip_sat12\":\"127%\",\"_pm_ip_sun13\":\"127%\",\"_pm_ip_mon13\":\"127%\",\"_pm_ip_tue13\":\"127%\",\"_pm_ip_wed13\":\"127%\",\"_pm_ip_thu13\":\"127%\",\"_pm_ip_fri13\":\"127%\",\"_pm_ip_sat13\":\"127%\",\"_pm_ip_sun14\":\"127%\",\"_pm_ip_mon14\":\"127%\",\"_pm_ip_tue14\":\"127%\",\"_pm_ip_wed14\":\"127%\",\"_pm_ip_thu14\":\"127%\",\"_pm_ip_fri14\":\"127%\",\"_pm_ip_sat14\":\"127%\",\"_pm_ip_sun15\":\"127%\",\"_pm_ip_mon15\":\"127%\",\"_pm_ip_tue15\":\"127%\",\"_pm_ip_wed15\":\"127%\",\"_pm_ip_thu15\":\"127%\",\"_pm_ip_fri15\":\"127%\",\"_pm_ip_sat15\":\"127%\",\"_pm_ip_sun16\":\"127%\",\"_pm_ip_mon16\":\"127%\",\"_pm_ip_tue16\":\"127%\",\"_pm_ip_wed16\":\"127%\",\"_pm_ip_thu16\":\"127%\",\"_pm_ip_fri16\":\"127%\",\"_pm_ip_sat16\":\"127%\",\"_pm_ip_sun17\":\"127%\",\"_pm_ip_mon17\":\"127%\",\"_pm_ip_tue17\":\"127%\",\"_pm_ip_wed17\":\"127%\",\"_pm_ip_thu17\":\"127%\",\"_pm_ip_fri17\":\"127%\",\"_pm_ip_sat17\":\"127%\",\"_pm_ip_sun18\":\"127%\",\"_pm_ip_mon18\":\"127%\",\"_pm_ip_tue18\":\"127%\",\"_pm_ip_wed18\":\"127%\",\"_pm_ip_thu18\":\"127%\",\"_pm_ip_fri18\":\"127%\",\"_pm_ip_sat18\":\"127%\",\"_pm_ip_sun19\":\"127%\",\"_pm_ip_mon19\":\"127%\",\"_pm_ip_tue19\":\"127%\",\"_pm_ip_wed19\":\"127%\",\"_pm_ip_thu19\":\"127%\",\"_pm_ip_fri19\":\"127%\",\"_pm_ip_sat19\":\"127%\",\"_pm_ip_sun20\":\"127%\",\"_pm_ip_mon20\":\"127%\",\"_pm_ip_tue20\":\"127%\",\"_pm_ip_wed20\":\"127%\",\"_pm_ip_thu20\":\"127%\",\"_pm_ip_fri20\":\"127%\",\"_pm_ip_sat20\":\"127%\",\"_pm_ip_sun21\":\"127%\",\"_pm_ip_mon21\":\"127%\",\"_pm_ip_tue21\":\"127%\",\"_pm_ip_wed21\":\"127%\",\"_pm_ip_thu21\":\"127%\",\"_pm_ip_fri21\":\"127%\",\"_pm_ip_sat21\":\"127%\",\"_pm_ip_sun22\":\"127%\",\"_pm_ip_mon22\":\"127%\",\"_pm_ip_tue22\":\"127%\",\"_pm_ip_wed22\":\"127%\",\"_pm_ip_thu22\":\"127%\",\"_pm_ip_fri22\":\"127%\",\"_pm_ip_sat22\":\"127%\",\"_pm_ip_sun23\":\"127%\",\"_pm_ip_mon23\":\"127%\",\"_pm_ip_tue23\":\"127%\",\"_pm_ip_wed23\":\"127%\",\"_pm_ip_thu23\":\"127%\",\"_pm_ip_fri23\":\"127%\",\"_pm_ip_sat23\":\"127%\"}}');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`id`, `emp_id`, `monthly_salary`, `calculated_salary`, `salary_type`, `per_hour_amount`) VALUES
(8, 66, 30000, 0, 'monthly', 0),
(9, 67, 30000, 0, 'monthly', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `location`) VALUES
(4, 'Web Developers', 7),
(5, 'Car Painter', 8),
(6, 'Electrical Engineer', 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `location`, `name`) VALUES
(7, 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 'Showroom'),
(8, 'Abbaseen Ave, Block F 1 Wapda Town Phase 1 WAPDA Town, Lahore, Punjab, Pakistan', 'Fectory'),
(9, 'Unnamed Road, Mazang, Lahore, Punjab 54000, Pakistan', 'Friend hostel');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_links`
--

INSERT INTO `terminal_links` (`id`, `positions`, `location_id`, `link_type`) VALUES
(31, '[\"{\\\"position\\\":{\\\"id\\\":\\\"4\\\",\\\"name\\\":\\\"Web Developers\\\"}}\",\"{\\\"position\\\":{\\\"id\\\":\\\"5\\\",\\\"name\\\":\\\"Car Painter\\\"}}\"]', 7, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_clock`
--

INSERT INTO `time_clock` (`id`, `emp_clock_in`, `emp_clock_out`, `emp_loc`, `emp_id`, `clock_in_img`, `clock_out_img`, `emp_clock_out_loc`, `clock_pay`, `status`, `special_overtime`) VALUES
(386, '2019-01-30 19:26:03', '2019-01-30 19:26:20', '1 Punj Mahal Rd, Mazang, Lahore, Punjab 54000, Pakistan', 66, 'clock_in386.jpeg', 'clock_out386.jpeg', '1 Punj Mahal Rd, Mazang, Lahore, Punjab 54000, Pakistan', 0.59027777777778, 1, 0),
(392, '2019-02-01 00:00:00', '2019-02-02 08:51:37', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 66, 'clock_in392.jpeg', 'clock_out392.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 4107.5347222222, 1, 270);

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
