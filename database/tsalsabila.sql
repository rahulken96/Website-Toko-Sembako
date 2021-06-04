-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2021 pada 00.12
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsalsabila`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `username` char(7) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email_admin` varchar(40) NOT NULL,
  `telp_admin` int(30) NOT NULL,
  `alamat_admin` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `Nama`, `username`, `password`, `email_admin`, `telp_admin`, `alamat_admin`) VALUES
(0, 'Admin', 'admin', 'admin', 'admin@gmail.com', 891234566, 'Jl. Kenangan Kemana saja'),
(1, 'asalbae', 'asall', '111', 'asal@gmail.com', 1, 'bondoll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `nama`, `harga_produk`, `jumlah`, `sub_harga`, `deskripsi`, `foto_produk`) VALUES
(1, 1, 20, 'Nabati', 2000, 1, 2000, 'Snack Nabati Keju', 'nabati.jpg.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `username` char(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `no_hp` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `Nama`, `username`, `password`, `no_hp`, `email`, `alamat`) VALUES
(1, 'Munir huda', 'admin', '111', 123123, '', ''),
(2, 'satu', 'munir20', '123', 895331126, 'munirhuda@gmail.com', ''),
(3, 'Bambanc', 'Rahul112', 'rahul123', 891234556, 'Bambanc@gmail.com', 'Jl. Kenangan bersama nya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` varchar(17) NOT NULL,
  `Nama` varchar(40) NOT NULL,
  `Bank` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `Bukti` varchar(255) NOT NULL,
  `Jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `Nama`, `Bank`, `tanggal`, `Bukti`, `Jumlah`) VALUES
(9, '14', 'asdjio', 'jaijdioa', '2021-06-03', '2021-06-03 08:11:38FFO Gold.jpg', 12312),
(10, '15', 'asndand', 'kaldsjd', '2021-06-03', '2021-06-03 08,12,46kopi.jpg', 1241241),
(11, '15', 'asdlkj', 'kjaiojd', '2021-06-03', '2021-06-03 08;13;10KUIZ 2_3.jpg', 98120398),
(12, '16', 'asdjj', 'jajdsdjio', '2021-06-03', '2021-06-03 08;13;44index.jpg', 912038),
(13, '17', 'ljilsjdiojaio', 'oijwdioawj', '2021-06-03', '2021-06-03 13;15;29kopi.jpg', 12398190),
(14, '21', 'Dudu', 'BRI', '2021-06-03', '2021-06-03 20;16;54nabati.jpg', 2123),
(15, '1', 'Rahul', 'BCA', '2021-06-04', '2021-06-04 05;07;52nabati.jpg', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_barang`
--

CREATE TABLE `pembelian_barang` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `nama` text NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_barang`
--

INSERT INTO `pembelian_barang` (`id_pembelian`, `id_pelanggan`, `nama`, `tanggal_pembelian`, `alamat`, `no_telp`, `total_harga`, `status_pembelian`) VALUES
(1, 3, 'Bambanc', '2021-06-04 05:07:31', 'Jl. Kenangan bersama nya', '891234556', 2000, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `deskripsi`, `foto_produk`) VALUES
(15, 'lays', 1000, 'Lays adalah salah satu keripik kentang dalam kemasan dengan banyak rasa. Gurih, renyah, dan nikmatnya Lays membuat banyak orang jatuh hati.', '60b8ac4b5b41f.jpg'),
(16, 'chitato', 4000, 'Chitato Potato Chips adalah makanan ringan berbahan dasar kentang yang diproduksi oleh PT. Indofood Fritolay Makmur yang merupakan anak perusahaan dari PT. Indofood, sebuah produsen makanan yang cukup besar di Indonesia.', 'chitato.jpg.jpg'),
(17, 'Ale-Ale', 2000, 'Ale Ale Anggur Minuman Instan [200 mL/ 24 pcs] merupakan minuman instan dalam kemasan gelas yang terbuat dari anggur alami. Minuman ini memberikan manfaat alami buah-buahan dengan cita rasa anggur sesungguhnya. Mengandung vitamin C yang tinggi untuk mendukung stamina dan daya tubuh Anda.', 'ale ale.jpg.jpg'),
(18, 'Beng-Beng', 1500, 'Beng – beng adalah snack wafer crunchy yang dibalut dengan coklat. Beng – beng diproduksi oleh Mayora dimana mereka memproduksi banyak jenis makanan ringan.', 'beng-beng.png.png'),
(20, 'Nabati', 2000, 'Snack Nabati Keju', 'nabati.jpg.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
