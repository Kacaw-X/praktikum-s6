<?php
    $current = current_url(); // ⭐ ambil URL aktif
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' - MyApp' : 'MyApp' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <i class="bi bi-book"></i> PerpustakaanKu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">

                <!-- BERANDA -->
                <li class="nav-item">
                    <a class="nav-link <?= ($current == base_url('/')) ? 'active' : '' ?>" href="<?= base_url('/') ?>">
                        <i class="bi bi-house"></i> Beranda
                    </a>
                </li>

                <!-- BUKU -->
                <li class="nav-item">
                    <a class="nav-link <?= str_contains($current, '/buku') ? 'active' : '' ?>" href="<?= base_url('buku') ?>">
                        <i class="bi bi-journals"></i> Buku
                    </a>
                </li>

                <!-- TENTANG -->
                <li class="nav-item">
                    <a class="nav-link <?= str_contains($current, '/tentang') ? 'active' : '' ?>" href="<?= base_url('tentang') ?>">
                        <i class="bi bi-info-circle"></i> Tentang
                    </a>
                </li>

                <!-- PROFIL -->
                <li class="nav-item">
                    <a class="nav-link <?= str_contains($current, '/profil') ? 'active' : '' ?>" href="<?= base_url('profil') ?>">
                        <i class="bi bi-person"></i> Profil
                    </a>
                </li>

                <!-- GALERI -->
                <li class="nav-item">
                    <a class="nav-link <?= str_contains($current, '/galeri') ? 'active' : '' ?>" href="<?= base_url('galeri') ?>">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                </li>

            </ul>

            <!-- AUTH -->
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
<!-- END NAVBAR -->


<!-- KONTEN -->
<main class="container py-4">

    <?= $this->renderSection('content') ?>

</main>


<!-- FOOTER -->
<footer class="py-4 mt-5 bg-dark text-light">
    <div class="container text-center">
        <h5><i class="bi bi-book"></i> PerpustakaanKu</h5>
        <p class="text-muted">Sistem Informasi Perpustakaan Digital</p>
        <p class="text-muted">&copy; <?= date('Y') ?></p>
    </div>
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ⭐ SECTION SCRIPTS -->
<?= $this->renderSection('scripts') ?>

</body>
</html>