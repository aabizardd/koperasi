-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 08:34 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` int(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `bpkb` varchar(255) NOT NULL,
  `stnk` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `status_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `username`, `password`, `nama`, `nik`, `email`, `no_hp`, `alamat`, `ktp`, `bpkb`, `stnk`, `jenis_kelamin`, `status_anggota`) VALUES
(2, 'eben', '123', 'Eben Ezer', 12345785, 'ebenezer@gmail.com', 884884848, 'Bida Ayu', 'ktp.jpg', '7703b79a9480c6937b9d150455e1210c.jpg', '47b8807ed53fe14bf91c2864fd241e1c.jpg', 'Laki-laki', 1),
(3, 'hariadi', '111', 'Hariadi', 24, 'hariadi@gmail.com', 98, 'Afrika', '', '', '', 'Laki-laki', 1),
(5, 'Mutia', '123', 'Mutia', 0, '', 0, '', '', '', '', 'Perempuan', 1),
(7, 'Joan', '321', 'Joan Gray', 520200020, 'joangray12@gmail.com', 87654, '', '', '', '', 'Laki-laki', 1),
(9, 'firman', '123', 'Firmansyah Arnold', 67678687, 'firmannsyah@gmail.com', 0, '', 'c36218d156495147ee75da9993e4fdd0.png', '8a9c28e6060c1045d76d59291a22d8c5.png', 'f9eca82f6832c69b8b18f37e5e421414.png', 'Laki-laki', 1),
(10, 'tes', 'tes', 'tes', 67678687, 'tes@gmail.com', 0, 'cibinong', 'e1f42c8b3cf73abe94651c10af7d83c4.jpg', '', '', 'Laki-laki', 1),
(11, 'albert', '123', 'Albert Frans Kevin', 214576246, 'albert@gmail.com', 82211, 'Batam', 'faf089201ee8cf626af8fa49a2f52dea.jpg', 'cc2fa33f5bca8414b672f44241352de0.jpeg', '48d087b11530eb69e95cc3beed93e7e9.jpg', 'Laki-laki', 1),
(13, 'andre', '123', 'Andre Parhusip', 235235, 'andre@gmail.com', 8212231, 'bougenvilee', '7767ad53caa58f68fa804ae2e847ab2d.jpg', '', '', 'Laki-laki', 1);

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `nominal` int(255) NOT NULL,
  `tanggal_angsuran` date NOT NULL,
  `id_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `nominal`, `tanggal_angsuran`, `id_pinjaman`) VALUES
(37, 250000, '2021-04-26', 55),
(38, 200000, '2021-04-28', 55),
(39, 570000, '2021-04-30', 55);

-- --------------------------------------------------------

--
-- Table structure for table `histori_pinjaman`
--

CREATE TABLE `histori_pinjaman` (
  `id_history` int(11) NOT NULL,
  `jml_pinjaman` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tenor` date NOT NULL,
  `plafon` varchar(255) NOT NULL,
  `bunga` int(255) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_pinjaman`
--

INSERT INTO `histori_pinjaman` (`id_history`, `jml_pinjaman`, `status`, `tenor`, `plafon`, `bunga`, `tgl_pinjaman`, `id_anggota`, `id_pinjaman`) VALUES
(43, 1000000, 'Cleared', '2021-09-23', '0', 2, '2021-04-23', 2, 55);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `username`, `password`) VALUES
(1, 'Petugas', 'petugas', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `jml_pinjaman` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `angsuran` int(255) NOT NULL,
  `tenor` date NOT NULL,
  `plafon` int(255) NOT NULL,
  `bunga` int(255) NOT NULL,
  `denda` int(255) NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jenis_jaminan` varchar(50) DEFAULT NULL,
  `jaminan_ktp` varchar(255) DEFAULT NULL,
  `jaminan_surat` varchar(255) DEFAULT NULL,
  `jaminan_pajak` varchar(255) DEFAULT NULL,
  `jaminan_stnk` varchar(255) DEFAULT NULL,
  `jaminan_foto` varchar(255) DEFAULT NULL,
  `taksiran_jaminan` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `jml_pinjaman`, `status`, `angsuran`, `tenor`, `plafon`, `bunga`, `denda`, `tgl_pinjaman`, `id_anggota`, `jenis_jaminan`, `jaminan_ktp`, `jaminan_surat`, `jaminan_pajak`, `jaminan_stnk`, `jaminan_foto`, `taksiran_jaminan`) VALUES
