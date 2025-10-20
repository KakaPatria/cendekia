-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 03:19 AM
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
(1, '2025_09_25_114449_update_users_roles_id_column', 1),
(2, '2025_09_29_000000_add_password_otp_to_users_table', 2);

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
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 21),
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
-- Table structure for table `referal_codes`
--

CREATE TABLE `referal_codes` (
  `code` varchar(55) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'Bahasa Indonesia', 'SD', 6, '2025-10-13 15:03:29', '2025-10-13 15:07:47');

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
  `is_open` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `tryout_nominal` bigint(20) NOT NULL,
  `tryout_diskon` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout`
--

INSERT INTO `tryout` (`tryout_id`, `tryout_judul`, `tryout_deskripsi`, `tryout_jenjang`, `tryout_kelas`, `tryout_register_due`, `tryout_banner`, `tryout_status`, `tryout_jenis`, `is_open`, `tryout_nominal`, `tryout_diskon`, `created_at`, `updated_at`) VALUES
(2, 'TRYOUT-ERWIN-1', '<p>Materi tentang TENSES</p>', 'SMP', '9', '2024-01-31', NULL, 'Aktif', 'Gratis', '', 0, 0, '2024-11-27 08:19:26', '2024-11-27 08:19:26'),
(3, 'PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊<br>&nbsp;</p>', 'SD', '6', '2024-01-31', 'public/uploads/banner_tryout/1733036999_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Aktif', 'Berbayar', 'Ya', 20000, 0, '2024-12-01 07:09:59', '2024-12-01 07:09:59'),
(4, 'test tryout', '<p>test</p>', 'SMA', '12', '2024-01-31', 'public/uploads/banner_tryout/1733044149_Screenshot 2024-07-11 at 15.26.43.png', 'Aktif', 'Gratis', 'Tidak', 0, 0, '2024-12-01 09:09:09', '2024-12-01 09:09:09'),
(5, 'coba', '', 'SMP', '7', '2025-01-20', NULL, 'Tidak Aktif', 'Gratis', 'Ya', 0, 0, '2025-09-22 12:04:07', '2025-09-22 12:04:07'),
(6, 'TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024 (Umum)', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊</p>', 'SD', '6', '2025-11-01', 'public/uploads/banner_tryout/1760370043_banner1.png', 'Aktif', 'Berbayar', 'Ya', 300000, 10, '2025-10-13 15:40:43', '2025-10-13 15:47:27');

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
(12, 'jDClLOFP91', 3, 'D', '4', 'He gone to school every day.', NULL, '2025-10-19 17:24:34');

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
('jDClLOFP91', 6, 3, 18, 'Tryout Bahasa Inggris untuk SD membantu siswa mengenali kosakata dasar, memahami kalimat sederhana, serta melatih kemampuan mendengarkan dan membaca teks pendek. Materi mencakup topik sehari-hari seperti keluarga, hobi, warna, dan benda di sekitar.', 'FORM', 3, NULL, NULL, NULL, NULL, 60, 1, NULL, NULL, '2025-10-19 23:00:26'),
('tqMZfC74ei', 6, 5, 18, 'Tryout Bahasa Indonesia untuk tingkat SD ini dirancang untuk menguji kemampuan membaca, memahami isi teks, menulis dengan tata bahasa yang baik, serta penggunaan ejaan dan tanda baca yang benar. Soal mencakup berbagai jenis teks seperti narasi, deskripsi, dan dialog.', 'PDF', 6, NULL, NULL, NULL, NULL, 60, 1, 'public/uploads/soal/1760373782_Contoh Soal-2.pdf', NULL, '2025-10-13 23:43:05'),
('wDofJXNyfY', 6, 1, 18, 'The Mathematics tryout for elementary school aims to evaluate students’ understanding of basic arithmetic, measurement, geometry, and problem-solving. The questions are designed to strengthen logical thinking and real-life application of math concepts.', NULL, NULL, NULL, NULL, NULL, NULL, 60, 1, NULL, NULL, NULL);

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
  `status` enum('Benar','Salah') NOT NULL DEFAULT 'Salah',
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
(15, 8, 6, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 1, '2025-10-19 08:42:05', '2025-10-19 15:15:44');

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

--
-- Dumping data for table `tryout_soal`
--

INSERT INTO `tryout_soal` (`tryout_soal_id`, `tryout_materi_id`, `tryout_nomor`, `point`, `tryout_soal`, `tryout_soal_type`, `tryout_kunci_jawaban`, `tryout_penyelesaian`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'jDClLOFP91', 1, 50, '<p>Decide whether you agree or disagree with the following statements.</p><p><br></p>', 'MCMA', '{\"A\":\"Benar\",\"B\":\"Salah\",\"C\":\"Benar\",\"D\":\"Salah\"}', NULL, 'Setuju,Tidak setuju', NULL, '2025-10-19 17:23:51'),
(2, 'jDClLOFP91', 2, 20, '<p>Which of these are animals that can fly?</p><p><br></p>', 'MC', '[\"A\",\"C\",\"D\"]', NULL, '--Pilih Jenis Jawaban--', NULL, '2025-10-19 17:18:45'),
(3, 'jDClLOFP91', 3, 10, '<p>Choose the correct sentence.</p>', 'SC', '[\"B\"]', NULL, 'Benar,Salah', NULL, '2025-10-19 17:24:34');

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
  `referal_code` varchar(255) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `roles_id`, `name`, `email`, `telepon`, `asal_sekolah`, `jenjang`, `kelas`, `alamat`, `nama_orang_tua`, `telp_orang_tua`, `avatar`, `referal_code`, `email_verified_at`, `password`, `remember_token`, `password_otp`, `password_otp_expires_at`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(8, 1, 'Faris Aizy', 'farisaizy12@gmail.com', '085600200913', 'SD Indonesia Merdeka', 'SD', '5', 'Jl ABc', 'Test', '9021830912830', 'public/uploads/avatar/1732698688_Screenshot 2024-06-27 215605.png', NULL, NULL, '$2y$10$BEm7CrVga8uHvEtzjX26cuHG9RIIWW/nN0wkzmgrsSI5HD75Yh6Um', NULL, NULL, NULL, 'Aktif', NULL, '2024-11-27 09:10:58', '2025-10-19 06:39:27'),
(14, 2, 'Super Admin', 'admin@cendekia.com', '123456789', '-', '', '', 'sonopakis', '', '', NULL, NULL, '2024-11-27 12:14:15', '$2y$10$.6poepR7Lj0AD3GjMiyl3ezkmgOBTy2CXeOAJiC/QV9pwcR9Rd5Oy', 'JXs4FJ72p56gayw4LQykz20tkNECiokreJcYzkOdN6hafTB0rz0B3VPW46DT', NULL, NULL, 'Aktif', NULL, '2024-11-27 12:14:15', '2025-09-25 01:34:59'),
(18, 3, 'Test Pengajar 1', 'pengajar1@gmail.com', '085600913', 'SD MUHAMMADIYAH BAUSASRAN 1', NULL, NULL, NULL, NULL, NULL, 'public/uploads/avatar/1733042407_Screenshot 2024-07-11 at 15.26.43.png', NULL, NULL, '$2y$10$UOBDX8Nzw1/.OniyOVruPeOilp4qcz/BcrGUEgd66lLJnel1Np2x.', NULL, NULL, NULL, 'Aktif', NULL, '2024-12-01 08:40:07', '2024-12-01 08:40:07'),
(27, 1, 'pia santoso', 'pia69@gmail.com', '123456789', '-', 'SMA', '12', 'sonopakis', 'ayaaaaaa', '23546789', NULL, NULL, NULL, '$2y$10$ijrb3V3zUtL5Opo0JTtwFOyH3TUsO/wl0cDK58cBzu7VILbKV.LnS', NULL, NULL, NULL, 'Aktif', NULL, '2025-09-25 08:12:30', '2025-09-25 08:12:30'),
(28, 1, 'KakaPatria', 'kakapatria65@gmail.com', '', '', '', '', '', '', '', NULL, NULL, NULL, '$2y$10$2NQ3Z9mu0yn.4pXs7mfbkuMp.LoOIICGQVmwtYOgB3qZQ7FXDzIfS', 'jAi9YKxCbI9BqZM6RDMEmMXA0tZVPwjyy126W9lniSkBHzpGIly4yIdNoUBK', NULL, NULL, 'Aktif', NULL, '2025-09-26 03:58:43', '2025-09-29 05:03:50'),
(29, 1, 'Admin 2', 'admin2@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$hcZ4eI.ja6fl4LIFLr0/W.XgVW.2Do6n8h/3WrsP.n.irthIhgcHK', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:17:51', '2025-10-13 15:17:51'),
(30, 1, 'Admin 3', 'admin3@cendekia.com', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2mOXRRUEcQGPEMuTIS/M2ufNO1SplpLgUMPZ0OHVeYexiN2oinEzu', NULL, NULL, NULL, 'Aktif', NULL, '2025-10-13 15:18:14', '2025-10-13 15:18:14');

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
-- Indexes for table `referal_codes`
--
ALTER TABLE `referal_codes`
  ADD PRIMARY KEY (`code`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ref_materi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `tryout_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tryout_jawaban`
--
ALTER TABLE `tryout_jawaban`
  MODIFY `tryout_jawaban_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tryout_nilai`
--
ALTER TABLE `tryout_nilai`
  MODIFY `tryout_nilai_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout_open_pendaftaran`
--
ALTER TABLE `tryout_open_pendaftaran`
  MODIFY `top_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  MODIFY `tryout_peserta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  MODIFY `tryout_soal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
