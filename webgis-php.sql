-- SQL schema for WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin

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

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nm_pengguna` varchar(20) NOT NULL,
  `kt_sandi` varchar(150) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `dokter` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `spesialis` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama_layanan` varchar(150) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `penanggung_jawab` (
  `id` int NOT NULL,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `m_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

ALTER TABLE `tempat_layanan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);

ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);

ALTER TABLE `penanggung_jawab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_layanan_id` (`tempat_layanan_id`);

ALTER TABLE `m_kabupaten`
  MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `tempat_layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `dokter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `penanggung_jawab`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;

ALTER TABLE `layanan`
  ADD CONSTRAINT `fk_layanan_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;

ALTER TABLE `penanggung_jawab`
  ADD CONSTRAINT `fk_penanggung_jawab_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE;

COMMIT;
