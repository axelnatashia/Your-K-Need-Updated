-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 07:25 AM
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
(1, 'admin', 'admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$v0iqiBnzPPAph9j5r9PTfe/7IjHOaZCaLV1tksnQwonkbHKTBNoqa', '2021-05-14 06:30:41', '2021-05-14 06:30:41'),
(2, 'admin2', 'admin2', 'admin2@gmail.com', NULL, 'admin2', '$2y$10$.4x5dCIN0KNkaPkKDa80seJ4sRaFdiiL2shUXW8zEmj2yyzeTniRO', '2021-05-14 06:30:58', '2021-05-14 06:30:58'),
(3, 'admin3', 'admin3', 'admin3@gmail.com', NULL, 'admin3', '$2y$10$iFoWi74eq7r3gl.dpF58Bu6X4hsuDXb5hiJTIivR8.2pskcbmWLjG', '2021-05-14 06:31:19', '2021-05-14 06:31:19');

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
(7, 'Merta Yoga', '087855117273', 'mertayoga17.my@gmail.com', NULL, NULL, NULL, 'w', '$2y$10$zVErnjPqSZzaFLlCOVjIGe329yGcPRlzyfYUrCTme1if6FhZc.uLa', '2021-04-20 16:42:55', '2021-04-20 16:42:55'),
(8, 'febi', '087478596', 'febi@gmail.com', 'denpasar', 'jawa timur', '1619072896.jpg', 'febi', '$2y$10$eJJgewXRjZBf4uccqR1oHuW1TExBcyho4clGZEjzbrVAnFD.LSQGe', '2021-04-21 22:25:51', '2021-04-21 22:28:16'),
(9, 'buyer', '123456789', 'buyer@gmail.com', 'buyer address', 'bali', '1621048180.png', 'buyer', '$2y$10$.By0Vr3VK44TzywIrn86Peq8H9bs/8qKJuUNP.CmmDqrPs0p7pc.m', '2021-05-14 19:08:39', '2021-05-14 19:09:40'),
(10, 'buyer2', '123456789', 'buyer2@gmail.com', 'address', 'sumatera utara', '1628062174.png', 'buyer2', '$2y$10$9zNoq7I6o1896pO14iRvReoX5TEbkddc7AVq5pOrm.Y6Ip87AiM/.', '2021-05-14 19:08:52', '2021-08-03 23:29:34'),
(11, 'buyer3', '123456789', 'buyer3@gmail.com', 'wade', 'jawa timur', NULL, 'buyer3', '$2y$10$..IwpQqXD1LWy0SwG4Tc0eau0AUUGI6ss0Q9W9e7SuoeKFswzi52O', '2021-05-14 19:09:11', '2021-08-08 06:20:01');

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

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_payment` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `code`, `status`, `total_payment`, `note`, `arrival_date`, `payment_method_id`, `buyer_id`, `created_at`, `updated_at`) VALUES
(2, 'TRCT20210815002', 'in progress', 55000, NULL, NULL, 3, 8, '2021-08-14 17:43:03', '2021-08-14 17:43:03'),
(3, 'TRCT20210815003', 'in progress', 451000, NULL, NULL, 1, 8, '2021-08-14 20:35:11', '2021-08-14 20:35:11');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkout_details`
--

