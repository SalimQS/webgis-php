<?php
use Dompdf\Dompdf;
use Dompdf\Options;

$title = "Laporan Tempat Layanan";
$judul = $title;
$url = 'report';

function report_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function report_get_data($db)
{
    return $db->ObjectBuilder()->get('tempat_layanan', null, 'nama, kategori, alamat, telepon, latitude, longitude, deskripsi');
}

function report_html($data)
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
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #777; padding: 6px; vertical-align: top; }
            th { background: #d9d9d9; text-align: center; }
            .no { width: 32px; text-align: center; }
            .meta { margin-bottom: 12px; }
            .meta td { border: 0; padding: 2px 0; }
            .footer { position: fixed; left: 0; right: 0; bottom: -25px; text-align: right; font-size: 10px; color: #555; }
            .footer .page:after { content: counter(page); }
        </style>
    </head>
    <body>
        <div class="footer">Halaman <span class="page"></span></div>
        <h2>Laporan WebGIS Layanan Kesehatan Disabilitas Kota Banjarmasin</h2>
        <h3>Data Tempat Layanan</h3>
        <table class="meta">
            <tr><td width="110">Tanggal Cetak</td><td width="10">:</td><td><?= report_escape(date('d-m-Y H:i')) ?></td></tr>
            <tr><td>Jumlah Data</td><td>:</td><td><?= count($data) ?></td></tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data) == 0) { ?>
                    <tr><td colspan="8" style="text-align:center">Tidak ada data</td></tr>
                <?php } ?>
                <?php $no = 1; foreach ($data as $row) { ?>
                    <tr>
                        <td class="no"><?= $no++ ?></td>
                        <td><?= report_escape($row->nama) ?></td>
                        <td><?= report_escape($row->kategori) ?></td>
                        <td><?= report_escape($row->alamat) ?></td>
                        <td><?= report_escape($row->telepon) ?></td>
                        <td><?= report_escape($row->latitude) ?></td>
                        <td><?= report_escape($row->longitude) ?></td>
                        <td><?= report_escape($row->deskripsi) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
    </html>
<?php
    return ob_get_clean();
}

function report_output_pdf($html, $aksi)
{
    if (!class_exists('Dompdf\Dompdf')) {
        die('Library Dompdf belum tersedia. Jalankan composer require dompdf/dompdf terlebih dahulu.');
    }

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('laporan-tempat-layanan.pdf', array('Attachment' => $aksi == 'download' ? 1 : 0));
    exit;
}

if (isset($_GET['aksi'])) {
    $setTemplate = false;
    report_output_pdf(report_html(report_get_data($db)), $_GET['aksi']);
}
?>

<?= content_open('Laporan Tempat Layanan') ?>
<form method="get" action="<?= base_url() ?>">
    <input type="hidden" name="halaman" value="<?= $url ?>">
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
