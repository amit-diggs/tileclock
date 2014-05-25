-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2014 at 09:44 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phaseii`
--
CREATE DATABASE `phaseii` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phaseii`;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `bg_color` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_name`, `bg_color`, `status`, `created_by`, `created`) VALUES
(1, 'Tile Clock', '#00549a', 0, 1, '2014-05-19 10:02:46'),
(2, 'Bass Brush', '#00549a', 0, 1, '2014-05-19 10:03:19'),
(3, 'Balini', '#00549a', 0, 1, '2014-05-19 10:03:45'),
(4, 'Acti8Vapor', '#00549a', 0, 1, '2014-05-19 10:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `tiles`
--

CREATE TABLE IF NOT EXISTS `tiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `in_date` date NOT NULL,
  `in_time` varchar(50) NOT NULL,
  `out_date` varchar(50) NOT NULL,
  `out_time` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tiles`
--

INSERT INTO `tiles` (`id`, `job_id`, `emp_id`, `in_date`, `in_time`, `out_date`, `out_time`, `status`, `created_by`, `created`) VALUES
(1, 1, 2, '2014-05-19', '11:19:25 PM', '2014-05-19', '11:47:33 PM', 0, 1, '2014-05-19 10:19:26'),
(2, 2, 2, '2014-05-19', '11:09:33 PM', '2014-05-20', '12:10:09 AM', 0, 1, '2014-05-19 10:47:34'),
(3, 1, 2, '2014-05-24', '07:28:34 PM', '', '', 1, 1, '2014-05-24 06:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `user_type` enum('admin','user') DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT '0',
  `email_token` varchar(128) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `address` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `hourly_rate` float NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_token`, `first_name`, `last_name`, `email_address`, `user_type`, `created_by`, `email_verified`, `email_token`, `email_token_expires`, `address`, `location`, `hourly_rate`, `status`, `created`) VALUES
(1, 'amit', 'e3f3cc28ea34b56bf243fa42305dc49188d78f7c', NULL, 'Amit', 'Chowdhury', 'amit3j2003@gmail.com', 'admin', 0, 0, NULL, NULL, 'as', 'Asia/Dhaka', 20, 0, '2014-05-17 09:23:21'),
(2, 'amit.chowdhu', 'e3f3cc28ea34b56bf243fa42305dc49188d78f7c', NULL, 'Amit', 'Chowdhury', 'amit3j2003@yahoo.com', 'user', 1, 0, NULL, NULL, 'Dhaka', 'Asia/Dhaka', 25, 0, '2014-05-18 03:47:50'),
(3, 'neamul', 'e3f3cc28ea34b56bf243fa42305dc49188d78f7c', NULL, 'Neamul', 'Hasan', 'neamul@gmail.com', 'user', 1, 0, NULL, NULL, 'Dhaka', 'Asia/Dhaka', 20, 0, '2014-05-18 10:06:58'),
(5, NULL, 'e3f3cc28ea34b56bf243fa42305dc49188d78f7c', NULL, 'Ujjal', 'Hossen', 'ujjal@gmail.com', 'user', 1, 0, NULL, NULL, '203,204 Malibagh', 'Asia/Dhaka', 25, 0, '2014-05-23 10:17:39');
