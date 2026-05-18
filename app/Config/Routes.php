<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route (beranda)
$routes->get('/', 'Beranda::index');

// Halaman tentang
$routes->get('tentang', 'Beranda::tentang');

// Route untuk Sistem Informasi Akademik
$routes->get('akademik', 'Akademik::index');

// Route untuk daftar mata kuliah
$routes->get('akademik/matkul', 'Akademik::matkul');

// Route untuk nilai mahasiswa dengan parameter NIM
$routes->get('akademik/nilai/(:segment)', 'Akademik::nilai/$1');
// Route controller Demo
$routes->get('demo', 'Demo::index');

$routes->get('/profil', 'Profil::index');
$routes->get('/galeri', 'Galeri::index');
$routes->get('buku', 'Buku::index');
$routes->get('buku/tambah', 'Buku::tambah');
$routes->post('buku/simpan', 'Buku::simpan');
$routes->get('buku/detail/(:num)', 'Buku::detail/$1');
$routes->get('buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('buku/update/(:num)', 'Buku::update/$1');
$routes->get('buku/hapus/(:num)', 'Buku::hapus/$1');
$routes->get('buku/ekspor', 'Buku::ekspor');
$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/tambah', 'Kategori::tambah');
$routes->post('/kategori/simpan', 'Kategori::simpan');
$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1');
$routes->post('/kategori/update/(:num)', 'Kategori::update/$1');
$routes->get('/kategori/hapus/(:num)', 'Kategori::hapus/$1');
$routes->get('/buku/statistik', 'Buku::statistik');