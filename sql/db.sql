SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studyapp_finaldraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `comment`, `time`) VALUES
(1, 6, 'The app sucks', '2019-07-30 07:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` varchar(250) NOT NULL,
  `class` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `num_members` int(11) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `creator`, `class`, `location`, `max_capacity`, `num_members`, `date`, `start`, `end`, `time_created`) VALUES
(15, 'annie', 'ABC123', 'Maricopa County, AZ, USA', 12, 2, '2019-07-30', '11:11:00', '14:22:00', '2019-07-30 02:31:08'),
(11, 'JerryBob', 'ABC123', 'Life Sciences Center, Tempe, AZ 85281, USA', 3, 0, '2019-07-25', '11:11:00', '14:22:00', '2019-07-25 06:28:51'),
(12, 'annie', 'ABC123', 'West Hall, 1000 Cady Mall, Tempe, AZ 85281, USA', 2, 2, '2019-07-25', '11:11:00', '11:11:00', '2019-07-25 06:29:27'),
(13, 'random', 'ABC123', '301 E Orange St, Tempe, AZ 85281, USA', 4, 3, '2019-07-25', '11:11:00', '23:12:00', '2019-07-25 06:30:06'),
(14, 'JerryBob', 'ABC321', '951 S Forest Mall, Tempe, AZ 85281, USA', 6, 1, '2019-07-25', '11:11:00', '14:22:00', '2019-07-25 06:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `user_name`, `time`) VALUES
(24, 6, 'annie', '2019-07-25 06:29:05'),
(23, 5, 'JerryBob', '2019-07-25 06:05:20'),
(22, 7, 'random', '2019-07-25 06:04:15'),
(21, 6, 'annie', '2019-07-25 06:01:37'),
(20, 5, 'JerryBob', '2019-07-25 04:06:23'),
(19, 5, 'JerryBob', '2019-07-08 22:14:30'),
(18, 5, 'JerryBob', '2019-06-03 12:48:34'),
(17, 5, 'JerryBob', '2019-06-03 12:18:17'),
(16, 5, 'JerryBob', '2019-06-03 12:17:08'),
(15, 5, 'JerryBob', '2019-06-02 19:04:44'),
(14, 5, 'JerryBob', '2019-06-02 07:53:58'),
(25, 7, 'random', '2019-07-25 06:29:44'),
(26, 5, 'JerryBob', '2019-07-25 06:30:19'),
(27, 5, 'JerryBob', '2019-07-27 06:55:10'),
(28, 7, 'random', '2019-07-27 10:06:45'),
(29, 5, 'JerryBob', '2019-07-29 19:11:20'),
(30, 6, 'annie', '2019-07-30 02:30:29'),
(31, 5, 'JerryBob', '2019-07-30 02:45:06'),
(32, 6, 'annie', '2019-07-30 05:55:59'),
(33, 6, 'annie', '2019-07-30 06:59:11'),
(34, 6, 'annie', '2019-08-02 01:01:27'),
(35, 5, 'JerryBob', '2019-08-08 20:20:36'),
(36, 8, 'nobody', '2019-08-14 22:34:53'),
(37, 9, 'nobody', '2019-08-14 22:49:07'),
(38, 6, 'annie', '2019-08-18 05:47:44'),
(39, 6, 'annie', '2019-08-27 15:08:44'),
(40, 6, 'annie', '2019-09-10 17:14:32'),
(41, 6, 'annie', '2019-09-10 17:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `logouts`
--

DROP TABLE IF EXISTS `logouts`;
CREATE TABLE IF NOT EXISTS `logouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logouts`
--

INSERT INTO `logouts` (`id`, `user_id`, `user_name`, `time`) VALUES
(17, 6, 'annie', '2019-07-25 06:03:28'),
(16, 5, 'JerryBob', '2019-07-25 06:00:12'),
(15, 5, 'JerryBob', '2019-06-06 18:49:14'),
(14, 5, 'JerryBob', '2019-06-03 12:48:26'),
(13, 5, 'JerryBob', '2019-06-03 12:18:00'),
(12, 5, 'JerryBob', '2019-06-03 12:17:01'),
(11, 2, 'JerryBob', '2019-06-02 07:53:08'),
(18, 7, 'random', '2019-07-25 06:04:51'),
(19, 5, 'JerryBob', '2019-07-25 06:28:58'),
(20, 6, 'annie', '2019-07-25 06:29:34'),
(21, 7, 'random', '2019-07-25 06:30:11'),
(22, 5, 'JerryBob', '2019-07-27 10:06:18'),
(23, 7, 'random', '2019-07-27 10:48:10'),
(24, 5, 'JerryBob', '2019-07-30 02:30:22'),
(25, 6, 'annie', '2019-07-30 02:44:55'),
(26, 5, 'JerryBob', '2019-07-30 05:55:50'),
(27, 6, 'annie', '2019-07-30 06:57:31'),
(28, 6, 'annie', '2019-08-01 19:58:43'),
(29, 6, 'annie', '2019-08-02 01:11:04'),
(30, 8, 'nobody', '2019-08-14 22:43:28'),
(31, 9, 'nobody', '2019-08-14 22:52:40'),
(32, 6, 'annie', '2019-08-22 07:57:41'),
(33, 6, 'annie', '2019-09-10 17:13:59'),
(34, 6, 'annie', '2019-09-10 17:14:36'),
(35, 6, 'annie', '2019-09-10 20:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL DEFAULT '"N/A"',
  `profile_pic` varchar(250) NOT NULL DEFAULT '../profilePics/defaultAvatar.png',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `password`, `phone_number`, `profile_pic`, `time_created`) VALUES
(10, 'Bardsley', 'grandmastergaynde@gmail.com', '87e764d9ef5ba80b93821a9adfec87f3532ca241', '\"N/A\"', '../profilePics/defaultAvatar.png', '2019-09-10 21:02:36'),
(6, 'annie', 'annie@asu.edu', '51f836aa96db69b491ace1a154bb2fa591ec8537', '\"N/A\"', '../profilePics/defaultAvatar.png', '2019-07-25 06:01:30'),
(7, 'random', 'randoMan@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '303 452 8888', '../profilePics/defaultAvatar.png', '2019-07-25 06:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_bridge`
--

DROP TABLE IF EXISTS `user_group_bridge`;
CREATE TABLE IF NOT EXISTS `user_group_bridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `time_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_bridge`
--

INSERT INTO `user_group_bridge` (`id`, `user_id`, `group_id`, `time_joined`) VALUES
(11, 7, 13, '2019-07-25 06:30:06'),
(24, 6, 15, '2019-08-20 08:19:06'),
(25, 6, 12, '2019-08-20 08:19:08'),
(22, 6, 13, '2019-08-20 08:12:47');
COMMIT;