<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'pengguna' => $this->userModel->getDaftarUser()
        ];

        return view('admin/pengguna/index', $data);
    }

    public function toggleStatus($id)
    {
        // Proteksi: admin tidak bisa menonaktifkan akun sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $statusBaru = $user['aktif'] ? 0 : 1;
        $this->userModel->update($id, ['aktif' => $statusBaru]);

        $pesan = $statusBaru ? 'Akun berhasil diaktifkan.' : 'Akun berhasil dinonaktifkan.';
        return redirect()->back()->with('sukses', $pesan);
    }

    public function ubahRole($id)
    {
        // Proteksi: admin tidak bisa mengubah role akun sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $roleBaru = $this->request->getPost('role');
        
        // Validasi role yang diperbolehkan
        $roleValid = ['admin', 'petugas', 'anggota'];
        if (!in_array($roleBaru, $roleValid)) {
            return redirect()->back()->with('error', 'Role tidak valid.');
        }

        $this->userModel->update($id, ['role' => $roleBaru]);

        return redirect()->back()->with('sukses', "Role pengguna berhasil diubah menjadi {$roleBaru}.");
    }
}
