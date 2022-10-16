-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2022 at 04:22 PM
-- Server version: 5.7.40
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
CREATE DATABASE IF NOT EXISTS `vnsguit_james` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vnsguit_james`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`vnsguit`@`localhost` PROCEDURE `deleteBckpStud` (IN `UN` VARCHAR(256))  BEGIN  
 DELETE FROM Bckp_Users WHERE username=UN;
COMMIT;
END$$

DELIMITER ;

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
  `fid` varchar(10) NOT NULL,
  `att_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `att_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_attendance_master`
--

INSERT INTO `Ams_attendance_master` (`att_no`, `spid`, `ams_setup_id`, `fid`, `att_date_time`, `att_status`) VALUES
(26, '2020049910', 2, 'FID12348', '2022-10-14 17:53:51', 1),
(27, '2020049910', 2, 'FID12348', '2022-10-14 17:53:51', 0),
(28, '2020049910', 2, 'FID12348', '2022-10-14 17:53:51', 1),
(29, '2020049910', 3, 'FID12347', '2022-10-14 17:53:51', 0),
(30, '2020049910', 3, 'FID12347', '2022-10-14 17:53:51', 0),
(31, '2020049910', 3, 'FID12347', '2022-10-14 17:53:51', 0),
(32, '2020049910', 3, 'FID12347', '2022-10-14 17:53:51', 1),
(33, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(34, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(35, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(36, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(37, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(38, '2020049910', 4, 'FID12349', '2022-10-14 17:53:51', 1),
(39, '2020049910', 5, 'FID12349', '2022-10-14 17:53:51', 0),
(40, '2020049910', 5, 'FID12349', '2022-10-14 17:53:51', 0),
(41, '2020049910', 5, 'FID12349', '2022-10-14 17:53:51', 0),
(42, '2020049910', 5, 'FID12349', '2022-10-14 17:53:51', 0),
(43, '2020049910', 5, 'FID12349', '2022-10-14 17:53:51', 0),
(44, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(45, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 1),
(46, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 0),
(47, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 1),
(48, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 0),
(51, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 1),
(52, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 0),
(53, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 1),
(54, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 0),
(55, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 1),
(56, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 0),
(57, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(58, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(59, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(60, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(61, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(62, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 0),
(63, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(64, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 0),
(65, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(66, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 0),
(67, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(68, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 0),
(69, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 0),
(70, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 1),
(71, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 0),
(72, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 1),
(73, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 0),
(74, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 1),
(75, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 0),
(76, '2020049910', 2, 'FID12348', '2022-10-14 17:53:52', 1),
(77, '2020049910', 3, 'FID12347', '2022-10-14 17:53:52', 0),
(78, '2020049910', 3, 'FID12347', '2022-10-14 17:53:52', 0),
(79, '2020049910', 3, 'FID12347', '2022-10-14 17:53:52', 0),
(80, '2020049910', 3, 'FID12347', '2022-10-14 17:53:52', 1),
(81, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(82, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(83, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(84, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(85, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(86, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(87, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(88, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(89, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(90, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(91, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(92, '2020049910', 5, 'FID12349', '2022-10-14 17:53:52', 0),
(93, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 1),
(94, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 0),
(95, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 1),
(96, '2020049910', 6, 'FID12345', '2022-10-14 17:53:52', 0),
(119, '2020049910', 1, 'FID12346', '2022-10-14 17:53:52', 1),
(120, '2020049910', 2, 'FID12345', '2022-10-14 17:53:52', 1),
(121, '2020049910', 4, 'FID12349', '2022-10-14 17:53:52', 1),
(122, '2020049910', 3, 'FID12347', '2022-10-14 17:54:20', 0),
(166, '2020049836', 1, 'FID12346', '2022-10-16 15:30:27', 0),
(167, '2020049836', 2, 'FID12346', '2022-10-16 15:30:27', 0),
(168, '2020049836', 2, 'FID12346', '2022-10-16 15:30:27', 0),
(169, '2020049836', 3, 'FID12346', '2022-10-16 15:30:27', 0),
(170, '2020049836', 4, 'FID12346', '2022-10-16 15:30:27', 0),
(171, '2020049836', 5, 'FID12346', '2022-10-16 15:30:27', 0),
(172, '2020049836', 6, 'FID12346', '2022-10-16 15:30:27', 0),
(173, '2020049836', 7, 'FID12346', '2022-10-16 15:30:27', 0),
(175, '2020049836', 1, 'FID12346', '2022-10-16 15:31:03', 0),
(176, '2020049836', 2, 'FID12346', '2022-10-16 15:31:03', 0),
(177, '2020049836', 2, 'FID12346', '2022-10-16 15:31:03', 0),
(178, '2020049836', 3, 'FID12346', '2022-10-16 15:31:03', 0),
(179, '2020049836', 4, 'FID12346', '2022-10-16 15:31:03', 0),
(180, '2020049836', 5, 'FID12346', '2022-10-16 15:31:03', 0),
(181, '2020049836', 6, 'FID12346', '2022-10-16 15:31:03', 0),
(182, '2020049836', 7, 'FID12346', '2022-10-16 15:31:03', 0),
(184, '2020049836', 1, 'FID12346', '2022-10-16 15:32:34', 0),
(185, '2020049836', 2, 'FID12346', '2022-10-16 15:32:34', 0),
(186, '2020049836', 2, 'FID12346', '2022-10-16 15:32:34', 0),
(187, '2020049836', 3, 'FID12346', '2022-10-16 15:32:34', 0),
(188, '2020049836', 4, 'FID12346', '2022-10-16 15:32:34', 0),
(189, '2020049836', 5, 'FID12346', '2022-10-16 15:32:34', 0),
(190, '2020049836', 6, 'FID12346', '2022-10-16 15:32:34', 0),
(191, '2020049836', 7, 'FID12346', '2022-10-16 15:32:34', 0),
(193, '2020049836', 1, 'FID12346', '2022-10-16 15:32:50', 0),
(194, '2020049836', 2, 'FID12346', '2022-10-16 15:34:22', 0),
(195, '2020049836', 2, 'FID12346', '2022-10-16 15:34:22', 0),
(196, '2020049836', 3, 'FID12346', '2022-10-16 15:34:22', 0),
(197, '2020049836', 4, 'FID12346', '2022-10-16 15:34:22', 0),
(198, '2020049836', 5, 'FID12346', '2022-10-16 15:34:22', 0),
(199, '2020049836', 6, 'FID12346', '2022-10-16 15:34:22', 0),
(200, '2020049836', 7, 'FID12346', '2022-10-16 15:34:22', 0),
(201, '2020049836', 8, 'FID12346', '2022-10-16 15:34:22', 0),
(202, '2020049837', 1, 'FID12346', '2022-10-16 15:34:22', 0),
(203, '2020049837', 2, 'FID12346', '2022-10-16 15:34:22', 0),
(204, '2020049837', 2, 'FID12346', '2022-10-16 15:34:22', 0),
(205, '2020049837', 3, 'FID12346', '2022-10-16 15:34:22', 0),
(206, '2020049837', 4, 'FID12346', '2022-10-16 15:34:22', 0),
(207, '2020049837', 5, 'FID12346', '2022-10-16 15:34:22', 0),
(208, '2020049837', 6, 'FID12346', '2022-10-16 15:34:22', 0),
(209, '2020049837', 7, 'FID12346', '2022-10-16 15:34:22', 0),
(210, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 0),
(211, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 0),
(212, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 1),
(213, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 0),
(214, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 1),
(215, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 0),
(216, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 1),
(217, '2020049910', 1, 'FID12346', '2022-10-16 15:36:12', 0),
(218, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(219, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(220, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(221, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(222, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(223, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 0),
(224, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(225, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 0),
(226, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(227, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 0),
(228, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 1),
(229, '2020049910', 2, 'FID12345', '2022-10-16 15:36:12', 0),
(230, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 0),
(231, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 1),
(232, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 0),
(233, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 1),
(234, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 0),
(235, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 1),
(236, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 0),
(237, '2020049910', 2, 'FID12348', '2022-10-16 15:36:12', 1),
(238, '2020049910', 3, 'FID12347', '2022-10-16 15:36:12', 0),
(239, '2020049910', 3, 'FID12347', '2022-10-16 15:36:12', 0),
(240, '2020049910', 3, 'FID12347', '2022-10-16 15:36:12', 0),
(241, '2020049910', 3, 'FID12347', '2022-10-16 15:36:12', 1),
(242, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(243, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(244, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(245, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(246, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(247, '2020049910', 4, 'FID12349', '2022-10-16 15:36:12', 1),
(248, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(249, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(250, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(251, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(252, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(253, '2020049910', 5, 'FID12349', '2022-10-16 15:36:12', 0),
(254, '2020049910', 6, 'FID12345', '2022-10-16 15:36:12', 1),
(255, '2020049910', 6, 'FID12345', '2022-10-16 15:36:12', 0),
(256, '2020049910', 6, 'FID12345', '2022-10-16 15:36:12', 1),
(257, '2020049910', 6, 'FID12345', '2022-10-16 15:36:12', 0),
(258, '2020049836', 1, 'FID12346', '2022-10-16 15:37:10', 0),
(259, '2020049836', 2, 'FID12346', '2022-10-16 15:37:10', 0),
(260, '2020049836', 2, 'FID12346', '2022-10-16 15:37:10', 0),
(261, '2020049836', 3, 'FID12346', '2022-10-16 15:37:10', 0),
(262, '2020049836', 4, 'FID12346', '2022-10-16 15:37:10', 0),
(263, '2020049836', 5, 'FID12346', '2022-10-16 15:37:10', 0),
(264, '2020049836', 6, 'FID12346', '2022-10-16 15:37:10', 0),
(265, '2020049836', 7, 'FID12346', '2022-10-16 15:37:10', 0),
(266, '2020049836', 8, 'FID12346', '2022-10-16 15:37:10', 0),
(267, '2020049837', 1, 'FID12346', '2022-10-16 15:37:10', 0),
(268, '2020049837', 2, 'FID12346', '2022-10-16 15:37:10', 0),
(269, '2020049837', 2, 'FID12346', '2022-10-16 15:37:10', 0),
(270, '2020049837', 3, 'FID12346', '2022-10-16 15:37:10', 0),
(271, '2020049837', 4, 'FID12346', '2022-10-16 15:37:10', 0),
(272, '2020049837', 5, 'FID12346', '2022-10-16 15:37:10', 0),
(273, '2020049837', 6, 'FID12346', '2022-10-16 15:37:10', 0),
(274, '2020049837', 7, 'FID12346', '2022-10-16 15:37:10', 0),
(275, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 1),
(276, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 0),
(277, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 1),
(278, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 0),
(279, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 1),
(280, '2020049910', 1, 'FID12346', '2022-10-16 15:37:10', 0),
(281, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(282, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(283, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(284, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(285, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(286, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 0),
(287, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(288, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 0),
(289, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(290, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 0),
(291, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 1),
(292, '2020049910', 2, 'FID12345', '2022-10-16 15:37:10', 0),
(293, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 0),
(294, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 1),
(295, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 0),
(296, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 1),
(297, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 0),
(298, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 1),
(299, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 0),
(300, '2020049910', 2, 'FID12348', '2022-10-16 15:37:10', 1),
(301, '2020049910', 3, 'FID12347', '2022-10-16 15:37:10', 0),
(302, '2020049910', 3, 'FID12347', '2022-10-16 15:37:10', 0),
(303, '2020049910', 3, 'FID12347', '2022-10-16 15:37:10', 0),
(304, '2020049910', 3, 'FID12347', '2022-10-16 15:37:10', 1),
(305, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(306, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(307, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(308, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(309, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(310, '2020049910', 4, 'FID12349', '2022-10-16 15:37:10', 1),
(311, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(312, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(313, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(314, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(315, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(316, '2020049910', 5, 'FID12349', '2022-10-16 15:37:10', 0),
(317, '2020049910', 6, 'FID12345', '2022-10-16 15:37:10', 1),
(318, '2020049910', 6, 'FID12345', '2022-10-16 15:37:10', 0),
(319, '2020049910', 6, 'FID12345', '2022-10-16 15:37:10', 1),
(320, '2020049910', 6, 'FID12345', '2022-10-16 15:37:10', 0),
(321, '2020049836', 1, 'FID12346', '2022-10-16 15:38:04', 0),
(322, '2020049836', 2, 'FID12346', '2022-10-16 15:38:04', 0),
(323, '2020049836', 2, 'FID12346', '2022-10-16 15:38:04', 0),
(324, '2020049836', 3, 'FID12346', '2022-10-16 15:38:04', 0),
(325, '2020049836', 4, 'FID12346', '2022-10-16 15:38:04', 0),
(326, '2020049836', 5, 'FID12346', '2022-10-16 15:38:04', 0),
(327, '2020049836', 6, 'FID12346', '2022-10-16 15:38:04', 0),
(328, '2020049836', 7, 'FID12346', '2022-10-16 15:38:04', 0),
(329, '2020049836', 8, 'FID12346', '2022-10-16 15:38:04', 0),
(330, '2020049837', 1, 'FID12346', '2022-10-16 15:38:23', 0),
(331, '2020049837', 2, 'FID12346', '2022-10-16 15:38:23', 0),
(332, '2020049837', 2, 'FID12346', '2022-10-16 15:38:23', 0),
(333, '2020049837', 3, 'FID12346', '2022-10-16 15:38:23', 0),
(334, '2020049837', 4, 'FID12346', '2022-10-16 15:38:23', 0),
(335, '2020049837', 5, 'FID12346', '2022-10-16 15:38:23', 0),
(336, '2020049837', 6, 'FID12346', '2022-10-16 15:38:23', 0),
(337, '2020049837', 7, 'FID12346', '2022-10-16 15:38:23', 0),
(338, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 1),
(339, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 0),
(340, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 1),
(341, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 0),
(342, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 1),
(343, '2020049910', 1, 'FID12346', '2022-10-16 15:38:40', 0),
(344, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(345, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(346, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(347, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(348, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(349, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 0),
(350, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(351, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 0),
(352, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(353, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 0),
(354, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 1),
(355, '2020049910', 2, 'FID12345', '2022-10-16 15:38:40', 0),
(356, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 0),
(357, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 1),
(358, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 0),
(359, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 1),
(360, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 0),
(361, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 1),
(362, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 0),
(363, '2020049910', 2, 'FID12348', '2022-10-16 15:38:40', 1),
(364, '2020049910', 3, 'FID12347', '2022-10-16 15:38:40', 0),
(365, '2020049910', 3, 'FID12347', '2022-10-16 15:38:40', 0),
(366, '2020049910', 3, 'FID12347', '2022-10-16 15:38:40', 0),
(367, '2020049910', 3, 'FID12347', '2022-10-16 15:38:40', 1),
(368, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(369, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(370, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(371, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(372, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(373, '2020049910', 4, 'FID12349', '2022-10-16 15:38:40', 1),
(374, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(375, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(376, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(377, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(378, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(379, '2020049910', 5, 'FID12349', '2022-10-16 15:38:40', 0),
(380, '2020049910', 6, 'FID12345', '2022-10-16 15:38:40', 1),
(381, '2020049910', 6, 'FID12345', '2022-10-16 15:38:40', 0),
(382, '2020049910', 6, 'FID12345', '2022-10-16 15:38:40', 1),
(383, '2020049910', 6, 'FID12345', '2022-10-16 15:38:40', 0),
(384, '2020049837', 1, 'FID12346', '2022-10-16 15:39:06', 0),
(385, '2020049837', 2, 'FID12345', '2022-10-16 15:39:06', 1),
(386, '2020049837', 2, 'FID12348', '2022-10-16 15:39:06', 1),
(387, '2020049837', 3, 'FID12347', '2022-10-16 15:39:06', 0),
(388, '2020049837', 4, 'FID12349', '2022-10-16 15:39:06', 1),
(389, '2020049837', 5, 'FID12349', '2022-10-16 15:39:06', 0),
(390, '2020049837', 6, 'FID12345', '2022-10-16 15:39:06', 1),
(391, '2020049935', 1, 'FID12346', '2022-10-16 15:39:06', 0),
(392, '2020049935', 2, 'FID12345', '2022-10-16 15:39:06', 1),
(393, '2020049935', 2, 'FID12345', '2022-10-16 15:39:06', 0),
(394, '2020049935', 2, 'FID12348', '2022-10-16 15:39:06', 1),
(395, '2020049935', 3, 'FID12347', '2022-10-16 15:39:06', 0),
(396, '2020049935', 4, 'FID12349', '2022-10-16 15:39:06', 1),
(397, '2020049935', 5, 'FID12349', '2022-10-16 15:39:06', 0),
(398, '2020049935', 6, 'FID12345', '2022-10-16 15:39:06', 1),
(399, '2020049819', 1, 'FID12346', '2022-10-16 15:39:06', 0),
(400, '2020049819', 2, 'FID12345', '2022-10-16 15:39:06', 1),
(401, '2020049819', 2, 'FID12348', '2022-10-16 15:39:06', 1),
(402, '2020049819', 3, 'FID12347', '2022-10-16 15:39:06', 0),
(403, '2020049819', 4, 'FID12349', '2022-10-16 15:39:06', 1),
(404, '2020049819', 5, 'FID12349', '2022-10-16 15:39:06', 0),
(405, '2020049819', 6, 'FID12345', '2022-10-16 15:39:07', 1),
(406, '2020049910', 1, 'FID12346', '2022-10-16 15:39:34', 1),
(407, '2020049910', 2, 'FID12345', '2022-10-16 15:39:34', 1),
(408, '2020049910', 1, 'FID12346', '2022-10-16 15:39:41', 1),
(409, '2020049910', 2, 'FID12345', '2022-10-16 15:39:41', 1),
(410, '2020049910', 3, 'FID12347', '2022-10-16 15:39:41', 0),
(411, '2020049910', 4, 'FID12349', '2022-10-16 15:39:41', 1),
(412, '2020049910', 5, 'FID12349', '2022-10-16 15:39:41', 1),
(413, '2020049910', 6, 'FID12345', '2022-10-16 15:39:41', 1);

--
-- Triggers `Ams_attendance_master`
--
DELIMITER $$
CREATE TRIGGER `count_PR_AB_days` AFTER INSERT ON `Ams_attendance_master` FOR EACH ROW BEGIN
    IF NEW.att_status = TRUE THEN
    UPDATE Ams_setup_students_map SET p_days = p_days + 1 WHERE spid = NEW.spid and ams_setup_id=NEW.ams_setup_id;
    ELSE 
    UPDATE Ams_setup_students_map SET a_days = a_days + 1 WHERE spid = NEW.spid  and ams_setup_id=NEW.ams_setup_id;
    END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_feedback`
--

CREATE TABLE `Ams_feedback` (
  `fb_id` int(11) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `givenAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ams_readers`
--

CREATE TABLE `Ams_readers` (
  `reader_id` smallint(6) NOT NULL,
  `reader_no` smallint(6) NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ams_readers`
--

INSERT INTO `Ams_readers` (`reader_id`, `reader_no`, `status`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);

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
(1, '2020049819', 0, 1),
(1, '2020049836', 0, 6),
(1, '2020049837', 0, 4),
(1, '2020049910', 23, 24),
(1, '2020049935', 0, 1),
(2, '2020049819', 2, 0),
(2, '2020049836', 0, 12),
(2, '2020049837', 2, 6),
(2, '2020049910', 77, 48),
(2, '2020049935', 2, 1),
(3, '2020049819', 0, 1),
(3, '2020049836', 0, 6),
(3, '2020049837', 0, 4),
(3, '2020049910', 6, 22),
(3, '2020049935', 0, 1),
(4, '2020049819', 1, 0),
(4, '2020049836', 0, 6),
(4, '2020049837', 1, 3),
(4, '2020049910', 40, 0),
(4, '2020049935', 1, 0),
(5, '2020049819', 0, 1),
(5, '2020049836', 0, 6),
(5, '2020049837', 0, 4),
(5, '2020049910', 2, 36),
(5, '2020049935', 0, 1),
(6, '2020049819', 1, 0),
(6, '2020049836', 0, 6),
(6, '2020049837', 1, 3),
(6, '2020049910', 14, 12),
(6, '2020049935', 1, 0),
(7, '2020049819', 0, 0),
(7, '2020049836', 0, 6),
(7, '2020049837', 0, 3),
(7, '2020049910', 0, 0),
(7, '2020049935', 0, 0),
(8, '2020049819', 0, 0),
(8, '2020049836', 0, 3),
(8, '2020049837', 0, 0),
(8, '2020049910', 0, 0),
(8, '2020049935', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Bckp_Ams_attendance_master`
--

CREATE TABLE `Bckp_Ams_attendance_master` (
  `att_no` bigint(20) NOT NULL,
  `spid` varchar(10) NOT NULL,
  `ams_setup_id` int(11) NOT NULL,
  `fid` varchar(10) NOT NULL,
  `att_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `att_status` tinyint(1) NOT NULL
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
(1, 'M.Sc. [I.T.]', 4),
(2, 'M.Sc. [I.C.T.]', 4),
(3, 'B.Sc. [I.T.]', 6);

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
('05 8F DB 52 29 11 00', '2020049836'),
('05 8F DB 52 29 71 00', '2020049910');

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
('drashtidhola.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('fgthakker@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('harshilramani.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('hiteshlad@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('kspandey@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('npmehta@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('nupulkukadiya.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('pjpatel@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('pkpandya@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('pydesai@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eOLHA.sdhWN6An/Ddyf904FQc8rR5OWS', 2, 1),
('sachaudhari@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('shikhaatikiwala.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('shubhamkhunt.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 1, 1),
('trshah@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 2, 1),
('vhsurati@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 2, 1);

--
-- Triggers `Users`
--
DELIMITER $$
CREATE TRIGGER `move_stud_to_bckp` BEFORE DELETE ON `Users` FOR EACH ROW BEGIN
    
    INSERT INTO Bckp_Users VALUES(OLD.username,OLD.password,OLD.user_type);

    IF OLD.user_type = 1 THEN

 /*insertion into backup data set */

    INSERT INTO Bckp_Students(spid,name,gender,dob,email,contact_no,course_id,joining_year,last_semester,last_division,last_roll_no) SELECT spid,name,gender,dob,email,contact_no,course_id,joining_year,cur_semester,cur_division,cur_roll_no FROM Students WHERE email =  OLD.username;
    INSERT INTO Bckp_Rfid_uid_spid_map SELECT * FROM Rfid_uid_spid_map WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);
    INSERT INTO Bckp_Ams_setup_students_map SELECT * FROM Ams_setup_students_map WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);
    INSERT INTO Bckp_Ams_attendance_master SELECT * FROM Ams_attendance_master WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);
    
 /* deletion from active data set */

    DELETE FROM Students WHERE email =  OLD.username;
    DELETE FROM Rfid_uid_spid_map WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);
    DELETE FROM Ams_setup_students_map WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);
    DELETE FROM Ams_attendance_master WHERE spid = (SELECT spid FROM Students WHERE email =  OLD.username);

    END IF;

    /* User table record will be deleted automatically as on before delete trigger is there.  */
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
  ADD KEY `idx_AmsReaderNo` (`reader_no`),
  ADD KEY `idx_AmsSemster` (`semester`),
  ADD KEY `FK_api_spid` (`spid`);

--
-- Indexes for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  ADD PRIMARY KEY (`att_no`),
  ADD KEY `idx_Ams_attendance_master_spid` (`spid`),
  ADD KEY `idx_Ams_attendance_master_ams_setup_id` (`ams_setup_id`);

--
-- Indexes for table `Ams_feedback`
--
ALTER TABLE `Ams_feedback`
  ADD PRIMARY KEY (`fb_id`),
  ADD KEY `idx_Ams_feedback_email` (`email`);

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
  ADD KEY `idx_AmsAttMasterAmsSetupId_bckp` (`ams_setup_id`),
  ADD KEY `FK_bckp_fid_map` (`fid`);

--
-- Indexes for table `Bckp_Ams_setup_students_map`
--
ALTER TABLE `Bckp_Ams_setup_students_map`
  ADD PRIMARY KEY (`ams_setup_id`,`spid`),
  ADD KEY `idx_amsSetupStudMap_bckp` (`spid`);

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
  ADD KEY `FK_stud_course_id_bckp` (`course_id`),
  ADD KEY `FK_stud_email_bckp` (`email`);

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
  ADD UNIQUE KEY `UNQ_fac_email` (`email`) USING BTREE,
  ADD UNIQUE KEY `idx_Faculty_email` (`email`) USING BTREE,
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
  MODIFY `reading_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  MODIFY `att_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT for table `Ams_feedback`
--
ALTER TABLE `Ams_feedback`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ams_readers`
--
ALTER TABLE `Ams_readers`
  MODIFY `reader_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Ams_setup_course_subject_map`
--
ALTER TABLE `Ams_setup_course_subject_map`
  MODIFY `ams_setup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Bckp_Ams_attendance_master`
--
ALTER TABLE `Bckp_Ams_attendance_master`
  MODIFY `att_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

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
  MODIFY `user_type` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ams_api`
--
ALTER TABLE `Ams_api`
  ADD CONSTRAINT `FK_api_spid` FOREIGN KEY (`spid`) REFERENCES `Rfid_uid_spid_map` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reader_readerNo` FOREIGN KEY (`reader_no`) REFERENCES `Ams_readers` (`reader_no`) ON UPDATE CASCADE;

--
-- Constraints for table `Ams_attendance_master`
--
ALTER TABLE `Ams_attendance_master`
  ADD CONSTRAINT `FK_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_spid_map` FOREIGN KEY (`spid`) REFERENCES `Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_course_subject_map`
--
ALTER TABLE `Ams_setup_course_subject_map`
  ADD CONSTRAINT `FK_ams_setup_cs_id_map` FOREIGN KEY (`cs_id`) REFERENCES `Course_subject_map` (`cs_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_faculties_map`
--
ALTER TABLE `Ams_setup_faculties_map`
  ADD CONSTRAINT `FK_ams_setup_fid_map` FOREIGN KEY (`fid`) REFERENCES `Faculties` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_fac_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ams_setup_students_map`
--
ALTER TABLE `Ams_setup_students_map`
  ADD CONSTRAINT `FK_ams_setup_spid_map` FOREIGN KEY (`spid`) REFERENCES `Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_attendance_master`
--
ALTER TABLE `Bckp_Ams_attendance_master`
  ADD CONSTRAINT `FK_bckp_ams_setup_id_map` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bckp_fid_map` FOREIGN KEY (`fid`) REFERENCES `Faculties` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bckp_stud_spid_map` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Ams_setup_students_map`
--
ALTER TABLE `Bckp_Ams_setup_students_map`
  ADD CONSTRAINT `FK_ams_setup_spid_map_bckp` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_ams_setup_id_map_bckp` FOREIGN KEY (`ams_setup_id`) REFERENCES `Ams_setup_course_subject_map` (`ams_setup_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Rfid_uid_spid_map`
--
ALTER TABLE `Bckp_Rfid_uid_spid_map`
  ADD CONSTRAINT `FK_uid_spid_map_bckp` FOREIGN KEY (`spid`) REFERENCES `Bckp_Students` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bckp_Students`
--
ALTER TABLE `Bckp_Students`
  ADD CONSTRAINT `FK_stud_course_id_bckp` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_stud_email_bckp` FOREIGN KEY (`email`) REFERENCES `Bckp_Users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_fac_email` FOREIGN KEY (`email`) REFERENCES `Users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
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
CREATE DEFINER=`vnsguit`@`localhost` EVENT `deleteAmsApiDataDaily` ON SCHEDULE EVERY 1 DAY STARTS '2022-10-04 03:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
  TRUNCATE TABLE Ams_api;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
