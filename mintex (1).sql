-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2018 at 04:47 PM
-- Server version: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mintex`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `reset` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id_admin`, `username`, `email`, `fullname`, `password`, `foto`, `reset`) VALUES
(1, 'admin', 'admin@mintex.com', 'Administrator', '$2y$10$7G0QZCygOc7BVfttUeGjOOx7FyrEZMnqOXg.P/6aq4tNJPJG8Uwf6', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_benang`
--

CREATE TABLE `t_benang` (
  `id_benang` int(11) NOT NULL,
  `nama_benang` varchar(255) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_benang_in`
--

CREATE TABLE `t_benang_in` (
  `id_benang_in` int(11) NOT NULL,
  `id_dist_benang` int(11) NOT NULL,
  `id_benang` int(11) NOT NULL,
  `b_karung` double NOT NULL,
  `b_box` double NOT NULL,
  `ball` double NOT NULL,
  `kg` double NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `status_bng` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_benang_out`
--

CREATE TABLE `t_benang_out` (
  `id_benang_out` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `status_bout` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_dest`
--

CREATE TABLE `t_dest` (
  `id_dest` int(11) NOT NULL,
  `nama_dest` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_dest_benang`
--

CREATE TABLE `t_dest_benang` (
  `id_dest` int(11) NOT NULL,
  `nama_dest` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_benang`
--

CREATE TABLE `t_detail_benang` (
  `id_benang_out` int(11) NOT NULL,
  `id_benang` int(11) NOT NULL,
  `box` double NOT NULL,
  `karung` double NOT NULL,
  `ball` double NOT NULL,
  `kg` double NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_out`
--

CREATE TABLE `t_detail_out` (
  `id_kain_out` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `gl` double NOT NULL,
  `meter` double NOT NULL,
  `kg` double NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_distributor`
--

CREATE TABLE `t_distributor` (
  `id_distributor` int(11) NOT NULL,
  `nama_dist` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_dist_benang`
--

CREATE TABLE `t_dist_benang` (
  `id_dist_benang` int(11) NOT NULL,
  `nama_dist` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_kain`
--

CREATE TABLE `t_kain` (
  `id_kain` int(11) NOT NULL,
  `nama_kain` varchar(225) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kain`
--

INSERT INTO `t_kain` (`id_kain`, `nama_kain`, `status`) VALUES
(1, 'P.Tc (S.56)', 'on'),
(2, 'Heret', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `t_kain_in`
--

CREATE TABLE `t_kain_in` (
  `id_kain_in` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `gl` double NOT NULL,
  `meter` double NOT NULL,
  `kg` double NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `tgl` date NOT NULL,
  `status_kain` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_kain_out`
--

CREATE TABLE `t_kain_out` (
  `id_kain_out` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `status_out` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_stok_benang`
--

CREATE TABLE `t_stok_benang` (
  `id_benang` int(11) NOT NULL,
  `total_box` double NOT NULL,
  `total_karung` double NOT NULL,
  `total_ball` double NOT NULL,
  `total_kg` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_stok_kain`
--

CREATE TABLE `t_stok_kain` (
  `id_kain` int(10) NOT NULL,
  `total_gl` double NOT NULL,
  `total_meter` double NOT NULL,
  `total_kg` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `t_benang`
--
ALTER TABLE `t_benang`
  ADD PRIMARY KEY (`id_benang`);

--
-- Indexes for table `t_benang_in`
--
ALTER TABLE `t_benang_in`
  ADD PRIMARY KEY (`id_benang_in`);

--
-- Indexes for table `t_benang_out`
--
ALTER TABLE `t_benang_out`
  ADD PRIMARY KEY (`id_benang_out`);

--
-- Indexes for table `t_dest`
--
ALTER TABLE `t_dest`
  ADD PRIMARY KEY (`id_dest`);

--
-- Indexes for table `t_dest_benang`
--
ALTER TABLE `t_dest_benang`
  ADD PRIMARY KEY (`id_dest`);

--
-- Indexes for table `t_detail_benang`
--
ALTER TABLE `t_detail_benang`
  ADD KEY `id_benang_out` (`id_benang_out`);

--
-- Indexes for table `t_detail_out`
--
ALTER TABLE `t_detail_out`
  ADD KEY `id_out` (`id_kain_out`);

--
-- Indexes for table `t_distributor`
--
ALTER TABLE `t_distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `t_dist_benang`
--
ALTER TABLE `t_dist_benang`
  ADD PRIMARY KEY (`id_dist_benang`);

--
-- Indexes for table `t_kain`
--
ALTER TABLE `t_kain`
  ADD PRIMARY KEY (`id_kain`);

--
-- Indexes for table `t_kain_in`
--
ALTER TABLE `t_kain_in`
  ADD PRIMARY KEY (`id_kain_in`),
  ADD KEY `id_kain` (`id_kain`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indexes for table `t_kain_out`
--
ALTER TABLE `t_kain_out`
  ADD PRIMARY KEY (`id_kain_out`),
  ADD KEY `id_dest` (`id_dest`);

--
-- Indexes for table `t_stok_benang`
--
ALTER TABLE `t_stok_benang`
  ADD KEY `id_kain` (`id_benang`);

--
-- Indexes for table `t_stok_kain`
--
ALTER TABLE `t_stok_kain`
  ADD KEY `id_kain` (`id_kain`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_benang`
--
ALTER TABLE `t_benang`
  MODIFY `id_benang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_benang_in`
--
ALTER TABLE `t_benang_in`
  MODIFY `id_benang_in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `t_benang_out`
--
ALTER TABLE `t_benang_out`
  MODIFY `id_benang_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_dest`
--
ALTER TABLE `t_dest`
  MODIFY `id_dest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_dest_benang`
--
ALTER TABLE `t_dest_benang`
  MODIFY `id_dest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_distributor`
--
ALTER TABLE `t_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_dist_benang`
--
ALTER TABLE `t_dist_benang`
  MODIFY `id_dist_benang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_kain`
--
ALTER TABLE `t_kain`
  MODIFY `id_kain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_kain_in`
--
ALTER TABLE `t_kain_in`
  MODIFY `id_kain_in` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_kain_out`
--
ALTER TABLE `t_kain_out`
  MODIFY `id_kain_out` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_kain_in`
--
ALTER TABLE `t_kain_in`
  ADD CONSTRAINT `fk_01` FOREIGN KEY (`id_kain`) REFERENCES `t_kain` (`id_kain`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_02` FOREIGN KEY (`id_distributor`) REFERENCES `t_distributor` (`id_distributor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_stok_kain`
--
ALTER TABLE `t_stok_kain`
  ADD CONSTRAINT `fk-001` FOREIGN KEY (`id_kain`) REFERENCES `t_kain` (`id_kain`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
