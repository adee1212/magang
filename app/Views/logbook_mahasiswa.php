<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monitoring Logbook Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .status-verifikasi.sudah {
            color: green;
        }

        .status-verifikasi.belum {
            color: red;
        }

        .search-input {
            width: 300px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Monitoring Logbook Mahasiswa</h2>

        <input type="text" id="searchInput" class="form-control search-input" placeholder="Search...">

        <table class="table table-bordered table-striped" id="logbookTable">
            <thead>
                <tr>
                    <th>Detail</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><a href="<?= base_url('admin/logbook/' . $mhs['mahasiswa_id']) ?>">Detail</a></td>
                        <td><?= esc($mhs['nama_lengkap']) ?></td> 
                        <td><?= esc($mhs['nim']) ?></td>
                        <td><?= esc($mhs['program_studi']) ?></td>
                        <td><?= esc($mhs['kelas']) ?></td>
                        <td class="status-verifikasi <?= $mhs['status'] === 'Sudah Verifikasi' ? 'sudah' : 'belum' ?>">
                            <?= esc($mhs['status']) ?>
                        </td>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("logbookTable").getElementsByTagName("tbody")[0];

        searchInput.addEventListener("keyup", function() {
            const filter = searchInput.value.toLowerCase();
            for (let row of table.rows) {
                row.style.display = [...row.cells].some(cell =>
                    cell.textContent.toLowerCase().includes(filter)
                ) ? "" : "none";
            }
        });
    </script>
</body>

</html>