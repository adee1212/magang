<h2>Atur Bimbingan Industri</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div style="color: green;"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<form method="post" action="/admin/bimbingan-industri/save">
    <label>Mahasiswa:</label><br>
    <select name="mahasiswa_id" required>
        <option value="">-- Pilih Mahasiswa --</option>
        <?php foreach ($mahasiswa as $m): ?>
            <option value="<?= $m['mahasiswa_id'] ?>">
                <?= $m['nama_lengkap'] ?> (<?= $m['nama_perusahaan'] ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Pembimbing Industri:</label><br>
    <select name="pembimbing_id" required>
        <option value="">-- Pilih Pembimbing Industri --</option>
        <?php foreach ($pembimbing as $p): ?>
            <option value="<?= $p['pembimbing_id'] ?>">
                <?= $p['nama'] ?> (<?= $p['perusahaan'] ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Simpan Bimbingan Industri</button>
</form>