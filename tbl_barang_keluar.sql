-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2023 pada 05.37
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudangbaku_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_keluar`
--

CREATE TABLE `tbl_barang_keluar` (
  `id_barang_keluar` int(20) NOT NULL,
  `nota_keluar` varchar(255) NOT NULL,
  `status_barang` varchar(50) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `barang_id` varchar(50) NOT NULL,
  `satuan_kode` varchar(50) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `pengeluaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang_keluar`
--

INSERT INTO `tbl_barang_keluar` (`id_barang_keluar`, `nota_keluar`, `status_barang`, `tgl_keluar`, `bagian`, `barang_id`, `satuan_kode`, `permintaan`, `pengeluaran`) VALUES
(22, 'keluar1', '1', '2023-01-05', 'produksi', '13', 'Pcs', '12', '12'),
(23, 'keluar1', '1', '2023-01-05', 'produksi', '11', 'Pcs', '10', '10'),
(24, 'keluar1', '1', '2023-01-05', 'produksi', '12', 'Pcs', '10', '10'),
(25, 'keluar12', '1', '2023-01-06', 'produksi', '11', 'Pcs', '10', '10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
