-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2021 at 04:34 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginpannel`
--

-- --------------------------------------------------------

--
-- Table structure for table `index_search`
--

CREATE TABLE `index_search` (
  `id` int NOT NULL,
  `uid` int NOT NULL,
  `word` varchar(255) NOT NULL,
  `added` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `index_search`
--

INSERT INTO `index_search` (`id`, `uid`, `word`, `added`) VALUES
(1, 1, 'neha@123', '04 Oct 2021'),
(2, 1, 'neha@123789&', '04 Oct 2021'),
(3, 2, 'abc', '04 Oct 2021'),
(4, 2, 'aman@123', '04 Oct 2021');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `weburl` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `gender`, `weburl`, `address`) VALUES
(1, 'neha', 'rathore', 'neha@gmail.com', '6267088856', '$2y$10$Ptop0xXPBj/bN0eARnT5kufLqEpteotJ9j2ee5QMNTiOPOXQdF4Zu', 'Female', 'http://localhost/task2php/registration.php', 'ujjain'),
(2, 'aman', 'namdev', 'aman@gmail.com', '6267088853', '$2y$10$/WiRsFZQERJIKg.gfylUNeInQ6sBC4VJjC3OPFfzx4AFLDoXvIZCG', 'Male', 'http://localhost/task2php/registration.php', 'nmh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `index_search`
--
ALTER TABLE `index_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `index_search`
--
ALTER TABLE `index_search`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
