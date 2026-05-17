<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1><?= esc($judul) ?></h1>
<p>Tahun: <?= $tahun ?></p>

<h3>Daftar Warna:</h3>
<ul>
 <?php foreach ($warna as $w): ?>
 <li><?= esc($w) ?></li>
 <?php endforeach; ?>
</ul>

<p>Nama: <?= esc($user['nama']) ?> | Email: <?= esc($user['email']) ?></p>

<table class='table'>
 <thead>
  <tr>
   <th>ID</th>
   <th>Nama</th>
   <th>Harga</th>
  </tr>
 </thead>
 <tbody>
 <?php foreach ($produk as $p): ?>
 <tr>
  <td><?= $p['id'] ?></td>
  <td><?= esc($p['nama']) ?></td>
  <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
 </tr>
 <?php endforeach; ?>
 </tbody>
</table>

<?php if ($show_footer): ?>
 <p>Dibuat tahun <?= $tahun ?></p>
<?php endif; ?>

<?php if ($promo !== null): ?>
 <div><?= esc($promo) ?></div>
<?php endif; ?>

<?= $this->endSection() ?>