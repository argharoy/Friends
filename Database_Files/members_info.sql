-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2017 at 04:26 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friends`
--

-- --------------------------------------------------------

--
-- Table structure for table `members_info`
--

CREATE TABLE `members_info` (
  `SL` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `schclg` varchar(225) NOT NULL,
  `work` varchar(225) NOT NULL,
  `about` longtext NOT NULL,
  `quotes` mediumtext NOT NULL,
  `b_day` enum('1','2','3','4','5','6','7','8','9','10','','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') NOT NULL,
  `b_month` enum('January','Feburary','March','April','May','June','July','August','September','October','November','December') NOT NULL,
  `b_year` enum('1990','1991','1992','1993','1994','1995','1996','1997','1999','2000','2001','2002','2003','2003','2004') NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `relationship` enum('Single','In A Relation','Engaged','Married','In A Civil Union','In A Domestic Partnership','In A Open Relation','Its Complicated','Seperated','Divorced','Widowed') NOT NULL,
  `interested_in` enum('Men','Women','Others') NOT NULL,
  `relegion` varchar(64) NOT NULL,
  `hometown` varchar(64) NOT NULL,
  `current_city` varchar(64) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_info`
--

INSERT INTO `members_info` (`SL`, `member_id`, `schclg`, `work`, `about`, `quotes`, `b_day`, `b_month`, `b_year`, `gender`, `relationship`, `interested_in`, `relegion`, `hometown`, `current_city`, `mobile_no`, `email`) VALUES
(1, 1, 'Haldia Institute Of Technology', 'Youtube Inc.', '', '', '12', 'July', '1995', 'Male', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members_info`
--
ALTER TABLE `members_info`
  ADD PRIMARY KEY (`SL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members_info`
--
ALTER TABLE `members_info`
  MODIFY `SL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
