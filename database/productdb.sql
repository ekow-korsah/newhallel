-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2020 at 05:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productdb`
--

create database productdb;
use productdb;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mypassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `mypassword`) VALUES
(17, 'akuasmart1@gmail.com', 'dfdb06de9aa5d23374ab0456e210b5ca');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `user_id_or_ip` varchar(20) DEFAULT NULL,
  `timestamp` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `price` varchar(15) DEFAULT NULL,
  `firstname` varchar(22) DEFAULT NULL,
  `lastname` varchar(22) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `house_address` varchar(30) DEFAULT NULL,
  `delivery_date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `producttb`
--

CREATE TABLE `producttb` (
  `id` int(11) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_price` float DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Dumping data for table `producttb`
--

INSERT INTO `producttb` (`id`, `product_name`, `product_price`, `product_image`) VALUES
(1, 'Palm Oil', 17, '../images-resized/palmoil.jpg'),
(2, 'Garlic Pack', 5, '../images-resized/bulb_garlic.jpg'),
(3, 'Ginger and Garlic', 1, '../images-resized/ginger_garlic.jpg'),
(4, 'Gino Paste', 3, '../images-resized/Ginosingle.jpg'),
(5, 'Carnation Milk', 1.2, '../images-resized/carnation_milk.jpg'),
(6, 'Onion', 3, '../images-resized/onions.jpeg'),
(7, 'Jasmine Rice', 135, '../images-resized/grainrice.jpg'),
(8, 'Magi Cubes Pack', 3.2, '../images-resized/maggi.jpg'),
(9, 'Tuber of Yam', 7, '../images-resized/yam.png'),
(10, 'Virgin oil', 17, '../images-resized/virgin_oil.jpg'),
(13, 'Brown Rice', 75, '../images-resized/brown-rice.png'),
(14, 'Brown Sugar', 17, '../images-resized/brown-sugar.jpg'),
(15, 'Sweet Potatoes', 10, '../images-resized/sweetpotatoes.jpg'),
(16, 'Tomatoes', 40, '../images-resized/tomatoes.jpg'),
(17, 'Vegetable Oil', 30, '../images-resized/vegetable.jpg'),
(18, 'White Sugar', 5, '../images-resized/whitesugar.jpg'),
(19, 'Pack of Ginger', 15, '../images-resized/packofginger.jpg'),
(20, 'Spice Tubes', 25, '../images-resized/spice_tubes.jpg'),
(21, 'Spring Onion', 1, '../images-resized/springonion.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `producttb`
--
ALTER TABLE `producttb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `producttb`
--
ALTER TABLE `producttb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
