-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 09, 2021 at 01:39 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saudi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `phone`, `image`, `remember_token`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'test@test.com', '$2y$10$V/uhCpqiREls8POiihN0HuYY.u8fvQ5zqdoRskwoT56monagGWley', '0987654321', NULL, 'H0kAcOYUoUwnANKNxBF5zQ59ZPt7lybYAUdXaXCN96DktdnbcS84v5gsrX43', 0, '2021-04-07 21:52:29', '2021-04-07 21:52:29'),
(2, 'HoZaifa Ramdan', 'hozaifa@tarseya.com', '$2y$10$wKkwgbgd5jYid/N/U/EQ0u7Y6YVOs40CaFSencsSB6.JrSIaXdJ3G', '01149632353', NULL, NULL, 0, '2021-04-08 03:16:26', '2021-04-08 03:16:26'),
(4, 'Ahmed', 'ahmed@gmail.com', '$2y$10$QRuCMLe.G8aQ8aGhANfq5unUHv0M15vBmLcYiNttA8jWqLmIs//.G', '4839485439', NULL, NULL, 0, '2021-04-08 03:52:58', '2021-04-08 03:52:58'),
(5, 'Said', 'said@gmail.com', '$2y$10$8aVKxwjpXvIKRmi3wemxnedY93SmLDhk.quCM3cL39kOy32gygtmS', '9494444949', NULL, NULL, 0, '2021-04-08 22:53:46', '2021-04-08 22:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meta_banners`
--

CREATE TABLE `meta_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2020_09_19_031319_create_password_resets_table', 1),
(3, '2020_09_19_031320_create_admins_table', 1),
(4, '2020_09_19_041320_create_settings_table', 1),
(5, '2021_02_06_025431_create_meta_banners_table', 1),
(6, '2021_02_14_112818_laratrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `path`, `created_at`, `updated_at`) VALUES
(1, 'read-roles', 'Read Roles', 'عرض الأدوار', 'roles', '2021-04-08 02:12:15', '2021-04-08 02:12:15'),
(2, 'update-roles', 'Update Roles', 'تعديل الأدوار', 'roles', '2021-04-08 02:12:15', '2021-04-08 02:12:15'),
(3, 'create-roles', 'Create Roles', 'إضافة الأدوار', 'roles', '2021-04-08 02:12:15', '2021-04-08 02:12:15'),
(4, 'delete-roles', 'Delete Roles', 'مسح الأدوار', 'roles', '2021-04-08 02:12:15', '2021-04-08 02:12:15'),
(5, 'read-admins', 'Read Admins', 'عرض المشرفين', 'admins', '2021-04-08 02:12:36', '2021-04-08 02:12:36'),
(6, 'update-admins', 'Update Admins', 'تعديل المشرفين', 'admins', '2021-04-08 02:12:36', '2021-04-08 02:12:36'),
(7, 'create-admins', 'Create Admins', 'إضافة المشرفين', 'admins', '2021-04-08 02:12:36', '2021-04-08 02:12:36'),
(8, 'delete-admins', 'Delete Admins', 'مسح المشرفين', 'admins', '2021-04-08 02:12:36', '2021-04-08 02:12:36'),
(9, 'read-settings', 'Read Settings', 'عرض الإعدادات', 'settings', '2021-04-08 02:12:36', '2021-04-08 02:12:36'),
(10, 'update-settings', 'Update Settings', 'تعديل الإعدادات', 'settings', '2021-04-08 02:12:36', '2021-04-08 02:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', NULL, NULL, 'مدير-النظام', '2021-04-08 02:51:03', '2021-04-08 21:59:53'),
(2, 'مدخل بيانات', NULL, NULL, 'مدخل-بيانات', '2021-04-08 02:52:15', '2021-04-08 22:00:01'),
(3, 'تيستر', NULL, NULL, 'تيستر', '2021-04-08 23:12:52', '2021-04-08 23:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\Admin'),
(1, 2, 'App\\Models\\Admin'),
(2, 4, 'App\\Models\\Admin'),
(2, 5, 'App\\Models\\Admin');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `val`, `created_at`, `updated_at`) VALUES
(1, 'default_timezone', 'Africa/Cairo', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(2, 'phone_1', '8484858845855', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(3, 'phone_2', '939058050544', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(4, 'email_1', 'info@saudi-business.com', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(5, 'email_2', 'support@saudi-business.com', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(6, 'logo', 'images/setting/2021040875244566659.png', '2021-04-07 21:50:02', '2021-04-08 17:52:44'),
(7, 'logo_white', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(8, 'favicon', 'images/setting/2021040875346101975.png', '2021-04-07 21:50:02', '2021-04-08 17:53:46'),
(9, 'favicon_white', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(10, 'location', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(11, 'facebook', 'https://www.facebook.com', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(12, 'twitter', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(13, 'instagram', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(14, 'pinterest', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(15, 'snapchat', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(16, 'youtube', NULL, '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(17, 'site_name', 'سعودي بيزنس', '2021-04-07 21:50:02', '2021-04-09 01:32:25'),
(18, 'address', 'Test', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(19, 'sm_description', 'small description about application', '2021-04-07 21:50:02', '2021-04-07 21:50:02'),
(20, 'copyright', 'جميع الحقوق محفوظة سعودي بيزنس، تنفيذ و تطوير بواسطة', '2021-04-07 21:50:02', '2021-04-08 17:34:11'),
(21, 'copyright_link_text', 'سعودي بيزنس', '2021-04-07 21:50:02', '2021-04-08 17:34:11'),
(22, 'copyright_link', 'http://www.google.com', '2021-04-07 21:50:02', '2021-04-08 17:42:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_banners`
--
ALTER TABLE `meta_banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_banners_page_unique` (`page`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_phone_index` (`phone`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meta_banners`
--
ALTER TABLE `meta_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
