-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 12:24 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(256) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `user_token` varchar(1000) NOT NULL,
  `user_type` smallint(6) NOT NULL,
  `user_access` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_token`, `user_type`, `user_access`) VALUES
('admin.jpd.ams@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eip/h3jnmOM0AYJcGkkOXfjNkgXS6wNO', '9316bafb196d3925', 4, 1),
('architghevariya.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', '1d5b92f27d09cc6e', 1, 1),
('drashtidhola.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', 'd2381ca6fb27d6a9', 1, 1),
('fgthakker@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5efYVR09PbLARM89IgOAUFkv9ZdcV0gBG', 'c70ce322e38dc233', 2, 1),
('harshilramani.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5eJDHYY6Nf1V0K/9qAqzIJe38pdTYizVK', '3bcc96af34eeb546', 1, 1),
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

CREATE TABLE `user_roles` (
  `user_type` smallint(6) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_type`, `role_name`) VALUES
(4, 'Admin'),
(2, 'Faculty'),
(3, 'Manager'),
(1, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FK_Users_role_map` (`user_type`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_type`),
  ADD UNIQUE KEY `UNQ_user_role` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_type` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Users_role_map` FOREIGN KEY (`user_type`) REFERENCES `user_roles` (`user_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
