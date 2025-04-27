<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Logbook Bimbingan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header-info {
            border-bottom: 2px solid #004d00;
            padding-bottom: 10px;
        }

        .status-verified {
            color: red;
        }
    </style>
</head>

<body>
    

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Materi Bimbingan</th>
                    <th>Catatan Dosen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logbook as $entry): ?>
                    <tr>
                        <td><?= esc($entry['tanggal']) ?></td>
                        <td><?= esc($entry['aktivitas']) ?></td>
                        <td><?= esc($entry['catatan_dosen']) ?: 'Belum Ada Catatan dari Dosen' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>