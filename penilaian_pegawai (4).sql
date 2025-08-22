-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(2) NOT NULL,
  `nama_bulan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `cek`
--

CREATE TABLE `cek` (
  `kode_cek_penilaian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cek`
--

INSERT INTO `cek` (`kode_cek_penilaian`) VALUES
(20240911),
(20240914),
(20240915),
(20240916),
(20240917),
(20240918),
(20240929),
(20250818),
(20250821),
(20250822),
(20250825),
(20250826),
(20250827),
(20250828),
(20250829),
(202409117),
(202409119),
(202409211),
(202508122),
(202508210),
(202508211),
(202508212),
(202508213),
(202508214),
(202508215),
(202508216),
(202508217),
(202508218),
(202508219),
(202508220),
(202508221),
(202508222),
(202508228),
(202508281),
(202508282),
(202508285),
(202508286),
(202508287),
(202508288),
(202508289),
(2025082810),
(2025082811),
(2025082812),
(2025082813),
(2025082814),
(2025082815),
(2025082816),
(2025082817),
(2025082818),
(2025082819),
(2025082820),
(2025082821),
(2025082822),
(2025082828);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nip_baru` varchar(18) NOT NULL,
  `nip_lama` varchar(9) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip_baru`, `nip_lama`, `jabatan`, `status`, `email`) VALUES
(1, 'admin', '123456789090887676', '123456789', 'admin', 'Pegawai', 'admin@gmail.com'),
(2, 'user', '123456789', '123456789', 'user', 'Pegawai', 'user@gmail.com'),
(4, 'Christian Harry Soplantila, S.Pi., M.Si.', '197808022005021006', '340017627', 'Kepala', 'Kepala', 'christo_erie@bps.go.id'),
(5, 'Vanny Anna Paulina Satumalay, S.Si.', '198102242010032001', '340053975', 'Kepala Subbagian Umum', 'Pegawai', 'vanny.satumalay@bps.go.id'),
(6, 'Abdul Azis Tuharea', '197705312007101001', '340020543', 'Pelaksana', 'Pegawai', 'azistuharea@bps.go.id'),
(7, 'Iksan Azwar Risahondua', '197805112002121004', '340016800', 'Pelaksana', 'Pegawai', 'arisahondau@bps.go.id'),
(8, 'Sudirman Kau', '197909022009011007', '340052282', 'Pelaksana', 'Pegawai', 'sudirmankau@bps.go.id'),
(9, 'Yuni Arfa Sahupala', '198606292009112001', '340053170', 'Pelaksana', 'Pegawai', 'yunisahupala@bps.go.id'),
(10, 'Yona Lelian Kaihena, S.E.', '198409032011012010', '340055570', 'Statistisi Ahli Muda', 'Pegawai', 'yonalelian@bps.go.id'),
(11, 'Muhammad Mulyadi Pane, SST', '199108142014101002', '340056678', 'Statistisi Ahli Muda', 'Pegawai', 'mulyadipane@bps.go.id'),
(12, 'Yosephine Murwanisiwi Riantoby, S.Tr.Stat.', '199603172019012002', '340059035', 'Pranata Komputer Ahli Pertama', 'Pegawai', 'mr.yosephine@bps.go.id'),
(13, 'Shania Maranatha Sofitje Nendissa, A.Md.Stat.', '200008162019122003', '340059901', 'Pelaksana Statistisi Ahli Pertama', 'Pegawai', 'shania.nendissa@bps.go.id'),
(14, 'Davin Giovanni Batara Francisco Nainggolan, S.Tr.Stat.', '199810232021041003', '340060040', 'Statistisi Ahli Pertama', 'Pegawai', 'davin.nainggolan@bps.go.id'),
(15, 'Rizkiani Ihfa, S.Tr.Stat.', '199712242021042002', '340060301', 'Statistisi Ahli Pertama', 'Pegawai', 'rizkiani.ihfa@bps.go.id'),
(16, 'Irawan Ghazali, S.Tr.Stat.', '199701022021041002', '340060155', 'Statistisi Ahli Pertama', 'Pegawai', 'irawan.ghazali@bps.go.id'),
(17, 'Rosa Audia Lillah, S.Tr.Stat.', '199804162021042001', '340060303', 'Statistisi Ahli Pertama', 'Pegawai', 'audia.lillah@bps.go.id'),
(18, 'Muhammad Azwar Sidik, A.Md.Stat', '199702272022031007', '340061429', 'Bendahara', 'Pegawai', 'azwar.sidik@bps.go.id'),
(19, 'Muhamad Bagus Adji Briliyanto, S.Tr.Stat.', '199809192022011002', '340060772', 'Statistisi Ahli Pertama', 'Pegawai', 'bagus.adji@bps.go.id'),
(20, 'Herpanindra Fadhilah, S.Tr.Stat.', '199909052022012002', '340060679', 'Statistisi Ahli Pertama', 'Pegawai', 'anin.fadhilah@bps.go.id'),
(21, 'Anzilna Luthfa Asyfiya, S.Tr.Stat.', '199908102023022001', '340061696', 'Statistisi Ahli Pertama', 'Pegawai', 'anzilnaluthfaa@bps.go.id'),
(22, 'Febriyeni Susi, S.Tr.Stat.', '199902112023022001', '340061793', 'Statistisi Ahli Pertama', 'Pegawai', 'febriyeni.susi@bps.go.id'),
(28, 'user1', '123456564534239887', '123458675', 'pegawai', 'Pegawai', 'user1@gmail.com'),
(29, 'user2', '123456678567877675', '324567877', 'user', 'Pegawai', 'user2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_pegawai_dinilai` int(11) NOT NULL,
  `id_pegawai_penilai` int(11) NOT NULL,
  `periode` int(2) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `kode_penilaian` int(11) NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `q5` int(11) NOT NULL,
  `q6` int(11) NOT NULL,
  `q7` int(11) NOT NULL,
  `q8` int(11) NOT NULL,
  `q9` int(11) NOT NULL,
  `q10` int(11) NOT NULL,
  `q11` int(11) NOT NULL,
  `tanggal_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_pegawai_dinilai`, `id_pegawai_penilai`, `periode`, `tahun`, `kode_penilaian`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `tanggal_submit`, `skor`) VALUES
