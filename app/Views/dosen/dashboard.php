<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen Pembimbing</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">MAGANG | Politeknik Negeri Jakarta (PNJ)</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <?= session('nama') ?> <!-- Menampilkan Nama Dosen -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= site_url('dosen/editProfile'); ?>">Edit Profil</a>
                            <a class="dropdown-item" href="<?= site_url('dosen/changePassword'); ?>">Ganti Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

<div class="container mt-4">
    <h2>Dashboard Dosen Pembimbing</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card mt-3 p-4">
        <h5>Informasi Dosen Pembimbing</h5>
        <p class="card-text">
            <strong>Nama:</strong> <?= esc($dosen['nama_lengkap']) ?> <br>
            <strong>NIP:</strong> <?= esc($dosen['nip']) ?> <br>
            <strong>No Telepon:</strong> <?= esc($dosen['no_telepon']) ?> <br>
            <strong>Email:</strong> <?= esc($dosen['email']) ?> <br>
            <strong>Link WhatsApp:</strong> <a href="<?= esc($dosen['link_whatsapp']) ?>" target="_blank"><?= esc($dosen['link_whatsapp']) ?></a>
        </p>
    </div>

    <div class="mt-4">
        <a href="<?= site_url('dosen/bimbingan'); ?>" class="btn btn-primary">Lihat Bimbingan Mahasiswa</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>