<?php
$title = "Data Titik Kebakaran";
$judul = $title;
$url = 'firespot';

if (isset($_POST['simpan'])) {
    $file = upload('marker', 'marker');
    if ($file != false) {
        $data['marker'] = $file;
        if ($_POST['id_firespot'] != '') {
            $db->where('id_firespot', $_POST['id_firespot']);
            $get = $db->ObjectBuilder()->getOne('t_firespot');
            if ($get && $get->marker != '' && file_exists('assets/unggah/marker/' . $get->marker)) {
                unlink('assets/unggah/marker/' . $get->marker);
            }
        }
    }

    $data['id_kabupaten'] = $_POST['id_kabupaten'];
    $data['lokasi'] = $_POST['lokasi'];
    $data['keterangan'] = $_POST['keterangan'];
    $data['lat'] = $_POST['lat'];
    $data['lng'] = $_POST['lng'];
    $data['tanggal'] = $_POST['tanggal'];
    $data['luas_terbakar'] = $_POST['luas_terbakar'];
    $data['status'] = $_POST['status'];
    $data['penyebab'] = $_POST['penyebab'];

    if ($_POST['id_firespot'] == "") {
        $exec = $db->insert("t_firespot", $data);
    } else {
        $db->where('id_firespot', $_POST['id_firespot']);
        $exec = $db->update("t_firespot", $data);
    }

    redirect(url($url));
}

if (isset($_GET['hapus'])) {
    $db->where('id_firespot', $_GET['id']);
    $db->delete('t_firespot');
    redirect(url($url));
}

$id_firespot = "";
$id_kabupaten = "";
$lokasi = "";
$keterangan = "";
$lat = "";
$lng = "";
$tanggal = date('Y-m-d');
$luas_terbakar = "";
$status = "Aktif";
$penyebab = "";

if (isset($_GET['ubah'])) {
    $db->where('id_firespot', $_GET['id']);
    $row = $db->ObjectBuilder()->getOne('t_firespot');
    if ($row) {
        extract((array)$row);
    }
}

if (isset($_GET['tambah']) || isset($_GET['ubah'])) {
?>
    <?= content_open('Form Fire Spot') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id_firespot', $id_firespot) ?>

        <label>Lokasi</label>
        <?= input_text('lokasi', $lokasi) ?>

        <label>Kabupaten</label>
        <?php
        $op = ['' => 'Pilih Kabupaten'];
        foreach ($db->ObjectBuilder()->get('m_kabupaten') as $k) {
            $op[$k->id_kabupaten] = $k->nm_kabupaten;
        }
        ?>
        <?= select('id_kabupaten', $op, $id_kabupaten) ?>

        <label>Keterangan</label>
        <?= textarea('keterangan', $keterangan) ?>

        <label>Latitude</label>
        <?= input_text('lat', $lat) ?>

        <label>Longitude</label>
        <?= input_text('lng', $lng) ?>

        <label>Tanggal</label>
        <?= input_date('tanggal', $tanggal) ?>

        <label>Luas Terbakar (Ha)</label>
        <?= input_text('luas_terbakar', $luas_terbakar) ?>

        <label>Status</label>
        <?php
        $st = [
            'Aktif' => 'Aktif',
            'Padam' => 'Padam',
            'Dalam Penanganan' => 'Dalam Penanganan'
        ];
        ?>
        <?= select('status', $st, $status) ?>

        <label>Penyebab</label>
        <?= input_text('penyebab', $penyebab) ?>

        <label>Marker</label>
        <?= input_file('marker', '') ?>

        <br><br>
        <button class="btn btn-info" name="simpan">
            Simpan
        </button>
        <a class="btn btn-danger" href="<?= url($url) ?>">Kembali</a>

    </form>
    <?= content_close() ?>

<?php } else { ?>

    <?= content_open('Data Fire Spot') ?>

    <a href="<?= url($url . '&tambah') ?>" class="btn btn-success">
        Tambah Fire Spot
    </a>

    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Kabupaten</th>
                <th>Luas</th>
                <th>Status</th>
                <th>Penyebab</th>
                <th>Lat</th>
                <th>Lng</th>
                <th>Tanggal</th>
                <th>Marker</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            $db->join('m_kabupaten b', 'a.id_kabupaten=b.id_kabupaten', 'LEFT');
            $data = $db->ObjectBuilder()->get('t_firespot a');

            foreach ($data as $row) {
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->lokasi ?></td>
                    <td><?= $row->nm_kabupaten ?></td>
                    <td><?= $row->luas_terbakar ?> Ha</td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->penyebab ?></td>
                    <td><?= $row->lat ?></td>
                    <td><?= $row->lng ?></td>
                    <td><?= $row->tanggal ?></td>
                    <td><?= ($row->marker == '' ? '-' : '<img src="' . assets('unggah/marker/' . $row->marker) . '" width="40">') ?></td>
                    <td>
                        <a class="btn btn-info" href="<?= url($url . '&ubah&id=' . $row->id_firespot) ?>">Ubah</a>
                        <a class="btn btn-danger" onclick="return confirm('Hapus data?')" href="<?= url($url . '&hapus&id=' . $row->id_firespot) ?>">Hapus</a>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

    <?= content_close() ?>

<?php } ?>