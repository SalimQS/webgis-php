<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Referensi Penelitian — Karhutla Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .info-shell {
      max-width: 820px;
    }

    .info-shell h3 {
      font-family: var(--display);
      font-size: 1.25rem;
      margin: 36px 0 12px;
    }

    .info-shell p {
      color: var(--ink-soft);
    }

    .meta-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 14px;
      margin: 20px 0 8px;
    }

    .meta-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-radius: 4px;
      padding: 16px 18px;
    }

    .meta-card .k {
      font-family: var(--mono);
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--ink-soft);
    }

    .meta-card .v {
      font-family: var(--display);
      font-size: 1.05rem;
      margin-top: 4px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 14px 0 4px;
      font-size: 0.9rem;
    }

    th,
    td {
      padding: 10px 12px;
      border-bottom: 1px solid var(--line);
      text-align: left;
      vertical-align: top;
    }

    th {
      font-family: var(--mono);
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--ink-soft);
      width: 34%;
    }

    .quote {
      border-left: 3px solid var(--ember-deep);
      padding: 6px 0 6px 18px;
      margin: 22px 0;
      font-family: var(--display);
      font-style: italic;
      color: var(--ink);
      font-size: 1.05rem;
    }

    .ref-list {
      font-size: 0.85rem;
      color: var(--ink-soft);
    }

    .ref-list li {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section class="info-shell">
    <div class="section-head">
      <div class="eyebrow">Referensi Penelitian</div>
      <h2>Pemetaan Daerah Potensi Rawan Kebakaran Hutan dan Lahan Menggunakan Sistem Informasi Geografis (SIG) di Kabupaten Kota Waingapu Kabupaten Sumba Timur</h2>
    </div>

    <div class="meta-grid">
      <div class="meta-card">
        <div class="k">Penulis</div>
        <div class="v">Umbu Djima, Jehunias L. Tanesib</div>
      </div>
      <div class="meta-card">
        <div class="k">Institusi</div>
        <div class="v">Prodi Fisika, Fak. Sains &amp; Teknik, Undana</div>
      </div>
      <div class="meta-card">
        <div class="k">Jurnal</div>
        <div class="v">Technologia: Jurnal Ilmiah</div>
      </div>
      <div class="meta-card">
        <div class="k">Terbit</div>
        <div class="v">Vol.15 No.4, Oktober 2024</div>
      </div>
      <div class="meta-card">
        <div class="k">DOI</div>
        <div class="v" style="font-family:var(--mono);font-size:0.85rem;">10.31602/tji.v15i4.16087</div>
      </div>
      <div class="meta-card">
        <div class="k">ISSN</div>
        <div class="v" style="font-size:0.9rem;">p-2086-6917 · e-2656-8047</div>
      </div>
    </div>

    <h3>Abstrak</h3>
    <p>
      Telah dilakukan pemetaan daerah potensi rawan kebakaran hutan dan lahan di Kabupaten Kota
      Waingapu, Kabupaten Sumba Timur, menggunakan Sistem Informasi Geografis. Penelitian bertujuan
      memetakan daerah potensi rawan serta mengklasifikasikan tingkat kerawanannya. Parameter curah
      hujan tercatat 963 mm/tahun (rendah), tutupan lahan didominasi padang rumput seluas 8.586,09 Ha,
      jenis tanah didominasi Kambisol Eutrik seluas 10.609,83 Ha, dan titik api didominasi tingkat
      kepercayaan sedang sebanyak 53 titik. Analisis menggunakan metode overlay dari nilai skoring
      dan bobot tiap parameter.
    </p>

    <h3>Latar Belakang</h3>
    <p>
      Kabupaten Kota Waingapu terletak di 9°38'–9°49' LS dan 120°5'–120°16' BT, seluas 73,8 km²
      di sepanjang pantai utara Sumba Timur — wilayah yang relatif berbatu dan kurang subur
      dibandingkan bagian selatan kabupaten. BMKG pernah merilis peringatan dini bahwa 20
      kabupaten/kota di NTT berpotensi karhutla, termasuk Sumba Timur, dan wilayah ini pernah
      mengalami 249 hari tanpa hujan pada tahun 2019.
    </p>

    <h3>Metode</h3>
    <p>
      Diolah menggunakan QGIS 3.26.1 berdasarkan acuan Peraturan Kepala BNPB No. 2 Tahun 2012,
      dengan tiga parameter utama dan pembobotannya:
    </p>
    <table>
      <tr>
        <th>Parameter</th>
        <td>Sumber data</td>
      </tr>
      <tr>
        <th>Curah hujan (bobot 30%)</th>
        <td>BMKG, data tahun 2023</td>
      </tr>
      <tr>
        <th>Tutupan lahan (bobot 40%)</th>
        <td>Citra satelit Landsat 8 (USGS), klasifikasi terbimbing</td>
      </tr>
      <tr>
        <th>Jenis tanah (bobot 30%)</th>
        <td>BBSDLP, Badan Penelitian &amp; Pengembangan Pertanian</td>
      </tr>
      <tr>
        <th>Titik api (pembanding)</th>
        <td>Brin Fire Hotspot, tahun 2023</td>
      </tr>
    </table>

    <h3>Hasil Utama</h3>
    <table>
      <tr>
        <th>Tingkat rawan tinggi</th>
        <td>10.002,37 Ha (50,65%)</td>
      </tr>
      <tr>
        <th>Tingkat rawan sedang</th>
        <td>5.133,39 Ha (26,00%)</td>
      </tr>
      <tr>
        <th>Tingkat rawan rendah</th>
        <td>4.610,55 Ha (23,35%)</td>
      </tr>
      <tr>
        <th>Total titik api 2023</th>
        <td>73 titik (19 rendah, 53 sedang, 1 tinggi)</td>
      </tr>
      <tr>
        <th>Kesesuaian titik api vs peta</th>
        <td>23 sesuai, 50 tidak sesuai</td>
      </tr>
      <tr>
        <th>Validasi area terbakar</th>
        <td>7 dari 10 titik berada di zona rawan tinggi</td>
      </tr>
    </table>

    <div class="quote">
      "Dengan adanya penelitian ini diharapkan dapat memberikan bahan informasi bagi pemerintah
      serta masyarakat dalam proses penanggulangan kebakaran hutan dan lahan serta dampak yang
      ditimbulkan."
    </div>

    <h3>Kesimpulan</h3>
    <p>
      Empat jenis data (curah hujan, jenis tanah, tutupan lahan, titik api) memiliki pengaruh besar
      terhadap tingkat potensi rawan kebakaran. Metode overlay berdasarkan skoring dan pembobotan
      BNPB berhasil menghasilkan peta klasifikasi rawan yang relatif sesuai dengan kondisi lapangan.
      Penelitian lanjutan disarankan menambah jumlah parameter dan memperbanyak validasi langsung
      di lapangan.
    </p>

    <h3>Referensi</h3>
    <ul class="ref-list">
      <li>Antara. 2022. "Peringatan Dini BMKG, 20 Kabupaten Kota Di NTT Diminta Waspada Karhutla." iNews.id.</li>
      <li>Badan Pusat Statistik Kabupaten Sumba Timur. 2020. <i>In Figures Sumba Timur Dalam Angka.</i></li>
      <li>Bere, S. M. 2019. "Kekeringan Ekstrem, Kabupaten Sumba Timur 249 Hari Tanpa Hujan." KOMPAS.com.</li>
      <li>Kusmajaya, S., dkk. 2019. "Pemetaan Bahaya dan Kerentanan Bencana Kebakaran Hutan dan Lahan di Provinsi Riau." JGEL 3(1):55.</li>
      <li>Purbowaseso, I. B. 2004. <i>Pengendalian Kebakaran Hutan: Suatu Pengantar.</i> Rineka Cipta.</li>
      <li>Syaufina, L. 2008. <i>Kebakaran Hutan dan Lahan di Indonesia: Perilaku Api, Penyebab, dan Dampak Kebakaran.</i> Bayumedia.</li>
      <li>Viviyanti, R., dkk. 2019. "Aplikasi SIG Untuk Pemetaan Bahaya Kebakaran Hutan dan Lahan di Kota Dumai." Media Komunikasi Geografi 20(2):78.</li>
    </ul>
  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>