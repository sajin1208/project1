-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 05:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `name`, `image`, `quantity`, `price`, `created_at`) VALUES
(49, 4, 11, 'dasd', 'p1.1.jpg', 1, 12345.00, '2024-05-01 12:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(255) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(0, 'brass'),
(0, 'gold'),
(0, 'silver');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `productnames` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `address`, `phone_number`, `payment_mode`, `status`, `created_at`, `productnames`) VALUES
(1, 3, 'sajin', 'nakabahil', '9863480246', 'Cash on Delivery', 'Approved', '2024-04-30 16:19:21', ''),
(2, 2, 'sajin1', 'asd', '9863480246', 'cash_on_delivery', 'Approved', '2024-04-30 16:30:25', ''),
(3, 2, 'sajin', 'dasd', '9863480246', 'cash_on_delivery', 'Rejected', '2024-04-30 16:31:49', ''),
(4, 2, 'sajin', 'adas', '9863480246', 'cash_on_delivery', 'Rejected', '2024-04-30 16:33:42', ''),
(5, 2, 'dad', 'dasdsa', '2131231', 'cash_on_delivery', 'Approved', '2024-04-30 16:57:05', ''),
(6, 2, 'dad', 'dasda', '2131231', 'cash_on_delivery', 'Pending', '2024-04-30 17:00:50', ''),
(7, 2, 'hun', 'dasdsa', '3321123', 'cash_on_delivery', 'Rejected', '2024-04-30 17:13:35', ''),
(8, 2, 'dadkja', 'dasd', '3131312', 'cash_on_delivery', 'Pending', '2024-04-30 17:16:19', ''),
(9, 2, 'loves', 'dasd', '4234234', 'cash_on_delivery', 'Pending', '2024-04-30 17:19:41', ''),
(10, 2, 'dasd', 'dadsa', '42342332', 'cash_on_delivery', 'Pending', '2024-04-30 17:20:38', ''),
(11, 3, 'hunter', 'patan', '836846', 'cash_on_delivery', 'Pending', '2024-05-01 09:00:38', 'guitarrr, ads'),
(14, 3, 'saj', 'asdas', '12323132', 'cash_on_delivery', 'Pending', '2024-05-01 13:47:19', 'bell, guitarrr'),
(15, 2, 'nijas', 'dasd', '123456789', 'cash_on_delivery', 'Pending', '2024-05-01 14:04:02', 'ads'),
(16, 4, 'jen', 'nakabahil', '999999999', 'cash_on_delivery', 'Pending', '2024-05-01 16:26:28', 'bell'),
(17, 4, 'jenish', 'nagbahal', '123456789', 'cash_on_delivery', 'Pending', '2024-05-01 16:27:19', 'guitarrr, ads'),
(18, 3, 'sajin', 'dsasad', '21345678', 'cash_on_delivery', 'Approved', '2024-05-03 06:27:25', 'ads, bell, bell, guitarrr');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, ''),
(2, 1, 8, 1, ''),
(3, 1, 8, 1, ''),
(4, 1, 8, 1, ''),
(5, 1, 1, 1, ''),
(6, 1, 1, 1, ''),
(7, 1, 11, 1, ''),
(8, 4, 1, 1, '11.00'),
(9, 4, 8, 1, '132.00'),
(10, 5, 1, 1, '1234.00'),
(11, 5, 8, 1, '132.00'),
(12, 5, 11, 1, '12345.00'),
(13, 6, 1, 1, '1234.00'),
(14, 7, 1, 1, '1234.00'),
(15, 8, 11, 1, '12345.00'),
(16, 9, 11, 1, '12345.00'),
(17, 10, 8, 1, '132.00'),
(18, 10, 8, 1, '132.00'),
(19, 11, 1, 1, '1234.00'),
(20, 11, 8, 1, '132.00'),
(24, 14, 14, 2, '1200.00'),
(25, 14, 1, 1, '1234.00'),
(26, 15, 8, 1, '132.00'),
(27, 16, 15, 2, '1200.00'),
(28, 17, 1, 1, '1234.00'),
(29, 17, 8, 1, '132.00'),
(30, 18, 8, 1, '132.00'),
(31, 18, 14, 4, '1200.00'),
(32, 18, 16, 1, '1200.00'),
(33, 18, 1, 1, '1234.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `price` bigint(100) NOT NULL,
  `imageUrl` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `createdBy` int(100) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `productName`, `price`, `imageUrl`, `description`, `category_name`, `createdBy`, `quantity`) VALUES
(1, 'guitarrr', 1234, 'guitar.jpg', 'dasdasd', '2', 0, 1),
(8, 'ads', 132, 'p1.4.jpg', 'sads', '0', 0, 1),
(11, 'dasd', 12345, 'p1.1.jpg', 'dasdas', 'brass', 0, 1),
(14, 'bell', 1200, 'p1.1.jpg', 'this is brass bell', 'brass', 0, 4),
(15, 'bell', 1200, 'p1.5.jpg', 'this is brass bell', 'silver', 0, 2),
(16, 'bell', 1200, 'p1.6.jpg', 'this is brass bell', 'gold', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`) VALUES
(2, 'sajin man shakya', 'sajin', 'sajin123'),
(3, 'sajinman', 'sajin1', 'sajin123'),
(4, 'jenishshakya', 'jenish', 'jenish123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
