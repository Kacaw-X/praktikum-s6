<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\BukuModel;

class Kategori extends BaseController
{
    protected $kategoriModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $kategori = $this->kategoriModel
            ->select('kategori.*, COUNT(buku.id) as jumlah_buku')
            ->join('buku', 'buku.kategori_id = kategori.id', 'left')
            ->groupBy('kategori.id')
            ->findAll();

        return view('kategori/index', [
            'title' => 'Kategori',
            'kategori' => $kategori
        ]);
    }

    public function tambah()
    {
        return view('kategori/form', [
            'title' => 'Tambah Kategori',
            'validation' => \Config\Services::validation()
        ]);
    }

    public function simpan()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[kategori.nama]',
                'errors' => [
                    'required' => 'Nama kategori wajib diisi',
                    'is_unique' => 'Nama kategori sudah ada'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/kategori/tambah')->withInput();
        }

        $this->kategoriModel->save([
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        session()->setFlashdata('success', 'Kategori berhasil ditambahkan');

        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $kategori = $this->kategoriModel->find($id);

        return view('kategori/form', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        $kategoriLama = $this->kategoriModel->find($id);

        $ruleNama = ($kategoriLama['nama'] == $this->request->getPost('nama'))
            ? 'required'
            : 'required|is_unique[kategori.nama]';

        $rules = [
            'nama' => [
                'rules' => $ruleNama,
                'errors' => [
                    'required' => 'Nama kategori wajib diisi',
                    'is_unique' => 'Nama kategori sudah ada'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/kategori/edit/' . $id)->withInput();
        }

        $this->kategoriModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        session()->setFlashdata('success', 'Kategori berhasil diupdate');

        return redirect()->to('/kategori');
    }

    public function hapus($id)
    {
        $jumlahBuku = $this->bukuModel
            ->where('kategori_id', $id)
            ->countAllResults();

        if ($jumlahBuku > 0) {

            session()->setFlashdata(
                'error',
                'Kategori tidak bisa dihapus karena masih digunakan buku'
            );

            return redirect()->to('/kategori');
        }

        $this->kategoriModel->delete($id);

        session()->setFlashdata('success', 'Kategori berhasil dihapus');

        return redirect()->to('/kategori');
    }
}