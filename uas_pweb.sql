-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2021 at 04:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_pweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `label` varchar(30) NOT NULL,
  `nama_penerima` varchar(30) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `area` varchar(30) NOT NULL,
  `kodepos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `id_pengguna`, `label`, `nama_penerima`, `telepon`, `alamat`, `area`, `kodepos`) VALUES
(1, 1, 'Rumah', 'irr', '091', 'rumah', 'Cibiru', '1252'),
(2, 1, 'Rumah', 'irr', '091', 'rumah', 'Cibiru', '1252');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `keterangan` varchar(90) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama`, `jenis`, `image`, `keterangan`, `harga`) VALUES
(1, 'Kemeja Pendek', 'Permak', 'kemejapendek-permak', 'Jasa mengecilkan ukuran kemeja lengan panjang sesuai dengan ukuran tubuh anda', 90000),
(2, 'Celana Panjang', 'Permak', 'celanapanjang-permak', 'Jasa mengecilkan ukuran celana panjang sesuai dengan ukuran tubuh anda', 80000),
(3, 'Celana Pendek', 'Permak', 'celanapendek-permak', 'Jasa mengecilkan ukuran celana pendek sesuai dengan ukuran tubuh anda', 60000),
(4, 'Gamis', 'Permak', 'gamis-permak', 'Jasa mengecilkan ukuran gamis sesuai dengan ukuran tubuh anda', 100000),
(5, 'Kaos', 'Permak', 'kaos-permak', 'Jasa mengecilkan ukuran kaos sesuai dengan ukuran tubuh anda', 70000),
(6, 'Kaos', 'Jahit Baru', 'kaos-jahitbaru', 'Jasa menjahit baru kaos sesuai dengan model yang anda berikan', 200000),
(7, 'Kemeja Pendek', 'Jahit Baru', 'kemejapendek-jahitbaru', 'Jasa menjahit baru kemeja lengan pendek sesuai dengan model yang anda berikan', 300000),
(8, 'Gamis', 'Jahit Baru', 'gamis-jahitbaru', 'Jasa menjahit baru gamis sesuai dengan model yang anda berikan', 400000),
(9, 'Celana Panjang', 'Jahit Baru', 'celanapanjang-jahitbaru', 'Jasa menjahit baru celana panjang sesuai dengan model yang anda berikan', 500000),
(10, 'Kemeja Panjang', 'Permak', 'kemejapanjang-permak', 'Jasa mengecilkan ukuran kemeja lengan panjang sesuai dengan ukuran tubuh anda', 80000),
(11, 'Celana Pendek', 'Jahit Baru', 'celanapendek-jahitbaru', 'Jasa menjahit baru celana pendek sesuai dengan model yang anda berikan', 70000),
(12, 'Kemeja Panjang', 'Jahit Baru', 'kemejapanjang-jahitbaru', 'Jasa menjahit baru kemeja lengan panjang sesuai dengan model yang anda berikan', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_pengguna`, `id_jasa`, `jumlah`) VALUES
(3, 1, 3, 1),
(4, 1, 4, 10),
(5, 1, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` char(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$cdHnN4XEvVZqmciAdFoJfeaooRZ7PrDm.TZGvG7Xnf5u4HWQu4jNG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_jasa` (`id_jasa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
