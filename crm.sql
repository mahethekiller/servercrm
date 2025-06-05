-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2025 at 08:45 PM
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
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_type` int(10) NOT NULL,
  `price` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `attribute_name`, `attribute_type`, `price`, `status`, `added_date`, `updated_at`) VALUES
(1, '2 GB', 1, '200', 'active', '2025-06-04 01:28:36', NULL),
(2, '250GB', 2, '300', 'active', '2025-06-04 01:51:34', NULL),
(3, 'Mysql', 3, '100', 'active', '2025-06-04 01:51:39', NULL),
(4, 'Dual Core', 4, '201', 'active', '2025-06-04 01:51:51', NULL),
(5, '1', 6, '11', 'active', '2025-06-04 01:51:57', NULL),
(6, '2MBPS', 7, '332', 'active', '2025-06-04 01:52:09', NULL),
(7, 'Linux', 5, '111', 'active', '2025-06-04 01:52:20', NULL),
(8, 'Windows', 5, '223', 'active', '2025-06-04 01:52:28', NULL),
(9, '1GB', 1, '222', 'active', '2025-06-04 01:52:34', NULL),
(10, '1TB', 2, '5000', 'active', '2025-06-04 01:58:07', NULL),
(11, 'SQL', 3, '2000', 'active', '2025-06-04 01:58:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_types`
--

CREATE TABLE `attribute_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `added` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attribute_types`
--

