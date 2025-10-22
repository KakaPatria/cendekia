-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 03:23 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  ADD PRIMARY KEY (`tryout_pengerjaan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tryout_pengerjaan`
--
ALTER TABLE `tryout_pengerjaan`
  MODIFY `tryout_pengerjaan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
