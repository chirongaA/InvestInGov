-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 02:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bonds`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `bond_id` varchar(100) NOT NULL,
  `yield` int(100) NOT NULL,
  `phonenumber` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `username`, `bond_id`, `yield`, `phonenumber`) VALUES
(1, 'lisa23ty', 'KE0000001', 100000, 793704787),
(2, 'lisa23ty', 'KE0000001', 100000, 787462843),
(3, 'lisa23ty', 'KE0000001', 100000, 787462843),
(4, 'lisa23ty', 'KE0000001', 100000, 793704787),
(5, 'lisa23ty', 'KE0000001', 100000, 2147483647),
(6, 'lisa23ty', 'KE0000001', 100000, 2147483647),
(7, 'lisa23ty', 'KE0000001', 100000, 2147483647),
(8, 'lisa23ty', 'KE0000002', 2, 2147483647),
(9, 'lisa23ty', 'KE0000002', 2, 2147483647),
(10, 'lisa23ty', 'KE0000002', 2, 2147483647),
(11, 'hodongo12', 'KE0000003', 0, 2147483647),
(12, 'hodongo12', 'KE0000003', 0, 2147483647),
(13, 'hodongo12', 'KE0000003', 0, 2147483647),
(14, 'hodongo12', 'KE0000003', 1, 2147483647),
(15, 'hodongo12', 'KE0000003', 1, 2147483647),
(16, 'lisa23ty', 'KE0000003', 2, 2147483647),
(17, 'lisa23ty', 'KE0000003', 2, 2147483647),
(18, 'lisa23ty', 'KE0000003', 2, 2147483647),
(19, 'lisa23ty', 'KE0000003', 2, 2147483647),
(20, 'hodongo12', 'KE0000001', 1, 793704787),
(21, 'hodongo12', 'KE0000001', 1, 793704787),
(22, 'hodongo12', 'KE0000001', 1, 793704787),
(23, 'hodongo12', 'KE0000001', 1, 793704787),
(24, 'hodongo12', 'KE0000001', 1, 793704787);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
