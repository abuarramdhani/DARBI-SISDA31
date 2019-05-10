-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2014 at 10:05 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `import_data_mentah_siswa`
--

CREATE TABLE IF NOT EXISTS `import_data_mentah_siswa` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `no_sisda` int(15) NOT NULL,
  `nisn` int(15) NOT NULL,
  `periode` varchar(15) NOT NULL,
  `tunggakan` text NOT NULL,
  `spp` varchar(15) NOT NULL,
  `nominal_spp` int(15) NOT NULL,
  `catering` varchar(30) NOT NULL,
  `nom_catering` int(15) NOT NULL,
  `supir` varchar(30) NOT NULL,
  `rute` int(1) NOT NULL,
  `tarif` int(15) NOT NULL,
  `biaya_masuk` int(15) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `nama_panggilan` varchar(15) NOT NULL,
  `jenjang` varchar(15) NOT NULL,
  `tingkat` varchar(15) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tanggal _lahir` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(200) NOT NULL,
  `kota_asal_sekolah` varchar(20) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `kerja_ayah` varchar(50) NOT NULL,
  `telepon_ayah` int(15) NOT NULL,
  `nama_ibu` varchar(30) NOT NULL,
  `kerja_ibu` varchar(15) NOT NULL,
  `telepon_ibu` int(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `anak_ke` int(2) NOT NULL,
  `jumlah_saudara` int(2) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `suku` varchar(15) NOT NULL,
  `kewarganegaraan` varchar(20) NOT NULL,
  `berat_badan` int(3) NOT NULL,
  `tinggi_badan` varchar(3) NOT NULL,
  `golongan_darah` varchar(1) NOT NULL,
  `jarak_rumah_sekolah` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1013 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
