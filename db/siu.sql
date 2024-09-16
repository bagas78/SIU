-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 04:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siu`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `absen_id` int(11) NOT NULL,
  `absen_karyawan` int(11) DEFAULT NULL,
  `absen_upah` text DEFAULT NULL,
  `absen_jam` time DEFAULT NULL,
  `absen_tanggal` date DEFAULT NULL,
  `absen_status` enum('masuk','tidak') DEFAULT NULL,
  `absen_bayar` enum('sudah','belum') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`absen_id`, `absen_karyawan`, `absen_upah`, `absen_jam`, `absen_tanggal`, `absen_status`, `absen_bayar`) VALUES
(34, 2, '55000', '11:46:42', '2024-03-12', 'masuk', 'belum'),
(35, 2, '55000', '11:46:42', '2024-04-12', 'masuk', 'belum'),
(36, 2, '55000', '11:46:42', '2024-05-12', 'masuk', 'belum'),
(37, 3, '70000', '11:53:57', '2024-03-12', 'masuk', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `t_bahan`
--

CREATE TABLE `t_bahan` (
  `bahan_id` int(11) NOT NULL,
  `bahan_kode` text NOT NULL,
  `bahan_nama` text NOT NULL,
  `bahan_satuan` text NOT NULL,
  `bahan_kategori` set('utama','pembantu') NOT NULL,
  `bahan_harga` text NOT NULL,
  `bahan_tanggal` date NOT NULL DEFAULT curdate(),
  `bahan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan`
--

INSERT INTO `t_bahan` (`bahan_id`, `bahan_kode`, `bahan_nama`, `bahan_satuan`, `bahan_kategori`, `bahan_harga`, `bahan_tanggal`, `bahan_hapus`) VALUES
(28, 'BH001', 'GALVALUME 0.20 X 914', '', 'utama', '16300', '2024-01-25', 0),
(29, 'BH002', 'GALVALUME 0.23 X 914', '', 'utama', '15800', '2024-01-25', 0),
(30, 'BH003', 'GALVALUME 0.27 X 914', '', 'utama', '15400', '2024-01-25', 0),
(31, 'BH004', 'GALVALUME 0.33 X 914', '', 'utama', '15200', '2024-01-25', 0),
(32, 'BH005', 'PPGL MAROON 0.23 X 914', '', 'utama', '15900', '2024-01-25', 0),
(33, 'BH006', 'PPGL HIJAU 0.23 X 914', '', 'utama', '15850', '2024-01-25', 0),
(34, 'BH007', 'PPGL BIRU 0.33 X 914', '', 'utama', '15050', '2024-01-25', 0),
(35, 'BH008', 'PPGL HIJAU 0.20 X 914', '', 'utama', '16250', '2024-01-25', 0),
(36, 'BH009', 'PPGL BIRU 0.23 X 914', '', 'utama', '15900', '2024-01-25', 0),
(37, 'BH0010', 'PPGL BIRU 0.27 X 914', '', 'utama', '15350', '2024-01-25', 0),
(38, 'BH0011', 'PPGL MAROON 0.20 X 914', '', 'utama', '16350', '2024-01-25', 0),
(39, 'BH0012', 'PPGL BIRU 0.20 X 914', '', 'utama', '16350', '2024-01-25', 0),
(40, 'BH0013', 'PPGL MAROON 0.27 X 914', '', 'utama', '15450', '2024-01-25', 0),
(41, 'BH0014', 'INDOLUM 0.40 BMT X 101', '', 'utama', '15350', '2024-01-25', 0),
(42, 'BH0015', 'INDOLUM 0.45 BMT X 101', '', 'utama', '15150', '2024-01-25', 0),
(43, 'BH0016', 'INDOLUM 0.50 BMT X 152', '', 'utama', '15000', '2024-01-25', 0),
(44, 'BH0017', 'INDOLUM 0.55 BMT X 152', '', 'utama', '14900', '2024-01-25', 0),
(45, 'BH0018', 'INDOLUM 0.60 BMT X 152', '', 'utama', '14800', '2024-01-25', 0),
(46, 'BH0019', 'INDOLUM 0.65 BMT X 152', '', 'utama', '14700', '2024-01-25', 0),
(47, 'BH0020', 'INDOLUM 0.70 BMT X 152', '', 'utama', '14600', '2024-01-25', 0),
(48, 'BH0021', 'ZINIUM 0.25 BMT X 101', '', 'utama', '17900', '2024-01-25', 0),
(49, 'BH0022', 'ZINIUM 0.70 BMT X 152', '', 'utama', '15900', '2024-01-25', 0),
(50, 'BH0023', 'INDOLUM 0.70 BMT X 152', '', 'utama', '14550', '2024-01-25', 0),
(51, 'BH0024', ' ZINIUM 0.20 BMT X 101', '', 'utama', '19600', '2024-01-25', 0),
(52, 'BH0025', 'PPGL MAROON 0.33 X 914', '', 'utama', '17492', '2024-02-27', 0),
(53, 'BH0026', 'PPGL HIJAU 0.27 X 914', '', 'utama', '17770', '2024-02-27', 0),
(54, 'BH0027', 'PPGL HIJAU 0.33 X 914', '', 'utama', '17492', '2024-02-27', 0),
(55, 'BH0028', 'PPGL HIJAU 0.22 X 914', '', 'utama', '16000', '2024-04-04', 0),
(56, 'BH0029', 'GALVALUM BMT 0.35 AZ100', '', 'utama', '56000', '2024-04-05', 0),
(57, 'BH0030', 'PPGL BIRU 0.22 X 914', '', 'utama', '15900', '2024-05-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_bahan_gudang`
--

