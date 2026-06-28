<?php
$title = "Kabupaten";
$judul = $title;
$url = 'kabupaten';
if ($session->get('level') != 'Admin') {
	redirect(url('beranda'));
}

if (isset($_POST['simpan'])) {
	$file = false;
	if (isset($_FILES['geojson_kabupaten']) && $_FILES['geojson_kabupaten']['error'] != 4) {
		$file = upload('geojson_kabupaten', 'geojson');
	}
	if ($file !== false) {
		$data['geojson_kabupaten'] = $file;
		if ($_POST['id_kabupaten'] != '') {
			// hapus file di dalam folder
			$db->where('id_kabupaten', $_POST['id_kabupaten']);
			$get = $db->ObjectBuilder()->getOne('m_kabupaten');
			$geojson_kabupaten = $get->geojson_kabupaten;
			if ($geojson_kabupaten && file_exists('assets/unggah/geojson/' . $geojson_kabupaten)) {
				unlink('assets/unggah/geojson/' . $geojson_kabupaten);
			}
			// end hapus file di dalam folder
		}
	}


	// cek validasi
	$validation = null;
	// cek kode apakah sudah ada
	if ($_POST['id_kabupaten'] != "") {
		$db->where('id_kabupaten !=' . $_POST['id_kabupaten']);
	}
	$db->where('kd_kabupaten', $_POST['kd_kabupaten']);
	$db->get('m_kabupaten');
	if ($db->count > 0) {
		$validation[] = 'Kode Kabupaten Sudah Ada';
	}

	//tidak boleh kosong
	if ($_POST['nm_kabupaten'] == '') {
		$validation[] = 'Nama Kabupaten Tidak Boleh Kosong';
	}
	if ($_POST['id_kabupaten'] == "" && $file === false) {
		$validation[] = 'File GeoJSON harus diunggah';
	}

	if ($validation != null) {
		$setTemplate = false;
		$session->set('error_validation', $validation);
		$session->set('error_value', $_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	// cek validasi

	if ($_POST['id_kabupaten'] == "") {
		$data['kd_kabupaten'] = $_POST['kd_kabupaten'];
		$data['nm_kabupaten'] = $_POST['nm_kabupaten'];
		$data['warna_kabupaten'] = $_POST['warna_kabupaten'];
		$exec = $db->insert("m_kabupaten", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses Ditambah </div>';
	} else {
		$data['kd_kabupaten'] = $_POST['kd_kabupaten'];
		$data['nm_kabupaten'] = $_POST['nm_kabupaten'];
		$data['warna_kabupaten'] = $_POST['warna_kabupaten'];
		$db->where('id_kabupaten', $_POST['id_kabupaten']);
		$exec = $db->update("m_kabupaten", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses diubah </div>';
	}

	if ($exec) {
		$session->set('info', $info);
	} else {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Proses gagal dilakukan <br>' . $db->getLastError() . '
              </div>');
	}
	redirect(url($url));
}

if (isset($_GET['hapus'])) {
	$setTemplate = false;
	// hapus file di dalam folder
	$db->where('id_kabupaten', $_GET['id']);
	$get = $db->ObjectBuilder()->getOne('m_kabupaten');
	$geojson_kabupaten = $get->geojson_kabupaten;
	unlink('assets/unggah/geojson/' . $geojson_kabupaten);
	// end hapus file di dalam folder
	$db->where("id_kabupaten", $_GET['id']);
	$exec = $db->delete("m_kabupaten");
	$info = '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses dihapus </div>';
	if ($exec) {
		$session->set('info', $info);
	} else {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Proses gagal dilakukan
              </div>');
	}
	redirect(url($url));
} elseif (isset($_GET['tambah']) or isset($_GET['ubah'])) {
	$id_kabupaten = "";
	$kd_kabupaten = "";
	$nm_kabupaten = "";
	$geojson_kabupaten = "";
	$warna_kabupaten = "";
	if (isset($_GET['ubah']) and isset($_GET['id'])) {
		$id = $_GET['id'];
		$db->where('id_kabupaten', $id);
		$row = $db->ObjectBuilder()->getOne('m_kabupaten');
		if ($db->count > 0) {
			$id_kabupaten = $row->id_kabupaten;
			$kd_kabupaten = $row->kd_kabupaten;
			$nm_kabupaten = $row->nm_kabupaten;
			$geojson_kabupaten = $row->geojson_kabupaten;
			$warna_kabupaten = $row->warna_kabupaten;
		}
	}
	// value ketika validasi
	if ($session->get('error_value')) {
		extract($session->pull('error_value'));
	}
?>
	<?= content_open('Form Kabupaten') ?>
	<form method="post" enctype="multipart/form-data">
		<?php
		// menampilkan error validasi
		if ($session->get('error_validation')) {
			foreach ($session->pull('error_validation') as $key => $value) {
				echo '<div class="alert alert-danger">' . $value . '</div>';
			}
		}
		if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['upload_error'])) {
			echo '<div class="alert alert-danger">' . $_SESSION['upload_error'] . ' ' . ($_SESSION['upload_error_details'] ?? '') . '</div>';
			unset($_SESSION['upload_error']);
		}    	
		?>
		<?= input_hidden('id_kabupaten', $id_kabupaten) ?>
		<div class="form-group">
			<label>Kode Kabupaten</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('kd_kabupaten', $kd_kabupaten) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Nama Kabupaten</label>
			<div class="row">
				<div class="col-md-6">
					<?= input_text('nm_kabupaten', $nm_kabupaten) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>GeoJSON</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_file('geojson_kabupaten', $geojson_kabupaten) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Warna</label>
			<div class="row">
				<div class="col-md-3">
					<?= input_color('warna_kabupaten', $warna_kabupaten) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
		</div>
	</form>
	<?= content_close() ?>

<?php  } else { ?>
	<?= content_open('Data Kabupaten') ?>

	<a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
	<hr>
	<?= $session->pull("info") ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Kabupaten</th>
				<th>GeoJSON</th>
				<th>Warna</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$getdata = $db->ObjectBuilder()->get('m_kabupaten');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row->kd_kabupaten ?></td>
					<td><?= $row->nm_kabupaten ?></td>
					<td><a href="<?= assets('unggah/geojson/' . $row->geojson_kabupaten) ?>" target="_BLANK"><?= $row->geojson_kabupaten ?></a></td>
					<td style="background: <?= $row->warna_kabupaten ?>"></td>
					<td>
						<a href="<?= url($url . '&ubah&id=' . $row->id_kabupaten) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
						<a href="<?= url($url . '&hapus&id=' . $row->id_kabupaten) ?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
					</td>
				</tr>
			<?php
				$no++;
			}

			?>
		</tbody>
	</table>
	<?= content_close() ?>
<?php } ?>