-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2022 pada 23.14
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `no` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `gambarBuku` varchar(50) NOT NULL,
  `bukuDipinjam` int(5) NOT NULL,
  `jumlahBuku` int(9) NOT NULL,
  `sinopsis` text NOT NULL,
  `jenisBuku` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarbuku`
--

CREATE TABLE `daftarbuku` (
  `kodeDaftar` int(11) NOT NULL,
  `namaBuku` varchar(100) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `noBuku` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanadmin`
--

CREATE TABLE `pesanadmin` (
  `nis` varchar(50) NOT NULL,
  `isiPesan` text NOT NULL,
  `tanggalPengirim` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanuser`
--

CREATE TABLE `pesanuser` (
  `nis` varchar(100) NOT NULL,
  `isiPesan` text NOT NULL,
  `tanggalPengirim` varchar(100) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prapeminjaman`
--

CREATE TABLE `prapeminjaman` (
  `nis` varchar(30) NOT NULL,
  `kodePraPeminjaman` varchar(5) NOT NULL,
  `waktuTenggat` varchar(50) NOT NULL,
  `noBuku` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayatpeminjaman`
--

CREATE TABLE `riwayatpeminjaman` (
  `kodeTransaksi` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `judulBuku` varchar(100) NOT NULL,
  `tanggalPeminjaman` varchar(100) NOT NULL,
  `tanggalPengembalian` varchar(100) NOT NULL,
  `noBuku` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `denda` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayatpengembalian`
--

CREATE TABLE `riwayatpengembalian` (
  `kodeTransaksi` varchar(50) NOT NULL,
  `noBuku` varchar(50) NOT NULL,
  `denda` varchar(50) NOT NULL,
  `tanggalPengembalian` varchar(100) NOT NULL,
  `kondisiBuku` varchar(100) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggalPeminjaman` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sanksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `noTelp` varchar(13) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `cookie` varchar(5) NOT NULL,
  `jenisAkun` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `kelas`, `password`, `noTelp`, `gambar`, `cookie`, `jenisAkun`) VALUES
(0, 'Figo', '', 'admin', '0', '636dbf4116406.png', '6355f', 'A'),
(212210015, 'Julioez Candita Haga Figo Latupeirissa', 'XI RPL 1', '212210015', '085810154283', '63992e868b8ae.png', '63992', 'U');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `daftarbuku`
--
ALTER TABLE `daftarbuku`
  ADD PRIMARY KEY (`kodeDaftar`);

--
-- Indeks untuk tabel `pesanadmin`
--
ALTER TABLE `pesanadmin`
  ADD PRIMARY KEY (`urutan`);

--
-- Indeks untuk tabel `pesanuser`
--
ALTER TABLE `pesanuser`
  ADD PRIMARY KEY (`urutan`);

--
-- Indeks untuk tabel `prapeminjaman`
--
ALTER TABLE `prapeminjaman`
  ADD PRIMARY KEY (`urutan`);

--
-- Indeks untuk tabel `riwayatpeminjaman`
--
ALTER TABLE `riwayatpeminjaman`
  ADD PRIMARY KEY (`urutan`);

--
-- Indeks untuk tabel `riwayatpengembalian`
--
ALTER TABLE `riwayatpengembalian`
  ADD PRIMARY KEY (`urutan`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `daftarbuku`
--
ALTER TABLE `daftarbuku`
  MODIFY `kodeDaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT untuk tabel `pesanadmin`
--
ALTER TABLE `pesanadmin`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT untuk tabel `pesanuser`
--
ALTER TABLE `pesanuser`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT untuk tabel `prapeminjaman`
--
ALTER TABLE `prapeminjaman`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `riwayatpengembalian`
--
ALTER TABLE `riwayatpengembalian`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
