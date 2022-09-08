-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 09:30 AM
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
-- Database: `james`
--

-- --------------------------------------------------------

--
-- Table structure for table `ams_api`
--
-- Creation: Sep 04, 2022 at 09:33 AM
--

CREATE TABLE `ams_api` (
  `reading_no` int(11) NOT NULL,
  `reader_no` smallint(6) NOT NULL,
  `reading_date` date NOT NULL DEFAULT curdate(),
  `reading_time` time NOT NULL DEFAULT curtime(),
  `spid` varchar(10) NOT NULL,
  `Semester` smallint(6) DEFAULT NULL
) ;

--
-- RELATIONSHIPS FOR TABLE `ams_api`:
--   `spid`
--       `rfid_uid_spid_map` -> `spid`
--

--
-- Dumping data for table `ams_api`
--

INSERT INTO `ams_api` (`reading_no`, `reader_no`, `reading_date`, `reading_time`, `spid`, `Semester`) VALUES
(1, 42, '2022-09-05', '12:35:20', '2020049935', 5);

--
-- Triggers `ams_api`
--
DELIMITER $$
CREATE TRIGGER `insert_ams_api` BEFORE INSERT ON `ams_api` FOR EACH ROW BEGIN
DECLARE sem int;
SELECT cur_semester into sem  FROM Students where spid = NEW.spid;
SET NEW.semester := sem;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ams_attendance_master`
--
-- Creation: Sep 06, 2022 at 07:37 AM
--

CREATE TABLE `ams_attendance_master` (
  `att_no` bigint(20) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `ams_setup_id` int(11) NOT NULL,
  `att_date` date NOT NULL DEFAULT curdate(),
  `att_time` time NOT NULL DEFAULT curtime(),
  `att_status` tinyint(1) NOT NULL
) ;

--
-- RELATIONSHIPS FOR TABLE `ams_attendance_master`:
--   `spid`
--       `students` -> `spid`
--   `ams_setup_id`
--       `ams_setup_course_subject_map` -> `ams_setup_id`
--

--
-- Dumping data for table `ams_attendance_master`
--

INSERT INTO `ams_attendance_master` (`att_no`, `spid`, `ams_setup_id`, `att_date`, `att_time`, `att_status`) VALUES
(1, '2020049910', 1, '2022-09-06', '13:07:23', 0),
(2, '2020049910', 1, '2022-09-06', '13:07:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ams_setup_course_subject_map`
--
-- Creation: Sep 06, 2022 at 06:50 AM
--

