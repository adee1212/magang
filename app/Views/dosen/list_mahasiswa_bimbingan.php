<!DOCTYPE html>
<html>

<head>
    <title>Mahasiswa Bimbingan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Mahasiswa Bimbingan</h2>

        <?php if (!empty($mahasiswaList)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mahasiswaList as $mhs): ?>
                        <tr>
                            <td><?= esc($mhs['nama_lengkap']) ?></td>
                            <td><?= esc($mhs['nim']) ?></td>
                            <td><?= esc($mhs['program_studi']) ?></td>
                            <td>
                                <a href="<?= site_url('dosen/bimbingan/detail/' . $mhs['mahasiswa_id']) ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada mahasiswa bimbingan.</p>
        <?php endif ?>
    </div>
</body>

</html>