-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2017 at 04:25 PM
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
-- Table structure for table `album_names`
--

CREATE TABLE `album_names` (
  `SL` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `album_name` varchar(64) NOT NULL,
  `image_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album_names`
--

INSERT INTO `album_names` (`SL`, `member_id`, `album_name`, `image_count`) VALUES
(1, 1, 'Chotu Ka Birthday', 6),
(2, 1, 'my_shreya', 4),
(6, 17, 'me', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album_names`
--
ALTER TABLE `album_names`
  ADD PRIMARY KEY (`SL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album_names`
--
ALTER TABLE `album_names`
  MODIFY `SL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
