-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2026 lúc 03:45 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT 0,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Đang đổ dữ liệu cho bảng `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `discount_price`, `category`, `image`) VALUES
(1, 'Áo Khoác Phao Tím Pastel', 850000, 650000, 'Jacket', '1.jpg'),
(2, 'Áo Khoác Jean Denim', 550000, 420000, 'Jacket', '2.jpg'),
(3, 'Áo Hoodie Nâu Oversize', 450000, 0, 'Jacket', '3.jpg'),
(4, 'Áo Khoác Jacket Kéo Khóa Đỏ Đô', 620000, 500000, 'Jacket', '4.jpg'),
(5, 'Áo Khoác Bomber Xám Ghi', 580000, 450000, 'Jacket', '5.jpg'),
(6, 'Áo Varsity Đỏ Đen Phối Da', 900000, 590000, 'Jacket', '6.jpg'),
(7, 'Áo Hoodie Zip Xám Sáng', 420000, 320000, 'Jacket', '7.jpg'),
(8, 'Áo Hoodie Hồng Pastel', 390000, 0, 'Jacket', '8.jpg'),
(9, 'Áo Hoodie Zip Xám Đậm', 420000, 350000, 'Jacket', '9.jpg'),
(10, 'Áo Khoác Kaki Vàng Be', 520000, 410000, 'Jacket', '10.jpg'),
(11, 'Áo Khoác Blazer Đen', 890000, 720000, 'Jacket', '11.jpg'),
(12, 'Quần Tây Âu Đen Slimfit', 450000, 350000, 'Pants', '12.jpg'),
(13, 'Quần Short Jean Xanh Nhạt', 350000, 0, 'Pants', '13.jpg'),
(14, 'Quần Kaki Suông Xám', 480000, 380000, 'Pants', '14.jpg'),
(15, 'Quần Jean Ống Suông Xanh', 550000, 440000, 'Pants', '15.jpg'),
(16, 'Quần Short Thun Xám Sport', 250000, 180000, 'Pants', '16.jpg'),
(17, 'Quần Jogger Đen Túi Hộp', 490000, 0, 'Pants', '17.jpg'),
(18, 'Quần Short Nữ Hồng', 220000, 150000, 'Pants', '18.jpg'),
(19, 'Quần Nỉ Baggy Xám', 380000, 290000, 'Pants', '19.jpg'),
(20, 'Quần Short Đen Basic', 240000, 0, 'Pants', '20.jpg'),
(21, 'Quần Nhung Tăm Nâu', 520000, 415000, 'Pants', '21.jpg'),
(22, 'Áo Thun Basic Đen', 250000, 190000, 'T-Shirt', '22.jpg'),
(23, 'Áo Thun Trắng In Chữ Blue', 280000, 210000, 'T-Shirt', '23.jpg'),
(24, 'Áo Thun Trắng Basic', 220000, 0, 'T-Shirt', '24.jpg'),
(25, 'Áo Thun Xám Trơn', 220000, 165000, 'T-Shirt', '25.jpg'),
(26, 'Áo Polo Trắng Classic', 350000, 280000, 'T-Shirt', '26.jpg'),
(27, 'Áo Thun Tay Dài Xanh Đen', 320000, 0, 'T-Shirt', '27.jpg'),
(28, 'Áo Polo Xanh Navy', 380000, 295000, 'T-Shirt', '28.jpg'),
(29, 'Áo Thun Xanh In Hình AIME', 300000, 220000, 'T-Shirt', '29.jpg'),
(30, 'Áo Polo Sọc Ngang Xanh Trắng', 360000, 270000, 'T-Shirt', '30.jpg'),
(31, 'Áo Thun Đỏ In Chữ Sau Lưng', 290000, 0, 'T-Shirt', '31.jpg'),
(32, 'Áo Thun Hồng Tím Pastel', 260000, 195000, 'T-Shirt', '32.jpg'),
(36, 'Áo Nỉ Xanh Biển', 340000, 0, 'Jacket', 'Áo Khoác Nỉ.jpg'),
(37, 'Áo Hoodie Zip', 399000, 0, 'Jacket', 'Áo Hoodie Zip.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: User, 1: Admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `role`) VALUES
(1, 'Sajal', 'sajal.agrawal1997@gmail.com', '57f231b1ec41dc6641270cb09a56f897', '8899889988', 'Indore', '100 palace colony, Indore', 1),
(2, 'Ram', 'ram1234@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889989', 'Pune', '100 palace colony, Pune', 0),
(3, 'Shyam', 'shyam@xyz.com', '57f231b1ec41dc6641270cb09a56f897', '8899889990', 'Bangalore', '100 palace colony, Bangalore', 0),
(0, 'Lê Thanh Long', 'long@gmail.com', '14e1b600b1fd579f47433b88e8d85291', '1023333333', 'hcm', 'hcm', 1),
(0, 'Minh', 'minh@gmail.com', '70873e8580c9900986939611618d7b1e', '123222222222', 'hà n?i', 'hà n?i', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_items`
--

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `status` enum('Added to cart','Confirmed','Ordered COD','Ordered MoMo','Cancelled') NOT NULL DEFAULT 'Added to cart',
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
