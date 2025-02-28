-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 03:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL,
  `tipo_persona` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `orario` time NOT NULL,
  `id_utilisatore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenotazioni`
--

INSERT INTO `prenotazioni` (`id`, `tipo_persona`, `data`, `orario`, `id_utilisatore`) VALUES
(5, 'esperienza vr', '2025-03-06', '04:13:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `is_admin`) VALUES
(1, 'hichamtaoual26@gmail.com', 'hicham', '$2y$10$sxxJngkXcoxYOD6FIJ8k7OCuUhne0/Y/cZmixMJEmuEIBw2A7PM7C', 1),
(2, 'hichamtaoual28@gmail.com', 'hicham', '$2y$10$Clf5SJjkeuNwJVdcs7SxdOp/g.VPHVXsGJa47j9wWsHhjTUUM1d.2', NULL),
(4, 'hichamtaoual@gmail.com', 'hichamsexy', '$2y$10$MAg2yRjRqmJAupWR5yFtXeyM6GdBOHIs21yZzmSI2cycvkbm9Xt2W', 0),
(5, 'abc@gmail.com', 'yahya', '$2y$10$.nHIFyfP12cDZ8g..On9N.3N9VJXAZVSGTssdXRsgnsBhp0R58lk2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
