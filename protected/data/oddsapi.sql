-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2013 at 12:02 AM
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
-- Table structure for table `cron`
--

CREATE TABLE IF NOT EXISTS `cron` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flag` varchar(32) NOT NULL,
  `cron_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cron`
--

INSERT INTO `cron` (`id`, `flag`, `cron_time`) VALUES
(1, 'stack_fill', '2013-10-30 21:27:56'),
(2, 'odds_fill', '2013-10-30 19:43:44'),
(3, 'xml_fill', '2013-10-30 21:21:58'),
(4, 'result_fill', '2013-11-06 22:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `syn` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=263 ;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`id`, `name`, `syn`) VALUES
(2, 'Newcastle United', 'Newcastle United'),
(3, 'Chelsea', 'Chelsea'),
(4, 'Fulham', 'Fulham'),
(5, 'Manchester United', 'Manchester United'),
(6, 'Hull City', 'Hull City'),
(7, 'Sunderland', 'Sunderland'),
(8, 'Manchester City', 'Manchester City'),
(9, 'Norwich City', 'Norwich City'),
(10, 'Stoke City', 'Stoke City'),
(11, 'Southampton', 'Southampton'),
(12, 'West Bromwich Albion', 'West Bromwich Albion'),
(13, 'Crystal Palace', 'Crystal Palace'),
(14, 'West Ham United', 'West Ham United'),
(15, 'Aston Villa', 'Aston Villa'),
(16, 'Arsenal', 'Arsenal'),
(17, 'Liverpool', 'Liverpool'),
(18, 'Everton', 'Everton'),
(19, 'Tottenham Hotspur', 'Tottenham Hotspur'),
(20, 'Cardiff City', 'Cardiff City'),
(21, 'Swansea City', 'Swansea City'),
(22, 'Ipswich Town', 'Ipswich Town'),
(23, 'Barnsley', 'Barnsley'),
(24, 'Watford', 'Watford'),
(25, 'Leicester City', 'Leicester City'),
(26, 'AFC Bournemouth', 'AFC Bournemouth'),
(27, 'Bolton Wanderers', 'Bolton Wanderers'),
(28, 'Birmingham City', 'Birmingham City'),
(29, 'Charlton Athletic', 'Charlton Athletic'),
(30, 'Blackburn Rovers', 'Blackburn Rovers'),
(31, 'Middlesbrough', 'Middlesbrough'),
(32, 'Doncaster Rovers', 'Doncaster Rovers'),
(33, 'Brighton &amp; Hove Albion', 'Brighton &amp; Hove Albion'),
(34, 'Leeds United', 'Leeds United'),
(35, 'Yeovil Town', 'Yeovil Town'),
(36, 'Millwall', 'Millwall'),
(37, 'Burnley', 'Burnley'),
(38, 'Nottingham Forest', 'Nottingham Forest'),
(39, 'Blackpool', 'Blackpool'),
(40, 'Queens Park Rangers', 'Queens Park Rangers'),
(41, 'Derby County', 'Derby County'),
(42, 'Sheffield Wednesday', 'Sheffield Wednesday'),
(43, 'Reading', 'Reading'),
(44, 'Wigan Athletic', 'Wigan Athletic'),
(45, 'Huddersfield Town', 'Huddersfield Town'),
(46, 'Bristol City', 'Bristol City'),
(47, 'Oldham Athletic', 'Oldham Athletic'),
(48, 'Coventry City', 'Coventry City'),
(49, 'Notts County', 'Notts County'),
(50, 'Crawley Town', 'Crawley Town'),
(51, 'Brentford', 'Brentford'),
(52, 'Crewe Alexandra', 'Crewe Alexandra'),
(53, 'Bradford City', 'Bradford City'),
(54, 'Gillingham', 'Gillingham'),
(55, 'Carlisle United', 'Carlisle United'),
(56, 'Milton Keynes Dons', 'Milton Keynes Dons'),
(57, 'Walsall', 'Walsall'),
(58, 'Peterborough United', 'Peterborough United'),
(59, 'Leyton Orient', 'Leyton Orient'),
(60, 'Preston North End', 'Preston North End'),
(61, 'Tranmere Rovers', 'Tranmere Rovers'),
(62, 'Rotherham United', 'Rotherham United'),
(63, 'Colchester United', 'Colchester United'),
(64, 'Shrewsbury Town', 'Shrewsbury Town'),
(65, 'Sheffield United', 'Sheffield United'),
(66, 'Swindon Town', 'Swindon Town'),
(67, 'Port Vale', 'Port Vale'),
(68, 'Wolverhampton Wanderers', 'Wolverhampton Wanderers'),
(69, 'Stevenage', 'Stevenage'),
(70, 'Southend United', 'Southend United'),
(71, 'Mansfield Town', 'Mansfield Town'),
(72, 'Accrington Stanley', 'Accrington Stanley'),
(73, 'Wycombe Wanderers', 'Wycombe Wanderers'),
(74, 'Burton Albion', 'Burton Albion'),
(75, 'Morecambe', 'Morecambe'),
(76, 'Bury', 'Bury'),
(77, 'Torquay United', 'Torquay United'),
(78, 'Cheltenham Town', 'Cheltenham Town'),
(79, 'York City', 'York City'),
(80, 'Chesterfield', 'Chesterfield'),
(81, 'Scunthorpe United', 'Scunthorpe United'),
(82, 'Fleetwood Town', 'Fleetwood Town'),
(83, 'Newport County', 'Newport County'),
(84, 'Hartlepool United', 'Hartlepool United'),
(85, 'Dagenham &amp; Redbridge', 'Dagenham &amp; Redbridge'),
(86, 'Oxford United', 'Oxford United'),
(87, 'Bristol Rovers', 'Bristol Rovers'),
(88, 'Plymouth Argyle', 'Plymouth Argyle'),
(89, 'Northampton Town', 'Northampton Town'),
(90, 'Portsmouth', 'Portsmouth'),
(91, 'Exeter City', 'Exeter City'),
(92, 'Rochdale', 'Rochdale'),
(93, 'AFC Wimbledon', 'AFC Wimbledon'),
(94, 'Alfreton Town', 'Alfreton Town'),
(95, 'Halifax Town', 'Halifax Town'),
(96, 'Barnet', 'Barnet'),
(97, 'Kidderminster Harriers', 'Kidderminster Harriers'),
(98, 'Chester FC', 'Chester FC'),
(99, 'Aldershot Town', 'Aldershot Town'),
(100, 'Forest Green Rovers', 'Forest Green Rovers'),
(101, 'Dartford', 'Dartford'),
(102, 'Gateshead FC', 'Gateshead FC'),
(103, 'Luton Town', 'Luton Town'),
(104, 'Hyde FC', 'Hyde FC'),
(105, 'Nuneaton Town', 'Nuneaton Town'),
(106, 'Macclesfield Town', 'Macclesfield Town'),
(107, 'Wrexham', 'Wrexham'),
(108, 'Southport', 'Southport'),
(109, 'Cambridge United', 'Cambridge United'),
(110, 'Tamworth', 'Tamworth'),
(111, 'Braintree Town', 'Braintree Town'),
(112, 'Welling United', 'Welling United'),
(113, 'Lincoln', 'Lincoln'),
(114, 'Woking', 'Woking'),
(115, 'Grimsby Town', 'Grimsby Town'),
(116, 'Parma', 'Parma'),
(117, 'Juventus', 'Juventus'),
(118, 'AC Milan', 'AC Milan'),
(119, 'Fiorentina', 'Fiorentina'),
(120, 'Napoli', 'SSC Napoli'),
(121, 'Catania', 'Catania'),
(122, 'Livorno', 'Livorno'),
(123, 'Atalanta', 'Atalanta'),
(124, 'Hellas Verona', 'Hellas Verona'),
(125, 'Cagliari', 'Cagliari'),
(126, 'Lazio', 'Lazio'),
(127, 'Genoa', 'Genoa'),
(128, 'Sampdoria', 'Sampdoria'),
(129, 'Sassuolo', 'Sassuolo'),
(130, 'Udinese', 'Udinese'),
(131, 'Inter', 'Inter'),
(132, 'Torino', 'Torino'),
(133, 'Roma', 'Roma'),
(134, 'Bologna', 'Bologna'),
(135, 'ChievoVerona', 'ChievoVerona'),
(136, 'Varese', 'Varese'),
(137, 'Juve Stabia', 'Juve Stabia'),
(138, 'Cesena', 'Cesena'),
(139, 'Ternana', 'Ternana'),
(140, 'Crotone', 'Crotone'),
(141, 'Novara', 'Novara'),
(142, 'Latina', 'Latina'),
(143, 'Reggina', 'Reggina'),
(144, 'Padova', 'Padova'),
(145, 'Spezia', 'Spezia'),
(146, 'Pescara', 'Pescara'),
(147, 'Brescia', 'Brescia'),
(148, 'Trapani', 'Trapani'),
(149, 'Carpi', 'Carpi'),
(150, 'Modena', 'Modena'),
(151, 'Virtus Lanciano', 'Virtus Lanciano'),
(152, 'Empoli', 'Empoli'),
(153, 'Bari', 'Bari'),
(154, 'Siena', 'Siena'),
(155, 'Cittadella', 'Cittadella'),
(156, 'Avellino', 'Avellino'),
(157, 'Palermo', 'Palermo'),
(158, 'Barcelona', 'Barcelona'),
(159, 'Espanyol', 'Espanyol'),
(160, 'Real Sociedad', 'Real Sociedad'),
(161, 'Osasuna', 'Osasuna'),
(162, 'Almeria', 'Almeria'),
(163, 'Valladolid', 'Valladolid'),
(164, 'Rayo Vallecano', 'Rayo Vallecano'),
(165, 'Real Madrid', 'Real Madrid'),
(166, 'Sevilla', 'Sevilla'),
(167, 'Celta Vigo', 'Celta Vigo'),
(168, 'Getafe', 'Getafe'),
(169, 'Valencia', 'Valencia'),
(170, 'Atletico Madrid', 'Atletico Madrid'),
(171, 'Athletic Bilbao', 'Athletic Bilbao'),
(172, 'Levante', 'Levante'),
(173, 'Granada', 'Granada'),
(174, 'Malaga', 'Malaga'),
(175, 'Real Betis', 'Real Betis'),
(176, 'Elche', 'Elche'),
(177, 'Villarreal', 'Villarreal'),
(178, 'Eibar', 'Eibar'),
(179, 'Zaragoza', 'Zaragoza'),
(180, 'Numancia', 'Numancia'),
(181, 'Barcelona B', 'Barcelona B'),
(182, 'Mallorca', 'Mallorca'),
(183, 'Lugo', 'Lugo'),
(184, 'Girona', 'Girona'),
(185, 'Hercules', 'Hercules'),
(186, 'Las Palmas', 'Las Palmas'),
(187, 'Alcorcon', 'Alcorcon'),
(188, 'Cordoba', 'Cordoba'),
(189, 'Sporting Gijon', 'Sporting Gijon'),
(190, 'Real Jaen', 'Real Jaen'),
(191, 'Mirandes', 'Mirandes'),
(192, 'Sabadell', 'Sabadell'),
(193, 'Murcia', 'Murcia'),
(194, 'Alaves', 'Alaves'),
(195, 'Tenerife', 'Tenerife'),
(196, 'Deportivo La Coruna', 'Deportivo La Coruna'),
(197, 'Real Madrid Castilla', 'Real Madrid Castilla'),
(198, 'Ponferradina', 'Ponferradina'),
(199, 'Recreativo Huelva', 'Recreativo Huelva'),
(200, 'Kuban Krasnodar', 'Kuban Krasnodar'),
(201, 'St.Gallen', 'St.Gallen'),
(202, 'PFC Ludogorets Razgrad', 'PFC Ludogorets Razgrad'),
(203, 'Chornomorets O.', 'Chornomorets O.'),
(204, 'PSV Eindhoven', 'PSV Eindhoven'),
(205, 'Dinamo Zagreb', 'Dinamo Zagreb'),
(206, 'Esbjerg fB', 'Esbjerg fB'),
(207, 'Elfsborg', 'Elfsborg'),
(208, 'Standard Liege', 'Standard Liege'),
(209, 'Salzburg', 'Salzburg'),
(210, 'Rubin Kazan', 'Rubin Kazan'),
(211, 'Maribor', 'Maribor'),
(212, 'Zulte-Waregem', 'Zulte-Waregem'),
(213, 'Dnipro', 'Dnipro'),
(214, 'P.Ferreira', 'P.Ferreira'),
(215, 'Pandurii', 'Pandurii'),
(216, 'APOEL Nicosia', 'APOEL Nicosia'),
(217, 'Bordeaux', 'Bordeaux'),
(218, 'Maccabi Tel Aviv', 'Maccabi Tel Aviv'),
(219, 'Eintracht Frankfurt', 'Eintracht Frankfurt'),
(220, 'Rapid Wien', 'Rapid Wien'),
(221, 'Genk', 'Genk'),
(222, 'Thun', 'Thun'),
(223, 'Dynamo Kyiv', 'Dynamo Kyiv'),
(224, 'Estoril', 'Estoril'),
(225, 'Freiburg', 'Freiburg'),
(226, 'Liberec', 'Liberec'),
(227, 'Rijeka', 'Rijeka'),
(228, 'Lyon', 'Lyon'),
(229, 'Vitoria de Guimaraes', 'Vitoria de Guimaraes'),
(230, 'Apollon Limassol', 'Apollon Limassol'),
(231, 'Legia Warszawa', 'Legia Warszawa'),
(232, 'Trabzonspor', 'Trabzonspor'),
(233, 'FC Sheriff', 'FC Sheriff'),
(234, 'Tromsø', 'Tromsø'),
(235, 'Anzhi Makhachkala', 'Anzhi Makhachkala'),
(236, 'AZ Alkmaar', 'AZ Alkmaar'),
(237, 'Shakhter Karagandy', 'Shakhter Karagandy'),
(238, 'Maccabi Haifa', 'Maccabi Haifa'),
(239, 'PAOK Thessaloniki FC', 'PAOK Thessaloniki FC'),
(240, 'Atromitos', 'Atromitos'),
(241, 'Shakhtar Donetsk', 'Shakhtar Donetsk'),
(242, 'Bayer Leverkusen', 'Bayer Leverkusen'),
(243, 'FC København', 'FC København'),
(244, 'Galatasaray', 'Galatasaray'),
(245, 'Olympiakos', 'Olympiakos'),
(246, 'Benfica', 'Benfica'),
(247, 'Paris Saint Germain', 'Paris Saint Germain'),
(248, 'Anderlecht', 'Anderlecht'),
(249, 'CSKA Moscow', 'CSKA Moscow'),
(250, 'Viktoria Plzen', 'Viktoria Plzen'),
(251, 'Bayern Munich', 'Bayern Munich'),
(252, 'Basel', 'Basel'),
(253, 'Steaua Bucuresti', 'Steaua Bucuresti'),
(254, 'Schalke 04', 'Schalke 04'),
(255, 'Dortmund', 'Borussia Dortmund'),
(256, 'Marseille', 'Marseille'),
(257, 'Zenit Petersburg', 'Zenit Petersburg'),
(258, 'FC Porto', 'FC Porto'),
(259, 'Austria Wien', 'Austria Wien'),
(260, 'Ajax', 'Ajax'),
(261, 'Celtic', 'Celtic'),
(262, 'Fenerbahce', 'Fenerbahce');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE IF NOT EXISTS `sport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `syn` varchar(256) DEFAULT NULL,
  `link` varchar(256) NOT NULL,
  `syn_link` varchar(256) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`id`, `name`, `syn`, `link`, `syn_link`, `active`) VALUES
