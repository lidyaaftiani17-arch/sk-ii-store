-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2026 at 08:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_ii_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$LeJcyHUqPKHEECBzGZu6Y.foLtESeF4.0gmco7rZ7DvDG9W/NEMMi', '2026-10-01 05:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `deskripsi`, `harga`, `stok`, `gambar`, `created_at`) VALUES
(1, 'SK-II Facial Treatment Essence', 'Essence', 'Essence ikonik dengan lebih dari 90% PITERA™ untuk menghidupkan kembali kelembapan alami kulit dan menghadirkan luminositas yang memikat.', '3080000.00', 20, 'facial-treatment-essence.jpg', '2026-10-01 05:46:59'),
(2, 'SK-II Facial Treatment Clear Lotion', 'Toner', 'Toner penyempurna yang memurnikan kulit dari sisa kotoran dan sel kulit mati, meninggalkan kanvas kulit yang segar dan siap menerima ritual perawatan berikutnya.', '1165000.00', 20, 'facial-treatment-clear-lotion.jpg', '2026-10-01 05:46:59'),
(3, 'SK-II Facial Treatment Gentle Cleanser', 'Cleanser', 'Pembersih wajah bertekstur lembut yang menyempurnakan kebersihan kulit tanpa mengusik kelembapan alaminya.', '940000.00', 20, 'facial-treatment-gentle-cleanser.jpg', '2026-10-01 05:46:59'),
(4, 'SK-II SKINPOWER Re-New Cream', 'Moisturizer', 'Krim mewah yang memelihara kelembapan dan kekenyalan kulit, untuk tampilan wajah yang terasa lembut, supple, dan youthful.', '3095000.00', 15, 'skinpower-re-new-cream.jpg', '2026-10-01 05:46:59'),
(5, 'SK-II GenOptics Advanced Spot Essence', 'Essence', 'Essence pencerah yang menyempurnakan tampilan kulit dengan membantu memudarkan noda serta menghadirkan rona wajah yang lebih merata dan luminous.', '2810000.00', 15, 'genoptics-advanced-spot-essence.jpg', '2026-10-01 05:46:59'),
(6, 'SK-II GenOptics InfinitAura Essence', 'Essence', 'Essence pencerah eksklusif yang merawat pancaran alami kulit, menghadirkan complexion yang tampak bening, cerah, dan penuh cahaya.', '4140000.00', 10, 'genoptics-infinit-aura-essence.jpg', '2026-10-01 05:46:59'),
(7, 'SK-II Facial Treatment Mask — 6 pcs', 'Mask', 'Perawatan intensif dalam selembar masker dengan konsentrat PITERA™, memberikan sentuhan kelembapan sekaligus kilau segar yang seketika.', '1535000.00', 20, 'facial-treatment-mask.jpg', '2026-10-01 05:46:59'),
(8, 'SK-II GenOptics CC Primer SPF 50+', 'Primer', 'Sentuhan akhir yang menyempurnakan complexion sekaligus memberikan perlindungan SPF 50+, untuk tampilan kulit yang flawless, natural, dan refined.', '1125000.00', 15, 'genoptics-cc-primer.jpg', '2026-10-01 05:46:59'),
(9, 'SK-II LXP Ultimate Perfecting Essence', 'Essence', 'Essence eksklusif dari lini LXP dengan konsentrasi PITERA™ tinggi, menghadirkan ritual perawatan intensif untuk kulit yang tampak refined, halus, dan bercahaya.', '4210000.00', 10, 'lxp-ultimate-perfecting-essence.jpg', '2026-10-01 05:46:59'),
(10, 'SK-II PITERA™ First Experience Kit', 'Set', 'Sebuah introduction to the SK-II ritual, menghadirkan rangkaian esensial pilihan untuk mengenal pengalaman perawatan dengan PITERA™.', '1295000.00', 20, 'pitera-first-experience-kit.jpg', '2026-10-01 05:46:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
