-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2020 at 11:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifs_dc`
--

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `bk/ro` varchar(20) NOT NULL,
  `bkg` varchar(20) NOT NULL,
  `shipper` varchar(50) NOT NULL,
  `consignee` varchar(50) NOT NULL,
  `imo` varchar(5) NOT NULL,
  `bond` varchar(5) NOT NULL,
  `instructions` varchar(20) NOT NULL,
  `pcs` int(10) NOT NULL,
  `pcs_type` varchar(20) NOT NULL,
  `kgs` int(11) NOT NULL,
  `m3` int(11) NOT NULL,
  `wh` varchar(50) NOT NULL,
  `ci` varchar(11) NOT NULL,
  `pl` varchar(11) NOT NULL,
  `sli` varchar(11) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `cntr` varchar(20) NOT NULL,
  `week` int(4) NOT NULL,
  `destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `bk/ro`, `bkg`, `shipper`, `consignee`, `imo`, `bond`, `instructions`, `pcs`, `pcs_type`, `kgs`, `m3`, `wh`, `ci`, `pl`, `sli`, `comments`, `cntr`, `week`, `destination`) VALUES
(75842, 'ROI', 'GTSTC19018F', 'ROLAND FOODS, LLC', 'INDUSTRIAS ODI S.A', 'NO', 'NO', 'ROI', 6, 'PALLETS', 5103, 8, 'W77865', 'NO', 'NO', 'SI', 'COMMENTSSSSS', 'TCNU6582354', 1, 'Guatemala'),
(75843, 'BKG', 'GTSTC19018F', 'Shipper Example', 'CNEE Example', 'NO', 'NO', 'BKG', 2, 'boxes', 51, 3, 'W88397', 'NO', 'no', 'no', 'Comments', 'CMAU6526694', 2, 'Guatemala'),
(86956, 'ROI', 'GTSTC19019C', 'Shipper Example 2', 'CNEE EXAMPLE 2', 'NO', 'NO', 'ROI', 23, 'PALLETS', 6, 1, 'W88695', 'NO', 'SI', 'no', 'COMMMENTSSSS', 'CMAU6526694', 2, 'Guatemala'),
(86956, 'ROI', 'GTSTC19019C', 'Shipper Example 2', 'CNEE EXAMPLE 2', 'NO', 'NO', 'roi', 23, 'PALLETS', 6, 1, 'W88695', 'NO', 'SI', 'no', 'COMMMENTSSSS', 'CMAU6526694', 2, 'Guatemala'),
(65962, 'ROI', 'GTSTC19018F', 'Shipper Example 3', 'INDUSTRIAS ODI S.A33333', 'NO', 'NO', 'ROI', 6, 'PALLETS', 65, 10, 'W96532', 'SI', 'SI', 'SI', 'COMMENTSSSSSSSSSSSSSSSSSSSSSSSSSSSS', 'CMAU6526694', 2, 'Guatemala'),
(22965, 'BKG', 'GTSTC19018F', 'Shipper Example', 'CNEE 34', 'NO', 'NO', 'ROI', 3, 'boxes', 5, 1, 'W77576', 'NO', 'SI', 'SI', 'COMMENTS', 'SEGU5648695', 2, 'San Salvador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