(1, 'Football', NULL, 'https://www.interwetten.com/en/sportsbook/o/10/football', NULL, 1),
(2, 'Tennis', NULL, 'https://www.interwetten.com/en/sportsbook/o/11/tennis', NULL, 1),
(3, 'Ice hockey', NULL, 'https://www.interwetten.com/en/sportsbook/o/40/ice-hockey', NULL, 1),
(4, 'Basketball', NULL, 'https://www.interwetten.com/en/sportsbook/o/15/basketball', NULL, 1),
(5, 'Baseball', NULL, 'https://www.interwetten.com/en/sportsbook/l/14233/mlb', NULL, 0),
(6, 'Handball', NULL, 'https://www.interwetten.com/en/sportsbook/o/1002/handball', NULL, 1),
(7, 'Motorbike', NULL, 'https://www.interwetten.com/en/sportsbook/o/1011/motorbike', NULL, 0),
(8, 'American football', NULL, 'https://www.interwetten.com/en/sportsbook/o/13/american-football', NULL, 1),
(9, 'Volleyball', NULL, 'https://www.interwetten.com/en/sportsbook/o/1012/volleyball', NULL, 0),
(10, 'Golf', NULL, 'https://www.interwetten.com/en/sportsbook/l/405262/ryder-cup-2014', NULL, 0),
(11, 'Rugbu', NULL, 'https://www.interwetten.com/en/sportsbook/o/1003/rugby', NULL, 0),
(12, 'Australian Rules Football', NULL, 'https://www.interwetten.com/en/sportsbook/l/405647/afl', NULL, 0),
(13, 'Alpine skiing', NULL, 'https://www.interwetten.com/en/sportsbook/l/200/world-cup', NULL, 0),
(14, 'Futsal', NULL, 'https://www.interwetten.com/en/sportsbook/l/406389/brazil-liga-futsal-40', NULL, 0),
(15, 'Biathlon', NULL, 'https://www.interwetten.com/en/sportsbook/l/406141/world-cup-competitions', NULL, 0),
(16, 'Superbike', NULL, 'https://www.interwetten.com/en/sportsbook/l/406158/superbike', NULL, 0),
(17, 'Nordic skiing', NULL, 'https://www.interwetten.com/en/sportsbook/l/405297/skijumping', NULL, 0),
(18, 'Lacrosse', NULL, 'https://www.interwetten.com/en/sportsbook/l/406119/nll', NULL, 0),
(19, 'Diving', NULL, 'https://www.interwetten.com/en/sportsbook/l/405960/cliff-diving-world-series', NULL, 0),
(20, 'Cricket', NULL, 'https://www.interwetten.com/en/sportsbook/l/405987/the-ashes', NULL, 0),
(21, 'Pool', NULL, 'https://www.interwetten.com/en/sportsbook/l/406030/mosconi-cup', NULL, 0),
(22, 'Darts', NULL, 'https://www.interwetten.com/en/sportsbook/l/405510/pdc-world-championship', NULL, 0),
(23, 'Boxing', NULL, 'https://www.interwetten.com/en/sportsbook/l/90/boxing', NULL, 0),
(24, 'Entertainment', NULL, 'https://www.interwetten.com/en/sportsbook/l/405709/schlag-den-raab', NULL, 0),
(25, 'Poker', NULL, 'https://www.interwetten.com/en/sportsbook/l/405831/wsop-main-event', NULL, 0),
(26, 'Sailing', NULL, 'https://www.interwetten.com/en/sportsbook/l/405637/americas-cup', NULL, 0),
(27, 'Chess', NULL, 'https://www.interwetten.com/en/sportsbook/l/406893/world-chess-championships-2013', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stack`
--

CREATE TABLE IF NOT EXISTS `stack` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` bigint(20) NOT NULL,
  `link` text NOT NULL,
  `syn_link` text,
  `opponent` varchar(256) DEFAULT NULL COMMENT 'home_team vs guest_team',
  `syn` varchar(256) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` tinyint(1) DEFAULT '0',
  `data` text,
  `tournament_id` int(10) unsigned NOT NULL,
  `cron` smallint(6) NOT NULL DEFAULT '0',
  `cron_time` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tournament_id` (`tournament_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1140 ;

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `syn` varchar(256) DEFAULT NULL,
  `link` text NOT NULL,
  `syn_link` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sport_id` int(10) unsigned NOT NULL,
  `special` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `syn`, `link`, `syn_link`, `active`, `sport_id`, `special`) VALUES
(88, 'WC Qualifying 2014 Play-off', NULL, 'https://www.interwetten.com/en/sportsbook/l/10907/wc-qualifying-2014-play-off', NULL, 1, 1, 0),
(89, 'U17 World Cup in UAE', NULL, 'https://www.interwetten.com/en/sportsbook/l/407164/u17-world-cup-in-uae', NULL, 1, 1, 0),
(90, 'Champions League', 'Champions League', 'https://www.interwetten.com/en/sportsbook/l/10410/champions-league', 'http://www.livescore.com/soccer/champions-league/', 1, 1, 0),
(91, 'Copa Sudamericana (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/105217/copa-sudamericana-90', NULL, 1, 1, 0),
(92, 'Germany Bundesliga', NULL, 'https://www.interwetten.com/en/sportsbook/l/1019/germany-bundesliga', NULL, 1, 1, 0),
(93, 'Germany Second League', NULL, 'https://www.interwetten.com/en/sportsbook/l/1020/germany-second-league', NULL, 1, 1, 0),
(94, 'Germany Third League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405932/germany-third-league', NULL, 1, 1, 0),
(95, 'Germany Fourth League Bavaria', NULL, 'https://www.interwetten.com/en/sportsbook/l/10347/germany-fourth-league-bavaria', NULL, 1, 1, 0),
(96, 'England Premier League', 'Premier League', 'https://www.interwetten.com/en/sportsbook/l/1021/england-premier-league', 'http://www.livescore.com/soccer/england/premier-league/', 1, 1, 0),
(97, 'England Championship', 'Championship', 'https://www.interwetten.com/en/sportsbook/l/1022/england-championship', 'http://www.livescore.com/soccer/england/championship/', 1, 1, 0),
(98, 'England League One', 'League 1', 'https://www.interwetten.com/en/sportsbook/l/10467/england-league-one', 'http://www.livescore.com/soccer/england/league-1/', 1, 1, 0),
(99, 'England League Two', 'League 2', 'https://www.interwetten.com/en/sportsbook/l/10468/england-league-two', 'http://www.livescore.com/soccer/england/league-2/', 1, 1, 0),
(100, 'England Conference', 'Conference Premier', 'https://www.interwetten.com/en/sportsbook/l/10691/england-conference', 'http://www.livescore.com/soccer/england/blue-square-premier/', 1, 1, 0),
(101, 'Italy Serie A', 'Serie A', 'https://www.interwetten.com/en/sportsbook/l/1029/italy-serie-a', 'http://www.livescore.com/soccer/italy/serie-a/', 1, 1, 0),
(102, 'Italy Series B', 'Serie B', 'https://www.interwetten.com/en/sportsbook/l/405298/italy-series-b', 'http://www.livescore.com/soccer/italy/serie-b/', 1, 1, 0),
(103, 'Spain Premier Division', 'Primera Division', 'https://www.interwetten.com/en/sportsbook/l/1030/spain-premier-division', 'http://www.livescore.com/soccer/spain/primera-division/', 1, 1, 0),
(104, 'Spain Segunda Division', 'Secunda Division', 'https://www.interwetten.com/en/sportsbook/l/105034/spain-segunda-division', 'http://www.livescore.com/soccer/spain/segunda-division/', 1, 1, 0),
(105, 'France First Division', NULL, 'https://www.interwetten.com/en/sportsbook/l/1024/france-first-division', NULL, 1, 1, 0),
(106, 'France Second Division', NULL, 'https://www.interwetten.com/en/sportsbook/l/10617/france-second-division', NULL, 1, 1, 0),
(107, 'Switzerland Super League', NULL, 'https://www.interwetten.com/en/sportsbook/l/1025/switzerland-super-league', NULL, 1, 1, 0),
(108, 'Switzerland Challenge League', NULL, 'https://www.interwetten.com/en/sportsbook/l/105002/switzerland-challenge-league', NULL, 1, 1, 0),
(109, 'Austria Bundesliga', NULL, 'https://www.interwetten.com/en/sportsbook/l/1023/austria-bundesliga', NULL, 1, 1, 0),
(110, 'Austria First League', NULL, 'https://www.interwetten.com/en/sportsbook/l/10900/austria-first-league', NULL, 1, 1, 0),
(111, 'Austria Third League East', NULL, 'https://www.interwetten.com/en/sportsbook/l/406244/austria-third-league-east', NULL, 1, 1, 0),
(112, 'Austria Third League Centre', NULL, 'https://www.interwetten.com/en/sportsbook/l/405718/austria-third-league-centre', NULL, 1, 1, 0),
(113, 'Scotland Premier League', NULL, 'https://www.interwetten.com/en/sportsbook/l/1026/scotland-premier-league', NULL, 1, 1, 0),
(114, 'Portugal First League', NULL, 'https://www.interwetten.com/en/sportsbook/l/10598/portugal-first-league', NULL, 1, 1, 0),
(115, 'Holland Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/10172/holland-cup-90', NULL, 1, 1, 0),
(116, 'Holland Ehrendivision', NULL, 'https://www.interwetten.com/en/sportsbook/l/1027/holland-ehrendivision', NULL, 1, 1, 0),
(117, 'Belgium 1st League', NULL, 'https://www.interwetten.com/en/sportsbook/l/1028/belgium-1st-league', NULL, 1, 1, 0),
(118, 'Turkey Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/1075/turkey-cup-90', NULL, 1, 1, 0),
(119, 'Turkey Süper Lig', NULL, 'https://www.interwetten.com/en/sportsbook/l/1036/turkey-süper-lig', NULL, 1, 1, 0),
(120, 'Greece First League', NULL, 'https://www.interwetten.com/en/sportsbook/l/1060/greece-first-league', NULL, 1, 1, 0),
(121, 'Russia Premier League', NULL, 'https://www.interwetten.com/en/sportsbook/l/10412/russia-premier-league', NULL, 1, 1, 0),
(122, 'Russia Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405304/russia-cup-90', NULL, 1, 1, 0),
(123, 'Denmark Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/10287/denmark-cup-90', NULL, 1, 1, 0),
(124, 'Denmark Superleague', NULL, 'https://www.interwetten.com/en/sportsbook/l/1035/denmark-superleague', NULL, 1, 1, 0),
(125, 'Norway Eliteseries', NULL, 'https://www.interwetten.com/en/sportsbook/l/10251/norway-eliteseries', NULL, 1, 1, 0),
(126, 'Czech Republic Gambrinus Liga', NULL, 'https://www.interwetten.com/en/sportsbook/l/10420/czech-republic-gambrinus-liga', NULL, 1, 1, 0),
(127, 'Slovakia First League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405281/slovakia-first-league', NULL, 1, 1, 0),
(128, 'Bulgaria League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405622/bulgaria-league', NULL, 1, 1, 0),
(129, 'Romania Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405692/romania-cup-90', NULL, 1, 1, 0),
(130, 'Poland Ekstraklasa', NULL, 'https://www.interwetten.com/en/sportsbook/l/1059/poland-ekstraklasa', NULL, 1, 1, 0),
(131, 'Croatia 1.HNL', NULL, 'https://www.interwetten.com/en/sportsbook/l/406081/croatia-1-hnl', NULL, 1, 1, 0),
(132, 'Slovenia First Division', NULL, 'https://www.interwetten.com/en/sportsbook/l/405541/slovenia-first-division', NULL, 1, 1, 0),
(133, 'Ireland  Promotion Playoff', NULL, 'https://www.interwetten.com/en/sportsbook/l/405917/ireland-promotion-playoff', NULL, 1, 1, 0),
(134, 'Ireland FAI Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405618/ireland-fai-cup-90', NULL, 1, 1, 0),
(135, 'Northern Ireland Premier League', NULL, 'https://www.interwetten.com/en/sportsbook/l/10909/northern-ireland-premier-league', NULL, 1, 1, 0),
(136, 'Australia A-League (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405485/australia-a-league-90', NULL, 1, 1, 0),
(137, 'Major League Soccer', NULL, 'https://www.interwetten.com/en/sportsbook/l/10750/major-league-soccer', NULL, 1, 1, 0),
(138, 'Argentina 1st League', NULL, 'https://www.interwetten.com/en/sportsbook/l/105121/argentina-1st-league', NULL, 1, 1, 0),
(139, 'Argentina Nacional B', NULL, 'https://www.interwetten.com/en/sportsbook/l/405902/argentina-nacional-b', NULL, 1, 1, 0),
(140, 'Brazil Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/105159/brazil-cup-90', NULL, 1, 1, 0),
(141, 'Brazil Serie A', NULL, 'https://www.interwetten.com/en/sportsbook/l/405525/brazil-serie-a', NULL, 1, 1, 0),
(142, 'Mexico Primera Division', NULL, 'https://www.interwetten.com/en/sportsbook/l/405250/mexico-primera-division', NULL, 1, 1, 0),
(143, 'Peru 1st League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405417/peru-1st-league', NULL, 1, 1, 0),
(144, 'Costa Rica Primera Division', NULL, 'https://www.interwetten.com/en/sportsbook/l/406296/costa-rica-primera-division', NULL, 1, 1, 0),
(145, 'Japan JLeague Cup Final in Tokyo (90'')', NULL, 'https://www.interwetten.com/en/sportsbook/l/405717/japan-jleague-cup-final-in-tokyo-90', NULL, 1, 1, 0),
(146, 'Singapore S-League', NULL, 'https://www.interwetten.com/en/sportsbook/l/105152/singapore-s-league', NULL, 1, 1, 0),
(147, 'World Cup 2014', NULL, 'https://www.interwetten.com/en/sportsbook/l/10406/world-cup-2014', NULL, 1, 1, 0),
(148, 'European Championship 2016', NULL, 'https://www.interwetten.com/en/sportsbook/l/10405/european-championship-2016', NULL, 1, 1, 0),
(149, 'ATP Paris', NULL, 'https://www.interwetten.com/en/sportsbook/l/407179/atp-paris', NULL, 1, 2, 0),
(150, 'ATP Paris Doubles', NULL, 'https://www.interwetten.com/en/sportsbook/l/407180/atp-paris-doubles', NULL, 1, 2, 0),
(151, 'WTA Nanjing', NULL, 'https://www.interwetten.com/en/sportsbook/l/407176/wta-nanjing', NULL, 1, 2, 0),
(152, 'WTA Nanjing Doubles', NULL, 'https://www.interwetten.com/en/sportsbook/l/407177/wta-nanjing-doubles', NULL, 1, 2, 0),
(153, 'ATP Challenger Montevideo', NULL, 'https://www.interwetten.com/en/sportsbook/l/405723/atp-challenger-montevideo', NULL, 1, 2, 0),
(154, 'ATP Challenger Traralgon', NULL, 'https://www.interwetten.com/en/sportsbook/l/405839/atp-challenger-traralgon', NULL, 1, 2, 0),
(155, 'ATP Challenger Charlottesville', NULL, 'https://www.interwetten.com/en/sportsbook/l/11446/atp-challenger-charlottesville', NULL, 1, 2, 0),
(156, 'ATP Challenger Eckental', NULL, 'https://www.interwetten.com/en/sportsbook/l/406058/atp-challenger-eckental', NULL, 1, 2, 0),
(157, 'ATP Challenger Geneva', NULL, 'https://www.interwetten.com/en/sportsbook/l/115188/atp-challenger-geneva', NULL, 1, 2, 0),
(158, 'ATP Challenger Seoul', NULL, 'https://www.interwetten.com/en/sportsbook/l/405794/atp-challenger-seoul', NULL, 1, 2, 0),
(159, 'Davis Cup', NULL, 'https://www.interwetten.com/en/sportsbook/l/405265/davis-cup', NULL, 1, 2, 0),
(160, 'Fed Cup', NULL, 'https://www.interwetten.com/en/sportsbook/l/115199/fed-cup', NULL, 1, 2, 0),
(161, 'AHL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/406348/ahl-60', NULL, 1, 3, 0),
(162, 'NHL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/4080/nhl-60', NULL, 1, 3, 0),
(163, 'Switzerland NLA (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405088/switzerland-nla-60', NULL, 1, 3, 0),
(164, 'Switzerland NLB (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40625/switzerland-nlb-60', NULL, 1, 3, 0),
(165, 'Germany DEL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40627/germany-del-60', NULL, 1, 3, 0),
(166, 'Germany 2. League (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405373/germany-2-league-60', NULL, 1, 3, 0),
(167, 'KHL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405288/khl-60', NULL, 1, 3, 0),
(168, 'Austria EHL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/4083/austria-ehl-60', NULL, 1, 3, 0),
(169, 'Sweden Eliteserien (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40506/sweden-eliteserien-60', NULL, 1, 3, 0),
(170, 'Sweden Hockey Allsvenskan (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/406409/sweden-hockey-allsvenskan-60', NULL, 1, 3, 0),
(171, 'Finland SM-Liga (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40511/finland-sm-liga-60', NULL, 1, 3, 0),
(172, 'Norway Eliteserien (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405093/norway-eliteserien-60', NULL, 1, 3, 0),
(173, 'Czech Republic Extraliga (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405257/czech-republic-extraliga-60', NULL, 1, 3, 0),
(174, 'Italia Serie A (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/406068/italia-serie-a-60', NULL, 1, 3, 0),
(175, 'A - World Championship 2014 in Belarus (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405147/a-world-championship-2014-in-belarus-60', NULL, 1, 3, 0),
(176, 'Winter Games 2014 (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405680/winter-games-2014-60', NULL, 1, 3, 0),
(177, 'NBA', NULL, 'https://www.interwetten.com/en/sportsbook/l/15103/nba', NULL, 1, 4, 0),
(178, 'Euroleague', NULL, 'https://www.interwetten.com/en/sportsbook/l/405226/euroleague', NULL, 1, 4, 0),
(179, 'German BBL', NULL, 'https://www.interwetten.com/en/sportsbook/l/405224/german-bbl', NULL, 1, 4, 0),
(180, 'Italy Lega A', NULL, 'https://www.interwetten.com/en/sportsbook/l/405293/italy-lega-a', NULL, 1, 4, 0),
(181, 'Poland Ekstraliga', NULL, 'https://www.interwetten.com/en/sportsbook/l/405542/poland-ekstraliga', NULL, 1, 4, 0),
(182, 'Australia NBL', NULL, 'https://www.interwetten.com/en/sportsbook/l/405691/australia-nbl', NULL, 1, 4, 0),
(183, 'Argentina Liga Nacional', NULL, 'https://www.interwetten.com/en/sportsbook/l/406427/argentina-liga-nacional', NULL, 1, 4, 0),
(184, 'European Championships Men 2014 in Denmark', NULL, 'https://www.interwetten.com/en/sportsbook/l/405223/european-championships-men-2014-in-denmark', NULL, 1, 6, 0),
(185, 'World Championship Qualification Men', NULL, 'https://www.interwetten.com/en/sportsbook/l/406036/world-championship-qualification-men', NULL, 1, 6, 0),
(186, 'EHF Champions League Women (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405371/ehf-champions-league-women-60', NULL, 1, 6, 0),
(187, 'Denmark Haandboldligaen Women', NULL, 'https://www.interwetten.com/en/sportsbook/l/405456/denmark-haandboldligaen-women', NULL, 1, 6, 0),
(188, 'NFL', NULL, 'https://www.interwetten.com/en/sportsbook/l/13472/nfl', NULL, 1, 8, 0),
(189, 'NCAAF (College)', NULL, 'https://www.interwetten.com/en/sportsbook/l/13473/ncaaf-college', NULL, 1, 8, 0),
(190, 'Europa League', 'Europa League', 'https://www.interwetten.com/en/sportsbook/l/105379/europa-league', 'http://www.livescore.com/soccer/europa-league/', 1, 1, 0),
(191, 'AFC CL (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/105353/afc-cl-90', NULL, 1, 1, 0),
(192, 'England FA Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/1091/england-fa-cup-90', NULL, 1, 1, 0),
(193, 'England League Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/10427/england-league-cup-90', NULL, 1, 1, 0),
(194, 'Switzerland Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/10692/switzerland-cup-90', NULL, 1, 1, 0),
(195, 'Scotland Championship', NULL, 'https://www.interwetten.com/en/sportsbook/l/10605/scotland-championship', NULL, 1, 1, 0),
(196, 'Scotland League One', NULL, 'https://www.interwetten.com/en/sportsbook/l/405266/scotland-league-one', NULL, 1, 1, 0),
(197, 'Scotland League Two', NULL, 'https://www.interwetten.com/en/sportsbook/l/10607/scotland-league-two', NULL, 1, 1, 0),
(198, 'Portugal Cup (90´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/10604/portugal-cup-90', NULL, 1, 1, 0),
(199, 'Turkey First League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405290/turkey-first-league', NULL, 1, 1, 0),
(200, 'Romania League 1', NULL, 'https://www.interwetten.com/en/sportsbook/l/405364/romania-league-1', NULL, 1, 1, 0),
(201, 'Bolivia Liga Profesional', NULL, 'https://www.interwetten.com/en/sportsbook/l/406388/bolivia-liga-profesional', NULL, 1, 1, 0),
(202, 'Japan J-League', NULL, 'https://www.interwetten.com/en/sportsbook/l/10148/japan-j-league', NULL, 1, 1, 0),
(203, 'ATP World Tour Finals London', NULL, 'https://www.interwetten.com/en/sportsbook/l/115125/atp-world-tour-finals-london', NULL, 1, 2, 0),
(204, 'WTA Taipei', NULL, 'https://www.interwetten.com/en/sportsbook/l/407185/wta-taipei', NULL, 1, 2, 0),
(205, 'ATP Challenger Bogota', NULL, 'https://www.interwetten.com/en/sportsbook/l/406786/atp-challenger-bogota', NULL, 1, 2, 0),
(206, 'ATP Challenger Bratislava', NULL, 'https://www.interwetten.com/en/sportsbook/l/405802/atp-challenger-bratislava', NULL, 1, 2, 0),
(207, 'ATP Challenger Yeongwol', NULL, 'https://www.interwetten.com/en/sportsbook/l/406785/atp-challenger-yeongwol', NULL, 1, 2, 0),
(208, 'ATP Challenger Knoxville', NULL, 'https://www.interwetten.com/en/sportsbook/l/406178/atp-challenger-knoxville', NULL, 1, 2, 0),
(209, 'ATP Challenger Ortisei', NULL, 'https://www.interwetten.com/en/sportsbook/l/407098/atp-challenger-ortisei', NULL, 1, 2, 0),
(210, 'Karjala Cup (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40371/karjala-cup-60', NULL, 1, 3, 0),
(211, 'Euro Ice Hockey Challenge (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405392/euro-ice-hockey-challenge-60', NULL, 1, 3, 0),
(212, 'International Friendlies (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/40690/international-friendlies-60', NULL, 1, 3, 0),
(213, 'Deutschland Cup in Munich (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/405231/deutschland-cup-in-munich-60', NULL, 1, 3, 0),
(214, 'Russia VHL (60´)', NULL, 'https://www.interwetten.com/en/sportsbook/l/406472/russia-vhl-60', NULL, 1, 3, 0),
(215, 'Eurocup', NULL, 'https://www.interwetten.com/en/sportsbook/l/405358/eurocup', NULL, 1, 4, 0),
(216, 'Eurochallenge', NULL, 'https://www.interwetten.com/en/sportsbook/l/406089/eurochallenge', NULL, 1, 4, 0),
(217, 'Germany 2nd Bundesliga', NULL, 'https://www.interwetten.com/en/sportsbook/l/406397/germany-2nd-bundesliga', NULL, 1, 6, 0),
(218, 'Germany Bundesliga Women', NULL, 'https://www.interwetten.com/en/sportsbook/l/405834/germany-bundesliga-women', NULL, 1, 6, 0),
(219, 'Austria HLA', NULL, 'https://www.interwetten.com/en/sportsbook/l/405310/austria-hla', NULL, 1, 6, 0),
(220, 'France National League', NULL, 'https://www.interwetten.com/en/sportsbook/l/405454/france-national-league', NULL, 1, 6, 0),
(221, 'Sweden Elitserien', NULL, 'https://www.interwetten.com/en/sportsbook/l/405362/sweden-elitserien', NULL, 1, 6, 0),
(222, 'Denmark Haandboldligaen Men', NULL, 'https://www.interwetten.com/en/sportsbook/l/405390/denmark-haandboldligaen-men', NULL, 1, 6, 0);

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
