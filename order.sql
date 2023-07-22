-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2023 at 06:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `POS`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Order_total` int(11) DEFAULT NULL,
  `Date_of_purchase` date DEFAULT current_timestamp(),
  `Street_delivered_to` varchar(45) DEFAULT NULL,
  `City_delivered_to` varchar(45) DEFAULT NULL,
  `State_delivered_to` varchar(45) DEFAULT NULL,
  `Zip_code_delivered_to` varchar(45) DEFAULT NULL,
  `Gallons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_ID`, `User_ID`, `Order_total`, `Date_of_purchase`, `Street_delivered_to`, `City_delivered_to`, `State_delivered_to`, `Zip_code_delivered_to`, `Gallons`) VALUES
(7, 7, 86, '2023-06-26', '2901 Huisache', 'Hidalgo', 'TX', '78557', 50),
(8, 7, 21, '2023-06-26', '2901 Huisache', 'Hidalgo', 'TX', '78557', 12),
(9, 32, 18, NULL, '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(10, 32, 17, '2023-06-29', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(11, 32, 19, '2023-06-29', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 11),
(12, 34, 18, '2023-06-30', '123 main st', 'Humble', 'Texas', '77346', 10),
(13, 35, 18, '2023-07-10', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(14, 35, 17, '2023-07-12', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(15, 35, 17, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(16, 35, 19, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 11),
(17, 35, 19, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 11),
(18, 35, 19, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 11),
(19, 35, 21, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 12),
(20, 35, 23, '2023-07-21', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 13),
(21, 35, 24, '2023-07-14', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 14),
(22, 35, 26, '2023-07-28', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 15),
(23, 35, 17, '2023-07-27', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(24, 35, 17, '2023-07-27', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(25, 35, 17, '2023-07-27', '2901 Huisache', 'Hidalgo', 'Texas', '78557', 10),
(26, 40, 18, '2023-07-17', '123 main', 'queens', 'new york', '12345', 10),
(27, 44, 172, '2023-07-18', '123 louis lane', 'metropolis', 'TX', '12345', 100),
(28, 44, 174, '2023-07-18', '123 louis lane', 'metropolis', 'louisiana ', '12345', 100),
(29, 44, 17252, '2023-07-18', '123 louis lane', 'metropolis', 'louisiana ', '12345', 10001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_ID`,`User_ID`,`Gallons`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
