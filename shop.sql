-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 07:05 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `user_id`, `quantity`) VALUES
(6, 3, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`order_items_id`, `order_id`, `product_id`, `quantity`) VALUES
(406, 30, 41, 1),
(407, 30, 45, 3),
(408, 30, 44, 3),
(409, 30, 55, 15),
(414, 32, 58, 5),
(415, 32, 51, 5),
(416, 32, 46, 6),
(417, 32, 42, 2),
(418, 32, 54, 5),
(419, 32, 43, 2),
(422, 34, 45, 3),
(423, 34, 51, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivery_address`, `created_at`) VALUES
(30, 80, 'Country1, City1 - Address1 | Zip1', '2023-08-10 06:21:32'),
(32, 77, 'Country3, City3 - Address3 | Zip3', '2023-08-10 06:23:57'),
(34, 81, 'awd, awd - awd | awd', '2023-08-10 06:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `size`, `image`, `created_at`) VALUES
(41, 'T-shirt', 15, 'S', '41.webp', '2023-08-09 14:52:30'),
(42, 'Jeans', 40, 'M', '42.webp', '2023-08-09 14:52:30'),
(43, 'Hoodie', 30, 'L', '43.webp', '2023-08-09 14:52:30'),
(44, 'Socks', 15, 'M', '44.webp', '2023-08-09 14:52:30'),
(45, 'Sweater', 35, 'L', '45.webp', '2023-08-09 14:52:30'),
(46, 'Gray Shoes', 20, 'S', '46.webp', '2023-08-09 14:52:30'),
(47, 'Jacket', 60, 'XL', '47.webp', '2023-08-09 14:52:30'),
(48, 'Sneakers', 25, 'S', '48.webp', '2023-08-09 14:52:30'),
(50, 'Pants', 45, 'L', '50.webp', '2023-08-09 14:52:30'),
(51, 'Coat', 75, 'XL', '51.webp', '2023-08-09 14:52:30'),
(52, 'Red T-Shirt', 22, 'S', '52.webp', '2023-08-09 14:52:30'),
(53, 'Suit', 80, 'M', '53.webp', '2023-08-09 14:52:30'),
(54, 'Sweatshirt', 28, 'L', '54.webp', '2023-08-09 14:52:30'),
(55, 'Sweatpants', 30, 'M', '55.webp', '2023-08-09 14:52:30'),
(58, 'Pullover', 38, 'L', '58.webp', '2023-08-09 14:52:30'),
(59, 'Jumpsuit', 42, 'M', '59.webp', '2023-08-09 14:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `is_admin`, `created_at`) VALUES
(77, 'user1', 'username1', 'user1@gmail.com', '$2y$10$9NS/Hxb7.EdMqxBZbxo22O.AcHn.HpS4s/lJXfIamPSs2D7nDQ1cq', 0, '2023-08-10 04:58:10'),
(78, 'user2', 'usernam2', 'user2@gmail.com', '$2y$10$UggLC7/b51g58fhaObJbZOL8/cLO4dNas1eUdB.niho4BI2ZwrRL.', 0, '2023-08-10 04:58:29'),
(79, 'user3', 'username3', 'user3@gmail.com', '$2y$10$TNJm0AbnTrfUtEgEL72GNOEwefSNnIvdmFR1xa8PIzlfdY7k7x6TS', 0, '2023-08-10 04:58:48'),
(80, 'user4', 'username4', 'user4@gmail.com', '$2y$10$7enIDwovArSf8Av2swm9JO0MmfunitLZ8/SnKybSLvpVhoEDgUAji', 0, '2023-08-10 04:59:01'),
(81, 'user5', 'username5', 'user5@gmail.com', '$2y$10$BD1JUMBabN/A0MS0KGyalensRVQpcCXax8y8.wQXXcI3c/uVYi4a2', 0, '2023-08-10 04:59:14'),
(82, 'admin', 'admin', 'admin@example.com', '$2y$10$Zhtk.HrMXFPfwrtZMtw3zOCCJU2NOmRDf4XscvaDb5dQaiEObWToC', 1, '2023-08-10 06:51:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
