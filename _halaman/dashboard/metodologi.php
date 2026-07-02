<?php
$setTemplate = false;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metodologi - WebGIS Layanan Kesehatan Disabilitas</title>
  <link rel="stylesheet" href="assets/css/style.css?v=health-20260703">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>

<div class="page-hero">
  <div class="section-head">
    <div class="eyebrow">Metodologi</div>
    <h2>Pengumpulan data layanan kesehatan dan pemetaan lokasi</h2>
    <div class="article-meta">
      <span>Mengacu pada artikel Johan Wahyudi, JURNAL JIEOM Vol.03 No.01.</span>
      <span>Fokus data: lokasi, fasilitas, layanan khusus, dokter, dan penanggung jawab.</span>
    </div>
  </div>
</div>

<section>
  <div class="page-grid">
    <div class="card">
      <span class="tag">1. Survei Lapangan</span>
      <h3>Koordinat tempat layanan</h3>
      <p>Data spasial diperoleh dari titik koordinat tempat layanan kesehatan. Pada aplikasi ini koordinat disimpan sebagai latitude dan longitude pada tabel tempat layanan.</p>
    </div>
    <div class="card">
      <span class="tag">2. Wawancara</span>
      <h3>Informasi layanan dan fasilitas</h3>
      <p>Informasi tempat, layanan, dokter, dan penanggung jawab disusun agar masyarakat dapat memahami fasilitas yang tersedia sebelum datang ke lokasi.</p>
    </div>
    <div class="card">
      <span class="tag">3. Implementasi WebGIS</span>
      <h3>PHP Native, MySQL, dan Leaflet</h3>
      <p>Data master dikelola admin, lalu ditampilkan kepada masyarakat melalui peta Leaflet, pencarian tempat, filter kategori, dan halaman detail.</p>
    </div>
    <div class="card">
      <span class="tag">4. Pengujian</span>
      <h3>Validasi fungsi utama</h3>
      <p>Fungsi utama yang perlu diuji meliputi penyimpanan lokasi, tampilan marker peta, filter kategori, detail tempat, dan laporan PDF.</p>
    </div>
  </div>
</section>

<footer>
  <span>Metodologi WebGIS Layanan Kesehatan Disabilitas</span>
  <span>Survei, database, peta, dan laporan</span>
</footer>
</body>
</html>
