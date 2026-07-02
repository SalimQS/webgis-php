<?php
$setTemplate = false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Kelompok - WebGIS Layanan Kesehatan Disabilitas</title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include __DIR__ . '/navbar.php'; ?>

  <section class="max-w-7xl mx-auto px-6 py-12">

    <div class="section-head">
      <div class="eyebrow">Informasi Kelompok</div>
      <h2>Tim Pengembang</h2>
    </div>

    <div class="flex flex-wrap justify-center gap-8 mt-10">

      <!-- Card -->
      <div class="flex-[0_0_100%] md:flex-[0_0_calc(50%-1rem)] lg:flex-[0_0_calc(33.333%-1.4rem)] max-w-[380px] bg-[var(--paper)] border border-[var(--line)] rounded p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <img src="assets/kelompok/salim.jpeg"
          alt="Satria Salim"
          class="w-24 h-24 rounded-full object-cover mx-auto mb-5 border-2 border-[var(--line)]">

        <h3>Satria Salim</h3>

        <div class="font-[var(--mono)] text-sm text-[var(--ink-soft)] mt-2">
          NPM. 2410010524
        </div>
      </div>

      <!-- Card -->
      <div class="flex-[0_0_100%] md:flex-[0_0_calc(50%-1rem)] lg:flex-[0_0_calc(33.333%-1.4rem)] max-w-[380px] bg-[var(--paper)] border border-[var(--line)] rounded p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <img src="assets/kelompok/razy.jpeg"
          alt="Razy Saputra"
          class="w-24 h-24 rounded-full object-cover mx-auto mb-5 border-2 border-[var(--line)]">

        <h3>Razy Saputra</h3>

        <div class="font-[var(--mono)] text-sm text-[var(--ink-soft)] mt-2">
          NPM. 2410010317
        </div>
      </div>

      <!-- Card -->
      <div class="flex-[0_0_100%] md:flex-[0_0_calc(50%-1rem)] lg:flex-[0_0_calc(33.333%-1.4rem)] max-w-[380px] bg-[var(--paper)] border border-[var(--line)] rounded p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <img src="assets/kelompok/iki.jpeg"
          alt="M. Miftahul Rizky"
          class="w-24 h-24 rounded-full object-cover mx-auto mb-5 border-2 border-[var(--line)]">

        <h3>M. Miftahul Rizky</h3>

        <div class="font-[var(--mono)] text-sm text-[var(--ink-soft)] mt-2">
          NPM. 2410010509
        </div>
      </div>

      <!-- Card -->
      <div class="flex-[0_0_100%] md:flex-[0_0_calc(50%-1rem)] lg:flex-[0_0_calc(33.333%-1.4rem)] max-w-[380px] bg-[var(--paper)] border border-[var(--line)] rounded p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <img src="assets/kelompok/fathur.jpeg"
          alt="Fathur Rahman"
          class="w-24 h-24 rounded-full object-cover mx-auto mb-5 border-2 border-[var(--line)]">

        <h3>Fathur Rahman</h3>

        <div class="font-[var(--mono)] text-sm text-[var(--ink-soft)] mt-2">
          NPM. 2410010410
        </div>
      </div>

      <!-- Card -->
      <div class="flex-[0_0_100%] md:flex-[0_0_calc(50%-1rem)] lg:flex-[0_0_calc(33.333%-1.4rem)] max-w-[380px] bg-[var(--paper)] border border-[var(--line)] rounded p-8 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
        <img src="assets/kelompok/adi.jpeg"
          alt="Adi Rizaldi"
          class="w-24 h-24 rounded-full object-cover mx-auto mb-5 border-2 border-[var(--line)]">

        <h3>Adi Rizaldi</h3>

        <div class="font-[var(--mono)] text-sm text-[var(--ink-soft)] mt-2">
          NPM. 2410010297
        </div>
      </div>

    </div>

  </section>

  <footer>
    <span>Penelitian Fisika, Universitas Nusa Cendana — 2024</span>
    <span>Technologia: Jurnal Ilmiah Vol.15 No.4</span>
  </footer>

</body>

</html>
