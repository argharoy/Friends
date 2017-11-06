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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `joined_on` datetime NOT NULL,
  `avatar` blob NOT NULL,
  `friends_array` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `firstname`, `lastname`, `email`, `password`, `joined_on`, `avatar`, `friends_array`) VALUES
(1, 'Argha', 'Roy', 'roy.argha08@gmail.com', '43acf52647c51ee5b1bc308100b95a73', '2014-12-23 00:12:36', 0x75736572732f726f792e6172676861303840676d61696c2e636f6d2f6176617461722f32643136383664343733663765323432656634313236313137333136656434332e6a7067, '17,21'),
(17, 'Shreya', 'Banerjee', 'shreya@gmail.com', '4a3232c59ecda21ac71bebe3b329bf36', '2014-12-23 00:43:40', 0x75736572732f73687265796140676d61696c2e636f6d2f6176617461722f63613435383565313137323036353862343832396361376334623135646236332e6a7067, '1,21,23'),
(21, 'neha', 'jaan', 'nehajaan70@gmail.com', '01775d204e5a3a2d6ff2aae770859a18', '2014-12-27 10:55:48', 0x30, '1,17'),
(23, 'Shenaya', 'golu', 'shenaya.golu@gmail.com', '68aa7f36ddbc252f82b82a6f9aada2c2', '2014-12-30 13:41:13', 0x30, '17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `members` ADD FULLTEXT KEY `firstname` (`firstname`,`lastname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
