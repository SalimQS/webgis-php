<script>
  var map = L.map('mapid').setView([-3.3186067, 114.5943784], 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
  <?php foreach ($db->ObjectBuilder()->get('tempat_layanan') as $row) {
    $lat = (float) $row->latitude;
    $lng = (float) $row->longitude;
    if ($lat == 0 || $lng == 0) continue;
  ?>
    L.marker([<?= $lat ?>, <?= $lng ?>]).addTo(map).bindPopup(<?= json_encode($row->nama) ?>);
  <?php } ?>
</script>
