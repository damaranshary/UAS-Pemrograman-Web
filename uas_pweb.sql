-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2021 at 03:29 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteAlamatID` (IN `idAlamat` INT)  begin
DELETE FROM alamat WHERE id_alamat=idAlamat;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteKeranjangID` (IN `idKeranjang` INT)  begin
DELETE FROM keranjang WHERE id=idKeranjang;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAlamatID` (IN `idUser` INT)  begin
SELECT * from alamat WHERE id_pengguna = idUser;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAlamatID2` (IN `idPengguna` INT, IN `idAlamat` INT)  begin
SELECT * from alamat WHERE id_pengguna = idPengguna AND id_alamat=idAlamat;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getJasaJenis` (IN `jenisJasa` VARCHAR(20))  begin
SELECT * FROM jasa WHERE jenis=jenisJasa;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getKeranjang` (IN `idPengguna` INT)  BEGIN
SELECT a.id AS id_keranjang, b.nama AS nama, b.jenis AS jenis, b.image AS image, b.harga * a.jumlah AS harga, a.jumlah AS jumlah FROM keranjang a INNER JOIN jasa b ON a.id_jasa = b.id WHERE a.id_pengguna=idPengguna;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTransaksiID` (IN `idPengguna` INT)  begin
SELECT * FROM transaksi WHERE id_users = idPengguna;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserEmail` (IN `emailUser` VARCHAR(40))  begin
SELECT id, name, email FROM users WHERE email=emailUser;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAlamat` (IN `idPeng` INT, IN `in_label` VARCHAR(30), IN `in_namaPenerima` VARCHAR(20), IN `in_telp` VARCHAR(20), IN `in_alamat` VARCHAR(300), IN `in_area` VARCHAR(30), IN `in_kodePos` VARCHAR(10))  BEGIN
INSERT INTO alamat (id_pengguna, label, nama_penerima, telepon, alamat, area, kodepos) values (idPeng, in_label, in_namaPenerima, in_telp, in_alamat, in_area, in_kodePos);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDetilTransaksi` (`in_transaksi` INT, `in_barang` INT, `in_kuantitas` INT)  begin
insert into detil_transaksi values(in_transaksi, in_barang, in_kuantitas);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertKeranjang` (IN `idPengguna` INT, IN `idBarang` INT, IN `jmlh` INT)  begin
INSERT INTO keranjang (id_pengguna, id_jasa, jumlah) VALUES (idPengguna, idBarang, jmlh);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransaksi` (`in_users` INT, `in_alamat` INT, `in_intruksi` VARCHAR(500), `in_waktu` DATE, `in_total` INT, `in_status` VARCHAR(20))  begin
 insert into transaksi (id_users, id_alamat, intruksi, waktu_pengambilan, total, status) values (in_users, in_alamat, in_intruksi, in_waktu, in_total, in_status);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUsers` (IN `in_name` VARCHAR(60), IN `in_email` VARCHAR(60), IN `in_password` CHAR(80))  BEGIN
    INSERT INTO users(name, email, password)
	VALUES(in_name, in_email, in_password);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getJumlahAlamat` (`idPengguna` INT, `labelAlamat` VARCHAR(30)) RETURNS INT(11) begin
declare jumlahAlamat int;
SELECT count(label) into jumlahAlamat FROM alamat WHERE id_pengguna=idPengguna AND label=labelAlamat;
return jumlahAlamat;
end$$

DELIMITER ;

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
(3, 12, 'Rumah 1', 'Admin Ganteng', '088888888', 'Jln. Ganteng', 'Cibiru', '190425'),
(4, 1, 'Rumah 2', 'Admin', '0891234568', 'Rumah Admin B01/44', 'Cibiru', '190425');

-- --------------------------------------------------------

--
-- Table structure for table `detil_transaksi`
--

CREATE TABLE `detil_transaksi` (
  `id_transaksi` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_pengguna`, `id_jasa`, `jumlah`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL,
  `intruksi` varchar(500) NOT NULL,
  `waktu_pengambilan` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'ganteng', 'ganteng@banget.com', '$2y$10$TBoliRlcHW.hsANKz6oD8Oyv1jswAO3U3fBiAMSBo9UDnvYwItJO6');

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
-- Indexes for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

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
  ADD KEY `id_jasa` (`id_jasa`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_alamat` (`id_alamat`);

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
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD CONSTRAINT `detil_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detil_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `jasa` (`id`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_alamat`) REFERENCES `alamat` (`id_alamat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
