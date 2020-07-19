-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 06:37 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
`id` int(11) NOT NULL,
  `bed_no` varchar(10) NOT NULL,
  `bed_price` varchar(10) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `bed_no`, `bed_price`, `ward_id`, `status`) VALUES
(95, 'b-1', '300', 12, 1),
(96, 'b-2', '400', 12, 0),
(97, 'k', '300', 13, 0),
(98, 'j', '400', 13, 1),
(99, 'm', '400', 13, 0),
(100, 'b-1', '400', 14, 0),
(101, 'bb', '400', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE IF NOT EXISTS `billings` (
`id` int(11) NOT NULL,
  `room_unit_charge` int(11) NOT NULL,
  `total_room_charge` int(11) NOT NULL,
  `consulting_fees` int(11) NOT NULL,
  `test_id` varchar(60) NOT NULL,
  `other_fees` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `concession` int(11) NOT NULL,
  `net_amount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `room_unit_charge`, `total_room_charge`, `consulting_fees`, `test_id`, `other_fees`, `total_amount`, `concession`, `net_amount`, `amount_paid`) VALUES
(145, 0, 0, 200, '1,2', 200, 0, 5, 0, 1100),
(146, 0, 0, 200, '2,3', 200, 0, 5, 0, 200),
(149, 0, 0, 200, '1,2', 200, 0, 5, 0, 1220),
(150, 0, 0, 500, '1,2', 200, 0, 5, 0, 1805),
(151, 0, 0, 250, '1,2', 200, 0, 5, 0, 1473),
(152, 0, 0, 0, '2', 500, 0, 5, 0, 1330);

-- --------------------------------------------------------

--
-- Table structure for table `cabins`
--

CREATE TABLE IF NOT EXISTS `cabins` (
`id` int(11) NOT NULL,
  `cabin_no` varchar(10) NOT NULL,
  `cabin_price` varchar(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cabins`
--

INSERT INTO `cabins` (`id`, `cabin_no`, `cabin_price`, `status`) VALUES
(7, 'c-1', '200', 0),
(8, 'c-2', '300', 0),
(9, 'c-4', '500', 0),
(10, 'c-9', '300', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard User', '{"doctor": 1}'),
(2, 'Administrator', '{\r\n"admin": 1,\r\n"moderator" : 1\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
`id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `guardian` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `age` smallint(6) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `cabin_id` int(11) NOT NULL,
  `vipcabin_id` int(11) NOT NULL,
  `bed_id` int(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `admitting_doctor_id` int(11) NOT NULL,
  `admitting_nurse_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `joined` datetime NOT NULL,
  `operator_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `guardian`, `address`, `age`, `gender`, `telephone`, `cabin_id`, `vipcabin_id`, `bed_id`, `account_id`, `admitting_doctor_id`, `admitting_nurse_id`, `director_id`, `joined`, `operator_id`, `billing_id`, `status`) VALUES
(125, 'Hasan Ali', '', 'bogra', 22, 'male', '45236589', 0, 0, 101, 0, 0, 0, 0, '2016-11-23 22:51:11', 5, 145, 1),
(126, 'nahid hasan', '', '', 30, 'male', '41235689', 0, 8, 0, 0, 3, 0, 0, '2016-11-25 10:52:24', 5, 146, 0),
(129, 'tausiful islam', 'nurul islam', 'poilanpur, pabna', 28, 'male', '45236589', 0, 0, 98, 0, 3, 0, 0, '2016-12-13 10:49:05', 5, 149, 0),
(130, 'dfsd dfgf', '', '', 22, 'male', '45236589', 0, 0, 96, 0, 3, 0, 0, '2016-12-17 19:05:34', 5, 150, 1),
(131, 'abdus salam', 'ppp', 'dfsdf', 26, 'male', '45236589', 0, 0, 97, 0, 0, 0, 0, '2017-01-01 21:29:25', 5, 151, 1),
(132, 'fdg hhh', 'dfd', 'sfdsdf', 25, 'male', '01232468977', 0, 0, 96, 0, 3, 0, 0, '2017-08-07 22:32:32', 5, 152, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
`id` int(11) NOT NULL,
  `test_name` varchar(60) NOT NULL,
  `test_price` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `test_price`) VALUES
(1, 'urine', '300'),
(2, 'xray', '500'),
(3, 'blood', '500'),
(4, 'urin', '500'),
(5, 'x-ray', '500'),
(6, 'jhj', '300');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `salt`, `joined`, `group`) VALUES
(5, 'tausif', 'Tausiful Islam', '', '3706d922187cbfdee42e34a07d78114105ba5e80d1efa97eb0d1203438fe257c', 'ü‰¡® aœ''±Ûé2µœ³æ¦þÍmœ!H–‘Î¶Qþ-', '2016-07-25 09:47:05', 2),
(11, 'tanmay', 'tanmay', '', 'e9cec2b29522136d8f84fadad3287b745b793e2f77e3e30ef515968edc51644e', 'iƒ„à³ŠâÆi©Ãç#©ÖjÓ)PiñŽ;°ÝKZ', '2017-01-08 10:12:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vipcabins`
--

CREATE TABLE IF NOT EXISTS `vipcabins` (
`id` int(11) NOT NULL,
  `vipcabin_no` varchar(10) NOT NULL,
  `vipcabin_price` varchar(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `vipcabins`
--

INSERT INTO `vipcabins` (`id`, `vipcabin_no`, `vipcabin_price`, `status`) VALUES
(4, 'vc-1', '300', 1),
(5, 'vc-2', '600', 1),
(6, 'vc-4', '6000', 0),
(7, 'vc-5', '300', 0),
(8, 'v-11', '200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE IF NOT EXISTS `wards` (
`id` int(11) NOT NULL,
  `ward_name` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `ward_name`) VALUES
(12, 'w-1'),
(13, 'w-2'),
(14, 'w-3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabins`
--
ALTER TABLE `cabins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vipcabins`
--
ALTER TABLE `vipcabins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `cabins`
--
ALTER TABLE `cabins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vipcabins`
--
ALTER TABLE `vipcabins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
