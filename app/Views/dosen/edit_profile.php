<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Dosen Pembimbing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Profil Dosen Pembimbing</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?= form_open('dosen/updateProfile'); ?>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama" value="<?= esc($dosen['nama_lengkap']) ?>" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= esc($dosen['nip']) ?>" required>
            </div>

            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= esc($dosen['no_telepon']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= esc($dosen['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="link_whatsapp">Link WhatsApp</label>
                <input type="url" class="form-control" id="link_whatsapp" name="link_whatsapp" value="<?= esc($dosen['link_whatsapp']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('dosen/dashboard'); ?>" class="btn btn-secondary">Kembali</a>
        <?= form_close(); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>