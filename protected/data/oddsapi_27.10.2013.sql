-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2013 at 05:56 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oddsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE IF NOT EXISTS `sport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `link` varchar(256) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`id`, `name`, `link`, `active`) VALUES
(1, 'Football', 'https://www.interwetten.com/en/sportsbook/o/10/football', 0),
(2, 'Tennis', 'https://www.interwetten.com/en/sportsbook/o/11/tennis', 0),
(3, 'Ice hockey', 'https://www.interwetten.com/en/sportsbook/o/40/ice-hockey', 0),
(4, 'Basketball', 'https://www.interwetten.com/en/sportsbook/o/15/basketball', 0),
(5, 'Baseball', 'https://www.interwetten.com/en/sportsbook/l/14233/mlb', 0),
(6, 'Handball', 'https://www.interwetten.com/en/sportsbook/o/1002/handball', 0),
(7, 'Motorbike', 'https://www.interwetten.com/en/sportsbook/o/1011/motorbike', 0),
(8, 'American football', 'https://www.interwetten.com/en/sportsbook/o/13/american-football', 1),
(9, 'Volleyball', 'https://www.interwetten.com/en/sportsbook/o/1012/volleyball', 0),
(10, 'Golf', 'https://www.interwetten.com/en/sportsbook/l/405262/ryder-cup-2014', 0),
(11, 'Rugbu', 'https://www.interwetten.com/en/sportsbook/o/1003/rugby', 0),
(12, 'Australian Rules Football', 'https://www.interwetten.com/en/sportsbook/l/405647/afl', 0),
(13, 'Alpine skiing', 'https://www.interwetten.com/en/sportsbook/l/200/world-cup', 0),
(14, 'Futsal', 'https://www.interwetten.com/en/sportsbook/l/406389/brazil-liga-futsal-40', 0),
(15, 'Biathlon', 'https://www.interwetten.com/en/sportsbook/l/406141/world-cup-competitions', 0),
(16, 'Superbike', 'https://www.interwetten.com/en/sportsbook/l/406158/superbike', 0),
(17, 'Nordic skiing', 'https://www.interwetten.com/en/sportsbook/l/405297/skijumping', 0),
(18, 'Lacrosse', 'https://www.interwetten.com/en/sportsbook/l/406119/nll', 0),
(19, 'Diving', 'https://www.interwetten.com/en/sportsbook/l/405960/cliff-diving-world-series', 0),
(20, 'Cricket', 'https://www.interwetten.com/en/sportsbook/l/405987/the-ashes', 0),
(21, 'Pool', 'https://www.interwetten.com/en/sportsbook/l/406030/mosconi-cup', 0),
(22, 'Darts', 'https://www.interwetten.com/en/sportsbook/l/405510/pdc-world-championship', 0),
(23, 'Boxing', 'https://www.interwetten.com/en/sportsbook/l/90/boxing', 0),
(24, 'Entertainment', 'https://www.interwetten.com/en/sportsbook/l/405709/schlag-den-raab', 0),
(25, 'Poker', 'https://www.interwetten.com/en/sportsbook/l/405831/wsop-main-event', 0),
(26, 'Sailing', 'https://www.interwetten.com/en/sportsbook/l/405637/americas-cup', 0),
(27, 'Chess', 'https://www.interwetten.com/en/sportsbook/l/406893/world-chess-championships-2013', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stack`
--

CREATE TABLE IF NOT EXISTS `stack` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `opponent` varchar(256) DEFAULT NULL COMMENT 'home_team vs guest_team',
  `start` datetime DEFAULT NULL,
  `data` text,
  `tournament_id` int(10) unsigned NOT NULL,
  `cron` smallint(6) NOT NULL DEFAULT '0',
  `cron_time` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tournament_id` (`tournament_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `link` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sport_id` int(10) unsigned NOT NULL,
  `special` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `oauth_provider` varchar(32) DEFAULT NULL,
  `oauth_uid` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `date_created`, `active`, `oauth_provider`, `oauth_uid`) VALUES
(10, 'admin', '$2a$12$HDt1bErn692T3Bmtr7qwpetJWIi59XyojI9aQBGzGPkxTj.FV4kQG', 'Mile Janev', 'admin@oddsleaders.com', '2013-10-27 16:54:15', 0, '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stack`
--
ALTER TABLE `stack`
  ADD CONSTRAINT `stack_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
