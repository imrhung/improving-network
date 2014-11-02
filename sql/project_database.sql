-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2014 at 11:11 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_sessions`
--

CREATE TABLE IF NOT EXISTS `app_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_sessions`
--

INSERT INTO `app_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('e3bbc57b6dacb9450fa91ac406eb8310', '::1', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36', 1400399258, 'a:5:{s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1400341544";}');

-- --------------------------------------------------------

--
-- Table structure for table `area_info`
--

CREATE TABLE IF NOT EXISTS `area_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_photo_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Simple table keep information of the area.' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `area_info`
--

INSERT INTO `area_info` (`id`, `phone_number`, `header_photo_url`, `description`) VALUES
(1, '1234567890', 'http://localhost/greatertraveler/assets/upload/logo-small.jpg', 'We help you');

-- --------------------------------------------------------

--
-- Table structure for table `business_directory`
--

CREATE TABLE IF NOT EXISTS `business_directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_address` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `renew` binary(1) DEFAULT '0',
  `yearly_membership` int(11) DEFAULT '0',
  `mem_to_mem_description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mem_to_mem_image_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prepay_meal` binary(1) DEFAULT '0',
  `business_description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT '1',
  `register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `chamber_category_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Main table for all business directory.' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `business_directory`
--

INSERT INTO `business_directory` (`id`, `business_name`, `first_name`, `last_name`, `mail_address`, `city`, `state`, `email`, `phone_number`, `website`, `renew`, `yearly_membership`, `mem_to_mem_description`, `mem_to_mem_image_url`, `prepay_meal`, `business_description`, `category_id`, `register_date`) VALUES
(1, 'Nha Hang 234', 'Nguyen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, NULL, NULL, '0', NULL, 1, NULL),
(2, 'Nha Hang', 'Nguyen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, NULL, NULL, '0', NULL, 1, '2014-05-18 05:00:20'),
(3, 'Nha Hang', 'Nguyen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, NULL, NULL, '0', NULL, 1, '2014-05-18 05:02:09'),
(4, 'Nha Hang', 'Nguyen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, NULL, NULL, '0', NULL, 1, '2014-05-18 05:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_category`
--

CREATE TABLE IF NOT EXISTS `chamber_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Category for chamber' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `chamber_category`
--

INSERT INTO `chamber_category` (`id`, `category_name`) VALUES
(1, 'No Category'),
(2, 'Food'),
(3, 'Beverage'),
(7, 'Fruit');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'admin', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1400397311, 1, 'Super', 'Admin', 'ADMIN', '222-333-4444');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_directory`
--
ALTER TABLE `business_directory`
  ADD CONSTRAINT `chamber_category` FOREIGN KEY (`category_id`) REFERENCES `chamber_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
