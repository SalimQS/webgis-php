<?php
use Dompdf\Dompdf;
use Dompdf\Options;

$title = "Report";
$judul = $title;
$url = 'report';

if ($session->get('level') != 'Admin') {
    redirect(url('beranda'));
}

function report_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function report_date($date)
{
    if ($date == '') {
        return '-';
    }

    $time = strtotime($date);
    if ($time === false) {
        return $date;
    }

    return date('d-m-Y', $time);
}

function report_table_columns($db, $table)
{
    $columns = array();
    $rows = $db->rawQuery('SHOW COLUMNS FROM ' . $table);

    foreach ($rows as $row) {
        if (is_array($row)) {
            $columns[] = $row['Field'];
        } else {
            $columns[] = $row->Field;
        }
    }

    return $columns;
}

function report_config($jenis)
{
    $config = array(
        'kabupaten' => array(
            'label' => 'Data Kabupaten',
            'orientation' => 'portrait',
            'columns' => array(
                'kd_kabupaten' => 'Kode',
                'nm_kabupaten' => 'Nama Kabupaten',
                'geojson_kabupaten' => 'GeoJSON',
                'warna_kabupaten' => 'Warna'
            )
        ),
        'hotspot' => array(
            'label' => 'Data Hotspot',
            'orientation' => 'landscape',
            'columns' => array(
                'lokasi' => 'Lokasi',
                'nm_kabupaten' => 'Kabupaten',
                'keterangan' => 'Keterangan',
                'lat' => 'Latitude',
                'lng' => 'Longitude',
                'tanggal' => 'Tanggal'
            )
        ),
        'firespot' => array(
            'label' => 'Data Fire Spot',
            'orientation' => 'landscape',
            'columns' => array(
                'lokasi' => 'Lokasi',
                'nm_kabupaten' => 'Kabupaten',
                'status' => 'Status',
                'luas_terbakar' => 'Luas Terbakar',
                'penyebab' => 'Penyebab',
                'lat' => 'Latitude',
                'lng' => 'Longitude',
                'tanggal' => 'Tanggal',
                'keterangan' => 'Keterangan'
            )
        ),
        'user' => array(
            'label' => 'Data User',
            'orientation' => 'portrait',
            'columns' => array(
                'nama' => 'Nama',
                'username' => 'Username',
                'level' => 'Level',
                'email' => 'Email'
            )
        )
    );

    return isset($config[$jenis]) ? $config[$jenis] : $config['kabupaten'];
}

function report_get_data($db, $jenis, $tgl_awal, $tgl_akhir)
{
    if ($jenis == 'kabupaten') {
        return $db->ObjectBuilder()->get('m_kabupaten', null, 'kd_kabupaten, nm_kabupaten, geojson_kabupaten, warna_kabupaten');
    }

    if ($jenis == 'hotspot') {
        if ($tgl_awal != '') {
            $db->where('a.tanggal', $tgl_awal, '>=');
        }
        if ($tgl_akhir != '') {
            $db->where('a.tanggal', $tgl_akhir, '<=');
        }
        $db->join('m_kabupaten b', 'a.id_kabupaten=b.id_kabupaten', 'LEFT');
        return $db->ObjectBuilder()->get('t_hotspot a', null, 'a.lokasi, b.nm_kabupaten, a.keterangan, a.lat, a.lng, a.tanggal');
    }

    if ($jenis == 'firespot') {
        if ($tgl_awal != '') {
            $db->where('a.tanggal', $tgl_awal, '>=');
        }
        if ($tgl_akhir != '') {
            $db->where('a.tanggal', $tgl_akhir, '<=');
        }
        $db->join('m_kabupaten b', 'a.id_kabupaten=b.id_kabupaten', 'LEFT');
        return $db->ObjectBuilder()->get('t_firespot a', null, 'a.lokasi, b.nm_kabupaten, a.status, a.luas_terbakar, a.penyebab, a.lat, a.lng, a.tanggal, a.keterangan');
    }

    $columns = report_table_columns($db, 'pengguna');
    $emailSelect = in_array('email', $columns) ? 'email' : '\'-\' AS email';
    $usernameSelect = in_array('username', $columns) ? 'username' : 'nm_pengguna AS username';

    return $db->ObjectBuilder()->get('pengguna', null, 'nm_pengguna AS nama, ' . $usernameSelect . ', level, ' . $emailSelect);
}

