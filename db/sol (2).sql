-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 11:42 AM
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
-- Database: `sol`
--

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `tgl_Temu` date NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keperluan` text NOT NULL,
  `kepentingan` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`tgl_Temu`, `gambar`, `keperluan`, `kepentingan`, `nama`, `telp`) VALUES
('2024-09-06', '66d80cb7d9cb6.jpg', 'cc', 'cc', '1', '085331485679'),
('2024-09-06', '66d80db952cdb.png', 'bb', 'bb', 'b', '085224186719'),
('2024-10-05', '66d80edb67f23.jpg', 'b', 'b', 'bb', '085224156218');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Admin', 'admin'),
(2, 'admin0', '$2y$10$Z4jAxvi5D4HDhBWbC1vvCO48WGLtvg6he/2KxiS3HKq9ntcndoWaC'),
(3, 'jono', '$2y$10$axcA.sxjhfqPt74DFH8.AukER8tjAoxUM2Zone2ZA5gfMvTfQfW6i'),
(4, 'jarot', '$2y$10$7gapQo/lvM.ZgzJTW9ums.dfKPNap5ZfDVSluyKjZgR2xob0nI5zu'),
(5, 'sueb', '$2y$10$mTy6hE5UYBF81wfcsphQIuhixSCJVEubYsE.dsNSLcFsUNJQ4dv4e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
