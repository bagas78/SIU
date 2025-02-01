-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table siu.t_absen: ~0 rows (approximately)

-- Dumping data for table siu.t_bahan: ~30 rows (approximately)
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

-- Dumping data for table siu.t_bahan_gudang: ~0 rows (approximately)

-- Dumping data for table siu.t_bahan_item: ~0 rows (approximately)

-- Dumping data for table siu.t_bank: ~141 rows (approximately)
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

-- Dumping data for table siu.t_cetak: ~0 rows (approximately)

-- Dumping data for table siu.t_coa: ~9 rows (approximately)
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

-- Dumping data for table siu.t_coa_sub: ~5 rows (approximately)
INSERT INTO `t_coa_sub` (`coa_sub_id`, `coa_sub_nomor`, `coa_sub_akun`, `coa_sub_plus`, `coa_sub_min`, `coa_sub_tanggal`) VALUES
	(1, '111', 'Harta', 'D', 'K', '2023-01-27'),
	(2, '121', 'Utang', 'K', 'D', '2023-01-27'),
	(3, '131', 'Modal', 'K', 'D', '2023-01-27'),
	(4, '141', 'Pendapatan', 'K', 'D', '2023-01-27'),
	(5, '151', 'Beban', 'D', 'K', '2023-01-27');

-- Dumping data for table siu.t_ekspedisi: ~4 rows (approximately)
INSERT INTO `t_ekspedisi` (`ekspedisi_id`, `ekspedisi_kode`, `ekspedisi_nama`, `ekspedisi_keterangan`, `ekspedisi_hapus`, `ekspedisi_tanggal`) VALUES
	(1, 'EXPEDISI-001', 'EKONOMI', 'Jalur Gaza', 1, '2023-08-12'),
	(2, 'EXPEDISI-002', 'CARGO EXPRESS ABC', 'Jalur Selat Malaka', 1, '2023-11-10'),
	(3, 'ABC', 'TEST', NULL, 1, '2023-12-17'),
	(4, 'EKS01', 'PT. MANDALIKA PUTRA TRANS', NULL, 0, '2024-01-25');

-- Dumping data for table siu.t_filter: ~0 rows (approximately)

-- Dumping data for table siu.t_gudang: ~2 rows (approximately)
INSERT INTO `t_gudang` (`gudang_id`, `gudang_kode`, `gudang_nama`, `gudang_keterangan`, `gudang_hapus`, `gudang_tanggal`) VALUES
	(0, 'GD000', 'Gudang Utama', NULL, 0, '0000-00-00'),
	(2, 'GD001', 'Gudang A', NULL, 0, '2023-09-03');

-- Dumping data for table siu.t_jurnal: ~0 rows (approximately)

-- Dumping data for table siu.t_kartu: ~0 rows (approximately)

-- Dumping data for table siu.t_karyawan: ~12 rows (approximately)
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

-- Dumping data for table siu.t_kontak: ~76 rows (approximately)
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

-- Dumping data for table siu.t_level: ~1 rows (approximately)
INSERT INTO `t_level` (`level_id`, `level_nama`, `level_akses`, `level_tanggal`, `level_hapus`) VALUES
	(3, 'Kasir', '{"nama":"Kasir","menu_dashboard":"0","menu_kontak":"0","karyawan":"0","karyawan_add":"0","karyawan_del":"0","supplier":"0","supplier_add":"0","supplier_del":"0","pelanggan":"0","pelanggan_add":"0","pelanggan_del":"0","rekening":"0","rekening_add":"0","rekening_del":"0","menu_pembelian":"0","bahan":"1","bahan_add":"0","bahan_del":"0","bahan_po":"1","bahan_po_add":"1","bahan_po_del":"1","pembelian_bahan":"1","pembelian_bahan_add":"1","pembelian_bahan_del":"1","pembelian_umum":"1","pembelian_umum_add":"1","pembelian_umum_del":"1","hutang":"1","hutang_add":"1","menu_produksi":"0","mesin":"0","mesin_add":"0","mesin_del":"0","peleburan":"0","peleburan_add":"0","peleburan_del":"0","produksi":"0","produksi_add":"0","produksi_del":"0","pewarnaan":"0","pewarnaan_add":"0","pewarnaan_del":"0","packing":"0","packing_add":"0","packing_del":"0","menu_produk":"0","jenis_pewarnaan":"0","jenis_pewarnaan_add":"0","warna_produk":"0","warna_produk_add":"0","warna_produk_del":"0","master_produk":"1","master_produk_add":"0","master_produk_del":"0","menu_penjualan":"0","penjualan_po":"1","penjualan_po_add":"1","penjualan_po_del":"1","penjualan_produk":"1","penjualan_produk_add":"1","penjualan_produk_del":"1","piutang":"1","piutang_add":"1","menu_keuangan":"0","coa":"0","coa_add":"0","coa_del":"0","kas":"0","kas_add":"0","kas_del":"0","jurnal":"0","jurnal_add":"0","jurnal_del":"0","buku_besar":"0","buku_besar_add":"0","buku_besar_del":"0","penyesuaian":"0","penyesuaian_add":"0","penyesuaian_del":"0","menu_laporan":"0","laporan_bahan":"1","laporan_produk":"1","laporan_produksi":"0","laporan_pembelian_po":"1","laporan_pembelian":"1","laporan_hutang":"1","laporan_hutang_jatuh_tampo":"1","laporan_penjualan":"1","laporan_piutang":"1","laporan_piutang_jatuh_tampo":"1","laporan_packing":"0","menu_inventori":"0","opname_pembelian":"0","opname_penjualan":"0","penyesuaian_stok":"0","penyesuaian_stok_add":"0","penyesuaian_stok_del":"0","menu_akun":"0","akses":"0","akses_add":"0","akses_del":"0","user_akun":"0","user_akun_add":"0","user_akun_del":"0","admin_akun":"0","admin_akun_add":"0","admin_akun_del":"0","menu_pengaturan":"0","pajak":"0","pajak_add":"0","backup":"0","informasi":"0"}', '2023-06-01', 0);

