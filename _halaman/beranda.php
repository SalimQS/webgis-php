<?php
$title = "Dashboard Admin";
$judul = $title;

function admin_count_table($db, $table)
{
  $db->get($table);
  return (int) $db->count;
}

$jumlahTempat = admin_count_table($db, 'tempat_layanan');
$jumlahDokter = admin_count_table($db, 'dokter');
$jumlahLayanan = admin_count_table($db, 'layanan');
$jumlahUser = admin_count_table($db, 'pengguna');
?>
<section class="content">
  <?= $session->pull("info") ?>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner"><h3><?= $jumlahTempat ?></h3><p>Tempat Layanan</p></div>
        <div class="icon"><i class="fa fa-hospital-o"></i></div>
        <a href="<?= url('tempat_layanan') ?>" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner"><h3><?= $jumlahDokter ?></h3><p>Dokter</p></div>
        <div class="icon"><i class="fa fa-user-md"></i></div>
        <a href="<?= url('dokter') ?>" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner"><h3><?= $jumlahLayanan ?></h3><p>Layanan</p></div>
        <div class="icon"><i class="fa fa-medkit"></i></div>
        <a href="<?= url('layanan') ?>" class="small-box-footer">Kelola <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner"><h3><?= $jumlahUser ?></h3><p>Pengguna</p></div>
        <div class="icon"><i class="fa fa-users"></i></div>
        <a href="#" class="small-box-footer">Sistem Login Aktif</a>
      </div>
    </div>
  </div>
</section>
