<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' - MyApp' : 'MyApp' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <i class="bi bi-book"></i> PerpustakaanKu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>" href="<?= base_url('/') ?>">
                        <i class="bi bi-house"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= str_contains(current_url(), '/buku') ? 'active' : '' ?>" href="<?= base_url('buku') ?>">
                        <i class="bi bi-journals"></i> Buku
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('tentang') ?>">
                        <i class="bi bi-info-circle"></i> Tentang
                    </a>
                </li>
            </ul>

            <div class="navbar-nav">
                <?php if (session()->get('logged_in')): ?>
                    <span class="navbar-text me-3 text-light">
                        <i class="bi bi-person-circle"></i>
                        <?= esc(session()->get('nama')) ?>
                    </span>
                    <a class="btn btn-outline-light btn-sm" href="<?= base_url('logout') ?>">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                <?php else: ?>
                    <a class="btn btn-outline-light btn-sm" href="<?= base_url('login') ?>">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<?php if (isset($breadcrumb)): ?>
    <div class="bg-white border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('/') ?>">Beranda</a>
                    </li>
                    <?php $lastKey = array_key_last($breadcrumb); ?>
                    <?php foreach ($breadcrumb as $key => $crumb): ?>
                        <?php if ($key === $lastKey): ?>
                            <li class="breadcrumb-item active" aria-current="page"><?= esc($crumb['label']) ?></li>
                        <?php else: ?>
                            <li class="breadcrumb-item">
                                <a href="<?= esc($crumb['url']) ?>"><?= esc($crumb['label']) ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
        </div>
    </div>
<?php endif; ?>

<main class="container py-4">
    <?php if (session()->getFlashdata('sukses')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?= esc(session()->getFlashdata('sukses')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <?= esc(session()->getFlashdata('info')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<footer class="py-4 mt-5 bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="bi bi-book"></i> PerpustakaanKu</h5>
                <p class="text-muted">Sistem Informasi Perpustakaan Digital</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-1">Dibangun dengan CodeIgniter 4</p>
                <p class="text-muted">&copy; <?= date('Y') ?> Praktikum Pemrograman Web 2</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
