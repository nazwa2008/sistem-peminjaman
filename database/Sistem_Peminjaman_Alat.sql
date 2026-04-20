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


-- Dumping database structure for sistem_peminjaman_alat
CREATE DATABASE IF NOT EXISTS `sistem_peminjaman_alat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistem_peminjaman_alat`;

-- Dumping structure for table sistem_peminjaman_alat.alat
CREATE TABLE IF NOT EXISTS `alat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` bigint unsigned DEFAULT NULL,
  `kondisi` enum('baik','rusak') COLLATE utf8mb4_unicode_ci DEFAULT 'baik',
  `stok_total` int NOT NULL DEFAULT '0',
  `stok_baik` int NOT NULL DEFAULT '0',
  `stok_rusak` int NOT NULL DEFAULT '0',
  `stok_tersedia` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alat_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `alat_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.alat: ~11 rows (approximately)
INSERT INTO `alat` (`id`, `nama_alat`, `kode_barang`, `kategori_id`, `kondisi`, `stok_total`, `stok_baik`, `stok_rusak`, `stok_tersedia`, `created_at`, `updated_at`) VALUES
	(2, 'Mic Wireless Shure', 'ELK-001', 1, 'baik', 10, 8, 2, 8, '2026-04-10 22:08:50', '2026-04-19 18:37:25'),
	(4, 'Kursi Lipat Chitose', 'LAI-001', 2, 'baik', 10, 10, 0, 10, '2026-04-10 22:08:50', '2026-04-14 05:59:47'),
	(5, 'Kamera Canon EOS 80D', 'ELK-002', 1, 'baik', 10, 10, 0, 10, '2026-04-10 22:08:50', '2026-04-14 06:00:11'),
	(6, 'camera canon', 'ELK-003', 1, 'baik', 10, 10, 0, 10, '2026-04-10 22:32:14', '2026-04-19 07:11:28'),
	(7, 'kipas', 'LAI-002', 2, 'baik', 10, 10, 0, 10, '2026-04-12 18:13:38', '2026-04-19 07:11:01'),
	(8, 'meja', 'LAI-003', 2, 'baik', 10, 9, 1, 9, '2026-04-13 00:33:42', '2026-04-16 18:56:54'),
	(10, 'laptop asus', 'ELK-004', 1, 'baik', 10, 10, 0, 10, '2026-04-13 20:45:46', '2026-04-16 17:58:56'),
	(12, 'camera proyektor', 'ELK-005', 1, 'baik', 10, 9, 1, 9, '2026-04-14 02:42:28', '2026-04-19 07:11:15'),
	(13, 'hp samsung', 'ELK-006', 1, 'baik', 10, 10, 0, 10, '2026-04-14 05:43:42', '2026-04-14 05:43:42'),
	(14, 'laptop asus', 'ELK-007', 1, 'baik', 10, 10, 0, 10, '2026-04-14 07:01:53', '2026-04-14 07:01:53');

-- Dumping structure for table sistem_peminjaman_alat.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.cache: ~11 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-alpariji ganteng|127.0.0.1', 'i:1;', 1776387763),
	('laravel-cache-alpariji ganteng|127.0.0.1:timer', 'i:1776387763;', 1776387763),
	('laravel-cache-alva@sipa.com|127.0.0.1', 'i:2;', 1776387806),
	('laravel-cache-alva@sipa.com|127.0.0.1:timer', 'i:1776387806;', 1776387806),
	('laravel-cache-ayu@sipa.com|127.0.0.1', 'i:1;', 1776131274),
	('laravel-cache-ayu@sipa.com|127.0.0.1:timer', 'i:1776131274;', 1776131274),
	('laravel-cache-putra@sipa.com|127.0.0.1', 'i:1;', 1776152642),
	('laravel-cache-putra@sipa.com|127.0.0.1:timer', 'i:1776152642;', 1776152642),
	('laravel-cache-sriayuu@sipa.com|127.0.0.1', 'i:1;', 1776152568),
	('laravel-cache-sriayuu@sipa.com|127.0.0.1:timer', 'i:1776152568;', 1776152568),
	('laravel-cache-sriayuuu@sipa.com|127.0.0.1', 'i:2;', 1776152557),
	('laravel-cache-sriayuuu@sipa.com|127.0.0.1:timer', 'i:1776152557;', 1776152557);

-- Dumping structure for table sistem_peminjaman_alat.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.cache_locks: ~0 rows (approximately)

-- Dumping structure for table sistem_peminjaman_alat.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategori` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_kode_kategori_unique` (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `nama_kategori`, `kode_kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Elektronik', 'ELK', '2026-04-14 03:53:23', '2026-04-14 03:53:23'),
	(2, 'Lainnya', 'LAI', '2026-04-14 03:53:23', '2026-04-14 03:53:23');

