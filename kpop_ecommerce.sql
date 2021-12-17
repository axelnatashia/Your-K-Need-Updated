-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 01:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpop_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone_number`, `email`, `avatar`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '087855117273', 'admin.my@gmail.com', '1636481343.jpg', 'admin', '$2y$10$0AUcC4xF8YSV9ZteoDR6Ge5FWKHAKOK2KVv3LgdGC5l65taqgE50m', '2021-11-09 10:09:04', '2021-11-09 10:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `name`, `phone_number`, `email`, `address`, `province`, `avatar`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'buyer', '087855117273', 'buyer.my@gmail.com', 'addrs', 'sumatera utara', '1636483296.png', 'buyer', '$2y$10$fVeDTwCyiCrCIIJtpIgkBeURdOCUQdEnBD9P7CnpqHQ66OodEXToO', '2021-11-09 10:19:00', '2021-11-11 02:51:42'),
(2, 'buyer2', '087855117273', 'buyer2.my@gmail.com', 'addres', 'sumatera barat', NULL, 'buyer2', '$2y$10$m.YB6ten.X3.Hf5k4CSrkOnPwrTp9n1J6C9x0xYXWqXJqT5y165WC', '2021-11-09 10:19:29', '2021-11-11 02:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `buyer_id`, `seller_product_id`, `qty`, `created_at`, `updated_at`) VALUES
(16, 1, 3, 1, '2021-12-15 22:26:24', '2021-12-15 22:26:24'),
(18, 1, 4, 1, '2021-12-16 16:25:47', '2021-12-16 16:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `admin_id`, `seller_id`, `buyer_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, '2021-11-11 14:50:19', '2021-11-11 14:50:19'),
(2, NULL, 1, 1, '2021-12-13 23:52:17', '2021-12-13 23:52:17'),
(3, NULL, 1, 2, '2021-12-14 00:04:52', '2021-12-14 00:04:52'),
(4, 1, 2, NULL, '2021-12-14 00:07:23', '2021-12-14 00:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `chat_details`
--

CREATE TABLE `chat_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` int(11) NOT NULL,
  `from_logged` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_details`
--

INSERT INTO `chat_details` (`id`, `chat_id`, `from_logged`, `img`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'buyer', NULL, 'hello', '2021-11-11 15:56:40', '2021-11-11 15:56:40'),
(4, 1, 'buyer', NULL, 'can i ask something?', '2021-11-11 19:30:02', '2021-11-11 19:30:02'),
(5, 1, 'admin', NULL, 'hello there', '2021-11-11 19:32:32', '2021-11-11 19:32:32'),
(6, 1, 'admin', NULL, 'of course you can', '2021-11-11 19:52:53', '2021-11-11 19:52:53'),
(7, 1, 'buyer', NULL, 'alright', '2021-11-11 19:52:59', '2021-11-11 19:52:59'),
(8, 2, 'buyer', NULL, 'halo kak', '2021-12-13 23:54:33', '2021-12-13 23:54:33'),
(9, 2, 'seller', NULL, 'iya kak bagaimana?', '2021-12-13 23:57:25', '2021-12-13 23:57:25'),
(10, 3, 'buyer', NULL, 'test kak', '2021-12-14 00:04:58', '2021-12-14 00:04:58'),
(11, 3, 'seller', NULL, 'iya ?', '2021-12-14 00:05:21', '2021-12-14 00:05:21'),
(12, 3, 'buyer', NULL, 'aman kak?', '2021-12-14 00:05:46', '2021-12-14 00:05:46'),
(13, 4, 'admin', NULL, 'woi', '2021-12-14 00:07:36', '2021-12-14 00:07:36'),
(14, 4, 'seller', NULL, 'apaan', '2021-12-14 00:07:43', '2021-12-14 00:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_payment` int(11) DEFAULT NULL,
  `already_paid` int(11) NOT NULL DEFAULT 0,
  `arrival_date` date DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `code`, `status`, `total_payment`, `already_paid`, `arrival_date`, `payment_method_id`, `buyer_id`, `created_at`, `updated_at`) VALUES
