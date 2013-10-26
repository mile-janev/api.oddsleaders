-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2013 at 02:24 PM
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
(8, 'American football', 'https://www.interwetten.com/en/sportsbook/o/13/american-football', 0),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `stack`
--

INSERT INTO `stack` (`id`, `link`, `opponent`, `start`, `data`, `tournament_id`, `cron`, `cron_time`, `date_created`) VALUES
(32, 'https://www.interwetten.com/en/sportsbook/e/9859432/cuatro-rayas-valladolid-juanfersa-grupo-fegar', NULL, NULL, NULL, 750, 0, NULL, '2013-10-26 14:07:35'),
(33, 'https://www.interwetten.com/en/sportsbook/e/9859431/helvetia-anaitasuna-globalcaja-ciudad-encantada', NULL, NULL, NULL, 750, 0, NULL, '2013-10-26 14:07:35'),
(34, 'https://www.interwetten.com/en/sportsbook/e/9859254/redbergslids-ik-ifk-kristianstad', NULL, NULL, NULL, 751, 0, NULL, '2013-10-26 14:07:40'),
(35, 'https://www.interwetten.com/en/sportsbook/e/9859868/hammarby-önnereds-hk', NULL, NULL, NULL, 751, 0, NULL, '2013-10-26 14:07:40'),
(36, 'https://www.interwetten.com/en/sportsbook/e/9859957/h-43-lund-rimbo-hk-roslagen', NULL, NULL, NULL, 751, 0, NULL, '2013-10-26 14:07:40'),
(37, 'https://www.interwetten.com/en/sportsbook/e/9859958/ystads-if-hf-alingsas', NULL, NULL, NULL, 751, 0, NULL, '2013-10-26 14:07:40'),
(38, 'https://www.interwetten.com/en/sportsbook/e/9860069/ifk-skovde-hk-lugi-hf', NULL, NULL, NULL, 751, 0, NULL, '2013-10-26 14:07:40'),
(39, 'https://www.interwetten.com/en/sportsbook/e/9858779/ribe-esbjerg-hh-skanderborg', NULL, NULL, NULL, 752, 0, NULL, '2013-10-26 14:07:44'),
(40, 'https://www.interwetten.com/en/sportsbook/e/9858828/sönderjyske-århus-gf', NULL, NULL, NULL, 752, 0, NULL, '2013-10-26 14:07:44'),
(41, 'https://www.interwetten.com/en/sportsbook/e/9858829/tms-ringsted-skjern-handball', NULL, NULL, NULL, 752, 0, NULL, '2013-10-26 14:07:44'),
(42, 'https://www.interwetten.com/en/sportsbook/e/9859253/kif-kolding-nordsjaelland', NULL, NULL, NULL, 752, 0, NULL, '2013-10-26 14:07:44'),
(43, 'https://www.interwetten.com/en/sportsbook/e/9859937/hf-mors-aab-handball', NULL, NULL, NULL, 752, 0, NULL, '2013-10-26 14:07:44');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=753 ;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `link`, `active`, `sport_id`, `special`) VALUES
(743, 'European Championships Men 2014 in Denmark', 'https://www.interwetten.com/en/sportsbook/l/405223/european-championships-men-2014-in-denmark', 1, 6, 1),
(744, 'European Championship Qualification Women', 'https://www.interwetten.com/en/sportsbook/l/406054/european-championship-qualification-women', 1, 6, 0),
(745, 'Germany 2nd Bundesliga', 'https://www.interwetten.com/en/sportsbook/l/406397/germany-2nd-bundesliga', 1, 6, 0),
(746, 'Germany Bundesliga', 'https://www.interwetten.com/en/sportsbook/l/405225/germany-bundesliga', 1, 6, 0),
(747, 'Austria HLA', 'https://www.interwetten.com/en/sportsbook/l/405310/austria-hla', 1, 6, 0),
(748, 'France National League', 'https://www.interwetten.com/en/sportsbook/l/405454/france-national-league', 1, 6, 0),
(749, 'Switzerland SHL', 'https://www.interwetten.com/en/sportsbook/l/405386/switzerland-shl', 1, 6, 0),
(750, 'Spain Asobal', 'https://www.interwetten.com/en/sportsbook/l/405376/spain-asobal', 1, 6, 0),
(751, 'Sweden Elitserien', 'https://www.interwetten.com/en/sportsbook/l/405362/sweden-elitserien', 1, 6, 0),
(752, 'Denmark Haandboldligaen Men', 'https://www.interwetten.com/en/sportsbook/l/405390/denmark-haandboldligaen-men', 1, 6, 0);

--
-- Constraints for dumped tables
--

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
