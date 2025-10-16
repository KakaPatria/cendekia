-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2025 at 04:30 AM
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
  `nama_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('IN-2412-0002', 7, 3, 10, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 1, '2024-12-01', '2024-12-01', '2024-12-01 09:03:59', '2024-12-01 09:03:59'),
('IN-2412-0003', 8, 3, 11, 'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', 20000, 0, '2024-12-08', NULL, '2024-12-01 09:27:43', '2024-12-01 09:27:43');

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
(1, '2025_09_25_114449_update_users_roles_id_column', 1),
(2, '2025_09_29_000000_add_password_otp_to_users_table', 2);

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
(1, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 21);

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
('Invoice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `referal_codes`
--

CREATE TABLE `referal_codes` (
  `code` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Matematika', 'SD', 2, '2024-12-01 09:37:20', '2024-12-01 09:37:20'),
(2, 'Bahasa Indonesia', 'SMP', 8, '2024-12-01 09:56:19', '2024-12-01 09:56:19'),
(3, 'Bahasa Inggris', 'SD', 2, '2024-12-01 10:08:21', '2024-12-01 10:08:21'),
(4, 'ipa', 'SMP', 7, '2025-09-22 12:06:05', '2025-09-22 12:06:05');

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
(1, 'Siswa', 'web', '2024-10-21 07:04:27', '2024-10-21 07:04:27'),
(2, 'Admin', 'web', '2025-09-25 02:33:54', '2025-09-25 02:33:54'),
(3, 'Pengajar', 'web', '2024-10-21 07:04:28', '2024-10-21 07:04:28'),
(4, 'Umum', 'web', '2025-10-10 02:02:29', '2025-10-10 02:02:29');

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
  `tryout_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_register_due` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `tryout_jenis` enum('Gratis','Berbayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Gratis',
  `is_open` enum('Ya','Tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak',
  `tryout_nominal` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout`
--

