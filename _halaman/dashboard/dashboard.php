<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Rawan Karhutla — Kota Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section class="hero">
    <div>
      <div class="eyebrow">Kota Banjarmasin · 2026</div>
      <h1>Memetakan tanah yang<br><em>siap terbakar</em> sebelum apinya datang.</h1>
      <p class="lead">Curah hujan 963 mm/tahun, padang rumput seluas 8.586 Ha, dan 73 titik api dalam satu tahun.
        Data ini diolah dengan metode skoring &amp; pembobotan BNPB untuk memetakan tingkat kerawanan kebakaran hutan dan lahan per desa/kelurahan.</p>
      <div style="display:flex;gap:12px;">
        <a href="?halaman=dashboard&section=peta" class="btn">Buka Peta Interaktif →</a>
        <a href="?halaman=dashboard&section=metodologi" class="btn ghost">Lihat Metodologi</a>
      </div>
    </div>

    <div class="scorch-card">
      <div class="label">Distribusi Potensi Kerawanan · 9.385 Ha</div>

      <div class="scorch-bar">
        <span class="tinggi" style="width:49%"></span>
        <span class="sedang" style="width:31%"></span>
        <span class="rendah" style="width:20%"></span>
      </div>

      <div class="scorch-legend">
        <div><span class="dot tinggi"></span>Tinggi · 4.590 Ha (49%)</div>
        <div><span class="dot sedang"></span>Sedang · 2.855 Ha (31%)</div>
        <div><span class="dot rendah"></span>Rendah · 1.940 Ha (20%)</div>
      </div>
    </div>
  </section>

  <div class="divider"></div>

  <section>
    <div class="section-head">
      <div class="eyebrow">Wilayah Analisis</div>
      <h2>Data spasial penyusun peta kerawanan Kota Banjarmasin</h2>
    </div>

    <div class="grid-3">

      <div class="card">
        <span class="tag">Administrasi</span>
        <h3>5 Kabupaten</h3>
        <p>Wilayah penelitian meliputi seluruh kabupaten di Kota Banjarmasin sebagai satu kesatuan area analisis.</p>
        <div class="stat">5<span style="font-size:.9rem;color:var(--ink-soft)"> Kabupaten</span></div>
      </div>

      <div class="card">
        <span class="tag">Parameter Analisis</span>
        <h3>Overlay SIG</h3>
        <p>Peta kerawanan disusun melalui proses overlay beberapa parameter spasial menggunakan Sistem Informasi Geografis (SIG).</p>
        <div class="stat">3<span style="font-size:.9rem;color:var(--ink-soft)"> Parameter</span></div>
      </div>

      <div class="card">
        <span class="tag">Output</span>
        <h3>Peta Kerawanan</h3>
        <p>Hasil analisis menghasilkan klasifikasi wilayah dengan tingkat kerawanan tinggi, sedang, dan rendah.</p>
        <div class="stat">3<span style="font-size:.9rem;color:var(--ink-soft)"> Kelas Risiko</span></div>
      </div>

    </div>
  </section>

  <section>

    <div class="section-head">
      <div class="eyebrow">Kabupaten Kota Banjarmasin</div>
      <h2>Ringkasan wilayah yang dianalisis</h2>
    </div>

    <div class="grid-3">

      <div class="card">
        <span class="tag">Kabupaten</span>
        <h3>Banjarmasin Selatan</h3>
        <p>Memiliki kawasan permukiman padat serta beberapa area vegetasi yang menjadi bagian dari analisis kerawanan.</p>
      </div>

      <div class="card">
        <span class="tag">Kabupaten</span>
        <h3>Banjarmasin Timur</h3>
        <p>Wilayah berkembang dengan kombinasi kawasan permukiman, ruang terbuka hijau, dan badan air.</p>
      </div>

      <div class="card">
        <span class="tag">Kabupaten</span>
        <h3>Banjarmasin Barat</h3>
        <p>Didominasi kawasan permukiman dan aktivitas perdagangan dengan beberapa ruang terbuka sebagai objek analisis.</p>
      </div>

      <div class="card">
        <span class="tag">Kabupaten</span>
        <h3>Banjarmasin Tengah</h3>
        <p>Pusat aktivitas perkotaan dengan dominasi kawasan terbangun dan ruang terbuka yang terbatas.</p>
      </div>

      <div class="card">
        <span class="tag">Kabupaten</span>
        <h3>Banjarmasin Utara</h3>
        <p>Memiliki kawasan permukiman, lahan terbuka, dan daerah tepian sungai yang menjadi bagian analisis spasial.</p>
      </div>

      <div class="card">
        <span class="tag">Analisis SIG</span>
        <h3>Keseluruhan Kota</h3>
        <p>Seluruh kabupaten digabungkan dalam proses overlay untuk menghasilkan peta potensi rawan kebakaran tingkat kota.</p>
      </div>

    </div>

  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>