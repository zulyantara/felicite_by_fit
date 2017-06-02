-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2014 at 09:58 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

DROP TABLE IF EXISTS `divisi`;
CREATE TABLE IF NOT EXISTS `divisi` (
  `divisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `divisi_ket` varchar(50) NOT NULL,
  PRIMARY KEY (`divisi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `td_id` int(11) NOT NULL AUTO_INCREMENT,
  `td_head` varchar(18) NOT NULL,
  `td_service` int(11) NOT NULL,
  `td_pegawai` varchar(10) NOT NULL,
  `td_qty` float NOT NULL,
  `td_harga` float NOT NULL,
  PRIMARY KEY (`td_id`),
  KEY `td_head` (`td_head`,`td_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_head`
--

DROP TABLE IF EXISTS `transaksi_head`;
CREATE TABLE IF NOT EXISTS `transaksi_head` (
  `th_no_faktur` varchar(18) NOT NULL,
  `th_tgl` datetime NOT NULL,
  `th_customer` varchar(50) NOT NULL,
  `th_pegawai` varchar(10) NOT NULL,
  `th_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`th_no_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
