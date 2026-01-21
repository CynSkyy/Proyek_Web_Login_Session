<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$menu = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Restoran</title>
    <link rel="stylesheet" href="../assets/user.css">
</head>
<body>

<div class="header">
    <h2>Halo, <?= htmlspecialchars($_SESSION['nama']) ?> 👋</h2>
    <a href="../auth/logout.php">Logout</a>
</div>

<h3>Daftar Menu</h3>

<div class="menu-container">
<?php while ($m = mysqli_fetch_assoc($menu)) : ?>
    <div class="menu-card">

        <?php if (!empty($m['gambar'])) : ?>
            <img src="../assets/image/menu/<?= $m['gambar'] ?>" alt="<?= $m['nama_menu'] ?>">
        <?php else : ?>
            <img src="../assets/image/menu/default.jpg" alt="Menu">
        <?php endif; ?>

        <h4><?= htmlspecialchars($m['nama_menu']) ?></h4>
        <p>Rp <?= number_format($m['harga']) ?></p>
        
        <a href="tambah_keranjang.php?id=<?= $m['id'] ?>" class="btn">
        Pesan
        </a>

    </div>
<?php endwhile; ?>
</div>

<div class="bottom-link">
    <a href="keranjang.php">🛒 Lihat Keranjang</a>
</div>

</body>
</html>
