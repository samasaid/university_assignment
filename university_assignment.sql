-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 09:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees_tbl`
--

CREATE TABLE `employees_tbl` (
  `emp_id` int(11) NOT NULL,
  `fullName` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_tbl`
--

INSERT INTO `employees_tbl` (`emp_id`, `fullName`, `email`, `username`, `password`, `created_on`) VALUES
(7, 'sama said', 'eng.samasaid19@gmail.com', 'sama19', 'df49071c2290e5f01412c48930c6ff2a304f9137', '2021-04-27 07:02:25'),
(8, 'sama said', 'eng.samasaid15@gmail.com', 'soma19', 'df49071c2290e5f01412c48930c6ff2a304f9137', '2021-04-28 06:32:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `email` (`email`,`username`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
