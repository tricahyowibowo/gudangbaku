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
-- Struktur dari tabel `tbl_barang_masuk`
--

CREATE TABLE `tbl_barang_masuk` (
  `id_barang_masuk` int(255) NOT NULL,
  `no_nota` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `status_barang` varchar(255) NOT NULL,
  `supplier_id` int(50) NOT NULL,
  `jml_barang` int(20) NOT NULL,
  `satuan_kode` varchar(50) NOT NULL,
  `tgl_masuk_barang` date NOT NULL,
  `coa` varchar(50) NOT NULL,
  `tgl_coa` date DEFAULT NULL,
  `halal` varchar(50) NOT NULL,
  `tgl_halal` date DEFAULT NULL,
  `expired_date` date NOT NULL,
  `batch` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'karantina',
  `daterelease` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`id_barang_masuk`, `no_nota`, `kode_barang`, `status_barang`, `supplier_id`, `jml_barang`, `satuan_kode`, `tgl_masuk_barang`, `coa`, `tgl_coa`, `halal`, `tgl_halal`, `expired_date`, `batch`, `status`, `daterelease`) VALUES
(11, 'tes1', 'GL001', '1', 1, 80, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'gl001', 'release', '2023-01-05 15:28:48'),
(12, 'tes2', 'SS001', '1', 1, 140, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'sb001', 'release', '2023-01-05 15:28:51'),
(13, 'tes3', 'F001', '1', 1, 88, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'V001', 'release', '2023-01-06 10:24:56'),
(14, 'tes12', 'GL001', '1', 1, 50, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-06', '2023-02-28', 'gl002', 'release', '2023-01-06 10:24:50'),
(15, 'tes22', 'F001', '1', 1, 2, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-03-31', 'F002', 'release', '2023-01-06 10:24:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `id_barang_masuk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
