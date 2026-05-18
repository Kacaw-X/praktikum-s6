<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">

    <h3>Data Kategori</h3>

    <a href="<?= base_url('kategori/tambah') ?>"
       class="btn btn-primary mb-3">
       Tambah Kategori
    </a>

    <?php if(session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach($kategori as $k) : ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nama'] ?></td>
                <td><?= $k['deskripsi'] ?></td>
                <td><?= $k['jumlah_buku'] ?></td>

                <td>

                    <a href="<?= base_url('kategori/edit/' . $k['id']) ?>"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="<?= base_url('kategori/hapus/' . $k['id']) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </a>

                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?= $this->endSection() ?>