(55, 1000000, 'Cleared', 0, '2021-09-23', 0, 2, 0, '2021-04-23', 2, 'Tanah', '1619027111-amelie.jpg', '1619027111-Abdimas.jpg', '1619027111-Screenshot_2021-04-07_015746.png', NULL, NULL, 1500000),
(56, 1500000, 'On Going', 1530000, '2021-10-01', 0, 2, 0, '2021-05-01', 2, 'Kendaraan', '1619032165-jtp.jpg', '1619032165-bpkb.jpg', NULL, '1619032165-stnk.jpg', '1619032165-foto.jpg', NULL),
(57, 1000000, 'Cleared', 0, '2022-09-23', 0, 2, 0, '2022-04-23', 2, 'Tanah', '1619027111-amelie.jpg', '1619027111-Abdimas.jpg', '1619027111-Screenshot_2021-04-07_015746.png', NULL, NULL, 1500000),
(58, 1000000, 'Cleared', 0, '2020-09-23', 0, 2, 0, '2020-04-23', 2, 'Tanah', '1619027111-amelie.jpg', '1619027111-Abdimas.jpg', '1619027111-Screenshot_2021-04-07_015746.png', NULL, NULL, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_simpanan`
--

CREATE TABLE `riwayat_simpanan` (
  `id_riwayatSimpanan` int(11) NOT NULL,
  `nominal` int(255) NOT NULL,
  `tanggal_ambil` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_tipeSimpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_simpanan`
--

INSERT INTO `riwayat_simpanan` (`id_riwayatSimpanan`, `nominal`, `tanggal_ambil`, `id_anggota`, `id_tipeSimpanan`) VALUES
(6, 500, '2020-11-21', 2, 2),
(7, 500, '2021-01-30', 10, 2),
(8, 200, '2021-01-30', 10, 2),
(9, 1000, '2021-01-30', 10, 1),
(10, 3000, '2021-02-15', 11, 2),
(11, 2000, '2021-02-15', 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `nominal` int(255) NOT NULL,
  `tanggal_simpanan` date NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_tipeSimpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `nominal`, `tanggal_simpanan`, `id_anggota`, `id_tipeSimpanan`) VALUES
(8, 1500, '2020-11-20', 2, 1),
(9, 2000, '2020-11-20', 2, 2),
(11, 3500, '2020-11-21', 2, 2),
(14, 1500, '2020-12-01', 2, 1),
(15, 5000, '2020-12-15', 2, 3),
(16, 1000, '2021-01-30', 10, 1),
(17, 1000, '2021-01-30', 10, 2),
(18, 1500, '2021-01-20', 10, 2),
(19, 1000, '2021-01-28', 10, 3),
(20, 10500, '2021-02-15', 11, 3),
(21, 1000, '2021-02-15', 11, 3),
(22, 4000, '2021-02-15', 11, 1),
(23, 3000, '2021-02-15', 11, 2),
(24, 7000, '2021-02-15', 11, 2),
(25, 4000, '2021-02-17', 2, 3),
(26, 9990, '2021-03-02', 2, 2),
(27, 2600, '2021-03-02', 2, 2),
(28, 1000, '2021-03-15', 13, 1),
(29, 1000, '2021-03-15', 13, 3),
(30, 1000, '2021-03-14', 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status_anggota`
--

CREATE TABLE `status_anggota` (
  `status_anggota` int(11) NOT NULL,
  `statusnya` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_anggota`
--

INSERT INTO `status_anggota` (`status_anggota`, `statusnya`) VALUES
(1, 'Aktif'),
(2, 'Nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `tipe simpanan`
--

CREATE TABLE `tipe simpanan` (
  `id_tipeSimpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_simpanan`
--

CREATE TABLE `tipe_simpanan` (
  `id_tipeSimpanan` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_simpanan`
--

INSERT INTO `tipe_simpanan` (`id_tipeSimpanan`, `tipe`) VALUES
(1, 'Simpanan Wajib'),
(2, 'Simpanan Sukarela'),
(3, 'Simpanan Pokok');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `status_anggota` (`status_anggota`);

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`),
  ADD KEY `angsuran_ibfk_1` (`id_pinjaman`);

--
-- Indexes for table `histori_pinjaman`
--
ALTER TABLE `histori_pinjaman`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `histori_pinjaman_ibfk_1` (`id_anggota`),
  ADD KEY `histori_pinjaman_ibfk_2` (`id_pinjaman`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  ADD PRIMARY KEY (`id_riwayatSimpanan`),
  ADD KEY `riwayat_simpanan_ibfk_1` (`id_anggota`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `fk_tipe` (`id_tipeSimpanan`);

--
-- Indexes for table `status_anggota`
--
ALTER TABLE `status_anggota`
  ADD PRIMARY KEY (`status_anggota`);

--
-- Indexes for table `tipe simpanan`
--
ALTER TABLE `tipe simpanan`
  ADD PRIMARY KEY (`id_tipeSimpanan`);

--
-- Indexes for table `tipe_simpanan`
--
ALTER TABLE `tipe_simpanan`
  ADD PRIMARY KEY (`id_tipeSimpanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `histori_pinjaman`
--
ALTER TABLE `histori_pinjaman`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  MODIFY `id_riwayatSimpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `status_anggota`
--
ALTER TABLE `status_anggota`
  MODIFY `status_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipe simpanan`
--
ALTER TABLE `tipe simpanan`
  MODIFY `id_tipeSimpanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_simpanan`
--
ALTER TABLE `tipe_simpanan`
  MODIFY `id_tipeSimpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`status_anggota`) REFERENCES `status_anggota` (`status_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `histori_pinjaman`
--
ALTER TABLE `histori_pinjaman`
  ADD CONSTRAINT `histori_pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `histori_pinjaman_ibfk_2` FOREIGN KEY (`id_pinjaman`) REFERENCES `pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `riwayat_simpanan`
--
ALTER TABLE `riwayat_simpanan`
  ADD CONSTRAINT `riwayat_simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `fk_tipe` FOREIGN KEY (`id_tipeSimpanan`) REFERENCES `tipe_simpanan` (`id_tipeSimpanan`),
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
