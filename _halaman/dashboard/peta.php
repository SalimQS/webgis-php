<?php
$setTemplate = false;

function peta_e($value)
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';
$kategoriList = array('Semua', 'Rumah Sakit', 'Puskesmas', 'Klinik', 'Komunitas Disabilitas');
if ($kategori != 'Semua') {
  $db->where('kategori', $kategori);
}
$rows = $db->ObjectBuilder()->get('tempat_layanan');
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Layanan Kesehatan Disabilitas</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php include __DIR__ . '/navbar.php'; ?>
  <div class="map-shell">
    <aside class="map-sidebar">
      <div class="sidebar-card">
        <div class="sidebar-card-title">Filter Kategori</div>
        <form method="get" action="<?= base_url() ?>" class="control-group">
          <input type="hidden" name="halaman" value="dashboard">
          <input type="hidden" name="section" value="peta">
          <select name="kategori" onchange="this.form.submit()" style="width:100%;padding:12px;border-radius:8px">
            <?php foreach ($kategoriList as $item) { ?>
              <option value="<?= peta_e($item) ?>" <?= $kategori == $item ? 'selected' : '' ?>><?= peta_e($item) ?></option>
            <?php } ?>
          </select>
        </form>
      </div>
      <div class="sidebar-card">
        <div class="sidebar-card-title">Daftar Tempat</div>
        <div class="panel-layers">
          <?php foreach ($rows as $row) { ?>
            <a class="layer-row" href="<?= url('dashboard') ?>&section=detail&id=<?= $row->id ?>">
              <span class="swatch" style="background:#2f80ed"></span>
              <span><?= peta_e($row->nama) ?><br><small><?= peta_e($row->kategori) ?></small></span>
            </a>
          <?php } ?>
        </div>
      </div>
    </aside>
    <div id="map"></div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    var map = L.map('map').setView([-3.3186067, 114.5943784], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var bounds = [];
    <?php foreach ($rows as $row) {
      $lat = (float) $row->latitude;
      $lng = (float) $row->longitude;
      if ($lat == 0 || $lng == 0) {
        continue;
      }
      $popup = '<strong>' . peta_e($row->nama) . '</strong><br>' .
        peta_e($row->kategori) . '<br>' .
        peta_e($row->alamat) . '<br>' .
        '<a href="' . url('dashboard') . '&section=detail&id=' . $row->id . '">Lihat Detail</a>';
    ?>
      L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map).bindPopup(<?= json_encode($popup) ?>);
      bounds.push([<?= $lat ?>, <?= $lng ?>]);
    <?php } ?>

    if (bounds.length > 0) {
      map.fitBounds(bounds, { padding: [30, 30] });
    }
  </script>
</body>

</html>
