<?php
$setTemplate = false;
$anggota = array(
  array('nama' => 'Satria Salim', 'npm' => '2410010524', 'foto' => 'salim.jpeg'),
  array('nama' => 'Razy Saputra', 'npm' => '2410010317', 'foto' => 'razy.jpeg'),
  array('nama' => 'M. Miftahul Rizky', 'npm' => '2410010509', 'foto' => 'iki.jpeg'),
  array('nama' => 'Fathur Rahman', 'npm' => '2410010410', 'foto' => 'fathur.jpeg'),
  array('nama' => 'Adi Rizaldi', 'npm' => '2410010297', 'foto' => 'adi.jpeg'),
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Kelompok - WebGIS Layanan Kesehatan Disabilitas</title>
  <link rel="stylesheet" href="assets/css/style.css?v=health-20260703">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>

<div class="page-hero">
  <div class="section-head">
    <div class="eyebrow">Informasi Kelompok</div>
    <h2>Tim Pengembang WebGIS Layanan Kesehatan Disabilitas</h2>
    <div class="article-meta">
      <span>Implementasi PHP Native, MySQL, dan Leaflet</span>
      <span>Studi kasus: Kota Banjarmasin</span>
    </div>
  </div>
</div>

<section>
  <div class="team-grid">
    <?php foreach ($anggota as $row) { ?>
      <div class="card team-card">
        <img src="assets/kelompok/<?= $row['foto'] ?>" alt="<?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8') ?>">
        <h3><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8') ?></h3>
        <p>NPM. <?= htmlspecialchars($row['npm'], ENT_QUOTES, 'UTF-8') ?></p>
      </div>
    <?php } ?>
  </div>
</section>

<footer>
  <span>WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin</span>
  <span>Informasi Kelompok</span>
</footer>
</body>
</html>
