<?php
$title = "Layanan";
$judul = $title;
$url = 'layanan';

function layanan_e($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function layanan_tempat_options($db)
{
	$options = array('' => 'Pilih Tempat Layanan');
	foreach ($db->ObjectBuilder()->get('tempat_layanan') as $row) {
		$options[$row->id] = $row->nama;
	}
	return $options;
}

if (isset($_POST['simpan'])) {
	$data['tempat_layanan_id'] = $_POST['tempat_layanan_id'];
	$data['nama_layanan'] = $_POST['nama_layanan'];
	$data['keterangan'] = $_POST['keterangan'];
	if ($_POST['id'] == "") {
		$exec = $db->insert("layanan", $data);
		$message = 'Data layanan berhasil ditambah';
	} else {
		$db->where('id', $_POST['id']);
		$exec = $db->update("layanan", $data);
		$message = 'Data layanan berhasil diubah';
	}
	$session->set('info', $exec ? info_success($message) : info_danger('Proses gagal dilakukan: ' . $db->getLastError()));
	redirect(url($url));
}

if (isset($_GET['hapus'])) {
	$setTemplate = false;
	$db->where("id", $_GET['id']);
	$exec = $db->delete("layanan");
	$session->set('info', $exec ? info_success('Data layanan berhasil dihapus') : info_danger('Proses gagal dilakukan'));
	redirect(url($url));
} elseif (isset($_GET['tambah']) or isset($_GET['ubah'])) {
	$id = "";
	$tempat_layanan_id = "";
	$nama_layanan = "";
	$keterangan = "";
	if (isset($_GET['ubah']) and isset($_GET['id'])) {
		$db->where('id', $_GET['id']);
		$row = $db->ObjectBuilder()->getOne('layanan');
		if ($db->count > 0) {
			extract((array) $row);
		}
	}
?>
	<?= content_open('Form Layanan') ?>
	<form method="post">
		<?= input_hidden('id', $id) ?>
		<div class="form-group"><label>Tempat Layanan</label><div class="row"><div class="col-md-6"><?= select('tempat_layanan_id', layanan_tempat_options($db), $tempat_layanan_id) ?></div></div></div>
		<div class="form-group"><label>Nama Layanan</label><div class="row"><div class="col-md-6"><?= input_text('nama_layanan', layanan_e($nama_layanan)) ?></div></div></div>
		<div class="form-group"><label>Keterangan</label><div class="row"><div class="col-md-6"><?= textarea('keterangan', layanan_e($keterangan)) ?></div></div></div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
		</div>
	</form>
	<?= content_close() ?>
<?php } else { ?>
	<?= content_open('Data Layanan') ?>
	<a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
	<hr>
	<?= $session->pull("info") ?>
	<table class="table table-bordered">
		<thead><tr><th>No</th><th>Tempat Layanan</th><th>Nama Layanan</th><th>Keterangan</th><th>Aksi</th></tr></thead>
		<tbody>
			<?php
			$no = 1;
			$db->join('tempat_layanan b', 'a.tempat_layanan_id=b.id', 'LEFT');
			$getdata = $db->ObjectBuilder()->get('layanan a', null, 'a.*, b.nama AS nama_tempat');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= layanan_e($row->nama_tempat) ?></td>
					<td><?= layanan_e($row->nama_layanan) ?></td>
					<td><?= layanan_e($row->keterangan) ?></td>
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
