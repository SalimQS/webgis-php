<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Kelompok — Karhutla Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .team-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-top: 10px;
    }

    .team-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 4px;
      padding: 22px;
      text-align: center;
    }

    .avatar {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      margin: 0 auto 14px;
      background: var(--ink);
      color: var(--khaki);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--display);
      font-size: 1.3rem;
      font-weight: 600;
    }

    .team-card h3 {
      font-family: var(--display);
      font-size: 1.05rem;
      margin: 0 0 4px;
    }

    .team-card .role {
      font-family: var(--mono);
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--ember-deep);
      margin-bottom: 8px;
    }

    .team-card .nim {
      font-family: var(--mono);
      font-size: 0.78rem;
      color: var(--ink-soft);
    }

    .edit-hint {
      margin-top: 36px;
      border: 1px dashed var(--line);
      border-radius: 4px;
      padding: 16px 18px;
      font-size: 0.85rem;
      color: var(--ink-soft);
    }
  </style>
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section>
    <div class="section-head">
      <div class="eyebrow">Informasi Kelompok</div>
      <h2>Tim Pengembang</h2>
    </div>

    <div class="team-grid">
      <div class="team-card">
        <div class="avatar">A</div>
        <h3>Nama Anggota 1</h3>
        <div class="role">Ketua Kelompok</div>
        <div class="nim">NIM. 0000000001</div>
      </div>
      <div class="team-card">
        <div class="avatar">B</div>
        <h3>Nama Anggota 2</h3>
        <div class="role">Pengembang Sistem</div>
        <div class="nim">NIM. 0000000002</div>
      </div>
      <div class="team-card">
        <div class="avatar">C</div>
        <h3>Nama Anggota 3</h3>
        <div class="role">Analis Data</div>
        <div class="nim">NIM. 0000000003</div>
      </div>
    </div>

    <div class="edit-hint">
      Halaman ini placeholder — ganti nama, peran, NIM, dan foto/avatar sesuai anggota kelompok yang sebenarnya.
      Tambahkan kartu baru dengan menyalin blok <code>.team-card</code> di atas.
    </div>
  </section>

  <section>
    <div class="section-head">
      <div class="eyebrow">Tentang Proyek Ini</div>
      <h2>Catatan Pengembangan</h2>
    </div>
    <p style="color:var(--ink-soft);max-width:700px;">
      Tuliskan di sini latar belakang kelompok, pembagian tugas, mata kuliah/tugas akhir terkait,
      serta dosen pembimbing jika perlu dicantumkan. Bagian ini bebas diisi sesuai kebutuhan.
    </p>
  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>