-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 04:49 AM
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
-- Database: `web_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_agenda`
--

CREATE TABLE `t_agenda` (
  `agenda_id` int(11) NOT NULL,
  `agenda_judul` text NOT NULL,
  `agenda_kategori` varchar(50) NOT NULL,
  `agenda_isi` text NOT NULL,
  `agenda_tgl` varchar(50) NOT NULL,
  `agenda_sampul` text NOT NULL,
  `agenda_author` varchar(50) NOT NULL,
  `agenda_edit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_agenda`
--

INSERT INTO `t_agenda` (`agenda_id`, `agenda_judul`, `agenda_kategori`, `agenda_isi`, `agenda_tgl`, `agenda_sampul`, `agenda_author`, `agenda_edit`) VALUES
(3, 'Agenda Title 1', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '11-09-2019', 'Penguins.jpg', '1', '1'),
(4, 'Agenda Title 2', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Lighthouse.jpg', '1', '1'),
(5, 'Agenda Title 3', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Lighthouse.jpg', '1', '1'),
(6, 'Agenda Title 4', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Chrysanthemum.jpg', '1', '1'),
(7, 'Agenda Title 6', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Penguins.jpg', '1', '1'),
(8, 'Agenda Title 6', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Penguins.jpg', '1', '1'),
(9, 'Agenda Title 6', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Penguins.jpg', '1', '1'),
(10, 'Agenda Title 6', '7', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '17-09-2019', 'Penguins.jpg', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_album`
--

CREATE TABLE `t_album` (
  `album_id` int(11) NOT NULL,
  `album_name` varchar(50) NOT NULL,
  `album_foto` varchar(50) NOT NULL,
  `album_tanggal` date NOT NULL,
  `album_jenis` set('galery','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_album`
--

INSERT INTO `t_album` (`album_id`, `album_name`, `album_foto`, `album_tanggal`, `album_jenis`) VALUES
(42, 'test', 'Penguins.jpg', '2019-09-09', 'video'),
(44, 'Album', 'biodata.png', '2024-11-03', 'galery');

-- --------------------------------------------------------

--
-- Table structure for table `t_artikel`
--

CREATE TABLE `t_artikel` (
  `artikel_id` int(11) NOT NULL,
  `artikel_judul` varchar(50) NOT NULL,
  `artikel_kategori` varchar(50) NOT NULL,
  `artikel_isi` text NOT NULL,
  `artikel_tgl` date NOT NULL,
  `artikel_sampul` text NOT NULL,
  `artikel_author` varchar(50) NOT NULL,
  `artikel_edit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_artikel`
--

INSERT INTO `t_artikel` (`artikel_id`, `artikel_judul`, `artikel_kategori`, `artikel_isi`, `artikel_tgl`, `artikel_sampul`, `artikel_author`, `artikel_edit`) VALUES
(5, 'Article Title 2', '3', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-06-10', 'noimage_(1).png', '1', '1'),
(6, 'Article Title 4', '3', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-06-11', 'noimage_(1).png', '1', '1'),
(7, 'Article Title 5', '10', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-05-06', 'noimage_(1).png', '1', '1'),
(8, 'Article Title 3', '3', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-06-11', 'noimage_(1).png', '1', '1'),
(9, 'Article Title 6', '10', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-05-06', 'noimage_(1).png', '1', '1'),
(11, 'Article Title 1', '10', '<p>KKN Desa Penari sudah menyita perhatian publik beberapa bulan belakangan ini. Kisah KKN yang cukup horor sekaligus tragis ini bikin banyak orang penasaran. Munculnya inisial dan clue tentang lokasi yang diceritakan oleh SimpleMan bikin orang pengen menemukan lokasinya. Rasa penasaran yang tinggi itulah yang membuat para Youtuber mencari keberadaan desa yang dianggap lokasinya berada di Banyuwangi tersebut.</p>\r\n\r\n<p>Ada beberapa Youtuber yang rela mencari lokasi KKN Desa Penari hingga ke pelosok-pelosok desa. Sampai sekarang belum ada yang bisa menemukan desa sesuai dengan deskripsi SimpleMan. Namun di antara desa-desa yang dicari, kampung Dukuh di desa Kemiren ini jadi lokasi yang paling sesuai dengan kisah KKN Desa Penari. Penasaran kan? Yuk simak penelusurannya.</p>\r\n\r\n<p>Pertama, Simple Man menyebut clue untuk lokasi KKN yakni hutan D, desa W, kecamatan K, kabupaten B. Inisial D maksudnya hutan larangan di kampung Dukuh, desa Kemiren dulu namanya Watu Ulo, atau bisa juga Kemiren dianggap kecamatan dan Kabupaten Banyuwangi. Jalanan menuju ke sana juga sulit dilewati mobil karena cuma jalan setapak. Mirip setting lokasi KKN Desa Penari.</p>\r\n\r\n<p>Kedua, di kampung Dukuh ada sendang bernama sendang Kamulyan dan sendang Panguripan, petilasan atau makam dari Putri Nilam Narendra dari Pasundan (kemungkinan ini samaran nama dari Badarawuhi), serta batu Megalitikum yang dianggap keramat (ingat lokasi genderuwo di balik batu di cerita KKN). Makam keramat tersebut juga ditutup kain warna putih. Tak jauh dari kampung ini juga terdapat hutan larangan yang angker atau dimensi ke dunia ghaib. Namanya hutan larangan Cempaka Putih, jadi memang tidak semua orang boleh atau bisa masuk ke sana. Beberapa aspek secara lokasi ini sangat mirip dengan penggambaran Desa Penari meskipun tidak mirip 100 %. SimpleMan juga sudah mengatakan bahwa ada beberapa bagian yang disamarkan.</p>\r\n', '2019-05-06', 'noimage_(1).png', '1', '1'),
(12, 'Article Title 6', '10', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-05-06', 'noimage_(1).png', '1', '1'),
(13, 'Article Title 6', '10', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2019-05-06', 'noimage_(1).png', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_user`
--

CREATE TABLE `t_detail_user` (
  `detail_id` int(11) NOT NULL,
  `detail_id_user` int(11) NOT NULL,
  `detail_jabatan` varchar(50) NOT NULL,
  `detail_pendidikan` text NOT NULL,
  `detail_alamat` text NOT NULL,
  `detail_biodata` text NOT NULL,
  `detail_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_detail_user`
--

INSERT INTO `t_detail_user` (`detail_id`, `detail_id_user`, `detail_jabatan`, `detail_pendidikan`, `detail_alamat`, `detail_biodata`, `detail_file`) VALUES
(1, 1, 'Pekerjaan anda', 'S3', 'ini alamat', 'Jujur dan nasionalis', 'Config___Administrator.pdf'),
(3, 2, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_feedback`
--

CREATE TABLE `t_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_email` text NOT NULL,
  `feedback_isi` text NOT NULL,
  `feedback_tanggal` date NOT NULL,
  `feedback_status` set('belum dibaca','sudah dibaca') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_feedback`
--

INSERT INTO `t_feedback` (`feedback_id`, `feedback_email`, `feedback_isi`, `feedback_tanggal`, `feedback_status`) VALUES
(3, 'mail@gmail.com', 'keren', '2019-09-09', 'sudah dibaca'),
(4, 'mail@gmail.com', 'keren', '2019-09-09', 'sudah dibaca'),
(10, 'test@gmail.com', '		sip		\r\n			', '2019-09-22', 'sudah dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `t_footer`
--

CREATE TABLE `t_footer` (
  `footer_id` int(11) NOT NULL,
  `footer_name` varchar(50) DEFAULT NULL,
  `footer_value` text DEFAULT NULL,
  `footer_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_footer`
--

INSERT INTO `t_footer` (`footer_id`, `footer_name`, `footer_value`, `footer_status`) VALUES
(1, 'facebook', '#', 'yes'),
(2, 'twitter', '#', 'yes'),
(3, 'instagram', '#', 'yes'),
(4, 'youtube', '#', 'yes'),
(5, 'addres', 'Jatitengah Selopuro, Blitar Regency, East Java, Indonesia', 'yes'),
(6, 'no_telp', '(0342) 694598', 'yes'),
(7, 'kodepos', '66184', 'yes'),
(8, 'embed_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15798.565203540598!2d112.29978204999999!3d-8.1379505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78944e6dc0804d%3A0x776565dc2471337a!2sJatitengah%2C%20Kec.%20Selopuro%2C%20Kabupaten%20Blitar%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1730604537114!5m2!1sid!2sid', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `t_galery`
--

CREATE TABLE `t_galery` (
  `galery_id` int(11) NOT NULL,
  `galery_name` text NOT NULL,
  `galery_album` text NOT NULL,
  `galery_foto` text NOT NULL,
  `galery_tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_galery`
--

INSERT INTO `t_galery` (`galery_id`, `galery_name`, `galery_album`, `galery_foto`, `galery_tanggal`) VALUES
(29, 'Bijak', '44', 'bijak.jpg', '2024-11-03'),
(30, 'Tari', '44', 'Tari-Klasik.jpeg', '2024-11-03'),
(31, 'Ecobrick', '44', 'pembuatan-ecobrick-dalam-merdeka-belajar-di-bali-18716-dom.jpg', '2024-11-03'),
(32, 'Pemetaan', '44', 'pemetaan.jpg', '2024-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `t_history`
--

CREATE TABLE `t_history` (
  `history_id` int(11) NOT NULL,
  `history_user` int(11) DEFAULT NULL,
  `history_menu` varchar(50) DEFAULT NULL,
  `history_action` varchar(50) DEFAULT NULL,
  `history_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_history`
--

INSERT INTO `t_history` (`history_id`, `history_user`, `history_menu`, `history_action`, `history_tanggal`) VALUES
(74, 1, 'login', 'login-auth', '2019-09-11 02:14:08'),
(75, 1, 'user', 'delete-user', '2019-09-11 02:14:14'),
(76, 1, 'user', 'insert-user', '2019-09-11 02:14:38'),
(77, 2, 'login', 'login-auth', '2019-09-11 02:14:54'),
(78, 1, 'login', 'login-auth', '2019-09-11 02:17:56'),
(79, 1, 'user', 'delete-user', '2019-09-11 02:18:02'),
(80, 1, 'user', 'insert-user', '2019-09-11 02:18:25'),
(81, 1, 'artikel', 'insert-artikel', '2019-09-11 03:15:42'),
(82, 1, 'artikel', 'insert-artikel', '2019-09-11 03:15:57'),
(83, 1, 'feedback', 'status-view', '2019-09-11 04:47:34'),
(84, 1, 'feedback', 'status-view', '2019-09-11 04:47:44'),
(85, 1, 'artikel', 'insert-artikel', '2019-09-11 04:48:47'),
(86, 1, 'user', 'update-user', '2019-09-11 04:50:24'),
(87, 1, 'login', 'login-auth', '2019-09-11 04:50:36'),
(88, 1, 'feedback', 'status-view', '2019-09-11 05:29:08'),
(89, 2, 'login', 'login-auth', '2019-09-12 08:14:08'),
(90, 1, 'login', 'login-auth', '2019-09-12 08:15:23'),
(91, 1, 'login', 'login-auth', '2019-09-13 12:53:39'),
(92, 1, 'galery', 'upload-foto', '2019-09-13 02:02:14'),
(93, 1, 'user', 'ban-user', '2019-09-13 02:09:17'),
(94, 1, 'user', 'ban-user', '2019-09-13 02:09:41'),
(95, 1, 'user', 'ban-user', '2019-09-13 02:09:44'),
(96, 1, 'login', 'login-auth', '2019-09-13 02:10:04'),
(97, 1, 'login', 'login-auth', '2019-09-15 06:42:16'),
(98, 1, 'artikel', 'update-artikel', '2019-09-15 06:42:42'),
(99, 1, 'artikel', 'update-artikel', '2019-09-15 06:42:57'),
(100, 1, 'artikel', 'update-artikel', '2019-09-15 06:43:09'),
(101, 1, 'artikel', 'update-artikel', '2019-09-15 06:58:54'),
(102, 1, 'artikel', 'update-artikel', '2019-09-15 06:59:06'),
(103, 1, 'artikel', 'update-artikel', '2019-09-15 06:59:14'),
(104, 1, 'login', 'login-auth', '2019-09-17 02:05:31'),
(105, 1, 'login', 'login-auth', '2019-09-17 02:27:22'),
(106, 1, 'agenda', 'update-agenda', '2019-09-17 02:33:28'),
(107, 1, 'agenda', 'insert-agenda', '2019-09-17 02:34:24'),
(108, 1, 'agenda', 'insert-agenda', '2019-09-17 02:36:19'),
(109, 1, 'agenda', 'insert-agenda', '2019-09-17 02:37:24'),
(110, 1, 'agenda', 'insert-agenda', '2019-09-17 02:38:28'),
(111, 1, 'login', 'login-auth', '2019-09-17 09:18:48'),
(112, 1, 'artikel', 'update-artikel', '2019-09-17 09:20:03'),
(113, 1, 'artikel', 'update-artikel', '2019-09-17 09:20:18'),
(114, 1, 'artikel', 'update-artikel', '2019-09-17 09:20:29'),
(115, 1, 'artikel', 'update-artikel', '2019-09-17 09:20:45'),
(116, 1, 'artikel', 'update-artikel', '2019-09-17 09:20:57'),
(117, 1, 'artikel', 'update-artikel', '2019-09-17 09:21:07'),
(118, 1, 'artikel', 'update-artikel', '2019-09-17 09:21:41'),
(119, 1, 'artikel', 'update-artikel', '2019-09-17 09:21:41'),
(120, 1, 'artikel', 'update-artikel', '2019-09-17 09:31:24'),
(121, 1, 'artikel', 'update-artikel', '2019-09-17 09:33:52'),
(122, 1, 'artikel', 'update-artikel', '2019-09-17 09:34:25'),
(123, 1, 'artikel', 'update-artikel', '2019-09-17 09:34:46'),
(124, 1, 'artikel', 'update-artikel', '2019-09-17 09:37:28'),
(125, 1, 'galery', 'delete-foto', '2019-09-17 10:48:07'),
(126, 1, 'artikel', 'update-artikel', '2019-09-18 01:30:35'),
(127, 1, 'login', 'login-auth', '2019-09-18 01:56:20'),
(128, 1, 'login', 'login-auth', '2019-09-18 04:23:06'),
(129, 1, 'login', 'login-auth', '2019-09-20 02:23:31'),
(130, 1, 'artikel', 'update-artikel', '2019-09-20 02:24:00'),
(131, 1, 'artikel', 'update-artikel', '2019-09-20 02:27:32'),
(132, 1, 'artikel', 'update-artikel', '2019-09-20 02:28:55'),
(133, 1, 'artikel', 'update-artikel', '2019-09-20 02:29:08'),
(134, 1, 'artikel', 'update-artikel', '2019-09-20 02:29:20'),
(135, 1, 'artikel', 'update-artikel', '2019-09-20 02:29:32'),
(136, 1, 'artikel', 'update-artikel', '2019-09-20 02:31:22'),
(137, 1, 'logo', 'update-foto', '2019-09-20 02:41:31'),
(138, 1, 'logo', 'update-foto', '2019-09-20 02:43:08'),
(139, 1, 'logo', 'update-foto', '2019-09-20 02:43:49'),
(140, 1, 'logo', 'update-foto', '2019-09-20 02:50:14'),
(141, 1, 'login', 'login-auth', '2019-09-20 12:44:23'),
(142, 1, 'logo', 'update-foto', '2019-09-20 12:48:24'),
(143, 1, 'login', 'login-auth', '2019-09-20 09:08:53'),
(144, 1, 'user', 'update-user', '2019-09-20 09:09:06'),
(145, 1, 'submenu', 'selete-submenu', '2019-09-20 09:10:25'),
(146, 1, 'menu', 'update-menu', '2019-09-20 09:23:40'),
(147, 1, 'menu', 'update-menu', '2019-09-20 09:23:57'),
(148, 1, 'menu', 'update-menu', '2019-09-20 09:24:15'),
(149, 1, 'menu', 'update-menu', '2019-09-20 09:24:37'),
(150, 1, 'agenda', 'update-agenda', '2019-09-20 09:32:24'),
(151, 1, 'agenda', 'update-agenda', '2019-09-20 09:32:29'),
(152, 1, 'agenda', 'update-agenda', '2019-09-20 09:32:34'),
(153, 1, 'agenda', 'update-agenda', '2019-09-20 09:32:39'),
(154, 1, 'agenda', 'update-agenda', '2019-09-20 09:32:44'),
(155, 1, 'footer', 'update-footer', '2019-09-20 09:35:43'),
(156, 1, 'logo', 'update-foto', '2019-09-20 10:33:38'),
(157, 1, 'submenu', 'insert-submenu', '2019-09-20 10:36:38'),
(158, 1, 'galery', 'delete-foto', '2019-09-20 10:37:21'),
(159, 1, 'galery', 'delete-foto', '2019-09-20 10:37:23'),
(160, 1, 'galery', 'delete-foto', '2019-09-20 10:37:25'),
(161, 1, 'galery', 'delete-foto', '2019-09-20 10:38:17'),
(162, 1, 'galery', 'delete-foto', '2019-09-20 10:38:18'),
(163, 1, 'galery', 'upload-foto', '2019-09-20 10:38:28'),
(164, 1, 'galery', 'upload-foto', '2019-09-20 10:38:35'),
(165, 1, 'galery', 'upload-foto', '2019-09-20 10:38:42'),
(166, 1, 'galery', 'upload-foto', '2019-09-20 10:39:15'),
(167, 1, 'login', 'login-auth', '2019-09-21 11:40:06'),
(168, 1, 'login', 'login-auth', '2019-09-21 06:30:04'),
(169, 1, 'menu', 'update-menu', '2019-09-21 06:30:15'),
(170, 1, 'menu', 'update-menu', '2019-09-21 07:32:04'),
(171, 1, 'menu', 'update-menu', '2019-09-21 07:34:14'),
(172, 1, 'menu', 'update-menu', '2019-09-21 07:34:28'),
(173, 1, 'menu', 'update-menu', '2019-09-21 07:35:06'),
(174, 1, 'menu', 'update-menu', '2019-09-21 07:39:11'),
(175, 1, 'menu', 'update-menu', '2019-09-21 07:40:00'),
(176, 1, 'menu', 'update-menu', '2019-09-21 07:40:36'),
(177, 1, 'submenu', 'selete-submenu', '2019-09-21 07:57:31'),
(178, 1, 'view_menu', 'insert-view_menu', '2019-09-21 09:51:50'),
(179, 1, 'submenu', 'update-submenu', '2019-09-21 09:53:05'),
(180, 1, 'submenu', 'update-submenu', '2019-09-21 09:53:16'),
(181, 1, 'submenu', 'update-submenu', '2019-09-21 10:11:59'),
(182, 1, 'login', 'login-auth', '2019-09-22 09:12:05'),
(183, 1, 'feedback', 'status-view', '2019-09-22 09:55:55'),
(184, 1, 'feedback', 'status-view', '2019-09-22 09:56:01'),
(185, 1, 'view_menu', 'update-view_menu', '2019-09-22 11:21:23'),
(186, 1, 'view_menu', 'update-view_menu', '2019-09-22 11:22:20'),
(187, 1, 'feedback', 'delete-feeback', '2019-09-22 02:12:45'),
(188, 1, 'feedback', 'status-view', '2019-09-22 02:12:48'),
(189, 1, 'login', 'login-auth', '2019-09-23 09:25:19'),
(190, 1, 'login', 'login-auth', '2019-09-24 10:39:29'),
(191, 1, 'login', 'login-auth', '2019-09-24 10:43:52'),
(192, 1, 'login', 'login-auth', '2019-09-25 12:33:05'),
(193, 1, 'logo', 'update-foto', '2019-09-25 12:42:13'),
(194, 1, 'logo', 'update-foto', '2019-09-25 12:42:33'),
(195, 1, 'submenu', 'selete-submenu', '2019-09-25 02:49:43'),
(196, 1, 'submenu', 'update-submenu', '2019-09-25 02:50:04'),
(197, 1, 'submenu', 'update-submenu', '2019-09-25 02:50:44'),
(198, 1, 'submenu', 'insert-submenu', '2019-09-25 02:52:20'),
(199, 1, 'submenu', 'insert-submenu', '2019-09-25 02:52:44'),
(200, 1, 'view_menu', 'insert-view_menu', '2019-09-25 02:53:15'),
(201, 1, 'view_menu', 'insert-view_menu', '2019-09-25 02:53:26'),
(202, 1, 'login', 'login-auth', '2019-09-25 03:00:36'),
(203, 2, 'login', 'login-auth', '2019-09-25 03:01:33'),
(204, 1, 'login', 'login-auth', '2019-09-25 03:01:52'),
(205, 1, 'login', 'login-auth', '2019-09-25 09:32:49'),
(206, 1, 'view_menu', 'delete-view_menu', '2019-09-25 10:08:30'),
(207, 1, 'view_menu', 'insert-view_menu', '2019-09-25 10:08:42'),
(208, 1, 'login', 'login-auth', '2019-09-25 09:55:04'),
(209, 1, 'login', 'login-auth', '2019-09-27 03:12:14'),
(210, 1, 'galery', 'upload-foto', '2019-09-27 03:13:06'),
(211, 1, 'login', 'login-auth', '2019-10-01 04:26:24'),
(212, 1, 'login', 'login-auth', '2019-10-03 08:11:58'),
(213, 1, 'login', 'login-auth', '2019-10-05 11:21:31'),
(214, 1, 'login', 'login-auth', '2019-10-05 10:30:38'),
(215, 1, 'login', 'login-auth', '2019-10-05 10:34:49'),
(216, 1, 'login', 'login-auth', '2019-10-06 07:09:06'),
(217, 1, 'login', 'login-auth', '2019-10-06 07:33:36'),
(218, 1, 'login', 'login-auth', '2019-10-06 08:06:56'),
(219, 1, 'login', 'login-auth', '2019-10-07 05:50:32'),
(220, 1, 'login', 'login-auth', '2019-10-08 12:22:31'),
(221, 1, 'login', 'login-auth', '2019-10-23 06:55:05'),
(222, 1, 'login', 'login-auth', '2019-10-23 07:24:10'),
(223, 1, 'login', 'login-auth', '2019-10-24 02:37:57'),
(224, 1, 'login', 'login-auth', '2019-10-26 03:20:55'),
(225, 1, 'login', 'login-auth', '2019-10-26 04:51:01'),
(226, 1, 'login', 'login-auth', '2019-10-30 12:54:03'),
(227, 1, 'login', 'login-auth', '2019-11-21 03:24:11'),
(228, 1, 'login', 'login-auth', '2019-11-21 03:45:45'),
(229, 1, 'login', 'login-auth', '2019-12-04 07:47:32'),
(230, 1, 'login', 'login-auth', '2019-12-10 08:15:50'),
(231, 1, 'login', 'login-auth', '2019-12-30 08:02:28'),
(232, 1, 'login', 'login-auth', '2019-12-30 02:08:48'),
(233, 1, 'login', 'login-auth', '2020-01-01 01:59:16'),
(234, 1, 'logo', 'update-foto', '2020-01-01 02:11:39'),
(235, 1, 'login', 'login-auth', '2020-01-01 02:19:27'),
(236, 1, 'login', 'login-auth', '2020-01-01 02:19:53'),
(237, 1, 'footer', 'update-footer', '2020-01-01 02:22:27'),
(238, 1, 'profile', 'update', '2020-01-01 02:42:38'),
(239, 1, 'login', 'login-auth', '2020-01-01 02:42:59'),
(240, 1, 'profile', 'update', '2020-01-01 02:43:20'),
(241, 1, 'menu', 'ban-user', '2020-01-01 02:47:04'),
(242, 1, 'menu', 'update-menu', '2020-01-01 02:47:50'),
(243, 1, 'login', 'login-auth', '2020-01-02 11:29:54'),
(244, 1, 'login', 'login-auth', '2020-01-02 02:30:06'),
(245, 1, 'user', 'update-user', '2020-01-02 02:30:44'),
(246, 1, 'galery', 'delete-foto', '2020-01-02 02:32:06'),
(247, 1, 'galery', 'delete-foto', '2020-01-02 02:32:09'),
(248, 1, 'galery', 'delete-foto', '2020-01-02 02:32:11'),
(249, 1, 'galery', 'delete-foto', '2020-01-02 02:32:13'),
(250, 1, 'galery', 'delete-album', '2020-01-02 02:32:47'),
(251, 1, 'galery', 'delete-album', '2020-01-02 02:32:50'),
(252, 1, 'galery', 'delete-album', '2020-01-02 02:32:52'),
(253, 1, 'galery', 'delete-album', '2020-01-02 02:32:54'),
(254, 1, 'galery', 'delete-album', '2020-01-02 02:32:57'),
(255, 1, 'galery', 'delete-album', '2020-01-02 02:33:00'),
(256, 1, 'galery', 'delete-album', '2020-01-02 02:33:02'),
(257, 1, 'galery', 'delete-album', '2020-01-02 02:33:04'),
(258, 1, 'galery', 'delete-album', '2020-01-02 02:33:06'),
(259, 1, 'galery', 'delete-album', '2020-01-02 02:33:08'),
(260, 1, 'galery', 'delete-album', '2020-01-02 02:33:11'),
(261, 1, 'galery', 'delete-album', '2020-01-02 02:33:13'),
(262, 1, 'galery', 'upload-foto', '2020-01-02 02:34:13'),
(263, 1, 'galery', 'upload-foto', '2020-01-02 02:34:20'),
(264, 1, 'galery', 'upload-foto', '2020-01-02 02:34:30'),
(265, 1, 'logo', 'update-foto', '2020-01-02 02:34:53'),
(266, 1, 'logo', 'update-foto', '2020-01-02 03:56:26'),
(267, 1, 'logo', 'update-foto', '2020-01-02 03:57:56'),
(268, 1, 'logo', 'update-foto', '2020-01-02 04:29:02'),
(269, 1, 'logo', 'update-foto', '2020-01-02 04:35:28'),
(270, 1, 'logo', 'update-foto', '2020-01-02 04:35:48'),
(271, 1, 'logo', 'update-foto', '2020-01-02 04:36:27'),
(272, 1, 'login', 'login-auth', '2020-01-05 01:39:47'),
(273, 1, 'login', 'login-auth', '2020-01-05 01:40:58'),
(274, 1, 'login', 'login-auth', '2020-01-05 01:50:35'),
(275, 1, 'login', 'login-auth', '2020-01-06 03:13:16'),
(276, 1, 'logo', 'update-foto', '2020-01-06 03:13:41'),
(277, 1, 'logo', 'update-foto', '2020-01-06 03:24:13'),
(278, 1, 'login', 'login-auth', '2020-01-06 04:07:48'),
(279, 1, 'login', 'login-auth', '2020-01-06 04:14:02'),
(280, 1, 'menu', 'ban-user', '2020-01-06 04:15:56'),
(281, 1, 'menu', 'ban-user', '2020-01-06 04:16:10'),
(282, 1, 'login', 'login-auth', '2020-01-07 09:04:15'),
(283, 1, 'login', 'login-auth', '2020-01-07 10:17:38'),
(284, 1, 'login', 'login-auth', '2022-01-09 10:17:46'),
(285, NULL, 'profile', 'update', '2022-01-09 11:27:00'),
(286, 1, 'profile', 'update', '2022-01-09 11:27:54'),
(287, 1, 'login', 'login-auth', '2022-01-09 11:38:52'),
(288, 1, 'login', 'login-auth', '2022-01-10 12:06:47'),
(289, 1, 'login', 'login-auth', '2024-11-02 01:29:13'),
(290, 1, 'login', 'login-auth', '2024-11-02 01:30:53'),
(291, 1, 'login', 'login-auth', '2024-11-03 09:24:10'),
(292, 1, 'logo', 'update-foto', '2024-11-03 09:41:50'),
(293, 1, 'logo', 'update-foto', '2024-11-03 09:49:24'),
(294, 1, 'logo', 'update-foto', '2024-11-03 09:53:52'),
(295, 1, 'view_menu', 'update-view_menu', '2024-11-03 09:58:29'),
(296, 1, 'menu', 'update-menu', '2024-11-03 09:59:35'),
(297, 1, 'menu', 'update-menu', '2024-11-03 09:59:56'),
(298, 1, 'menu', 'update-menu', '2024-11-03 10:00:17'),
(299, 1, 'menu', 'update-menu', '2024-11-03 10:00:46'),
(300, 1, 'view_menu', 'delete-view_menu', '2024-11-03 10:02:00'),
(301, 1, 'view_menu', 'delete-view_menu', '2024-11-03 10:02:04'),
(302, 1, 'view_menu', 'delete-view_menu', '2024-11-03 10:02:07'),
(303, 1, 'view_menu', 'insert-view_menu', '2024-11-03 10:03:18'),
(304, 1, 'view_menu', 'insert-view_menu', '2024-11-03 10:07:19'),
(305, 1, 'view_menu', 'update-view_menu', '2024-11-03 10:07:49'),
(306, 1, 'view_menu', 'update-view_menu', '2024-11-03 10:08:24'),
(307, 1, 'view_menu', 'insert-view_menu', '2024-11-03 10:11:25'),
(308, 1, 'menu', 'ban-user', '2024-11-03 10:12:39'),
(309, 1, 'galery', 'delete-album', '2024-11-03 10:13:20'),
(310, 1, 'galery', 'delete-album', '2024-11-03 10:13:26'),
(311, 1, 'galery', 'delete-album', '2024-11-03 10:13:32'),
(312, 1, 'galery', 'delete-album', '2024-11-03 10:13:36'),
(313, 1, 'galery', 'delete-album', '2024-11-03 10:13:42'),
(314, 1, 'galery', 'delete-album', '2024-11-03 10:13:47'),
(315, 1, 'galery', 'delete-album', '2024-11-03 10:13:52'),
(316, 1, 'galery', 'delete-album', '2024-11-03 10:13:56'),
(317, 1, 'galery', 'delete-album', '2024-11-03 10:14:02'),
(318, 1, 'galery', 'delete-album', '2024-11-03 10:14:07'),
(319, 1, 'galery', 'delete-album', '2024-11-03 10:14:11'),
(320, 1, 'galery', 'delete-album', '2024-11-03 10:14:16'),
(321, 1, 'galery', 'delete-album', '2024-11-03 10:14:20'),
(322, 1, 'galery', 'delete-album', '2024-11-03 10:14:25'),
(323, 1, 'galery', 'delete-album', '2024-11-03 10:14:30'),
(324, 1, 'galery', 'delete-album', '2024-11-03 10:14:35'),
(325, 1, 'galery', 'update-galery', '2024-11-03 10:15:42'),
(326, 1, 'galery', 'upload-foto', '2024-11-03 10:17:40'),
(327, 1, 'galery', 'delete-foto', '2024-11-03 10:18:02'),
(328, 1, 'galery', 'upload-foto', '2024-11-03 10:19:05'),
(329, 1, 'galery', 'delete-foto', '2024-11-03 10:19:22'),
(330, 1, 'galery', 'upload-foto', '2024-11-03 10:19:35'),
(331, 1, 'galery', 'delete-foto', '2024-11-03 10:19:45'),
(332, 1, 'galery', 'upload-foto', '2024-11-03 10:20:17'),
(333, 1, 'galery', 'delete-foto', '2024-11-03 10:20:58'),
(334, 1, 'galery', 'upload-foto', '2024-11-03 10:21:07'),
(335, 1, 'galery', 'upload-foto', '2024-11-03 10:22:06'),
(336, 1, 'galery', 'upload-foto', '2024-11-03 10:22:59'),
(337, 1, 'galery', 'upload-foto', '2024-11-03 10:24:03'),
(338, 1, 'logo', 'update-foto', '2024-11-03 10:25:22'),
(339, 1, 'footer', 'update-footer', '2024-11-03 10:29:59'),
(340, 1, 'footer', 'update-footer', '2024-11-03 10:31:19'),
(341, 1, 'login', 'login-auth', '2024-11-03 03:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `t_kategori`
--

CREATE TABLE `t_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(50) NOT NULL,
  `kategori_tgl` date NOT NULL,
  `kategori_jenis` set('artikel','agenda') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kategori`
--

INSERT INTO `t_kategori` (`kategori_id`, `kategori_nama`, `kategori_tgl`, `kategori_jenis`) VALUES
(3, 'dua', '2019-09-03', 'artikel'),
(7, 'empat', '2019-09-07', 'agenda'),
(10, 'tiga', '2019-09-07', 'artikel'),
(11, 'lima', '2019-09-07', 'agenda');

-- --------------------------------------------------------

--
-- Table structure for table `t_logo`
--

CREATE TABLE `t_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_nama` text NOT NULL,
  `logo_label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ini adalah logo';

--
-- Dumping data for table `t_logo`
--

INSERT INTO `t_logo` (`logo_id`, `logo_nama`, `logo_label`) VALUES
(1, 'logo.png', ''),
(2, 'kepala_desa.png', 'YARMONO');

-- --------------------------------------------------------

--
-- Table structure for table `t_menu`
--

CREATE TABLE `t_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_nama` varchar(50) DEFAULT NULL,
  `menu_sub` set('yes','no') DEFAULT NULL,
  `menu_khusus` int(11) NOT NULL DEFAULT 0,
  `menu_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_menu`
--

INSERT INTO `t_menu` (`menu_id`, `menu_nama`, `menu_sub`, `menu_khusus`, `menu_status`) VALUES
(1, 'Profile Desa', 'no', 0, 1),
(2, 'Pemerintahan', 'no', 0, 1),
(3, 'Potensi Desa', 'no', 0, 1),
(4, 'Berita Terkini', 'no', 0, 0),
(5, 'Artikel', 'no', 1, 1),
(6, 'Agenda', 'no', 1, 1),
(7, 'Galery', 'no', 1, 1),
(8, 'Video Collection', 'no', 1, 1),
(9, 'Feedback', 'no', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_statistik`
--

CREATE TABLE `t_statistik` (
  `ip` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hits` int(11) DEFAULT 1,
  `online` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_statistik`
--

INSERT INTO `t_statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('127.0.0.1', '2019-09-24', 44, '1569333764'),
('192.168.0.102', '2019-09-24', 3, '1569288469'),
('127.0.0.1', '2019-09-25', 73, '1569425038'),
('127.0.0.1', '2019-09-27', 3, '1569572391'),
('127.0.0.1', '2019-10-01', 1, '1569921973'),
('127.0.0.1', '2019-10-03', 2, '1570107375'),
('127.0.0.1', '2019-10-05', 3, '1570289428'),
('127.0.0.1', '2019-10-05', 3, '1570289428'),
('127.0.0.1', '2019-10-06', 4, '1570367208'),
('127.0.0.1', '2019-10-06', 4, '1570367208'),
('127.0.0.1', '2019-10-07', 2, '1570445422'),
('127.0.0.1', '2019-10-08', 2, '1570468943'),
('127.0.0.1', '2019-10-23', 3, '1571833438'),
('127.0.0.1', '2019-10-24', 2, '1571859468'),
('127.0.0.1', '2019-10-26', 4, '1572083451'),
('127.0.0.1', '2019-10-30', 2, '1572414828'),
('127.0.0.1', '2019-11-21', 2, '1574325927'),
('127.0.0.1', '2019-12-03', 1, '1575391779'),
('127.0.0.1', '2019-12-04', 2, '1575463610'),
('127.0.0.1', '2019-12-08', 4, '1575803517'),
('127.0.0.1', '2019-12-10', 1, '1575983739'),
('127.0.0.1', '2019-12-27', 1, '1577453289'),
('127.0.0.1', '2019-12-30', 5, '1577689721'),
('127.0.0.1', '2020-01-01', 17, '1577821106'),
('127.0.0.1', '2020-01-02', 45, '1577957890'),
('127.0.0.1', '2020-01-04', 1, '1578072315'),
('127.0.0.1', '2020-01-05', 5, '1578207179'),
('127.0.0.1', '2020-01-06', 23, '1578303133'),
('127.0.0.1', '2020-01-07', 9, '1578411167'),
('127.0.0.1', '2022-01-09', 3, '1641746312'),
('127.0.0.1', '2022-01-10', 1, '1641747994'),
('127.0.0.1', '2024-11-02', 1, '1730528868'),
('180.248.13.60', '2024-11-02', 1, '1730528985'),
('116.68.162.194', '2024-11-02', 2, '1730530710'),
('180.248.13.60', '2024-11-03', 17, '1730604774'),
('116.68.162.194', '2024-11-03', 4, '1730622372'),
('140.213.58.76', '2024-11-04', 1, '1730700983'),
('103.160.69.105', '2024-11-05', 1, '1730795929'),
('103.189.123.4', '2024-11-05', 1, '1730795929'),
('103.160.69.105', '2024-11-11', 2, '1731293521');

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_menu`
--

CREATE TABLE `t_sub_menu` (
  `sub_id` int(11) NOT NULL,
  `sub_nama` varchar(50) DEFAULT NULL,
  `sub_id_menu` int(11) DEFAULT NULL,
  `sub_menu_khusus` int(11) DEFAULT 0,
  `sub_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sub_menu`
--

INSERT INTO `t_sub_menu` (`sub_id`, `sub_nama`, `sub_id_menu`, `sub_menu_khusus`, `sub_status`) VALUES
(5, 'sub goverment', 2, 0, 1),
(9, 'sub public service', 3, 0, 1),
(10, 'sub vilage potential', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL DEFAULT '0',
  `user_email` varchar(50) NOT NULL DEFAULT '0',
  `user_password` varchar(50) NOT NULL DEFAULT '0',
  `user_level` int(11) NOT NULL DEFAULT 0,
  `user_foto` text DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `user_foto`, `user_status`) VALUES
(1, 'Joni', 'admin@admin.com', 'password', 1, 'lurah.png', 1),
(2, 'yudha', 'user@user.com', 'password', 2, 'lurah.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_video`
--

CREATE TABLE `t_video` (
  `video_id` int(11) NOT NULL,
  `video_judul` text DEFAULT NULL,
  `video_album` int(11) DEFAULT NULL,
  `video_foto` text DEFAULT NULL,
  `video_link` text DEFAULT NULL,
  `video_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_video`
--

INSERT INTO `t_video` (`video_id`, `video_judul`, `video_album`, `video_foto`, `video_link`, `video_tanggal`) VALUES
(2, 'test', 42, 'Chrysanthemum.jpg', 'gc4__1P8oJc', '2019-09-09'),
(5, 'laila', 42, 'Tulips.jpg', 'wQOp8Ar5cFU', '2019-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `t_view`
--

CREATE TABLE `t_view` (
  `view_id` int(11) NOT NULL,
  `view_id_konten` int(11) DEFAULT NULL,
  `view_tgl` date DEFAULT NULL,
  `view_jenis` set('artikel','agenda') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_view`
--

INSERT INTO `t_view` (`view_id`, `view_id_konten`, `view_tgl`, `view_jenis`) VALUES
(1, 10, '2020-01-02', 'agenda'),
(2, 10, '2020-01-02', 'agenda'),
(3, 13, '2020-01-02', 'artikel'),
(4, 13, '2020-01-02', 'artikel'),
(5, 5, '2020-01-02', 'artikel'),
(6, 13, '2020-01-02', 'artikel'),
(7, 10, '2020-01-06', 'agenda'),
(8, 6, '2020-01-06', 'artikel'),
(9, 8, '2020-01-06', 'artikel'),
(10, 6, '2024-11-02', 'artikel');

-- --------------------------------------------------------

--
-- Table structure for table `t_view_menu`
--

CREATE TABLE `t_view_menu` (
  `view_id` int(11) NOT NULL,
  `view_type` set('menu','submenu') NOT NULL,
  `view_id_menu` varchar(50) NOT NULL,
  `view_isi` text NOT NULL,
  `view_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_view_menu`
--

INSERT INTO `t_view_menu` (`view_id`, `view_type`, `view_id_menu`, `view_isi`, `view_foto`) VALUES
(9, 'menu', '1', '<p>Asal usul Desa Jatitengah</p>\r\n\r\n<p>&nbsp;&nbsp;Desa Jatitengah awalnya merupakan hutan belantara yang diubah menjadi pemukiman oleh Mbah Wonodiryo, salah satu leluhur desa, melalui proses &ldquo;Babad Alas&rdquo;. Nama Jatitengah berasal dari sebuah pohon jati besar di tengah hutan yang menjadi tempat berteduh dan beristirahat bagi para pendatang. Seiring waktu, Jatitengah menjadi bagian dari Desa Mronjo yang dipisahkan oleh Sungai Lekso, menyebabkan kesulitan administrasi bagi penduduk. Setelah pengaduan warga, Jatitengah digabungkan dengan Desa Njeruk, di mana warga kemudian memutuskan untuk memisahkan diri dan membentuk Desa Jatitengah secara mandiri, dengan Pawiro Semadi sebagai lurah pertama yang menjabat seumur hidup.&nbsp;</p>\r\n', 'biodata.png'),
(14, 'menu', '2', '<h2><strong>Visi</strong></h2>\r\n\r\n<p>&quot;Membangun Desa Jatitengah lebih baik, aman, tenteram, sejahtera, adil, makmur dan mandiri yang berlandaskan pada keTuhanan yang maha esa&quot;&nbsp;</p>\r\n\r\n<h2><strong>Misi</strong></h2>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Meningkatkan pembangunan infrastruktur yang mendukung perekonomian desa, seperti jalan, jembatan serta infrastruktur strategis lainnya.</p>\r\n	</li>\r\n	<li>\r\n	<p>Meningkatkan pembangunan di bidang kesehatan untuk mendorong derajat kesehatan masyarakat agar dapat bekerja lebih optimal dan memiliki harapan hidup yang lebih panjang.</p>\r\n	</li>\r\n	<li>\r\n	<p>Meningkatkan pembangunan di bidang pendidikan untuk mendorong peningkatan kualitas sumber daya manusia agar memiliki kecerdasan dan daya saing yang lebih</p>\r\n	</li>\r\n	<li>\r\n	<p>Meningkatkan pembangunan ekonomi dengan mendorong semakin tumbuh dan berkembangnya pembangunan di bidang pertanian dalam arti luas, industri, perdagangan dan pariwisata serta pemerataan pembangunan yang berkeadilan di segala bidang.</p>\r\n	</li>\r\n	<li>\r\n	<p>Menciptakan tata kelola pemerintahan yang baik (good governance) yang bersih. efektif berdasarkan demokratisasi terpercaya, manajemen keuangan, manajemen pelayanan, transparansi, penegakan hukum, berkeadilan, kesetaraan gender dan mengutamakan pelayanan kepada masyarakat.</p>\r\n	</li>\r\n	<li>\r\n	<p>Mengupayakan pelestarian sumber daya alam dengan meningkatkan dan memberdayakan produktifitas untuk memenuhi kebutuhan dan pemerataan pembangunan guna meningkatkan perekonomian, sehingga berdaya saing disegala bidang sehingga Desa Jatitengah dapat menjadi Desa Mandiri dan bangkit bersama daerah - daerah lain.</p>\r\n	</li>\r\n</ol>\r\n', 'struktur.png'),
(15, 'menu', '3', '<h1>Perikanan</h1>\r\n\r\n<p>Di sektor perikanan,&nbsp;air bersih&nbsp;dan melimpah dari Gunung Kelud sangat ideal untuk budidaya&nbsp;ikan tawar&nbsp;yang membutuhkan lingkungan air berkualitas untuk tumbuh optimal. Lahan subur di sekitar sumber air juga bisa dimanfaatkan untuk&nbsp;membangun kolam-kolam ikan,&nbsp;baik untuk skala kecil rumah tangga maupun skala besar komersial. Dengan pengelolaan yang baik, desa ini dapat mengembangkan&nbsp;usaha perikanan&nbsp;yang berkelanjutan, meningkatkan&nbsp;produksi ikan lokal,&nbsp;dan memenuhi&nbsp;kebutuhan protein&nbsp;masyarakat.&nbsp;</p>\r\n', 'ikan.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_logo`
-- (See below for the actual view)
--
CREATE TABLE `view_logo` (
`logo_id` int(11)
,`logo_nama` text
,`logo_label` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu`
-- (See below for the actual view)
--
CREATE TABLE `view_menu` (
`menu_khusus` int(11)
,`menu_id` int(11)
,`menu_nama` varchar(50)
,`menu_sub` set('yes','no')
,`menu_status` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_submenu`
-- (See below for the actual view)
--
CREATE TABLE `view_submenu` (
`sub_id` int(11)
,`sub_id_menu` int(11)
,`sub_nama` varchar(50)
,`sub_status` int(11)
,`menu_id` int(11)
,`menu_nama` varchar(50)
,`menu_status` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user`
-- (See below for the actual view)
--
CREATE TABLE `view_user` (
`user_id` int(11)
,`user_name` varchar(50)
,`user_email` varchar(50)
,`user_password` varchar(50)
,`user_level` int(11)
,`user_foto` text
,`user_status` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_logo`
--
DROP TABLE IF EXISTS `view_logo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_logo`  AS  select `t_logo`.`logo_id` AS `logo_id`,`t_logo`.`logo_nama` AS `logo_nama`,`t_logo`.`logo_label` AS `logo_label` from `t_logo` ;

-- --------------------------------------------------------

--
-- Structure for view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS  select `t_menu`.`menu_khusus` AS `menu_khusus`,`t_menu`.`menu_id` AS `menu_id`,`t_menu`.`menu_nama` AS `menu_nama`,`t_menu`.`menu_sub` AS `menu_sub`,`t_menu`.`menu_status` AS `menu_status` from `t_menu` ;

-- --------------------------------------------------------

--
-- Structure for view `view_submenu`
--
DROP TABLE IF EXISTS `view_submenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_submenu`  AS  select `a`.`sub_id` AS `sub_id`,`a`.`sub_id_menu` AS `sub_id_menu`,`a`.`sub_nama` AS `sub_nama`,`a`.`sub_status` AS `sub_status`,`b`.`menu_id` AS `menu_id`,`b`.`menu_nama` AS `menu_nama`,`b`.`menu_status` AS `menu_status` from (`t_sub_menu` `a` join `t_menu` `b` on(`a`.`sub_id_menu` = `b`.`menu_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS  select `t_user`.`user_id` AS `user_id`,`t_user`.`user_name` AS `user_name`,`t_user`.`user_email` AS `user_email`,`t_user`.`user_password` AS `user_password`,`t_user`.`user_level` AS `user_level`,`t_user`.`user_foto` AS `user_foto`,`t_user`.`user_status` AS `user_status` from `t_user` order by `t_user`.`user_id` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_agenda`
--
ALTER TABLE `t_agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `t_album`
--
ALTER TABLE `t_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `t_artikel`
--
ALTER TABLE `t_artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `t_feedback`
--
ALTER TABLE `t_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `t_footer`
--
ALTER TABLE `t_footer`
  ADD PRIMARY KEY (`footer_id`);

--
-- Indexes for table `t_galery`
--
ALTER TABLE `t_galery`
  ADD PRIMARY KEY (`galery_id`);

--
-- Indexes for table `t_history`
--
ALTER TABLE `t_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `t_kategori`
--
ALTER TABLE `t_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `t_logo`
--
ALTER TABLE `t_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `t_view`
--
ALTER TABLE `t_view`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `t_view_menu`
--
ALTER TABLE `t_view_menu`
  ADD PRIMARY KEY (`view_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_agenda`
--
ALTER TABLE `t_agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_album`
--
ALTER TABLE `t_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_artikel`
--
ALTER TABLE `t_artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_feedback`
--
ALTER TABLE `t_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_footer`
--
ALTER TABLE `t_footer`
  MODIFY `footer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_galery`
--
ALTER TABLE `t_galery`
  MODIFY `galery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `t_history`
--
ALTER TABLE `t_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `t_kategori`
--
ALTER TABLE `t_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_logo`
--
ALTER TABLE `t_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_video`
--
ALTER TABLE `t_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_view`
--
ALTER TABLE `t_view`
  MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_view_menu`
--
ALTER TABLE `t_view_menu`
  MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
