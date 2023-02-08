-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Feb 2023 pada 02.25
-- Versi server: 10.4.24-MariaDB-log
-- Versi PHP: 7.4.33

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
-- Struktur dari tabel `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `nama_bagian`) VALUES
(1, 'produksi'),
(2, 'packing'),
(3, 'lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bahan`
--

CREATE TABLE `tbl_bahan` (
  `kode_bahan` varchar(50) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `supplier_id` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bahan`
--

INSERT INTO `tbl_bahan` (`kode_bahan`, `nama_bahan`, `supplier_id`) VALUES
('F001', 'Vitamin A', NULL),
('GL001', 'Gula Pasir', ''),
('SKM001', 'Susu Kental Manis', ''),
('SS001', 'Susu Bubuk', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_keluar`
--

CREATE TABLE `tbl_barang_keluar` (
  `id_barang_keluar` int(20) NOT NULL,
  `nota_keluar` varchar(255) NOT NULL,
  `status_barang` varchar(50) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `bagian` int(20) NOT NULL,
  `barang_id` varchar(50) NOT NULL,
  `satuan_kode` varchar(50) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `pengeluaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang_keluar`
--

INSERT INTO `tbl_barang_keluar` (`id_barang_keluar`, `nota_keluar`, `status_barang`, `tgl_keluar`, `bagian`, `barang_id`, `satuan_kode`, `permintaan`, `pengeluaran`) VALUES
(22, 'keluar1', '1', '2023-02-05', 1, '13', 'Pcs', '12', '12'),
(23, 'keluar2', '1', '2023-02-06', 1, '11', 'Pcs', '10', '10'),
(24, 'keluar3', '1', '2023-02-07', 2, '12', 'Pcs', '10', '10'),
(25, 'keluar4', '1', '2023-02-08', 2, '11', 'Pcs', '10', '10'),
(26, 'keluar5', '1', '2023-02-09', 1, '16', 'Pcs', '80', '80'),
(27, 'keluar6', '1', '2023-02-10', 2, '16', 'Pcs', '10', '10'),
(28, 'keluar6', '1', '2023-02-10', 2, '11', 'Pcs', '20', '20');

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
  `seri` varchar(50) NOT NULL DEFAULT '',
  `status` varchar(50) NOT NULL DEFAULT 'karantina',
  `daterelease` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`id_barang_masuk`, `no_nota`, `kode_barang`, `status_barang`, `supplier_id`, `jml_barang`, `satuan_kode`, `tgl_masuk_barang`, `coa`, `tgl_coa`, `halal`, `tgl_halal`, `expired_date`, `batch`, `seri`, `status`, `daterelease`) VALUES
(11, 'tes1', 'GL001', '1', 1, 60, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'gl001', 'seri1', 'release', '2023-01-05 15:28:48'),
(12, 'tes2', 'SS001', '1', 1, 140, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'sb001', 'seri2', 'release', '2023-01-05 15:28:51'),
(13, 'tes3', 'F001', '1', 1, 88, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-01-31', 'V001', 'seri3', 'release', '2023-01-06 10:24:56'),
(14, 'tes12', 'GL001', '1', 1, 50, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-06', '2023-02-28', 'gl002', 'seri4', 'release', '2023-01-06 10:24:50'),
(15, 'tes22', 'F001', '1', 1, 2, 'Pcs', '2023-01-05', 'ya', '2023-01-05', 'ya', '2023-01-05', '2023-03-31', 'F002', 'seri5', 'release', '2023-01-06 10:24:53'),
(16, 'nota1', 'SS001', '1', 1, 10, 'Pcs', '2023-01-09', 'ya', '2023-01-09', 'ya', '2023-01-09', '2023-01-09', 'COBA1', 'seri6', 'release', '2023-01-09 11:49:20');

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
(1, 'PT. ABC', 'jalan bareng sama aku yuk'),
(2, 'PT. DEF', 'jalan mulu makan kaga');

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
(29, 'adminpk', '$2y$10$jLKp7VDe8ESadwalwQLS7.L//ktGvxP3LPzM9PjfjnWXalNOR8T2m', 'Admin Piutang Karyawan', 6, 0, 0, 25, '2022-11-24 09:17:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `id` int(10) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `tanggal_keluar` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`id`, `id_transaksi`, `tanggal_masuk`, `tanggal_keluar`, `lokasi`, `kode_barang`, `nama_barang`, `satuan`, `jumlah`) VALUES
(1, 'WG-201713067948', '8/11/2017', '11/11/2017', 'NTB', '8888166995215', 'Ciki Walens', 'Dus', '50'),
(2, 'WG-201713067948', '8/11/2017', '11/12/2017', 'NTB', '8888166995215', 'Ciki Walens', 'Dus', '6'),
(3, 'WG-201713549728', '4/11/2017', '11/11/2017', 'Banten', '1923081008002', 'Buku Hiragana', 'Pack', '3'),
(4, 'WG-201774896520', '9/11/2017', '12/11/2017', 'Yogyakarta', '60201311121008264', 'Battery ZTE', 'Dus', '3'),
(5, 'WG-201727134650', '05/12/2017', '20/12/2017', 'Jakarta', '29312390203', 'Susu', 'Dus', '17'),
(6, 'WG-201810974628', '15/01/2018', '16/01/2018', 'Lampung', '1923081008002', 'Buku Nihongo', 'Dus', '50'),
(7, 'WG-201781267543', '7/11/2017', '17/01/2018', 'Yogyakarta', '97897952889', 'Buku Framework Codeigniter', 'Dus', '1'),
(8, 'WG-201832570869', '15/01/2018', '17/01/2018', 'Bali', '1923081008002', 'test', 'Dus', '10'),
(9, 'WG-201893850472', '15/01/2018', '18/01/2018', 'Bali', '1923081008002', 'lumpur nartugo', 'Pcs', '11'),
(10, 'WG-201781267543', '7/11/2017', '15/01/2018', 'Yogyakarta', '97897952889', 'Buku Framework Codeigniter', 'Dus', '1'),
(11, 'WG-201727134650', '05/12/2017', '15/01/2018', 'Jakarta', '29312390203', 'Susu', 'Dus', '3'),
(12, 'WG-201774896520', '9/11/2017', '15/01/2018', 'Yogyakarta', '60201311121008264', 'Battery ZTE', 'Dus', '3'),
(13, 'WG-201727134650', '05/12/2017', '16/01/2018', 'Jakarta', '29312390203', 'Susu', 'Dus', '1'),
(14, 'WG-201727134650', '05/12/2017', '17/01/2018', 'Jakarta', '29312390203', 'Susu', 'Dus', '1'),
(15, 'WG-201885472106', '18/01/2018', '19/01/2018', 'Riau', '8996001600146', 'Teh Pucuk', 'Dus', '50'),
(16, 'WG-201871602934', '18/01/2018', '16/03/2018', 'Papua', '312212331222', 'Kopi Hitam', 'Dus', '10'),
(0, 'WG-201871602934', '18/01/2018', '08/12/2022', 'Papua', '312212331222', 'Kopi Hitam', 'Dus', '10'),
(0, 'WG-201871602934', '18/01/2018', '13/12/2022', 'Papua', '312212331222', 'Kopi Hitam', 'Dus', '10'),
(0, 'WG-201871602934', '18/01/2018', '29/12/2022', 'Papua', '312212331222', 'Kopi Hitam', 'Dus', '10');

--
-- Trigger `tb_barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `TG_BARANG_KELUAR` AFTER INSERT ON `tb_barang_keluar` FOR EACH ROW BEGIN
 UPDATE tb_barang_masuk SET jumlah=jumlah-NEW.jumlah
 WHERE kode_barang=NEW.kode_barang;
 DELETE FROM tb_barang_masuk WHERE jumlah = 0;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_masuk`
--

CREATE TABLE `tb_barang_masuk` (
  `id_transaksi` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`id_transaksi`, `tanggal`, `lokasi`, `kode_barang`, `nama_barang`, `satuan`, `jumlah`) VALUES
('WG-201871602934', '18/01/2018', 'Papua', '312212331222', 'Kopi Hitam', 'Dus', '70');

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
-- Indeks untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
  ADD PRIMARY KEY (`kode_bahan`);

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
-- AUTO_INCREMENT untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_keluar`
--
ALTER TABLE `tbl_barang_keluar`
  MODIFY `id_barang_keluar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `id_barang_masuk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id_supplier` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
