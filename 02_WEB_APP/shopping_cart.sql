-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2022 at 12:05 PM
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
-- Database: `shopping_cart`
--
CREATE DATABASE IF NOT EXISTS `shopping_cart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopping_cart`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`, `status`) VALUES
(1, 'Menswear', 1),
(2, 'Womenswear', 1),
(4, 'Chlidrenwear', 1),
(5, 'Formalwear', 1),
(6, 'Partywear', 1),
(7, 'Casualwear', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `p_name` varchar(256) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `address` varchar(256) NOT NULL DEFAULT 'J P Dower...',
  `d_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `username`, `p_name`, `quantity`, `address`, `d_status`) VALUES
(1, 'harshilramani9777@gmail.com', 'Luxury', 2, 'J P Dower..', 1),
(2, 'harshilramani9777@gmail.com', 'watch', 1, 'J P Dower..', 1),
(3, 'archit@gmail.com', 'Fiction', 1, 'J P Dower..', 1),
(4, 'riddhi@gmail.com', 'Comdey', 1, 'J P Dower..', 1),
(5, 'riddhi@gmail.com', 'Womenwear', 1, 'J P Dower...', 1),
(6, 'riddhi@gmail.com', 'Menswear', 1, 'J P Dower...', 0),
(7, 'archit@gmail.com', 'Childwear', 1, 'J P Dower...', 0),
(8, 'harshilramani9777@gmail.com', 'Shoes for mens', 2, 'Select a country...,,', 0),
(9, 'harshilramani9777@gmail.com', 'Women suit', 1, 'Select a country...,,', 0),
(10, 'harshilramani9777@gmail.com', 'Shoes for mens', 1, 'Select a country...,,', 0),
(11, 'harshilramani9777@gmail.com', 'Shoes for mens', 1, 'Select a country...,,', 0),
(12, 'harshilramani9777@gmail.com', 'Frunky jeans', 1, 'USA,Gujrat,394101,', 0),
(13, 'harshilramani9777@gmail.com', 'Main suits for men', 1, 'USA,Gujrat,394101,', 0),
(14, 'harshilramani9777@gmail.com', 'Women suit', 1, 'USA,Gujrat,394101,', 0),
(15, 'harshilramani9777@gmail.com', 'Frunky jeans', 1, 'USA,Gujrat,394101,', 0),
(16, 'harshilramani9777@gmail.com', 'Frunky jeans', 3, 'USA,Gujrat,394101,', 0),
(17, 'harshilramani9777@gmail.com', 'Main suits for men', 2, 'UK,Gujrat,394101,', 0),
(18, 'harshilramani9777@gmail.com', 'Jacket for children', 3, 'UK,Gujrat,394101,', 0),
(19, 'harshilramani9777@gmail.com', 'Main suits for men', 2, 'USA,Gujrat,394101,', 0),
(20, 'harshilramani9777@gmail.com', 'Jacket for children', 1, 'USA,Gujrat,394101,', 0),
(21, 'harshilramani9777@gmail.com', 'Jacket for children', 2, 'USA,Gujrat,394101,', 0),
(22, 'harshilramani9777@gmail.com', 'Salwar', 2, 'USA,Gujrat,394101,', 0),
(23, 'harshilramani9777@gmail.com', 'Ladies denim', 2, 'USA,Gujrat,394101,', 0),
(24, 'harshilramani9777@gmail.com', 'Main suits for men', 2, 'USA,Gujrat,394101,', 0),
(25, 'harshilramani9777@gmail.com', 'Kurti', 2, 'USA,Gujrat,394101,', 1),
(26, 'trusha@gmail.com', 'Main suits for men', 2, 'UK,Gujrat,394101,', 0),
(27, 'trusha@gmail.com', 'Kurti', 3, 'UK,Gujrat,394101,', 0),
(28, 'trusha@gmail.com', 'Crop top', 1, 'UK,Gujrat,394101,', 0),
(29, 'nishi@gmail.com', 'Main suits for men', 3, 'UK,Gujrat,394101,', 0),
(30, 'nishi@gmail.com', 'Women suit', 2, 'UK,Gujrat,394101,', 0),
(31, 'harshilramani9777@gmail.com', 'Main suits for men', 1, 'USA,Gujrat,394101,', 0),
(32, 'harshilramani9777@gmail.com', 'Women suit', 3, 'USA,Gujrat,394101,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) DEFAULT NULL,
  `p_pic` varchar(1000) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 588
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_name`, `p_pic`, `c_id`, `status`, `price`) VALUES
(1, 'Frunky jeans', '../uploads/gallery-08.jpg', 6, 1, 502),
(2, 'Ladies denim', '../uploads/product-13.jpg', 6, 1, 851),
(3, 'Main suits for men', '../uploads/banner-05.jpg', 5, 1, 756),
(4, 'Women suit', '../uploads/product-07.jpg', 5, 1, 229),
(6, 'Salwar', '../uploads/salwar.jpeg', 2, 1, 849),
(7, 'Kurti', '../uploads/kurti.jpeg', 2, 1, 578),
(8, 'Jacket for children', '../uploads/product-detail-03.jpg', 4, 1, 335),
(9, 'Cap or hat', '../uploads/banner-03.jpg', 4, 1, 919),
(10, 'Sobber women', '../uploads/product-02.jpg', 7, 1, 612),
(13, 'Pants', '../uploads/pants.jpg', 1, 1, 293),
(14, 'Shoes for mens', '../uploads/shoes.jpg', 1, 1, 607),
(15, 'Male shirts', '../uploads/shirts.jpg', 1, 1, 170),
(16, 'T-shirts for men', '../uploads/t-shirts.jpg', 1, 1, 1009),
(17, 'Crop top', '../uploads/product-14.jpg', 2, 1, 517),
(18, 'Jackets for women', '../uploads/blog-03.jpg', 2, 1, 568),
(19, 'Loffer', '../uploads/pexels-pixabay-267301.jpg', 4, 1, 290),
(20, 'watch for kids', '../uploads/product-06.jpg', 4, 1, 725),
(21, 'prime winter jackets for couple', '../uploads/blog-04.jpg', 5, 1, 765),
(22, 'classic lady', '../uploads/product-04.jpg', 6, 1, 650),
(23, 'Trendy top', '../uploads/about-02.jpg', 6, 1, 947),
(24, 'Glancy fashion Jacket', '../uploads/gallery-03.jpg', 5, 1, 795),
(25, 'Tourist bags', '../uploads/thumb-03.jpg', 7, 1, 134),
(26, 'White walker', '../uploads/omar-tursic-ZXQpLIvnUto-unsplash.jpg', 7, 1, 255);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(256) NOT NULL,
  `password` varchar(10000) NOT NULL,
  `token` varchar(256) NOT NULL,
  `type` smallint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `token`, `type`) VALUES
('admin@shoppingcart.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ekP.G6kG7NqqPHnOFMu12n8M2K34rKR6', '5ba6321c47c51f17', 1),
('archit@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', 'b3bdd363ac225103', 2),
('harshilramani.mscit20@vnsgu.ac.in', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', '967a82caf3239cff', 2),
('harshilramani9777@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', 'c7b5681006a46321', 2),
('jeshvi@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', '5d5834ea0a6c4d13', 2),
('nishi@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', '132c76cbc1a63bf1', 2),
('riddhi@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', '06c1d13153be4c86', 2),
('shikkha@gmail.com', '$2a$10$1qAz2wSx3eDc4rFv5tGb5ei/qe74RzludMimU29lkThR7NtwxEy2C', '53d8270a015ba03e', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
