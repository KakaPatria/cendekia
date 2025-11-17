-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 09:09 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cendekia_prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `asal_sekolah`
--

CREATE TABLE `asal_sekolah` (
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_peserta_id` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `discount` int NOT NULL,
  `total` int NOT NULL,
  `status` int NOT NULL,
  `due_date` date NOT NULL,
  `inv_paid` datetime DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `user_id`, `tryout_id`, `tryout_peserta_id`, `keterangan`, `amount`, `discount`, `total`, `status`, `due_date`, `inv_paid`, `payment_type`, `bank`, `va_number`, `remark`, `snap_token`, `redirect_url`, `created_at`, `updated_at`) VALUES
('IN-2412-0002', 7, 3, 10, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 0, 0, 1, '2024-12-01', '2024-12-01 00:00:00', '', '', '', '0', NULL, NULL, '2024-12-01 09:03:59', '2024-12-01 09:03:59'),
('IN-2412-0003', 8, 3, 11, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 0, 0, 0, '2024-12-08', NULL, '', '', '', '0', NULL, NULL, '2024-12-01 09:27:43', '2024-12-01 09:27:43'),
('IN-2510-0004', 8, 6, 15, 'Biaya TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024 (Umum)', 300000, 10, 270000, 1, '2025-10-26', '2025-10-19 16:12:40', 'bank_transfer', 'bni', '9882531954073632', 'Dibayar melalui Midtrans dengan status settlement', NULL, NULL, '2025-10-19 08:42:05', '2025-10-19 15:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` int NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `guru` varchar(100) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `nama_kelas`, `mapel`, `guru`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(1, '9 - 1', 'Matematika', 'Pak Rofiq', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(2, '9 - 1', 'IPA', 'Pak Rischa', 'Senin', '16:30:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(3, '9 - 1', 'Bahasa Indonesia', 'Bu Devi', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(4, '9 - 1', 'Bahasa Inggris', 'Uncle', 'Senin', '16:30:00', '18:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(5, '9 - 3', 'Matematika', 'Pak Wodo', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(6, '9 - 3', 'IPA', 'Pak Andang', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(7, '9 - 3', 'Bahasa Indonesia', 'Bu Devi', 'Senin', '16:30:00', '18:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(8, '9 - 4', 'Matematika', 'Pak Wodo', 'Senin', '18:30:00', '20:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(9, '9 - 4', 'IPA', 'Pak Andang', 'Senin', '18:30:00', '20:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(10, '9 - 4', 'Bahasa Indonesia', 'Bu Devi', 'Senin', '18:30:00', '20:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(11, '9 - 4', 'Bahasa Inggris', 'Uncle', 'Senin', '18:30:00', '20:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(12, '6 - 1', 'Matematika', 'Pak Agus', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(13, '6 - 1', 'IPA', '', 'Senin', '16:15:00', '17:45:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(14, '6 - 1', 'Bahasa Indonesia', 'P Handoko', 'Senin', '15:30:00', '17:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(15, '5 - 1', 'Matematika', 'Atika', 'Senin', '17:00:00', '18:30:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(16, '5 - 1', 'IPA', 'Atika', 'Senin', '15:30:00', '17:00:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15'),
(17, '5 - 1', 'Bahasa Indonesia', 'Atika', 'Senin', '17:00:00', '18:30:00', '2025-10-29 09:16:15', '2025-10-29 09:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_cendekia`
--

CREATE TABLE `jadwal_cendekia` (
  `jadwal_cendekia_id` bigint UNSIGNED NOT NULL,
  `kelas_cendekia_id` int NOT NULL,
  `ref_materi_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `jadwal_cendekia_hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal_mulai` time NOT NULL,
  `jadwal_selesai` time NOT NULL,
  `jadwal_cendekia_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_cendekia`
--

CREATE TABLE `kelas_cendekia` (
  `kelas_cendekia_id` bigint UNSIGNED NOT NULL,
  `kelas_cendekia_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` int NOT NULL,
  `kelas_cendekia_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa_cendekia`
--

CREATE TABLE `kelas_siswa_cendekia` (
  `kelas_siswa_cendekia_id` bigint UNSIGNED NOT NULL,
  `kelas_cendekia_id` int NOT NULL,
  `siswa_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_09_25_114449_update_users_roles_id_column', 1),
(2, '2025_09_29_000000_add_password_otp_to_users_table', 2),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(4, '2025_10_23_201340_updatetype_user', 3),
(5, '2025_10_23_202006_drop_referalcode_table', 3),
(6, '2025_10_24_150651_create_kelas_cendekia_table', 3),
(7, '2025_10_24_150745_create_jadwal_cendekia_table', 3),
(8, '2025_10_24_151320_create_kelas_siswa_cendekia', 3),
(9, '2025_10_25_100701_add_kelas_cendekia_i_d_column', 3),
(10, '2025_10_26_140637_add_jenjang_status_kelas_cendekia', 3),
(11, '2025_10_28_224829_update_invoice_nullable', 3),
(12, '2025_10_28_231036_update_invoice_midtrans', 3),
(13, '2025_10_29_100942_update_pengerjaancolumn', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 30);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL
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
  `ref_materi_id` bigint UNSIGNED NOT NULL,
  `ref_materi_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_kelas` int NOT NULL,
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
(6, 'Matematika', 'SMP', 9, '2025-10-20 03:45:19', '2025-10-20 03:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 1),
(4, 1),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tryout`
--

CREATE TABLE `tryout` (
  `tryout_id` bigint UNSIGNED NOT NULL,
  `tryout_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_register_due` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `tryout_jenis` enum('Gratis','Berbayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Gratis',
  `is_open` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `tryout_nominal` bigint NOT NULL,
  `tryout_diskon` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout`
--

INSERT INTO `tryout` (`tryout_id`, `tryout_judul`, `tryout_deskripsi`, `tryout_jenjang`, `tryout_kelas`, `tryout_register_due`, `tryout_banner`, `tryout_status`, `tryout_jenis`, `is_open`, `tryout_nominal`, `tryout_diskon`, `created_at`, `updated_at`) VALUES
(3, 'PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊<br>&nbsp;</p>', 'SD', '6', '2024-01-31', 'public/uploads/banner_tryout/1733036999_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Aktif', 'Berbayar', 'Umum', 20000, 0, '2024-12-01 07:09:59', '2024-12-01 07:09:59'),
(4, 'test tryout', '<p>test</p>', 'SMA', '12', '2024-01-31', 'public/uploads/banner_tryout/1733044149_Screenshot 2024-07-11 at 15.26.43.png', 'Aktif', 'Gratis', 'Cendekia', 0, 0, '2024-12-01 09:09:09', '2024-12-01 09:09:09'),
(6, 'TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024 (Umum)', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊</p>', 'SD', '6', '2025-11-01', 'public/uploads/banner_tryout/1760370043_banner1.png', 'Aktif', 'Berbayar', 'Umum', 300000, 10, '2025-10-13 15:40:43', '2025-10-13 15:47:27'),
(10, 'try end', '<p>ya deh</p>', 'SD', '6', '2025-11-17', 'public/uploads/banner_tryout/1761184793_Screenshot 2024-01-29 221753.png', 'Aktif', 'Berbayar', 'Umum', 90000, 5, '2025-10-23 01:59:53', '2025-10-23 01:59:53');

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

-- --------------------------------------------------------

--
-- Table structure for table `tryout_materi`
--

CREATE TABLE `tryout_materi` (
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_id` int NOT NULL,
  `materi_id` int NOT NULL,
  `pengajar_id` int NOT NULL,
  `tryout_materi_deskripsi` text COLLATE utf8mb4_unicode_ci,
  `jenis_soal` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_soal` int DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `safe_mode` int NOT NULL DEFAULT '1',
  `master_soal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_materi`
--

INSERT INTO `tryout_materi` (`tryout_materi_id`, `tryout_id`, `materi_id`, `pengajar_id`, `tryout_materi_deskripsi`, `jenis_soal`, `jumlah_soal`, `periode_mulai`, `periode_selesai`, `waktu_mulai`, `waktu_selesai`, `durasi`, `safe_mode`, `master_soal`, `created_at`, `updated_at`) VALUES
('SxSmX0giNw', 10, 1, 18, 'g', 'PDF', 9, NULL, NULL, NULL, NULL, 60, 1, 'public/uploads/soal/1761184824_soal mtk.pdf', NULL, '2025-10-23 09:00:29'),
('tqMZfC74ei', 6, 5, 18, 'Tryout Bahasa Indonesia untuk tingkat SD ini dirancang untuk menguji kemampuan membaca, memahami isi teks, menulis dengan tata bahasa yang baik, serta penggunaan ejaan dan tanda baca yang benar. Soal mencakup berbagai jenis teks seperti narasi, deskripsi, dan dialog.', 'PDF', 6, NULL, NULL, NULL, NULL, 60, 1, 'public/uploads/soal/1760373782_Contoh Soal-2.pdf', NULL, '2025-10-13 23:43:05'),
('wDofJXNyfY', 6, 1, 18, 'The Mathematics tryout for elementary school aims to evaluate students’ understanding of basic arithmetic, measurement, geometry, and problem-solving. The questions are designed to strengthen logical thinking and real-life application of math concepts.', NULL, NULL, NULL, NULL, NULL, NULL, 60, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tryout_nilai`
--

CREATE TABLE `tryout_nilai` (
  `tryout_nilai_id` bigint UNSIGNED NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `nilai` double DEFAULT NULL,
  `total_point` int DEFAULT '0',
  `soal_dijekerjakan` int DEFAULT NULL,
  `soal_total` int DEFAULT NULL,
  `jumlah_salah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_benar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_soal_id` int DEFAULT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Proses',
  `mulai_pengerjaan` datetime DEFAULT NULL,
  `stop_pengerjaan` datetime DEFAULT NULL,
  `lanjutkan_pengerjaan` datetime DEFAULT NULL,
  `selesai_pengerjaan` datetime DEFAULT NULL,
  `durasi_berjalan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_open_pendaftaran`
--

CREATE TABLE `tryout_open_pendaftaran` (
  `top_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `top_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_telpon_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_telpon_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_tanggal_bayar` date NOT NULL,
  `top_jenis_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_status` enum('Pending','Terverifikasi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_pengerjaan`
--

CREATE TABLE `tryout_pengerjaan` (
  `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tryout_jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Benar','Salah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Salah',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tryout_peserta`
--

CREATE TABLE `tryout_peserta` (
  `tryout_peserta_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_peserta_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_peserta`
--

INSERT INTO `tryout_peserta` (`tryout_peserta_id`, `user_id`, `tryout_id`, `tryout_peserta_name`, `tryout_peserta_telpon`, `tryout_peserta_email`, `tryout_peserta_alamat`, `tryout_peserta_status`, `created_at`, `updated_at`) VALUES
(15, 8, 6, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 1, '2025-10-19 08:42:05', '2025-10-19 15:15:44'),
(16, 27, 10, 'pia santoso', '123456789', 'pia69@gmail.com', 'sonopakis', 0, '2025-10-23 02:03:13', '2025-10-23 02:03:13'),
(17, 27, 10, 'pia santoso', '123456789', 'pia69@gmail.com', 'sonopakis', 0, '2025-10-23 02:03:37', '2025-10-23 02:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_soal`
--

CREATE TABLE `tryout_soal` (
  `tryout_soal_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_nomor` int NOT NULL,
  `point` int NOT NULL DEFAULT '1',
  `tryout_soal` longtext COLLATE utf8mb4_unicode_ci,
  `tryout_soal_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_kunci_jawaban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_penyelesaian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_soal`
--

INSERT INTO `tryout_soal` (`tryout_soal_id`, `tryout_materi_id`, `tryout_nomor`, `point`, `tryout_soal`, `tryout_soal_type`, `tryout_kunci_jawaban`, `tryout_penyelesaian`, `notes`, `created_at`, `updated_at`) VALUES
(22, 'SxSmX0giNw', 1, 1, 'public/uploads/soal/image/soal_1_1761184825.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_2_1761184825.jpg', NULL, NULL, NULL),
(23, 'SxSmX0giNw', 2, 1, 'public/uploads/soal/image/soal_3_1761184825.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_4_1761184826.jpg', NULL, NULL, NULL),
(24, 'SxSmX0giNw', 3, 1, 'public/uploads/soal/image/soal_5_1761184826.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_6_1761184826.jpg', NULL, NULL, NULL),
(25, 'SxSmX0giNw', 4, 1, 'public/uploads/soal/image/soal_7_1761184826.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_8_1761184827.jpg', NULL, NULL, NULL),
(26, 'SxSmX0giNw', 5, 1, 'public/uploads/soal/image/soal_9_1761184827.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_10_1761184827.jpg', NULL, NULL, NULL),
(27, 'SxSmX0giNw', 6, 1, 'public/uploads/soal/image/soal_11_1761184828.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_12_1761184828.jpg', NULL, NULL, NULL),
(28, 'SxSmX0giNw', 7, 1, 'public/uploads/soal/image/soal_13_1761184828.jpg', NULL, NULL, 'public/uploads/soal/image/jawaban_14_1761184828.jpg', NULL, NULL, NULL),
(29, 'SxSmX0giNw', 8, 1, 'public/uploads/soal/image/soal_15_1761184829.jpg', NULL, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `roles_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_siswa` enum('Cendekia','Umum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_otp_expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roles_id`, `name`, `email`, `telepon`, `asal_sekolah`, `jenjang`, `kelas`, `alamat`, `nama_orang_tua`, `telp_orang_tua`, `avatar`, `tipe_siswa`, `email_verified_at`, `password`, `remember_token`, `password_otp`, `password_otp_expires_at`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(8, 1, 'Faris Aizy', 'farisaizy12@gmail.com', '085600200913', 'SD Indonesia Merdeka', 'SD', '5', 'Jl ABc', 'Test', '9021830912830', 'public/uploads/avatar/1732698688_Screenshot 2024-06-27 215605.png', 'Umum', NULL, '$2y$10$BEm7CrVga8uHvEtzjX26cuHG9RIIWW/nN0wkzmgrsSI5HD75Yh6Um', NULL, NULL, NULL, 'Aktif', NULL, '2024-11-27 09:10:58', '2025-10-19 06:39:27'),
(14, 2, 'Super Admin', 'admin@cendekia.com', '123456789', '-', '', '', 'sonopakis', '', '', NULL, 'Umum', '2024-11-27 12:14:15', '$2y$10$.6poepR7Lj0AD3GjMiyl3ezkmgOBTy2CXeOAJiC/QV9pwcR9Rd5Oy', 'EiKrSpW4rWAC9DtktNQE9XCYFBqw7Apolt6VHhpwHeH3q8KpZND6n1ZA1k44', NULL, NULL, 'Aktif', NULL, '2024-11-27 12:14:15', '2025-09-25 01:34:59'),
(18, 3, 'Test Pengajar 1', 'pengajar1@gmail.com', '085600913', 'SD MUHAMMADIYAH BAUSASRAN 1', NULL, NULL, NULL, NULL, NULL, 'public/uploads/avatar/1733042407_Screenshot 2024-07-11 at 15.26.43.png', 'Umum', NULL, '$2y$10$UOBDX8Nzw1/.OniyOVruPeOilp4qcz/BcrGUEgd66lLJnel1Np2x.', NULL, NULL, NULL, 'Aktif', NULL, '2024-12-01 08:40:07', '2024-12-01 08:40:07'),
(27, 1, 'pia santoso', 'pia69@gmail.com', '123456789', '-', 'SD', '6', 'sonopakis', 'ayaaaaaa', '23546789', NULL, 'Umum', NULL, '$2y$10$ijrb3V3zUtL5Opo0JTtwFOyH3TUsO/wl0cDK58cBzu7VILbKV.LnS', NULL, NULL, NULL, 'Aktif', NULL, '2025-09-25 08:12:30', '2025-09-25 08:12:30'),
(28, 1, 'KakaPatria', 'kakapatria65@gmail.com', '', '', '', '', '', '', '', NULL, 'Umum', NULL, '$2y$10$2NQ3Z9mu0yn.4pXs7mfbkuMp.LoOIICGQVmwtYOgB3qZQ7FXDzIfS', 'jAi9YKxCbI9BqZM6RDMEmMXA0tZVPwjyy126W9lniSkBHzpGIly4yIdNoUBK', NULL, NULL, 'Aktif', NULL, '2025-09-26 03:58:43', '2025-09-29 05:03:50'),
(29, 1, 'Admin 2', 'admin2@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Umum', NULL, '$2y$10$hcZ4eI.ja6fl4LIFLr0/W.XgVW.2Do6n8h/3WrsP.n.irthIhgcHK', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:17:51', '2025-10-13 15:17:51'),
(30, 1, 'Admin 3', 'admin3@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Umum', NULL, '$2y$10$2mOXRRUEcQGPEMuTIS/M2ufNO1SplpLgUMPZ0OHVeYexiN2oinEzu', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:18:14', '2025-10-13 15:18:14');

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
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jadwal_cendekia`
--
ALTER TABLE `jadwal_cendekia`
  MODIFY `jadwal_cendekia_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_cendekia`
--
ALTER TABLE `kelas_cendekia`
  MODIFY `kelas_cendekia_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_siswa_cendekia`
--
ALTER TABLE `kelas_siswa_cendekia`
  MODIFY `kelas_siswa_cendekia_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `ref_materi_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `tryout_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tryout_jawaban`
--
ALTER TABLE `tryout_jawaban`
  MODIFY `tryout_jawaban_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tryout_nilai`
--
ALTER TABLE `tryout_nilai`
  MODIFY `tryout_nilai_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout_open_pendaftaran`
--
ALTER TABLE `tryout_open_pendaftaran`
  MODIFY `top_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  MODIFY `tryout_peserta_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  MODIFY `tryout_soal_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
