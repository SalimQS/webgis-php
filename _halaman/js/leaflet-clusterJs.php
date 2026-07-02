<script>
  var map = L.map('mapid').setView([-3.3186067, 114.5943784], 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  var markers = L.markerClusterGroup ? L.markerClusterGroup() : L.layerGroup();
  <?php foreach ($db->ObjectBuilder()->get('tempat_layanan') as $row) {
    $lat = (float) $row->latitude;
    $lng = (float) $row->longitude;
    if ($lat == 0 || $lng == 0) continue;
    $popup = '<strong>' . htmlspecialchars($row->nama, ENT_QUOTES, 'UTF-8') . '</strong><br>' .
      htmlspecialchars($row->kategori, ENT_QUOTES, 'UTF-8') . '<br>' .
      htmlspecialchars($row->alamat, ENT_QUOTES, 'UTF-8');
  ?>
    markers.addLayer(L.marker([<?= $lat ?>, <?= $lng ?>]).bindPopup(<?= json_encode($popup) ?>));
  <?php } ?>
  map.addLayer(markers);
</script>
