<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil KPS</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
        }

        .container {
            padding: 30px;
        }

        form {
            max-width: 500px;
            background: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav>
        <strong>Edit Profil KPS</strong>
    </nav>
    <div class="container">
        <form action="/kps/update-profil" method="post">
            <?= csrf_field() ?>

            <label for="nip">NIP</label>
            <input type="text" name="nip" value="<?= esc($kps['nip']) ?>" required readonly>

            <label for="nama">Nama</label>
            <input type="text" name="nama" value="<?= esc($kps['nama']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= esc($kps['email']) ?>" required>

            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" value="<?= esc($kps['no_telepon']) ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>

</html>