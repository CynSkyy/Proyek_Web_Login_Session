<?php
session_start();
include '../config/database.php';


$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>
<body>

<div class="login-background">
    <div class="login-container">
        <h2>Login</h2>

        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <a href="Project.html" class="btn-cancel">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>

