-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 04:06 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT 0,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `discount_price`, `category`) VALUES
(1, 'Áo Khoác Phao Tím Pastel', 850000, 650000, 'Jacket'),
(2, 'Áo Khoác Jean Denim', 550000, 420000, 'Jacket'),
(3, 'Áo Hoodie Nâu Oversize', 450000, 0, 'Jacket'),
(4, 'Áo Khoác Jacket Kéo Khóa Đỏ Đô', 620000, 500000, 'Jacket'),
(5, 'Áo Khoác Bomber Xám Ghi', 580000, 450000, 'Jacket'),
(6, 'Áo Varsity Đỏ Đen Phối Da', 750000, 590000, 'Jacket'),
(7, 'Áo Hoodie Zip Xám Sáng', 420000, 320000, 'Jacket'),
(8, 'Áo Hoodie Hồng Pastel', 390000, 0, 'Jacket'),
(9, 'Áo Hoodie Zip Xám Đậm', 420000, 350000, 'Jacket'),
(10, 'Áo Khoác Kaki Vàng Be', 520000, 410000, 'Jacket'),
(11, 'Áo Khoác Blazer Đen', 890000, 720000, 'Jacket'),
(12, 'Quần Tây Âu Đen Slimfit', 450000, 350000, 'Pants'),
(13, 'Quần Short Jean Xanh Nhạt', 350000, 0, 'Pants'),
(14, 'Quần Kaki Suông Xám', 480000, 380000, 'Pants'),
(15, 'Quần Jean Ống Suông Xanh', 550000, 440000, 'Pants'),
(16, 'Quần Short Thun Xám Sport', 250000, 180000, 'Pants'),
(17, 'Quần Jogger Đen Túi Hộp', 490000, 0, 'Pants'),
(18, 'Quần Short Nữ Hồng', 220000, 150000, 'Pants'),
(19, 'Quần Nỉ Baggy Xám', 380000, 290000, 'Pants'),
(20, 'Quần Short Đen Basic', 240000, 0, 'Pants'),
(21, 'Quần Nhung Tăm Nâu', 520000, 415000, 'Pants'),
(22, 'Áo Thun Basic Đen', 250000, 190000, 'T-Shirt'),
(23, 'Áo Thun Trắng In Chữ Blue', 280000, 210000, 'T-Shirt'),
(24, 'Áo Thun Trắng Basic', 220000, 0, 'T-Shirt'),
(25, 'Áo Thun Xám Trơn', 220000, 165000, 'T-Shirt'),
(26, 'Áo Polo Trắng Classic', 350000, 280000, 'T-Shirt'),
(27, 'Áo Thun Tay Dài Xanh Đen', 320000, 0, 'T-Shirt'),
(28, 'Áo Polo Xanh Navy', 380000, 295000, 'T-Shirt'),
(29, 'Áo Thun Xanh In Hình AIME', 300000, 220000, 'T-Shirt'),
(30, 'Áo Polo Sọc Ngang Xanh Trắng', 360000, 270000, 'T-Shirt'),
(31, 'Áo Thun Đỏ In Chữ Sau Lưng', 290000, 0, 'T-Shirt'),
(32, 'Áo Thun Hồng Tím Pastel', 260000, 195000, 'T-Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
   `role` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: User, 1: Admin' -- thêm trường role để phân quyền
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `role`) VALUES
(1, 'Sajal', 'sajal.agrawal1997@gmail.com', '57f231b1ec41dc6641270cb09a56f897', '8899889988', 'Indore', '100 palace colony, Indore', 1),
(2, 'Ram', 'ram1234@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889989', 'Pune', '100 palace colony, Pune', 0),
(3, 'Shyam', 'shyam@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889990', 'Bangalore', '100 palace colony, Bangalore', 0); -- Cập nhật trường role

-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `status` enum('Added to cart','Confirmed','Ordered COD','Ordered MoMo','Cancelled') NOT NULL DEFAULT 'Added to cart',
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `size`, `status`, `quantity`) VALUES
(7, 3, 3, 'L', 'Added to cart', 1),
(8, 3, 4, 'M', 'Added to cart', 1),
(9, 3, 5, 'S', 'Added to cart', 1),
(10, 3, 11, 'XL', 'Added to cart', 1),
(11, 1, 9, 'L', 'Added to cart', 1),
(12, 1, 2, 'M', 'Added to cart', 1),
(13, 1, 8, 'S', 'Added to cart', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_items`
--
ALTER TABLE `users_items`
  ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
