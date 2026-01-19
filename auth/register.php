<?php
session_start();
include '../config/database.php';

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar!";
    } elseif ($password !== $password2) {
        $error = "Konfirmasi password tidak sama!";
    } else {
        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = mysqli_query($conn, 
            "INSERT INTO users (nama, email, password)
             VALUES ('$nama', '$email', '$hash')"
        );

        if ($insert) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>

<div class="login-background">
    <div class="login-container">
        <h2>Register</h2>

        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password2" placeholder="Konfirmasi Password" required>

            <button type="submit" name="register" class="btn-login">Daftar</button>
        </form>

        <p style="margin-top:10px; font-size:14px;">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </p>

        <a href="../Project.php" class="btn-cancel">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>
