-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: db_cendekia_prod
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asal_sekolah`
--

DROP TABLE IF EXISTS `asal_sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asal_sekolah` (
  `nama_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asal_sekolah`
--

LOCK TABLES `asal_sekolah` WRITE;
/*!40000 ALTER TABLE `asal_sekolah` DISABLE KEYS */;
INSERT INTO `asal_sekolah` VALUES ('SD Indonesia Merdeka'),('SD KANISIUS GAYAM 1'),('SD NEGERI JETIS 1'),('SD NEGERI LEMPUYANGAN 1'),('SD MUHAMMADIYAH BAUSASRAN 1'),('SD MUHAMMADIYAH BAUSASRAN 2'),('SD NEGERI DEMANGAN'),('SD TAMANSISWA JETIS'),('SD NEGERI JETISHARJO'),('SD JOANNES BOSCO YOGYAKARTA'),('SD NEGERI COKROKUSUMAN'),('SD NEGERI BHAYANGKARA'),('SD NEGERI WIDORO'),('SD NEGERI SERAYU'),('SD NEGERI UNGARAN 1'),('SD BOPKRI GONDOLAYU'),('SD NEGERI KYAI MOJO'),('SD NEGERI BUMIJO'),('SD NEGERI GONDOLAYU'),('SD NEGERI BACIRO'),('SD KANISIUS GOWONGAN'),('SD NEGERI KLITREN'),('SD BHINNEKA TUNGGAL IKA'),('SD TARAKANITA 1'),('SD NEGERI TERBANSARI 1'),('SD BUDYA WACANA 1'),('SD NEGERI JETIS 2'),('SD NEGERI VIDYA QASANA'),('SD NEGERI BADRAN'),('SD NEGERI LEMPUYANGWANGI'),('smk 2 depok'),('SMK Negeri 2 Yogyakarta'),('SMKN 1 KOTABUMI'),('SD BUASASRAN 3'),('SMP 9 Yogyakarta'),('smk');
/*!40000 ALTER TABLE `asal_sekolah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES ('IN-2412-0002',7,3,10,'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024',20000,1,'2024-12-01','2024-12-01','2024-12-01 09:03:59','2024-12-01 09:03:59'),('IN-2412-0003',8,3,11,'Biaya PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024',20000,0,'2024-12-08',NULL,'2024-12-01 09:27:43','2024-12-01 09:27:43');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1),(1,'App\\Models\\User',7),(2,'App\\Models\\User',11),(2,'App\\Models\\User',12),(2,'App\\Models\\User',13),(2,'App\\Models\\User',14),(3,'App\\Models\\User',15),(1,'App\\Models\\User',17),(3,'App\\Models\\User',18),(1,'App\\Models\\User',19);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'panel.dashboard','web','2024-10-21 07:04:27','2024-10-21 07:04:27'),(2,'panel.logout','web','2024-10-21 07:04:27','2024-10-21 07:04:27'),(3,'siswa.dashboard','web','2024-10-21 07:04:27','2024-10-21 07:04:27'),(4,'siswa.logout','web','2024-10-21 07:04:27','2024-10-21 07:04:27');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefix_number`
--

DROP TABLE IF EXISTS `prefix_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prefix_number` (
  `id` varchar(55) NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefix_number`
--

