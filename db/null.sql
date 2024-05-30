-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 07:14 PM
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
-- Database: `dsb_sandbox`
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
(56, 'BH0029', 'GALVALUM BMT 0.35 AZ100', '', 'utama', '56000', '2024-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_bahan_gudang`
--

CREATE TABLE `t_bahan_gudang` (
  `bahan_gudang_id` int(11) NOT NULL,
  `bahan_gudang_bahan` text NOT NULL,
  `bahan_gudang_gudang` text DEFAULT NULL,
  `bahan_gudang_berat_permeter` text DEFAULT '0' COMMENT 'Berat permeter ',
  `bahan_gudang_berat` decimal(20,2) DEFAULT NULL COMMENT 'Stok berat bahan baku',
  `bahan_gudang_panjang` decimal(20,2) DEFAULT NULL COMMENT 'Stok panjang bahan baku',
  `bahan_gudang_hpp` text DEFAULT '0',
  `bahan_gudang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan_gudang`
--

INSERT INTO `t_bahan_gudang` (`bahan_gudang_id`, `bahan_gudang_bahan`, `bahan_gudang_gudang`, `bahan_gudang_berat_permeter`, `bahan_gudang_berat`, `bahan_gudang_panjang`, `bahan_gudang_hpp`, `bahan_gudang_tanggal`) VALUES
(24, '28', '0', '0', '0.00', '0.00', '0', '2024-01-26'),
(25, '29', '0', '0', '0.00', '0.00', '0', '2024-01-26'),
(26, '30', '0', '0', '0.00', '0.00', '0', '2024-01-26'),
(27, '31', '0', '0', '0.00', '0.00', '0', '2024-01-26'),
(28, '32', '0', '0', '0.00', '0.00', '0', '2024-01-26'),
(29, '33', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(30, '34', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(31, '35', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(32, '36', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(33, '37', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(34, '41', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(35, '42', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(36, '43', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(37, '44', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(38, '45', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(39, '46', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(40, '47', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(41, '38', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(42, '39', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(43, '40', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(44, '48', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(45, '49', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(46, '51', '0', '0', '0.00', '0.00', '0', '2024-01-27'),
(47, '52', '0', '0', '0.00', '0.00', '0', '2024-02-28'),
(48, '53', '0', '0', '0.00', '0.00', '0', '2024-02-28'),
(49, '54', '0', '0', '0.00', '0.00', '0', '2024-02-28'),
(50, '55', '0', '0', '0.00', '0.00', '0', '2024-04-04'),
(51, '56', '0', '0', '0.00', '0.00', '0', '2024-04-05');

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
(0, 'GD000', 'Gudang Utama', NULL, 0, '0000-00-00'),
(2, 'GD001', 'Gudang A', NULL, 1, '2023-09-03');

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

-- --------------------------------------------------------

--
-- Table structure for table `t_jurnal_old`
--

CREATE TABLE `t_jurnal_old` (
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
-- Dumping data for table `t_jurnal_old`
--

INSERT INTO `t_jurnal_old` (`jurnal_id`, `jurnal_nomor`, `jurnal_akun`, `jurnal_keterangan`, `jurnal_type`, `jurnal_nominal`, `jurnal_hapus`, `jurnal_tanggal`) VALUES
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
(1004, '0', 'produksi', 'masuk', 'SO-17022024-2', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '45.45', '2285.03', '2024-04-03', '02:52:33', 0),
(1005, '0', 'produksi', 'keluar', 'SO-17022024-3', '51', 'BH0024', ' ZINIUM 0.20 BMT X 101', 'Mtr', '200.00', '-32128.00', '2024-04-03', '02:52:35', 0),
(1006, '0', 'produksi', 'keluar', 'SO-17022024-3', '48', 'BH0021', 'ZINIUM 0.25 BMT X 101', 'Mtr', '200.00', '-4434.00', '2024-04-03', '02:52:35', 0),
(1007, '0', 'produksi', 'masuk', 'SO-17022024-3', '29', 'MP0024', 'HOLLOW SOLID 0.30', 'Mtr', '200.00', '3774.00', '2024-04-03', '02:52:35', 0),
(1008, '0', 'produksi', 'masuk', 'SO-17022024-3', '28', 'MP0023', 'HOLLOW SOLID 0.25', 'Mtr', '200.00', '17441.00', '2024-04-03', '02:52:35', 0),
(1009, '0', 'produksi', 'keluar', 'SO-17022024-4', '35', 'BH008', 'PPGL HIJAU 0.20 X 914', 'Mtr', '681.50', '-707.00', '2024-04-03', '02:52:37', 0),
(1010, '0', 'produksi', 'masuk', 'SO-17022024-4', '18', 'MP0013', 'SPANDEK HIJAU 0.25', 'Mtr', '33.50', '59.00', '2024-04-03', '02:52:37', 0),
(1011, '0', 'produksi', 'masuk', 'SO-17022024-4', '18', 'MP0013', 'SPANDEK HIJAU 0.25', 'Mtr', '648.00', '707.00', '2024-04-03', '02:52:37', 0),
(1012, '0', 'produksi', 'keluar', 'SO-19022024-1', '28', 'BH001', 'GALVALUME 0.20 X 914', 'Mtr', '50.00', '-1332.63', '2024-04-03', '02:52:39', 0),
(1013, '0', 'produksi', 'masuk', 'SO-19022024-1', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '50.00', '713.73', '2024-04-03', '02:52:39', 0),
(1014, '0', 'produksi', 'keluar', 'SO-19022024-2', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '360.00', '-8898.00', '2024-04-03', '02:52:41', 0),
(1015, '0', 'produksi', 'masuk', 'SO-19022024-2', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '360.00', '8820.00', '2024-04-03', '02:52:41', 0),
(1016, '0', 'produksi', 'keluar', 'SO-19022024-3', '41', 'BH0014', 'INDOLUM 0.40 BMT X 101', 'Mtr', '18.00', '-17880.00', '2024-04-03', '02:52:43', 0),
(1017, '0', 'produksi', 'keluar', 'SO-19022024-3', '44', 'BH0017', 'INDOLUM 0.55 BMT X 152', 'Mtr', '12.00', '-9396.00', '2024-04-03', '02:52:43', 0),
(1018, '0', 'produksi', 'keluar', 'SO-19022024-3', '39', 'BH0012', 'PPGL BIRU 0.20 X 914', 'Mtr', '12.80', '-174.80', '2024-04-03', '02:52:43', 0),
(1019, '0', 'produksi', 'masuk', 'SO-19022024-3', '14', 'MP009', 'SPANDEK BIRU 0.25', 'Mtr', '12.80', '102.80', '2024-04-03', '02:52:43', 0),
(1020, '0', 'produksi', 'masuk', 'SO-19022024-3', '26', 'MP0021', 'CANAL SOLID 75.65R', 'Mtr', '12.00', '7447.80', '2024-04-03', '02:52:43', 0),
(1021, '0', 'produksi', 'masuk', 'SO-19022024-3', '31', 'MP0026', 'RENG SOLID 30.40', 'Mtr', '18.00', '3498.00', '2024-04-03', '02:52:43', 0),
(1022, '0', 'produksi', 'keluar', 'SO-19022024-4', '54', 'BH0027', 'PPGL HIJAU 0.33 X 914', 'Mtr', '6.00', '-115.65', '2024-04-03', '02:52:45', 0),
(1023, '0', 'produksi', 'masuk', 'SO-19022024-4', '21', 'MP0016', 'SPANDEK HIJAU 0.40', 'Mtr', '6.00', '115.65', '2024-04-03', '02:52:45', 0),
(1024, '0', 'produksi', 'keluar', 'SO-19022024-5', '37', 'BH0010', 'PPGL BIRU 0.27 X 914', 'Mtr', '12.00', '-721.35', '2024-04-03', '02:52:47', 0),
(1025, '0', 'produksi', 'masuk', 'SO-19022024-5', '16', 'MP0011', 'SPANDEK BIRU 0.35', 'Mtr', '12.00', '283.75', '2024-04-03', '02:52:47', 0),
(1026, '0', 'produksi', 'keluar', 'SO-20022024-2', '53', 'BH0026', 'PPGL HIJAU 0.27 X 914', 'Mtr', '18.50', '-168.00', '2024-04-03', '02:52:53', 0),
(1027, '0', 'produksi', 'masuk', 'SO-20022024-2', '20', 'MP0015', 'SPANDEK HIJAU 0.35', 'Mtr', '11.10', '160.60', '2024-04-03', '02:52:53', 0),
(1028, '0', 'produksi', 'masuk', 'SO-20022024-2', '20', 'MP0015', 'SPANDEK HIJAU 0.35', 'Mtr', '7.40', '168.00', '2024-04-03', '02:52:53', 0),
(1029, '0', 'produksi', 'keluar', 'SO-20022024-3', '33', 'BH006', 'PPGL HIJAU 0.23 X 914', 'Mtr', '1500.00', '-1500.00', '2024-04-03', '02:52:55', 0),
(1030, '0', 'produksi', 'masuk', 'SO-20022024-3', '19', 'MP0014', 'SPANDEK HIJAU 0.30', 'Mtr', '1.50', '1.50', '2024-04-03', '02:52:55', 0),
(1031, '0', 'produksi', 'keluar', 'SO-20022024-4', '43', 'BH0016', 'INDOLUM 0.50 BMT X 152', 'Mtr', '600.00', '-9630.00', '2024-04-03', '02:52:57', 0),
(1032, '0', 'produksi', 'masuk', 'SO-20022024-4', '36', 'MP0031', 'CANAL DALLE 75.65R', 'Mtr', '600.00', '3450.00', '2024-04-03', '02:52:57', 0),
(1033, '0', 'produksi', 'keluar', 'SO-21022024-1', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '540.00', '-3414.83', '2024-04-03', '02:53:01', 0),
(1034, '0', 'produksi', 'keluar', 'SO-21022024-1', '48', 'BH0021', 'ZINIUM 0.25 BMT X 101', 'Mtr', '2000.00', '-6434.00', '2024-04-03', '02:53:01', 0),
(1035, '0', 'produksi', 'masuk', 'SO-21022024-1', '29', 'MP0024', 'HOLLOW SOLID 0.30', 'Mtr', '2000.00', '5774.00', '2024-04-03', '02:53:01', 0),
(1036, '0', 'produksi', 'masuk', 'SO-21022024-1', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '180.00', '2465.03', '2024-04-03', '02:53:01', 0),
(1037, '0', 'produksi', 'masuk', 'SO-21022024-1', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '150.00', '2615.03', '2024-04-03', '02:53:01', 0),
(1038, '0', 'produksi', 'masuk', 'SO-21022024-1', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '120.00', '2735.03', '2024-04-03', '02:53:01', 0),
(1039, '0', 'produksi', 'masuk', 'SO-21022024-1', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '90.00', '2825.03', '2024-04-03', '02:53:01', 0),
(1040, '0', 'produksi', 'keluar', 'SO-21022024-2', '40', 'BH0013', 'PPGL MAROON 0.27 X 914', 'Mtr', '48.60', '-1188.25', '2024-04-03', '02:53:05', 0),
(1041, '0', 'produksi', 'keluar', 'SO-21022024-2', '42', 'BH0015', 'INDOLUM 0.45 BMT X 101', 'Mtr', '60.00', '-14052.00', '2024-04-03', '02:53:05', 0),
(1042, '0', 'produksi', 'keluar', 'SO-21022024-2', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '90.00', '-8988.00', '2024-04-03', '02:53:05', 0),
(1043, '0', 'produksi', 'masuk', 'SO-21022024-2', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '90.00', '8910.00', '2024-04-03', '02:53:05', 0),
(1044, '0', 'produksi', 'masuk', 'SO-21022024-2', '30', 'MP0025', 'RENG SOLID 30.45', 'Mtr', '60.00', '9074.58', '2024-04-03', '02:53:05', 0),
(1045, '0', 'produksi', 'masuk', 'SO-21022024-2', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '48.60', '439.30', '2024-04-03', '02:53:05', 0),
(1046, '0', 'produksi', 'keluar', 'SO-21022024-3', '39', 'BH0012', 'PPGL BIRU 0.20 X 914', 'Mtr', '1.60', '-176.40', '2024-04-03', '02:53:07', 0),
(1047, '0', 'produksi', 'masuk', 'SO-21022024-3', '14', 'MP009', 'SPANDEK BIRU 0.25', 'Mtr', '1.60', '104.40', '2024-04-03', '02:53:07', 0),
(1048, '0', 'produksi', 'keluar', 'SO-21022024-5', '43', 'BH0016', 'INDOLUM 0.50 BMT X 152', 'Mtr', '900.00', '-10530.00', '2024-04-03', '02:53:09', 0),
(1049, '0', 'produksi', 'masuk', 'SO-21022024-5', '36', 'MP0031', 'CANAL DALLE 75.65R', 'Mtr', '900.00', '4350.00', '2024-04-03', '02:53:09', 0),
(1050, '0', 'produksi', 'keluar', 'SO-21022024-6', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '38.50', '-3453.33', '2024-04-03', '02:53:11', 0),
(1051, '0', 'produksi', 'masuk', 'SO-21022024-6', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '38.50', '2863.53', '2024-04-03', '02:53:11', 0),
(1052, '0', 'produksi', 'keluar', 'SO-21022024-7', '51', 'BH0024', ' ZINIUM 0.20 BMT X 101', 'Mtr', '800.00', '-32928.00', '2024-04-03', '02:53:14', 0),
(1053, '0', 'produksi', 'masuk', 'SO-21022024-7', '28', 'MP0023', 'HOLLOW SOLID 0.25', 'Mtr', '800.00', '18241.00', '2024-04-03', '02:53:14', 0),
(1054, '0', 'produksi', 'keluar', 'SO-21022024-9', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '450.00', '-9438.00', '2024-04-03', '02:53:18', 0),
(1055, '0', 'produksi', 'masuk', 'SO-21022024-9', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '450.00', '9360.00', '2024-04-03', '02:53:18', 0),
(1056, '0', 'produksi', 'keluar', 'SO-22022024-2', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '420.00', '-9858.00', '2024-04-03', '02:53:22', 0),
(1057, '0', 'produksi', 'masuk', 'SO-22022024-2', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '420.00', '9780.00', '2024-04-03', '02:53:22', 0),
(1058, '0', 'produksi', 'keluar', 'SO-19022024-6', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '40.00', '-11798.20', '2024-04-04', '02:52:49', 0),
(1059, '0', 'produksi', 'masuk', 'SO-19022024-6', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '40.00', '-706.12', '2024-04-04', '02:52:49', 0),
(1060, '0', 'produksi', 'keluar', 'SO-22022024-1', '31', 'BH004', 'GALVALUME 0.33 X 914', 'Mtr', '8.50', '-1551.50', '2024-04-04', '02:53:20', 0),
(1061, '0', 'produksi', 'masuk', 'SO-22022024-1', '9', 'MP004', 'SPANDEK SILVER 0.40', 'Mtr', '8.50', '262.30', '2024-04-04', '02:53:20', 0),
(1062, '0', 'produksi', 'keluar', 'SO-22022024-3', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '31.05', '-3484.38', '2024-04-04', '02:53:24', 0),
(1063, '0', 'produksi', 'masuk', 'SO-22022024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '14.55', '2878.08', '2024-04-04', '02:53:24', 0),
(1064, '0', 'produksi', 'masuk', 'SO-22022024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '16.50', '2894.58', '2024-04-04', '02:53:24', 0),
(1065, '0', 'produksi', 'keluar', 'SO-22022024-4', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '351.00', '-3835.38', '2024-04-04', '02:53:26', 0),
(1066, '0', 'produksi', 'masuk', 'SO-22022024-4', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '351.00', '3245.58', '2024-04-04', '02:53:26', 0),
(1067, '0', 'produksi', 'keluar', 'SO-22022024-5', '48', 'BH0021', 'ZINIUM 0.25 BMT X 101', 'Mtr', '800.00', '-7234.00', '2024-04-04', '02:53:28', 0),
(1068, '0', 'produksi', 'masuk', 'SO-22022024-5', '29', 'MP0024', 'HOLLOW SOLID 0.30', 'Mtr', '800.00', '6574.00', '2024-04-04', '02:53:28', 0),
(1069, '0', 'produksi', 'keluar', 'SO-22022024-6', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '528.00', '-10386.00', '2024-04-04', '02:53:30', 0),
(1070, '0', 'produksi', 'keluar', 'SO-22022024-6', '41', 'BH0014', 'INDOLUM 0.40 BMT X 101', 'Mtr', '768.00', '-18648.00', '2024-04-04', '02:53:30', 0),
(1071, '0', 'produksi', 'masuk', 'SO-22022024-6', '42', 'MP0037', 'RENG DALLE 30.45', 'Mtr', '768.00', '1521.00', '2024-04-04', '02:53:30', 0),
(1072, '0', 'produksi', 'masuk', 'SO-22022024-6', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '528.00', '10308.00', '2024-04-04', '02:53:30', 0),
(1073, '0', 'produksi', 'keluar', 'SO-22022024-7', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '80.00', '-3915.38', '2024-04-04', '02:53:32', 0),
(1074, '0', 'produksi', 'masuk', 'SO-22022024-7', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '80.00', '3325.58', '2024-04-04', '02:53:32', 0),
(1075, '0', 'produksi', 'keluar', 'SO-22022024-8', '48', 'BH0021', 'ZINIUM 0.25 BMT X 101', 'Mtr', '1000.00', '-8234.00', '2024-04-04', '02:53:34', 0),
(1076, '0', 'produksi', 'masuk', 'SO-22022024-8', '29', 'MP0024', 'HOLLOW SOLID 0.30', 'Mtr', '1.00', '6575.00', '2024-04-04', '02:53:34', 0),
(1077, '0', 'produksi', 'keluar', 'SO-22022024-9', '41', 'BH0014', 'INDOLUM 0.40 BMT X 101', 'Mtr', '360.00', '-19008.00', '2024-04-04', '02:53:36', 0),
(1078, '0', 'produksi', 'masuk', 'SO-22022024-9', '42', 'MP0037', 'RENG DALLE 30.45', 'Mtr', '360.00', '1881.00', '2024-04-04', '02:53:36', 0),
(1079, '0', 'produksi', 'keluar', 'SO-22022024-11', '35', 'BH008', 'PPGL HIJAU 0.20 X 914', 'Mtr', '24.00', '-731.00', '2024-04-04', '02:53:40', 0),
(1080, '0', 'produksi', 'masuk', 'SO-22022024-11', '18', 'MP0013', 'SPANDEK HIJAU 0.25', 'Mtr', '24.00', '731.00', '2024-04-04', '02:53:40', 0),
(1081, '0', 'produksi', 'keluar', 'SO-22022024-12', '40', 'BH0013', 'PPGL MAROON 0.27 X 914', 'Mtr', '446.60', '-1634.85', '2024-04-04', '02:53:42', 0),
(1082, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '22.00', '461.30', '2024-04-04', '02:53:42', 0),
(1083, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '19.20', '480.50', '2024-04-04', '02:53:42', 0),
(1084, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '56.00', '536.50', '2024-04-04', '02:53:42', 0),
(1085, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '15.20', '551.70', '2024-04-04', '02:53:42', 0),
(1086, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '25.20', '576.90', '2024-04-04', '02:53:42', 0),
(1087, '0', 'produksi', 'masuk', 'SO-22022024-12', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '309.00', '885.90', '2024-04-04', '02:53:42', 0),
(1088, '0', 'produksi', 'keluar', 'SO-23022024-2', '51', 'BH0024', ' ZINIUM 0.20 BMT X 101', 'Mtr', '600.00', '-33528.00', '2024-04-04', '02:53:46', 0),
(1089, '0', 'produksi', 'masuk', 'SO-23022024-2', '28', 'MP0023', 'HOLLOW SOLID 0.25', 'Mtr', '600.00', '18841.00', '2024-04-04', '02:53:46', 0),
(1090, '0', 'produksi', 'keluar', 'SO-23022024-3', '39', 'BH0012', 'PPGL BIRU 0.20 X 914', 'Mtr', '9.00', '-185.40', '2024-04-04', '02:53:48', 0),
(1091, '0', 'produksi', 'masuk', 'SO-23022024-3', '14', 'MP009', 'SPANDEK BIRU 0.25', 'Mtr', '9.00', '113.40', '2024-04-04', '02:53:48', 0),
(1092, '0', 'produksi', 'keluar', 'SO-23022024-5', '44', 'BH0017', 'INDOLUM 0.55 BMT X 152', 'Mtr', '180.00', '-9576.00', '2024-04-04', '02:53:52', 0),
(1093, '0', 'produksi', 'masuk', 'SO-23022024-5', '26', 'MP0021', 'CANAL SOLID 75.65R', 'Mtr', '180.00', '7627.80', '2024-04-04', '02:53:52', 0),
(1094, '0', 'produksi', 'keluar', 'SO-23022024-7', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '108.00', '-4023.38', '2024-04-04', '02:53:56', 0),
(1095, '0', 'produksi', 'masuk', 'SO-23022024-7', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '15.00', '3340.58', '2024-04-04', '02:53:56', 0),
(1096, '0', 'produksi', 'masuk', 'SO-23022024-7', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '57.00', '3397.58', '2024-04-04', '02:53:56', 0),
(1097, '0', 'produksi', 'masuk', 'SO-23022024-7', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '36.00', '3433.58', '2024-04-04', '02:53:56', 0),
(1098, '0', 'produksi', 'keluar', 'SO-24022024-1', '37', 'BH0010', 'PPGL BIRU 0.27 X 914', 'Mtr', '27.50', '-748.85', '2024-04-04', '02:54:00', 0),
(1099, '0', 'produksi', 'masuk', 'SO-24022024-1', '16', 'MP0011', 'SPANDEK BIRU 0.35', 'Mtr', '27.50', '311.25', '2024-04-04', '02:54:00', 0),
(1100, '0', 'produksi', 'keluar', 'SO-24022024-2', '53', 'BH0026', 'PPGL HIJAU 0.27 X 914', 'Mtr', '45.00', '-213.00', '2024-04-04', '02:54:02', 0),
(1101, '0', 'produksi', 'masuk', 'SO-24022024-2', '20', 'MP0015', 'SPANDEK HIJAU 0.35', 'Mtr', '45.00', '213.00', '2024-04-04', '02:54:02', 0),
(1102, '0', 'produksi', 'keluar', 'SO-26022024-2', '40', 'BH0013', 'PPGL MAROON 0.27 X 914', 'Mtr', '240.00', '-1874.85', '2024-04-04', '02:54:08', 0),
(1103, '0', 'produksi', 'keluar', 'SO-26022024-2', '41', 'BH0014', 'INDOLUM 0.40 BMT X 101', 'Mtr', '270.00', '-19278.00', '2024-04-04', '02:54:08', 0),
(1104, '0', 'produksi', 'keluar', 'SO-26022024-2', '45', 'BH0018', 'INDOLUM 0.60 BMT X 152', 'Mtr', '390.00', '-3492.00', '2024-04-04', '02:54:08', 0),
(1105, '0', 'produksi', 'masuk', 'SO-26022024-2', '34', 'MP0029', 'CANAL DALLE 75.65', 'Mtr', '390.00', '1962.00', '2024-04-04', '02:54:08', 0),
(1106, '0', 'produksi', 'masuk', 'SO-26022024-2', '42', 'MP0037', 'RENG DALLE 30.45', 'Mtr', '270.00', '2151.00', '2024-04-04', '02:54:08', 0),
(1107, '0', 'produksi', 'masuk', 'SO-26022024-2', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '120.00', '1005.90', '2024-04-04', '02:54:08', 0),
(1108, '0', 'produksi', 'keluar', 'SO-26022024-3', '47', 'BH0020', 'INDOLUM 0.70 BMT X 152', 'Mtr', '300.00', '-14166.00', '2024-04-04', '02:54:10', 0),
(1109, '0', 'produksi', 'masuk', 'SO-26022024-3', '32', 'MP0027', 'CANAL DALLE 75.75', 'Mtr', '300.00', '3901.20', '2024-04-04', '02:54:10', 0),
(1110, '0', 'produksi', 'keluar', 'SO-26022024-5', '44', 'BH0017', 'INDOLUM 0.55 BMT X 152', 'Mtr', '180.00', '-9756.00', '2024-04-04', '02:54:14', 0),
(1111, '0', 'produksi', 'masuk', 'SO-26022024-5', '26', 'MP0021', 'CANAL SOLID 75.65R', 'Mtr', '180.00', '7807.80', '2024-04-04', '02:54:14', 0),
(1112, '0', 'produksi', 'keluar', 'SO-26022024-8', '51', 'BH0024', ' ZINIUM 0.20 BMT X 101', 'Mtr', '800.00', '-34328.00', '2024-04-04', '02:54:20', 0),
(1113, '0', 'produksi', 'masuk', 'SO-26022024-8', '39', 'MP0034', 'HOLLOW DALLE 0.30', 'Mtr', '800.00', '1900.00', '2024-04-04', '02:54:20', 0),
(1114, '0', 'produksi', 'keluar', 'SO-26022024-9', '40', 'BH0013', 'PPGL MAROON 0.27 X 914', 'Mtr', '88.80', '-1963.65', '2024-04-04', '02:54:22', 0),
(1115, '0', 'produksi', 'keluar', 'SO-26022024-9', '47', 'BH0020', 'INDOLUM 0.70 BMT X 152', 'Mtr', '120.00', '-14286.00', '2024-04-04', '02:54:22', 0),
(1116, '0', 'produksi', 'masuk', 'SO-26022024-9', '32', 'MP0027', 'CANAL DALLE 75.75', 'Mtr', '120.00', '4021.20', '2024-04-04', '02:54:22', 0),
(1117, '0', 'produksi', 'masuk', 'SO-26022024-9', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '39.00', '1044.90', '2024-04-04', '02:54:22', 0),
(1118, '0', 'produksi', 'masuk', 'SO-26022024-9', '12', 'MP007', 'SPANDEK MAROON 0.35', 'Mtr', '49.80', '1094.70', '2024-04-04', '02:54:22', 0),
(1119, '0', 'produksi', 'keluar', 'SO-26022024-10', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '319.90', '-4343.28', '2024-04-04', '02:54:24', 0),
(1120, '0', 'produksi', 'masuk', 'SO-26022024-10', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '87.50', '3521.08', '2024-04-04', '02:54:24', 0),
(1121, '0', 'produksi', 'masuk', 'SO-26022024-10', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '232.40', '3753.48', '2024-04-04', '02:54:24', 0),
(1122, '0', 'produksi', 'keluar', 'SO-26022024-11', '49', 'BH0022', 'ZINIUM 0.70 BMT X 152', 'Mtr', '300.00', '-10686.00', '2024-04-04', '02:54:26', 0),
(1123, '0', 'produksi', 'masuk', 'SO-26022024-11', '22', 'MP0017', 'CANAL SOLID 75.75', 'Mtr', '300.00', '10608.00', '2024-04-04', '02:54:26', 0),
(1124, '0', 'produksi', 'keluar', 'SO-26022024-12', '47', 'BH0020', 'INDOLUM 0.70 BMT X 152', 'Mtr', '300.00', '-14586.00', '2024-04-04', '02:54:28', 0),
(1125, '0', 'produksi', 'masuk', 'SO-26022024-12', '32', 'MP0027', 'CANAL DALLE 75.75', 'Mtr', '300.00', '4321.20', '2024-04-04', '02:54:28', 0),
(1126, '0', 'produksi', 'keluar', 'SO-26022024-13', '37', 'BH0010', 'PPGL BIRU 0.27 X 914', 'Mtr', '95.50', '-844.35', '2024-04-04', '02:54:30', 0),
(1127, '0', 'produksi', 'masuk', 'SO-26022024-13', '16', 'MP0011', 'SPANDEK BIRU 0.35', 'Mtr', '55.50', '366.75', '2024-04-04', '02:54:30', 0),
(1128, '0', 'produksi', 'masuk', 'SO-26022024-13', '16', 'MP0011', 'SPANDEK BIRU 0.35', 'Mtr', '40.00', '406.75', '2024-04-04', '02:54:30', 0),
(1129, '0', 'produksi', 'keluar', 'SO-27022024-1', '33', 'BH006', 'PPGL HIJAU 0.23 X 914', 'Mtr', '48.00', '-1548.00', '2024-04-04', '02:54:34', 0),
(1130, '0', 'produksi', 'masuk', 'SO-27022024-1', '19', 'MP0014', 'SPANDEK HIJAU 0.30', 'Mtr', '48.00', '49.50', '2024-04-04', '02:54:34', 0),
(1131, '0', 'produksi', 'keluar', 'SO-27022024-2', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '207.50', '-3958.46', '2024-04-04', '02:54:36', 0),
(1132, '0', 'produksi', 'masuk', 'SO-27022024-2', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '64.90', '-4645.20', '2024-04-04', '02:54:36', 0),
(1133, '0', 'produksi', 'masuk', 'SO-27022024-2', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '96.00', '-4549.20', '2024-04-04', '02:54:36', 0),
(1134, '0', 'produksi', 'masuk', 'SO-27022024-2', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '30.80', '-4518.40', '2024-04-04', '02:54:36', 0),
(1135, '0', 'produksi', 'masuk', 'SO-27022024-2', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '15.80', '-4502.60', '2024-04-04', '02:54:36', 0),
(1136, '0', 'produksi', 'keluar', 'SO-27022024-3', '30', 'BH003', 'GALVALUME 0.27 X 914', 'Mtr', '26.10', '-4369.38', '2024-04-04', '02:54:38', 0),
(1137, '0', 'produksi', 'masuk', 'SO-27022024-3', '8', 'MP003', 'SPANDEK SILVER 0.35', 'Mtr', '26.10', '3779.58', '2024-04-04', '02:54:38', 0),
(1138, '0', 'produksi', 'keluar', 'SO-27022024-4', '52', 'BH0025', 'PPGL MAROON 0.33 X 914', 'Mtr', '43.20', '-348.80', '2024-04-04', '02:54:40', 0),
(1139, '0', 'produksi', 'masuk', 'SO-27022024-4', '13', 'MP008', 'SPANDEK MAROON 0.40', 'Mtr', '6.00', '311.60', '2024-04-04', '02:54:40', 0),
(1140, '0', 'produksi', 'masuk', 'SO-27022024-4', '13', 'MP008', 'SPANDEK MAROON 0.40', 'Mtr', '37.20', '348.80', '2024-04-04', '02:54:40', 0),
(1141, '0', 'produksi', 'keluar', 'SO-27022024-5', '43', 'BH0016', 'INDOLUM 0.50 BMT X 152', 'Mtr', '210.00', '-10740.00', '2024-04-04', '02:54:42', 0),
(1142, '0', 'produksi', 'keluar', 'SO-27022024-5', '45', 'BH0018', 'INDOLUM 0.60 BMT X 152', 'Mtr', '180.00', '-3672.00', '2024-04-04', '02:54:42', 0),
(1143, '0', 'produksi', 'masuk', 'SO-27022024-5', '34', 'MP0029', 'CANAL DALLE 75.65', 'Mtr', '180.00', '2142.00', '2024-04-04', '02:54:42', 0),
(1144, '0', 'produksi', 'masuk', 'SO-27022024-5', '36', 'MP0031', 'CANAL DALLE 75.65R', 'Mtr', '210.00', '4560.00', '2024-04-04', '02:54:42', 0),
(1145, '0', 'produksi', 'keluar', 'SO-05122023-6', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '2571.30', '-6529.76', '2024-04-27', '02:43:49', 0),
(1146, '0', 'produksi', 'masuk', 'SO-05122023-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '945.00', '-3557.60', '2024-04-27', '02:43:49', 0),
(1147, '0', 'produksi', 'masuk', 'SO-05122023-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '1626.30', '-1931.30', '2024-04-27', '02:43:49', 0),
(1148, '0', 'produksi', 'keluar', 'SO-26022024-6', '32', 'BH005', 'PPGL MAROON 0.23 X 914', 'Mtr', '185.00', '-6714.76', '2024-04-27', '02:54:16', 0),
(1149, '0', 'produksi', 'keluar', 'SO-26022024-6', '36', 'BH009', 'PPGL BIRU 0.23 X 914', 'Mtr', '75.00', '-617.20', '2024-04-27', '02:54:16', 0),
(1150, '0', 'produksi', 'keluar', 'SO-26022024-6', '41', 'BH0014', 'INDOLUM 0.40 BMT X 101', 'Mtr', '600.00', '-19878.00', '2024-04-27', '02:54:16', 0),
(1151, '0', 'produksi', 'masuk', 'SO-26022024-6', '42', 'MP0037', 'RENG DALLE 30.45', 'Mtr', '600.00', '2751.00', '2024-04-27', '02:54:16', 0),
(1152, '0', 'produksi', 'masuk', 'SO-26022024-6', '15', 'MP0010', 'SPANDEK BIRU 0.30', 'Mtr', '50.00', '50.00', '2024-04-27', '02:54:16', 0),
(1153, '0', 'produksi', 'masuk', 'SO-26022024-6', '15', 'MP0010', 'SPANDEK BIRU 0.30', 'Mtr', '25.00', '75.00', '2024-04-27', '02:54:16', 0),
(1154, '0', 'produksi', 'masuk', 'SO-26022024-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '60.00', '-1871.30', '2024-04-27', '02:54:16', 0),
(1155, '0', 'produksi', 'masuk', 'SO-26022024-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '50.00', '-1821.30', '2024-04-27', '02:54:16', 0),
(1156, '0', 'produksi', 'masuk', 'SO-26022024-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '40.00', '-1781.30', '2024-04-27', '02:54:16', 0),
(1157, '0', 'produksi', 'masuk', 'SO-26022024-6', '11', 'MP006', 'SPANDEK MAROON 0.30', 'Mtr', '35.00', '-1746.30', '2024-04-27', '02:54:16', 0),
(1158, '0', 'produksi', 'keluar', 'SO-08032024-5', '29', 'BH002', 'GALVALUME 0.23 X 914', 'Mtr', '13.00', '-11811.20', '2024-04-27', '02:57:03', 0),
(1159, '0', 'produksi', 'masuk', 'SO-08032024-5', '7', 'MP002', 'SPANDEK SILVER 0.30', 'Mtr', '9.00', '-697.12', '2024-04-27', '02:57:03', 0),
(1160, '0', 'penjualan', 'keluar', 'SO-28022024-8', '6', 'MP001', 'SPANDEK SILVER 0.25', 'Mtr', '41.20', NULL, '2024-02-28', '03:12:19', 0),
(1161, '0', 'penjualan', 'keluar', 'SO-28022024-8', '42', 'MP0037', 'RENG DALLE 30.45', 'Mtr', '300.00', NULL, '2024-02-28', '03:12:19', 0);

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
(1, '393621bd7bad14338cdf4bc5fe01ce5f.jpg', 'DWIKARYA SUKSES BERSAMA', '085399793558', 'Makassar', 'Jl. Komp Pergud Parangloe blok i4/17');

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
  `pembelian_proses` text NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_nomor` text NOT NULL,
  `pembelian_barang_barang` text NOT NULL,
  `pembelian_barang_berat` text NOT NULL,
  `pembelian_barang_panjang` text NOT NULL,
  `pembelian_barang_harga` text NOT NULL,
  `pembelian_barang_total` text NOT NULL,
  `pembelian_barang_ekspedisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_barang`
--

CREATE TABLE `t_penjualan_barang` (
  `penjualan_barang_id` int(11) NOT NULL,
  `penjualan_barang_nomor` text NOT NULL,
  `penjualan_barang_barang` text NOT NULL,
  `penjualan_barang_stok` text DEFAULT '0',
  `penjualan_barang_konversi` text DEFAULT '0',
  `penjualan_barang_panjang` text DEFAULT '0',
  `penjualan_barang_batang` text DEFAULT '0',
  `penjualan_barang_qty` text DEFAULT '0',
  `penjualan_barang_panjang_total` text DEFAULT '0',
  `penjualan_barang_harga` text NOT NULL,
  `penjualan_barang_hps` text NOT NULL,
  `penjualan_barang_total` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `t_produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_merk`, `produk_konversi`, `produk_ketebalan`, `produk_keterangan`, `produk_colly`, `produk_update`, `produk_tanggal`, `produk_hapus`) VALUES
(6, 'MP001', 'SPANDEK SILVER 0.25', 'DALLE DECK', '', '0.25', '-', '0', '2024-01-25', '2024-01-25', 0),
(7, 'MP002', 'SPANDEK SILVER 0.30', 'DALLE DECK', '', '0.35', '-', '1', '2024-01-25', '2024-01-25', 0),
(8, 'MP003', 'SPANDEK SILVER 0.35', 'DALLE DECK', '', '0.35', '-', '1', '2024-01-25', '2024-01-25', 0),
(9, 'MP004', 'SPANDEK SILVER 0.40', 'DALLE DECK', '', '0.40', '-', '1', '2024-01-25', '2024-01-25', 0),
(10, 'MP005', 'SPANDEK MAROON 0.25', 'DALLE DECK', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(11, 'MP006', 'SPANDEK MAROON 0.30', 'DALLE DECK', '', '0.30', '0', '1', '2024-01-26', '2024-01-26', 0),
(12, 'MP007', 'SPANDEK MAROON 0.35', 'DALLE DECK', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(13, 'MP008', 'SPANDEK MAROON 0.40', 'DALLE DECK', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(14, 'MP009', 'SPANDEK BIRU 0.25', 'DALLE DECK', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(15, 'MP0010', 'SPANDEK BIRU 0.30', 'DALLE DECK', '', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(16, 'MP0011', 'SPANDEK BIRU 0.35', 'DALLE DECK', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(17, 'MP0012', 'SPANDEK BIRU 0.40', 'DALLE DECK', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(18, 'MP0013', 'SPANDEK HIJAU 0.25', 'DALLE DECK', '', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(19, 'MP0014', 'SPANDEK HIJAU 0.30', 'DALLE DECK', '', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(20, 'MP0015', 'SPANDEK HIJAU 0.35', 'DALLE DECK', '', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(21, 'MP0016', 'SPANDEK HIJAU 0.40', 'DALLE DECK', '', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(22, 'MP0017', 'CANAL SOLID 75.75', 'SOLID', '6', '0.75', '-', '1', '2024-01-26', '2024-01-26', 0),
(23, 'MP0018', 'CANAL SOLID 75.75P', 'SOLID', '6', '0.70', '-', '1', '2024-01-26', '2024-01-26', 0),
(24, 'MP0019', 'CANAL SOLID 75.65', 'SOLID', '6', '0.65', '-', '1', '2024-01-26', '2024-01-26', 0),
(25, 'MP0020', 'CANAL SOLID 75.65P', 'SOLID', '6', '0.60', '-', '1', '2024-01-26', '2024-01-26', 0),
(26, 'MP0021', 'CANAL SOLID 75.65R', 'SOLID', '6', '0.55', '-', '1', '2024-01-26', '2024-01-26', 0),
(27, 'MP0022', 'CANAL SOLID 75.65K', 'SOLID', '6', '0.50', '-', '1', '2024-01-26', '2024-01-26', 0),
(28, 'MP0023', 'HOLLOW SOLID 0.25', 'SOLID', '4', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(29, 'MP0024', 'HOLLOW SOLID 0.30', 'SOLID', '4', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(30, 'MP0025', 'RENG SOLID 30.45', 'SOLID', '6', '0.45', '-', '1', '2024-01-26', '2024-01-26', 0),
(31, 'MP0026', 'RENG SOLID 30.40', 'SOLID', '6', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(32, 'MP0027', 'CANAL DALLE 75.75', 'DALLE', '6', '0.75', '-', '1', '2024-01-26', '2024-01-26', 0),
(33, 'MP0028', 'CANAL DALLE 75.75P', 'DALLE', '6', '0.70', '-', '1', '2024-01-26', '2024-01-26', 0),
(34, 'MP0029', 'CANAL DALLE 75.65', 'DALLE', '6', '0.65', '-', '1', '2024-01-26', '2024-01-26', 0),
(35, 'MP0030', 'CANAL DALLE 75.65P', 'DALLE', '6', '0.60', '-\r\n', '1', '2024-01-26', '2024-01-26', 0),
(36, 'MP0031', 'CANAL DALLE 75.65R', 'DALLE', '6', '0.55', '-', '1', '2024-01-26', '2024-01-26', 0),
(37, 'MP0032', 'CANAL DALLE 75.65K', 'DALLE', '6', '0.50', '-', '1', '2024-01-26', '2024-01-26', 0),
(38, 'MP0033', 'HOLLOW DALLE 0.25', 'DALLE', '4', '0.25', '-', '1', '2024-01-26', '2024-01-26', 0),
(39, 'MP0034', 'HOLLOW DALLE 0.30', 'DALLE', '4', '0.30', '-', '1', '2024-01-26', '2024-01-26', 0),
(40, 'MP0035', 'HOLLOW DALLE 0.35', 'DALLE', '4', '0.35', '-', '1', '2024-01-26', '2024-01-26', 0),
(41, 'MP0036', 'RENG DALLE 30.40', 'DALLE', '6', '0.40', '-', '1', '2024-01-26', '2024-01-26', 0),
(42, 'MP0037', 'RENG DALLE 30.45', 'DALLE', '6', '0.45', '-', '1', '2024-01-26', '2024-01-26', 0),
(45, 'MP0038', 'SPANDEK SILVER 0.40 AZ100', 'SOLID', '', '0.40', '-', '1', '2024-04-05', '2024-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_proses` text DEFAULT NULL,
  `produksi_so` int(11) NOT NULL DEFAULT 0,
  `produksi_so_tanggal` date DEFAULT NULL,
  `produksi_pelanggan` text DEFAULT NULL,
  `produksi_nomor` text NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_barang`
--

CREATE TABLE `t_produksi_barang` (
  `produksi_barang_id` int(11) NOT NULL,
  `produksi_barang_nomor` text NOT NULL,
  `produksi_barang_barang` text NOT NULL,
  `produksi_barang_stok` text NOT NULL DEFAULT '0',
  `produksi_barang_panjang` text NOT NULL DEFAULT '0',
  `produksi_barang_berat` text NOT NULL,
  `produksi_barang_harga` text NOT NULL DEFAULT '0',
  `produksi_barang_total` text NOT NULL DEFAULT '0',
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `produksi_produksi_panjang_total` text NOT NULL,
  `produksi_produksi_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `produk_gudang_harga` text DEFAULT '0',
  `produk_gudang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk_gudang`
--

INSERT INTO `t_produk_gudang` (`produk_gudang_id`, `produk_gudang_gudang`, `produk_gudang_produk`, `produk_gudang_panjang`, `produk_gudang_hps`, `produk_gudang_harga`, `produk_gudang_tanggal`) VALUES
(16, '0', '6', '0.00', '0', '11000', '2024-01-30'),
(17, '0', '7', '0.00', '0', '12000', '2024-01-30'),
(18, '0', '28', '0.00', '0', '0', '2024-02-01'),
(19, '0', '29', '0.00', '0', '0', '2024-02-01'),
(20, '0', '22', '0.00', '0', '0', '2024-02-11'),
(21, '0', '9', '0.00', '0', '0', '2024-02-11'),
(22, '0', '15', '0.00', '0', '0', '2024-02-18'),
(23, '0', '24', '0.00', '0', '0', '2024-02-18'),
(24, '0', '31', '0.00', '0', '0', '2024-02-18'),
(25, '0', '42', '0.00', '0', '0', '2024-03-07'),
(26, '0', '36', '0.00', '0', '0', '2024-03-07'),
(27, '', '12', '0.00', '0', '0', '2024-04-27'),
(28, '0', '10', '0.00', '0', '0', '2024-04-27'),
(29, '0', '11', '0.00', '0', '0', '2024-04-27'),
(30, '0', '12', '0.00', '0', '0', '2024-04-27'),
(31, '0', '13', '0.00', '0', '0', '2024-04-27'),
(32, '0', '14', '0.00', '0', '0', '2024-04-27'),
(33, '0', '16', '0.00', '0', '0', '2024-04-27'),
(34, '0', '17', '0.00', '0', '0', '2024-04-27'),
(35, '0', '18', '0.00', '0', '0', '2024-04-27'),
(36, '0', '19', '0.00', '0', '0', '2024-04-27'),
(37, '0', '20', '0.00', '0', '0', '2024-04-27'),
(38, '0', '21', '0.00', '0', '0', '2024-04-27'),
(39, '0', '23', '0.00', '0', '0', '2024-04-27'),
(40, '0', '25', '0.00', '0', '0', '2024-04-27'),
(41, '0', '26', '0.00', '0', '0', '2024-04-27'),
(42, '0', '27', '0.00', '0', '0', '2024-04-27'),
(43, '0', '30', '0.00', '0', '0', '2024-04-27'),
(44, '0', '32', '0.00', '0', '0', '2024-04-27'),
(45, '0', '33', '0.00', '0', '0', '2024-04-27'),
(46, '0', '34', '0.00', '0', '0', '2024-04-27'),
(47, '0', '35', '0.00', '0', '0', '2024-04-27'),
(48, '0', '39', '0.00', '0', '0', '2024-04-27'),
(49, '0', '41', '0.00', '0', '0', '2024-04-27'),
(50, '0', '8', '0.00', '0', '0', '2024-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_rekening`
--

CREATE TABLE `t_rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_nama` text NOT NULL,
  `rekening_bank` text NOT NULL,
  `rekening_no` text NOT NULL,
  `rekening_tanggal` date NOT NULL DEFAULT curdate(),
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
-- Indexes for table `t_bank`
--
ALTER TABLE `t_bank`
  ADD PRIMARY KEY (`bank_id`);

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
-- Indexes for table `t_jurnal_old`
--
ALTER TABLE `t_jurnal_old`
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
  ADD PRIMARY KEY (`produksi_produksi_id`) USING BTREE;

--
-- Indexes for table `t_produk_gudang`
--
ALTER TABLE `t_produk_gudang`
  ADD PRIMARY KEY (`produk_gudang_id`) USING BTREE;

--
-- Indexes for table `t_rekening`
--
ALTER TABLE `t_rekening`
  ADD PRIMARY KEY (`rekening_id`);

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
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `t_bahan_gudang`
--
ALTER TABLE `t_bahan_gudang`
  MODIFY `bahan_gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `t_bank`
--
ALTER TABLE `t_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

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
-- AUTO_INCREMENT for table `t_gudang`
--
ALTER TABLE `t_gudang`
  MODIFY `gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jurnal_old`
--
ALTER TABLE `t_jurnal_old`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `t_kartu`
--
ALTER TABLE `t_kartu`
  MODIFY `kartu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1162;

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
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_produksi_produksi`
--
ALTER TABLE `t_produksi_produksi`
  MODIFY `produksi_produksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_produk_gudang`
--
ALTER TABLE `t_produk_gudang`
  MODIFY `produk_gudang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_rekening`
--
ALTER TABLE `t_rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
