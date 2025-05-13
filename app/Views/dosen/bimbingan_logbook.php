<!DOCTYPE html>
<html lang="en">

<head>
    <title>Logbook Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Logbook: <?= esc($mahasiswa['nama_lengkap']) ?> (<?= esc($mahasiswa['nim']) ?>)</h2>
        <?php
        // Hitung jumlah logbook yang disetujui
        $logbookLayakDinilai = array_filter($logbooks, function ($log) {
            return isset($log['status_validasi']) && $log['status_validasi'] === 'disetujui';
        });
        $jumlahDisetujui = count($logbookLayakDinilai);
        ?>
        <p><strong>Logbook disetujui:</strong> <?= $jumlahDisetujui ?> / <?= count($logbooks) ?></p>
        <?php if (!empty($logbooks)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logbooks as $log): ?>
                        <tr>
                            <td><?= esc($log['tanggal']) ?></td>
                            <td><?= esc($log['aktivitas']) ?></td>
                            <td><?= esc($log['catatan_dosen']) ?: 'Belum ada catatan' ?></td>
                            <td>
                                <?php if ($log['status_validasi'] === 'menunggu'): ?>
                                    <form action="<?= site_url('dosen/bimbingan/setujui/' . $log['logbook_id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                    </form>
                                    <form action="<?= site_url('dosen/bimbingan/tolak/' . $log['logbook_id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-warning btn-sm">Tolak</button>
                                    </form>
                                    <form action="<?= site_url('dosen/bimbingan/hapus/' . $log['logbook_id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus logbook ini?');">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                <?php elseif ($log['status_validasi'] === 'disetujui'): ?>
                                    <span class="badge badge-success">Disetujui</span>
                                <?php elseif ($log['status_validasi'] === 'ditolak'): ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada logbook yang diinput.</p>
        <?php endif; ?>

        <!-- Tombol Penilaian -->
        <?php if ($jumlahDisetujui >= 6 && !empty($bimbingan_id)): ?>
            <button type="button" class="btn btn-primary mt-3" onclick="location.href='<?= site_url('dosen/penilaian-dosen/form/' . $bimbingan_id) ?>'">
                Beri Penilaian
            </button>
        <?php else: ?>
            <div class="alert alert-warning mt-3">
                Mahasiswa belum memenuhi syarat penilaian atau bimbingan tidak ditemukan.
            </div>
        <?php endif; ?>



        <a href="<?= site_url('dosen/bimbingan_logbook') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>

</html>