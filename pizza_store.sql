-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2020 at 03:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postalCode` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`name`, `address`, `city`, `province`, `postalCode`, `email`) VALUES
('Muhammad Sadiq', 'Sukkur IBA University, Airport Road Sukkur', 'Sukkur', 'Sindh', '66220', 'sadiq.cs17@iba-suk.edu.pk'),
('client', 'fds', 'lkfhdsl', 'flhkds', 'lfkhdsl', 'email@gmail.com'),
('Ali', 'Sukkur IBA University', 'Sukkur', 'Sindh', '66220', 'Ali@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `orderID` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`orderID`, `date`, `email`) VALUES
(1, '2020-11-20 17:24:17', 'sadiq@gmail.com'),
(2, '2020-11-20 17:26:19', 'sadiq@gmail.com'),
(3, '2020-11-20 19:00:49', 'sadiq@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Pizza`
--

CREATE TABLE `Pizza` (
  `pizzaID` int(11) NOT NULL,
  `dough` varchar(100) NOT NULL,
  `sauce` varchar(200) NOT NULL,
  `cheese` varchar(200) NOT NULL,
  `toppings` varchar(100) NOT NULL,
  `currentOrderKey` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pizza`
--

INSERT INTO `Pizza` (`pizzaID`, `dough`, `sauce`, `cheese`, `toppings`, `currentOrderKey`) VALUES
(1, 'doughType_2', 'sauceType_2', 'topping_4 topping_8 ', 'cheeseType_2', 're0UwIFKcN'),
(2, 'doughType_2', 'sauceType_2', 'topping_7 topping_8 topping_9 topping_10 ', 'cheeseType_2', 'UY0kTwEhqi'),
(3, 'doughType_2', 'sauceType_3', 'topping_4 topping_5 ', 'cheeseType_3', 'tkyDlg1rKL'),
(4, 'doughType_2', 'sauceType_3', 'topping_4 topping_7 ', 'cheeseType_2', 'RSJOzQYZVJ'),
(5, 'doughType_2', 'sauceType_2', 'topping_4 topping_5 topping_8 ', 'cheeseType_2', 'yZ4BQBEIBB'),
(6, 'doughType_3', 'sauceType_2', 'topping_1 topping_2 topping_7 topping_8 ', 'cheeseType_2', 'mTiD9fymx3'),
(7, 'doughType_1', 'sauceType_3', 'topping_1 topping_2 topping_5 topping_7 topping_8 ', 'cheeseType_1', 'Tth5IAZssv'),
(8, 'doughType_3', 'sauceType_1', 'topping_4 ', 'cheeseType_3', 'Tx59KlqBRM'),
(9, 'doughType_3', 'sauceType_2', 'topping_1 topping_2 topping_3 ', 'cheeseType_2', 'tneHRDH1f9'),
(10, 'doughType_3', 'sauceType_2', 'cheeseType_2', 'topping_1 topping_2 topping_3 topping_1 topping_2 topping_3 ', 'tneHRDH1f9'),
(11, 'doughType_1', 'sauceType_1', 'cheeseType_1', 'topping_1 ', '8AfqWtBjB4'),
(12, 'doughType_2', 'sauceType_2', 'cheeseType_2', 'topping_2 ', '8AfqWtBjB4'),
(13, 'doughType_2', 'sauceType_2', 'cheeseType_2', 'topping_1 topping_2 topping_3 topping_6 topping_8 ', 'bgSzz0qfET'),
(14, 'doughType_2', 'sauceType_3', 'cheeseType_2', 'topping_1 topping_2 ', 'bgSzz0qfET');

-- --------------------------------------------------------

--
-- Table structure for table `PizzaOrders`
--

CREATE TABLE `PizzaOrders` (
  `pizzaOrderID` int(11) NOT NULL,
  `pizzaID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PizzaOrders`
--

INSERT INTO `PizzaOrders` (`pizzaOrderID`, `pizzaID`, `orderID`) VALUES
(1, 11, 1),
(2, 12, 1),
(3, 13, 3),
(4, 14, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `Pizza`
--
ALTER TABLE `Pizza`
  ADD PRIMARY KEY (`pizzaID`);

--
-- Indexes for table `PizzaOrders`
--
ALTER TABLE `PizzaOrders`
  ADD PRIMARY KEY (`pizzaOrderID`),
  ADD KEY `pizzaID` (`pizzaID`),
  ADD KEY `orderID` (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Pizza`
--
ALTER TABLE `Pizza`
  MODIFY `pizzaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `PizzaOrders`
--
ALTER TABLE `PizzaOrders`
  MODIFY `pizzaOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`email`) REFERENCES `Customers` (`email`);

--
-- Constraints for table `PizzaOrders`
--
ALTER TABLE `PizzaOrders`
  ADD CONSTRAINT `pizzaorders_ibfk_1` FOREIGN KEY (`pizzaID`) REFERENCES `Pizza` (`pizzaID`),
  ADD CONSTRAINT `pizzaorders_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `Orders` (`orderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
