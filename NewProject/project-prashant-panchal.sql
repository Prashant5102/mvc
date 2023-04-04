-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 06:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-prashant-panchal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `path` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`path`, `category_id`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
('', 1, 'mobile', 1, 'dsfefwefw', '0000-00-00 00:00:00', '2023-03-03 03:23:07'),
('', 3, 'aaaaaaaaaa', 1, 'ggggggggg', '2023-02-13 16:26:02', '2023-04-03 06:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `address_id`, `created_at`, `updated_at`) VALUES
(1, 'prashant', 'panchal', 'prashant@gmail.com', 12457857, 'male', 1, 0, '2023-02-14 13:24:04', '2023-03-03 01:32:08'),
(6, 'hiten', 'panchal', 'h@gmail.com', 451226585, 'male', 0, 0, '2023-04-02 05:40:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(10) NOT NULL,
  `state` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `customer_id`) VALUES
(1, 'house no-175,', 'ahmedabad', 'gujrat', 'india', 380022, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `small` varchar(255) NOT NULL,
  `base` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `gallary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jjjk', 1, '2023-03-03 14:22:32', NULL),
(2, 'upi', 1, '2023-03-03 14:22:43', '2023-04-02 07:02:19'),
(6, 'cod', 0, '2023-04-02 07:02:36', '2023-04-03 06:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL DEFAULT 100,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` enum('red','blue') NOT NULL,
  `material` enum('plastic','metal') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(1, 'nokia', '1100', '1100.00', '1100.00', 1, 'mobile', 1, 'blue', 'plastic', '0000-00-00 00:00:00', '2023-03-09 10:36:08'),
(2, 'nokia', '1100', '1100.00', '1100.00', 3, 'mobile', 1, 'blue', 'metal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'samsung', '21', '15555.00', '16600.00', 2, 'smart mobile', 1, 'blue', 'metal', '0000-00-00 00:00:00', '2023-02-14 03:01:19'),
(12, 'asus', '22', '13000.00', '15000.00', 3, 'ggerge', 2, 'red', 'metal', '0000-00-00 00:00:00', '2023-02-14 03:02:09'),
(14, 'aaaa', '25', '872278.00', '78272.00', 2, 'fgifi', 2, 'red', 'metal', '0000-00-00 00:00:00', '2023-02-14 03:01:07'),
(21, 'wdw', '3', '15555.00', '15000.00', 11, 'mobile', 0, 'red', 'plastic', '2023-02-21 10:25:38', '2023-04-01 11:57:37'),
(64, 'htc', '12', '10000.00', '12000.00', 1, 'dfs', 0, 'blue', 'metal', '2023-04-01 17:57:22', '2023-04-02 04:16:52'),
(65, 'lenovo', '51', '15000.00', '20000.00', 2, 'mobile', 0, 'red', 'plastic', '2023-04-01 14:37:19', '2023-04-02 04:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `base` tinyint(4) NOT NULL,
  `thumbnail` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `gallary` tinyint(4) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`product_id`, `media_id`, `name`, `created_at`, `base`, `thumbnail`, `small`, `gallary`, `file_name`) VALUES
(1, 1, 'nokia 1100', '2023-03-13 06:00:03', 0, 0, 0, 0, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(1, 'hiten', 'panchal', 'dfj@flf.ll', 'male', 777777, 1, 'hhhhh', '2023-02-14 14:10:05', '0000-00-00 00:00:00'),
(3, 'ashish', 'odedra', 'od@gmail.com', 'male', 1236547, 1, 'cc', '2023-03-03 01:30:59', '2023-04-02 06:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `shipping_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`shipping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fddd', '799.00', 1, '2023-03-03 13:56:33', '2023-03-03 02:07:20'),
(2, 'kk', '1100.00', 1, '2023-03-03 14:11:41', '2023-04-02 06:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `company`, `created_at`, `updated_at`) VALUES
(1, 'prashant', 'panchal', 'hdh@sjdkjd.com', 98657451, 'male', 1, 'cybercom', '2023-02-14 13:44:54', '2023-03-03 11:47:37'),
(3, 'hiten', 'panchal', 'hp@gmail.com', 65324512, 'male', 1, 'welltech', '2023-02-14 13:47:57', '2023-03-09 10:49:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`shipping_method_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `shipping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
