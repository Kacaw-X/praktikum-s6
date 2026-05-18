<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">

    <h3><i class="bi bi-bar-chart"></i> Statistik Buku</h3>

    <!-- Kartu Ringkasan -->
    <div class="row mt-3">

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Buku</h5>
                <h3><?= $total_buku ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Stok</h5>
                <h3><?= $total_stok ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Rata-rata Stok</h5>
                <h3><?= number_format($rata_rata_stok, 2) ?></h3>
            </div>
        </div>

    </div>

    <!-- Distribusi Kategori -->
    <h5 class="mt-4">Distribusi Buku per Kategori</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Jumlah Buku</th>
                <th>Total Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($distribusi as $d): ?>
                <tr>
                    <td><?= $d['nama_kategori'] ?></td>
                    <td><?= $d['jumlah_buku'] ?></td>
                    <td><?= $d['total_stok'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 5 Buku Terbanyak -->
    <h5 class="mt-4">5 Buku dengan Stok Terbanyak</h5>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stok_terbanyak as $b): ?>
                <tr>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['nama_kategori'] ?></td>
                    <td><?= $b['stok'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Stok Habis -->
    <h5 class="mt-4 text-danger">Buku Stok Habis</h5>

    <table class="table table-danger">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stok_habis as $b): ?>
                <tr>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['nama_kategori'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>