-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2024 at 09:02 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u804333930_rosshen`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(12) NOT NULL,
  `name` varchar(254) NOT NULL,
  `price` double(12,2) NOT NULL,
  `image_path` varchar(254) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image_path`, `created_at`) VALUES
(26, 'Ice Cream', 12.00, 'https://oriental212.kahhoechoo.com/uploads/gettyimages-157472912-612x612.jpg', '2024-10-23'),
(27, 'Oriental Volcano Sandwich', 14.73, 'https://oriental212.kahhoechoo.com/uploads/MENU-ORIENTAL-KOPI-SANDWICH-PRICES.jpg', '2024-10-23'),
(28, 'Nanyang Curry Chicken Rice', 17.91, 'https://oriental212.kahhoechoo.com/uploads/ORIENTAL-KOPI-MENU-CURRY-PRICES.jpg', '2024-10-23'),
(29, 'Oriental Penang Prawn Mee', 20.03, 'https://oriental212.kahhoechoo.com/uploads/ORIENTAL-KOPI-NOODLES-MENU-PRICES.jpg', '2024-10-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
