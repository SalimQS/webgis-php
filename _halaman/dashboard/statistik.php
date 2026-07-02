<?php
$setTemplate = false;

function statistik_count($db, $table)
{
  $db->get($table);
  return (int) $db->count;
}

$jumlahTempat = statistik_count($db, 'tempat_layanan');
$jumlahDokter = statistik_count($db, 'dokter');
$jumlahLayanan = statistik_count($db, 'layanan');
$jumlahPenanggungJawab = statistik_count($db, 'penanggung_jawab');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistik - WebGIS Layanan Kesehatan Disabilitas</title>
  <link rel="stylesheet" href="assets/css/style.css?v=health-20260703">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>

<div class="page-hero">
  <div class="section-head">
    <div class="eyebrow">Statistik Data</div>
    <h2>Ringkasan data layanan kesehatan disabilitas</h2>
  </div>
</div>

<section>
  <div class="grid-3">
    <div class="card"><span class="tag">Tempat</span><h3><?= $jumlahTempat ?></h3><p>Tempat layanan yang muncul sebagai marker pada peta.</p></div>
    <div class="card"><span class="tag">Dokter</span><h3><?= $jumlahDokter ?></h3><p>Dokter yang terhubung ke tempat layanan.</p></div>
    <div class="card"><span class="tag">Layanan</span><h3><?= $jumlahLayanan ?></h3><p>Layanan kesehatan atau pendampingan yang tersedia.</p></div>
    <div class="card"><span class="tag">Penanggung Jawab</span><h3><?= $jumlahPenanggungJawab ?></h3><p>Kontak pengelola atau koordinator layanan.</p></div>
  </div>
</section>

<footer>
  <span>Statistik WebGIS Layanan Kesehatan Disabilitas</span>
  <span>Data publik masyarakat</span>
</footer>
</body>
</html>
