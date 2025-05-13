<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Panitia</title>
</head>

<body>
    <h1>Selamat datang, Panitia!</h1>
    <p>Ini adalah dashboard panitia.</p>

    <!-- Tambahan tombol navigasi -->
    <div>
        <a href="<?= base_url('panitia/editProfil') ?>">Edit Profil</a>
        <button>Edit Profil</button>
        </a>

        <a href="<?= base_url('panitia/gantiPassword') ?>">Ganti Password</a>
        <button>Ganti Password</button>
        </a>
    </div>
</body>

</html>