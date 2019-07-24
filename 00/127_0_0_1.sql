-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 01:50 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telkomsel`
--
CREATE DATABASE IF NOT EXISTS `telkomsel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `telkomsel`;

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `tgl` date NOT NULL,
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `snd` decimal(25,0) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `nd_ref` text NOT NULL,
  `mail` varchar(100) NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `cicilan` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`tgl`, `id`, `nama`, `snd`, `customer`, `nd_ref`, `mail`, `nominal`, `cicilan`) VALUES
('2018-09-17', 4, 'Riyani Sufeliyati', '1809182691754', 'Yusuf Supriatna', '082128956608', 'erickyusuf@gmails.com', '20000000', '5000000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_piutang`
--

CREATE TABLE `detail_piutang` (
  `tgl` date NOT NULL,
  `kode_p` varchar(100) NOT NULL,
  `snd` varchar(50) NOT NULL,
  `grouping` text NOT NULL,
  `keterangan` text NOT NULL,
  `cp_penerima` text NOT NULL,
  `penerima` text NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `sisa` decimal(10,0) NOT NULL,
  `denda` int(3) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_piutang`
--

INSERT INTO `detail_piutang` (`tgl`, `kode_p`, `snd`, `grouping`, `keterangan`, `cp_penerima`, `penerima`, `nominal`, `bayar`, `sisa`, `denda`, `status`) VALUES
('2018-10-21', 'PTG-2757-220918', '1809182691754', 'SUDAH BAYAR', 'YBS Membayar tepat waktu', '082128956608', 'YBS', '5000000', '5000000', '0', 10, 'BAYAR(TEPAT WAKTU)'),
('2018-09-21', 'PTG-7481-190918', '1809182691754', 'SUDAH BAYAR', 'YBS membayar tepat waktu', '082128956608', 'YB', '5000000', '5000000', '0', 10, 'BAYAR(TEPAT WAKTU)'),
('2018-09-18', 'PTG-8601-190918', '1809182691754', '_', '_', '_', '_', '20000000', '20000000', '0', 0, 'Lunas(Thn. Pertama)');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `kode_p` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `kode_akun` varchar(15) NOT NULL,
  `nama_akun` text NOT NULL,
  `debet` decimal(10,0) NOT NULL,
  `kredit` decimal(10,0) NOT NULL,
  `ket` text NOT NULL,
  `snd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`kode_p`, `tgl`, `kode_akun`, `nama_akun`, `debet`, `kredit`, `ket`, `snd`) VALUES
('PTG-2757-220918BD', '2018-10-22', '1.1.1', 'Kas', '5000000', '0', '_', '1809182691754'),
('PTG-2757-220918BK', '2018-10-22', '1.1.3', 'Piutang', '0', '5000000', 'Pembayaran Piutang (tagihan cicilan) atas jasa servis Indihome kepada Yusuf Supriatna dengan SND (1809182691754) pada tanggal 22 Oktober 2018', '1809182691754'),
('PTG-2757-220918D', '2018-10-21', '1.1.3', 'Piutang', '5000000', '0', '_', '1809182691754'),
('PTG-2757-220918K', '2018-10-21', '4.1.4', 'Pendapatan Servis Indihome', '0', '5000000', 'Piutang (tagihan cicilan) atas jasa servis Indihome kepada Yusuf Supriatna dengan SND (1809182691754) pada tanggal 21 Oktober 2018', '1809182691754'),
('PTG-7481-190918BD', '2018-09-30', '1.1.1', 'Kas', '5000000', '0', '_', '1809182691754'),
('PTG-7481-190918BK', '2018-09-30', '1.1.3', 'Piutang', '0', '5000000', 'Pembayaran Piutang (tagihan cicilan) atas jasa servis Indihome kepada Yusuf Supriatna dengan SND (1809182691754) pada tanggal 30 September 2018', '1809182691754'),
('PTG-7481-190918D', '2018-09-21', '1.1.3', 'Piutang', '5000000', '0', '_', '1809182691754'),
('PTG-7481-190918K', '2018-09-21', '4.1.4', 'Pendapatan Servis Indihome', '0', '5000000', 'Piutang (tagihan cicilan) atas jasa servis Indihome kepada Yusuf Supriatna dengan SND (1809182691754) pada tanggal 21 September 2018', '1809182691754'),
('PTG-8601-190918D', '2018-09-18', '1.1.3', 'Piutang', '20000000', '0', '-', '1809182691754'),
('PTG-8601-190918K', '2018-09-18', '4.1.4', 'Pendapatan Servis Indihome', '0', '20000000', 'Pendapatan Servis Indihome kepada Yusuf Supriatna dengan no SND (1809182691754)', '1809182691754'),
('PTG-8601-190918LD', '2018-09-20', '1.1.1', 'Kas', '20000000', '0', '-', '1809182691754'),
('PTG-8601-190918LK', '2018-09-20', '1.1.3', 'Piutang', '0', '20000000', 'Pendapatan Servis Indihome kepada Yusuf Supriatna dengan no SND (1809182691754)', '1809182691754');

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `tgl` date NOT NULL,
  `nama` text NOT NULL,
  `user_npc` text NOT NULL,
  `pswd` text NOT NULL,
  `agen` text NOT NULL,
  `snd` varchar(50) NOT NULL,
  `customer` text NOT NULL,
  `nd_ref` text NOT NULL,
  `email` text NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `cicilan` decimal(10,0) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`tgl`, `nama`, `user_npc`, `pswd`, `agen`, `snd`, `customer`, `nd_ref`, `email`, `nominal`, `cicilan`, `status`) VALUES
('2018-09-18', 'Rizki Khair', 'BDG_03', 'telkom_02', 'Riyani Sufeliyati', '1809182691754', 'Yusuf Supriatna', '082128956608', 'erickyusuf@gmails.com', '20000000', '5000000', 'Lunas(Thn. Pertama)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `user_npc` varchar(10) NOT NULL,
  `pswd` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `user_npc`, `pswd`, `username`, `password`, `mail`) VALUES
(1, 'Rizki Khair', 'BDG_03', 'telkom_02', 'rizukikhair4658', '12345', 'rizkikhair4658@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_piutang`
--
ALTER TABLE `detail_piutang`
  ADD PRIMARY KEY (`kode_p`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`kode_p`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`snd`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
