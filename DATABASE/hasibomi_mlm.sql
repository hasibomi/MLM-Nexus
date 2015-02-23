-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2015 at 11:54 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hasibomi_mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE IF NOT EXISTS `amounts` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`id`, `user_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 500, 1, '2015-02-02 03:58:11', '2015-02-02 03:58:11'),
(2, 1, 600, 1, '2015-02-02 03:58:11', '2015-02-05 15:47:48'),
(3, 2, 500, 1, '2015-02-04 13:42:03', '2015-02-04 13:42:03'),
(4, 1, 600, 1, '2015-02-04 13:42:03', '2015-02-05 15:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
`id` int(10) unsigned NOT NULL,
  `invoice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `catagory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE IF NOT EXISTS `catagories` (
`id` int(10) unsigned NOT NULL,
  `catagory_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `catagory_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `catagory_name`, `catagory_type`, `created_at`, `updated_at`) VALUES
(3, 'Jeans', 'Main catagory', '2015-01-26 15:29:38', '2015-01-26 15:29:38'),
(4, 'T Shirt', 'Main catagory', '2015-01-27 07:50:11', '2015-01-27 07:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `commisions`
--

CREATE TABLE IF NOT EXISTS `commisions` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `referal_id` int(11) NOT NULL,
  `user_ammount` int(11) NOT NULL,
  `referal_ammount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_infos`
--

CREATE TABLE IF NOT EXISTS `contact_infos` (
`id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `description`, `facebook`, `twitter`, `google`, `status`, `created_at`, `updated_at`) VALUES
(1, '<p>Nexus IT Zone<br>House: 1(3rd floor), Road: 4, Block: A, Section: 10, Mirpur, Dhaka-1216<br></p>', 'http://www.facebook.com/NexusITzone', '', '', 1, '2015-01-26 16:09:57', '2015-01-26 16:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `call_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `description`, `call_name`, `active`, `created_at`, `updated_at`) VALUES
(1, '<h2>Hello world</h2>', '<h3>Welcome to MLM site.</h3><div>This is an Ecommerce site.</div><h4>Features:</h4><div><ul><li>Customizable contents</li><li>Customizable sliders</li><li>Add products, catagory</li><li>User management</li><li>Notice management</li><li>Support system</li><li>Order processing system</li></ul></div>', 'home', 1, '2015-01-26 14:39:57', '2015-01-27 04:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_06_204923_create_users', 1),
('2014_10_14_173009_products', 1),
('2014_10_19_181815_catagories', 1),
('2014_11_09_125035_create_content', 1),
('2014_11_12_201955_create_slider', 1),
('2014_11_22_221229_create_contact_info', 1),
('2014_12_07_214542_create_cart', 1),
('2014_12_27_224859_create_points', 1),
('2014_12_29_220757_create_commision', 1),
('2015_01_06_233334_create_notices', 1),
('2015_01_07_191523_create_notice_user_associates', 1),
('2015_01_28_115934_create_amounts', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
`id` int(10) unsigned NOT NULL,
  `notice_id` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` text COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `notice_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, '54c6bcf5d4189', '<a href="http://localhost:8000/dashboard/user/1">1</a>, <a href="http://localhost:8000/dashboard/user/2">2</a>, <a href="http://localhost:8000/dashboard/user/3">3</a>', '<p>Please come</p>', '2015-01-26 16:17:34', '2015-01-26 16:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `notice_user_associates`
--

CREATE TABLE IF NOT EXISTS `notice_user_associates` (
`id` int(10) unsigned NOT NULL,
  `notice_id` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notice_user_associates`
--

INSERT INTO `notice_user_associates` (`id`, `notice_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '54c6bcf5d4189', 1, '2015-01-28 16:32:29', '2015-01-28 16:32:29'),
(8, '54c6bcf5d4189', 2, '2015-01-28 16:32:29', '2015-01-28 16:32:29'),
(9, '54c6bcf5d4189', 3, '2015-01-28 16:32:31', '2015-01-28 16:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(10) unsigned NOT NULL,
  `catagory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_condition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `product_code` text COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catagory_id`, `name`, `quantity`, `price`, `product_condition`, `brand`, `description`, `image`, `point`, `product_code`, `code`, `created_at`, `updated_at`) VALUES
(1, 3, 'Blue Jeans', 300, 500, 'New', 'Easy', 'Jeans pant for sell', 'blue_jeans.jpg', 500, '1216', '2XwQPumYK54c6b1e5d8317', '2015-01-26 15:30:13', '2015-02-04 13:42:02'),
(2, 3, 'White Jeans', 100, 550, 'New', 'Easy', 'White Jeans for female.', 'white_jeans.jpg', 350, '1215', 'Ca5rIjHdI54c7a21a45cb7', '2015-01-27 07:52:35', '2015-02-02 03:57:10'),
(3, 4, 'Green T Shirt', 0, 200, 'New', 'Yellow', 'Green T Shirt for men. 100% cotton.', 'T shirt 1.jpg', 100, '1217', 'p02YlyNT854c799ab5fd3c', '2015-01-27 07:59:07', '2015-01-30 11:25:01'),
(4, 4, 'Light Green T Shirt', 200, 200, 'New', 'Nexus', 'New stylish light green t shirt for men.', 'T Shirt 2.jpg', 220, '1218', 'Yy47mTiim54c7982329aeb', '2015-01-27 08:35:06', '2015-02-02 03:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
`id` int(10) unsigned NOT NULL,
  `slider_id` int(11) NOT NULL,
  `slider_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_id`, `slider_text`, `slider`, `active`, `created_at`, `updated_at`) VALUES
(1, 0, '', '', 1, '2015-01-26 14:36:26', '2015-01-26 14:36:26'),
(2, 1, '<h1>White jeans for female<br></h1>\r\n', 'assets/images/slider/52-14-2015white_jeans.jpg', 1, '2015-01-26 14:56:55', '2015-01-27 08:52:54'),
(3, 2, '<h1>Green T Shirt for men<br></h1>\r\n', 'assets/images/slider/53-14-2015Tshirt1.jpg', 1, '2015-01-27 08:07:56', '2015-01-27 08:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` int(11) NOT NULL,
  `month_of_birth` int(11) NOT NULL,
  `year_of_birth` int(11) NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `referal_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `arrange_group` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `date_of_birth`, `month_of_birth`, `year_of_birth`, `profile_picture`, `permanent_address`, `present_address`, `designation`, `type`, `referal_id`, `token`, `active`, `arrange_group`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@nexusitzone.com', '$2y$10$hHx1a2n2eUOEDOgjav/Cqu.5YuVUmhXlH44VYoSVU6yUy1OwT6Xau', 'Male', 0, 0, 0, '', '', '', '', 'admin', 0, '0', 1, '', 'mPqVAFheo5OIJViIdfNTV2QO0m12nBYnS7Nkm1SgJvwoAy3RJtbqtdDpiklL', '2015-01-26 14:36:26', '2015-02-05 16:25:55'),
(2, 'Hasibur Rahman Omi', 'hasibomi@hasibomi.com', '$2y$10$dCZVRFxWIfKRxAJSt.n04O6GOMR.OuYScl1S1u.G42PM5bfEebllC', 'Male', 1, 4, 1980, 'assets/images/propic/phone-samsung-s3.png', 'Bangladesh', 'Bangladesh', 'Model member', 'member', 1, '20', 1, 'right_side', '0niu0IxeFWxGHYz3uMasysQtdIvTNb4rjBqMKCDm94LRSDrRmkATQ9xZt9pT', '2015-01-26 16:27:15', '2015-02-05 15:47:44'),
(3, 'Hasib Omi', 'hasibomi@nexusitzone.com', '$2y$10$FZ0LVgXU8cU6ARrPqcA/3uL1t2eUYwnYrtlsToQBJL/KNQcZj0KLu', 'Male', 11, 9, 1977, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 2, '0', 1, 'left_side', 'acThWv9ze1XCqlOmTcgGypzeiMqv5SiP5accowFPiKPKJLQVSpabjEUsGp9B', '2015-01-28 11:46:11', '2015-01-30 12:21:39'),
(4, 'Sakibur Rahman Omi', 'ovitherock@gmail.com', '$2y$10$mMFADix/nIzO8xBLrocVBeX/I0caH3ZnZOiZGcjuVhjua7bL2msrG', 'Male', 1, 3, 1997, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 3, '870', 1, 'left_side', 'ZFV8xVzlxpQ2mRZf7C3SJJ7DvBtmX2jnY9YltRlAyQrO90d1S37d9i7zSODR', '2015-01-30 12:11:35', '2015-01-30 12:20:56'),
(5, 'Mansur Abdullah', 'mansur@gmail.com', '$2y$10$3jpGpLo5dk/DjfgWVHVpSujGgJ/73A.bB8jpoVFK.JYsG4N8nNH7O', 'Male', 0, 0, 0, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 2, '2', 1, 'right_side', '', '2015-01-30 12:12:33', '2015-01-30 12:12:33'),
(6, 'Mahbub Alam', 'itsmemahbubalam@gmail.com', '$2y$10$AtR3cDRVc5vMLFjad3d5ru8DfaB3tFsfhkr2Fz72e1057Nvh7vGaa', 'Male', 7, 1, 1994, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 3, '2147483647', 1, 'right_side', '', '2015-01-30 12:14:25', '2015-01-30 12:14:25'),
(7, 'Donald Duck', 'duck@forest.com', '$2y$10$oolqo7Gw5X5zJK2CP9yVDOoYFGcttfa7yuYmIhcZnuxf.4ajY4yCy', 'Male', 15, 4, 1916, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 4, '1', 1, 'left_side', '', '2015-02-04 06:38:45', '2015-02-04 06:38:45'),
(8, 'John Doe', 'doe@john.com', '$2y$10$KFD/aSWZB2z0r2FqlOcA5.d.WrsETzA8MptywcwBfFYYM.Kh4sgGu', 'Male', 17, 9, 2000, '', 'Bangladesh', 'Bangladesh', 'Not an active member', 'member', 6, 'fece6f4bdad47fce3c9b435fd354eab7', 1, 'left_side', '', '2015-02-04 07:11:06', '2015-02-04 07:11:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `catagories_catagory_name_unique` (`catagory_name`);

--
-- Indexes for table `commisions`
--
ALTER TABLE `commisions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_user_associates`
--
ALTER TABLE `notice_user_associates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amounts`
--
ALTER TABLE `amounts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `commisions`
--
ALTER TABLE `commisions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notice_user_associates`
--
ALTER TABLE `notice_user_associates`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
