-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laravel.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.cache: ~0 rows (approximately)

-- Dumping structure for table laravel.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.cache_locks: ~0 rows (approximately)

-- Dumping structure for table laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table laravel.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.jobs: ~0 rows (approximately)

-- Dumping structure for table laravel.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.job_batches: ~0 rows (approximately)

-- Dumping structure for table laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_05_13_064611_create_surats_table', 1),
	(5, '2026_05_21_033039_create_rkas_table', 1),
	(6, '2026_05_21_033040_create_transaksi_kartu_kendalis_table', 1),
	(7, '2026_07_14_023136_remove_bukti_from_transaksi_kartu_kendalis_table', 2),
	(8, '2026_07_19_085057_add_file_pdf_to_surats_table', 3),
	(9, '2026_07_20_080121_add_rka_id_to_transaksi_kartu_kendalis_table', 4);

-- Dumping structure for table laravel.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table laravel.rkas
CREATE TABLE IF NOT EXISTS `rkas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagu` bigint NOT NULL,
  `sisa` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.rkas: ~18 rows (approximately)
INSERT INTO `rkas` (`id`, `kode`, `nama`, `program`, `kegiatan`, `sub_kegiatan`, `pagu`, `sisa`, `created_at`, `updated_at`) VALUES
	(1, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.02 Penelitian dan Pengembangan Bidang Sosial dan Kependudukan', '5.05.02.2.02.0001 Penelitian dan Pengembangan Bidang Aspek Aspek Sosial', 26000000, 26000000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(2, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.02 Penelitian dan Pengembangan Bidang Sosial dan Kependudukan', '5.05.02.2.02.0001 Penelitian dan Pengembangan Bidang Aspek Aspek Sosial', 18300000, 12900000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(3, '5.1.02.02.001.00003', 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.02 Penelitian dan Pengembangan Bidang Sosial dan Kependudukan', '5.05.02.2.02.0001 Penelitian dan Pengembangan Bidang Aspek Aspek Sosial', 4000000, 2100000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(4, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor- Bahan Cetak', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.04 Pengembangan Inovasi dan Teknologi', '5.05.02.2.04.0004 Sosialisasi dan Diseminasi Hasil-Hasil Kelitbangan', 13000000, 13000000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(5, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.04 Pengembangan Inovasi dan Teknologi', '5.05.02.2.04.0004 Sosialisasi dan Diseminasi Hasil-Hasil Kelitbangan', 15250000, 15250000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(6, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0018 Bimbingan teknis dan supervisi, kerja sama, serta kemitraan invensi dan inovasi', 2000000, 2000000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(7, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0018 Bimbingan teknis dan supervisi, kerja sama, serta kemitraan invensi dan inovasi', 45750000, 8775000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(8, '5.1.02.02.001.00003', 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0018 Bimbingan teknis dan supervisi, kerja sama, serta kemitraan invensi dan inovasi', 13500000, 1500000, '2026-07-20 01:19:47', '2026-07-20 01:34:11'),
	(9, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0012 Fasilitasi dan pembinaan untuk apresiasi prestasi Inovasi', 9625000, 9625000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(10, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0012 Fasilitasi dan pembinaan untuk apresiasi prestasi Inovasi', 45750000, 45750000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(11, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual', 5600000, 5600000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(12, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual', 18300000, 11100000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(13, '5.1.02.02.001.00067', 'Belanja Pembayaran Pajak, Bea, dan Perizinan', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual', 35000000, 32350000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(14, '5.1.02.02.001.00015', 'Belanja Jasa Tenaga Laboratorium', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual', 17100000, 6951000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(15, '5.1.02.02.001.00003', 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual', 26000000, 8000000, '2026-07-20 01:19:47', '2026-07-20 01:27:38'),
	(16, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor- Bahan Cetak', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0003 Fasilitasi dan pembinaan untuk penyelenggaraan pengembangan klaster Inovasi berbasis produk unggulan daerah daerah', 3225000, 3225000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(17, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.03 PROGRAM RISET DAN INOVASI DAERAH', '5.05.03.2.02 Invensi dan Inovasi', '5.05.03.2.02.0003 Fasilitasi dan pembinaan untuk penyelenggaraan pengembangan klaster Inovasi berbasis produk unggulan daerah daerah', 18300000, 18300000, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(18, '5.1.02.01.001.00026', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.01 Penelitian dan Pengembangan Bidang Penyelenggaraan Pemerintahan dan Pengkajian Peraturan', '5.05.02.2.01.0002 Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 0, 0, '2026-07-20 01:19:47', '2026-07-20 01:19:47'),
	(19, '5.1.02.01.001.00052', 'Belanja Makanan dan Minuman Rapat', '5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH', '5.05.02.2.01 Penelitian dan Pengembangan Bidang Penyelenggaraan Pemerintahan dan Pengkajian Peraturan', '5.05.02.2.01.0002 Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum', 6100000, 6100000, '2026-07-20 01:19:47', '2026-07-20 01:19:47');

-- Dumping structure for table laravel.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.sessions: ~3 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('AEOSUWdVN2J7zplDMeb3o0whifmy9t9DMdkNc0un', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJxUDc1R0Q5bkFicHlsbmdhMW83STk0UWJydkhJRzdyQktHTm9HMVM5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rYXJ0dS1rZW5kYWxpIiwicm91dGUiOiJrYXJ0dWtlbmRhbGkuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTN9', 1784541306),
	('FZWgIRvWiqWeBO2kVowq7ELVK7p6rzgKr4U5bfJ7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkeWthVWxCTFFMSXpmUDE1Z2JhYU9NVEphdGxnd05SR0NTandPeUVCIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1784544766);

-- Dumping structure for table laravel.surats
CREATE TABLE IF NOT EXISTS `surats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Masuk','Keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.surats: ~2 rows (approximately)
INSERT INTO `surats` (`id`, `nomor_surat`, `perihal`, `tanggal_surat`, `pengirim`, `status`, `file_pdf`, `created_at`, `updated_at`) VALUES
	(10, '000.9.2/21414-Litbang/Bappelitbang/2026', 'Pemberitahuan Nobar PILDUN', '2026-07-08', 'Bappelitbang', 'Keluar', NULL, '2026-07-19 00:56:18', '2026-07-19 00:56:18'),
	(11, '000.9.2/877-Litbang/Bappelitbang/2026', 'Pemberitahuan nobar pildun', '2026-07-16', 'Bappelitbang', 'Keluar', 'uploads/surat/1784451490_Surat Keluar Biasa - Pemberitahuan nobar pildun.pdf', '2026-07-19 00:57:42', '2026-07-19 00:58:10');

-- Dumping structure for table laravel.transaksi_kartu_kendalis
CREATE TABLE IF NOT EXISTS `transaksi_kartu_kendalis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rka_id` bigint unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` bigint NOT NULL,
  `sisa_akhir` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.transaksi_kartu_kendalis: ~16 rows (approximately)
INSERT INTO `transaksi_kartu_kendalis` (`id`, `rka_id`, `tanggal`, `kode`, `uraian`, `jumlah`, `sisa_akhir`, `created_at`, `updated_at`) VALUES
	(1, 2, '2026-07-14', '5.1.02.01.001.00052', 'Pembayaran makan minum kegiatan KAJIAN PAD', 1200000, 17100000, '2026-07-13 19:24:22', '2026-07-20 00:04:03'),
	(2, 2, '2026-07-14', '5.1.02.01.001.00052', 'Pembayaran Makan Minum Expose laporan awal KAJIAN PAD', 4200000, 12900000, '2026-07-13 19:24:42', '2026-07-20 00:04:03'),
	(3, 3, '2026-07-14', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kajian PAD', 1400000, 2600000, '2026-07-13 19:25:50', '2026-07-20 00:04:03'),
	(4, 3, '2026-07-14', '5.1.02.02.001.00003', 'Pembayaran Moderator Kajian PAD', 500000, 2100000, '2026-07-13 19:26:10', '2026-07-20 00:04:03'),
	(5, 12, '2026-02-24', '5.1.02.01.001.00052', 'Pembayaran makan minum kegiatan pendampingan kunjungan lapangan Tim Ahli Indikasi Geografis di Kec. Lokpaikat & Kec. Hatungun', 4200000, 14100000, '2026-07-14 00:32:34', '2026-07-20 01:27:38'),
	(6, 12, '2026-02-25', '5.1.02.01.001.00052', 'Pembayaran makan minum Kegiatan diskusi hasil kunjungan lapangan dalam rangka pendaftaran Indikasi Geografis Kopi Tapin', 3000000, 11100000, '2026-07-14 00:33:11', '2026-07-20 01:27:38'),
	(7, 7, '2026-07-02', '5.1.02.01.001.00052', 'Kegiatan Verifikasi dan Validasi Inovasi Daerah', 36975000, 8775000, '2026-07-19 18:51:19', '2026-07-20 00:04:03'),
	(9, 13, '2026-07-13', '5.1.02.02.001.00067', 'Pembayaran Hak Cipta', 2650000, 32350000, '2026-07-19 20:35:11', '2026-07-20 01:27:38'),
	(10, 14, '2026-07-20', '5.1.02.02.001.00015', 'Pembayaran Uji Laboratorium', 1047000, 16053000, '2026-07-19 20:50:02', '2026-07-20 01:27:38'),
	(11, 14, '2026-07-20', '5.1.02.02.001.00015', 'Pembayaran Uji Laboratorium Citarasa Kopi Excelsa', 9102000, 6951000, '2026-07-19 20:50:24', '2026-07-20 01:27:38'),
	(12, 15, '2026-07-20', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Tindak Lanjut Penyusunan Dokumen IG Kopi Wilayah Kab. Tapin', 3000000, 14000000, '2026-07-19 23:31:21', '2026-07-20 01:27:39'),
	(13, 15, '2026-07-20', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Tindak Lanjut Penyusunan Dokumen IG Kopi Wilayah Kab. Tapin', 3000000, 11000000, '2026-07-19 23:31:43', '2026-07-20 01:27:39'),
	(14, 15, '2026-07-20', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Tindak Lanjut Penyusunan Dokumen IG Kopi Wilayah Kab. Tapin', 3000000, 8000000, '2026-07-19 23:32:03', '2026-07-20 01:27:39'),
	(15, 15, '2026-06-15', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Koordinasi Penyempurnaan Dokumen IG Kopi Kab. Tapin, 15 Juni 2026', 3000000, 23000000, '2026-07-19 23:32:33', '2026-07-20 01:27:39'),
	(16, 15, '2026-06-15', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Koordinasi Penyempurnaan Dokumen IG Kopi Kab. Tapin, 15 Juni 2026', 3000000, 20000000, '2026-07-19 23:32:51', '2026-07-20 01:27:39'),
	(17, 15, '2026-06-15', '5.1.02.02.001.00003', 'Pembayaran Narasumber Kegiatan Koordinasi Penyempurnaan Dokumen IG Kopi Kab. Tapin, 15 Juni 2026', 3000000, 17000000, '2026-07-19 23:33:08', '2026-07-20 01:27:39');

-- Dumping structure for table laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Bidang Litbang', 'litbang', 'user', 'litbang@gmail.com', NULL, '$2y$12$6epseFGCaOhjfQAEpkfb9OOFU1NdcLBROeDABPeeGhb9pVOyrdCOW', 'V660V1jKb7nlzf9GoHsJKYE03fbnAZRlswuYcQOBF9h5P4MR2bzURibo4Xvf', '2026-06-23 18:01:09', '2026-07-08 01:54:32'),
	(3, 'ADMIN AGUS JAWA', 'agusjawa', 'developer', 'agusjawa@gmail.com', NULL, '$2y$12$o1BzE/NYpOVq6JaesxVx3OFM9Tsqsuy5ZapcwL2hyeYCrbUkdtX7q', '82fKv0O8us0isDTAnnqzCtHhHHlNkkemYqE8gp6hPu9SLh5H6z8D8ai2T5o6', '2026-07-08 01:54:10', '2026-07-08 02:00:36'),
	(4, 'Ahmad Fikri Ramadhani, S.A.B.', 'fikri', 'user', 'fikrigaming@gmail.com', NULL, '$2y$12$kioN/kV12qmhRPIGGxM6/uZa.gYXZi1QNhjEXPfT0ZdLSkJ4mGN86', NULL, '2026-07-08 17:03:03', '2026-07-08 17:03:03'),
	(11, 'ANISSA MAULIDA, M.H.', 'nisa', 'user', 'anissamaulida11@gmail.com', NULL, '$2y$12$Rpiy0ZqLAKSd3b3W4Bn15uZMMNeHSMOKkdc7o8CLVTBdiq8RXqz7m', NULL, '2026-07-13 18:00:41', '2026-07-13 18:00:51'),
	(12, 'Nurul Adha Aprilia, S.Pd', 'adha', 'user', 'adha@gmail.com', NULL, '$2y$12$jj4hi0fskzqGYxoi.jR6/ufUQ9szCJ7mGTkZLXzRG7l3y2L18Ms7m', 'CpeqVQ5diyVU6nMVRPhn1Iisrh84kSn80cXMpsnwezyyglvAohTAB65j0hln', '2026-07-13 18:09:10', '2026-07-13 18:09:10'),
	(13, 'Raihan Khairi, S.Kom.', 'raihan', 'user', 'raihangamming@gmail.com', NULL, '$2y$12$.LbrIlVYCr2BFOVCUa1DKuTT7wib2mGCG9eqVY2yqZwJREmKUkTq6', NULL, '2026-07-13 18:09:37', '2026-07-19 01:09:04'),
	(14, 'Ibnu Muhammad', 'ibnu', 'developer', 'ibnuvdk@gmail.com', NULL, '$2y$12$ouhfAAePA72cp2VVPD2APOzOjE2kC9wZ1fYJIirseZ95mExtiVoXa', NULL, '2026-07-19 01:25:56', '2026-07-19 01:25:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
