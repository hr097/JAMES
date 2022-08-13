-- phpMyAdmin SQL Dump
-- version 5.2.0-1.fc36
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2022 at 02:39 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otptables`
--

CREATE TABLE `otptables` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otptables`
--

INSERT INTO `otptables` (`id`, `email`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'mistriparth16@gmail.com', 623736, '2022-06-13 09:24:05', '2022-05-24 10:39:12'),
(2, 'makwnameet7301@gmail.com', 121688, '2022-06-01 02:48:32', '2022-06-01 02:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `rolls`
--

CREATE TABLE `rolls` (
  `roll_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolls`
--

INSERT INTO `rolls` (`roll_id`, `type`) VALUES
(1, 'faculty'),
(2, 'admin'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `spid` int(11) DEFAULT NULL,
  `enrollment_no` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `pnumber` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `joining_year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `email`, `spid`, `enrollment_no`, `gender`, `bdate`, `pnumber`, `course_name`, `joining_year`, `semester`, `division`, `created_at`, `updated_at`) VALUES
(1, 'parth', 'mistri', 'parthmistri.mscit20@vnsgu.ac.in', 2020049853, 'E20110018000610062', 'male', '2002-07-16', '9879683247', 'IT', 2020, 5, 'A', '2022-07-03 08:16:45', '2022-07-03 13:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `roll`, `created_at`, `updated_at`) VALUES
(1, 'mistriparth16@gmail.com', '$2y$10$FYCQJDHxe.f8a9kzaGJicu.KUrIb1yEoEFzOc96kHX6IvAUtK.eii', 2, '2022-05-25 07:54:37', '2022-05-21 07:50:24'),
(2, 'makwnameet7301@gmail.com', '$2y$10$Exg2qm14BY7bxRH0reEJjOzBzp8uqiZF089KljE.Uv3GaImQLbPWy', 1, '2022-06-01 02:48:15', '2022-06-01 02:48:15'),
(3, 'jaydevjadav.015@gmail.com', '$2y$10$QapFDMH80nDJbtb0ldaCkeSfyAXxbii8tBLtLA4JfNjDM4IO6P13y', 2, '2022-06-23 08:16:19', '2022-06-23 08:16:19'),
(6, 'parthmistri.mscit20@vnsgu.ac.in', '$2y$10$nx9/06G0nl3UyaXWyaM.Q.FLSFJtDgdxmv4ZloX3wJU0WHTv6PtTK', 3, '2022-07-03 08:16:45', '2022-07-03 08:16:45'),
(7, 'amsjpd10@gmail.com', '$2y$10$UJCAuQoJOei4m0NsDxL5UuKWtEXUC98pnWZiu.kifjN9R/.wpVMda', 2, '2022-07-03 09:55:10', '2022-07-03 09:55:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `otptables`
--
ALTER TABLE `otptables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolls`
--
ALTER TABLE `rolls`
  ADD PRIMARY KEY (`roll_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otptables`
--
ALTER TABLE `otptables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `roll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