CREATE TABLE `ams_setup_course_subject_map` (
  `ams_setup_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `year` year(4) NOT NULL
) ;

--
-- RELATIONSHIPS FOR TABLE `ams_setup_course_subject_map`:
--   `cs_id`
--       `course_subject_map` -> `cs_id`
--

--
-- Dumping data for table `ams_setup_course_subject_map`
--

INSERT INTO `ams_setup_course_subject_map` (`ams_setup_id`, `cs_id`, `year`) VALUES
(1, 1, 2022),
(2, 2, 2022),
(3, 3, 2022),
(4, 4, 2022),
(5, 5, 2022),
(6, 6, 2022),
(7, 7, 2022),
(8, 8, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `ams_setup_faculties_map`
--
-- Creation: Sep 06, 2022 at 07:13 AM
--

CREATE TABLE `ams_setup_faculties_map` (
  `ams_setup_id` int(11) NOT NULL,
  `fid` varchar(8) NOT NULL,
  `setup_status` tinyint(1) NOT NULL DEFAULT 1
) ;

--
-- RELATIONSHIPS FOR TABLE `ams_setup_faculties_map`:
--   `fid`
--       `faculties` -> `fid`
--   `ams_setup_id`
--       `ams_setup_course_subject_map` -> `ams_setup_id`
--

--
-- Dumping data for table `ams_setup_faculties_map`
--

INSERT INTO `ams_setup_faculties_map` (`ams_setup_id`, `fid`, `setup_status`) VALUES
(1, 'FID12346', 1),
(2, 'FID12345', 1),
(2, 'FID12348', 1),
(3, 'FID12347', 1),
(4, 'FID12349', 1),
(5, 'FID12349', 1),
(6, 'FID12345', 1),
(7, 'FID12348', 1),
(8, 'FID12347', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ams_setup_students_map`
--
-- Creation: Sep 06, 2022 at 07:22 AM
--

CREATE TABLE `ams_setup_students_map` (
  `ams_setup_id` int(11) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `p_days` smallint(6) NOT NULL DEFAULT 0,
  `a_days` smallint(6) NOT NULL DEFAULT 0
) ;

--
-- RELATIONSHIPS FOR TABLE `ams_setup_students_map`:
--   `spid`
--       `students` -> `spid`
--   `ams_setup_id`
--       `ams_setup_course_subject_map` -> `ams_setup_id`
--

--
-- Dumping data for table `ams_setup_students_map`
--

INSERT INTO `ams_setup_students_map` (`ams_setup_id`, `spid`, `p_days`, `a_days`) VALUES
(1, '2020049812', 0, 0),
(1, '2020049819', 0, 0),
(1, '2020049836', 0, 0),
(1, '2020049910', 0, 0),
(1, '2020049935', 0, 0),
(4, '2020049812', 0, 0),
(4, '2020049819', 0, 0),
(4, '2020049836', 0, 0),
(4, '2020049910', 0, 0),
(4, '2020049935', 0, 0),
(6, '2020049812', 0, 0),
(6, '2020049819', 0, 0),
(6, '2020049836', 0, 0),
(6, '2020049910', 0, 0),
(6, '2020049935', 0, 0),
(7, '2020049812', 0, 0),
(7, '2020049819', 0, 0),
(7, '2020049836', 0, 0),
(7, '2020049910', 0, 0),
(7, '2020049935', 0, 0),
(8, '2020049812', 0, 0),
(8, '2020049819', 0, 0),
(8, '2020049836', 0, 0),
(8, '2020049910', 0, 0),
(8, '2020049935', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--
-- Creation: Sep 04, 2022 at 07:27 AM
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `total_semester` int(11) NOT NULL
) ;

--
-- RELATIONSHIPS FOR TABLE `courses`:
--

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `total_semester`) VALUES
(3, 'B.Sc I.T.', 6),
(2, 'M.Sc I.C.T.', 4),
(1, 'M.Sc I.T.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `course_subject_map`
--
-- Creation: Sep 04, 2022 at 10:08 PM
--

CREATE TABLE `course_subject_map` (
  `cs_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `course_subject_map`:
--   `course_id`
--       `courses` -> `course_id`
--   `subject_id`
--       `subjects` -> `subject_id`
--

--
-- Dumping data for table `course_subject_map`
--

INSERT INTO `course_subject_map` (`cs_id`, `course_id`, `subject_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--
-- Creation: Sep 04, 2022 at 10:28 PM
--

CREATE TABLE `faculties` (
  `fid` varchar(8) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `designation` varchar(256) NOT NULL,
  `fac_status` tinyint(1) DEFAULT 1
) ;

--
-- RELATIONSHIPS FOR TABLE `faculties`:
--   `email`
--       `users` -> `username`
--

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`fid`, `name`, `gender`, `dob`, `email`, `contact_no`, `joining_year`, `designation`, `fac_status`) VALUES
('FID12345', 'Pushpal Desai', 'M', '1960-01-01', 'pydesai@vnsgu.ac.in', '+91 1234567890', 2000, 'Associate Professor', 1),
('FID12346', 'Payal Joshi', 'F', '1970-02-01', 'pkpandya@vnsgu.ac.in', '+91 1234567891', 2008, 'Assistant Professor', 1),
('FID12347', 'Falguni Thakkar', 'F', '1980-02-07', 'fgthakker@vnsgu.ac.in', '+91 1234567892', 2009, 'Teaching Assistant', 1),
('FID12348', 'Vinny Surati', 'F', '1989-02-07', 'vhsurati@vnsgu.ac.in', '+91 1234567893', 2018, 'Teaching Assistant', 1),
('FID12349', 'Shailesh Chaudhri', 'M', '1980-02-08', 'sachaudhari@vnsgu.ac.in', '+91 1234567894', 2007, 'Assistant Professor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rfid_uid_spid_map`
--
-- Creation: Sep 04, 2022 at 07:26 AM
--

CREATE TABLE `rfid_uid_spid_map` (
  `uid` varchar(20) NOT NULL,
  `spid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `rfid_uid_spid_map`:
--   `spid`
--       `students` -> `spid`
--

--
-- Dumping data for table `rfid_uid_spid_map`
--

INSERT INTO `rfid_uid_spid_map` (`uid`, `spid`) VALUES
('05 85 52 02 4B B0 00', '2020049910'),
('05 8F DB 52 29 71 00', '2020049935');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--
-- Creation: Sep 04, 2022 at 07:26 AM
--

CREATE TABLE `students` (
  `spid` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `course_id` int(11) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `cur_semester` int(11) NOT NULL,
  `cur_division` char(1) NOT NULL,
  `cur_roll_no` smallint(6) NOT NULL,
  `stud_status` tinyint(1) DEFAULT 1
) ;

--
-- RELATIONSHIPS FOR TABLE `students`:
--   `course_id`
--       `courses` -> `course_id`
--   `email`
--       `users` -> `username`
--

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`spid`, `name`, `gender`, `dob`, `email`, `contact_no`, `course_id`, `joining_year`, `cur_semester`, `cur_division`, `cur_roll_no`, `stud_status`) VALUES
('2020049812', 'Dhola Drashti Ishwarbhai', 'F', '2002-11-15', 'drashtidhola.mscit20@vnsgu.ac.in', '+91 9687630768', 3, 2020, 5, 'A', 19, 1),
('2020049819', 'Ghevariya Archit Nareshbhai', 'M', '2003-03-05', 'architghevariya.mscit20@vnsgu.ac.in', '+91 7383837798', 3, 2020, 5, 'A', 26, 1),
('2020049836', 'Khunt Shubham Vinubhai', 'M', '2003-07-18', 'shubhamkhunt.mscit20@vnsgu.ac.in', '+91 8849178317', 3, 2020, 5, 'A', 42, 1),
('2020049910', 'Ramani Harshil Shaileshbhai', 'M', '2003-05-08', 'harshilramani.mscit20@vnsgu.ac.in', '+91 9624561892', 3, 2020, 5, 'B', 113, 1),
('2020049935', 'Tikiwala Shikhaa Rupalkumar', 'F', '2002-08-24', 'shikhaatikiwala.mscit20@vnsgu.ac.in', '+91 8200290477', 3, 2020, 5, 'B', 138, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--
-- Creation: Sep 04, 2022 at 10:13 PM
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL
) ;

--
-- RELATIONSHIPS FOR TABLE `subjects`:
--

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `semester`) VALUES
(1, 501, 'Web development-II', 5),
(2, 502, 'RDBMS-II', 5),
(3, 503, 'Computer Graphics', 5),
(4, 504, 'System Analysis & Design', 5),
(5, 505, 'Account & Taxation', 5),
(6, 506, 'Practical-10', 5),
(7, 507, 'Practical-11', 5),
(8, 508, 'Practical-12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Aug 28, 2022 at 09:30 AM
--

CREATE TABLE `users` (
  `username` varchar(256) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_token` varchar(1000) NOT NULL,
  `user_type` smallint(6) NOT NULL,
  `user_access` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `users`:
--   `user_type`
--       `user_roles` -> `user_type`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_token`, `user_type`, `user_access`) VALUES
('admin.jpd.ams@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eip/h3jnmOM0AYJcGkkOXfjNkgXS6wNO', '4553c3bfjpd.a', 4, 1),
('architghevariya.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ekPfxWv2tcWiZmrLyhKtJ4tl10ijuYc.', '1dfdc0f1gheva', 1, 1),
('drashtidhola.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5emv.NpSRy4aKBna29naFqD7LSrGwA3MO', 'fab2b022idhol', 1, 1),
('fgthakker@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 'c70ce322e38dc233', 2, 1),
('harshilramani.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', '33516076lrama', 1, 1),
('office.jpd.ams@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5e5pDklWmYdrDpjv09uUSqeJCkwjXbgsi', '13de3e7556aaf17f', 3, 1),
('pkpandya@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', '5c8a2d886aa6dbbd', 2, 1),
('pydesai@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 'cfc4b326ad7c7d1a', 2, 1),
('sachaudhari@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 'e68566e1e6f1acfd', 2, 1),
('shikhaatikiwala.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', '6e09689b395278d0', 1, 1),
('shubhamkhunt.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', '5641a7c003593472', 1, 1),
('vhsurati@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', '315c57389dd4e40d', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--
-- Creation: Sep 04, 2022 at 07:27 AM
--

CREATE TABLE `user_roles` (
  `user_type` smallint(6) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `user_roles`:
--

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_type`, `role_name`) VALUES
(4, 'Admin'),
(2, 'Faculty'),
(3, 'Manager'),
(1, 'Student');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ams_setup_faculties_map`
-- (See below for the actual view)
--
CREATE TABLE `vw_ams_setup_faculties_map` (
`ams_setup_id` int(11)
,`fid` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_faculties`
-- (See below for the actual view)
--
CREATE TABLE `vw_faculties` (
`fid` varchar(8)
,`name` varchar(256)
,`gender` char(1)
,`dob` date
,`email` varchar(256)
,`contact_no` varchar(15)
,`joining_year` year(4)
,`designation` varchar(256)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_students`
-- (See below for the actual view)
--
CREATE TABLE `vw_students` (
`spid` varchar(10)
,`name` varchar(256)
,`gender` char(1)
,`dob` date
,`email` varchar(256)
,`contact_no` varchar(15)
,`course_name` varchar(255)
,`joining_year` year(4)
,`cur_semester` int(11)
,`cur_division` char(1)
,`cur_roll_no` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_users_auth`
-- (See below for the actual view)
--
CREATE TABLE `vw_users_auth` (
`username` varchar(256)
,`password` varchar(1000)
,`user_token` varchar(1000)
,`user_type` smallint(6)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_ams_setup_faculties_map`
--
DROP TABLE IF EXISTS `vw_ams_setup_faculties_map`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ams_setup_faculties_map`  AS SELECT `ams_setup_faculties_map`.`ams_setup_id` AS `ams_setup_id`, `ams_setup_faculties_map`.`fid` AS `fid` FROM `ams_setup_faculties_map` WHERE `ams_setup_faculties_map`.`setup_status` = 11  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_faculties`
--
DROP TABLE IF EXISTS `vw_faculties`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_faculties`  AS SELECT `faculties`.`fid` AS `fid`, `faculties`.`name` AS `name`, `faculties`.`gender` AS `gender`, `faculties`.`dob` AS `dob`, `faculties`.`email` AS `email`, `faculties`.`contact_no` AS `contact_no`, `faculties`.`joining_year` AS `joining_year`, `faculties`.`designation` AS `designation` FROM `faculties` WHERE `faculties`.`fac_status` = 11  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_students`
--
DROP TABLE IF EXISTS `vw_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_students`  AS SELECT `students`.`spid` AS `spid`, `students`.`name` AS `name`, `students`.`gender` AS `gender`, `students`.`dob` AS `dob`, `students`.`email` AS `email`, `students`.`contact_no` AS `contact_no`, `courses`.`course_name` AS `course_name`, `students`.`joining_year` AS `joining_year`, `students`.`cur_semester` AS `cur_semester`, `students`.`cur_division` AS `cur_division`, `students`.`cur_roll_no` AS `cur_roll_no` FROM (`students` join `courses`) WHERE `students`.`course_id` = `courses`.`course_id` AND `students`.`stud_status` = 11  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_users_auth`
--
DROP TABLE IF EXISTS `vw_users_auth`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_users_auth`  AS SELECT `users`.`username` AS `username`, `users`.`password` AS `password`, `users`.`user_token` AS `user_token`, `users`.`user_type` AS `user_type` FROM `users` WHERE `users`.`user_access` = 11  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ams_api`
--
ALTER TABLE `ams_api`
  ADD PRIMARY KEY (`reading_no`),
  ADD KEY `idx_AmsReaderNo` (`reader_no`),
  ADD KEY `idx_AmsSemster` (`Semester`),
  ADD KEY `FK_api_spid` (`spid`);

--
-- Indexes for table `ams_attendance_master`
--
ALTER TABLE `ams_attendance_master`
  ADD PRIMARY KEY (`att_no`),
  ADD KEY `FK_attedance_spid_map` (`spid`),
  ADD KEY `FK_attendance_ams_setup_map` (`ams_setup_id`);

--
-- Indexes for table `ams_setup_course_subject_map`
--
ALTER TABLE `ams_setup_course_subject_map`
  ADD PRIMARY KEY (`ams_setup_id`),
  ADD UNIQUE KEY `UNQ_ams_setup_per_year` (`cs_id`,`year`),
  ADD UNIQUE KEY `idx_amsSetupId` (`ams_setup_id`),
  ADD KEY `idx_amsSetupCsIdMap` (`cs_id`);

--
-- Indexes for table `ams_setup_faculties_map`
--
ALTER TABLE `ams_setup_faculties_map`
  ADD PRIMARY KEY (`ams_setup_id`,`fid`),
  ADD KEY `idx_amsSetupFacMap` (`fid`);

--
-- Indexes for table `ams_setup_students_map`
--
ALTER TABLE `ams_setup_students_map`
  ADD PRIMARY KEY (`ams_setup_id`,`spid`),
  ADD KEY `idx_amsSetupStudMap` (`spid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `UNQ_course_name` (`course_name`,`total_semester`),
  ADD KEY `idx_courseName` (`course_name`);

--
-- Indexes for table `course_subject_map`
--
ALTER TABLE `course_subject_map`
  ADD PRIMARY KEY (`cs_id`),
  ADD UNIQUE KEY `UNQ_course_subject_map` (`course_id`,`subject_id`),
  ADD KEY `idx_cs_id` (`cs_id`),
  ADD KEY `FK_subject_map` (`subject_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `idx_FacSpid` (`fid`),
  ADD KEY `FK_fac_email` (`email`);

--
-- Indexes for table `rfid_uid_spid_map`
--
ALTER TABLE `rfid_uid_spid_map`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `UNQ_spid_map` (`spid`),
  ADD UNIQUE KEY `idx_StudUidSpidMap` (`uid`,`spid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`spid`),
  ADD UNIQUE KEY `UNQ_stud_email` (`email`),
  ADD UNIQUE KEY `idx_StudSpid` (`spid`),
  ADD KEY `FK_stud_course_id` (`course_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `UNQ_subject_name` (`subject_code`),
  ADD UNIQUE KEY `idx_subjectCode` (`subject_code`),
  ADD KEY `idx_subjectName` (`subject_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `idx_userName` (`username`),
  ADD UNIQUE KEY `UNQ_user_token` (`user_token`) USING HASH,
  ADD UNIQUE KEY `idx_user_token` (`user_token`) USING HASH,
  ADD KEY `idx_user_type` (`user_type`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_type`),
  ADD UNIQUE KEY `UNQ_user_role` (`role_name`),
  ADD KEY `idx_RoleName` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ams_api`
--
ALTER TABLE `ams_api`
  MODIFY `reading_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ams_attendance_master`
--
ALTER TABLE `ams_attendance_master`
  MODIFY `att_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ams_setup_course_subject_map`
--
ALTER TABLE `ams_setup_course_subject_map`
  MODIFY `ams_setup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_subject_map`
--
ALTER TABLE `course_subject_map`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_type` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ams_api`
--
ALTER TABLE `ams_api`
  ADD CONSTRAINT `FK_api_spid` FOREIGN KEY (`spid`) REFERENCES `rfid_uid_spid_map` (`spid`) ON UPDATE CASCADE;

--
-- Constraints for table `ams_attendance_master`
--
ALTER TABLE `ams_attendance_master`
  ADD CONSTRAINT `FK_attedance_spid_map` FOREIGN KEY (`spid`) REFERENCES `students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendance_ams_setup_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ams_setup_course_subject_map`
--
ALTER TABLE `ams_setup_course_subject_map`
  ADD CONSTRAINT `FK_ams_setup_cs_id_map` FOREIGN KEY (`cs_id`) REFERENCES `course_subject_map` (`cs_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ams_setup_faculties_map`
--
ALTER TABLE `ams_setup_faculties_map`
  ADD CONSTRAINT `FK_ams_setup_fid_map` FOREIGN KEY (`fid`) REFERENCES `faculties` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ams_setup_students_map`
--
ALTER TABLE `ams_setup_students_map`
  ADD CONSTRAINT `FK_ams_setup_spid_map` FOREIGN KEY (`spid`) REFERENCES `students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_subject_map`
--
ALTER TABLE `course_subject_map`
  ADD CONSTRAINT `FK_Course_map` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject_map` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `FK_fac_email` FOREIGN KEY (`email`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `rfid_uid_spid_map`
--
ALTER TABLE `rfid_uid_spid_map`
  ADD CONSTRAINT `FK_uid_spid_map` FOREIGN KEY (`spid`) REFERENCES `students` (`spid`) ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_stud_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_email` FOREIGN KEY (`email`) REFERENCES `users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_role_map` FOREIGN KEY (`user_type`) REFERENCES `user_roles` (`user_type`) ON UPDATE CASCADE;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table ams_api
--

--
-- Metadata for table ams_attendance_master
--

--
-- Metadata for table ams_setup_course_subject_map
--

--
-- Metadata for table ams_setup_faculties_map
--

--
-- Metadata for table ams_setup_students_map
--

--
-- Metadata for table courses
--

--
-- Metadata for table course_subject_map
--

--
-- Metadata for table faculties
--

--
-- Metadata for table rfid_uid_spid_map
--

--
-- Metadata for table students
--

--
-- Metadata for table subjects
--

--
-- Metadata for table users
--

--
-- Metadata for table user_roles
--

--
-- Metadata for table vw_ams_setup_faculties_map
--

--
-- Metadata for table vw_faculties
--

--
-- Metadata for table vw_students
--

--
-- Metadata for table vw_users_auth
--

--
-- Metadata for database james
--

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `deleteAmsApiDataDaily` ON SCHEDULE EVERY 1 DAY STARTS '2022-09-05 03:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
  TRUNCATE TABLE ams_api;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
