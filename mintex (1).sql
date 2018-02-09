-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2018 at 12:39 PM
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

--
-- Dumping data for table `t_benang`
--

INSERT INTO `t_benang` (`id_benang`, `nama_benang`, `status`) VALUES
(1, 'Tc 30s', 'on');

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
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_benang_in`
--

INSERT INTO `t_benang_in` (`id_benang_in`, `id_dist_benang`, `id_benang`, `b_karung`, `b_box`, `ball`, `kg`, `harga`, `keterangan`, `tgl`) VALUES
(4, 1, 1, 0, 40, 0, 900, 1000, '', '2018-02-07'),
(5, 1, 1, 40, 0, 120, 0, 4300, 'test', '2018-02-08');

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

--
-- Dumping data for table `t_dest`
--

INSERT INTO `t_dest` (`id_dest`, `nama_dest`, `alamat`, `telepon`, `status`) VALUES
(1, 'Badjatex', 'Bandung', '022xxxxxx', 'on');

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

--
-- Dumping data for table `t_detail_out`
--

INSERT INTO `t_detail_out` (`id_kain_out`, `id_kain`, `gl`, `meter`, `kg`, `harga`) VALUES
(15, 1, 10, 10, 10, 5000),
(15, 2, 10, 10, 10, 4900),
(16, 1, 10, 10, 10, 1000),
(17, 1, 10, 10, 10, 1000),
(18, 1, 10, 20, 10, 1000),
(19, 1, 10, 10, 10, 1500),
(19, 2, 10, 10, 10, 1200),
(20, 1, 10, 10, 10, 1000),
(21, 1, 10, 10, 10, 1000),
(21, 2, 10, 10, 10, 1200),
(22, 1, 70, 960, 970, 4000),
(22, 2, 30, 20, 20, 1200);

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

--
-- Dumping data for table `t_distributor`
--

INSERT INTO `t_distributor` (`id_distributor`, `nama_dist`, `alamat`, `telepon`) VALUES
(1, 'Inkatex', 'Majalaya', '022xxxxxx');

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

--
-- Dumping data for table `t_dist_benang`
--

INSERT INTO `t_dist_benang` (`id_dist_benang`, `nama_dist`, `alamat`, `telepon`) VALUES
(1, 'Agus', 'Bandung', '022xxxxxx');

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
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kain_in`
--

INSERT INTO `t_kain_in` (`id_kain_in`, `id_kain`, `id_distributor`, `gl`, `meter`, `kg`, `harga`, `keterangan`, `tgl`) VALUES
(13, 1, 1, 200, 5000, 9000, 4300, '', '2018-02-04'),
(14, 2, 1, 100, 5500, 1200, 3400, '', '2018-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `t_kain_out`
--

CREATE TABLE `t_kain_out` (
  `id_kain_out` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kain_out`
--

INSERT INTO `t_kain_out` (`id_kain_out`, `id_dest`, `keterangan`, `tgl`, `status`) VALUES
(15, 1, 'kternagna coba', '2018-02-04', 1),
(16, 1, 'bandung', '2018-02-04', 1),
(17, 1, 'sdfcdsfsd', '2018-02-04', 1),
(18, 1, 'bancet', '2018-02-04', 1),
(19, 1, 'testeretrqewhrwjhewm', '2018-02-04', 1),
(20, 1, 'asdasdasdasd', '2018-02-04', 1),
(21, 1, 'diretas', '2018-02-04', 1),
(22, 1, 'indonesia raya ciptaan ismail marzuki', '2018-02-04', 1);

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

--
-- Dumping data for table `t_stok_benang`
--

INSERT INTO `t_stok_benang` (`id_benang`, `total_box`, `total_karung`, `total_ball`, `total_kg`) VALUES
(1, 40, 40, 120, 0);

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
-- Dumping data for table `t_stok_kain`
--

INSERT INTO `t_stok_kain` (`id_kain`, `total_gl`, `total_meter`, `total_kg`) VALUES
(1, 100, 4000, 8000),
(2, 50, 5460, 1160);

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
-- Indexes for table `t_dest`
--
ALTER TABLE `t_dest`
  ADD PRIMARY KEY (`id_dest`);

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
  MODIFY `id_benang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_benang_in`
--
ALTER TABLE `t_benang_in`
  MODIFY `id_benang_in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_dest`
--
ALTER TABLE `t_dest`
  MODIFY `id_dest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_distributor`
--
ALTER TABLE `t_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_dist_benang`
--
ALTER TABLE `t_dist_benang`
  MODIFY `id_dist_benang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_kain`
--
ALTER TABLE `t_kain`
  MODIFY `id_kain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_kain_in`
--
ALTER TABLE `t_kain_in`
  MODIFY `id_kain_in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `t_kain_out`
--
ALTER TABLE `t_kain_out`
  MODIFY `id_kain_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
