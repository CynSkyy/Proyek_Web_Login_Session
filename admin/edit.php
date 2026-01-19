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
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    <input type="text" name="nama" value="<?= $user['nama'] ?>" required><br><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>
    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"><br><br>

    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>
