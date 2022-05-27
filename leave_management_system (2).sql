-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 05:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `user_profile_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `leave_start_date` varchar(20) NOT NULL,
  `leave_end_date` varchar(20) NOT NULL,
  `leave_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_profile_id`, `name`, `leave_start_date`, `leave_end_date`, `leave_reason`) VALUES
(4, 3, 'Test name', '12 may 2022', '13 may 2022', 'sick leave');

-- --------------------------------------------------------

--
-- Table structure for table `processed_requests`
--

CREATE TABLE `processed_requests` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `user_profile_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `section` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `section`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Nilgiri', 'test1', '$2y$10$.ChfvUhrQoVN6KLAT9MAgOF5KlVfxrzBhv7.Ks8S87Wk7JdkgTTvK', '', '0000-00-00 00:00:00'),
(2, 'Test', 'shubham_23065', '$2y$10$EXAtbeFxwRhhtYVB6oG8bu7OEbVCji.ptlB9RtCy4V/pxMZAmyWYK', '', '0000-00-00 00:00:00'),
(3, 'mardi', 'student1', '$2y$10$YuQlzIx0pIHRGOEQYbcKoePQNCcazXxsKZSZO3wfrU.Rw5Av9G5Jq', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`user_profile_id`);

--
-- Indexes for table `processed_requests`
--
ALTER TABLE `processed_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_id` (`leave_id`),
  ADD KEY `user_id` (`user_profile_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `processed_requests`
--
ALTER TABLE `processed_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `profile_id` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `processed_requests`
--
ALTER TABLE `processed_requests`
  ADD CONSTRAINT `leave_id` FOREIGN KEY (`leave_id`) REFERENCES `leave_requests` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
