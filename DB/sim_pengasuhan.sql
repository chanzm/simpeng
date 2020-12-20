-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2019 pada 06.38
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengasuhan_sim`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_peristiwa`
--

CREATE TABLE `history_peristiwa` (
  `id_history` bigint(20) UNSIGNED NOT NULL,
  `id_per` int(11) NOT NULL,
  `counter_history` int(11) NOT NULL,
  `waktu_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `flag` int(20) NOT NULL,
  `waktu_kategori` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `flag`, `waktu_kategori`) VALUES
(1, 'Kesamaptaan', 1, '2019-06-25 08:24:10'),
(2, 'Kejujuran', 1, '2019-06-25 08:24:10'),
(3, 'Keindonesiaan Yang Pluralis', 1, '2019-06-25 08:24:10'),
(4, 'Prima Melayani', 1, '2019-06-25 08:24:10'),
(5, 'Disiplin dan Pentang Menyerah', 1, '2019-06-25 08:24:10'),
(6, 'Senantiasa Evaluasi dan Mengembangkan diri', 1, '2019-06-25 08:24:10'),
(7, 'Tanggung jawab dan Kepemimpinan', 1, '2019-06-25 08:24:10'),
(8, 'Loyalitas Pada Cita-cita Organisasi', 1, '2019-06-25 08:24:10'),
(9, 'Pelanggaran Ringan', 2, '2019-06-25 08:24:10'),
(10, 'Pelanggaran Sedang', 2, '2019-06-25 08:24:10'),
(11, 'Pelanggaran Berat', 2, '2019-06-25 08:24:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_session`
--

CREATE TABLE `login_session` (
  `id_log` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','pimpinan') NOT NULL,
  `reg` enum('normal','hard') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login_session`
--

INSERT INTO `login_session` (`id_log`, `username`, `password`, `level`, `reg`) VALUES
(1, 'pakadmin', '12345', 'admin', 'normal'),
(2, 'pakpimpinan', 'pakpimpinan', 'pimpinan', 'normal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` bigint(20) UNSIGNED NOT NULL,
  `nama_mhs` varchar(100) NOT NULL,
  `sex` char(1) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `kd_angkatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `melakukan`
--

CREATE TABLE `melakukan` (
  `id_melakukan` bigint(20) UNSIGNED NOT NULL,
  `id_peristiwa` int(20) NOT NULL,
  `nim` int(20) NOT NULL,
  `smt_melakukan` int(11) NOT NULL,
  `counter_melakukan` int(11) NOT NULL DEFAULT '1',
  `time_melakukan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `melakukan`
--

INSERT INTO `melakukan` (`id_melakukan`, `id_peristiwa`, `nim`, `smt_melakukan`, `counter_melakukan`, `time_melakukan`) VALUES
(1, 1, 12345, 0, 1, '2019-06-25 08:30:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(20) NOT NULL,
  `id_mhs` int(20) NOT NULL,
  `ips` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peristiwa`
--

CREATE TABLE `peristiwa` (
  `id_peristiwa` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `nama_peristiwa` text NOT NULL,
  `point` decimal(4,2) NOT NULL,
  `counter_peristiwa` int(11) NOT NULL,
  `waktu_peristiwa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peristiwa`
--

INSERT INTO `peristiwa` (`id_peristiwa`, `id_kategori`, `nama_peristiwa`, `point`, `counter_peristiwa`, `waktu_peristiwa`) VALUES
(1, 1, 'Ditugaskan/dipilih sebagai Petugas Upacara/ Kegiatan di dalam atau luar kampus: l. petugas prosesi pemakaman jenazah', '1.50', 0, '2019-06-25 08:32:24'),
(2, 10, 'Menggunakan handphone tidak sesuai ketentuan', '-1.00', 0, '2019-06-25 08:32:24'),
(3, 1, 'Kegiatan lain yang patut diberikan penghargaan dengan pertimbangan Pengasuh', '3.00', 0, '2019-06-25 08:32:24'),
(4, 11, 'Melawan atasan (insubordinasi), memperlakukan dosen dan pengasuh tidak dengan hormat', '-5.00', 0, '2019-06-25 08:32:24'),
(5, 2, 'Mengaku menyontek saat ujian', '-0.50', 0, '2019-06-26 03:57:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history_peristiwa`
--
ALTER TABLE `history_peristiwa`
  ADD PRIMARY KEY (`id_history`),
  ADD UNIQUE KEY `id_history` (`id_history`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `login_session`
--
ALTER TABLE `login_session`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `id_mhs` (`nim`);

--
-- Indeks untuk tabel `melakukan`
--
ALTER TABLE `melakukan`
  ADD PRIMARY KEY (`id_melakukan`),
  ADD UNIQUE KEY `id_melakukan` (`id_melakukan`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `peristiwa`
--
ALTER TABLE `peristiwa`
  ADD PRIMARY KEY (`id_peristiwa`),
  ADD UNIQUE KEY `id_peristiwa` (`id_peristiwa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history_peristiwa`
--
ALTER TABLE `history_peristiwa`
  MODIFY `id_history` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `nim` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `melakukan`
--
ALTER TABLE `melakukan`
  MODIFY `id_melakukan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peristiwa`
--
ALTER TABLE `peristiwa`
  MODIFY `id_peristiwa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
