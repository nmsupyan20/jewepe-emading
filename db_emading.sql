-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2024 pada 17.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_emading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `id_artikel` int(4) NOT NULL,
  `header` varchar(160) NOT NULL,
  `judul_artikel` varchar(255) NOT NULL,
  `isi_artikel` text NOT NULL,
  `status_publish` enum('publish','draft') NOT NULL,
  `id_users` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_artikel`
--

INSERT INTO `tb_artikel` (`id_artikel`, `header`, `judul_artikel`, `isi_artikel`, `status_publish`, `id_users`, `created_at`, `updated_at`) VALUES
(11, 'idulFitri_920378643.jpg', 'Libur Hari Raya Idul Fitri 1445 H ', 'Menanggapi hari raya Idul Fitri, maka perkuliahan diliburkan', 'draft', 1, '2024-01-06 10:42:00', '2024-01-06 12:47:58'),
(14, 'bot_1153633745.jpeg', 'Sidang PI FTI', '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque corporis eos ratione recusandae voluptatem esse quae quasi exercitationem assumenda accusantium, quis inventore expedita harum incidunt deleniti vero repellat laudantium architecto!<br></p>', 'publish', 1, '2024-01-06 13:33:31', NULL),
(16, 'Gambar1_841522799.jpg', 'Sidang Isbat Penetapan Hilal 2024', '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque corporis eos ratione recusandae voluptatem esse quae quasi exercitationem assumenda accusantium, quis inventore expedita harum incidunt deleniti vero repellat laudantium architecto!<br></p>', 'publish', 1, '2024-01-06 16:31:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(4) NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'supyan', 'supyan21', '$2y$10$9nQcrPvV.4yvFbFo.iDWkuu1JcC/Dg2c7zt7WMK3.Fq9mNYIFSZoC', '2024-01-04 02:52:57', '2024-01-04 02:52:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  MODIFY `id_artikel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD CONSTRAINT `tb_artikel_constraint` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
