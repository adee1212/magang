<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen Pembimbing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #004d00;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand text-white" href="#">MAGANG | Politeknik Negeri Jakarta (PNJ)</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= site_url('dosen/dashboard'); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Daftar Mahasiswa
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= site_url('dosen/bimbingan'); ?>">Daftar Mahasiswa</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('mahasiswa/logbook'); ?>">Logbook Bimbingan</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('mahasiswa/logbook_industri'); ?>">Logbook Aktivitas</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('mahasiswa/nilai'); ?>">Nilai Mahasiswa</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= site_url('dosen/bimbingan'); ?>">Kuesioner Industri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= site_url('admin/generate-akun'); ?>">Generate Akun</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            <?= session('nama') ?> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= site_url('dosen/edit'); ?>">Profile</a>
                            <a class="dropdown-item" href="<?= site_url('dosen/ganti-password'); ?>">Ganti Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Selamat datang, <?= session('nama') ?></h3>

        <div class="card mt-3 p-4">
            <h5>Menu Dosen Pembimbing</h5>
            <ul>
                <li><a href="<?= site_url('mahasiswa/logbook'); ?>">Lihat Logbook Mahasiswa</a></li>
                <li><a href="<?= site_url('mahasiswa/logbook_industri'); ?>">Lihat Logbook Aktivitas</a></li>
                <li><a href="<?= site_url('mahasiswa/nilai'); ?>">Lihat Nilai Mahasiswa</a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>