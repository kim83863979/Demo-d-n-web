-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2026 lúc 04:17 PM
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
(37, 'Áo Hoodie Zip', 399000, 0, 'Jacket', 'Áo Hoodie Zip.jpg'),
(38, 'Quần kaki Cam', 780000, 0, 'Pants', 'Quần kaki dài nam.jpg'),
(39, 'Quần thun nam', 210000, 0, 'Pants', 'Quần thun nam.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_method`, `status`, `created_at`) VALUES
(2, 5, 1500000, 'COD', 'Cancelled', '2026-05-01 07:45:21'),
(3, 5, 720000, 'COD', 'Cancelled', '2026-05-01 07:46:42'),
(4, 5, 860000, 'COD', 'Cancelled', '2026-05-01 07:51:40'),
(5, 5, 520000, 'COD', 'Cancelled', '2026-05-01 07:55:09'),
(6, 5, 520000, 'COD', 'Cancelled', '2026-05-01 07:55:46'),
(7, 5, 490000, 'COD', 'Cancelled', '2026-05-01 07:55:55'),
(8, 5, 380000, 'COD', 'Cancelled', '2026-05-01 07:56:16'),
(9, 5, 340000, 'COD', 'Ordered COD', '2026-05-01 07:58:50'),
(10, 5, 490000, 'COD', 'Ordered COD', '2026-05-01 07:58:56'),
(11, 5, 220000, 'COD', 'Cancelled', '2026-05-01 07:59:03'),
(12, 5, 380000, 'COD', 'Ordered COD', '2026-05-01 13:34:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price`) VALUES
(1, 1, 29, 'M', 1, 300000),
(2, 2, 23, 'M', 1, 280000),
(3, 2, 27, 'XL', 1, 320000),
(4, 2, 6, 'M', 1, 900000),
(5, 3, 19, 'M', 1, 380000),
(6, 3, 36, 'L', 1, 340000),
(7, 4, 28, 'S', 1, 380000),
(8, 4, 14, 'M', 1, 480000),
(9, 5, 21, 'S', 1, 520000),
(10, 6, 21, 'M', 1, 520000),
(11, 7, 17, 'S', 1, 490000),
(12, 8, 28, 'XL', 1, 380000),
(13, 9, 36, 'L', 1, 340000),
(14, 10, 17, 'S', 1, 490000),
(15, 11, 24, 'S', 1, 220000),
(16, 12, 19, 'M', 1, 380000);

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
(5, 'Minh', 'minh@gmail.com', '70873e8580c9900986939611618d7b1e', '01111111111111', 'hà n?i', 'hà n?i', 0),
(8, 'Lê Thanh Long', 'long@gmail.com', '14e1b600b1fd579f47433b88e8d85291', '0123400000', 'hcm', 'hcm', 1);

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

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
