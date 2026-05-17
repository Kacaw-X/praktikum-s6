<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    public function index()
    {
        $data = [
            'npm' => '2310010273', 
            'nama' => 'Muhammad Nofan Firdaus', 
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2023',
            'ipk' => 3.75,
            'matkul' => [
                'Testing',
                'Etika dan Profesi',
                'Fiqih',
                'pengolahan citra',
                'jaringan saraf tiruan',
            ]
        ];

        return view('profil/index', $data);
    }
}