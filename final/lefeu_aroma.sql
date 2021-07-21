-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 02:23 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lefeu_aroma`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ordered',
  `grand_total` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `user_id`, `product_id`, `quantity`, `status`, `grand_total`) VALUES
(87, '47876170cf49de476dd2', 46, 114, 1, 'ordered', 303.75),
(88, '47876170cf49de476dd2', 46, 118, 1, 'ordered', 303.75),
(89, '4fdbe4b5a44d7901bbac', 33, 114, 1, 'ontheway', 303.75),
(90, '4fdbe4b5a44d7901bbac', 33, 118, 1, 'ontheway', 303.75);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `productname`, `size`, `price`, `description`) VALUES
(114, 'coffee (1).jpg', 'Coffee', '4oz', '175', 'lorem ipsum'),
(118, 'coffee1.jpg', 'Coffee', '2oz', '100', 'lorem ipsum'),
(120, 'spearming.jpg', 'Spearmint', '2oz', '100', 'lorem ipsum'),
(123, 'citrus vanilla.jpg', 'Citrus Vanilla', '4oz', '175', 'lorem ipsum'),
(126, 'lavender 2oz.jpg', 'Lavender', '2oz', '100', 'lorem ipsum'),
(127, 'lavender 4oz.jpg', 'Lavender', '4oz', '170', 'lorem ipsum'),
(128, 'spearmint4oz.jpg', 'Spearmint', '4oz', '175', 'lorem ipsum'),
(129, 'vanilla.jpg', 'Vanilla', '4oz', '170', 'lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `house_number`, `street`, `brgy`, `city`, `province`) VALUES
(27, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(28, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(29, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(30, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(31, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(32, '12', 'St', 'Natatas', 'Tanauan City', 'Batangas'),
(33, 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna'),
(34, 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna'),
(35, 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna'),
(36, 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pnumber` varchar(11) NOT NULL,
  `house_number` varchar(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `pnumber`, `house_number`, `street`, `brgy`, `city`, `province`, `user_type`, `password`) VALUES
(18, 'admin', 'admin', 'admin@gmail.com', '0', '123', 'St', 'Natatas', 'Tanauan City', 'Batangas', 'admin', '202cb962ac59075b964b07152d234b70'),
(33, 'user', 'user', 'user@gmail.com', '09386181581', '12', 'St', 'Natatas', 'Tanauan City', 'Batangas', 'user', '202cb962ac59075b964b07152d234b70'),
(44, 'Josh', 'Bathan', 'user@hmail.com', '2147483647', '123', 'St', '123', 'Tanauan City', 'Batangas', 'user', '202cb962ac59075b964b07152d234b70'),
(45, 'Josh', 'Bathan', 'jbathan@gmail.com', '09123456789', '123', 'St', 'Natatas', 'Tanauan City', 'Batangas', 'user', 'f94adcc3ddda04a8f34928d862f404b4'),
(46, 'Gerly', 'Gajo', 'gajogerly@gmail.com', '09183816957', 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna', 'user', '202cb962ac59075b964b07152d234b70'),
(47, 'user', 'g', 'user1@gmail.com', '12345678910', 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna', 'user', '202cb962ac59075b964b07152d234b70'),
(48, 'user', 'g', 'user2@gmail.com', '12345678910', 'Blk 8', 'Aztec', 'Looc', 'Calamba', 'Laguna', 'user', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
