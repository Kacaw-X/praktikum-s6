<?php

namespace App\Controllers;

class Galeri extends BaseController
{
    public function index()
    {
        helper('text');

        $dataGaleri = [
            [
                'judul' => 'Gunung Indah',
                'url_gambar' => 'https://picsum.photos/id/1018/600/400',
                'deskripsi' => 'Pemandangan gunung yang sangat indah dengan udara segar dan suasana tenang.',
                'kategori' => 'alam'
            ],
            [
                'judul' => 'Kota Malam',
                'url_gambar' => 'https://picsum.photos/id/1015/600/400',
                'deskripsi' => 'Lampu kota di malam hari memberikan suasana modern dan hidup.',
                'kategori' => 'kota'
            ],
            [
                'judul' => 'Teknologi AI',
                'url_gambar' => 'https://picsum.photos/id/1005/600/400',
                'deskripsi' => 'Perkembangan teknologi AI yang semakin canggih di era digital.',
                'kategori' => 'teknologi'
            ],
            [
                'judul' => 'Pantai Sunset',
                'url_gambar' => 'https://picsum.photos/id/1016/600/400',
                'deskripsi' => 'Pemandangan matahari terbenam di pantai yang sangat memukau.',
                'kategori' => 'alam'
            ],
            [
                'judul' => 'Gedung Tinggi',
                'url_gambar' => 'https://picsum.photos/id/1020/600/400',
                'deskripsi' => 'Deretan gedung pencakar langit di pusat kota.',
                'kategori' => 'kota'
            ],
            [
                'judul' => 'Robot Modern',
                'url_gambar' => 'https://picsum.photos/id/1024/600/400',
                'deskripsi' => 'Robot dengan teknologi modern yang membantu kehidupan manusia.',
                'kategori' => 'teknologi'
            ],
        ];

        $kategori = $this->request->getGet('kategori');

        if ($kategori) {
            $dataGaleri = array_filter($dataGaleri, function ($item) use ($kategori) {
                return $item['kategori'] === $kategori;
            });
        }

        return view('galeri/index', [
            'title' => 'Galeri',
            'galeri' => $dataGaleri,
            'kategori_aktif' => $kategori
        ]);
    }
}