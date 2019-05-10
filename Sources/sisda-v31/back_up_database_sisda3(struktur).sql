-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 07:42 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisda3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bg`
--

CREATE TABLE IF NOT EXISTS `bg` (
  `id` int(2) NOT NULL,
  `hexa` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_user` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `activity` text NOT NULL,
  `url` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=673 ;

-- --------------------------------------------------------

--
-- Table structure for table `set_cat_adm_bi_ma`
--

CREATE TABLE IF NOT EXISTS `set_cat_adm_bi_ma` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `periode` varchar(25) NOT NULL,
  `jenjang` varchar(15) NOT NULL,
  `cat_adm` varchar(100) NOT NULL,
  `set_cat_adm` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `set_spp`
--

CREATE TABLE IF NOT EXISTS `set_spp` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `periode` varchar(25) NOT NULL,
  `jenjang` varchar(15) NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `ket_disc` varchar(50) NOT NULL,
  `item_byr` varchar(25) NOT NULL,
  `nominal` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=499 ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `no_sisda` int(25) NOT NULL,
  `periode` varchar(12) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `nama_siswa` varchar(250) NOT NULL,
  `nama_panggilan` varchar(250) NOT NULL,
  `nisn` varchar(250) NOT NULL,
  `ttl_tempat` varchar(250) NOT NULL,
  `ttl` date NOT NULL DEFAULT '0000-00-00',
  `jenis_kelamin` varchar(10) NOT NULL,
  `nama_ayah` varchar(250) NOT NULL,
  `nama_bunda` varchar(250) NOT NULL,
  `kat_status_anak` varchar(15) NOT NULL,
  `telp_ayah` varchar(250) NOT NULL,
  `telp_bunda` varchar(250) NOT NULL,
  `email_ortu` varchar(250) NOT NULL,
  `hub_saya_melalui` varchar(10) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kodepos` int(10) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `negara` varchar(30) NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `stat_sekolah_asal` varchar(5) NOT NULL,
  `nama_saudara` varchar(250) NOT NULL,
  `kel_sau` varchar(250) NOT NULL,
  `tanggal_daftar` date NOT NULL DEFAULT '0000-00-00',
  `gelombang_test` int(2) NOT NULL,
  `tahap1` date NOT NULL DEFAULT '0000-00-00',
  `tahap2` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_finance`
--

CREATE TABLE IF NOT EXISTS `siswa_finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_sisda` int(11) NOT NULL,
  `aktif` enum('1','2') NOT NULL DEFAULT '1',
  `nama_siswa` varchar(250) NOT NULL,
  `periode` varchar(12) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `kat_status_anak` varchar(15) NOT NULL,
  `discount_payment` varchar(15) NOT NULL,
  `pengembangan` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `peralatan` int(11) NOT NULL,
  `seragam` int(11) NOT NULL,
  `paket` int(11) NOT NULL,
  `spp` int(11) NOT NULL,
  `ks` int(11) NOT NULL,
  `zakat_mal` int(11) NOT NULL,
  `zakat_profesi` int(11) NOT NULL,
  `infaq_shodaqoh` int(11) NOT NULL,
  `wakaf` int(11) NOT NULL,
  `lainlain` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `privilege` int(2) NOT NULL,
  `priv_expl` varchar(250) NOT NULL,
  `theme` varchar(2) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;
