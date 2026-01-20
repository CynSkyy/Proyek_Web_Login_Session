<?php
session_start();
include '../config/database.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM users WHERE id='$id'")
);

if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn,
            "UPDATE users SET nama='$nama', email='$email', password='$password'
             WHERE id='$id'"
        );
    } else {
        mysqli_query($conn,
            "UPDATE users SET nama='$nama', email='$email'
             WHERE id='$id'"
        );
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Edit User</h2>
        <a href="index.php" class="back">← Kembali</a>
    </div>

    <form method="POST" class="form-admin">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $user['nama'] ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">

        <button type="submit" name="update" class="btn btn-edit">
            Update
        </button>
    </form>

</div>

</body>
</html>

