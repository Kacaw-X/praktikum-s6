<?php
namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;

class Buku extends BaseController
{
    private BukuModel $bukuModel;
    private KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
    }

    // ──────────────────────────────────────
    // READ - Daftar Buku dengan Search & Paginasi
    // ──────────────────────────────────────
    public function index(): string
    {
        $keyword = $this->request->getGet('q') ?? '';
        $perPage = 10;
        $buku = $this->bukuModel->getBukuPaginate($perPage, $keyword);
        $pager = $this->bukuModel->pager;
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $buku,
            'pager' => $pager,
            'keyword' => $keyword,
            'total' => $this->bukuModel->countAllResults(false),
        ];

        return view('buku/index', $data);
    }
public function statistik(): string
{
    // 1. Total buku & stok
    $totalBuku = $this->bukuModel->countAllResults(false);

    $totalStok = $this->bukuModel
        ->selectSum('stok')
        ->first()['stok'] ?? 0;

    $rataRataStok = $totalBuku > 0 ? $totalStok / $totalBuku : 0;

    // 2. Distribusi per kategori
    $distribusiKategori = $this->bukuModel
        ->select('kategori.nama as nama_kategori, COUNT(buku.id) as jumlah_buku, SUM(buku.stok) as total_stok')
        ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
        ->groupBy('kategori.id')
        ->findAll();

    // 3. 5 buku stok terbanyak
    $stokTerbanyak = $this->bukuModel
        ->select('buku.*, kategori.nama as nama_kategori')
        ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
        ->orderBy('stok', 'DESC')
        ->limit(5)
        ->find();

    // 4. Buku stok 0
    $stokHabis = $this->bukuModel
        ->select('buku.*, kategori.nama as nama_kategori')
        ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
        ->where('stok', 0)
        ->findAll();

    return view('buku/statistik', [
        'title' => 'Statistik Buku',
        'total_buku' => $totalBuku,
        'total_stok' => $totalStok,
        'rata_rata_stok' => $rataRataStok,
        'distribusi' => $distribusiKategori,
        'stok_terbanyak' => $stokTerbanyak,
        'stok_habis' => $stokHabis
    ]);
}
    // ──────────────────────────────────────
    // READ - Detail satu buku
    // ──────────────────────────────────────
    public function detail(int $id): string
    {
        $buku = $this->bukuModel
            ->select('buku.*, kategori.nama AS nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        return view('buku/detail', [
            'title' => 'Detail Buku',
            'buku' => $buku,
        ]);
    }

    // ──────────────────────────────────────
    // CREATE - Form tambah
    // ──────────────────────────────────────
    public function tambah(): string
    {
        return view('buku/form', [
            'title' => 'Tambah Buku',
            'buku' => null,
            'kategori' => $this->kategoriModel->getDropdown(),
        ]);
    }

    // ──────────────────────────────────────
    // CREATE - Proses simpan
    // ──────────────────────────────────────
    public function simpan()
    {
        $data = $this->ambilDataForm();

        // Validasi kode unik
        if ($this->bukuModel->isKodeTaken($data['kode_buku'])) {
            session()->setFlashdata('error', 'Kode buku sudah digunakan.');
            return redirect()->back()->withInput();
        }

        $this->bukuModel->insert($data);
        session()->setFlashdata('sukses', "Buku '{$data['judul']}' berhasil ditambahkan.");

        return redirect()->to('/buku');
    }

    // ──────────────────────────────────────
    // UPDATE - Form edit
    // ──────────────────────────────────────
    public function edit(int $id): string
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        return view('buku/form', [
            'title' => 'Edit Buku: ' . $buku['judul'],
            'buku' => $buku,
            'kategori' => $this->kategoriModel->getDropdown(),
        ]);
    }

    // ──────────────────────────────────────
    // UPDATE - Proses update
    // ──────────────────────────────────────
    public function update(int $id)
    {
        $data = $this->ambilDataForm();

        // Validasi kode unik, kecuali buku yang sedang diedit
        if ($this->bukuModel->isKodeTaken($data['kode_buku'], $id)) {
            session()->setFlashdata('error', 'Kode buku sudah digunakan buku lain.');
            return redirect()->back()->withInput();
        }

        $this->bukuModel->update($id, $data);
        session()->setFlashdata('sukses', "Buku '{$data['judul']}' berhasil diperbarui.");

        return redirect()->to('/buku');
    }

    // ──────────────────────────────────────
    // DELETE
    // ──────────────────────────────────────
    public function hapus(int $id)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            session()->setFlashdata('error', 'Buku tidak ditemukan.');
            return redirect()->to('/buku');
        }

        $this->bukuModel->delete($id);
        session()->setFlashdata('sukses', "Buku '{$buku['judul']}' berhasil dihapus.");

        return redirect()->to('/buku');
    }
public function ekspor()
{
    $buku = $this->bukuModel
        ->select('buku.*, kategori.nama AS nama_kategori')
        ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
        ->findAll();

    $filename = 'buku-export-' . date('Y-m-d') . '.csv';

    $csvData = '';

    // Header
    $csvData .= "No,Kode,Judul,Penulis,Penerbit,Tahun,Stok,Kategori\n";

    $no = 1;

    foreach ($buku as $b) {

        $csvData .= implode(',', [
            $no++,
            '"' . $b['kode_buku'] . '"',
            '"' . $b['judul'] . '"',
            '"' . $b['penulis'] . '"',
            '"' . $b['penerbit'] . '"',
            '"' . $b['tahun'] . '"',
            '"' . $b['stok'] . '"',
            '"' . $b['nama_kategori'] . '"'
        ]) . "\n";
    }

    return $this->response
        ->setHeader('Content-Type', 'text/csv')
        ->download($filename, $csvData);
}
    // ──────────────────────────────────────
    // PRIVATE HELPER - Kumpulkan data dari form
    // ──────────────────────────────────────
    private function ambilDataForm(): array
    {
        return [
            'kode_buku' => strtoupper($this->request->getPost('kode_buku')),
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun' => $this->request->getPost('tahun') ?: null,
            'isbn' => $this->request->getPost('isbn'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'stok' => (int) $this->request->getPost('stok'),
            'kategori_id' => $this->request->getPost('kategori_id') ?: null,
        ];
    }
}
