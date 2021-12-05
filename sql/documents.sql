-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 07:11 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `documents`
--

-- --------------------------------------------------------

--
-- Table structure for table `docupload`
--

CREATE TABLE `docupload` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `doc_file_name` varchar(255) NOT NULL,
  `doc_points` text NOT NULL,
  `doc_table_size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docupload`
--

INSERT INTO `docupload` (`id`, `doc_name`, `doc_type`, `doc_file_name`, `doc_points`, `doc_table_size`) VALUES
(18, 'Part-1', '1', 'demo_files/1638727780sri-varalakshmi-2.jpg', '{\"x\":2,\"y\":36,\"x2\":124,\"y2\":155,\"w\":122,\"h\":119}', ''),
(19, 'Part-2', '2', 'demo_files/1638727818google-map.png', '{\"x\":408,\"y\":217,\"x2\":456,\"y2\":287,\"w\":48,\"h\":70}', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docupload`
--
ALTER TABLE `docupload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docupload`
--
ALTER TABLE `docupload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
