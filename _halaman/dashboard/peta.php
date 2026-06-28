<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Interaktif — Karhutla Banjarmasin</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <style type="text/css">
    #map,
    #mapid {
      height: 100%;
    }

    .icon {
      display: inline-block;
      margin: 2px;
      height: 16px;
      width: 16px;
      background-color: #ccc;
    }
  </style>
</head>

<body>
  <?php include __DIR__ . '/navbar.php'; ?>
  <div class="map-shell">
    <aside class="map-sidebar">
      <div class="sidebar-card">
        <div class="sidebar-card-title">Base Map</div>
        <div class="control-group flex flex-col">
          <label class="radio-row mt-2">
            <input type="radio" name="base-layer" value="osm" checked>
            <span class="control-label-text">OpenStreetMap</span>
          </label>
          <label class="radio-row mt-2">
            <input type="radio" name="base-layer" value="cycle">
            <span class="control-label-text">OpenCycleMap</span>
          </label>
          <label class="radio-row mt-2">
            <input type="radio" name="base-layer" value="outdoors">
            <span class="control-label-text">Outdoors</span>
          </label>
        </div>
      </div>

      <div class="sidebar-card mt-5">
        <div class="sidebar-card-title">Layer Kabupaten</div>
        <div class="panel-layers">
          <?php
          $getKabupaten = $db->ObjectBuilder()->get('m_kabupaten');
          if ($db->count > 0) {
            foreach ($getKabupaten as $row) {
          ?>
              <label class="layer-row">
                <input type="checkbox" class="toggle-kabupaten" data-layer-id="kab-<?= $row->id_kabupaten ?>" checked>
                <span class="swatch" style="background:<?= $row->warna_kabupaten ?>"></span> <?= $row->nm_kabupaten ?>
              </label>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </aside>

    <div id="map"></div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="<?= assets('js/leaflet.ajax.js') ?>"></script>
  <script src="<?= assets('js/Leaflet.heat-gh-pages/dist/leaflet-heat.js') ?>"></script>
  <script>
    function iconByName(name) {
      return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
    }

    function popUp(feature, layer) {
      if (!feature || !feature.properties || !feature.geometry || feature.geometry.type !== 'Point') {
        return;
      }
      var out = [];
      if (feature.properties['PROVINSI']) out.push('Provinsi: ' + feature.properties['PROVINSI']);
      if (feature.properties['KABUPATEN']) out.push('Kabupaten: ' + feature.properties['KABUPATEN']);
      layer.bindPopup(out.join('<br />'));
    }

    function featureToMarker(feature, latlng) {
      return L.marker(latlng, {
        icon: L.divIcon({
          className: 'marker-' + (feature.properties ? feature.properties.amenity : ''),
          html: iconByName(feature.properties ? feature.properties.amenity : '#555'),
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        })
      });
    }

    var map = L.map('map').setView([-3.3285005196803144, 114.595341038577], 11);

    var baseLayers = {
      osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }),
      cycle: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png'),
      outdoors: L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
    };

    var currentBaseLayer = baseLayers.osm;
    currentBaseLayer.addTo(map);

    function setBaseLayer(key) {
      if (!baseLayers[key] || baseLayers[key] === currentBaseLayer) return;
      map.removeLayer(currentBaseLayer);
      currentBaseLayer = baseLayers[key];
      map.addLayer(currentBaseLayer);
    }

    var kabupatenLayers = L.layerGroup().addTo(map);
    var kabupatenLayerMap = {};
    var terbakarLayer = L.layerGroup();

    // Build hotspot icon markers from database table t_hotspot
    <?php
    $arrayHotspot = array();
    $db->join('m_kabupaten b', 'a.id_kabupaten=b.id_kabupaten', 'LEFT');
    $hotspotRows = $db->ObjectBuilder()->get('t_hotspot a');
    if ($db->count > 0) {
      foreach ($hotspotRows as $row) {
        $lat = floatval($row->lat);
        $lng = floatval($row->lng);
        if ($lat != 0 && $lng != 0) {
          $iconUrl = ($row->marker == '' ? assets('icons/marker.png') : assets('unggah/marker/' . $row->marker));
          $popup = addslashes('<strong>' . $row->lokasi . '</strong><br><em>' . $row->keterangan . '</em><br>Kabupaten: ' . ($row->nm_kabupaten ?? '') . '<br>Tanggal: ' . $row->tanggal);
          $arrayHotspot[] = "L.marker([$lat, $lng], {icon: L.icon({iconUrl: '$iconUrl', iconSize: [30, 40], iconAnchor: [15, 40]})}).bindPopup('{$popup}')";
        }
      }
    }
    ?>
    var hotspotLayer = L.layerGroup([
      <?= isset($arrayHotspot) ? implode(",\n      ", $arrayHotspot) : '' ?>
    ]).addTo(map);

    <?php
    $getKabupaten = $db->ObjectBuilder()->get('m_kabupaten');
    if ($db->count > 0) {
      foreach ($getKabupaten as $row) {
    ?>
        var myStyle<?= $row->id_kabupaten ?> = {
          "color": "<?= $row->warna_kabupaten ?>",
          "weight": 1,
          "opacity": 1
        };
        var kabupatenLayer<?= $row->id_kabupaten ?> = new L.GeoJSON.AJAX(["<?= assets('unggah/geojson/' . $row->geojson_kabupaten) ?>"], {
          onEachFeature: popUp,
          style: myStyle<?= $row->id_kabupaten ?>,
          pointToLayer: featureToMarker
        });
        kabupatenLayerMap['kab-<?= $row->id_kabupaten ?>'] = kabupatenLayer<?= $row->id_kabupaten ?>;
        kabupatenLayers.addLayer(kabupatenLayer<?= $row->id_kabupaten ?>);
    <?php
      }
    }
    ?>

    document.querySelectorAll('input[name="base-layer"]').forEach(function(input) {
      input.addEventListener('change', function() {
        setBaseLayer(this.value);
      });
    });

    document.querySelectorAll('.toggle-kabupaten').forEach(function(input) {
      input.addEventListener('change', function() {
        var layerId = this.getAttribute('data-layer-id');
        var layer = kabupatenLayerMap[layerId];
        if (!layer) return;
        if (this.checked) {
          kabupatenLayers.addLayer(layer);
        } else {
          kabupatenLayers.removeLayer(layer);
        }
      });
    });

    document.getElementById('toggle-titikapi').addEventListener('change', function() {
      if (this.checked) {
        map.addLayer(hotspotLayer);
      } else {
        map.removeLayer(hotspotLayer);
      }
    });

    document.getElementById('toggle-terbakar').addEventListener('change', function() {
      if (this.checked) {
        map.addLayer(terbakarLayer);
      } else {
        map.removeLayer(terbakarLayer);
      }
    });

    setTimeout(function() {
      try {
        map.invalidateSize();
      } catch (e) {
        console.error(e);
      }
    }, 250);
  </script>
</body>

</html>