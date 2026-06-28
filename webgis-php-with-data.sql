-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2026 at 10:19 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kabupaten`
--

CREATE TABLE `m_kabupaten` (
  `id_kabupaten` int NOT NULL,
  `kd_kabupaten` varchar(10) NOT NULL,
  `nm_kabupaten` varchar(30) NOT NULL,
  `geojson_kabupaten` varchar(30) NOT NULL,
  `warna_kabupaten` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kabupaten`
--

INSERT INTO `m_kabupaten` (`id_kabupaten`, `kd_kabupaten`, `nm_kabupaten`, `geojson_kabupaten`, `warna_kabupaten`) VALUES
(1, '63.71', 'Kota Banjarmasin', '80280626054915.geojson', '#e218c7'),
(2, '63.03', 'Kab. Banjar', '16280626071601.geojson', '#d52020'),
(3, '63.72', 'Kota Banjarbaru', '47280626071621.geojson', '#1abc1c'),
(4, '63.11', 'Kab. Balangan', '21280626071656.geojson', '#521967'),
(5, '63.01', 'Kab. Tanah Laut ', '79280626083540.geojson', '#1a33ea'),
(6, '63.02', 'Kab. Kotabaru', '74280626083610.geojson', '#44e218'),
(7, '63.10', 'Kab. Tanah Bumbu', '3280626095157.geojson', '#05f5f5'),
(8, '63.05', 'Kab. Tapin', '38280626095324.geojson', '#000000'),
(9, '63.06', 'Kab. Hulu Sungai Selatan', '82280626095641.geojson', '#8b0e0e'),
(10, '63.07', 'Kab. Hulu Sungai Tengah', '19280626095741.geojson', '#122daf'),
(11, '63.08', 'Kab. Hulu Sungai Utara', '16280626095819.geojson', '#ecce09'),
(12, '63.09', 'Kab. Tabalong', '12280626095857.geojson', '#00ff7b'),
(13, '63.04', 'Kab. Barito Kuala', '82280626095939.geojson', '#18670e');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(150) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`, `level`) VALUES
(1, 'admin', '$2a$12$GOGv2fD/a/yDEYJeIjFcROD5EcnHlseyuoemK2Wr2/K0AnI9FcS9a', 'Admin'),
(2, 'user', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `t_firespot`
--

CREATE TABLE `t_firespot` (
  `id_firespot` int NOT NULL,
  `id_kabupaten` int NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `keterangan` text,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `tanggal` date NOT NULL,
  `luas_terbakar` decimal(10,2) DEFAULT '0.00',
  `status` enum('Aktif','Padam','Dalam Penanganan') DEFAULT 'Aktif',
  `penyebab` varchar(150) DEFAULT NULL,
  `marker` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_hotspot`
--

CREATE TABLE `t_hotspot` (
  `id_hotspot` int NOT NULL,
  `id_kabupaten` int NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lat` float(9,6) NOT NULL,
  `lng` float(9,6) NOT NULL,
  `tanggal` date NOT NULL,
  `marker` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kabupaten`
--
ALTER TABLE `m_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `t_firespot`
--
ALTER TABLE `t_firespot`
  ADD PRIMARY KEY (`id_firespot`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  ADD PRIMARY KEY (`id_hotspot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kabupaten`
--
ALTER TABLE `m_kabupaten`
  MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_firespot`
--
ALTER TABLE `t_firespot`
  MODIFY `id_firespot` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_hotspot`
--
ALTER TABLE `t_hotspot`
  MODIFY `id_hotspot` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_firespot`
--
ALTER TABLE `t_firespot`
  ADD CONSTRAINT `fk_firespot_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `m_kabupaten` (`id_kabupaten`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
