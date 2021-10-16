-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2021 at 11:41 AM
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
(1, 1, 'neH123', '07 Oct 2021'),
(2, 1, 'neha@#$@34', '07 Oct 2021'),
(3, 1, 'Neh#456', '07 Oct 2021'),
(5, 1, 'hhssdg', '07 Oct 2021'),
(13, 7, 'etsre123', '08 Oct 2021'),
(17, 2, '234Ac344', '08 Oct 2021'),
(18, 1, 'Neh@#789', '08 Oct 2021'),
(19, 2, '234Ac@#$', '08 Oct 2021');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt`
--

CREATE TABLE `login_attempt` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `attempt_time` datetime NOT NULL,
  `recaptcha_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(2, 'aman', 'namdev', 'aman@gmail.com', '6267088853', '$2y$10$/WiRsFZQERJIKg.gfylUNeInQ6sBC4VJjC3OPFfzx4AFLDoXvIZCG', 'Male', 'http://localhost/task2php/registration.php', 'nmh'),
(3, 'aayu', 'jain', 'aayu@gmail.com', '6267088856', '$2y$10$./6I0GrWEmPWOFSJA8/h8uanutYJ0POWi.JGb2UM4zgyTnGytZfim', 'Female', 'http://localhost/task2php/registration.php', 'indore'),
(4, 'Etstus', 'jaiiiiiin', 'etstest@mailinator.com', '1234567890', '$2y$10$/iCyVhq28FpCyapLWvdDJuLO3b0MIZ.U45skjKjQeE6hnnLVIvQp2', 'Female', 'http://localhost/task2php/registration.php', 'Sai ram plaza'),
(5, 'aayu', 'jain', 'aayu123@gmail.com', '6267088856', '$2y$10$Z.ocr2iu6O3VrJy1bT2u4.3HlmGZUWTk2615lMzDlEGQBMiKdG5c6', 'Female', 'http://localhost/task2php/registration.php', 'ujn'),
(6, 'ajay', 'mehta', 'ajay@gmail.com', '6267088567', '$2y$10$KVFbJGMNBC60NWAaLQZbZeWlFEQ.oWb.wAvikxFMm/QIb3bBYYkLC', 'Male', 'http://localhost/task2php/registration.php', 'indore'),
(7, 'roli', 'jain', 'roli.jain.ets@mailinator.com', '0147852963', '$2y$10$dIOJR0kV.lhsK1qx19joROk14MAB20y4dm68Hy51Rb.dauqGxLz/C', 'Female', 'http://localhost/task2php/registration.php', 'sai ram plaza '),
(8, 'tarun ', 'malviya', 'tarunmalviya333@gmail.com', '9584651020', '$2y$10$vXUCch.aJrXqqGzG9.G1UOVimXtCNmGup68q1YrjHCWn4S7274Z.a', 'Male', 'http://localhost/task2php/registration.php', 'dhgvkffdvgv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `index_search`
--
ALTER TABLE `index_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempt`
--
ALTER TABLE `login_attempt`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login_attempt`
--
ALTER TABLE `login_attempt`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
