<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metodologi — Karhutla Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .step {
      display: grid;
      grid-template-columns: 60px 1fr;
      gap: 20px;
      padding: 22px 0;
      border-bottom: 1px solid var(--line);
    }

    .step:last-child {
      border-bottom: none;
    }

    .step .num {
      font-family: var(--display);
      font-size: 1.6rem;
      color: var(--ember-deep);
    }

    .step h3 {
      font-family: var(--display);
      margin: 0 0 6px;
      font-size: 1.1rem;
    }

    .step p {
      margin: 0;
      color: var(--ink-soft);
      font-size: 0.92rem;
    }

    .formula {
      font-family: var(--mono);
      background: var(--ink);
      color: var(--khaki);
      padding: 18px 20px;
      border-radius: 4px;
      font-size: 0.85rem;
      line-height: 1.8;
      margin: 18px 0;
    }
  </style>
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section>
    <div class="section-head">
      <div class="eyebrow">Acuan: Perka BNPB No. 2 Tahun 2012</div>
      <h2>Skoring &amp; pembobotan overlay</h2>
    </div>

    <div class="formula">
      Skor Total = (0,4 × Skor Tutupan Lahan) + (0,3 × Skor Curah Hujan) + (0,3 × Skor Jenis Tanah)
    </div>

    <div class="step">
      <div class="num">01</div>
      <div>
        <h3>Kumpulkan data parameter</h3>
        <p>Curah hujan (BMKG), tutupan lahan (Landsat 8), jenis tanah (BBSDLP), titik api (Brin Fire Hotspot).</p>
      </div>
    </div>
    <div class="step">
      <div class="num">02</div>
      <div>
        <h3>Klasifikasi & skoring</h3>
        <p>Tiap parameter diberi skor 0,333 (rendah) / 0,666 (sedang) / 1 (tinggi) sesuai tabel acuan BNPB.</p>
      </div>
    </div>
    <div class="step">
      <div class="num">03</div>
      <div>
        <h3>Overlay / intersect</h3>
        <p>Ketiga peta parameter digabung di QGIS menggunakan metode intersect untuk menghasilkan skor total per wilayah.</p>
      </div>
    </div>
    <div class="step">
      <div class="num">04</div>
      <div>
        <h3>Klasifikasi akhir</h3>
        <p>Skor total dikelompokkan menjadi tiga kelas: Rendah (0,533), Sedang (0,666), Tinggi (0,800).</p>
      </div>
    </div>
    <div class="step">
      <div class="num">05</div>
      <div>
        <h3>Validasi</h3>
        <p>Dibandingkan dengan titik api (Topology Checker) dan survei area yang sudah terbakar di lapangan.</p>
      </div>
    </div>
  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>