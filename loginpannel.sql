-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2021 at 02:49 PM
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
(1, 'aayu', 'jain', 'aayu@gmail.com', '9167543456', '$2y$10$FdWJSCNdRsfpm0yAcKRDuuwImB8wezuc6wGJd9AIiV8zfjI2iWShm', 'Female', 'http://localhost/task2php/registration.php', 'indore'),
(2, 'aman', 'namdev', 'aman@gmail.com', '6267088234', '$2y$10$QFHgRH5XjrPSj9z7UxGdteQf8X13kSI0.LPwVSH0mYS2HY9Gb/lLe', 'Male', 'http://localhost/task2php/registration.php', 'ujjain'),
(3, 'ruchi', 'malviya', 'ruchi@gmail.com', '6267088236', '$2y$10$N7VHQLN/21freoHvTcKw5.nYZZ/RkhPq6UWRjaxhMLpckYM7CIgh.', 'Female', 'http://localhost/task2php/registration.php', 'ujjain'),
(4, 'sonu', 'malviya', 'sonu@gmail.com', '3456789123', '$2y$10$msjr4h/e5uMo8yznzmNXbOh3XY2HcvtwF3ToUZeomhsJqEFU2Dowi', 'Male', 'http://localhost/task2php/registration.php', 'indore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
