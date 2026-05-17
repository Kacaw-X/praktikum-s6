<?php

namespace App\Controllers;

class Akademik extends BaseController
{
    // 1. Method index()
    public function index()
    {
        echo "<h1>Sistem Informasi Akademik</h1>";
        echo "<p>Nama: Muhammad Nofan Firdaus</p>"; 
    }

    // 2. Method matkul()
    public function matkul()
    {
        $matkul = [
            "Riset operasi",
            "Fiqih",
            "jaringan saraf tiruan",
            "Testing",
            "Pengolahan Citra",
        ];

        echo "<h2>Daftar Mata Kuliah</h2>";
        echo "<ul>";
        foreach ($matkul as $m) {
            echo "<li>$m</li>";
        }
        echo "</ul>";
    }

    // 3. Method nilai($nim)
    public function nilai($nim)
    {
        echo "Nilai mahasiswa dengan NIM: " . $nim;
    }
}