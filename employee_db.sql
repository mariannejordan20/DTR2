-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 03:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`ID`, `username`, `password`, `fullname`, `user_type`) VALUES
(1, 'p.luarez', 'p@ssw0rd', 'pol full name', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `employee_information`
--

CREATE TABLE `employee_information` (
  `ID` int(11) NOT NULL,
  `Employee_ID` varchar(100) NOT NULL,
  `Employee_FullName` varchar(100) NOT NULL,
  `Employee_Department` varchar(100) NOT NULL,
  `Employee_Position` varchar(100) NOT NULL,
  `Employee_Sex` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_information`
--

INSERT INTO `employee_information` (`ID`, `Employee_ID`, `Employee_FullName`, `Employee_Department`, `Employee_Position`, `Employee_Sex`, `user_type`) VALUES
(1, '2021001', 'CRIS FULL NAME', 'Malanday', 'Staff', 'Male', 'employee'),
(2, '2021002', 'QWE FULL NAME', 'Malanday', 'Staff', 'Female', 'employee'),
(3, '2021003', 'AWDWA FULL NAME', 'Malanday', 'Driver', 'Female', 'employee'),
(4, '2021004', 'POL FULL NAME', 'Malanday', 'Staff', 'Female', 'employee'),
(5, '2021005', 'LOP FULL NAME', 'Sto. Niño', 'Staff', 'Female', 'employee'),
(6, '2021006', 'GHJ FULL NAME', 'Sto. Niño', 'Staff', 'Female', 'employee'),
(7, '2021007', 'TER FULL NAME', 'Sto. Niño', 'Staff', 'Female', 'employee'),
(8, '2021008', 'BNF FULL NAME', 'Sto. Niño', 'Staff', 'Male', 'employee'),
(9, '2021009', 'YUI FULL NAME', 'Sto. Niño', 'Staff', 'Female', 'employee'),
(11, '2021011', 'UBAS FULL NAME', 'Tumana', 'Staff', 'Female', 'employee'),
(12, '2021012', 'PASI FULL NAME', 'Tumana', 'Staff', 'Female', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

CREATE TABLE `employee_log` (
  `ID` int(11) NOT NULL,
  `Employee_ID` varchar(100) NOT NULL,
  `Employee_Date` varchar(100) NOT NULL,
  `Employee_Time` varchar(100) NOT NULL,
  `Employee_Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_log`
--

INSERT INTO `employee_log` (`ID`, `Employee_ID`, `Employee_Date`, `Employee_Time`, `Employee_Status`) VALUES
(1, '2021001', '03/14/2021', '07:24:42  PM', 'In'),
(2, '2021005', '03/14/2021', '07:25:07  PM', 'Out'),
(3, '2021001', '03/16/2021', '08:53:33  PM', 'In');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee_information`
--
ALTER TABLE `employee_information`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_information`
--
ALTER TABLE `employee_information`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
