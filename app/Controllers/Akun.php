<?php

namespace App\Controllers;

use App\Models\UserModel;

class Akun extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function gantiPassword()
    {
        return view('akun/ganti_password', ['title' => 'Ganti Password']);
    }

    public function prosesGantiPassword()
    {
        $rules = [
            'password_lama' => [
                'label'  => 'Password Lama',
                'rules'  => 'required',
            ],
            'password_baru' => [
                'label'  => 'Password Baru',
                'rules'  => 'required|min_length[8]',
                'errors' => ['min_length' => 'Password baru minimal 8 karakter.']
            ],
            'konfirmasi_password' => [
                'label'  => 'Konfirmasi Password Baru',
                'rules'  => 'required|matches[password_baru]',
                'errors' => ['matches' => 'Konfirmasi password tidak cocok dengan password baru.']
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');

        if (!password_verify($passwordLama, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password lama tidak sesuai dengan yang ada di database.');
        }

        $this->userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/')->with('sukses', 'Password berhasil diubah.');
    }
}