-- Dumping data for table siu.t_logo: ~1 rows (approximately)
INSERT INTO `t_logo` (`logo_id`, `logo_foto`, `logo_nama`, `logo_telp`, `logo_kota`, `logo_alamat`) VALUES
	(1, '8070be03d83f8954076632975a7c8429.jpg', 'WEB APLIKASI SIU', '021-7980421', 'Jakarta', 'JL. Raya Pasar Minggu No. 17 Jakarta Selatan 12520');

-- Dumping data for table siu.t_mesin: ~4 rows (approximately)
INSERT INTO `t_mesin` (`mesin_id`, `mesin_kode`, `mesin_nama`, `mesin_hapus`, `mesin_tanggal`) VALUES
	(6, 'VS002', 'MESIN CANAL', 0, '2023-06-20'),
	(7, 'VS001', 'MESIN SPANDEK 5 GELOMBANG', 0, '2023-12-17'),
	(8, 'VS003', 'MESIN HOLLOW 2X4', 0, '2024-01-25'),
	(9, 'VS004', 'MESIN RENG', 0, '2024-01-25');

-- Dumping data for table siu.t_pajak: ~2 rows (approximately)
INSERT INTO `t_pajak` (`pajak_id`, `pajak_jenis`, `pajak_persen`, `pajak_tanggal`, `pajak_update`) VALUES
	(1, 'pembelian', '11', '2022-12-03', '2022-12-02 17:49:05'),
	(2, 'penjualan', '11', '2022-12-03', '2022-12-02 17:49:10');

-- Dumping data for table siu.t_pembelian: ~0 rows (approximately)

-- Dumping data for table siu.t_pembelian_barang: ~0 rows (approximately)

-- Dumping data for table siu.t_pembelian_partial: ~0 rows (approximately)

-- Dumping data for table siu.t_pembelian_terima: ~0 rows (approximately)

-- Dumping data for table siu.t_pembelian_umum: ~0 rows (approximately)

-- Dumping data for table siu.t_pembelian_umum_barang: ~0 rows (approximately)

-- Dumping data for table siu.t_penjualan: ~0 rows (approximately)

-- Dumping data for table siu.t_penjualan_barang: ~0 rows (approximately)

-- Dumping data for table siu.t_penyesuaian: ~0 rows (approximately)

-- Dumping data for table siu.t_penyesuaian_barang: ~0 rows (approximately)

-- Dumping data for table siu.t_produk: ~38 rows (approximately)
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

-- Dumping data for table siu.t_produksi: ~0 rows (approximately)

-- Dumping data for table siu.t_produksi_barang: ~0 rows (approximately)

-- Dumping data for table siu.t_produksi_log: ~0 rows (approximately)

-- Dumping data for table siu.t_produksi_produksi: ~0 rows (approximately)

-- Dumping data for table siu.t_produk_gudang: ~0 rows (approximately)

-- Dumping data for table siu.t_rekening: ~2 rows (approximately)
INSERT INTO `t_rekening` (`rekening_id`, `rekening_nama`, `rekening_bank`, `rekening_no`, `rekening_tanggal`, `rekening_hapus`) VALUES
	(7, 'BCA', '8', '158895555', '2023-09-27', 0),
	(8, 'BRI', '1', '03430108888303', '2023-12-17', 0);

-- Dumping data for table siu.t_saldo: ~0 rows (approximately)

-- Dumping data for table siu.t_satuan: ~9 rows (approximately)
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

-- Dumping data for table siu.t_user: ~3 rows (approximately)
INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
	(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'JTM', '2021-11-09', '085555111555', 'Alamat', 'Biodata', '4c293a141d8c17800a44b816d35238cd.png', 0, NULL, NULL, NULL, '2023-02-09', 0),
	(78, 'DSB@GMAIL.COM', 'afa0b885505255964c06188e2b4e8f59', 'YUNI', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2022-12-04', 0),
	(84, 'kasir@gmail.com', 'c7911af3adbd12a035b289556d96470a', 'Kasir JTM', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2023-06-02', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
