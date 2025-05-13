<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Profil Mahasiswa</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('mahasiswa/update'); ?>">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= esc($mahasiswa['nama_lengkap']) ?>" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" name="nim" id="nim" class="form-control" value="<?= esc($mahasiswa['nim']) ?>" required>
            </div>
            <div class="form-group">
                <label for="program_studi">Program Studi:</label>
                <input type="text" name="program_studi" id="program_studi" class="form-control" value="<?= esc($mahasiswa['program_studi']) ?>" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" id="kelas" class="form-control" value="<?= esc($mahasiswa['kelas']) ?>" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= esc($mahasiswa['no_hp']) ?>">
            </div>
            <div class="form-group">
                <label for="nama_perusahaan">Nama Perusahaan:</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="<?= esc($mahasiswa['nama_perusahaan']) ?>">
            </div>
            <div class="form-group">
                <label for="divisi">Divisi:</label>
                <input type="text" name="divisi" id="divisi" class="form-control" value="<?= esc($mahasiswa['divisi']) ?>">
            </div>
            <div class="form-group">
                <label for="durasi_magang">Durasi Magang (dalam minggu/bulan):</label>
                <input type="number" name="durasi_magang" id="durasi_magang" class="form-control" value="<?= esc($mahasiswa['durasi_magang']) ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?= esc($mahasiswa['tanggal_mulai']) ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?= esc($mahasiswa['tanggal_selesai']) ?>">
            </div>
            <div class="form-group">
                <label for="nama_pembimbing_perusahaan">Nama Pembimbing Perusahaan:</label>
                <input type="text" name="nama_pembimbing_perusahaan" id="nama_pembimbing_perusahaan" class="form-control" value="<?= esc($mahasiswa['nama_pembimbing_perusahaan']) ?>">
            </div>
            <div class="form-group">
                <label for="no_hp_pembimbing_perusahaan">No HP Pembimbing Perusahaan:</label>
                <input type="text" name="no_hp_pembimbing_perusahaan" id="no_hp_pembimbing_perusahaan" class="form-control" value="<?= esc($mahasiswa['no_hp_pembimbing_perusahaan']) ?>">
            </div>
            <div class="form-group">
                <label for="email_pembimbing_perusahaan">Email Pembimbing Perusahaan:</label>
                <input type="email" name="email_pembimbing_perusahaan" id="email_pembimbing_perusahaan" class="form-control" value="<?= esc($mahasiswa['email_pembimbing_perusahaan']) ?>">
            </div>
            <div class="form-group">
                <label for="judul_magang">Isi judul Laporan Magang:</label>
                <input type="email" name="email_pembimbing_perusahaan" id="judul_magang" class="form-control" value="<?= esc($mahasiswa['email_pembimbing_perusahaan']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

        <div class="mt-4">
            <a href="<?= site_url('mahasiswa/dashboard'); ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>