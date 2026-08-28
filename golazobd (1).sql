-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2026 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `golazobd`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `ItemID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`ItemID`, `OrderID`, `ProductID`, `Quantity`, `UnitPrice`, `SubTotal`) VALUES
(1, 1, 3, 2, 2200.00, 4400.00),
(2, 2, 3, 2, 2200.00, 4400.00),
(3, 3, 1, 2, 2200.00, 4400.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerName` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `BillingAddress` text DEFAULT NULL,
  `DeliveryArea` varchar(30) DEFAULT NULL,
  `DeliveryCharge` decimal(10,2) DEFAULT NULL,
  `ProductTotal` decimal(10,2) DEFAULT NULL,
  `GrandTotal` decimal(10,2) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `Status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerName`, `Phone`, `BillingAddress`, `DeliveryArea`, `DeliveryCharge`, `ProductTotal`, `GrandTotal`, `OrderDate`, `Status`) VALUES
(1, 'Mehedi Sarker', '01675316067', 'Division: dhaka, District: dhaka, Area: sutrapur, Address: 29/A,20/5\r\nSatish Sarker road', '', 0.00, 4400.00, 4400.00, '2026-08-15 13:08:00', 'Delivered'),
(2, 'rakib', '0183673643', 'Division: dhaka, District: dhaka, Area: sutrapur, Address: 29/A,20/5\r\nlalbaghr road', 'Inside Dhaka', 80.00, 4400.00, 4480.00, '2026-08-15 13:12:40', 'Pending'),
(3, 'labonno', '01675316067', '29/A,20/5\r\nSatish Sarker road, sutrapur, dhaka, dhaka (Note: gg)', 'Inside Dhaka', 80.00, 4400.00, 4480.00, '2026-08-16 18:03:08', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Club` varchar(50) DEFAULT NULL,
  `Edition` varchar(30) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Category`, `Club`, `Edition`, `Price`, `Stock`, `Image`) VALUES
(1, 'Arsenal Home 2026', 'Jersey', 'Arsenal', 'Player', 2200.00, 7, 'Assets/arsenal.jpg'),
(2, 'Barcelona Home 2026', 'Jersey', 'Barcelona', 'Fan', 1500.00, 18, 'Assets/barcelona.jpg'),
(3, 'Real Madrid Home 2026', 'Jersey', 'Real Madrid', 'Player', 2200.00, 8, 'Assets/madrid.jpg'),
(4, 'Fc Bayern Munchen', 'jersey', 'bayern Munchen', 'player', 2000.00, 5, 'Assets/bayern.jpg'),
(5, 'ManChester City', 'jersey', 'Manchester City F.C', 'player', 2000.00, 5, 'Assets/city.jpg'),
(6, 'Liverpool', 'jersey', 'Liverpool F.C', 'Fan', 1500.00, 6, 'Assets/liverpool.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Role`) VALUES
(1, 'A102', '1234', 'Admin'),
(2, 'D102', '1234', 'DeliveryMan'),
(3, 'Rana', '0987654321', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
