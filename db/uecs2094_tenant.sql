-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2017 at 06:06 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uecs2094_tenant`
--

CREATE DATABASE `uecs2094_tenant`;
USE `uecs2094_tenant`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Eatery'),
(2, 'Office'),
(3, 'Fashion'),
(4, 'Electronics'),
(5, 'Books'),
(6, 'General store'),
(7, 'Hardware store'),
(8, 'Music store'),
(9, 'Branded store'),
(10, 'Beauty');

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `floor_id` int(11) NOT NULL,
  `floor_name` varchar(30) NOT NULL,
  `floor_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`floor_id`, `floor_name`, `floor_number`) VALUES
(1, 'First floor', 1),
(2, 'Second floor', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lot`
--

CREATE TABLE `lot` (
  `lot_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `lot_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lot`
--

INSERT INTO `lot` (`lot_id`, `floor_id`, `zone_id`, `lot_number`) VALUES
(1, 1, 1, '1'),
(2, 1, 1, '2'),
(3, 1, 1, '3'),
(4, 1, 1, '4'),
(5, 1, 1, '5'),
(6, 1, 2, '6'),
(7, 1, 2, '7'),
(8, 1, 2, '8'),
(9, 1, 2, '9'),
(10, 1, 2, '10'),
(11, 2, 1, '1'),
(12, 2, 1, '2'),
(13, 2, 1, '3'),
(14, 2, 1, '4'),
(15, 2, 1, '5'),
(16, 2, 2, '6'),
(17, 2, 2, '7'),
(18, 2, 2, '8'),
(19, 2, 2, '9'),
(20, 2, 2, '10');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `lot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `name`, `category_id`, `lot_id`) VALUES
(1, 'Laputa Fans', 9, 1),
(3, 'Anpanman', 1, 11),
(4, 'Misos', 1, 3),
(5, 'Totoro Umbrella', 9, 2),
(6, 'Naruto Ramen', 1, 8),
(7, 'Orange Mikan', 4, 16),
(8, 'Management Office', 2, 4),
(9, 'Daiso', 6, 5),
(10, 'Mononoke Hide', 3, 14),
(11, 'Hadalabo', 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone_name`) VALUES
(1, 'Left wing'),
(2, 'Right wing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`lot_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lot`
--
ALTER TABLE `lot`
  MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