-- Dumping structure for table sistem_peminjaman_alat.failed_jobs
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

-- Dumping data for table sistem_peminjaman_alat.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sistem_peminjaman_alat.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.jobs: ~0 rows (approximately)

-- Dumping structure for table sistem_peminjaman_alat.job_batches
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

-- Dumping data for table sistem_peminjaman_alat.job_batches: ~0 rows (approximately)

-- Dumping structure for table sistem_peminjaman_alat.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.migrations: ~15 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_04_09_000004_create_alat_table', 1),
	(5, '2026_04_09_000005_create_peminjaman_table', 1),
	(6, '2026_04_09_000006_create_peminjaman_detail_table', 1),
	(7, '2026_04_14_002454_add_username_to_users_table', 2),
	(8, '2026_04_14_002521_add_officer_tracking_to_tables', 3),
	(9, '2026_04_14_013325_rename_user_id_to_peminjam_id_in_peminjaman_table', 4),
	(10, '2026_04_14_015620_add_nama_peminjam_to_peminjaman_table', 5),
	(11, '2026_04_14_022238_add_alasan_denda_to_peminjaman_detail_table', 6),
	(12, '2026_04_14_062951_add_keterangan_denda_to_peminjaman_detail_table', 7),
	(13, '2026_04_14_092518_update_struktur_tabel_alat', 8),
	(14, '2026_04_14_105151_create_categories_table', 9),
	(15, '2026_04_14_105213_update_alat_table_for_categories', 9),
	(16, '2026_04_14_134021_simplify_alat_stock_fields', 10),
	(17, '2026_04_16_000001_rename_peminjam_id_to_user_id_in_peminjaman_table', 11),
	(18, '2026_04_20_013450_update_kondisi_akhir_in_peminjaman_detail_table', 11),
	(19, '2026_04_20_013500_update_kondisi_akhir_in_peminjaman_detail_table', 11);

