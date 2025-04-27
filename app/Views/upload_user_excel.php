<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload User Excel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4">Import Akun User dari Excel</h3>

  <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info">
      <?= session()->getFlashdata('message') ?>
    </div>
  <?php endif; ?>

  <form action="<?= base_url('/upload-user-excel') ?>" method="post" enctype="multipart/form-data">
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
    <li>Nomor Induk</li>
    <li>Password</li>
    <li>Role (mahasiswa, dosen, panitia, kps, pembimbing_industri)</li>
  </ol>
</div>
</body>
</html>
