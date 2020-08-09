-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for koperasi
DROP DATABASE IF EXISTS `koperasi`;
CREATE DATABASE IF NOT EXISTS `koperasi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `koperasi`;

-- Dumping structure for table koperasi.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `login_id` varchar(25) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.admin: ~1 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`login_id`, `nama`, `PASSWORD`, `level`) VALUES
	('admin', 'Fajar', '21232f297a57a5a743894a0e4a801fc3', 1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table koperasi.nasabah
DROP TABLE IF EXISTS `nasabah`;
CREATE TABLE IF NOT EXISTS `nasabah` (
  `nomor_nasabah` varchar(25) NOT NULL,
  `nama_nasabah` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(12) DEFAULT NULL,
  `no_telfon` varchar(20) DEFAULT NULL,
  `type_identitas` varchar(10) DEFAULT NULL,
  `no_identitas` int(11) DEFAULT NULL,
  `tanggal_lahir` datetime DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `Nama_bank` varchar(50) DEFAULT NULL,
  `no_rek` int(11) DEFAULT NULL,
  `gaji` int(11) DEFAULT NULL,
  `total_tabungan` int(11) DEFAULT NULL,
  `Foto_nasabah` varchar(255) DEFAULT NULL,
  `Foto_identitas` varchar(255) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`nomor_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.nasabah: ~0 rows (approximately)
DELETE FROM `nasabah`;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;

-- Dumping structure for table koperasi.pelunasan
DROP TABLE IF EXISTS `pelunasan`;
CREATE TABLE IF NOT EXISTS `pelunasan` (
  `nomor_pelunasan` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pelunasan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.pelunasan: ~0 rows (approximately)
DELETE FROM `pelunasan`;
/*!40000 ALTER TABLE `pelunasan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelunasan` ENABLE KEYS */;

-- Dumping structure for table koperasi.peminjaman
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `nomor_pinjam` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.peminjaman: ~0 rows (approximately)
DELETE FROM `peminjaman`;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table koperasi.pengajuan_pinjaman
DROP TABLE IF EXISTS `pengajuan_pinjaman`;
CREATE TABLE IF NOT EXISTS `pengajuan_pinjaman` (
  `nomor_pengajuan` varchar(10) NOT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.pengajuan_pinjaman: ~0 rows (approximately)
DELETE FROM `pengajuan_pinjaman`;
/*!40000 ALTER TABLE `pengajuan_pinjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajuan_pinjaman` ENABLE KEYS */;

-- Dumping structure for table koperasi.transaksi_tabungan
DROP TABLE IF EXISTS `transaksi_tabungan`;
CREATE TABLE IF NOT EXISTS `transaksi_tabungan` (
  `nomor_tabungan` varchar(10) NOT NULL,
  `nomor_nasabah` varchar(25) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nomor_tabungan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table koperasi.transaksi_tabungan: ~0 rows (approximately)
DELETE FROM `transaksi_tabungan`;
/*!40000 ALTER TABLE `transaksi_tabungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_tabungan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
