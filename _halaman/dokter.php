<?php
$title = "Dokter";
$judul = $title;
$url = 'dokter';

function dokter_e($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function dokter_tempat_options($db)
{
	$options = array('' => 'Pilih Tempat Layanan');
	foreach ($db->ObjectBuilder()->get('tempat_layanan') as $row) {
		$options[$row->id] = $row->nama;
	}
	return $options;
}

if (isset($_POST['simpan'])) {
	$data['tempat_layanan_id'] = $_POST['tempat_layanan_id'];
	$data['nama'] = $_POST['nama'];
	$data['alamat'] = $_POST['alamat'];
	$data['spesialis'] = $_POST['spesialis'];
	$data['telepon'] = $_POST['telepon'];

	if ($_POST['id'] == "") {
		$exec = $db->insert("dokter", $data);
		$message = 'Data dokter berhasil ditambah';
	} else {
		$db->where('id', $_POST['id']);
		$exec = $db->update("dokter", $data);
		$message = 'Data dokter berhasil diubah';
	}
	$session->set('info', $exec ? info_success($message) : info_danger('Proses gagal dilakukan: ' . $db->getLastError()));
	redirect(url($url));
}

if (isset($_GET['hapus'])) {
	$setTemplate = false;
	$db->where("id", $_GET['id']);
	$exec = $db->delete("dokter");
	$session->set('info', $exec ? info_success('Data dokter berhasil dihapus') : info_danger('Proses gagal dilakukan'));
	redirect(url($url));
} elseif (isset($_GET['tambah']) or isset($_GET['ubah'])) {
	$id = "";
	$tempat_layanan_id = "";
	$nama = "";
	$alamat = "";
	$spesialis = "";
	$telepon = "";
	if (isset($_GET['ubah']) and isset($_GET['id'])) {
		$db->where('id', $_GET['id']);
		$row = $db->ObjectBuilder()->getOne('dokter');
		if ($db->count > 0) {
			extract((array) $row);
		}
	}
?>
	<?= content_open('Form Dokter') ?>
	<form method="post">
		<?= input_hidden('id', $id) ?>
		<div class="form-group"><label>Tempat Layanan</label><div class="row"><div class="col-md-6"><?= select('tempat_layanan_id', dokter_tempat_options($db), $tempat_layanan_id) ?></div></div></div>
		<div class="form-group"><label>Nama Dokter</label><div class="row"><div class="col-md-6"><?= input_text('nama', dokter_e($nama)) ?></div></div></div>
		<div class="form-group"><label>Alamat</label><div class="row"><div class="col-md-6"><?= textarea('alamat', dokter_e($alamat)) ?></div></div></div>
		<div class="form-group"><label>Spesialis</label><div class="row"><div class="col-md-6"><?= input_text('spesialis', dokter_e($spesialis)) ?></div></div></div>
		<div class="form-group"><label>Telepon</label><div class="row"><div class="col-md-4"><?= input_text('telepon', dokter_e($telepon)) ?></div></div></div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
		</div>
	</form>
	<?= content_close() ?>
<?php } else { ?>
	<?= content_open('Data Dokter') ?>
	<a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
	<hr>
	<?= $session->pull("info") ?>
	<table class="table table-bordered">
		<thead><tr><th>No</th><th>Tempat Layanan</th><th>Nama</th><th>Spesialis</th><th>Telepon</th><th>Aksi</th></tr></thead>
		<tbody>
			<?php
			$no = 1;
			$db->join('tempat_layanan b', 'a.tempat_layanan_id=b.id', 'LEFT');
			$getdata = $db->ObjectBuilder()->get('dokter a', null, 'a.*, b.nama AS nama_tempat');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= dokter_e($row->nama_tempat) ?></td>
					<td><?= dokter_e($row->nama) ?></td>
					<td><?= dokter_e($row->spesialis) ?></td>
					<td><?= dokter_e($row->telepon) ?></td>
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
