-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 09:51 AM
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
(1, 'Admin', 'admin@email.com', '$2y$10$cdHnN4XEvVZqmciAdFoJfeaooRZ7PrDm.TZGvG7Xnf5u4HWQu4jNG'),
(2, 'admin2', 'admin2@email.com', '$2y$10$VDmSLwmBGTaZh3fx54ZVeuhNsjNxForR2wyb8AOdwBBWMHfsO4psy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
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
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
