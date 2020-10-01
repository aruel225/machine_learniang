-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2020 pada 17.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai_ag_dosen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `kode_dosen` char(3) NOT NULL,
  `nama_dosen` varchar(60) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hari`
--

CREATE TABLE `tb_hari` (
  `kode_hari` int(11) NOT NULL,
  `nama_hari` varchar(20) NOT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hari`
--

INSERT INTO `tb_hari` (`kode_hari`, `nama_hari`, `kode_prodi`) VALUES
(1, 'selasa', 'AR'),
(2, 'Selasa', 'IF'),
(3, 'jumat', 'TE'),
(4, 'selasa', 'TIP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(11) NOT NULL,
  `kuliah` int(11) NOT NULL,
  `ruang` int(11) NOT NULL,
  `waktu` int(11) NOT NULL,
  `kode_prodi` char(3) NOT NULL,
  `kode_semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jam`
--

CREATE TABLE `tb_jam` (
  `kode_jam` int(11) NOT NULL,
  `nama_jam` time NOT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kode_kelas` char(8) NOT NULL,
  `nama_kelas` varchar(60) NOT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kuliah`
--

CREATE TABLE `tb_kuliah` (
  `kode_kuliah` int(11) NOT NULL,
  `kode_matkul` char(6) NOT NULL,
  `kode_kelas` char(8) NOT NULL,
  `kode_dosen` char(5) NOT NULL,
  `kode_prodi` char(3) NOT NULL,
  `kode_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `kode_level` int(1) NOT NULL,
  `nama_level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`kode_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Prodi'),
(3, 'Dosen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `kode_matkul` char(6) NOT NULL,
  `nama_matkul` varchar(60) NOT NULL,
  `sks` int(2) NOT NULL,
  `kode_prodi` char(3) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `kode_prodi` char(3) NOT NULL,
  `Nama_prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi`
--

INSERT INTO `tb_prodi` (`kode_prodi`, `Nama_prodi`) VALUES
('AR', 'Arsitek'),
('IF', 'Informatika'),
('MN', 'Manajemen'),
('OTO', 'Otomotif'),
('PWK', 'Perencanaan Wilayah Kota'),
('SP', 'Teknik Sipil'),
('TE', 'Teknik Elektro'),
('TI', 'Teknik Industri'),
('TIP', 'Teknologi Industri Pertanian'),
('TK', 'Teknik Kimia'),
('TM', 'Teknik Mesin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `kode_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(25) NOT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ruang`
--

INSERT INTO `tb_ruang` (`kode_ruang`, `nama_ruang`, `keterangan`, `kode_prodi`) VALUES
(1, 'LIK', 'Laboratorium', ''),
(2, 'LIK', 'Laboratorium Ilmu Komputer', 'IF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `kode_level` int(1) NOT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama`, `user`, `pass`, `kode_level`, `kode_prodi`) VALUES
(1, 'Administrator (DPA)', 'admin', 'admin', 1, ''),
(2, 'Melani Indriasari, ST M.Kom', 'melani123', '1234', 3, 'IF'),
(3, 'Dra. Sulistyowati, M.Kom', 'informatika', '123', 2, 'IF'),
(4, 'Novy Hapsari, ST M.Sc', 'elektro', '123', 2, 'TE'),
(5, 'Muhamad Soleh', 'soleh', '123456', 3, 'IF'),
(6, 'asd', 'asd', 'asd', 0, ''),
(7, 'asd', 'asd', 'asd', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_waktu`
--

CREATE TABLE `tb_waktu` (
  `kode_waktu` int(11) NOT NULL,
  `kode_hari` int(11) NOT NULL,
  `kode_jam` int(3) NOT NULL,
  `kode_prodi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`kode_dosen`);

--
-- Indeks untuk tabel `tb_hari`
--
ALTER TABLE `tb_hari`
  ADD PRIMARY KEY (`kode_hari`);

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jam`
--
ALTER TABLE `tb_jam`
  ADD PRIMARY KEY (`kode_jam`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indeks untuk tabel `tb_kuliah`
--
ALTER TABLE `tb_kuliah`
  ADD PRIMARY KEY (`kode_kuliah`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`kode_level`);

--
-- Indeks untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`kode_matkul`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`kode_prodi`);

--
-- Indeks untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_waktu`
--
ALTER TABLE `tb_waktu`
  ADD PRIMARY KEY (`kode_waktu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_hari`
--
ALTER TABLE `tb_hari`
  MODIFY `kode_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  MODIFY `kode_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
