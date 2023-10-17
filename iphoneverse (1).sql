-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 08:17 AM
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
-- Database: `iphoneverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `mobile`, `pass`, `token`, `status`, `image`) VALUES
(8, 'admin', 'xgaming72272@gmail.com', '03061872272', '$2y$10$keAJg6wbf8FnOh5Y5lLCfuZqWC15uVBiRuIm.wt4Iad6z.g00zC2O', '00a29d7b3896f388981dd4a44a54c1', 'active', 'abdulsamad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'iphone 11-Series', 'iphone11.png'),
(2, 'iphone 12-Series', 'iphone12.png'),
(3, 'iphone 13-Series', 'iphone13.png'),
(4, 'iphone 14-Series', '14.png'),
(5, 'iphone 15-Series', '15.png'),
(6, 'jackpots', 'jack.png');

-- --------------------------------------------------------

--
-- Table structure for table `iphone_category`
--

CREATE TABLE `iphone_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iphone_category`
--

INSERT INTO `iphone_category` (`sub_category_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 4),
(11, 4),
(12, 4),
(13, 9),
(14, 9),
(15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `first-name` varchar(50) NOT NULL,
  `last-name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip-code` int(11) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `storage` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `u_id`, `first-name`, `last-name`, `email`, `address`, `city`, `zip-code`, `mobile`, `p_id`, `image`, `name`, `color`, `storage`, `type`, `price`, `qty`, `total`, `status`) VALUES
(1, 6, 'abdulsamad', 'zahid', 'xgaming72272@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 1, 'iphone11.png', 'iphone 11', 'red,black,whitw', 128, 'jv', 90000, 1, 90000, 'Pending'),
(2, 8, 'abdulsamad', 'zahid', 'abdulsamad72272@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 1, 'iphone11.png', 'iphone 11', 'red,black,whitw', 128, 'jv', 90000, 1, 90000, 'Pending'),
(3, 8, 'abdulsamad', 'zahid', 'abdulsamad72272@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 6, '14series.png', 'iphone 15', 'red', 128, 'jv', 300000, 1, 300000, 'Pending'),
(4, 8, 'abdulsamad', 'zahid', 'abdulsamad72272@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 2, 'iphone12.png', 'iphone 11 pro', 'red,black,whitw', 128, 'jv', 100000, 1, 100000, 'Pending'),
(5, 6, 'abdul', 'zahid', 'xgaming72272@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 2, 'iphone12.png', 'iphone 11 pro', 'red,black,whitw', 128, 'jv', 100000, 1, 100000, 'delivered'),
(6, 6, 'dedqd', 'dsdwdw', 'Usman@gmail.com', 'liyari agrataj', 'karachi', 5444, '03061872272', 3, 'iphone13.png', 'iphone 12', 'red,black,whitw', 128, 'jv', 140000, 1, 140000, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'JV',
  `price` int(11) NOT NULL,
  `s_disc` text NOT NULL,
  `l_disc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `active_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `color`, `storage`, `type`, `price`, `s_disc`, `l_disc`, `category_id`, `image`, `active_at`) VALUES
(1, 'iphone 11', 'red,black,whitw', '128', 'jv', 90000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 0, 'iphone11.png', '2023-10-13 13:47:43'),
(2, 'iphone 11 pro', 'red,black,whitw', '128', 'jv', 100000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 'iphone12.png', '2023-05-13 13:47:43'),
(3, 'iphone 12', 'red,black,whitw', '128', 'jv', 140000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 'iphone13.png', '2023-10-01 13:47:43'),
(4, 'iphone 14-Series', 'red,black,whitw', '128', 'jv', 160000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 'iphone14.png', '2023-10-08 13:47:43'),
(6, 'iphone 15', 'red', '128', 'jv', 300000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, '14series.png', '2023-10-12 13:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `u_id`, `p_id`, `name`, `review`, `date`) VALUES
(1, 5, 1, 'abdul', 'nice product', '2023-10-09 04:27:22'),
(2, 6, 1, 'abdulsamad', 'nice product', '2023-10-09 04:41:09'),
(3, 6, 1, 'abdulsamad', 'good', '2023-10-09 04:41:18'),
(4, 6, 1, 'abdulsamad', 'good', '2023-10-09 04:41:29'),
(5, 6, 1, 'abdulsamad', 'wow', '2023-10-09 04:41:37'),
(6, 6, 1, 'abdulsamad', 'wow', '2023-10-09 04:43:00'),
(7, 6, 2, 'abdulsamad', 'amazing', '2023-10-09 04:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`) VALUES
(1, 'iphone 11'),
(2, 'iphone 11 pro'),
(3, 'iphone 11 pro max'),
(4, 'iphone 12'),
(5, 'iphone 12 pro'),
(6, 'iphone 12 pro max'),
(7, 'iphone 13'),
(8, 'iphone 13 pro'),
(9, 'iphone 13 pro max'),
(10, 'iphone 14'),
(11, 'iphone 14 pro'),
(12, 'iphone 14 pro max'),
(13, 'iphone 15'),
(14, 'iphone 15 pro'),
(15, 'iphone 15 pro max');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `city`, `pass`, `token`, `status`, `image`) VALUES
(2, 'abdulsamad', 'xgaming72272@gmail.com', '03061872272', 'karachi', '$2y$10$wvfnAVjZPQ72ipbsZ7EM/OA5h6JwJSXTdgevORha2S7zi0eX8Al0a', 'aee2e54557ed6b6891b10900193056', 'active', 'abdulsamad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `storage` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `u_id`, `p_id`, `image`, `name`, `color`, `storage`, `type`, `price`, `qty`, `total`) VALUES
(8, 6, 1, 'iphone11.png', 'iphone 11', 'red,black,whitw', '128', 'jv', 90000, 1, 90000),
(9, 8, 2, 'iphone12.png', 'iphone 11 pro', 'red,black,whitw', '128', 'jv', 100000, 1, 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`email`),
  ADD UNIQUE KEY `image` (`image`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `iphone_category`
--
ALTER TABLE `iphone_category`
  ADD PRIMARY KEY (`sub_category_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