(5, 'TRCT20211109005', 'in progress', 300000, 150000, NULL, 1, 1, '2021-11-09 11:23:55', '2021-11-09 11:23:55'),
(8, 'TRCT20211109008', 'in progress', 320000, 160000, NULL, 1, 2, '2021-11-09 12:27:19', '2021-11-09 12:27:19'),
(10, 'TRCT20211215010', 'done', 420000, 420000, NULL, 2, 1, '2021-12-14 17:24:14', '2021-12-16 15:16:05'),
(11, 'TRCT20211216011', 'done', 200000, 0, NULL, 2, 1, '2021-12-16 08:53:26', '2021-12-16 16:03:45'),
(12, 'TRCT20211216012', 'done', 240000, 240000, NULL, 2, 1, '2021-12-16 15:21:15', '2021-12-16 15:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_details`
--

CREATE TABLE `checkout_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkout_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkout_details`
--

INSERT INTO `checkout_details` (`id`, `checkout_id`, `note`, `seller_product_id`, `qty`, `price`, `total_price`, `status`, `rating`, `created_at`, `updated_at`) VALUES
(6, '5', NULL, 3, 1, 300000, 300000, 'in delivery', 5, '2021-11-09 11:23:55', '2021-12-14 15:59:45'),
(9, '8', NULL, 1, 1, 120000, 120000, 'in delivery', 3, '2021-11-09 12:27:19', '2021-11-09 13:04:04'),
(10, '8', NULL, 2, 1, 200000, 200000, 'in progress', 5, '2021-11-09 12:27:19', '2021-11-09 12:27:19'),
(13, '10', NULL, 4, 1, 120000, 120000, 'arrived', 5, '2021-12-14 17:24:14', '2021-12-14 17:35:40'),
(14, '10', NULL, 3, 1, 300000, 300000, 'arrived', 5, '2021-12-14 17:24:14', '2021-12-14 17:35:46'),
(15, '11', NULL, 2, 1, 200000, 200000, 'arrived', 3, '2021-12-16 08:53:26', '2021-12-16 16:03:51'),
(16, '12', NULL, 1, 2, 120000, 240000, 'arrived', 3, '2021-12-16 15:21:15', '2021-12-16 16:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_20_011638_create_sellers_table', 1),
(5, '2021_04_20_201606_create_buyers_table', 1),
(6, '2021_04_20_202539_create_admins_table', 1),
(7, '2021_04_26_033146_create_seller_products_table', 1),
(8, '2021_05_14_045637_create_serial_numbers_table', 1),
(9, '2021_05_15_020713_create_wishlists_table', 1),
(10, '2021_05_15_020904_create_carts_table', 1),
(11, '2021_08_11_134442_create_paylaters_table', 1),
(12, '2021_08_13_143213_create_payment_methods_table', 1),
(13, '2021_08_14_122818_create_checkouts_table', 1),
(14, '2021_08_14_122831_create_checkout_details_table', 1),
(15, '2021_11_11_140934_create_chats_table', 2),
(16, '2021_11_11_140942_create_chat_details_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paylaters`
--

CREATE TABLE `paylaters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_card_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selfie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paylaters`
--

INSERT INTO `paylaters` (`id`, `buyer_id`, `balance`, `status`, `identity_number`, `identity_card_img`, `selfie`, `created_at`, `updated_at`) VALUES
(1, 1, 1030000, 'confirm', '5555', 'id_1636483660.jpg', 'selfie_1636483660.jpg', '2021-11-09 10:47:40', '2021-11-09 12:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pay Later', '2021-11-09 10:14:12', '2021-11-09 10:14:12'),
(2, 'Isaku Indomaret', '2021-11-09 10:14:20', '2021-11-09 10:14:20'),
(3, 'Transfer Rekening', '2021-11-09 10:18:22', '2021-11-09 10:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `description`, `phone_number`, `email`, `address`, `province`, `avatar`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'seller', 'desc', '087855117273', 'seller.my@gmail.com', 'address', 'bali', '1636482429.png', 'seller', '$2y$10$USo7mqXuhDuUqJDQJ.oEiOAiNDhVAbSD2vfAnYfa3D9/qhkxlvVgW', '2021-11-09 10:19:49', '2021-11-09 11:52:51'),
(2, 'seller2', 'desc', '087855117273', 'seller2@gmail.com', 'addrs', 'aceh', '1636483063.jpg', 'seller2', '$2y$10$EGocvLR7VS3lh5qmwgYay.xwq.w5TZlryp79Zjz.iZCkKYjtNE46S', '2021-11-09 10:20:13', '2021-11-09 11:54:22'),
(3, 'seller3', 'awdawd', '3456', 'seller3@gmail.com', 'awdawd', 'bali', NULL, 'seller3', '$2y$10$GHEVCczhQAz3hZyGo4grtuAWI6UQwhJk6Mhd.9xBGZ4RXG9HYMhvi', '2021-12-16 16:35:34', '2021-12-16 16:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `seller_products`
--

CREATE TABLE `seller_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_products`
--

INSERT INTO `seller_products` (`id`, `name`, `description`, `price`, `total`, `image`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 'product 1 seller', 'desc', 120000, 18, '1636482483.png', 1, '2021-11-09 10:28:04', '2021-12-16 15:21:15'),
(2, 'product 2 seller', 'desc', 200000, 0, '1636482583.png', 1, '2021-11-09 10:29:43', '2021-12-16 08:53:26'),
(3, 'product 1 seller2', 'desc', 300000, 1, '1636482968.png', 2, '2021-11-09 10:36:08', '2021-11-09 10:36:08'),
(4, 'product 1', 'desc', 120000, 10, '1636681601.png', 1, '2021-11-11 17:46:41', '2021-11-11 17:46:41'),
(5, 'pro seller 3', 'awde', 300000, 1, '1639701420.jpg', 3, '2021-12-16 16:37:00', '2021-12-16 16:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `serial_numbers`
--

CREATE TABLE `serial_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serial_numbers`
--

INSERT INTO `serial_numbers` (`id`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, '123', 1, '2021-11-09 10:09:20', '2021-11-09 10:28:04'),
(2, '456', 1, '2021-11-09 10:09:26', '2021-11-09 10:29:43'),
(3, '789', 1, '2021-11-09 10:09:31', '2021-11-09 10:36:08'),
(4, '111', 1, '2021-11-09 10:51:05', '2021-11-11 17:46:41'),
(5, 'xxx', 1, '2021-12-16 16:36:52', '2021-12-16 16:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `buyer_id`, `seller_product_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '2021-11-09 10:42:55', '2021-11-09 10:42:55'),
(3, 1, 4, '2021-12-16 16:25:54', '2021-12-16 16:25:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buyers_email_unique` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_details`
--
ALTER TABLE `chat_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `checkouts_code_unique` (`code`);

--
-- Indexes for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paylaters`
--
ALTER TABLE `paylaters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paylaters_buyer_id_unique` (`buyer_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`email`);

--
-- Indexes for table `seller_products`
--
ALTER TABLE `seller_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_details`
--
ALTER TABLE `chat_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paylaters`
--
ALTER TABLE `paylaters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller_products`
--
ALTER TABLE `seller_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
