<!DOCTYPE html>
<html>

<head>
    <title>Ganti Password</title>
</head>

<body>
    <h1>Ganti Password</h1>

    <form action="/panitia/gantiPassword" method="post">
        <label for="password_lama">Password Lama:</label>
        <input type="password" id="password_lama" name="password_lama" required>
        <br>

        <label for="password_baru">Password Baru:</label>
        <input type="password" id="password_baru" name="password_baru" required>
        <br>

        <label for="konfirmasi_password">Konfirmasi Password Baru:</label>
        <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
        <br>

        <button type="submit">Ganti Password</button>
    </form>
</body>

</html>
