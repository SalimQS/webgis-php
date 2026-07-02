<?php
use Dompdf\Dompdf;
use Dompdf\Options;

$title = "Laporan";
$judul = $title;
$url = 'report';

function report_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function report_config($jenis)
{
    $configs = array(
        'tempat_layanan' => array(
            'label' => 'Laporan Tempat Layanan',
            'orientation' => 'landscape',
            'columns' => array(
                'nama' => 'Nama',
                'kategori' => 'Kategori',
                'alamat' => 'Alamat',
                'telepon' => 'Telepon',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
                'deskripsi' => 'Deskripsi'
            )
        ),
        'dokter' => array(
            'label' => 'Laporan Dokter',
            'orientation' => 'landscape',
            'columns' => array(
                'nama_tempat' => 'Tempat Layanan',
                'nama' => 'Nama Dokter',
                'alamat' => 'Alamat',
                'spesialis' => 'Spesialis',
                'telepon' => 'Telepon'
            )
        ),
        'layanan' => array(
            'label' => 'Laporan Layanan',
            'orientation' => 'landscape',
            'columns' => array(
                'nama_tempat' => 'Tempat Layanan',
                'nama_layanan' => 'Nama Layanan',
                'keterangan' => 'Keterangan'
            )
        ),
        'penanggung_jawab' => array(
            'label' => 'Laporan Penanggung Jawab',
            'orientation' => 'landscape',
            'columns' => array(
                'nama_tempat' => 'Tempat Layanan',
                'nama' => 'Nama',
                'jabatan' => 'Jabatan',
                'telepon' => 'Telepon'
            )
        ),
        'pengguna' => array(
            'label' => 'Laporan Pengguna',
            'orientation' => 'portrait',
            'columns' => array(
                'nm_pengguna' => 'Nama Pengguna',
                'level' => 'Level'
            )
        )
    );

    return isset($configs[$jenis]) ? $configs[$jenis] : $configs['tempat_layanan'];
}

function report_get_data($db, $jenis)
{
    if ($jenis == 'dokter') {
        $db->join('tempat_layanan b', 'a.tempat_layanan_id=b.id', 'LEFT');
        return $db->ObjectBuilder()->get('dokter a', null, 'b.nama AS nama_tempat, a.nama, a.alamat, a.spesialis, a.telepon');
    }

    if ($jenis == 'layanan') {
        $db->join('tempat_layanan b', 'a.tempat_layanan_id=b.id', 'LEFT');
        return $db->ObjectBuilder()->get('layanan a', null, 'b.nama AS nama_tempat, a.nama_layanan, a.keterangan');
    }

    if ($jenis == 'penanggung_jawab') {
        $db->join('tempat_layanan b', 'a.tempat_layanan_id=b.id', 'LEFT');
        return $db->ObjectBuilder()->get('penanggung_jawab a', null, 'b.nama AS nama_tempat, a.nama, a.jabatan, a.telepon');
    }

    if ($jenis == 'pengguna') {
        return $db->ObjectBuilder()->get('pengguna', null, 'nm_pengguna, level');
    }

    return $db->ObjectBuilder()->get('tempat_layanan', null, 'nama, kategori, alamat, telepon, latitude, longitude, deskripsi');
}

function report_html($config, $data)
{
    ob_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            @page { margin: 35px 28px 45px 28px; }
            body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #223; }
            h2 { margin: 0; text-align: center; font-size: 17px; }
            h3 { margin: 6px 0 18px 0; text-align: center; font-size: 14px; font-weight: normal; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #777; padding: 6px; vertical-align: top; }
            th { background: #dff3f2; text-align: center; }
            .no { width: 32px; text-align: center; }
            .meta { margin-bottom: 12px; }
            .meta td { border: 0; padding: 2px 0; }
            .footer { position: fixed; left: 0; right: 0; bottom: -25px; text-align: right; font-size: 10px; color: #555; }
            .footer .page:after { content: counter(page); }
        </style>
    </head>
    <body>
        <div class="footer">Halaman <span class="page"></span></div>
        <h2>WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin</h2>
        <h3><?= report_escape($config['label']) ?></h3>
        <table class="meta">
            <tr><td width="110">Tanggal Cetak</td><td width="10">:</td><td><?= report_escape(date('d-m-Y H:i')) ?></td></tr>
            <tr><td>Jumlah Data</td><td>:</td><td><?= count($data) ?></td></tr>
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
                    <tr><td colspan="<?= count($config['columns']) + 1 ?>" style="text-align:center">Tidak ada data</td></tr>
                <?php } ?>
                <?php $no = 1; foreach ($data as $row) { ?>
                    <tr>
                        <td class="no"><?= $no++ ?></td>
                        <?php foreach ($config['columns'] as $field => $label) { ?>
                            <td><?= report_escape(isset($row->$field) ? $row->$field : '-') ?></td>
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
    $filename = strtolower(str_replace(' ', '-', $config['label'])) . '.pdf';
    $dompdf->stream($filename, array('Attachment' => $aksi == 'download' ? 1 : 0));
    exit;
}

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'tempat_layanan';
$config = report_config($jenis);

if (isset($_GET['aksi'])) {
    $setTemplate = false;
    report_output_pdf($config, report_html($config, report_get_data($db, $jenis)), $_GET['aksi']);
}
?>

<?= content_open('Form Laporan') ?>
<form method="get" action="<?= base_url() ?>">
    <input type="hidden" name="halaman" value="<?= $url ?>">
    <div class="form-group">
        <label>Jenis Laporan</label>
        <div class="row">
            <div class="col-md-5">
                <?php
                $op = array(
                    'tempat_layanan' => 'Tempat Layanan',
                    'dokter' => 'Dokter',
                    'layanan' => 'Layanan',
                    'penanggung_jawab' => 'Penanggung Jawab',
                    'pengguna' => 'Pengguna'
                );
                ?>
                <?= select('jenis', $op, $jenis) ?>
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
