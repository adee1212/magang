<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentukan Bimbingan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<body>
    <div class="container mt-5">
        <h2>Tentukan Bimbingan Mahasiswa</h2>

        <form method="POST" action="<?= site_url('admin/save-bimbingan'); ?>">
            <div class="form-group">
                <label for="mahasiswa_id">Pilih Mahasiswa:</label>
                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control" required>
                    <?php foreach ($mahasiswa as $mhs): ?>
                        <option value="<?= esc($mhs['mahasiswa_id']) ?>"><?= esc($mhs['nama_lengkap']) ?> (<?= esc($mhs['nim']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dosen_id">Pilih Dosen Pembimbing:</label>
                <select name="dosen_id" id="dosen_id" class="form-control" required>
                    <?php foreach ($dosen as $dsn): ?>
                        <option value="<?= esc($dsn['dosen_id']) ?>"><?= esc($dsn['nama_lengkap']) ?> (<?= esc($dsn['nip']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tentukan Bimbingan</button>
        </form>
    </div>
</body>

</html>