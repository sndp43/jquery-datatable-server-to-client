-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2022 at 03:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testusersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `mobile_number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `mobile_number`) VALUES
(1, 'sa', 'sa', 1111111111),
(2, 'sa', 'sa', 1111111111),
(3, 'sa1', 'sa1', 2147483647),
(4, 'sa2', 'sa2', 2147483647),
(5, 'sa3', 'sa3', 2147483647),
(6, 'sa4', 'sa4', 2147483647),
(7, 'sa5', 'sa5', 2147483647),
(8, 'sa6', 'sa6', 1111111111),
(9, 'sa7', 'sa7', 777777777),
(10, 'sa8', 'sa8', 2147483647),
(11, 'sa9', 'sa9', 2147483647),
(12, 'sa111', 'sa111', 0),
(13, 'sa10', 'sa10', 1212121212),
(14, 'sa11', 'sa11', 2147483647),
(15, 'sa12', 'sa', 2147483647),
(16, 'sa13', 'sa13', 2147483647),
(17, 'sa14', 'sa14', 1111111111),
(18, 'sandeep', 'sndp.mdk@g.com', 1212121212),
(19, 'sandeep', '1sndp.mdk@g.com', 1212121212),
(20, 'sandeep', '2sndp.mdk@g.com', 1222222222),
(21, 'sandeep', '3sndp.mdk@g.com', 133333333),
(22, 'sandeep', '4sndp.mdk@g.com', 1444444444),
(23, 'sandeep', '5sndp.mdk@g.com', 1555555555),
(24, 'sandeep', '6sndp.mdk@g.com', 1666666666),
(25, 'sandeep', '7sndp.mdk@g.com', 1666777777),
(26, 'sandeep', '8sndp.mdk@g.com', 1888888888),
(27, 'sandeep', '9sndp.mdk@g.com', 1999999999),
(28, 'sandeep', '0sndp.mdk@g.com', 1000000000),
(29, 'sandeep', '11sndp.mdk@g.com', 1122222222),
(30, 'sandeep', '12sndp.mdk@g.com', 1133333333),
(31, 'sandeep', '13sndp.mdk@g.com', 1334444444);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
