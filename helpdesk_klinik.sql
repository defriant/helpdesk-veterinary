-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2022 pada 15.47
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `terjual` bigint(20) NOT NULL,
  `dilihat` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `jenis`, `nama`, `harga`, `stock`, `gambar`, `deskripsi`, `terjual`, `dilihat`, `created_at`, `updated_at`) VALUES
('obat-flu-kucing', 'obat', 'Obat flu kucing', 120000, 120, 'obat-flu-kucing-1654892009-image-1.png', 'obat flu kucing', 0, 1, '2022-06-10 20:13:29', '2022-06-10 20:17:36'),
('pedigree', 'makanan', 'Pedigree', 85000, 298, 'pedigree-1654891872-image-1.png', 'Makanan anjing pedigree', 2, 3, '2022-06-10 20:11:12', '2022-06-10 21:31:06'),
('royal-cannin', 'makanan', 'Royal Cannin', 50000, 499, 'royal-cannin-1654891583-image-1.jpg', 'Makanan kucing royal canning', 1, 0, '2022-06-10 20:06:23', '2022-06-10 21:32:00'),
('whiskas-junior', 'makanan', 'Whiskas junior', 40000, 700, 'whiskas-junior-1654891970-image-1.png', 'makanan kucing junior', 0, 1, '2022-06-10 20:12:50', '2022-06-10 21:31:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_img`
--

CREATE TABLE `barang_img` (
  `id` bigint(20) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_img`
--

INSERT INTO `barang_img` (`id`, `id_barang`, `gambar`, `created_at`, `updated_at`) VALUES
(19, 'royal-cannin', 'royal-cannin-1654891583-image-1.jpg', '2022-06-10 20:06:23', '2022-06-10 20:06:23'),
(20, 'royal-cannin', 'royal-cannin-1654891583-image-2.jpg', '2022-06-10 20:06:23', '2022-06-10 20:06:23'),
(21, 'royal-cannin', 'royal-cannin-1654891583-image-3.jpg', '2022-06-10 20:06:23', '2022-06-10 20:06:23'),
(22, 'pedigree', 'pedigree-1654891872-image-1.png', '2022-06-10 20:11:12', '2022-06-10 20:11:12'),
(23, 'pedigree', 'pedigree-1654891872-image-2.png', '2022-06-10 20:11:12', '2022-06-10 20:11:12'),
(24, 'pedigree', 'pedigree-1654891872-image-3.png', '2022-06-10 20:11:12', '2022-06-10 20:11:12'),
(25, 'whiskas-junior', 'whiskas-junior-1654891970-image-1.png', '2022-06-10 20:12:50', '2022-06-10 20:12:50'),
(26, 'whiskas-junior', 'whiskas-junior-1654891970-image-2.png', '2022-06-10 20:12:50', '2022-06-10 20:12:50'),
(27, 'whiskas-junior', 'whiskas-junior-1654891970-image-3.png', '2022-06-10 20:12:50', '2022-06-10 20:12:50'),
(28, 'obat-flu-kucing', 'obat-flu-kucing-1654892009-image-1.png', '2022-06-10 20:13:29', '2022-06-10 20:13:29'),
(29, 'obat-flu-kucing', 'obat-flu-kucing-1654892009-image-2.png', '2022-06-10 20:13:29', '2022-06-10 20:13:29'),
(30, 'obat-flu-kucing', 'obat-flu-kucing-1654892009-image-3.png', '2022-06-10 20:13:29', '2022-06-10 20:13:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) NOT NULL,
  `from_user` bigint(20) NOT NULL,
  `to_user` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id`, `from_user`, `to_user`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(88, 40, 1, 'cakep !]', 1, '2022-06-10 21:34:49', '2022-06-10 21:34:51'),
(89, 1, 40, 'OK !', 1, '2022-06-10 21:34:54', '2022-06-10 21:34:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `confirm_regis`
--

CREATE TABLE `confirm_regis` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `barang_id` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `notif` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_read` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `jenis`, `notif`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
(239, '37', 'pesanan', 'Pesananmu telah dikonfirmasi oleh admin', '/pesanan/3706117287', 1, '2022-06-10 20:25:58', '2022-06-10 21:15:52'),
(240, '37', 'pembayaran', 'Pembayaran telah divalidasi', '/pesanan/3706117287', 1, '2022-06-10 20:26:23', '2022-06-10 21:15:52'),
(241, '37', 'pesanan', 'Pesananmu sedang dikirim ke Bekasi', '/pesanan/3706117287', 1, '2022-06-10 20:26:40', '2022-06-10 21:15:52'),
(242, '37', 'pesanan', 'Pesananmu telah tiba di tujuan, pesanan selesai', '/pesanan/3706117287', 1, '2022-06-10 20:27:05', '2022-06-10 21:15:52'),
(243, '40', 'pesanan', 'Pesananmu telah dikonfirmasi oleh admin', '/pesanan/4006115660', 1, '2022-06-10 21:32:00', '2022-06-10 21:32:51'),
(244, '40', 'pembayaran', 'Pembayaran telah divalidasi', '/pesanan/4006115660', 1, '2022-06-10 21:32:23', '2022-06-10 21:32:51'),
(245, '40', 'pesanan', 'Pesananmu sedang dikirim ke Bekasi', '/pesanan/4006115660', 1, '2022-06-10 21:32:34', '2022-06-10 21:32:51'),
(246, '40', 'pesanan', 'Pesananmu telah tiba di tujuan, pesanan selesai', '/pesanan/4006115660', 1, '2022-06-10 21:32:46', '2022-06-10 21:32:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` varchar(25) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `konfirmasi` datetime DEFAULT NULL,
  `menunggu_validasi` datetime DEFAULT NULL,
  `validasi` datetime DEFAULT NULL,
  `pengiriman` datetime DEFAULT NULL,
  `tiba_di_tujuan` datetime DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `alasan_batal` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `nama`, `telp`, `alamat`, `ongkir`, `total`, `status`, `konfirmasi`, `menunggu_validasi`, `validasi`, `pengiriman`, `tiba_di_tujuan`, `bukti_pembayaran`, `alasan_batal`, `created_at`, `updated_at`) VALUES
('3706117287', '37', 'afif', '12345', 'Bekasi', 15000, 185000, 'selesai', '2022-06-11 03:25:58', '2022-06-11 03:26:14', '2022-06-11 03:26:23', '2022-06-11 03:26:40', '2022-06-11 03:27:05', 'contoh_3706117287.jpg', NULL, '2022-06-10 20:25:50', '2022-06-10 20:27:05'),
('4006115660', '40', 'Tester', '12345', 'Bekasi', 15000, 65000, 'selesai', '2022-06-11 04:32:00', '2022-06-11 04:32:14', '2022-06-11 04:32:23', '2022-06-11 04:32:34', '2022-06-11 04:32:46', 'contoh_4006115660.jpg', NULL, '2022-06-10 21:31:49', '2022-06-10 21:32:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_barang`
--

CREATE TABLE `pesanan_barang` (
  `id` bigint(20) NOT NULL,
  `pesanan_id` varchar(50) NOT NULL,
  `barang_id` varchar(50) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `terjual` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan_barang`
--

INSERT INTO `pesanan_barang` (`id`, `pesanan_id`, `barang_id`, `nama`, `harga`, `jumlah`, `total`, `gambar`, `url`, `terjual`, `created_at`, `updated_at`) VALUES
(151, '3706117287', 'pedigree', 'Pedigree', '85000', 2, '170000', 'pedigree-1654891872-image-1.png', '/produk/pedigree', 'terjual', '2022-06-10 20:25:50', '2022-06-10 20:26:23'),
(152, '4006115660', 'royal-cannin', 'Royal Cannin', '50000', 1, '50000', 'royal-cannin-1654891583-image-1.jpg', '/produk/royal-cannin', 'terjual', '2022-06-10 21:31:49', '2022-06-10 21:32:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `telp`, `alamat`, `email`, `image`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dokter', '08123123123', 'Jakarta', 'dokter@dokter.com', NULL, NULL, '$2y$10$90RXNTjU7hQthRrb9H2I2.BZ.aQa5n6b0cSUDqs3LFSP6oj.nO43O', 'owner', NULL, '2022-06-10 10:10:11', '2022-06-10 10:12:34'),
(2, 'Admin', '081313131313', 'Bekasi Utara', 'admin@admin.com', NULL, NULL, '$2y$10$8zGFQ2nSWPE07QFBxjQqlul3DuSrTn/sp7.x.k5wcXH6Vwb6XXRda', 'admin', NULL, '2021-05-26 07:51:19', '2021-05-26 07:51:19'),
(37, 'afif', '12345', 'Bekasi', 'defriant17@gmail.com', NULL, NULL, '$2y$10$w1gB5ZQ/qJs0kcMhKq9vMea.zZQyNfAFe515zSyAsnqB7.u54DlEi', 'user', NULL, '2022-06-10 06:18:06', '2022-06-10 06:18:06'),
(39, 'Johansyah Tamaslan', '12345', 'Bekasi', 'tes@tes.com', NULL, NULL, '$2y$10$jk0EPgjIMm/8VhTGmUI57eueFTvtPe7rwqtv1lfFnycC2Fv4Msejq', 'user', NULL, '2022-06-10 17:31:39', '2022-06-10 17:31:39'),
(40, 'Tester', '12345', 'Bekasi', 'tes1@tes.com', NULL, NULL, '$2y$10$T.XDqE31OyPVTrnQ9u0V7.cgaBDxRZmEn6vpCNFWNa5SgUT5zTRM2', 'user', NULL, '2022-06-10 21:31:01', '2022-06-10 21:31:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_img`
--
ALTER TABLE `barang_img`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `confirm_regis`
--
ALTER TABLE `confirm_regis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_barang`
--
ALTER TABLE `pesanan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_img`
--
ALTER TABLE `barang_img`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT untuk tabel `pesanan_barang`
--
ALTER TABLE `pesanan_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
