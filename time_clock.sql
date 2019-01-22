-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2019 at 11:03 AM
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
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_clock`
--

INSERT INTO `time_clock` (`id`, `emp_clock_in`, `emp_clock_out`, `emp_loc`, `emp_id`, `clock_in_img`, `clock_out_img`, `emp_clock_out_loc`, `clock_pay`) VALUES
(210, '2019-01-05 15:19:12', '2019-01-05 15:19:30', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 52, 'clock_in210.jpeg', 'clock_out210.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.48148148148148),
(211, '2019-01-05 15:20:01', '2019-01-05 15:20:16', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 52, 'clock_in211.jpeg', 'clock_out211.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.40123456790123),
(212, '2019-01-05 15:21:01', '2019-01-05 15:21:27', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 52, 'clock_in212.jpeg', 'clock_out212.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.69547325102881),
(213, '2019-01-05 15:23:28', '2019-01-05 15:23:46', '112 Tipu Block? Shakir Ali Ln, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 53, 'clock_in213.jpeg', 'clock_out213.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.335),
(214, '2019-01-05 15:24:23', '2019-01-05 15:24:53', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 53, 'clock_in214.jpeg', 'clock_out214.jpeg', 'Plot 52, Tipu Block Garden Town, Lahore, Punjab, Pakistan', 0.55833333333333);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time_clock`
--
ALTER TABLE `time_clock`
  ADD CONSTRAINT `time_clock_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
