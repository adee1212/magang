<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Industri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Industri Dashboard</a>
      <div class="d-flex gap-2">
        <!-- Tombol Edit Profil -->
        <a href="<?= base_url('industri/edit-profil') ?>" class="btn btn-outline-light btn-sm">Edit Profil</a>

        <!-- Tombol Ganti Password -->
        <a href="<?= base_url('industri/ganti-password') ?>" class="btn btn-outline-light btn-sm">Ganti Password</a>

        <!-- Logout -->
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="container mt-4">
    <h3>Selamat datang di Dashboard Pembimbing Industri</h3>
    <p>Ini adalah halaman utama Anda untuk memantau kegiatan bimbingan industri.</p>

    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card border-primary shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Total Mahasiswa Bimbingan</h5>
            <p class="card-text fs-4">0</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-success shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Laporan Disetujui</h5>
            <p class="card-text fs-4">0</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-warning shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Laporan Menunggu</h5>
            <p class="card-text fs-4">0</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>