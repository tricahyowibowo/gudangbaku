-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2023 pada 05.32
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
-- Struktur dari tabel `tbl_bahan`
--

CREATE TABLE `tbl_bahan` (
  `kode_bahan` varchar(50) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `supplier_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bahan`
--

INSERT INTO `tbl_bahan` (`kode_bahan`, `nama_bahan`, `supplier_id`) VALUES
('GL001', 'Gula Manis', ''),
('SS001', 'Susu Bubuk', ''),
('F001', 'Vitamin A', '');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_items`
--

CREATE TABLE `tbl_items` (
  `itemId` int(11) NOT NULL,
  `itemHeader` varchar(512) NOT NULL COMMENT 'Heading',
  `itemSub` varchar(1021) NOT NULL COMMENT 'sub heading',
  `itemDesc` text DEFAULT NULL COMMENT 'content or description',
  `itemImage` varchar(80) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_items`
--

INSERT INTO `tbl_items` (`itemId`, `itemHeader`, `itemSub`, `itemDesc`, `itemImage`, `isDeleted`, `createdBy`, `createdDtm`, `updatedDtm`, `updatedBy`) VALUES
(1, 'jquery.validation.js', 'Contribution towards jquery.validation.js', 'jquery.validation.js is the client side javascript validation library authored by Jörn Zaefferer hosted on github for us and we are trying to contribute to it. Working on localization now', 'validation.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL),
(2, 'CodeIgniter User Management', 'Demo for user management system', 'This the demo of User Management System (Admin Panel) using CodeIgniter PHP MVC Framework and AdminLTE bootstrap theme. You can download the code from the repository or forked it to contribute. Usage and installation instructions are provided in ReadMe.MD', 'cias.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perusahaan`
--

CREATE TABLE `tbl_perusahaan` (
  `id_perusahaan` int(50) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_perusahaan`
--

INSERT INTO `tbl_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`) VALUES
(1, 'PT. Mirota Ksm', 'jl. raya jogja-solo no 9');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Manager/Direksi'),
(3, 'Admin Kas'),
(4, 'Admin Bank'),
(5, 'Kepala Bagian'),
(6, 'Admin Piutang Karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(20) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat_supplier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`) VALUES
(1, 'PT. ABC', 'jalan bareng sama aku yuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `username` varchar(128) NOT NULL COMMENT 'login username',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `roleId` tinyint(4) NOT NULL,
  `isLogin` tinyint(4) NOT NULL DEFAULT 0,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `username`, `password`, `name`, `roleId`, `isLogin`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(25, 'admin', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'Tri Cahya Wibawa', 1, 1, 0, 0, '2022-11-21 02:24:48', NULL, NULL),
(26, 'adminkas', '$2y$10$1LEUNRABhviwwADmC02KKuga8FPs60gYWxgeLaysPWWGBz7ZvS.pi', 'Admin Kas', 3, 0, 0, 25, '2022-11-21 08:39:17', 25, '2022-11-23 02:24:10'),
(27, 'adminbank', '$2y$10$s5gqBa.txPnTIwsb0GNA..WO.5nWFbgELXkWFQNbv54P6cFPz/eKS', 'Admin Bank', 4, 0, 0, 25, '2022-11-21 08:39:51', 25, '2022-11-23 02:24:28'),
(28, 'kabag', '$2y$10$6nu8lVNGElzWH9w7OGpv6eLKOhLsEgHcKvGYXDTZ6EcznAtGotU7a', 'Kepala Bagian', 5, 0, 0, 25, '2022-11-23 02:14:35', NULL, NULL),
(29, 'adminpk', '$2y$10$jLKp7VDe8ESadwalwQLS7.L//ktGvxP3LPzM9PjfjnWXalNOR8T2m', 'Admin Piutang Karyawan', 6, 0, 0, 25, '2022-11-24 09:17:06', NULL, NULL),
(30, 'susisu', '$2y$10$rcP4rnnrEiGx./a/tZpu..jj70ZUc2R0//839ZPrqsZNYUK65TTmi', 'Tri Cahya Wibawa', 3, 0, 0, 25, '2023-01-03 08:29:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL,
  `kode_satuan` varchar(100) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `kode_satuan`, `nama_satuan`) VALUES
(1, 'Dus', 'Dus'),
(2, 'Pcs', 'Pcs'),
(5, 'Pack', 'Pack');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indeks untuk tabel `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `id_barang_masuk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  MODIFY `id_perusahaan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