-- Dumping structure for table sistem_peminjaman_alat.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table sistem_peminjaman_alat.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas_id` bigint unsigned DEFAULT NULL,
  `approver_id` bigint unsigned DEFAULT NULL,
  `kode_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('pending','disetujui','ditolak','dipinjam','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `alasan_penolakan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peminjaman_kode_peminjaman_unique` (`kode_peminjaman`),
  KEY `peminjaman_petugas_id_foreign` (`petugas_id`),
  KEY `peminjaman_approver_id_foreign` (`approver_id`),
  KEY `peminjaman_user_id_foreign` (`user_id`),
  CONSTRAINT `peminjaman_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peminjaman_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.peminjaman: ~19 rows (approximately)
INSERT INTO `peminjaman` (`id`, `user_id`, `nama_peminjam`, `petugas_id`, `approver_id`, `kode_peminjaman`, `tanggal_pengajuan`, `status`, `alasan_penolakan`, `created_at`, `updated_at`) VALUES
	(5, 3, 'Sri Ayu', NULL, 2, 'PJ-1776132338', '2026-04-14', 'selesai', NULL, '2026-04-13 19:05:38', '2026-04-13 19:08:45'),
	(6, 3, 'lemon', NULL, 2, 'PJ-1776138806', '2026-04-14', 'selesai', NULL, '2026-04-13 20:53:26', '2026-04-13 20:54:10'),
	(7, 3, 'nanda lemon', NULL, 2, 'PJ-1776150203', '2026-04-14', 'selesai', NULL, '2026-04-14 00:03:23', '2026-04-16 18:51:01'),
	(8, 3, 'nanda lemon', NULL, 2, 'PJ-1776150204', '2026-04-14', 'selesai', NULL, '2026-04-14 00:03:24', '2026-04-14 00:04:00'),
	(9, 3, 'lemon ndin', NULL, 2, 'PJ-1776159888', '2026-04-14', 'selesai', NULL, '2026-04-14 02:44:48', '2026-04-14 02:45:48'),
	(10, 3, 'saputra', NULL, 2, 'PJ-1776174757', '2026-04-14', 'selesai', NULL, '2026-04-14 06:52:37', '2026-04-14 07:00:00'),
	(12, 3, 'alifahtusadiah', NULL, 2, 'PJ-1776306885', '2026-04-16', 'selesai', NULL, '2026-04-15 19:34:45', '2026-04-16 18:49:34'),
	(13, 3, 'nazwa shifa', NULL, 2, 'PJ-1776307631', '2026-04-16', 'selesai', NULL, '2026-04-15 19:47:11', '2026-04-16 17:52:26'),
	(14, 3, 'awa', NULL, 2, 'PJ-1776309704', '2026-04-16', 'selesai', NULL, '2026-04-15 20:21:44', '2026-04-15 20:30:06'),
	(18, 3, 'alpa', NULL, 2, 'PJ-1776387231', '2026-04-17', 'selesai', NULL, '2026-04-16 17:53:51', '2026-04-16 17:54:31'),
	(19, 3, 'alpariji', NULL, 2, 'PJ-1776387516', '2026-04-17', 'selesai', NULL, '2026-04-16 17:58:36', '2026-04-16 17:58:56'),
	(20, 3, 'Sevia', NULL, 2, 'PJ-1776613176', '2026-04-19', 'selesai', NULL, '2026-04-19 08:39:36', '2026-04-19 18:37:25');

-- Dumping structure for table sistem_peminjaman_alat.peminjaman_detail
CREATE TABLE IF NOT EXISTS `peminjaman_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `peminjaman_id` bigint unsigned NOT NULL,
  `alat_id` bigint unsigned NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `kondisi_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `keterangan_denda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alasan_denda` enum('terlambat','rusak','hilang') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_item` enum('dipinjam','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dipinjam',
  `returned_by_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peminjaman_detail_peminjaman_id_foreign` (`peminjaman_id`),
  KEY `peminjaman_detail_alat_id_foreign` (`alat_id`),
  KEY `peminjaman_detail_returned_by_id_foreign` (`returned_by_id`),
  CONSTRAINT `peminjaman_detail_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjaman_detail_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjaman_detail_returned_by_id_foreign` FOREIGN KEY (`returned_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.peminjaman_detail: ~12 rows (approximately)
INSERT INTO `peminjaman_detail` (`id`, `peminjaman_id`, `alat_id`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_pengembalian`, `kondisi_akhir`, `denda`, `keterangan_denda`, `alasan_denda`, `status_item`, `returned_by_id`, `created_at`, `updated_at`) VALUES
	(7, 7, 6, '2026-04-14', '2026-04-14', '2026-04-17', 'Baik', -15000.00, '', NULL, 'dikembalikan', 2, '2026-04-14 00:03:23', '2026-04-16 18:51:01'),
	(8, 8, 6, '2026-04-14', '2026-04-14', '2026-04-14', 'Rusak', 3527.76, 'Keterlambatan (-0.29444729962963 Hari) & Kerusakan', 'rusak', 'dikembalikan', 2, '2026-04-14 00:03:24', '2026-04-14 00:04:00'),
	(9, 9, 12, '2026-04-14', '2026-04-14', '2026-04-14', 'Rusak', 2965.94, 'Keterlambatan (-0.40681240966435 Hari) & Kerusakan', 'rusak', 'dikembalikan', 2, '2026-04-14 02:44:48', '2026-04-14 02:45:48'),
	(10, 10, 2, '2026-04-14', '2026-04-14', '2026-04-14', 'Rusak', 2083.31, 'Keterlambatan (-0.58333825224537 Hari) & Kerusakan', 'rusak', 'dikembalikan', 2, '2026-04-14 06:52:37', '2026-04-14 07:00:00'),
	(12, 12, 2, '2026-04-16', '2026-04-16', '2026-04-17', 'Baik', -5000.00, '', NULL, 'dikembalikan', 2, '2026-04-15 19:34:45', '2026-04-16 18:49:34'),
	(13, 13, 2, '2026-04-16', '2026-04-16', '2026-04-17', 'Rusak', 0.00, 'Kerusakan Alat: Rp 5.000', 'rusak', 'dikembalikan', 1, '2026-04-15 19:47:11', '2026-04-16 17:52:26'),
	(14, 14, 2, '2026-04-16', '2026-04-16', '2026-04-16', 'Baik', -729.54, NULL, NULL, 'dikembalikan', 2, '2026-04-15 20:21:44', '2026-04-15 20:30:06'),
	(18, 18, 2, '2026-04-17', '2026-04-17', '2026-04-17', 'Hilang', 50000.00, 'Kehilangan Alat: Rp 50.000', 'hilang', 'dikembalikan', 2, '2026-04-16 17:53:51', '2026-04-16 17:54:31'),
	(19, 19, 10, '2026-04-17', '2026-04-17', '2026-04-17', 'Baik', 0.00, '', NULL, 'dikembalikan', 2, '2026-04-16 17:58:36', '2026-04-16 17:58:56'),
	(20, 20, 2, '2026-04-19', '2026-04-19', '2026-04-20', 'Telat', 25000.00, 'Keterlambatan (5 Hari): Rp 25.000', NULL, 'dikembalikan', 2, '2026-04-19 08:39:36', '2026-04-19 18:37:25');

-- Dumping structure for table sistem_peminjaman_alat.sessions
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

-- Dumping data for table sistem_peminjaman_alat.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Y6X2jHOFRyMaIzBFaPXU1HTzppTIQxsrGGSoJlAY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiI1Y2JCN0dGRHdvUkw0dnhTVzJ4WmtBWFpVVVM4RzJxZTc4UVhad1NrIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2lzdGVtcGVtaW5qYW1hbmFsYXQudGVzdFwvZGFzaGJvYXJkIiwicm91dGUiOiJkYXNoYm9hcmQifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1776649453);

-- Dumping structure for table sistem_peminjaman_alat.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','peminjam') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peminjam',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sistem_peminjaman_alat.users: ~11 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Sipa', 'admin@sipa.com', NULL, NULL, '$2y$12$LTLneJ05XwT38/cEYdLckuLsErEtjP1Ak39Z.O9.7Hw.VMS2rWaUC', 'admin', NULL, '2026-04-10 22:08:48', '2026-04-10 22:08:48'),
	(2, 'Petugas Jaga', 'petugas@sipa.com', NULL, NULL, '$2y$12$PVZLmHu5I63WoyznaiKJVuj7/AWj0mVzR145aiqfm5KVB8gbnSHTC', 'petugas', NULL, '2026-04-10 22:08:49', '2026-04-10 22:08:49'),
	(3, 'Peminjam', 'peminjam@sipa.com', NULL, NULL, '$2y$12$SvYxOn02Ars2PywnKkRTy.j.7brSxOEzK6WrXVbbl9rA8qefNmGGq', 'peminjam', NULL, '2026-04-10 22:08:49', '2026-04-10 22:08:49'),
	(4, 'Siti Peminjam', 'siti@sipa.com', NULL, NULL, '$2y$12$1vyL1svJAnaq0GAcQ7Rdxu2kNcqEFw2tvM5U/JZ6KZJLvFAaRhXCm', 'peminjam', NULL, '2026-04-10 22:08:50', '2026-04-10 22:08:50'),
	(5, 'nazwa shifa', 'awa@sipa.com', 'awa@sipa.com', NULL, '$2y$12$T/nGtxaSPKBD1FqTKO70..lRmqSxWB.W3xBy3jBjeWGd33WoKoAu6', 'petugas', NULL, '2026-04-13 17:57:30', '2026-04-13 17:57:30'),
	(6, 'syifa', 'syifa@sipa.com', 'syifa@sipa.com', NULL, '$2y$12$Y5Jc0P036wAxhhWLA0J3Yuzd8fFwGDVbd53bm7rOYqfDf0g3UWH/y', 'petugas', NULL, '2026-04-13 22:31:00', '2026-04-13 22:31:00'),
	(7, 'alifah', 'alifah@sipa.com', 'alifah@sipa.com', NULL, '$2y$12$MMJRhdZ4EtxoxPKln2GyVey.cuyrCv/sCQSN5FnALmrVvD6gIY0Du', 'petugas', NULL, '2026-04-13 22:32:36', '2026-04-13 22:32:36'),
	(8, 'syifa', 'petugas1@sipa.com', NULL, NULL, '$2y$12$dPQVnWgpKP3hdiAc7WFABOfdURU5gBbvQU307fj7L7wFuZb4/m47a', 'peminjam', NULL, '2026-04-13 22:38:58', '2026-04-13 22:38:58'),
	(9, 'putra', 'petugas2@sipa.com', 'putra@gmail.com', NULL, '$2y$12$Ah9mJuspRJUOpArxbsqSs.K98ieu1PU7FagviYxs1aKSzMwYCfoou', 'petugas', NULL, '2026-04-13 23:00:55', '2026-04-13 23:00:55'),
	(10, 'sriayuuu', 'sriayu@sipa.com', 'sriayu@sipa.com', NULL, '$2y$12$hk80CfCv5gcIfDzDiFyPFOvqYMy8oOX5K6Zlp56CnHPZaMdj3mJui', 'petugas', NULL, '2026-04-14 00:41:11', '2026-04-14 00:41:11'),
	(11, 'awaaa', 'awaaa@gmail.com', 'awaaa@gmail.com', NULL, '$2y$12$efhNtbzDEam6vP7YmgzOxO868UOtd6.y2EO4kTc9ElFM/eSHlRoNC', 'petugas', NULL, '2026-04-14 00:44:27', '2026-04-14 00:44:27'),
	(13, 'alpariji ganteng', 'alva@gmail.com', 'alva@sipa.com', NULL, '$2y$12$pUeAO/neP.ZtQrRavD9nBuA3foP3bU6wuAQwD5BpQXbl8uLLKMhOS', 'petugas', NULL, '2026-04-16 18:01:26', '2026-04-16 18:01:26');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
