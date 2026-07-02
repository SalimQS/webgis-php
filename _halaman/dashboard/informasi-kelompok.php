<?php
$setTemplate = false;
$anggota = array(
  array('nama' => 'Adelia Putri Effendi', 'npm' => '2410010514'),
  array('nama' => 'Putri Daniyati', 'npm' => '2410010451'),
  array('nama' => 'Nurul huda', 'npm' => '2410010437'),
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

  <div class="kelompok-content-wrapper">
    <div class="page-hero">
      <div class="section-head">
        <div class="eyebrow">Informasi Kelompok</div>
        <h2>Anggota Kelompok</h2>
        <!-- <div class="article-meta">
          <span>Kelompok pengembang aplikasi pemetaan layanan kesehatan bagi penyandang disabilitas.</span>
          <span>Studi kasus: Kota Banjarmasin</span>
        </div> -->
      </div>
    </div>
    
    <section>
      <div class="team-grid">
        <?php foreach ($anggota as $index => $row) { ?>
          <div class="card team-card" style="text-align:left">
            <span class="tag">Anggota <?= $index + 1 ?></span>
            <h3><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p>NPM. <?= htmlspecialchars($row['npm'], ENT_QUOTES, 'UTF-8') ?></p>
          </div>
        <?php } ?>
      </div>
    </section>
  </div>

  <footer>
    <span>WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin</span>
    <span>Informasi Kelompok</span>
  </footer>
</body>

</html>