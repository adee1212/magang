<!DOCTYPE html>
<html>

<head>
    <title>Edit Profil Panitia</title>
</head>

<body>
    <h1>Edit Profil</h1>

    <form action="/panitia/updateProfil" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= esc($panitia['email'] ?? '') ?>" required>
        <br>

        <label for="no_telepon">No. Telepon:</label>
        <input type="text" id="no_telepon" name="no_telepon" value="<?= esc($panitia['no_telepon'] ?? '') ?>" required>
        <br>

        <button type="submit">Update Profil</button>
    </form>
</body>

</html>