<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Daftar Mahasiswa</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Program Studi</th>
                    <th>Kelas</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Nama Perusahaan</th>
                    <th>Divisi</th>
                    <th>Durasi Magang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Nama Pembimbing Perusahaan</th>
                    <th>No HP Pembimbing</th>
                    <th>Email Pembimbing</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= esc($no++) ?></td>
                        <td><?= esc($mhs['nim']) ?></td>
                        <td><?= esc($mhs['nama_lengkap']) ?></td>
                        <td><?= esc($mhs['program_studi']) ?></td>
                        <td><?= esc($mhs['kelas']) ?></td>
                        <td><?= esc($mhs['no_hp']) ?></td>
                        <td><?= esc($mhs['email']) ?></td>
                        <td><?= esc($mhs['nama_perusahaan']) ?></td>
                        <td><?= esc($mhs['divisi']) ?></td>
                        <td><?= esc($mhs['durasi_magang']) ?></td>
                        <td><?= esc($mhs['tanggal_mulai']) ?></td>
                        <td><?= esc($mhs['tanggal_selesai']) ?></td>
                        <td><?= esc($mhs['nama_pembimbing_perusahaan']) ?></td>
                        <td><?= esc($mhs['no_hp_pembimbing_perusahaan']) ?></td>
                        <td><?= esc($mhs['email_pembimbing_perusahaan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>