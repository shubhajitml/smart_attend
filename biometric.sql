-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2019 at 01:13 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biometric`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `fingerprint` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `mob`, `full_name`, `designation`, `branch`, `last_login`, `fingerprint`) VALUES
(1, 'mukeshbathre@gcekjr.ac.in', '09876', 9437851422, 'Mekesh Bathre', 'HOD (CSE)', 'Computer Science and Engineering', '2018-09-14 15:58:49', 'khiah hjshjhuhsyuhgyuhgyugyugygyugbg878765564151');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_sheet`
--

CREATE TABLE `attendance_sheet` (
  `attandance_id` int(11) NOT NULL,
  `fk_subject_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fk_student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_sheet`
--

INSERT INTO `attendance_sheet` (`attandance_id`, `fk_subject_id`, `date`, `time`, `fk_student_id`) VALUES
(1, 2, '2019-03-06', '19:43:53', 1),
(2, 2, '2019-03-06', '23:23:38', 2),
(3, 1, '2019-03-06', '19:43:53', 1),
(4, 2, '2019-04-04', '13:24:30', 3),
(7, 3, '2019-04-04', '13:25:44', 3),
(8, 1, '2019-04-04', '13:25:50', 3);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_users`
--

CREATE TABLE `faculty_users` (
  `fac_id` int(11) NOT NULL,
  `fac_reg_no` varchar(100) NOT NULL,
  `fac_fing_serial` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `created_by` int(5) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_users`
--

INSERT INTO `faculty_users` (`fac_id`, `fac_reg_no`, `fac_fing_serial`, `name`, `email`, `mobile`, `branch`, `created_by`, `created_on`) VALUES
(1, 'CSE002', 0, 'Omkar Pattanaik', 'omkarpattanaik@gcekjr.ac.in', 9439413440, 'Computer Science and Engineering', 1, '2019-03-06 19:08:08'),
(2, 'CSE003', 1, 'Sanjit Kumar Barik', 'sanjitbarik@gcekjr.ac.in', 9937583247, 'Computer Science and Engineering', 1, '2019-03-06 19:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `fac_attendance_sheet`
--

CREATE TABLE `fac_attendance_sheet` (
  `attandance_id` int(11) NOT NULL,
  `fk_subject_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fk_faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stu_id` int(11) NOT NULL,
  `reg_no` bigint(20) NOT NULL,
  `stu_fing_serial` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `created_by` int(5) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stu_id`, `reg_no`, `stu_fing_serial`, `name`, `branch`, `email`, `mobile`, `created_by`, `created_on`) VALUES
(1, 1501104078, 151, 'Sasmita Dash', 'Computer Science and Engineering', 'sasmita1798@gmail.com', 8763656601, 1, '2019-03-06 19:11:01'),
(2, 1501104083, 152, 'Sonali Priyadarsini Rout', 'Computer Science and Engineering', 'a.s.sonali.rout@gmail.com', 9348216431, 1, '2019-03-06 19:13:55'),
(3, 1501104080, 150, 'Shubhajit Das', 'Computer Science and Engineering', 'shubhajitdas121@gmail.com', 8280144660, 1, '2019-03-06 21:53:54'),
(4, 1501104054, 161, 'Amitabh Sekhar Mishra', 'Computer Science and Engineering', 'amitabhmishra592@gmail.com', 7064207517, 155, '2019-03-09 23:04:16'),
(5, 1501104058, 154, 'Ashirbad Samantaray', 'Computer Science and Engineering', 'contact@ashirbad.me', 7008917985, 1, '2019-03-09 23:08:08'),
(6, 1501104055, 153, 'Ananya Jena', 'Computer Science and Engineering', 'ajena635@gmail.com', 7978079693, 1, '2019-03-09 23:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` int(2) NOT NULL,
  `fk_faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `branch`, `semester`, `fk_faculty_id`) VALUES
(1, 'PCS8J002', 'Expert Systems', 'Computer Science and Engineering', 8, 2),
(2, 'PCP8H001', 'Entrepreneurship Development', 'Computer Science and Engineering', 8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_sheet`
--
ALTER TABLE `attendance_sheet`
  ADD PRIMARY KEY (`attandance_id`),
  ADD UNIQUE KEY `attendance_unique` (`fk_subject_id`,`date`,`fk_student_id`) USING BTREE;

--
-- Indexes for table `faculty_users`
--
ALTER TABLE `faculty_users`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `fac_attendance_sheet`
--
ALTER TABLE `fac_attendance_sheet`
  ADD PRIMARY KEY (`attandance_id`),
  ADD UNIQUE KEY `fk_subject_id` (`fk_subject_id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD UNIQUE KEY `fk_faculty_id` (`fk_faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stu_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mob` (`mobile`),
  ADD UNIQUE KEY `regno` (`reg_no`),
  ADD UNIQUE KEY `fk_fing_serial` (`stu_fing_serial`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attendance_sheet`
--
ALTER TABLE `attendance_sheet`
  MODIFY `attandance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `faculty_users`
--
ALTER TABLE `faculty_users`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fac_attendance_sheet`
--
ALTER TABLE `fac_attendance_sheet`
  MODIFY `attandance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
