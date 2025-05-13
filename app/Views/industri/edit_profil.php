<form action="<?= base_url('/industri/update-profil') ?>" method="post" class="container mt-4">
    <h4>Edit Profil</h4>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $profil['nama'] ?>">
    </div>
    <div class="mb-3">
        <label>No Telepon</label>
        <input type="text" name="no_telepon" class="form-control" value="<?= $profil['no_telepon'] ?>">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= $profil['email'] ?>">
    </div>
    <div class="mb-3">
        <label>Perusahaan</label>
        <input type="text" name="perusahaan" class="form-control" value="<?= $profil['perusahaan'] ?>">
    </div>
    <div class="mb-3">
        <label>NIP</label>
        <input type="text" name="nip" class="form-control" value="<?= $profil['nip'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>