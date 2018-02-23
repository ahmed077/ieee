-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 11:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ieee`
--
CREATE DATABASE IF NOT EXISTS `ieee` DEFAULT CHARACTER SET utf32 COLLATE utf32_general_ci;
USE `ieee`;

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `semester` int(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook_profile` varchar(255) NOT NULL,
  `mobile` int(16) NOT NULL,
  `membership_type` varchar(50) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `name`, `faculty`, `semester`, `email`, `facebook_profile`, `mobile`, `membership_type`, `event_id`) VALUES
(43, 'dddd', 'ddd', 2, 'ddasd', 'sss', 2131, '1', 0),
(44, 'dddd', 'ddd', 2, 'ddasd', 'sss', 2131, '1', 35),
(45, 'dddd', 'ddd', 2, 'ddasd', 'sss', 2131, '1', 35),
(46, 'dddd', 'ddd', 2, 'ddasd', 'sss', 2131, '1', 35),
(47, 'dddd', 'ddd', 2, 'ddasd', 'sss', 2131, '1', 35),
(48, 'sdds', 'saasd', 2, 'sadasdasd', 'sdasd', 2147483647, '1', 39),
(49, 'sdds', 'saasd', 2, 'sadasdasd', 'sdasd', 2147483647, '1', 39);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(511) NOT NULL,
  `location` varchar(511) NOT NULL,
  `date` date NOT NULL,
  `description` mediumtext NOT NULL,
  `speakers` varchar(1023) NOT NULL,
  `speakers_images` varchar(4095) NOT NULL,
  `mission` varchar(1023) NOT NULL,
  `goals` varchar(1023) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_open` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `location`, `date`, `description`, `speakers`, `speakers_images`, `mission`, `goals`, `event_type`, `event_open`) VALUES
(1, 'Event Title', 'images/events/da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Location', '0000-00-00', 'Description', 'Speaker', 'images/speakers/person-vector.jpg', 'Mission', 'Goal', 'workshop', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `admin`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', 1),
(2, 'staff', 'staff', 'staff', 'staff@staff.com', 2),
(3, 'member', 'member', 'member', 'member@member.com', 0),
(4, 'substaff', 'substaff', 'substaff', 'substaff@substaff.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Committee` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Facebook` varchar(255) NOT NULL DEFAULT '#',
  `Linkedin` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`ID`, `Name`, `Committee`, `Img`, `Facebook`, `Linkedin`) VALUES
(1, 'xx', 'xxx', 'images/volunteers/581c52cbc3a21951d1a8b76d1874397265cf61aa.jpg', 'xxx', 'xx'),
(2, 'xx', 'xxx', 'images/volunteers/581c52cbc3a21951d1a8b76d1874397265cf61aa.jpg', 'xxx', 'xx'),
(3, 'xx', 'xxx', 'images/volunteers/581c52cbc3a21951d1a8b76d1874397265cf61aa.jpg', 'xxx', 'xx'),
(4, 'ii', 'iii', 'images/volunteers/7b2d680da2fa1361e4bd0c4494c60a9266988e31.jpg', 'iiii', 'iii');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
