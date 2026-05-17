<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route (beranda)
$routes->get('/', 'Beranda::index');

// Halaman tentang
$routes->get('tentang', 'Beranda::tentang');

// Route controller Demo
$routes->get('demo', 'Demo::index');

// Route dengan parameter angka
$routes->get('pengguna/(:num)', 'Beranda::pengguna/$1');

// Halaman waktu
$routes->get('waktu', 'Beranda::waktu');

// Route untuk Sistem Informasi Akademik
$routes->get('akademik', 'Akademik::index');

// Route untuk daftar mata kuliah
$routes->get('akademik/matkul', 'Akademik::matkul');

// Route untuk nilai mahasiswa dengan parameter NIM
$routes->get('akademik/nilai/(:segment)', 'Akademik::nilai/$1');