-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2021 at 05:41 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHistoriTransaksi` (IN `idPengguna` INT)  begin
select * from historiTransaksi where id_users=idPengguna;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getJasaJenis` (IN `jenisJasa` VARCHAR(20))  begin
SELECT * FROM jasa WHERE jenis=jenisJasa;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getKeranjang` (IN `idPengguna` INT)  BEGIN
SELECT a.id AS id_keranjang, a.id_jasa AS id_jasa, b.nama AS nama, b.jenis AS jenis, b.image AS image, b.harga * a.jumlah AS harga, a.jumlah AS jumlah FROM keranjang a INNER JOIN jasa b ON a.id_jasa = b.id WHERE a.id_pengguna=idPengguna;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransaksi` (IN `in_users` INT, IN `in_alamat` INT, IN `in_intruksi` VARCHAR(500), IN `in_waktu` DATETIME, IN `in_total` INT, IN `in_status` VARCHAR(20))  begin
 insert into transaksi (id_users, id_alamat, intruksi, waktu_pengambilan, total, status) values (in_users, in_alamat, in_intruksi, in_waktu, in_total, in_status);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUsers` (IN `in_name` VARCHAR(60), IN `in_email` VARCHAR(60), IN `in_password` CHAR(80))  BEGIN
    INSERT INTO users(name, email, password)
	VALUES(in_name, in_email, in_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rankJasa` ()  begin
SELECT b.*, COUNT(a.id_barang) as jumlahTransaksi, DENSE_RANK() OVER (ORDER BY jumlahTransaksi DESC) FROM detil_transaksi a INNER JOIN jasa b ON a.id_barang=b.id GROUP BY a.id_barang LIMIT 4;
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
(3, 12, 'Rumah 1', 'Admin Ganteng', '088888888', 'Jln. Ganteng', 'Cibiru', '190425'),
(4, 1, 'Rumah 2', 'Admin', '0891234568', 'Rumah Admin B01/44', 'Cibiru', '190425');

-- --------------------------------------------------------

--
-- Table structure for table `detil_alamat`
--

CREATE TABLE `detil_alamat` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `label` varchar(30) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `nama_penerima` varchar(30) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detil_alamat`
--

INSERT INTO `detil_alamat` (`id`, `id_transaksi`, `label`, `alamat`, `nama_penerima`, `telepon`) VALUES
(1, 44, 'Rumah 2', 'Rumah Admin B01/44, Cibiru, 190425', 'Admin', '0891234568'),
(2, 45, 'Rumah 2', 'Rumah Admin B01/44, Cibiru, 190425', 'Admin', '0891234568'),
(3, 46, 'Rumah 2', 'Rumah Admin B01/44, Cibiru, 190425', 'Admin', '0891234568'),
(4, 47, 'Rumah Besar', 'Rumah Admin Besar R44/41, Kabupaten Cibiru, Cibiru, 190425', 'Admin Ganteng', '0819999999');

-- --------------------------------------------------------

--
-- Table structure for table `detil_transaksi`
--

CREATE TABLE `detil_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detil_transaksi`
--

INSERT INTO `detil_transaksi` (`id_transaksi`, `id_barang`, `kuantitas`, `id`) VALUES
(32, 1, 2, 12),
(32, 2, 2, 13),
(32, 3, 2, 14),
(33, 1, 2, 15),
(33, 2, 2, 16),
(33, 3, 2, 17),
(34, 7, 2, 18),
(34, 4, 1, 19),
(36, 2, 2, 20),
(37, 4, 10, 21),
(43, 4, 2, 24),
(45, 1, 1, 25),
(46, 3, 20, 26),
(47, 10, 2, 27);

-- --------------------------------------------------------

--
-- Stand-in structure for view `historiTransaksi`
-- (See below for the actual view)
--
CREATE TABLE `historiTransaksi` (
`id_users` int(11)
,`id` int(11)
,`nama` varchar(30)
,`jenis` varchar(30)
,`jumlah` int(11)
,`waktu_pengambilan` datetime
,`total` int(11)
,`status` varchar(20)
);

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
(3, 13, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL,
  `intruksi` varchar(500) NOT NULL,
  `waktu_pengambilan` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_users`, `id_alamat`, `intruksi`, `waktu_pengambilan`, `total`, `status`) VALUES
