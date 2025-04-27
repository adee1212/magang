<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Bimbingan Industri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Logbook Bimbingan Industri</h2>
        <?php if (session()->get('logged_in')): ?>
            <h5>Selamat datang, <?= esc(session()->get('nama')) ?>!</h5> <!-- Menampilkan Nama Mahasiswa -->
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('mahasiswa/logbook_industri/create'); ?>">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="aktivitas">Aktivitas:</label>
                <textarea name="aktivitas" id="aktivitas" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="catatan_industri">Catatan Industri:</label>
                <textarea name="catatan_industri" id="catatan_industri" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Logbook</button>
        </form>

        <h3 class="mt-4">Daftar Logbook</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Aktivitas</th>
                    <th>Catatan Dosen</th>
                    <th>Status Validasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logbook as $entry): ?>
                    <tr>
                        <td><?= esc($entry['tanggal']) ?></td>
                        <td><?= esc($entry['aktivitas']) ?></td>
                        <td><?= esc($entry['catatan_industri']) ?? 'Belum ada catatan' ?></td>
                        <td><?= esc($entry['status_validasi']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>