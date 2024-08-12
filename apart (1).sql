-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 03:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `book_date` date NOT NULL,
  `book_enddate` date NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `book_pay` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`book_id`, `book_date`, `book_enddate`, `room_number`, `cust_id`, `book_pay`, `created_at`, `updated_at`) VALUES
(18, '2024-08-09', '2024-08-09', 'A1', 2, '50000', '2024-08-08 17:53:15', '2024-08-08 17:53:15'),
(19, '2024-08-09', '2024-08-09', 'D11', 2, '20000', '2024-08-08 18:02:47', '2024-08-08 18:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` bigint(20) UNSIGNED NOT NULL,
  `rent_id` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `date_checkout` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `rent_id`, `room_number`, `cust_name`, `date_checkout`, `created_at`, `updated_at`) VALUES
(18, '30', 'A2', 'lar yang', '2024-08-04', NULL, NULL),
(22, '31', 'A3', 'pia yang', '2024-08-28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` enum('ຊາຍ','ຍິງ','ອື່ນໆ') NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `gender`, `phoneNumber`, `created_at`, `updated_at`) VALUES
(2, 'lar', 'yang', 'ຍິງ', '91711267', '2024-07-29 08:56:53', '2024-07-31 19:40:27'),
(3, 'pia', 'yang', 'ຊາຍ', '91711267', '2024-07-29 16:56:26', '2024-07-29 16:56:26'),
(4, 'seng', 'yang', 'ຊາຍ', '91711267', '2024-07-29 16:56:37', '2024-07-29 16:56:37'),
(5, 'phet', 'yang', 'ຊາຍ', '91711267', '2024-07-29 16:56:51', '2024-07-29 16:56:51'),
(6, 'pia', 'yang', 'ຊາຍ', '343535435', '2024-07-31 17:55:58', '2024-07-31 17:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `expen_date` date NOT NULL,
  `expen_detail` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `expen_date`, `expen_detail`, `total_price`, `created_at`, `updated_at`) VALUES
(3, 3, '2024-07-31', 'ແປງດອກໄຟ 3 ດອກ', 150000.00, '2024-07-31 05:40:46', '2024-07-31 05:40:46'),
(4, 8, '2024-07-31', 'ສີ', 4000000.00, '2024-07-31 10:00:01', '2024-07-31 10:00:01'),
(5, 3, '2024-08-01', 'ແປງແອ', 7000000.00, '2024-07-31 13:53:48', '2024-07-31 13:53:48'),
(6, 3, '2024-08-01', 'ທໍ່ນໍ້າ', 70000.00, '2024-07-31 17:32:13', '2024-07-31 17:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(39, '2019_08_19_000000_create_failed_jobs_table', 1),
(40, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(41, '2024_06_03_120914_create_customers_table', 1),
(42, '2024_06_03_121213_create_bookings_table', 1),
(44, '2024_06_03_121253_create_rents_table', 1),
(45, '2024_06_03_121331_create_rooms_table', 1),
(46, '2024_06_03_121336_create_roomtypes_table', 1),
(47, '2024_06_03_121413_create_payments_table', 1),
(48, '2024_07_01_034555_create_equipment_table', 1),
(49, '2024_07_30_013353_create_checkouts_table', 2),
(58, '2024_06_03_121239_create_expenses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` bigint(20) UNSIGNED NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `rent_id` varchar(255) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `month_year` date NOT NULL,
  `room_price` int(11) NOT NULL,
  `ele_price` int(11) NOT NULL,
  `water_price` int(11) NOT NULL,
  `gar_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `roomtype_id`, `room_number`, `rent_id`, `cust_id`, `month_year`, `room_price`, `ele_price`, `water_price`, `gar_price`, `created_at`, `updated_at`) VALUES
(7, 122, 'A3', '18', 3, '2024-07-31', 400000, 909000, 4000, 90000, '2024-07-31 05:48:12', '2024-07-31 05:48:12'),
(8, 122, 'A1', '1', 2, '2024-07-31', 400000, 2222, 3333, 3333, '2024-07-31 06:04:04', '2024-07-31 06:04:04'),
(9, 122, 'A2', '30', 2, '2024-08-04', 400000, 30000, 15000, 10000, '2024-08-03 18:38:10', '2024-08-03 18:38:10'),
(10, 122, 'A2', '30', 2, '2024-08-04', 400000, 30000, 10000, 10000, '2024-08-03 18:45:31', '2024-08-03 18:45:31'),
(11, 122, 'AF12', '32', 6, '2024-08-04', 400000, 25000, 13000, 10000, '2024-08-03 19:55:42', '2024-08-03 19:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `rent_id` bigint(20) UNSIGNED NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `book_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `room_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`rent_id`, `date_start`, `date_end`, `book_id`, `room_number`, `cust_id`, `room_price`, `created_at`, `updated_at`) VALUES
(30, '2024-07-30', '2024-08-29', 3, 'A2', 2, 500000, '2024-08-03 17:54:43', '2024-08-03 17:54:43'),
(31, '2024-07-30', '2024-08-29', 4, 'A3', 3, 700000, '2024-08-03 17:55:12', '2024-08-03 17:55:12'),
(32, '2024-08-01', '2024-08-31', 11, 'AF12', 6, 4000, '2024-08-03 18:39:26', '2024-08-03 18:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `roomtype_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'A1', 1, 'ຫວ່າງ', '2024-07-29 08:49:34', '2024-08-08 18:03:44'),
(3, 'A2', 1, 'ຫວ່າງ', '2024-07-29 16:27:56', '2024-08-08 18:04:18'),
(4, 'A3', 1, 'ຫວ່າງ', '2024-07-29 16:28:10', '2024-08-08 18:04:25'),
(5, 'D11', 1, 'ຈອງແລ້ວ', '2024-07-29 20:35:06', '2024-08-08 18:02:48'),
(6, 'VV12', 1, 'ຫວ່າງ', '2024-07-29 20:38:24', '2024-08-08 18:04:06'),
(7, 'AC123', 122, 'ຫວ່າງ', '2024-07-29 21:09:26', '2024-08-08 18:04:00'),
(8, 'A33', 122, 'ຫວ່າງ', '2024-07-30 07:21:19', '2024-08-03 00:10:12'),
(9, 'AF12', 1, 'ຫວ່າງ', '2024-07-30 23:44:43', '2024-08-08 17:52:50'),
(10, 'AC1234', 122, 'ຫວ່າງ', '2024-08-03 19:45:20', '2024-08-03 19:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roomtype_id` int(11) NOT NULL,
  `roomtype_name` varchar(255) NOT NULL,
  `room_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`id`, `roomtype_id`, `roomtype_name`, `room_price`, `created_at`, `updated_at`) VALUES
(2, 1, 'ຫ້ອງແອA', 2000, '2024-07-29 08:49:21', '2024-07-31 19:41:12'),
(4, 122, 'ຫ້ອງພັດລົມ', 400000, '2024-07-29 16:29:14', '2024-07-29 16:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(30) NOT NULL,
  `profile_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `firstName`, `lastName`, `gender`, `email`, `password`, `phoneNumber`, `profile_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'S1234', 'lar', 'yang', 'ຊາຍ', 'laryang.2000@gmail.com', '$2y$12$qQ8ushGt7S4rmXjXeZ2ePeS4xnVrP3O.lceXwOXPANI.rqoowEmpO', '91711267', 'profiles/Z5KRA9Nd6glfxCIbwuMqHdj1bwJJ0N1OSFIt9Lhf.jpg', NULL, '2024-07-29 09:20:58', '2024-07-29 09:20:58'),
(5, 'S123456', 'lar', 'yang', 'ຊາຍ', 'payang123@hotmail.com', '$2y$12$CnOpSKp1oQbOeZaeqN7bp.GtBJtbme7DDy3cBQ5HdsTt5F4Nh1os6', '91711267', 'profiles/fEMpP0SWYPI8joF3fTR0a66fdOhMHG2cmYnEoIDC.jpg', NULL, '2024-07-29 22:00:04', '2024-07-29 22:00:04'),
(6, 'A1234', 'Tou', 'yang', 'ຊາຍ', 'pboang123@hotmail.com', '$2y$12$dXTPoKwO6zCyo7Ktx16iKu3yiR8o5th0Tu4bcspltvifeazS6bn7e', '91711267', 'profiles/yoZSdTxqYTTvnbrDe08iph4PgDbQrY97yzdX0hor.jpg', NULL, '2024-07-29 23:19:49', '2024-07-29 23:19:49'),
(7, 'AD1256', 'lar', 'yang', 'ຍິງ', 'hueso@gmail.com', '$2y$12$ozPJpQqchBoGraL3XgktXun0MowAO19E4Qp0.4DDoQt9WKaByWB3u', '91711267', 'profiles/DBT85zth2AnJFH23jBY4apUllwV1yT0z6Rvn6IEI.jpg', NULL, '2024-07-30 04:35:19', '2024-07-30 04:35:19'),
(8, 'TY123', 'lar', 'yang', 'ຊາຍ', 'laryangbm.2000@gmail.com', '$2y$12$j2j4RORhJJGuhMaL75nyt.7Wgplum9EYozANxDAsnwOwi8isyEYrS', '91711267', 'profiles/YTU1bzbeDYuvy9KsQrn64MlAmPRsIW3TfBaMUJRL.jpg', NULL, '2024-07-30 12:13:52', '2024-07-30 12:13:52'),
(12, 'vy123', 'lar', 'yang', 'ຊາຍ', 'pay767ang13@hotmail.com', '7575674646', '91711267', 'profiles/n5ezOjbEg0lIjw1is5ufMFBh4UrzTyl6rFXV7On1.jpg', NULL, '2024-07-31 03:28:17', '2024-07-31 03:28:17'),
(13, 'S1234556', 'lar', 'yang', 'ຊາຍ', 'paya7713@hotmail.com', '123456789', '91711267', 'profiles/GnF9L0CFxaRIIwzPFFcBUEuLM5ie2fKONekYhsD0.png', NULL, '2024-07-31 17:42:40', '2024-07-31 17:42:40'),
(14, 'at123', 'A', 'B', 'ຊາຍ', 'a@b.gmail.com', '12345678', '2099999999', 'profiles/TvWrdyL0eD03xJD6TDtTxbdPsvTIdxSRKRiuCkNj.jpg', NULL, '2024-07-31 19:36:30', '2024-07-31 19:36:30'),
(15, 'H123', 'noy', 'yang', 'ຊາຍ', 'noy@gmail.com', '12345678', '91711267', 'profiles/oiEpMyTC70etNTSRyiOhqsiO36RLdH4DIealRao1.jpg', NULL, '2024-07-31 23:52:07', '2024-07-31 23:52:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roomtypes_roomtype_id_unique` (`roomtype_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `rent_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
