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