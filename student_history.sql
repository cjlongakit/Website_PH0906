-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 07:18 PM
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
-- Database: `student_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_history`
--

CREATE TABLE `student_history` (
  `id` int(11) NOT NULL,
  `ph906` varchar(50) NOT NULL,
  `history_text` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `admin_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_history`
--

INSERT INTO `student_history` (`id`, `ph906`, `history_text`, `timestamp`, `admin_id`) VALUES
(21, '701', 'YEYEYEYEYE', '2025-09-09 01:11:25', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_history`
--
ALTER TABLE `student_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ph906` (`ph906`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_history`
--
ALTER TABLE `student_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_history`
--
ALTER TABLE `student_history`
  ADD CONSTRAINT `student_history_ibfk_1` FOREIGN KEY (`ph906`) REFERENCES `masterlist` (`ph906`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
