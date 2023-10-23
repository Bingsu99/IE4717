-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 07:50 PM
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
-- Database: `javajam`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffeeproducts`
--

CREATE TABLE `coffeeproducts` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `current_price` decimal(10,2) DEFAULT NULL,
  `shot_option` enum('single','double','Endless Cup') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coffeeproducts`
--

INSERT INTO `coffeeproducts` (`product_id`, `product_name`, `description`, `base_price`, `current_price`, `shot_option`) VALUES
(1, 'Just Java', 'Regular house blend, decaffinated coffee, or flavour of the day', 2.00, 2.00, 'Endless Cup'),
(2, 'Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk', 2.00, 2.00, 'single'),
(3, 'Iced Cappucino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass', 4.75, 4.75, 'single'),
(4, 'Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk', 3.00, 3.00, 'double'),
(5, 'Iced Cappucino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass', 5.75, 5.75, 'double');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `quantity_sold` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `product_id`, `sale_date`, `quantity_sold`, `total_amount`) VALUES
(1, 2, '2023-10-24', 1, 2.00),
(2, 2, '2023-10-24', 1, 2.00),
(3, 3, '2023-10-23', 2, 9.50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffeeproducts`
--
ALTER TABLE `coffeeproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffeeproducts`
--
ALTER TABLE `coffeeproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `coffeeproducts` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
