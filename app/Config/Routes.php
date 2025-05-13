<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/Admin', 'Admin::about');
$routes->get('/', 'Home::admin');
$routes->get('/register', 'AuthController::register'); // Menampilkan halaman registrasi
$routes->post('/register/create', 'AuthController::create'); // Memproses pendaftaran baru
$routes->get('/login', 'AuthController::index'); // Menampilkan halaman login
$routes->post('/login', 'AuthController::login'); // Memproses login
$routes->get('/admin/daftarmahasiswa', 'MahasiswaController::index'); // Rute untuk daftar mahasiswa
$routes->get('/logout', 'AuthController::logout'); // Menangani logout
$routes->get('/admin/logbook', 'AdminLogbookController::index');
$routes->get('/admin/logbook/(:num)', 'AdminLogbookController::detail/$1');
$routes->get('/admin/tambah-bimbingan', 'AdminController::tambahBimbingan'); // Menampilkan form untuk menambahkan bimbingan
$routes->post('admin/save-bimbingan', 'BimbinganController::tentukanBimbingan');
$routes->get('/admin/bimbingan-industri', 'AdminController::tambahBimbinganIndustri');
$routes->post('/admin/bimbingan-industri/save', 'AdminController::saveBimbinganIndustri');




$routes->get('/mahasiswa/edit', 'MahasiswaController::edit'); // Rute untuk edit profil mahasiswa
$routes->post('/mahasiswa/update', 'MahasiswaController::update'); // Rute untuk mengupdate profil mahasiswa
$routes->group('mahasiswa', function ($routes) {
    $routes->get('dashboard', 'MahasiswaController::index');

    // Logbook Bimbingan Mahasiswa
    $routes->get('logbook', 'LogbookController::index');
    $routes->post('logbook/create', 'LogbookController::create');

    // Logbook Industri Mahasiswa
    $routes->get('logbook_industri', 'LogbookIndustriController::index');
    $routes->post('logbook_industri/create', 'LogbookIndustriController::create');

    // User Requirement
    $routes->get('user-requirement', 'MahasiswaController::userRequirement');

    // Profile dan Ganti Password
    $routes->get('edit', 'MahasiswaController::edit');
    $routes->get('ganti-password', 'MahasiswaController::ganti_password');

    // Upload Laporan
    $routes->post('upload', 'MahasiswaController::upload');
});

// ==========================================
// ROUTE DOSEN
// ==========================================
$routes->group('dosen', ['filter' => 'auth'], function ($routes) {
    // Rute untuk Pembimbing Dosen
    $routes->get('/', 'DosenPembimbingController::index'); // /dosen
    $routes->get('editProfile', 'DosenPembimbingController::editProfile'); // /dosen/editProfile
    $routes->post('updateProfile', 'DosenPembimbingController::updateProfile');
    $routes->get('changePassword', 'DosenPembimbingController::changePassword');
    $routes->post('update-password', 'DosenPembimbingController::updatePassword');

    // Rute Bimbingan Logbook Mahasiswa
    $routes->get('bimbingan', 'BimbinganController::index');
    $routes->post('tentukan-bimbingan', 'BimbinganController::tentukanBimbingan');
    $routes->get('bimbingan/detail/(:num)', 'BimbinganController::detail/$1');

    // Rute untuk Penilaian Dosen
    $routes->get('penilaian-dosen', 'PenilaianDosenController::index');
    $routes->get('penilaian-dosen/form/(:num)', 'PenilaianDosenController::showForm/$1');

    $routes->post('penilaian-dosen/save', 'PenilaianDosenController::save');



    // Rute untuk Validasi Logbook Mahasiswa
    $routes->post('bimbingan/setujui/(:num)', 'BimbinganController::setujui/$1');
    $routes->post('bimbingan/tolak/(:num)', 'BimbinganController::tolak/$1');
    $routes->post('bimbingan/hapus/(:num)', 'BimbinganController::hapus/$1');
});
$routes->get('/admin/form-tambah-akun', 'Admin::formTambahAkun');
$routes->get('/upload-excel', 'UploadExcelController::index');
$routes->post('/upload-excel', 'UploadExcelController::upload');
$routes->get('/upload-user-excel', 'UploadUserController::index');
$routes->post('/upload-user-excel', 'UploadUserController::upload');
$routes->get('/admin', 'AdminController::index', ['filter' => 'auth']);
$routes->group('dosen', function ($routes) {
    $routes->get('dashboard', 'DosenPembimbingController::index'); // Rute untuk dashboard dosen pembimbing
});

$routes->group('kps', ['filter' => 'kpsauth'], function ($routes) {
    $routes->get('dashboard', 'KpsController::dashboard');
    $routes->get('profil', 'KpsController::profil');
    $routes->match(['GET', 'POST'], 'edit-profil', 'KpsController::editProfil');
    $routes->match(['GET', 'POST'], 'ganti-password', 'KpsController::gantiPassword');
    $routes->get('logout', 'KpsController::logout');
});

$routes->group('panitia', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'PanitiaController::index');
    $routes->get('editProfil', 'PanitiaController::editProfil'); // panggil method editProfil
    $routes->post('updateProfil', 'PanitiaController::updateProfil');
    $routes->post('gantiPassword', 'PanitiaController::gantiPassword');
});



// ROUTE UNTUK INDUSTRI


$routes->group('industri', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'PembimbingIndustriController::dashboard');

    // 🔧 Edit Profil
    $routes->get('edit-profil', 'PembimbingIndustriController::editProfil');
    $routes->post('update-profil', 'PembimbingIndustriController::updateProfil');

    // 🔒 Ganti Password
    $routes->get('ganti-password', 'PembimbingIndustriController::gantiPassword');
    $routes->post('simpan-password', 'PembimbingIndustriController::simpanPassword');
});



$routes->get('/dashboard', function () {
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }
    return "Halo, " . session()->get('username') . "! Anda sudah login.";
});