function report_html($config, $data, $tgl_awal, $tgl_akhir)
{
    ob_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            @page { margin: 35px 28px 45px 28px; }
            body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #222; }
            h2 { margin: 0; text-align: center; font-size: 17px; }
            h3 { margin: 6px 0 18px 0; text-align: center; font-size: 14px; font-weight: normal; }
            .meta { margin-bottom: 12px; width: 100%; }
            .meta td { padding: 2px 0; border: 0; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #777; padding: 6px; vertical-align: top; }
            th { background: #d9d9d9; text-align: center; }
            .no { width: 32px; text-align: center; }
            .footer { position: fixed; left: 0; right: 0; bottom: -25px; text-align: right; font-size: 10px; color: #555; }
            .footer .page:after { content: counter(page); }
        </style>
    </head>
    <body>
        <div class="footer">Halaman <span class="page"></span></div>
        <h2>Laporan Sistem Informasi Geografis Kebakaran Hutan dan Lahan</h2>
        <h3><?= report_escape($config['label']) ?></h3>

        <table class="meta">
            <tr>
                <td width="110">Tanggal Cetak</td>
                <td width="10">:</td>
                <td><?= report_escape(date('d-m-Y H:i')) ?></td>
            </tr>
            <tr>
                <td>Jumlah Data</td>
                <td>:</td>
                <td><?= count($data) ?></td>
            </tr>
            <?php if ($tgl_awal != '' || $tgl_akhir != '') { ?>
                <tr>
                    <td>Rentang Tanggal</td>
                    <td>:</td>
                    <td><?= report_escape(report_date($tgl_awal)) ?> s/d <?= report_escape(report_date($tgl_akhir)) ?></td>
                </tr>
            <?php } ?>
        </table>

        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <?php foreach ($config['columns'] as $label) { ?>
                        <th><?= report_escape($label) ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) == 0) { ?>
                    <tr>
                        <td colspan="<?= count($config['columns']) + 1 ?>" style="text-align:center">Tidak ada data</td>
                    </tr>
                <?php } ?>
                <?php $no = 1; foreach ($data as $row) { ?>
                    <tr>
                        <td class="no"><?= $no++ ?></td>
                        <?php foreach ($config['columns'] as $field => $label) { ?>
                            <?php
                            $value = isset($row->$field) ? $row->$field : '-';
                            if ($field == 'tanggal' && $value != '-') {
                                $value = report_date($value);
                            }
                            if ($field == 'luas_terbakar' && $value != '-') {
                                $value = $value . ' Ha';
                            }
                            ?>
                            <td><?= report_escape($value) ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
    </html>
<?php
    return ob_get_clean();
}

function report_output_pdf($config, $html, $aksi)
{
    if (!class_exists('Dompdf\Dompdf')) {
        die('Library Dompdf belum tersedia. Jalankan composer require dompdf/dompdf terlebih dahulu.');
    }

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', $config['orientation']);
    $dompdf->render();

    $attachment = ($aksi == 'download') ? 1 : 0;
    $filename = strtolower(str_replace(' ', '-', $config['label'])) . '.pdf';
    $dompdf->stream($filename, array('Attachment' => $attachment));
    exit;
}

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'kabupaten';
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : '';
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : '';

if (isset($_GET['aksi'])) {
    $setTemplate = false;
    $config = report_config($jenis);
    $data = report_get_data($db, $jenis, $tgl_awal, $tgl_akhir);
    $html = report_html($config, $data, $tgl_awal, $tgl_akhir);
    report_output_pdf($config, $html, $_GET['aksi']);
}
?>

<?= content_open('Form Report') ?>
<form method="get" action="<?= base_url() ?>">
    <input type="hidden" name="halaman" value="<?= $url ?>">
    <div class="form-group">
        <label>Jenis Laporan</label>
        <div class="row">
            <div class="col-md-6">
                <?php
                $op = array(
                    'kabupaten' => 'Data Kabupaten',
                    'hotspot' => 'Data Hotspot',
                    'firespot' => 'Data Fire Spot',
                    'user' => 'Data User'
                );
                ?>
                <?= select('jenis', $op, $jenis) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Tanggal Awal</label>
        <div class="row">
            <div class="col-md-4">
                <?= input_date('tgl_awal', $tgl_awal) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Tanggal Akhir</label>
        <div class="row">
            <div class="col-md-4">
                <?= input_date('tgl_akhir', $tgl_akhir) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" name="aksi" value="preview" class="btn btn-info" formtarget="_blank">
            <i class="fa fa-eye"></i> Preview PDF
        </button>
        <button type="submit" name="aksi" value="download" class="btn btn-success">
            <i class="fa fa-download"></i> Download PDF
        </button>
    </div>
</form>
<?= content_close() ?>