INSERT INTO `tryout` (`tryout_id`, `tryout_judul`, `tryout_deskripsi`, `tryout_jenjang`, `tryout_kelas`, `tryout_register_due`, `tryout_banner`, `tryout_status`, `tryout_jenis`, `is_open`, `tryout_nominal`, `created_at`, `updated_at`) VALUES
(1, 'TRYOUT KELAS 6 SD', '<p><strong>PETUNJUK TRYOUT</strong><br><br>&nbsp;</p><ol><li><i><strong>Berdoa sebelum mengerjakan soal tryout.&nbsp;</strong></i></li><li><i><strong>Silakan mengerjakan soal secara mandiri tanpa bantuan orang lain dengan penuh kejujuran.</strong></i></li><li><i><strong>Tidak diperbolehkan menggunakan kalkulator, tabel matematika atau alat bantu hitung lainnya.</strong></i></li><li><i><strong>Pilihlah nama lengkap anda.</strong></i></li><li><i><strong>Masukkan token yang diberikan oleh petugas kepada anda.</strong></i></li><li><i><strong>Periksa dan bacalah soal-soal sebelum menjawabnya.</strong></i></li><li><i><strong>Pada setiap butir soal terdapat 4 pilihan jawaban.</strong></i></li><li><i><strong>Silakan mengerjakan,&nbsp;Pilihlah jawaban yang menurut anda paling benar di lembar jawab online yang tersedia.</strong></i></li><li><i><strong>Periksalah jawaban anda sebelum anda submit ke sistem.</strong></i></li><li><i><strong>Setiap peserta hanya diizinkan melakukan satu kali pengerjaan soal.</strong></i></li><li><i><strong>Jika ada masalah dalam teknis link soal, silakan hubungi admin LBB Cendekia. WA : 081272139500.</strong></i></li></ol>', 'SD', '2', '2024-01-20', 'public/uploads/banner_tryout/1732695186_TRYOUT CENDEKIA CENTER (2).jpg', 'Aktif', 'Gratis', '', 0, '2024-11-27 08:13:06', '2024-11-27 08:13:06'),
(2, 'TRYOUT-ERWIN-1', '<p>Materi tentang TENSES</p>', 'SMP', '9', '2024-01-31', NULL, 'Aktif', 'Gratis', '', 0, '2024-11-27 08:19:26', '2024-11-27 08:19:26'),
(3, 'PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024', '<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊<br>&nbsp;</p>', 'SD', '6', '2024-01-31', 'public/uploads/banner_tryout/1733036999_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Aktif', 'Berbayar', 'Ya', 20000, '2024-12-01 07:09:59', '2024-12-01 07:09:59'),
(4, 'test tryout', '<p>test</p>', 'SMA', '12', '2024-01-31', 'public/uploads/banner_tryout/1733044149_Screenshot 2024-07-11 at 15.26.43.png', 'Aktif', 'Gratis', 'Tidak', 0, '2024-12-01 09:09:09', '2024-12-01 09:09:09'),
(5, 'coba', '', 'SMP', '7', '2025-01-20', NULL, 'Tidak Aktif', 'Gratis', 'Ya', 0, '2025-09-22 12:04:07', '2025-09-22 12:04:07'),
(6, 'piaw', '<p>wduwgqhjbkdqw</p>', 'SMA', '12', '2025-12-05', 'public/uploads/banner_tryout/1759912985_code.png', 'Aktif', 'Berbayar', 'Ya', 10000, '2025-10-08 08:43:05', '2025-10-08 08:43:05'),
(7, 'tryouttt sophia', '<p>udavshd</p>', 'SMP', '9', '2025-02-28', 'public/uploads/banner_tryout/1760083370_Screenshot 2025-10-06 203421.png', 'Aktif', 'Gratis', 'Tidak', 0, '2025-10-10 08:02:50', '2025-10-10 08:02:50'),
(8, 'tryouttt sophia', '<p>wdfghn</p>', 'SD', '5', '2025-10-21', 'public/uploads/banner_tryout/1760409526_code.png', 'Aktif', 'Berbayar', 'Ya', 12000, '2025-10-14 02:38:46', '2025-10-14 02:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_jawaban`
--

CREATE TABLE `tryout_jawaban` (
  `tryout_jawaban_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `tryout_jawaban_prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_urutan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_isi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_jawaban`
--

INSERT INTO `tryout_jawaban` (`tryout_jawaban_id`, `tryout_materi_id`, `tryout_soal_id`, `tryout_jawaban_prefix`, `tryout_jawaban_urutan`, `tryout_jawaban_isi`, `created_at`, `updated_at`) VALUES
(1, 'Dpo0guZRxz', 1, 'A', '1', 'Jabawan A', NULL, NULL),
(2, 'Dpo0guZRxz', 1, 'B', '2', 'Jawaban B', NULL, NULL),
(3, 'Dpo0guZRxz', 1, 'C', '3', 'Jawaban C', NULL, NULL),
(4, 'Dpo0guZRxz', 1, 'D', '4', 'Jawaban D', NULL, NULL),
(5, 'Dpo0guZRxz', 2, 'A', '1', 'Jawaban A', NULL, NULL),
(6, 'Dpo0guZRxz', 2, 'B', '2', 'Jawaban B', NULL, NULL),
(7, 'Dpo0guZRxz', 2, 'C', '3', 'Jawaban C', NULL, NULL),
(8, 'Dpo0guZRxz', 2, 'D', '4', 'Jawaban D', NULL, NULL),
(9, 'Dpo0guZRxz', 3, 'A', '1', 'Jawaban A', NULL, NULL),
(10, 'Dpo0guZRxz', 3, 'B', '2', 'Jawaban B', NULL, NULL),
(11, 'Dpo0guZRxz', 3, 'C', '3', 'Jawaban C', NULL, NULL),
(12, 'Dpo0guZRxz', 3, 'D', '4', 'Jawaban D', NULL, NULL);

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
  `jumlah_soal` int DEFAULT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_selesai` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `safe_mode` int NOT NULL DEFAULT '1',
  `master_soal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_materi`
--

INSERT INTO `tryout_materi` (`tryout_materi_id`, `tryout_id`, `materi_id`, `pengajar_id`, `tryout_materi_deskripsi`, `jenis_soal`, `jumlah_soal`, `periode_mulai`, `periode_selesai`, `waktu_mulai`, `waktu_selesai`, `durasi`, `safe_mode`, `master_soal`, `created_at`, `updated_at`) VALUES
('4OXg4wOUVt', 1, 3, 18, 'Perlu di isi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
('Dpo0guZRxz', 1, 1, 18, 'Lorem ipsum', 'FORM', 3, '2024-11-01', '2024-12-31', '12:00:00', '20:00:00', 30, 1, NULL, NULL, '2024-12-01 16:39:04'),
('QT1t12eoMw', 5, 4, 15, 'kdghu', 'PDF', 4, '2025-09-21', '2025-09-22', '09:00:00', '12:00:00', 90, 1, 'public/uploads/soal/1758544027_LATIHAN SOAL IPA KELAS 7 BAB 2 Materi dan Perubahannya.pdf', NULL, '2025-09-22 19:27:09'),
('XII5GCFDAR', 8, 1, 18, 'asdfghjk', 'FORM', 10, '2025-10-14', '2025-10-14', '10:00:00', '12:00:00', 120, 1, NULL, NULL, '2025-10-14 09:40:42');

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
  `total_point` int DEFAULT '0',
  `soal_dijekerjakan` int DEFAULT NULL,
  `soal_total` int DEFAULT NULL,
  `jumlah_salah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_benar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_soal_id` int DEFAULT NULL,
  `status` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Proses',
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
  `top_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_telpon_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_telpon_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_tanggal_bayar` date NOT NULL,
  `top_jenis_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_bukti_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_nama_bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_status` enum('Pending','Terverifikasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_open_pendaftaran`
--

INSERT INTO `tryout_open_pendaftaran` (`top_id`, `tryout_id`, `top_email`, `top_nama_siswa`, `top_asal_sekolah`, `top_telpon_siswa`, `top_nama_orang_tua`, `top_telpon_orang_tua`, `top_tanggal_bayar`, `top_jenis_bayar`, `top_bukti_bayar`, `top_nama_bayar`, `top_status`, `created_at`, `updated_at`) VALUES
(1, 15, 'farisaizy12@gmail.com', 'Faris Aizy', 'SD Indonesia Merdeka', '0129380183', 'fsafasssad', '990312129039012', '2024-11-21', 'Bank Transfer', '/tmp/phpPeFljC', 'sadjhkashdasd', 'Terverifikasi', NULL, '2024-11-22 06:59:17'),
(18, 3, 'faris123@gmail.com', 'Faris Aizy', 'SD NEGERI JETIS 1', '085600200913', 'Jhon Doe', '0856000200913', '2024-12-28', 'Bank Transfer', 'uploads/bukti_bayar/1733038212_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Jhon Doe', 'Terverifikasi', '2024-12-01 07:30:12', '2025-09-22 12:17:07'),
(19, 3, 'faris123@gmail.com', 'Faris Aizy', 'SD NEGERI JETIS 1', '085600200913', 'Jhon Doe', '0856000200913', '2024-12-28', 'Bank Transfer', 'uploads/bukti_bayar/1733038271_WhatsApp Image 2023-11-01 at 17.02.40.jpeg', 'Jhon Doe', 'Pending', '2024-12-01 07:31:11', '2024-12-01 07:31:11'),
(20, 3, 'ayawwwww3@gmail.com', 'adinda cintya firdausi', 'smk', '081233374920', 'zea', '081233374920', '2025-09-19', 'Datang Langsung Ke Kantor Cendekia', 'uploads/bukti_bayar/1758276835_17582768198558896121984039273250.jpg', 'fia', 'Pending', '2025-09-19 10:13:55', '2025-09-19 10:13:55'),
(21, 3, 'ayawwwww3@gmail.com', 'adinda cintya firdausi', 'smk', '081233374920', 'zea', '081233374920', '2025-09-19', 'Datang Langsung Ke Kantor Cendekia', 'uploads/bukti_bayar/1758276840_17582768198558896121984039273250.jpg', 'fia', 'Pending', '2025-09-19 10:14:00', '2025-09-19 10:14:00'),
(22, 3, 'ayawwwww3@gmail.com', 'adinda cintya firdausi', 'smk', '081233374920', 'zea', '081233374920', '2025-09-19', 'Datang Langsung Ke Kantor Cendekia', 'uploads/bukti_bayar/1758276850_17582768198558896121984039273250.jpg', 'fia', 'Pending', '2025-09-19 10:14:10', '2025-09-19 10:14:10'),
(23, 3, 'alfi31973197@gmail.com', 'alfi dwi yanti', 'SMP 9 Yogyakarta', '082330533018', '082330533018', '12345678913254', '2025-09-30', 'Bank Transfer', 'uploads/bukti_bayar/1759201988_code.png', 'pia', 'Pending', '2025-09-30 03:13:08', '2025-09-30 03:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_pengerjaan`
--

CREATE TABLE `tryout_pengerjaan` (
  `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tryout_jawaban` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Benar','Salah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Salah',
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
(1, 17, 2, 'Faris Aizy', '012312312312313', 'farisaizy123@gmail.com', 'JL ABCD', 1, '2024-11-27 12:45:48', '2024-11-27 12:45:48'),
(2, 17, 3, 'Faris Aizy', '012312312312313', 'farisaizy123@gmail.com', 'JL ABCD', 1, '2024-12-01 08:43:42', '2024-12-01 08:43:42'),
(3, 17, 3, 'Faris Aizy', '012312312312313', 'farisaizy123@gmail.com', 'JL ABCD', 1, '2024-12-01 08:43:56', '2024-12-01 08:43:56'),
(4, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 08:55:22', '2024-12-01 08:55:22'),
(5, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:00:19', '2024-12-01 09:00:19'),
(6, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:00:26', '2024-12-01 09:00:26'),
(7, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:01:14', '2024-12-01 09:01:14'),
(8, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:01:23', '2024-12-01 09:01:23'),
(9, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:01:56', '2024-12-01 09:01:56'),
(10, 7, 3, 'Erwin Pebriari Widiyatmoko', '0881080080101', 'erwinwidiyatmoko@gmail.com', 'MG II/1039, Brontokusuman, Mergangsan', 1, '2024-12-01 09:03:58', '2024-12-01 09:03:58'),
(11, 8, 3, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 0, '2024-12-01 09:27:43', '2024-12-01 09:27:43'),
(12, 8, 1, 'Faris Aizy', '085600200913', 'farisaizy12@gmail.com', 'Jl ABc', 1, '2024-12-01 09:28:38', '2024-12-01 09:28:38'),
(13, 19, 2, 'wawa nasional', '0812345678', 'wawa@gmail.com', 'jl damaii', 1, '2025-09-15 08:47:29', '2025-09-15 08:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `tryout_soal`
--

CREATE TABLE `tryout_soal` (
  `tryout_soal_id` bigint UNSIGNED NOT NULL,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_nomor` int NOT NULL,
  `point` int NOT NULL DEFAULT '1',
  `tryout_soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tryout_kunci_jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_penyelesaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tryout_soal`
--

INSERT INTO `tryout_soal` (`tryout_soal_id`, `tryout_materi_id`, `tryout_nomor`, `point`, `tryout_soal`, `tryout_kunci_jawaban`, `tryout_penyelesaian`, `created_at`, `updated_at`) VALUES
(1, 'Dpo0guZRxz', 1, 20, '<p> Sebuah muatan listrik 5 C mendapat gaya 30 N dari sebuah muatan yang lain. Besar medan listrik yang dialami muataun itu adalah ... </p>', '[\"A\",\"D\"]', NULL, NULL, '2024-12-01 09:45:06'),
(2, 'Dpo0guZRxz', 2, 40, '<p><img src=\"/storage/uploads/soal/1733046216_Screenshot 2024-12-01 at 16.43.25.png\" style=\"\" width=\"712\"></p><p>Teks Tambahan</p><ul><li><br></li></ul>', '[\"B\"]', NULL, NULL, '2024-12-01 09:45:06'),
(3, 'Dpo0guZRxz', 3, 50, '<p> Titik A berada pada jarak 6 cm dari suatu muatan listrik. Jika muatan itu memberkan kuat medan listrik sebesar 106 N/C, berapa besar muatan listriknya? </p>', '[\"C\"]', NULL, NULL, '2024-12-01 09:45:06'),
(4, 'QT1t12eoMw', 1, 1, 'public/uploads/soal/image/soal_1_1758544027.jpg', '[\"A\"]', 'public/uploads/soal/image/jawaban_2_1758544027.jpg', NULL, '2025-09-22 12:32:38'),
(5, 'QT1t12eoMw', 2, 1, 'public/uploads/soal/image/soal_3_1758544027.jpg', '[\"B\"]', 'public/uploads/soal/image/jawaban_4_1758544028.jpg', NULL, '2025-09-22 12:34:52'),
(6, 'QT1t12eoMw', 3, 1, 'public/uploads/soal/image/soal_5_1758544028.jpg', '[\"A\"]', '', NULL, '2025-09-22 12:34:52'),
(7, 'QT1t12eoMw', 1, 1, 'public/uploads/soal/image/soal_1_1758544027.jpg', '[\"C\"]', 'public/uploads/soal/image/jawaban_2_1758544028.jpg', NULL, '2025-09-22 12:34:52'),
(8, 'QT1t12eoMw', 2, 1, 'public/uploads/soal/image/soal_3_1758544028.jpg', '[\"A\"]', 'public/uploads/soal/image/jawaban_4_1758544028.jpg', NULL, '2025-09-22 12:34:52'),
(9, 'QT1t12eoMw', 3, 1, 'public/uploads/soal/image/soal_5_1758544028.jpg', '[\"A\"]', '', NULL, '2025-09-22 12:33:52'),
(10, 'XII5GCFDAR', 1, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'XII5GCFDAR', 2, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'XII5GCFDAR', 3, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'XII5GCFDAR', 4, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'XII5GCFDAR', 5, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'XII5GCFDAR', 6, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'XII5GCFDAR', 7, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'XII5GCFDAR', 8, 1, NULL, NULL, NULL, NULL, NULL),
(18, 'XII5GCFDAR', 9, 1, NULL, NULL, NULL, NULL, NULL),
(19, 'XII5GCFDAR', 10, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nomor_urut` int DEFAULT NULL,
  `id` bigint UNSIGNED NOT NULL,
  `roles_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_otp_expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nomor_urut`, `id`, `roles_id`, `name`, `email`, `telepon`, `asal_sekolah`, `jenjang`, `kelas`, `golongan`, `alamat`, `nama_orang_tua`, `telp_orang_tua`, `avatar`, `referal_code`, `email_verified_at`, `password`, `remember_token`, `password_otp`, `password_otp_expires_at`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'Faris Aizy', 'farisaizy12@gmail.com', '085600200913', 'SD Indonesia Merdeka', 'SD', '5', 'B', 'Jl ABc', 'Test', '9021830912830', 'public/uploads/avatar/1732698688_Screenshot 2024-06-27 215605.png', NULL, NULL, '$2y$10$TGwGBLBKFEvJluTvXw2IP.WFUKffqErHU4VC.dODSZ/lpAPO3wagi', NULL, NULL, NULL, 'Aktif', NULL, '2024-11-27 09:10:58', '2024-11-27 09:11:28'),
(2, 14, 2, 'Super Admin', 'admin@cendekia.com', '123456789', '-', '', '', 'Belum Ditentukan', 'sonopakis', '', '', NULL, NULL, '2024-11-27 12:14:15', '$2y$10$.6poepR7Lj0AD3GjMiyl3ezkmgOBTy2CXeOAJiC/QV9pwcR9Rd5Oy', '9JFXOffHwyU3HbwXi41ytfFTUFZKXZLX62XlG7AHvRdFbAJcoO4Dm9DPnIu0', NULL, NULL, 'Aktif', NULL, '2024-11-27 12:14:15', '2025-09-25 01:34:59'),
(3, 18, 3, 'Test Pengajar 1', 'pengajar1@gmail.com', '085600913', 'SD MUHAMMADIYAH BAUSASRAN 1', NULL, NULL, 'Belum Ditentukan', NULL, NULL, NULL, 'public/uploads/avatar/1733042407_Screenshot 2024-07-11 at 15.26.43.png', NULL, NULL, '$2y$10$UOBDX8Nzw1/.OniyOVruPeOilp4qcz/BcrGUEgd66lLJnel1Np2x.', NULL, NULL, NULL, 'Aktif', NULL, '2024-12-01 08:40:07', '2024-12-01 08:40:07'),
(4, 27, 1, 'pia santoso', 'pia69@gmail.com', '123456789', '-', 'SMA', '12', 'D', 'sonopakis', 'ayaaaaaa', '23546789', NULL, NULL, NULL, '$2y$10$ijrb3V3zUtL5Opo0JTtwFOyH3TUsO/wl0cDK58cBzu7VILbKV.LnS', NULL, NULL, NULL, 'Aktif', NULL, '2025-09-25 08:12:30', '2025-09-25 08:12:30');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `ref_materi_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tryout`
--
ALTER TABLE `tryout`
  MODIFY `tryout_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `top_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tryout_peserta`
--
ALTER TABLE `tryout_peserta`
  MODIFY `tryout_peserta_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tryout_soal`
--
ALTER TABLE `tryout_soal`
  MODIFY `tryout_soal_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