CREATE TABLE `t_bahan_gudang` (
  `bahan_gudang_id` int(11) NOT NULL,
  `bahan_gudang_bahan` text NOT NULL,
  `bahan_gudang_gudang` text DEFAULT NULL,
  `bahan_gudang_berat_permeter` decimal(20,2) DEFAULT NULL COMMENT 'Berat permeter ',
  `bahan_gudang_berat` decimal(20,2) DEFAULT NULL COMMENT 'Stok berat bahan baku',
  `bahan_gudang_panjang` decimal(20,2) DEFAULT NULL COMMENT 'Stok panjang bahan baku',
  `bahan_gudang_hpp` decimal(20,2) DEFAULT NULL,
  `bahan_gudang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan_gudang`
--

INSERT INTO `t_bahan_gudang` (`bahan_gudang_id`, `bahan_gudang_bahan`, `bahan_gudang_gudang`, `bahan_gudang_berat_permeter`, `bahan_gudang_berat`, `bahan_gudang_panjang`, `bahan_gudang_hpp`, `bahan_gudang_tanggal`) VALUES
(12, '28', '0', '0.00', '0.00', '0.00', '0.00', '2024-06-18'),
(13, '29', '0', '2.21', '8840.00', '4006.00', '17100.90', '2024-06-18'),
(14, '28', '2', '0.00', '0.00', '0.00', '0.00', '2024-06-21'),
(15, '29', '2', '0.00', '0.00', '0.00', '0.00', '2024-06-21'),
(16, '30', '2', '0.00', '0.00', '0.00', '0.00', '2024-06-21'),
(17, '32', '2', '2.00', '100.00', '50.00', '15900.00', '2024-06-22'),
(18, '31', '0', '2.36', '12048.00', '5097.00', '16037.92', '2024-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `t_bahan_item`
--

CREATE TABLE `t_bahan_item` (
  `bahan_item_id` int(11) NOT NULL,
  `bahan_item_gudang` text NOT NULL,
  `bahan_item_bahan` text NOT NULL,
  `bahan_item_kode` text DEFAULT NULL,
  `bahan_item_berat` decimal(20,2) DEFAULT NULL,
  `bahan_item_panjang` decimal(20,2) DEFAULT NULL,
  `bahan_item_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan_item`
--

INSERT INTO `t_bahan_item` (`bahan_item_id`, `bahan_item_gudang`, `bahan_item_bahan`, `bahan_item_kode`, `bahan_item_berat`, `bahan_item_panjang`, `bahan_item_tanggal`) VALUES
(22, '0', '28', 'GV-1', '0.00', '0.00', '2024-06-18'),
(23, '0', '29', 'GV-1', '0.00', '0.00', '2024-06-18'),
(24, '0', '29', 'GV-2', '0.00', '0.00', '2024-06-21'),
(25, '2', '28', 'A1', '0.00', '0.00', '2024-06-21'),
(26, '2', '29', 'A2', '0.00', '0.00', '2024-06-21'),
(27, '2', '29', 'A3', '0.00', '0.00', '2024-06-21'),
(28, '2', '29', 'A4', '0.00', '0.00', '2024-06-21'),
(29, '2', '30', 'A5', '0.00', '0.00', '2024-06-21'),
(30, '2', '32', 'MM001', '20.00', '10.00', '2024-06-22'),
(31, '2', '32', 'MM002', '20.00', '10.00', '2024-06-22'),
(32, '2', '32', 'MM003', '20.00', '10.00', '2024-06-22'),
(33, '2', '32', 'MM004', '20.00', '10.00', '2024-06-22'),
(34, '2', '32', 'MM005', '20.00', '10.00', '2024-06-22'),
(35, '0', '29', 'GRTU 223805', '4420.00', '2003.00', '2024-06-25'),
(36, '0', '29', 'GRTU 223806', '4420.00', '2003.00', '2024-06-25'),
(37, '0', '31', 'LQZH1375FT', '4024.00', '1700.00', '2024-07-09'),
(38, '0', '31', 'LWZH1371FT', '4012.00', '1698.00', '2024-07-09'),
(39, '0', '31', 'LWZH1373FT', '4012.00', '1699.00', '2024-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

CREATE TABLE `t_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_kode` text NOT NULL,
  `bank_nama` text NOT NULL,
  `bank_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bank`
--

INSERT INTO `t_bank` (`bank_id`, `bank_kode`, `bank_nama`, `bank_tanggal`) VALUES
(1, '002', 'BANK BRI', '2022-11-30'),
(2, '003', 'BANK EKSPOR INDONESIA', '2022-11-30'),
(3, '008', 'BANK MANDIRI', '2022-11-30'),
(4, '009', 'BANK BNI', '2022-11-30'),
(5, '427', 'BANK BNI SYARIAH', '2022-11-30'),
(6, '011', 'BANK DANAMON', '2022-11-30'),
(7, '013', 'PERMATA BANK', '2022-11-30'),
(8, '014', 'BANK BCA', '2022-11-30'),
(9, '016', 'BANK BII', '2022-11-30'),
(10, '019', 'BANK PANIN', '2022-11-30'),
(11, '020', 'BANK ARTA NIAGA KENCANA', '2022-11-30'),
(12, '022', 'BANK NIAGA', '2022-11-30'),
(13, '023', 'BANK BUANA IND', '2022-11-30'),
(14, '026', 'BANK LIPPO', '2022-11-30'),
(15, '028', 'BANK NISP', '2022-11-30'),
(16, '030', 'AMERICAN EXPRESS BANK LTD', '2022-11-30'),
(17, '031', 'CITIBANK N.A.', '2022-11-30'),
(18, '032', 'JP. MORGAN CHASE BANK, N.A.', '2022-11-30'),
(19, '033', 'BANK OF AMERICA, N.A', '2022-11-30'),
(20, '034', 'ING INDONESIA BANK', '2022-11-30'),
(21, '036', 'BANK MULTICOR TBK.', '2022-11-30'),
(22, '037', 'BANK ARTHA GRAHA', '2022-11-30'),
(23, '039', 'BANK CREDIT AGRICOLE INDOSUEZ', '2022-11-30'),
(24, '040', 'THE BANGKOK BANK COMP. LTD', '2022-11-30'),
(25, '041', 'THE HONGKONG & SHANGHAI B.C.', '2022-11-30'),
(26, '042', 'THE BANK OF TOKYO MITSUBISHI UFJ LTD', '2022-11-30'),
(27, '045', 'BANK SUMITOMO MITSUI INDONESIA', '2022-11-30'),
(28, '046', 'BANK DBS INDONESIA', '2022-11-30'),
(29, '047', 'BANK RESONA PERDANIA', '2022-11-30'),
(30, '048', 'BANK MIZUHO INDONESIA', '2022-11-30'),
(31, '050', 'STANDARD CHARTERED BANK', '2022-11-30'),
(32, '052', 'BANK ABN AMRO', '2022-11-30'),
(33, '053', 'BANK KEPPEL TATLEE BUANA', '2022-11-30'),
(34, '054', 'BANK CAPITAL INDONESIA, TBK.', '2022-11-30'),
(35, '057', 'BANK BNP PARIBAS INDONESIA', '2022-11-30'),
(36, '058', 'BANK UOB INDONESIA', '2022-11-30'),
(37, '059', 'KOREA EXCHANGE BANK DANAMON', '2022-11-30'),
(38, '060', 'RABOBANK INTERNASIONAL INDONESIA', '2022-11-30'),
(39, '061', 'ANZ PANIN BANK', '2022-11-30'),
(40, '067', 'DEUTSCHE BANK AG.', '2022-11-30'),
(41, '068', 'BANK WOORI INDONESIA', '2022-11-30'),
(42, '069', 'BANK OF CHINA LIMITED', '2022-11-30'),
(43, '076', 'BANK BUMI ARTA', '2022-11-30'),
(44, '087', 'BANK EKONOMI', '2022-11-30'),
(45, '088', 'BANK ANTARDAERAH', '2022-11-30'),
(46, '089', 'BANK HAGA', '2022-11-30'),
(47, '093', 'BANK IFI', '2022-11-30'),
(48, '095', 'BANK CENTURY, TBK.', '2022-11-30'),
(49, '097', 'BANK MAYAPADA', '2022-11-30'),
(50, '110', 'BANK JABAR', '2022-11-30'),
(51, '111', 'BANK DKI', '2022-11-30'),
(52, '112', 'BPD DIY', '2022-11-30'),
(53, '113', 'BANK JATENG', '2022-11-30'),
(54, '114', 'BANK JATIM', '2022-11-30'),
(55, '115', 'BPD JAMBI', '2022-11-30'),
(56, '116', 'BPD ACEH', '2022-11-30'),
(57, '117', 'BANK SUMUT', '2022-11-30'),
(58, '118', 'BANK NAGARI', '2022-11-30'),
(59, '119', 'BANK RIAU', '2022-11-30'),
(60, '120', 'BANK SUMSEL', '2022-11-30'),
(61, '121', 'BANK LAMPUNG', '2022-11-30'),
(62, '122', 'BPD KALSEL', '2022-11-30'),
(63, '123', 'BPD KALIMANTAN BARAT', '2022-11-30'),
(64, '124', 'BPD KALTIM', '2022-11-30'),
(65, '125', 'BPD KALTENG', '2022-11-30'),
(66, '126', 'BPD SULSEL', '2022-11-30'),
(67, '127', 'BANK SULUT', '2022-11-30'),
(68, '128', 'BPD NTB', '2022-11-30'),
(69, '129', 'BPD BALI', '2022-11-30'),
(70, '130', 'BANK NTT', '2022-11-30'),
(71, '131', 'BANK MALUKU', '2022-11-30'),
(72, '132', 'BPD PAPUA', '2022-11-30'),
(73, '133', 'BANK BENGKULU', '2022-11-30'),
(74, '134', 'BPD SULAWESI TENGAH', '2022-11-30'),
(75, '135', 'BANK SULTRA', '2022-11-30'),
(76, '145', 'BANK NUSANTARA PARAHYANGAN', '2022-11-30'),
(77, '146', 'BANK SWADESI', '2022-11-30'),
(78, '147', 'BANK MUAMALAT', '2022-11-30'),
(79, '151', 'BANK MESTIKA', '2022-11-30'),
(80, '152', 'BANK METRO EXPRESS', '2022-11-30'),
(81, '153', 'BANK SHINTA INDONESIA', '2022-11-30'),
(82, '157', 'BANK MASPION', '2022-11-30'),
(83, '159', 'BANK HAGAKITA', '2022-11-30'),
(84, '161', 'BANK GANESHA', '2022-11-30'),
(85, '162', 'BANK WINDU KENTJANA', '2022-11-30'),
(86, '164', 'HALIM INDONESIA BANK', '2022-11-30'),
(87, '166', 'BANK HARMONI INTERNATIONAL', '2022-11-30'),
(88, '167', 'BANK KESAWAN', '2022-11-30'),
(89, '200', 'BANK TABUNGAN NEGARA (PERSERO)', '2022-11-30'),
(90, '212', 'BANK HIMPUNAN SAUDARA 1906, TBK .', '2022-11-30'),
(91, '213', 'BANK TABUNGAN PENSIUNAN NASIONAL', '2022-11-30'),
(92, '405', 'BANK SWAGUNA', '2022-11-30'),
(93, '422', 'BANK JASA ARTA', '2022-11-30'),
(94, '426', 'BANK MEGA', '2022-11-30'),
(95, '427', 'BANK JASA JAKARTA', '2022-11-30'),
(96, '441', 'BANK BUKOPIN', '2022-11-30'),
(97, '451', 'BANK SYARIAH MANDIRI', '2022-11-30'),
(98, '459', 'BANK BISNIS INTERNASIONAL', '2022-11-30'),
(99, '466', 'BANK SRI PARTHA', '2022-11-30'),
(100, '472', 'BANK JASA JAKARTA', '2022-11-30'),
(101, '484', 'BANK BINTANG MANUNGGAL', '2022-11-30'),
(102, '485', 'BANK BUMIPUTERA', '2022-11-30'),
(103, '490', 'BANK YUDHA BHAKTI', '2022-11-30'),
(104, '491', 'BANK MITRANIAGA', '2022-11-30'),
(105, '494', 'BANK AGRO NIAGA', '2022-11-30'),
(106, '498', 'BANK INDOMONEX', '2022-11-30'),
(107, '501', 'BANK ROYAL INDONESIA', '2022-11-30'),
(108, '503', 'BANK ALFINDO', '2022-11-30'),
(109, '506', 'BANK SYARIAH MEGA', '2022-11-30'),
(110, '513', 'BANK INA PERDANA', '2022-11-30'),
(111, '517', 'BANK HARFA', '2022-11-30'),
(112, '520', 'PRIMA MASTER BANK', '2022-11-30'),
(113, '521', 'BANK PERSYARIKATAN INDONESIA', '2022-11-30'),
(114, '525', 'BANK AKITA', '2022-11-30'),
(115, '526', 'LIMAN INTERNATIONAL BANK', '2022-11-30'),
(116, '531', 'ANGLOMAS INTERNASIONAL BANK', '2022-11-30'),
(117, '523', 'BANK DIPO INTERNATIONAL', '2022-11-30'),
(118, '535', 'BANK KESEJAHTERAAN EKONOMI', '2022-11-30'),
(119, '536', 'BANK UIB', '2022-11-30'),
(120, '542', 'BANK ARTOS IND', '2022-11-30'),
(121, '547', 'BANK PURBA DANARTA', '2022-11-30'),
(122, '548', 'BANK MULTI ARTA SENTOSA', '2022-11-30'),
(123, '553', 'BANK MAYORA', '2022-11-30'),
(124, '555', 'BANK INDEX SELINDO', '2022-11-30'),
(125, '566', 'BANK VICTORIA INTERNATIONAL', '2022-11-30'),
(126, '558', 'BANK EKSEKUTIF', '2022-11-30'),
(127, '559', 'CENTRATAMA NASIONAL BANK', '2022-11-30'),
(128, '562', 'BANK FAMA INTERNASIONAL', '2022-11-30'),
(129, '564', 'BANK SINAR HARAPAN BALI', '2022-11-30'),
(130, '567', 'BANK HARDA', '2022-11-30'),
(131, '945', 'BANK FINCONESIA', '2022-11-30'),
(132, '946', 'BANK MERINCORP', '2022-11-30'),
(133, '947', 'BANK MAYBANK INDOCORP', '2022-11-30'),
(134, '948', 'BANK OCBC – INDONESIA', '2022-11-30'),
(135, '949', 'BANK CHINA TRUST INDONESIA', '2022-11-30'),
(136, '950', 'BANK COMMONWEALTH', '2022-11-30'),
(137, '425', 'BANK BJB SYARIAH', '2022-11-30'),
(138, '688', 'BPR KS (KARYAJATNIKA SEDAYA)', '2022-11-30'),
(139, '789', 'INDOSAT DOMPETKU', '2022-11-30'),
(140, '911', 'TELKOMSEL TCASH', '2022-11-30'),
(141, '911', 'LINKAJA', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `t_cetak`
--

CREATE TABLE `t_cetak` (
  `cetak_id` int(11) NOT NULL,
  `cetak_user` int(11) NOT NULL,
  `cetak_level` int(11) NOT NULL,
  `cetak_jumlah` int(11) NOT NULL DEFAULT 0,
  `cetak_setujui` int(11) DEFAULT 0,
  `cetak_berhasil` int(11) NOT NULL DEFAULT 0,
  `cetak_nomor` text NOT NULL,
  `cetak_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_cetak`
--

INSERT INTO `t_cetak` (`cetak_id`, `cetak_user`, `cetak_level`, `cetak_jumlah`, `cetak_setujui`, `cetak_berhasil`, `cetak_nomor`, `cetak_tanggal`) VALUES
(15, 5, 3, 33, 0, 2, 'PR-18062024-1', '2024-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `t_coa`
--

CREATE TABLE `t_coa` (
  `coa_id` int(11) NOT NULL,
  `coa_nomor` text NOT NULL,
  `coa_akun` text NOT NULL,
  `coa_sub` text NOT NULL,
  `coa_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_coa`
--

INSERT INTO `t_coa` (`coa_id`, `coa_nomor`, `coa_akun`, `coa_sub`, `coa_tanggal`) VALUES
(1, '112', 'Kas', '1', '2023-01-27'),
(2, '113', 'Piutang', '1', '2023-01-27'),
(3, '114', 'Stok produk', '1', '2023-01-27'),
(4, '115', 'Stok bahan baku', '1', '2023-01-27'),
(6, '122', 'Utang', '2', '2023-01-27'),
(7, '132', 'Saldo', '3', '2023-01-27'),
(8, '142', 'Penjualan produk', '4', '2023-01-27'),
(9, '152', 'Biaya produksi', '5', '2023-01-27'),
(10, '153', 'Penyesuaian stok', '5', '2023-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `t_coa_sub`
--

CREATE TABLE `t_coa_sub` (
  `coa_sub_id` int(11) NOT NULL,
  `coa_sub_nomor` text NOT NULL,
  `coa_sub_akun` text NOT NULL,
  `coa_sub_plus` text NOT NULL,
  `coa_sub_min` text NOT NULL,
  `coa_sub_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_coa_sub`
--

INSERT INTO `t_coa_sub` (`coa_sub_id`, `coa_sub_nomor`, `coa_sub_akun`, `coa_sub_plus`, `coa_sub_min`, `coa_sub_tanggal`) VALUES
(1, '111', 'Harta', 'D', 'K', '2023-01-27'),
(2, '121', 'Utang', 'K', 'D', '2023-01-27'),
(3, '131', 'Modal', 'K', 'D', '2023-01-27'),
(4, '141', 'Pendapatan', 'K', 'D', '2023-01-27'),
(5, '151', 'Beban', 'D', 'K', '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_ekspedisi`
--

CREATE TABLE `t_ekspedisi` (
  `ekspedisi_id` int(11) NOT NULL,
  `ekspedisi_kode` varchar(255) DEFAULT NULL,
  `ekspedisi_nama` varchar(255) DEFAULT NULL,
  `ekspedisi_keterangan` text DEFAULT NULL,
  `ekspedisi_hapus` int(2) DEFAULT 0,
  `ekspedisi_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_ekspedisi`
--

INSERT INTO `t_ekspedisi` (`ekspedisi_id`, `ekspedisi_kode`, `ekspedisi_nama`, `ekspedisi_keterangan`, `ekspedisi_hapus`, `ekspedisi_tanggal`) VALUES
(1, 'EXPEDISI-001', 'EKONOMI', 'Jalur Gaza', 1, '2023-08-12'),
(2, 'EXPEDISI-002', 'CARGO EXPRESS ABC', 'Jalur Selat Malaka', 1, '2023-11-10'),
(3, 'ABC', 'TEST', NULL, 1, '2023-12-17'),
(4, 'EKS01', 'PT. MANDALIKA PUTRA TRANS', NULL, 0, '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `t_filter`
--

CREATE TABLE `t_filter` (
  `filter_id` int(11) NOT NULL,
  `filter_nomor` text DEFAULT NULL,
  `filter_produksi` text DEFAULT NULL,
  `filter_barang` text DEFAULT NULL,
  `filter_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_filter`
--

INSERT INTO `t_filter` (`filter_id`, `filter_nomor`, `filter_produksi`, `filter_barang`, `filter_tanggal`) VALUES
(200, 'SO-21082024-2', '105', '9', '2024-09-16'),
(201, 'SO-21082024-2', '106', '6', '2024-09-16'),
(202, 'SO-21082024-3', '108', '12', '2024-09-16'),
(203, 'SO-21082024-3', '109', '10', '2024-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `t_gudang`
--

CREATE TABLE `t_gudang` (
  `gudang_id` int(11) NOT NULL,
  `gudang_kode` varchar(255) DEFAULT NULL,
  `gudang_nama` varchar(255) DEFAULT NULL,
  `gudang_keterangan` text DEFAULT NULL,
  `gudang_hapus` int(2) DEFAULT 0,
  `gudang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_gudang`
--

INSERT INTO `t_gudang` (`gudang_id`, `gudang_kode`, `gudang_nama`, `gudang_keterangan`, `gudang_hapus`, `gudang_tanggal`) VALUES
(1, 'GD000', 'Gudang Utama', NULL, 0, '0000-00-00'),
(2, 'GD001', 'Gudang A', NULL, 0, '2023-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `t_jurnal`
--

CREATE TABLE `t_jurnal` (
  `jurnal_id` int(11) NOT NULL,
  `jurnal_nomor` text NOT NULL,
  `jurnal_akun` text NOT NULL,
  `jurnal_keterangan` text NOT NULL,
  `jurnal_type` enum('debit','kredit') NOT NULL,
  `jurnal_nominal` text NOT NULL,
  `jurnal_hapus` int(11) NOT NULL DEFAULT 0,
  `jurnal_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jurnal`
--

INSERT INTO `t_jurnal` (`jurnal_id`, `jurnal_nomor`, `jurnal_akun`, `jurnal_keterangan`, `jurnal_type`, `jurnal_nominal`, `jurnal_hapus`, `jurnal_tanggal`) VALUES
(1, 'PB-27092023-2', '4', 'stok bahan baku', 'debit', '148000', 0, '2023-09-27'),
(2, 'PB-27092023-2', '6', 'utang ( pembelian bahan  )', 'kredit', '148000', 0, '2023-09-27'),
(3, 'PR-09102023-1', '9', 'biaya produksi', 'debit', '40000', 0, '2023-10-09'),
(4, 'PR-09102023-1', '4', 'stok bahan baku', 'kredit', '40000', 0, '2023-10-09'),
(5, 'PR-10102023-1', '9', 'biaya produksi', 'debit', '40000', 0, '2023-10-10'),
(6, 'PR-10102023-1', '4', 'stok bahan baku', 'kredit', '40000', 0, '2023-10-10'),
(7, 'PR-10102023-1', '9', 'biaya produksi', 'debit', '42000', 0, '2023-10-10'),
(8, 'PR-10102023-1', '4', 'stok bahan baku', 'kredit', '42000', 0, '2023-10-10'),
(9, 'PR-10102023-1', '9', 'biaya produksi', 'debit', '39000', 0, '2023-10-10'),
(10, 'PR-10102023-1', '4', 'stok bahan baku', 'kredit', '39000', 0, '2023-10-10'),
(11, 'PB-10102023-3', '4', 'stok bahan baku', 'debit', '2000000', 0, '2023-10-10'),
(12, 'PB-10102023-3', '1', 'kas ( pembelian bahan  )', 'kredit', '2000000', 0, '2023-10-10'),
(13, 'PR-10102023-1', '9', 'biaya produksi', 'debit', '147000', 0, '2023-10-10'),
(14, 'PR-10102023-1', '4', 'stok bahan baku', 'kredit', '147000', 0, '2023-10-10'),
(15, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '37000', 0, '2023-10-11'),
(16, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '37000', 0, '2023-10-11'),
(17, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '75000', 0, '2023-10-11'),
(18, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '75000', 0, '2023-10-11'),
(19, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '37100', 0, '2023-10-11'),
(20, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '37100', 0, '2023-10-11'),
(21, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '0', 0, '2023-10-11'),
(22, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '0', 0, '2023-10-11'),
(23, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '37000', 0, '2023-10-11'),
(24, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '37000', 0, '2023-10-11'),
(25, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '37000', 0, '2023-10-11'),
(26, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '37000', 0, '2023-10-11'),
(27, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '47000', 0, '2023-10-11'),
(28, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '47000', 0, '2023-10-11'),
(29, 'PR-11102023-1', '9', 'biaya produksi', 'debit', '38000', 0, '2023-10-11'),
(30, 'PR-11102023-1', '4', 'stok bahan baku', 'kredit', '38000', 0, '2023-10-11'),
(31, 'PB-17102023-1', '4', 'stok bahan baku', 'debit', '485000', 0, '2023-10-17'),
(32, 'PB-17102023-1', '1', 'kas ( pembelian bahan  )', 'kredit', '485000', 0, '2023-10-17'),
(33, 'PB-17102023-1', '4', 'stok bahan baku', 'debit', '1850000', 0, '2023-10-17'),
(34, 'PB-17102023-1', '1', 'kas ( pembelian bahan  )', 'kredit', '1850000', 0, '2023-10-17'),
(35, 'PB-17102023-2', '4', 'stok bahan baku', 'debit', '3850000', 0, '2023-10-17'),
(36, 'PB-17102023-2', '6', 'utang ( pembelian bahan  )', 'kredit', '3850000', 0, '2023-10-17'),
(37, 'PB-18102023-1', '4', 'stok bahan baku', 'debit', '3850000', 0, '2023-10-18'),
(38, 'PB-18102023-1', '1', 'kas ( pembelian bahan  )', 'kredit', '3850000', 0, '2023-10-18'),
(39, 'PB-18102023-2', '4', 'stok bahan baku', 'debit', '1850000', 0, '2023-10-18'),
(40, 'PB-18102023-2', '1', 'kas ( pembelian bahan  )', 'kredit', '1850000', 0, '2023-10-18'),
(41, 'PB-06112023-3', '4', 'stok bahan baku', 'debit', '1850000', 0, '2023-11-06'),
(42, 'PB-06112023-3', '1', 'kas ( pembelian bahan  )', 'kredit', '1850000', 0, '2023-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `t_kartu`
--

CREATE TABLE `t_kartu` (
  `kartu_id` int(11) NOT NULL,
  `kartu_gudang` text NOT NULL,
  `kartu_jenis` set('pembelian','produksi','penjualan') NOT NULL,
  `kartu_transaksi` set('masuk','keluar') NOT NULL,
  `kartu_nomor` text DEFAULT NULL,
  `kartu_barang` text DEFAULT NULL,
  `kartu_kode` text DEFAULT NULL,
  `kartu_barang_nama` text DEFAULT NULL,
  `kartu_satuan` text DEFAULT NULL,
  `kartu_jumlah` decimal(20,2) DEFAULT NULL,
  `kartu_saldo` decimal(20,2) DEFAULT NULL,
  `kartu_tanggal` date DEFAULT NULL,
  `kartu_jam` time DEFAULT NULL,
  `kartu_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kartu`
--

INSERT INTO `t_kartu` (`kartu_id`, `kartu_gudang`, `kartu_jenis`, `kartu_transaksi`, `kartu_nomor`, `kartu_barang`, `kartu_kode`, `kartu_barang_nama`, `kartu_satuan`, `kartu_jumlah`, `kartu_saldo`, `kartu_tanggal`, `kartu_jam`, `kartu_hapus`) VALUES
(87, '0', 'pembelian', 'masuk', 'PB-12062024-1', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '0.00', NULL, '2024-06-12', '00:39:30', 0),
(88, '0', 'pembelian', 'masuk', 'PB-12062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-12', '00:39:30', 0),
(89, '0', 'pembelian', 'masuk', 'PB-12062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '50.00', NULL, '2024-06-12', '00:39:30', 0),
(95, '0', 'pembelian', 'masuk', 'PB-13062024-5', '33', 'BH006', 'PPGL HIJAU 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-13', '07:59:05', 0),
(121, '0', 'pembelian', 'masuk', 'PB-13062024-4', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '10.00', NULL, '2024-06-13', '07:56:36', 0),
(122, '0', 'pembelian', 'masuk', 'PB-13062024-4', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '10.00', NULL, '2024-06-13', '07:56:36', 0),
(123, '0', 'pembelian', 'masuk', 'PB-13062024-4', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '10.00', NULL, '2024-06-13', '07:56:36', 0),
(124, '0', 'pembelian', 'masuk', 'PB-13062024-4', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '0.00', NULL, '2024-06-13', '07:56:36', 0),
(125, '0', 'pembelian', 'masuk', 'PB-13062024-4', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '0.00', NULL, '2024-06-13', '07:56:36', 0),
(160, '0', 'pembelian', 'masuk', 'PB-12062024-3', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-12', '02:10:43', 0),
(181, '0', 'pembelian', 'masuk', 'PB-12062024-2', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '0.00', NULL, '2024-06-12', '02:07:55', 0),
(182, '0', 'pembelian', 'masuk', 'PB-12062024-2', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '0.00', NULL, '2024-06-12', '02:07:55', 0),
(185, '0', 'pembelian', 'masuk', 'PB-13062024-6', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '2003.00', NULL, '2024-06-13', '09:16:23', 0),
(186, '0', 'pembelian', 'masuk', 'PB-13062024-6', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '0.00', NULL, '2024-06-13', '09:16:23', 0),
(197, '0', 'pembelian', 'masuk', 'PB-14062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-14', '22:47:16', 0),
(198, '0', 'pembelian', 'masuk', 'PB-14062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-14', '22:47:16', 0),
(207, '0', 'pembelian', 'masuk', 'PB-17062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-17', '00:43:01', 0),
(208, '0', 'pembelian', 'masuk', 'PB-17062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-17', '00:43:01', 0),
(231, '0', 'pembelian', 'masuk', 'PB-17062024-2', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '60.00', NULL, '2024-06-17', '02:30:29', 0),
(232, '0', 'pembelian', 'masuk', 'PB-17062024-2', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '180.00', '180.00', '2024-06-17', '02:30:29', 0),
(237, '0', 'pembelian', 'masuk', 'PB-18062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '70.00', NULL, '2024-06-18', '11:12:31', 0),
(238, '0', 'pembelian', 'masuk', 'PB-18062024-1', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '60.00', '240.00', '2024-06-18', '11:12:31', 0),
(249, '0', 'produksi', 'keluar', 'PR-18062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '20.00', NULL, '2024-06-19', '11:21:33', 0),
(250, '0', 'produksi', 'masuk', 'PR-18062024-1', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '100.00', NULL, '2024-06-19', '11:21:33', 0),
(251, '0', 'produksi', 'masuk', 'PR-18062024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '100.00', NULL, '2024-06-19', '11:21:33', 0),
(266, '0', 'pembelian', 'masuk', 'PB-20062024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-20', '10:46:10', 0),
(267, '0', 'pembelian', 'masuk', 'PB-20062024-1', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-20', '10:46:10', 0),
(314, '2', 'pembelian', 'masuk', 'PB-21062024-2', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '0.00', NULL, '2024-06-21', '08:03:03', 0),
(315, '2', 'pembelian', 'masuk', 'PB-21062024-2', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-21', '08:03:03', 0),
(316, '2', 'pembelian', 'masuk', 'PB-21062024-2', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-21', '08:03:03', 0),
(317, '2', 'pembelian', 'masuk', 'PB-21062024-2', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-21', '08:03:03', 0),
(318, '2', 'pembelian', 'masuk', 'PB-21062024-2', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '0.00', NULL, '2024-06-21', '08:03:03', 0),
(324, '2', 'pembelian', 'masuk', 'PB-22062024-3', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-22', '07:59:30', 0),
(325, '2', 'pembelian', 'masuk', 'PB-22062024-3', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-22', '07:59:30', 0),
(326, '2', 'pembelian', 'masuk', 'PB-22062024-3', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-22', '07:59:30', 0),
(327, '2', 'pembelian', 'masuk', 'PB-22062024-3', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-22', '07:59:30', 0),
(328, '2', 'pembelian', 'masuk', 'PB-22062024-3', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '0.00', NULL, '2024-06-22', '07:59:30', 0),
(334, '0', 'pembelian', 'masuk', 'PB-25062024-6', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-25', '14:41:27', 0),
(335, '0', 'pembelian', 'masuk', 'PB-25062024-6', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '0.00', '240.00', '2024-06-25', '14:41:27', 0),
(336, '0', 'produksi', 'keluar', 'PR-25062024-3', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '500.00', '-260.00', '2024-06-25', '14:47:01', 0),
(337, '0', 'produksi', 'masuk', 'PR-25062024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '500.00', NULL, '2024-06-25', '14:47:01', 0),
(338, '0', 'penjualan', 'keluar', 'PJ-25062024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '500.00', NULL, '2024-06-25', '14:47:01', 0),
(339, '0', 'penjualan', 'keluar', 'PJ-21062024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '20.00', NULL, '2024-06-21', '10:39:42', 0),
(340, '0', 'penjualan', 'keluar', 'PJ-21062024-1', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '30.00', NULL, '2024-06-21', '10:39:42', 0),
(341, '0', 'penjualan', 'keluar', 'PJ-21062024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '20.00', NULL, '2024-06-21', '10:39:42', 0),
(342, '0', 'penjualan', 'keluar', 'PJ-21062024-1', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '30.00', NULL, '2024-06-21', '10:39:42', 0),
(343, '2', 'produksi', 'keluar', 'PR-22062024-2', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '8.00', NULL, '2024-07-04', '08:02:21', 0),
(344, '2', 'produksi', 'masuk', 'PR-22062024-2', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '2.00', NULL, '2024-07-04', '08:02:21', 0),
(345, '2', 'produksi', 'masuk', 'PR-22062024-2', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '2.00', NULL, '2024-07-04', '08:02:21', 0),
(346, '2', 'produksi', 'masuk', 'PR-22062024-2', '13', 'MP008', 'SPANDEK MAROON 0.40', 'Mtr', '2.00', NULL, '2024-07-04', '08:02:21', 0),
(347, '2', 'produksi', 'masuk', 'PR-22062024-2', '10', 'MP005', 'SPANDEK MAROON 0.25', 'Mtr', '2.00', NULL, '2024-07-04', '08:02:21', 0),
(348, '0', 'pembelian', 'masuk', 'PB-09072024-7', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '0.00', NULL, '2024-07-09', '10:18:38', 0),
(349, '0', 'pembelian', 'masuk', 'PB-09072024-7', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '0.00', NULL, '2024-07-09', '10:18:38', 0),
(350, '0', 'pembelian', 'masuk', 'PB-09072024-7', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '0.00', NULL, '2024-07-09', '10:18:38', 0),
(351, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '0.00', NULL, '2024-07-11', '14:56:32', 0),
(352, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '22500.00', NULL, '2024-07-11', '14:56:32', 0),
(353, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '45000.00', NULL, '2024-07-11', '14:56:32', 0),
(354, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '3600.00', NULL, '2024-07-11', '14:56:32', 0),
(355, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '9', 'MP004', 'SPANDEK SILVER 0.40', 'Mtr', '60.00', NULL, '2024-07-11', '14:56:32', 0),
(356, '0', 'penjualan', 'keluar', 'PJ-11072024-3', '9', 'MP004', 'SPANDEK SILVER 0.40', 'Mtr', '35.00', NULL, '2024-07-11', '14:56:32', 0),
(357, '0', 'penjualan', 'keluar', 'PJ-11072024-4', '9', 'MP004', 'SPANDEK SILVER 0.40', 'Mtr', '0.00', NULL, '2024-07-11', '14:56:56', 0),
(358, '0', 'penjualan', 'keluar', 'PJ-11072024-4', '9', 'MP004', 'SPANDEK SILVER 0.40', 'Mtr', '5000.00', NULL, '2024-07-11', '14:56:56', 0),
(359, '0', 'produksi', 'keluar', 'PR-11072024-6', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '100.00', NULL, '2024-07-11', '15:23:49', 0),
(360, '0', 'produksi', 'masuk', 'PR-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '0.00', NULL, '2024-07-11', '15:23:49', 0),
(361, '0', 'produksi', 'masuk', 'PR-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '52.50', NULL, '2024-07-11', '15:23:49', 0),
(362, '0', 'penjualan', 'keluar', 'PJ-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '0.00', NULL, '2024-07-11', '15:23:49', 0),
(363, '0', 'penjualan', 'keluar', 'PJ-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '0.00', NULL, '2024-07-11', '15:23:49', 0),
(364, '0', 'penjualan', 'keluar', 'PJ-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '0.00', NULL, '2024-07-11', '15:23:49', 0),
(365, '0', 'penjualan', 'keluar', 'PJ-11072024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '52.50', NULL, '2024-07-11', '15:23:49', 0),
(366, '0', 'produksi', 'keluar', 'PR-11072024-5', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '52.50', NULL, '2024-07-12', '15:22:16', 0),
(367, '0', 'produksi', 'masuk', 'PR-11072024-5', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '0.00', NULL, '2024-07-12', '15:22:16', 0),
(368, '0', 'produksi', 'masuk', 'PR-11072024-5', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '52.50', NULL, '2024-07-12', '15:22:16', 0),
(430, '0', 'produksi', 'keluar', 'SO-19082024-1', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '10.00', NULL, '2024-08-19', '07:25:21', 0),
(431, '0', 'produksi', 'masuk', 'SO-19082024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '15.00', NULL, '2024-08-19', '07:25:21', 0),
(432, '0', 'produksi', 'masuk', 'SO-19082024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '20.00', NULL, '2024-08-19', '07:25:21', 0),
(439, '0', 'produksi', 'keluar', 'SO-21082024-1', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '10.00', NULL, '2024-08-21', '21:02:01', 0),
(440, '0', 'produksi', 'masuk', 'SO-21082024-1', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '25.00', NULL, '2024-08-21', '21:02:01', 0),
(441, '0', 'produksi', 'masuk', 'SO-21082024-1', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '30.00', NULL, '2024-08-21', '21:02:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_nama` text NOT NULL,
  `karyawan_telp` text NOT NULL,
  `karyawan_alamat` text NOT NULL,
  `karyawan_tanggal` date NOT NULL DEFAULT curdate(),
  `karyawan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`karyawan_id`, `karyawan_nama`, `karyawan_telp`, `karyawan_alamat`, `karyawan_tanggal`, `karyawan_hapus`) VALUES
(6, 'Joe doe', '08111', 'tes', '2023-09-01', 1),
(7, 'ABC', '213123', 'Makassar', '2023-12-17', 1),
(10, 'AMIN', '0', 'MAROS', '2024-01-26', 1),
(11, 'AMIN', '0', 'MAROS', '2024-01-26', 0),
(12, 'IQBAL', '0', 'MAROS', '2024-01-26', 0),
(13, 'YUSUF', '0', 'MAROS', '2024-01-26', 0),
(14, 'HERI', '0', 'MAROS', '2024-01-26', 0),
(15, 'YUNI', '0', 'MAKASSAR', '2024-01-26', 0),
(16, 'TIRA', '0', 'MAROS', '2024-01-26', 0),
(17, 'ANTO', '0', '-', '2024-02-20', 0),
(18, 'VALEN', '0', '-', '2024-02-20', 0),
(19, 'JACK', '0', '-', '2024-02-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_kontak`
--

CREATE TABLE `t_kontak` (
  `kontak_id` int(11) NOT NULL,
  `kontak_jenis` set('s','p') NOT NULL,
  `kontak_kode` text NOT NULL,
  `kontak_nama` text NOT NULL,
  `kontak_alamat` text NOT NULL,
  `kontak_tlp` text NOT NULL,
  `kontak_email` text NOT NULL,
  `kontak_rek` text NOT NULL,
  `kontak_bank` text NOT NULL,
  `kontak_npwp` text NOT NULL,
  `kontak_tanggal` date NOT NULL DEFAULT curdate(),
  `kontak_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kontak`
--

INSERT INTO `t_kontak` (`kontak_id`, `kontak_jenis`, `kontak_kode`, `kontak_nama`, `kontak_alamat`, `kontak_tlp`, `kontak_email`, `kontak_rek`, `kontak_bank`, `kontak_npwp`, `kontak_tanggal`, `kontak_hapus`) VALUES
(16, 's', 'SP001', 'UD Jaya Makmur TEST', 'sby', '08123', 'jayamakmur@tes.com', '123', '1', '123', '2023-08-31', 1),
(17, 'p', 'PL001', 'Pak Bambang ABC', 'Jl. Merdeka Selatan 123', '08222', 'bambang@contoh.com', '123', '3', '321', '2023-09-01', 1),
(18, 's', 'SP002', 'TEST12345', 'ABC', '213231', 'boswil@gmail.com', '212313', '1', '123', '2023-12-17', 1),
(19, 's', 'SP001', 'ABC', 'Mjong', '213', 'boswil@gmail.com', '21323', '1', '132123', '2023-12-17', 1),
(20, 'p', 'PL001', 'TREMBESI SUKSES CEMERLANG', 'KOMPLEK PATTENE BUSINES PARK, EE, 1, PABBENTENGAN, MARUSU, KAB MAROS', '0', 'boswil@gmail.com', '0', '8', '84.137.464.8-809.000', '2023-12-17', 0),
(22, 's', 'SP001', 'HONOR INDONESIA METAL', 'JALAN RAYA OLEK KP. KALATURAM RT 001 RW 002 GUDANG 03 DESA SENTUL KEC BALARAJA KABUPATEN TANGERANG SELATAN', '0', '', '1683177770', '8', '-', '2024-01-25', 0),
(23, 's', 'SP005', 'LEX METAL INDONESIA', 'JALAN PLUIT INDAH RAYA NO 168 B-G JEC PENJARINGAN JAKARTA UTARA 14450', '0', '', '1686339000', '8', '-', '2024-01-25', 0),
(24, 's', 'SP006', 'LEASEN NEW MATERIAL STEEL', 'JALAN PLUIT SELATAN RAYA BLOK Q, PLUIT PENJARINGAN JAKARTA UTARA, INDONESIA 14450', '0', '', '1688900301', '8', '-', '2024-01-25', 0),
(25, 's', 'SP007', 'SUNRISE STEEL', 'JL BY PASS KM 54 DESA/KEL JAMPIROGO KEC SOOKO MOJOKERTO', '0', '', '0501912424', '8', '-', '2024-01-25', 0),
(26, 's', 'SP008', 'UPKING STEEL INDONESIA', 'JL RAYA SERANG KM 19.5 RT 012/RW 002 DESA SUKANEGARA KEC CIKUPA 15710', '0', '', '5205012998', '8', '-', '2024-01-25', 0),
(27, 'p', 'PL003', 'UMUM/CASH', 'MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(28, 'p', 'PL004', 'CV. MITRA AGUNG PERKASA', 'JL. PONEGORO NO. 63 MAKASSAR', '0', '', '0', '1', '71.553.180.2-801.000', '2024-01-25', 0),
(29, 'p', 'PL005', 'CV. ALTIMETRIK MKS', 'YUSUF BAUTY PERUM CITRA GARDEN ', '0', '', '0', '8', '96.647.382.9-807.000', '2024-01-25', 0),
(30, 'p', 'PL006', 'TIGA MENARA SULAWESI', 'KAYANA ROYAL MANSION JL JATI LAPONGKODA TEMPE KAB WAJO', '0', '', '0', '1', '95.725.042.6-808.001', '2024-01-25', 0),
(31, 'p', 'PL007', 'KARYA BARU SENTOSA', 'PANGERAN DIPONEGORO NO 51 MAKASSAR', '0', '', '0', '1', '84.260.228.6-801.000', '2024-01-25', 0),
(32, 'p', 'PL008', 'BAKUNG', 'PARE-PARE', '0', '', '0', '1', '-', '2024-01-25', 0),
(33, 'p', 'PL009', 'MAJU JAYA', 'TAKALAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(34, 'p', 'PL0010', 'MITRA BANGUNAN', 'BULUDOANG', '0', '', '0', '1', '-', '2024-01-25', 0),
(35, 'p', 'PL0011', 'SINAR MUDA', 'PINRANG', '0', '', '0', '1', '-', '2024-01-25', 0),
(36, 'p', 'PL0012', 'ADI JAYA BANGUNAN', 'TAKALAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(37, 'p', 'PL0013', 'BAJA UTAMA', 'ANTANG', '0', '', '0', '1', '-', '2024-01-25', 0),
(38, 'p', 'PL0014', 'H HAMID', 'BONE', '0', '', '0', '1', '-', '2024-01-25', 0),
(39, 'p', 'PL0015', 'MAS ARIF GYPSUM', 'TAKALAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(40, 'p', 'PL0016', 'MITRA PAMANJENGAN', 'MONCONGLOE POROS PAMANJENGAN', '0', '', '0', '1', '-', '2024-01-25', 0),
(41, 'p', 'PL0017', 'SURYA BARU S SADDANG', 'SUNGAI SADDANG BARU MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(42, 'p', 'PL0018', 'ANUGERAH KAYU', 'DAENG RAMANG MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(43, 'p', 'PL0019', 'AMANAH MANDIRI', 'MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(44, 'p', 'PL0020', 'AMANDA JAYA BANGUNAN', 'VILLA MUTIARA MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(45, 'p', 'PL0021', 'ASOKA', 'BAROMBONG', '0', '', '0', '1', '-', '2024-01-25', 0),
(46, 'p', 'PL0022', 'BAROMBONG JAYA', 'BAROMBONG', '0', '', '0', '1', '-', '2024-01-25', 0),
(47, 'p', 'PL0023', 'BINA FATRAH', 'PACCERAKKANG MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(48, 'p', 'PL0024', 'BUMINDO JAYA', 'BTP MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(49, 'p', 'PL0025', 'CIPTA BUANA', 'PONGTIKU MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(50, 'p', 'PL0026', 'GALESONG JAYA', 'GALESONG', '0', '', '0', '1', '-', '2024-01-25', 0),
(51, 'p', 'PL0027', 'HARAPAN BANGUNAN', 'PERINTIS MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(52, 'p', 'PL0028', 'JANGKAR EFATA', 'BAROMBONG', '0', '', '0', '1', '-', '2024-01-25', 0),
(53, 'p', 'PL0029', 'KURNIA JAYA', 'KARIANGO', '0', '', '0', '1', '-', '2024-01-25', 0),
(54, 'p', 'PL0030', 'MATAHARI', 'BALLAPATI MONCONGLOE', '0', '', '0', '1', '-', '2024-01-25', 0),
(55, 'p', 'PL0031', 'MITRA ASRI', 'TAMANGAPA RAYA 3 ANTANG', '0', '', '0', '1', '-', '2024-01-25', 0),
(56, 'p', 'PL0032', 'RAJA SALMAN', 'BONE', '0', '', '0', '1', '-', '2024-01-25', 0),
(57, 'p', 'PL0033', 'SINAR MUJUR', 'ALAUDDIN MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(58, 'p', 'PL0034', 'TAMANGAPA JAYA', 'ANTANG MAKASSAR', '0', '', '0', '1', '-', '2024-01-25', 0),
(59, 'p', 'PL0035', 'TODURI', 'ABUBAKAR LAMBOGO', '0', '', '0', '1', '-', '2024-01-25', 0),
(60, 'p', 'PL0036', 'WILI BAJA MANDIRI', '0', '0', '', '0', '1', '-', '2024-01-25', 0),
(61, 'p', 'PL0037', 'SURYA BARU ANTANG', 'ANTANG', '0', '', '0', '1', '-', '2024-02-20', 0),
(62, 'p', 'PL0038', 'BENGKEL KARYA MUDA', 'MAKASSAR', '0', '', '0', '1', '-', '2024-02-20', 0),
(63, 'p', 'PL0039', 'KARYA GYPSUM', 'MONCONGLOE', '0', '', '0', '1', '-', '2024-02-24', 0),
(64, 'p', 'PL0040', 'CAHAYA BARU', 'BAROMBONG', '0', '', '0', '1', '-', '2024-02-24', 0),
(65, 'p', 'PL0041', 'SUKSES JAYA', 'TANJUNG ALANG', '0', '', '0', '1', '-', '2024-02-24', 0),
(66, 'p', 'PL0042', 'JAYA SAKTI', 'RAJAWALI', '0', '', '0', '1', '-', '2024-03-02', 0),
(67, 'p', 'PL0043', 'CITRA MANDIRI', 'RANTEPAO', '0', '', '0', '1', '-', '2024-03-02', 0),
(68, 'p', 'PL0044', 'KAWAGUCHI', 'PERINTIS MAKASSAR', '0', '', '0', '1', '-', '2024-03-02', 0),
(69, 'p', 'PL0045', 'JATI MAKMUR', 'BARUGA NIPA2', '0', '', '0', '1', '-', '2024-03-02', 0),
(70, 'p', 'PL0046', 'SUMBER CAHAYA BANGUNAN', 'DANGKO', '0', '', '0', '1', '-', '2024-03-02', 0),
(71, 'p', 'PL0047', 'TRANSITO BANGUNAN', 'MAKASSAR', '0', '', '0', '1', '-', '2024-03-02', 0),
(72, 'p', 'PL0048', 'USAHA MANDIRI', 'MAKASSAR', '0', '', '0', '1', '-', '2024-03-02', 0),
(73, 'p', 'PL0049', 'MEGA QUEEN', 'BAHAMATEVE', '0', '', '0', '1', '-', '2024-03-02', 0),
(74, 'p', 'PL0050', 'TIGA PUTRA', 'POROS MAKASSAR MAROS', '0', '', '0', '1', '-', '2024-03-02', 0),
(75, 'p', 'PL0051', 'NUH BANGUNAN', 'ANDI TONRO GOWA', '0', '', '0', '1', '-', '2024-03-02', 0),
(76, 'p', 'PL0052', 'SEDERHANA', 'KROASU', '0', '', '0', '1', '-', '2024-03-02', 0),
(77, 'p', 'PL0053', 'SELVI', 'SUDU ENREKANG', '0', '', '0', '1', '-', '2024-03-02', 0),
(78, 'p', 'PL0054', 'UD HAFIS', 'BONE', '0', '', '0', '1', '-', '2024-03-02', 0),
(79, 'p', 'PL0055', 'SUMBER MAKMUR CEMERLANG', 'POROS TANETEA BONTOSUNGGU GOWA', '0', '', '0', '1', '-', '2024-03-02', 0),
(80, 'p', 'PL0056', 'PT. DIKA MUNCUL JAYA', 'MAKASSAR', '0', '', '0', '1', '02.825.888.7-615.000', '2024-03-02', 0),
(81, 'p', 'PL0057', 'SURYA MAS', 'PONGTIKU MAKASSAR', '0', '', '0', '1', '-', '2024-03-02', 0),
(82, 'p', 'PL0058', 'SINAR AGUNG', 'MALENGKERI', '0', '', '0', '1', '-', '2024-03-02', 0),
(83, 'p', 'PL0059', 'SUMBER REJEKI', 'MAKASSAR', '0', '', '0', '1', '-', '2024-03-02', 0),
(84, 'p', 'PL0060', 'MULYA JAYA', 'JENEPONTO', '0', '', '0', '1', '-', '2024-03-02', 0),
(85, 'p', 'PL0061', 'ATIRAH BANGUNAN', 'MAWANG', '0', '', '0', '1', '-', '2024-03-02', 0),
(86, 'p', 'PL0062', 'CAHAYA LOGAM', 'ANTANG MAKASSAR', '0', '', '0', '1', '-', '2024-03-08', 0),
(87, 'p', 'PL0063', 'BERKAH UTAMA', 'MAKASSAR', '0', '', '0', '1', '-', '2024-03-09', 0),
(88, 'p', 'PL0064', 'RANGA BANGUNAN', 'TAENG', '0', '', '0', '1', '-', '2024-03-12', 0),
(89, 'p', 'PL0065', 'PT. CAHAYA CEMERLANG', 'SUNGAI CEREKANG MAKASSAR', '0', '', '0', '1', '01.125.517.1-812.000', '2024-03-15', 0),
(90, 'p', 'PL0066', 'PT. RAFI MANDIRI SEJAHTERA', 'HARMONY RESIDENCE SAMATA BANTAENG', '0', '', '0', '1', '96.411.150.4-807.000', '2024-03-15', 0),
(91, 'p', 'PL0067', 'LESTARI', 'MAKASSAR', '0', '', '0', '1', '-', '2024-03-15', 0),
(92, 's', 'SP009', 'GRAHA BINTANG METALINDO', 'JL PU NO 40 MAKASSAR', '0', '', '0', '1', '-', '2024-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_level`
--

CREATE TABLE `t_level` (
  `level_id` int(11) NOT NULL,
  `level_nama` text DEFAULT NULL,
  `level_akses` text DEFAULT NULL,
  `level_tanggal` date DEFAULT curdate(),
  `level_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_level`
--

INSERT INTO `t_level` (`level_id`, `level_nama`, `level_akses`, `level_tanggal`, `level_hapus`) VALUES
(3, 'Kasir', '{\"nama\":\"Kasir\",\"menu_dashboard\":\"0\",\"menu_kontak\":\"0\",\"karyawan\":\"0\",\"karyawan_add\":\"0\",\"karyawan_del\":\"0\",\"supplier\":\"0\",\"supplier_add\":\"0\",\"supplier_del\":\"0\",\"pelanggan\":\"0\",\"pelanggan_add\":\"0\",\"pelanggan_del\":\"0\",\"rekening\":\"0\",\"rekening_add\":\"0\",\"rekening_del\":\"0\",\"menu_pembelian\":\"0\",\"bahan\":\"1\",\"bahan_add\":\"0\",\"bahan_del\":\"0\",\"bahan_po\":\"1\",\"bahan_po_add\":\"1\",\"bahan_po_del\":\"1\",\"pembelian_bahan\":\"1\",\"pembelian_bahan_add\":\"1\",\"pembelian_bahan_del\":\"1\",\"pembelian_umum\":\"1\",\"pembelian_umum_add\":\"1\",\"pembelian_umum_del\":\"1\",\"hutang\":\"1\",\"hutang_add\":\"1\",\"menu_produksi\":\"0\",\"mesin\":\"0\",\"mesin_add\":\"0\",\"mesin_del\":\"0\",\"peleburan\":\"0\",\"peleburan_add\":\"0\",\"peleburan_del\":\"0\",\"produksi\":\"0\",\"produksi_add\":\"0\",\"produksi_del\":\"0\",\"pewarnaan\":\"0\",\"pewarnaan_add\":\"0\",\"pewarnaan_del\":\"0\",\"packing\":\"0\",\"packing_add\":\"0\",\"packing_del\":\"0\",\"menu_produk\":\"0\",\"jenis_pewarnaan\":\"0\",\"jenis_pewarnaan_add\":\"0\",\"warna_produk\":\"0\",\"warna_produk_add\":\"0\",\"warna_produk_del\":\"0\",\"master_produk\":\"1\",\"master_produk_add\":\"0\",\"master_produk_del\":\"0\",\"menu_penjualan\":\"0\",\"penjualan_po\":\"1\",\"penjualan_po_add\":\"1\",\"penjualan_po_del\":\"1\",\"penjualan_produk\":\"1\",\"penjualan_produk_add\":\"1\",\"penjualan_produk_del\":\"1\",\"piutang\":\"1\",\"piutang_add\":\"1\",\"menu_keuangan\":\"0\",\"coa\":\"0\",\"coa_add\":\"0\",\"coa_del\":\"0\",\"kas\":\"0\",\"kas_add\":\"0\",\"kas_del\":\"0\",\"jurnal\":\"0\",\"jurnal_add\":\"0\",\"jurnal_del\":\"0\",\"buku_besar\":\"0\",\"buku_besar_add\":\"0\",\"buku_besar_del\":\"0\",\"penyesuaian\":\"0\",\"penyesuaian_add\":\"0\",\"penyesuaian_del\":\"0\",\"menu_laporan\":\"0\",\"laporan_bahan\":\"1\",\"laporan_produk\":\"1\",\"laporan_produksi\":\"0\",\"laporan_pembelian_po\":\"1\",\"laporan_pembelian\":\"1\",\"laporan_hutang\":\"1\",\"laporan_hutang_jatuh_tampo\":\"1\",\"laporan_penjualan\":\"1\",\"laporan_piutang\":\"1\",\"laporan_piutang_jatuh_tampo\":\"1\",\"laporan_packing\":\"0\",\"menu_inventori\":\"0\",\"opname_pembelian\":\"0\",\"opname_penjualan\":\"0\",\"penyesuaian_stok\":\"0\",\"penyesuaian_stok_add\":\"0\",\"penyesuaian_stok_del\":\"0\",\"menu_akun\":\"0\",\"akses\":\"0\",\"akses_add\":\"0\",\"akses_del\":\"0\",\"user_akun\":\"0\",\"user_akun_add\":\"0\",\"user_akun_del\":\"0\",\"admin_akun\":\"0\",\"admin_akun_add\":\"0\",\"admin_akun_del\":\"0\",\"menu_pengaturan\":\"0\",\"pajak\":\"0\",\"pajak_add\":\"0\",\"backup\":\"0\",\"informasi\":\"0\"}', '2023-06-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_logo`
--

CREATE TABLE `t_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_foto` text NOT NULL,
  `logo_nama` text NOT NULL,
  `logo_telp` text NOT NULL,
  `logo_kota` text NOT NULL,
  `logo_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_logo`
--

INSERT INTO `t_logo` (`logo_id`, `logo_foto`, `logo_nama`, `logo_telp`, `logo_kota`, `logo_alamat`) VALUES
(1, '8070be03d83f8954076632975a7c8429.jpg', 'WEB APLIKASI SIU', '021-7980421', 'Jakarta', 'JL. Raya Pasar Minggu No. 17 Jakarta Selatan 12520');

-- --------------------------------------------------------

--
-- Table structure for table `t_mesin`
--

CREATE TABLE `t_mesin` (
  `mesin_id` int(11) NOT NULL,
  `mesin_kode` text NOT NULL,
  `mesin_nama` text NOT NULL,
  `mesin_hapus` int(11) NOT NULL DEFAULT 0,
  `mesin_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_mesin`
--

INSERT INTO `t_mesin` (`mesin_id`, `mesin_kode`, `mesin_nama`, `mesin_hapus`, `mesin_tanggal`) VALUES
(6, 'VS002', 'MESIN CANAL', 0, '2023-06-20'),
(7, 'VS001', 'MESIN SPANDEK 5 GELOMBANG', 0, '2023-12-17'),
(8, 'VS003', 'MESIN HOLLOW 2X4', 0, '2024-01-25'),
(9, 'VS004', 'MESIN RENG', 0, '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `t_pajak`
--

CREATE TABLE `t_pajak` (
  `pajak_id` int(11) NOT NULL,
  `pajak_jenis` enum('pembelian','penjualan') NOT NULL,
  `pajak_persen` text NOT NULL,
  `pajak_tanggal` date NOT NULL DEFAULT curdate(),
  `pajak_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pajak`
--

INSERT INTO `t_pajak` (`pajak_id`, `pajak_jenis`, `pajak_persen`, `pajak_tanggal`, `pajak_update`) VALUES
(1, 'pembelian', '11', '2022-12-03', '2022-12-02 17:49:05'),
(2, 'penjualan', '11', '2022-12-03', '2022-12-02 17:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_jumlah` int(11) NOT NULL DEFAULT 0 COMMENT '0 = belum, 1 = sebagian, 2 = selesai',
  `pembelian_proses` int(11) NOT NULL DEFAULT 0,
  `pembelian_po` int(11) NOT NULL DEFAULT 0,
  `pembelian_po_tanggal` date DEFAULT NULL,
  `pembelian_user` text NOT NULL,
  `pembelian_nomor` text NOT NULL,
  `pembelian_supplier` text NOT NULL,
  `pembelian_ekspedisi` text NOT NULL,
  `pembelian_gudang` text NOT NULL,
  `pembelian_tanggal` date NOT NULL DEFAULT curdate(),
  `pembelian_jam` time NOT NULL DEFAULT current_timestamp(),
  `pembelian_jatuh_tempo` date NOT NULL,
  `pembelian_status` enum('lunas','belum') NOT NULL COMMENT 'l = lunas | b = belum lunas',
  `pembelian_pelunasan` text DEFAULT NULL,
  `pembelian_pelunasan_keterangan` text NOT NULL,
  `pembelian_pembayaran` text DEFAULT NULL,
  `pembelian_keterangan` text NOT NULL,
  `pembelian_lampiran` text NOT NULL,
  `pembelian_subtotal` text DEFAULT NULL,
  `pembelian_ekspedisi_total` text DEFAULT NULL,
  `pembelian_ppn` text DEFAULT NULL,
  `pembelian_grandtotal` text DEFAULT NULL,
  `pembelian_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_jumlah`, `pembelian_proses`, `pembelian_po`, `pembelian_po_tanggal`, `pembelian_user`, `pembelian_nomor`, `pembelian_supplier`, `pembelian_ekspedisi`, `pembelian_gudang`, `pembelian_tanggal`, `pembelian_jam`, `pembelian_jatuh_tempo`, `pembelian_status`, `pembelian_pelunasan`, `pembelian_pelunasan_keterangan`, `pembelian_pembayaran`, `pembelian_keterangan`, `pembelian_lampiran`, `pembelian_subtotal`, `pembelian_ekspedisi_total`, `pembelian_ppn`, `pembelian_grandtotal`, `pembelian_hapus`) VALUES
(11, 2, 0, 0, '2024-06-20', '5', 'PB-20062024-1', '22', '4', '0', '2024-06-20', '10:46:10', '0000-00-00', 'lunas', NULL, '', 'tunai', 'PO di proses', '', '190', '20000', '0', '3072000', 0),
(12, 5, 0, 0, '2024-06-21', '5', 'PB-21062024-2', '24', '4', '2', '2024-06-21', '08:03:03', '0000-00-00', 'lunas', NULL, '', 'tunai', '', '', '30', '0', '11', '470000', 0),
(13, 5, 1, 1, '2024-06-22', '5', 'PB-22062024-3', '92', '4', '2', '2024-06-22', '07:59:30', '0000-00-00', 'lunas', NULL, '', 'tunai', '', '', '40', '0', '11', '636000', 0),
(14, 2, 0, 1, '2024-06-25', '5', 'PB-25062024-4', '23', '4', '0', '2024-06-25', '08:42:01', '2024-07-25', 'belum', NULL, '', '7', '', '', '8850', '11500000', '11', '151330000', 0),
(15, 2, 0, 1, '2024-06-25', '5', 'PB-25062024-4', '23', '4', '0', '2024-06-25', '08:42:03', '2024-07-25', 'belum', NULL, '', '7', '', '', '8850', '11500000', '11', '151330000', 0),
(16, 2, 1, 1, '2024-06-25', '5', 'PB-25062024-6', '22', '4', '0', '2024-06-25', '14:41:27', '2024-07-25', 'belum', NULL, '', '7', '', '', '8840', '11500000', '11', '151172000', 0),
(17, 3, 1, 1, '2024-07-09', '5', 'PB-09072024-7', '24', '4', '0', '2024-07-09', '10:18:38', '2024-07-22', 'belum', NULL, '', '7', '', '', '12048', '11700000', '11', '193224800', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_terima` int(11) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = belum di terima, 1 = di terima',
  `pembelian_barang_nomor` text NOT NULL,
  `pembelian_barang_barang` text NOT NULL,
  `pembelian_barang_kode` text NOT NULL,
  `pembelian_barang_berat_qty` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_panjang_qty` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_berat` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_panjang` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_berat_cek` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_panjang_cek` decimal(20,2) NOT NULL DEFAULT 0.00,
  `pembelian_barang_harga` text NOT NULL,
  `pembelian_barang_total` text NOT NULL,
  `pembelian_barang_ekspedisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_terima`, `pembelian_barang_nomor`, `pembelian_barang_barang`, `pembelian_barang_kode`, `pembelian_barang_berat_qty`, `pembelian_barang_panjang_qty`, `pembelian_barang_berat`, `pembelian_barang_panjang`, `pembelian_barang_berat_cek`, `pembelian_barang_panjang_cek`, `pembelian_barang_harga`, `pembelian_barang_total`, `pembelian_barang_ekspedisi`) VALUES
(1, 0, 'PB-20062024-1', '28', 'GV-1', '1.11', '0.90', '100.00', '90.00', '0.00', '0.00', '16300', '1630000', '10526.315789474'),
(2, 0, 'PB-20062024-1', '29', 'GV-2', '1.29', '0.78', '90.00', '70.00', '0.00', '0.00', '15800', '1422000', '9473.6842105263'),
(3, 0, 'PB-21062024-2', '30', 'A5', '1.00', '1.00', '10.00', '10.00', '0.00', '0.00', '15400', '154000', '0'),
(4, 0, 'PB-21062024-2', '29', 'A4', '1.00', '1.00', '10.00', '10.00', '0.00', '0.00', '15800', '158000', '0'),
(5, 0, 'PB-21062024-2', '29', 'A3', '1.00', '1.00', '10.00', '10.00', '0.00', '0.00', '15800', '158000', '0'),
(6, 0, 'PB-21062024-2', '29', 'A2', '1.00', '1.00', '10.00', '10.00', '0.00', '0.00', '15800', '158000', '0'),
(7, 0, 'PB-21062024-2', '28', 'A1', '1.00', '1.00', '10.00', '10.00', '0.00', '0.00', '16300', '163000', '0'),
(8, 1, 'PB-22062024-3', '32', 'MM005', '2.00', '0.50', '20.00', '10.00', '0.00', '0.00', '15900', '318000', '0'),
(9, 1, 'PB-22062024-3', '32', 'MM004', '2.00', '0.50', '20.00', '10.00', '0.00', '0.00', '15900', '318000', '0'),
(10, 1, 'PB-22062024-3', '32', 'MM003', '2.00', '0.50', '20.00', '10.00', '0.00', '0.00', '15900', '318000', '0'),
(11, 1, 'PB-22062024-3', '32', 'MM002', '2.00', '0.50', '20.00', '10.00', '0.00', '0.00', '15900', '318000', '0'),
(12, 1, 'PB-22062024-3', '32', 'MM001', '2.00', '0.50', '20.00', '10.00', '0.00', '0.00', '15900', '318000', '0'),
(13, 0, 'PB-25062024-4', '29', 'GRTU 220583', '2.21', '0.45', '4420.00', '2003.00', '0.00', '0.00', '15800', '69836000', '5743502.8248588'),
(14, 0, 'PB-25062024-4', '29', 'Grtu 220584', '2.21', '0.45', '4430.00', '2004.00', '0.00', '0.00', '15800', '69994000', '5756497.1751412'),
(15, 1, 'PB-25062024-6', '29', 'GRTU 223806', '2.21', '0.45', '4420.00', '2003.00', '0.00', '0.00', '15800', '69836000', '5750000'),
(16, 1, 'PB-25062024-6', '29', 'GRTU 223805', '2.21', '0.45', '4420.00', '2003.00', '0.00', '0.00', '15800', '69836000', '5750000'),
(17, 1, 'PB-09072024-7', '31', 'LWZH1371FT', '2.36', '0.42', '4012.00', '1698.00', '0.00', '0.00', '15000', '60180000', '3896115.5378486'),
(18, 1, 'PB-09072024-7', '31', 'LWZH1373FT', '2.36', '0.42', '4012.00', '1699.00', '0.00', '0.00', '15000', '60180000', '3896115.5378486'),
(19, 1, 'PB-09072024-7', '31', 'LQZH1375FT', '2.37', '0.42', '4024.00', '1700.00', '0.00', '0.00', '15200', '61164800', '3907768.9243028');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_partial`
--

CREATE TABLE `t_pembelian_partial` (
  `pembelian_partial_id` int(11) NOT NULL,
  `pembelian_partial_nomor` text DEFAULT NULL,
  `pembelian_partial_barang` int(11) DEFAULT NULL,
  `pembelian_partial_kode` text DEFAULT NULL,
  `pembelian_partial_berat` decimal(20,2) DEFAULT NULL,
  `pembelian_partial_panjang` decimal(20,2) DEFAULT NULL,
  `pembelian_partial_tanggal` date DEFAULT curdate(),
  `pembelian_partial_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_terima`
--

CREATE TABLE `t_pembelian_terima` (
  `pembelian_terima_id` int(11) NOT NULL,
  `pembelian_terima_nomor` text DEFAULT NULL,
  `pembelian_terima_bukti` text DEFAULT NULL,
  `pembelian_terima_barang` text DEFAULT NULL,
  `pembelian_terima_tanggal` date DEFAULT curdate(),
  `pembelian_terima_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_terima`
--

INSERT INTO `t_pembelian_terima` (`pembelian_terima_id`, `pembelian_terima_nomor`, `pembelian_terima_bukti`, `pembelian_terima_barang`, `pembelian_terima_tanggal`, `pembelian_terima_hapus`) VALUES
(18, 'PB-21062024-2', 'BD-21062024-1', '3,4,5', '2024-06-21', 0),
(20, 'PB-22062024-3', 'BD-22062024-2', '10,11,12', '2024-06-22', 0),
(21, 'PB-22062024-3', 'BD-22062024-3', '8,9', '2024-06-22', 0),
(22, 'PB-25062024-6', 'BD-25062024-4', '15,16', '2024-06-25', 0),
(23, 'PB-09072024-7', 'BD-09072024-5', '17,18,19', '2024-07-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_umum`
--

CREATE TABLE `t_pembelian_umum` (
  `pembelian_umum_id` int(11) NOT NULL,
  `pembelian_umum_user` text NOT NULL,
  `pembelian_umum_nomor` text NOT NULL,
  `pembelian_umum_gudang` text NOT NULL,
  `pembelian_umum_tanggal` date NOT NULL DEFAULT curdate(),
  `pembelian_umum_jatuh_tempo` text NOT NULL,
  `pembelian_umum_status` enum('lunas','belum') NOT NULL COMMENT 'l = lunas | b = belum',
  `pembelian_umum_pelunasan` text DEFAULT NULL,
  `pembelian_umum_pelunasan_keterangan` text DEFAULT NULL,
  `pembelian_umum_pembayaran` text NOT NULL,
  `pembelian_umum_keterangan` text NOT NULL,
  `pembelian_umum_lampiran` text NOT NULL,
  `pembelian_umum_qty_akhir` text NOT NULL,
  `pembelian_umum_ppn` text NOT NULL,
  `pembelian_umum_total` text NOT NULL,
  `pembelian_umum_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_umum_barang`
--

CREATE TABLE `t_pembelian_umum_barang` (
  `pembelian_umum_barang_id` int(11) NOT NULL,
  `pembelian_umum_barang_nomor` text NOT NULL,
  `pembelian_umum_barang_barang` text NOT NULL,
  `pembelian_umum_barang_qty` text NOT NULL,
  `pembelian_umum_barang_potongan` text NOT NULL,
  `pembelian_umum_barang_harga` text NOT NULL,
  `pembelian_umum_barang_subtotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_proses` text NOT NULL,
  `penjualan_so` int(11) NOT NULL DEFAULT 0,
  `penjualan_so_tanggal` date NOT NULL,
  `penjualan_nomor` text NOT NULL,
  `penjualan_pelanggan` text NOT NULL,
  `penjualan_tanggal` date NOT NULL,
  `penjualan_jam` time NOT NULL DEFAULT current_timestamp(),
  `penjualan_jatuh_tempo` date DEFAULT NULL,
  `penjualan_pembayaran` text DEFAULT NULL,
  `penjualan_keterangan` text NOT NULL,
  `penjualan_ambil` set('iya','tidak') NOT NULL DEFAULT '',
  `penjualan_lampiran` text NOT NULL,
  `penjualan_subtotal` text DEFAULT NULL,
  `penjualan_ppn` text DEFAULT NULL,
  `penjualan_grandtotal` text DEFAULT NULL,
  `penjualan_piutang` enum('1','0') DEFAULT '0' COMMENT '1 = ada piutang , 0 = tidak ada',
  `penjualan_status` set('lunas','belum') NOT NULL,
  `penjualan_pelunasan` date DEFAULT NULL,
  `penjualan_pelunasan_jumlah` text DEFAULT '0',
  `penjualan_pelunasan_keterangan` text DEFAULT NULL,
  `penjualan_gudang` text DEFAULT NULL,
  `penjualan_ekspedisi` int(11) DEFAULT NULL,
  `penjualan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_proses`, `penjualan_so`, `penjualan_so_tanggal`, `penjualan_nomor`, `penjualan_pelanggan`, `penjualan_tanggal`, `penjualan_jam`, `penjualan_jatuh_tempo`, `penjualan_pembayaran`, `penjualan_keterangan`, `penjualan_ambil`, `penjualan_lampiran`, `penjualan_subtotal`, `penjualan_ppn`, `penjualan_grandtotal`, `penjualan_piutang`, `penjualan_status`, `penjualan_pelunasan`, `penjualan_pelunasan_jumlah`, `penjualan_pelunasan_keterangan`, `penjualan_gudang`, `penjualan_ekspedisi`, `penjualan_hapus`) VALUES
(25, '0', 1, '0000-00-00', 'SO-21082024-1', '20', '2024-08-21', '21:02:01', '0000-00-00', 'tunai', 'SO', 'iya', '', '825000', '0', '825000', '0', 'lunas', NULL, '0', NULL, '0', NULL, 0),
(26, '0', 1, '0000-00-00', 'SO-21082024-2', '20', '2024-08-21', '23:15:41', '0000-00-00', 'tunai', 'filter 0.25', 'iya', '', '1940000', '0', '1940000', '0', 'lunas', NULL, '0', NULL, '0', NULL, 0),
(27, '0', 1, '0000-00-00', 'SO-21082024-3', '20', '2024-08-21', '23:22:56', '0000-00-00', 'tunai', 'filter maroon', 'iya', '', '225000', '0', '225000', '0', 'lunas', NULL, '0', NULL, '0', NULL, 0),
(28, '0', 1, '0000-00-00', 'SO-16092024-4', '20', '2024-09-16', '09:45:48', '0000-00-00', 'tunai', 'test', 'iya', '', '12100000', '0', '12100000', '0', 'lunas', NULL, '0', NULL, '1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_barang`
--

CREATE TABLE `t_penjualan_barang` (
  `penjualan_barang_id` int(11) NOT NULL,
  `penjualan_barang_nomor` text NOT NULL,
  `penjualan_barang_barang` text NOT NULL,
  `penjualan_barang_stok` decimal(20,2) DEFAULT NULL,
  `penjualan_barang_panjang` decimal(20,2) DEFAULT NULL,
  `penjualan_barang_konversi` text DEFAULT '0',
  `penjualan_barang_batang` text DEFAULT '0',
  `penjualan_barang_qty` text DEFAULT '0',
  `penjualan_barang_panjang_total` decimal(20,2) DEFAULT NULL,
  `penjualan_barang_harga` text NOT NULL,
  `penjualan_barang_hps` text NOT NULL,
  `penjualan_barang_total` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan_barang`
--

INSERT INTO `t_penjualan_barang` (`penjualan_barang_id`, `penjualan_barang_nomor`, `penjualan_barang_barang`, `penjualan_barang_stok`, `penjualan_barang_panjang`, `penjualan_barang_konversi`, `penjualan_barang_batang`, `penjualan_barang_qty`, `penjualan_barang_panjang_total`, `penjualan_barang_harga`, `penjualan_barang_hps`, `penjualan_barang_total`) VALUES
(68, 'SO-21082024-1', '7', '0.00', '5.00', '0', '0', '5', '25.00', '15000', '0', '375000'),
(69, 'SO-21082024-1', '7', '0.00', '10.00', '0', '0', '3', '30.00', '15000', '0', '450000'),
(70, 'SO-21082024-2', '9', '0.00', '8.00', '0', '0', '3', '24.00', '50000', '0', '1200000'),
(71, 'SO-21082024-2', '6', '0.00', '8.00', '0', '0', '3', '24.00', '10000', '0', '240000'),
(72, 'SO-21082024-2', '6', '0.00', '10.00', '0', '0', '5', '50.00', '10000', '0', '500000'),
(73, 'SO-21082024-3', '12', '0.00', '3.00', '0', '0', '5', '15.00', '7000', '0', '105000'),
(74, 'SO-21082024-3', '10', '0.00', '5.00', '0', '0', '3', '15.00', '8000', '0', '120000'),
(79, 'SO-16092024-4', '6', '0.00', '50.00', '0', '0', '20', '1000.00', '11000', '0', '11000000'),
(80, 'SO-16092024-4', '6', '0.00', '10.00', '0', '0', '10', '100.00', '11000', '', '1100000');

-- --------------------------------------------------------

--
-- Table structure for table `t_penyesuaian`
--

CREATE TABLE `t_penyesuaian` (
  `penyesuaian_id` int(11) NOT NULL,
  `penyesuaian_nomor` text DEFAULT NULL,
  `penyesuaian_jenis` enum('penjualan','pembelian') NOT NULL,
  `penyesuaian_transaksi` enum('perhitungan','masuk','keluar') NOT NULL,
  `penyesuaian_kategori` enum('umum','rusak') NOT NULL,
  `penyesuaian_keterangan` text DEFAULT NULL,
  `penyesuaian_tanggal` date DEFAULT NULL,
  `penyesuaian_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_penyesuaian_barang`
--

CREATE TABLE `t_penyesuaian_barang` (
  `penyesuaian_barang_id` int(11) NOT NULL,
  `penyesuaian_barang_nomor` text DEFAULT NULL,
  `penyesuaian_barang_barang` text DEFAULT NULL,
  `penyesuaian_barang_jenis` text DEFAULT NULL,
  `penyesuaian_barang_warna` text DEFAULT NULL,
  `penyesuaian_barang_jumlah` text DEFAULT NULL,
  `penyesuaian_barang_stok` text DEFAULT NULL,
  `penyesuaian_barang_selisih` text DEFAULT NULL,
  `penyesuaian_barang_status` enum('bertambah','berkurang') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_produk`
--

CREATE TABLE `t_produk` (
  `produk_id` int(11) NOT NULL,
  `produk_kode` text NOT NULL,
  `produk_nama` text NOT NULL,
  `produk_merk` text NOT NULL,
  `produk_harga` text NOT NULL DEFAULT '0',
  `produk_konversi` text DEFAULT NULL,
  `produk_ketebalan` text NOT NULL,
  `produk_keterangan` text NOT NULL,
  `produk_colly` text NOT NULL COMMENT 'jumlah isi / pack',
  `produk_update` date NOT NULL DEFAULT curdate(),
  `produk_tanggal` date NOT NULL DEFAULT curdate(),
  `produk_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_merk`, `produk_harga`, `produk_konversi`, `produk_ketebalan`, `produk_keterangan`, `produk_colly`, `produk_update`, `produk_tanggal`, `produk_hapus`) VALUES
(6, 'MP001', 'SPANDEK SILVER 0.25', 'DALLE DECK', '0', '', '0.25', '-', '0', '2024-01-25', '2024-01-25', 0),
(7, 'MP002', 'SPANDEK SILVER 0.30', 'DALLE DECK', '15000', '', '0.35', '-', '1', '2024-01-25', '2024-01-25', 0),
(8, 'MP003', 'SPANDEK SILVER 0.35', 'DALLE DECK', '35000', '', '0.35', '-', '1', '2024-01-25', '2024-01-25', 0),
(9, 'MP004', 'SPANDEK SILVER 0.40', 'DALLE DECK', '50000', '', '0.40', '-', '1', '2024-01-25', '2024-01-25', 0),
(10, 'MP005', 'SPANDEK MAROON 0.25', 'DALLE DECK', '0', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(11, 'MP006', 'SPANDEK MAROON 0.30', 'DALLE DECK', '0', '', '0.30', '0', '1', '2024-01-26', '2024-01-26', 0),
(12, 'MP007', 'SPANDEK MAROON 0.35', 'DALLE DECK', '0', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(13, 'MP008', 'SPANDEK MAROON 0.40', 'DALLE DECK', '20000', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(14, 'MP009', 'SPANDEK BIRU 0.25', 'DALLE DECK', '0', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(15, 'MP0010', 'SPANDEK BIRU 0.30', 'DALLE DECK', '0', '', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(16, 'MP0011', 'SPANDEK BIRU 0.35', 'DALLE DECK', '0', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(17, 'MP0012', 'SPANDEK BIRU 0.40', 'DALLE DECK', '0', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(18, 'MP0013', 'SPANDEK HIJAU 0.25', 'DALLE DECK', '0', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(19, 'MP0014', 'SPANDEK HIJAU 0.30', 'DALLE DECK', '0', '', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(20, 'MP0015', 'SPANDEK HIJAU 0.35', 'DALLE DECK', '0', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(21, 'MP0016', 'SPANDEK HIJAU 0.40', 'DALLE DECK', '0', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(22, 'MP0017', 'CANAL SOLID 75.75', 'SOLID', '0', '6', '0.75', '-', '1', '2024-01-26', '2024-01-26', 0),
(23, 'MP0018', 'CANAL SOLID 75.75P', 'SOLID', '0', '6', '0.70', '-', '1', '2024-01-26', '2024-01-26', 0),
(24, 'MP0019', 'CANAL SOLID 75.65', 'SOLID', '0', '6', '0.65', '-', '1', '2024-01-26', '2024-01-26', 0),
(25, 'MP0020', 'CANAL SOLID 75.65P', 'SOLID', '0', '6', '0.60', '-', '1', '2024-01-26', '2024-01-26', 0),
(26, 'MP0021', 'CANAL SOLID 75.65R', 'SOLID', '0', '6', '0.55', '-', '1', '2024-01-26', '2024-01-26', 0),
(27, 'MP0022', 'CANAL SOLID 75.65K', 'SOLID', '0', '6', '0.50', '-', '1', '2024-01-26', '2024-01-26', 0),
(28, 'MP0023', 'HOLLOW SOLID 0.25', 'SOLID', '0', '4', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(29, 'MP0024', 'HOLLOW SOLID 0.30', 'SOLID', '0', '4', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(30, 'MP0025', 'RENG SOLID 30.45', 'SOLID', '0', '6', '0.45', '-', '1', '2024-01-26', '2024-01-26', 0),
(31, 'MP0026', 'RENG SOLID 30.40', 'SOLID', '0', '6', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(32, 'MP0027', 'CANAL DALLE 75.75', 'DALLE', '0', '6', '0.75', '-', '1', '2024-01-26', '2024-01-26', 0),
(33, 'MP0028', 'CANAL DALLE 75.75P', 'DALLE', '0', '6', '0.70', '-', '1', '2024-01-26', '2024-01-26', 0),
(34, 'MP0029', 'CANAL DALLE 75.65', 'DALLE', '0', '6', '0.65', '-', '1', '2024-01-26', '2024-01-26', 0),
(35, 'MP0030', 'CANAL DALLE 75.65P', 'DALLE', '0', '6', '0.60', '-\r\n', '1', '2024-01-26', '2024-01-26', 0),
(36, 'MP0031', 'CANAL DALLE 75.65R', 'DALLE', '0', '6', '0.55', '-', '1', '2024-01-26', '2024-01-26', 0),
(37, 'MP0032', 'CANAL DALLE 75.65K', 'DALLE', '0', '6', '0.50', '-', '1', '2024-01-26', '2024-01-26', 0),
(38, 'MP0033', 'HOLLOW DALLE 0.25', 'DALLE', '0', '4', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(39, 'MP0034', 'HOLLOW DALLE 0.30', 'DALLE', '0', '4', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(40, 'MP0035', 'HOLLOW DALLE 0.35', 'DALLE', '0', '4', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(41, 'MP0036', 'RENG DALLE 30.40', 'DALLE', '0', '6', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(42, 'MP0037', 'RENG DALLE 30.45', 'DALLE', '30000', '6', '0.45', '-', '1', '2024-01-26', '2024-01-26', 0),
(45, 'MP0038', 'SPANDEK SILVER 0.40 AZ100', 'SOLID', '25000', '3', '0.40', '-', '1', '2024-04-05', '2024-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_nomor` text NOT NULL,
  `produksi_proses` int(11) DEFAULT 0 COMMENT '1 = masih ada, 2 = sudah selesai',
  `produksi_selesai` int(11) DEFAULT 0,
  `produksi_so` int(11) DEFAULT 0,
  `produksi_so_tanggal` date DEFAULT NULL,
  `produksi_pelanggan` text DEFAULT NULL,
  `produksi_tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `produksi_jam` time NOT NULL DEFAULT current_timestamp(),
  `produksi_shift` text NOT NULL,
  `produksi_pekerja` text DEFAULT NULL,
  `produksi_gudang` text DEFAULT NULL,
  `produksi_keterangan` text NOT NULL,
  `produksi_mesin` text DEFAULT NULL,
  `produksi_lampiran_1` text DEFAULT NULL,
  `produksi_lampiran_2` text DEFAULT NULL,
  `produksi_subtotal` text DEFAULT NULL,
  `produksi_jasa` text DEFAULT NULL,
  `produksi_grandtotal` text DEFAULT NULL,
  `produksi_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi`
--

INSERT INTO `t_produksi` (`produksi_id`, `produksi_nomor`, `produksi_proses`, `produksi_selesai`, `produksi_so`, `produksi_so_tanggal`, `produksi_pelanggan`, `produksi_tanggal`, `produksi_jam`, `produksi_shift`, `produksi_pekerja`, `produksi_gudang`, `produksi_keterangan`, `produksi_mesin`, `produksi_lampiran_1`, `produksi_lampiran_2`, `produksi_subtotal`, `produksi_jasa`, `produksi_grandtotal`, `produksi_hapus`) VALUES
(34, 'PR-21082024-1', 2, 1, 1, NULL, '20', '2024-08-21 21:02:01', '21:02:01', '78', '[\"11\"]', '0', 'sebagian - full', '6', NULL, NULL, 'NaN', '0', 'NaN', 0),
(35, 'SO-21082024-2', 0, 0, 1, NULL, '20', '2024-08-21 23:15:41', '23:15:41', '', NULL, '0', '', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(36, 'SO-21082024-3', 0, 0, 1, NULL, '20', '2024-08-21 23:22:56', '23:22:56', '', NULL, '0', '', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(37, 'SO-16092024-4', 0, 0, 1, NULL, '20', '2024-09-16 09:45:48', '09:45:48', '', NULL, '1', '', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_barang`
--

CREATE TABLE `t_produksi_barang` (
  `produksi_barang_id` int(11) NOT NULL,
  `produksi_barang_nomor` text NOT NULL,
  `produksi_barang_barang` text NOT NULL,
  `produksi_barang_kode` text NOT NULL,
  `produksi_barang_stok` decimal(20,2) NOT NULL DEFAULT 0.00,
  `produksi_barang_panjang` decimal(20,2) NOT NULL DEFAULT 0.00,
  `produksi_barang_berat` decimal(20,2) NOT NULL DEFAULT 0.00,
  `produksi_barang_harga` text NOT NULL DEFAULT '0',
  `produksi_barang_total` text NOT NULL DEFAULT '0',
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi_barang`
--

INSERT INTO `t_produksi_barang` (`produksi_barang_id`, `produksi_barang_nomor`, `produksi_barang_barang`, `produksi_barang_kode`, `produksi_barang_stok`, `produksi_barang_panjang`, `produksi_barang_berat`, `produksi_barang_harga`, `produksi_barang_total`, `produksi_barang_tanggal`) VALUES
(57, 'PR-21082024-1', '29', '35', '2003.00', '10.00', '2.21', '17100.90', '17100900', '2024-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_produksi`
--

CREATE TABLE `t_produksi_produksi` (
  `produksi_produksi_id` int(11) NOT NULL,
  `produksi_produksi_nomor` text NOT NULL,
  `produksi_produksi_produk` text NOT NULL,
  `produksi_produksi_konversi` text NOT NULL,
  `produksi_produksi_batang` text NOT NULL,
  `produksi_produksi_panjang` text NOT NULL,
  `produksi_produksi_qty` text NOT NULL,
  `produksi_produksi_panjang_total` decimal(20,2) NOT NULL DEFAULT 0.00,
  `produksi_produksi_status` int(11) NOT NULL DEFAULT 0,
  `produksi_produksi_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi_produksi`
--

INSERT INTO `t_produksi_produksi` (`produksi_produksi_id`, `produksi_produksi_nomor`, `produksi_produksi_produk`, `produksi_produksi_konversi`, `produksi_produksi_batang`, `produksi_produksi_panjang`, `produksi_produksi_qty`, `produksi_produksi_panjang_total`, `produksi_produksi_status`, `produksi_produksi_tanggal`) VALUES
(103, 'PR-21082024-1', '7', '0', '0', '5', '5', '25.00', 1, '2024-08-21'),
(104, 'PR-21082024-1', '7', '0', '0', '10', '3', '30.00', 1, '2024-08-21'),
(105, 'SO-21082024-2', '9', '0', '0', '8', '3', '24.00', 0, '2024-08-21'),
(106, 'SO-21082024-2', '6', '0', '0', '8', '3', '24.00', 0, '2024-08-21'),
(107, 'SO-21082024-2', '6', '0', '0', '10', '5', '50.00', 0, '2024-08-21'),
(108, 'SO-21082024-3', '12', '0', '0', '3', '5', '15.00', 0, '2024-08-21'),
(109, 'SO-21082024-3', '10', '0', '0', '5', '3', '15.00', 0, '2024-08-21'),
(110, 'SO-16092024-4', '6', '0', '0', '50', '20', '1000.00', 0, '2024-09-16'),
(111, 'SO-16092024-4', '6', '0', '0', '10', '10', '100.00', 0, '2024-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_gudang`
--

CREATE TABLE `t_produk_gudang` (
  `produk_gudang_id` int(11) NOT NULL,
  `produk_gudang_gudang` text DEFAULT '0',
  `produk_gudang_produk` text DEFAULT NULL,
  `produk_gudang_panjang` decimal(20,2) DEFAULT NULL COMMENT 'stok panjang produk',
  `produk_gudang_hps` text DEFAULT '0',
  `produk_gudang_tanggal` date NOT NULL DEFAULT curdate(),
  `produk_gudang_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk_gudang`
--

INSERT INTO `t_produk_gudang` (`produk_gudang_id`, `produk_gudang_gudang`, `produk_gudang_produk`, `produk_gudang_panjang`, `produk_gudang_hps`, `produk_gudang_tanggal`, `produk_gudang_hapus`) VALUES
(1, '0', '7', '55.00', '0', '2024-09-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_rekening`
--

CREATE TABLE `t_rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_nama` text DEFAULT NULL,
  `rekening_bank` text DEFAULT NULL,
  `rekening_no` text DEFAULT NULL,
  `rekening_tanggal` date DEFAULT curdate(),
  `rekening_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_rekening`
--

INSERT INTO `t_rekening` (`rekening_id`, `rekening_nama`, `rekening_bank`, `rekening_no`, `rekening_tanggal`, `rekening_hapus`) VALUES
(7, 'BCA', '8', '158895555', '2023-09-27', 0),
(8, 'BRI', '1', '03430108888303', '2023-12-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_saldo`
--

CREATE TABLE `t_saldo` (
  `saldo_id` int(11) NOT NULL,
  `saldo_nomor` text DEFAULT NULL,
  `saldo_sumber` set('langsung','pembelian','penjualan') DEFAULT NULL,
  `saldo_nominal` text DEFAULT '0',
  `saldo_rekening` text DEFAULT NULL,
  `saldo_jenis` set('setor','tarik') DEFAULT NULL,
  `saldo_keterangan` text DEFAULT NULL,
  `saldo_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `saldo_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_saldo`
--

INSERT INTO `t_saldo` (`saldo_id`, `saldo_nomor`, `saldo_sumber`, `saldo_nominal`, `saldo_rekening`, `saldo_jenis`, `saldo_keterangan`, `saldo_tanggal`, `saldo_hapus`) VALUES
(3, 'SO-16092024-4', 'penjualan', '12100000', 'tunai', 'setor', 'transaksi penjualan', '2024-09-16 02:47:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_satuan`
--

CREATE TABLE `t_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_kepanjangan` text NOT NULL,
  `satuan_singkatan` text NOT NULL,
  `satuan_tanggal` date NOT NULL DEFAULT curdate(),
  `satuan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_satuan`
--

INSERT INTO `t_satuan` (`satuan_id`, `satuan_kepanjangan`, `satuan_singkatan`, `satuan_tanggal`, `satuan_hapus`) VALUES
(1, 'Kilogram', 'Kg', '2022-12-05', 0),
(2, '1 Kardus', 'Dus', '2022-12-05', 0),
(3, '1 Pak', 'Pak', '2022-12-05', 0),
(4, '1 Box', 'Box', '2022-12-05', 0),
(5, 'Gram', 'Gr', '2022-12-05', 0),
(6, 'Gelas', 'Gls', '2022-12-05', 0),
(7, 'Pieces', 'PCS', '2023-01-06', 0),
(8, 'Batang', 'Btg', '2023-04-14', 0),
(9, 'Meter', 'Mtr', '2023-11-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_ttl` date DEFAULT NULL,
  `user_nohp` text DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_biodata` text DEFAULT NULL,
  `user_foto` text DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_pelajaran` text DEFAULT NULL,
  `user_kelas` text DEFAULT NULL,
  `user_email_2` text DEFAULT NULL,
  `user_tanggal` date DEFAULT curdate(),
  `user_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'JTM', '2021-11-09', '085555111555', 'Alamat', 'Biodata', '4c293a141d8c17800a44b816d35238cd.png', 0, NULL, NULL, NULL, '2023-02-09', 0),
(78, 'DSB@GMAIL.COM', 'afa0b885505255964c06188e2b4e8f59', 'YUNI', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2022-12-04', 0),
(84, 'kasir@gmail.com', 'c7911af3adbd12a035b289556d96470a', 'Kasir JTM', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2023-06-02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `t_bahan`
--
ALTER TABLE `t_bahan`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `t_bahan_gudang`
--
ALTER TABLE `t_bahan_gudang`
  ADD PRIMARY KEY (`bahan_gudang_id`);

--
-- Indexes for table `t_bahan_item`
--
ALTER TABLE `t_bahan_item`
  ADD PRIMARY KEY (`bahan_item_id`);

--
-- Indexes for table `t_bank`
--
ALTER TABLE `t_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `t_cetak`
--
ALTER TABLE `t_cetak`
  ADD PRIMARY KEY (`cetak_id`);

--
-- Indexes for table `t_coa`
--
ALTER TABLE `t_coa`
  ADD PRIMARY KEY (`coa_id`);

--
-- Indexes for table `t_coa_sub`
--
ALTER TABLE `t_coa_sub`
  ADD PRIMARY KEY (`coa_sub_id`);

--
-- Indexes for table `t_ekspedisi`
--
ALTER TABLE `t_ekspedisi`
  ADD PRIMARY KEY (`ekspedisi_id`) USING BTREE;

--
-- Indexes for table `t_filter`
--
ALTER TABLE `t_filter`
  ADD PRIMARY KEY (`filter_id`);

--
-- Indexes for table `t_gudang`
--
ALTER TABLE `t_gudang`
  ADD PRIMARY KEY (`gudang_id`);

--
-- Indexes for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  ADD PRIMARY KEY (`jurnal_id`);

--
-- Indexes for table `t_kartu`
--
ALTER TABLE `t_kartu`
  ADD PRIMARY KEY (`kartu_id`);

--
-- Indexes for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `t_kontak`
--
ALTER TABLE `t_kontak`
  ADD PRIMARY KEY (`kontak_id`);

--
-- Indexes for table `t_level`
--
ALTER TABLE `t_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `t_logo`
--
ALTER TABLE `t_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `t_mesin`
--
ALTER TABLE `t_mesin`
  ADD PRIMARY KEY (`mesin_id`);

--
-- Indexes for table `t_pajak`
--
ALTER TABLE `t_pajak`
  ADD PRIMARY KEY (`pajak_id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  ADD PRIMARY KEY (`pembelian_barang_id`);

--
-- Indexes for table `t_pembelian_partial`
--
ALTER TABLE `t_pembelian_partial`
  ADD PRIMARY KEY (`pembelian_partial_id`);

--
-- Indexes for table `t_pembelian_terima`
--
ALTER TABLE `t_pembelian_terima`
  ADD PRIMARY KEY (`pembelian_terima_id`);

--
-- Indexes for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  ADD PRIMARY KEY (`pembelian_umum_id`);

--
-- Indexes for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  ADD PRIMARY KEY (`pembelian_umum_barang_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  ADD PRIMARY KEY (`penjualan_barang_id`);

--
-- Indexes for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  ADD PRIMARY KEY (`penyesuaian_id`);

--
-- Indexes for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  ADD PRIMARY KEY (`penyesuaian_barang_id`);

--
-- Indexes for table `t_produk`
--
ALTER TABLE `t_produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `t_produksi`
--
ALTER TABLE `t_produksi`
  ADD PRIMARY KEY (`produksi_id`);

--
-- Indexes for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  ADD PRIMARY KEY (`produksi_barang_id`);

--
-- Indexes for table `t_produksi_produksi`
--
ALTER TABLE `t_produksi_produksi`
  ADD PRIMARY KEY (`produksi_produksi_id`);

--
-- Indexes for table `t_produk_gudang`
--
ALTER TABLE `t_produk_gudang`
  ADD PRIMARY KEY (`produk_gudang_id`);

--
-- Indexes for table `t_rekening`
--
ALTER TABLE `t_rekening`
  ADD PRIMARY KEY (`rekening_id`);

--
-- Indexes for table `t_saldo`
--
ALTER TABLE `t_saldo`
  ADD PRIMARY KEY (`saldo_id`);

--
-- Indexes for table `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_bahan_gudang`
--
ALTER TABLE `t_bahan_gudang`
  MODIFY `bahan_gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `t_bahan_item`
--
ALTER TABLE `t_bahan_item`
  MODIFY `bahan_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `t_bank`
--
ALTER TABLE `t_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `t_cetak`
--
ALTER TABLE `t_cetak`
  MODIFY `cetak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_coa`
--
ALTER TABLE `t_coa`
  MODIFY `coa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_coa_sub`
--
ALTER TABLE `t_coa_sub`
  MODIFY `coa_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_ekspedisi`
--
ALTER TABLE `t_ekspedisi`
  MODIFY `ekspedisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_filter`
--
ALTER TABLE `t_filter`
  MODIFY `filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `t_gudang`
--
ALTER TABLE `t_gudang`
  MODIFY `gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `t_kartu`
--
ALTER TABLE `t_kartu`
  MODIFY `kartu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_logo`
--
ALTER TABLE `t_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_mesin`
--
ALTER TABLE `t_mesin`
  MODIFY `mesin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_pajak`
--
ALTER TABLE `t_pajak`
  MODIFY `pajak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_pembelian_partial`
--
ALTER TABLE `t_pembelian_partial`
  MODIFY `pembelian_partial_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian_terima`
--
ALTER TABLE `t_pembelian_terima`
  MODIFY `pembelian_terima_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  MODIFY `penyesuaian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  MODIFY `penyesuaian_barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_produksi_produksi`
--
ALTER TABLE `t_produksi_produksi`
  MODIFY `produksi_produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `t_produk_gudang`
--
ALTER TABLE `t_produk_gudang`
  MODIFY `produk_gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_rekening`
--
ALTER TABLE `t_rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_saldo`
--
ALTER TABLE `t_saldo`
  MODIFY `saldo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
