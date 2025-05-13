<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 0; }
        nav { background-color: #2c3e50; color: white; padding: 15px 20px; }
        .container { padding: 30px; }
        form { max-width: 500px; background: #ecf0f1; padding: 20px; border-radius: 10px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="password"] {
            width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #bdc3c7; border-radius: 5px;
        }
        button { margin-top: 20px; padding: 10px 15px; background-color: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

<nav>
    <strong>Ganti Password</strong>
</nav>

<div class="container">
    <form action="/kps/update-password" method="post">
        <?= csrf_field() ?>
        <label for="old_password">Password Lama</label>
        <input type="password" name="old_password" required>

        <label for="new_password">Password Baru</label>
        <input type="password" name="new_password" required>

        <label for="confirm_password">Konfirmasi Password Baru</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Ganti Password</button>
    </form>
</div>

</body>
</html>
