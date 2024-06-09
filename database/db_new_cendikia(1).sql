-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2024 at 12:20 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_new_cendikia`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_peserta_id` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `status` int NOT NULL,
  `due_date` date NOT NULL,
  `inv_paid` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `user_id`, `tryout_id`, `tryout_peserta_id`, `keterangan`, `amount`, `status`, `due_date`, `inv_paid`, `created_at`, `updated_at`) VALUES
('IN-2405-0010', 102, 21, 24, 'Biaya TRYOUT SD Paket 10', 285153, 0, '2024-06-07', NULL, '2024-05-30 19:57:37', '2024-05-30 19:57:37'),
('IN-2406-0011', 13, 4, 29, 'Biaya TRYOUT SMP Paket 3', 882231, 1, '2024-06-01', '2024-06-01', '2024-06-01 02:04:58', '2024-06-01 02:04:58'),
('IN-2406-0012', 14, 4, 30, 'Biaya TRYOUT SMP Paket 3', 882231, 1, '2024-06-01', '2024-06-01', '2024-06-01 02:04:58', '2024-06-01 02:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_26_023010_create_permission_tables', 1),
(6, '2024_05_26_073202_create_materis_table', 1),
(7, '2024_05_26_091732_create_tryouts_table', 2),
(8, '2024_05_26_091755_create_tryout_materis_table', 2),
(9, '2024_05_29_025856_create_tryout_pesertas_table', 3),
(10, '2024_05_29_040801_create_tryout_nilais_table', 4),
(11, '2024_05_29_073647_create_invoices_table', 5),
(12, '2024_06_01_054349_create_tryout_soals_table', 6),
(13, '2024_06_01_054556_create_tryout_jawabans_table', 7),
(14, '2024_06_02_160359_create_tryout_pengerjaans_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 9),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 20),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\User', 23),
(1, 'App\\Models\\User', 24),
(1, 'App\\Models\\User', 25),
(1, 'App\\Models\\User', 26),
(1, 'App\\Models\\User', 27),
(1, 'App\\Models\\User', 28),
(1, 'App\\Models\\User', 29),
(1, 'App\\Models\\User', 30),
(1, 'App\\Models\\User', 31),
(1, 'App\\Models\\User', 32),
(1, 'App\\Models\\User', 33),
(1, 'App\\Models\\User', 34),
(1, 'App\\Models\\User', 35),
(1, 'App\\Models\\User', 36),
(1, 'App\\Models\\User', 37),
(1, 'App\\Models\\User', 38),
(1, 'App\\Models\\User', 39),
(1, 'App\\Models\\User', 40),
(1, 'App\\Models\\User', 41),
(1, 'App\\Models\\User', 42),
(1, 'App\\Models\\User', 43),
(1, 'App\\Models\\User', 44),
(1, 'App\\Models\\User', 45),
(1, 'App\\Models\\User', 46),
(1, 'App\\Models\\User', 47),
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
(1, 'App\\Models\\User', 59),
(1, 'App\\Models\\User', 60),
(1, 'App\\Models\\User', 61),
(1, 'App\\Models\\User', 62),
(1, 'App\\Models\\User', 63),
(1, 'App\\Models\\User', 64),
(1, 'App\\Models\\User', 65),
(1, 'App\\Models\\User', 66),
(1, 'App\\Models\\User', 67),
(1, 'App\\Models\\User', 68),
(1, 'App\\Models\\User', 69),
(1, 'App\\Models\\User', 70),
(1, 'App\\Models\\User', 71),
(1, 'App\\Models\\User', 72),
(1, 'App\\Models\\User', 73),
(1, 'App\\Models\\User', 74),
(1, 'App\\Models\\User', 75),
(1, 'App\\Models\\User', 76),
(1, 'App\\Models\\User', 77),
(1, 'App\\Models\\User', 78),
(1, 'App\\Models\\User', 79),
(1, 'App\\Models\\User', 80),
(1, 'App\\Models\\User', 81),
(3, 'App\\Models\\User', 82),
(3, 'App\\Models\\User', 83),
(3, 'App\\Models\\User', 84),
(3, 'App\\Models\\User', 85),
(3, 'App\\Models\\User', 86),
(3, 'App\\Models\\User', 87),
(3, 'App\\Models\\User', 88),
(3, 'App\\Models\\User', 89),
(3, 'App\\Models\\User', 90),
(3, 'App\\Models\\User', 91),
(3, 'App\\Models\\User', 92),
(3, 'App\\Models\\User', 93),
(3, 'App\\Models\\User', 94),
(3, 'App\\Models\\User', 95),
(3, 'App\\Models\\User', 96),
(3, 'App\\Models\\User', 97),
(3, 'App\\Models\\User', 98),
(3, 'App\\Models\\User', 99),
(3, 'App\\Models\\User', 100),
(3, 'App\\Models\\User', 101);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'panel.dashboard', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12'),
(2, 'panel.logout', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12'),
(3, 'siswa.dashboard', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12'),
(4, 'siswa.logout', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prefix_number`
--

INSERT INTO `prefix_number` (`id`, `value`) VALUES
('Invoice', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ref_materi`
--

CREATE TABLE `ref_materi` (
  `ref_materi_id` bigint UNSIGNED NOT NULL,
  `ref_materi_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_kelas` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_materi`
--

INSERT INTO `ref_materi` (`ref_materi_id`, `ref_materi_judul`, `ref_materi_jenjang`, `ref_materi_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', 'SD', 3, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(2, 'Ilmu Pengetahuan Alam', 'SD', 5, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(3, 'Ilmu Pengetahuan Alam', 'SD', 4, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(4, 'Matematika', 'SD', 5, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(5, 'Bahasa Indonesia', 'SD', 2, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(6, 'Matematika', 'SD', 4, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(7, 'Matematika', 'SD', 6, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(8, 'Matematika', 'SD', 5, '2024-05-30 02:42:47', '2024-05-30 02:42:47'),
(9, 'Ilmu Pengetahuan Alam', 'SD', 6, '2024-05-30 02:42:48', '2024-05-30 02:42:48'),
(10, 'Bahasa Indonesia', 'SD', 6, '2024-05-30 02:42:48', '2024-05-30 02:42:48'),
(11, 'Ilmu Pengetahuan Alam', 'SMP', 7, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(12, 'Matematika', 'SMP', 9, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(13, 'Bahasa Indonesia', 'SMP', 7, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(14, 'Matematika', 'SMP', 9, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(15, 'Bahasa Indonesia', 'SMP', 9, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(16, 'Ilmu Pengetahuan Sosial', 'SMP', 7, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(17, 'Matematika', 'SMP', 7, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(18, 'Bahasa Indonesia', 'SMP', 7, '2024-05-30 02:43:39', '2024-05-30 02:43:39'),
(19, 'Bahasa Indonesia', 'SMP', 7, '2024-05-30 02:43:40', '2024-05-30 02:43:40'),
(20, 'Ilmu Pengetahuan Alam', 'SMP', 8, '2024-05-30 02:43:40', '2024-05-30 02:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Siswa', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12'),
(2, 'Admin', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12'),
(3, 'Pengajar', 'web', '2024-05-26 00:45:12', '2024-05-26 00:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 1),
(4, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tryout`
--

CREATE TABLE `tryout` (
  `tryout_id` bigint UNSIGNED NOT NULL,
  `tryout_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_register_due` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `tryout_jenis` enum('Gratis','Berbayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Gratis',
  `tryout_nominal` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout`
--

INSERT INTO `tryout` (`tryout_id`, `tryout_judul`, `tryout_deskripsi`, `tryout_jenjang`, `tryout_kelas`, `tryout_register_due`, `tryout_banner`, `tryout_status`, `tryout_jenis`, `tryout_nominal`, `created_at`, `updated_at`) VALUES
(2, 'TRYOUT SMP Paket 1', '<p>Qui ut maxime ut voluptatum ea ipsum.</p>', 'SMP', '7', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 03:11:32', '2024-06-01 01:47:08'),
(3, 'TRYOUT SMP Paket 2', 'Velit aut esse et distinctio aliquam et quo.', 'SMP', '7', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 03:11:32', '2024-05-30 03:11:32'),
(4, 'TRYOUT SMP Paket 3', 'Ut repellendus et adipisci rerum ducimus.', 'SMP', '7', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 882231, '2024-05-30 03:11:32', '2024-05-30 03:11:32'),
(5, 'TRYOUT SMP Paket 4', 'At perferendis eius sed aperiam et veniam.', 'SMP', '7', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 359921, '2024-05-30 03:11:32', '2024-05-30 03:11:32'),
(6, 'TRYOUT SMP Paket 5', 'Ad iure consequatur placeat sed et qui natus.', 'SMP', '9', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 788761, '2024-05-30 03:11:32', '2024-05-30 03:11:32'),
(7, 'TRYOUT SMP Paket 6', 'Veritatis tenetur saepe dicta tempora sint ad.', 'SMP', '9', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 833630, '2024-05-30 03:11:33', '2024-05-30 03:11:33'),
(8, 'TRYOUT SMP Paket 7', 'Voluptates modi soluta provident rem assumenda quod.', 'SMP', '8', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 03:11:33', '2024-05-30 03:11:33'),
(9, 'TRYOUT SMP Paket 8', 'Sed repudiandae quasi quis eum consectetur.', 'SMP', '9', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 421473, '2024-05-30 03:11:33', '2024-05-30 03:11:33'),
(10, 'TRYOUT SMP Paket 9', 'Ut sint vero cumque libero officia sunt.', 'SMP', '9', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 815725, '2024-05-30 03:11:34', '2024-05-30 03:11:34'),
(11, 'TRYOUT SMP Paket 10', 'Reiciendis cupiditate dolor blanditiis nisi.', 'SMP', '7', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 558089, '2024-05-30 03:11:34', '2024-05-30 03:11:34'),
(12, 'TRYOUT SD Paket 1', 'Mollitia minima qui dignissimos sunt doloribus voluptatum inventore.', 'SD', '6', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 19:39:13', '2024-05-30 19:39:13'),
(13, 'TRYOUT SD Paket 2', 'Aspernatur nesciunt nostrum ut dolores et et.', 'SD', '5', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 19:39:13', '2024-05-30 19:39:13'),
(14, 'TRYOUT SD Paket 3', 'Libero qui non ipsam nihil nihil accusamus non.', 'SD', '6', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 656244, '2024-05-30 19:39:14', '2024-05-30 19:39:14'),
(15, 'TRYOUT SD Paket 4', 'Nihil est necessitatibus voluptatem et nostrum.', 'SD', '3', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 118824, '2024-05-30 19:39:14', '2024-05-30 19:39:14'),
(16, 'TRYOUT SD Paket 5', 'Et architecto explicabo pariatur omnis non.', 'SD', '5', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 700086, '2024-05-30 19:39:15', '2024-05-30 19:39:15'),
(17, 'TRYOUT SD Paket 6', 'Qui nihil consequatur consectetur.', 'SD', '2', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 131167, '2024-05-30 19:39:15', '2024-05-30 19:39:15'),
(18, 'TRYOUT SD Paket 7', 'Ullam rem eum ratione earum sed nostrum.', 'SD', '6', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Gratis', 0, '2024-05-30 19:39:15', '2024-05-30 19:39:15'),
(19, 'TRYOUT SD Paket 8', 'Sed eos qui voluptatibus voluptatum aspernatur similique enim.', 'SD', '5', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 888167, '2024-05-30 19:39:15', '2024-05-30 19:39:15'),
(20, 'TRYOUT SD Paket 9', 'Animi sapiente omnis eligendi atque voluptatibus ut autem esse.', 'SD', '4', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 669345, '2024-05-30 19:39:16', '2024-05-30 19:39:16'),
(21, 'TRYOUT SD Paket 10', 'Rerum voluptatem ipsum quia et cum velit.', 'SD', '4', '2024-06-15', 'public/uploads/banner_tryout/LBB-Cendekia-Yogyakarta-Banner.jpeg', 'Aktif', 'Berbayar', 285153, '2024-05-30 19:39:16', '2024-05-30 19:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_jawaban`
--

CREATE TABLE `tryout_jawaban` (
  `tryout_jawaban_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `tryout_jawaban_prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_urutan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_jawaban`
--

INSERT INTO `tryout_jawaban` (`tryout_jawaban_id`, `tryout_materi_id`, `tryout_soal_id`, `tryout_jawaban_prefix`, `tryout_jawaban_urutan`, `tryout_jawaban_isi`, `created_at`, `updated_at`) VALUES
(1, 'tvoQ0eLevT', 6, 'A', '1', '2', NULL, NULL),
(2, 'tvoQ0eLevT', 6, 'B', '2', '8', NULL, '2024-06-01 01:33:43'),
(3, 'tvoQ0eLevT', 6, 'C', '3', '-7', NULL, NULL),
(4, 'tvoQ0eLevT', 6, 'D', '4', '-8', NULL, NULL),
(5, 'tvoQ0eLevT', 7, 'A', '1', '6mn^2 dan 11mn^2', NULL, NULL),
(6, 'tvoQ0eLevT', 7, 'B', '2', '-7m^2 n dan 11mn^2', NULL, NULL),
(7, 'tvoQ0eLevT', 7, 'C', '3', '6mn^2 dan -m^2 n^2', NULL, NULL),
(8, 'tvoQ0eLevT', 7, 'D', '4', '8', NULL, '2024-06-01 01:33:32'),
(9, 'tvoQ0eLevT', 8, 'A', '1', '〖14x〗^2+6xy-2x', NULL, NULL),
(10, 'tvoQ0eLevT', 8, 'B', '2', '〖6x〗^2+12xy+12x', NULL, NULL),
(11, 'tvoQ0eLevT', 8, 'C', '3', '〖-6x〗^2+12xy-2x', NULL, NULL),
(12, 'tvoQ0eLevT', 8, 'D', '4', '〖-14x〗^2-6xy+12x', NULL, NULL),
(13, 'tvoQ0eLevT', 9, 'A', '1', '〖-12x〗^2-8x+5', NULL, NULL),
(14, 'tvoQ0eLevT', 9, 'B', '2', '〖-12x〗^2-32x-20', NULL, NULL),
(15, 'tvoQ0eLevT', 9, 'C', '3', '〖12x〗^2-32x+20', NULL, NULL),
(16, 'tvoQ0eLevT', 9, 'D', '4', '〖-12x〗^2+32x-2', NULL, NULL),
(17, 'tvoQ0eLevT', 10, 'A', '1', '-4x^2-3x+9', NULL, NULL),
(18, 'tvoQ0eLevT', 10, 'B', '2', '-8x^2-3x+9', NULL, NULL),
(19, 'tvoQ0eLevT', 10, 'C', '3', '-8x^2+3x-9', NULL, NULL),
(20, 'tvoQ0eLevT', 10, 'D', '4', '4x^2+3x-9', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tryout_materi`
--

CREATE TABLE `tryout_materi` (
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_id` int NOT NULL,
  `materi_id` int NOT NULL,
  `pengajar_id` int NOT NULL,
  `tryout_materi_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `jenis_soal` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `safe_mode` int NOT NULL DEFAULT '1',
  `master_soal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_materi`
--

INSERT INTO `tryout_materi` (`tryout_materi_id`, `tryout_id`, `materi_id`, `pengajar_id`, `tryout_materi_deskripsi`, `jenis_soal`, `periode_mulai`, `periode_selesai`, `safe_mode`, `master_soal`, `created_at`, `updated_at`) VALUES
('2kKL25bqsA', 7, 11, 82, 'Suscipit dolore dolorem provident fuga tempore cupiditate molestiae magnam.', '', NULL, NULL, 1, '', NULL, NULL),
('4EeMrFSmY1', 21, 10, 82, 'Est amet ipsa soluta sed.', '', NULL, NULL, 1, '', NULL, NULL),
('7fmBRKbwR9', 5, 11, 82, 'Voluptatem quasi maiores fuga sed dolores expedita.', '', NULL, NULL, 1, '', NULL, NULL),
('7PTL1OdMq6', 13, 1, 82, 'Minus quis dolores ab ut consectetur.', '', NULL, NULL, 1, '', NULL, NULL),
('9wVBNjKTPs', 19, 1, 82, 'Sit quidem et molestiae ut.', '', NULL, NULL, 1, '', NULL, NULL),
('aTm0lrCIfR', 18, 1, 91, 'Possimus sed sed qui commodi.', '', NULL, NULL, 1, '', NULL, NULL),
('auapQ5XRTw', 13, 1, 82, 'Aperiam quis in et ducimus.', '', NULL, NULL, 1, '', NULL, NULL),
('BDE1LoiX22', 6, 20, 91, 'Eum quasi nam dolorem sunt doloremque.', '', NULL, NULL, 1, '', NULL, NULL),
('BG6qlOv1Js', 9, 11, 82, 'Sed a beatae vel optio cupiditate sed.', '', NULL, NULL, 1, '', NULL, NULL),
('dSRglPmV90', 15, 1, 82, 'Voluptas fugit iure excepturi ut mollitia mollitia.', '', NULL, NULL, 1, '', NULL, NULL),
('dUcX7DPDK9', 12, 7, 91, 'Est at aut nihil.', '', '2024-06-03', '2024-06-08', 0, '', NULL, '2024-06-01 14:59:32'),
('E4QWiS77nw', 20, 1, 82, 'In enim est perferendis reprehenderit quas quia.', '', NULL, NULL, 1, '', NULL, NULL),
('eid3HEL56a', 19, 10, 82, 'Fugiat sunt qui odit et illo.', '', NULL, NULL, 1, '', NULL, NULL),
('ePFwjbfnmX', 5, 11, 82, 'Ut animi magni ab perferendis.', '', NULL, NULL, 1, '', NULL, NULL),
('FogfFn8jCt', 15, 10, 82, 'Voluptatum ab et vel aut ut non.', '', NULL, NULL, 1, '', NULL, NULL),
('fulBw2uFVo', 13, 10, 91, 'Quia nesciunt quod amet.', '', NULL, NULL, 1, '', NULL, NULL),
('Fw5pJBBOOz', 9, 11, 82, 'Praesentium nam quis impedit temporibus.', '', NULL, NULL, 1, '', NULL, NULL),
('H1oE3Nkf60', 6, 20, 91, 'Cumque officia nobis voluptatibus amet tempore.', '', NULL, NULL, 1, '', NULL, NULL),
('hdopeIr9rK', 20, 1, 91, 'Deserunt quae nam vel beatae qui et dignissimos.', '', NULL, NULL, 1, '', NULL, NULL),
('hHnsCMit2m', 11, 11, 82, 'Illo et esse officia velit eligendi earum.', '', NULL, NULL, 1, '', NULL, NULL),
('HRq6oE61FC', 16, 1, 91, 'Animi voluptates deserunt voluptatem mollitia rerum enim.', '', NULL, NULL, 1, '', NULL, NULL),
('HsgVGgD9P8', 17, 10, 91, 'Aut dolorem architecto consequatur et porro voluptate aperiam.', '', NULL, NULL, 1, '', NULL, NULL),
('JNc6srKBCh', 21, 10, 82, 'Non earum qui enim occaecati veritatis inventore.', '', NULL, NULL, 1, '', NULL, NULL),
('l8vPy9Tt9t', 3, 20, 91, 'Qui deleniti tempora eius ducimus voluptate tempora enim.', '', NULL, NULL, 1, '', NULL, NULL),
('LqIvP9UodR', 18, 1, 91, 'Saepe odio eaque praesentium quia tempora dignissimos possimus voluptatibus.', '', NULL, NULL, 1, '', NULL, NULL),
('MCwH1DNKeD', 18, 10, 82, 'Ut quos reiciendis dolores fuga sequi aliquam ducimus provident.', '', NULL, NULL, 1, '', NULL, NULL),
('mJa9qCpir9', 18, 10, 91, 'Et tenetur ratione sed ut id.', '', NULL, NULL, 1, '', NULL, NULL),
('MqbckEjLQy', 4, 11, 82, 'Praesentium quia possimus sint possimus unde rerum et.', '', NULL, NULL, 1, '', NULL, NULL),
('nfLCsi1aiY', 14, 1, 82, 'Dolorum commodi voluptatibus cumque facilis ut blanditiis quis.', '', NULL, NULL, 1, '', NULL, NULL),
('Nk25znhF9b', 14, 1, 82, 'Soluta consequuntur fugit culpa officia aut sed aut vitae.', '', NULL, NULL, 1, '', NULL, NULL),
('nm5pcNXFA2', 4, 11, 82, 'Et asperiores vel quisquam quibusdam.', '', NULL, NULL, 1, '', NULL, NULL),
('NmYMfLiz04', 10, 11, 82, 'Neque autem ipsam est vel.', '', NULL, NULL, 1, '', NULL, NULL),
('o2WUApn93P', 13, 10, 91, 'Quam nam aut minus incidunt quisquam nihil vitae quia.', '', NULL, NULL, 1, '', NULL, NULL),
('OBxvINfAUc', 10, 20, 82, 'Amet id quidem iure est.', '', NULL, NULL, 1, '', NULL, NULL),
('phwNJM7Sud', 10, 11, 82, 'Voluptatem sit consequuntur fugiat repellendus magnam.', '', NULL, NULL, 1, '', NULL, NULL),
('qmQVcfkIuB', 21, 1, 82, 'Sequi voluptatem quia autem nostrum molestiae nam.', '', NULL, NULL, 1, '', NULL, NULL),
('rdH5B3mIeX', 16, 1, 91, 'Sequi a quasi et in quisquam.', '', NULL, NULL, 1, '', NULL, NULL),
('RjOslIeFvR', 15, 1, 82, 'Corrupti et quo quis voluptate cum tempora corporis sint.', '', NULL, NULL, 1, '', NULL, NULL),
('ttogNZhTJ6', 10, 11, 91, 'Corporis explicabo pariatur sint.', '', NULL, NULL, 1, '', NULL, NULL),
('tv1UJAVEhA', 6, 20, 82, 'Voluptatem fugit voluptates ea optio ducimus quisquam corporis.', '', NULL, NULL, 1, '', NULL, NULL),
('tvoQ0eLevT', 2, 11, 82, 'Sint tenetur recusandae mollitia et.', 'PDF', '2024-05-30', '2024-06-08', 1, 'public/uploads/soal/1717221565_Contoh Soal-2.pdf', NULL, '2024-06-01 15:30:53'),
('uaD8w2mTtx', 5, 20, 91, 'Nisi id ut necessitatibus velit qui aspernatur.', '', NULL, NULL, 1, '', NULL, NULL),
('vuTQjPprdp', 2, 17, 84, 'Teest Edit', NULL, NULL, NULL, 1, NULL, NULL, '2024-06-01 09:39:16'),
('VVyoPsoq8u', 9, 20, 82, 'Doloremque atque nobis et libero.', '', NULL, NULL, 1, '', NULL, NULL),
('w01BJzZ9Wy', 17, 10, 82, 'Doloremque quia asperiores repellendus quia laudantium officiis.', '', NULL, NULL, 1, '', NULL, NULL),
('WG9xigpmig', 8, 20, 82, 'Quis magni accusamus et occaecati laborum nesciunt voluptatum.', '', NULL, NULL, 1, '', NULL, NULL),
('wlUMCO4JOR', 5, 11, 82, 'Ut quam aut et voluptate itaque aliquam.', '', NULL, NULL, 1, '', NULL, NULL),
('WMX3g6lz1j', 7, 11, 91, 'Dolor illum et adipisci.', '', NULL, NULL, 1, '', NULL, NULL),
('XYrn2p32EP', 20, 10, 82, 'Facere quaerat doloremque veniam dolore aut.', '', NULL, NULL, 1, '', NULL, NULL),
('z5mKFtNya5', 14, 1, 91, 'Et quia et provident quae quos in sapiente.', '', NULL, NULL, 1, '', NULL, NULL),
('zHE1Gcpv42', 21, 1, 82, 'Quia adipisci quas maiores et ut temporibus quia.', '', NULL, NULL, 1, '', NULL, NULL),
('zrwvFOZiDas', 12, 10, 82, 'Consectetur quo sit ut ut soluta est adipisci vitae.', '', '2024-05-31', '2024-06-08', 1, '', NULL, '2024-06-01 15:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_nilai`
--

CREATE TABLE `tryout_nilai` (
  `tryout_nilai_id` bigint UNSIGNED NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `nilai` double DEFAULT NULL,
  `soal_dijekerjakan` int DEFAULT NULL,
  `soal_total` int DEFAULT NULL,
  `jumlah_salah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_benar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_soal_id` int NOT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Proses',
  `mulai_pengerjaan` datetime DEFAULT NULL,
  `stop_pengerjaan` datetime DEFAULT NULL,
  `lanjutkan_pengerjaan` datetime DEFAULT NULL,
  `selesai_pengerjaan` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_nilai`
--

INSERT INTO `tryout_nilai` (`tryout_nilai_id`, `tryout_id`, `tryout_materi_id`, `user_id`, `nilai`, `soal_dijekerjakan`, `soal_total`, `jumlah_salah`, `jumlah_benar`, `last_soal_id`, `status`, `mulai_pengerjaan`, `stop_pengerjaan`, `lanjutkan_pengerjaan`, `selesai_pengerjaan`, `created_at`, `updated_at`) VALUES
(1, 12, 'dUcX7DPDK9', 1, 58, NULL, NULL, '42', '58', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(2, 12, 'dUcX7DPDK9', 2, 92, NULL, NULL, '8', '92', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(3, 12, 'dUcX7DPDK9', 3, 94, NULL, NULL, '6', '94', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(4, 12, 'dUcX7DPDK9', 4, 98, NULL, NULL, '2', '98', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(5, 12, 'dUcX7DPDK9', 5, 89, NULL, NULL, '11', '89', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(6, 12, 'dUcX7DPDK9', 6, 98, NULL, NULL, '2', '98', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(7, 12, 'dUcX7DPDK9', 7, 51, NULL, NULL, '49', '51', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(8, 12, 'dUcX7DPDK9', 8, 89, NULL, NULL, '11', '89', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:45', '2024-05-28 21:18:45'),
(9, 12, 'dUcX7DPDK9', 9, 80, NULL, NULL, '20', '80', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:46', '2024-05-28 21:18:46'),
(10, 12, 'dUcX7DPDK9', 10, 92, NULL, NULL, '8', '92', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:46', '2024-05-28 21:18:46'),
(11, 12, 'zrwvFOZiDas', 1, 77, NULL, NULL, '23', '77', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(12, 12, 'zrwvFOZiDas', 2, 99, NULL, NULL, '1', '99', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(13, 12, 'zrwvFOZiDas', 3, 79, NULL, NULL, '21', '79', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(14, 12, 'zrwvFOZiDas', 4, 60, NULL, NULL, '40', '60', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(15, 12, 'zrwvFOZiDas', 5, 100, NULL, NULL, '0', '100', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(16, 12, 'zrwvFOZiDas', 6, 96, NULL, NULL, '4', '96', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(17, 12, 'zrwvFOZiDas', 7, 95, NULL, NULL, '5', '95', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:58', '2024-05-28 21:18:58'),
(18, 12, 'zrwvFOZiDas', 8, 65, NULL, NULL, '35', '65', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:59', '2024-05-28 21:18:59'),
(19, 12, 'zrwvFOZiDas', 9, 67, NULL, NULL, '33', '67', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:59', '2024-05-28 21:18:59'),
(20, 12, 'zrwvFOZiDas', 10, 100, NULL, NULL, '0', '100', 0, 'Proses', NULL, NULL, NULL, NULL, '2024-05-28 21:18:59', '2024-05-28 21:18:59'),
(22, 2, 'tvoQ0eLevT', 24, 60, 5, 5, '2', '3', 10, 'Selesai', '2024-06-02 16:46:35', '2024-06-02 17:22:46', '2024-06-02 18:05:54', '2024-06-02 18:06:01', '2024-06-02 09:46:35', '2024-06-02 11:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_pengerjaan`
--

CREATE TABLE `tryout_pengerjaan` (
  `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tryout_jawaban` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Benar','Salah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Salah',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_pengerjaan`
--

INSERT INTO `tryout_pengerjaan` (`tryout_pengerjaan_id`, `tryout_materi_id`, `tryout_soal_id`, `user_id`, `tryout_jawaban`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tvoQ0eLevT', 6, 24, 'B', 'Salah', '2024-06-02 10:21:33', '2024-06-02 10:21:33'),
(2, 'tvoQ0eLevT', 7, 24, 'A', 'Benar', '2024-06-02 10:22:09', '2024-06-02 10:22:09'),
(3, 'tvoQ0eLevT', 8, 24, 'C', 'Benar', '2024-06-02 10:22:42', '2024-06-02 10:22:42'),
(4, 'tvoQ0eLevT', 9, 24, 'C', 'Salah', '2024-06-02 10:36:56', '2024-06-02 10:38:03'),
(5, 'tvoQ0eLevT', 10, 24, 'A', 'Benar', '2024-06-02 10:54:39', '2024-06-02 10:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_peserta`
--

CREATE TABLE `tryout_peserta` (
  `tryout_peserta_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_peserta_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_telpon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_peserta`
--

INSERT INTO `tryout_peserta` (`tryout_peserta_id`, `user_id`, `tryout_id`, `tryout_peserta_name`, `tryout_peserta_telpon`, `tryout_peserta_email`, `tryout_peserta_alamat`, `tryout_peserta_status`, `created_at`, `updated_at`) VALUES
(24, 102, 21, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl axxssd', 0, '2024-05-30 19:57:37', '2024-05-30 19:57:37'),
(25, 102, 3, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Alamat', 1, '2024-05-30 20:48:32', '2024-05-30 20:48:32'),
(26, 3, 3, 'Among Siregar', '0932 6205 9551', 'pradana.talia@example.com', '', 1, '2024-06-01 02:04:30', '2024-06-01 02:04:30'),
(27, 40, 3, 'Wisnu Taufik Prabowo', '(+62) 349 9528 9988', 'hana58@example.net', '', 1, '2024-06-01 02:04:30', '2024-06-01 02:04:30'),
(28, 46, 3, 'Cayadi Tampubolon', '0894 311 346', 'hidayanto.warji@example.org', '', 1, '2024-06-01 02:04:30', '2024-06-01 02:04:30'),
(29, 13, 4, 'Ophelia Yolanda', '0937 3391 3173', 'xmegantara@example.com', '', 1, '2024-06-01 02:04:58', '2024-06-01 02:04:58'),
(30, 14, 4, 'Waluyo Wardi Sihotang', '0274 5282 8142', 'aardianto@example.com', '', 1, '2024-06-01 02:04:58', '2024-06-01 02:04:58'),
(31, 24, 12, 'Dewi Agustina', '0373 0465 898', 'aaryani@example.com', 'alamat', 1, '2024-06-01 07:03:16', '2024-06-01 07:03:16'),
(32, 24, 2, 'Dewi Agustina', '0373 0465 898', 'aaryani@example.com', '', 1, '2024-06-01 08:30:26', '2024-06-01 08:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_soal`
--

CREATE TABLE `tryout_soal` (
  `tryout_soal_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_nomor` int NOT NULL,
  `tryout_soal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_kunci_jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_penyelesaian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_soal`
--

INSERT INTO `tryout_soal` (`tryout_soal_id`, `tryout_materi_id`, `tryout_nomor`, `tryout_soal`, `tryout_kunci_jawaban`, `tryout_penyelesaian`, `created_at`, `updated_at`) VALUES
(6, 'tvoQ0eLevT', 1, 'public/uploads/soal/image/jawaban_1_1717221565.jpg', 'A', 'public/uploads/soal/image/jawaban_2_1717221566.jpg', NULL, '2024-06-01 01:33:32'),
(7, 'tvoQ0eLevT', 2, 'public/uploads/soal/image/jawaban_3_1717221566.jpg', 'A', 'public/uploads/soal/image/jawaban_4_1717221566.jpg', NULL, '2024-05-31 23:53:00'),
(8, 'tvoQ0eLevT', 3, 'public/uploads/soal/image/jawaban_5_1717221566.jpg', 'C', 'public/uploads/soal/image/jawaban_6_1717221566.jpg', NULL, '2024-05-31 23:53:00'),
(9, 'tvoQ0eLevT', 4, 'public/uploads/soal/image/jawaban_7_1717221566.jpg', 'B', 'public/uploads/soal/image/jawaban_8_1717221566.jpg', NULL, '2024-05-31 23:53:00'),
(10, 'tvoQ0eLevT', 5, 'public/uploads/soal/image/jawaban_9_1717221567.jpg', 'A', 'public/uploads/soal/image/jawaban_10_1717221567.jpg', NULL, '2024-05-31 23:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telepon`, `asal_sekolah`, `jenjang`, `kelas`, `avatar`, `email_verified_at`, `password`, `remember_token`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'lms@cendikia.com', '085600200913', '-', '', '', NULL, '2024-05-30 00:46:29', '$2y$10$QkKWR1QeG2k8nTEG3/Yd0eBMJ4A/EdYy4ut41VxMQUs4CzpypWKPG', '3bpAgJNBTR', 'Aktif', NULL, '2024-05-30 00:46:29', '2024-05-30 00:46:29'),
(2, 'Hasim Siregar M.Ak', 'cemeti.laksmiwati@example.com', '(+62) 792 9062 963', 'SD KANISIUS GAYAM 1', 'SD', '1', NULL, '2024-05-30 00:59:06', '$2y$10$h8eUrMKgSkb32Lmp14Zb8.zEBDYD3i8c.qCIsUIqL1A5cG4Eti01e', 'TZroMR8JuW', 'Aktif', NULL, '2024-05-30 00:59:06', '2024-05-30 00:59:06'),
(3, 'Among Siregar', 'pradana.talia@example.com', '0932 6205 9551', 'SD NEGERI JETIS 1', 'SD', '2', NULL, '2024-05-30 00:59:06', '$2y$10$.lQxlyLQ6u4EYHyzW1XfqOz3ZbwEKKa/deTYRZZMTOwUV79gvdn.i', 'uKLS4OA0I5', 'Aktif', NULL, '2024-05-30 00:59:06', '2024-05-30 00:59:06'),
(4, 'Dono Zulkarnain M.Pd', 'kuswandari.dono@example.net', '0839 9474 471', 'SD NEGERI LEMPUYANGAN 1', 'SD', '5', NULL, '2024-05-30 00:59:06', '$2y$10$CwEMWwLQAIbgeMllW1VLhezGRmRegERZXP26v/5d3TTqNzpwjV8Bi', 'SpLFdfotgf', 'Aktif', NULL, '2024-05-30 00:59:06', '2024-05-30 00:59:06'),
(5, 'Kusuma Suwarno', 'uyainah.langgeng@example.net', '(+62) 639 5611 2544', 'SD MUHAMMADIYAH BAUSASRAN 1', 'SD', '3', NULL, '2024-05-30 00:59:06', '$2y$10$ZYW72s1a4VxIih7cCjtSXOhbil8T1ZkoWCxAefmVwUj/dZbYubEde', 'i1NfMudh3k', 'Aktif', NULL, '2024-05-30 00:59:06', '2024-05-30 00:59:06'),
(6, 'Oni Mutia Suryatmi', 'hasna.nababan@example.net', '0233 3373 940', 'SD MUHAMMADIYAH BAUSASRAN 2', 'SD', '2', NULL, '2024-05-30 00:59:06', '$2y$10$4Bn3iqtY9rEPgHMWQqTPn.Vz/24PZC5mPpvLKbZi.Tt1mLZY2Bwta', 'TrO7SsRCKH', 'Aktif', NULL, '2024-05-30 00:59:06', '2024-05-30 00:59:06'),
(7, 'Makuta Wijaya S.Kom', 'hartaka.firgantoro@example.net', '(+62) 263 9153 439', 'SD NEGERI DEMANGAN', 'SD', '2', NULL, '2024-05-30 00:59:07', '$2y$10$uPPWBzt/bAa/qBGeGejieuKD5IYgkt12oFHpA59/Y.o4Xz7Jqe27i', 'lBCpmDMrYE', 'Aktif', NULL, '2024-05-30 00:59:07', '2024-05-30 00:59:07'),
(8, 'Jamal Harsaya Anggriawan S.Gz', 'daryani.sitorus@example.org', '(+62) 371 1507 9389', 'SD TAMANSISWA JETIS', 'SD', '6', NULL, '2024-05-30 00:59:07', '$2y$10$kh2MJ4vTupmKBUtbZeYBmOKLrMZxRqVHBoEhCo.DSI.Pa1B0HUXH2', 'cBCnYRnEGa', 'Aktif', NULL, '2024-05-30 00:59:07', '2024-05-30 00:59:07'),
(9, 'Sakura Pratiwi', 'rpertiwi@example.net', '0591 3246 1471', 'SD NEGERI JETISHARJO', 'SD', '5', NULL, '2024-05-30 00:59:07', '$2y$10$ga101eaOmXuf7YdW2mVhVuQN5lnQ/4nSB8IxH5tIjvIPrizbHoZQi', 'Kxaz3KBwog', 'Aktif', NULL, '2024-05-30 00:59:07', '2024-05-30 00:59:07'),
(10, 'Legawa Kurniawan', 'vpuspasari@example.com', '0231 3984 468', 'SD JOANNES BOSCO YOGYAKARTA', 'SD', '2', NULL, '2024-05-30 00:59:07', '$2y$10$8.qi/L1h9QXwD20GWiZVfuO4CBt5VqdGfnL6l3rFQaVdv5v1gd6JG', 'hvt7JdOEJ5', 'Aktif', NULL, '2024-05-30 00:59:07', '2024-05-30 00:59:07'),
(11, 'Catur Rajasa', 'nasyidah.agnes@example.org', '0613 7228 560', 'SD NEGERI COKROKUSUMAN', 'SD', '2', NULL, '2024-05-30 00:59:08', '$2y$10$AM5KIrDYLEgWEEvRExRxDuMd.IxTJnR.SHrop77dJBuFzzptM2XNK', 'DP0QQrAl7R', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(12, 'Irma Pertiwi', 'elisa70@example.com', '(+62) 887 498 443', 'SD NEGERI COKROKUSUMAN', 'SD', '4', NULL, '2024-05-30 00:59:08', '$2y$10$1ZGm7IHeNDSIGDaFD7wVpupA8Ck3JwBPnqFKTwmBhCewsrZnrwXN.', 'iX5RrNOnsC', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(13, 'Ophelia Yolanda', 'xmegantara@example.com', '0937 3391 3173', 'SD MUHAMMADIYAH BAUSASRAN 2', 'SD', '2', NULL, '2024-05-30 00:59:08', '$2y$10$IV/VZypvMyeCwpn0Ugkad.WR2.uMpjaXwy20wgzAgczHq9DZ6r9nW', 'ghMyjoAa0Z', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(14, 'Waluyo Wardi Sihotang', 'aardianto@example.com', '0274 5282 8142', 'SD NEGERI JETIS 1', 'SD', '4', NULL, '2024-05-30 00:59:08', '$2y$10$tXU7PTYB8lML5HSBm5LLKes3T5g1i0AMIG9y0CvdzqHmAGVzWxHdq', '7dqdytg0Qj', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(15, 'Yuni Aryani', 'mpuspita@example.org', '(+62) 369 4090 7534', 'SD NEGERI BHAYANGKARA', 'SD', '3', NULL, '2024-05-30 00:59:08', '$2y$10$Fk5XCGxfGQZfADaHODzm9.TJmG0UrYVF6J1ot4bKe14H6T3hRvqcm', '2BOmrmIvIR', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(16, 'Ganep Siregar S.H.', 'santoso.laila@example.org', '0620 2156 1297', 'SD MUHAMMADIYAH BAUSASRAN 1', 'SD', '5', NULL, '2024-05-30 00:59:08', '$2y$10$uB6dfsbD7k/VFOM3z4WQU.EI8vYuPxtOntP4ZuuzQX/rqYXqOH0Qa', 'Z0lZyl9NMf', 'Aktif', NULL, '2024-05-30 00:59:08', '2024-05-30 00:59:08'),
(17, 'Elvina Suartini', 'laksita.gading@example.org', '(+62) 28 5351 4217', 'SD NEGERI COKROKUSUMAN', 'SD', '6', NULL, '2024-05-30 00:59:09', '$2y$10$VEnyhBxAHkudhR8loxJVx.rpPytb9vA9s2OHfZ5CerOb351nAs2aq', 'uRsdWRqV59', 'Aktif', NULL, '2024-05-30 00:59:09', '2024-05-30 00:59:09'),
(18, 'Hamzah Hasim Marpaung S.Psi', 'haryanti.talia@example.net', '0658 4266 930', 'SD NEGERI JETIS 1', 'SD', '3', NULL, '2024-05-30 00:59:09', '$2y$10$GSU2d2BpZkWnQKfecIyRe.4vgqiLwvlpjD1If7S/sXFU4SjOBMX16', 'M8YpSmXtUA', 'Aktif', NULL, '2024-05-30 00:59:09', '2024-05-30 00:59:09'),
(19, 'Pangestu Ismail Ramadan', 'shakila.nasyidah@example.org', '(+62) 741 2092 6804', 'SD NEGERI WIDORO', 'SD', '6', NULL, '2024-05-30 00:59:09', '$2y$10$6RxA5pp8DR4uGhTtxGpmp.PPFVzOx/m3ITOyEyUlbA0UQb2S93UNa', 'unakL94qtV', 'Aktif', NULL, '2024-05-30 00:59:09', '2024-05-30 00:59:09'),
(20, 'Ganda Daliman Sirait', 'kanda42@example.org', '(+62) 253 0322 416', 'SD NEGERI LEMPUYANGAN 1', 'SD', '4', NULL, '2024-05-30 00:59:09', '$2y$10$agBNuhOyboQUkFDpLYTBYOuU6.vUVzdItjsdwg22GIFaAo0i9wkNu', 'H70jdplho4', 'Aktif', NULL, '2024-05-30 00:59:09', '2024-05-30 00:59:09'),
(21, 'Zelaya Aryani M.M.', 'bahuwarna.januar@example.com', '0238 2588 779', 'SD NEGERI SERAYU', 'SD', '1', NULL, '2024-05-30 00:59:10', '$2y$10$sS95hKOSQDJOAeqCkbo6NO4uBk6DC5EnB0vk1p30QU9irfpJqWEz6', 'YvFHLXqe3K', 'Aktif', NULL, '2024-05-30 00:59:10', '2024-05-30 00:59:10'),
(22, 'Purwanto Emin Firgantoro S.E.I', 'sihombing.umi@example.org', '0812 343 914', 'SD NEGERI UNGARAN 1', 'SD', '5', NULL, '2024-05-30 00:59:10', '$2y$10$hv4KF5Wr2C6Czy5Zn61SVOfhRQEqTScsJbz5sFBZOVqK6B0xCPiW6', 'ImX9KdRPYb', 'Aktif', NULL, '2024-05-30 00:59:10', '2024-05-30 00:59:10'),
(23, 'Hardi Vega Simanjuntak', 'ewidiastuti@example.com', '0384 2468 2767', 'SD MUHAMMADIYAH BAUSASRAN 1', 'SD', '2', NULL, '2024-05-30 00:59:11', '$2y$10$QJTVBKyfkigqJ0vEsBhLCublBkogv5tPAA.JnyiqwHsWHbCbRIwoG', 'VdGADScF8f', 'Aktif', NULL, '2024-05-30 00:59:11', '2024-05-30 00:59:11'),
(24, 'Dewi Agustina', 'aaryani@example.com', '0373 0465 898', 'SD BOPKRI GONDOLAYU', 'SD', '6', NULL, '2024-05-30 00:59:11', '$2y$10$WP3rJX6gKkg5w6tfjb6OFO/sChT4Mgq8yn9qqEJh8cm0GcocLO0SS', 'As5b72Oc5A', 'Aktif', NULL, '2024-05-30 00:59:11', '2024-05-30 00:59:11'),
(25, 'Anastasia Handayani', 'wmulyani@example.net', '(+62) 761 4225 2304', 'SD NEGERI JETIS 1', 'SD', '6', NULL, '2024-05-30 00:59:11', '$2y$10$feqeGfHsLXOADmQR2wqyDO2ztFkLfg.Ba7vJ9sROlSZohDo8Mmesm', 'cWstPlzYE8', 'Aktif', NULL, '2024-05-30 00:59:11', '2024-05-30 00:59:11'),
(26, 'Nadia Yuliarti', 'frahayu@example.org', '0992 7100 6546', 'SD NEGERI KYAI MOJO', 'SD', '5', NULL, '2024-05-30 00:59:11', '$2y$10$sn3ScVrf1JcOi3ugzKzv5uqsiSq5cu7pwJMlvtVnCiCjE1o5DFaQa', 'ScN1o6xYxs', 'Aktif', NULL, '2024-05-30 00:59:11', '2024-05-30 00:59:11'),
(27, 'Sari Ilsa Usada', 'onasyidah@example.org', '(+62) 828 643 657', 'SD NEGERI BUMIJO', 'SD', '5', NULL, '2024-05-30 00:59:12', '$2y$10$H6lEMgqBdvFit1vIOnUexeX.s/LVV3EBL0o.AzwMZloCGwj4W8j3e', '4MXC6eSCd8', 'Aktif', NULL, '2024-05-30 00:59:12', '2024-05-30 00:59:12'),
(28, 'Opung Budiman', 'mustofa.jatmiko@example.net', '(+62) 813 075 086', 'SD BOPKRI GONDOLAYU', 'SD', '6', NULL, '2024-05-30 00:59:12', '$2y$10$J8rX/BHn0LSjpRyzPQEZauYKAMz1p4QqKhtIgTDlehbpbLlAB.sGO', 'syFnQUxd3r', 'Aktif', NULL, '2024-05-30 00:59:12', '2024-05-30 00:59:12'),
(29, 'Irsad Damanik', 'mmardhiyah@example.com', '(+62) 831 733 801', 'SD NEGERI GONDOLAYU', 'SD', '6', NULL, '2024-05-30 00:59:12', '$2y$10$OL2FFyO36Jb9bPmipB8wr.BtVX4R45LBk.fIiy.fYJlxN8ToBcPrK', 'xrJa7QpRVS', 'Aktif', NULL, '2024-05-30 00:59:12', '2024-05-30 00:59:12'),
(30, 'Lutfan Situmorang', 'namaga.daru@example.net', '(+62) 995 0000 566', 'SD TAMANSISWA JETIS', 'SD', '2', NULL, '2024-05-30 00:59:12', '$2y$10$B0KnfNaKhvdhDCfqbgTelewWvPKFp8H60DmofquCqPCn2SVK/xStu', '4duAdcRyRQ', 'Aktif', NULL, '2024-05-30 00:59:12', '2024-05-30 00:59:12'),
(31, 'Lili Hartati', 'saryani@example.org', '(+62) 21 6223 677', 'SD NEGERI BACIRO', 'SD', '1', NULL, '2024-05-30 00:59:12', '$2y$10$Czz4KiGHfLUF1cHWEYRxee2CkojRAVib.u7d4ssL69O4wYj6ZPkMO', '65TwRfUVaq', 'Aktif', NULL, '2024-05-30 00:59:12', '2024-05-30 00:59:12'),
(32, 'Gawati Sudiati S.Pd', 'zulaikha00@example.com', '(+62) 804 939 891', 'SD NEGERI KYAI MOJO', 'SD', '5', NULL, '2024-05-30 00:59:13', '$2y$10$gPw3//GPK04nAEq2eyBFweLkIWfMCZsVkGTJ.gJspFXudHf.x2wyK', '1nRUqEEuZN', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(33, 'Ikhsan Okta Haryanto S.Pd', 'dipa10@example.org', '(+62) 280 1179 531', 'SD KANISIUS GAYAM 1', 'SD', '2', NULL, '2024-05-30 00:59:13', '$2y$10$PEzgwO.1j2b7ik8C1q.zGO2bEqxtVaVEIN2zmq4bBQWCa6iAMvrbq', 'xGqFU5UKkd', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(34, 'Viman Taswir Budiyanto', 'safitri.caturangga@example.org', '(+62) 803 5447 456', 'SD NEGERI BHAYANGKARA', 'SD', '1', NULL, '2024-05-30 00:59:13', '$2y$10$It4Mm3ls8c4eY.NQ9dbHbur4IoOL11C7TBz/0bBk4bWrsqRwC4x5G', '63PHbuu7r9', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(35, 'Garan Kusumo', 'fujiati.nadia@example.org', '(+62) 24 5005 0987', 'SD KANISIUS GOWONGAN', 'SD', '2', NULL, '2024-05-30 00:59:13', '$2y$10$41s/PSSt/HnboK/qcD8S2.ejdEP8qZyIHE2RGARqHMmov1RxERNLi', 'Pn0QmMaU4k', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(36, 'Edi Napitupulu S.H.', 'kamila33@example.com', '0606 7494 8667', 'SD NEGERI COKROKUSUMAN', 'SD', '3', NULL, '2024-05-30 00:59:13', '$2y$10$o5WrfIZQATkdqa.9k9lA4uX93Dj96JvLuXcUosgoCEmsUB/9Mqpyy', 'zKmSGWySNQ', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(37, 'Harjaya Hutapea', 'kania.rahayu@example.org', '(+62) 508 7021 5571', 'SD NEGERI JETISHARJO', 'SD', '6', NULL, '2024-05-30 00:59:13', '$2y$10$rLZT2nbR5v/YiDbnUUfgCuKTXXDr1gIqmkHWA0vOzRzBclHss5jxa', 'adAqegePFx', 'Aktif', NULL, '2024-05-30 00:59:13', '2024-05-30 00:59:13'),
(38, 'Humaira Winarsih', 'johan12@example.com', '(+62) 27 1500 910', 'SD MUHAMMADIYAH BAUSASRAN 2', 'SD', '2', NULL, '2024-05-30 00:59:14', '$2y$10$UwOV9IDbCFfOrkz5yP9kfefU389.LDqpYJw9m3Bsq6veRSXrLV/ve', 'rmrTFc9Wl6', 'Aktif', NULL, '2024-05-30 00:59:14', '2024-05-30 00:59:14'),
(39, 'Wulan Maryati M.M.', 'cinta.firmansyah@example.net', '0360 3291 3006', 'SD NEGERI BACIRO', 'SD', '2', NULL, '2024-05-30 00:59:14', '$2y$10$0I5VeNk0YD5q7.HTjYBH/OxICcwYk2UWONd2SshxyRTk0B8vhlXmi', 'loZp1Xd50H', 'Aktif', NULL, '2024-05-30 00:59:14', '2024-05-30 00:59:14'),
(40, 'Wisnu Taufik Prabowo', 'hana58@example.net', '(+62) 349 9528 9988', 'SD KANISIUS GOWONGAN', 'SD', '4', NULL, '2024-05-30 00:59:14', '$2y$10$sgqtEL7JN3wv29hb/tjwtuPfGReitGVPW5unvBwHblLoviLs0Niy.', 'k2qc9sQc9P', 'Aktif', NULL, '2024-05-30 00:59:14', '2024-05-30 00:59:14'),
(41, 'Panca Haryanto', 'uli07@example.net', '0200 0368 4754', 'SD KANISIUS GOWONGAN', 'SD', '6', NULL, '2024-05-30 00:59:14', '$2y$10$gESjJCP9mcSXFpDQ.x88qOqBMEh6f5nf1KO6Tdn5rKbu/BkfxJPWq', 'kdwuEFLSAQ', 'Aktif', NULL, '2024-05-30 00:59:14', '2024-05-30 00:59:14'),
(42, 'Siska Wahyuni S.Sos', 'panca.maheswara@example.org', '0781 0500 635', 'SD NEGERI WIDORO', 'SD', '3', NULL, '2024-05-30 00:59:15', '$2y$10$aNSqsY1iDHt09TSRClONEexU1tOuRASzBVFo6sCEtJ7WMc.wLYHo6', 'ogKsrfntD5', 'Aktif', NULL, '2024-05-30 00:59:15', '2024-05-30 00:59:15'),
(43, 'Belinda Hastuti', 'poktaviani@example.org', '0302 5272 022', 'SD NEGERI COKROKUSUMAN', 'SD', '2', NULL, '2024-05-30 00:59:15', '$2y$10$hWWIWREuEfSY1hQY/D7jB.fM6hpIL/Shi.UhnbMXXbmvyVWiN.Ebu', 'YuoMhM4mPv', 'Aktif', NULL, '2024-05-30 00:59:15', '2024-05-30 00:59:15'),
(44, 'Aisyah Tiara Kusmawati S.Pt', 'sadina93@example.com', '027 2776 578', 'SD NEGERI COKROKUSUMAN', 'SD', '2', NULL, '2024-05-30 00:59:15', '$2y$10$MMlk8AqqwGl5Ay6VlTmqmOCqhRd8dhQ4dS7Xp3x/BmQWCWphBxRqa', 'R5QvqhVlp1', 'Aktif', NULL, '2024-05-30 00:59:15', '2024-05-30 00:59:15'),
(45, 'Fitria Haryanti', 'nurdiyanti.zelda@example.com', '0576 1078 5840', 'SD NEGERI KLITREN', 'SD', '4', NULL, '2024-05-30 00:59:15', '$2y$10$Q5dt2AbgAhOb2l5W3Mh1KubS72.K9Q84NUCsFKEoE1CU.nfec82ma', 'NT6261IMak', 'Aktif', NULL, '2024-05-30 00:59:15', '2024-05-30 00:59:15'),
(46, 'Cayadi Tampubolon', 'hidayanto.warji@example.org', '0894 311 346', 'SD NEGERI BHAYANGKARA', 'SD', '1', NULL, '2024-05-30 00:59:15', '$2y$10$ubtrrt1xNd7lW8w9GwOoou2R0jofWkMCxRQit3xh.n2MQUlgXJlL.', 'kyYCohblrqQMXJZ9JBhMZjFdDP8vdSyhsWYJBXJCy1xc3iKLSaCagjA3oF0N', 'Aktif', NULL, '2024-05-30 00:59:15', '2024-05-30 00:59:15'),
(47, 'Ikin Iswahyudi', 'bakti56@example.com', '0852 2961 5964', 'SD NEGERI DEMANGAN', 'SD', '4', NULL, '2024-05-30 00:59:16', '$2y$10$l4Ha8.ZscRHP2elM3fk3tOS9Lf/J2gl42.O.QC2IqESQyO46z2IpO', 'uTruLulPf7', 'Aktif', NULL, '2024-05-30 00:59:16', '2024-05-30 00:59:16'),
(48, 'Siska Mila Halimah M.Kom.', 'tasnim.hardiansyah@example.net', '0842 2569 763', 'SD NEGERI DEMANGAN', 'SD', '6', NULL, '2024-05-30 00:59:16', '$2y$10$TbJJis.TcyZ96mXCGy12J.djxRWI7EUu/OnfmWFRyDGYq3WoMLrgi', 'U3cYH4Of1Z', 'Aktif', NULL, '2024-05-30 00:59:16', '2024-05-30 00:59:16'),
(49, 'Humaira Hasanah', 'candra38@example.com', '0779 0171 1812', 'SD BHINNEKA TUNGGAL IKA', 'SD', '5', NULL, '2024-05-30 00:59:16', '$2y$10$kmsWGYt5ka.l.KI5D8F1nO6z.XeV7BgeO42vKHoMeHCCo.jROz/p6', 'jR50FyL6gh', 'Aktif', NULL, '2024-05-30 00:59:16', '2024-05-30 00:59:16'),
(50, 'Cornelia Zalindra Riyanti S.Farm', 'patricia.rahimah@example.com', '0866 7243 8518', 'SD NEGERI BUMIJO', 'SD', '3', NULL, '2024-05-30 00:59:16', '$2y$10$Wi2E3AekneFhL/c0afEmCOm3pFVjcy7rkMWZ5EqOeTLWKYt2Hicm6', 'LDzIbpTE5g', 'Aktif', NULL, '2024-05-30 00:59:17', '2024-05-30 00:59:17'),
(51, 'Kasiyah Rahimah', 'farhunnisa28@example.net', '0958 7664 0753', 'SD JOANNES BOSCO YOGYAKARTA', 'SD', '3', NULL, '2024-05-30 00:59:17', '$2y$10$MoR9epvhQGWxuzNIl.U6JOeJB/Ag0h2OFOwVHM7uFJJLNKFUH9wPS', 'cRNF9eymCM', 'Aktif', NULL, '2024-05-30 00:59:17', '2024-05-30 00:59:17'),
(52, 'Tira Puspita S.E.', 'oni54@example.com', '0692 3940 4419', 'SD NEGERI BHAYANGKARA', 'SMP', '7', NULL, '2024-05-30 01:02:32', '$2y$10$lu2RLe4ZqmZiycYVk5xVYOLvKfeYxpOK09Ispoi1qJGGKZ25GS6TG', 'oiYn0QgPBq', 'Aktif', NULL, '2024-05-30 01:02:32', '2024-05-30 01:02:32'),
(53, 'Humaira Pertiwi', 'salsabila.firmansyah@example.org', '(+62) 765 4097 434', 'SD TARAKANITA 1', 'SMP', '8', NULL, '2024-05-30 01:02:32', '$2y$10$it3lGrwBeibFXH9voyfH7eaKH/nGYaBn6czxfQXUf8ucVuoHN8cIC', 'UUG5i7ExDb', 'Aktif', NULL, '2024-05-30 01:02:32', '2024-05-30 01:02:32'),
(54, 'Shania Sakura Winarsih', 'jdabukke@example.com', '028 1585 7466', 'SD TARAKANITA 1', 'SMP', '8', NULL, '2024-05-30 01:02:32', '$2y$10$VKz7ylqwMlaqDnpxQJV.e.PYChFef/A4P4nfAuSqDOsPlzXlZbRPG', 'AT9Vv2iXCZ', 'Aktif', NULL, '2024-05-30 01:02:32', '2024-05-30 01:02:32'),
(55, 'Emong Firmansyah', 'namaga.sidiq@example.com', '(+62) 419 4754 230', 'SD KANISIUS GOWONGAN', 'SMP', '7', NULL, '2024-05-30 01:02:33', '$2y$10$3qdC5.ESkhDb.vGTVQk6HuZpCJjD5gcZpjQ8KWtoPdhNnsdopRpbu', 'EhUJcc9oCm', 'Aktif', NULL, '2024-05-30 01:02:33', '2024-05-30 01:02:33'),
(56, 'Putri Yolanda S.Gz', 'nova23@example.com', '0780 8258 4495', 'SD NEGERI JETISHARJO', 'SMP', '8', NULL, '2024-05-30 01:02:33', '$2y$10$/qoSC6HWskh/cSwSfjnO4eFHdN77ZIn9LgwjddEqUtOkAfC3m1AqG', 'WIXM0Jh6z7', 'Aktif', NULL, '2024-05-30 01:02:33', '2024-05-30 01:02:33'),
(57, 'Dalimin Santoso', 'anggriawan.dadap@example.com', '(+62) 763 5474 7856', 'SD KANISIUS GOWONGAN', 'SMP', '7', NULL, '2024-05-30 01:02:33', '$2y$10$4K1ETN.sf8I10H1cq/93AeOX1VDG1PU3SekWBmhE059C9dVw9sABy', 'UJR4qW9ui2', 'Aktif', NULL, '2024-05-30 01:02:33', '2024-05-30 01:02:33'),
(58, 'Maria Anggraini S.H.', 'ganep.marpaung@example.net', '0720 8456 019', 'SD NEGERI KLITREN', 'SMP', '9', NULL, '2024-05-30 01:02:33', '$2y$10$zpWsR4UVvrvrlwxDdgRc/uEHJ8C9umC.3MSh.pxMzXZGKl1cxqjGi', 'Jd7Isdod3c', 'Aktif', NULL, '2024-05-30 01:02:33', '2024-05-30 01:02:33'),
(59, 'Balijan Himawan Narpati', 'bmansur@example.net', '(+62) 24 0781 900', 'SD NEGERI SERAYU', 'SMP', '8', NULL, '2024-05-30 01:02:33', '$2y$10$wcq891wE9H6m8LC1YY6Zou/U.ljnmHP1D96m510jv8gVPnTqkcfnG', 'wA1ELYvn0H', 'Aktif', NULL, '2024-05-30 01:02:33', '2024-05-30 01:02:33'),
(60, 'Sari Yuliarti', 'wijayanti.gara@example.com', '0924 2604 216', 'SD NEGERI LEMPUYANGAN 1', 'SMP', '8', NULL, '2024-05-30 01:02:34', '$2y$10$4jBewaahfXlznm3nUMBTru4rGttwM/oWIgRk6MseX5gXRZCCRPzlK', '2s0zOlntXS', 'Aktif', NULL, '2024-05-30 01:02:34', '2024-05-30 01:02:34'),
(61, 'Eli Susanti', 'genta29@example.net', '0740 0183 216', 'SD NEGERI BACIRO', 'SMP', '9', NULL, '2024-05-30 01:02:34', '$2y$10$NT5/t1cdHH2gv8o9CRTHL.I3WnMs.XJ5CpC7hGJbO4GjRVlVS6lvi', 'h6wp97HQbk', 'Aktif', NULL, '2024-05-30 01:02:34', '2024-05-30 01:02:34'),
(62, 'Rahmi Titin Andriani S.IP', 'safina32@example.net', '0480 6991 9282', 'SD KANISIUS GAYAM 1', 'SMP', '8', NULL, '2024-05-30 01:02:34', '$2y$10$FY9MLnT7LXxJqH9Ddb5HHejSOwgWZIAw/1UT8LIJUIQGRrTT/FoHu', '20W8AnwT4A', 'Aktif', NULL, '2024-05-30 01:02:34', '2024-05-30 01:02:34'),
(63, 'Rika Rahimah', 'suwarno.ayu@example.com', '(+62) 806 4210 3890', 'SD NEGERI UNGARAN 1', 'SMP', '9', NULL, '2024-05-30 01:02:34', '$2y$10$FazuzxKMS8icS/XqVQ0n1uEyyLwpYiHASJEfjk630lxWk2AAZq.kK', 'cx75vnphgB', 'Aktif', NULL, '2024-05-30 01:02:34', '2024-05-30 01:02:34'),
(64, 'Edward Estiono Lazuardi S.Pt', 'vrajasa@example.com', '0647 6949 386', 'SD NEGERI TERBANSARI 1', 'SMP', '8', NULL, '2024-05-30 01:02:35', '$2y$10$BGzwBE0JknWr93H4m3P3ne1a2QvzvmetGCEmb1WvaFT.9b97Oq91u', 'TFnYpJhFid', 'Aktif', NULL, '2024-05-30 01:02:35', '2024-05-30 01:02:35'),
(65, 'Kamal Prasasta', 'permata.lantar@example.org', '0410 6688 5973', 'SD NEGERI COKROKUSUMAN', 'SMP', '9', NULL, '2024-05-30 01:02:35', '$2y$10$pOBXSDFv9Iu.RX7KspfX4u2HZzpqvdeWwVp/MWhoy1ja3zH2TYYS2', 'WueJ0VyNSv', 'Aktif', NULL, '2024-05-30 01:02:35', '2024-05-30 01:02:35'),
(66, 'Faizah Anggraini', 'rajasa.rachel@example.com', '0480 5921 709', 'SD BOPKRI GONDOLAYU', 'SMP', '7', NULL, '2024-05-30 01:02:35', '$2y$10$1uq1a8rHUgs3GRcODwW0mecx/gjUR1vlV9/gdDrI6snx782SYN.yy', 'LDsq2DF6fd', 'Aktif', NULL, '2024-05-30 01:02:35', '2024-05-30 01:02:35'),
(67, 'Dina Hartati S.H.', 'dpangestu@example.net', '0507 0635 976', 'SD TAMANSISWA JETIS', 'SMP', '7', NULL, '2024-05-30 01:02:35', '$2y$10$fKuGSkrFi5UwD7f6hloqMuvyEPwijPD3CdS4xm/BDvktQTAPF9zv2', 'xvX7Jatn5w', 'Aktif', NULL, '2024-05-30 01:02:35', '2024-05-30 01:02:35'),
(68, 'Ikhsan Jailani', 'nainggolan.anita@example.com', '0376 2935 166', 'SD NEGERI JETISHARJO', 'SMP', '9', NULL, '2024-05-30 01:02:35', '$2y$10$k0o9CMCc9AD6Q/rxlOH5x.sXRsIYSP84HnFNMpWvErXYlt2zm/fSG', 'URP250lGwl', 'Aktif', NULL, '2024-05-30 01:02:35', '2024-05-30 01:02:35'),
(69, 'Kani Hasanah', 'kpadmasari@example.net', '0228 0738 0794', 'SD BUDYA WACANA 1', 'SMP', '9', NULL, '2024-05-30 01:02:35', '$2y$10$28bHF/86by6RiUf7XwxkLOYBj93ANU1cugJkfoKQpR7YscS5fbh9m', 'Ciw9JHlcXi', 'Aktif', NULL, '2024-05-30 01:02:36', '2024-05-30 01:02:36'),
(70, 'Arsipatra Winarno', 'xmangunsong@example.net', '(+62) 28 2224 7338', 'SD TAMANSISWA JETIS', 'SMP', '9', NULL, '2024-05-30 01:02:36', '$2y$10$zj3H8I1J7K04a7vQXZmx..b4UkRC1ZMgOmF8Up6ID1.KCpEdH6YvO', 'RdhBICcczm', 'Aktif', NULL, '2024-05-30 01:02:36', '2024-05-30 01:02:36'),
(71, 'Vero Saefullah', 'knapitupulu@example.net', '0789 2141 322', 'SD NEGERI KYAI MOJO', 'SMP', '8', NULL, '2024-05-30 01:02:36', '$2y$10$8izkpyywg0TVvTWPqEuIpu3K5JN7jfRBq89ll2YCLXyTzDldFPZgW', 'vqTOLozxSB', 'Aktif', NULL, '2024-05-30 01:02:36', '2024-05-30 01:02:36'),
(72, 'Fitriani Latika Prastuti', 'titin.halim@example.net', '0643 1156 716', 'SD NEGERI JETIS 1', 'SMP', '7', NULL, '2024-05-30 01:02:36', '$2y$10$reAtPTjDJ8JPWhSlC.duDOTHcou6gA4iTBMuQELhNvPbrunfY/Fqu', 'Cna1R6RjzI', 'Aktif', NULL, '2024-05-30 01:02:36', '2024-05-30 01:02:36'),
(73, 'Rahmi Maryati', 'ptamba@example.net', '(+62) 26 5525 4848', 'SD NEGERI JETIS 2', 'SMP', '8', NULL, '2024-05-30 01:02:36', '$2y$10$Q.mGIjnEJTV8qA4C9rJHg./xSUq6Hfx66xWWZFYJ9pABzB4gq95BW', 'KKO6pHsjKR', 'Aktif', NULL, '2024-05-30 01:02:36', '2024-05-30 01:02:36'),
(74, 'Vanya Ratna Kusmawati M.TI.', 'luthfi.simanjuntak@example.com', '027 4390 9638', 'SD BUDYA WACANA 1', 'SMP', '8', NULL, '2024-05-30 01:02:37', '$2y$10$aQ6h5WaSoOCOYHJVFKAVP.k6RhzMrqt4XwYhMp1rUVJjWtif0ZbOS', '3ElgUwCYnf', 'Aktif', NULL, '2024-05-30 01:02:37', '2024-05-30 01:02:37'),
(75, 'Luluh Ikin Waluyo S.Gz', 'gilang81@example.net', '(+62) 752 1712 1188', 'SD NEGERI VIDYA QASANA', 'SMP', '9', NULL, '2024-05-30 01:02:37', '$2y$10$qqUUH3Eo6FSa.ZjfxqCyceghOa.iu2ySLoUW4sd95.DRguV2zwy2S', 'iEEEOCFo9D', 'Aktif', NULL, '2024-05-30 01:02:37', '2024-05-30 01:02:37'),
(76, 'Rina Nasyiah M.TI.', 'lardianto@example.com', '0779 3897 360', 'SD KANISIUS GAYAM 1', 'SMP', '9', NULL, '2024-05-30 01:02:37', '$2y$10$lGJmeE/GiphyKeQRvlTcUuPKYnxVYhkpY7ALCJIgnIbLbrBYH8RI2', 'KaIMpSKvLI', 'Aktif', NULL, '2024-05-30 01:02:37', '2024-05-30 01:02:37'),
(77, 'Muhammad Waluyo S.H.', 'septi17@example.net', '(+62) 555 0941 4188', 'SD NEGERI DEMANGAN', 'SMP', '7', NULL, '2024-05-30 01:02:37', '$2y$10$bUzEzXv4zg25B46iPqgJHeWmjTu0MQnuC3fCimMETi0E/7F1PTBdK', '2ie29XhCZc', 'Aktif', NULL, '2024-05-30 01:02:37', '2024-05-30 01:02:37'),
(78, 'Hamima Kuswandari', 'maheswara.rahayu@example.org', '(+62) 618 0836 276', 'SD NEGERI BADRAN', 'SMP', '9', NULL, '2024-05-30 01:02:38', '$2y$10$rxYlZmJGTLvy3fdlwrYMtepTiC4HEcMLdZG2A1NZD4UPYMtBosgHS', 'aAMK1AcjLx', 'Aktif', NULL, '2024-05-30 01:02:38', '2024-05-30 01:02:38'),
(79, 'Jamil Mulya Haryanto', 'kani04@example.com', '(+62) 835 439 411', 'SD NEGERI LEMPUYANGAN 1', 'SMP', '8', NULL, '2024-05-30 01:02:38', '$2y$10$oxs1z..ge2wT24Q2dhRR2Oj6PHMUNC7aV7J/UvnAA2tZB2a7RT7Sq', 'd6swjenzMw', 'Aktif', NULL, '2024-05-30 01:02:38', '2024-05-30 01:02:38'),
(80, 'Almira Prastuti', 'nsuartini@example.org', '0848 361 314', 'SD MUHAMMADIYAH BAUSASRAN 2', 'SMP', '9', NULL, '2024-05-30 01:02:38', '$2y$10$dSaI63VnDucnWuE.JklCm.GoT/9k1/sBqoCJION2AL2.X/X3vmRQK', '7L81ggQcns', 'Aktif', NULL, '2024-05-30 01:02:38', '2024-05-30 01:02:38'),
(81, 'Gina Lestari', 'zulaikha30@example.org', '(+62) 24 6821 2186', 'SD NEGERI LEMPUYANGWANGI', 'SMP', '9', NULL, '2024-05-30 01:02:38', '$2y$10$CnnyWSH8V0mlgJ4/VA9Rw.0OdTgevASJI73GuUAHDq10jsgGbkIOa', '4yuwTNz4rC', 'Aktif', NULL, '2024-05-30 01:02:38', '2024-05-30 01:02:38'),
(82, 'Dan Mante', 'cschmidt@example.org', '704-601-3534', NULL, NULL, NULL, NULL, '2024-05-30 03:07:25', '$2y$10$Vw/NhnpVKGXI4GehfrvAhuGwcggdVT8Tnvkofu3lsbdnyUvICqyUS', 'kqnb9o9sWF', 'Aktif', NULL, '2024-05-30 03:07:25', '2024-05-30 03:07:25'),
(83, 'Yazmin Kling', 'laverne41@example.org', '(251) 303-2376', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$s7GyJeIg5ZyDgEyGt4oLN.LhynJ8.nWfYLRE3bAcQfVmWBPxV0AsG', '5Wwk7iyIhR', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(84, 'Adrienne Pollich IV', 'alysson50@example.net', '(334) 750-9179', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$AX8pUl24slI0njasjP4e9u8c6.8li5pZItl5XAgm82UveI4ExjqPa', 'KurHGgw3Y9', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(85, 'Mr. Rico Fritsch Sr.', 'kylie07@example.com', '+1-984-823-0602', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$A4u5.PwtoylCrYkS9QHUhOUUtlUHLp/kNSEmxq1fJb3ciT/0fhLtC', 'qeYHnLlQEn', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(86, 'Audra Jacobson IV', 'jziemann@example.org', '(610) 982-2346', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$T.YyBaQW8mCLQvm3hARA6.in9amHBlo4etpAUSgajv10UXw4kfTV2', 'cz7y52bNdD', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(87, 'Dr. Kelsi Von', 'gschaden@example.com', '520-978-5215', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$rSAXTBSJwXOPesgdF2wgSeYy.NpUh5zejVRC6HvGySIdaseSGiWMC', 'HnmDzLhxKE', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(88, 'Mr. Lorenzo Hackett II', 'stiedemann.lambert@example.com', '1-820-689-8016', NULL, NULL, NULL, NULL, '2024-05-30 03:07:26', '$2y$10$cBz4FMInUO9XzZq41it4SepFO.ppheniqTymI699Hhr6T81iCur3y', 'hj1GWcy3nU', 'Aktif', NULL, '2024-05-30 03:07:26', '2024-05-30 03:07:26'),
(89, 'Misty Graham V', 'cicero.bashirian@example.com', '+1-480-559-1363', NULL, NULL, NULL, NULL, '2024-05-30 03:07:27', '$2y$10$6N7w3Cet46bEx75S4TJ0IOTfqlTJR48Gwn9XiXmkLYSvF6mEI3m/S', '4GJ9IMj41m', 'Aktif', NULL, '2024-05-30 03:07:27', '2024-05-30 03:07:27'),
(90, 'Prof. Rosetta McClure', 'tskiles@example.com', '1-629-209-7597', NULL, NULL, NULL, NULL, '2024-05-30 03:07:27', '$2y$10$tGc7BUuQMLbBCJhn.Wm7A.Bt9PTFRHViQ9YF7EsJ6PYtFAaFifGJ2', 'AEEposDhIN', 'Aktif', NULL, '2024-05-30 03:07:27', '2024-05-30 03:07:27'),
(91, 'Dr. Fae Dibbert DDS', 'okihn@example.org', '984.701.6432', NULL, NULL, NULL, NULL, '2024-05-30 03:07:27', '$2y$10$Y0MFuYZNslW3Hhd0zhsHM.SlgkXcXO6q7uggUTxWGC2tMuFRVQv/a', 'MNPUPd1mQi', 'Aktif', NULL, '2024-05-30 03:07:27', '2024-05-30 03:07:27'),
(92, 'Dr. Carmine Tillman', 'lesch.ora@example.net', '+1.605.432.2597', NULL, NULL, NULL, NULL, '2024-05-30 03:08:41', '$2y$10$5KuzGX0q5SJHli91NEZlkOmw4rF3EcZsTjMgTOjPsn/Nv0xuM6a12', 'ZZinEO1jlZ', 'Aktif', NULL, '2024-05-30 03:08:41', '2024-05-30 03:08:41'),
(93, 'Miss Karelle Wilderman', 'schmitt.hiram@example.com', '+1-743-983-6578', NULL, NULL, NULL, NULL, '2024-05-30 03:08:41', '$2y$10$t8nYhSVS2Cdc1a4k87ZxcOd8wJ4nDPpHIulX1C/bbIRL5iQc8sLrK', 'vbt5qqbW6j', 'Aktif', NULL, '2024-05-30 03:08:41', '2024-05-30 03:08:41'),
(94, 'Edna Okuneva', 'polly.walker@example.net', '+1-424-503-1356', NULL, NULL, NULL, NULL, '2024-05-30 03:08:42', '$2y$10$tFMuxu4eJA/Vf08Vrv3Ulu7zYj.OmJudcNjcHHl9qEMBSf6Q50Wqm', 'qzASacqorb', 'Aktif', NULL, '2024-05-30 03:08:42', '2024-05-30 03:08:42'),
(95, 'Wendy Little', 'cwiegand@example.com', '+1-713-460-7517', NULL, NULL, NULL, NULL, '2024-05-30 03:08:42', '$2y$10$q2B2iVhJQ.yjfgW1u3EQsOhYeuJdh7pwVfymcc1HmWntvOV4ITiny', 'iSkuyx8pDn', 'Aktif', NULL, '2024-05-30 03:08:42', '2024-05-30 03:08:42'),
(96, 'Juana Bailey', 'noah.gerlach@example.com', '(469) 473-3207', NULL, NULL, NULL, NULL, '2024-05-30 03:08:42', '$2y$10$aHH9aKIptgrl.oshOOoTO.ZLBDwMqnqHhAytQNiFAVnvPHsgE87ym', 'Rtz3b1VnrU', 'Aktif', NULL, '2024-05-30 03:08:42', '2024-05-30 03:08:42'),
(97, 'Mr. Baron Bartell', 'ahyatt@example.org', '878.934.8415', NULL, NULL, NULL, NULL, '2024-05-30 03:08:42', '$2y$10$pYLba1hD1e3K1hBcVB93iOqNlcTJBmeHfdslndIqDFPjWgrfvYCUK', '2uv3m3M7na', 'Aktif', NULL, '2024-05-30 03:08:42', '2024-05-30 03:08:42'),
(98, 'Mr. Timmothy Hill DVM', 'reinger.jimmie@example.com', '909.230.1426', NULL, NULL, NULL, NULL, '2024-05-30 03:08:42', '$2y$10$h3Asnv5MNl8kAGoT3u/7xuNNcAQR0IZAPwucZDBRrzmquZElyahl6', '66NYSD7Sbk', 'Aktif', NULL, '2024-05-30 03:08:42', '2024-05-30 03:08:42'),
(99, 'Katlyn Keeling', 'gloria.mraz@example.com', '1-458-227-6049', NULL, NULL, NULL, NULL, '2024-05-30 03:08:43', '$2y$10$KBEyOaBNvbT6J650kMzvhuDykHlQH0K.1ozK0OSyZTyfSyAK4753u', '63RiuCZtr0', 'Aktif', NULL, '2024-05-30 03:08:43', '2024-05-30 03:08:43'),
(100, 'Ken Abshire', 'medhurst.beau@example.com', '502.259.8582', NULL, NULL, NULL, NULL, '2024-05-30 03:08:43', '$2y$10$H6eZVURlfVk2ATQRjr5tquk4x0DsezjoaRPCJZnFhX53HRo8ig3ue', 'RN24cHJRw5', 'Aktif', NULL, '2024-05-30 03:08:43', '2024-05-30 03:08:43'),
(101, 'Mr. Wilmer Hermiston', 'hilbert25@example.net', '+1 (541) 410-1651', NULL, NULL, NULL, NULL, '2024-05-30 03:08:43', '$2y$10$6RmI/wjYnnrKX/xPwAapC.sp6NmKCpyPR8Y2bgQ9/hw7nIkjHTXtG', 'ESDnEPRLru', 'Aktif', NULL, '2024-05-30 03:08:43', '2024-05-30 03:08:43'),
(102, 'Faris Aizy', 'farisaizy12@gmail.com', '085600200913', 'SD NEGERI JETIS 1', 'SD', '4', NULL, NULL, '$2y$10$QkKWR1QeG2k8nTEG3/Yd0eBMJ4A/EdYy4ut41VxMQUs4CzpypWKPG', NULL, 'Aktif', NULL, '2024-05-30 19:04:03', '2024-05-30 19:12:08');

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_materi`
--
ALTER TABLE `ref_materi`
  MODIFY `ref_materi_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `tryout_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tryout_jawaban`
--
ALTER TABLE `tryout_jawaban`
  MODIFY `tryout_jawaban_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tryout_nilai`
--
ALTER TABLE `tryout_nilai`
  MODIFY `tryout_nilai_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  MODIFY `tryout_peserta_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  MODIFY `tryout_soal_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