(1, 1, 1, 'Halooo', '2021-06-02 14:16:00', 328000, 'Proses'),
(2, 1, 1, 'Haloo', '2021-06-02 11:10:31', 465000, 'Proses'),
(3, 1, 1, 'Haloo', '2021-06-02 11:12:06', 465000, 'Proses'),
(4, 1, 1, 'Haloo', '2021-06-02 11:19:15', 465000, 'Proses'),
(26, 1, 1, 'Haloooo', '2021-06-02 23:02:00', 465000, 'Proses'),
(27, 1, 1, 'Haloooo', '2021-06-02 23:02:00', 465000, 'Proses'),
(28, 1, 1, 'Haloooo', '2021-06-02 23:02:00', 465000, 'Proses'),
(29, 1, 1, 'Haloooo', '2021-06-02 23:02:00', 465000, 'Proses'),
(32, 1, 4, 'Saya punya baju dan celana yang bolong', '2021-06-02 16:17:44', 465000, 'Proses'),
(33, 1, 4, 'Saya punya baju dan celana yang bolong', '2021-06-02 16:24:57', 465000, 'Proses'),
(34, 1, 1, 'Tunggu di rumah saya', '2021-06-02 21:35:00', 700000, 'Proses'),
(35, 1, 1, 'ok', '2021-06-18 09:08:00', 5000, 'Proses'),
(36, 1, 1, 'Celana bolong', '2021-06-03 10:52:00', 165000, 'Proses'),
(37, 1, 1, 'Gamis saya bolong mas', '2021-06-03 13:56:00', 1005000, 'Proses'),
(43, 1, 4, 'Bolong', '2021-06-03 22:26:00', 205000, 'Proses'),
(44, 1, 4, 'Bolong', '2021-06-04 22:31:48', 200000, 'Proses'),
(45, 1, 4, 'Ngetes gan', '2021-06-03 22:34:00', 95000, 'Proses'),
(46, 1, 4, 'Tesst lagi', '2021-06-03 22:36:00', 1205000, 'Proses'),
(47, 1, 6, 'Test ganti alamat', '2021-06-03 22:40:00', 165000, 'Proses');

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `insertDetilAlamat` AFTER INSERT ON `transaksi` FOR EACH ROW begin
declare labelAlamat varchar(30);
declare namaPenerima varchar(30);
declare telp varchar(20);
declare alamatPenerima varchar(500);

select label, nama_penerima, telepon, concat(alamat, ", ", area, ", ", kodepos) into labelAlamat, namaPenerima, telp, alamatPenerima from alamat where id_pengguna=new.id_users AND id_alamat=new.id_alamat;

insert into detil_alamat (id_transaksi, label, alamat, nama_penerima, telepon) values (new.id_transaksi, labelAlamat, alamatPenerima, namaPenerima, telp);
end
$$
DELIMITER ;

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
(1, 'Admin', 'admin@email.com', '$2y$10$.QV81Fg92a8rjJ68WnNVSuefZH7kL0IjMey9GjdynBj2QYWx5LH5.'),
(12, 'ganteng', 'ganteng@banget.com', '$2y$10$TBoliRlcHW.hsANKz6oD8Oyv1jswAO3U3fBiAMSBo9UDnvYwItJO6'),
(13, 'irfan', 'irfannm@mail.com', '$2y$10$g56VCade.GEqS2n92qxu4O4JE0zJEa3NIM0Yng4pGyeUNng5PIhMC'),
(14, 'testing', 'test@email.com', '$2y$10$52XuZ2C8GrmPyK0zSbk.Re./wX48cE53CCxDiFJpwSY3WedIxPAjS');

-- --------------------------------------------------------

--
-- Structure for view `historiTransaksi`
--
DROP TABLE IF EXISTS `historiTransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `historiTransaksi`  AS SELECT `b`.`id_users` AS `id_users`, `a`.`id_transaksi` AS `id`, `c`.`nama` AS `nama`, `c`.`jenis` AS `jenis`, `a`.`kuantitas` AS `jumlah`, `b`.`waktu_pengambilan` AS `waktu_pengambilan`, `b`.`total` AS `total`, `b`.`status` AS `status` FROM ((`detil_transaksi` `a` join `transaksi` `b` on(`a`.`id_transaksi` = `b`.`id_transaksi`)) join `jasa` `c` on(`a`.`id_barang` = `c`.`id`)) ;

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
-- Indexes for table `detil_alamat`
--
ALTER TABLE `detil_alamat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_transaksi` (`id_transaksi`);

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
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detil_alamat`
--
ALTER TABLE `detil_alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `detil_alamat`
--
ALTER TABLE `detil_alamat`
  ADD CONSTRAINT `detil_alamat_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD CONSTRAINT `detil_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `jasa` (`id`),
  ADD CONSTRAINT `detil_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

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
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
