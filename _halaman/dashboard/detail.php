<?php
$setTemplate = false;

function detail_e($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$db->where('id', $id);
$tempat = $db->ObjectBuilder()->getOne('tempat_layanan');
if (!$tempat) {
  include __DIR__ . '/../error.php';
  return;
}

$db->where('tempat_layanan_id', $id);
$dokter = $db->ObjectBuilder()->get('dokter');
$db->where('tempat_layanan_id', $id);
$layanan = $db->ObjectBuilder()->get('layanan');
$db->where('tempat_layanan_id', $id);
$penanggungJawab = $db->ObjectBuilder()->get('penanggung_jawab');
$mapsUrl = 'https://www.google.com/maps?q=' . urlencode($tempat->latitude . ',' . $tempat->longitude);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= detail_e($tempat->nama) ?></title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
<section>
  <div class="section-head">
    <div class="eyebrow"><?= detail_e($tempat->kategori) ?></div>
    <h2><?= detail_e($tempat->nama) ?></h2>
  </div>
  <div class="grid-3">
    <div class="card" style="grid-column:span 1">
      <?php if ($tempat->foto != '') { ?>
        <img src="<?= assets('unggah/tempat_layanan/' . $tempat->foto) ?>" alt="<?= detail_e($tempat->nama) ?>" style="width:100%;height:220px;object-fit:cover;margin-bottom:16px">
      <?php } ?>
      <p><?= detail_e($tempat->alamat) ?></p>
      <p style="margin-top:10px"><?= detail_e($tempat->telepon) ?></p>
      <p style="margin-top:10px"><?= detail_e($tempat->deskripsi) ?></p>
      <a href="<?= $mapsUrl ?>" target="_blank" class="btn" style="margin-top:16px">Buka Google Maps</a>
    </div>
    <div class="card" style="grid-column:span 2">
      <div id="map" style="height:360px"></div>
    </div>
  </div>
</section>
<section>
  <div class="grid-3">
    <div class="card">
      <span class="tag">Dokter</span>
      <?php foreach ($dokter as $row) { ?>
        <h3><?= detail_e($row->nama) ?></h3>
        <p><?= detail_e($row->spesialis) ?> - <?= detail_e($row->telepon) ?></p>
      <?php } ?>
      <?php if (count($dokter) == 0) { ?><p>Belum ada data dokter.</p><?php } ?>
    </div>
    <div class="card">
      <span class="tag">Layanan</span>
      <?php foreach ($layanan as $row) { ?>
        <h3><?= detail_e($row->nama_layanan) ?></h3>
        <p><?= detail_e($row->keterangan) ?></p>
      <?php } ?>
      <?php if (count($layanan) == 0) { ?><p>Belum ada data layanan.</p><?php } ?>
    </div>
    <div class="card">
      <span class="tag">Penanggung Jawab</span>
      <?php foreach ($penanggungJawab as $row) { ?>
        <h3><?= detail_e($row->nama) ?></h3>
        <p><?= detail_e($row->jabatan) ?> - <?= detail_e($row->telepon) ?></p>
      <?php } ?>
      <?php if (count($penanggungJawab) == 0) { ?><p>Belum ada data penanggung jawab.</p><?php } ?>
    </div>
  </div>
</section>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  var lat = <?= (float) $tempat->latitude ?>;
  var lng = <?= (float) $tempat->longitude ?>;
  var map = L.map('map').setView([lat, lng], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  L.marker([lat, lng]).addTo(map).bindPopup(<?= json_encode($tempat->nama) ?>);
</script>
</body>
</html>
