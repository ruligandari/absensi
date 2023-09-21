<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
//Admin
$routes->get('login', 'Admin\LoginController::index');
$routes->post('auth', 'Admin\LoginController::auth');
$routes->get('logout', 'Admin\LoginController::logout');
//Dosen
$routes->get('dosen/login', 'Dosen\LoginController::index');
$routes->post('dosen/auth', 'Dosen\LoginController::auth');
$routes->get('dosen/logout', 'Dosen\LoginController::logout');

// Presensi Mahasiswa Face Recogintion
$routes->get('absen/(:any)', 'AbsensiController::create/$1');
//Master Admin
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    // Mahasiswa
    $routes->get('data-mahasiswa', 'Admin\MahasiswaController::index');
    $routes->get('mahasiswa/create', 'Admin\MahasiswaController::create');
    $routes->post('mahasiswa/save', 'Admin\MahasiswaController::save');
    $routes->get('mahasiswa/form_edit/(:any)', 'Admin\MahasiswaController::form_edit/$1');
    $routes->post('mahasiswa/update/(:any)', 'Admin\MahasiswaController::update/$1');
    $routes->post('mahasiswa/delete/(:any)', 'Admin\MahasiswaController::delete/$1');
    $routes->get('mahasiswa/pas-foto/(:any)', 'Admin\MahasiswaController::pasfoto/$1');
    $routes->post('mahasiswa/upload', 'Admin\MahasiswaController::upload');

    // Dosen
    $routes->get('data-dosen', 'Admin\DosenController::index');
    $routes->get('dosen/create', 'Admin\DosenController::create');
    $routes->post('dosen/save', 'Admin\DosenController::save');
    $routes->get('dosen/form_edit/(:any)', 'Admin\DosenController::form_edit/$1');
    $routes->post('dosen/update/(:any)', 'Admin\DosenController::update/$1');
    $routes->get('dosen/delete/(:any)', 'Admin\DosenController::delete/$1');
    // Mata Kuliah
    $routes->get('data-matakuliah', 'Admin\MataKuliahController::index');
    $routes->get('matakuliah/create', 'Admin\MataKuliahController::create');
    $routes->post('matakuliah/save', 'Admin\MataKuliahController::save');
    $routes->get('matakuliah/form-edit/(:any)', 'Admin\MataKuliahController::form_edit/$1');
    $routes->post('matakuliah/update/(:any)', 'Admin\MataKuliahController::update/$1');
    $routes->post('matakuliah/delete/(:any)', 'Admin\MataKuliahController::delete/$1');
    $routes->get('matakuliah/kontrak/(:any)', 'Admin\MataKuliahController::kontrak/$1');
    $routes->post('matakuliah/kontrak/filter', 'Admin\MataKuliahController::filter');
    $routes->post('matakuliah/kontrak/save', 'Admin\MataKuliahController::save_kontrak');
    $routes->post('matakuliah/kontrak/check', 'Admin\MataKuliahController::check');
    // WaktuPresensi
    $routes->get('data-waktupresensi', 'Admin\WaktuPresensiController::index');
    $routes->get('waktupresensi/create', 'Admin\WaktuPresensiController::create');
    $routes->post('waktupresensi/save', 'Admin\WaktuPresensiController::save');
    $routes->get('waktupresensi/form_edit/(:any)', 'Admin\WaktuPresensiController::form_edit/$1');
    $routes->post('waktupresensi/update/(:any)', 'Admin\WaktuPresensiController::update/$1');
    $routes->post('waktupresensi/delete/(:any)', 'Admin\WaktuPresensiController::delete/$1');
    $routes->get('waktupresensi/rincian/(:any)', 'Admin\WaktuPresensiController::rincian/$1');
    $routes->post('waktupresensi/update-kehadiran', 'Admin\WaktuPresensiController::updateKehadiran');
    //Presensi
    $routes->get('data-presensi', 'Admin\PresensiController::index');
    $routes->get('presensi/create', 'Admin\PresensiController::create');
    $routes->post('presensi/save', 'Admin\PresensiController::save');
    $routes->get('presensi/form-edit/(:any)', 'Admin\PresensiController::form-edit/$1');
    $routes->post('presensi/update/(:any)', 'Admin\PresensiController::update/$1');
    $routes->get('presensi/delete/(:any)', 'Admin\PresensiController::delete/$1');
});

$routes->group('dosen', ['filter' => 'dosen/auth'], function ($routes) {
    $routes->get('dashboard', 'Dosen\DashboardController::index');
    // WaktuPresensi
    $routes->get('data-waktupresensi', 'Dosen\WaktuPresensiController::index');
    $routes->get('waktupresensi/form-edit/(:any)', 'Dosen\WaktuPresensiController::form_edit/$1');
    $routes->post('waktupresensi/update/(:any)', 'Dosen\WaktuPresensiController::update/$1');
    $routes->get('waktupresensi/rincian/(:any)', 'Dosen\WaktuPresensiController::rincian/$1');

    $routes->post('waktupresensi/update-kehadiran', 'Admin\WaktuPresensiController::updateKehadiranDosen');
    //Presensi
    $routes->get('data-presensi', 'Dosen\PresensiController::index');
});

$routes->get('model', 'Home::getModel');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
