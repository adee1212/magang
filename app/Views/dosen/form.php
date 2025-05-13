<form method="post" action="<?= site_url('dosen/penilaian-dosen/save'); ?>" class="p-4 rounded bg-light shadow-sm" style="max-width: 600px; margin: auto;">
    <input type="hidden" name="bimbingan_id" value="<?= $bimbingan_id ?>">

    <h4 class="mb-3 text-center">Input Nilai Mahasiswa</h4>

    <div class="mb-4">
        <h5>Pelaporan 30%</h5>
        <div class="form-group mb-2">
            <label>1.1 Mahasiswa mampu menuliskan kesesuaian judul Magang dengan produk yang dihasilkan</label>
            <input type="number" name="nilai_1_1" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>1.2 Mahasiswa mampu menggunakan Tata bahasa & Tata tulis dengan baik dan benar</label>
            <input type="number" name="nilai_1_2" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>1.3 Mahasiswa mampu menyusun laporan magang sesuai dengan format & kerangka standar yang berlaku</label>
            <input type="number" name="nilai_1_3" min="5" max="10" class="form-control" required>
        </div>
    </div>

    <div class="mb-4">
        <h5>Presentasi 40%</h5>
        <div class="form-group mb-2">
            <label>2.1 Mahasiswa mampu menunjukkan Pengetahuan praktis sesuai dengan kegiatan magang</label>
            <input type="number" name="nilai_2_1" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>2.2 Mahasiswa mampu menjawab pertanyaan dengan tepat dan jelas</label>
            <input type="number" name="nilai_2_2" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>2.3 Mahasiswa menunjukkan Etika/ sikap yang baik</label>
            <input type="number" name="nilai_2_3" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>2.4 Mahasiswa mampu menjustifikasi kesesuaian kegiatan magang dengan profil lulusan PSI Mulai</label>
            <input type="number" name="nilai_2_4" min="5" max="10" class="form-control" required>
        </div>
    </div>

    <div class="mb-4">
        <h5>Bimbingan 30%</h5>
        <div class="form-group mb-2">
            <label>3.1 Mahasiswa melakukan bimbingan minimal 4 kali</label>
            <input type="number" name="nilai_3_1" min="5" max="10" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>3.2 Mahasiswa mampu menunjukkan bukti kemajuan bimbingan secara berkala</label>
            <input type="number" name="nilai_3_2" min="5" max="10" class="form-control" required>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>