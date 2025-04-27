<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password Dosen Pembimbing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Ganti Password Dosen Pembimbing</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?= form_open('dosen/update-password'); ?>
        <div class="form-group">
            <label for="current_password">Password Saat Ini</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit" class="btn btn-primary">Ganti Password</button>
        <a href="<?= site_url('dosen/dashboard'); ?>" class="btn btn-secondary">Kembali</a>
        <?= form_close(); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>