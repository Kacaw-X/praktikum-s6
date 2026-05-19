<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-3">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0"><i class="bi bi-key"></i> Ganti Password</h5>
            </div>
            <div class="card-body p-4">
                <?php $errors = session()->getFlashdata('errors') ?? []; ?>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger py-2">
                        <?php foreach ($errors as $e): ?>
                            <div><i class="bi bi-x-circle"></i> <?= esc($e) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2">
                        <div><i class="bi bi-x-circle"></i> <?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('akun/proses-ganti-password') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password Lama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password_lama" id="pwd_lama" 
                                class="form-control" placeholder="Password lama" required autofocus>
                            <button type="button" class="btn btn-outline-secondary" 
                                onclick="var x=document.getElementById('pwd_lama'); x.type=x.type==='password'?'text':'password'">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" name="password_baru" id="pwd_baru" 
                                class="form-control" placeholder="Password baru (Min. 8 karakter)" required>
                            <button type="button" class="btn btn-outline-secondary" 
                                onclick="var x=document.getElementById('pwd_baru'); x.type=x.type==='password'?'text':'password'">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-check-circle"></i></span>
                            <input type="password" name="konfirmasi_password" id="pwd_konfirm" 
                                class="form-control" placeholder="Ulangi password baru" required>
                            <button type="button" class="btn btn-outline-secondary" 
                                onclick="var x=document.getElementById('pwd_konfirm'); x.type=x.type==='password'?'text':'password'">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
