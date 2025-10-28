-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 02:19 AM
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
-- Database: `db_new_cendekia`
--

-- --------------------------------------------------------

--
-- Table structure for table `asal_sekolah`
--

CREATE TABLE `asal_sekolah` (
  `nama_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asal_sekolah`
--

INSERT INTO `asal_sekolah` (`nama_sekolah`) VALUES
('SD Indonesia Merdeka'),
('SD KANISIUS GAYAM 1'),
('SD NEGERI JETIS 1'),
('SD NEGERI LEMPUYANGAN 1'),
('SD MUHAMMADIYAH BAUSASRAN 1'),
('SD MUHAMMADIYAH BAUSASRAN 2'),
('SD NEGERI DEMANGAN'),
('SD TAMANSISWA JETIS'),
('SD NEGERI JETISHARJO'),
('SD JOANNES BOSCO YOGYAKARTA'),
('SD NEGERI COKROKUSUMAN'),
('SD NEGERI BHAYANGKARA'),
('SD NEGERI WIDORO'),
('SD NEGERI SERAYU'),
('SD NEGERI UNGARAN 1'),
('SD BOPKRI GONDOLAYU'),
('SD NEGERI KYAI MOJO'),
('SD NEGERI BUMIJO'),
('SD NEGERI GONDOLAYU'),
('SD NEGERI BACIRO'),
('SD KANISIUS GOWONGAN'),
('SD NEGERI KLITREN'),
('SD BHINNEKA TUNGGAL IKA'),
('SD TARAKANITA 1'),
('SD NEGERI TERBANSARI 1'),
('SD BUDYA WACANA 1'),
('SD NEGERI JETIS 2'),
('SD NEGERI VIDYA QASANA'),
('SD NEGERI BADRAN'),
('SD NEGERI LEMPUYANGWANGI'),
('smk 2 depok'),
('SMK Negeri 2 Yogyakarta'),
('SMKN 1 KOTABUMI'),
('SD BUASASRAN 3'),
('SMP 9 Yogyakarta'),
('smk');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `tryout_peserta_id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `inv_paid` datetime DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `va_number` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `user_id`, `tryout_id`, `tryout_peserta_id`, `keterangan`, `amount`, `discount`, `total`, `status`, `due_date`, `inv_paid`, `payment_type`, `bank`, `va_number`, `remark`, `created_at`, `updated_at`) VALUES
('IN-2412-0002', 7, 3, 10, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 0, 0, 1, '2024-12-01', '2024-12-01 00:00:00', '', '', '', '0', '2024-12-01 09:03:59', '2024-12-01 09:03:59'),
('IN-2412-0003', 8, 3, 11, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 0, 0, 0, '2024-12-08', NULL, '', '', '', '0', '2024-12-01 09:27:43', '2024-12-01 09:27:43'),
('IN-2510-0004', 8, 6, 15, 'Biaya TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024 (Umum)', 300000, 10, 270000, 1, '2025-10-26', '2025-10-19 16:12:40', 'bank_transfer', 'bni', '9882531954073632', 'Dibayar melalui Midtrans dengan status settlement', '2025-10-19 08:42:05', '2025-10-19 15:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_cendekia`
--

CREATE TABLE `jadwal_cendekia` (
  `jadwal_cendekia_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_cendekia_id` int(11) NOT NULL,
  `ref_materi_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `jadwal_cendekia_hari` varchar(255) NOT NULL,
  `jadwal_mulai` time NOT NULL,
  `jadwal_selesai` time NOT NULL,
  `jadwal_cendekia_keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_cendekia`
--

INSERT INTO `jadwal_cendekia` (`jadwal_cendekia_id`, `kelas_cendekia_id`, `ref_materi_id`, `guru_id`, `jadwal_cendekia_hari`, `jadwal_mulai`, `jadwal_selesai`, `jadwal_cendekia_keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 29, 31, 'Senin', '16:15:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(2, 1, 37, 32, 'Senin', '16:30:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(3, 1, 21, 33, 'Senin', '16:15:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(4, 1, 14, 34, 'Senin', '16:30:00', '18:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(5, 3, 29, 37, 'Senin', '16:15:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(6, 3, 37, 39, 'Senin', '16:15:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(7, 3, 21, 33, 'Senin', '16:30:00', '18:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(8, 4, 29, 37, 'Senin', '18:30:00', '20:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(9, 4, 37, 39, 'Senin', '18:30:00', '20:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(10, 4, 21, 33, 'Senin', '18:30:00', '20:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(11, 4, 14, 34, 'Senin', '18:30:00', '20:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(12, 6, 1, 38, 'Senin', '16:15:00', '17:45:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(13, 6, 5, 36, 'Senin', '15:30:00', '17:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(14, 14, 3, 33, 'Jumat', '17:00:00', '18:00:00', NULL, '2025-10-25 03:10:21', '2025-10-26 10:00:03'),
(15, 12, 34, 0, 'Senin', '15:30:00', '17:00:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(16, 12, 19, 0, 'Senin', '17:00:00', '18:30:00', NULL, '2025-10-25 03:10:21', '2025-10-25 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_cendekia`
--

CREATE TABLE `kelas_cendekia` (
  `kelas_cendekia_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_cendekia_nama` varchar(255) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `kelas` int(11) NOT NULL,
  `kelas_cendekia_keterangan` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_cendekia`
--

INSERT INTO `kelas_cendekia` (`kelas_cendekia_id`, `kelas_cendekia_nama`, `jenjang`, `kelas`, `kelas_cendekia_keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, '9 - 1', 'SMP', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(2, '9 - 2', 'SMP', 9, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(3, '9 - 3', 'SMP', 9, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(4, '9 - 4', 'SMP', 9, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(5, '9 - 5', 'SMP', 9, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(6, '6 - 1', 'SD', 6, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(7, '6 - 2', 'SD', 6, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(8, '7 - 1', 'SMP', 7, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(9, '7 - 2', 'SMP', 7, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(10, '7 - 3', 'SMP', 7, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(11, '8 - 2', 'SMP', 8, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(12, '5 - 1', 'SD', 5, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(13, '5 ADI W', 'SD', 5, NULL, 'Aktif', '2025-10-25 03:10:21', '2025-10-25 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa_cendekia`
--

CREATE TABLE `kelas_siswa_cendekia` (
  `kelas_siswa_cendekia_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_cendekia_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_siswa_cendekia`
--

INSERT INTO `kelas_siswa_cendekia` (`kelas_siswa_cendekia_id`, `kelas_cendekia_id`, `siswa_id`, `created_at`, `updated_at`) VALUES
(1, 7, 42, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(2, 1, 43, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(3, 3, 44, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(4, 4, 45, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(5, 1, 46, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(6, 13, 47, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(7, 1, 48, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(8, 11, 49, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(9, 2, 50, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(10, 5, 51, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(11, 7, 52, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(12, 6, 53, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(13, 9, 54, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(14, 10, 55, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(15, 8, 56, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(16, 12, 57, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(17, 0, 58, '2025-10-25 03:10:21', '2025-10-25 03:10:21'),
(18, 3, 50, '2025-10-27 16:16:07', '2025-10-27 16:16:07'),
(19, 3, 44, '2025-10-27 16:16:07', '2025-10-27 16:16:07'),
(21, 3, 43, '2025-10-27 16:26:47', '2025-10-27 16:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_10_23_201340_updatetype_user', 2),
(5, '2025_10_23_202006_drop_referalcode_table', 2),
(6, '2025_10_24_150651_create_kelas_cendekia_table', 3),
(7, '2025_10_24_150745_create_jadwal_cendekia_table', 3),
(8, '2025_10_24_151320_create_kelas_siswa_cendekia', 3),
(9, '2025_10_25_100701_add_kelas_cendekia_i_d_column', 4),
(10, '2025_10_26_140637_add_jenjang_status_kelas_cendekia', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\User', 48),
(1, 'App\\Models\\User', 49),
(1, 'App\\Models\\User', 50),
(1, 'App\\Models\\User', 51),
(1, 'App\\Models\\User', 52),
(1, 'App\\Models\\User', 53),
(1, 'App\\Models\\User', 54),
(1, 'App\\Models\\User', 55),
(1, 'App\\Models\\User', 56),
(1, 'App\\Models\\User', 57),
(1, 'App\\Models\\User', 58),
(2, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'panel.dashboard', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27'),
(2, 'panel.logout', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27'),
(3, 'siswa.dashboard', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27'),
(4, 'siswa.logout', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_number`
--

CREATE TABLE `prefix_number` (
  `id` varchar(55) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prefix_number`
--

INSERT INTO `prefix_number` (`id`, `value`) VALUES
('Invoice', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ref_materi`
--

CREATE TABLE `ref_materi` (
  `ref_materi_id` bigint(20) UNSIGNED NOT NULL,
  `ref_materi_judul` varchar(255) NOT NULL,
  `ref_materi_jenjang` varchar(255) NOT NULL,
  `ref_materi_kelas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_materi`
--

INSERT INTO `ref_materi` (`ref_materi_id`, `ref_materi_judul`, `ref_materi_jenjang`, `ref_materi_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', 'SD', 6, '2024-12-01 09:37:20', '2025-10-13 15:07:39'),
(2, 'Bahasa Indonesia', 'SMP', 8, '2024-12-01 09:56:19', '2024-12-01 09:56:19'),
(3, 'Bahasa Inggris', 'SD', 6, '2024-12-01 10:08:21', '2025-10-13 15:07:43'),
(4, 'ipa', 'SMP', 7, '2025-09-22 12:06:05', '2025-09-22 12:06:05'),
(5, 'Bahasa Indonesia', 'SD', 6, '2025-10-13 15:03:29', '2025-10-13 15:07:47'),
(6, 'Materi', 'SMP', 9, '2025-10-20 14:57:37', '2025-10-20 14:57:37'),
(7, 'Bahasa Inggris', 'SD', 1, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(8, 'Bahasa Inggris', 'SD', 2, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(9, 'Bahasa Inggris', 'SD', 3, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(10, 'Bahasa Inggris', 'SD', 4, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(11, 'Bahasa Inggris', 'SD', 5, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(12, 'Bahasa Inggris', 'SMP', 7, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(13, 'Bahasa Inggris', 'SMP', 8, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(14, 'Bahasa Inggris', 'SMP', 9, '2025-10-24 13:04:55', '2025-10-24 13:04:55'),
(15, 'Bahasa Indonesia', 'SD', 1, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(16, 'Bahasa Indonesia', 'SD', 2, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(17, 'Bahasa Indonesia', 'SD', 3, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(18, 'Bahasa Indonesia', 'SD', 4, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(19, 'Bahasa Indonesia', 'SD', 5, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(20, 'Bahasa Indonesia', 'SMP', 7, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(21, 'Bahasa Indonesia', 'SMP', 9, '2025-10-24 13:05:48', '2025-10-24 13:05:48'),
(22, 'Matematika', 'SD', 1, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(23, 'Matematika', 'SD', 2, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(24, 'Matematika', 'SD', 3, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(25, 'Matematika', 'SD', 4, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(26, 'Matematika', 'SD', 5, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(27, 'Matematika', 'SMP', 7, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(28, 'Matematika', 'SMP', 8, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(29, 'Matematika', 'SMP', 9, '2025-10-24 13:06:00', '2025-10-24 13:06:00'),
(30, 'IPA', 'SD', 1, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(31, 'IPA', 'SD', 2, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(32, 'IPA', 'SD', 3, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(33, 'IPA', 'SD', 4, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(34, 'IPA', 'SD', 5, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(35, 'IPA', 'SD', 6, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(36, 'IPA', 'SMP', 8, '2025-10-24 13:06:08', '2025-10-24 13:06:08'),
(37, 'IPA', 'SMP', 9, '2025-10-24 13:06:08', '2025-10-24 13:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Siswa', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27'),
(2, 'Admin', 'web', '2025-09-25 02:33:54', '2025-09-25 02:33:54'),
(3, 'Pengajar', 'web', '2024-10-21 07:04:28', '2024-10-21 07:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tryout`
--

CREATE TABLE `tryout` (
  `tryout_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_judul` varchar(255) NOT NULL,
  `tryout_deskripsi` text NOT NULL,
  `tryout_jenjang` varchar(255) NOT NULL,
  `tryout_kelas` varchar(255) NOT NULL,
  `tryout_register_due` varchar(255) NOT NULL,
  `tryout_banner` varchar(255) DEFAULT NULL,
  `tryout_status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `tryout_jenis` enum('Gratis','Berbayar') NOT NULL DEFAULT 'Gratis',
  `is_open` varchar(50) NOT NULL DEFAULT 'Umum',
  `tryout_nominal` bigint(20) NOT NULL,
  `tryout_diskon` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout`
--

INSERT INTO `tryout` (`tryout_id`, `tryout_judul`, `tryout_deskripsi`, `tryout_jenjang`, `tryout_kelas`, `tryout_register_due`, `tryout_banner`, `tryout_status`, `tryout_jenis`, `is_open`, `tryout_nominal`, `tryout_diskon`, `created_at`, `updated_at`) VALUES
(2, 'TRYOUT-ERWIN-1', '<p>Materi tentang TENSES</p>', 'SMP', '9', '2026-01-01', NULL, 'Aktif', 'Gratis', 'Cendekia', 0, 0, '2024-11-27 08:19:26', '2025-10-20 15:04:55'),
(3, 'PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊<br>&nbsp;</p>', 'SD', '6', '2024-01-31', 'public/uploads/banner_tryout/1733036999_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Aktif', 'Berbayar', 'Umum', 20000, 0, '2024-12-01 07:09:59', '2024-12-01 07:09:59'),
(4, 'test tryout', '<p>test</p>', 'SMA', '12', '2024-01-31', 'public/uploads/banner_tryout/1733044149_Screenshot 2024-07-11 at 15.26.43.png', 'Aktif', 'Gratis', 'Cendekia', 0, 0, '2024-12-01 09:09:09', '2024-12-01 09:09:09'),
(5, 'coba', '', 'SMP', '7', '2025-01-20', NULL, 'Tidak Aktif', 'Gratis', 'Umum', 0, 0, '2025-09-22 12:04:07', '2025-09-22 12:04:07'),
(6, 'TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024 (Umum)', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊</p>', 'SD', '6', '2025-11-01', 'public/uploads/banner_tryout/1760370043_banner1.png', 'Aktif', 'Berbayar', 'Umum', 300000, 10, '2025-10-13 15:40:43', '2025-10-13 15:47:27'),
(7, 'tryout outbrain', '<p>asdfghjkl</p>', 'SMP', '8', '2025-10-20', 'public/uploads/banner_tryout/1760926402_codesni.png', 'Aktif', 'Berbayar', 'Cendekia', 90000, 10, '2025-10-20 02:13:22', '2025-10-20 02:13:22'),
(8, 'tryout outbrain', '<p>asdfghjk</p>', 'SMP', '9', '2026-01-01', 'public/uploads/banner_tryout/1760931200_img.png.jpg', 'Aktif', 'Gratis', 'Cendekia', 0, 0, '2025-10-20 03:33:20', '2025-10-20 14:46:02'),
(10, 'Test Kelas Internal', '<p>kajskaskdjaskjdad</p>', 'SMP', '9', '2025-10-27', 'public/uploads/banner_tryout/1761578960_gettyimages-1411749124-2048x2048.jpg', 'Aktif', 'Gratis', 'Cendekia', 0, 0, '2025-10-27 15:29:20', '2025-10-27 15:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_jawaban`
--

CREATE TABLE `tryout_jawaban` (
  `tryout_jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) NOT NULL,
  `tryout_soal_id` int(11) NOT NULL,
  `tryout_jawaban_prefix` varchar(255) NOT NULL,
  `tryout_jawaban_urutan` varchar(255) NOT NULL,
  `tryout_jawaban_isi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_jawaban`
--

INSERT INTO `tryout_jawaban` (`tryout_jawaban_id`, `tryout_materi_id`, `tryout_soal_id`, `tryout_jawaban_prefix`, `tryout_jawaban_urutan`, `tryout_jawaban_isi`, `created_at`, `updated_at`) VALUES
(1, 'jDClLOFP91', 1, 'A', '1', 'Reading improves vocabulary.', NULL, '2025-10-19 17:19:36'),
(2, 'jDClLOFP91', 1, 'B', '2', 'Watching TV is better than studying.', NULL, '2025-10-19 17:19:36'),
(3, 'jDClLOFP91', 1, 'C', '3', 'Practice makes perfect.', NULL, '2025-10-19 17:19:36'),
(4, 'jDClLOFP91', 1, 'D', '4', 'Sleeping late is healthy.', NULL, '2025-10-19 17:19:36'),
(5, 'jDClLOFP91', 2, 'A', '1', 'Eagle', NULL, '2025-10-19 17:18:45'),
(6, 'jDClLOFP91', 2, 'B', '2', 'Cat', NULL, '2025-10-19 17:18:45'),
(7, 'jDClLOFP91', 2, 'C', '3', 'Bat', NULL, '2025-10-19 17:18:45'),
(8, 'jDClLOFP91', 2, 'D', '4', 'Butterfly', NULL, '2025-10-19 17:18:45'),
(9, 'jDClLOFP91', 3, 'A', '1', 'He go to school every day.', NULL, '2025-10-19 17:24:34'),
(10, 'jDClLOFP91', 3, 'B', '2', 'He goes to school every day.', NULL, '2025-10-19 17:24:34'),
(11, 'jDClLOFP91', 3, 'C', '3', 'He going to school every day.', NULL, '2025-10-19 17:24:34'),
(12, 'jDClLOFP91', 3, 'D', '4', 'He gone to school every day.', NULL, '2025-10-19 17:24:34'),
(13, 'EbvsCZTeFw', 9, 'A', '1', 'A', '2025-10-20 15:32:14', '2025-10-20 15:32:14'),
(14, 'EbvsCZTeFw', 9, 'B', '2', 'B', '2025-10-20 15:32:14', '2025-10-20 15:32:14'),
(15, 'EbvsCZTeFw', 9, 'C', '3', 'C', '2025-10-20 15:32:14', '2025-10-20 15:32:14'),
(16, 'EbvsCZTeFw', 9, 'D', '4', 'D', '2025-10-20 15:32:14', '2025-10-20 15:32:14'),
(17, 'EbvsCZTeFw', 10, 'A', '1', 'A', '2025-10-20 15:32:39', '2025-10-20 15:32:39'),
(18, 'EbvsCZTeFw', 10, 'B', '2', 'B', '2025-10-20 15:32:39', '2025-10-20 15:32:39'),
(19, 'EbvsCZTeFw', 10, 'C', '3', 'C', '2025-10-20 15:32:39', '2025-10-20 15:32:39'),
(20, 'EbvsCZTeFw', 10, 'D', '4', 'D', '2025-10-20 15:32:39', '2025-10-20 15:32:39'),
(21, 'EbvsCZTeFw', 11, 'A', '1', 'AAA', '2025-10-20 15:34:48', '2025-10-20 15:34:48'),
(22, 'EbvsCZTeFw', 11, 'B', '2', 'BB', '2025-10-20 15:34:48', '2025-10-20 15:34:48'),
(23, 'EbvsCZTeFw', 11, 'C', '3', 'CCC', '2025-10-20 15:34:48', '2025-10-20 15:34:48'),
(24, 'EbvsCZTeFw', 11, 'D', '4', 'DDD', '2025-10-20 15:34:48', '2025-10-20 15:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_materi`
--

CREATE TABLE `tryout_materi` (
  `tryout_materi_id` varchar(255) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `pengajar_id` int(11) NOT NULL,
  `tryout_materi_deskripsi` text DEFAULT NULL,
  `jenis_soal` varchar(55) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `safe_mode` int(11) NOT NULL DEFAULT 1,
  `master_soal` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_materi`
--

INSERT INTO `tryout_materi` (`tryout_materi_id`, `tryout_id`, `materi_id`, `pengajar_id`, `tryout_materi_deskripsi`, `jenis_soal`, `jumlah_soal`, `periode_mulai`, `periode_selesai`, `waktu_mulai`, `waktu_selesai`, `durasi`, `safe_mode`, `master_soal`, `created_at`, `updated_at`) VALUES
('2RU8zGWTcq', 10, 14, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 1, NULL, NULL, NULL),
('8nC3mzCYKq', 10, 37, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 1, NULL, NULL, NULL),
('EbvsCZTeFw', 2, 6, 18, '100', 'PDF', 6, NULL, NULL, NULL, NULL, 90, 1, 'public/uploads/soal/1760973784_Contoh Soal-2.pdf', NULL, '2025-10-20 22:23:07'),
('jDClLOFP91', 6, 3, 18, 'Tryout Bahasa Inggris untuk SD membantu siswa mengenali kosakata dasar, memahami kalimat sederhana, serta melatih kemampuan mendengarkan dan membaca teks pendek. Materi mencakup topik sehari-hari seperti keluarga, hobi, warna, dan benda di sekitar.', 'FORM', 3, NULL, NULL, NULL, NULL, 60, 1, NULL, NULL, '2025-10-19 23:00:26'),
('RYYpa2McMa', 10, 29, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 1, NULL, NULL, NULL),
('tqMZfC74ei', 6, 5, 18, 'Tryout Bahasa Indonesia untuk tingkat SD ini dirancang untuk menguji kemampuan membaca, memahami isi teks, menulis dengan tata bahasa yang baik, serta penggunaan ejaan dan tanda baca yang benar. Soal mencakup berbagai jenis teks seperti narasi, deskripsi, dan dialog.', 'PDF', 6, NULL, NULL, NULL, NULL, 60, 1, 'public/uploads/soal/1760373782_Contoh Soal-2.pdf', NULL, '2025-10-13 23:43:05'),
('wDofJXNyfY', 6, 1, 18, 'The Mathematics tryout for elementary school aims to evaluate students’ understanding of basic arithmetic, measurement, geometry, and problem-solving. The questions are designed to strengthen logical thinking and real-life application of math concepts.', NULL, NULL, NULL, NULL, NULL, NULL, 60, 1, NULL, NULL, NULL),
('yWNNfmnqRm', 10, 21, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tryout_nilai`
--

CREATE TABLE `tryout_nilai` (
  `tryout_nilai_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `tryout_materi_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nilai` double DEFAULT NULL,
  `total_point` int(11) DEFAULT 0,
  `soal_dijekerjakan` int(11) DEFAULT NULL,
  `soal_total` int(11) DEFAULT NULL,
  `jumlah_salah` varchar(255) DEFAULT NULL,
  `jumlah_benar` varchar(255) DEFAULT NULL,
  `last_soal_id` int(11) DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'Proses',
  `mulai_pengerjaan` datetime DEFAULT NULL,
  `stop_pengerjaan` datetime DEFAULT NULL,
  `lanjutkan_pengerjaan` datetime DEFAULT NULL,
  `selesai_pengerjaan` datetime DEFAULT NULL,
  `durasi_berjalan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_open_pendaftaran`
--

CREATE TABLE `tryout_open_pendaftaran` (
  `top_id` int(11) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `top_email` varchar(255) NOT NULL,
  `top_nama_siswa` varchar(255) NOT NULL,
  `top_asal_sekolah` varchar(255) NOT NULL,
  `top_telpon_siswa` varchar(255) NOT NULL,
  `top_nama_orang_tua` varchar(255) NOT NULL,
  `top_telpon_orang_tua` varchar(255) NOT NULL,
  `top_tanggal_bayar` date NOT NULL,
  `top_jenis_bayar` varchar(255) NOT NULL,
  `top_bukti_bayar` varchar(255) NOT NULL,
  `top_nama_bayar` varchar(255) NOT NULL,
  `top_status` enum('Pending','Terverifikasi') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_pengerjaan`
--

CREATE TABLE `tryout_pengerjaan` (
  `tryout_pengerjaan_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) NOT NULL,
  `tryout_soal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tryout_jawaban` varchar(10) NOT NULL,
  `status` enum('Benar','Salah','Sebagian Benar') NOT NULL DEFAULT 'Salah',
  `point` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_peserta`
--

CREATE TABLE `tryout_peserta` (
  `tryout_peserta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `tryout_id` int(11) NOT NULL,
  `tryout_peserta_name` varchar(255) NOT NULL,
  `tryout_peserta_telpon` varchar(255) NOT NULL,
  `tryout_peserta_email` varchar(255) NOT NULL,
  `tryout_peserta_alamat` varchar(255) NOT NULL,
  `tryout_peserta_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_peserta`
--

INSERT INTO `tryout_peserta` (`tryout_peserta_id`, `user_id`, `tryout_id`, `tryout_peserta_name`, `tryout_peserta_telpon`, `tryout_peserta_email`, `tryout_peserta_alamat`, `tryout_peserta_status`, `created_at`, `updated_at`) VALUES
(15, 8, 6, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 1, '2025-10-19 08:42:05', '2025-10-19 15:15:44'),
(16, 8, 2, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 1, '2025-10-20 15:05:53', '2025-10-20 15:05:53'),
(17, 43, 10, 'RAMEYZA HAFID QURRATUAININ', '0896033009876', 'rameyza.hafid.qurratuainin@cendekia.com', 'TRAYEMAN RT 02 PLERET BANTUL', 1, NULL, NULL),
(18, 46, 10, 'MADHYANA DIPTA KIRANAJATI', '081987654322', 'madhyana.dipta.kiranajati@cendekia.com', 'WARUNGBOTO UH 4/931, RT 033/RW 008, WARUNGBOTO, UMBULHARJO, YOGYAKARTA 55164', 1, NULL, NULL),
(19, 48, 10, 'MUHAMMAD ZURAR RAFIF', '089245670844', 'muhammad.zurar.rafif@cendekia.com', 'BASEN, PURBAYAN, KOTAGEDE', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tryout_soal`
--

CREATE TABLE `tryout_soal` (
  `tryout_soal_id` bigint(20) UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) NOT NULL,
  `tryout_nomor` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 1,
  `tryout_soal` longtext DEFAULT NULL,
  `tryout_soal_type` varchar(10) DEFAULT NULL,
  `tryout_kunci_jawaban` varchar(255) DEFAULT NULL,
  `tryout_penyelesaian` varchar(255) DEFAULT NULL,
  `notes` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_orang_tua` varchar(255) DEFAULT NULL,
  `telp_orang_tua` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `tipe_siswa` enum('Cendekia','Umum') NOT NULL DEFAULT 'Umum',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password_otp` varchar(255) DEFAULT NULL,
  `password_otp_expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roles_id`, `name`, `email`, `telepon`, `asal_sekolah`, `jenjang`, `kelas`, `alamat`, `nama_orang_tua`, `telp_orang_tua`, `avatar`, `tipe_siswa`, `email_verified_at`, `password`, `remember_token`, `password_otp`, `password_otp_expires_at`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(8, 1, 'Faris Aizy', 'farisaizy12@gmail.com', '085600200913', 'SD Indonesia Merdeka', 'SD', '5', 'Jl ABc', 'Test', '9021830912830', 'public/uploads/avatar/1732698688_Screenshot 2024-06-27 215605.png', 'Umum', NULL, '$2y$10$BEm7CrVga8uHvEtzjX26cuHG9RIIWW/nN0wkzmgrsSI5HD75Yh6Um', NULL, NULL, NULL, 'Aktif', NULL, '2024-11-27 09:10:58', '2025-10-19 06:39:27'),
(18, 3, 'Test Pengajar 1', 'pengajar1@gmail.com', '085600913', 'SD MUHAMMADIYAH BAUSASRAN 1', NULL, NULL, NULL, NULL, NULL, 'public/uploads/avatar/1733042407_Screenshot 2024-07-11 at 15.26.43.png', 'Umum', NULL, '$2y$10$UOBDX8Nzw1/.OniyOVruPeOilp4qcz/BcrGUEgd66lLJnel1Np2x.', NULL, NULL, NULL, 'Aktif', NULL, '2024-12-01 08:40:07', '2024-12-01 08:40:07'),
(27, 1, 'pia santoso', 'pia69@gmail.com', '123456789', '-', 'SMA', '12', 'sonopakis', 'ayaaaaaa', '23546789', NULL, 'Umum', NULL, '$2y$10$ijrb3V3zUtL5Opo0JTtwFOyH3TUsO/wl0cDK58cBzu7VILbKV.LnS', NULL, NULL, NULL, 'Aktif', NULL, '2025-09-25 08:12:30', '2025-09-25 08:12:30'),
(28, 1, 'KakaPatria', 'kakapatria65@gmail.com', '', '', '', '', '', '', '', NULL, 'Umum', NULL, '$2y$10$2NQ3Z9mu0yn.4pXs7mfbkuMp.LoOIICGQVmwtYOgB3qZQ7FXDzIfS', 'jAi9YKxCbI9BqZM6RDMEmMXA0tZVPwjyy126W9lniSkBHzpGIly4yIdNoUBK', NULL, NULL, 'Aktif', NULL, '2025-09-26 03:58:43', '2025-09-29 05:03:50'),
(29, 2, 'Admin 2', 'admin2@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Umum', NULL, '$2y$10$hcZ4eI.ja6fl4LIFLr0/W.XgVW.2Do6n8h/3WrsP.n.irthIhgcHK', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:17:51', '2025-10-13 15:17:51'),
(30, 2, 'Admin 3', 'admin3@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Umum', NULL, '$2y$10$2mOXRRUEcQGPEMuTIS/M2ufNO1SplpLgUMPZ0OHVeYexiN2oinEzu', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:18:14', '2025-10-13 15:18:14'),
(31, 3, 'Pak Rofiq', 'pak.rofiq@cendekia.com\r\n', '(+62) 380 9333 028', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:14', '$2y$10$.BgMpa6/8B4rCqnrxsfyOOZRPUL2frL3L9xFShDQjGT.E/kMjm9Z2', 'YVZfFHqacy', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:14', '2025-10-24 13:06:14'),
(32, 3, 'Pak Rischa', 'pak.rischa@cendekia.com\r\n', '020 9921 2444', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$e4UBQpHrh3qLMAWl/6X7RuAfInd5zvQ42XuALXnATVaV0kkGv8X6a', 'BR9RnOewnK', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(33, 3, 'Bu Devi', 'bu.devi@cendekia.com\r\n', '(+62) 537 2058 5299', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$iFAukhO5UfutYsX22NUKReu0H46l6qanKVlek0olJbH1NFp/87Cbe', 'RtazO1d96p', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(34, 3, 'Uncle', 'uncle@cendekia.com\r\n', '0300 9756 968', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$AIg4UH0mPtRq8R6/GIEGGuojS0WdgnyCTdL8Uwk6bUwdpADgcaWVO', 'wez6AdOCsg', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(35, 3, 'P Arfan', 'p.arfan@cendekia.com\r\n', '0783 9934 4761', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$/1NbDXQvOYK0WSkUFCJVdOACwQ2ssf/r2nAQvXgKhgi0PUL2kgkN2', '0QeUSn7RaP', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(36, 3, 'P Handoko', 'p.handoko@cendekia.com\r\n', '0863 191 095', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$opKd.Ae5GHusJa0d2ZFyyuR3918f8AsOpv7aGvDN16r7yyt1eK9VW', 'Yjt63XlwmP', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(37, 3, 'Pak Wodo', 'pak.wodo@cendekia.com\r\n', '0748 1209 9760', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$prXQsnOuhRz0P0zjpcOzge.aWn1KM4PAkR1iIs6fnPEBODvNT3bpi', 'F5qjFRGwyY', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(38, 3, 'Pak Agus', 'pak.agus@cendekia.com\r\n', '0972 5477 740', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$V5DOEf.gxFCdtPBJppVPw.vl1hPxUIdyWhNytkz9g8.k.bvJaclHO', 'jtDGbJlrLO', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(39, 3, 'Pak Andang', 'pak.andang@cendekia.com\r\n', '(+62) 21 8656 9618', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$VTSqFA.GtGlLtFjY0wTluuLAE3dIykwDdkmew4aCSyn15cVttoiwG', 'WKwnF0HOAI', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(40, 3, 'M. Alfian', 'm.alfian@cendekia.com\r\n', '(+62) 737 5211 7476', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$gfgPS0fwVnHWBtQ9NteRt./Is8zC9fzaG9DXf8LDL6Eqj/nGouEiq', 'L3161urc37', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(41, 3, 'Dilla', 'dilla@cendekia.com\r\n', '0856 644 733', '-', '-', '0', NULL, NULL, NULL, NULL, 'Umum', '2025-10-24 13:06:15', '$2y$10$p3F4MxuyhDLqubPemrdh8.X0RSBCxqKzwESPRITjrsTmLBud.leiG', 'gZh8mEKVAy', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:06:15', '2025-10-24 13:06:15'),
(42, 1, 'ZAHRAN HAFID AL KHALIFI', 'zahran.hafid.al.khalifi@cendekia.com', '089510876548', 'SD MUH KLECO KOTAGEDE YOGYAKARTA', 'SD', '6', 'TRAYEMAN RT 02 PLERET BANTUL', 'MAKRUF HAFID', '088765456', NULL, 'Cendekia', '2025-10-24 13:07:56', '$2y$10$p16JyiEY0/0UCNMwhXNDU.spMt4dzUbVjEhjGrDX6BrO1Yfk.EuRS', 'o49LyJVRUw', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:56', '2025-10-25 04:55:05'),
(43, 1, 'RAMEYZA HAFID QURRATUAININ', 'rameyza.hafid.qurratuainin@cendekia.com', '0896033009876', 'SMP MUH 2 YOGYAKARTA', 'SMP', '9', 'TRAYEMAN RT 02 PLERET BANTUL', 'MAKRUF HAFID', '0821123456', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$gfh5CTna9pwIP9mMt/7pFOvaCvze0yjZk0Np8N8TyaWJTwBY2JxMm', 'PFquyaG70R', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-25 04:53:42'),
(44, 1, 'MUHAMMAD FATHURROHMAN', 'muhammad.fathurrohman@cendekia.com', '087465236882', 'SMP N 2 PLERET', 'SMP', '9', 'PERUM TRIMULYO BLOK D3 NO.1, JETIS, BANTUL', 'AGUS MURWANTO', '08579873456', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$.31O8XSBDZZQ37eaxMp3HOOXJP1DjzSjEGxPRcnNEI.wdOoshyeay', 'lVMG6hRZn4', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(45, 1, 'NOUVELINE PRIMA SARI', 'nouveline.prima.sari@cendekia.com', '089609876445', 'SMPN 10 YK', 'SMP', '9', 'JALAN MANUNGGAL 080, MUTIHAN RT 03, WIROKERTEN, BANGUNTAPAN, BANTUL', 'ODANG MUHAMMMAD JAMHARI', '08109876523456', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$/BjEEygjN9EKf8s4KV78B.Whu1dmIXKkgkZPR79Xi./kp/gp/E9C6', 'NULKbp4ngi', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-25 04:54:47'),
(46, 1, 'MADHYANA DIPTA KIRANAJATI', 'madhyana.dipta.kiranajati@cendekia.com', '081987654322', 'SMPN 9 YOGYAKARTA', 'SMP', '9', 'WARUNGBOTO UH 4/931, RT 033/RW 008, WARUNGBOTO, UMBULHARJO, YOGYAKARTA 55164', 'GALUH RAHMI PANGESTIx', '082345677654', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$iide6VqbzBZieR0BEgd/iuxPtYiNIYnDSIwdFqMf/iNuv8eMnOinS', '5hkNvxSS3a', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-25 04:48:55'),
(47, 1, 'ATHIFA HATMAKINARTIKA', 'athifa.hatmakinartika@cendekia.com', '085612346546', 'SD PEDAGOGIA LAB FIPP UNY', 'SD', '5', 'CEPOR RT 04/02, SENDANGTIRTO, BERBAH, SLEMAN', 'NURULITA SEPTIANAX', '085123456542', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$zQ9Xa9KME/1mG1OGU/4mpe9Hadeho52DohpFL5/uyMcTduUrx2Imm', 'WS2JWdKQbU', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-25 04:54:56'),
(48, 1, 'MUHAMMAD ZURAR RAFIF', 'muhammad.zurar.rafif@cendekia.com', '089245670844', 'SMP NEGERI 9 YOGYAKARTA', 'SMP', '9', 'BASEN, PURBAYAN, KOTAGEDE', 'KHOIRI NURYATI', '08955678987654', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$HR3J6SYtgV/Ce4zuWgzOSe39vRDkD9r9x4FMs2yfZmRiWTyHaTQdu', '89CfTseRtC', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(49, 1, 'NAYARA PUTRI ISNAINI', 'nayara.putri.isnaini@cendekia.com', '085768765499', 'SMP NEGERI 10 YOGYAKARTA', 'SMP', '8', 'TEGALSARI RT 10 JOMBLANGAN, BANGUNTAPAN', 'ISNAINI', '08734567898765', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$4vc77o3V4LKp5pIJvE1sAek9scZCSdlHSyPY8OvonU2hthUdNu4V6', '2WkEGht5Lo', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(50, 1, 'FAKHRI ARBIA PRATAMA', 'fakhri.arbia.pratama@cendekia.com', '089876543122', 'SMP 9 YK', 'SMP', '9', 'PILAHAN PERMAI B17 RT 36 RW 11 YOGYAKARTA', 'DIAN EKHAWATI', '0832345654', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$w2P5BEha.861gp19O4C24eqoo9KjfnsqDqXrxjisdNGyVhD0EcTRy', '2LOnyvTh9B', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(51, 1, 'HADIAH NAFI RUSDIANA NINGSIH', 'hadiah.nafi.rusdiana.ningsih@cendekia.com', '08978554999', 'SMP Negeri 9', 'SMP', '8', 'PERUM GIWANG PRATAMA NO 43, GIWANGAN UMBULHARJO YOGYAKARTA', 'SULASTRININGSIH', '0824567876', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$R.YCH5irA5Iz3VvVEH0TXOORuBsvMaaCH1IQ6CAFFL7Uo5ceZGX2u', 'bDDch5bOUQ', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(52, 1, 'JANEETA NAIFA SILMI', 'janeeta.naifa.silmi@cendekia.com', '08076524651', 'SDN KOTAGEDE 4', 'SD', '6', 'BUMEN KOTAGEDE YOGYAKARTA', 'YUNIKA PERMATA SARI', '08959876543456', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$yTKyb2N53tWF0sAByHL1YOG6qtX4xtH8KTZ3tqyyNTVJJovz.EsZG', 'RKFnMG8EZU', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(53, 1, 'AHZA DANISH FAHREZA', 'ahza.danish.fahreza@cendekia.com', '089754457922', 'SD MUHAMMADIYAH SOKONANDI', 'SD', '6', 'JOMBLANGAN, RT 12 NO C 20', 'MUTHMAINAH FAJAR', '0857236785453', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$HxJVZZYbiE7U0GLjWV69J.b8LOzIJJjW5S0kD5xnxPvnpSFSaeWqy', 'MnDcUUemh3', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(54, 1, 'SOFIE ALEA NUR SYABAN PALUPI', 'sofie.alea.nur.syaban.palupi@cendekia.com', '08797567896', 'SMP NEGERI 9 YOGYAKARTA', 'SMP', '7', 'GRIYA PURWA ASRI G202, KALASAN, PURWAMARTANI, SLEMAN', 'SUMANTRI SRI NUGRAHA', '0899347575234', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$T.YlODH7fvLS6HaZNBzQOu686LRvUD8MB363QQ2GzeE0B4Y5ioc76', 'D7YnO2q8hd', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(55, 1, 'AKMAL KENZIE KURNIADI', 'akmal.kenzie.kurniadi@cendekia.com', '0839533479', 'BELUM MENDAFTAR', 'SMP', '7', 'SUNTEN RT 08 PADUKUHAN JOMBLANGAN BANGUNTAPAN', 'IKA PAWESTRI AVIV KURNIADI', '08154859075452', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$8wkNczMPBPabcnR0.dqOAOqWaB3t63eVu1g6k.rGvRdnXWDy0mM2O', 'uC9D9gkdcC', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(56, 1, 'KAYLA RAISA NURADHARA', 'kayla.raisa.nuradhara@cendekia.com', '083507325797', 'SMP NEGERI 9 YOGYAKARTA', 'SMP', '7', 'Jl.TINALAN RT 18 / 04 KAV GREEN GARDEN HARMONY A4 KOTAGEDE', 'PUTRI ELLYSA', '085296367694', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$vD3eFY7kvmTr89VoYN0jKOGIv4XKK/glCN6nNAQxiU45HPOluJTdG', 'JqAGlV2SV7', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(57, 1, 'ALIYYAH ZAHRA MAHESTRI', 'aliyyah.zahra.mahestri@cendekia.com', '081234567899', 'SD MUHAMMADIYAH KLECO', 'SD', '5', 'REJOWINANGUN KG 1/373 RT 20 RW 06 KOTAGEDE YK', 'ANWAR SANUSI', '083108653456', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$FBMN9yejPpbFErhYpb2GxunF3JvlUCn2u6CNbMGx/Zr9iu1cvldrm', 'K2k2FerZ2M', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(58, 1, 'AYRAHASNA ABHIMASYAH', 'ayrahasna.abhimasyah@cendekia.com', '08523456789', 'SDIT LUQMAN AL HAKIM TIMOHO YOGYAKARTA', 'SD', '5', 'PURI HEGAR 1, JL. RETNO DUMILAH, REJOWINANGUN, KOTAGEDE, YOGYAKARTA', 'FITRI WULANSARI', '08562356788', NULL, 'Cendekia', '2025-10-24 13:07:57', '$2y$10$49c7elNbJba263hQKCwK2ua3gReLgXZrGg.qzlAmEX4zaEQAwUCY6', 'tHoJz1zpUU', NULL, NULL, 'Aktif', NULL, '2025-10-24 13:07:57', '2025-10-24 13:07:57'),
(59, 1, 'Siswa 1 Testing', 'testsiswa1@gmail.com', '02193018123', 'SD KANISIUS GAYAM 1', 'SD', '2', 'Jl Abcd', 'Jhon', '0901239', NULL, 'Cendekia', NULL, '$2y$10$HiCYM6V1KpmyAu38R7o0ietvlD.1KsbbDhjG3ct4zy1T4ezv/KEFC', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-25 04:59:53', '2025-10-25 05:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `jadwal_cendekia`
--
ALTER TABLE `jadwal_cendekia`
  ADD PRIMARY KEY (`jadwal_cendekia_id`);

--
-- Indexes for table `kelas_cendekia`
--
ALTER TABLE `kelas_cendekia`
  ADD PRIMARY KEY (`kelas_cendekia_id`);

--
-- Indexes for table `kelas_siswa_cendekia`
--
ALTER TABLE `kelas_siswa_cendekia`
  ADD PRIMARY KEY (`kelas_siswa_cendekia_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ref_materi`
--
ALTER TABLE `ref_materi`
  ADD PRIMARY KEY (`ref_materi_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tryout`
--
ALTER TABLE `tryout`
  ADD PRIMARY KEY (`tryout_id`);

--
-- Indexes for table `tryout_jawaban`
--
ALTER TABLE `tryout_jawaban`
  ADD PRIMARY KEY (`tryout_jawaban_id`);

--
-- Indexes for table `tryout_materi`
--
ALTER TABLE `tryout_materi`
  ADD PRIMARY KEY (`tryout_materi_id`);

--
-- Indexes for table `tryout_nilai`
--
ALTER TABLE `tryout_nilai`
  ADD PRIMARY KEY (`tryout_nilai_id`);

--
-- Indexes for table `tryout_open_pendaftaran`
--
ALTER TABLE `tryout_open_pendaftaran`
  ADD PRIMARY KEY (`top_id`);

--
-- Indexes for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  ADD PRIMARY KEY (`tryout_pengerjaan_id`);

--
-- Indexes for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  ADD PRIMARY KEY (`tryout_peserta_id`);

--
-- Indexes for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  ADD PRIMARY KEY (`tryout_soal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_users_roles` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_cendekia`
--
ALTER TABLE `jadwal_cendekia`
  MODIFY `jadwal_cendekia_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelas_cendekia`
--
ALTER TABLE `kelas_cendekia`
  MODIFY `kelas_cendekia_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kelas_siswa_cendekia`
--
ALTER TABLE `kelas_siswa_cendekia`
  MODIFY `kelas_siswa_cendekia_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_materi`
--
ALTER TABLE `ref_materi`
  MODIFY `ref_materi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `tryout_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tryout_jawaban`
--
ALTER TABLE `tryout_jawaban`
  MODIFY `tryout_jawaban_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tryout_nilai`
--
ALTER TABLE `tryout_nilai`
  MODIFY `tryout_nilai_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tryout_open_pendaftaran`
--
ALTER TABLE `tryout_open_pendaftaran`
  MODIFY `top_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  MODIFY `tryout_peserta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  MODIFY `tryout_soal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
