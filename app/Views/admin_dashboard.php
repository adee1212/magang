<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">MAGANG | Politeknik Negeri Jakarta (PNJ)</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar Mahasiswa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('/admin/daftarmahasiswa'); ?>">Daftar Mahasiswa</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/admin/logbook'); ?>">Logbook Bimbingan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/aktivitas'); ?>">Logbook Aktivitas</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/nilai'); ?>">Nilai Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/admin/tambah-bimbingan'); ?>">Tambah Bimbingan</a> <!-- Tambahkan link untuk tambah bimbingan -->
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/logout') ?>" class="btn btn-light ms-2">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h3>Selamat datang, <?= session('nama') ?></h3>
        <p>Role: <?= session('role') ?></p>
        <div class="card mt-3 p-4">
            <h5>Menu Admin</h5>
            <ul>
                <li><a href="<?= base_url('/upload-user-excel') ?>">Upload User dari Excel</a></li>
                <li><a href="<?= base_url('/register') ?>">Tambah Akun Manual</a></li>
                <li><a href="<?= base_url('/mahasiswa/manage') ?>">Kelola Mahasiswa</a></li>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>