-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Nov 2025 pada 07.33
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_osissmkbi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$UhNwi0d4EqWzORE01h.C3ewsNonwjc95KMNNDXpTTl6bvF82pmFlW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_about`
--

CREATE TABLE `tb_about` (
  `id_about` int(11) NOT NULL,
  `head_about` varchar(20) NOT NULL,
  `img_about` varchar(255) NOT NULL,
  `hashtag_about` text NOT NULL,
  `deskripsi_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_about`
--

INSERT INTO `tb_about` (`id_about`, `head_about`, `img_about`, `hashtag_about`, `deskripsi_about`) VALUES
(1, 'TENTANG KAMI', 'img-about.png', '- Kerja Cerdas, Kerja Ikhlas cermat', 'OSIS (Organisasi Siswa Intra Sekolah) SMK Bina Informatika adalah wadah bagi peserta didik untuk berkembang, berkreasi, dan berkontribusi dalam membangun sekolah yang lebih baik dan berprestasi. Dengan semangat kebersamaan, OSIS siap menjadi jembatan aspirasi siswa, penggerak inovasi, serta pelopor kegiatan positif yang menginspirasi.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_biyouth`
--

CREATE TABLE `tb_biyouth` (
  `id_biyouth` int(11) NOT NULL,
  `judul_biyouth` varchar(50) NOT NULL,
  `nama_peserta` varchar(50) NOT NULL,
  `gambar_biyouth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_biyouth`
--

INSERT INTO `tb_biyouth` (`id_biyouth`, `judul_biyouth`, `nama_peserta`, `gambar_biyouth`) VALUES
(1, 'Etika di Ruang Guru', 'Qanita Malila - XII DKV', 'bicre-1.png'),
(2, 'Bawalah Bekal Sendiri!', 'Qanita Malila - XII DKV', 'bicre-2.png'),
(3, 'UAS Perpustakaan', 'Raihan Rizky Adriansyah - XII RPL', 'bicre-3.png'),
(4, 'Website Streaming Anime', 'M Dafa Adiwinata - XI RPL', 'bicre-4.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_divisi`
--

CREATE TABLE `tb_divisi` (
  `id_divisi` int(11) NOT NULL,
  `img_divisi` varchar(255) NOT NULL,
  `tagline_divisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_divisi`
--

INSERT INTO `tb_divisi` (`id_divisi`, `img_divisi`, `tagline_divisi`) VALUES
(1, 'bph-logo.png', 'BPH'),
(2, 'belneg-logo.png', 'BELA NEGARA'),
(3, 'ketaqwaan-logo.png', 'KETAQWAAN'),
(4, 'budpek-logo.png', 'BUDI PEKERTI'),
(5, 'kesehatan-logo.png', 'KESEHATAN'),
(6, 'seniora-logo.png', 'SENIORA'),
(7, 'tik-logo.png', 'TIK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_forum_aspirasi`
--

CREATE TABLE `tb_forum_aspirasi` (
  `id_forum` int(11) NOT NULL,
  `tujuan_aspirasi` varchar(255) NOT NULL,
  `komentar_forum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id_galeri` int(11) NOT NULL,
  `img_galeri` varchar(255) NOT NULL,
  `kategori_galeri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_galeri`
--

INSERT INTO `tb_galeri` (`id_galeri`, `img_galeri`, `kategori_galeri`) VALUES
(1, 'galeri-landscape1.png', 'landscape'),
(2, 'galeri-landscape2.png', 'landscape'),
(3, 'galeri1.png', 'kotak'),
(4, 'galeri2.png', 'kotak'),
(5, 'galeri3.png', 'kotak'),
(6, 'galeri4.png', 'kotak'),
(7, 'galeri5.png', 'kotak'),
(8, 'galeri6.png', 'kotak'),
(9, 'galeri7.png', 'kotak'),
(10, 'galeri8.png', 'kotak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_input_lomba`
--

CREATE TABLE `tb_input_lomba` (
  `id` int(11) NOT NULL,
  `nama_lomba` varchar(100) NOT NULL,
  `label_lomba` varchar(255) NOT NULL,
  `emoji` varchar(50) NOT NULL,
  `jenis_input` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban_lomba`
--

CREATE TABLE `tb_jawaban_lomba` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_tim` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_main_content`
--

CREATE TABLE `tb_main_content` (
  `id_content` int(11) NOT NULL,
  `judul_portal` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_1` varchar(255) NOT NULL,
  `gambar_2` varchar(255) NOT NULL,
  `gambar_3` varchar(255) NOT NULL,
  `gambar_4` varchar(255) NOT NULL,
  `link_teknis` varchar(255) NOT NULL,
  `link_reels` varchar(255) NOT NULL,
  `ink_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_main_content`
--

INSERT INTO `tb_main_content` (`id_content`, `judul_portal`, `deskripsi`, `gambar_1`, `gambar_2`, `gambar_3`, `gambar_4`, `link_teknis`, `link_reels`, `ink_contact`) VALUES
(1, 'PORTAL LOMBA BI CLASSICA', 'Selamat datang di portal pendaftaran BI Classica 2025! 🎉 Ajang tahunan SMK Bina Informatika ini menjadi wadah kreativitas, bakat, dan prestasi peserta didik. Melalui formulir ini, kamu dapat mendaftarkan diri sesuai cabang lomba yang diminati.', 'galeri1.png', 'galeri2.png', 'galeri3.png', 'galeri4.png', '#', '#', '#');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_news`
--

CREATE TABLE `tb_news` (
  `id_news` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul_news` varchar(50) NOT NULL,
  `deskripsi_news` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_news`
--

INSERT INTO `tb_news` (`id_news`, `gambar`, `judul_news`, `deskripsi_news`) VALUES
(1, 'news-1.png', 'Berita Baru', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magnam ea nulla totam, laudantium debitis, magni necessitatibus vel obcaecati atque illo, iste repellat natus vitae possimus temporibus? Itaque distinctio quibusdam quaerat!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_promdat`
--

CREATE TABLE `tb_promdat` (
  `id_promdat` int(11) NOT NULL,
  `img_card` varchar(255) NOT NULL,
  `judul_card` varchar(50) NOT NULL,
  `tanggal_card` varchar(100) NOT NULL,
  `deskripsi_card` text NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_promdat`
--

INSERT INTO `tb_promdat` (`id_promdat`, `img_card`, `judul_card`, `tanggal_card`, `deskripsi_card`, `kategori`) VALUES
(1, 'promdat-1.png', 'Sumatif Tengah Semester', '10 Maret 2025 s/d 18 Maret 2025', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', 'Pendidikan'),
(2, 'promdat-2.png', 'Pesantren Ramadhan', '19, 20, 21 Maret 2025', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', 'Agama'),
(3, 'promdat-3.png', 'BI’s Got Talent', '17 & 19 April 2025', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', 'Minat dan Bakat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indeks untuk tabel `tb_biyouth`
--
ALTER TABLE `tb_biyouth`
  ADD PRIMARY KEY (`id_biyouth`);

--
-- Indeks untuk tabel `tb_divisi`
--
ALTER TABLE `tb_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `tb_forum_aspirasi`
--
ALTER TABLE `tb_forum_aspirasi`
  ADD PRIMARY KEY (`id_forum`);

--
-- Indeks untuk tabel `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `tb_input_lomba`
--
ALTER TABLE `tb_input_lomba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jawaban_lomba`
--
ALTER TABLE `tb_jawaban_lomba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_main_content`
--
ALTER TABLE `tb_main_content`
  ADD PRIMARY KEY (`id_content`);

--
-- Indeks untuk tabel `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indeks untuk tabel `tb_promdat`
--
ALTER TABLE `tb_promdat`
  ADD PRIMARY KEY (`id_promdat`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_biyouth`
--
ALTER TABLE `tb_biyouth`
  MODIFY `id_biyouth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_divisi`
--
ALTER TABLE `tb_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_forum_aspirasi`
--
ALTER TABLE `tb_forum_aspirasi`
  MODIFY `id_forum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_input_lomba`
--
ALTER TABLE `tb_input_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban_lomba`
--
ALTER TABLE `tb_jawaban_lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_main_content`
--
ALTER TABLE `tb_main_content`
  MODIFY `id_content` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_promdat`
--
ALTER TABLE `tb_promdat`
  MODIFY `id_promdat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
