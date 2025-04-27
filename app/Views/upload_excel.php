<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Import Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4">Import Akun Mahasiswa dari Excel</h3>

  <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info">
      <?= session()->getFlashdata('message') ?>
    </div>
  <?php endif; ?>

  <form action="<?= base_url('/upload-excel') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="excel_file" class="form-label">Pilih File Excel (.xlsx)</label>
      <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls" required>
    </div>

    <button type="submit" class="btn btn-primary">Upload & Import</button>
  </form>

  <hr class="my-4">
  <p><strong>Format Kolom Excel:</strong></p>
  <ol>
    <li>Nama Lengkap</li>
    <li>NIM</li>
    <li>Program Studi</li>
    <li>Kelas</li>
    <li>No HP</li>
    <li>Nama Perusahaan</li>
    <li>Divisi</li>
    <li>Durasi Magang</li>
    <li>Tanggal Mulai Magang</li>
    <li>Tanggal Selesai Magang</li>
    <li>Nama Pembimbing Industri</li>
    <li>No HP Pembimbing</li>
    <li>Email Pembimbing</li>
  </ol>
</div>
</body>
</html>
