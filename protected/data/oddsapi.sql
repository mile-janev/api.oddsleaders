-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2013 at 05:32 PM
-- Server version: 5.5.32
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
(1, 'Football', 'https://www.interwetten.com/en/sportsbook/o/10/football', 1),
(2, 'Tennis', 'https://www.interwetten.com/en/sportsbook/o/11/tennis', 1),
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
  `opponent` varchar(256) DEFAULT NULL COMMENT 'home_team=>vs<=guest_team',
  `start` datetime DEFAULT NULL,
  `data` text,
  `tournament_id` int(10) unsigned NOT NULL,
  `cron` smallint(6) NOT NULL DEFAULT '0',
  `cron_time` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tournament_id` (`tournament_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=914 ;

--
-- Dumping data for table `stack`
--

INSERT INTO `stack` (`id`, `link`, `opponent`, `start`, `data`, `tournament_id`, `cron`, `cron_time`, `date_created`) VALUES
(716, 'https://www.interwetten.com/en/sportsbook/e/9871586/uae-u17-brazil-u17', 'UAE (U17)=>vs<=Brazil (U17)', '2013-10-20 18:00:00', '{"teams":{"home":"UAE (U17)","guest":"Brazil (U17)"},"date":"2013-10-20 18:00","coefficients":{"match":{"label":"Match","1":"13,00","x":"6,00","2":"1,15"},"handicap":{"label":"Handicap 1:0","1":"4,20","x":"4,30","2":"1,45"},"first-goal":{"label":"First goal","home":"4,70","guest":"1,17"},"how-many-goals":{"label":"How many goals","0-2":"3,00","3+":"1,30","0-1":"5,50","2+":"1,07"},"time-first-goal":{"label":"Time first goal","1-29":"1,50","30+":"2,80"},"when-first-goal":{"label":"When 1st goal","1-10":"3,80","11-20":"3,80","21-30":"4,00","31-40":"7,50","41-50":"10,00","51-60":"16,00","61-70":"20,00","71-80":"25,00","81+":"30,00"},"half-time":{"label":"HalfTime","1":"9,00","x":"3,30","2":"1,40"},"half-full-time":{"label":"Half-Time\\/Full-Time","H\\/H":"22,00","X\\/H":"24,00","G\\/H":"50,00","H\\/X":"20,00","X\\/X":"10,00","G\\/X":"20,00","H\\/G":"26,00","X\\/G":"5,50","G\\/G":"1,40"},"correct-score":{"label":"Correct Score","1:0":"22,00","0:0":"10,00","0:1":"8,00","2:0":"50,00","1:1":"12,00","0:2":"6,00","2:1":"40,00","2:2":"35,00","1:2":"11,00","3:0":"100,00","3:3":"80,00","0:3":"7,00","3:1":"100,00","4:4":"100,00","1:3":"11,00","3:2":"80,00","2:3":"","4:0":"40,00","0:4":"100,00","4:1":"","1:4":"8,00","4:2":"100,00","2:4":"","4:3":"9,00","3:4":"100,00","5:0":"","0:5":"40,00","5:1":"100,00","1:5":"","5:2":"80,00","2:5":"100,00"}}}', 372, 1, '2013-10-20 16:30:06', '2013-10-20 15:05:00'),
(717, 'https://www.interwetten.com/en/sportsbook/e/9871588/italy-u17-new-zealand-u17', 'Italy (U17)=>vs<=New Zealand (U17)', '2013-10-20 18:00:00', '{"teams":{"home":"Italy (U17)","guest":"New Zealand (U17)"},"date":"2013-10-20 18:00","coefficients":{"match":{"label":"Match","1":"1,12","x":"6,50","2":"14,00"},"handicap":{"label":"Handicap 0:1","1":"1,40","x":"4,40","2":"4,50"},"first-goal":{"label":"First goal","home":"1,15","guest":"5,00"},"how-many-goals":{"label":"How many goals","0-2":"3,00","3+":"1,30","0-1":"5,50","2+":"1,07"},"time-first-goal":{"label":"Time first goal","1-29":"1,50","30+":"2,80"},"when-first-goal":{"label":"When 1st goal","1-10":"3,80","11-20":"3,80","21-30":"4,00","31-40":"7,50","41-50":"10,00","51-60":"16,00","61-70":"20,00","71-80":"25,00","81+":"30,00"},"half-time":{"label":"HalfTime","1":"1,22","x":"4,40","2":"12,00"}}}', 372, 1, '2013-10-20 16:30:11', '2013-10-20 15:05:00'),
(718, 'https://www.interwetten.com/en/sportsbook/e/9871850/croatia-u17-panama-u17', 'Croatia (U17)=>vs<=Panama (U17)', '2013-10-21 15:00:00', '{"teams":{"home":"Croatia (U17)","guest":"Panama (U17)"},"date":"2013-10-21 15:00","coefficients":{"match":{"label":"Match","1":"1,70","x":"3,40","2":"4,30"},"handicap":{"label":"Handicap 0:1","1":"2,80","x":"3,60","2":"1,90"},"double-chance":{"label":"Double Chance","1x":"1,10","x2":"1,90"},"first-goal":{"label":"First goal","home":"1,55","guest":"2,50"},"how-many-goals":{"label":"How many goals","0-2":"2,00","3+":"1,65","0":"10,00","1+":"1,01","0-1":"3,80","2+":"1,17","0-3":"1,35","4+":"2,70","0-4":"1,12","5+":"4,50"},"time-first-goal":{"label":"Time first goal","1-29":"1,80","30+":"2,25"},"when-first-goal":{"label":"When 1st goal","1-10":"4,75","11-20":"4,75","21-30":"4,50","31-40":"5,50","41-50":"8,00","51-60":"10,00","61-70":"17,00","71-80":"20,00","81+":"28,00"},"half-time":{"label":"HalfTime","1":"2,15","x":"2,15","2":"4,90"},"half-full-time":{"label":"Half-Time\\/Full-Time","H\\/H":"2,50","X\\/H":"4,00","G\\/H":"22,00","H\\/X":"14,00","X\\/X":"4,80","G\\/X":"14,00","H\\/G":"28,00","X\\/G":"8,50","G\\/G":"7,50"},"correct-score":{"label":"Correct Score","1:0":"6,50","0:0":"10,00","0:1":"11,00","2:0":"7,00","1:1":"7,00","0:2":"20,00","2:1":"7,50","2:2":"14,00","1:2":"14,00","3:0":"12,00","3:3":"50,00","0:3":"50,00","3:1":"11,00","4:4":"100,00","1:3":"35,00","3:2":"25,00","2:3":"","4:0":"35,00","0:4":"30,00","4:1":"","1:4":"100,00","4:2":"30,00","2:4":"","4:3":"80,00","3:4":"45,00","5:0":"","0:5":"100,00","5:1":"80,00","1:5":"","5:2":"100,00","2:5":"60,00"},"goals":{"label":"Goals","0":"10,00","1":"5,75","2":"4,00","3":"4,00","4":"4,50","5+":"4,50"}}}', 372, 1, '2013-10-20 16:30:17', '2013-10-20 15:05:00'),
(719, 'https://www.interwetten.com/en/sportsbook/e/9871854/tunisia-u17-russia-u17', 'Tunisia (U17)=>vs<=Russia (U17)', '2013-10-21 15:00:00', '{"teams":{"home":"Tunisia (U17)","guest":"Russia (U17)"},"date":"2013-10-21 15:00","coefficients":{"match":{"label":"Match","1":"3,60","x":"3,20","2":"1,90"},"handicap":{"label":"Handicap 1:0","1":"1,70","x":"3,60","2":"3,50"},"double-chance":{"label":"Double Chance","1x":"1,70","x2":"1,18"},"first-goal":{"label":"First goal","home":"2,40","guest":"1,60"},"how-many-goals":{"label":"How many goals","0-2":"1,90","3+":"1,70","0":"9,50","1+":"1,02","0-1":"3,60","2+":"1,20","0-3":"1,30","4+":"2,90","0-4":"1,11","5+":"5,00"},"time-first-goal":{"label":"Time first goal","1-29":"1,85","30+":"2,20"},"when-first-goal":{"label":"When 1st goal","1-10":"4,75","11-20":"4,75","21-30":"4,50","31-40":"5,50","41-50":"8,00","51-60":"10,00","61-70":"17,00","71-80":"20,00","81+":"28,00"},"half-time":{"label":"HalfTime","1":"4,20","x":"2,05","2":"2,45"},"asian-handicap":{"label":"Asian 0 Ball Handicap","1":"2,30","2":"1,50"},"half-full-time":{"label":"Half-Time\\/Full-Time","H\\/H":"6,00","X\\/H":"7,50","G\\/H":"26,00","H\\/X":"14,00","X\\/X":"4,50","G\\/X":"14,00","H\\/G":"22,00","X\\/G":"4,00","G\\/G":"3,00"},"correct-score":{"label":"Correct Score","1:0":"9,00","0:0":"9,50","0:1":"6,50","2:0":"14,00","1:1":"7,00","0:2":"8,00","2:1":"12,00","2:2":"14,00","1:2":"7,00","3:0":"35,00","3:3":"50,00","0:3":"14,00","3:1":"28,00","4:4":"100,00","1:3":"13,00","3:2":"30,00","2:3":"","4:0":"25,00","0:4":"80,00","4:1":"","1:4":"40,00","4:2":"60,00","2:4":"","4:3":"35,00","3:4":"100,00","5:0":"","0:5":"50,00","5:1":"100,00","1:5":"","5:2":"80,00","2:5":"100,00"},"goals":{"label":"Goals","0":"9,50","1":"5,80","2":"3,60","3":"4,00","4":"5,00","5+":"5,00"}}}', 372, 1, '2013-10-20 16:30:01', '2013-10-20 15:05:01');

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
  PRIMARY KEY (`id`),
  KEY `sport_id` (`sport_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=443 ;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `link`, `active`, `sport_id`) VALUES
(372, 'U17 World Cup in UAE', 'https://www.interwetten.com/en/sportsbook/l/407164/u17-world-cup-in-uae', 1, 1),
(373, 'Champions League', 'https://www.interwetten.com/en/sportsbook/l/10410/champions-league', 1, 1),
(374, 'Europa League', 'https://www.interwetten.com/en/sportsbook/l/105379/europa-league', 1, 1),
(375, 'CAF Confederation Cup (90´)', 'https://www.interwetten.com/en/sportsbook/l/406008/caf-confederation-cup-90', 1, 1),
(376, 'Germany Bundesliga', 'https://www.interwetten.com/en/sportsbook/l/1019/germany-bundesliga', 1, 1),
(377, 'Germany Second League', 'https://www.interwetten.com/en/sportsbook/l/1020/germany-second-league', 1, 1),
(378, 'England Premier League', 'https://www.interwetten.com/en/sportsbook/l/1021/england-premier-league', 1, 1),
(379, 'England League One', 'https://www.interwetten.com/en/sportsbook/l/10467/england-league-one', 1, 1),
(380, 'Italy Serie A', 'https://www.interwetten.com/en/sportsbook/l/1029/italy-serie-a', 1, 1),
(381, 'Italy Series B', 'https://www.interwetten.com/en/sportsbook/l/405298/italy-series-b', 1, 1),
(382, 'Italy Lega Pro Prima A', 'https://www.interwetten.com/en/sportsbook/l/10599/italy-lega-pro-prima-a', 1, 1),
(383, 'Spain Premier Division', 'https://www.interwetten.com/en/sportsbook/l/1030/spain-premier-division', 1, 1),
(384, 'Spain Segunda Division', 'https://www.interwetten.com/en/sportsbook/l/105034/spain-segunda-division', 1, 1),
(385, 'Spain Segunda B Group 1', 'https://www.interwetten.com/en/sportsbook/l/405449/spain-segunda-b-group-1', 1, 1),
(386, 'Spain Segunda B Group 2', 'https://www.interwetten.com/en/sportsbook/l/405450/spain-segunda-b-group-2', 1, 1),
(387, 'Spain Segunda B Group 3', 'https://www.interwetten.com/en/sportsbook/l/405451/spain-segunda-b-group-3', 1, 1),
(388, 'Spain Segunda B Group 4', 'https://www.interwetten.com/en/sportsbook/l/405452/spain-segunda-b-group-4', 1, 1),
(389, 'France First Division', 'https://www.interwetten.com/en/sportsbook/l/1024/france-first-division', 1, 1),
(390, 'France Second Division', 'https://www.interwetten.com/en/sportsbook/l/10617/france-second-division', 1, 1),
(391, 'Switzerland Super League', 'https://www.interwetten.com/en/sportsbook/l/1025/switzerland-super-league', 1, 1),
(392, 'Switzerland Challenge League', 'https://www.interwetten.com/en/sportsbook/l/105002/switzerland-challenge-league', 1, 1),
(393, 'Austria Bundesliga', 'https://www.interwetten.com/en/sportsbook/l/1023/austria-bundesliga', 1, 1),
(394, 'Austria First League', 'https://www.interwetten.com/en/sportsbook/l/10900/austria-first-league', 1, 1),
(395, 'Austria Third League East', 'https://www.interwetten.com/en/sportsbook/l/406244/austria-third-league-east', 1, 1),
(396, 'Austria Third League West', 'https://www.interwetten.com/en/sportsbook/l/405871/austria-third-league-west', 1, 1),
(397, 'Portugal Cup (90´)', 'https://www.interwetten.com/en/sportsbook/l/10604/portugal-cup-90', 1, 1),
(398, 'Holland Ehrendivision', 'https://www.interwetten.com/en/sportsbook/l/1027/holland-ehrendivision', 1, 1),
(399, 'Holland Second Division', 'https://www.interwetten.com/en/sportsbook/l/10448/holland-second-division', 1, 1),
(400, 'Belgium 1st League', 'https://www.interwetten.com/en/sportsbook/l/1028/belgium-1st-league', 1, 1),
(401, 'Turkey Süper Lig', 'https://www.interwetten.com/en/sportsbook/l/1036/turkey-süper-lig', 1, 1),
(402, 'Turkey First League', 'https://www.interwetten.com/en/sportsbook/l/405290/turkey-first-league', 1, 1),
(403, 'Greece First League', 'https://www.interwetten.com/en/sportsbook/l/1060/greece-first-league', 1, 1),
(404, 'Greece Second League Gr2', 'https://www.interwetten.com/en/sportsbook/l/407138/greece-second-league-gr2', 1, 1),
(405, 'Cyprus Division 1', 'https://www.interwetten.com/en/sportsbook/l/405435/cyprus-division-1', 1, 1),
(406, 'Russia Premier League', 'https://www.interwetten.com/en/sportsbook/l/10412/russia-premier-league', 1, 1),
(407, 'Denmark Superleague', 'https://www.interwetten.com/en/sportsbook/l/1035/denmark-superleague', 1, 1),
(408, 'Sweden Allsvenskan', 'https://www.interwetten.com/en/sportsbook/l/10235/sweden-allsvenskan', 1, 1),
(409, 'Sweden Superettan', 'https://www.interwetten.com/en/sportsbook/l/10208/sweden-superettan', 1, 1),
(410, 'Norway Eliteseries', 'https://www.interwetten.com/en/sportsbook/l/10251/norway-eliteseries', 1, 1),
(411, 'Norway First Division', 'https://www.interwetten.com/en/sportsbook/l/10782/norway-first-division', 1, 1),
(412, 'Czech Republic Gambrinus Liga', 'https://www.interwetten.com/en/sportsbook/l/10420/czech-republic-gambrinus-liga', 1, 1),
(413, 'Ukraine 1st League', 'https://www.interwetten.com/en/sportsbook/l/405859/ukraine-1st-league', 1, 1),
(414, 'Hungary NB I', 'https://www.interwetten.com/en/sportsbook/l/10306/hungary-nb-i', 1, 1),
(415, 'Romania League 1', 'https://www.interwetten.com/en/sportsbook/l/405364/romania-league-1', 1, 1),
(416, 'Bulgaria League', 'https://www.interwetten.com/en/sportsbook/l/405622/bulgaria-league', 1, 1),
(417, 'Belarus Vysshaya Liga', 'https://www.interwetten.com/en/sportsbook/l/405931/belarus-vysshaya-liga', 1, 1),
(418, 'Poland Cup (90´)', 'https://www.interwetten.com/en/sportsbook/l/105361/poland-cup-90', 1, 1),
(419, 'Poland Ekstraklasa', 'https://www.interwetten.com/en/sportsbook/l/1059/poland-ekstraklasa', 1, 1),
(420, 'Poland League 2', 'https://www.interwetten.com/en/sportsbook/l/406254/poland-league-2', 1, 1),
(421, 'Croatia 1.HNL', 'https://www.interwetten.com/en/sportsbook/l/406081/croatia-1-hnl', 1, 1),
(422, 'Israel First League', 'https://www.interwetten.com/en/sportsbook/l/10618/israel-first-league', 1, 1),
(423, 'Major League Soccer', 'https://www.interwetten.com/en/sportsbook/l/10750/major-league-soccer', 1, 1),
(424, 'North American Soccer League', 'https://www.interwetten.com/en/sportsbook/l/406331/north-american-soccer-league', 1, 1),
(425, 'Argentina 1st League', 'https://www.interwetten.com/en/sportsbook/l/105121/argentina-1st-league', 1, 1),
(426, 'Argentina Nacional B', 'https://www.interwetten.com/en/sportsbook/l/405902/argentina-nacional-b', 1, 1),
(427, 'Brazil Serie A', 'https://www.interwetten.com/en/sportsbook/l/405525/brazil-serie-a', 1, 1),
(428, 'Mexico Primera Division', 'https://www.interwetten.com/en/sportsbook/l/405250/mexico-primera-division', 1, 1),
(429, 'Mexico Ascenso', 'https://www.interwetten.com/en/sportsbook/l/406106/mexico-ascenso', 1, 1),
(430, 'Peru 1st League', 'https://www.interwetten.com/en/sportsbook/l/405417/peru-1st-league', 1, 1),
(431, 'Chile 1st League', 'https://www.interwetten.com/en/sportsbook/l/405415/chile-1st-league', 1, 1),
(432, 'Colombia Liga Postobon', 'https://www.interwetten.com/en/sportsbook/l/405736/colombia-liga-postobon', 1, 1),
(433, 'Uruguay First League', 'https://www.interwetten.com/en/sportsbook/l/405440/uruguay-first-league', 1, 1),
(434, 'Paraguay Primera Division', 'https://www.interwetten.com/en/sportsbook/l/406291/paraguay-primera-division', 1, 1),
(435, 'World Cup 2014', 'https://www.interwetten.com/en/sportsbook/l/10406/world-cup-2014', 1, 1),
(436, 'European Championship 2016', 'https://www.interwetten.com/en/sportsbook/l/10405/european-championship-2016', 1, 1),
(437, 'ATP Vienna Doubles', 'https://www.interwetten.com/en/sportsbook/l/407157/atp-vienna-doubles', 1, 2),
(438, 'ATP Basel Qualification', 'https://www.interwetten.com/en/sportsbook/l/407170/atp-basel-qualification', 1, 2),
(439, 'ATP Valencia Qualification', 'https://www.interwetten.com/en/sportsbook/l/407168/atp-valencia-qualification', 1, 2),
(440, 'WTA Tour Championships Istanbul', 'https://www.interwetten.com/en/sportsbook/l/115067/wta-tour-championships-istanbul', 1, 2),
(441, 'Davis Cup', 'https://www.interwetten.com/en/sportsbook/l/405265/davis-cup', 1, 2),
(442, 'Fed Cup', 'https://www.interwetten.com/en/sportsbook/l/115199/fed-cup', 1, 2);

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
