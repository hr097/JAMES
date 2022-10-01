-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2022 at 05:08 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vnsguit_james`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ams_api`
--

CREATE TABLE `Ams_api` (
  `reading_no` int(11) NOT NULL,
  `reader_no` smallint(6) NOT NULL,
  `reading_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `spid` varchar(10) NOT NULL,
  `semester` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_api`
--

INSERT INTO `Ams_api` (`reading_no`, `reader_no`, `reading_date_time`, `spid`, `semester`) VALUES
(1, 5, '2022-09-30 20:09:36', '2020049910', 5),
(3, 5, '2022-09-30 20:10:39', '2020049812', 5),
(6, 1, '2022-09-30 20:57:37', '2020049910', 5),
(7, 1, '2022-09-30 20:58:39', '2020049910', 5),
(8, 2, '2022-09-30 20:59:01', '2020049910', 5),
(9, 2, '2022-10-01 01:28:42', '2020049910', 5),
(10, 1, '2022-10-01 12:11:20', '2020049910', 5),
(11, 1, '2022-10-01 16:17:41', '2020049910', 5);

--
-- Triggers `Ams_api`
--
DELIMITER $$
CREATE TRIGGER `insert_ams_api` BEFORE INSERT ON `Ams_api` FOR EACH ROW BEGIN
DECLARE sem int;
SELECT cur_semester into sem  FROM vw_students where spid = NEW.spid;
SET NEW.semester := sem;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_attendance_master`
--

CREATE TABLE `Ams_attendance_master` (
  `att_no` bigint(20) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `ams_setup_id` int(11) NOT NULL,
  `att_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `att_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_attendance_master`
--

INSERT INTO `Ams_attendance_master` (`att_no`, `spid`, `ams_setup_id`, `att_date_time`, `att_status`) VALUES
(1, '2020049910', 1, '2022-09-30 20:20:22', 0),
(2, '2020049910', 1, '2022-09-30 20:20:47', 1);

--
-- Triggers `Ams_attendance_master`
--
DELIMITER $$
CREATE TRIGGER `count_PR_AB_days` AFTER INSERT ON `Ams_attendance_master` FOR EACH ROW BEGIN
    IF NEW.att_status = TRUE THEN
    UPDATE Ams_setup_students_map SET p_days = p_days + 1 WHERE spid = NEW.spid;
    ELSE 
    UPDATE Ams_setup_students_map SET a_days = a_days + 1 WHERE spid = NEW.spid;
    END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `move_att_to_bckp` BEFORE DELETE ON `Ams_attendance_master` FOR EACH ROW BEGIN
    INSERT INTO Bckp_Ams_attendance_master(spid,ams_setup_id,att_date_time,att_status) VALUES(OLD.spid,OLD.ams_setup_id,OLD.att_date_time,OLD.att_status);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_readers`
--

CREATE TABLE `Ams_readers` (
  `reader_id` smallint(6) NOT NULL,
  `reader_no` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_readers`
--

INSERT INTO `Ams_readers` (`reader_id`, `reader_no`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Ams_setup_course_subject_map`
--

CREATE TABLE `Ams_setup_course_subject_map` (
  `ams_setup_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_setup_course_subject_map`
--

INSERT INTO `Ams_setup_course_subject_map` (`ams_setup_id`, `cs_id`, `year`) VALUES
(1, 1, 2022),
(2, 2, 2022),
(3, 3, 2022),
(4, 4, 2022),
(5, 5, 2022),
(6, 6, 2022),
(7, 7, 2022),
(8, 8, 2022);

--
-- Triggers `Ams_setup_course_subject_map`
--
DELIMITER $$
CREATE TRIGGER `move_setup_to_bckp` BEFORE DELETE ON `Ams_setup_course_subject_map` FOR EACH ROW BEGIN
    INSERT INTO Bckp_Ams_setup_course_subject_map(ams_setup_id,cs_id,year) VALUES(OLD.ams_setup_id,OLD.cs_id,OLD.year);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_setup_faculties_map`
--

CREATE TABLE `Ams_setup_faculties_map` (
  `ams_setup_id` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL,
  `setup_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_setup_faculties_map`
--

INSERT INTO `Ams_setup_faculties_map` (`ams_setup_id`, `fid`, `setup_status`) VALUES
(1, 'FID12346', 1),
(2, 'FID12345', 1),
(2, 'FID12348', 1),
(3, 'FID12347', 1),
(4, 'FID12349', 1),
(5, 'FID12349', 1),
(6, 'FID12345', 1),
(7, 'FID12348', 1),
(8, 'FID12347', 1);

--
-- Triggers `Ams_setup_faculties_map`
--
DELIMITER $$
CREATE TRIGGER `move_setup_fac_map_to_bckp` BEFORE DELETE ON `Ams_setup_faculties_map` FOR EACH ROW BEGIN
    INSERT INTO Bckp_Ams_setup_faculties_map(ams_setup_id,fid) VALUES(OLD.ams_setup_id,OLD.fid);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_setup_students_map`
--

CREATE TABLE `Ams_setup_students_map` (
  `ams_setup_id` int(11) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `p_days` smallint(6) DEFAULT '0',
  `a_days` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_setup_students_map`
--

INSERT INTO `Ams_setup_students_map` (`ams_setup_id`, `spid`, `p_days`, `a_days`) VALUES
(1, '2020049812', 0, 0),
(1, '2020049819', 0, 0),
(1, '2020049836', 0, 0),
(1, '2020049837', 0, 0),
(1, '2020049910', 1, 1),
(1, '2020049935', 0, 0),
(4, '2020049812', 0, 0),
(4, '2020049819', 0, 0),
(4, '2020049836', 0, 0),
(4, '2020049837', 0, 0),
(4, '2020049910', 1, 1),
(4, '2020049935', 0, 0),
(6, '2020049812', 0, 0),
(6, '2020049819', 0, 0),
(6, '2020049836', 0, 0),
(6, '2020049837', 0, 0),
(6, '2020049910', 1, 1),
(6, '2020049935', 0, 0),
(7, '2020049812', 0, 0),
(7, '2020049819', 0, 0),
(7, '2020049836', 0, 0),
(7, '2020049837', 0, 0),
(7, '2020049910', 1, 1),
(7, '2020049935', 0, 0),
(8, '2020049812', 0, 0),
(8, '2020049819', 0, 0),
(8, '2020049836', 0, 0),
(8, '2020049837', 0, 0),
(8, '2020049910', 1, 1),
(8, '2020049935', 0, 0);

--
-- Triggers `Ams_setup_students_map`
--
DELIMITER $$
CREATE TRIGGER `move_setup_stud_map_to_bckp` BEFORE DELETE ON `Ams_setup_students_map` FOR EACH ROW BEGIN
    INSERT INTO Bckp_Ams_setup_students_map(ams_setup_id,spid,p_days,a_days) VALUES(OLD.ams_setup_id,OLD.spid,OLD.p_days,OLD.a_days);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Ams_attendance_master`
--

CREATE TABLE `Bckp_Ams_attendance_master` (
  `att_no` bigint(20) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `ams_setup_id` int(11) NOT NULL,
  `att_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `att_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Ams_setup_course_subject_map`
--

CREATE TABLE `Bckp_Ams_setup_course_subject_map` (
  `ams_setup_id` int(11) NOT NULL,
  `cs_id` int(11) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Ams_setup_faculties_map`
--

CREATE TABLE `Bckp_Ams_setup_faculties_map` (
  `ams_setup_id` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Ams_setup_students_map`
--

CREATE TABLE `Bckp_Ams_setup_students_map` (
  `ams_setup_id` int(11) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `p_days` smallint(6) NOT NULL,
  `a_days` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Faculties`
--

CREATE TABLE `Bckp_Faculties` (
  `fid` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `role_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Rfid_uid_spid_map`
--

CREATE TABLE `Bckp_Rfid_uid_spid_map` (
  `uid` varchar(20) NOT NULL,
  `spid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Students`
--

CREATE TABLE `Bckp_Students` (
  `spid` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `course_id` int(11) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `last_semester` int(11) NOT NULL,
  `last_division` char(1) NOT NULL,
  `last_roll_no` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Users`
--

CREATE TABLE `Bckp_Users` (
  `username` varchar(256) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `total_semester` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`course_id`, `course_name`, `total_semester`) VALUES
(1, 'M.Sc I.T.', 4),
(2, 'M.Sc I.C.T.', 4),
(3, 'B.Sc I.T.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `Course_subject_map`
--

CREATE TABLE `Course_subject_map` (
  `cs_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Course_subject_map`
--

INSERT INTO `Course_subject_map` (`cs_id`, `course_id`, `subject_id`) VALUES
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
-- Table structure for table `Faculties`
--

CREATE TABLE `Faculties` (
  `fid` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `role_id` smallint(6) NOT NULL,
  `fac_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Faculties`
--

INSERT INTO `Faculties` (`fid`, `name`, `gender`, `dob`, `email`, `contact_no`, `joining_year`, `role_id`, `fac_status`) VALUES
('FID12345', 'Pushpal Desai', 'Male', '1960-01-01', 'pydesai@vnsgu.ac.in', '+91 1234567890', 2000, 1, 1),
('FID12346', 'Payal Joshi', 'Female', '1970-02-01', 'pkpandya@vnsgu.ac.in', '+91 1234567891', 2008, 2, 1),
('FID12347', 'Falguni Thakkar', 'Female', '1980-02-07', 'fgthakker@vnsgu.ac.in', '+91 1234567892', 2009, 3, 1),
('FID12348', 'Vinny Surati', 'Female', '1989-02-07', 'vhsurati@vnsgu.ac.in', '+91 1234567893', 2018, 3, 1),
('FID12349', 'Shailesh Chaudhri', 'Male', '1980-02-08', 'sachaudhari@vnsgu.ac.in', '+91 1234567894', 2007, 3, 1);

--
-- Triggers `Faculties`
--
DELIMITER $$
CREATE TRIGGER `move_faculty_to_bckp` BEFORE DELETE ON `Faculties` FOR EACH ROW BEGIN
INSERT INTO Bckp_Faculties VALUES(OLD.fid,OLD.name,OLD.gender,OLD.dob,OLD.email,OLD.contact_no,OLD.joining_year,OLD.role_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Faculty_roles`
--

CREATE TABLE `Faculty_roles` (
  `role_id` smallint(6) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Faculty_roles`
--

INSERT INTO `Faculty_roles` (`role_id`, `role_name`) VALUES
(2, 'Assistant Professor'),
(1, 'Associate Professor'),
(3, 'Teaching Assistant');

-- --------------------------------------------------------

--
-- Table structure for table `Rfid_uid_spid_map`
--

CREATE TABLE `Rfid_uid_spid_map` (
  `uid` varchar(20) NOT NULL,
  `spid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rfid_uid_spid_map`
--

INSERT INTO `Rfid_uid_spid_map` (`uid`, `spid`) VALUES
('05 8F 15 AD 42 D1 00', '2020049812'),
('05 8F DB 52 29 71 00', '2020049910');

--
-- Triggers `Rfid_uid_spid_map`
--
DELIMITER $$
CREATE TRIGGER `move_uid_spid_map_to_bckp` BEFORE DELETE ON `Rfid_uid_spid_map` FOR EACH ROW BEGIN
    INSERT INTO Bckp_Rfid_uid_spid_map(uid,spid) VALUES(OLD.uid,OLD.spid);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `spid` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `course_id` int(11) NOT NULL,
  `joining_year` year(4) NOT NULL,
  `cur_semester` smallint(6) NOT NULL,
  `cur_division` char(1) NOT NULL,
  `cur_roll_no` int(11) NOT NULL,
  `stud_status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`spid`, `name`, `gender`, `dob`, `email`, `contact_no`, `course_id`, `joining_year`, `cur_semester`, `cur_division`, `cur_roll_no`, `stud_status`) VALUES
('2020049812', 'Dhola Drashti Ishwarbhai', 'Female', '2002-11-15', 'drashtidhola.mscit20@vnsgu.ac.in', '+91 9687630768', 3, 2020, 5, 'A', 19, 1),
('2020049819', 'Ghevariya Archit Nareshbhai', 'Male', '2003-03-05', 'architghevariya.mscit20@vnsgu.ac.in', '+91 7383837798', 3, 2020, 5, 'A', 26, 1),
('2020049836', 'Khunt Shubham Vinubhai', 'Male', '2003-07-18', 'shubhamkhunt.mscit20@vnsgu.ac.in', '+91 8849178317', 3, 2020, 5, 'A', 42, 1),
('2020049837', 'Kukadiya Nupul Bhaveshbhai', 'Female', '2002-08-08', 'nupulkukadiya.mscit20@vnsgu.ac.in', '+91 6355517262', 3, 2020, 5, 'A', 43, 1),
('2020049910', 'Ramani Harshil Shaileshbhai', 'Male', '2003-05-08', 'harshilramani.mscit20@vnsgu.ac.in', '+91 9624561892', 3, 2020, 5, 'B', 113, 1),
('2020049935', 'Tikiwala Shikhaa Rupalkumar', 'Female', '2002-08-24', 'shikhaatikiwala.mscit20@vnsgu.ac.in', '+91 8200290477', 3, 2020, 5, 'B', 138, 1);

--
-- Triggers `Students`
--
DELIMITER $$
CREATE TRIGGER `move_student_to_bckp` BEFORE DELETE ON `Students` FOR EACH ROW BEGIN
INSERT INTO Bckp_Students VALUES(OLD.spid,OLD.name,OLD.gender,OLD.dob,OLD.email,OLD.contact_no,OLD.course_id,OLD.joining_year,OLD.cur_semester,OLD.cur_division,OLD.cur_roll_no);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Subjects`
--

CREATE TABLE `Subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `semester` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Subjects`
--

INSERT INTO `Subjects` (`subject_id`, `subject_code`, `subject_name`, `semester`) VALUES
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
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `username` varchar(256) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_type` smallint(6) NOT NULL,
  `user_access` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`username`, `password`, `user_type`, `user_access`) VALUES
('ams.jpd@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJHKTQz63E9RPxIX/88VoNwmlyNroAqe', 3, 1),
('architghevariya.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('dajoshi@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('degulestan@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('dgpandey@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('drashtidhola.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eURFIGhto2yXL0LzQ2g9wA1grwfdn5Ly', 1, 1),
('fgthakker@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('harshilramani.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('hiteshlad@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('kspandey@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('npmehta@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('nupulkukadiya.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('pjpatel@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('pkpandya@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('pydesai@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('sachaudhari@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('shikhaatikiwala.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('shubhamkhunt.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('trshah@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('vhsurati@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 2, 1);

--
-- Triggers `Users`
--
DELIMITER $$
CREATE TRIGGER `move_user_to_bckp` BEFORE DELETE ON `Users` FOR EACH ROW BEGIN
INSERT INTO Bckp_Users VALUES(OLD.username,OLD.password,OLD.user_type);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `User_roles`
--

CREATE TABLE `User_roles` (
  `user_type` smallint(6) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_roles`
--

INSERT INTO `User_roles` (`user_type`, `role_name`) VALUES
(3, 'Admin'),
(2, 'Faculty'),
(1, 'Student');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ams_setup_faculties_map`
-- (See below for the actual view)
--
CREATE TABLE `vw_ams_setup_faculties_map` (
`ams_setup_id` int(11)
,`fid` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_faculties`
-- (See below for the actual view)
--
CREATE TABLE `vw_faculties` (
`fid` varchar(10)
,`name` varchar(256)
,`gender` varchar(10)
,`dob` date
,`email` varchar(256)
,`contact_no` varchar(15)
,`joining_year` year(4)
,`designation` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_students`
-- (See below for the actual view)
--
CREATE TABLE `vw_students` (
`spid` varchar(10)
,`name` varchar(256)
,`gender` varchar(10)
,`dob` date
,`email` varchar(256)
,`contact_no` varchar(15)
,`course_name` varchar(255)
,`joining_year` year(4)
,`cur_semester` smallint(6)
,`cur_division` char(1)
,`cur_roll_no` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_users_auth`
-- (See below for the actual view)
--
CREATE TABLE `vw_users_auth` (
`username` varchar(256)
,`password` varchar(1000)
,`user_type` smallint(6)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_ams_setup_faculties_map`
--
DROP TABLE IF EXISTS `vw_ams_setup_faculties_map`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vnsguit`@`localhost` SQL SECURITY DEFINER VIEW `vw_ams_setup_faculties_map`  AS SELECT `Ams_setup_faculties_map`.`ams_setup_id` AS `ams_setup_id`, `Ams_setup_faculties_map`.`fid` AS `fid` FROM `Ams_setup_faculties_map` WHERE (`Ams_setup_faculties_map`.`setup_status` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_faculties`
--
DROP TABLE IF EXISTS `vw_faculties`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vnsguit`@`localhost` SQL SECURITY DEFINER VIEW `vw_faculties`  AS SELECT `F`.`fid` AS `fid`, `F`.`name` AS `name`, `F`.`gender` AS `gender`, `F`.`dob` AS `dob`, `F`.`email` AS `email`, `F`.`contact_no` AS `contact_no`, `F`.`joining_year` AS `joining_year`, `R`.`role_name` AS `designation` FROM (`Faculties` `F` join `Faculty_roles` `R`) WHERE ((`F`.`role_id` = `R`.`role_id`) AND (`F`.`fac_status` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_students`
--
DROP TABLE IF EXISTS `vw_students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vnsguit`@`localhost` SQL SECURITY DEFINER VIEW `vw_students`  AS SELECT `Students`.`spid` AS `spid`, `Students`.`name` AS `name`, `Students`.`gender` AS `gender`, `Students`.`dob` AS `dob`, `Students`.`email` AS `email`, `Students`.`contact_no` AS `contact_no`, `Courses`.`course_name` AS `course_name`, `Students`.`joining_year` AS `joining_year`, `Students`.`cur_semester` AS `cur_semester`, `Students`.`cur_division` AS `cur_division`, `Students`.`cur_roll_no` AS `cur_roll_no` FROM (`Students` join `Courses`) WHERE ((`Students`.`course_id` = `Courses`.`course_id`) AND (`Students`.`stud_status` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_users_auth`
--
DROP TABLE IF EXISTS `vw_users_auth`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vnsguit`@`localhost` SQL SECURITY DEFINER VIEW `vw_users_auth`  AS SELECT `Users`.`username` AS `username`, `Users`.`password` AS `password`, `Users`.`user_type` AS `user_type` FROM `Users` WHERE (`Users`.`user_access` = 1) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ams_api`
--
ALTER TABLE `Ams_api`
  ADD PRIMARY KEY (`reading_no`),
  ADD KEY `FK_api_spid` (`spid`),
  ADD KEY `idx_AmsReaderNo` (`reader_no`),
  ADD KEY `idx_AmsSemster` (`semester`);

--
-- Indexes for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  ADD PRIMARY KEY (`att_no`),
  ADD KEY `idx_Ams_attendance_master_spid` (`spid`),
  ADD KEY `idx_Ams_attendance_master_ams_setup_id` (`ams_setup_id`);

--
-- Indexes for table `Ams_readers`
--
ALTER TABLE `Ams_readers`
  ADD PRIMARY KEY (`reader_id`),
  ADD UNIQUE KEY `UNQ_reader_no` (`reader_no`),
  ADD UNIQUE KEY `idx_ReaderNo` (`reader_no`);

--
-- Indexes for table `Ams_setup_course_subject_map`
--
ALTER TABLE `Ams_setup_course_subject_map`
  ADD PRIMARY KEY (`ams_setup_id`),
  ADD UNIQUE KEY `UNQ_ams_setup_per_year` (`cs_id`,`year`),
  ADD KEY `idx_amsSetupCsIdMap` (`cs_id`);

--
-- Indexes for table `Ams_setup_faculties_map`
--
ALTER TABLE `Ams_setup_faculties_map`
  ADD PRIMARY KEY (`ams_setup_id`,`fid`),
  ADD KEY `FK_ams_setup_fid_map` (`fid`);

--
-- Indexes for table `Ams_setup_students_map`
--
ALTER TABLE `Ams_setup_students_map`
  ADD PRIMARY KEY (`ams_setup_id`,`spid`),
  ADD KEY `FK_ams_setup_spid_map` (`spid`);

--
-- Indexes for table `Bckp_Ams_attendance_master`
--
ALTER TABLE `Bckp_Ams_attendance_master`
  ADD PRIMARY KEY (`att_no`),
  ADD KEY `idx_AmsAttMasterAmsSetupSpid_bckp` (`spid`),
  ADD KEY `idx_AmsAttMasterAmsSetupId_bckp` (`ams_setup_id`);

--
-- Indexes for table `Bckp_Ams_setup_course_subject_map`
--
ALTER TABLE `Bckp_Ams_setup_course_subject_map`
  ADD PRIMARY KEY (`ams_setup_id`),
  ADD UNIQUE KEY `UNQ_ams_setup_per_year_bckp` (`cs_id`,`year`),
  ADD KEY `idx_amsSetupCsIdMap_bckp` (`cs_id`);

--
-- Indexes for table `Bckp_Ams_setup_faculties_map`
--
ALTER TABLE `Bckp_Ams_setup_faculties_map`
  ADD PRIMARY KEY (`ams_setup_id`,`fid`),
  ADD KEY `FK_ams_setup_fid_map_bckp` (`fid`);

--
-- Indexes for table `Bckp_Ams_setup_students_map`
--
ALTER TABLE `Bckp_Ams_setup_students_map`
  ADD PRIMARY KEY (`ams_setup_id`,`spid`),
  ADD KEY `idx_amsSetupStudMap_bckp` (`spid`);

--
-- Indexes for table `Bckp_Faculties`
--
ALTER TABLE `Bckp_Faculties`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `FK_fac_email_bckp` (`email`),
  ADD KEY `FK_fac_role_bckp` (`role_id`);

--
-- Indexes for table `Bckp_Rfid_uid_spid_map`
--
ALTER TABLE `Bckp_Rfid_uid_spid_map`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `UNQ_spid_map_bckp` (`spid`),
  ADD UNIQUE KEY `idx_StudUidSpidMap_bckp` (`spid`);

--
-- Indexes for table `Bckp_Students`
--
ALTER TABLE `Bckp_Students`
  ADD PRIMARY KEY (`spid`),
  ADD KEY `FK_stud_email_bckp` (`email`),
  ADD KEY `FK_stud_course_id_bckp` (`course_id`);

--
-- Indexes for table `Bckp_Users`
--
ALTER TABLE `Bckp_Users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `idx_user_type_bckp` (`user_type`);

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `UNQ_course_name` (`course_name`),
  ADD UNIQUE KEY `idx_courseName` (`course_name`);

--
-- Indexes for table `Course_subject_map`
--
ALTER TABLE `Course_subject_map`
  ADD PRIMARY KEY (`cs_id`),
  ADD UNIQUE KEY `UNQ_course_subject_map` (`course_id`,`subject_id`),
  ADD UNIQUE KEY `idx_course_subject_map` (`course_id`,`subject_id`),
  ADD KEY `FK_subject_map` (`subject_id`);

--
-- Indexes for table `Faculties`
--
ALTER TABLE `Faculties`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `UNQ_fec_email` (`email`),
  ADD UNIQUE KEY `Faculty_email` (`email`),
  ADD KEY `FK_fac_role` (`role_id`);

--
-- Indexes for table `Faculty_roles`
--
ALTER TABLE `Faculty_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `UNQ_fac_role` (`role_name`),
  ADD UNIQUE KEY `idx_RoleName` (`role_name`);

--
-- Indexes for table `Rfid_uid_spid_map`
--
ALTER TABLE `Rfid_uid_spid_map`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `UNQ_spid_map` (`spid`),
  ADD UNIQUE KEY `idx_StudUidSpidMap` (`spid`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`spid`),
  ADD UNIQUE KEY `UNQ_stud_email` (`email`),
  ADD UNIQUE KEY `idx_email` (`email`),
  ADD KEY `idx_cur_sem` (`cur_semester`),
  ADD KEY `idx_cur_div` (`cur_division`),
  ADD KEY `idx_cur_course_id` (`course_id`);

--
-- Indexes for table `Subjects`
--
ALTER TABLE `Subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `UNQ_subject_name` (`subject_code`),
  ADD UNIQUE KEY `idx_subjectCode` (`subject_code`),
  ADD KEY `idx_subjectName` (`subject_name`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `idx_user_type` (`user_type`);

--
-- Indexes for table `User_roles`
--
ALTER TABLE `User_roles`
  ADD PRIMARY KEY (`user_type`),
  ADD UNIQUE KEY `UNQ_user_role` (`role_name`),
  ADD UNIQUE KEY `idx_RoleName` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ams_api`
--
ALTER TABLE `Ams_api`
  MODIFY `reading_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  MODIFY `att_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Ams_readers`
--
ALTER TABLE `Ams_readers`
  MODIFY `reader_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Ams_setup_course_subject_map`
--
ALTER TABLE `Ams_setup_course_subject_map`
  MODIFY `ams_setup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Bckp_Ams_attendance_master`
--
ALTER TABLE `Bckp_Ams_attendance_master`
  MODIFY `att_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Courses`
--
ALTER TABLE `Courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Course_subject_map`
--
ALTER TABLE `Course_subject_map`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Faculty_roles`
--
ALTER TABLE `Faculty_roles`
  MODIFY `role_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Subjects`
--
ALTER TABLE `Subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `User_roles`
--
ALTER TABLE `User_roles`
  MODIFY `user_type` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ams_api`
--
ALTER TABLE `Ams_api`
  ADD CONSTRAINT `FK_api_spid` FOREIGN KEY (`spid`) REFERENCES `Rfid_uid_spid_map` (`spid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reader_readerNo` FOREIGN KEY (`reader_no`) REFERENCES `Ams_readers` (`reader_no`) ON UPDATE CASCADE;

--
-- Constraints for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  ADD CONSTRAINT `FK_attedance_spid_map` FOREIGN KEY (`spid`) REFERENCES `Students` (`spid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendance_ams_setup_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_course_subject_map`
--
ALTER TABLE `Ams_setup_course_subject_map`
  ADD CONSTRAINT `FK_ams_setup_cs_id_map` FOREIGN KEY (`cs_id`) REFERENCES `Course_subject_map` (`cs_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_faculties_map`
--
ALTER TABLE `Ams_setup_faculties_map`
  ADD CONSTRAINT `FK_ams_setup_fid_map` FOREIGN KEY (`fid`) REFERENCES `Faculties` (`fid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_students_map`
--
ALTER TABLE `Ams_setup_students_map`
  ADD CONSTRAINT `FK_ams_setup_spid_map` FOREIGN KEY (`spid`) REFERENCES `Students` (`spid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_attendance_master`
--
ALTER TABLE `Bckp_Ams_attendance_master`
  ADD CONSTRAINT `FK_attedance_spid_map2_bckp` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendance_ams_setup_map_bckp` FOREIGN KEY (`ams_setup_id`) REFERENCES `Bckp_Ams_setup_course_subject_map` (`ams_setup_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_setup_course_subject_map`
--
ALTER TABLE `Bckp_Ams_setup_course_subject_map`
  ADD CONSTRAINT `FK_ams_setup_cs_id_map_bckp` FOREIGN KEY (`cs_id`) REFERENCES `Course_subject_map` (`cs_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_setup_faculties_map`
--
ALTER TABLE `Bckp_Ams_setup_faculties_map`
  ADD CONSTRAINT `FK_ams_setup_fid_map_bckp` FOREIGN KEY (`fid`) REFERENCES `Bckp_Faculties` (`fid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_ams_setup_id_map_bckp` FOREIGN KEY (`ams_setup_id`) REFERENCES `Bckp_Ams_setup_course_subject_map` (`ams_setup_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_setup_students_map`
--
ALTER TABLE `Bckp_Ams_setup_students_map`
  ADD CONSTRAINT `FK_ams_setup_spid_map_bckp` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_ams_setup_id_map_bckp` FOREIGN KEY (`ams_setup_id`) REFERENCES `Bckp_Ams_setup_course_subject_map` (`ams_setup_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Faculties`
--
ALTER TABLE `Bckp_Faculties`
  ADD CONSTRAINT `FK_fac_email_bckp` FOREIGN KEY (`email`) REFERENCES `Bckp_Users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_role_bckp` FOREIGN KEY (`role_id`) REFERENCES `Faculty_roles` (`role_id`);

--
-- Constraints for table `Bckp_Rfid_uid_spid_map`
--
ALTER TABLE `Bckp_Rfid_uid_spid_map`
  ADD CONSTRAINT `FK_uid_spid_map_bckp` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Students`
--
ALTER TABLE `Bckp_Students`
  ADD CONSTRAINT `FK_stud_course_id_bckp` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`),
  ADD CONSTRAINT `FK_stud_email_bckp` FOREIGN KEY (`email`) REFERENCES `Bckp_Users` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Users`
--
ALTER TABLE `Bckp_Users`
  ADD CONSTRAINT `FK_Bckp_Users_role_map_bckp` FOREIGN KEY (`user_type`) REFERENCES `User_roles` (`user_type`) ON UPDATE CASCADE;

--
-- Constraints for table `Course_subject_map`
--
ALTER TABLE `Course_subject_map`
  ADD CONSTRAINT `FK_Course_map` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_subject_map` FOREIGN KEY (`subject_id`) REFERENCES `Subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Faculties`
--
ALTER TABLE `Faculties`
  ADD CONSTRAINT `FK_fac_email` FOREIGN KEY (`email`) REFERENCES `Users` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_role` FOREIGN KEY (`role_id`) REFERENCES `Faculty_roles` (`role_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Rfid_uid_spid_map`
--
ALTER TABLE `Rfid_uid_spid_map`
  ADD CONSTRAINT `FK_uid_spid_map` FOREIGN KEY (`spid`) REFERENCES `Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `FK_stud_course_id` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_email` FOREIGN KEY (`email`) REFERENCES `Users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `FK_Users_role_map` FOREIGN KEY (`user_type`) REFERENCES `User_roles` (`user_type`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`vnsguit`@`localhost` EVENT `deleteAmsApiDataDaily` ON SCHEDULE EVERY 1 DAY STARTS '2022-09-05 03:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
  TRUNCATE TABLE ams_api;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
