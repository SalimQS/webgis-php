<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistik — Karhutla Banjarmasin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .bars {
      display: flex;
      align-items: flex-end;
      gap: 18px;
      height: 240px;
      margin-top: 30px;
    }

    .bar-col {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-end;
      height: 100%;
    }

    .bar-col .bar {
      width: 100%;
      border-radius: 3px 3px 0 0;
    }

    .bar-col .val {
      font-family: var(--mono);
      font-size: 0.8rem;
      margin-bottom: 6px;
    }

    .bar-col .name {
      font-family: var(--mono);
      font-size: 0.72rem;
      color: var(--ink-soft);
      margin-top: 8px;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      font-size: 0.88rem;
    }

    th,
    td {
      padding: 10px 12px;
      border-bottom: 1px solid var(--line);
      text-align: left;
    }

    th {
      font-family: var(--mono);
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: var(--ink-soft);
    }

    .cards-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .stat-card {
      border: 1px solid var(--line);
      padding: 22px;
      background: rgba(255, 255, 255, .15);
    }

    .stat-card span {
      display: block;
      font-family: var(--mono);
      font-size: .72rem;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin-bottom: 10px;
      letter-spacing: .08em;
    }

    .stat-card strong {
      font-size: 2rem;
      font-weight: 600;
    }

    @media(max-width:900px) {

      .cards-grid {
        grid-template-columns: repeat(2, 1fr);
      }

    }

    @media(max-width:600px) {

      .cards-grid {
        grid-template-columns: 1fr;
      }

    }
  </style>
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section>

    <div class="section-head">
      <div class="eyebrow">Ringkasan Data</div>
      <h2>Statistik Potensi Rawan Karhutla Kota Banjarmasin</h2>
    </div>

    <div class="bars">

      <div class="bar-col">
        <div class="val">2.845 Ha</div>
        <div class="bar" style="height:100%;background:var(--ember)"></div>
        <div class="name">Banjarmasin Selatan</div>
      </div>

      <div class="bar-col">
        <div class="val">2.430 Ha</div>
        <div class="bar" style="height:86%;background:var(--ember)"></div>
        <div class="name">Banjarmasin Timur</div>
      </div>

      <div class="bar-col">
        <div class="val">1.965 Ha</div>
        <div class="bar" style="height:69%;background:var(--ochre)"></div>
        <div class="name">Banjarmasin Barat</div>
      </div>

      <div class="bar-col">
        <div class="val">1.280 Ha</div>
        <div class="bar" style="height:45%;background:var(--olive)"></div>
        <div class="name">Banjarmasin Utara</div>
      </div>

      <div class="bar-col">
        <div class="val">865 Ha</div>
        <div class="bar" style="height:30%;background:var(--olive)"></div>
        <div class="name">Banjarmasin Tengah</div>
      </div>

    </div>

    <p style="font-size:.82rem;color:var(--ink-soft);margin-top:12px">
      Data ditampilkan berdasarkan hasil analisis overlay parameter kerawanan kebakaran hutan dan lahan pada wilayah Kota Banjarmasin.
    </p>

  </section>

  <div class="divider"></div>

  <section>

    <div class="cards-grid">

      <div class="stat-card">
        <span>Total Kabupaten</span>
        <strong>5</strong>
      </div>

      <div class="stat-card">
        <span>Luas Risiko Tinggi</span>
        <strong>4.590 Ha</strong>
      </div>

      <div class="stat-card">
        <span>Total Titik Api</span>
        <strong>43</strong>
      </div>

      <div class="stat-card">
        <span>Luas Wilayah Analisis</span>
        <strong>9.385 Ha</strong>
      </div>

    </div>

  </section>

  <div class="divider"></div>

  <section>

    <div class="section-head">
      <div class="eyebrow">Detail Wilayah</div>
      <h2>Rekapitulasi Potensi Rawan per Kabupaten</h2>
    </div>

    <table>

      <thead>
        <tr>
          <th>Kabupaten</th>
          <th>Risiko Tinggi</th>
          <th>Risiko Sedang</th>
          <th>Risiko Rendah</th>
          <th>Total</th>
          <th>Titik Api</th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <td>Banjarmasin Selatan</td>
          <td>1.520 Ha</td>
          <td>820 Ha</td>
          <td>505 Ha</td>
          <td>2.845 Ha</td>
          <td>14</td>
        </tr>

        <tr>
          <td>Banjarmasin Timur</td>
          <td>1.230 Ha</td>
          <td>715 Ha</td>
          <td>485 Ha</td>
          <td>2.430 Ha</td>
          <td>11</td>
        </tr>

        <tr>
          <td>Banjarmasin Barat</td>
          <td>910 Ha</td>
          <td>620 Ha</td>
          <td>435 Ha</td>
          <td>1.965 Ha</td>
          <td>9</td>
        </tr>

        <tr>
          <td>Banjarmasin Utara</td>
          <td>560 Ha</td>
          <td>410 Ha</td>
          <td>310 Ha</td>
          <td>1.280 Ha</td>
          <td>6</td>
        </tr>

        <tr>
          <td>Banjarmasin Tengah</td>
          <td>370 Ha</td>
          <td>290 Ha</td>
          <td>205 Ha</td>
          <td>865 Ha</td>
          <td>3</td>
        </tr>

        <tr>
          <td><b>Total</b></td>
          <td><b>4.590 Ha</b></td>
          <td><b>2.855 Ha</b></td>
          <td><b>1.940 Ha</b></td>
          <td><b>9.385 Ha</b></td>
          <td><b>43</b></td>
        </tr>

      </tbody>

    </table>

  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>