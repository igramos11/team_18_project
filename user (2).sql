-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2023 at 03:43 AM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `APT` varchar(10) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `ZipCode` varchar(45) DEFAULT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `first_login` tinyint(1) DEFAULT 1,
  `profitMargin` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `firstName`, `lastName`, `email`, `phoneNumber`, `Address`, `APT`, `City`, `State`, `ZipCode`, `Username`, `Password`, `first_login`, `profitMargin`) VALUES
(34, 'Abdiel', 'Loera', 'abloera@gmail.com', '9564678269', '123 main st', '', 'Humble', 'Texas', '77346', 'bebe01', '$2y$10$hCWCL.DKNPztW8mUJnSSVuGKOOlQ.lJwOYz0Gpx/GWEUmRjfw4Gs6', 0, '0.00'),
(35, 'Irma', 'Ramos', 'irma.gr.ramos@gmail.com', '9564678269', '2901 Huisache', '', 'Hidalgo', 'Texas', '78557', 'iramos22', '$2y$10$dvt0rEgrd7pIR4E6V6yoF.2xtYzuYaewiQCpY4nGwQV7LUmlQcB52', 0, '0.00'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'iramos1', '$2y$10$HGA5ZODmCOhxq9NZdhlFBO6B0TeW2of/gF6r26G/CMlPb4jNZ2EqO', 0, '0.00'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pparker', '$2y$10$gMwRez7oNRzT9ZiNsjaVSeWEoEYjMw1XU3ldf.gGzwywq4KaE1drq', 0, '0.00'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pparker1', '$2y$10$AncZpsVOZ7wquTgmRq/7Iuw/V9sHQMp3S1cld/FqwWDISjBQ85RbO', 0, '0.00'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pparker2', '$2y$10$K.Z93QJn3tbGQviZwBZHkeFFbcRm.1lMI1y50QoQNW/fi9nK4U.1a', 0, '0.00'),
(40, 'peter', 'parker', 'pparker123@gmail.com', '1234567', '123 main', '', 'queens', 'new york', '12345', 'pparker4', '$2y$10$OyXJJ2.Ls4Mrufuuk0Rj2OB7/o8PAfwqnAQOiG2XBNfvGw11xTQf.', 0, '0.00'),
(41, 'henry', 'cavill', 'hcavill@gmail.com', '1111111', '123 louis lane', '', 'metropolis', 'iowa', '00000', 'hcavill<3irma', '$2y$10$A6u5huEpc.91JBrQIbHJxuPq6Wz3fpipA0jIsi6kHMi02GUn/sCqG', 0, '0.00'),
(42, 'tony', 'stark', 'tonystark@starkindustries.com', '1234567', '123 jarvis', '', 'Los Angeles', 'California', '11111', 'ironman', '$2y$10$JVsa3uH2ZDmGSvdxJS.B5OWmHap.QSGqMmIql1H/hXYfZe31rBu76', 0, '0.00'),
(43, 'thor', 'GodOfThunder', 'thor@godofthunder.com', '1234567', 'Mount Olympus', '', 'Asgard', 'Norway', '12345', 'thor', '$2y$10$mcWmLByrPUhfQQq.zppkJuVW8wp75sTP5Spt/SDjJH.pg8/jomCMe', 0, '0.00'),
(44, 'henry', 'cavill', 'hcavill1@gmail.com', '1234567', '123 louis lane', '', 'metropolis', 'TX', '12345', 'hcavill1', '$2y$10$jF49fXhXUf8GzMiE5y298e03HETtcXzpzs/OXXsZlk2ZxYhxS4PmW', 0, '0.00'),
(45, 'henry', 'calvillo', 'henrycavill@gmail.com', '1234567', '123 louis lane', '', 'metropolis', 'new york', '12345', 'hcavill2', '$2y$10$r88SHuVhQPTyfZZJq0RVjOpTLNrvChcc4ovfix3X1whys/XpN.uP.', 0, '0.00'),
(46, 'Abdiel', 'Loera', 'abloera@gmail.com', '1234567', '111 main st', '', 'Houston', 'TX', '11111', 'aloera', '$2y$10$mFjHQjyC/RhgU/uLiIs6WeYAXLibyVlPcOkEtYIrEc0drbg/ubbbi', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
