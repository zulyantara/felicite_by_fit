-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2014 at 04:06 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `felicite_cashier`
--
CREATE DATABASE IF NOT EXISTS `felicite_cashier` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `felicite_cashier`;

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
CREATE TABLE IF NOT EXISTS `absensi` (
  `absensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `absensi_pegawai` varchar(10) NOT NULL,
  `absensi_tgl` datetime NOT NULL,
  PRIMARY KEY (`absensi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `absensi`
--

TRUNCATE TABLE `absensi`;
--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`absensi_id`, `absensi_pegawai`, `absensi_tgl`) VALUES
(1, 'p092014001', '2014-09-13 14:51:14'),
(2, 'p092014001', '2014-09-13 14:51:42'),
(3, 'p092014001', '2014-09-13 14:51:57'),
(4, 'p092014001', '2014-09-13 14:52:02'),
(5, 'p092014001', '2014-09-13 14:52:35'),
(6, 'p092014002', '2014-09-13 15:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_nama` varchar(50) NOT NULL,
  `customer_alamat` varchar(150) NOT NULL,
  `customer_telp` varchar(25) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `customer`
--

TRUNCATE TABLE `customer`;
--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_nama`, `customer_alamat`, `customer_telp`) VALUES
(1, 'umum', 'umum', '-'),
(2, 'tara', 'depok', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

DROP TABLE IF EXISTS `divisi`;
CREATE TABLE IF NOT EXISTS `divisi` (
  `divisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `divisi_ket` varchar(50) NOT NULL,
  PRIMARY KEY (`divisi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `divisi`
--

TRUNCATE TABLE `divisi`;
--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `divisi_ket`) VALUES
(1, 'Operasional');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan_ket` varchar(50) NOT NULL,
  `jabatan_divisi` int(11) NOT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `jabatan`
--

TRUNCATE TABLE `jabatan`;
--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_ket`, `jabatan_divisi`) VALUES
(1, 'staf kasir', 1),
(2, 'staf stylist', 1),
(3, 'staf creambath', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_pegawai`
--

DROP TABLE IF EXISTS `jabatan_pegawai`;
CREATE TABLE IF NOT EXISTS `jabatan_pegawai` (
  `jp_id` int(11) NOT NULL AUTO_INCREMENT,
  `jp_pegawai` varchar(10) NOT NULL,
  `jp_jabatan` int(11) NOT NULL,
  `jp_isactive` tinyint(4) NOT NULL,
  PRIMARY KEY (`jp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `jabatan_pegawai`
--

TRUNCATE TABLE `jabatan_pegawai`;
--
-- Dumping data for table `jabatan_pegawai`
--

INSERT INTO `jabatan_pegawai` (`jp_id`, `jp_pegawai`, `jp_jabatan`, `jp_isactive`) VALUES
(1, 'p092014001', 1, 1),
(2, 'p092014001', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_service`
--

DROP TABLE IF EXISTS `jenis_service`;
CREATE TABLE IF NOT EXISTS `jenis_service` (
  `js_id` int(11) NOT NULL AUTO_INCREMENT,
  `js_ket` varchar(100) NOT NULL,
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Truncate table before insert `jenis_service`
--

TRUNCATE TABLE `jenis_service`;
--
-- Dumping data for table `jenis_service`
--

INSERT INTO `jenis_service` (`js_id`, `js_ket`) VALUES
(1, 'perawatan'),
(2, 'kecantikan'),
(3, 'rambut'),
(4, 'test 1'),
(5, 'test 2'),
(6, 'test 3'),
(7, 'test 4'),
(8, 'test 6'),
(9, 'test 7'),
(10, 'test 8'),
(11, 'test 9'),
(12, 'test 10'),
(13, 'test 1');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `pegawai_id` varchar(10) NOT NULL,
  `pegawai_nama` varchar(50) NOT NULL,
  `pegawai_alamat` varchar(150) NOT NULL,
  `pegawai_telp` varchar(50) NOT NULL,
  PRIMARY KEY (`pegawai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `pegawai`
--

TRUNCATE TABLE `pegawai`;
--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `pegawai_nama`, `pegawai_alamat`, `pegawai_telp`) VALUES
('p092014001', 'zulyantara', 'kukusan', '123456789'),
('p092014002', 'eny kurniawati', 'Depok', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_nama` varchar(100) NOT NULL,
  `service_harga` float NOT NULL,
  `service_jenis` int(11) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `service`
--

TRUNCATE TABLE `service`;
--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_nama`, `service_harga`, `service_jenis`) VALUES
(1, 'test service 1', 1000, 2),
(2, 'test service 2', 3500, 1),
(3, 'test service 3', 50000, 3),
(4, 'test service 4', 10000, 13);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `td_id` int(11) NOT NULL AUTO_INCREMENT,
  `td_head` varchar(18) NOT NULL,
  `td_service` int(11) NOT NULL,
  `td_qty` float NOT NULL,
  `td_harga` float NOT NULL,
  PRIMARY KEY (`td_id`),
  KEY `td_head` (`td_head`,`td_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Truncate table before insert `transaksi_detail`
--

TRUNCATE TABLE `transaksi_detail`;
--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`td_id`, `td_head`, `td_service`, `td_qty`, `td_harga`) VALUES
(1, 'FBF/2014/09/001', 1, 3, 1000),
(2, 'FBF/2014/09/001', 2, 1, 3500),
(3, 'FBF/2014/09/001', 3, 1, 50000),
(4, 'FBF/2014/09/001', 4, 1, 10000),
(5, 'FBF/2014/09/001', 1, 1, 1000),
(6, 'FBF/2014/09/002', 1, 2, 1000),
(7, 'FBF/2014/09/002', 2, 1, 3500),
(8, 'FBF/2014/09/002', 2, 1, 3500),
(9, 'FBF/2014/09/002', 2, 1, 3500),
(10, 'FBF/2014/09/002', 2, 1, 3500),
(11, 'FBF/2014/09/002', 2, 1, 3500),
(12, 'FBF/2014/09/002', 2, 1, 3500),
(13, 'FBF/2014/09/002', 2, 1, 3500),
(14, 'FBF/2014/09/002', 2, 1, 3500),
(15, 'FBF/2014/09/002', 2, 1, 3500),
(16, 'FBF/2014/09/002', 2, 1, 3500),
(17, 'FBF/2014/09/002', 2, 1, 3500),
(18, 'FBF/2014/09/003', 1, 1, 1000),
(19, 'FBF/2014/09/003', 2, 1, 3500),
(20, 'FBF/2014/09/003', 3, 1, 50000),
(21, 'FBF/2014/09/003', 4, 1, 10000),
(22, 'FBF/2014/09/003', 4, 1, 10000),
(23, 'FBF/2014/09/004', 1, 1, 1000),
(24, 'FBF/2014/09/004', 4, 1, 10000),
(25, 'FBF/2014/09/005', 1, 1, 1000),
(26, 'FBF/2014/09/005', 2, 1, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_head`
--

DROP TABLE IF EXISTS `transaksi_head`;
CREATE TABLE IF NOT EXISTS `transaksi_head` (
  `th_no_faktur` varchar(18) NOT NULL,
  `th_tgl` datetime NOT NULL,
  `th_customer` int(11) NOT NULL,
  `th_pegawai` int(11) NOT NULL,
  `th_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`th_no_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `transaksi_head`
--

TRUNCATE TABLE `transaksi_head`;
--
-- Dumping data for table `transaksi_head`
--

INSERT INTO `transaksi_head` (`th_no_faktur`, `th_tgl`, `th_customer`, `th_pegawai`, `th_status`) VALUES
('FBF/2014/09/001', '2014-09-09 23:16:19', 2, 1, 0),
('FBF/2014/09/002', '2014-09-09 23:51:08', 2, 1, 0),
('FBF/2014/09/003', '2014-09-10 00:11:45', 2, 1, 0),
('FBF/2014/09/004', '2014-09-10 00:16:27', 2, 1, 0),
('FBF/2014/09/005', '2014-09-10 00:20:59', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_type`) VALUES
(1, 'tara', '42323b8772f2fa047cb082307d134e5e', 0),
(2, 'zulyantara', '42323b8772f2fa047cb082307d134e5e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `ul_id` int(11) NOT NULL AUTO_INCREMENT,
  `ul_ket` varchar(50) NOT NULL,
  PRIMARY KEY (`ul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `user_level`
--

TRUNCATE TABLE `user_level`;
--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`ul_id`, `ul_ket`) VALUES
(0, 'administrator'),
(1, 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `user_pegawai`
--

DROP TABLE IF EXISTS `user_pegawai`;
CREATE TABLE IF NOT EXISTS `user_pegawai` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `up_pegawai` varchar(10) NOT NULL,
  `up_user` int(11) NOT NULL,
  PRIMARY KEY (`up_id`),
  KEY `up_pegawai` (`up_pegawai`,`up_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `user_pegawai`
--

TRUNCATE TABLE `user_pegawai`;
--
-- Dumping data for table `user_pegawai`
--

INSERT INTO `user_pegawai` (`up_id`, `up_pegawai`, `up_user`) VALUES
(1, 'p092014001', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
