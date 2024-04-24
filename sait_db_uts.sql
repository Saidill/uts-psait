-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Apr 2024 pada 12.06
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sait_db_uts`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_perkuliahan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_perkuliahan` (
`nim` varchar(10)
,`nama_mahasiswa` varchar(20)
,`alamat` varchar(40)
,`tanggal_lahir` date
,`kode_mk` varchar(10)
,`nama_mk` varchar(20)
,`sks` int(2)
,`nilai` double
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_001', 'joko', 'bantul', '1999-12-07'),
('sv_002', 'paul', 'sleman', '2000-10-07'),
('sv_003', 'andy', 'surabaya', '2000-02-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(20) NOT NULL,
  `sks` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_001', 'database', 2),
('svpl_002', 'kecerdasan artifisia', 2),
('svpl_003', 'interoperabilitas', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id_perkuliahan` int(5) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perkuliahan`
--

INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(1, 'sv_001', 'svpl_001', 90),
(2, 'sv_001', 'svpl_002', 87),
(3, 'sv_001', 'svpl_003', 88),
(4, 'sv_002', 'svpl_001', 98),
(5, 'sv_002', 'svpl_002', 77);

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_perkuliahan`
--
DROP TABLE IF EXISTS `detail_perkuliahan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_perkuliahan`  AS SELECT `m`.`nim` AS `nim`, `m`.`nama` AS `nama_mahasiswa`, `m`.`alamat` AS `alamat`, `m`.`tanggal_lahir` AS `tanggal_lahir`, `mk`.`kode_mk` AS `kode_mk`, `mk`.`nama_mk` AS `nama_mk`, `mk`.`sks` AS `sks`, `p`.`nilai` AS `nilai` FROM ((`mahasiswa` `m` join `perkuliahan` `p` on(`m`.`nim` = `p`.`nim`)) join `matakuliah` `mk` on(`p`.`kode_mk` = `mk`.`kode_mk`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indeks untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `nim` (`nim`),
  ADD KEY `kode_mk` (`kode_mk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id_perkuliahan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `kode_mk` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`),
  ADD CONSTRAINT `nim` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