LOCK TABLES `prefix_number` WRITE;
/*!40000 ALTER TABLE `prefix_number` DISABLE KEYS */;
INSERT INTO `prefix_number` VALUES ('Invoice',3);
/*!40000 ALTER TABLE `prefix_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_materi`
--

DROP TABLE IF EXISTS `ref_materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ref_materi` (
  `ref_materi_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_materi_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_materi_kelas` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ref_materi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_materi`
--

LOCK TABLES `ref_materi` WRITE;
/*!40000 ALTER TABLE `ref_materi` DISABLE KEYS */;
INSERT INTO `ref_materi` VALUES (1,'Matematika','SD',2,'2024-12-01 09:37:20','2024-12-01 09:37:20'),(2,'Bahasa Indonesia','SMP',8,'2024-12-01 09:56:19','2024-12-01 09:56:19'),(3,'Bahasa Inggris','SD',2,'2024-12-01 10:08:21','2024-12-01 10:08:21'),(4,'ipa','SMP',7,'2025-09-22 12:06:05','2025-09-22 12:06:05');
/*!40000 ALTER TABLE `ref_materi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referal_codes`
--

DROP TABLE IF EXISTS `referal_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referal_codes` (
  `code` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referal_codes`
--

LOCK TABLES `referal_codes` WRITE;
/*!40000 ALTER TABLE `referal_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `referal_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (3,1),(4,1),(1,2),(2,2),(1,3),(2,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Siswa','web','2024-10-21 07:04:27','2024-10-21 07:04:27'),(2,'Admin','web','2024-10-21 07:04:27','2024-10-21 07:04:27'),(3,'Pengajar','web','2024-10-21 07:04:28','2024-10-21 07:04:28');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout`
--

DROP TABLE IF EXISTS `tryout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout` (
  `tryout_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tryout_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_register_due` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `tryout_jenis` enum('Gratis','Berbayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Gratis',
  `is_open` enum('Ya','Tidak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak',
  `tryout_nominal` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout`
--

LOCK TABLES `tryout` WRITE;
/*!40000 ALTER TABLE `tryout` DISABLE KEYS */;
INSERT INTO `tryout` VALUES (1,'TRYOUT KELAS 6 SD','<p><strong>PETUNJUK TRYOUT</strong><br><br>&nbsp;</p><ol><li><i><strong>Berdoa sebelum mengerjakan soal tryout.&nbsp;</strong></i></li><li><i><strong>Silakan mengerjakan soal secara mandiri tanpa bantuan orang lain dengan penuh kejujuran.</strong></i></li><li><i><strong>Tidak diperbolehkan menggunakan kalkulator, tabel matematika atau alat bantu hitung lainnya.</strong></i></li><li><i><strong>Pilihlah nama lengkap anda.</strong></i></li><li><i><strong>Masukkan token yang diberikan oleh petugas kepada anda.</strong></i></li><li><i><strong>Periksa dan bacalah soal-soal sebelum menjawabnya.</strong></i></li><li><i><strong>Pada setiap butir soal terdapat 4 pilihan jawaban.</strong></i></li><li><i><strong>Silakan mengerjakan,&nbsp;Pilihlah jawaban yang menurut anda paling benar di lembar jawab online yang tersedia.</strong></i></li><li><i><strong>Periksalah jawaban anda sebelum anda submit ke sistem.</strong></i></li><li><i><strong>Setiap peserta hanya diizinkan melakukan satu kali pengerjaan soal.</strong></i></li><li><i><strong>Jika ada masalah dalam teknis link soal, silakan hubungi admin LBB Cendekia. WA : 081272139500.</strong></i></li></ol>','SD','2','2024-01-20','public/uploads/banner_tryout/1732695186_TRYOUT CENDEKIA CENTER (2).jpg','Aktif','Gratis','',0,'2024-11-27 08:13:06','2024-11-27 08:13:06'),(2,'TRYOUT-ERWIN-1','<p>Materi tentang TENSES</p>','SMP','9','2024-01-31',NULL,'Aktif','Gratis','',0,'2024-11-27 08:19:26','2024-11-27 08:19:26'),(3,'PENDAFTARAN TRYOUT PERSIAPAN DINI ASPD SD/MI TA 2023-2024','<p>✨<strong>Halo adik-adik kelas 6 SD</strong>✨<br>Dalam rangka pemantapan persiapan ASPD, OSIS&nbsp;NATA ADIBRATA -&nbsp;SMP Negeri 9 Yogyakarta bekerjasama&nbsp;LBB Cendekia&nbsp; dengan&nbsp;mengadakan TRYOUT PERSIAPAN DINI ASPD SD di SMP Negeri 9 Yogyakarta, yang <strong>berlangsung pada SABTU, 25 NOVEMBER 2023 dengan sesi pengerjaan 08.00-10.15 WIB</strong><br><br>📲Ananda Wajib membawa HP yang berisikan Kouta untuk mengisikan jawaban Try out pada lembar jawab google form.<br><br>❇️ <strong>CARA MENDAFTAR :</strong><br>1) Melakukan pembayaran dengan Biaya Rp20.000,- terlebih dahulu melalui :<br>▫️ Transfer&nbsp;BRI : 117501003821538 RATIH PADMA SARI<br>▫️ atau Datang langsung ke SMP Negeri 9 Yogyakarta pada jam kerja<br>2) Mengisi link pendaftaran :<br>🔗https://lbbcendekia.com/to2023<br><br>3) Kuitansi / bukti transfer difoto ataupun discreenshot kemudian unggah pada link pendaftaran (point 2). Kemudian submit jawaban anda.​<br><br>4) Masuk pada Whatsapp Grup melalui link undangan di akhir pendaftaran<br>(setelah sumbit).​<br><br>5) Cek email yang terdaftar saat mengisikan link pendaftaran untuk mendapatkan kartu peserta (tidak perlu diprint).<br><br>📌<strong>CATATAN :</strong><br>&nbsp;</p><ul><li>Pastikan setelah melakukan pembayaran anda mengisi link pendaftaran pada point 2.</li><li>Jika tidak mengisi link pendaftaran, maka dianggap tidak terdaftar sebagai peserta.</li><li>Adanya perubahan waktu <strong>Tryout menjadi SABTU, 25 November 2023</strong>, Bagi ananda yang sudah mendaftarkan diri sebelum tanggal 1 november 2023 dengan pembayaran yang SAH, tetap terverifikasi.</li><li>Perubahan cara membayar online untuk yang belum melakukan pembayaran dan pendaftaran dari An. <strong>Zulfa nur aulia menjadi RATIH PADMA SARI</strong>, yang sudah melakukan pembayaran menggunakan BRI An. Zulfa nur aulia tetap SAH.</li><li>Perubahan cara membayar offline dari Kantor Cendekia menjadi di SMP Negeri 9.<br>&nbsp;</li><li>Jika belum mendapatkan kartu peserta melalui email, silahkan untuk chat kami melalui wa, tidak perlu untuk mengulang pendaftaran.</li></ul><p><br>📲 Informasi &amp; Pendaftaran hubungi kami:<br>SMP N 9 : wa.me/085880426862<br>Kak Lia LBB Cendekia : wa.me/6281272139500<br><br>Terima kasih atas partisipasi anda😊<br>&nbsp;</p>','SD','6','2024-01-31','public/uploads/banner_tryout/1733036999_WhatsApp Image 2023-11-01 at 17.02.40.jpeg','Aktif','Berbayar','Ya',20000,'2024-12-01 07:09:59','2024-12-01 07:09:59'),(4,'test tryout','<p>test</p>','SMA','12','2024-01-31','public/uploads/banner_tryout/1733044149_Screenshot 2024-07-11 at 15.26.43.png','Aktif','Gratis','Tidak',0,'2024-12-01 09:09:09','2024-12-01 09:09:09'),(5,'coba','','SMP','7','2025-01-20',NULL,'Tidak Aktif','Gratis','Ya',0,'2025-09-22 12:04:07','2025-09-22 12:04:07');
/*!40000 ALTER TABLE `tryout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_jawaban`
--

DROP TABLE IF EXISTS `tryout_jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_jawaban` (
  `tryout_jawaban_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `tryout_jawaban_prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_urutan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_jawaban_isi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_jawaban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_jawaban`
--

LOCK TABLES `tryout_jawaban` WRITE;
/*!40000 ALTER TABLE `tryout_jawaban` DISABLE KEYS */;
INSERT INTO `tryout_jawaban` VALUES (1,'Dpo0guZRxz',1,'A','1','Jabawan A',NULL,NULL),(2,'Dpo0guZRxz',1,'B','2','Jawaban B',NULL,NULL),(3,'Dpo0guZRxz',1,'C','3','Jawaban C',NULL,NULL),(4,'Dpo0guZRxz',1,'D','4','Jawaban D',NULL,NULL),(5,'Dpo0guZRxz',2,'A','1','Jawaban A',NULL,NULL),(6,'Dpo0guZRxz',2,'B','2','Jawaban B',NULL,NULL),(7,'Dpo0guZRxz',2,'C','3','Jawaban C',NULL,NULL),(8,'Dpo0guZRxz',2,'D','4','Jawaban D',NULL,NULL),(9,'Dpo0guZRxz',3,'A','1','Jawaban A',NULL,NULL),(10,'Dpo0guZRxz',3,'B','2','Jawaban B',NULL,NULL),(11,'Dpo0guZRxz',3,'C','3','Jawaban C',NULL,NULL),(12,'Dpo0guZRxz',3,'D','4','Jawaban D',NULL,NULL);
/*!40000 ALTER TABLE `tryout_jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_materi`
--

DROP TABLE IF EXISTS `tryout_materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tryout_materi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_materi`
--

LOCK TABLES `tryout_materi` WRITE;
/*!40000 ALTER TABLE `tryout_materi` DISABLE KEYS */;
INSERT INTO `tryout_materi` VALUES ('4OXg4wOUVt',1,3,18,'Perlu di isi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL),('Dpo0guZRxz',1,1,18,'Lorem ipsum','FORM',3,'2024-11-01','2024-12-31','12:00:00','20:00:00',30,1,NULL,NULL,'2024-12-01 16:39:04'),('QT1t12eoMw',5,4,15,'kdghu','PDF',4,'2025-09-21','2025-09-22','09:00:00','12:00:00',90,1,'public/uploads/soal/1758544027_LATIHAN SOAL IPA KELAS 7 BAB 2 Materi dan Perubahannya.pdf',NULL,'2025-09-22 19:27:09');
/*!40000 ALTER TABLE `tryout_materi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_nilai`
--

DROP TABLE IF EXISTS `tryout_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_nilai` (
  `tryout_nilai_id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_nilai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_nilai`
--

LOCK TABLES `tryout_nilai` WRITE;
/*!40000 ALTER TABLE `tryout_nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `tryout_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_open_pendaftaran`
--

DROP TABLE IF EXISTS `tryout_open_pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_open_pendaftaran` (
  `top_id` int NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`top_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_open_pendaftaran`
--

LOCK TABLES `tryout_open_pendaftaran` WRITE;
/*!40000 ALTER TABLE `tryout_open_pendaftaran` DISABLE KEYS */;
INSERT INTO `tryout_open_pendaftaran` VALUES (1,15,'farisaizy12@gmail.com','Faris Aizy','SD Indonesia Merdeka','0129380183','fsafasssad','990312129039012','2024-11-21','Bank Transfer','/tmp/phpPeFljC','sadjhkashdasd','Terverifikasi',NULL,'2024-11-22 06:59:17'),(18,3,'faris123@gmail.com','Faris Aizy','SD NEGERI JETIS 1','085600200913','Jhon Doe','0856000200913','2024-12-28','Bank Transfer','uploads/bukti_bayar/1733038212_WhatsApp Image 2023-11-01 at 17.02.40.jpeg','Jhon Doe','Terverifikasi','2024-12-01 07:30:12','2025-09-22 12:17:07'),(19,3,'faris123@gmail.com','Faris Aizy','SD NEGERI JETIS 1','085600200913','Jhon Doe','0856000200913','2024-12-28','Bank Transfer','uploads/bukti_bayar/1733038271_WhatsApp Image 2023-11-01 at 17.02.40.jpeg','Jhon Doe','Pending','2024-12-01 07:31:11','2024-12-01 07:31:11'),(20,3,'ayawwwww3@gmail.com','adinda cintya firdausi','smk','081233374920','zea','081233374920','2025-09-19','Datang Langsung Ke Kantor Cendekia','uploads/bukti_bayar/1758276835_17582768198558896121984039273250.jpg','fia','Pending','2025-09-19 10:13:55','2025-09-19 10:13:55'),(21,3,'ayawwwww3@gmail.com','adinda cintya firdausi','smk','081233374920','zea','081233374920','2025-09-19','Datang Langsung Ke Kantor Cendekia','uploads/bukti_bayar/1758276840_17582768198558896121984039273250.jpg','fia','Pending','2025-09-19 10:14:00','2025-09-19 10:14:00'),(22,3,'ayawwwww3@gmail.com','adinda cintya firdausi','smk','081233374920','zea','081233374920','2025-09-19','Datang Langsung Ke Kantor Cendekia','uploads/bukti_bayar/1758276850_17582768198558896121984039273250.jpg','fia','Pending','2025-09-19 10:14:10','2025-09-19 10:14:10');
/*!40000 ALTER TABLE `tryout_open_pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_pengerjaan`
--

DROP TABLE IF EXISTS `tryout_pengerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_pengerjaan` (
  `tryout_pengerjaan_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_soal_id` int NOT NULL,
  `user_id` int NOT NULL,
  `tryout_jawaban` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Benar','Salah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Salah',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_pengerjaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_pengerjaan`
--

LOCK TABLES `tryout_pengerjaan` WRITE;
/*!40000 ALTER TABLE `tryout_pengerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tryout_pengerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_peserta`
--

DROP TABLE IF EXISTS `tryout_peserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_peserta` (
  `tryout_peserta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `tryout_id` int NOT NULL,
  `tryout_peserta_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_telpon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_peserta_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_peserta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_peserta`
--

LOCK TABLES `tryout_peserta` WRITE;
/*!40000 ALTER TABLE `tryout_peserta` DISABLE KEYS */;
INSERT INTO `tryout_peserta` VALUES (1,17,2,'Faris Aizy','012312312312313','farisaizy123@gmail.com','JL ABCD',1,'2024-11-27 12:45:48','2024-11-27 12:45:48'),(2,17,3,'Faris Aizy','012312312312313','farisaizy123@gmail.com','JL ABCD',1,'2024-12-01 08:43:42','2024-12-01 08:43:42'),(3,17,3,'Faris Aizy','012312312312313','farisaizy123@gmail.com','JL ABCD',1,'2024-12-01 08:43:56','2024-12-01 08:43:56'),(4,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 08:55:22','2024-12-01 08:55:22'),(5,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:00:19','2024-12-01 09:00:19'),(6,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:00:26','2024-12-01 09:00:26'),(7,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:01:14','2024-12-01 09:01:14'),(8,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:01:23','2024-12-01 09:01:23'),(9,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:01:56','2024-12-01 09:01:56'),(10,7,3,'Erwin Pebriari Widiyatmoko','0881080080101','erwinwidiyatmoko@gmail.com','MG II/1039, Brontokusuman, Mergangsan',1,'2024-12-01 09:03:58','2024-12-01 09:03:58'),(11,8,3,'Faris Aizy','085600200913','farisaizy12@gmail.com','Jl ABc',0,'2024-12-01 09:27:43','2024-12-01 09:27:43'),(12,8,1,'Faris Aizy','085600200913','farisaizy12@gmail.com','Jl ABc',1,'2024-12-01 09:28:38','2024-12-01 09:28:38'),(13,19,2,'wawa nasional','0812345678','wawa@gmail.com','jl damaii',1,'2025-09-15 08:47:29','2025-09-15 08:47:29');
/*!40000 ALTER TABLE `tryout_peserta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tryout_soal`
--

DROP TABLE IF EXISTS `tryout_soal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tryout_soal` (
  `tryout_soal_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tryout_materi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tryout_nomor` int NOT NULL,
  `point` int NOT NULL DEFAULT '1',
  `tryout_soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tryout_kunci_jawaban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tryout_penyelesaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tryout_soal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tryout_soal`
--

LOCK TABLES `tryout_soal` WRITE;
/*!40000 ALTER TABLE `tryout_soal` DISABLE KEYS */;
INSERT INTO `tryout_soal` VALUES (1,'Dpo0guZRxz',1,20,'<p> Sebuah muatan listrik 5 C mendapat gaya 30 N dari sebuah muatan yang lain. Besar medan listrik yang dialami muataun itu adalah ... </p>','[\"A\",\"D\"]',NULL,NULL,'2024-12-01 09:45:06'),(2,'Dpo0guZRxz',2,40,'<p><img src=\"/storage/uploads/soal/1733046216_Screenshot 2024-12-01 at 16.43.25.png\" style=\"\" width=\"712\"></p><p>Teks Tambahan</p><ul><li><br></li></ul>','[\"B\"]',NULL,NULL,'2024-12-01 09:45:06'),(3,'Dpo0guZRxz',3,50,'<p> Titik A berada pada jarak 6 cm dari suatu muatan listrik. Jika muatan itu memberkan kuat medan listrik sebesar 106 N/C, berapa besar muatan listriknya? </p>','[\"C\"]',NULL,NULL,'2024-12-01 09:45:06'),(4,'QT1t12eoMw',1,1,'public/uploads/soal/image/soal_1_1758544027.jpg','[\"A\"]','public/uploads/soal/image/jawaban_2_1758544027.jpg',NULL,'2025-09-22 12:32:38'),(5,'QT1t12eoMw',2,1,'public/uploads/soal/image/soal_3_1758544027.jpg','[\"B\"]','public/uploads/soal/image/jawaban_4_1758544028.jpg',NULL,'2025-09-22 12:34:52'),(6,'QT1t12eoMw',3,1,'public/uploads/soal/image/soal_5_1758544028.jpg','[\"A\"]','',NULL,'2025-09-22 12:34:52'),(7,'QT1t12eoMw',1,1,'public/uploads/soal/image/soal_1_1758544027.jpg','[\"C\"]','public/uploads/soal/image/jawaban_2_1758544028.jpg',NULL,'2025-09-22 12:34:52'),(8,'QT1t12eoMw',2,1,'public/uploads/soal/image/soal_3_1758544028.jpg','[\"A\"]','public/uploads/soal/image/jawaban_4_1758544028.jpg',NULL,'2025-09-22 12:34:52'),(9,'QT1t12eoMw',3,1,'public/uploads/soal/image/soal_5_1758544028.jpg','[\"A\"]','',NULL,'2025-09-22 12:33:52');
/*!40000 ALTER TABLE `tryout_soal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_orang_tua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','lms@cendekia.com','085600200913','-','','',NULL,NULL,NULL,NULL,NULL,'2024-10-21 07:04:56','$2y$10$vvQQCpQKsiM7Q0ndQO5Ct.SLBVpAMDFqe.iu8h.reLDmwAQbiuMOi','KJjMsUVlfHNZsaGj97j4N4GgyJ0skgJCD2l6XHONw7kxlwN1ZsfKqtJyQFPA','Aktif',NULL,'2024-10-21 07:04:56','2024-10-21 07:04:56'),(2,'faris home','homefaris2@gmail.com','085600200913','SD Indonesia Merdeka','SD','5','Jl abcd','ksadjkla','100027390138','public/uploads/avatar/1729518291_Screenshot 2024-08-16 at 20.03.27.png',NULL,NULL,'$2y$10$hg51i3SBoO13oCWX/Kf8rukL3hKv0N/uL8xMT2thpYL6LncfQUSeW',NULL,'Aktif',NULL,'2024-10-21 13:44:09','2024-10-21 13:44:51'),(3,'lise tya','jeng.lise@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$de7d.uaBNug5bWu6uICMz.BeB9ZR1Hd3kMCSZ0WPaLToP7CmJOb8W',NULL,'Aktif',NULL,'2024-10-24 05:57:49','2024-10-24 05:57:49'),(4,'Faris Aizy','faris.aizy@sanf.co.id','085600200913','SD Indonesia Merdeka','SD','3','Jl ABC','Orang tua','192381203801',NULL,NULL,NULL,'$2y$10$mFLtnvdn1lX1BZRyH.Hc6u.Aq8ctcn2CPocgClJxnp2mm9AKpbL8y',NULL,'Aktif',NULL,'2024-11-22 02:27:20','2024-11-22 02:29:24'),(5,'Zulfa Aulia','zulfaenaulia@gmail.com','08987264999','smp it abu bakar','SMP','9','yogyakarta','eni diana','081272139500',NULL,NULL,NULL,'$2y$10$n51mjmwOe5pvFvJeeA3X/OWbNm4Z3cwdxJDsYFmGwihVKkGWE3onG',NULL,'Aktif',NULL,'2024-11-27 07:47:02','2024-11-27 07:48:31'),(6,'SISWA ZULFA NUR AULIA','lbbcdoc3@gmail.com','08987264999','SMP IT ABU BAKAR','SMP','9','KENARI, YOGYAKARTA','ENI DIANA','087839379500',NULL,NULL,NULL,'$2y$10$VW3gWFEHq/WQFkbyZmo2be7JKnXoVykZR1chEh22iwpYNPQugjoL6',NULL,'Aktif',NULL,'2024-11-27 08:02:20','2024-11-27 08:02:20'),(7,'Erwin Pebriari Widiyatmoko','erwinwidiyatmoko@gmail.com','0881080080101','SMP MUHAMMADIYAH 9 YOGYAKARTA','SD','6','MG II/1039, Brontokusuman, Mergangsan','PANDA','123123','public/uploads/avatar/1732698886_Screenshot 2024-07-12 223504.png',NULL,NULL,'$2y$10$OxHf9L/rKir087jF4VgjxuC7NHlcaBI8ydntbT5ZTFKaCIrqtXoGu',NULL,'Aktif',NULL,'2024-11-27 08:14:17','2024-11-27 09:14:46'),(8,'Faris Aizy','farisaizy12@gmail.com','085600200913','SD Indonesia Merdeka','SD','5','Jl ABc','Test','9021830912830','public/uploads/avatar/1732698688_Screenshot 2024-06-27 215605.png',NULL,NULL,'$2y$10$TGwGBLBKFEvJluTvXw2IP.WFUKffqErHU4VC.dODSZ/lpAPO3wagi',NULL,'Aktif',NULL,'2024-11-27 09:10:58','2024-11-27 09:11:28'),(14,'Super Admin','admin@cendekia.com','085600200913','-','','',NULL,NULL,NULL,NULL,NULL,'2024-11-27 12:14:15','$2y$10$.6poepR7Lj0AD3GjMiyl3ezkmgOBTy2CXeOAJiC/QV9pwcR9Rd5Oy','NstmxmbmDYihsZ19LBHgvGnvva45Auh0qCIn7xWftxxMaY54HXbpFHQDzwPW','Aktif',NULL,'2024-11-27 12:14:15','2024-11-27 12:14:15'),(15,'Faris Aizy','faris.aizy2@sanf.co.id','085600200913','-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$9.0bkMJrlzrr2GUgvcvAuuokJQEDcYdw4mmo11aF2fhe646emd4M.',NULL,'Aktif',NULL,'2024-11-27 12:20:55','2024-11-27 12:20:55'),(17,'Faris Aizy','farisaizy123@gmail.com','012312312312313','SD NEGERI JETIS 1','SMP','8','JL ABCD','Jhon Doe','0812345678989','public/uploads/avatar/1732711540_Screenshot 2024-11-27 194130.png',NULL,NULL,'$2y$10$ojD4qcvpa9gpsQvdkPdpG.z.NY150tOdyK8HNH9ILSG83PpiJzqKi',NULL,'Aktif',NULL,'2024-11-27 12:45:40','2024-11-27 12:45:40'),(18,'Test Pengajar 1','pengajar1@gmail.com','085600913','SD MUHAMMADIYAH BAUSASRAN 1',NULL,NULL,NULL,NULL,NULL,'public/uploads/avatar/1733042407_Screenshot 2024-07-11 at 15.26.43.png',NULL,NULL,'$2y$10$UOBDX8Nzw1/.OniyOVruPeOilp4qcz/BcrGUEgd66lLJnel1Np2x.',NULL,'Aktif',NULL,'2024-12-01 08:40:07','2024-12-01 08:40:07'),(19,'wawa nasional','wawa@gmail.com','0812345678','SMP 9 Yogyakarta','SMP','9','jl damaii','yaya','0812345',NULL,NULL,NULL,'$2y$10$IVGJwvsWuN0t3qZV0n1OxO7eQ6wuVPeAvlzlidh3hh5OS/d2UPcz.',NULL,'Aktif',NULL,'2025-09-15 08:40:34','2025-09-15 08:40:34'),(20,'forgpt team','forgptteam@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$DojhQ5V3fiUTPRQqI7ApBe3L9lEgl6hSL6i8g5eZ7lnXMtTrFetuC',NULL,'Aktif',NULL,'2025-09-22 01:28:50','2025-09-22 01:28:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-23  9:38:58
