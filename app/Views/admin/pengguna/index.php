<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-people"></i> Manajemen Pengguna</h5>
            </div>
            <div class="card-body">
                
                <?php if (session()->getFlashdata('sukses')): ?>
                    <div class="alert alert-success py-2">
                        <div><i class="bi bi-check-circle"></i> <?= esc(session()->getFlashdata('sukses')) ?></div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2">
                        <div><i class="bi bi-x-circle"></i> <?= esc(session()->getFlashdata('error')) ?></div>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($pengguna as $p): ?>
                                <?php $isSelf = ($p['id'] == session()->get('user_id')); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($p['nama_lengkap']) ?></td>
                                    <td><?= esc($p['username']) ?></td>
                                    <td><?= esc($p['email']) ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/pengguna/ubah-role/' . $p['id']) ?>" method="post" class="d-flex">
                                            <?= csrf_field() ?>
                                            <select name="role" class="form-select form-select-sm me-1" <?= $isSelf ? 'disabled' : '' ?>>
                                                <option value="anggota" <?= $p['role'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                                <option value="petugas" <?= $p['role'] === 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                                <option value="admin" <?= $p['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                            <?php if (!$isSelf): ?>
                                            <button type="submit" class="btn btn-sm btn-primary" title="Simpan Role">
                                                <i class="bi bi-save"></i>
                                            </button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td>
                                        <?php if ($p['aktif']): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <form action="<?= base_url('admin/pengguna/toggle-status/' . $p['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <?php if ($p['aktif']): ?>
                                                <button type="submit" class="btn btn-sm btn-danger" <?= $isSelf ? 'disabled' : '' ?> onclick="return confirm('Nonaktifkan pengguna ini?');" title="Nonaktifkan">
                                                    <i class="bi bi-x-circle"></i> Nonaktifkan
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" class="btn btn-sm btn-success" <?= $isSelf ? 'disabled' : '' ?> onclick="return confirm('Aktifkan pengguna ini?');" title="Aktifkan">
                                                    <i class="bi bi-check-circle"></i> Aktifkan
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
