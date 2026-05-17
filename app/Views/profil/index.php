<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<?php helper('profile'); ?>

<style>
    body {
        background: #121212; /* samakan dengan halaman lain */
        color: #eaeaea;
    }

    .profile-card {
        background: #1e1e1e; /* dark card */
        border-radius: 16px;
        padding: 30px;
        color: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.05);
        transition: 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .profile-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd, #4dabf7); /* biru bootstrap */
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        font-weight: bold;
        margin: 0 auto 10px;
        box-shadow: 0 4px 15px rgba(13,110,253,0.4);
    }

    .info-box {
        background: #2a2a2a;
        border-radius: 12px;
        padding: 12px 15px;
        margin-bottom: 10px;
        border-left: 3px solid #0d6efd; /* aksen biru */
    }

    .badge-ipk {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 10px;
    }

    .matkul-list li {
        background: #2a2a2a;
        margin-bottom: 6px;
        padding: 8px 12px;
        border-radius: 8px;
        list-style: none;
        border-left: 3px solid #198754; /* hijau seperti fitur */
    }

    h4, h5 {
        color: #ffffff;
    }

    small {
        color: #aaa;
    }
</style>

<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="profile-card">

            <!-- Header -->
            <div class="profile-header">
<div class="profile-avatar overflow-hidden p-0">
    <img src="<?= ($nama) ?>" class="w-100 h-100 rounded-circle">
</div>
                <h4><?= esc($nama) ?></h4>
                <small><?= esc($prodi) ?> • Angkatan <?= esc($angkatan) ?></small>
            </div>

            <!-- Info -->
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <strong>NPM</strong><br>
                        <?= esc($npm) ?>
                    </div>

                    <div class="info-box">
                        <strong>IPK</strong><br>
                        <?php
                            if ($ipk >= 3.5) {
                                $badge = 'bg-success';
                            } elseif ($ipk >= 3.0) {
                                $badge = 'bg-warning text-dark';
                            } else {
                                $badge = 'bg-danger';
                            }
                        ?>
                        <span class="badge <?= $badge ?> badge-ipk">
                            <?= esc($ipk) ?>
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <strong>Program Studi</strong><br>
                        <?= esc($prodi) ?>
                    </div>

                    <div class="info-box">
                        <strong>Angkatan</strong><br>
                        <?= esc($angkatan) ?>
                    </div>
                </div>
            </div>

            <!-- Mata Kuliah -->
            <div class="mt-4">
                <h5>Mata Kuliah</h5>
                <ul class="matkul-list p-0">
                    <?php foreach ($matkul as $mk): ?>
                        <li><?= esc($mk) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>