-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2014 at 03:45 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hellolion`
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
('0a605a19ad72b621ae65d874a264f280', '::1', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36', 1414490544, 'a:5:{s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1413819977";}'),
('18012d89ea68632c98056576e59062f7', '::1', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1414634894, '');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL,
  `game_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='The game that we difine';

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
-- Stand-in structure for view `leaderboard`
--
CREATE TABLE IF NOT EXISTS `leaderboard` (
`id` int(11)
,`name` varchar(45)
,`points` int(11)
,`level` int(11)
,`rank` bigint(22)
);
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
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Store information for players. Work with "users" table when need authorization service. :)';

-- --------------------------------------------------------

--
-- Table structure for table `practice_day`
--

CREATE TABLE IF NOT EXISTS `practice_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `day_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Keep track of the day user will play/practice.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `skill_category`
--

CREATE TABLE IF NOT EXISTS `skill_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Categories (grammar, speaking, listening, writing, spelling, reading)' AUTO_INCREMENT=1 ;

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
(1, '\0\0', 'admin', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1414488687, 1, 'Super', 'Admin', 'ADMIN', '222-333-4444');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_master_skills`
--

CREATE TABLE IF NOT EXISTS `user_master_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT 'The bigger level, the better user skill.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This is calculated by the system to evaluate user skill.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE IF NOT EXISTS `user_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Define user skill that need to be improve. This is set by user.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `words_eng`
--

CREATE TABLE IF NOT EXISTS `words_eng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `definition` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `example` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sound_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sound_example_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_of_speech` int(11) DEFAULT NULL COMMENT '1 noun, 2 pronoun, 3 adjective, 4 determiner, 5 verb, 6 adverb, 7 preposition, 8 conjunction, and 9 interjection',
  `difficulty` int(11) DEFAULT '1' COMMENT '1 to 10. The bigger the more difficult.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Words table of English' AUTO_INCREMENT=136 ;

--
-- Dumping data for table `words_eng`
--