INSERT INTO `attribute_types` (`id`, `name`, `status`, `added`, `updated`) VALUES
(1, 'Ram', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(2, 'HDD', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(3, 'database', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(4, 'CPU', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(5, 'OS', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(6, 'IP', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58'),
(7, 'bandwidth', 1, '2025-06-04 23:40:58', '2025-06-04 23:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `cin_no` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `client_name`, `country_code`, `gst_no`, `cin_no`, `city`, `state`, `industry`, `email`, `phone`, `address`, `pin_code`, `country`, `pan_no`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Test', 's', 's', '123333433331assa', 'ss', 's', 'ss', 's', 'a@g.com', '1234567890', 'tt', '123456', 's', 'ss', 'http://localhost/crm/admin/companies/edit.php?id=1', '2025-05-23 05:07:23', '2025-05-23 09:09:08'),
(2, 'Test', '', NULL, NULL, NULL, '', '', '', 'a@g.com', '1234567890', 'tt', '', NULL, NULL, NULL, '2025-05-23 05:07:23', '2025-05-23 05:07:23'),
(3, 'tt', '', NULL, NULL, NULL, '', '', '', 'ttt', 'ttt', 'ttt', '', NULL, NULL, 'ttt', '2025-05-23 06:28:22', '2025-05-23 06:28:22'),
(4, 'ddd', '', NULL, NULL, NULL, '', '', '', 'dd', 'dd', 'dd', '', NULL, NULL, 'dd', '2025-05-23 06:28:45', '2025-05-23 06:28:45'),
(5, 'ddd', '', NULL, NULL, NULL, '', '', '', 'dd@g.com', 'dd', 'dd', '', NULL, NULL, 'https://www.ww.com', '2025-05-23 06:31:37', '2025-05-23 06:31:37'),
(6, 'test', 'test', '11', '', '', '', '', '', 'test@g.com', '11', 'test', '', '', '', '', '2025-05-23 08:12:41', '2025-05-23 08:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `crmleads`
--

CREATE TABLE `crmleads` (
  `id` int(11) NOT NULL,
  `added_by` int(100) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `lead_status` varchar(100) NOT NULL,
  `lead_source` varchar(100) NOT NULL,
  `follow_up_date` date NOT NULL,
  `expected_closer` date NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crmleads`
--

INSERT INTO `crmleads` (`id`, `added_by`, `company_id`, `lead_status`, `lead_source`, `follow_up_date`, `expected_closer`, `website`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Not Interested/ Junk Lead', 'Outbound - Cold Call by Sales Team', '2025-05-23', '2025-05-24', '', 's', '2025-05-23 19:44:45', '2025-05-23 20:01:14'),
(2, 1, 1, 'Not Interested/ Junk Lead', 'Outbound - Cold Call by Sales Team', '2025-05-22', '2025-05-29', '', 's', '2025-05-23 19:46:15', '2025-05-23 20:01:17'),
(3, 1, 1, 'Not Interested/ Junk Lead', 'Outbound - Cold Call by Sales Team', '2025-05-22', '2025-05-29', '', 's', '2025-05-23 19:47:01', '2025-05-23 20:01:20'),
(4, 1, 1, 'Not Interested/ Junk Lead', 'Outbound - Cold Call by Sales Team', '2025-05-22', '2025-05-29', '', 's', '2025-05-23 19:47:54', '2025-05-23 19:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `menu_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `status`, `added_date`, `updated_at`) VALUES
(1, 'Linux Server', '', NULL, 0.00, 'active', '2025-06-03 13:52:14', NULL),
(2, 'Windows Server', NULL, NULL, 0.00, 'active', '2025-06-03 13:52:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `antivirus_backup` varchar(10) DEFAULT NULL,
  `description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `server_type` varchar(100) NOT NULL,
  `otc` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL,
  `lead_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `quotation_status` varchar(20) NOT NULL DEFAULT 'demo',
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `antivirus_backup`, `description`, `location`, `server_type`, `otc`, `sub_total`, `lead_id`, `company_id`, `added_by`, `updated`, `added_date`, `quotation_status`, `status`) VALUES
(18, 'No', '', 'Noida', 'Virtual', 0.00, 1255.00, 1, 1, 1, '2025-06-05 23:32:33', '2025-06-05 23:32:33', 'demo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quote_details`
--

CREATE TABLE `quote_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(10) DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_type` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `reg_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `sale_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `added_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_details`
--

INSERT INTO `quote_details` (`id`, `quotation_id`, `product_id`, `attribute_type`, `attribute_id`, `reg_price`, `unit`, `sale_price`, `total_price`, `added_date`) VALUES
(1, NULL, 1, 1, 0, 0.00, 1, 0.00, 0.00, '2025-06-04 21:05:01'),
(2, NULL, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-04 21:07:27'),
(3, NULL, 1, 1, 1, 200.00, 2, 0.00, 400.00, '2025-06-04 21:08:26'),
(4, NULL, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-04 21:22:08'),
(5, NULL, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-04 21:22:08'),
(6, NULL, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-04 21:22:08'),
(7, NULL, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-04 21:22:09'),
(8, NULL, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-04 21:22:09'),
(9, NULL, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-04 21:22:09'),
(10, NULL, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-04 21:22:09'),
(11, 11, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 17:17:04'),
(12, 11, 1, 2, 2, 300.00, 2, 0.00, 600.00, '2025-06-05 17:17:04'),
(13, 11, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 17:17:04'),
(14, 11, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 17:17:04'),
(15, 11, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 17:17:04'),
(16, 11, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 17:17:04'),
(17, 11, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 17:17:04'),
(18, 12, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 19:30:03'),
(19, 12, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 19:30:03'),
(20, 12, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 19:30:03'),
(21, 12, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 19:30:03'),
(22, 12, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 19:30:03'),
(23, 12, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 19:30:03'),
(24, 12, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 19:30:03'),
(25, 13, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 19:32:02'),
(26, 13, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 19:32:03'),
(27, 13, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 19:32:03'),
(28, 13, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 19:32:03'),
(29, 13, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 19:32:03'),
(30, 13, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 19:32:03'),
(31, 13, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 19:32:03'),
(32, 14, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 19:32:03'),
(33, 14, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 19:32:03'),
(34, 14, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 19:32:03'),
(35, 14, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 19:32:03'),
(36, 14, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 19:32:03'),
(37, 14, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 19:32:03'),
(38, 14, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 19:32:03'),
(39, 15, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 19:33:42'),
(40, 15, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 19:33:43'),
(41, 15, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 19:33:43'),
(42, 15, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 19:33:43'),
(43, 15, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 19:33:43'),
(44, 15, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 19:33:43'),
(45, 15, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 19:33:43'),
(46, 16, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 20:00:42'),
(47, 16, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 20:00:42'),
(48, 16, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 20:00:42'),
(49, 16, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 20:00:42'),
(50, 16, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 20:00:42'),
(51, 16, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 20:00:42'),
(52, 16, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 20:00:42'),
(53, 17, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 20:01:05'),
(54, 17, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 20:01:05'),
(55, 17, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 20:01:05'),
(56, 17, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 20:01:05'),
(57, 17, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 20:01:05'),
(58, 17, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 20:01:05'),
(59, 17, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 20:01:05'),
(60, 18, 1, 1, 1, 200.00, 1, 0.00, 200.00, '2025-06-05 20:02:33'),
(61, 18, 1, 2, 2, 300.00, 1, 0.00, 300.00, '2025-06-05 20:02:33'),
(62, 18, 1, 3, 3, 100.00, 1, 0.00, 100.00, '2025-06-05 20:02:33'),
(63, 18, 1, 4, 4, 201.00, 1, 0.00, 201.00, '2025-06-05 20:02:33'),
(64, 18, 1, 5, 7, 111.00, 1, 0.00, 111.00, '2025-06-05 20:02:33'),
(65, 18, 1, 6, 5, 11.00, 1, 0.00, 11.00, '2025-06-05 20:02:33'),
(66, 18, 1, 7, 6, 332.00, 1, 0.00, 332.00, '2025-06-05 20:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `username`, `password`, `role`) VALUES
(1, 'mahe', 'm@g.com', 'male', 'mahe', '$2y$10$.oeGEYeY3h446Yo5.B0XU.3Eq3QWLfr0K4enqljh7DbLTUwRnkAGm', 'admin'),
(2, 'mahe', 'mmm@g.com', 'Male', 'mahe2', '$2y$10$6JO3JO3ggKSro8IREK3mtuQusZChC/YPytsDCR5S2EH.SuhXne1om', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_types`
--
ALTER TABLE `attribute_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crmleads`
--
ALTER TABLE `crmleads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_details`
--
ALTER TABLE `quote_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_id` (`product_id`),
  ADD KEY `idx_attribute_type` (`attribute_type`),
  ADD KEY `idx_attribute_id` (`attribute_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attribute_types`
--
ALTER TABLE `attribute_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crmleads`
--
ALTER TABLE `crmleads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quote_details`
--
ALTER TABLE `quote_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
