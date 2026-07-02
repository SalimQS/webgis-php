CREATE TABLE IF NOT EXISTS `tempat_layanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `kategori` enum('Rumah Sakit','Puskesmas','Klinik','Komunitas Disabilitas') NOT NULL,
  `alamat` text NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `spesialis` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tempat_layanan_id` (`tempat_layanan_id`),
  CONSTRAINT `fk_dokter_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `layanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tempat_layanan_id` int NOT NULL,
  `nama_layanan` varchar(150) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`),
  KEY `tempat_layanan_id` (`tempat_layanan_id`),
  CONSTRAINT `fk_layanan_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `penanggung_jawab` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tempat_layanan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tempat_layanan_id` (`tempat_layanan_id`),
  CONSTRAINT `fk_penanggung_jawab_tempat_layanan` FOREIGN KEY (`tempat_layanan_id`) REFERENCES `tempat_layanan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
