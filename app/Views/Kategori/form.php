<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">

    <h3><?= $title ?></h3>

    <form action="<?= isset($kategori)
        ? base_url('kategori/update/' . $kategori['id'])
        : base_url('kategori/simpan')
    ?>" method="post">

        <div class="mb-3">
            <label>Nama Kategori</label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   value="<?= old('nama', $kategori['nama'] ?? '') ?>">

            <small class="text-danger">
                <?= $validation->getError('nama') ?>
            </small>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>

            <textarea name="deskripsi"
                      class="form-control"><?= old('deskripsi', $kategori['deskripsi'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>

        <a href="<?= base_url('kategori') ?>"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>