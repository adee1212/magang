<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #004d00;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            /* Adjust based on the navbar height */
            left: 0;
            width: 250px;
            height: calc(100% - 56px);
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand text-white" href="#">MAGANG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mahasiswa
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= site_url('mahasiswa/edit'); ?>">Profile</a>
                        <a class="dropdown-item" href="<?= site_url('mahasiswa/ganti-password'); ?>">Ganti Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="sidebar">
        <h3>Menu</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('mahasiswa/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('mahasiswa/logbook'); ?>">Logbook Bimbingan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('mahasiswa/logbook_industri'); ?>">Logbook Aktivitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('mahasiswa/user-requirement'); ?>">User Requirement</a>
            </li>
        </ul>
    </div>

    <div class="container mt-5" style="margin-left: 260px;">
        <h2>Dashboard Mahasiswa</h2>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Mahasiswa</h5>
                <p class="card-text">
                    <strong>Nama:</strong> <?= esc($mahasiswa['nama_lengkap']) ?> <br>
                    <strong>NIM:</strong> <?= esc($mahasiswa['nim']) ?> <br>
                    <strong>Email:</strong> <?= esc($mahasiswa['email']) ?> <br>
                </p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Upload Laporan Magang</h5>
                <form method="post" action="<?= site_url('mahasiswa/upload'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Pilih File:</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Petunjuk Pengisian Logbook</h5>
                <p>
                    1. Login untuk mengisi logbook.<br>
                    2. Pastikan semua data diisi dengan lengkap.<br>
                    3. Lengkapi semua kolom yang diperlukan dan upload laporan sesuai waktu yang ditentukan.
                </p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>