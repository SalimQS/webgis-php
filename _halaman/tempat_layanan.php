<?php
$title = "Tempat Layanan";
$judul = $title;
$url = 'tempat_layanan';

function tl_e($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function tl_categories()
{
	return array(
		'' => 'Pilih Kategori',
		'Rumah Sakit' => 'Rumah Sakit',
		'Puskesmas' => 'Puskesmas',
		'Klinik' => 'Klinik',
		'Komunitas Disabilitas' => 'Komunitas Disabilitas'
	);
}

if (isset($_POST['simpan'])) {
	$file = upload('foto', 'tempat_layanan');
	if ($file != false) {
		$data['foto'] = $file;
		if ($_POST['id'] != '') {
			$db->where('id', $_POST['id']);
			$get = $db->ObjectBuilder()->getOne('tempat_layanan');
			if ($get && $get->foto != '' && file_exists('assets/unggah/tempat_layanan/' . $get->foto)) {
				unlink('assets/unggah/tempat_layanan/' . $get->foto);
			}
		}
	}

	$data['nama'] = $_POST['nama'];
	$data['kategori'] = $_POST['kategori'];
	$data['alamat'] = $_POST['alamat'];
	$data['latitude'] = $_POST['latitude'];
	$data['longitude'] = $_POST['longitude'];
	$data['telepon'] = $_POST['telepon'];
	$data['deskripsi'] = $_POST['deskripsi'];

	if ($_POST['id'] == "") {
		$exec = $db->insert("tempat_layanan", $data);
		$message = 'Data tempat layanan berhasil ditambah';
	} else {
		$db->where('id', $_POST['id']);
		$exec = $db->update("tempat_layanan", $data);
		$message = 'Data tempat layanan berhasil diubah';
	}

	$session->set('info', $exec ? info_success($message) : info_danger('Proses gagal dilakukan: ' . $db->getLastError()));
	redirect(url($url));
}

if (isset($_GET['hapus'])) {
	$setTemplate = false;
	$db->where('id', $_GET['id']);
	$get = $db->ObjectBuilder()->getOne('tempat_layanan');
	if ($get && $get->foto != '' && file_exists('assets/unggah/tempat_layanan/' . $get->foto)) {
		unlink('assets/unggah/tempat_layanan/' . $get->foto);
	}
	$db->where("id", $_GET['id']);
	$exec = $db->delete("tempat_layanan");
	$session->set('info', $exec ? info_success('Data tempat layanan berhasil dihapus') : info_danger('Proses gagal dilakukan'));
	redirect(url($url));
} elseif (isset($_GET['tambah']) or isset($_GET['ubah'])) {
	$id = "";
	$nama = "";
	$kategori = "";
	$alamat = "";
	$latitude = "-3.3186067";
	$longitude = "114.5943784";
	$telepon = "";
	$deskripsi = "";
	$foto = "";

	if (isset($_GET['ubah']) and isset($_GET['id'])) {
		$db->where('id', $_GET['id']);
		$row = $db->ObjectBuilder()->getOne('tempat_layanan');
		if ($db->count > 0) {
			extract((array) $row);
		}
	}
?>
	<?= content_open('Form Tempat Layanan') ?>
	<form method="post" enctype="multipart/form-data">
		<?= input_hidden('id', $id) ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group"><label>Nama Tempat</label><?= input_text('nama', tl_e($nama)) ?></div>
				<div class="form-group"><label>Kategori</label><?= select('kategori', tl_categories(), $kategori) ?></div>
				<div class="form-group"><label>Alamat</label><?= textarea('alamat', tl_e($alamat)) ?></div>
				<div class="form-group"><label>Telepon</label><?= input_text('telepon', tl_e($telepon)) ?></div>
				<div class="form-group"><label>Deskripsi</label><?= textarea('deskripsi', tl_e($deskripsi)) ?></div>
				<div class="form-group"><label>Foto</label><?= input_file('foto', '') ?></div>
				<?php if ($foto != '') { ?>
					<p><img src="<?= assets('unggah/tempat_layanan/' . $foto) ?>" width="120" alt="<?= tl_e($nama) ?>"></p>
				<?php } ?>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Koordinat</label>
					<div class="row">
						<div class="col-md-6"><?= input_text('latitude', tl_e($latitude), '', 'id="latitude"') ?></div>
						<div class="col-md-6"><?= input_text('longitude', tl_e($longitude), '', 'id="longitude"') ?></div>
					</div>
				</div>
				<div id="mapid" style="height:420px"></div>
				<p class="help-block">Klik peta untuk memindahkan marker dan mengisi koordinat otomatis.</p>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
		</div>
	</form>
	<?= content_close() ?>
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
	<script>
		var latInput = document.getElementById('latitude');
		var lngInput = document.getElementById('longitude');
		var startLat = parseFloat(latInput.value) || -3.3186067;
		var startLng = parseFloat(lngInput.value) || 114.5943784;
		var map = L.map('mapid').setView([startLat, startLng], 13);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; OpenStreetMap contributors'
		}).addTo(map);
		var marker = L.marker([startLat, startLng], { draggable: true }).addTo(map);
		function setCoordinate(latlng) {
			marker.setLatLng(latlng);
			latInput.value = latlng.lat.toFixed(7);
			lngInput.value = latlng.lng.toFixed(7);
		}
		map.on('click', function(e) { setCoordinate(e.latlng); });
		marker.on('dragend', function(e) { setCoordinate(e.target.getLatLng()); });
	</script>
<?php } else { ?>
	<?= content_open('Data Tempat Layanan') ?>
	<a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
	<hr>
	<?= $session->pull("info") ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Kategori</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Koordinat</th>
				<th>Foto</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$getdata = $db->ObjectBuilder()->get('tempat_layanan');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= tl_e($row->nama) ?></td>
					<td><?= tl_e($row->kategori) ?></td>
					<td><?= tl_e($row->alamat) ?></td>
					<td><?= tl_e($row->telepon) ?></td>
					<td><?= tl_e($row->latitude) ?>, <?= tl_e($row->longitude) ?></td>
					<td class="text-center"><?= ($row->foto == '' ? '-' : '<img src="' . assets('unggah/tempat_layanan/' . $row->foto) . '" width="50">') ?></td>
					<td>
						<a href="<?= url($url . '&ubah&id=' . $row->id) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
						<a href="<?= url($url . '&hapus&id=' . $row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?= content_close() ?>
<?php } ?>
