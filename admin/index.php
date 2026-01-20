<?php
session_start();
include '../config/database.php';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Data User</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Data User</h2>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while ($u = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $u['nama'] ?></td>
            <td><?= $u['email'] ?></td>
            <td>
                <a href="edit.php?id=<?= $u['id'] ?>" class="btn btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $u['id'] ?>"
                   class="btn btn-hapus"
                   onclick="return confirm('Yakin hapus user ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="../project.php" class="back">← Kembali ke Beranda</a>

</div>

</body>
</html>
