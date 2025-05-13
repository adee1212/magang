<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard KPS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 30px;
        }

        .card {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            color: #2c3e50;
        }
    </style>
</head>
<body>

<!-- HEADER NAVIGATION -->
<nav>
    <div><strong>Dashboard KPS</strong></div>
    <div class="nav-links">
        <a href="/kps/profil">Profil</a>
        <a href="/kps/edit-profil">Edit Profil</a>
        <a href="/kps/ganti-password">Ganti Password</a>
        <a href="/logout">Logout</a>
    </div>
</nav>

<!-- ISI DASHBOARD -->
<div class="container">
    <h2>Selamat Datang, <?= esc(session('nama')) ?>!</h2>

    <div class="card">
        <p><strong>NIP:</strong> <?= esc($kps['nip']) ?></p>
        <p><strong>Email:</strong> <?= esc($kps['email']) ?></p>
        <p><strong>No Telepon:</strong> <?= esc($kps['no_telepon']) ?></p>
    </div>
</div>

</body>
</html>
