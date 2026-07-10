-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2026 pada 09.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `study`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `value1` text NOT NULL,
  `value2` text NOT NULL,
  `value3` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `username`, `value1`, `value2`, `value3`, `created_at`) VALUES
(1, 'kithhh', 'aaaa', 'aaaa', 'aaa', '2026-07-06 03:24:14'),
(2, 'kithhh', 'study is fun', '', 'all good', '2026-07-08 03:54:42'),
(3, 'kithhh', 'study is fun', '', 'all good', '2026-07-08 03:55:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `todo`
--

CREATE TABLE `todo` (
  `list` varchar(500) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `todo`
--

INSERT INTO `todo` (`list`, `id`) VALUES
('tes', 36),
('tes2', 45),
('tes3', 46),
('tes', 47);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(70) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(13, '', 'rulla', 'rullaaliyah21@yahoo.com', '$2y$10$6wPfu.L0OPOpc86wgE7g4.0y729IYaJNszkLYjH4p42Fl9Hl.OGh6'),
(15, '', 'aliyah', 'aliyah@gmail.com', '$2y$10$tnjKY3aDuNFYDvP5vF3N8esl/1f5Blnsumw0AmIU0X8KfDKtsyaDu'),
(16, 'Kith', 'kithhh', 'kith@gmail.com', '$2y$10$m6gx6pFFmopd/DpbF7geheEJIlb9mGqIb26oxqC3u36QhyGK1F6h2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
