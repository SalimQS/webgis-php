<?php
if (!isset($section)) {
    $section = isset($_GET['section']) ? $_GET['section'] : 'index';
}
$sections = [
    'index' => 'Beranda',
    'peta' => 'Peta Layanan',
    'referensi-penelitian' => 'Referensi',
    'informasi-kelompok' => 'Kelompok',
];
$logged = isset($session) && $session->get('logged') === true;
?>
<header class="topbar">
    <a href="<?= url('dashboard') ?>" class="brand">Layanan Kesehatan Disabilitas<small>WebGIS Kota Banjarmasin</small></a>
    <nav>
        <?php foreach ($sections as $key => $label): ?>
            <?php $href = url('dashboard') . ($key === 'index' ? '' : '&section=' . $key); ?>
            <a href="<?= $href ?>" class="<?= $key === $section ? 'active' : '' ?>"><?= $label ?></a>
        <?php endforeach; ?>
    </nav>
    <div class="cta">
        <a href="<?= $logged ? url('beranda') : url('login'); ?>" class="btn"><?= $logged ? 'Beranda' : 'Login'; ?></a>
    </div>
</header>