INSERT INTO `words_eng` (`id`, `word`, `definition`, `example`, `picture_url`, `sound_url`, `sound_example_url`, `part_of_speech`, `difficulty`) VALUES
(36, 'week', 'seven days a week', 'I''ve had a cold for one week, and I still haven''t got better.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10384_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4258.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/102573.mp3', 1, 1),
(37, 'year', 'leap year', 'There are 12 months in a year.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/14841_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3120.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4266.mp3', 1, 1),
(38, 'today', 'today at 6:15', 'I have a lot to do today.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10400_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88852.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3173.mp3', 1, 1),
(39, 'tomorrow', 'tomorrow afternoon', 'Tomorrow is my birthday.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10401_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88860.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3178.mp3', 1, 1),
(40, 'yesterday', 'yesterday afternoon', 'Yesterday was a holiday, so we had the day off.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10402_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88862.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3184.mp3', 1, 1),
(41, 'calendar', 'day calendar', 'I marked our anniversary on the calendar.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8294_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/262702.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/262704.mp3', 1, 1),
(42, 'hour', 'for one hour', 'I’ll be home from work in an hour.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/18747_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3248.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3251.mp3', 1, 1),
(43, 'minute', 'three minutes', 'There are sixty seconds in a minute.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10923_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3257.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3260.mp3', 1, 1),
(44, 'o''clock', '3 o’clock', 'School ends at 3 o’clock in the afternoon.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/7580_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87738.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3269.mp3', 6, 1),
(45, 'clock', 'alarm clock', 'The clock reads eight minutes to twelve.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8731_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/104222.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/253421.mp3', 1, 1),
(46, 'can', 'can eat', 'I can eat spicy food.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9008_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89127.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4100.mp3', 5, 1),
(47, 'use', 'use a computer', 'I use a computer for work.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17270_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4105.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4110.mp3', 5, 1),
(48, 'do', 'to do it all', 'I have so much work to do!', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9432_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3066.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3069.mp3', 5, 1),
(49, 'go', 'go to the park', 'It''s time for my sister to go to the airport.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9499_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3073.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3076.mp3', 5, 1),
(50, 'come', 'come early', 'Come here.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9189_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3106.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/254229.mp3', 5, 1),
(51, 'laugh', 'laugh at something funny', 'The mother and daughter are laughing.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9527_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306149.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/92418.mp3', 5, 1),
(52, 'make', 'make coffee', 'The man and woman make dinner every night.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8742_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4118.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4123.mp3', 5, 1),
(53, 'see', 'see a movie', 'She cannot see anything without her glasses.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17269_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4124.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/91299.mp3', 5, 1),
(54, 'far', 'far away', 'The station is far from here.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8065_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88444.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3388.mp3', 3, 1),
(55, 'small', 'small size', 'The car is small, but it''s very powerful.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9725_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88687.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2803.mp3', 3, 1),
(56, 'good', 'good for one''s body', 'She is a good person.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17033_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3004.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3005.mp3', 3, 1),
(57, 'beautiful', 'beautiful dress', 'She''s not only beautiful, but also very smart.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9658_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87475.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3826.mp3', 3, 1),
(58, 'ugly', 'ugly animal', 'That is a very ugly dog.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8197_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3843.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3844.mp3', 3, 1),
(59, 'difficult', 'very difficult', 'Wednesday''s test will be difficult.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17227_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4217.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4220.mp3', 3, 1),
(60, 'easy', 'easy problem', 'This problem is easy.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8717_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4224.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/253858.mp3', 3, 1),
(61, 'bad', 'bad news', 'He''s a bad boy.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8487_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3636.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3637.mp3', 3, 1),
(62, 'near', 'near the city', 'I live near the university.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9622_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/85485.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/85487.mp3', 3, 1),
(63, 'Nice to meet you.', NULL, 'Please come in, it''s nice to meet you.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9401_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89211.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2974.mp3', 10, 1),
(64, 'Hello.', NULL, 'When I first meet someone, I like to say, "Hello."', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17251_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88341.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2889.mp3', 10, 1),
(65, 'Good morning.', NULL, 'I always say, "Good evening,"to the people I meet on my way home from work.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17247_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88343.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2893.mp3', 10, 1),
(66, 'Good afternoon.', NULL, '"Good afternoon," is a greeting used from noon to early evening.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/3504_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88344.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2895.mp3', 10, 1),
(67, 'Good evening.', NULL, 'visiting friends after dinner usually leads to a good evening.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17246_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88345.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2897.mp3', 10, 1),
(68, 'Good night.', NULL, 'I said good night to everyone when I left the party.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17249_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88346.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/91167.mp3', 10, 1),
(69, 'How are you?', NULL, NULL, 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10083_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89209.mp3', NULL, 10, 1),
(70, 'Thank you!', NULL, 'Thank you very much for the invitation.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/14992_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/910067.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2911.mp3', 10, 1),
(71, 'No.', '"no" sign', 'No, thank you.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9431_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89112.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/65634.mp3', 10, 1),
(72, 'Delicious!', 'delicious deserts', 'Your mother makes the most delicious pies I have ever eaten.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10146_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89203.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2979.mp3', 10, 1),
(73, 'I''m...(name).', NULL, NULL, 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9898_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87588.mp3', NULL, 10, 1),
(74, 'Goodbye.', NULL, NULL, 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17250_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/2907.mp3', NULL, 10, 1),
(75, 'Yes.', NULL, NULL, 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17257_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/85479.mp3', NULL, 10, 1),
(76, 'Monday', 'Monday the 12th', 'The workweek starts on Monday.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9732_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87724.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3135.mp3', 1, 1),
(77, 'Tuesday', 'Tuesday next week', 'Monday, Tuesday, Wednesday, Thursday and Friday are weekdays.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9309_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87726.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90274.mp3', 1, 1),
(78, 'Wednesday', 'Wednesday the 18th', 'Wednesday nights we play poker at my house.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8832_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87725.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3146.mp3', 1, 1),
(79, 'Thursday', 'on Thursday', 'Monday, Tuesday, Wednesday, Thursday and Friday are weekdays.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8439_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87729.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90274.mp3', 1, 1),
(80, 'Friday', 'Friday, December 8th', 'Monday, Tuesday, Wednesday, Thursday and Friday are weekdays.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9319_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87727.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90274.mp3', 1, 1),
(81, 'Saturday', 'Saturday night', 'I do housework every Saturday for five hours.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8657_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87728.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3164.mp3', 1, 1),
(82, 'Sunday', 'Sunday morning breakfast', 'We like to sleep late on Sunday mornings.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/15509_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3166.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3169.mp3', 1, 1),
(83, 'May', 'May flowers', 'It is now April so next month will be May.', 'http://3.bp.blogspot.com/-lLpU2b8N280/TbgqbY2PLkI/AAAAAAAABu8/xn036f8Yma0/s400/i-love-may-128397014340.png', 'http://cdn.innovativelanguage.com/wordlists/audio/88308.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3199.mp3', 11, 1),
(84, 'January', 'Thursday, January 3rd', 'It''s very cold here in January.', 'http://maithancailin.files.wordpress.com/2014/01/hello-january.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3207.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3788.mp3', 11, 1),
(85, 'February', 'February 29th', 'February is the shortest month with 28 days.', 'http://1.bp.blogspot.com/-bo1Vv6mzOFA/Tz1Op56E46I/AAAAAAAABBA/yHFM5aCtOBc/s1600/feb.gif', 'http://cdn.innovativelanguage.com/wordlists/audio/3210.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3212.mp3', 11, 1),
(86, 'March', 'March 17th', 'It is now April so last month was March.', 'http://i2.wp.com/uiwlogos.org/wp-content/uploads/2014/03/march_10080c.jpg?resize=636%2C310', 'http://cdn.innovativelanguage.com/wordlists/audio/3204.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3196.mp3', 11, 1),
(87, 'April', 'April first', 'It is now April so next month will be May.', 'http://thesportsbrat.com/wp-content/uploads/2014/03/FND_April-Fools_s4x3_lead.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3214.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3199.mp3', 11, 1),
(88, 'June', 'June wedding', 'There are a large number of weddings in June, as some think its a lucky month for love.', 'http://batool.com.pk/wp-content/uploads/2013/05/june.png', 'http://cdn.innovativelanguage.com/wordlists/audio/3218.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3220.mp3', 11, 1),
(89, 'July', 'month of July', 'July is one of 7 months with 31 days.', 'http://www.seniorcarectrs.com/wp-content/uploads/2014/06/red-white-blue-july-1.png', 'http://cdn.innovativelanguage.com/wordlists/audio/3221.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3223.mp3', 11, 1),
(90, 'August', 'hot August day', 'It''s usually hot in August, but today it''s really hot.', 'http://cocomsp.com/wp-content/uploads/2013/07/August.png', 'http://cdn.innovativelanguage.com/wordlists/audio/3225.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3796.mp3', 11, 1),
(91, 'September', 'September 1st', 'Today is Saturday, September 10th.', 'http://www.torindiegalaxien.de/0914/September.png', 'http://cdn.innovativelanguage.com/wordlists/audio/3228.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3175.mp3', 11, 1),
(92, 'October', 'on October 13th', 'Halloween falls on October 31st.', 'http://www.colorprintingcentral.com/blog/wp-content/uploads/2013/10/october-month-halloween.png', 'http://cdn.innovativelanguage.com/wordlists/audio/3231.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3233.mp3', 11, 1),
(93, 'November', 'Thanksgiving, Thursday November 24th', 'November is one of four months with thirty days.', 'http://batool.com.pk/wp-content/uploads/2013/05/november1.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3234.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3236.mp3', 11, 1),
(94, 'December', 'December 25th', 'December 31st is New Year''s Eve.', 'http://www.mymcpl.org/_uploaded_resources/december.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3237.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3239.mp3', 11, 1),
(95, 'zero', 'fall below zero degrees Celsius', 'It''s about zero degrees today.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10304_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87285.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3469.mp3', 1, 1),
(96, 'one', 'one hour', 'There are twenty-four hours in one day.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8873_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88316.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4256.mp3', 1, 1),
(97, 'two', 'two arms', 'I have two (2) arms and two (2) legs.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9077_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88317.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/104025.mp3', 1, 1),
(98, 'three', 'number three', 'The first group arrived on bus number three.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9718_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88318.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90747.mp3', 1, 1),
(99, 'four', 'number four', 'November is one of four months with thirty days.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9466_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88319.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3236.mp3', 1, 1),
(100, 'five', 'number five', 'The starfish has five legs.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8167_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88320.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/198022.mp3', 1, 1),
(101, 'six', 'six inches', 'I wake up every morning at six o''clock a.m.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9140_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88321.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/305963.mp3', 1, 1),
(102, 'seven', 'seven days a week', 'There are seven (7) days in every week.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9424_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88322.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/102572.mp3', 1, 1),
(103, 'eight', 'eight times', 'You should sleep at least eight hours every night.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9473_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88323.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/91556.mp3', 1, 1),
(104, 'nine', 'number nine', 'The plane will take off at nine o''clock.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8833_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88324.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2708.mp3', 1, 1),
(105, 'ten', 'number ten', 'I can count from one to ten in Chinese.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9088_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4322.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4102.mp3', 1, 1),
(106, 'coffee', 'cup of coffee', 'I start each day with a cup of coffee.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9158_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87753.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4561.mp3', 1, 1),
(107, 'beer', 'bottle of beer', 'The bartender is pouring a draft beer.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8700_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87754.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/105880.mp3', 1, 1),
(108, 'tea', 'tea bag', 'Tea is a popular drink throughout the world.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17286_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87763.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4602.mp3', 1, 1),
(109, 'wine', 'white wine', 'You drink red wine with meat, and white wine with fish.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/12080_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/4609.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4615.mp3', 1, 1),
(110, 'water', 'drink water', 'The man is drinking from the water bottle.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9628_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/305977.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/305978.mp3', 1, 1),
(111, 'beef', 'beef steak', 'Tonight''s choices are beef or chicken.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8664_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87894.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4701.mp3', 1, 1),
(112, 'pork', 'pork chops', 'Eating pork is forbidden by a number of religions.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8081_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87895.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/87106.mp3', 1, 1),
(113, 'chicken', 'chicken leg', 'Chicken or fish?', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10126_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306130.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4921.mp3', 1, 1),
(114, 'lamb', 'lamb chops', 'Lamb is extremely delicious.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/15190_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/89195.mp3', '', 1, 1),
(115, 'fish', 'raw fish', 'Fish is an important food source for people.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/10023_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/87889.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4693.mp3', 1, 1),
(116, 'foot', 'right foot', 'A foot has five toes.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8374_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88200.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3851.mp3', 1, 1),
(117, 'leg', 'long legs', 'The woman is  rinsing her leg.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8542_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/262976.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3869.mp3', 1, 1),
(118, 'head', 'head and neck', 'Wear a helmet to protect your head.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9133_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3876.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/262977.mp3', 1, 1),
(119, 'arm', 'muscular arm', 'The two arms are raised.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9562_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/310921.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/197907.mp3', 1, 1),
(120, 'hand', 'left hand', 'The child is raising his hand.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8317_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88939.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/89916.mp3', 1, 1),
(121, 'finger', 'five fingers', 'The finger is pressed against the glass.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9323_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88940.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/197909.mp3', 1, 1),
(122, 'body', 'body and soul', 'Food is fuel for the body.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8181_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3929.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3931.mp3', 1, 1),
(123, 'stomach', 'model of a stomach', 'I ate too much, and now my stomach hurts.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8438_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/3938.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/3943.mp3', 1, 1),
(124, 'back', 'back muscles', 'A hedgehog''s back is covered in sharp spines.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/2127_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/92254.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/262982.mp3', 1, 1),
(125, 'chest', 'X-ray of a chest', 'The doctor and nurse are taking an X-ray of the patient''s chest.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8815_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/106570.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/197912.mp3', 1, 1),
(126, 'nurse', 'male nurse', 'The nurse at the school infirmary is examining the student.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9349_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88502.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/198006.mp3', 1, 1),
(127, 'employee', 'employee benefits', 'The employees are having a meeting in the boardroom.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/15526_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306113.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/197977.mp3', 1, 1),
(128, 'police officer', 'police officer', 'The job of a police officer is to protect and serve the public.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8975_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88497.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90640.mp3', 1, 1),
(129, 'cook', 'head cook', 'We hired a new cook for the hotel restaurant.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8032_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306127.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/90642.mp3', 1, 1),
(130, 'engineer', 'civil engineer', 'A good engineer can design and build systems.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/19050_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88506.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2200.mp3', 1, 1),
(131, 'doctor', 'see a doctor', 'I am a doctor.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8125_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/88507.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/4938.mp3', 1, 1),
(132, 'manager', 'department manager', 'The department manager is in charge of production.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/17412_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306119.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2142.mp3', 1, 1),
(133, 'teacher', 'English teacher', 'The teacher is teaching the kids in the classroom.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9229_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/306031.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2228.mp3', 1, 1),
(134, 'programmer', 'computer programmer', 'Some programmers work from home, so they don''t have to commute to work.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/8595_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/2235.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2239.mp3', 1, 1),
(135, 'salesman', 'car salesman', 'Good salesmen are critical for the company''s success.', 'http://cdn.innovativelanguage.com/wordlists/media/thumb/9477_90s_.jpg', 'http://cdn.innovativelanguage.com/wordlists/audio/263201.mp3', 'http://cdn.innovativelanguage.com/wordlists/audio/2244.mp3', 1, 1);

-- --------------------------------------------------------

--
-- Structure for view `leaderboard`
--
DROP TABLE IF EXISTS `leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`developer`@`%` SQL SECURITY DEFINER VIEW `leaderboard` AS select `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`points` AS `points`,`p`.`level` AS `level`,(1 + (select count(0) from `players` `r` where (`p`.`points` < `r`.`points`))) AS `rank` from `players` `p` order by `rank`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
