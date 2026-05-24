-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2026 at 07:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_nilai_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jurusan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `kode_jurusan`, `nama_jurusan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TI', 'TEKNIK INFORMATIKA', 'TEKNIK', '2025-12-25 04:16:05', '2025-12-25 04:16:05'),
(2, 'SI', 'SISTEM INFORMASI', NULL, '2025-12-25 04:16:20', '2025-12-25 04:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nim`, `nama`, `jurusan_id`, `alamat`, `email`, `telepon`, `jenis_kelamin`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'aris prasetyo', 1, 'Bekasi', 'arispras@gmail.com', '081387373939', 'L', '2025-12-25', '2025-12-25 04:17:11', '2025-12-25 04:17:11'),
(2, '001', 'asep', 2, 'Bekasi', 'asep@gmail.com', '081387373939', 'L', '2025-12-02', '2025-12-25 04:17:38', '2025-12-25 04:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliahs`
--

CREATE TABLE `mata_kuliahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `semester` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_kuliahs`
--

INSERT INTO `mata_kuliahs` (`id`, `kode_mk`, `nama_mk`, `sks`, `jurusan_id`, `semester`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'P01', 'PEMROGRAMAN I', 3, 1, 2, NULL, '2025-12-25 04:16:42', '2025-12-25 04:16:42'),
(2, 'P02', 'PEMROGRAMAN WEB', 2, 2, 3, NULL, '2025-12-25 04:18:08', '2025-12-25 04:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_25_085858_create_jurusans_table', 1),
(6, '2025_12_25_085903_create_mahasiswas_table', 1),
(7, '2025_12_25_085909_create_nilais_table', 1),
(8, '2025_12_25_104125_create_mata_kuliahs_table', 1),
(9, '2025_12_25_104643_update_nilais_table_add_mata_kuliah_id', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_uts` decimal(5,2) NOT NULL,
  `nilai_uas` decimal(5,2) NOT NULL,
  `nilai_tugas` decimal(5,2) NOT NULL,
  `nilai_akhir` decimal(5,2) NOT NULL,
  `grade` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilais`
--

INSERT INTO `nilais` (`id`, `mahasiswa_id`, `nilai_uts`, `nilai_uas`, `nilai_tugas`, `nilai_akhir`, `grade`, `created_at`, `updated_at`, `mata_kuliah_id`) VALUES
(1, 1, '100.00', '80.00', '70.00', '83.00', 'B', '2025-12-25 04:18:42', '2025-12-25 04:18:42', 1),
(2, 2, '70.00', '80.00', '60.00', '71.00', 'C', '2025-12-25 04:19:00', '2025-12-25 05:04:39', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','nonadmin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nonadmin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@nilai.com', NULL, '$2y$10$VqCnvXm.ZnufabsatF51zOfvZPXyu3flUCHpyhQX9XvBtMWFnJ03G', 'admin', 'bdq4SZkoYunAkRfb5gnXVrjYrcCZQEFn8gGY1YLhzaO2LVi5QVYqixwzBbYW', '2025-12-25 04:07:41', '2025-12-25 04:07:41'),
(2, 'User Biasa', 'user@nilai.com', NULL, '$2y$10$YxGcXqT76kfZBRnLBzfoxuxZSOImkvNqxrASAWk4pVryXhURdxJZS', 'nonadmin', NULL, '2025-12-25 04:07:41', '2025-12-25 04:07:41');

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
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusans_kode_jurusan_unique` (`kode_jurusan`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswas_nim_unique` (`nim`),
  ADD UNIQUE KEY `mahasiswas_email_unique` (`email`),
  ADD KEY `mahasiswas_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_kuliahs_kode_mk_unique` (`kode_mk`),
  ADD KEY `mata_kuliahs_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilais_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `nilais_mata_kuliah_id_foreign` (`mata_kuliah_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `mahasiswas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD CONSTRAINT `mata_kuliahs_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilais_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliahs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
