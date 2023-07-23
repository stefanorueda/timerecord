-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 01:47 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timerecord`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `created_by` int(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `datetime_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `created_by`, `file`, `datetime_added`, `datetime_updated`) VALUES
(10, 'Stef3', '2', 1, 'assets/media/qrcode/5374656632.png', '2023-07-23 11:00:57', '2023-07-23 19:03:10'),
(13, 'Asfasf', 'Asgasg', 1, 'assets/media/qrcode/417366617366417367617367.png', '2023-07-23 21:41:49', '2023-07-23 21:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_in` int(11) NOT NULL,
  `time_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `employee_id`, `date_added`, `time_in`, `time_out`) VALUES
(1, 10, '2023-07-23 21:08:12', 1, 0),
(2, 10, '2023-07-23 21:23:04', 0, 1),
(3, 10, '2023-07-23 21:24:00', 1, 0),
(4, 10, '2023-07-23 21:24:04', 0, 1),
(5, 10, '2023-07-23 21:24:08', 1, 0),
(6, 10, '2023-07-23 21:25:37', 0, 1),
(7, 13, '2023-07-23 21:41:56', 1, 0),
(8, 10, '2023-07-23 23:33:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `datetime_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `datetime_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_password`, `user_type`, `datetime_added`, `datetime_updated`) VALUES
(2, 'tepteprueda', '$2y$11$0ojaXryE2J2y8uRbHDX3K.Ol3PY7LUjx9MAErvD6030cyy5ZeJt06', 2, '2023-07-23 22:22:48', '2023-07-23 22:22:48'),
(3, 'teprueda', '$2y$11$JSAf6RRrLJcO7XhrZdlZRejtHu8FcxsvPgQQ37GcEqn0OaBobP6xq', 2, '2023-07-23 22:50:16', '2023-07-23 22:50:16'),
(4, 'tepruedasuperadmin', '$2y$11$fKPcG7FcnaH79ywXG2L9CuDEocyxeTsAmsBYeR9w6J3stweQ37Ide', 1, '2023-07-23 23:17:47', '2023-07-23 23:17:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
