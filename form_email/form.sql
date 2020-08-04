-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 02:38 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manual`
--

CREATE TABLE `tbl_manual` (
  `id` int(11) NOT NULL,
  `employee_no` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `occurrence_date` varchar(255) NOT NULL,
  `explanation_code` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `pay_status` varchar(255) NOT NULL,
  `clock_in` varchar(255) NOT NULL,
  `clock_out` varchar(255) NOT NULL,
  `work_order` varchar(11) NOT NULL,
  `seq` varchar(11) NOT NULL,
  `total_hour` int(11) NOT NULL,
  `total_min` int(11) NOT NULL,
  `less_hour` int(11) NOT NULL,
  `less_min` int(11) NOT NULL,
  `net_hour` int(11) NOT NULL,
  `net_min` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '1',
  `identity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time`
--

CREATE TABLE `tbl_time` (
  `id` int(11) NOT NULL,
  `employee_no` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `pay_end` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `begin_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `total_hours` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '1',
  `identity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_manual`
--
ALTER TABLE `tbl_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_manual`
--
ALTER TABLE `tbl_manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