(1, 5, 1, 10, '2024', 20240915, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '2024-09-17 06:58:34', 22),
(2, 6, 1, 10, '2024', 20240916, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2024-09-17 06:58:34', 11),
(3, 7, 1, 10, '2024', 20240917, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, '2024-09-17 06:58:34', 33),
(4, 8, 1, 10, '2024', 20240918, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, '2024-09-17 06:58:34', 33),
(5, 17, 1, 9, '2024', 202409117, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, '2024-09-13 01:34:48', 110),
(6, 4, 1, 9, '2024', 20240914, 10, 10, 9, 9, 8, 8, 8, 8, 9, 10, 10, '2024-09-17 02:22:04', 99),
(7, 19, 1, 9, '2024', 202409119, 10, 10, 10, 9, 9, 10, 7, 9, 9, 6, 10, '2024-09-17 02:50:58', 99),
(8, 11, 2, 9, '2024', 202409211, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, '2024-09-17 04:37:37', 110),
(9, 9, 2, 9, '2024', 20240929, 7, 7, 7, 10, 7, 9, 6, 8, 9, 6, 5, '2024-09-19 01:49:58', 81),
(10, 1, 1, 9, '2024', 20240911, 3, 3, 4, 4, 5, 5, 5, 5, 4, 4, 4, '2024-09-20 06:12:19', 46),
(11, 15, 2, 8, '2025', 202508215, 10, 8, 9, 8, 8, 6, 6, 7, 7, 9, 10, '2025-08-19 02:49:28', 88),
(12, 8, 1, 8, '2025', 20250818, 10, 10, 10, 10, 9, 10, 9, 9, 9, 9, 9, '2025-08-19 08:34:57', 104),
(13, 7, 2, 8, '2025', 20250827, 5, 5, 4, 7, 7, 3, 7, 6, 5, 5, 7, '2025-08-19 10:01:12', 61),
(14, 6, 2, 8, '2025', 20250826, 10, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, '2025-08-20 09:29:19', 100),
(15, 1, 2, 8, '2025', 20250821, 10, 8, 9, 8, 6, 6, 5, 4, 5, 2, 1, '2025-08-20 09:29:46', 64),
(16, 21, 2, 8, '2025', 202508221, 7, 1, 2, 4, 4, 7, 6, 2, 4, 10, 9, '2025-08-20 09:30:14', 56),
(17, 14, 2, 8, '2025', 202508214, 9, 8, 6, 1, 5, 4, 3, 3, 8, 10, 6, '2025-08-20 09:30:47', 63),
(18, 22, 2, 8, '2025', 202508222, 8, 1, 5, 3, 1, 9, 3, 6, 10, 1, 1, '2025-08-20 09:31:18', 48),
(19, 20, 2, 8, '2025', 202508220, 10, 8, 3, 6, 9, 5, 6, 10, 10, 3, 1, '2025-08-20 09:31:46', 71),
(20, 16, 2, 8, '2025', 202508216, 9, 7, 8, 1, 4, 2, 4, 5, 1, 8, 10, '2025-08-20 09:32:15', 59),
(21, 19, 2, 8, '2025', 202508219, 10, 4, 5, 4, 5, 4, 3, 2, 10, 8, 7, '2025-08-20 09:32:43', 62),
(22, 18, 2, 8, '2025', 202508218, 10, 9, 5, 1, 4, 8, 7, 7, 9, 3, 4, '2025-08-20 09:33:17', 67),
(23, 11, 2, 8, '2025', 202508211, 10, 2, 5, 6, 4, 9, 3, 10, 3, 10, 5, '2025-08-20 09:33:53', 67),
(24, 17, 2, 8, '2025', 202508217, 9, 7, 6, 6, 8, 3, 1, 9, 3, 6, 5, '2025-08-20 09:35:30', 63),
(25, 13, 2, 8, '2025', 202508213, 10, 8, 3, 6, 1, 4, 9, 1, 9, 7, 6, '2025-08-20 09:36:11', 64),
(26, 8, 2, 8, '2025', 20250828, 10, 1, 1, 4, 6, 6, 7, 8, 4, 2, 2, '2025-08-20 09:36:55', 51),
(27, 2, 2, 8, '2025', 20250822, 6, 8, 4, 1, 1, 3, 10, 8, 5, 6, 5, '2025-08-20 09:37:47', 57),
(28, 5, 2, 8, '2025', 20250825, 6, 7, 1, 4, 8, 9, 10, 10, 9, 7, 5, '2025-08-20 09:51:01', 76),
(29, 10, 2, 8, '2025', 202508210, 9, 7, 8, 6, 8, 9, 10, 4, 4, 3, 2, '2025-08-20 09:51:38', 70),
(30, 12, 2, 8, '2025', 202508212, 9, 9, 8, 7, 9, 7, 8, 6, 8, 9, 9, '2025-08-20 09:52:29', 89),
(31, 9, 2, 8, '2025', 20250829, 9, 7, 6, 1, 6, 5, 8, 8, 4, 3, 1, '2025-08-20 09:53:06', 58),
(32, 22, 1, 8, '2025', 202508122, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, '2025-08-20 12:42:54', 110),
(33, 6, 28, 8, '2025', 202508286, 10, 9, 8, 7, 6, 6, 6, 5, 5, 6, 3, '2025-08-20 12:46:15', 71),
(34, 1, 28, 8, '2025', 202508281, 10, 9, 5, 5, 6, 6, 8, 8, 7, 1, 1, '2025-08-20 12:46:43', 66),
(35, 21, 28, 8, '2025', 2025082821, 10, 8, 8, 7, 6, 5, 5, 4, 4, 4, 3, '2025-08-20 12:47:22', 64),
(36, 14, 28, 8, '2025', 2025082814, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-08-20 12:47:54', 11),
(37, 22, 28, 8, '2025', 2025082822, 10, 7, 1, 5, 7, 6, 4, 10, 9, 6, 4, '2025-08-20 12:48:28', 69),
(38, 20, 28, 8, '2025', 2025082820, 9, 8, 7, 6, 6, 4, 4, 4, 4, 2, 2, '2025-08-20 12:48:53', 56),
(39, 7, 28, 8, '2025', 202508287, 10, 9, 3, 3, 5, 6, 5, 4, 3, 9, 10, '2025-08-20 12:49:22', 67),
(40, 16, 28, 8, '2025', 2025082816, 10, 8, 8, 8, 6, 1, 1, 1, 1, 2, 2, '2025-08-20 12:49:53', 48),
(41, 19, 28, 8, '2025', 2025082819, 10, 8, 6, 8, 10, 8, 5, 4, 3, 1, 3, '2025-08-20 12:50:20', 66),
(42, 18, 28, 8, '2025', 2025082818, 10, 9, 7, 8, 2, 3, 4, 5, 5, 5, 4, '2025-08-20 12:51:01', 62),
(43, 11, 28, 8, '2025', 2025082811, 9, 8, 5, 2, 4, 3, 6, 2, 3, 3, 2, '2025-08-20 12:51:35', 47),
(44, 15, 28, 8, '2025', 2025082815, 9, 8, 7, 10, 6, 5, 6, 6, 7, 6, 5, '2025-08-20 12:52:02', 75),
(45, 17, 28, 8, '2025', 2025082817, 10, 6, 6, 8, 7, 6, 9, 8, 10, 6, 5, '2025-08-20 12:52:38', 81),
(46, 13, 28, 8, '2025', 2025082813, 9, 8, 7, 6, 8, 7, 6, 6, 6, 6, 6, '2025-08-20 12:53:05', 75),
(47, 12, 28, 8, '2025', 2025082812, 10, 9, 9, 8, 8, 10, 10, 10, 10, 9, 9, '2025-08-20 12:53:36', 102),
(48, 10, 28, 8, '2025', 2025082810, 10, 9, 8, 10, 10, 9, 9, 5, 2, 2, 2, '2025-08-20 12:54:04', 76),
(49, 8, 28, 8, '2025', 202508288, 8, 8, 7, 6, 5, 4, 4, 3, 3, 3, 3, '2025-08-20 12:54:31', 54),
(50, 28, 28, 8, '2025', 2025082828, 9, 8, 7, 6, 6, 7, 4, 5, 3, 4, 7, '2025-08-20 12:55:09', 66),
(51, 2, 28, 8, '2025', 202508282, 9, 6, 5, 4, 5, 6, 7, 8, 7, 3, 8, '2025-08-20 12:55:49', 68),
(52, 5, 28, 8, '2025', 202508285, 10, 9, 9, 9, 9, 9, 8, 7, 6, 5, 4, '2025-08-20 12:56:32', 85),
(53, 28, 2, 8, '2025', 202508228, 9, 8, 8, 7, 6, 5, 5, 7, 6, 7, 10, '2025-08-20 12:58:37', 78),
(54, 9, 28, 8, '2025', 202508289, 8, 7, 7, 6, 5, 7, 6, 5, 7, 9, 10, '2025-08-20 13:00:36', 77);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL,
  `authKey` varchar(255) NOT NULL,
  `accessToken` varchar(255) NOT NULL,
  `status` int(3) NOT NULL,
  `role` varchar(60) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `authKey`, `accessToken`, `status`, `role`, `id_pegawai`, `time_create`, `time_update`) VALUES
(1, 'admin', '12345', 'EYGg9Kk3xqLFCBnRFsAbYO8vYAlkMBdg', 'EYGg9Kk3xqLFCBnRFsAbYO8vYAlkMBdg', 10, 'Admin', 1, '2024-08-29 09:07:45', '2025-08-19 13:03:45'),
(2, 'user', '12345', 'VBiGh2scYOiQxUsDdrDcJX27hQpN3gRN', 'VBiGh2scYOiQxUsDdrDcJX27hQpN3gRN', 10, 'User', 2, '2024-08-29 12:19:09', '2025-08-19 11:48:55'),
(3, 'christo_erie@bps.go.id', '340017627', 'LXvJfjh955Se9aHSlOjpNLm76baxuo8Y', 'LXvJfjh955Se9aHSlOjpNLm76baxuo8Y', 10, 'User', 4, '2024-08-30 09:56:18', '2024-09-17 16:11:57'),
(4, 'vanny.satumalay@bps.go.id', '340053975', 'YbC1uZRuMUq0GcodQYYwnrWiiGYsKvKf', 'YbC1uZRuMUq0GcodQYYwnrWiiGYsKvKf', 10, 'User', 5, '2024-08-30 09:56:18', '2024-09-17 16:12:47'),
(5, 'azistuharea@bps.go.id', '340020543', 'a3WSO96TxSTHaaFtbJMzte7VrVYOiUlY', 'a3WSO96TxSTHaaFtbJMzte7VrVYOiUlY', 10, 'User', 6, '2024-08-30 10:03:33', '2024-09-17 16:13:09'),
(6, 'arisahondau@bps.go.id', '340016800', 'BhfmdOSPNWfv17rN2R1imKg9bdzPwiL8', 'BhfmdOSPNWfv17rN2R1imKg9bdzPwiL8', 10, 'User', 7, '2024-08-30 10:03:33', '2024-09-17 16:13:26'),
(7, 'sudirmankau@bps.go.id', '340052282', 'KoYZV2AbYaHsGXHrfRQ7wcI61f0xt9RB', 'KoYZV2AbYaHsGXHrfRQ7wcI61f0xt9RB', 10, 'User', 8, '2024-08-30 10:06:45', '2024-09-20 11:42:30'),
(8, 'yunisahupala@bps.go.id', '340053170', '4e9WnS8KaburVTXRxseGJnNbqi7ZlzzM', '4e9WnS8KaburVTXRxseGJnNbqi7ZlzzM', 10, 'User', 9, '2024-08-30 10:06:45', '2024-09-17 16:14:04'),
(9, 'yonalelian@bps.go.id', '340055570', '8NufjhCAa_FKcqhcPKU8K9nQishLEsTr', '8NufjhCAa_FKcqhcPKU8K9nQishLEsTr', 10, 'User', 10, '2024-08-30 10:06:45', '2024-09-17 16:14:15'),
(10, 'mulyadipane@bps.go.id', '340056678', 'WVsmXFpEuqfAlLik2H9kMmOcZVF-7-bR', 'WVsmXFpEuqfAlLik2H9kMmOcZVF-7-bR', 10, 'User', 11, '2024-08-30 10:06:45', '2024-09-17 16:14:32'),
(11, 'mr.yosephine@bps.go.id', '340059035', 'xEUMIQz42jlUw_9JOhHxzlUr62QIw7OC', 'xEUMIQz42jlUw_9JOhHxzlUr62QIw7OC', 10, 'User', 12, '2024-08-30 10:06:45', '2024-09-17 16:14:45'),
(12, 'shania.nendissa@bps.go.id', '340059901', '2xbwxLzt8veHxrI9Gv4UsthzIzBz9pbi', '2xbwxLzt8veHxrI9Gv4UsthzIzBz9pbi', 10, 'User', 13, '2024-08-30 10:13:09', '2024-09-17 16:15:05'),
(13, 'davin.nainggolan@bps.go.id', '340060040', 'hZBIALaNf4G2qzFYIOGUeFoTyGBz8G3_', 'hZBIALaNf4G2qzFYIOGUeFoTyGBz8G3_', 10, 'User', 14, '2024-08-30 10:13:09', '2024-09-17 16:15:17'),
(14, 'rizkiani.ihfa@bps.go.id', '340060301', '3ANGuTW7bb_Cs-Njo12sJpH0nu4Sp6A7', '3ANGuTW7bb_Cs-Njo12sJpH0nu4Sp6A7', 10, 'User', 15, '2024-08-30 10:13:09', '2024-09-17 16:15:43'),
(15, 'irawan.ghazali@bps.go.id', '340060155', 'VqkNUmvZzDdkimUz7UKR-w_Y6N6bf_Ii', 'VqkNUmvZzDdkimUz7UKR-w_Y6N6bf_Ii', 10, 'User', 16, '2024-08-30 10:13:09', '2024-09-17 16:15:56'),
(16, 'audia.lillah@bps.go.id', '340060303', 'nHkzZrIX6aMQi9gR1xIe081Toka9Hno5', 'nHkzZrIX6aMQi9gR1xIe081Toka9Hno5', 10, 'User', 17, '2024-08-30 10:13:09', '2024-09-17 16:16:09'),
(17, 'azwar.sidik@bps.go.id', '340061429', 'fCSdMm77Kxr8T72H03xsoRqSyYJcjVf4', 'fCSdMm77Kxr8T72H03xsoRqSyYJcjVf4', 10, 'User', 18, '2024-08-30 10:13:09', '2024-09-17 16:16:24'),
(18, 'bagus.adji@bps.go.id', '340060772', 'ePjhSQe3jWXK5RRrxfCnoEUU8K2-6aC7', 'ePjhSQe3jWXK5RRrxfCnoEUU8K2-6aC7', 10, 'User', 19, '2024-08-30 10:22:28', '2024-09-17 16:16:37'),
(19, 'anin.fadhilah@bps.go.id', '340060679', 'oFqucwYpRGvzNZJH5NyKxJHqGDuxqJ8a', 'oFqucwYpRGvzNZJH5NyKxJHqGDuxqJ8a', 10, 'User', 20, '2024-08-30 10:22:28', '2024-09-17 16:16:51'),
(20, 'anzilnaluthfaa@bps.go.id', '340061696', '2iJeyr60VWSrvrSLkSJMivydBmf7FRDr', '2iJeyr60VWSrvrSLkSJMivydBmf7FRDr', 10, 'User', 21, '2024-08-30 10:22:28', '2024-09-17 16:16:59'),
(21, 'febriyeni.susi@bps.go.id', '340061793', 'b7KdPWmV4cPnV4FgWqqYz3j-WFVsam5s', 'b7KdPWmV4cPnV4FgWqqYz3j-WFVsam5s', 10, 'User', 22, '2024-08-30 10:22:28', '2024-09-17 16:17:29'),
(26, 'user1', '12345', 'tD43hTbcItmK4sZ3QGbGmmQzu-5DyJhe', 'tD43hTbcItmK4sZ3QGbGmmQzu-5DyJhe', 0, 'User', 28, '2025-08-19 11:41:32', '2025-08-21 16:41:24'),
(27, 'user2', '12345', 'nVXHUI3CgDr5YrV7TG_K_4CTtBpQR9nc', 'nVXHUI3CgDr5YrV7TG_K_4CTtBpQR9nc', 10, 'User', 29, '2025-08-21 16:47:28', '2025-08-21 16:47:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `cek`
--
ALTER TABLE `cek`
  ADD UNIQUE KEY `kode_cek_penilaian_2` (`kode_cek_penilaian`),
  ADD KEY `kode_cek_penilaian` (`kode_cek_penilaian`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `penilaian_id_pegawai` (`id_pegawai_dinilai`),
  ADD KEY `penilaian_id_pegawai_penilai` (`id_pegawai_penilai`),
  ADD KEY `periode` (`periode`),
  ADD KEY `kode_penilaian` (`kode_penilaian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relasi_id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `cek_penilaian` FOREIGN KEY (`kode_penilaian`) REFERENCES `cek` (`kode_cek_penilaian`),
  ADD CONSTRAINT `penilaian_id_pegawai_dinilai` FOREIGN KEY (`id_pegawai_dinilai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `penilaian_id_pegawai_penilai` FOREIGN KEY (`id_pegawai_penilai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `periode_bulan` FOREIGN KEY (`periode`) REFERENCES `bulan` (`id_bulan`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `relasi_id_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
