<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Bimbingan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Logbook Bimbingan</h2>
        <?php if (session()->get('logged_in')): ?>
            <h5>Selamat datang, <?= esc(session()->get('nama')) ?>!</h5>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('mahasiswa/logbook/create'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="aktivitas">Aktivitas:</label>
                <textarea name="aktivitas" id="aktivitas" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="catatan_dosen">Catatan Dosen:</label>
                <textarea name="catatan_dosen" id="catatan_dosen" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="file_dokumen">Upload Dokumen (PDF):</label>
                <input type="file" name="file_dokumen" id="file_dokumen" class="form-control-file" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="link_drive">Link Google Drive (opsional):</label>
                <input type="url" name="link_drive" id="link_drive" class="form-control" placeholder="https://drive.google.com/...">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Logbook</button>
        </form>

        <h3 class="mt-4">Daftar Logbook</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Aktivitas</th>
                    <th>Catatan Dosen</th>
                    <th>Status Validasi</th>
                    <th>Dokumen</th>
                    <th>Link Drive</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logbook as $entry): ?>
                    <tr>
                        <td><?= esc($entry['tanggal']) ?></td>
                        <td><?= esc($entry['aktivitas']) ?></td>
                        <td><?= esc($entry['catatan_dosen']) ?? 'Belum ada catatan' ?></td>
                        <td><?= esc($entry['status_validasi']) ?></td>
                        <td>
                            <?php if (!empty($entry['file_dokumen'])): ?>
                                <a href="<?= base_url('uploads/logbook/' . $entry['file_dokumen']) ?>" target="_blank">Download</a>
                            <?php else: ?>
                                Tidak ada file
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($entry['link_drive'])): ?>
                                <a href="<?= esc($entry['link_drive']) ?>" target="_blank">Drive</a>
                            <?php else: ?>
                                Tidak ada link
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>