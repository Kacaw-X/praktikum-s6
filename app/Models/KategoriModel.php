<?php
namespace App\Models;
use CodeIgniter\Model;
class KategoriModel extends Model
{
 protected $table = 'kategori';
 protected $primaryKey = 'id';
 protected $useAutoIncrement = true;
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $useTimestamps = true;
 protected $allowedFields = ['nama', 'deskripsi'];
 /**
 * Ambil semua kategori sebagai dropdown options
 * Return: ['id' => 'nama'] untuk form select
 */
 public function getDropdown(): array
 {
 $kategori = $this->orderBy('nama')->findAll();
 $result = ['' => '-- Pilih Kategori --'];
 foreach ($kategori as $k) {
 $result[$k['id']] = $k['nama'];
 }
 return $result;
 }
}