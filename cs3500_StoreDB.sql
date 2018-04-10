-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2017 at 05:53 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs3500_StoreDB`
--
CREATE DATABASE IF NOT EXISTS `cs3500_StoreDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs3500_StoreDB`;

-- --------------------------------------------------------

--
-- Table structure for table `OrderDetails`
--

DROP TABLE IF EXISTS `OrderDetails`;
CREATE TABLE `OrderDetails` (
  `OrderDetailsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UnitsPurchased` int(11) NOT NULL,
  `TotalPrice` double NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
CREATE TABLE `Product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Weight` double NOT NULL,
  `UnitsInStorage` int(11) NOT NULL,
  `Dimension` varchar(255) NOT NULL,
  `Description` longtext NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProductFavorite`
--

DROP TABLE IF EXISTS `ProductFavorite`;
CREATE TABLE `ProductFavorite` (
  `ProductFavoriteID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ProductRating`
--

DROP TABLE IF EXISTS `ProductRating`;
CREATE TABLE `ProductRating` (
  `ProductRatingID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Rating` int(1) NOT NULL,
  `WouldBuyAgain` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `UID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DateOfRegistration` datetime NOT NULL,
  `FisrtName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `GiftCardBalance` int(11) NOT NULL DEFAULT '500'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserShoppingCart`
--

DROP TABLE IF EXISTS `UserShoppingCart`;
CREATE TABLE `UserShoppingCart` (
  `USCID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UnitsInCart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD PRIMARY KEY (`OrderDetailsID`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `ProductFavorite`
--
ALTER TABLE `ProductFavorite`
  ADD PRIMARY KEY (`ProductFavoriteID`);

--
-- Indexes for table `ProductRating`
--
ALTER TABLE `ProductRating`
  ADD PRIMARY KEY (`ProductRatingID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `UserShoppingCart`
--
ALTER TABLE `UserShoppingCart`
  ADD PRIMARY KEY (`USCID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `OrderDetails`
--
ALTER TABLE `OrderDetails`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ProductFavorite`
--
ALTER TABLE `ProductFavorite`
  MODIFY `ProductFavoriteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ProductRating`
--
ALTER TABLE `ProductRating`
  MODIFY `ProductRatingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserShoppingCart`
--
ALTER TABLE `UserShoppingCart`
  MODIFY `USCID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
