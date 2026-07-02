<?php
$setTemplate = false;

function dash_e($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q != '') {
  $db->where('nama', '%' . $q . '%', 'LIKE');
}
$tempatLayanan = $db->ObjectBuilder()->get('tempat_layanan');
$jumlahTempat = count($tempatLayanan);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Kesehatan Disabilitas Kota Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css?v=health-20260703">
</head>

<body>
  <?php include __DIR__ . '/navbar.php'; ?>

  <div class="hero-container">
    <section class="hero">
      <div>
        <div class="eyebrow">Kota Banjarmasin 2026</div>
        <h1>Pemetaan layanan kesehatan bagi <em>penyandang disabilitas</em>.</h1>
        <p class="lead">Aplikasi ini membantu masyarakat menemukan rumah sakit, puskesmas, klinik, dan komunitas yang menyediakan layanan terkait disabilitas di Kota Banjarmasin.</p>
        <div style="display:flex;gap:12px;flex-wrap:wrap">
          <a href="?halaman=dashboard&section=peta" class="btn">Buka Peta Layanan</a>
          <a href="#daftar-tempat" class="btn ghost">Cari Tempat</a>
        </div>
      </div>

      <div class="health-card">
        <div class="label">Ringkasan Data Layanan</div>
        <div class="stat" style="font-size:3rem;color:#fff"><?= $jumlahTempat ?></div>
        <div class="service-legend">
          <div><span class="dot tinggi"></span>Rumah Sakit</div>
          <div><span class="dot sedang"></span>Puskesmas</div>
          <div><span class="dot rendah"></span>Klinik dan Komunitas</div>
        </div>
      </div>
    </section>
  </div>

  <div class="divider"></div>

  <section>
    <div class="section-head">
      <div class="eyebrow">Informasi Aplikasi</div>
      <h2>Data tempat layanan ditampilkan sebagai marker pada peta WebGIS</h2>
    </div>

    <div class="grid-3">
      <div class="card">
        <span class="tag">Objek GIS</span>
        <h3>Tempat Layanan</h3>
        <p>Marker peta berasal dari data tempat layanan kesehatan yang memiliki layanan bagi penyandang disabilitas.</p>
        <div class="stat"><?= $jumlahTempat ?><span style="font-size:.9rem;color:var(--ink-soft)"> Tempat</span></div>
      </div>

      <div class="card">
        <span class="tag">Kategori</span>
        <h3>Fasilitas dan Komunitas</h3>
        <p>Kategori meliputi rumah sakit, puskesmas, klinik, dan komunitas disabilitas.</p>
        <div class="stat">4<span style="font-size:.9rem;color:var(--ink-soft)"> Kategori</span></div>
      </div>

      <div class="card">
        <span class="tag">Detail</span>
        <h3>Informasi Lengkap</h3>
        <p>Setiap tempat memiliki halaman detail berisi foto, kontak, lokasi, dokter, layanan, dan penanggung jawab.</p>
        <div class="stat">1<span style="font-size:.9rem;color:var(--ink-soft)"> Halaman Detail</span></div>
      </div>
    </div>
  </section>

  <section id="daftar-tempat">
    <div class="section-head">
      <div class="eyebrow">Pencarian Tempat</div>
      <h2>Daftar tempat layanan kesehatan</h2>
    </div>

    <form method="get" action="<?= base_url() ?>" class="search-row">
      <input type="hidden" name="halaman" value="dashboard">
      <input type="text" name="q" value="<?= dash_e($q) ?>" placeholder="Cari nama tempat">
      <button type="submit" class="btn">Cari</button>
    </form>

    <div class="grid-3">
      <?php if (count($tempatLayanan) == 0) { ?>
        <div class="card"><h3>Data belum tersedia</h3><p>Silakan cek kembali setelah admin menambahkan data tempat layanan.</p></div>
      <?php } ?>
      <?php foreach ($tempatLayanan as $row) { ?>
        <div class="card">
          <span class="tag"><?= dash_e($row->kategori) ?></span>
          <h3><?= dash_e($row->nama) ?></h3>
          <p><?= dash_e($row->alamat) ?></p>
          <p style="margin-top:10px"><?= dash_e($row->telepon) ?></p>
          <a href="<?= url('dashboard') ?>&section=detail&id=<?= $row->id ?>" class="btn" style="margin-top:16px">Lihat Detail</a>
        </div>
      <?php } ?>
    </div>
  </section>

  <footer>
    <span>WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin</span>
    <span>PHP Native dan Leaflet</span>
  </footer>
</body>

</html>
