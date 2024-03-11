-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 03:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lecturer_eva_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `department`, `program`, `level`, `user_type`, `password`, `date_created`) VALUES
(1, 'Admin', 'Mathematics and Computer Science', 'B. Sc. Computer Science', 'super', 'Super', '21232f297a57a5a743894a0e4a801fc3', '2023-03-30'),
(2, 'Admin 400', 'Mathematics and Computer Science', 'B. Sc. Computer Science', '400L', 'Admin', 'fc1ebc848e31e0a68e868432225e3c82', '2023-03-30'),
(3, 'Admin 200', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'Admin', 'c84258e9c39059a89ab77d846ddab909', '2023-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(10) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_title` text NOT NULL,
  `course_type` varchar(50) NOT NULL,
  `credit_unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `admin_id`, `course_code`, `course_title`, `course_type`, `credit_unit`) VALUES
(1, 0, 'CMP101', 'Pascal Programming I', 'Elective Course', '6 Unit'),
(3, 0, 'CMP432', 'Algorithm Almighty course', 'Core Course', '4 Unit'),
(4, 0, 'Mth208', 'Almighty Mathematics', 'Core Course', '4 Unit'),
(5, 1, 'CMP432', 'Algorithm I', 'Core Course', '3 Unit'),
(8, 2, 'CMP201', 'programming', 'Elective Course', '4 Unit'),
(9, 2, 'CMP205', 'Mathematices for Computer', 'Elective Course', '2 Unit'),
(14, 1, 'CMP101', 'Pascal Programming I', 'Elective Course', '2 Unit'),
(15, 3, 'CMP201', 'Pascal Programming I', 'Core Course', '3 Unit');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `admin_id`, `name`, `date_created`) VALUES
(1, 0, 'Mathematics and Computer Sc.', '2023-03-01 01:21:38'),
(4, 1, 'Mathematics and Computer Science', '2023-03-26 05:08:57'),
(5, 2, 'Mathematics And computer Science', '2023-03-25 13:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `hod_list`
--

CREATE TABLE `hod_list` (
  `id` int(10) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `hod_name` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hod_list`
--

INSERT INTO `hod_list` (`id`, `admin_id`, `hod_name`, `department`, `password`, `user_type`, `date_created`) VALUES
(1, 1, 'Dr Egahi', 'Mathematics and Computer Science', '17d84f171d54c301fabae1391a125c4e', 'HOD', '2023-03-26 16:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `l_id` int(50) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `lecturer_name` varchar(100) NOT NULL,
  `department` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(200) NOT NULL,
  `percentile` double NOT NULL DEFAULT 0,
  `user_type` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`l_id`, `admin_id`, `lecturer_name`, `department`, `program`, `level`, `course_code`, `course_title`, `percentile`, `user_type`, `password`, `date_created`) VALUES
(1, 1, 'Young Lecturer', 'Mathematics and Computer Science', 'B.sc Computer Science', '400L', 'CMP432', 'Algorithm I', 0, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-03-26 14:19:01'),
(2, 1, 'Dr Obilikwu', 'Mathematics and Computer Science', 'B.sc Computer Science', '400L', 'CMP432', 'Algorithm I', 0, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-03-30 08:28:40'),
(3, 2, 'Dr White', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'CMP201', 'programming', 0, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-03-30 08:34:36'),
(4, 2, 'Dr Obilikwu', 'Mathematics and Computer Science', 'B. Sc. Computer Science', '400L', 'CMP205', 'Mathematices for Computer', 100, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-04-06 13:08:09'),
(5, 2, 'Dr Steven ', 'Mathematics and Computer Science', 'B. Sc. Computer Science', '400L', 'CMP201', 'programming', 100, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-04-06 13:09:30'),
(6, 3, 'Mr Salumu', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'CMP201', 'Pascal Programming I', 100, 'Lecturer', '81dc9bdb52d04dc20036dbd8313ed055', '2023-04-06 23:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers_reports`
--

CREATE TABLE `lecturers_reports` (
  `id` int(20) NOT NULL,
  `admin_id` int(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `percentile` float DEFAULT NULL,
  `l_count` int(20) NOT NULL,
  `time_left` int(100) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturers_reports`
--

INSERT INTO `lecturers_reports` (`id`, `admin_id`, `level`, `l_name`, `percentile`, `l_count`, `time_left`, `date_created`) VALUES
(1, 2, '400L', 'Dr White', 20, 6, 180, '2023-04-06 23:44:19'),
(2, 2, '400L', 'Dr Obilikwu', 15, 3, 60, '2023-04-06 23:45:26'),
(3, 3, '200L', 'Mr Salumu', 5, 1, 0, '2023-04-06 23:53:58'),
(4, 2, '400L', 'Dr Steven', 0, 0, 0, '2023-05-19 12:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `program_list`
--

CREATE TABLE `program_list` (
  `id` int(10) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_list`
--

INSERT INTO `program_list` (`id`, `admin_id`, `name`, `department_id`, `create_at`) VALUES
(1, 1, 'B. Sc Computer Science', 'Mathematics and Computer Science', '2023-03-25 07:25:17'),
(2, 2, 'B. Sc. Computer Science', 'Mathematics And computer Science', '2023-03-25 12:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(20) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `lecturer_name` varchar(50) NOT NULL,
  `time_in` varchar(20) NOT NULL,
  `time_out` varchar(20) NOT NULL,
  `leave_time` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `lecture_hall` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `l_status` varchar(100) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `admin_id`, `department`, `course_title`, `course_code`, `lecturer_name`, `time_in`, `time_out`, `leave_time`, `level`, `lecture_hall`, `status`, `l_status`, `date_created`) VALUES
(1, 1, 'Mathematics and Computer Science', 'Software Engineering', 'CMP472', 'Dr UK', '10AM', '1PM', '11 AM', '400L', 'sample lecturer hall one', 'Active', '', '2023-03-25'),
(2, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Young Lecturer', '12 AM', '4 PM', '1PM', '200L', 'CMPLH', 'Active', '', '2023-03-25'),
(3, 1, '', 'Scamming Courser', 'CMP491', 'Dr UK', '11AM', '7PM', '0', '200L', 'Scamming Hall', 'Active', '', '2023-03-25'),
(4, 1, '', 'Scamming Courser', 'CMP491', 'Dr UK', '7 AM', '8 PM', '7:20AM', '400L', 'Scamming Sample Hall', 'Active', '', '2023-03-25'),
(5, 1, 'Mathematics and Computer Science', 'Software Engineering', 'CMP472', 'Dr UK sample', '7 AM', '4 PM', '11 : 30 AM', '400L', 'CMPLH2', 'Active', '', '2023-03-25'),
(6, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Young Lecturer', '7 AM', '8 PM', '12 PM', '200L', 'Scamming Sample Hall', 'Active', '', '2023-03-25'),
(8, 1, 'Mathematics and Computer Science', 'Algorithm I', 'CMP432', 'Dr Obilikwu', '10 : 30 AM', '2 : 30 PM', '0', '400L', 'Sample lecture hall', 'Inactive', '', '2023-03-30'),
(9, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '200L', 'sample hall', 'Active', '<span class=\"btn btn-xs btn btn-danger\" style=\"Absent: 5px 10px;\">Present</span>', '2023-04-06'),
(10, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '10 : 30 AM', '5 : 30 PM', '0', '400L', 'Sample lecture hall', 'Active', 'Absent', '2023-04-06'),
(11, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Young Hall', 'Active', 'present', '2023-04-06'),
(12, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr White', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(13, 2, 'Mathematics and Computer Science', 'programming', 'CMP205', 'Dr Obilikwu', '11 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'present', '2023-04-06'),
(14, 2, 'Mathematics and Computer Science', 'programming', 'CMP205', 'Dr Steven', '1 : 30 PM', '12 : 30 AM', '12 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'present', '2023-04-06'),
(15, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '10 : 30 AM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'present', '2023-04-06'),
(16, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr Steven', '10 : 30 AM', '5 : 30 PM', '12 : 30 AM', '400L', 'Sample lecture by Drwhite', 'Active', 'present', '2023-04-06'),
(17, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr Steven', '1 : 30 PM', '2 : 30 PM', '12 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-06'),
(18, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '10 : 30 AM', '5 : 30 PM', '0', '400L', 'Sample lecture hall', 'Active', 'Absent', '2023-04-06'),
(19, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(20, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr White', '10 : 30 AM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture by Drwhite', 'Active', 'Present', '2023-04-07'),
(21, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '10 : 30 AM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture hall by Steve', 'Active', 'Present', '2023-04-07'),
(22, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr White', '1 : 30 PM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(23, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr Steven', '10 : 30 AM', '12 : 30 AM', '11 : 35 AM', '400L', 'Sample lecture hall by Obilikwu', 'Active', 'Present', '2023-04-07'),
(24, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr White', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(25, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '1 : 30 PM', '5 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(26, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr Steven', '10 : 30 AM', '2 : 30 PM', '0', '400L', 'Sample lecture hall by Steve', 'Active', 'Absent', '2023-04-07'),
(27, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr White', '10 : 30 AM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-08'),
(28, 2, 'Mathematics and Computer Science', 'programming', 'CMP205', 'Dr Obilikwu', '10 : 30 AM', '12 : 30 AM', '11 : 30 AM', '400L', 'Sample lecture by Drwhite', 'Active', 'Present', '2023-04-07'),
(29, 3, 'Mathematics and Computer Science', 'Pascal Programming I', 'CMP201', 'Mr Salumu', '1 : 30 PM', '12 : 30 AM', '12 : 30 AM', '200L', 'Sample lecture hall', 'Active', 'Present', '2023-04-07'),
(30, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr White', '11 : 30 AM', '5 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture by Drwhite', 'Active', 'Present', '2023-04-08'),
(31, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP205', 'Dr White', '10 : 30 AM', '12 : 30 AM', '12 : 30 AM', '400L', 'Young Hall', 'Active', 'Present', '2023-04-08'),
(32, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr Obilikwu', '10 : 30 AM', '5 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-04-08'),
(33, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '10 : 30 AM', '2 : 30 PM', '11 : 30 AM', '400L', 'Sample lecture hall', 'Active', 'Present', '2023-05-19'),
(34, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr Obilikwu', '10 : 30 AM', '12 : 30 AM', '', '400L', 'Sample lecture by Drwhite', 'Active', 'Present', '2023-07-14'),
(35, 2, 'Mathematics and Computer Science', 'Mathematices for Computer', 'CMP201', 'Dr Obilikwu', '10 : 30 AM', '2 : 30 PM', '0', '400L', 'Sample lecture by Drwhite', 'Inactive', '<span class=\"btn btn-xs btn btn-info\" style=\"padding: 5px 10px;\">Pending</span>', '2023-05-19'),
(36, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '10 : 30 AM', '2 : 30 PM', '12 : 30 PM', '400L', 'Sample lecture hall', 'Active', 'Absent', '2023-05-19'),
(37, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '10 : 30 AM', '2 : 30 PM', '0', '400L', 'Sample lecture hall', 'Inactive', '<span class=\"btn btn-xs btn btn-info\" style=\"padding: 5px 10px;\">Pending</span>', '2023-05-19'),
(38, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr Steven', '2023-05-19T20:30', '2023-05-19T12:30', '0', '400L', 'Sample lecture hall', 'Inactive', '<span class=\"btn btn-xs btn btn-info\" style=\"padding: 5px 10px;\">Pending</span>', '2023-05-19'),
(39, 2, 'Mathematics and Computer Science', 'programming', 'CMP205', 'Dr Obilikwu', '2023-05-19T07:00', '2023-05-19T08:00', '', '400L', 'Sample lecture hall', 'Active', 'Select Status', '2023-05-24'),
(40, 2, 'Mathematics and Computer Science', 'programming', 'CMP205', 'Dr White', '08:30', '12:30', '', '400L', 'Sample lecture hall', 'Active', 'Select Status', '2023-05-24'),
(42, 2, 'Mathematics and Computer Science', 'programming', 'CMP201', 'Dr White', '11:00', '14:00', '', '400L', 'CMPLH', 'Active', 'Present', '2023-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `student_remark`
--

CREATE TABLE `student_remark` (
  `id` int(10) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `remark` varchar(10) NOT NULL,
  `lecturer_name` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `lecture_hall` varchar(50) NOT NULL,
  `time_in` varchar(50) NOT NULL,
  `time_out` varchar(50) NOT NULL,
  `time_left` varchar(100) NOT NULL,
  `l_status` varchar(50) NOT NULL,
  `lecture_date` date NOT NULL,
  `remark_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_remark`
--

INSERT INTO `student_remark` (`id`, `student_name`, `remark`, `lecturer_name`, `course_code`, `course_title`, `level`, `lecture_hall`, `time_in`, `time_out`, `time_left`, `l_status`, `lecture_date`, `remark_date`) VALUES
(1, 'Young', 'Excellent', 'Dr Steven', 'CMP101', 'Pascal Programming I', '300 L', 'Sample lecture hall by Dr steven', '10 : 30 AM', '2 : 30 PM', '', '', '2023-03-09', '2023-03-13'),
(2, 'Young', 'Excellent', 'Dr Obilikwu', 'CMP432', 'Algorithm Almighty course', '200 L', 'Sample lecture hall by Obilikwu', '10 : 30 AM', '2 : 30 PM', '', '', '2023-03-08', '2023-03-13'),
(3, 'Young', 'Excellent', 'Dr Steven', 'CMP101', 'Pascal Programming I', 'Select Level', 'Sample lecture hall by Steve', '1 : 30 PM', '5 : 30 PM', '', '', '2023-03-12', '2023-03-13'),
(4, 'Young Student', 'Excellent', 'Dr UK', 'CMP101', 'Algorithm Almighty course', '300 L', 'Sample lecture hall', '10 : 30 AM', '2 : 30 PM', '', '', '2023-03-14', '2023-03-14'),
(5, 'Drwhite', 'V-Poor', 'Dr UK', 'CMP472', 'Software Engineering', '400L', 'sample lecturer hall one', '10AM', '1PM', '', '', '2023-03-25', '2023-03-25'),
(6, 'Drwhite', 'Excellent', 'Dr UK', 'CMP491', 'Scamming Courser', '400L', 'Scamming Sample Hall', '7 AM', '8 PM', '7:20AM', '', '2023-03-25', '2023-03-25'),
(7, '', 'Excellent', 'Young Lecturer', 'CMP205', 'Mathematices for Computer', '200L', 'Scamming Sample Hall', '7 AM', '8 PM', '12 PM', '', '2023-03-25', '2023-03-25'),
(8, 'Dr Egahi', 'V-Gppd', 'Young Lecturer', 'CMP201', 'programming', '200L', 'CMPLH', '12 AM', '4 PM', '1PM', '', '2023-03-25', '2023-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `username` varchar(45) NOT NULL,
  `reg_no` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `program` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL,
  `user_type` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `date_reg` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `username`, `reg_no`, `department`, `program`, `level`, `user_type`, `password`, `date_reg`) VALUES
(1, 1, 'Drwhite', 'first2343df', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'Student', '202cb962ac59075b964b07152d234b70', '2023-03-25 23:00:00'),
(2, 1, 'Sample Name', 'Drwhite123', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'Student', '202cb962ac59075b964b07152d234b70', '2023-03-29 23:00:00'),
(3, 2, 'Young', 'jdkdu4iewrpow', 'Mathematics and Computer Science', 'B. Sc Computer Science', '200L', 'Student', '202cb962ac59075b964b07152d234b70', '2023-03-29 23:00:00'),
(4, 2, 'first Student 400', 'first_4', 'Mathematics and Computer Science', 'B. Sc. Computer Science', '400L', 'Student', '202cb962ac59075b964b07152d234b70', '2023-04-05 23:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hod_list`
--
ALTER TABLE `hod_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `lecturers_reports`
--
ALTER TABLE `lecturers_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_list`
--
ALTER TABLE `program_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_remark`
--
ALTER TABLE `student_remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hod_list`
--
ALTER TABLE `hod_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `l_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lecturers_reports`
--
ALTER TABLE `lecturers_reports`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_list`
--
ALTER TABLE `program_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `student_remark`
--
ALTER TABLE `student_remark`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
