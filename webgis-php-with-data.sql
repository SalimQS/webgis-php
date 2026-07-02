-- SQL schema and seed data for WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `m_kabupaten` (
  `id_kabupaten` int NOT NULL,
  `kd_kabupaten` varchar(10) NOT NULL,
  `nm_kabupaten` varchar(30) NOT NULL,
  `geojson_kabupaten` varchar(30) NOT NULL,
  `warna_kabupaten` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `m_kabupaten` (`id_kabupaten`, `kd_kabupaten`, `nm_kabupaten`, `geojson_kabupaten`, `warna_kabupaten`) VALUES
(1, '63.71', 'Kota Banjarmasin', '80280626054915.geojson', '#2f80ed');

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(150) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengguna` (`id_pengguna`, `nm_pengguna`, `kt_sandi`, `level`) VALUES
(1, 'admin', '$2a$12$GOGv2fD/a/yDEYJeIjFcROD5EcnHlseyuoemK2Wr2/K0AnI9FcS9a', 'Admin'),
(2, 'user', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'User');

CREATE TABLE `tempat_layanan` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `kategori` enum('Rumah Sakit','Puskesmas','Klinik','Komunitas Disabilitas') NOT NULL,
  `alamat` text NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tempat_layanan` (`id`, `nama`, `kategori`, `alamat`, `latitude`, `longitude`, `telepon`, `deskripsi`, `foto`) VALUES
(1, 'RSUD Sultan Suriansyah', 'Rumah Sakit', 'Jl. Rantauan Darat, Kota Banjarmasin', -3.3346300, 114.5887000, '0511-000000', 'Fasilitas layanan kesehatan rujukan di Kota Banjarmasin.', NULL),
(2, 'Puskesmas Teluk Dalam', 'Puskesmas', 'Teluk Dalam, Kota Banjarmasin', -3.3168000, 114.5814000, '0511-000001', 'Layanan kesehatan masyarakat tingkat pertama.', NULL),
(3, 'Komunitas Disabilitas Banjarmasin', 'Komunitas Disabilitas', 'Kota Banjarmasin', -3.3186067, 114.5943784, '0812-0000-0000', 'Komunitas pendamping dan informasi layanan disabilitas.', NULL);

CREATE TABLE `dokter` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `spesialis` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `dokter` (`id`, `tempat_layanan_id`, `nama`, `alamat`, `spesialis`, `telepon`) VALUES
(1, 1, 'dr. Contoh Rehab Medik', 'Kota Banjarmasin', 'Rehabilitasi Medik', '0812-1111-1111');

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama_layanan` varchar(150) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `layanan` (`id`, `tempat_layanan_id`, `nama_layanan`, `keterangan`) VALUES
(1, 1, 'Konsultasi Rehabilitasi Medik', 'Konsultasi dan rujukan layanan rehabilitasi.'),
(2, 2, 'Pemeriksaan Kesehatan Dasar', 'Pemeriksaan kesehatan dasar dan edukasi keluarga.');

CREATE TABLE `penanggung_jawab` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `penanggung_jawab` (`id`, `tempat_layanan_id`, `nama`, `jabatan`, `telepon`) VALUES
(1, 1, 'Admin Layanan', 'Koordinator Layanan', '0812-2222-2222');

ALTER TABLE `m_kabupaten` ADD PRIMARY KEY (`id_kabupaten`);
ALTER TABLE `pengguna` ADD PRIMARY KEY (`id_pengguna`);
ALTER TABLE `tempat_layanan` ADD PRIMARY KEY (`id`);
ALTER TABLE `dokter` ADD PRIMARY KEY (`id`), ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);
ALTER TABLE `layanan` ADD PRIMARY KEY (`id`), ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);
ALTER TABLE `penanggung_jawab` ADD PRIMARY KEY (`id`), ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);

ALTER TABLE `m_kabupaten` MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `pengguna` MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `tempat_layanan` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `dokter` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `layanan` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `penanggung_jawab` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;
ALTER TABLE `layanan`
  ADD CONSTRAINT `fk_layanan_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;
ALTER TABLE `penanggung_jawab`
  ADD CONSTRAINT `fk_penanggung_jawab_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;

COMMIT;
