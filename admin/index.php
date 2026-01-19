<?php
session_start();
include '../config/database.php';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Data User</title>
</head>
<body>

<h2>Data User</h2>

<table border="1" cellpadding="8">
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
        <a href="edit.php?id=<?= $u['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $u['id'] ?>"
           onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="../project.php">← Kembali ke Beranda</a>

</body>
</html>
