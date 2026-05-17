<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
body {
    background: #121212;
    color: #eee;
}

.card-hover {
    transition: 0.3s;
    cursor: pointer;
}

.card-hover:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0,0,0,0.6);
}

.card img {
    height: 200px;
    object-fit: cover;
}
</style>

<div class="container">
    <h3 class="mb-4 text-white">
        <i class="bi bi-images"></i> Galeri
    </h3>

    <!-- FILTER -->
    <div class="mb-4">
        <a href="<?= base_url('galeri') ?>" class="btn btn-sm <?= !$kategori_aktif ? 'btn-primary' : 'btn-outline-primary' ?>">Semua</a>
        <a href="<?= base_url('galeri?kategori=alam') ?>" class="btn btn-sm <?= $kategori_aktif == 'alam' ? 'btn-success' : 'btn-outline-success' ?>">Alam</a>
        <a href="<?= base_url('galeri?kategori=kota') ?>" class="btn btn-sm <?= $kategori_aktif == 'kota' ? 'btn-warning' : 'btn-outline-warning' ?>">Kota</a>
        <a href="<?= base_url('galeri?kategori=teknologi') ?>" class="btn btn-sm <?= $kategori_aktif == 'teknologi' ? 'btn-info' : 'btn-outline-info' ?>">Teknologi</a>
    </div>

    <!-- GRID -->
    <div class="row">
        <?php foreach ($galeri as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-light border-0 card-hover"
                     data-bs-toggle="modal"
                     data-bs-target="#modalGaleri"
                     data-img="<?= esc($item['url_gambar']) ?>"
                     data-judul="<?= esc($item['judul']) ?>"
                     data-deskripsi="<?= esc($item['deskripsi']) ?>">

                    <img src="<?= esc($item['url_gambar']) ?>" class="card-img-top">

                    <div class="card-body">
                        <h5><?= esc($item['judul']) ?></h5>

                        <span class="badge bg-primary mb-2">
                            <?= esc($item['kategori']) ?>
                        </span>

                        <p><?= truncate_text($item['deskripsi'], 80) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- MODAL PREVIEW -->
<div class="modal fade" id="modalGaleri" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">

            <div class="modal-header border-0">
                <h5 class="modal-title" id="modalJudul"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img id="modalImg" class="img-fluid rounded mb-3">
                <p id="modalDeskripsi"></p>
            </div>

        </div>
    </div>
</div>

<script>
const modal = document.getElementById('modalGaleri');

modal.addEventListener('show.bs.modal', function (event) {
    const card = event.relatedTarget;

    document.getElementById('modalImg').src = card.getAttribute('data-img');
    document.getElementById('modalJudul').innerText = card.getAttribute('data-judul');
    document.getElementById('modalDeskripsi').innerText = card.getAttribute('data-deskripsi');
});
</script>

<?= $this->endSection() ?>