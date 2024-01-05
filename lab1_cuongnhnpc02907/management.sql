-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2024 at 03:22 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `mssv` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ho` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lop` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `que_quan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sdt` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `so_cccd` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nguyen_quan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `mssv`, `ten`, `ho`, `dia_chi`, `lop`, `ngay_sinh`, `que_quan`, `sdt`, `so_cccd`, `email`, `nguyen_quan`) VALUES
(1, 'pc02907', 'cuong', 'nguyen', 'cai rang, can tho', 'WD18302', '2004-01-01', 'vinh thanh, can tho', '0349351942', '092203000333', 'cuongnhnpc02907@fpt.edu.vn', 'bac giang'),
(1, 'pc02907', 'cuong', 'nguyen', 'cai rang, can tho', 'WD18302', '2004-01-01', 'vinh thanh, can tho', '0349351942', '092203000333', 'cuongnhnpc02907@fpt.edu.vn', 'bac giang');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