INSERT INTO `checkout_details` (`id`, `checkout_id`, `note`, `seller_product_id`, `qty`, `price`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(2, '2', NULL, 3, 1, 50000, 50000, 'in progress', '2021-08-14 17:43:03', '2021-08-14 17:43:03'),
(3, '2', NULL, 4, 1, 5000, 5000, 'in progress', '2021-08-14 17:43:03', '2021-08-14 17:43:03'),
(4, '3', NULL, 5, 1, 451000, 451000, 'in progress', '2021-08-14 20:35:11', '2021-08-14 20:35:11');

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
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2021_04_20_011638_create_sellers_table', 1),
(23, '2021_04_20_201606_create_buyers_table', 1),
(24, '2021_04_20_202539_create_admins_table', 1),
(26, '2021_04_26_033146_create_seller_products_table', 2),
(27, '2021_05_14_045637_create_serial_numbers_table', 3),
(32, '2021_05_15_020713_create_wishlists_table', 4),
(33, '2021_05_15_020904_create_carts_table', 4),
(34, '2021_08_11_134442_create_paylaters_table', 5),
(35, '2021_08_13_143213_create_payment_methods_table', 5),
(42, '2021_08_14_122818_create_checkouts_table', 6),
(43, '2021_08_14_122831_create_checkout_details_table', 6);

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
(1, 8, 2000000, 'confirm', '6666', 'id_1628999956.jpg', 'selfie_1628999956.jpg', '2021-08-14 19:59:17', '2021-08-14 20:34:33');

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
(1, 'Pay Later', '2021-08-13 07:53:07', '2021-08-14 04:12:56'),
(3, 'OVO', '2021-08-14 04:02:24', '2021-08-14 04:02:24'),
(4, 'Indomaret', '2021-08-14 04:02:30', '2021-08-14 04:02:30'),
(5, 'Alfamart', '2021-08-14 04:02:35', '2021-08-14 04:02:35'),
(6, 'Dana', '2021-08-14 04:02:40', '2021-08-14 04:02:40'),
(7, 'Bank Transfer', '2021-08-14 04:02:52', '2021-08-14 04:02:52');

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
(6, 'Merta Yoga', 'descsss', '0878551172732', 'mertayoga17.my@gmail.com', 'Ahmad Yani Street, Anugrah VII Number 17', 'sumatera utara', '1618985286.png', 'merta', '$2y$10$oZbeqqNCr0Q2VU6MCBdpA.sTrrTbJdXlmdEOAPL3o/AfqxLVq.otO', '2021-04-20 20:57:55', '2021-05-14 05:33:06'),
(7, 'axel', 'desc', '0878547858', 'axel@gmail.com', 'denpasar', 'sumatera utara', '1619072709.png', 'axel', '$2y$10$.q7166SfWAxpK0d/qa.9du11bFV8ofkIfZHVq8Mm0eEQBGbItjj0.', '2021-04-21 22:23:58', '2021-04-21 22:25:10'),
(8, 'seller', 'seller desc', '834564', 'seller@gmail.com', 'seller address', 'aceh', '1620998693.png', 'seller', '$2y$10$KxT1EruKE7ektYSHV2jEh.1NkeBmcr.Es4LRLyDQSviS3fP6NCOUq', '2021-05-14 05:24:53', '2021-05-14 23:28:47'),
(9, 'seller22', 'seller22 desc', '8345642', 'seller22@gmail.com', 'seller22 address', 'maluku utara', '1620998720.png', 'seller2', '$2y$10$7y8Lh4rdAfR25uFNBIQ92eHppZzo8BVwX/wzDB9nviK0d6hIokUyG', '2021-05-14 05:25:20', '2021-05-14 05:28:17');

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
(1, 'item 1', 'desc 1', 5000, 3, '1621057978.jpg', 6, '2021-05-04 19:55:06', '2021-05-14 21:52:59'),
(2, 'item 2', 'desc', 50000, 1, '1621057987.png', 6, '2021-05-14 19:41:01', '2021-05-14 21:53:07'),
(3, 'item 3', 'desc', 50000, 1, '1621057994.jpg', 6, '2021-05-14 19:41:53', '2021-05-14 21:53:15'),
(4, 'seller item 1', 'desc', 5000, 1, '1621061309.jpg', 8, '2021-05-14 22:48:29', '2021-05-14 22:48:29'),
(5, 'seller item 22', 'desc', 451000, 2, '1621063662.jpg', 8, '2021-05-14 23:27:42', '2021-05-14 23:28:35');

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
(1, '123', 0, '2021-05-14 19:33:39', '2021-05-14 23:33:32'),
(2, '1234', 1, '2021-05-14 19:33:43', '2021-05-14 19:41:53'),
(3, '124', 1, '2021-05-14 19:33:47', '2021-05-14 22:48:30'),
(4, '125', 0, '2021-05-14 19:33:49', '2021-05-14 23:27:42'),
(5, '126', 0, '2021-05-14 19:33:52', '2021-05-14 19:33:52'),
(6, '127', 0, '2021-05-14 23:33:19', '2021-05-14 23:33:19');

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
(1, 9, 3, '2021-05-14 21:55:47', '2021-05-14 21:55:47'),
(2, 10, 5, '2021-08-04 00:01:17', '2021-08-04 00:01:17'),
(3, 10, 4, '2021-08-04 00:01:24', '2021-08-04 00:01:24'),
(4, 8, 3, '2021-08-08 05:16:34', '2021-08-08 05:16:34'),
(5, 8, 5, '2021-08-08 05:16:58', '2021-08-08 05:16:58');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `paylaters`
--
ALTER TABLE `paylaters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seller_products`
--
ALTER TABLE `seller_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
